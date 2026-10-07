<?php
/** Template Name: Contact / Appointment Request */
defined('ABSPATH') || exit;
get_header();
$studio = noir_theme_studio();
$content = [];
foreach (['intro','response','form','standards','process'] as $section) { $content[$section] = get_post_meta(get_queried_object_id(),'_noir_contact_'.$section,true); }
?>
<main id="main-content" tabindex="-1" class="contact-main"><div class="container contact-container">
<div class="contact-intro"><div>
<?php if (!empty($content['intro']['eyebrow'])) : ?><p class="eyebrow"><span class="dot" aria-hidden="true"></span><?php echo esc_html($content['intro']['eyebrow']); ?></p><?php endif; ?>
<h1><?php echo esc_html($content['intro']['heading']??get_the_title()); ?></h1>
<p class="introduction muted"><?php echo esc_html($content['intro']['body']??''); ?></p>
</div>
<?php if (!empty($content['response']['heading'])) : ?><aside class="response-card" aria-labelledby="response-heading"><h2 class="label accent" id="response-heading"><?php noir_icon('verified'); echo esc_html($content['response']['heading']); ?></h2><p class="muted"><?php echo esc_html($content['response']['body']); ?></p></aside><?php endif; ?>
</div>
<div class="contact-grid"><div class="studio-column">
<section class="panel studio-details" aria-labelledby="studio-details-heading"><div class="panel-top"><h2 class="label accent" id="studio-details-heading"><?php esc_html_e('Studio Details & Location','noir-auto-detailing'); ?></h2><span class="small-label"><?php esc_html_e('Beverly Hills Studio','noir-auto-detailing'); ?></span></div>
<p class="muted studio-description"><?php echo esc_html($studio['description']??''); ?></p>
<div class="contact-facts">
<div class="fact"><?php noir_icon('call'); ?><div><h3 class="small-label"><?php esc_html_e('Telephone','noir-auto-detailing'); ?></h3><?php noir_public_contacts(true); ?></div></div>
<div class="fact"><?php noir_icon('mail'); ?><div><h3 class="small-label"><?php esc_html_e('Email Inquiries','noir-auto-detailing'); ?></h3><?php noir_email_link(); ?><span class="small-label contact-note"><?php esc_html_e('Client services & appointment desk','noir-auto-detailing'); ?></span></div></div>
<div class="fact"><?php noir_icon('location_on'); ?><div><h3 class="small-label"><?php esc_html_e('Studio Address','noir-auto-detailing'); ?></h3><address><?php noir_address(); ?></address><?php $directions = noir_theme_destination($studio['directions']??''); if ($directions) : ?><a class="text-link" href="<?php echo esc_url($directions); ?>"><?php esc_html_e('Get Directions','noir-auto-detailing'); ?></a><?php endif; ?></div></div>
</div><div class="hours-panel"><h3 class="label accent"><?php esc_html_e('Opening Hours','noir-auto-detailing'); ?></h3><?php noir_hours(); ?></div>
</section>
<?php if (!empty($content['standards']) && is_array($content['standards'])) : ?><section class="panel standards" aria-labelledby="standards-heading"><h2 class="label accent" id="standards-heading"><?php esc_html_e('Studio Details & Standards','noir-auto-detailing'); ?></h2>
<?php foreach ($content['standards'] as $standard) : ?><div class="standard"><span class="standard-icon"><?php noir_icon($standard['icon']); ?></span><div><h3><?php echo esc_html($standard['title']); ?></h3><p class="muted"><?php echo esc_html($standard['body']); ?></p></div></div><?php endforeach; ?>
</section><?php endif; ?>
</div>
<section class="panel appointment-panel" id="appointment-request" aria-labelledby="appointment-heading"><div class="appointment-intro"><div class="panel-top"><p class="label accent"><?php echo esc_html($content['form']['eyebrow']??__('Appointment Request','noir-auto-detailing')); ?></p><span class="small-label"><?php esc_html_e('Response within 1 Business Day','noir-auto-detailing'); ?></span></div><h2 id="appointment-heading"><?php echo esc_html($content['form']['heading']??__('Request an Appointment','noir-auto-detailing')); ?></h2><p class="muted"><?php echo esc_html($content['form']['body']??''); ?></p></div>
<?php get_template_part('template-parts/appointment'); ?>
</section></div>
<?php if (!empty($content['process']) && is_array($content['process'])) : ?><section class="process panel" aria-label="<?php esc_attr_e('Appointment process','noir-auto-detailing'); ?>"><h2 class="screen-reader-text"><?php esc_html_e('Appointment process','noir-auto-detailing'); ?></h2><ol>
<?php foreach ($content['process'] as $index=>$step) : ?><li><span class="label accent"><?php echo esc_html(sprintf(__('Step %02d','noir-auto-detailing'),$index+1)); ?></span><h3><?php echo esc_html($step['title']); ?></h3><p class="muted"><?php echo esc_html($step['body']); ?></p></li><?php endforeach; ?>
</ol></section><?php endif; ?>
</div></main><?php get_footer(); ?>
