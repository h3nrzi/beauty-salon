<?php defined('ABSPATH') || exit; $studio = noir_theme_studio(); ?>
<footer class="site-footer"><div class="container"><div class="footer-grid">
<div><?php noir_identity(); ?><p class="muted"><?php echo esc_html($studio['description']??get_bloginfo('description')); ?></p></div>
<div><h2 class="label footer-heading"><?php esc_html_e('Navigation','noir-auto-detailing'); ?></h2><nav aria-label="<?php esc_attr_e('Footer navigation','noir-auto-detailing'); ?>"><?php noir_navigation('footer'); noir_appointment_link('text-link'); ?></nav></div>
<div><h2 class="label footer-heading"><?php esc_html_e('Services','noir-auto-detailing'); ?></h2>
<nav aria-label="<?php esc_attr_e('Services','noir-auto-detailing'); ?>"><?php noir_navigation('footer_services'); ?></nav>
</div>
<div><h2 class="label footer-heading"><?php esc_html_e('Operating Hours & Location','noir-auto-detailing'); ?></h2><?php noir_hours(); ?><div class="footer-contact"><span class="small-label"><?php esc_html_e('Studio Location','noir-auto-detailing'); ?></span><?php noir_address(); noir_public_contacts(); noir_email_link(); ?></div></div>
</div><div class="footer-bottom"><p>© <?php echo esc_html(wp_date('Y')); ?> <?php echo esc_html(get_bloginfo('name')); ?>. <?php esc_html_e('All rights reserved.','noir-auto-detailing'); ?></p>
<div><?php foreach (['privacy'=>__('Privacy Policy','noir-auto-detailing'),'terms'=>__('Terms of Service','noir-auto-detailing')] as $key=>$label) { $url = noir_theme_destination($studio[$key]??''); if ($url) { echo '<a href="'.esc_url($url).'">'.esc_html($label).'</a>'; } } ?></div>
</div></div></footer><?php wp_footer(); ?></body></html>
