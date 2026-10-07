<?php defined('ABSPATH') || exit; get_header(); ?>
<main id="main-content" tabindex="-1" class="generic-main container">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?><article><h1><?php the_title(); ?></h1><?php the_content(); ?></article><?php endwhile; else : ?><h1><?php esc_html_e('Page not found','noir-auto-detailing'); ?></h1><p><?php esc_html_e('Use the navigation to explore the Studio.','noir-auto-detailing'); ?></p><?php endif; ?>
</main><?php get_footer(); ?>
