<?php
defined('ABSPATH') || exit;
if (!function_exists('noir_appointment_view')) { get_template_part('template-parts/appointment-unavailable'); return; }

// The theme owns normal form/status presentation from the public plugin view model.
$view = noir_appointment_view();
if (!empty($view['accepted'])) {
 echo '<div class="request-status" role="status"><p>'.esc_html($view['accepted_message']).'</p></div>';
 return;
}
$errors = $view['errors']??[];
if ($errors || !empty($view['message'])) {
 echo '<div class="request-errors" id="request-errors" tabindex="-1" aria-labelledby="request-errors-heading"><h3 id="request-errors-heading">'.esc_html($errors ? __('Please correct your Appointment Request','noir-auto-detailing') : __('Appointment Request could not be completed','noir-auto-detailing')).'</h3>';
 if (!empty($view['message'])) { echo '<p>'.esc_html($view['message']).'</p>'; }
 if ($errors) {
  echo '<ul>';
  foreach ($errors as $key=>$error) { echo '<li><a href="#request-'.esc_attr($key).'">'.esc_html($error).'</a></li>'; }
  echo '</ul>';
 }
 echo '</div>';
}
if (!empty($view['token'])) {
 echo '<form method="post" action="'.esc_url($view['endpoint']).'" class="appointment-form">';
 foreach (['action'=>'noir_appointment_request','submission_token'=>$view['token'],'_noir_nonce'=>$view['nonce']] as $key=>$value) { echo '<input type="hidden" name="'.esc_attr($key).'" value="'.esc_attr($value).'">'; }
 echo '<div hidden aria-hidden="true"><label>'.esc_html__('Website','noir-auto-detailing').' <input name="website" tabindex="-1" autocomplete="off" value=""></label></div>';
 $choices = $view['choices'];
 foreach ($view['fields'] as $key=>$field) {
  if ($key==='name') { echo '<div class="field-pair">'; }
  $value = $view['values'][$key]??'';
  $id = 'request-'.$key;
  $attributes = ' id="'.esc_attr($id).'" name="'.esc_attr($key).'"'.($field['required']?' required':'').' aria-invalid="'.(isset($errors[$key])?'true':'false').'"';
  if (isset($errors[$key]) && $key!=='preferred_date') { $attributes.=' aria-describedby="'.esc_attr($id).'-error"'; }
  if ($key==='service_id') {
   echo '<fieldset class="service-choices" id="request-service_id"'.(isset($errors[$key])?' aria-invalid="true" aria-describedby="request-service_id-error"':'').'><legend>'.esc_html__('Service of Interest *','noir-auto-detailing').'</legend><div class="service-grid">';
   foreach ($choices as $choice) {
    echo '<label><input class="screen-reader-text" type="radio" name="service_id" required value="'.esc_attr($choice['service_id']).'" '.checked($value,$choice['service_id'],false).(isset($errors[$key])?' aria-invalid="true" aria-describedby="request-service_id-error"':'').'><span>'.esc_html($choice['title']).'</span></label>';
   }
   echo '</div>';
  } else {
   echo '<div class="field"><label for="'.esc_attr($id).'">'.esc_html($field['label'].($field['required']?' *':__(' (Optional)','noir-auto-detailing'))).'</label>';
   if ($field['input_type']==='textarea') { echo '<textarea'.$attributes.' rows="4" maxlength="2000">'.esc_textarea($value).'</textarea>'; }
   else {
    echo '<input'.$attributes.' type="'.esc_attr($field['input_type']).'" maxlength="'.esc_attr($field['max_length']).'" value="'.esc_attr($value).'"'.($field['autocomplete']?' autocomplete="'.esc_attr($field['autocomplete']).'"':'').($key==='preferred_date'?' min="'.esc_attr($view['today']).'" aria-describedby="request-date-help'.(isset($errors[$key])?' request-preferred_date-error':'').'"':'').'>';
   }
   if ($key==='preferred_date') { echo '<p id="request-date-help" class="muted">'.esc_html__('Interpreted in the Studio timezone. This date does not reserve availability.','noir-auto-detailing').'</p>'; }
  }
  if (isset($errors[$key])) { echo '<p class="field-error" id="'.esc_attr($id).'-error">'.esc_html($errors[$key]).'</p>'; }
  echo $key==='service_id' ? '</fieldset>' : '</div>';
  if ($key==='phone') { echo '</div>'; }
 }
 echo '<p class="muted">'.esc_html__('An Appointment Request does not confirm an appointment. The Studio will contact you within 1 business day to discuss availability and recommendations.','noir-auto-detailing').'</p><button class="button" type="submit">'.esc_html__('Request Appointment','noir-auto-detailing').'</button></form>';
}
if (!empty($view['message']) || empty($view['token'])) {
 $s=$view['contacts'];
 echo '<p class="request-fallback">'.esc_html__('Contact the Studio directly: ','noir-auto-detailing');
 if (!empty($s['phone_dial'])) { echo '<a href="'.esc_attr('tel:'.$s['phone_dial']).'">'.esc_html($s['phone_label']).'</a> '; }
 if (!empty($s['email'])) { echo '<a href="'.esc_attr('mailto:'.$s['email']).'">'.esc_html($s['email']).'</a>'; }
 echo '</p>';
}
