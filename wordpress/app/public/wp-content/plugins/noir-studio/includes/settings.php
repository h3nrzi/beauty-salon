<?php
defined('ABSPATH') || exit;

function noir_studio_settings() { return (array)get_option('noir_studio',[]); }
function noir_studio_fields() {
 return [
  'description'=>['Studio description',1,500],
  'phone_label'=>['Public phone label',1,60], 'phone_dial'=>['Public phone dial string',7,16],
  'direct_label'=>['Direct phone label (optional)',0,60], 'direct_dial'=>['Direct phone dial string (optional)',0,16],
  'email'=>['Public email',1,254], 'timezone'=>['IANA Studio timezone',1,100],
  'status'=>['Studio status (optional)',0,80], 'directions'=>['Directions HTTPS URL (optional)',0,2048],
 ];
}
function noir_studio_error($message) { return new WP_Error('noir_studio_invalid',$message); }
function noir_validate_studio($input) {
 if (!is_array($input)) { return noir_studio_error(__('Settings must be structured fields.','noir-studio')); }
 $allowed = array_merge(array_keys(noir_studio_fields()),['address','hours','pages','privacy','terms']);
 if (array_diff(array_keys($input),$allowed)) { return noir_studio_error(__('Remove unknown Studio settings.','noir-studio')); }
 $clean = [];
 foreach (noir_studio_fields() as $key=>$field) {
  if (!isset($input[$key]) || !is_string($input[$key])) { return noir_studio_error($field[0].': '.__('enter a text value.','noir-studio')); }
  $text = trim($input[$key]);
  $valid = noir_validate_contact($text,noir_text_schema($field[1],$field[2]),$field[0]);
  if (is_wp_error($valid)) { return $valid; }
  $clean[$key] = $text;
 }
 foreach (['phone_dial','direct_dial'] as $key) {
  if ($key==='direct_dial' && $clean[$key]==='' && $clean['direct_label']==='') { continue; }
  if (!preg_match('/^\+?[0-9]{7,15}$/D',$clean[$key])) { return noir_studio_error($key.': '.__('use 7–15 digits with an optional leading +.','noir-studio')); }
 }
 if (($clean['direct_label']==='') !== ($clean['direct_dial']==='')) { return noir_studio_error(__('Supply both direct phone label and dial string, or leave both empty.','noir-studio')); }
 if (!is_email($clean['email']) || preg_match('/[\r\n]/',$clean['email'])) { return noir_studio_error(__('Enter a valid public email address.','noir-studio')); }
 if (!in_array($clean['timezone'],DateTimeZone::listIdentifiers(),true)) { return noir_studio_error(__('Choose a valid IANA timezone, such as America/Los_Angeles.','noir-studio')); }
 if ($clean['directions']!=='' && !noir_https_destination($clean['directions'])) { return noir_studio_error(__('Directions must be an explicit valid HTTPS URL.','noir-studio')); }
 if (!isset($input['address']) || !is_array($input['address']) || count($input['address'])>4) { return noir_studio_error(__('Address accepts one to four text lines.','noir-studio')); }
 $clean['address'] = [];
 foreach ($input['address'] as $line) {
  if (!is_string($line)) { return noir_studio_error(__('Address lines must be text.','noir-studio')); }
  $line = trim($line);
  if ($line==='') { continue; }
  $valid = noir_validate_contact($line,noir_text_schema(1,200),'Address');
  if (is_wp_error($valid)) { return $valid; }
  $clean['address'][] = $line;
 }
 if (!$clean['address']) { return noir_studio_error(__('Supply at least one address line.','noir-studio')); }
 $days = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
 if (!isset($input['hours']) || !is_array($input['hours']) || array_diff(array_keys($input['hours']),$days)) { return noir_studio_error(__('Supply hours for all seven days only.','noir-studio')); }
 foreach ($days as $day) {
  $row = $input['hours'][$day] ?? null;
  if (!is_array($row) || array_diff(array_keys($row),['closed','open','close'])) { return noir_studio_error($day.': '.__('supply closed or an opening/closing pair.','noir-studio')); }
  $closed = $row['closed'] ?? false;
  if (!in_array($closed,[false,true,'0','1',0,1],true)) { return noir_studio_error($day.': '.__('closed must be a checkbox value.','noir-studio')); }
  if ($closed) { $clean['hours'][$day] = ['closed'=>true]; continue; }
  foreach (['open','close'] as $key) {
   if (!isset($row[$key]) || !is_string($row[$key]) || !preg_match('/^(?:[01][0-9]|2[0-3]):[0-5][0-9]$/D',$row[$key])) { return noir_studio_error($day.': '.__('use HH:MM times in 24-hour format.','noir-studio')); }
  }
  if ($row['close']<=$row['open']) { return noir_studio_error($day.': '.__('closing time must be later than opening time.','noir-studio')); }
  $clean['hours'][$day] = ['closed'=>false,'open'=>$row['open'],'close'=>$row['close']];
 }
 if (!isset($input['pages']) || !is_array($input['pages']) || array_diff(array_keys($input['pages']),['home','services','gallery','contact'])) { return noir_studio_error(__('Use only the four native product page roles.','noir-studio')); }
 foreach (['home','services','gallery','contact'] as $role) {
  $id = $input['pages'][$role] ?? 0;
  if (!noir_published_page($id)) { return noir_studio_error($role.': '.__('choose a published native page.','noir-studio')); }
  $clean['pages'][$role] = (int)$id;
 }
 if (count(array_unique($clean['pages']))!==4) { return noir_studio_error(__('Assign a different published page to each role.','noir-studio')); }
 if (get_page_template_slug($clean['pages']['contact'])!=='page-contact.php') { return noir_studio_error(__('Assign the Contact / Appointment Request template to the Contact page first.','noir-studio')); }
 foreach (['privacy','terms'] as $key) {
  $value = $input[$key] ?? '';
  if (!is_string($value) && !is_int($value)) { return noir_studio_error($key.': '.__('enter a page ID or HTTPS URL.','noir-studio')); }
  $value = trim((string)$value);
  // Incomplete development setup is allowed but visibly reported; never fabricate legal content.
  if ($value!=='' && !noir_published_page($value) && !noir_https_destination($value)) { return noir_studio_error($key.': '.__('enter a published page ID or valid HTTPS URL.','noir-studio')); }
  $clean[$key] = $value;
 }
 return $clean;
}
function noir_https_destination($url) {
 return is_string($url) && strlen($url)<=2048 && !preg_match('/[\x00-\x20\x7f]/',$url) && filter_var($url,FILTER_VALIDATE_URL) && wp_parse_url($url,PHP_URL_SCHEME)==='https' && !wp_parse_url($url,PHP_URL_USER) && !wp_parse_url($url,PHP_URL_PASS);
}
function noir_published_page($id) {
 return (is_int($id) || (is_string($id) && ctype_digit($id))) && (int)$id>0 && get_post_type((int)$id)==='page' && get_post_status((int)$id)==='publish';
}
function noir_destination($value) {
 if (noir_published_page($value)) { return get_permalink((int)$value); }
 return noir_https_destination($value) ? $value : '';
}
function noir_page_url($role) {
 $settings = noir_studio_settings();
 $id = $settings['pages'][$role] ?? 0;
 return noir_published_page($id) ? get_permalink($id) : '';
}
add_action('admin_init',function() {
 register_setting('noir_studio','noir_studio',['type'=>'object','show_in_rest'=>false,'sanitize_callback'=>function($input) {
  if (!current_user_can('manage_options')) { return noir_studio_settings(); }
  $valid = noir_validate_studio($input);
  if (is_wp_error($valid)) {
   add_settings_error('noir_studio','noir_invalid',$valid->get_error_message().' '.__('Previous Studio settings were kept.','noir-studio'));
   return noir_studio_settings();
  }
  return $valid;
 }]);
});
// Also guard direct native option writes; Settings API is not loaded on every route.
add_filter('pre_update_option_noir_studio',function($value,$old) {
 if (!current_user_can('manage_options')) { return $old; }
 return is_wp_error(noir_validate_studio($value)) ? $old : noir_validate_studio($value);
},10,2);
add_action('admin_menu',function() {
 add_options_page(__('Studio settings','noir-studio'),__('Studio settings','noir-studio'),'manage_options','noir-studio','noir_settings_screen');
});
function noir_settings_screen() {
 if (!current_user_can('manage_options')) { return; }
 $settings = noir_studio_settings();
 echo '<div class="wrap"><h1>'.esc_html__('Studio settings','noir-studio').'</h1>';
 settings_errors('noir_studio');
 echo '<p>'.esc_html__('Shared facts are maintained here only. Site identity and navigation remain under native WordPress settings and menus. Legal destinations and directions must be supplied explicitly before acceptance.','noir-studio').'</p><form method="post" action="options.php">';
 settings_fields('noir_studio');
 foreach (noir_studio_fields() as $key=>$field) { noir_contact_input("noir_studio[$key]",$field[0],$settings[$key]??'',$field[2],$key==='description'); }
 for ($i=0;$i<4;$i++) { noir_contact_input("noir_studio[address][$i]",sprintf(__('Address line %d','noir-studio'),$i+1),$settings['address'][$i]??'',200); }
 echo '<h2>'.esc_html__('Opening hours (Studio timezone)','noir-studio').'</h2>';
 foreach (['monday','tuesday','wednesday','thursday','friday','saturday','sunday'] as $day) {
  $row = $settings['hours'][$day]??[];
  echo '<fieldset><legend>'.esc_html(ucfirst($day)).'</legend><label><input type="checkbox" name="noir_studio[hours]['.esc_attr($day).'][closed]" value="1" '.checked($row['closed']??false,true,false).'>'.esc_html__('Closed','noir-studio').'</label> ';
  foreach (['open','close'] as $key) {
   echo '<label>'.esc_html(ucfirst($key)).' <input type="time" name="noir_studio[hours]['.esc_attr($day).']['.esc_attr($key).']" value="'.esc_attr($row[$key]??'').'"></label> ';
  }
  echo '</fieldset>';
 }
 echo '<h2>'.esc_html__('Native page assignments','noir-studio').'</h2>';
 foreach (['home','services','gallery','contact'] as $role) {
  echo '<p><label>'.esc_html(ucfirst($role)).' ';
  wp_dropdown_pages(['name'=>"noir_studio[pages][$role]",'selected'=>$settings['pages'][$role]??0,'show_option_none'=>__('Choose published page','noir-studio'),'post_status'=>'publish']);
  echo '</label></p>';
 }
 foreach (['privacy','terms'] as $key) { noir_contact_input("noir_studio[$key]",ucfirst($key).' — published page ID or HTTPS URL',$settings[$key]??'',2048); }
 submit_button();
 echo '</form></div>';
}
add_action('admin_notices',function() {
 if (!current_user_can('manage_options')) { return; }
 $settings = noir_studio_settings();
 $missing = [];
 if (!$settings) { $missing[] = __('Studio settings','noir-studio'); }
 foreach (['privacy','terms','directions'] as $key) {
  if (empty($settings[$key]) || !noir_destination($settings[$key])) { $missing[] = $key; }
 }
 if ($missing) { echo '<div class="notice notice-warning"><p>'.esc_html__('NOIR setup incomplete. Configure before acceptance: ','noir-studio').esc_html(implode(', ',$missing)).' <a href="'.esc_url(admin_url('options-general.php?page=noir-studio')).'">'.esc_html__('Studio settings','noir-studio').'</a></p></div>'; }
});
