<?php
/** Disposable Local database; real independent FPM HTTP workers, synthetic fields only. */
if (wp_get_environment_type()!=='local') { throw new RuntimeException('Local only'); }
function reliability_check($ok,$message) {
 if (!$ok) { throw new RuntimeException($message); }
 echo "PASS: $message\n";
}
function reliability_http($requests,$during=null) {
 $multi=curl_multi_init(); $handles=[];
 foreach ($requests as $request) {
  $handle=curl_init($request['url']);
  curl_setopt_array($handle,[CURLOPT_RETURNTRANSFER=>true,CURLOPT_HEADER=>true,CURLOPT_TIMEOUT_MS=>$request['timeout_ms']??20000]);
  if (isset($request['body'])) { curl_setopt($handle,CURLOPT_POSTFIELDS,http_build_query($request['body'])); }
  if (isset($request['cookie'])) { curl_setopt($handle,CURLOPT_COOKIE,$request['cookie']); }
  if (isset($request['headers'])) { curl_setopt($handle,CURLOPT_HTTPHEADER,$request['headers']); }
  curl_multi_add_handle($multi,$handle); $handles[]=$handle;
 }
 do { curl_multi_exec($multi,$active); if ($during) { $during(); } if ($active) {curl_multi_select($multi,0.1);} } while ($active);
 $responses=[];
 foreach ($handles as $handle) {
  $raw=curl_multi_getcontent($handle); $size=curl_getinfo($handle,CURLINFO_HEADER_SIZE);
  $responses[]=['code'=>curl_getinfo($handle,CURLINFO_HTTP_CODE),'headers'=>substr($raw,0,$size),'body'=>substr($raw,$size)];
  curl_multi_remove_handle($multi,$handle);curl_close($handle);
 }
 curl_multi_close($multi); return $responses;
}
function reliability_ledger($change=null) {
 global $wpdb;
 $raw=$wpdb->get_var("SELECT option_value FROM {$wpdb->options} WHERE option_name='noir_request_ledger'");
 $ledger=$raw ? json_decode($raw,true) : ['version'=>1,'tokens'=>[],'counters'=>[]];
 if ($change) {
  $change($ledger);
  $wpdb->query($wpdb->prepare("INSERT INTO {$wpdb->options} (option_name,option_value,autoload) VALUES ('noir_request_ledger',%s,'off') ON DUPLICATE KEY UPDATE option_value=VALUES(option_value)",wp_json_encode($ledger)));
 }
 return $ledger;
}
function reliability_reset() { reliability_ledger(function(&$ledger) { $ledger=['version'=>1,'tokens'=>[],'counters'=>[]]; }); }
function reliability_mode($mode) {
 file_put_contents('/tmp/noir-ticket06/mode',$mode);
 file_put_contents('/tmp/noir-ticket06/attempts','');
 file_put_contents('/tmp/noir-ticket06/workers','');
}
function reliability_attempts() { return count(file('/tmp/noir-ticket06/attempts',FILE_IGNORE_NEW_LINES)); }
function reliability_form($url,$headers=[]) {
 $response=reliability_http([['url'=>$url,'headers'=>$headers]])[0];
 preg_match('/name="submission_token" value="([a-f0-9]{64})"/',$response['body'],$token);
 preg_match('/name="_noir_nonce" value="([^"]+)"/',$response['body'],$nonce);
 preg_match('/Set-Cookie: (noir_visitor=[^;]+)/i',$response['headers'],$cookie);
 reliability_check($response['code']===200 && isset($token[1],$nonce[1],$cookie[1]),'Public Contact issues a bound no-store form');
 reliability_check(str_contains($response['headers'],'no-store'),'Form is isolated from shared caching');
 return [['action'=>'noir_appointment_request','submission_token'=>$token[1],'_noir_nonce'=>$nonce[1],'website'=>'','name'=>'Synthetic reliability customer','phone'=>'+1 310 555 0100','vehicle'=>'Synthetic vehicle','email'=>'','service_id'=>noir_services()[0]['service_id'],'notes'=>'','preferred_date'=>''],$cookie[1]];
}
function reliability_post($form,$cookie) { return ['url'=>admin_url('admin-post.php'),'body'=>$form,'cookie'=>$cookie]; }

