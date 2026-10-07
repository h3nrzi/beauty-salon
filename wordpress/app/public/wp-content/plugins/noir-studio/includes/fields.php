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
 $valid = rest_validate_value_from_schema($value,$schema,$name);
 if ($schema['type']==='string' && is_string($value) && wp_check_invalid_utf8($value)!==$value) { return new WP_Error('noir_encoding',__('Use valid UTF-8 text.','noir-studio')); }
 if (is_wp_error($valid)) { return $valid; }
 // Whitespace-only required strings are not meaningful editorial content.
 if ($schema['type']==='string' && !empty($schema['minLength']) && trim($value)==='') {
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
