<?php
// The spec's native WordPress editorial/public boundary, with real Core revisions and HTTP.
function noir_service_check($condition,$message) {
 if (!$condition) { throw new RuntimeException($message); }
 echo "PASS: $message\n";
}
noir_service_check(post_type_exists('noir_service'),'Services are registered for native editing');
$admin=get_users(['role'=>'administrator','number'=>1])[0]->ID;
$users=[];$temporary=[];
$records=get_posts(['post_type'=>'noir_service','post_status'=>'publish','posts_per_page'=>-1,'orderby'=>'ID','order'=>'ASC']);
noir_service_check(count($records)===5,'Local baseline has exactly five Services');
$post=$records[0];$original=get_post_meta($post->ID,'_noir_service_facts',true);$identity=get_post_meta($post->ID,'_noir_service_id',true);$image=get_post_thumbnail_id($post);
$page=(int)get_option('noir_studio')['pages']['services'];
$faq=get_post_meta($page,'_noir_services_faq',true);
$comparison=get_post_meta($page,'_noir_services_comparison',true);
$settings=get_option('noir_studio');$contact=get_post($settings['pages']['contact']);
function noir_services_http($url) {
 $response=wp_remote_get($url,['timeout'=>15]);
 if (is_wp_error($response)) { throw new RuntimeException($response->get_error_message()); }
 return wp_remote_retrieve_body($response);
}
try {
 foreach (['editor','author','contributor','subscriber'] as $role) { $users[$role]=wp_insert_user(['user_login'=>'noir-services-'.wp_generate_password(10,false),'user_pass'=>wp_generate_password(),'role'=>$role]); }
 wp_set_current_user($users['editor']);
 noir_service_check(current_user_can('edit_post',$post->ID) && current_user_can('publish_noir_services'),'Editor can edit and publish Services');
 noir_service_check(!current_user_can('manage_options'),'Editor cannot change operational settings');
 foreach (['author','contributor','subscriber'] as $role) {
  wp_set_current_user($users[$role]);
  noir_service_check(!current_user_can('edit_post',$post->ID) && !current_user_can('edit_noir_services') && !current_user_can('publish_noir_services'),'No Service management privileges for '.$role);
 }
 wp_set_current_user(0);noir_service_check(!current_user_can('edit_post',$post->ID),'Anonymous cannot edit a Service');
 wp_set_current_user($users['editor']);
 $facts=$original;$facts['price']=35125;$facts['description']='حسین — literal backslash: \\';$facts['duration']='6 hours revised';$facts['protection']='Updated sealant fact';
 $_POST=['noir_service_nonce'=>wp_create_nonce('noir_service_save'),'noir_service'=>wp_slash(['identity'=>$identity,'facts'=>$facts])];
 wp_update_post(['ID'=>$post->ID,'post_title'=>'Exterior renamed','post_name'=>'renamed-service']);
 noir_service_check(get_post_meta($post->ID,'_noir_service_facts',true)['description']===$facts['description'],'Editor native save keeps Unicode and one unslashing pass');
 $revision=array_key_first(wp_get_post_revisions($post->ID));
 $html=noir_services_http(get_permalink($page));
 noir_service_check(str_contains($html,'$351.25') && substr_count($html,'Exterior renamed')>=3,'Canonical price and title propagate to Services index, card and native footer');
 noir_service_check(str_contains($html,'6 hours revised') && str_contains($html,'Updated sealant fact'),'Canonical duration and optional protection appear in Services');
 noir_service_check(str_contains($html,'id="service-exterior-detail"') && str_contains($html,'service=exterior-detail#appointment-request'),'Title and slug rename preserve section and request identities');
 foreach (['order'=>1000,'short_description'=>str_repeat('x',301),'description'=>'','eyebrow'=>str_repeat('x',81),'badge'=>str_repeat('x',81),'inclusions'=>[],'price'=>100000001,'duration'=>str_repeat('x',81),'protection'=>str_repeat('x',121)] as $key=>$invalid) {
  $bad=$facts;$bad[$key]=$invalid;$_POST['noir_service']['facts']=wp_slash($bad);
  wp_update_post(['ID'=>$post->ID,'post_title'=>'Invalid replacement']);
  noir_service_check(get_post_meta($post->ID,'_noir_service_facts',true)===$facts && get_post($post->ID)->post_title==='Exterior renamed','Invalid '.$key.' retains all previous Service facts and title');
 }
 foreach (['<script>alert(1)</script>',str_repeat('ح',2001),['array'],'   '] as $bad) {
  $invalid=$facts;$invalid['description']=$bad;$_POST['noir_service']['facts']=wp_slash($invalid);wp_update_post(['ID'=>$post->ID]);
  noir_service_check(get_post_meta($post->ID,'_noir_service_facts',true)===$facts,'Malformed, markup, blank and Unicode bound+1 saves rejected');
 }
 foreach ([array_merge($facts,['extra'=>'unknown']),array_merge($facts,['price'=>'35125']),array_merge($facts,['inclusions'=>array_fill(0,13,'Extra item')]),array_merge($facts,['inclusions'=>[str_repeat('x',181)]]),array_merge($facts,['duration'=>''])] as $bad) {
  noir_service_check(!update_post_meta($post->ID,'_noir_service_facts',wp_slash($bad)),'Unknown properties, numeric strings, oversize inclusions and empty optional facts rejected');
 }
 $_POST['noir_service']['facts']=wp_slash($facts);wp_update_post(['ID'=>$post->ID,'post_title'=>str_repeat('x',101)]);
 noir_service_check(get_post($post->ID)->post_title==='Exterior renamed','Native title bound+1 retains valid title');
 $_POST['noir_service']['facts']=wp_slash($facts);$_POST['noir_service']['identity']='interior-detail';wp_update_post(['ID'=>$post->ID]);
 noir_service_check(get_post_meta($post->ID,'_noir_service_id',true)==='exterior-detail','Immutable identity cannot change');
 $_POST['noir_service']['identity']='exterior-detail';$_POST['noir_service_nonce']='forged';$_POST['noir_service']['facts']['price']=999;wp_update_post(['ID'=>$post->ID]);
 noir_service_check(get_post_meta($post->ID,'_noir_service_facts',true)===$facts,'Forged nonce cannot save Service facts');
 $_POST=[];
 noir_service_check(!delete_post_meta($post->ID,'_noir_service_id'),'Stable identity cannot be deleted');
 $duplicate=wp_insert_post(['post_type'=>'noir_service','post_status'=>'draft','post_title'=>'Duplicate test']);$temporary[]=$duplicate;
 noir_service_check(!add_post_meta($duplicate,'_noir_service_id','exterior-detail'),'Duplicate identity rejected, including drafts');
 noir_service_check(!add_post_meta($duplicate,'_noir_service_id','custom-consultation'),'Sixth identity rejected');
 noir_service_check(!update_post_meta($post->ID,'_noir_service_facts',['bad'=>'shape']),'Invalid writes also rejected at native metadata boundary');
 update_post_meta($post->ID,'_noir_service_facts',wp_slash($original));
 wp_restore_post_revision($revision);
 noir_service_check(get_post_meta($post->ID,'_noir_service_facts',true)===$facts && get_post($post->ID)->post_title==='Exterior renamed','Native Service revision restores facts and native title');
 // Featured-image revision uses actual image attachments.
 wp_save_post_revision($post->ID);$image_revision=array_key_first(wp_get_post_revisions($post->ID));set_post_thumbnail($post->ID,get_post_thumbnail_id($records[1]));wp_save_post_revision($post->ID);wp_restore_post_revision($image_revision);
 noir_service_check((int)get_post_thumbnail_id($post->ID)===(int)$image,'Native revision restores primary Service attachment');
 wp_update_post(['ID'=>$post->ID,'post_status'=>'draft']);
 $html=noir_services_http(get_permalink($page));$form=noir_services_http(get_permalink($contact).'?service=exterior-detail');
 noir_service_check(!str_contains($html,'id="service-exterior-detail"') && !str_contains($html,'>Exterior renamed<') && !str_contains($form,'value="exterior-detail"'),'Draft absent from cards, index, footer and Contact choices');
 wp_update_post(['ID'=>$post->ID,'post_status'=>'publish']);delete_post_thumbnail($post->ID);
 noir_service_check(!str_contains(noir_services_http(get_permalink($page)),'id="service-exterior-detail"'),'Invalid Service missing required media excluded');
 set_post_thumbnail($post->ID,$image);
 wp_trash_post($post->ID);noir_service_check(!str_contains(noir_services_http(get_permalink($page)),'id="service-exterior-detail"'),'Trashed Service excluded');wp_untrash_post($post->ID);wp_update_post(['ID'=>$post->ID,'post_status'=>'publish']);
 // Services page native sections, exact bounds and revision restoration.
 $request=new WP_REST_Request('POST','/wp/v2/pages/'.$page);$changed=$faq;$changed['heading']='FAQ restored from native revision';
 $request->set_param('meta',['_noir_services_faq'=>$changed]);noir_service_check(rest_do_request($request)->get_status()===200,'Editor saves Services sections through native page REST boundary');
 wp_save_post_revision($page);$page_revision=array_key_first(wp_get_post_revisions($page));
 $bad=$changed;$bad['items'][0]['answer']=str_repeat('x',2001);$request->set_param('meta',['_noir_services_faq'=>$bad]);noir_service_check(rest_do_request($request)->get_status()===400,'FAQ answer bound+1 rejects full section');
 $request->set_param('meta',['_noir_services_faq'=>$faq]);rest_do_request($request);wp_restore_post_revision($page_revision);
 noir_service_check(get_post_meta($page,'_noir_services_faq',true)['heading']==='FAQ restored from native revision','Native revision restores FAQ collection and copy');
 $_POST=['noir_services_page_nonce'=>wp_create_nonce('noir_services_page_save'),'noir_services'=>['final'=>['eyebrow'=>'Requests','heading'=>'Native meta box save','body'=>'Speak to the Studio.']]];
 $final=get_post_meta($page,'_noir_services_final',true);wp_update_post(['ID'=>$page]);noir_service_check(get_post_meta($page,'_noir_services_final',true)['heading']==='Native meta box save','Editor native Services meta box saves fixed sections');
 update_post_meta($page,'_noir_services_final',wp_slash($final));$_POST=[];
 $one=$comparison;$one['after_image']=0;update_post_meta($page,'_noir_services_comparison',wp_slash($one));$html=noir_services_http(get_permalink($page));
 noir_service_check(str_contains($html,'comparison-before') && !str_contains($html,'comparison-control'),'Incomplete comparison pair keeps labelled single image with no empty control');
 update_post_meta($page,'_noir_services_comparison',wp_slash($comparison));
 $changed_comparison=$comparison;$changed_comparison['before_image']=get_post_thumbnail_id($records[1]);wp_save_post_revision($page);$pair_revision=array_key_first(wp_get_post_revisions($page));update_post_meta($page,'_noir_services_comparison',wp_slash($changed_comparison));wp_save_post_revision($page);wp_restore_post_revision($pair_revision);
 noir_service_check(get_post_meta($page,'_noir_services_comparison',true)===$comparison,'Native page revision restores comparison attachment references');
 wp_update_post(['ID'=>$contact->ID,'post_title'=>'Contact renamed','post_name'=>'contact-renamed']);
 $html=noir_services_http(get_permalink($page));noir_service_check(str_contains($html,'/contact-renamed/?service=exterior-detail#appointment-request'),'Assigned Contact rename updates request permalink');
 foreach (['/?noir_service=renamed-service','/?post_type=noir_service','/?post_type=noir_service&feed=rss2','/?post_type=noir_service&p='.$post->ID,'/noir_service/renamed-service/','/wp-json/wp/v2/noir_service','/?s=Exterior+renamed'] as $route) {
  $html=noir_services_http(home_url($route));noir_service_check(!str_contains($html,$facts['description']) && !str_contains($html,'id="service-exterior-detail"'),'No independent public Service content at '.$route);
 }
 echo "Ticket 02 WordPress checks complete.\n";
} finally {
 $_POST=[];wp_set_current_user($admin);
 wp_update_post(['ID'=>$post->ID,'post_status'=>$post->post_status,'post_title'=>$post->post_title,'post_name'=>$post->post_name]);update_post_meta($post->ID,'_noir_service_facts',wp_slash($original));set_post_thumbnail($post->ID,$image);
 update_post_meta($page,'_noir_services_faq',wp_slash($faq));update_post_meta($page,'_noir_services_comparison',wp_slash($comparison));
 if (isset($final)) { update_post_meta($page,'_noir_services_final',wp_slash($final)); }
 wp_update_post(['ID'=>$contact->ID,'post_title'=>$contact->post_title,'post_name'=>$contact->post_name]);
 foreach ($temporary as $id) { wp_delete_post($id,true); }
 require_once ABSPATH.'wp-admin/includes/user.php';foreach ($users as $id) { wp_delete_user($id); }
}
