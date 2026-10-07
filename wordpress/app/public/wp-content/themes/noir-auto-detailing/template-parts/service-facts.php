<?php defined('ABSPATH') || exit; $service = $args['service'];
if ($service['price']!==null) { ?><div><dt class="small-label muted"><?php esc_html_e('Starting At','noir-auto-detailing'); ?></dt><dd class="price"><?php echo esc_html('$'.number_format($service['price']/100,$service['price']%100?2:0)); ?></dd></div><?php }
if ($service['duration']!==null) { ?><div><dt class="small-label muted"><?php esc_html_e('Duration','noir-auto-detailing'); ?></dt><dd><?php echo esc_html($service['duration']); ?></dd></div><?php }
?>
