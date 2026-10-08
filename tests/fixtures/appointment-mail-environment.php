<?php
// Temporary Local-only fixture, removed by the harness; no submission store.
if (!defined('ABSPATH') || wp_get_environment_type()!=='local') { return; }
$mode=is_readable('/tmp/noir-ticket05/mail-mode') ? trim((string)file_get_contents('/tmp/noir-ticket05/mail-mode')) : 'off';
if (!in_array($mode,['accepted','uncertain'],true)) { return; }
define('NOIR_MAIL_READY',true);
define('NOIR_MAIL_RECIPIENT','studio@example.test');
define('NOIR_MAIL_FROM','requests@noir.example.test');
if ($mode==='uncertain') { add_filter('pre_wp_mail',function() { return false; }); }
// Bypass Local's sendmail wrapper, which adds a mailhog recovery recipient.
add_action('phpmailer_init',function($mail) {
 $mail->isSMTP(); $mail->Host='127.0.0.1'; $mail->Port=10006; $mail->SMTPAuth=false; $mail->SMTPAutoTLS=false;
});
