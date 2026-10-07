<?php
defined('ABSPATH') || exit;
function noir_services_page_schemas() {
 $section = ['eyebrow'=>noir_text_schema(0,80),'heading'=>noir_text_schema(1,180),'body'=>noir_text_schema(0,2000)];
 $rows = function($max,$properties) { return ['type'=>'array','maxItems'=>$max,'items'=>noir_object_schema($properties)]; };
 $image = ['type'=>'integer','minimum'=>0];
 return [
  'intro'=>noir_object_schema($section), 'details'=>noir_object_schema($section),
  'metrics'=>$rows(8,['title'=>noir_text_schema(1,120),'value'=>array_merge(noir_text_schema(0,100),['pattern'=>'^[^<\\x00-\\x08\\x0B\\x0C\\x0E-\\x1F\\x7F]*$']),'caption'=>noir_text_schema(0,120),'body'=>noir_text_schema(0,500)]),
  'process'=>noir_object_schema($section+['items'=>$rows(4,['title'=>noir_text_schema(1,120),'body'=>noir_text_schema(0,500),'icon'=>['type'=>'string','enum'=>['search','local_car_wash','auto_fix_high','verified_user']]])]),
  'comparison'=>noir_object_schema($section+[
   'before_title'=>noir_text_schema(0,120),'before_body'=>noir_text_schema(0,500),
   'after_title'=>noir_text_schema(0,120),'after_body'=>noir_text_schema(0,500),
   'before_image'=>$image,'after_image'=>$image,'before_label'=>noir_text_schema(1,80),'after_label'=>noir_text_schema(1,80),
  ]),
  'faq'=>noir_object_schema($section+['items'=>$rows(12,['question'=>noir_text_schema(1,180),'answer'=>noir_text_schema(1,2000)])]),
  'final'=>noir_object_schema($section),
 ];
}
function noir_validate_services_section($value,$schema,$name) {
 $valid = noir_validate_fields($value,$schema,$name);
 if (is_wp_error($valid)) { return $valid; }
 foreach (['before_image','after_image'] as $key) {
  if (isset($value[$key]) && (!is_int($value[$key]) || ($value[$key]!==0 && !noir_image_valid($value[$key])))) { return new WP_Error('noir_image',__('Select an image attachment, or 0 to omit it.','noir-studio')); }
 }
 return true;
}
add_action('init',function() {
 foreach (noir_services_page_schemas() as $section=>$schema) {
  register_post_meta('page','_noir_services_'.$section,[
   'type'=>$schema['type'],'single'=>true,'revisions_enabled'=>true,'show_in_rest'=>['schema'=>$schema],
   'sanitize_callback'=>'noir_normalize_text',
   'auth_callback'=>function($allowed,$key,$post_id) { return get_page_template_slug($post_id)==='page-services.php' && current_user_can('edit_post',$post_id) && current_user_can('edit_others_pages'); },
  ]);
 }
});
function noir_guard_services_page_meta($check,$post_id,$key,$value) {
 if (!str_starts_with($key,'_noir_services_')) { return $check; }
 $name = substr($key,strlen('_noir_services_'));
 $schemas = noir_services_page_schemas();
 if (!isset($schemas[$name])) { return $check; }
 $valid = noir_validate_services_section($value,$schemas[$name],$name);
 if (is_wp_error($valid)) { noir_contact_error($valid->get_error_message().' '.__('Previous section was kept.','noir-studio')); return false; }
 return $check;
}
add_filter('add_post_metadata','noir_guard_services_page_meta',10,4);
add_filter('update_post_metadata','noir_guard_services_page_meta',10,4);
add_filter('rest_pre_insert_page',function($prepared,$request) {
 $meta = $request->get_param('meta');
 if (!is_array($meta)) { return $prepared; }
 foreach (noir_services_page_schemas() as $section=>$schema) {
  $key = '_noir_services_'.$section;
  if (!array_key_exists($key,$meta)) { continue; }
  $valid = noir_validate_services_section(noir_normalize_text($meta[$key]),$schema,$section);
  if (is_wp_error($valid)) { return new WP_Error('noir_services_invalid',$valid->get_error_message().' '.__('Previous section was kept.','noir-studio'),['status'=>400]); }
 }
 return $prepared;
},10,2);
function noir_services_field_labels() {
 return [
  'intro'=>__('Introduction','noir-studio'),'details'=>__('Detailed Services','noir-studio'),
  'metrics'=>__('Metrics','noir-studio'),'process'=>__('Process','noir-studio'),
  'comparison'=>__('Comparison','noir-studio'),'faq'=>__('FAQ','noir-studio'),'final'=>__('Final CTA','noir-studio'),
  'eyebrow'=>__('Eyebrow','noir-studio'),'heading'=>__('Heading','noir-studio'),'body'=>__('Body','noir-studio'),
  'items'=>__('Items','noir-studio'),'title'=>__('Title','noir-studio'),'value'=>__('Value','noir-studio'),
  'caption'=>__('Caption','noir-studio'),'icon'=>__('Decorative icon','noir-studio'),
  'before_title'=>__('Before title','noir-studio'),'before_body'=>__('Before description','noir-studio'),
  'after_title'=>__('After title','noir-studio'),'after_body'=>__('After description','noir-studio'),
  'before_image'=>__('Before image','noir-studio'),'after_image'=>__('After image','noir-studio'),
  'before_label'=>__('Before label','noir-studio'),'after_label'=>__('After label','noir-studio'),
  'question'=>__('Question','noir-studio'),'answer'=>__('Answer','noir-studio'),
 ];
}
// Fixed-schema recursive field rendering; editors never enter JSON or layout HTML.
function noir_services_fields($name,$schema,$value,$label) {
 if ($schema['type']==='object') {
  echo '<fieldset><legend><h3>'.esc_html($label).'</h3></legend>';
  foreach ($schema['properties'] as $key=>$child) { noir_services_fields($name.'['.$key.']',$child,$value[$key]??null,noir_services_field_labels()[$key]); }
  echo '</fieldset>';
 } elseif ($schema['type']==='array') {
  echo '<p>'.esc_html__('Clear all text in a row to remove it. Empty collections omit the section.','noir-studio').'</p>';
  for ($i=0;$i<$schema['maxItems'];$i++) {
   echo '<details'.($i<count((array)$value)?' open':'').'><summary>'.esc_html(sprintf(__('Item %d','noir-studio'),$i+1)).'</summary>';
   noir_services_fields($name.'['.$i.']',$schema['items'],$value[$i]??[],sprintf(__('Item %d','noir-studio'),$i+1));
   echo '</details>';
  }
 } elseif (isset($schema['enum'])) {
  echo '<p><label>'.esc_html($label).' <select name="'.esc_attr($name).'">';
  foreach ($schema['enum'] as $option) { echo '<option value="'.esc_attr($option).'" '.selected($value,$option,false).'>'.esc_html(['search'=>__('Inspection','noir-studio'),'local_car_wash'=>__('Wash','noir-studio'),'auto_fix_high'=>__('Polishing','noir-studio'),'verified_user'=>__('Protection','noir-studio')][$option]).'</option>'; }
  echo '</select></label></p>';
 } elseif ($schema['type']==='integer') {
  echo '<p><label>'.esc_html($label).' <input type="number" min="0" step="1" name="'.esc_attr($name).'" value="'.esc_attr($value??0).'"></label> '.esc_html__('Media Library attachment ID; 0 omits the image.','noir-studio').'</p>';
 } else { noir_admin_text_input($name,$label,$value??'',$schema['maxLength'],($schema['maxLength']??0)>300); }
}
function noir_services_input($value,$schema) {
 if ($schema['type']==='object' && is_array($value)) {
  foreach ($schema['properties'] as $key=>$child) { if (array_key_exists($key,$value)) { $value[$key]=noir_services_input($value[$key],$child); } }
 } elseif ($schema['type']==='array' && is_array($value)) {
  $value = array_values(array_filter($value,function($row) { if (!is_array($row)) { return true; } foreach ($row as $key=>$field) { if ($key!=='icon' && (!is_string($field) || trim($field)!=='')) { return true; } } return false; }));
  foreach ($value as &$row) { $row=noir_services_input($row,$schema['items']); } unset($row);
 } elseif ($schema['type']==='integer' && is_string($value) && preg_match('/^[0-9]{1,10}$/D',$value)) { $value=(int)$value; }
 return noir_normalize_text($value);
}
add_action('add_meta_boxes_page',function($post) {
 if (get_page_template_slug($post->ID)==='page-services.php') { add_meta_box('noir-services-page',__('Services fixed sections','noir-studio'),'noir_services_page_box','page','normal','high'); }
});
function noir_services_page_box($post) {
 wp_nonce_field('noir_services_page_save','noir_services_page_nonce');
 foreach (noir_services_page_schemas() as $section=>$schema) { noir_services_fields('noir_services['.$section.']',$schema,get_post_meta($post->ID,'_noir_services_'.$section,true),noir_services_field_labels()[$section]); }
}
add_action('save_post_page',function($post_id) {
 if (wp_is_post_revision($post_id) || wp_is_post_autosave($post_id) || (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || !current_user_can('edit_post',$post_id) || !current_user_can('edit_others_pages') || get_page_template_slug($post_id)!=='page-services.php') { return; }
 if (!isset($_POST['noir_services_page_nonce']) || !is_string($_POST['noir_services_page_nonce']) || !wp_verify_nonce(wp_unslash($_POST['noir_services_page_nonce']),'noir_services_page_save')) { return; }
 $input = isset($_POST['noir_services'])?wp_unslash($_POST['noir_services']):null;
 if (!is_array($input) || array_diff(array_keys($input),array_keys(noir_services_page_schemas()))) { noir_contact_error(__('Use the fixed Services sections. Previous content was kept.','noir-studio')); return; }
 foreach (noir_services_page_schemas() as $section=>$schema) {
  if (!array_key_exists($section,$input)) { continue; }
  $value = noir_services_input($input[$section],$schema);
  $valid = noir_validate_services_section($value,$schema,$section);
  if (is_wp_error($valid)) { noir_contact_error($valid->get_error_message().' '.__('Previous section was kept.','noir-studio')); continue; }
  update_post_meta($post_id,'_noir_services_'.$section,wp_slash($value));
 }
 wp_save_post_revision($post_id);
});
function noir_services_page($post_id) {
 if (get_page_template_slug($post_id)!=='page-services.php') { return []; }
 $sections = [];
 foreach (noir_services_page_schemas() as $section=>$schema) {
  $value = get_post_meta($post_id,'_noir_services_'.$section,true);
  if (!is_wp_error(noir_validate_services_section($value,$schema,$section))) { $sections[$section]=$value; }
 }
 return $sections;
}
