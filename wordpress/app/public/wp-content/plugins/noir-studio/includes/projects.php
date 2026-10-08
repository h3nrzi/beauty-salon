<?php
// Canonical completed work, deliberately without independent public routes.
defined('ABSPATH') || exit;
function noir_gallery_filters() {
 return ['all'=>__('All Projects','noir-studio'),'paint-correction'=>__('Paint Correction','noir-studio'),'ceramic'=>__('Ceramic Coating','noir-studio'),'full-detail'=>__('Full Detail','noir-studio'),'exotic'=>__('Exotics & Supercars','noir-studio'),'vintage'=>__('Classics','noir-studio')];
}
function noir_project_comparison_schema() {
 return noir_object_schema(['before_image'=>['type'=>'integer','minimum'=>0],'after_image'=>['type'=>'integer','minimum'=>0],'before_label'=>noir_text_schema(1,80),'after_label'=>noir_text_schema(1,80)]);
}
function noir_project_schema() {
 return noir_object_schema([
  'vehicle'=>noir_text_schema(1,160),'finish'=>noir_text_schema(0,100),'work'=>noir_text_schema(1,1000),
  'facts'=>['type'=>'array','maxItems'=>8,'items'=>noir_object_schema(['label'=>noir_text_schema(1,60),'value'=>noir_text_schema(1,180)])],
  'comparison'=>noir_project_comparison_schema(),
  'memberships'=>['type'=>'array','maxItems'=>6,'uniqueItems'=>true,'items'=>['type'=>'string','enum'=>['paint-correction','ceramic','full-detail','exotic','vintage','restoration']]],
 ]);
}
function noir_project_editor($post_id) { return current_user_can('edit_post',$post_id) && current_user_can('edit_noir_projects'); }
add_action('init',function() {
 $type=register_post_type('noir_project',[
  'labels'=>['name'=>__('Projects','noir-studio'),'singular_name'=>__('Project','noir-studio')],
  'public'=>false,'publicly_queryable'=>false,'exclude_from_search'=>true,'show_ui'=>true,'show_in_nav_menus'=>false,
  'has_archive'=>false,'rewrite'=>false,'query_var'=>false,'show_in_rest'=>false,
  'capability_type'=>['noir_project','noir_projects'],'map_meta_cap'=>true,'supports'=>['title','thumbnail','revisions','custom-fields'],
 ]);
 foreach (['administrator','editor'] as $name) {
  $role=get_role($name); if (!$role) { continue; }
  foreach ($type->cap as $cap) {
   if ($cap!=='read' && !in_array($cap,['edit_noir_project','read_noir_project','delete_noir_project'],true) && !$role->has_cap($cap)) { $role->add_cap($cap); }
  }
 }
 foreach (['_noir_project_id'=>'string','_noir_project_facts'=>'object','_thumbnail_id'=>'integer'] as $key=>$type) {
  register_post_meta('noir_project',$key,['type'=>$type,'single'=>true,'show_in_rest'=>false,'revisions_enabled'=>$key!=='_noir_project_id','sanitize_callback'=>$type==='integer'?'absint':'noir_normalize_text','auth_callback'=>function($allowed,$key,$post_id) { return noir_project_editor($post_id); }]);
 }
});
function noir_project_identity_valid($post_id,$value) {
 if (!is_string($value) || !preg_match('/^[a-z0-9][a-z0-9-]{0,79}$/D',$value)) { return false; }
 $previous=get_post_meta($post_id,'_noir_project_id',true);
 if ($previous!=='' && $previous!==$value) { return false; }
 return !get_posts(['post_type'=>'noir_project','post_status'=>array_keys(get_post_stati()),'posts_per_page'=>1,'fields'=>'ids','post__not_in'=>[$post_id],'meta_key'=>'_noir_project_id','meta_value'=>$value]);
}
function noir_validate_project_comparison($pair) {
 foreach (['before_image','after_image'] as $key) {
  if (!is_int($pair[$key]) || ($pair[$key]!==0 && !noir_image_valid($pair[$key]))) { return new WP_Error('noir_project_image',__('Use an image attachment ID, or 0 for no comparison.','noir-studio')); }
 }
 if ((bool)$pair['before_image']!==(bool)$pair['after_image']) { return new WP_Error('noir_project_pair',__('Supply both labelled comparison images, or set both IDs to 0.','noir-studio')); }
 return true;
}
function noir_validate_project_facts($facts) {
 $valid=noir_validate_fields($facts,noir_project_schema(),'Project');
 return is_wp_error($valid) ? $valid : noir_validate_project_comparison($facts['comparison']);
}
function noir_guard_project_meta($check,$post_id,$key,$value) {
 $post=get_post($post_id);
 if (!$post || ($post->post_type!=='noir_project' && !($post->post_type==='revision' && get_post_type($post->post_parent)==='noir_project'))) { return $check; }
 if ($key==='_noir_project_id') { $valid=$post->post_type!=='revision' && noir_project_identity_valid($post_id,$value); }
 elseif ($key==='_noir_project_facts') { $valid=noir_validate_project_facts(noir_normalize_text($value)); }
 elseif ($key==='_thumbnail_id') { $valid=noir_image_valid(is_numeric($value)?(int)$value:0); }
 else { return $check; }
 if ($valid===false || is_wp_error($valid)) { noir_contact_error((is_wp_error($valid)?$valid->get_error_message():__('Use a unique immutable Project identity and an image attachment.','noir-studio')).' '.__('Previous content was kept.','noir-studio')); return false; }
 return $check;
}
add_filter('add_post_metadata','noir_guard_project_meta',10,4);
add_filter('update_post_metadata','noir_guard_project_meta',10,4);
add_filter('delete_post_metadata',function($check,$post_id,$key) { return get_post_type($post_id)==='noir_project' && $key==='_noir_project_id' ? false : $check; },10,3);
function noir_project_save_allowed($post_id) {
 return !wp_is_post_revision($post_id) && !wp_is_post_autosave($post_id) && !(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) && noir_project_editor($post_id) && isset($_POST['noir_project_nonce']) && is_string($_POST['noir_project_nonce']) && wp_verify_nonce(wp_unslash($_POST['noir_project_nonce']),'noir_project_save');
}
function noir_project_posted_facts() {
 $raw=isset($_POST['noir_project'])?wp_unslash($_POST['noir_project']):null;
 if (!is_array($raw)) { return new WP_Error('noir_project_fields',__('Use the fixed Project fields.','noir-studio')); }
 // An unchecked membership group is an intentionally empty list.
 if (!isset($raw['memberships'])) { $raw['memberships']=[]; }
 $facts=noir_editorial_input($raw,noir_project_schema());
 $valid=noir_validate_project_facts($facts);
 return is_wp_error($valid)?$valid:$facts;
}
add_filter('wp_insert_post_data',function($data,$postarr) {
 if ($data['post_type']!=='noir_project' || $data['post_status']==='auto-draft') { return $data; }
 $id=(int)($postarr['ID']??0);
 $valid=noir_validate_fields(wp_unslash($data['post_title']),noir_text_schema(1,120),'Project title');
 if (isset($_POST['noir_project_nonce'])) {
  $facts=noir_project_posted_facts();
  if (!noir_project_save_allowed($id) || is_wp_error($facts)) { $valid=is_wp_error($facts)?$facts:new WP_Error('noir_project_permission',__('Check your Project editing permission and nonce.','noir-studio')); }
 }
 if (is_wp_error($valid)) {
  $GLOBALS['noir_project_rejected'][$id]=true; noir_contact_error($valid->get_error_message().' '.__('Previous content was kept.','noir-studio'));
  $previous=get_post($id);
  foreach (['post_title','post_status','post_name'] as $key) { $data[$key]=$previous?wp_slash($previous->$key):($key==='post_status'?'draft':''); }
 }
 return $data;
},10,2);
add_action('save_post_noir_project',function($post_id) {
 if (!empty($GLOBALS['noir_project_rejected'][$post_id])) { unset($GLOBALS['noir_project_rejected'][$post_id]); return; }
 if (!noir_project_save_allowed($post_id)) { return; }
 $facts=noir_project_posted_facts(); if (is_wp_error($facts)) { return; }
 if (!get_post_meta($post_id,'_noir_project_id',true)) { update_post_meta($post_id,'_noir_project_id','project-'.wp_generate_uuid4()); }
 update_post_meta($post_id,'_noir_project_facts',wp_slash($facts)); wp_save_post_revision($post_id);
});
add_action('add_meta_boxes_noir_project',function() { add_meta_box('noir-project',__('Canonical Project facts','noir-studio'),'noir_project_box','noir_project','normal','high'); });
function noir_project_box($post) {
 wp_nonce_field('noir_project_save','noir_project_nonce');
 echo '<p>'.esc_html__('Set the primary photograph with Featured image. New Projects receive a permanent identity on save. Comparison pairs require both images; 0 omits them.','noir-studio').'</p><p>'.esc_html__('Stable identity: ','noir-studio').esc_html(get_post_meta($post->ID,'_noir_project_id',true)).'</p>';
 noir_editorial_fields('noir_project',noir_project_schema(),get_post_meta($post->ID,'_noir_project_facts',true),__('Facts','noir-studio'));
}
function noir_projects() {
 $records=[];
 foreach (get_posts(['post_type'=>'noir_project','post_status'=>'publish','posts_per_page'=>-1,'orderby'=>'ID','order'=>'ASC']) as $post) {
  $id=get_post_meta($post->ID,'_noir_project_id',true); $facts=get_post_meta($post->ID,'_noir_project_facts',true); $image=(int)get_post_thumbnail_id($post);
  if (!noir_project_identity_valid($post->ID,$id) || is_wp_error(noir_validate_fields($post->post_title,noir_text_schema(1,120),'Project title')) || is_wp_error(noir_validate_fields($facts,noir_project_schema(),'Project')) || !noir_image_valid($image)) { continue; }
  // Missing optional media at read time degrades to the surviving labelled figure.
  foreach (['before_image','after_image'] as $key) { if (!noir_image_valid($facts['comparison'][$key])) { $facts['comparison'][$key]=0; } }
  $records[$id]=$facts+['project_id'=>$id,'post_id'=>$post->ID,'title'=>$post->post_title,'image'=>$image];
 }
 return $records;
}
function noir_project_link($identity) {
 $page=noir_studio_settings()['pages']['gallery']??0;
 if (!noir_published_page($page)) { return ''; }
 foreach (noir_project_placements($page,'gallery') as $placement) { if ($placement['project_id']===$identity) { return get_permalink($page).'#project-'.$identity; } }
 return get_permalink($page);
}
