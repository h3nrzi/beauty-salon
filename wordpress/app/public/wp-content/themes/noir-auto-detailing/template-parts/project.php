<?php
defined('ABSPATH') || exit;
$project=$args['project']; $primary=!empty($args['primary']);
$pair=$project['comparison'];
$comparison=(bool)($pair['before_image'] || $pair['after_image']);
// Full-width emphasis follows completed work's exported identity, independently of row edits.
$classic=$project['project_id']==='mercedes-benz-300sl-1955';
$wide=$comparison || $classic;
?>
<article id="project-<?php echo esc_attr($project['project_id']); ?>" data-project data-memberships="<?php echo esc_attr(implode(' ',$project['memberships'])); ?>" class="project-card<?php echo $wide?' project-wide':''; echo $classic?' project-classic':''; ?>">
<div class="project-visual"><?php if ($comparison) { get_template_part('template-parts/comparison',null,['comparison'=>$pair,'primary'=>$primary]); } else { echo wp_get_attachment_image($project['image'],'large',false,['sizes'=>$classic?'(min-width: 1024px) 66vw, 100vw':'(min-width: 768px) 50vw, 100vw','loading'=>$primary?'eager':'lazy','fetchpriority'=>$primary?'high':'auto']); } ?>
<?php if (!$wide && $project['eyebrow']) : ?><p class="project-image-eyebrow small-label"><?php echo esc_html($project['eyebrow']); ?></p><?php endif; ?><?php if (!$wide && $project['finish']) : ?><p class="project-finish small-label"><?php echo esc_html($project['finish']); ?></p><?php endif; ?></div>
<div class="project-content">
<?php if ($wide && $project['eyebrow']) : ?><p class="eyebrow"><?php echo esc_html($project['eyebrow']); ?></p><?php endif; ?>
<h2><?php echo esc_html($project['title']); ?></h2>
<?php if ($wide) : ?><p class="project-subtitle"><?php echo esc_html(($project['vehicle']!==$project['title']?$project['vehicle'].($project['finish']?' • ':''):'').$project['finish']); ?></p><?php endif; ?><?php if (!$wide && $project['vehicle']!==$project['title']) : ?><p class="project-vehicle muted"><?php echo esc_html($project['vehicle']); ?></p><?php endif; ?><?php if ($project['teaser']) : ?><p class="project-subtitle"><?php echo esc_html($project['teaser']); ?></p><?php endif; ?>
<p class="muted"><?php echo esc_html($project['work']); ?></p>
<?php if ($project['facts']) : ?><dl class="project-facts"><?php foreach ($project['facts'] as $fact) : ?><div><dt><?php echo esc_html($fact['label']); ?></dt><dd><?php echo esc_html($fact['value']); ?></dd></div><?php endforeach; ?></dl><?php endif; ?>
<?php if ($comparison) : ?><div class="project-detail-link"><span class="small-label muted"><?php esc_html_e('Completed Project','noir-auto-detailing'); ?></span><a class="small-label" href="<?php echo esc_url(noir_project_link($project['project_id'])); ?>"><?php esc_html_e('View Project Details','noir-auto-detailing'); ?></a></div><?php endif; ?>
</div></article>
