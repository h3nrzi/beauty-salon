<?php
defined('ABSPATH') || exit;

function noir_text_schema($min, $max) {
 return ['type'=>'string', 'minLength'=>$min, 'maxLength'=>$max, 'pattern'=>'^[^<>\\x00-\\x08\\x0B\\x0C\\x0E-\\x1F\\x7F]*$'];
}
function noir_object_schema($properties) {
 return ['type'=>'object', 'properties'=>$properties, 'required'=>array_keys($properties), 'additionalProperties'=>false];
}
// Canonical plain-text normalization without silently stripping invalid input.
function noir_normalize_text($value) {
 if (is_string($value)) { return trim(str_replace(["\r\n","\r"],"\n",$value)); }
 if (is_array($value)) { return array_map('noir_normalize_text',$value); }
 return $value;
}
function noir_validate_fields($value, $schema, $name) {
 if (in_array($schema['type'],['array','object'],true) && !is_array($value)) { return new WP_Error('noir_structure',sprintf(__('%s must use structured fields.','noir-studio'),$name)); }
 if ($schema['type']==='array' && array_values($value)!==$value) { return new WP_Error('noir_collection',sprintf(__('%s must be an ordered list.','noir-studio'),$name)); }
 $valid = rest_validate_value_from_schema($value,$schema,$name);
 if (is_string($value) && ($schema['type']==='string' || (is_array($schema['type']) && in_array('string',$schema['type'],true))) && wp_check_invalid_utf8($value)!==$value) { return new WP_Error('noir_encoding',__('Use valid UTF-8 text.','noir-studio')); }
 if (is_wp_error($valid)) { return $valid; }
 // Whitespace-only required strings are not meaningful editorial content.
 if (is_string($value) && !empty($schema['minLength']) && trim($value)==='') {
  return new WP_Error('noir_empty',sprintf(__('%s must contain text.','noir-studio'),$name));
 }
 if ($schema['type']==='object') {
  foreach ($schema['properties'] as $field=>$child) {
   $valid = noir_validate_fields($value[$field],$child,$name.'.'.$field);
   if (is_wp_error($valid)) { return $valid; }
  }
 } elseif ($schema['type']==='array') {
  foreach ($value as $item) {
   $valid = noir_validate_fields($item,$schema['items'],$name);
   if (is_wp_error($valid)) { return $valid; }
  }
 }
 return true;
}
function noir_admin_text_input($name,$label,$value,$max,$multiline=false) {
 $id = 'noir-'.sanitize_html_class($name);
 echo '<p><label for="'.esc_attr($id).'"><strong>'.esc_html($label).'</strong></label><br>';
 if ($multiline) {
  echo '<textarea class="widefat" rows="3" id="'.esc_attr($id).'" name="'.esc_attr($name).'" maxlength="'.(int)$max.'">'.esc_textarea($value).'</textarea>';
 } else {
  echo '<input class="widefat" id="'.esc_attr($id).'" name="'.esc_attr($name).'" value="'.esc_attr($value).'" maxlength="'.(int)$max.'">';
 }
 echo '</p>';
}

