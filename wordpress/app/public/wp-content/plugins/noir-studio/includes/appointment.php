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
  'name'=>['Full Name',100,'text','name',true],
  'phone'=>['Phone Number',40,'tel','tel',true],
  'email'=>['Email Address',254,'email','email',false],
  'vehicle'=>['Vehicle Make & Model',160,'text','',true],
  'service_id'=>['Service of Interest',80,'radio','',true],
  'preferred_date'=>['Preferred Date',10,'date','',false],
  'notes'=>['Message / Notes',2000,'textarea','',false],
 ];
}
function noir_appointment_view() {
 return $GLOBALS['noir_appointment_view']??['values'=>[],'errors'=>[],'message'=>'Online requests are unavailable. Please contact the Studio directly.'];
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
  $GLOBALS['noir_appointment_view']=noir_request_issue() ?: ['values'=>[],'errors'=>[],'message'=>'Online requests are unavailable. Please contact the Studio directly.'];
 }
});

// The theme and portable fallback consume the same bounded form view model.
function noir_appointment_form($view=null) {
 $view = $view??noir_appointment_view();
 if (!empty($view['accepted'])) {
  echo '<div class="request-status" role="status"><p>Your appointment request has been accepted for sending. The Studio will contact you within 1 business day to discuss availability and recommendations. Your appointment is not confirmed.</p></div>';
  return;
 }
 $errors = $view['errors']??[];
 if ($errors || !empty($view['message'])) {
  echo '<div class="request-errors" id="request-errors" tabindex="-1" aria-labelledby="request-errors-heading"><h3 id="request-errors-heading">'.esc_html($errors ? 'Please correct your Appointment Request' : 'Appointment Request could not be completed').'</h3>';
  if (!empty($view['message'])) { echo '<p>'.esc_html($view['message']).'</p>'; }
  if ($errors) {
   echo '<ul>';
   foreach ($errors as $key=>$error) { echo '<li><a href="#request-'.esc_attr($key).'">'.esc_html($error).'</a></li>'; }
   echo '</ul>';
  }
  echo '</div>';
 }
 if (!empty($view['token'])) {
  echo '<form method="post" action="'.esc_url(admin_url('admin-post.php')).'" class="appointment-form">';
  foreach (['action'=>'noir_appointment_request','submission_token'=>$view['token'],'_noir_nonce'=>$view['nonce']] as $key=>$value) { echo '<input type="hidden" name="'.esc_attr($key).'" value="'.esc_attr($value).'">'; }
  echo '<div hidden aria-hidden="true"><label>Website <input name="website" tabindex="-1" autocomplete="off" value=""></label></div>';
  $choices = noir_services();
  foreach (noir_request_fields() as $key=>$field) {
   if ($key==='name') { echo '<div class="field-pair">'; }
   $value = $view['values'][$key]??'';
   $id = 'request-'.$key;
   $attributes = ' id="'.esc_attr($id).'" name="'.esc_attr($key).'"'.($field[4]?' required':'').' aria-invalid="'.(isset($errors[$key])?'true':'false').'"';
   if (isset($errors[$key]) && $key!=='preferred_date') { $attributes.=' aria-describedby="'.esc_attr($id).'-error"'; }
   if ($key==='service_id') {
    echo '<fieldset class="service-choices" id="request-service_id"'.(isset($errors[$key])?' aria-invalid="true" aria-describedby="request-service_id-error"':'').'><legend>Service of Interest *</legend><div class="service-grid">';
    foreach ($choices as $choice) {
     echo '<label><input class="screen-reader-text" type="radio" name="service_id" required value="'.esc_attr($choice['service_id']).'" '.checked($value,$choice['service_id'],false).(isset($errors[$key])?' aria-invalid="true" aria-describedby="request-service_id-error"':'').'><span>'.esc_html($choice['title']).'</span></label>';
    }
    echo '</div>';
   } else {
    echo '<div class="field"><label for="'.esc_attr($id).'">'.esc_html($field[0].($field[4]?' *':' (Optional)')).'</label>';
    if ($field[2]==='textarea') { echo '<textarea'.$attributes.' rows="4" maxlength="2000">'.esc_textarea($value).'</textarea>'; }
    else {
     echo '<input'.$attributes.' type="'.esc_attr($field[2]).'" maxlength="'.esc_attr($field[1]).'" value="'.esc_attr($value).'"'.($field[3]?' autocomplete="'.esc_attr($field[3]).'"':'').($key==='preferred_date'?' min="'.esc_attr(noir_request_today()).'" aria-describedby="request-date-help'.(isset($errors[$key])?' request-preferred_date-error':'').'"':'').'>';
    }
    if ($key==='preferred_date') { echo '<p id="request-date-help" class="muted">Interpreted in the Studio timezone. This date does not reserve availability.</p>'; }
   }
   if (isset($errors[$key])) { echo '<p class="field-error" id="'.esc_attr($id).'-error">'.esc_html($errors[$key]).'</p>'; }
   echo $key==='service_id' ? '</fieldset>' : '</div>';
   if ($key==='phone') { echo '</div>'; }
  }
  echo '<p class="muted">An Appointment Request does not confirm an appointment. The Studio will contact you within 1 business day to discuss availability and recommendations.</p><button class="button" type="submit">Request Appointment</button></form>';
 }
 if (!empty($view['message']) || empty($view['token'])) {
  $s=noir_studio_settings();
  echo '<p class="request-fallback">Contact the Studio directly: ';
  if (!empty($s['phone_dial'])) { echo '<a href="'.esc_attr('tel:'.$s['phone_dial']).'">'.esc_html($s['phone_label']).'</a> '; }
  if (!empty($s['email'])) { echo '<a href="'.esc_attr('mailto:'.$s['email']).'">'.esc_html($s['email']).'</a>'; }
  echo '</p>';
 }
}

