<?php
// Explicit maintainer command. Never included on public requests or activation.
defined('ABSPATH') || exit;

class Noir_Bootstrap_Command {
 private const MENUS=['primary'=>'NOIR Primary','footer'=>'NOIR Footer','footer_services'=>'NOIR Services'];
 private $root;
 private $fixtures=[];
 private $assets=[];
 private $records=[];
 private $ids=[];
 private $state=[];
 private $report=['versions'=>[],'assets'=>[],'records'=>[],'drift'=>[],'conflicts'=>[],'acceptance_blockers'=>[]];

 /**
  * Reproduce the four-page baseline, preserving existing editorial records by default.
  *
  * ## OPTIONS
  *
  * --fixtures=<directory>
  * : Absolute path to tracked fixtures/noir.
  * [--dry-run]
  * : Validate and report without writing.
  * [--reset]
  * : Restore only fixture-owned editorial fields and assignments.
  * [--prototype]
  * : Allow temporarily authorized photography only in local/development environments.
  *
  * ## EXAMPLES
  *
  *     wp noir bootstrap --user=admin --fixtures=/project/fixtures/noir --prototype --dry-run
  */
 public function __invoke($args,$flags) {
  try {
   if (!current_user_can('manage_options')) { throw new RuntimeException('Use --user with an Administrator account.'); }
   if (!str_starts_with($flags['fixtures']??'','/')) { throw new RuntimeException('Use an absolute --fixtures path.'); }
   $this->root=realpath($flags['fixtures']);
   if (!$this->root || !is_dir($this->root)) { throw new RuntimeException('Supply an existing absolute --fixtures directory.'); }
   $prototype=isset($flags['prototype']);
   if ($prototype && !in_array(wp_get_environment_type(),['local','development'],true)) { throw new RuntimeException('--prototype is limited to local/development.'); }
   if (get_stylesheet()!=='noir-auto-detailing') { throw new RuntimeException('Activate the NOIR theme explicitly first.'); }
   $this->state=(array)get_option('noir_bootstrap',[]);
   $this->load($prototype,isset($flags['reset']));
   $this->plan();
   $this->report['mode']=isset($flags['reset'])?'reset':'preserve';
   $this->report['scope']=['fixture_records'=>array_keys($this->records),'menus'=>['primary','footer','footer_services'],'assignments'=>['page templates','Studio page roles','static front page','menu locations'],'preserved'=>['unrelated content','legal destinations','mail configuration','environment secrets','appointment state']];
   if (!isset($flags['dry-run'])) {
    // Scope is printed before reset, including on non-interactive runs.
    if (isset($flags['reset'])) { WP_CLI::log(wp_json_encode(['reset_scope'=>$this->report['scope']],JSON_PRETTY_PRINT)); }
    $this->apply(isset($flags['reset']));
   }
   WP_CLI::log(wp_json_encode($this->report,JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
  } catch (Throwable $error) { WP_CLI::error($error->getMessage()); }
 }

 private function json($file) {
  if (!is_readable($file)) { throw new RuntimeException('Missing fixture: '.$file); }
  return json_decode(file_get_contents($file),true,512,JSON_THROW_ON_ERROR);
 }
 private function valid($result,$label) {
  if (is_wp_error($result)) { throw new RuntimeException($label.': '.$result->get_error_message()); }
 }
 private function load($prototype,$reset) {
  $contact=$this->root.'/contact/baseline.php';
  if (!is_readable($contact)) { throw new RuntimeException('Missing Contact fixture.'); }
  $this->fixtures['contact']=require $contact;
  foreach (['services','gallery','home'] as $slice) { $this->fixtures[$slice]=$this->json($this->root.'/'.$slice.'/baseline.json'); }
  foreach ($this->fixtures as $slice=>$fixture) {
   if (!is_array($fixture) || !isset($fixture['sections'])) { throw new RuntimeException('Invalid '.$slice.' fixture.'); }
   $version=$fixture['version']??$fixture['fixture_version']??null;
   if (!$version) { throw new RuntimeException('Missing '.$slice.' fixture version.'); }
   $this->report['versions'][$slice]=['version'=>$version,'sha256'=>hash_file('sha256',$this->root.'/'.$slice.'/baseline.'.($slice==='contact'?'php':'json'))];
  }
  // Presentation assets are tracked separately from editorial Media Library assets.
  $theme_prefix='wordpress/app/public/wp-content/themes/noir-auto-detailing/';
  foreach ($this->json($this->root.'/contact/assets.json')['assets'] as $asset) {
   if (!str_starts_with($asset['file'],$theme_prefix) || !str_starts_with($asset['license_file'],$theme_prefix)) { throw new RuntimeException('Presentation asset must belong to the NOIR theme.'); }
   $file=get_stylesheet_directory().'/'.substr($asset['file'],strlen($theme_prefix));
   $license=get_stylesheet_directory().'/'.substr($asset['license_file'],strlen($theme_prefix));
   if (!is_readable($file) || hash_file('sha256',$file)!==$asset['sha256'] || !is_readable($license)) { throw new RuntimeException('Missing/changed local asset or license: '.$asset['file']); }
  }
  $gallery_icons=$this->json($this->root.'/gallery/icons.json');
  if (empty($gallery_icons['rights']) || empty($gallery_icons['license'])) { throw new RuntimeException('Missing Gallery icon rights.'); }
  $icons=array_merge($this->json($this->root.'/services/icons.json'),array_map(function($asset) { return ['file'=>basename($asset['source']),'sha256'=>$asset['sha256']]; },$gallery_icons['assets']));
  foreach ($icons as $asset) {
   $file=get_stylesheet_directory().'/assets/icons/'.$asset['file'];
   if (!is_readable($file) || hash_file('sha256',$file)!==$asset['sha256']) { throw new RuntimeException('Missing/changed Service icon: '.$asset['file']); }
  }
  foreach (['services','gallery','home'] as $slice) {
   $manifest=$this->json($this->root.'/'.$slice.'/assets.json');
   $this->report['versions'][$slice]['manifest_sha256']=hash_file('sha256',$this->root.'/'.$slice.'/assets.json');
   foreach (($manifest['assets']??$manifest) as $asset) {
    $role=$asset['id']??$asset['role']??$asset['asset_id']??'';
    if (!$role || isset($this->assets[$slice.':'.$role])) { throw new RuntimeException('Duplicate/empty asset identity in '.$slice); }
    $relative=$asset['source']??'media/'.($asset['file']??'');
    $file=realpath($this->root.'/'.$slice.'/'.$relative);
    if (!$file || !str_starts_with($file,$this->root.'/'.$slice.'/') || !is_readable($file) || hash_file('sha256',$file)!==($asset['sha256']??'')) { throw new RuntimeException('Missing asset/checksum mismatch: '.$slice.':'.$role); }
    $dimensions=$asset['dimensions']??['width'=>$asset['width']??0,'height'=>$asset['height']??0];
    $expected=array_values($dimensions); $actual=getimagesize($file);
    if (!$actual || [$actual[0],$actual[1]]!==$expected || !isset($asset['alt'],$asset['crop'])) { throw new RuntimeException('Invalid asset dimensions/alternative/crop: '.$role); }
    $rights=$asset['rights_evidence']??$asset['usage']??'';
    if (!$rights) { throw new RuntimeException('Missing rights evidence: '.$role); }
    if (($asset['rights_status']??'')!=='cleared') {
     $this->report['acceptance_blockers'][]='rights:'.$slice.':'.$role;
     if (!$prototype || ($asset['rights_status']??'')!=='not-yet-rights-cleared') { throw new RuntimeException('Production rights not cleared: '.$slice.':'.$role.' (local prototype requires --prototype).'); }
    }
    $this->assets[$slice.':'.$role]=['file'=>$file,'sha256'=>$asset['sha256'],'alt'=>$asset['alt'],'rights'=>$asset['rights_status'],'role'=>$role,'slice'=>$slice];
   }
  }
  foreach (['services','gallery','home'] as $slice) {
   $kind=$slice==='services'?'service':'project';
   foreach ($this->fixtures[$slice][$kind.'s']??[] as $row) {
    $identity=$row[$kind.'_id']??''; $key=$kind.':'.$identity;
    if (!$identity || isset($this->records[$key])) { throw new RuntimeException('Duplicate/empty record identity: '.$key); }
    $this->valid(noir_validate_fields($row['title']??null,noir_text_schema(1,180),'Title'),$key);
    $facts=$this->images($row['facts'],$slice,[],true);
    $this->valid(noir_validate_fields($facts,$kind==='service'?noir_service_schema():noir_project_schema(),'Facts'),$key);
    if ($kind==='service' && !in_array($identity,noir_service_ids(),true)) { throw new RuntimeException('Unknown Service identity: '.$identity); }
    if ($kind==='project' && !preg_match('/^[a-z0-9][a-z0-9-]{0,79}$/D',$identity)) { throw new RuntimeException('Invalid Project identity.'); }
    $image=$row['image']??null;
    if (!is_string($image) || !isset($this->assets[$slice.':'.$image])) { throw new RuntimeException('Required primary image: '.$key); }
    $this->records[$key]=['type'=>'noir_'.$kind,'title'=>$row['title'],'slug'=>$identity,'slice'=>$slice,'meta'=>['_noir_'.$kind.'_id'=>$identity,'_noir_'.$kind.'_facts'=>$row['facts'],'_thumbnail_id'=>$image]];
   }
  }
  $service_count=count(array_filter(array_keys($this->records),function($key) { return str_starts_with($key,'service:'); }));
  if ($service_count!==5 || count($this->records)!==13) { throw new RuntimeException('Baseline requires five Services and eight Projects.'); }
  foreach ($this->fixtures as $slice=>$fixture) {
   $schemas=call_user_func('noir_'.($slice==='contact'?'contact':$slice.'_page').'_schemas');
   if (array_diff(array_keys($fixture['sections']),array_keys($schemas)) || array_diff(array_keys($schemas),array_keys($fixture['sections']))) { throw new RuntimeException('Missing/unknown fixed sections: '.$slice); }
   $meta=['_wp_page_template'=>'page-'.$slice.'.php'];
   foreach ($fixture['sections'] as $section=>$value) {
    $this->valid(noir_validate_fields($this->images($value,$slice,[],true),$schemas[$section],$section),$slice);
    if ($section==='placements') {
     $seen=[];
     foreach ($value as $row) {
      if (!isset($this->records['project:'.$row['project_id']]) || isset($seen[$row['project_id']])) { throw new RuntimeException('Missing/duplicate Project placement in '.$slice); }
      $seen[$row['project_id']]=true;
     }
    }
    $meta['_noir_'.$slice.'_'.$section]=$value;
   }
   $this->records['page:'.$slice]=['type'=>'page','title'=>ucfirst($slice),'slug'=>$slice,'slice'=>$slice,'meta'=>$meta];
  }
  // Validate shared facts separately from native assignments, which can need repair.
  $this->valid(noir_validate_studio_facts($this->fixtures['contact']['studio']),'Studio fixture');
  $existing=noir_studio_settings();
  if ($existing) {
   if (!$reset) { $this->valid(noir_validate_studio_facts($existing),'Existing Studio facts'); }
   foreach ($existing['pages']??[] as $role=>$id) {
    if (!in_array($role,['home','services','gallery','contact'],true) || (!is_int($id) && !(is_string($id) && ctype_digit($id)))) { throw new RuntimeException('Invalid existing page assignment input: '.$role); }
    if (get_post($id) && !noir_published_page($id)) { $this->report['acceptance_blockers'][]='unpublished-page:'.$role; }
   }
   foreach (['privacy','terms'] as $legal) { if (!empty($existing[$legal]) && !noir_destination($existing[$legal])) { throw new RuntimeException('Invalid existing legal destination: '.$legal); } }
   if (!empty($existing['pages']['contact']) && get_post($existing['pages']['contact']) && get_page_template_slug($existing['pages']['contact'])!=='page-contact.php') { $this->report['conflicts'][]='Contact template assignment'; }
   if (count(array_unique($existing['pages']??[]))!==count($existing['pages']??[])) { $this->report['conflicts'][]='duplicate Studio page assignments'; }
  }
  foreach (['privacy','terms'] as $legal) { if (!noir_destination(noir_studio_settings()[$legal]??'')) { $this->report['acceptance_blockers'][]='legal:'.$legal; } }
  if (!noir_request_mail_configuration()) { $this->report['acceptance_blockers'][]='mail:configuration'; }
 }

 private function images($value,$slice,$mapping,$validate=false,$key='') {
  if (in_array($key,['image','before_image','after_image','_thumbnail_id'],true)) {
   if ($value===0) { return 0; }
   if (!is_string($value) || !isset($this->assets[$slice.':'.$value])) { throw new RuntimeException('Unknown media reference: '.$slice.':'.(is_scalar($value)?$value:'invalid')); }
   return $validate?1:$mapping[$slice.':'.$value];
  }
  if (is_array($value) && isset($value['before_image'],$value['after_image']) && (bool)$value['before_image']!==(bool)$value['after_image']) { throw new RuntimeException('Incomplete comparison pair: '.$slice); }
  if (is_array($value)) { foreach ($value as $name=>$item) { $value[$name]=$this->images($item,$slice,$mapping,$validate,$name); } }
  return $value;
 }
 private function find($type,$meta,$identity) {
  $ids=get_posts(['post_type'=>$type,'post_status'=>array_keys(get_post_stati()),'posts_per_page'=>-1,'fields'=>'ids','meta_key'=>$meta,'meta_value'=>$identity]);
  if (count($ids)>1) { throw new RuntimeException('Duplicate runtime identity: '.$identity); }
  return $ids[0]??0;
 }
 private function plan() {
  $pages=noir_studio_settings()['pages']??[];
  foreach ($this->records as $key=>$record) {
   [$kind,$identity]=explode(':',$key,2);
   $id=$kind==='page'?($this->state['records'][$key]??$pages[$identity]??0):$this->find($record['type'],'_noir_'.$kind.'_id',$identity);
   if (!$id && $kind!=='page') {
    $candidate=$this->state['records'][$key]??0;
    if ($candidate && get_post_type($candidate)===$record['type']) {
     $stored=get_post_meta($candidate,'_noir_'.$kind.'_id',true);
     if ($stored!=='' && $stored!==$identity) { throw new RuntimeException('Conflicting importer identity: '.$key); }
     $id=$candidate;
    }
   }
   if ($id && get_post_type($id)!==$record['type']) { $id=0; }
   if ($id && $kind==='page' && !isset($this->state['records'][$key]) && get_page_template_slug($id)!=='page-'.$identity.'.php' && get_post_field('post_name',$id)!==$identity) {
    $this->report['conflicts'][]='Unowned Studio page role:'.$identity; $id=0;
   }
   if (!$id && $kind==='page' && get_page_by_path($record['slug'],OBJECT,'page')) { throw new RuntimeException('Unowned page slug conflict: '.$record['slug']); }
   $this->ids[$key]=(int)$id;
   $this->report['records'][$key]=['id'=>(int)$id,'action'=>$id?'preserve/report drift':'create'];
  }
  // Hash actual original files, not stale attachment metadata. A matching owned
  // source is reused even if the previous slice did not record its checksum.
  $hashes=[];
  foreach (get_posts(['post_type'=>'attachment','post_status'=>['inherit','publish','private'],'posts_per_page'=>-1,'fields'=>'ids']) as $id) {
   $file=get_attached_file($id);
   if ($file && is_readable($file)) { $hashes[hash_file('sha256',$file)][]=$id; }
  }
  foreach ($this->assets as $key=>&$asset) {
   $id=$this->state['assets'][$key]??$this->find('attachment','_noir_asset_id',$asset['slice']==='services'?$asset['role']:$asset['slice'].'-'.$asset['role']);
   if ($id && !noir_image_valid((int)$id)) { $id=0; }
   if ($id) {
    $file=get_attached_file($id);
    if (!$file || !is_readable($file) || hash_file('sha256',$file)!==$asset['sha256']) {
     $this->report['drift'][]='attachment:'.$key;
     $this->report['acceptance_blockers'][]='runtime-media:'.$key;
     // Preserve the edited attachment; reset will restore references to a matching source.
     $asset['changed']=true;
     $asset['reset_id']=$hashes[$asset['sha256']][0]??0;
    }
   } else { $id=$hashes[$asset['sha256']][0]??0; }
   $asset['id']=(int)$id;
   $this->report['assets'][$key]=['id'=>(int)$id,'action'=>$id?'reuse':'import','sha256'=>$asset['sha256']];
  }
  unset($asset);
  $mapping=array_map(function($asset) { return $asset['id']; },$this->assets);
  foreach ($this->records as $key=>$record) {
   $id=$this->ids[$key]; if (!$id) { continue; }
   $post=get_post($id);
   foreach (['post_title'=>$record['title'],'post_name'=>$record['slug'],'post_status'=>'publish','post_content'=>''] as $field=>$expected) {
    if ($post->$field!==$expected) { $this->report['drift'][]=$key.':'.$field; }
   }
   foreach ($record['meta'] as $meta=>$value) {
    $expected=$this->images($value,$record['slice'],$mapping,false,$meta);
    if (get_post_meta($id,$meta,true)!=$expected) { $this->report['drift'][]=$key.':'.$meta; }
   }
   if (isset($pages[$record['slice']]) && $record['type']==='page' && (int)$pages[$record['slice']]!==$id) { $this->report['conflicts'][]='Studio page role:'.$record['slice']; }
  }
  $settings=noir_studio_settings();
  foreach ($this->fixtures['contact']['studio'] as $field=>$value) {
   if (!in_array($field,['privacy','terms'],true) && $settings && ($settings[$field]??null)!=$value) { $this->report['drift'][]='Studio:'.$field; }
  }
  $front=(int)get_option('page_on_front');
  if ($front && ($front!==$this->ids['page:home'] || get_option('show_on_front')!=='page')) { $this->report['conflicts'][]='static front page'; }
  $locations=get_nav_menu_locations();
  foreach (self::MENUS as $location=>$name) {
   $menu=$this->state['menus'][$location]['id']??0;
   if (!$menu) { $term=wp_get_nav_menu_object($name); $menu=$term?$term->term_id:0; }
   if (!empty($locations[$location]) && (int)$locations[$location]!== (int)$menu) { $this->report['conflicts'][]='menu location:'.$location; }
   $this->report['menus'][$location]=['id'=>(int)$menu,'action'=>$menu?'preserve/report drift':'create'];
   if ($menu) {
    $items=wp_get_nav_menu_items($menu)?:[];
    $targets=$location==='footer_services'?noir_service_ids():['home','services','gallery','contact'];
    foreach ($targets as $position=>$target) {
     $service=$location==='footer_services'; $page=$this->ids['page:'.($service?'services':$target)];
     $found=$this->menu_item($location,$target,$page,$items);
     $title=$service?get_the_title($this->ids['service:'.$target]):'';
     if (!$found || $found->object!=='page' || (int)$found->object_id!==$page || (int)$found->menu_order!==$position+1 || get_post_field('post_title',$found->ID)!==$title) {
      $this->report['drift'][]='menu:'.$location.':'.$target;
     }
    }
    if (count($items)>count($targets)) { $this->report['drift'][]='menu:'.$location.':additional-items-preserved'; }
   }
  }
 }
 private function meta($id,$key,$value) {
  update_post_meta($id,$key,wp_slash($value));
  if (get_post_meta($id,$key,true)!=$value) { throw new RuntimeException('Metadata write rejected: '.$id.':'.$key); }
 }
 private function apply($reset) {
  require_once ABSPATH.'wp-admin/includes/file.php';
  require_once ABSPATH.'wp-admin/includes/media.php';
  require_once ABSPATH.'wp-admin/includes/image.php';
  $mapping=[];
  foreach ($this->assets as $key=>$asset) {
   $id=$asset['id'];
   if ($reset && !empty($asset['changed'])) { $id=$asset['reset_id']; }
   if (!$id) {
    $tmp=wp_tempnam($asset['file']);
    if (!$tmp || !copy($asset['file'],$tmp)) { throw new RuntimeException('Cannot stage asset: '.$key); }
    $id=media_handle_sideload(['name'=>basename($asset['file']),'tmp_name'=>$tmp],0);
    if (is_wp_error($id)) { @unlink($tmp); throw new RuntimeException($id->get_error_message()); }
    $this->meta($id,'_wp_attachment_image_alt',$asset['alt']);
   } elseif ($reset) { $this->meta($id,'_wp_attachment_image_alt',$asset['alt']); }
   $mapping[$key]=(int)$id;
   $this->state['assets'][$key]=(int)$id;
   $this->state['asset_provenance'][$key]=['sha256'=>$asset['sha256'],'rights_status'=>$asset['rights']];
   update_option('noir_bootstrap',$this->state,false);
  }
  // Records precede page collections, so reference validation sees all Projects.
  foreach ($this->records as $key=>$record) {
   $id=$this->ids[$key]; $new=!$id;
   if ($new || $reset) {
    $data=['post_type'=>$record['type'],'post_status'=>'publish','post_title'=>$record['title'],'post_name'=>$record['slug'],'post_content'=>''];
    if ($id) { $data['ID']=$id; }
    $id=wp_insert_post(wp_slash($data),true); $this->valid($id,$key);
    $this->state['records'][$key]=(int)$id;
    update_option('noir_bootstrap',$this->state,false);
   }
   foreach ($record['meta'] as $meta=>$value) {
    if ($new || $reset || !metadata_exists('post',$id,$meta) || ($meta==='_wp_page_template' && in_array(get_post_meta($id,$meta,true),['','default'],true))) {
     $this->meta($id,$meta,$this->images($value,$record['slice'],$mapping,false,$meta));
    }
   }
   if ($new || $reset) { wp_save_post_revision($id); }
   $this->ids[$key]=(int)$id;
   $this->state['records'][$key]=(int)$id;
   $this->state['baselines'][$key]=hash('sha256',wp_json_encode($record));
   // Checkpoint independently of editorial revisions; resumable after I/O failure.
   update_option('noir_bootstrap',$this->state,false);
  }
  $old=noir_studio_settings();
  $settings=$old?:$this->fixtures['contact']['studio'];
  if ($reset) { $settings=array_replace($settings,$this->fixtures['contact']['studio']); foreach (['privacy','terms'] as $legal) { $settings[$legal]=$old[$legal]??''; } }
  foreach (['home','services','gallery','contact'] as $role) {
   if ($reset || empty($settings['pages'][$role]) || !get_post($settings['pages'][$role])) { $settings['pages'][$role]=$this->ids['page:'.$role]; }
  }
  $valid=noir_validate_studio($settings);
  if (is_wp_error($valid) && !$reset && $old) {
   $this->report['conflicts'][]='Studio settings preserved: '.$valid->get_error_message();
   $this->report['acceptance_blockers'][]='settings:assignments';
  } else {
   $this->valid($valid,'Studio settings');
   update_option('noir_studio',$settings);
   if (noir_studio_settings()!=$settings) { throw new RuntimeException('Studio settings write failed.'); }
  }
  if ($reset || !(int)get_option('page_on_front') || !get_post((int)get_option('page_on_front'))) { update_option('show_on_front','page'); update_option('page_on_front',$this->ids['page:home']); }
  $this->menus($reset);
  $this->state['versions']=$this->report['versions'];
  update_option('noir_bootstrap',$this->state,false);
  $this->report['native_ids']=$this->ids;
 }
 private function menu_item($location,$target,$page,$items) {
  $tracked=$this->state['menus'][$location]['items'][$target]??0;
  foreach ($items as $item) { if ($item->ID===$tracked) { return $item; } }
  foreach ($items as $item) {
   if (($location==='footer_services' && get_post_meta($item->ID,'_noir_service_ref',true)===$target) ||
    ($location!=='footer_services' && $item->object==='page' && (int)$item->object_id===$page)) { return $item; }
  }
  return null;
 }
 private function menus($reset) {
  $locations=get_nav_menu_locations();
  foreach (self::MENUS as $location=>$name) {
   $id=$this->report['menus'][$location]['id'];
   if ($id && !wp_get_nav_menu_object($id)) { $id=0; }
   if (!$id) { $id=wp_create_nav_menu($name); $this->valid($id,$name); }
   $existing=wp_get_nav_menu_items($id)?:[];
   $targets=$location==='footer_services'?noir_service_ids():['home','services','gallery','contact'];
   foreach ($targets as $position=>$target) {
    $service=$location==='footer_services';
    $page=$this->ids['page:'.($service?'services':$target)];
    $found=$this->menu_item($location,$target,$page,$existing);
    $item=$found?$found->ID:0;
    if ($item && !$reset && get_post_meta($item,'_menu_item_object',true)==='page' && !get_post((int)get_post_meta($item,'_menu_item_object_id',true))) {
     // Repair a missing native reference while preserving its human label/order.
     $this->meta($item,'_menu_item_object_id',$page);
    }
    if (!$item || $reset) {
     $data=['menu-item-status'=>'publish','menu-item-position'=>$position+1,'menu-item-type'=>'post_type','menu-item-object'=>'page','menu-item-object-id'=>$page];
     if ($service) { $data['menu-item-title']=get_the_title($this->ids['service:'.$target]); }
     $item=wp_update_nav_menu_item($id,$item,$data); $this->valid($item,$name);
     if ($service) { $this->meta($item,'_noir_service_ref',$target); }
    }
    $this->state['menus'][$location]['items'][$target]=(int)$item;
   }
   $this->state['menus'][$location]['id']=(int)$id;
   if ($reset || empty($locations[$location])) { $locations[$location]=(int)$id; }
  }
  set_theme_mod('nav_menu_locations',$locations);
 }
}
WP_CLI::add_command('noir bootstrap','Noir_Bootstrap_Command');
