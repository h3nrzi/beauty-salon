<?php
/** Project-owned Appointment Request HTTP boundary. Customer values live only in this response. */
defined('ABSPATH') || exit;

function noir_request_digest($scope,$value) {
 return hash_hmac('sha256',$scope.'|'.$value,wp_salt('auth'));
}
function noir_request_cookie($name,$value,$expires) {
 return setcookie($name,$value,['expires'=>$expires,'path'=>COOKIEPATH ?: '/','secure'=>is_ssl(),'httponly'=>true,'samesite'=>'Lax']);
}
function noir_request_signed($scope,$payload) { return $payload.'.'.noir_request_digest($scope,$payload); }
function noir_request_verified($scope,$cookie) {
 if (!is_string($cookie) || strlen($cookie)>256) { return ''; }
 $parts = explode('.',$cookie);
 $signature = array_pop($parts);
 $payload = implode('.',$parts);
 return hash_equals(noir_request_digest($scope,$payload),$signature) ? $payload : '';
}
function noir_request_visitor() {
 $payload = noir_request_verified('visitor',$_COOKIE['noir_visitor']??'');
 if (!preg_match('/^([a-f0-9]{32})\.([0-9]{10})$/D',$payload,$match) || (int)$match[2]<=time()) { return ''; }
 return noir_request_digest('visitor-binding',$match[1]);
}
function noir_request_nonce_action($token) { return 'noir_appointment_request:'.$token; }
add_filter('nonce_user_logged_out',function($uid,$action) {
 return is_string($action) && preg_match('/^noir_appointment_request:[a-f0-9]{64}$/D',$action) ? noir_request_visitor() : $uid;
},10,2);
function noir_request_uncached() {
 if (!defined('DONOTCACHEPAGE')) { define('DONOTCACHEPAGE',true); }
 nocache_headers();
 header('Cache-Control: no-store, private, max-age=0');
}
function noir_request_state($token) {
 if (!is_string($token) || !preg_match('/^[a-f0-9]{64}$/D',$token)) { return false; }
 return get_transient('noir_request_'.noir_request_digest('token',$token));
}
function noir_request_today($timestamp=null) {
 $zone = noir_studio_settings()['timezone']??'America/Los_Angeles';
 if (!in_array($zone,DateTimeZone::listIdentifiers(),true)) { $zone='America/Los_Angeles'; }
 return wp_date('Y-m-d',$timestamp,new DateTimeZone($zone));
}
function noir_request_fields() {
 return [
  'name'=>['label'=>__('Full Name','noir-studio'),'max_length'=>100,'input_type'=>'text','autocomplete'=>'name','required'=>true],
  'phone'=>['label'=>__('Phone Number','noir-studio'),'max_length'=>40,'input_type'=>'tel','autocomplete'=>'tel','required'=>true],
  'email'=>['label'=>__('Email Address','noir-studio'),'max_length'=>254,'input_type'=>'email','autocomplete'=>'email','required'=>false],
  'vehicle'=>['label'=>__('Vehicle Make & Model','noir-studio'),'max_length'=>160,'input_type'=>'text','autocomplete'=>'','required'=>true],
  'service_id'=>['label'=>__('Service of Interest','noir-studio'),'max_length'=>80,'input_type'=>'radio','autocomplete'=>'','required'=>true],
  'preferred_date'=>['label'=>__('Preferred Date','noir-studio'),'max_length'=>10,'input_type'=>'date','autocomplete'=>'','required'=>false],
  'notes'=>['label'=>__('Message / Notes','noir-studio'),'max_length'=>2000,'input_type'=>'textarea','autocomplete'=>'','required'=>false],
 ];
}
function noir_appointment_view() {
 return array_merge(['fields'=>noir_request_fields(),'choices'=>noir_services(),'endpoint'=>admin_url('admin-post.php'),'today'=>noir_request_today(),'accepted_message'=>noir_appointment_accepted_message(),'contacts'=>noir_studio_settings(),'values'=>[],'errors'=>[]],$GLOBALS['noir_appointment_view']??['message'=>__('Online requests are unavailable. Please contact the Studio directly.','noir-studio')]);
}
function noir_request_issue() {
 if (!noir_request_visitor()) {
  $cookie = noir_request_signed('visitor',bin2hex(random_bytes(16)).'.'.(time()+7200));
  if (!noir_request_cookie('noir_visitor',$cookie,time()+7200)) { return false; }
  $_COOKIE['noir_visitor']=$cookie;
 }
 $token = bin2hex(random_bytes(32));
 $state = ['visitor'=>noir_request_visitor(),'user'=>get_current_user_id(),'expires'=>time()+3600,'status'=>'issued'];
 if (!set_transient('noir_request_'.noir_request_digest('token',$token),$state,7200)) { return false; }
 wp_schedule_single_event(time()+7200,'noir_request_cleanup',[noir_request_digest('token',$token)]);
 $interest=isset($_GET['service']) && is_string($_GET['service']) ? wp_unslash($_GET['service']) : '';
 $choices=noir_services();
 $selected=noir_service($interest) ? $interest : ($choices[0]['service_id']??'');
 return ['token'=>$token,'nonce'=>wp_create_nonce(noir_request_nonce_action($token)),'values'=>['service_id'=>$selected],'errors'=>[],'message'=>''];
}
function noir_request_receipt_valid() {
 $payload = noir_request_verified('receipt',$_COOKIE['noir_receipt']??'');
 if (!preg_match('/^([a-f0-9]{64})\.([0-9]{10})$/D',$payload,$parts) || (int)$parts[2]<=time()) { return false; }
 $state = get_transient('noir_request_'.$parts[1]);
 return is_array($state) && ($state['status']??'')==='accepted' && hash_equals($state['visitor'],noir_request_visitor()) && $state['user']===get_current_user_id();
}
add_action('template_redirect',function() {
 if (get_queried_object_id()!==(int)(noir_studio_settings()['pages']['contact']??0)) { return; }
 noir_request_uncached();
 if (isset($_GET['status']) && $_GET['status']==='sent' && noir_request_receipt_valid()) {
  $GLOBALS['noir_appointment_view']=['accepted'=>true];
 } else {
  $GLOBALS['noir_appointment_view']=noir_request_issue() ?: ['values'=>[],'errors'=>[],'message'=>__('Online requests are unavailable. Please contact the Studio directly.','noir-studio')];
 }
});

