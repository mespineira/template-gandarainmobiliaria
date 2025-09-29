<?php get_header(); ?>
<div class="ge-container ge-content">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<article <?php post_class('ge-article'); ?>>
		<h1 class="ge-article__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		
        <?php // No mostrar la fecha en páginas ?>
        <?php if ( ! is_page() ) : ?>
		    <div class="ge-article__meta"><?php echo get_the_date(); ?></div>
        <?php endif; ?>

		<div class="ge-article__content"><?php the_content(); ?></div>
	</article>
	<?php endwhile; the_posts_pagination(); else: ?>
	<p><?php esc_html_e('No hay contenido.','gandara-estate'); ?></p>
	<?php endif; ?>
</div>
<?php get_footer(); ?>