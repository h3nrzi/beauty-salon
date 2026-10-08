<?php
/** Template Name: Gallery */
defined('ABSPATH') || exit;
get_header();
$page=get_queried_object_id();
$sections=function_exists('noir_gallery_page')?noir_gallery_page($page):[];
$placements=function_exists('noir_project_placements')?noir_project_placements($page,'gallery'):[];
?>
<main id="main-content" class="gallery-main" data-gallery tabindex="-1">
<section class="gallery-intro"><div class="container"><div class="gallery-intro-heading"><div>
<?php if (!empty($sections['intro'])) : $intro=$sections['intro']; ?><p class="eyebrow"><?php echo esc_html($intro['eyebrow']); ?></p><h1><?php echo esc_html($intro['heading']); ?></h1><p class="muted lead"><?php echo esc_html($intro['body']); ?></p><?php else : ?><h1><?php the_title(); ?></h1><?php endif; ?>
</div><div class="gallery-studio"><p class="eyebrow"><?php esc_html_e('Beverly Hills Studio','noir-auto-detailing'); ?></p><p><?php esc_html_e('Recent Projects','noir-auto-detailing'); ?></p></div></div>
<?php if ($placements) : ?><div class="gallery-filters" data-gallery-filters hidden role="group" aria-label="<?php esc_attr_e('Filter completed Projects','noir-auto-detailing'); ?>">
<?php foreach (noir_gallery_filters() as $key=>$label) : ?><button type="button" data-filter="<?php echo esc_attr($key); ?>" aria-pressed="<?php echo $key==='all'?'true':'false'; ?>"><?php echo esc_html($label); ?></button><?php endforeach; ?></div>
<p class="gallery-count small-label muted" data-gallery-count data-message="<?php echo esc_attr__('Showing %1$d of %2$d Projects','noir-auto-detailing'); ?>" role="status" aria-live="polite" aria-atomic="true" hidden></p><?php endif; ?></div></section>
<section class="services-section" aria-label="<?php esc_attr_e('Completed Projects','noir-auto-detailing'); ?>"><div class="container"><div class="gallery-grid">
<?php foreach ($placements as $index=>$project) { get_template_part('template-parts/project',null,['project'=>$project,'primary'=>$index===0]); } ?>
</div><?php if (!$placements) : ?><p><?php esc_html_e('Project information is currently unavailable. Please contact the Studio.','noir-auto-detailing'); ?></p><?php noir_public_contacts(); endif; ?></div></section>
<?php if (!empty($sections['equipment']['items'])) : $equipment=$sections['equipment']; ?><section class="services-section gallery-equipment"><div class="container"><?php noir_section_heading($equipment); ?><div class="equipment-grid"><?php foreach ($equipment['items'] as $item) : ?><article><h3><?php echo esc_html($item['title']); ?></h3><p class="muted"><?php echo esc_html($item['body']); ?></p></article><?php endforeach; ?></div></div></section><?php endif; ?>
<?php if (!empty($sections['final'])) : ?><section class="services-section services-final"><div class="container final-grid"><?php noir_section_heading($sections['final']); ?><div class="final-actions"><?php noir_appointment_link(); $contact=noir_theme_page_url('contact'); if ($contact) : ?><a class="button secondary" href="<?php echo esc_url($contact); ?>"><?php esc_html_e('Contact Us','noir-auto-detailing'); ?></a><?php endif; ?></div></div></section><?php endif; ?>
</main><?php get_footer(); ?>