$fixture=WP_CONTENT_DIR.'/mu-plugins/noir-appointment-reliability-test.php';
$original=file_exists($fixture) ? file_get_contents($fixture) : null;
$prior=reliability_ledger();
if (!is_dir(dirname($fixture))) { mkdir(dirname($fixture),0700,true); }
if (!is_dir('/tmp/noir-ticket06')) { mkdir('/tmp/noir-ticket06',0700,true); }
$controls=[];
foreach (['mode','attempts','workers'] as $file) { $path='/tmp/noir-ticket06/'.$file; $controls[$file]=file_exists($path) ? file_get_contents($path) : null; }
$url=noir_page_url('contact');
try {
 copy(__DIR__.'/fixtures/appointment-reliability-environment.php',$fixture);
 reliability_reset(); reliability_mode('accepted');
 $requests=[];
 for ($i=0;$i<45;$i++) { $requests[]=['url'=>$url,'headers'=>['X-Forwarded-For: 203.0.113.'.($i+1)]]; }
 $responses=reliability_http($requests);
 reliability_check(count(array_filter($responses,fn($r)=>$r['code']===200 && str_contains($r['body'],'name="submission_token"')))===40,'Concurrent issuance is network-limited across cleared cookies and forged proxy headers');
 reliability_check(count(array_filter($responses,fn($r)=>$r['code']===429 && preg_match('/Retry-After: [1-9][0-9]*/i',$r['headers'])))===5,'Issuance throttling returns 429 and Retry-After');
 reliability_check(count(reliability_ledger()['tokens'])===40,'Rejected issuance cannot grow token state');

 reliability_reset(); reliability_mode('slow');
 [$form,$cookie]=reliability_form($url);
 $responses=reliability_http(array_fill(0,8,reliability_post($form,$cookie)));
 reliability_check(reliability_attempts()===1,'Eight simultaneous valid POSTs invoke transport at most once');
 reliability_check(count(array_unique(file('/tmp/noir-ticket06/workers',FILE_IGNORE_NEW_LINES)))>1,'Concurrency uses independent PHP worker processes');
 reliability_check(count(array_filter($responses,fn($r)=>$r['code']===303))===1 && count(array_filter($responses,fn($r)=>$r['code']===503 && str_contains($r['body'],'pending or uncertain')))===7,'In-progress duplicates get pending direct-contact guidance without a retry form');
 $accepted=array_values(array_filter($responses,fn($r)=>$r['code']===303))[0];
 preg_match('/Set-Cookie: (noir_receipt=[^;]+)/i',$accepted['headers'],$receipt);
 $status=reliability_http([['url'=>$url.'?status=sent','cookie'=>$cookie.'; '.$receipt[1]]])[0];
 reliability_check($status['code']===200 && str_contains($status['headers'],'no-store') && str_contains($status['body'],'Your appointment request has been accepted for sending.'),'Recorded acceptance displays only with the bound receipt, with no-store');
 $foreign=reliability_http([['url'=>$url.'?status=sent','cookie'=>$receipt[1]]])[0];
 reliability_check(!str_contains($foreign['body'],'Your appointment request has been accepted for sending.'),'Another visitor cannot borrow the receipt');
 $replay=reliability_http([reliability_post($form,$cookie)])[0];
 reliability_check($replay['code']===303 && reliability_attempts()===1,'Authenticated accepted replay never resends');

 reliability_reset(); reliability_mode('slow'); [$form,$cookie]=reliability_form($url);
 $timed=reliability_post($form,$cookie); $timed['timeout_ms']=200;
 $responses=reliability_http([$timed]);
 reliability_check($responses[0]['code']===0 && reliability_attempts()===1,'Client timeout leaves the original transport worker active');
 $pending=reliability_http([reliability_post($form,$cookie)])[0];
 reliability_check($pending['code']===503 && str_contains($pending['body'],'pending or uncertain') && reliability_attempts()===1,'Timeout replay receives pending direct-contact guidance');
 sleep(3);
 reliability_check(reliability_http([reliability_post($form,$cookie)])[0]['code']===303 && reliability_attempts()===1,'Only recorded acceptance by the original timed-out worker permits success');

 foreach (['uncertain','exception','crash','record-failure'] as $mode) {
  reliability_reset(); reliability_mode($mode); [$form,$cookie]=reliability_form($url);
  $responses=reliability_http([reliability_post($form,$cookie),reliability_post($form,$cookie)]);
  reliability_check(reliability_attempts()===1 && count(array_filter($responses,fn($r)=>$r['code']===503 && str_contains($r['body'],'Contact the Studio') && !str_contains($r['body'],'name="submission_token"')))===2,$mode.': non-success and replay remain uncertain without a retry form');
 }
 reliability_reset(); reliability_mode('off'); [$form,$cookie]=reliability_form($url);
 $response=reliability_http([reliability_post($form,$cookie)])[0];
 reliability_check($response['code']===503 && str_contains($response['body'],'Nothing was sent') && str_contains($response['body'],'name="submission_token"') && reliability_attempts()===0,'Proven pre-send failure permits only an explicit retry');
 reliability_mode('accepted');
 reliability_check(reliability_http([reliability_post($form,$cookie)])[0]['code']===303 && reliability_attempts()===1,'Later explicit retry after proven non-acceptance is safe');

 reliability_reset(); reliability_mode('accepted'); [$form,$cookie]=reliability_form($url);
 $digest=noir_request_digest('token',$form['submission_token']);
 reliability_ledger(function(&$ledger) use ($digest) { $ledger['tokens'][$digest]['expires']=time()-1; });
 reliability_check(reliability_http([reliability_post($form,$cookie)])[0]['code']===403 && reliability_attempts()===0,'Expired issued token cannot send');
 reliability_reset();
 $bad=$form; $bad['submission_token']=str_repeat('a',64);
 $responses=reliability_http(array_fill(0,40,reliability_post($bad,'')));
 reliability_check(count(array_filter($responses,fn($r)=>$r['code']===403))===30 && count(array_filter($responses,fn($r)=>$r['code']===429))===10 && reliability_attempts()===0 && count(reliability_ledger()['tokens'])===0,'Concurrent invalid POSTs are throttled and cannot create issuance state');

 reliability_reset(); reliability_mode('accepted'); [$form,$cookie]=reliability_form($url);
 reliability_mode('storage-failure');
 $response=reliability_http([reliability_post($form,$cookie)])[0];
 reliability_check($response['code']===503 && reliability_attempts()===0 && !str_contains($response['body'],'name="submission_token"'),'Lost storage connection fails closed before transport');
 reliability_mode('accepted');
 global $wpdb;
 $lock='noir:'.substr(hash('sha256',DB_NAME.'|'.$wpdb->options),0,48);
 $wpdb->get_var($wpdb->prepare('SELECT GET_LOCK(%s,1)',$lock));
 try {
  $response=reliability_http([reliability_post($form,$cookie)])[0];
  reliability_check($response['code']===503 && reliability_attempts()===0,'Unavailable exclusive lock refuses new work');
 } finally { $wpdb->get_var($wpdb->prepare('SELECT RELEASE_LOCK(%s)',$lock)); }

 // Exercise actual database write refusal, including after transport acceptance.
 reliability_reset(); reliability_mode('accepted'); [$form,$cookie]=reliability_form($url);
 $trigger='noir_ticket06_refuse_write';
 try {
  $wpdb->query("CREATE TRIGGER $trigger BEFORE UPDATE ON {$wpdb->options} FOR EACH ROW BEGIN IF NEW.option_name='noir_request_ledger' THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='Synthetic write failure'; END IF; END");
  $response=reliability_http([reliability_post($form,$cookie)])[0];
  reliability_check($response['code']===503 && reliability_attempts()===0,'Database write refusal fails closed before any send');
  $response=reliability_http([['url'=>$url]])[0];
  reliability_check($response['code']===503,'Failed issuance storage cannot publish a usable form');
 } finally { $wpdb->query("DROP TRIGGER IF EXISTS $trigger"); }
 try {
  $wpdb->query("CREATE TRIGGER $trigger BEFORE UPDATE ON {$wpdb->options} FOR EACH ROW BEGIN IF NEW.option_name='noir_request_ledger' AND NEW.option_value LIKE '%\"status\":\"accepted\"%' THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='Synthetic acceptance recording failure'; END IF; END");
  $responses=reliability_http([reliability_post($form,$cookie),reliability_post($form,$cookie)]);
  reliability_check(reliability_attempts()===1 && count(array_filter($responses,fn($r)=>$r['code']===503))===2,'Post-send acceptance write failure leaves protective processing state and never claims success');
 } finally { $wpdb->query("DROP TRIGGER IF EXISTS $trigger"); }

 reliability_reset(); reliability_mode('trusted');
 $requests=[];
 for ($i=0;$i<150;$i++) { $requests[]=['url'=>$url,'headers'=>['X-Forwarded-For: 198.51.100.'.(intdiv($i,30)+1)]]; }
 $responses=[];
 foreach (array_chunk($requests,25) as $batch) { $responses=array_merge($responses,reliability_http($batch)); }
 reliability_check(count(array_filter($responses,fn($r)=>$r['code']===200))===120 && count(array_filter($responses,fn($r)=>$r['code']===429))===30,'Explicitly trusted proxy resolves clients while global issuance remains bounded concurrently: '.wp_json_encode(array_count_values(array_column($responses,'code'))));
 reliability_reset(); reliability_mode('accepted');
 [$form,$cookie]=reliability_form($url);
 $requests=array_fill(0,25,['url'=>$url,'cookie'=>$cookie]);
 $responses=reliability_http($requests);
 reliability_check(count(array_filter($responses,fn($r)=>$r['code']===200))===19 && count(array_filter($responses,fn($r)=>$r['code']===429))===6,'Visitor issuance limit is atomic under concurrent requests');
 reliability_ledger(function(&$ledger) { $ledger['counters']=[]; });
 reliability_check(reliability_http([reliability_post($form,$cookie)])[0]['code']===303,'Accepted setup for concurrent authenticated replay throttling');
 reliability_ledger(function(&$ledger) { $ledger['counters']=[]; });
 $responses=reliability_http(array_fill(0,40,reliability_post($form,$cookie)));
 reliability_check(count(array_filter($responses,fn($r)=>$r['code']===303))===30 && count(array_filter($responses,fn($r)=>$r['code']===429))===10 && reliability_attempts()===1,'Valid concurrent accepted replay is throttled without additional transport');

 reliability_reset(); reliability_mode('slow-cleanup'); [$form,$cookie]=reliability_form($url);
 $cleaned=false;
 $responses=reliability_http([reliability_post($form,$cookie),reliability_post($form,$cookie)],function() use (&$cleaned) {
  if (!$cleaned && reliability_attempts()) {
   reliability_ledger(function(&$ledger) { foreach ($ledger['tokens'] as &$state) { $state['retain_until']=time()-1; } });
   do_action('noir_request_cleanup_ledger'); $cleaned=true;
  }
 });
 reliability_check($cleaned && reliability_attempts()===1 && !array_filter($responses,fn($r)=>$r['code']===303) && count(reliability_ledger()['tokens'])===0,'Cleanup during a slow sender never reopens or resurrects permission or late acceptance');
 reliability_check(reliability_http([reliability_post($form,$cookie)])[0]['code']===403 && reliability_attempts()===1,'Removed token stays invalid after the original worker finishes');

 reliability_reset(); reliability_mode('accepted'); [$form,$cookie]=reliability_form($url);
 $digest=noir_request_digest('token',$form['submission_token']);
 reliability_ledger(function(&$ledger) use ($digest) {
  $state=$ledger['tokens'][$digest];
  for ($i=0;$i<768;$i++) { $ledger['tokens'][hash('sha256',(string)$i)]=$state; }
  unset($ledger['tokens'][$digest]);
 });
 $response=reliability_http([['url'=>$url]])[0];
 reliability_check($response['code']===429 && count(reliability_ledger()['tokens'])===768,'Hard token capacity refuses issuance without state growth');
 reliability_ledger(function(&$ledger) {
  foreach ($ledger['tokens'] as &$state) { $state['retain_until']=time()-1; }
  foreach ($ledger['counters'] as &$counter) { $counter['until']=time()-1; }
 });
 do_action('noir_request_cleanup_ledger');
 reliability_check(count(reliability_ledger()['tokens'])===0 && count(reliability_ledger()['counters'])===0 && wp_next_scheduled('noir_request_cleanup_ledger'),'Scheduled cleanup actually removes expired token and abuse state');
 reliability_check(reliability_http([['url'=>$url]])[0]['code']===200,'Admission resumes after effective cleanup');
 reliability_ledger(function(&$ledger) {
  $ledger['counters']=[];
  for ($i=0;$i<1024;$i++) { $ledger['counters'][hash('sha256',(string)$i)]=['count'=>1,'until'=>time()+600]; }
 });
 $response=reliability_http([['url'=>$url]])[0];
 reliability_check($response['code']===429 && count(reliability_ledger()['counters'])===1024,'Abuse-state capacity refuses new identities without growth');
 reliability_ledger(function(&$ledger) { foreach ($ledger['counters'] as &$counter) { $counter['until']=time()-1; } });
 do_action('noir_request_cleanup_ledger');
 reliability_check(count(reliability_ledger()['counters'])===0,'Cleanup removes capacity-filling abuse state');

 $encoded=wp_json_encode(reliability_ledger());
 foreach (['Synthetic reliability customer','Synthetic vehicle','127.0.0.1','203.0.113.','submission_token','_noir_nonce','studio@example.test'] as $private) { reliability_check(!str_contains($encoded,$private),'Operational storage excludes '.$private); }
 reliability_reset(); reliability_mode('uncertain');
 passthru('node '.escapeshellarg(__DIR__.'/appointment-reliability-browser.cjs'),$browser_exit);
 reliability_check($browser_exit===0,'Real browser uncertainty and throttling work with and without JavaScript');
 $home=reliability_http([['url'=>home_url('/')]])[0];
 reliability_check(!str_contains($home['headers'],'no-store'),'Unrelated public pages remain cacheable');
} finally {
 reliability_ledger(function(&$ledger) use ($prior) { $ledger=$prior; });
 if ($original===null) { unlink($fixture); } else { file_put_contents($fixture,$original); }
 foreach ($controls as $file=>$prior_control) { if ($prior_control===null) { @unlink('/tmp/noir-ticket06/'.$file); } else { file_put_contents('/tmp/noir-ticket06/'.$file,$prior_control); } }
 @rmdir('/tmp/noir-ticket06');
}
