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
        <?php
        // Usamos el loop estándar de WordPress en lugar del shortcode
        // para asegurar que la paginación nativa funcione correctamente.
        if ( have_posts() ) :
            echo '<div class="rep-grid rep-grid-list">';
            while ( have_posts() ) : the_post();
                // Incluimos la plantilla de la tarjeta para mantener la consistencia
                if ( function_exists('rep_placeholder_img') ) { // Chequeo por si el plugin está desactivado
                    include( WP_PLUGIN_DIR . '/real-estate-pro/templates/parts/property-card.php' );
                }
            endwhile;
            echo '</div>';
            
            // Paginación con la clase correcta para que apliquen los estilos del plugin
            echo '<nav class="rep-pagination">';
            the_posts_pagination(array(
                'prev_text' => '<i class="fa-solid fa-arrow-left"></i>',
                'next_text' => '<i class="fa-solid fa-arrow-right"></i>',
            ));
            echo '</nav>';

        else :
            echo '<p>No hay inmuebles que coincidan con tu búsqueda.</p>';
        endif;
        ?>
	</div>
</div>
<?php get_footer(); ?>

