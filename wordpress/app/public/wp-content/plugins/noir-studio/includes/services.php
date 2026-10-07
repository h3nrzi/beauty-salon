<?php
// Canonical editorial records. No public record routes or content API.
defined('ABSPATH') || exit;

function noir_service_ids() { return ['exterior-detail','interior-detail','full-detail','paint-correction','ceramic-coating']; }
function noir_service_schema() {
 return noir_object_schema([
  'order'=>['type'=>'integer','minimum'=>0,'maximum'=>999],
  'short_description'=>noir_text_schema(0,300), 'description'=>noir_text_schema(1,2000),
  'eyebrow'=>noir_text_schema(0,80), 'badge'=>noir_text_schema(0,80),
  'inclusions'=>['type'=>'array','minItems'=>1,'maxItems'=>12,'items'=>noir_text_schema(1,180)],
  'price'=>['type'=>['integer','null'],'minimum'=>0,'maximum'=>100000000],
  'duration'=>array_merge(noir_text_schema(1,80),['type'=>['string','null']]),
  'protection'=>array_merge(noir_text_schema(1,120),['type'=>['string','null']]),
 ]);
}
function noir_service_editor($post_id) {
 return current_user_can('edit_post',$post_id) && current_user_can('edit_noir_services');
}
add_action('init',function() {
 $type = register_post_type('noir_service',[
  'labels'=>['name'=>__('Services','noir-studio'),'singular_name'=>__('Service','noir-studio')],
  'public'=>false,'publicly_queryable'=>false,'exclude_from_search'=>true,'show_ui'=>true,
  'show_in_nav_menus'=>false,'has_archive'=>false,'rewrite'=>false,'query_var'=>false,'show_in_rest'=>false,
  'capability_type'=>['noir_service','noir_services'],'map_meta_cap'=>true,
  'supports'=>['title','thumbnail','revisions','custom-fields'],
 ]);
 // Upgrade existing installations too; no activation-time content seeding.
 foreach (['administrator','editor'] as $name) {
  $role = get_role($name);
  if (!$role) { continue; }
  foreach ($type->cap as $cap) {
   if ($cap!=='read' && !in_array($cap,['edit_noir_service','read_noir_service','delete_noir_service'],true) && !$role->has_cap($cap)) { $role->add_cap($cap); }
  }
 }
 foreach (['_noir_service_id'=>'string','_noir_service_facts'=>'object','_thumbnail_id'=>'integer'] as $key=>$type) {
  register_post_meta('noir_service',$key,[
   'type'=>$type,'single'=>true,'show_in_rest'=>false,'revisions_enabled'=>$key!=='_noir_service_id',
   'sanitize_callback'=>$type==='integer'?'absint':'noir_normalize_text',
   'auth_callback'=>function($allowed,$key,$post_id) { return noir_service_editor($post_id); },
  ]);
 }
});
function noir_service_identity_valid($post_id,$value) {
 if (!is_string($value) || !in_array($value,noir_service_ids(),true)) { return false; }
 $existing = get_post_meta($post_id,'_noir_service_id',true);
 if ($existing!=='' && $existing!==$value) { return false; }
 $duplicates = get_posts(['post_type'=>'noir_service','post_status'=>array_keys(get_post_stati()),'posts_per_page'=>-1,'fields'=>'ids','post__not_in'=>[$post_id],'meta_key'=>'_noir_service_id','meta_value'=>$value]);
 return !$duplicates;
}
function noir_image_valid($id) {
 return is_int($id) && $id>0 && get_post_type($id)==='attachment' && wp_attachment_is_image($id) && get_post_status($id)!=='trash';
}
function noir_validate_service_facts($facts) {
 $valid = noir_validate_fields($facts,noir_service_schema(),'Service');
 if (is_wp_error($valid)) { return $valid; }
 foreach (['order','price'] as $key) {
  if ($facts[$key]!==null && !is_int($facts[$key])) { return new WP_Error('noir_service_integer',__('Order and price must be whole numbers.','noir-studio')); }
 }
 return true;
}
function noir_guard_service_meta($check,$post_id,$key,$value) {
 $post = get_post($post_id);
 if (!$post || ($post->post_type!=='noir_service' && !($post->post_type==='revision' && get_post_type($post->post_parent)==='noir_service'))) { return $check; }
 if ($key==='_noir_service_id') { $valid = $post->post_type!=='revision' && noir_service_identity_valid($post_id,$value); }
 elseif ($key==='_noir_service_facts') { $valid = noir_validate_service_facts(noir_normalize_text($value)); }
 elseif ($key==='_thumbnail_id') { $valid = noir_image_valid(is_numeric($value)?(int)$value:0); }
 else { return $check; }
 if ($valid===false || is_wp_error($valid)) {
  noir_contact_error((is_wp_error($valid)?$valid->get_error_message():__('Use an available immutable Service identity or a valid image attachment.','noir-studio')).' '.__('Previous content was kept.','noir-studio'));
  return false;
 }
 return $check;
}
add_filter('add_post_metadata','noir_guard_service_meta',10,4);
add_filter('update_post_metadata','noir_guard_service_meta',10,4);
add_filter('delete_post_metadata',function($check,$post_id,$key) {
 return get_post_type($post_id)==='noir_service' && $key==='_noir_service_id' ? false : $check;
},10,3);

