<?php
// Real public HTTP boundary; no customer values are retained by this harness.
function appointment_check($condition,$message) {
 if (!$condition) { throw new RuntimeException($message); }
 echo "PASS: $message\n";
}
$url = noir_page_url('contact');
$response = wp_remote_get($url);
$html = wp_remote_retrieve_body($response);
appointment_check(str_contains($html,'name="submission_token"') && str_contains($html,'name="_noir_nonce"') && str_contains($html,'method="post"'),'Contact issues an ordinary anonymous POST form');
function appointment_form($url) {
 $response=wp_remote_get($url);
 $html=wp_remote_retrieve_body($response);
 preg_match('/name="submission_token" value="([a-f0-9]{64})"/',$html,$token);
 preg_match('/name="_noir_nonce" value="([^"]+)"/',$html,$nonce);
 return [['action'=>'noir_appointment_request','submission_token'=>$token[1]??'','_noir_nonce'=>$nonce[1]??'','website'=>''],wp_remote_retrieve_cookies($response)];
}
function appointment_post($form,$cookies) {
 return wp_remote_post(admin_url('admin-post.php'),['body'=>$form,'cookies'=>$cookies,'redirection'=>0]);
}
[$form,$cookies]=appointment_form($url);
$form+=['name'=>'حسین <script>alert(1)</script>','phone'=>'bad','vehicle'=>'Porsche \\ 911','email'=>'','service_id'=>'full-detail','preferred_date'=>'','notes'=>''];
$response=appointment_post($form,$cookies);
appointment_check(wp_remote_retrieve_response_code($response)===422,'Invalid request returns 422 without JavaScript');
$html=wp_remote_retrieve_body($response);
appointment_check(str_contains($html,'id="request-errors"') && str_contains($html,'href="#request-phone"') && str_contains($html,'aria-invalid="true"'),'Validation exposes linked summary and associated errors');
appointment_check(!str_contains($html,'<script>alert(1)</script>') && str_contains($html,'Porsche \\ 911'),'Safe values preserve Unicode and literal backslashes without executing markup');
$valid=['name'=>'حسین','phone'=>'+44 (20) 1234-5678','email'=>'','vehicle'=>'2024 Porsche 911','service_id'=>noir_services()[0]['service_id'],'preferred_date'=>'','notes'=>''];
$invalid_cases=[
 ['name',str_repeat('名',101)],['phone','123456'],['phone','1234567890123456'],['email',"test@example.com\r\nBcc: bad@example.com"],['vehicle',str_repeat('x',161)],['service_id','invented'],['preferred_date','2026-02-30'],['preferred_date','2026-10-07'],['notes',str_repeat('😀',2001)],['name',['array']],['name',"Hello\x01"],['notes',"abc\x7f"],['name',"\nHello"],
];
foreach ($invalid_cases as [$key,$value]) {
 $candidate=$valid; $candidate[$key]=$value;
 $result=noir_validate_appointment($candidate,'2026-10-08');
 appointment_check(isset($result['errors'][$key]),"Policy rejects $key boundary/shape/control");
}
$limits=['name'=>str_repeat('名',100),'phone'=>'1234567','vehicle'=>str_repeat('🚗',160),'notes'=>str_repeat('😀',2000),'preferred_date'=>'9999-12-31'];
foreach ($limits as $key=>$value) {
 $candidate=$valid; $candidate[$key]=$value;
 appointment_check(!noir_validate_appointment($candidate,'2026-10-08')['errors'],"Policy accepts $key at its specified boundary");
}
foreach (['2026-10-08','2028-02-29'] as $date) {
 $candidate=$valid; $candidate['preferred_date']=$date;
 appointment_check(!noir_validate_appointment($candidate,'2026-10-08')['errors'],'Today and valid leap date accepted without availability rules');
}
$candidate=$valid; $candidate['notes']="Line one\r\nLine two\tend";
appointment_check(noir_validate_appointment($candidate)['values']['notes']==="Line one\nLine two\tend",'Notes normalize CRLF and preserve normal whitespace');
$candidate=$valid; $candidate['name']="\xC3\x28";
appointment_check(!empty(noir_validate_appointment($candidate)['malformed']),'Malformed UTF-8 rejected without reflection');
[$form,$cookies]=appointment_form($url);
$response=appointment_post($form+$valid,$cookies);
appointment_check(wp_remote_retrieve_response_code($response)===503 && str_contains(wp_remote_retrieve_body($response),'Nothing was sent'),'Missing explicit transport configuration returns safe 503 and permits explicit retry');
appointment_check(str_contains(wp_remote_retrieve_body($response),'value="حسین"'),'Definite pre-acceptance failure preserves safe values');
foreach (['website'=>'bot','_noir_nonce'=>'forged','submission_token'=>str_repeat('a',64)] as $key=>$value) {
 $bad=$form+$valid; $bad[$key]=$value;
 $response=appointment_post($bad,$cookies);
 appointment_check(wp_remote_retrieve_response_code($response)===403 && !str_contains(wp_remote_retrieve_body($response),'value="حسین"'),"Security rejects $key without reflecting customer fields");
}
appointment_check(wp_remote_retrieve_response_code(appointment_post($form+$valid,[]))===403,'Missing visitor cookie fails with direct-contact guidance');
$response=wp_remote_get(admin_url('admin-post.php?action=noir_appointment_request'));
appointment_check(wp_remote_retrieve_response_code($response)===405,'GET cannot submit');
$response=wp_remote_get(add_query_arg('status','sent',$url));
appointment_check(!str_contains(wp_remote_retrieve_body($response),'Your appointment request has been accepted for sending.'),'Guessed success URL cannot claim acceptance');
appointment_check(str_contains(wp_remote_retrieve_header($response,'cache-control'),'no-store'),'Contact and status responses prevent shared caching');
[$form,$cookies]=appointment_form($url);
$oversize=wp_remote_post(admin_url('admin-post.php'),['body'=>$form+$valid+['extra'=>str_repeat('x',32769)],'cookies'=>$cookies,'redirection'=>0]);
appointment_check(wp_remote_retrieve_response_code($oversize)===422 && !str_contains(wp_remote_retrieve_body($oversize),'value="حسین"'),'32 KiB body limit fails without reflecting values');
$bad=$form+$valid; $bad['vehicle']=['bad'];
appointment_check(wp_remote_retrieve_response_code(appointment_post($bad,$cookies))===422,'Array field shape rejected through real HTTP');
$bad=$form+$valid; $bad['name']="\xC3\x28";
appointment_check(wp_remote_retrieve_response_code(appointment_post($bad,$cookies))===422,'Malformed UTF-8 rejected through real HTTP');
$service=noir_services()[0];
$admin=get_users(['role'=>'administrator','number'=>1])[0]->ID;
wp_set_current_user($admin);
try {
 wp_update_post(['ID'=>$service['post_id'],'post_status'=>'draft']);
 appointment_check(wp_remote_retrieve_response_code(appointment_post($form+$valid,$cookies))===422,'A Service withdrawn after form issuance cannot be requested');
 $unavailable=wp_remote_retrieve_body(wp_remote_get(add_query_arg('service',$service['service_id'],$url)));
 appointment_check(!str_contains($unavailable,'value="'.$service['service_id'].'"'),'Unavailable preselection cannot fabricate an option');
} finally { wp_update_post(['ID'=>$service['post_id'],'post_status'=>'publish']); }
$settings=noir_studio_settings();
try {
 $modified=$settings; $modified['timezone']='America/Los_Angeles'; update_option('noir_studio',$modified);
 appointment_check(noir_request_today(strtotime('2026-10-08 01:00:00 UTC'))==='2026-10-07','Studio date differs from UTC across midnight');
 appointment_check(noir_request_today(strtotime('2026-03-08 09:59:59 UTC'))==='2026-03-08' && noir_request_today(strtotime('2026-03-08 10:00:00 UTC'))==='2026-03-08','Studio date survives DST transition');
 $modified['timezone']='Asia/Tehran';update_option('noir_studio',$modified);
 appointment_check(noir_request_today(strtotime('2026-10-07 21:00:00 UTC'))==='2026-10-08','Configured Studio timezone controls date boundary');
} finally {update_option('noir_studio',$settings);}
$subscriber=wp_insert_user(['user_login'=>'noir-appointment-'.wp_generate_password(8,false),'user_pass'=>wp_generate_password(),'role'=>'subscriber']);
try {
 $session=WP_Session_Tokens::get_instance($subscriber)->create(time()+3600);
 $auth=new WP_Http_Cookie(['name'=>LOGGED_IN_COOKIE,'value'=>wp_generate_auth_cookie($subscriber,time()+3600,'logged_in',$session)]);
 $response=wp_remote_get($url,['cookies'=>[$auth]]);$html=wp_remote_retrieve_body($response);
 preg_match('/name="submission_token" value="([a-f0-9]{64})"/',$html,$token);
 preg_match('/name="_noir_nonce" value="([^"]+)"/',$html,$nonce);
 $logged=['action'=>'noir_appointment_request','submission_token'=>$token[1],'_noir_nonce'=>$nonce[1],'website'=>'']+$valid;
 $logged_cookies=array_merge([$auth],wp_remote_retrieve_cookies($response));
 appointment_check(wp_remote_retrieve_response_code(appointment_post($logged,$logged_cookies))===503,'Native logged-in route accepts the correctly bound nonce before configuration failure');
 $logged['_noir_nonce']='bad';
 appointment_check(wp_remote_retrieve_response_code(appointment_post($logged,$logged_cookies))===403,'Logged-in route enforces native nonce protection');
 appointment_check(wp_remote_retrieve_response_code(appointment_post($form+$valid,$logged_cookies))===403,'A logged-in identity cannot borrow an anonymous issued token');
} finally {
 require_once ABSPATH.'wp-admin/includes/user.php';wp_delete_user($subscriber);
}
[$form,$cookies]=appointment_form($url);
$invalid=$form+$valid; $invalid['phone']='123';
$response=appointment_post($invalid,$cookies);
appointment_check(!preg_match('/Warning:|Fatal error:|<div id="wpadminbar"/',wp_remote_retrieve_body($response)),'Public POST response renders without an admin toolbar or PHP diagnostics');