// Bounded native fields for the Project/Gallery schemas; no JSON or layout editing.
function noir_editorial_label($key) {
 $labels=[
  'vehicle'=>__('Vehicle','noir-studio'),'finish'=>__('Finish / color','noir-studio'),'work'=>__('Work summary','noir-studio'),
  'facts'=>__('Ordered facts (up to 8)','noir-studio'),'label'=>__('Label','noir-studio'),'value'=>__('Value','noir-studio'),
  'comparison'=>__('Optional comparison','noir-studio'),'before_image'=>__('Before image attachment ID','noir-studio'),'after_image'=>__('After image attachment ID','noir-studio'),
  'before_label'=>__('Before label','noir-studio'),'after_label'=>__('After label','noir-studio'),'memberships'=>__('Gallery memberships (exact values)','noir-studio'),
  'project_id'=>__('Stable Project reference','noir-studio'),'teaser'=>__('Contextual teaser','noir-studio'),'eyebrow'=>__('Eyebrow','noir-studio'),
  'image'=>__('Contextual image attachment ID (0 uses canonical image)','noir-studio'),'heading'=>__('Heading','noir-studio'),'body'=>__('Body','noir-studio'),
  'items'=>__('Items','noir-studio'),'title'=>__('Title','noir-studio'),'intro'=>__('Introduction','noir-studio'),'equipment'=>__('Studio equipment','noir-studio'),'final'=>__('Final CTA','noir-studio'),'placements'=>__('Ordered Project placements','noir-studio'),
 ];
 return $labels[$key]??$key;
}
function noir_editorial_fields($name,$schema,$value,$label) {
 if ($schema['type']==='object') {
  echo '<fieldset><legend><strong>'.esc_html($label).'</strong></legend>';
  foreach ($schema['properties'] as $key=>$child) { noir_editorial_fields($name.'['.$key.']',$child,$value[$key]??null,noir_editorial_label($key)); }
  echo '</fieldset>';
 } elseif ($schema['type']==='array' && isset($schema['items']['enum'])) {
  echo '<fieldset><legend>'.esc_html($label).'</legend>';
  foreach ($schema['items']['enum'] as $option) { echo '<p><label><input type="checkbox" name="'.esc_attr($name).'[]" value="'.esc_attr($option).'" '.checked(in_array($option,(array)$value,true),true,false).'> '.esc_html($option).'</label></p>'; }
  echo '</fieldset>';
 } elseif ($schema['type']==='array') {
  echo '<p>'.esc_html($label).' — '.esc_html__('Order follows row order. Clear a row to remove it.','noir-studio').'</p>';
  for ($i=0;$i<$schema['maxItems'];$i++) {
   echo '<details'.($i<count((array)$value)?' open':'').'><summary>'.esc_html(sprintf(__('Row %d','noir-studio'),$i+1)).'</summary>';
   noir_editorial_fields($name.'['.$i.']',$schema['items'],$value[$i]??[],sprintf(__('Row %d','noir-studio'),$i+1)); echo '</details>';
  }
 } elseif ($schema['type']==='integer') {
  echo '<p><label>'.esc_html($label).' <input type="number" min="0" step="1" name="'.esc_attr($name).'" value="'.esc_attr($value??0).'"></label></p>';
 } else {
  if ($value===null && str_ends_with($name,'[before_label]')) { $value=__('Before','noir-studio'); }
  if ($value===null && str_ends_with($name,'[after_label]')) { $value=__('After','noir-studio'); }
  noir_admin_text_input($name,$label,$value??'',$schema['maxLength']??80,($schema['maxLength']??0)>300);
 }
}
function noir_editorial_row_empty($row) {
 if (!is_array($row)) { return false; }
 foreach ($row as $key=>$value) {
  if (in_array($key,['before_label','after_label'],true)) { continue; }
  if (is_array($value)) { if (!noir_editorial_row_empty($value)) { return false; } }
  elseif (!is_string($value) || (trim($value)!=='' && $value!=='0')) { return false; }
 }
 return true;
}
function noir_editorial_input($value,$schema) {
 if ($schema['type']==='object' && is_array($value)) {
  foreach ($schema['properties'] as $key=>$child) { if (array_key_exists($key,$value)) { $value[$key]=noir_editorial_input($value[$key],$child); } }
 } elseif ($schema['type']==='array' && is_array($value)) {
  // Only native form rows use blank-row removal. Direct metadata still enforces bounds.
  if ($schema['items']['type']==='object') { $value=array_values(array_filter($value,function($row) { return !noir_editorial_row_empty($row); })); }
  foreach ($value as &$row) { $row=noir_editorial_input($row,$schema['items']); } unset($row);
 } elseif ($schema['type']==='integer' && is_string($value) && preg_match('/^[0-9]{1,10}$/D',$value)) { $value=(int)$value; }
 return noir_normalize_text($value);
}
