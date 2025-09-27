<?php
/* Template Name: Listado Comprar */
get_header(); ?>
<div class="ge-container">
	<?php ge_breadcrumbs(); ?>
	<header class="ge-archive-head"><h1><?php esc_html_e('Comprar','gandara-estate'); ?></h1></header>
	<?php echo do_shortcode('[rep_filters operation="venta"]'); ?>
<?php echo do_shortcode('[rep_list per_page="12" operation="venta"]'); ?>
</div>
<?php get_footer(); ?>
