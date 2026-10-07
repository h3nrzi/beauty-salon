<?php
// Run with wp eval-file; exercises WordPress REST rather than plugin internals.
function noir_check($condition, $message) {
 if (!$condition) { throw new RuntimeException($message); }
 echo "PASS: $message\n";
}
$admin = get_users(['role'=>'administrator', 'number'=>1])[0]->ID;
$editor = wp_insert_user(['user_login'=>'noir-test-'.wp_generate_password(8,false), 'user_pass'=>wp_generate_password(), 'role'=>'editor']);
$page = wp_insert_post(['post_type'=>'page','post_status'=>'publish','post_title'=>'Contact test']);
update_post_meta($page, '_wp_page_template', 'page-contact.php');
try {
 wp_set_current_user($editor);
 $request = new WP_REST_Request('POST', '/wp/v2/pages/'.$page);
 $request->set_param('meta', ['_noir_contact_intro'=>['eyebrow'=>'Studio', 'heading'=>'Contact the Studio', 'body'=>'Speak with our specialists.']]);
 $response = rest_do_request($request);
 noir_check($response->get_status()===200 && (get_post_meta($page,'_noir_contact_intro',true)['heading']??'')==='Contact the Studio', 'Editor saves bounded Contact content through REST');
 $request->set_param('meta', ['_noir_contact_intro'=>['eyebrow'=>'Studio', 'heading'=>str_repeat('x',181), 'body'=>'Invalid']]);
 noir_check(rest_do_request($request)->get_status()===400, 'Oversize heading rejected');
 noir_check((get_post_meta($page,'_noir_contact_intro',true)['heading']??'')==='Contact the Studio', 'Invalid save retains last valid content');

 foreach ([['eyebrow'=>'Studio','heading'=>'   ','body'=>''],['eyebrow'=>'Studio','heading'=>'Valid','body'=>'','unknown'=>'bad']] as $invalid) {
  $request->set_param('meta', ['_noir_contact_intro'=>$invalid]);
  noir_check(rest_do_request($request)->get_status()===400, 'Empty or unknown editorial fields rejected with actionable REST feedback');
 }
 $request->set_param('meta',['_noir_contact_process'=>[['title'=>['malformed'],'body'=>'Invalid']]]);
 noir_check(rest_do_request($request)->get_status()===400,'Malformed collection row rejected without fatal error');
 $request->set_param('meta',['_noir_contact_intro'=>['eyebrow'=>'Studio','heading'=>'Contact the Studio','body'=>'A literal backslash: \\ and a Unicode name: حسین']]);
 noir_check(rest_do_request($request)->get_status()===200,'Unicode and literal backslashes round-trip through native metadata');
 noir_check(get_post_meta($page,'_noir_contact_intro',true)['body']==='A literal backslash: \\ and a Unicode name: حسین','Only one unslashing pass');
 wp_save_post_revision($page);
 $revision = array_key_first(wp_get_post_revisions($page));
 noir_check(is_int($revision) && $revision>0,'Native revision created for Contact metadata');
 $request->set_param('meta',['_noir_contact_intro'=>['eyebrow'=>'Studio','heading'=>'A later heading','body'=>'Later revision']]);
 rest_do_request($request);
 wp_restore_post_revision($revision);
 noir_check(get_post_meta($page,'_noir_contact_intro',true)['heading']==='Contact the Studio','Native revision restores editorial metadata');
 // Exercise the native meta-box POST save, including nonce and recovery feedback.
 $_POST=['noir_contact_nonce'=>wp_create_nonce('noir_contact_save'),'noir_contact'=>['intro'=>['eyebrow'=>'Studio','heading'=>'Saved from meta box','body'=>'Native POST']]];
 wp_update_post(['ID'=>$page,'post_title'=>'Contact test edited']);
 noir_check(get_post_meta($page,'_noir_contact_intro',true)['heading']==='Saved from meta box','Editor saves native Contact meta box with nonce');
 $_POST['noir_contact']['intro']['heading']=str_repeat('x',181);
 wp_update_post(['ID'=>$page,'post_title'=>'Contact test invalid']);
 noir_check(get_post_meta($page,'_noir_contact_intro',true)['heading']==='Saved from meta box','Invalid meta-box POST retains previous content');
 ob_start();do_action('admin_notices');$notices=ob_get_clean();
 noir_check(str_contains($notices,'Previous section was kept'),'Invalid meta-box POST provides actionable admin notice');
 $_POST['noir_contact_nonce']='invalid';$_POST['noir_contact']['intro']['heading']='Forged';
 wp_update_post(['ID'=>$page]);
 noir_check(get_post_meta($page,'_noir_contact_intro',true)['heading']==='Saved from meta box','Invalid nonce cannot change Contact metadata');
 $_POST=[];
 wp_set_current_user(0);
 $request->set_param('meta',['_noir_contact_intro'=>['eyebrow'=>'Studio','heading'=>'Unauthorized','body'=>'No']]);
 noir_check(rest_do_request($request)->get_status()===401,'Anonymous visitor cannot edit Contact');
} finally {
 $_POST=[];
 wp_set_current_user($admin);
 wp_delete_post($page,true);
 require_once ABSPATH.'wp-admin/includes/user.php';
 wp_delete_user($editor);
}
