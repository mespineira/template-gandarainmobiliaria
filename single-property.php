<?php
get_header();
?>
<div class="ge-container ge-single">
	<?php ge_breadcrumbs(); ?>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<article <?php post_class('ge-single__article'); ?>>
			<?php the_content(); // Renderiza plantilla del plugin ?>
		</article>
	<?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>