function noir_service_posted_fields() {
 $raw = isset($_POST['noir_service']) ? wp_unslash($_POST['noir_service']) : null;
 if (!is_array($raw) || array_diff(array_keys($raw),['identity','facts'])) { return new WP_Error('noir_service_input',__('Use the fixed Service fields.','noir-studio')); }
 $facts = noir_normalize_text($raw['facts']??null);
 if (is_array($facts)) {
  foreach (['order','price'] as $key) {
   if (isset($facts[$key]) && is_string($facts[$key]) && preg_match('/^[0-9]{1,9}$/D',$facts[$key])) { $facts[$key]=(int)$facts[$key]; }
  }
  foreach (['price','duration','protection'] as $key) { if (isset($facts[$key]) && $facts[$key]==='') { $facts[$key]=null; } }
  if (isset($facts['inclusions']) && is_string($facts['inclusions'])) { $facts['inclusions']=explode("\n",$facts['inclusions']); }
 }
 $valid = noir_validate_service_facts($facts);
 return is_wp_error($valid) ? $valid : ['identity'=>$raw['identity']??null,'facts'=>$facts];
}
function noir_service_save_allowed($post_id) {
 return !wp_is_post_revision($post_id) && !wp_is_post_autosave($post_id) && !(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) && noir_service_editor($post_id) && isset($_POST['noir_service_nonce']) && is_string($_POST['noir_service_nonce']) && wp_verify_nonce(wp_unslash($_POST['noir_service_nonce']),'noir_service_save');
}
// Preserve native title on invalid saves as well as registered facts.
add_filter('wp_insert_post_data',function($data,$postarr) {
 if ($data['post_type']!=='noir_service' || $data['post_status']==='auto-draft') { return $data; }
 $valid = noir_validate_fields(wp_unslash($data['post_title']),noir_text_schema(1,100),'Service title');
 $id = (int)($postarr['ID']??0);
 if (isset($_POST['noir_service_nonce'])) {
  $fields = noir_service_posted_fields();
  if (!noir_service_save_allowed($id) || is_wp_error($fields) || !noir_service_identity_valid($id,$fields['identity']??null)) { $valid = new WP_Error('noir_service_save',__('Check the Service fields, unique identity and editing nonce.','noir-studio')); }
 }
 if (is_wp_error($valid)) {
  $GLOBALS['noir_service_rejected'][$id] = true;
  noir_contact_error($valid->get_error_message().' '.__('Previous content was kept.','noir-studio'));
  $previous = get_post($id);
  foreach (['post_title','post_status','post_name'] as $field) { $data[$field]=$previous?wp_slash($previous->$field):($field==='post_status'?'draft':''); }
 }
 return $data;
},10,2);
add_action('save_post_noir_service',function($post_id) {
 if (!empty($GLOBALS['noir_service_rejected'][$post_id])) { unset($GLOBALS['noir_service_rejected'][$post_id]); return; }
 if (!noir_service_save_allowed($post_id)) { return; }
 $fields = noir_service_posted_fields();
 if (is_wp_error($fields) || !noir_service_identity_valid($post_id,$fields['identity']??null)) {
  noir_contact_error((is_wp_error($fields)?$fields->get_error_message():__('The Service identity is immutable and must be unique.','noir-studio')).' '.__('Previous content was kept.','noir-studio')); return;
 }
 update_post_meta($post_id,'_noir_service_id',$fields['identity']);
 update_post_meta($post_id,'_noir_service_facts',wp_slash($fields['facts']));
 wp_save_post_revision($post_id);
});
add_action('add_meta_boxes_noir_service',function() {
 add_meta_box('noir-service',__('Canonical Service facts','noir-studio'),'noir_service_box','noir_service','normal','high');
});
function noir_service_box($post) {
 wp_nonce_field('noir_service_save','noir_service_nonce');
 $id = get_post_meta($post->ID,'_noir_service_id',true);
 echo '<p>'.esc_html__('One record per approved identity, including drafts and trash. Identity cannot change. Set the primary image with Featured image. Empty optional facts are omitted. Invalid fields retain previous content.','noir-studio').'</p>';
 if ($id) { echo '<p>'.esc_html__('Stable identity: ','noir-studio').'<strong>'.esc_html($id).'</strong><input type="hidden" name="noir_service[identity]" value="'.esc_attr($id).'"></p>'; }
 else {
  echo '<label>'.esc_html__('Stable identity','noir-studio').' <select name="noir_service[identity]">';
  foreach (noir_service_ids() as $identity) { echo '<option value="'.esc_attr($identity).'">'.esc_html($identity).'</option>'; }
  echo '</select></label>';
 }
 $facts = get_post_meta($post->ID,'_noir_service_facts',true);
 $labels = ['order'=>__('Order (0–999)','noir-studio'),'short_description'=>__('Short description','noir-studio'),'description'=>__('Full description','noir-studio'),'eyebrow'=>__('Eyebrow','noir-studio'),'badge'=>__('Badge','noir-studio'),'inclusions'=>__('Inclusions — one per line, 1–12 lines, up to 180 characters each','noir-studio'),'price'=>__('Starting price — USD cents, optional (0–100000000)','noir-studio'),'duration'=>__('Duration, optional','noir-studio'),'protection'=>__('Protection, optional','noir-studio')];
 foreach (noir_service_schema()['properties'] as $key=>$schema) {
  $value = $facts[$key]??'';
  if ($key==='inclusions' && is_array($value)) { $value=implode("\n",$value); }
  noir_admin_text_input('noir_service[facts]['.$key.']',$labels[$key],$value,$schema['maxLength']??($key==='inclusions'?2171:9),in_array($key,['description','short_description','inclusions'],true));
 }
}

