<?php
/* Template Name: Listado Alquilar */
get_header(); ?>
<div class="ge-container">
	<?php ge_breadcrumbs(); ?>
	<header class="ge-archive-head"><h1><?php esc_html_e('Alquilar','gandara-estate'); ?></h1></header>
	<?php echo do_shortcode('[rep_filters operation="alquiler"]'); ?>
	<?php echo do_shortcode('[rep_list per_page="12" operation="alquiler"]'); ?>
</div>
<?php get_footer(); ?>
