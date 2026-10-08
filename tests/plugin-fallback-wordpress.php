<?php
function fallback_check($condition,$message) {
 if (!$condition) { throw new RuntimeException($message); }
 echo "PASS: $message\n";
}
$admin=get_users(['role'=>'administrator','number'=>1])[0]->ID;
wp_set_current_user($admin);
$active=get_option('active_plugins');
$studio=get_option('noir_studio');
$url=get_permalink($studio['pages']['contact']);
require_once ABSPATH.'wp-admin/includes/plugin.php';
try {
 deactivate_plugins('noir-studio/noir-studio.php',true);
 $response=wp_remote_get($url,['timeout'=>10]);$html=wp_remote_retrieve_body($response);
 fallback_check(wp_remote_retrieve_response_code($response)===200,'Plugin absence does not fatal on Contact');
 fallback_check(str_contains($html,'tel:'.$studio['phone_dial']) && str_contains($html,'mailto:'.$studio['email']),'Saved public phone/email remain usable without plugin');
 fallback_check(str_contains($html,'#appointment-request'),'Native Contact anchor remains available without plugin');
 fallback_check(!str_contains($html,'type="submit"'),'Plugin absence cannot enable request submission');
 $response=wp_remote_get(get_permalink($studio['pages']['home']),['timeout'=>10]);$html=wp_remote_retrieve_body($response);
 fallback_check(wp_remote_retrieve_response_code($response)===200 && str_contains($html,'Home information is currently unavailable') && str_contains($html,'tel:'.$studio['phone_dial']),'Plugin absence leaves an explicit Home fallback and configured public contact');
} finally {update_option('active_plugins',$active);}