// Theme and form use this validated read boundary; mutable titles/slugs are never keys.
function noir_services() {
 $services = [];
 foreach (get_posts(['post_type'=>'noir_service','post_status'=>'publish','posts_per_page'=>-1,'orderby'=>'ID','order'=>'ASC']) as $post) {
  $id = get_post_meta($post->ID,'_noir_service_id',true);
  $facts = get_post_meta($post->ID,'_noir_service_facts',true);
  $image = (int)get_post_thumbnail_id($post);
  if (!noir_service_identity_valid($post->ID,$id) || is_wp_error(noir_validate_fields($post->post_title,noir_text_schema(1,100),'Service title')) || is_wp_error(noir_validate_service_facts($facts)) || !noir_image_valid($image)) { continue; }
  $services[] = array_merge($facts,['service_id'=>$id,'post_id'=>$post->ID,'title'=>$post->post_title,'image'=>$image]);
 }
 usort($services,function($a,$b) { return ($a['order']<=>$b['order']) ?: (array_search($a['service_id'],noir_service_ids(),true)<=>array_search($b['service_id'],noir_service_ids(),true)); });
 return $services;
}
function noir_service($identity) {
 foreach (noir_services() as $service) { if ($service['service_id']===$identity) { return $service; } }
 return null;
}
function noir_service_links($identity) {
 if (!noir_service($identity)) { return ['detail'=>'','appointment'=>'']; }
 $pages = noir_studio_settings()['pages']??[];
 $services = noir_published_page($pages['services']??0)?get_permalink($pages['services']):'';
 $contact = noir_published_page($pages['contact']??0)?get_permalink($pages['contact']):'';
 return ['detail'=>$services?$services.'#service-'.$identity:'','appointment'=>$contact?add_query_arg('service',$identity,$contact).'#appointment-request':''];
}

// Native editorial menu reference, resolved through the same published-valid boundary.
function noir_service_menu_reference($item_id) {
 $service = noir_service(get_post_meta($item_id,'_noir_service_ref',true));
 if (!$service) { return null; }
 $url = noir_service_links($service['service_id'])['detail'];
 return $url ? ['title'=>$service['title'],'url'=>$url,'order'=>$service['order']] : null;
}
add_action('wp_nav_menu_item_custom_fields',function($item_id,$item) {
 if (!function_exists('noir_service_ids')) { return; }
 echo '<p><label>'.esc_html__('Service reference (footer Service links)','noir-studio').' <select name="noir_service_ref['.(int)$item_id.']"><option value="">'.esc_html__('None','noir-studio').'</option>';
 foreach (noir_service_ids() as $id) { echo '<option value="'.esc_attr($id).'" '.selected(get_post_meta($item_id,'_noir_service_ref',true),$id,false).'>'.esc_html($id).'</option>'; }
 echo '</select></label></p>';
},10,2);
add_action('wp_update_nav_menu_item',function($menu_id,$item_id) {
 if (!current_user_can('edit_theme_options') || !function_exists('noir_service_ids') || !isset($_POST['noir_service_ref'][$item_id],$_POST['update-nav-menu-nonce']) || !is_string($_POST['update-nav-menu-nonce']) || !wp_verify_nonce(wp_unslash($_POST['update-nav-menu-nonce']),'update-nav_menu')) { return; }
 $identity = wp_unslash($_POST['noir_service_ref'][$item_id]);
 if (is_string($identity) && ($identity==='' || in_array($identity,noir_service_ids(),true))) { update_post_meta($item_id,'_noir_service_ref',$identity); }
},10,2);
