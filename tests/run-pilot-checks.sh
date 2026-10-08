#!/usr/bin/env bash
# Full checks against a disposable Local database, using its configured WP-CLI shell.
set -euo pipefail
cd "$(dirname "$0")/.."
wp_bin="${NOIR_WP_BIN:-wp}"
wp_path=wordpress/app/public
run_wp() { "$wp_bin" --path="$wp_path" "$@"; }
if [[ "$(run_wp eval 'echo wp_get_environment_type();')" != local ]]; then
 echo 'These checks require a disposable Local WordPress database.' >&2
 exit 1
fi
fixture="$wp_path/wp-content/mu-plugins/noir-appointment-test.php"
mode=/tmp/noir-ticket05/mail-mode
if [[ -e "$fixture" || -e "$mode" ]]; then
 echo 'Remove the existing appointment test fixture before running the full checks.' >&2
 exit 1
fi
checks_dir=$(mktemp -d)
# A failed read is not proof of absence: abort before mutating operational state.
if ! run_wp eval '
 global $wpdb;
 $row=$wpdb->get_row($wpdb->prepare("SELECT option_value FROM {$wpdb->options} WHERE option_name=%s", "noir_request_ledger"));
 if ($wpdb->last_error) { WP_CLI::error("Cannot snapshot the appointment ledger."); }
 echo $row ? "present\n".$row->option_value : "absent\n";
' > "$checks_dir/ledger"; then
 rm -rf "$checks_dir"
 exit 1
fi
read -r restore_ledger < "$checks_dir/ledger"
if [[ "$restore_ledger" != present && "$restore_ledger" != absent ]]; then
 echo 'Invalid appointment ledger snapshot; refusing to run checks.' >&2
 rm -rf "$checks_dir"
 exit 1
fi
cleanup() {
 rm -f "$fixture" "$mode"
 if [[ "$restore_ledger" == present ]]; then
  run_wp option update noir_request_ledger "$(tail -n +2 "$checks_dir/ledger")" --autoload=off >/dev/null
 else
  run_wp option delete noir_request_ledger >/dev/null 2>&1 || true
 fi
 rm -rf "$checks_dir"
}
trap cleanup EXIT
reset_ledger() { run_wp option delete noir_request_ledger >/dev/null 2>&1 || true; }
NOIR_WP_BIN="$wp_bin" bash tests/bootstrap-cli.sh
for suite in studio contact services gallery home plugin-fallback appointment appointment-delivery appointment-reliability; do
 reset_ledger
 run_wp eval-file "tests/$suite-wordpress.php"
done
npm run check
checks_evidence="${NOIR_EVIDENCE_DIR:-docs/evidence/pilot-07}"
for suite in contact services gallery home; do
 reset_ledger
 NOIR_EVIDENCE_DIR="$checks_evidence/$suite" node "tests/$suite-browser.cjs"
done
reset_ledger
mkdir -p "$(dirname "$fixture")" "$(dirname "$mode")"
cp tests/fixtures/appointment-mail-environment.php "$fixture"
printf '%s\n' accepted > "$mode"
NOIR_MAILPIT_URL="${NOIR_MAILPIT_URL:-http://127.0.0.1:10005}" NOIR_BROWSER="${NOIR_APPOINTMENT_BROWSERS:-chrome,firefox,webkit}" NOIR_EVIDENCE_DIR="$checks_evidence/appointment" npm run test:appointment

reset_ledger
NOIR_EVIDENCE_DIR="$checks_evidence/supplemental" node tests/pilot-browser.cjs
