<?php get_header(); ?>
<div class="ge-container ge-content">
	<header class="ge-archive-head"><h1><?php printf( esc_html__('Resultados para: %s','gandara-estate'), get_search_query() ); ?></h1></header>
	<?php if ( have_posts() ): while ( have_posts() ): the_post(); ?>
	<article <?php post_class('ge-article'); ?>>
		<h2 class="ge-article__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<div class="ge-article__excerpt"><?php the_excerpt(); ?></div>
	</article>
	<?php endwhile; the_posts_pagination(); else: ?>
	<p><?php esc_html_e('Sin resultados.','gandara-estate'); ?></p>
	<?php endif; ?>
</div>
<?php get_footer(); ?>
