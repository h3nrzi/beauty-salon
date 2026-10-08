#!/usr/bin/env bash
# Isolated native WordPress tables; never run against production.
set -euo pipefail
cd "$(dirname "$0")/.."
wp_bin="${NOIR_WP_BIN:-wp}"
source_path="$PWD/wordpress/app/public"
if [[ "$($wp_bin --path="$source_path" eval 'echo wp_get_environment_type();')" != local ]]; then
 echo 'Requires a disposable Local runtime.' >&2; exit 1
fi
sandbox=$(mktemp -d)
export NOIR_BOOTSTRAP_SOURCE="$source_path" NOIR_BOOTSTRAP_SANDBOX="$sandbox"
python3 - <<'PY'
import os,pathlib,re,uuid
src=pathlib.Path(os.environ['NOIR_BOOTSTRAP_SOURCE']); dst=pathlib.Path(os.environ['NOIR_BOOTSTRAP_SANDBOX'])
for f in src.iterdir():
 if f.name not in ('wp-config.php','wp-content'): (dst/f.name).symlink_to(f)
(dst/'wp-content').mkdir()
for name in ['plugins','themes']:
 (dst/'wp-content'/name).symlink_to(src/'wp-content'/name)
config=(src/'wp-config.php').read_text()
config,n=re.subn(r"\$table_prefix\s*=\s*'[^']*';", "$table_prefix = 'noir_bootstrap_test_"+uuid.uuid4().hex[:8]+"_';", config)
assert n==1
(dst/'wp-config.php').write_text(config)
(dst/'wp-config.php').chmod(0o600)
PY
wp_test() { "$wp_bin" --path="$sandbox" "$@"; }
cleanup() {
 # Only the explicitly isolated test prefix, never wp db clean/reset.
 wp_test eval 'global $wpdb; foreach ($wpdb->get_col("SHOW TABLES") as $table) { if (str_starts_with($wpdb->prefix,"noir_bootstrap_test_") && str_starts_with($table,$wpdb->prefix)) { $wpdb->query("DROP TABLE `".$table."`"); } }' >/dev/null
 rm -rf "$sandbox"
}
trap cleanup EXIT
if wp_test core is-installed >/dev/null 2>&1; then echo 'Test prefix already exists; refusing reuse.' >&2; trap - EXIT; rm -rf "$sandbox"; exit 1; fi
wp_test core install --url=http://noir-bootstrap.invalid --title='NOIR acceptance test' --admin_user=bootstrap-admin --admin_password=synthetic-test-only --admin_email=test@example.invalid --skip-email >/dev/null
wp_test plugin activate noir-studio >/dev/null
wp_test theme activate noir-auto-detailing >/dev/null
args=(noir bootstrap --user=bootstrap-admin --fixtures="$PWD/fixtures/noir" --prototype)
before=$(wp_test post list --post_type=any --format=count)
wp_test "${args[@]}" --dry-run > "$sandbox/dry.json"
[[ "$(wp_test post list --post_type=any --format=count)" == "$before" ]]
echo 'PASS: dry-run makes no editorial changes'
wp_test "${args[@]}" > "$sandbox/import.json"
wp_test eval '
$s=noir_studio_settings();
if (count($s["pages"])!==4 || count(noir_services())!==5 || count(noir_projects())!==8) { throw new RuntimeException("Incorrect baseline counts"); }
if (get_option("page_on_front")!=$s["pages"]["home"] || get_page_template_slug($s["pages"]["contact"])!=="page-contact.php") { throw new RuntimeException("Missing assignments"); }
$state=get_option("noir_bootstrap");
if (count($state["assets"])!==22 || count($state["records"])!==17 || count(get_nav_menu_locations())!==3) { throw new RuntimeException("Incomplete asset/menu/native mapping"); }
$home=get_post_meta($s["pages"]["home"],"_noir_home_placements",true); $gallery=get_post_meta($s["pages"]["gallery"],"_noir_gallery_placements",true);
if (array_column($home,"project_id")!==["porsche-911-gt3-992","aston-martin-db12","range-rover-sv"] || count($gallery)!==6) { throw new RuntimeException("Incorrect Project placements"); }
echo "PASS: fresh setup creates four native pages, five Services, eight Projects and assignments\n";
'
wp_test eval '
$s=noir_studio_settings(); $home=$s["pages"]["home"];
wp_set_current_user(get_users(["role"=>"administrator","number"=>1])[0]->ID);
wp_update_post(["ID"=>$home,"post_title"=>"Human Home","post_name"=>"human-home"]);
$v=get_post_meta($home,"_noir_home_hero",true); $v["heading"]="Human heading"; update_post_meta($home,"_noir_home_hero",wp_slash($v));
$unrelated=wp_insert_post(["post_type"=>"page","post_status"=>"publish","post_title"=>"Unrelated"]); update_option("noir_test_unrelated",$unrelated);
update_option("noir_test_secret","synthetic-environment-value");
update_option("page_on_front",$unrelated);
'
counts=$(wp_test eval 'echo wp_json_encode(wp_count_posts("attachment"))."/".wp_count_posts("nav_menu_item")->publish;')
wp_test "${args[@]}" > "$sandbox/reimport.json"
[[ "$(wp_test eval 'echo wp_json_encode(wp_count_posts("attachment"))."/".wp_count_posts("nav_menu_item")->publish;')" == "$counts" ]]
wp_test eval '
$home=noir_studio_settings()["pages"]["home"];
if (get_the_title($home)!=="Human Home" || get_post_meta($home,"_noir_home_hero",true)["heading"]!=="Human heading" || get_option("page_on_front")!=get_option("noir_test_unrelated")) { throw new RuntimeException("Re-import overwrote human edits/assignment"); }
echo "PASS: repeat import preserves edits and conflicting assignments without duplicate media/menus\n";
'
python3 - "$sandbox/reimport.json" <<'PY'
import json,sys
r=json.load(open(sys.argv[1])); assert 'page:home:post_title' in r['drift']; assert 'static front page' in r['conflicts']
print('PASS: dry/import report identifies editorial drift and assignment conflicts')
PY
wp_test "${args[@]}" --reset --dry-run > "$sandbox/reset-plan.json"
wp_test "${args[@]}" --reset > "$sandbox/reset.json"
wp_test eval '
$s=noir_studio_settings(); $home=$s["pages"]["home"];
if (get_the_title($home)!=="Home" || get_post_meta($home,"_noir_home_hero",true)["heading"]!=="The Art of" || get_option("page_on_front")!=$home || !get_post(get_option("noir_test_unrelated")) || get_option("noir_test_secret")!=="synthetic-environment-value") { throw new RuntimeException("Reset exceeded scope or failed"); }
echo "PASS: explicit reset restores baseline, preserving unrelated content and environment options\n";
'
# A missing baseline field is repaired, while an intentionally empty collection stays empty.
wp_test eval '
wp_set_current_user(get_users(["role"=>"administrator","number"=>1])[0]->ID);
$home=noir_studio_settings()["pages"]["home"]; delete_post_meta($home,"_noir_home_final"); update_post_meta($home,"_noir_home_benefits",[]);
'
wp_test "${args[@]}" > "$sandbox/missing-field.json"
wp_test eval '
$home=noir_studio_settings()["pages"]["home"];
if (!get_post_meta($home,"_noir_home_final",true) || get_post_meta($home,"_noir_home_benefits",true)!==[]) { throw new RuntimeException("Missing fields vs editorial emptiness"); }
echo "PASS: missing baseline metadata is filled; intentional editorial emptiness is preserved\n";
'
# Validate failures before any writes, including a late-file failure.
cp -R fixtures/noir "$sandbox/bad-fixtures"
printf 'tampered' >> "$sandbox/bad-fixtures/home/media/range-rover-sv.jpg"
if wp_test noir bootstrap --user=bootstrap-admin --fixtures="$sandbox/bad-fixtures" --prototype > "$sandbox/invalid.log" 2>&1; then echo 'Invalid checksum was accepted' >&2; exit 1; fi
[[ "$(wp_test eval 'echo wp_json_encode(wp_count_posts("attachment"))."/".wp_count_posts("nav_menu_item")->publish;')" == "$counts" ]]
echo 'PASS: late asset checksum failure aborts before mutation'
python3 - "$sandbox/bad-fixtures" <<'PY'
import json,pathlib,sys,shutil
p=pathlib.Path(sys.argv[1]); shutil.copyfile('fixtures/noir/home/media/range-rover-sv.jpg',p/'home/media/range-rover-sv.jpg')
f=p/'home/baseline.json'; r=json.loads(f.read_text()); r['projects'].append(r['projects'][0]); f.write_text(json.dumps(r))
PY
if wp_test noir bootstrap --user=bootstrap-admin --fixtures="$sandbox/bad-fixtures" --prototype > "$sandbox/duplicates.log" 2>&1; then echo 'Duplicate identity accepted' >&2; exit 1; fi
echo 'PASS: duplicate fixture identities abort before mutation'
if wp_test noir bootstrap --user=bootstrap-admin --fixtures="$PWD/fixtures/noir" --dry-run > "$sandbox/rights.log" 2>&1; then echo 'Uncleared production media accepted' >&2; exit 1; fi
echo 'PASS: temporary media cannot pass production import'
wp_test user create bootstrap-editor test-editor@example.invalid --role=editor --user_pass=synthetic-test-only >/dev/null
if wp_test noir bootstrap --user=bootstrap-editor --fixtures="$PWD/fixtures/noir" --prototype --dry-run > "$sandbox/editor.log" 2>&1; then echo 'Editor performed operational bootstrap' >&2; exit 1; fi
echo 'PASS: bootstrap requires Administrator authority'
wp_test eval '
$state=get_option("noir_bootstrap"); $item=$state["menus"]["primary"]["items"]["home"];
wp_update_post(["ID"=>$item,"post_title"=>"Human navigation label"]);
'
wp_test "${args[@]}" > "$sandbox/menu-drift.json"
python3 - "$sandbox/menu-drift.json" <<'PY'
import json,sys
r=json.load(open(sys.argv[1])); assert 'menu:primary:home' in r['drift']
print('PASS: native menu editorial drift is reported and preserved')
PY
wp_test option get noir_studio --format=json > "$sandbox/studio-backup.json"
wp_test --user=bootstrap-admin eval '
$s=noir_studio_settings();$s["phone_label"]="Synthetic recovery phone";update_option("noir_studio",$s);
'
wp_test --user=bootstrap-admin option update noir_studio "$(cat "$sandbox/studio-backup.json")" --format=json >/dev/null
wp_test eval 'if (noir_studio_settings()["phone_label"]!=="+1 (800) 492-NOIR") { throw new RuntimeException("Shared settings restore failed"); } echo "PASS: shared settings backup/restore uses validated native option operations\n";'