/** Unslashed input and an optional Studio-local clock date; focused policy seam. */
function noir_validate_appointment($input,$today=null) {
 $values=[]; $errors=[];
 foreach (noir_request_fields() as $key=>$field) {
  $raw=$input[$key]??'';
  if (!is_string($raw)) { $errors[$key]=sprintf(__('%s: enter a single text value.','noir-studio'),$field['label']); continue; }
  if (!preg_match('//u',$raw)) { return ['values'=>[],'errors'=>[],'malformed'=>true]; }
  // Email header injection is rejected before whitespace normalization.
  $bad_email=$key==='email' && preg_match('/[\r\n]/',$raw);
  $text=$key==='notes' ? str_replace(["\r\n","\r"],"\n",$raw) : $raw;
  $text=in_array($key,['preferred_date','service_id'],true) ? $text : trim($text);
  preg_match_all('/./us',$text,$characters);
  $length=count($characters[0]);
  $controls=$key==='notes' ? '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F-\x9F]/u' : '/\p{Cc}/u';
  if ($length>$field['max_length'] || preg_match($controls,$key==='notes' ? $text : $raw) || $bad_email) {
   $errors[$key]=sprintf(__('%1$s: use valid text within %2$d characters.','noir-studio'),$field['label'],$field['max_length']);
   continue;
  }
  $clean=$key==='notes' ? sanitize_textarea_field($text) : sanitize_text_field($text);
  $values[$key]=$clean;
  if ($field['required'] && $clean==='') { $errors[$key]=sprintf(__('%s is required.','noir-studio'),$field['label']); continue; }
  if ($key==='phone' && (!preg_match('/^[0-9 ()+.\-]{7,40}$/D',$text) || strlen(preg_replace('/[^0-9]/','',$text))<7 || strlen(preg_replace('/[^0-9]/','',$text))>15)) {
   $errors[$key]=__('Phone Number: use 7–15 digits with spaces, parentheses, plus, hyphen or period.','noir-studio');
  }
  if ($key==='email' && $text!=='' && (!is_email($text) || $clean!==$text)) { $errors[$key]=__('Email Address: enter a valid email without line breaks.','noir-studio'); $values[$key]=''; }
  if ($key==='service_id' && !noir_service($text)) { $errors[$key]=__('Service of Interest: choose a currently available Service.','noir-studio'); $values[$key]=''; }
  if ($key==='preferred_date' && $text!=='') {
   $date=DateTimeImmutable::createFromFormat('!Y-m-d',$text,new DateTimeZone('UTC'));
   if (!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/D',$text) || !$date || $date->format('Y-m-d')!==$text || $text<($today??noir_request_today())) {
    $errors[$key]=__('Preferred Date: choose a real date today or later in the Studio timezone.','noir-studio');
   }
  }
 }
 return ['values'=>$values,'errors'=>$errors];
}
function noir_request_response($code,$view) {
 noir_request_uncached();
 status_header($code);
 // admin-post boots WP_ADMIN without an editing screen. Its toolbar is inappropriate
 // for this public response and would access a missing screen in Core.
 remove_action('wp_body_open','wp_admin_bar_render',0);
 remove_action('wp_footer','wp_admin_bar_render',1000);
 remove_action('wp_head','wp_admin_bar_header');
 remove_action('wp_head','_admin_bar_bump_cb');
 wp_dequeue_style('admin-bar');
 wp_dequeue_script('admin-bar');
 remove_action('wp_enqueue_scripts','wp_enqueue_admin_bar_bump_styles');
 $GLOBALS['noir_appointment_view']=$view;
 // An active theme may render the current response, never a redirect carrying values.
 if (has_action('noir_appointment_response')) { do_action('noir_appointment_response'); }
 else {
  header('Content-Type: text/html; charset=UTF-8');
  echo '<!doctype html><html '; language_attributes();
  echo '><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>'.esc_html__('Appointment Request','noir-studio').'</title></head><body><main><h1>'.esc_html__('Appointment Request','noir-studio').'</h1>';
  noir_appointment_fallback(noir_appointment_view());
  echo '</main></body></html>';
 }
 exit;
}
function noir_request_security_failure() {
 noir_request_response(403,['message'=>__('This form expired or could not be verified. Enable cookies and open a fresh Contact form, or contact the Studio directly.','noir-studio'),'values'=>[],'errors'=>[]]);
}
function noir_request_mail_configuration() {
 if (!defined('NOIR_MAIL_READY') || NOIR_MAIL_READY!==true) { return false; }
 foreach (['NOIR_MAIL_RECIPIENT','NOIR_MAIL_FROM'] as $key) {
  if (!defined($key) || !is_string(constant($key)) || !is_email(constant($key)) || preg_match('/[\r\n]/',constant($key))) { return false; }
 }
 // Sender is an operational identity supplied by the site operator, never by a customer.
 return ['to'=>NOIR_MAIL_RECIPIENT,'from'=>NOIR_MAIL_FROM];
}
function noir_request_redirect($token) {
 $url=noir_page_url('contact');
 $receipt=noir_request_signed('receipt',noir_request_digest('token',$token).'.'.(time()+900));
 if (!$url || !noir_request_cookie('noir_receipt',$receipt,time()+900)) {
  noir_request_response(503,['message'=>__('Sending was accepted, but the browser receipt could not be established. Contact the Studio to verify your request. Do not resubmit.','noir-studio')]);
 }
 wp_safe_redirect(add_query_arg('status','sent',$url).'#appointment-request',303);
 exit;
}
function noir_handle_appointment() {
 noir_request_uncached();
 if (($_SERVER['REQUEST_METHOD']??'')!=='POST') {
  header('Allow: POST');
  noir_request_response(405,['message'=>__('Use the Contact form to submit an Appointment Request.','noir-studio')]);
 }
 $body=file_get_contents('php://input',false,null,0,32769);
 if ((int)($_SERVER['CONTENT_LENGTH']??0)>32768 || strlen($body)>32768) {
  noir_request_response(422,['message'=>__('The form is too large. Open a fresh form and use shorter text.','noir-studio')]);
 }
 foreach (['submission_token','_noir_nonce','website'] as $key) {
  if (!isset($_POST[$key]) || !is_string($_POST[$key])) { noir_request_security_failure(); }
 }
 $token=wp_unslash($_POST['submission_token']);
 $state=noir_request_state($token);
 $visitor=noir_request_visitor();
 if (!$visitor || !is_array($state) || ($state['status']!=='accepted' && $state['expires']<=time()) || !hash_equals($state['visitor'],$visitor) || $state['user']!==get_current_user_id() || !wp_verify_nonce(wp_unslash($_POST['_noir_nonce']),noir_request_nonce_action($token)) || wp_unslash($_POST['website'])!=='') {
  noir_request_security_failure();
 }
 if ($state['status']==='accepted') { noir_request_redirect($token); }
 if ($state['status']!=='issued') {
  noir_request_response(503,['message'=>__('The sending outcome is pending or uncertain. Contact the Studio to verify it. Do not resubmit this request.','noir-studio')]);
 }
 $validation=noir_validate_appointment(wp_unslash($_POST));
 $view=array_merge($validation,['token'=>$token,'nonce'=>wp_unslash($_POST['_noir_nonce']),'message'=>'']);
 if (!empty($validation['malformed'])) { noir_request_response(422,['message'=>__('Use valid UTF-8 text and a fresh form.','noir-studio')]); }
 if ($validation['errors']) { noir_request_response(422,$view); }
 $configuration=noir_request_mail_configuration();
 if (!$configuration || !noir_page_url('contact')) {
  $view['message']=__('Online sending is unavailable. Nothing was sent. You may retry explicitly when service is restored, or contact the Studio directly.','noir-studio');
  noir_request_response(503,$view);
 }
 // Recheck eligibility immediately before attempting mail.
 $service=noir_service($view['values']['service_id']);
 if (!$service) { $view['errors']['service_id']=__('Choose a currently available Service.','noir-studio'); noir_request_response(422,$view); }
 $digest=noir_request_digest('token',$token);
 // Unique option insertion gives the normal path one attempt; Ticket 06 certifies all failure/concurrency boundaries.
 if (!add_option('noir_request_claim_'.$digest,time()+7200,'',false)) {
  noir_request_response(503,['message'=>__('The sending outcome is pending or uncertain. Contact the Studio to verify it. Do not resubmit this request.','noir-studio')]);
 }
 wp_schedule_single_event(time()+7200,'noir_request_cleanup',[$digest]);
 $state['status']='processing';
 if (!set_transient('noir_request_'.$digest,$state,7200)) {
  noir_request_response(503,['message'=>__('Sending could not be safely started. Contact the Studio directly.','noir-studio')]);
 }
 $zone=noir_studio_settings()['timezone']??'America/Los_Angeles';
 $body="Appointment Request — not confirmed\n\n";
 foreach (noir_request_fields() as $key=>$field) {
  $value=$view['values'][$key];
  if ($key==='service_id') { $value=$service['title'].' ('.$service['service_id'].')'; }
  $body.=$field['label'].': '.($value!==''?$value:'Not supplied')."\n";
 }
 $body.="Request time: ".wp_date('Y-m-d H:i:s',null,new DateTimeZone($zone)).' '.$zone."\n";
 $headers=['From: NOIR Studio <'.$configuration['from'].'>','Content-Type: text/plain; charset=UTF-8'];
 if ($view['values']['email']!=='') { $headers[]='Reply-To: '.$view['values']['email']; }
 try { $accepted=wp_mail($configuration['to'],'NOIR Appointment Request',$body,$headers,[]); }
 catch (Throwable $error) { $accepted=false; }
 if ($accepted===true) {
  $state['status']='accepted';
  if (set_transient('noir_request_'.$digest,$state,7200) && (get_transient('noir_request_'.$digest)['status']??'')==='accepted') { noir_request_redirect($token); }
 }
 // Generic wp_mail failure cannot establish that the remote transport did not accept mail.
 noir_request_response(503,['message'=>__('The sending outcome is uncertain. Contact the Studio to verify your request. Do not resubmit this request.','noir-studio')]);
}
add_action('admin_post_nopriv_noir_appointment_request','noir_handle_appointment');
add_action('admin_post_noir_appointment_request','noir_handle_appointment');
add_action('noir_request_cleanup',function($digest) {
 if (!is_string($digest) || !preg_match('/^[a-f0-9]{64}$/D',$digest)) { return; }
 // Delete issuance first: removal must never reopen an old request token.
 delete_transient('noir_request_'.$digest);
 delete_option('noir_request_claim_'.$digest);
});
add_action('admin_notices',function() {
 if (current_user_can('manage_options') && !noir_request_mail_configuration()) {
  echo '<div class="notice notice-error"><p>'.esc_html__('NOIR Appointment Request sending is unavailable. Configure NOIR_MAIL_RECIPIENT, NOIR_MAIL_FROM and explicit NOIR_MAIL_READY in the environment after verifying the transport. No customer data is recorded in WordPress.','noir-studio').'</p></div>';
 }
});

