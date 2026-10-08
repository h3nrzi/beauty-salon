<?php
// Native WordPress editorial/public seam. Temporary probes are removed in finally.
function noir_gallery_check($condition,$message) {
 if (!$condition) { throw new RuntimeException($message); }
 echo "PASS: $message\n";
}
function noir_gallery_http($url) {
 $response=wp_remote_get($url,['timeout'=>15]);
 if (is_wp_error($response)) { throw new RuntimeException($response->get_error_message()); }
 return wp_remote_retrieve_body($response);
}
noir_gallery_check(post_type_exists('noir_project'),'Projects are registered for native editing');
$admin=get_users(['role'=>'administrator','number'=>1])[0]->ID;
$page=(int)get_option('noir_studio')['pages']['gallery'];
$original=get_post_meta($page,'_noir_gallery_placements',true);
$had_placements=metadata_exists('post',$page,'_noir_gallery_placements');
$users=[]; $temporary=[];
$attachments=get_posts(['post_type'=>'attachment','post_status'=>'inherit','posts_per_page'=>2,'post_mime_type'=>'image']);
noir_gallery_check(count($attachments)===2,'Local Media Library has image prerequisites for disposable probes');
$image=(int)$attachments[0]->ID; $other=(int)$attachments[1]->ID;
$pair=['before_image'=>$image,'after_image'=>$other,'before_label'=>'Before','after_label'=>'After'];
$facts=['vehicle'=>'Probe vehicle','finish'=>'Original finish','work'=>'Completed work — public probe','facts'=>[['label'=>'Duration','value'=>'2 Days']],'comparison'=>$pair,'memberships'=>['paint-correction','exotic']];
try {
 foreach (['editor','author','contributor','subscriber'] as $role) { $users[$role]=wp_insert_user(['user_login'=>'noir-gallery-'.wp_generate_password(10,false),'user_pass'=>wp_generate_password(),'role'=>$role]); }
 wp_set_current_user($admin);
 $id=wp_insert_post(['post_type'=>'noir_project','post_status'=>'auto-draft','post_title'=>'Probe']);$temporary[]=$id;
 set_post_thumbnail($id,$image);
 foreach (['administrator'=>$admin]+$users as $role=>$user) {
  wp_set_current_user($user);
  $allowed=in_array($role,['administrator','editor'],true);
  noir_gallery_check(current_user_can('edit_post',$id)===$allowed && current_user_can('publish_noir_projects')===$allowed,'Project management permissions: '.$role);
 }
 wp_set_current_user(0);noir_gallery_check(!current_user_can('edit_post',$id),'Anonymous cannot manage Projects');
 wp_set_current_user($users['editor']);
 $_POST=['noir_project_nonce'=>wp_create_nonce('noir_project_save'),'noir_project'=>wp_slash($facts)];
 wp_update_post(['ID'=>$id,'post_title'=>'Completed probe','post_status'=>'publish']);
 $identity=get_post_meta($id,'_noir_project_id',true);
 noir_gallery_check(str_starts_with($identity,'project-'),'Native Editor save generates a stable Project identity');
 noir_gallery_check(get_post_meta($id,'_noir_project_facts',true)===$facts,'Native Editor save persists canonical facts');
 $_POST=[];
 $placements=[['project_id'=>$identity,'teaser'=>'Contextual teaser','eyebrow'=>'Completed work','image'=>0,'comparison'=>['before_image'=>0,'after_image'=>0,'before_label'=>'Before','after_label'=>'After']]];
 $request=new WP_REST_Request('POST','/wp/v2/pages/'.$page);$request->set_param('meta',['_noir_gallery_placements'=>$placements]);
 noir_gallery_check(rest_do_request($request)->get_status()===200,'Editor saves ordered placements through native page REST');
 $html=noir_gallery_http(get_permalink($page));
 noir_gallery_check(str_contains($html,'id="project-'.$identity.'"') && str_contains($html,'Completed probe') && str_contains($html,'Completed work — public probe'),'Published canonical work resolves through a Gallery placement');
 wp_save_post_revision($id);$revision=array_key_first(wp_get_post_revisions($id));
 $changed=$facts;$changed['vehicle']='Renamed canonical vehicle';$changed['work']='حسین — literal backslash: \\';
 $_POST=['noir_project_nonce'=>wp_create_nonce('noir_project_save'),'noir_project'=>wp_slash($changed)];
 wp_update_post(['ID'=>$id,'post_title'=>'Renamed title','post_name'=>'renamed-project']);
 $html=noir_gallery_http(get_permalink($page));
 noir_gallery_check(get_post_meta($id,'_noir_project_facts',true)===$changed && str_contains($html,'Renamed canonical vehicle') && str_contains($html,'id="project-'.$identity.'"'),'Native rename preserves references and propagates Unicode canonical vehicle/work');
 foreach (['vehicle'=>'','finish'=>str_repeat('x',101),'work'=>str_repeat('ح',1001),'facts'=>array_fill(0,9,['label'=>'Extra','value'=>'Extra']),'memberships'=>['ceramic-extra'],'comparison'=>array_merge($pair,['after_image'=>0])] as $key=>$bad) {
  $_POST['noir_project']=wp_slash(array_merge($changed,[$key=>$bad]));wp_update_post(['ID'=>$id,'post_title'=>'Rejected title']);
  noir_gallery_check(get_post_meta($id,'_noir_project_facts',true)===$changed && get_post($id)->post_title==='Renamed title','Invalid '.$key.' retains facts and native title');
 }
 $_POST['noir_project']=wp_slash($changed);$_POST['noir_project_nonce']='forged';wp_update_post(['ID'=>$id,'post_title'=>'Forged']);
 noir_gallery_check(get_post($id)->post_title==='Renamed title' && get_post_meta($id,'_noir_project_facts',true)===$changed,'Forged native nonce retains prior title/facts');
 $_POST=[];
 foreach ([['vehicle'=>['array']],['work'=>'<script>bad</script>'],['extra'=>'unknown'],['facts'=>[['label'=>'','value'=>'bad']]],['comparison'=>array_merge($pair,['before_image'=>(string)$image])],['memberships'=>['exotic','exotic']]] as $bad) {
  noir_gallery_check(!update_post_meta($id,'_noir_project_facts',wp_slash(array_merge($changed,$bad))),'Malformed, unknown, markup and duplicate membership metadata is rejected');
 }
 noir_gallery_check(!update_post_meta($id,'_noir_project_id','replacement') && !delete_post_meta($id,'_noir_project_id'),'Project identity cannot change or be deleted');
 $duplicate=wp_insert_post(['post_type'=>'noir_project','post_status'=>'draft','post_title'=>'Duplicate probe']);$temporary[]=$duplicate;
 noir_gallery_check(!add_post_meta($duplicate,'_noir_project_id',$identity),'Duplicate identity including draft is rejected');
 foreach (['INVALID',str_repeat('x',81),'has space'] as $bad) { noir_gallery_check(!add_post_meta($duplicate,'_noir_project_id',$bad),'Invalid identity format is rejected'); }
 set_post_thumbnail($id,$other);wp_save_post_revision($id);wp_restore_post_revision($revision);
 $html=noir_gallery_http(get_permalink($page));
 noir_gallery_check(get_post($id)->post_title==='Completed probe' && get_post_meta($id,'_noir_project_facts',true)===$facts && (int)get_post_thumbnail_id($id)===$image && str_contains($html,'Completed probe'),'Native revision restores Project title, facts, comparison and Featured image');
 wp_save_post_revision($page);$page_revision=array_key_first(wp_get_post_revisions($page));
 $reordered=$placements;$reordered[0]['image']=$other;$reordered[0]['teaser']='Revised placement';
 $_POST=['noir_gallery_nonce'=>wp_create_nonce('noir_gallery_save'),'noir_gallery'=>wp_slash(['placements'=>$reordered])];wp_update_post(['ID'=>$page]);$_POST=[];
 noir_gallery_check(get_post_meta($page,'_noir_gallery_placements',true)===$reordered,'Native Gallery meta box saves contextual media and copy');
 wp_save_post_revision($page);wp_restore_post_revision($page_revision);
 noir_gallery_check(get_post_meta($page,'_noir_gallery_placements',true)===$placements,'Native Gallery revision restores placement references, copy and imagery');
 foreach ([array_merge($placements,$placements),[array_merge($placements[0],['project_id'=>'unknown'])],[array_merge($placements[0],['teaser'=>str_repeat('x',501)])],array_fill(0,61,$placements[0])] as $bad) {
  $request->set_param('meta',['_noir_gallery_placements'=>$bad]);noir_gallery_check(rest_do_request($request)->get_status()===400,'Duplicate/unknown/oversize placements rejected through REST');
 }
 wp_set_current_user($users['author']);$request->set_param('meta',['_noir_gallery_placements'=>[]]);noir_gallery_check(rest_do_request($request)->get_status()===403,'Author cannot change Gallery placements through REST');
 wp_set_current_user(0);$request=new WP_REST_Request('GET','/wp/v2/pages/'.$page);$public=rest_do_request($request)->get_data();noir_gallery_check(!array_key_exists('_noir_gallery_placements',$public['meta']??[]),'Anonymous page API excludes contextual Project references');
 wp_set_current_user($users['editor']);
 wp_update_post(['ID'=>$id,'post_status'=>'draft']);noir_gallery_check(!str_contains(noir_gallery_http(get_permalink($page)),'id="project-'.$identity.'"'),'Draft Project is excluded from Gallery');
 wp_update_post(['ID'=>$id,'post_status'=>'publish']);delete_post_thumbnail($id);noir_gallery_check(!str_contains(noir_gallery_http(get_permalink($page)),'id="project-'.$identity.'"'),'Missing required image excludes Project');set_post_thumbnail($id,$image);
 // A media deletion after a complete valid save leaves the surviving optional figure.
 wp_update_post(['ID'=>$other,'post_status'=>'trash']);
 $html=noir_gallery_http(get_permalink($page));noir_gallery_check(str_contains($html,'comparison-before') && !str_contains($html,'comparison-control'),'Unavailable optional comparison image degrades to labelled single figure');wp_update_post(['ID'=>$other,'post_status'=>'inherit']);
 foreach (['/?noir_project=renamed-project','/?post_type=noir_project','/?post_type=noir_project&feed=rss2','/?post_type=noir_project&p='.$id,'/noir_project/renamed-project/','/wp-json/wp/v2/noir_project','/?s=Completed+probe'] as $route) {
  $html=noir_gallery_http(home_url($route));noir_gallery_check(!str_contains($html,'Completed work — public probe') && !str_contains($html,'id="project-'.$identity.'"'),'No independent public Project exposure at '.$route);
 }
 echo "Ticket 03 native WordPress probe checks complete.\n";
} finally {
 $_POST=[];wp_set_current_user($admin);
 wp_update_post(['ID'=>$other,'post_status'=>'inherit']);
 if ($had_placements) { update_post_meta($page,'_noir_gallery_placements',wp_slash($original)); } else { delete_post_meta($page,'_noir_gallery_placements'); }
 foreach ($temporary as $id) { wp_delete_post($id,true); }
 require_once ABSPATH.'wp-admin/includes/user.php';foreach ($users as $user) { wp_delete_user($user); }
}
