<?php
/* Template Name: Vende tu inmueble */
get_header(); ?>
<div class="ge-container ge-content">
	<?php ge_breadcrumbs(); ?>
	<header class="ge-archive-head"><h1><?php esc_html_e('Vende tu inmueble','gandara-estate'); ?></h1></header>
	<p><?php esc_html_e('Cuéntanos sobre tu propiedad y nos pondremos en contacto.','gandara-estate'); ?></p>
	<?php echo do_shortcode('[rep_contact]'); ?>
</div>
<?php get_footer(); ?>
