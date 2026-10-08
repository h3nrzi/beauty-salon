<?php
/** Bounded pilot-only operational state. Never persist customer fields or mail. */
defined('ABSPATH') || exit;

function noir_request_network() {
 $peer=$_SERVER['REMOTE_ADDR']??'';
 $trusted=defined('NOIR_TRUSTED_PROXIES') && is_array(NOIR_TRUSTED_PROXIES) ? NOIR_TRUSTED_PROXIES : [];
 if (in_array($peer,$trusted,true)) {
  $forwarded=$_SERVER['HTTP_X_FORWARDED_FOR']??'';
  if (!is_string($forwarded) || strlen($forwarded)>1024) { return false; }
  $chain=array_map('trim',explode(',',$forwarded));
  foreach ($chain as $address) { if (!filter_var($address,FILTER_VALIDATE_IP)) { return false; } }
  while (in_array($peer,$trusted,true) && $chain) { $peer=array_pop($chain); }
 }
 if (!filter_var($peer,FILTER_VALIDATE_IP)) { return false; }
 return noir_request_digest('network',bin2hex(inet_pton($peer)));
}

/** Use the pinned mysqli connection directly: wpdb's automatic reconnect loses advisory locks. */
function noir_request_store($change) {
 global $wpdb;
 $connection=$wpdb->dbh;
 if (!($connection instanceof mysqli)) { return false; }
 $lock='noir:'.substr(hash('sha256',DB_NAME.'|'.$wpdb->options),0,48);
 $previous=$wpdb->suppress_errors(true);
 $locked=false;
 try {
  $query=function($sql) use ($connection) {
   $result=mysqli_query($connection,$sql);
   if ($result===false) { throw new RuntimeException('Appointment storage unavailable'); }
   return $result;
  };
  $scalar=function($sql) use ($query) {
   $result=$query($sql);
   return $result instanceof mysqli_result ? ($result->fetch_row()[0]??null) : null;
  };
  $locked=(string)$scalar($wpdb->prepare('SELECT GET_LOCK(%s, 1)',$lock))==='1';
  if (!$locked) { return false; }
  $sql=$wpdb->prepare("SELECT option_value FROM {$wpdb->options} WHERE option_name=%s",'noir_request_ledger');
  $raw=$scalar($sql);
  if ($raw===null) {
   $ledger=['version'=>1,'tokens'=>[],'counters'=>[]];
   $encoded=wp_json_encode($ledger);
   if (!$query($wpdb->prepare("INSERT INTO {$wpdb->options} (option_name, option_value, autoload) VALUES (%s,%s,'off')",'noir_request_ledger',$encoded))) { return false; }
  } else {
   $ledger=json_decode($raw,true);
   if (!is_array($ledger) || ($ledger['version']??0)!==1 || !is_array($ledger['tokens']??null) || !is_array($ledger['counters']??null) || count($ledger['tokens'])>768 || count($ledger['counters'])>1024) { return false; }
  }
  $now=time();
  foreach ($ledger['tokens'] as $digest=>$state) {
   if (!preg_match('/^[a-f0-9]{64}$/D',$digest) || !is_array($state) || !isset($state['retain_until'],$state['expires'],$state['visitor'],$state['user'],$state['status']) || !is_int($state['retain_until']) || !is_int($state['expires']) || !is_string($state['visitor']) || !preg_match('/^[a-f0-9]{64}$/D',$state['visitor']) || !is_string($state['user']) || !preg_match('/^[a-f0-9]{64}$/D',$state['user']) || !in_array($state['status'],['issued','processing','accepted','uncertain'],true)) { return false; }
   if ($state['retain_until']<=$now) { unset($ledger['tokens'][$digest]); }
  }
  foreach ($ledger['counters'] as $key=>$counter) {
   if (!is_array($counter) || !is_int($counter['until']??null) || !is_int($counter['count']??null)) { return false; }
   if ($counter['until']<=$now) { unset($ledger['counters'][$key]); }
  }
  $outcome=$change($ledger,$now);
  $encoded=wp_json_encode($ledger);
  // The write itself checks ownership. Lost connection/lock cannot authorize sending.
  if (!$encoded || !$query($wpdb->prepare("UPDATE {$wpdb->options} SET option_value=%s WHERE option_name=%s AND IS_USED_LOCK(%s)=CONNECTION_ID()",$encoded,'noir_request_ledger',$lock))) { return false; }
  if ((string)$scalar($wpdb->prepare('SELECT IS_USED_LOCK(%s)=CONNECTION_ID()',$lock))!=='1' || $scalar($sql)!==$encoded) { return false; }
  return $outcome;
 } catch (Throwable $error) {
  return false;
 } finally {
  if ($locked) { try { mysqli_query($connection,$wpdb->prepare('SELECT RELEASE_LOCK(%s)',$lock)); } catch (Throwable $error) { /* Closed connection already released it. */ } }
  $wpdb->suppress_errors($previous);
 }
}

function noir_request_allow(&$ledger,$now,$kind,$network,$visitor) {
 $limits=$kind==='issue' ? ['global'=>120,'network'=>40,'visitor'=>20] : ['global'=>240,'network'=>80,'visitor'=>30];
 $identities=['global'=>'all','network'=>$network,'visitor'=>$visitor?:'missing'];
 $keys=[]; $retry=0;
 foreach ($limits as $scope=>$limit) {
  $key=noir_request_digest('throttle:'.$kind.':'.$scope,$identities[$scope]);
  $keys[]=$key;
  $counter=$ledger['counters'][$key]??['count'=>0,'until'=>$now+600];
  if ($counter['count']>=$limit) { $retry=max($retry,$counter['until']-$now); }
 }
 $new=count(array_filter($keys,fn($key)=>!isset($ledger['counters'][$key])));
 if (count($ledger['counters'])+$new>1024) { $retry=max($retry,600); }
 if ($retry) { return ['code'=>429,'retry'=>$retry]; }
 foreach ($keys as $key) {
  if (!isset($ledger['counters'][$key])) { $ledger['counters'][$key]=['count'=>0,'until'=>$now+600]; }
  $ledger['counters'][$key]['count']++;
 }
 return ['code'=>200];
}
function noir_request_operational_failure($outcome) {
 if (is_array($outcome) && ($outcome['code']??0)===429) {
  header('Retry-After: '.max(1,(int)$outcome['retry']));
  noir_request_response(429,['message'=>__('Too many online requests. Please wait before trying again, or contact the Studio directly.','noir-studio')]);
 }
 noir_request_response(503,['message'=>__('Online requests cannot be safely processed. Contact the Studio directly.','noir-studio')]);
}
function noir_request_pending() {
 noir_request_response(503,['message'=>__('The sending outcome is pending or uncertain. Contact the Studio to verify your request. Do not resubmit this request.','noir-studio')]);
}
function noir_request_cleanup_ledger() {
 return noir_request_store(function(&$ledger,$now) { return ['code'=>200]; });
}
add_action('noir_request_cleanup_ledger','noir_request_cleanup_ledger');
add_action('init',function() {
 if (!wp_next_scheduled('noir_request_cleanup_ledger')) { wp_schedule_event(time()+300,'hourly','noir_request_cleanup_ledger'); }
});