/** Unslashed input and an optional Studio-local clock date; focused policy seam. */
function noir_validate_appointment($input,$today=null) {
 $values=[]; $errors=[];
 foreach (noir_request_fields() as $key=>$field) {
  $raw=$input[$key]??'';
  if (!is_string($raw)) { $errors[$key]=$field[0].': enter a single text value.'; continue; }
  if (!preg_match('//u',$raw)) { return ['values'=>[],'errors'=>[],'malformed'=>true]; }
  // Email header injection is rejected before whitespace normalization.
  $bad_email=$key==='email' && preg_match('/[\r\n]/',$raw);
  $text=$key==='notes' ? str_replace(["\r\n","\r"],"\n",$raw) : $raw;
  $text=in_array($key,['preferred_date','service_id'],true) ? $text : trim($text);
  preg_match_all('/./us',$text,$characters);
  $length=count($characters[0]);
  $controls=$key==='notes' ? '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F-\x9F]/u' : '/\p{Cc}/u';
  if ($length>$field[1] || preg_match($controls,$key==='notes' ? $text : $raw) || $bad_email) {
   $errors[$key]=$field[0].': use valid text within '.$field[1].' characters.';
   continue;
  }
  $clean=$key==='notes' ? sanitize_textarea_field($text) : sanitize_text_field($text);
  $values[$key]=$clean;
  if ($field[4] && $clean==='') { $errors[$key]=$field[0].' is required.'; continue; }
  if ($key==='phone' && (!preg_match('/^[0-9 ()+.\-]{7,40}$/D',$text) || strlen(preg_replace('/[^0-9]/','',$text))<7 || strlen(preg_replace('/[^0-9]/','',$text))>15)) {
   $errors[$key]='Phone Number: use 7–15 digits with spaces, parentheses, plus, hyphen or period.';
  }
  if ($key==='email' && $text!=='' && (!is_email($text) || $clean!==$text)) { $errors[$key]='Email Address: enter a valid email without line breaks.'; $values[$key]=''; }
  if ($key==='service_id' && !noir_service($text)) { $errors[$key]='Service of Interest: choose a currently available Service.'; $values[$key]=''; }
  if ($key==='preferred_date' && $text!=='') {
   $date=DateTimeImmutable::createFromFormat('!Y-m-d',$text,new DateTimeZone('UTC'));
   if (!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/D',$text) || !$date || $date->format('Y-m-d')!==$text || $text<($today??noir_request_today())) {
    $errors[$key]='Preferred Date: choose a real date today or later in the Studio timezone.';
   }
  }
 }
 return ['values'=>$values,'errors'=>$errors];
}
function noir_request_response($code,$view) {
 noir_request_uncached();
 status_header($code);
 $GLOBALS['noir_appointment_view']=$view;
 // An active theme may render the current response, never a redirect carrying values.
 if (has_action('noir_appointment_response')) { do_action('noir_appointment_response'); }
 else {
  header('Content-Type: text/html; charset=UTF-8');
  echo '<!doctype html><html lang="en"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Appointment Request</title><body><main><h1>Appointment Request</h1>';
  noir_appointment_form($view);
  echo '</main></body></html>';
 }
 exit;
}
function noir_request_security_failure() {
 noir_request_response(403,['message'=>'This form expired or could not be verified. Enable cookies and open a fresh Contact form, or contact the Studio directly.','values'=>[],'errors'=>[]]);
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
  noir_request_response(503,['message'=>'Sending was accepted, but the browser receipt could not be established. Contact the Studio to verify your request. Do not resubmit.']);
 }
 wp_safe_redirect(add_query_arg('status','sent',$url).'#appointment-request',303);
 exit;
}
function noir_handle_appointment() {
 noir_request_uncached();
 if (($_SERVER['REQUEST_METHOD']??'')!=='POST') {
  header('Allow: POST');
  noir_request_response(405,['message'=>'Use the Contact form to submit an Appointment Request.']);
 }
 $body=file_get_contents('php://input',false,null,0,32769);
 if ((int)($_SERVER['CONTENT_LENGTH']??0)>32768 || strlen($body)>32768) {
  noir_request_response(422,['message'=>'The form is too large. Open a fresh form and use shorter text.']);
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
  noir_request_response(503,['message'=>'The sending outcome is pending or uncertain. Contact the Studio to verify it. Do not resubmit this request.']);
 }
 $validation=noir_validate_appointment(wp_unslash($_POST));
 $view=array_merge($validation,['token'=>$token,'nonce'=>wp_unslash($_POST['_noir_nonce']),'message'=>'']);
 if (!empty($validation['malformed'])) { noir_request_response(422,['message'=>'Use valid UTF-8 text and a fresh form.']); }
 if ($validation['errors']) { noir_request_response(422,$view); }
 $configuration=noir_request_mail_configuration();
 if (!$configuration || !noir_page_url('contact')) {
  $view['message']='Online sending is unavailable. Nothing was sent. You may retry explicitly when service is restored, or contact the Studio directly.';
  noir_request_response(503,$view);
 }
 // Recheck eligibility immediately before attempting mail.
 $service=noir_service($view['values']['service_id']);
 if (!$service) { $view['errors']['service_id']='Choose a currently available Service.'; noir_request_response(422,$view); }
 $digest=noir_request_digest('token',$token);
 // Unique option insertion gives the normal path one attempt; Ticket 06 certifies all failure/concurrency boundaries.
 if (!add_option('noir_request_claim_'.$digest,time()+7200,'',false)) {
  noir_request_response(503,['message'=>'The sending outcome is pending or uncertain. Contact the Studio to verify it. Do not resubmit this request.']);
 }
 wp_schedule_single_event(time()+7200,'noir_request_cleanup',[$digest]);
 $state['status']='processing';
 if (!set_transient('noir_request_'.$digest,$state,7200)) {
  noir_request_response(503,['message'=>'Sending could not be safely started. Contact the Studio directly.']);
 }
 $zone=noir_studio_settings()['timezone']??'America/Los_Angeles';
 $body="Appointment Request — not confirmed\n\n";
 foreach (noir_request_fields() as $key=>$field) {
  $value=$view['values'][$key];
  if ($key==='service_id') { $value=$service['title'].' ('.$service['service_id'].')'; }
  $body.=$field[0].': '.($value!==''?$value:'Not supplied')."\n";
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
 noir_request_response(503,['message'=>'The sending outcome is uncertain. Contact the Studio to verify your request. Do not resubmit this request.']);
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
  echo '<div class="notice notice-error"><p>NOIR Appointment Request sending is unavailable. Configure NOIR_MAIL_RECIPIENT, NOIR_MAIL_FROM and explicit NOIR_MAIL_READY in the environment after verifying the transport. No customer data is recorded in WordPress.</p></div>';
 }
});
