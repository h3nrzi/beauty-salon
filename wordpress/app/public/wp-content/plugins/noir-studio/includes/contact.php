<?php
defined('ABSPATH') || exit;

function noir_contact_schemas() {
 $section = noir_object_schema(['eyebrow'=>noir_text_schema(0,80), 'heading'=>noir_text_schema(1,180), 'body'=>noir_text_schema(0,2000)]);
 return [
  'intro'=>$section, 'response'=>$section, 'form'=>$section,
  'standards'=>['type'=>'array','maxItems'=>8,'items'=>noir_object_schema(['title'=>noir_text_schema(1,120),'body'=>noir_text_schema(0,500),'icon'=>['type'=>'string','enum'=>['verified_user','coffee','shield']]])],
  'process'=>['type'=>'array','maxItems'=>4,'items'=>noir_object_schema(['title'=>noir_text_schema(1,120),'body'=>noir_text_schema(0,500)])],
 ];
}
function noir_contact_error($message) {
 if (get_current_user_id()) {
  $key = 'noir_contact_errors_'.get_current_user_id();
  $errors = get_transient($key) ?: [];
  $errors[] = $message;
  set_transient($key,array_unique($errors),120);
 }
}
add_action('init',function() {
 foreach (noir_contact_schemas() as $section=>$schema) {
  register_post_meta('page','_noir_contact_'.$section,[
   'type'=>$schema['type'], 'single'=>true, 'revisions_enabled'=>true,
   'show_in_rest'=>['schema'=>$schema],
   'sanitize_callback'=>'noir_normalize_text',
   'auth_callback'=>function($allowed,$key,$post_id) {
    return get_page_template_slug($post_id)==='page-contact.php' && current_user_can('edit_post',$post_id) && (current_user_can('edit_others_pages') || current_user_can('manage_options'));
   },
  ]);
 }
});
// Reject writes at the metadata boundary too, including REST and revision restoration.
function noir_guard_contact_meta($check,$post_id,$key,$value) {
 $schemas = noir_contact_schemas();
 $section = substr($key,strlen('_noir_contact_'));
 if (!str_starts_with($key,'_noir_contact_') || !isset($schemas[$section])) { return $check; }
 $valid = noir_validate_fields($value,$schemas[$section],$section);
 if (is_wp_error($valid)) {
  noir_contact_error($valid->get_error_message().' '.__('Previous content was kept. Correct this field and save again.','noir-studio'));
  return false;
 }
 return $check;
}
add_filter('update_post_metadata','noir_guard_contact_meta',10,4);
add_filter('add_post_metadata','noir_guard_contact_meta',10,4);
add_action('add_meta_boxes_page',function($post) {
 if (get_page_template_slug($post->ID)==='page-contact.php') {
  add_meta_box('noir-contact',__('Contact fixed sections','noir-studio'),'noir_contact_box','page','normal','high');
 }
});
function noir_contact_box($post) {
 $section_labels = ['intro'=>__('Introduction','noir-studio'),'response'=>__('Response expectation','noir-studio'),'form'=>__('Surrounding form copy','noir-studio'),'standards'=>__('Studio standards','noir-studio'),'process'=>__('Appointment process','noir-studio')];
 $field_labels = ['eyebrow'=>__('Eyebrow','noir-studio'),'heading'=>__('Heading','noir-studio'),'body'=>__('Body','noir-studio'),'title'=>__('Title','noir-studio')];
 $icon_labels = ['verified_user'=>__('Secure Studio','noir-studio'),'coffee'=>__('Customer lounge','noir-studio'),'shield'=>__('Insurance','noir-studio')];
 wp_nonce_field('noir_contact_save','noir_contact_nonce');
 echo '<p>'.esc_html__('Layout and section order are fixed. Plain text only; invalid sections keep their previous content. Leave both title and body empty to remove a collection row.','noir-studio').'</p>';
 foreach (noir_contact_schemas() as $section=>$schema) {
  $value = get_post_meta($post->ID,'_noir_contact_'.$section,true);
  echo '<fieldset><legend><h3>'.esc_html($section_labels[$section]).'</h3></legend>';
  if ($schema['type']==='object') {
   foreach ($schema['properties'] as $field=>$bounds) {
    noir_admin_text_input("noir_contact[$section][$field]",$field_labels[$field],$value[$field]??'',$bounds['maxLength'],$field==='body');
   }
  } else {
   for ($i=0;$i<$schema['maxItems'];$i++) {
    echo '<details'.($i<count((array)$value)?' open':'').'><summary>'.esc_html(sprintf(__('Item %d','noir-studio'),$i+1)).'</summary>';
    foreach ($schema['items']['properties'] as $field=>$bounds) {
     $name = "noir_contact[$section][$i][$field]";
     if ($field==='icon') {
      echo '<label>'.esc_html__('Decorative icon','noir-studio').' <select name="'.esc_attr($name).'">';
      foreach ($bounds['enum'] as $icon) { echo '<option value="'.esc_attr($icon).'" '.selected($value[$i]['icon']??'',$icon,false).'>'.esc_html($icon_labels[$icon]).'</option>'; }
      echo '</select></label>';
     } else { noir_admin_text_input($name,$field_labels[$field],$value[$i][$field]??'',$bounds['maxLength'],$field==='body'); }
    }
    echo '</details>';
   }
  }
  echo '</fieldset>';
 }
}
add_action('save_post_page',function($post_id) {
 if (wp_is_post_revision($post_id) || wp_is_post_autosave($post_id) || !current_user_can('edit_post',$post_id) || !current_user_can('edit_others_pages') || get_page_template_slug($post_id)!=='page-contact.php') { return; }
 if (!isset($_POST['noir_contact_nonce']) || !is_string($_POST['noir_contact_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['noir_contact_nonce'])),'noir_contact_save')) { return; }
 $input = isset($_POST['noir_contact']) ? wp_unslash($_POST['noir_contact']) : [];
 if (!is_array($input)) { noir_contact_error(__('Contact content must be structured fields.','noir-studio')); return; }
 foreach (noir_contact_schemas() as $section=>$schema) {
  if (!array_key_exists($section,$input)) { continue; }
  $value = noir_normalize_text($input[$section]);
  if ($schema['type']==='array' && is_array($value)) {
   $value = array_values(array_filter($value,function($row) { return !is_array($row) || !isset($row['title'],$row['body']) || !is_string($row['title']) || !is_string($row['body']) || trim($row['title'])!=='' || trim($row['body'])!==''; }));
  }
  $valid = noir_validate_fields($value,$schema,$section);
  if (is_wp_error($valid)) { noir_contact_error($valid->get_error_message().' '.__('Previous section was kept.','noir-studio')); continue; }
  update_post_meta($post_id,'_noir_contact_'.$section,wp_slash($value));
 }
 // Core's usual revision callback precedes this meta-box save. Include the new metadata.
 wp_save_post_revision($post_id);
});
add_action('admin_notices',function() {
 $key = 'noir_contact_errors_'.get_current_user_id();
 $errors = get_transient($key);
 if (!$errors) { return; }
 delete_transient($key);
 foreach ($errors as $message) { echo '<div class="notice notice-error"><p>'.esc_html($message).'</p></div>'; }
});

add_filter('rest_pre_insert_page',function($prepared,$request) {
 $meta = $request->get_param('meta');
 if (!is_array($meta)) { return $prepared; }
 foreach (noir_contact_schemas() as $section=>$schema) {
  $key = '_noir_contact_'.$section;
  if (!array_key_exists($key,$meta)) { continue; }
  $valid = noir_validate_fields(noir_normalize_text($meta[$key]),$schema,$section);
  if (is_wp_error($valid)) {
   return new WP_Error('noir_contact_invalid',$valid->get_error_message().' '.__('Previous content was kept. Correct this field and save again.','noir-studio'),['status'=>400]);
  }
 }
 return $prepared;
},10,2);
