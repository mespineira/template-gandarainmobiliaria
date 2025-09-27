<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
</main>
<footer class="ge-footer">
	<div class="ge-container">
		<div class="ge-footer__widgets">
			
			<div class="ge-footer__widget-col">
				<?php // Columna 1: Logo e información de contacto. No es un área de widget para asegurar el formato. ?>
				<div class="ge-footer-contact">
					<?php 
					if ( has_custom_logo() ) { 
						$custom_logo_id = get_theme_mod( 'custom_logo' );
						$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
						echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '" class="ge-footer-logo">';
					} else {
						echo '<h3 class="widget__title">' . get_bloginfo('name') . '</h3>';
					}
					?>
					<?php if ( $address = ge_opt('ge_address') ) : ?>
						<p><?php echo nl2br(esc_html($address)); ?></p>
					<?php endif; ?>
					<?php if ( $phone = ge_opt('ge_phone') ) : ?>
						<p><a href="tel:<?php echo esc_attr( preg_replace('/\s+/', '', $phone ) ); ?>"><?php echo esc_html($phone); ?></a></p>
					<?php endif; ?>
					<?php if ( $email = ge_opt('ge_email') ) : ?>
						<p><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></p>
					<?php endif; ?>
				</div>
			</div>
			
			<div class="ge-footer__widget-col">
				<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
					<?php dynamic_sidebar( 'footer-2' ); ?>
				<?php endif; ?>
				<?php // Añadimos el menú directamente como fallback o complemento. ?>
				<nav class="widget">
					<h3 class="widget__title"><?php esc_html_e('Sobre Nosotros', 'gandara-estate'); ?></h3>
					<?php wp_nav_menu(array('theme_location'=>'footer_about','container'=>false,'menu_class'=>'ge-menu-footer','fallback_cb' => false)); ?>
				</nav>
			</div>

			<div class="ge-footer__widget-col">
				<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
					<?php dynamic_sidebar( 'footer-3' ); ?>
				<?php endif; ?>
				<nav class="widget">
					<h3 class="widget__title"><?php esc_html_e('Servicios', 'gandara-estate'); ?></h3>
					<?php wp_nav_menu(array('theme_location'=>'footer_services','container'=>false,'menu_class'=>'ge-menu-footer','fallback_cb' => false)); ?>
				</nav>
			</div>

		</div>
	</div>
	<div class="ge-sub-footer">
		<div class="ge-container ge-container--flex">
			<div class="ge-sub-footer__legal">
				<p>© <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('Todos los derechos reservados.', 'gandara-estate'); ?></p>
				<nav class="ge-legal-menu">
					<a href="<?php echo esc_url( home_url('/aviso-legal') ); ?>"><?php esc_html_e('Aviso legal','gandara-estate'); ?></a>
					<a href="<?php echo esc_url( home_url('/politica-de-privacidad') ); ?>"><?php esc_html_e('Privacidad','gandara-estate'); ?></a>
					<a href="<?php echo esc_url( home_url('/politica-de-cookies') ); ?>"><?php esc_html_e('Cookies','gandara-estate'); ?></a>
				</nav>
			</div>
			<div class="ge-sub-footer__credits">
				<?php // Puedes añadir tus créditos aquí ?>
			</div>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
