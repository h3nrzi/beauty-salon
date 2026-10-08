<?php
defined('ABSPATH') || exit;
function noir_project_placement_schema($context) {
 return ['type'=>'array','maxItems'=>$context==='home'?12:60,'items'=>noir_object_schema([
  'project_id'=>array_merge(noir_text_schema(1,80),['pattern'=>'^[a-z0-9][a-z0-9-]{0,79}$']),
  'teaser'=>noir_text_schema(0,500),'eyebrow'=>noir_text_schema(0,80),'image'=>['type'=>'integer','minimum'=>0],
  'comparison'=>noir_project_comparison_schema(),
 ])];
}
function noir_gallery_page_schemas() {
 $section=['eyebrow'=>noir_text_schema(0,80),'heading'=>noir_text_schema(1,180),'body'=>noir_text_schema(0,2000)];
 return ['intro'=>noir_object_schema($section),'placements'=>noir_project_placement_schema('gallery'),
  'equipment'=>noir_object_schema($section+['items'=>['type'=>'array','maxItems'=>8,'items'=>noir_object_schema(['title'=>noir_text_schema(1,120),'body'=>noir_text_schema(0,500),'value'=>noir_text_schema(0,100),'icon'=>['type'=>'string','enum'=>['','light-mode','water','polisher','climate']]])]]),
  'final'=>noir_object_schema($section)];
}
function noir_project_reference_exists($identity) {
 return (bool)get_posts(['post_type'=>'noir_project','post_status'=>array_keys(get_post_stati()),'posts_per_page'=>1,'fields'=>'ids','meta_key'=>'_noir_project_id','meta_value'=>$identity]);
}
function noir_validate_placements($value,$context) {
 $valid=noir_validate_fields($value,noir_project_placement_schema($context),'Project placements');
 if (is_wp_error($valid)) { return $valid; }
 $seen=[];
 foreach ($value as $row) {
  if (isset($seen[$row['project_id']]) || !noir_project_reference_exists($row['project_id'])) { return new WP_Error('noir_project_reference',__('Use each existing stable Project identity once per page.','noir-studio')); }
  $seen[$row['project_id']]=true;
  if (!is_int($row['image']) || ($row['image']!==0 && !noir_image_valid($row['image']))) { return new WP_Error('noir_placement_image',__('Use a contextual image attachment ID, or 0 for the Project image.','noir-studio')); }
  $valid=noir_validate_project_comparison($row['comparison']); if (is_wp_error($valid)) { return $valid; }
 }
 return true;
}
function noir_validate_gallery_section($value,$name) {
 $valid=noir_validate_fields($value,noir_gallery_page_schemas()[$name],$name);
 return is_wp_error($valid) || $name!=='placements' ? $valid : noir_validate_placements($value,'gallery');
}
add_action('init',function() {
 $schemas=[];
 foreach (noir_gallery_page_schemas() as $name=>$schema) { $schemas['_noir_gallery_'.$name]=$schema; }
 $schemas['_noir_home_placements']=noir_project_placement_schema('home');
 foreach ($schemas as $key=>$schema) {
  $template=$key==='_noir_home_placements'?'page-home.php':'page-gallery.php';
  register_post_meta('page',$key,['type'=>$schema['type'],'single'=>true,'revisions_enabled'=>true,'show_in_rest'=>['schema'=>$schema],
   'sanitize_callback'=>'noir_normalize_text','auth_callback'=>function($allowed,$key,$post_id) use ($template) { return get_page_template_slug($post_id)===$template && current_user_can('edit_post',$post_id) && current_user_can('edit_others_pages'); }]);
 }
});
function noir_validate_gallery_metadata($key,$value) {
 if ($key==='_noir_home_placements') { return noir_validate_placements(noir_normalize_text($value),'home'); }
 $prefix='_noir_gallery_';
 if (str_starts_with($key,$prefix)) {
  $name=substr($key,strlen($prefix));
  if (isset(noir_gallery_page_schemas()[$name])) { return noir_validate_gallery_section(noir_normalize_text($value),$name); }
 }
 return null;
}
function noir_guard_gallery_meta($check,$post_id,$key,$value) {
 $valid=noir_validate_gallery_metadata($key,$value);
 if (is_wp_error($valid)) { noir_contact_error($valid->get_error_message().' '.__('Previous content was kept.','noir-studio')); return false; }
 return $check;
}
add_filter('add_post_metadata','noir_guard_gallery_meta',10,4);
add_filter('update_post_metadata','noir_guard_gallery_meta',10,4);
add_filter('rest_pre_insert_page',function($prepared,$request) {
 $meta=$request->get_param('meta'); if (!is_array($meta)) { return $prepared; }
 foreach ($meta as $key=>$value) {
  $valid=noir_validate_gallery_metadata($key,$value);
  if (is_wp_error($valid)) { return new WP_Error('noir_gallery_invalid',$valid->get_error_message(),['status'=>400]); }
 }
 return $prepared;
},10,2);
// References and contextual media are editorial data, not an anonymous content API.
add_filter('rest_prepare_page',function($response,$post) {
 if (!current_user_can('edit_post',$post->ID)) {
  $data=$response->get_data();
  foreach (array_keys($data['meta']??[]) as $key) { if (str_starts_with($key,'_noir_gallery_') || $key==='_noir_home_placements') { unset($data['meta'][$key]); } }
  $response->set_data($data);
 }
 return $response;
},10,2);
add_action('add_meta_boxes_page',function($post) {
 if (get_page_template_slug($post->ID)==='page-gallery.php') { add_meta_box('noir-gallery',__('Gallery fixed sections','noir-studio'),'noir_gallery_box','page','normal','high'); }
});
function noir_gallery_box($post) {
 wp_nonce_field('noir_gallery_save','noir_gallery_nonce');
 foreach (noir_gallery_page_schemas() as $name=>$schema) { noir_editorial_fields('noir_gallery['.$name.']',$schema,get_post_meta($post->ID,'_noir_gallery_'.$name,true),noir_editorial_label($name)); }
}
add_action('save_post_page',function($post_id) {
 if (wp_is_post_revision($post_id) || wp_is_post_autosave($post_id) || (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || get_page_template_slug($post_id)!=='page-gallery.php' || !current_user_can('edit_post',$post_id) || !current_user_can('edit_others_pages')) { return; }
 if (!isset($_POST['noir_gallery_nonce']) || !is_string($_POST['noir_gallery_nonce']) || !wp_verify_nonce(wp_unslash($_POST['noir_gallery_nonce']),'noir_gallery_save')) { return; }
 $input=isset($_POST['noir_gallery'])?wp_unslash($_POST['noir_gallery']):null;
 if (!is_array($input) || array_diff(array_keys($input),array_keys(noir_gallery_page_schemas()))) { noir_contact_error(__('Use the fixed Gallery sections. Previous content was kept.','noir-studio')); return; }
 foreach (noir_gallery_page_schemas() as $name=>$schema) {
  if (!array_key_exists($name,$input)) { continue; }
  $value=noir_editorial_input($input[$name],$schema); $valid=noir_validate_gallery_section($value,$name);
  if (is_wp_error($valid)) { noir_contact_error($valid->get_error_message().' '.__('Previous section was kept.','noir-studio')); continue; }
  update_post_meta($post_id,'_noir_gallery_'.$name,wp_slash($value));
 }
 wp_save_post_revision($post_id);
});
function noir_project_placements($page,$context) {
 if (!in_array($context,['home','gallery'],true)) { return []; }
 $value=get_post_meta($page,'_noir_'.$context.'_placements',true);
 if (is_wp_error(noir_validate_fields($value,noir_project_placement_schema($context),'Placements'))) { return []; }
 $projects=noir_projects(); $result=[]; $seen=[];
 foreach ($value as $row) {
  $id=$row['project_id']; if (!isset($projects[$id]) || isset($seen[$id])) { continue; } $seen[$id]=true;
  $project=$projects[$id];
  $row['image']=noir_image_valid($row['image'])?$row['image']:$project['image'];
  // A contextual pair overrides the canonical pair, including a surviving single image.
  $pair=$row['comparison']; $contextual=(bool)($pair['before_image'] || $pair['after_image']);
  if (!$contextual) { $pair=$project['comparison']; }
  foreach (['before_image','after_image'] as $key) { if (!noir_image_valid($pair[$key])) { $pair[$key]=0; } }
  $result[]=array_merge($project,$row,['comparison'=>$pair]);
 }
 return $result;
}
function noir_gallery_page($page) {
 if (get_page_template_slug($page)!=='page-gallery.php') { return []; }
 $sections=[];
 foreach (noir_gallery_page_schemas() as $name=>$schema) {
  if ($name==='placements') { continue; }
  $value=get_post_meta($page,'_noir_gallery_'.$name,true);
  if (!is_wp_error(noir_validate_fields($value,$schema,$name))) { $sections[$name]=$value; }
 }
 return $sections;
}