function noir_appointment_accepted_message() {
 return __('Your appointment request has been accepted for sending. The Studio will contact you within 1 business day to discuss availability and recommendations. Your appointment is not confirmed.','noir-studio');
}
/** Minimal semantic fallback for another theme; normal composition belongs to NOIR's theme. */
function noir_appointment_fallback($view) {
 if (!empty($view['accepted'])) { echo '<p role="status">'.esc_html($view['accepted_message']).'</p>'; return; }
 if (!empty($view['message'])) { echo '<p>'.esc_html($view['message']).'</p>'; }
 if ($view['errors']) {
  echo '<div id="request-errors" tabindex="-1"><h2>'.esc_html__('Please correct your Appointment Request','noir-studio').'</h2><ul>';
  foreach ($view['errors'] as $key=>$error) { echo '<li><a href="#request-'.esc_attr($key).'">'.esc_html($error).'</a></li>'; }
  echo '</ul></div>';
 }
 if (!empty($view['token'])) {
  echo '<form method="post" action="'.esc_url($view['endpoint']).'">';
  foreach (['action'=>'noir_appointment_request','submission_token'=>$view['token'],'_noir_nonce'=>$view['nonce']] as $key=>$value) { echo '<input type="hidden" name="'.esc_attr($key).'" value="'.esc_attr($value).'">'; }
  echo '<div hidden aria-hidden="true"><label>'.esc_html__('Website','noir-studio').' <input name="website" value="" tabindex="-1" autocomplete="off"></label></div>';
  foreach ($view['fields'] as $key=>$field) {
   $id='request-'.$key; $value=$view['values'][$key]??''; $error=$view['errors'][$key]??'';
   $association=$error ? ' aria-invalid="true" aria-describedby="'.esc_attr($id).'-error"' : '';
   if ($key==='service_id') {
    echo '<fieldset id="request-service_id"'.$association.'><legend>'.esc_html($field['label']).' *</legend>';
    foreach ($view['choices'] as $choice) { echo '<label><input type="radio" name="service_id" required value="'.esc_attr($choice['service_id']).'" '.checked($value,$choice['service_id'],false).$association.'>'.esc_html($choice['title']).'</label>'; }
   } else {
    echo '<p><label for="'.esc_attr($id).'">'.esc_html($field['label'].($field['required']?' *':__(' (Optional)','noir-studio'))).'</label> ';
    $attributes=' id="'.esc_attr($id).'" name="'.esc_attr($key).'" maxlength="'.esc_attr($field['max_length']).'"'.($field['required']?' required':'').$association;
    if ($field['input_type']==='textarea') { echo '<textarea'.$attributes.'>'.esc_textarea($value).'</textarea>'; }
    else { echo '<input'.$attributes.' type="'.esc_attr($field['input_type']).'" value="'.esc_attr($value).'"'.($field['autocomplete']?' autocomplete="'.esc_attr($field['autocomplete']).'"':'').($key==='preferred_date'?' min="'.esc_attr($view['today']).'"':'').'>'; }
   }
   if ($error) { echo '<span id="'.esc_attr($id).'-error">'.esc_html($error).'</span>'; }
   echo $key==='service_id' ? '</fieldset>' : '</p>';
  }
  echo '<p>'.esc_html__('A Preferred Date is interpreted in the Studio timezone and does not reserve availability. Your appointment is not confirmed.','noir-studio').'</p><button type="submit">'.esc_html__('Request Appointment','noir-studio').'</button></form>';
 }
 echo '<p>'.esc_html__('Contact the Studio directly: ','noir-studio');
 $s=$view['contacts'];
 if (!empty($s['phone_dial'])) { echo '<a href="'.esc_attr('tel:'.$s['phone_dial']).'">'.esc_html($s['phone_label']).'</a> '; }
 if (!empty($s['email'])) { echo '<a href="'.esc_attr('mailto:'.$s['email']).'">'.esc_html($s['email']).'</a>'; }
 echo '</p>';
}
