<?php
// Run only against Local. Installs a temporary mail adapter; restores environment in finally.
if (wp_get_environment_type()!=='local') { throw new RuntimeException('This test requires Local and its Mailpit capture.'); }
$fixture=WP_CONTENT_DIR.'/mu-plugins/noir-appointment-test.php';
$original=file_exists($fixture)?file_get_contents($fixture):null;
$mode_file='/tmp/noir-ticket05/mail-mode';
if (!is_dir(dirname($mode_file))) { mkdir(dirname($mode_file),0700,true); }
$original_mode=file_exists($mode_file)?file_get_contents($mode_file):null;
if (!is_dir(dirname($fixture))) { mkdir(dirname($fixture),0700,true); }
try {
 file_put_contents($mode_file,'off');
 require __DIR__.'/appointment-wordpress.php';
 copy(__DIR__.'/fixtures/appointment-mail-environment.php',$fixture);
 file_put_contents($mode_file,'uncertain');
 [$form,$cookies]=appointment_form($url);
 $response=appointment_post($form+$valid,$cookies);
 appointment_check(wp_remote_retrieve_response_code($response)===503 && str_contains(wp_remote_retrieve_body($response),'outcome is uncertain') && !str_contains(wp_remote_retrieve_body($response),'Nothing was sent'),'Generic transport rejection is uncertain, with no success or safe-retry promise');
 $response=appointment_post($form+$valid,$cookies);
 appointment_check(wp_remote_retrieve_response_code($response)===503 && str_contains(wp_remote_retrieve_body($response),'pending or uncertain'),'Uncertain attempt does not retry transport on sequential replay');
 file_put_contents($mode_file,'fallback');
 [$fallback_form,$fallback_cookies]=appointment_form($url);
 $fallback_values=$valid; $fallback_values['phone']='123';
 $fallback=appointment_post($fallback_form+$fallback_values,$fallback_cookies);
 $fallback_html=wp_remote_retrieve_body($fallback);
 appointment_check(wp_remote_retrieve_response_code($fallback)===422 && str_contains($fallback_html,'value="حسین"') && str_contains($fallback_html,'href="#request-phone"') && !str_contains($fallback_html,'contact-main'),'Plugin fallback preserves an accessible correction form without a theme renderer');
 file_put_contents($mode_file,'accepted');
 [$form,$cookies]=appointment_form($url);
 $response=appointment_post($form+$valid,$cookies);
 appointment_check(wp_remote_retrieve_response_code($response)===303,'Positive transport acceptance produces 303 PRG');
 $receipt_cookies=array_values(array_filter(wp_remote_retrieve_cookies($response),fn($cookie)=>$cookie->name==='noir_receipt')); 
 $accepted_cookies=array_merge($cookies,$receipt_cookies);
 $status=wp_remote_get(wp_remote_retrieve_header($response,'location'),['cookies'=>$accepted_cookies]);
 appointment_check(str_contains(wp_remote_retrieve_body($status),'Your appointment request has been accepted for sending.') && str_contains(wp_remote_retrieve_body($status),'Your appointment is not confirmed.'),'Bound recorded receipt displays honest accepted-for-sending wording');
 $foreign=wp_remote_get(wp_remote_retrieve_header($response,'location'),['cookies'=>$receipt_cookies]);
 appointment_check(!str_contains(wp_remote_retrieve_body($foreign),'Your appointment request has been accepted for sending.'),'Receipt cannot be borrowed without the visitor binding');
 foreach ($receipt_cookies as $cookie) { $cookie->value.='x'; }
 $forged=wp_remote_get(wp_remote_retrieve_header($response,'location'),['cookies'=>array_merge($cookies,$receipt_cookies)]);
 appointment_check(!str_contains(wp_remote_retrieve_body($forged),'Your appointment request has been accepted for sending.'),'Altered receipt cannot claim success');
 $replay=appointment_post($form+$valid,$cookies);
 appointment_check(wp_remote_retrieve_response_code($replay)===303,'Accepted sequential replay returns authenticated PRG');
} finally {
 if ($original===null) { unlink($fixture); } else {file_put_contents($fixture,$original);}
 if ($original_mode===null) {unlink($mode_file);} else {file_put_contents($mode_file,$original_mode);}
}
