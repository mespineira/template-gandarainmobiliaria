<?php
/* Template Name: Portada */
get_header();

$hero_img_id = ge_opt('ge_hero_image', '');
$hero_url = $hero_img_id ? wp_get_attachment_image_url( $hero_img_id, 'full' ) : get_template_directory_uri() . '/assets/images/hero-default.jpg';
?>
<section class="ge-hero" style="background-image:url('<?php echo esc_url($hero_url); ?>')">
	<div class="ge-hero__overlay"></div>
	<div class="ge-hero__inner ge-container">
		<h1><?php echo esc_html( ge_opt('ge_hero_heading', '') ); ?></h1>
		
		<div class="ge-hero__search">
			<?php 
			// Integramos el buscador del plugin directamente en la sección hero.
			// Este shortcode debe ser el del formulario de búsqueda de tu plugin.
			echo do_shortcode('[rep_filters]'); 
			?>
		</div>
	</div>
</section>

<section class="ge-section ge-container">
	<header class="ge-section__header">
		<h2><?php esc_html_e('Propiedades destacadas', 'gandara-estate'); ?></h2>
		<a class="ge-link" href="<?php echo esc_url( get_post_type_archive_link('property') ); ?>"><?php esc_html_e('Ver todas', 'gandara-estate'); ?> →</a>
	</header>
	<?php 
	// Shortcode para mostrar propiedades destacadas.
	echo do_shortcode('[rep_list per_page="9" featured="1"]'); 
	?>
</section>

<section class="ge-section ge-section--cta" style="background-image:url('<?php echo esc_url($hero_url); ?>')">
    <div class="ge-hero__overlay"></div>
    <div class="ge-container ge-container--narrow">
        <h2>¿Quieres vender tu casa?</h2>
        <p>Te ayudamos en todo el proceso para que vendas al mejor precio y sin complicaciones.</p>
        <a href="<?php echo esc_url( home_url('/vender') ); ?>" class="ge-btn ge-btn--outline-white">Infórmate ahora</a>
    </div>
</section>

<section class="ge-section ge-container">
    <header class="ge-section__header">
        <h2><?php esc_html_e('Nuestros servicios', 'gandara-estate'); ?></h2>
    </header>
    <div class="ge-services-grid">
        <div class="ge-service-item">
            <div class="ge-service-item__icon">🏡</div>
            <h3 class="ge-service-item__title">Compra-Venta</h3>
            <p>Encuentra la vivienda que buscas o vende la tuya al mejor precio de mercado.</p>
        </div>
        <div class="ge-service-item">
            <div class="ge-service-item__icon">🔑</div>
            <h3 class="ge-service-item__title">Alquileres</h3>
            <p>Gestionamos el alquiler de tu propiedad con las máximas garantías.</p>
        </div>
        <div class="ge-service-item">
            <div class="ge-service-item__icon">📋</div>
            <h3 class="ge-service-item__title">Valoraciones</h3>
            <p>Realizamos valoraciones profesionales para conocer el precio real de un inmueble.</p>
        </div>
    </div>
</section>

<?php 
// Sección de Blog - Obtenemos las 3 últimas entradas
$recent_posts = new WP_Query(array(
    'post_type' => 'post',
    'posts_per_page' => 3,
    'ignore_sticky_posts' => 1
));

if ($recent_posts->have_posts()) :
?>
<section class="ge-section ge-section--light-bg">
    <div class="ge-container">
        <header class="ge-section__header">
            <h2><?php esc_html_e('Últimas noticias del blog', 'gandara-estate'); ?></h2>
            <a class="ge-link" href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>"><?php esc_html_e('Ver todo', 'gandara-estate'); ?> →</a>
        </header>
        <div class="ge-posts-grid">
            <?php while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
            <article class="ge-post-card">
                <a href="<?php the_permalink(); ?>" class="ge-post-card__image-link">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('medium_large'); ?>
                    <?php endif; ?>
                </a>
                <div class="ge-post-card__content">
                    <h3 class="ge-post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <div class="ge-post-card__excerpt"><?php the_excerpt(); ?></div>
                    <a href="<?php the_permalink(); ?>" class="ge-link"><?php esc_html_e('Leer más', 'gandara-estate'); ?></a>
                </div>
            </article>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php 
endif; 
wp_reset_postdata();
?>

<?php get_footer(); ?>
