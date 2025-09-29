<?php
/* Template Name: Valora tu inmueble */
get_header(); ?>
<div class="ge-container ge-content">
	<?php ge_breadcrumbs(); ?>
	<header class="ge-archive-head"><h1><?php esc_html_e('Valora tu inmueble','gandara-estate'); ?></h1></header>
	<?php the_content(); ?>
	<p><?php esc_html_e('Completa los siguientes pasos para recibir una valoración profesional y gratuita de tu propiedad.','gandara-estate'); ?></p>
    <?php
    // Usamos el nuevo shortcode para renderizar el formulario por fases
    if ( shortcode_exists( 'rep_valuation_form' ) ) {
        echo do_shortcode('[rep_valuation_form]');
    } else {
        echo '<p>El formulario de valoración no está disponible en este momento.</p>';
    }
    ?>

</div>
<?php get_footer(); ?>
