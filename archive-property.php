<?php
get_header();
?>
<div class="ge-container">
	<?php ge_breadcrumbs(); ?>
	<header class="ge-archive-head">
		<h1><?php post_type_archive_title(); ?></h1>
	</header>
	<div class="ge-archive__filters">
		<?php echo do_shortcode('[rep_filters]'); ?>
	</div>
	<div class="ge-archive__results">
		<?php echo do_shortcode('[rep_list per_page="12"]'); ?>
	</div>
</div>
<?php get_footer(); ?>
