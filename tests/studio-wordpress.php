<?php
function studio_check($condition,$message) {
 if (!$condition) { throw new RuntimeException($message); }
 echo "PASS: $message\n";
}
$admin = get_users(['role'=>'administrator','number'=>1])[0]->ID;
$editor = wp_insert_user(['user_login'=>'noir-settings-'.wp_generate_password(8,false),'user_pass'=>wp_generate_password(),'role'=>'editor']);
$old = get_option('noir_studio',false);
$pages = [];
try {
 wp_set_current_user($admin);
 foreach (['home','services','gallery','contact'] as $role) {
  $pages[$role] = wp_insert_post(['post_type'=>'page','post_status'=>'publish','post_title'=>'Test '.$role]);
 }
 update_post_meta($pages['contact'],'_wp_page_template','page-contact.php');
 $fixture = require getcwd().'/fixtures/noir/contact/baseline.php';
 $settings = $fixture['studio']; $settings['pages']=$pages;
 $settings['privacy']=(string)$pages['home'];$settings['terms']='https://example.org/terms';$settings['directions']='https://example.org/directions';
 // Explicitly test first-time creation: native update_option calls add_option on this path.
 delete_option('noir_studio');wp_set_current_user($editor);
 update_option('noir_studio',$settings);
 studio_check(!get_option('noir_studio'), 'Editor cannot create shared settings on first save');
 wp_set_current_user($admin);
 update_option('noir_studio',$settings);
 studio_check(get_option('noir_studio')['timezone']==='America/Los_Angeles','Administrator saves shared baseline');
 wp_set_current_user($editor);
 $change=$settings;$change['phone_label']='Unauthorized';update_option('noir_studio',$change);
 studio_check(get_option('noir_studio')['phone_label']==='+1 (800) 492-NOIR','Editor cannot change shared settings');
 wp_set_current_user($admin);
 foreach ([['email','bad email'],['timezone','Mars/City'],['phone_dial','123'],['directions','javascript:alert(1)'],['description',str_repeat('x',501)],['privacy','https://user:secret@example.org/privacy']] as [$key,$value]) {
  $change=$settings;$change[$key]=$value;update_option('noir_studio',$change);
  studio_check(get_option('noir_studio')==$settings,'Invalid '.$key.' retains all valid settings');
 }
 $change=$settings;$change['hours']['monday']=['closed'=>false,'open'=>'18:00','close'=>'08:00'];update_option('noir_studio',$change);
 studio_check(get_option('noir_studio')==$settings,'Hours cannot close before opening');
 $change=$settings;$change['hours']['sunday']=['closed'=>true,'unexpected'=>'x'];update_option('noir_studio',$change);
 studio_check(get_option('noir_studio')==$settings,'Unknown nested hours properties rejected');
 $change=$settings;$change['pages']['home']=3;update_option('noir_studio',$change);
 studio_check(get_option('noir_studio')==$settings,'Unpublished native page rejected');
 // Render over HTTP to prove shared settings reach independently served public requests.
 $contact_url = get_permalink($old['pages']['contact']??0);
 $change=$settings;$change['phone_label']='Studio test number';$change['phone_dial']='+13105550123';$change['description']='Shared Studio propagation check';
 update_option('noir_studio',$change);
 $html=wp_remote_retrieve_body(wp_remote_get($contact_url,['timeout'=>10]));
 studio_check(substr_count($html,'Studio test number')>=3 && substr_count($html,'Shared Studio propagation check')===2,'Shared phone and description propagate to header, Contact and footer');
 studio_check(str_contains($html,'https://example.org/terms') && str_contains($html,'https://example.org/directions') && str_contains($html,get_permalink($pages['home'])),'Explicit HTTPS and native legal/directions destinations render');

 foreach ($fixture['sections'] as $section=>$value) { update_post_meta($pages['contact'],'_noir_contact_'.$section,wp_slash($value)); }
 wp_update_post(['ID'=>$pages['contact'],'post_title'=>'Renamed native Contact','post_name'=>'renamed-contact-'.wp_generate_password(8,false)]);
 $html=wp_remote_retrieve_body(wp_remote_get(get_permalink($pages['contact']),['timeout'=>10]));
 studio_check(str_contains($html,'Contact &amp; Appointment Request') && str_contains($html,'Studio test number'),'Renamed native Contact preserves template and shared page identity');
} finally {
 wp_set_current_user($admin);delete_option('noir_studio');
 if ($old!==false) { update_option('noir_studio',$old); }
 foreach ($pages as $id) { wp_delete_post($id,true); }
 require_once ABSPATH.'wp-admin/includes/user.php';wp_delete_user($editor);
}
