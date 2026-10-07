<?php
defined('ABSPATH') || exit;
add_action('after_setup_theme',function() {
 load_theme_textdomain('noir-auto-detailing',get_template_directory().'/languages');
 add_theme_support('title-tag');
 add_theme_support('custom-logo',['height'=>32,'width'=>32,'flex-height'=>true,'flex-width'=>true]);
 add_theme_support('post-thumbnails');
 add_theme_support('html5',['search-form','gallery','caption','style','script']);
 register_nav_menus(['primary'=>__('Primary navigation','noir-auto-detailing'),'footer'=>__('Footer navigation','noir-auto-detailing'),'footer_services'=>__('Footer Service links','noir-auto-detailing')]);
});
add_action('wp_enqueue_scripts',function() {
 wp_enqueue_style('noir',get_stylesheet_uri(),[],filemtime(get_stylesheet_directory().'/style.css'));
 wp_enqueue_script('noir-navigation',get_template_directory_uri().'/assets/navigation.js',[],filemtime(get_template_directory().'/assets/navigation.js'),['in_footer'=>true,'strategy'=>'defer']);
});
add_action('admin_notices',function() {
 if (!function_exists('noir_studio_settings') && current_user_can('manage_options')) {
  echo '<div class="notice notice-error"><p>'.esc_html__('NOIR requires the NOIR Studio plugin. Activate it to restore Contact content and shared Studio settings.','noir-auto-detailing').'</p></div>';
 }
});
// Read persisted public facts through Core even when the required plugin is unavailable.
function noir_theme_studio() {
 $settings = get_option('noir_studio',[]);
 if (!is_array($settings)) { return []; }
 foreach (['phone','direct'] as $prefix) {
  $dial = $settings[$prefix.'_dial']??'';
  $label = $settings[$prefix.'_label']??'';
  if (!is_string($dial) || !preg_match('/^\+?[0-9]{7,15}$/D',$dial) || !is_string($label)) {
   unset($settings[$prefix.'_dial'],$settings[$prefix.'_label']);
  }
 }
 if (!isset($settings['email']) || !is_string($settings['email']) || !is_email($settings['email']) || preg_match('/[\r\n]/',$settings['email'])) { unset($settings['email']); }
 return $settings;
}
function noir_theme_page_url($role) {
 $id = noir_theme_studio()['pages'][$role]??0;
 return is_numeric($id) && get_post_type((int)$id)==='page' && get_post_status((int)$id)==='publish' ? get_permalink((int)$id) : '';
}
function noir_theme_destination($value) {
 if (function_exists('noir_destination')) { return noir_destination($value); }
 if (is_numeric($value) && get_post_type((int)$value)==='page' && get_post_status((int)$value)==='publish') { return get_permalink((int)$value); }
 return is_string($value) && filter_var($value,FILTER_VALIDATE_URL) && wp_parse_url($value,PHP_URL_SCHEME)==='https' && !wp_parse_url($value,PHP_URL_USER) && !wp_parse_url($value,PHP_URL_PASS) ? $value : '';
}
function noir_icon($name) {
 $allowed = ['person','menu','verified','call','mail','location_on','verified_user','coffee','shield','info'];
 if (!in_array($name,$allowed,true)) { return; }
 echo '<img class="icon" src="'.esc_url(get_template_directory_uri().'/assets/icons/'.$name.'.svg').'" width="24" height="24" alt="" aria-hidden="true">';
}
function noir_identity() {
 echo '<a class="identity" href="'.esc_url(home_url('/')).'">';
 $id = get_theme_mod('custom_logo');
 if ($id) { echo wp_get_attachment_image($id,'full',false,['class'=>'studio-logo','alt'=>'']); }
 echo '<span>'.esc_html(get_bloginfo('name')).'</span></a>';
}
function noir_appointment_link($class='button') {
 $url = noir_theme_page_url('contact');
 if ($url) { echo '<a class="'.esc_attr($class).'" href="'.esc_url($url.'#appointment-request').'">'.esc_html__('Request Appointment','noir-auto-detailing').'</a>'; }
}
function noir_navigation($location) {
 // Do not silently substitute arbitrary pages or a different native menu.
 if (has_nav_menu($location)) {
  wp_nav_menu(['theme_location'=>$location,'container'=>false,'menu_class'=>'menu','menu_id'=>'','fallback_cb'=>false,'depth'=>1]);
 }
}
function noir_public_contacts($direct=false) {
 $s = noir_theme_studio();
 if (!empty($s['phone_dial']) && !empty($s['phone_label'])) { echo '<a href="'.esc_attr('tel:'.$s['phone_dial']).'">'.esc_html($s['phone_label']).'</a>'; }
 if ($direct && !empty($s['direct_dial'])) { echo '<a class="muted" href="'.esc_attr('tel:'.$s['direct_dial']).'">'.esc_html__('Direct: ','noir-auto-detailing').esc_html($s['direct_label']).'</a>'; }
}
function noir_email_link() {
 $s = noir_theme_studio();
 if (!empty($s['email'])) { echo '<a href="'.esc_attr('mailto:'.$s['email']).'">'.esc_html($s['email']).'</a>'; }
}
function noir_address() {
 foreach (noir_theme_studio()['address']??[] as $line) { echo '<span class="address-line">'.esc_html($line).'</span>'; }
}
function noir_hours() {
 $hours = noir_theme_studio()['hours']??[];
 if (!$hours) { return; }
 $days = ['monday'=>__('Monday','noir-auto-detailing'),'tuesday'=>__('Tuesday','noir-auto-detailing'),'wednesday'=>__('Wednesday','noir-auto-detailing'),'thursday'=>__('Thursday','noir-auto-detailing'),'friday'=>__('Friday','noir-auto-detailing'),'saturday'=>__('Saturday','noir-auto-detailing'),'sunday'=>__('Sunday','noir-auto-detailing')];
 $groups = [];
 foreach ($days as $key=>$label) {
  if (!isset($hours[$key])) { continue; }
  $last = count($groups)-1;
  if ($last>=0 && $groups[$last]['hours']===$hours[$key]) { $groups[$last]['end']=$label; }
  else { $groups[] = ['start'=>$label,'end'=>$label,'hours'=>$hours[$key]]; }
 }
 echo '<dl class="hours">';
 foreach ($groups as $group) {
  $row = $group['hours'];
  $label = $group['start'].($group['end']!==$group['start']?' – '.$group['end']:'');
  $time = !empty($row['closed']) ? __('Closed','noir-auto-detailing') : wp_date('g:i A',strtotime('2000-01-01 '.$row['open'].' UTC'),new DateTimeZone('UTC')).' – '.wp_date('g:i A',strtotime('2000-01-01 '.$row['close'].' UTC'),new DateTimeZone('UTC'));
  echo '<div><dt>'.esc_html($label).'</dt><dd>'.esc_html($time).'</dd></div>';
 }
 echo '</dl>';
}
