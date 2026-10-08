<?php
defined('ABSPATH') || exit;
function noir_home_service_schema() {
 return ['type'=>'array','maxItems'=>3,'items'=>noir_object_schema([
  'service_id'=>['type'=>'string','enum'=>noir_service_ids()], 'teaser'=>noir_text_schema(0,300),
  'badge'=>noir_text_schema(0,80),'scope'=>noir_text_schema(0,180),'image'=>['type'=>'integer','minimum'=>0],
 ])];
}
function noir_home_page_schemas() {
 $section=['eyebrow'=>noir_text_schema(0,80),'heading'=>noir_text_schema(1,180),'body'=>noir_text_schema(0,2000)];
 $items=['type'=>'array','maxItems'=>8,'items'=>noir_object_schema([
  'title'=>noir_text_schema(1,120),'body'=>noir_text_schema(0,500),'value'=>noir_text_schema(0,100),
  'icon'=>['type'=>'string','enum'=>['','light-mode','water','polisher','climate','shield','verified','person','verified_user']],
 ])];
 return [
  'hero'=>noir_object_schema($section+['accent'=>noir_text_schema(0,180),'ending'=>noir_text_schema(0,180),
   'image'=>['type'=>'integer','minimum'=>0],'badge'=>noir_text_schema(0,80),'caption'=>noir_text_schema(0,80),'meta'=>noir_text_schema(0,180)]),
  'trust'=>$items,
  'philosophy'=>noir_object_schema($section+['accent'=>noir_text_schema(0,180),'secondary'=>noir_text_schema(0,2000),'items'=>$items]),
  'services'=>noir_object_schema($section+['items'=>noir_home_service_schema()]),
  'projects'=>noir_object_schema($section),'placements'=>noir_project_placement_schema('home'),
  'benefits'=>$items,
  'testimonials'=>noir_object_schema($section+['items'=>['type'=>'array','maxItems'=>6,'items'=>noir_object_schema([
   'quote'=>noir_text_schema(1,1000),'author'=>noir_text_schema(1,100),'attribution'=>noir_text_schema(0,160),'rating'=>['type'=>'integer','minimum'=>1,'maximum'=>5],
  ])]]),
  'final'=>noir_object_schema($section),
 ];
}
function noir_validate_home_section($value,$name) {
 $valid=noir_validate_fields($value,noir_home_page_schemas()[$name],$name);
 if (is_wp_error($valid)) { return $valid; }
 if ($name==='placements') { return noir_validate_placements($value,'home'); }
 if ($name==='hero' && (!is_int($value['image']) || ($value['image']!==0 && !noir_image_valid($value['image'])))) { return new WP_Error('noir_home_image',__('Use a Home image attachment ID, or 0 to omit.','noir-studio')); }
 if ($name==='services') {
  $seen=[];
  foreach ($value['items'] as $row) {
   if (isset($seen[$row['service_id']])) { return new WP_Error('noir_home_reference',__('Use each Service once in featured placements.','noir-studio')); }
   $seen[$row['service_id']]=true;
   if (!is_int($row['image']) || ($row['image']!==0 && !noir_image_valid($row['image']))) { return new WP_Error('noir_home_image',__('Use a contextual image attachment ID, or 0 for the Service image.','noir-studio')); }
  }
 }
 if ($name==='testimonials') { foreach ($value['items'] as $row) { if (!is_int($row['rating'])) { return new WP_Error('noir_home_rating',__('Use an integer rating from 1 to 5.','noir-studio')); } } }
 return true;
}
add_action('init',function() {
 $schemas=[];
 foreach (noir_home_page_schemas() as $name=>$schema) { $schemas['_noir_home_'.$name]=$schema; }
 foreach ($schemas as $key=>$schema) {
  $template='page-home.php';
  register_post_meta('page',$key,['type'=>$schema['type'],'single'=>true,'revisions_enabled'=>true,'show_in_rest'=>['schema'=>$schema],
   'sanitize_callback'=>'noir_normalize_text','auth_callback'=>function($allowed,$key,$post_id) use ($template) { return get_page_template_slug($post_id)===$template && current_user_can('edit_post',$post_id) && current_user_can('edit_others_pages'); }]);
 }
});
function noir_validate_home_metadata($key,$value) {
 $prefix='_noir_home_';
 if (str_starts_with($key,$prefix)) {
  $name=substr($key,strlen($prefix));
  if (isset(noir_home_page_schemas()[$name])) { return noir_validate_home_section(noir_normalize_text($value),$name); }
 }
 return null;
}
function noir_guard_home_meta($check,$post_id,$key,$value) {
 $valid=noir_validate_home_metadata($key,$value);
 if (is_wp_error($valid)) { noir_contact_error($valid->get_error_message().' '.__('Previous content was kept.','noir-studio')); return false; }
 return $check;
}
add_filter('add_post_metadata','noir_guard_home_meta',10,4);
add_filter('update_post_metadata','noir_guard_home_meta',10,4);
add_filter('rest_pre_insert_page',function($prepared,$request) {
 $meta=$request->get_param('meta'); if (!is_array($meta)) { return $prepared; }
 foreach ($meta as $key=>$value) {
  $valid=noir_validate_home_metadata($key,$value);
  if (is_wp_error($valid)) { return new WP_Error('noir_home_invalid',$valid->get_error_message(),['status'=>400]); }
 }
 return $prepared;
},10,2);
// References and contextual media are editorial data, not an anonymous content API.
add_filter('rest_prepare_page',function($response,$post) {
 if (!current_user_can('edit_post',$post->ID)) {
  $data=$response->get_data();
  foreach (array_keys($data['meta']??[]) as $key) { if (str_starts_with($key,'_noir_home_')) { unset($data['meta'][$key]); } }
  $response->set_data($data);
 }
 return $response;
},10,2);
add_action('add_meta_boxes_page',function($post) {
 if (get_page_template_slug($post->ID)==='page-home.php') { add_meta_box('noir-home',__('Home fixed sections','noir-studio'),'noir_home_box','page','normal','high'); }
});
function noir_home_box($post) {
 wp_nonce_field('noir_home_save','noir_home_nonce');
 foreach (noir_home_page_schemas() as $name=>$schema) { noir_editorial_fields('noir_home['.$name.']',$schema,get_post_meta($post->ID,'_noir_home_'.$name,true),noir_editorial_label($name)); }
}
add_action('save_post_page',function($post_id) {
 if (wp_is_post_revision($post_id) || wp_is_post_autosave($post_id) || (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || get_page_template_slug($post_id)!=='page-home.php' || !current_user_can('edit_post',$post_id) || !current_user_can('edit_others_pages')) { return; }
 if (!isset($_POST['noir_home_nonce']) || !is_string($_POST['noir_home_nonce']) || !wp_verify_nonce(wp_unslash($_POST['noir_home_nonce']),'noir_home_save')) { return; }
 $input=isset($_POST['noir_home'])?wp_unslash($_POST['noir_home']):null;
 if (!is_array($input) || array_diff(array_keys($input),array_keys(noir_home_page_schemas()))) { noir_contact_error(__('Use the fixed Home sections. Previous content was kept.','noir-studio')); return; }
 foreach (noir_home_page_schemas() as $name=>$schema) {
  if (!array_key_exists($name,$input)) { continue; }
  $value=noir_editorial_input($input[$name],$schema); $valid=noir_validate_home_section($value,$name);
  if (is_wp_error($valid)) { noir_contact_error($valid->get_error_message().' '.__('Previous section was kept.','noir-studio')); continue; }
  update_post_meta($post_id,'_noir_home_'.$name,wp_slash($value));
 }
 wp_save_post_revision($post_id);
});
function noir_home_page($page) {
 if (get_page_template_slug($page)!=='page-home.php') { return []; }
 $sections=[];
 foreach (noir_home_page_schemas() as $name=>$schema) {
  if ($name==='placements') { continue; }
  $value=get_post_meta($page,'_noir_home_'.$name,true);
  // Read surviving optional media without rejecting otherwise valid editorial text.
  if (!is_wp_error(noir_validate_fields($value,$schema,$name))) { $sections[$name]=$value; }
 }
 return $sections;
}
function noir_home_services($page) {
 $section=noir_home_page($page)['services']??[]; $result=[]; $seen=[];
 foreach ($section['items']??[] as $row) {
  $id=$row['service_id']; $service=noir_service($id);
  if (!$service || isset($seen[$id])) { continue; } $seen[$id]=true;
  $row['image']=noir_image_valid($row['image'])?$row['image']:$service['image'];
  $result[]=array_merge($service,$row);
 }
 return $result;
}
