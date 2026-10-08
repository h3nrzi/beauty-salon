<?php
// Approved seam: native editorial writes/revisions and public HTTP on real WordPress.
function noir_home_check($condition,$message) {
 if (!$condition) { throw new RuntimeException($message); }
 echo "PASS: $message\n";
}
function noir_home_http($page) {
 $response=wp_remote_get(get_permalink($page),['timeout'=>15]);
 if (is_wp_error($response)) { throw new RuntimeException($response->get_error_message()); }
 return wp_remote_retrieve_body($response);
}
$page=(int)get_option('noir_studio')['pages']['home'];
$admin=get_users(['role'=>'administrator','number'=>1])[0]->ID;
wp_set_current_user($admin);
$previous=get_post_meta($page,'_noir_home_hero',true);
$had=metadata_exists('post',$page,'_noir_home_hero');
$template=get_page_template_slug($page);
$hero=['eyebrow'=>'Studio probe','heading'=>'Home editorial probe','accent'=>'Automotive','ending'=>'Preservation.','body'=>'Public Home introduction','image'=>0,'badge'=>'Licensed & Insured','caption'=>'Certified Studio Application','meta'=>'Los Angeles, CA'];
$snapshot=[];
foreach (['hero','trust','philosophy','services','projects','placements','benefits','testimonials','final'] as $name) { $key='_noir_home_'.$name; $snapshot[$key]=['exists'=>metadata_exists('post',$page,$key),'value'=>get_post_meta($page,$key,true)]; }
$users=[];$service_ids=[];$project_ids=[];
try {
 update_post_meta($page,'_wp_page_template','page-home.php');
 $request=new WP_REST_Request('POST','/wp/v2/pages/'.$page);
 $request->set_param('meta',['_noir_home_hero'=>$hero]);
 noir_home_check(rest_do_request($request)->get_status()===200,'Native page REST accepts fixed Home hero');
 noir_home_check(str_contains(noir_home_http($page),'Home editorial probe'),'Saved Home hero appears through public HTTP');

 foreach (['editor','author','subscriber'] as $role) { $users[$role]=wp_insert_user(['user_login'=>'noir-home-'.wp_generate_password(10,false),'user_pass'=>wp_generate_password(),'role'=>$role]); }
 wp_set_current_user($users['editor']);
 $hero['image']=$snapshot['_noir_home_hero']['value']['image'];$hero['heading']='Editor Home probe';$hero['body']='حسین — literal backslash: \\';
 $_POST=['noir_home_nonce'=>wp_create_nonce('noir_home_save'),'noir_home'=>wp_slash(['hero'=>$hero])];wp_update_post(['ID'=>$page]);$_POST=[];
 noir_home_check(str_contains(noir_home_http($page),'Editor Home probe') && str_contains(noir_home_http($page),'حسین'),'Native Editor save propagates Home Unicode content');
 wp_save_post_revision($page);$revision=array_key_first(wp_get_post_revisions($page));
 $changed=$hero;$changed['heading']='Later hero';$changed['image']=$snapshot['_noir_home_services']['value']['items'][0]['image'];$changed_reviews=$snapshot['_noir_home_testimonials']['value'];$changed_reviews['items'][0]['quote']='Later Testimonial probe';$request->set_param('meta',['_noir_home_hero'=>$changed,'_noir_home_testimonials'=>$changed_reviews]);
 noir_home_check(rest_do_request($request)->get_status()===200,'Editor can update fixed hero through REST');
 wp_restore_post_revision($revision);
 noir_home_check(str_contains(noir_home_http($page),'Editor Home probe') && !str_contains(noir_home_http($page),'Later hero'),'Native Home revision restores hero through HTTP');
 noir_home_check(get_post_meta($page,'_noir_home_hero',true)['image']===$hero['image'] && !str_contains(noir_home_http($page),'Later Testimonial probe') && str_contains(noir_home_http($page),'The attention to detail on my GT3 RS was exceptional.'),'Native revision restores Home hero media and Testimonial collection');
 $review=$snapshot['_noir_home_testimonials']['value'];
 $bad=$review;$bad['items'][0]['rating']=6;
 foreach ([$bad,array_merge($review,['items'=>array_fill(0,7,$review['items'][0])]),array_merge($review,['extra'=>'Unknown'])] as $value) {
  $request->set_param('meta',['_noir_home_testimonials'=>$value]);noir_home_check(rest_do_request($request)->get_status()===400,'Out-of-range/oversized/unknown Testimonial fields are rejected');
 }
 $bad=$hero;$bad['heading']=str_repeat('ح',181);$request->set_param('meta',['_noir_home_hero'=>$bad]);noir_home_check(rest_do_request($request)->get_status()===400,'Unicode heading bound enforced');
 $request->set_param('meta',['_noir_home_hero'=>array_merge($hero,['body'=>'<script>bad</script>'])]);noir_home_check(rest_do_request($request)->get_status()===400,'Editorial markup is rejected');
 $_POST=['noir_home_nonce'=>'forged','noir_home'=>wp_slash(['hero'=>$changed])];wp_update_post(['ID'=>$page]);$_POST=[];noir_home_check(str_contains(noir_home_http($page),'Editor Home probe'),'Forged native nonce preserves Home content');
 foreach (['author','subscriber'] as $role) { wp_set_current_user($users[$role]);$request->set_param('meta',['_noir_home_hero'=>$changed]);noir_home_check(rest_do_request($request)->get_status()===403,$role.' cannot edit Home sections'); }
 wp_set_current_user(0);$anonymous=new WP_REST_Request('GET','/wp/v2/pages/'.$page);$data=rest_do_request($anonymous)->get_data();noir_home_check(!array_filter(array_keys($data['meta']??[]),fn($key)=>str_starts_with($key,'_noir_home_')),'Anonymous page REST hides Home editorial metadata');
 wp_set_current_user($users['editor']);
 $service=get_posts(['post_type'=>'noir_service','meta_key'=>'_noir_service_id','meta_value'=>'paint-correction','posts_per_page'=>1])[0];
 $facts=get_post_meta($service->ID,'_noir_service_facts',true);$service_ids[$service->ID]=['facts'=>$facts,'title'=>$service->post_title,'status'=>$service->post_status];
 $facts['price']=123400;$facts['duration']='4 Days — editorial probe';$facts['protection']='Editorial protection probe';update_post_meta($service->ID,'_noir_service_facts',wp_slash($facts));wp_update_post(['ID'=>$service->ID,'post_title'=>'Renamed canonical Service']);
 $html=noir_home_http($page);$service_page=(int)get_option('noir_studio')['pages']['services'];
 noir_home_check(str_contains($html,'$1,234') && str_contains($html,'4 Days — editorial probe') && str_contains($html,'Editorial protection probe') && str_contains($html,'Renamed canonical Service') && str_contains(noir_home_http($service_page),'4 Days — editorial probe'),'Canonical Service edits propagate across Home and Services');
 noir_home_check(str_contains($html,'#service-paint-correction') && str_contains($html,'?service=paint-correction#appointment-request'),'Service detail/preselection links retain stable identity after rename');
 wp_update_post(['ID'=>$service->ID,'post_status'=>'draft']);noir_home_check(!str_contains(noir_home_http($page),'data-home-service="paint-correction"'),'Draft featured Service omitted');wp_update_post(['ID'=>$service->ID,'post_status'=>'publish']);
 $project=get_posts(['post_type'=>'noir_project','meta_key'=>'_noir_project_id','meta_value'=>'porsche-911-gt3-992','posts_per_page'=>1])[0];
 $facts=get_post_meta($project->ID,'_noir_project_facts',true);$project_ids[$project->ID]=['facts'=>$facts,'title'=>$project->post_title,'status'=>$project->post_status];
 $facts['work']='Canonical Porsche work propagation probe';$facts['vehicle']='Renamed Porsche vehicle';update_post_meta($project->ID,'_noir_project_facts',wp_slash($facts));wp_update_post(['ID'=>$project->ID,'post_title'=>'Renamed Porsche']);
 $gallery=(int)get_option('noir_studio')['pages']['gallery'];
 noir_home_check(str_contains(noir_home_http($page),'Canonical Porsche work propagation probe') && str_contains(noir_home_http($gallery),'Canonical Porsche work propagation probe'),'Single shared Porsche work edit propagates to Home and Gallery');
 $placements=$snapshot['_noir_home_placements']['value'];wp_save_post_revision($page);$ordered_revision=array_key_first(wp_get_post_revisions($page));
 $reordered=array_reverse($placements);$reordered[0]['teaser']='Revised placement media probe';$reordered[0]['image']=$placements[0]['image'];
 $_POST=['noir_home_nonce'=>wp_create_nonce('noir_home_save'),'noir_home'=>wp_slash(['placements'=>$reordered])];wp_update_post(['ID'=>$page]);$_POST=[];
 preg_match_all('/<article id="project-([^" ]+)"/',noir_home_http($page),$matches);noir_home_check($matches[1]===['range-rover-sv','aston-martin-db12','porsche-911-gt3-992'],'Native row order controls Home placements');
 $reordered_html=noir_home_http($page);noir_home_check(str_contains($reordered_html,wp_get_attachment_url($placements[0]['comparison']['before_image'])) && str_contains($reordered_html,'comparison-control'),'Reordered Porsche preserves configured comparison images and control');
 wp_restore_post_revision($ordered_revision);preg_match_all('/<article id="project-([^" ]+)"/',noir_home_http($page),$matches);noir_home_check($matches[1]===['porsche-911-gt3-992','aston-martin-db12','range-rover-sv'] && get_post_meta($page,'_noir_home_placements',true)===$placements,'Native revision restores ordered references, contextual copy and media');
 foreach ([array_merge($placements,$placements),array_fill(0,13,$placements[0]),[array_merge($placements[0],['project_id'=>'unknown'])]] as $value) { $request->set_param('meta',['_noir_home_placements'=>$value]);noir_home_check(rest_do_request($request)->get_status()===400,'Duplicate/unknown/oversized Project references rejected'); }
 $featured=$snapshot['_noir_home_services']['value'];$featured['items'][]=$featured['items'][0];$request->set_param('meta',['_noir_home_services'=>$featured]);noir_home_check(rest_do_request($request)->get_status()===400,'Featured Service reference bounds rejected');
 $featured=$snapshot['_noir_home_services']['value'];$featured['items'][1]=$featured['items'][0];$request->set_param('meta',['_noir_home_services'=>$featured]);noir_home_check(rest_do_request($request)->get_status()===400,'Duplicate featured Service reference rejected');
 $empty_review=$review;$empty_review['items']=[];$featured['items']=[];
 $request->set_param('meta',['_noir_home_testimonials'=>$empty_review,'_noir_home_trust'=>[],'_noir_home_benefits'=>[],'_noir_home_services'=>$featured,'_noir_home_placements'=>[]]);noir_home_check(rest_do_request($request)->get_status()===200,'Editor can omit optional Home collections');
 $html=noir_home_http($page);foreach (['home-testimonials','home-trust','home-benefits','home-services','home-projects','comparison-control'] as $class) { noir_home_check(!str_contains($html,'class="'.$class),'Empty collection omits '.$class); }
 // Blank native rows must not materialize a Service or review.
 $_POST=['noir_home_nonce'=>wp_create_nonce('noir_home_save'),'noir_home'=>wp_slash(['services'=>array_merge($featured,['items'=>[['service_id'=>'','teaser'=>'','badge'=>'','scope'=>'','image'=>'0']]]),'testimonials'=>array_merge($review,['items'=>[['quote'=>'','author'=>'','attribution'=>'','rating'=>'']]])])];wp_update_post(['ID'=>$page]);$_POST=[];
 noir_home_check(!str_contains(noir_home_http($page),'class="home-services"') && !str_contains(noir_home_http($page),'class="home-testimonials"'),'Cleared native rows omit optional featured Services and Testimonials');
 echo "Ticket 04 native WordPress checks complete.\n";
} finally {
 wp_set_current_user($admin);$_POST=[];
 foreach ($snapshot as $key=>$entry) { if ($entry['exists']) { update_post_meta($page,$key,wp_slash($entry['value'])); } else { delete_post_meta($page,$key); } }
 foreach ([$service_ids,$project_ids] as $records) { foreach ($records as $id=>$record) { $key=get_post_type($id)==='noir_service'?'_noir_service_facts':'_noir_project_facts';update_post_meta($id,$key,wp_slash($record['facts']));wp_update_post(['ID'=>$id,'post_title'=>$record['title'],'post_status'=>$record['status']]); } }
 require_once ABSPATH.'wp-admin/includes/user.php';foreach($users as $id) { wp_delete_user($id); }
 if ($had) { update_post_meta($page,'_noir_home_hero',wp_slash($previous)); } else { delete_post_meta($page,'_noir_home_hero'); }
 update_post_meta($page,'_wp_page_template',$template);
}
