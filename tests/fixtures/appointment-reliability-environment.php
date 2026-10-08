<?php
/** Harness installs only on disposable Local; controls contain no customer data. */
if (!defined('ABSPATH') || wp_get_environment_type()!=='local') { return; }
$directory='/tmp/noir-ticket06';
$mode=trim((string)@file_get_contents($directory.'/mode'));
if ($mode==='trusted') { define('NOIR_TRUSTED_PROXIES',['127.0.0.1','::1']); }
if ($mode!=='off') {
 define('NOIR_MAIL_READY',true);
 define('NOIR_MAIL_RECIPIENT','studio@example.test');
 define('NOIR_MAIL_FROM','requests@example.test');
}
// Prove requests actually run on independent PHP workers, rather than a sequential client.
add_action('admin_init',function() use ($directory) {
 if (($_POST['action']??'')==='noir_appointment_request') { file_put_contents($directory.'/workers',getmypid()."\n",FILE_APPEND|LOCK_EX); }
});
// A dead pinned connection must fail closed, even if WordPress later reconnects.
if ($mode==='storage-failure') {
 add_action('admin_init',function() { global $wpdb; $wpdb->query('KILL CONNECTION '.(int)$wpdb->get_var('SELECT CONNECTION_ID()')); },PHP_INT_MAX);
 add_action('template_redirect',function() { global $wpdb; $wpdb->query('KILL CONNECTION '.(int)$wpdb->get_var('SELECT CONNECTION_ID()')); },0);
}
add_filter('pre_wp_mail',function($return) use ($directory,$mode) {
 file_put_contents($directory.'/attempts',getmypid()."\n",FILE_APPEND|LOCK_EX);
 if ($mode==='slow' || $mode==='slow-cleanup') { sleep(3); }
 if ($mode==='crash') { wp_die('The sending outcome is pending or uncertain. Contact the Studio directly. Do not resubmit.', 'Appointment Request',['response'=>503]); }
 if ($mode==='record-failure') { global $wpdb; $wpdb->query('KILL CONNECTION '.(int)$wpdb->get_var('SELECT CONNECTION_ID()')); }
 if ($mode==='exception') { throw new RuntimeException('Ambiguous transport failure'); }
 return $mode==='uncertain' ? false : true;
});
