<?php
// Reusable Services/Home/Gallery component. An incomplete pair remains a single figure.
defined('ABSPATH') || exit;
$comparison = $args['comparison'];
$images = [];
foreach (['before','after'] as $side) { if (!empty($comparison[$side.'_image'])) { $images[$side]=$comparison[$side.'_image']; } }
if (!$images) { return; }
$range_id = wp_unique_id('comparison-range-');
?>
<div class="comparison" data-comparison><div class="comparison-images">
<?php foreach ($images as $side=>$image) : ?><figure class="comparison-<?php echo esc_attr($side); ?>"><?php echo wp_get_attachment_image($image,'large',false,['sizes'=>'(min-width: 1024px) 55vw, 100vw','loading'=>!empty($args['primary'])?'eager':'lazy','fetchpriority'=>!empty($args['primary']) && $side==='before'?'high':'auto']); ?><figcaption><?php echo esc_html($comparison[$side.'_label']); ?></figcaption></figure><?php endforeach; ?>
<?php if (count($images)===2) : ?><div class="comparison-control" hidden><label class="screen-reader-text" for="<?php echo esc_attr($range_id); ?>"><?php esc_html_e('Before and after comparison — reveal after image','noir-auto-detailing'); ?></label><input id="<?php echo esc_attr($range_id); ?>" data-value-label="<?php echo esc_attr__('%s% after image revealed','noir-auto-detailing'); ?>" type="range" dir="rtl" min="0" max="100" step="1" value="50"><span class="comparison-divider" aria-hidden="true"><span class="comparison-handle"><svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="m8 6-6 6 6 6m8-12 6 6-6 6"/></svg></span></span></div><?php endif; ?></div></div>
