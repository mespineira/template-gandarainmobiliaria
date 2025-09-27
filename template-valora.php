<?php
/* Template Name: Valora tu inmueble */
get_header(); ?>
<div class="ge-container ge-content">
	<?php ge_breadcrumbs(); ?>
	<header class="ge-archive-head"><h1><?php esc_html_e('Valora tu inmueble','gandara-estate'); ?></h1></header>
	<p><?php esc_html_e('Introduce los datos del inmueble para estimar su valor.','gandara-estate'); ?></p>
	<form class="ge-valuation" method="post">
		<div class="ge-grid">
			<label><?php esc_html_e('Dirección','gandara-estate'); ?><input type="text" name="addr" required></label>
			<label><?php esc_html_e('Población','gandara-estate'); ?><input type="text" name="city" required></label>
			<label><?php esc_html_e('Superficie (m²)','gandara-estate'); ?><input type="number" name="m2" required></label>
			<label><?php esc_html_e('Habitaciones','gandara-estate'); ?><input type="number" name="rooms"></label>
			<label><?php esc_html_e('Baños','gandara-estate'); ?><input type="number" name="baths"></label>
			<label><?php esc_html_e('Referencia Catastral (opcional)','gandara-estate'); ?><input type="text" name="refcat"></label>
		</div>
		<p><button class="ge-btn" type="submit"><?php esc_html_e('Solicitar valoración','gandara-estate'); ?></button></p>
	</form>
	<div class="ge-note"><?php esc_html_e('Recibirás una estimación preliminar y nos pondremos en contacto para una valoración profesional.','gandara-estate'); ?></div>
</div>
<?php get_footer(); ?>
