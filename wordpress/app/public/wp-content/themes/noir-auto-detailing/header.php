<?php defined('ABSPATH') || exit; $studio = noir_theme_studio(); ?>
<!doctype html><html <?php language_attributes(); ?>><head><meta charset="<?php bloginfo('charset'); ?>"><meta name="viewport" content="width=device-width, initial-scale=1"><?php wp_head(); ?></head>
<body <?php body_class(); ?>><?php wp_body_open(); ?>
<a class="skip-link" href="#main-content"><?php esc_html_e('Skip to content','noir-auto-detailing'); ?></a>
<header class="site-header"><div class="header-inner container">
<?php noir_identity(); ?>
<nav class="desktop-nav" aria-label="<?php esc_attr_e('Primary navigation','noir-auto-detailing'); ?>"><?php noir_navigation('primary'); ?></nav>
<div class="header-actions">
<?php if (!empty($studio['status'])) : ?><span class="studio-status"><span class="dot" aria-hidden="true"></span><?php echo esc_html($studio['status']); ?></span><?php endif; ?>
<span class="header-phone"><?php noir_public_contacts(); ?></span>
<?php noir_appointment_link('button header-appointment'); ?>
<span class="person" aria-hidden="true"><?php noir_icon('person'); ?></span>
<button class="nav-toggle" type="button" aria-controls="mobile-navigation" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation','noir-auto-detailing'); ?>" hidden><?php noir_icon('menu'); ?></button>
</div></div>
<div class="mobile-navigation container" id="mobile-navigation"><nav aria-label="<?php esc_attr_e('Mobile navigation','noir-auto-detailing'); ?>"><?php noir_navigation('primary'); ?></nav>
<div class="mobile-actions"><?php noir_public_contacts(); noir_appointment_link(); ?></div></div>
</header>
