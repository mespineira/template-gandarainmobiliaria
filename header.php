<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="ge-header">
	<div class="ge-topbar">
		<div class="ge-container ge-container--flex">
			<div class="ge-topbar__social">
				<?php if ( $facebook_url = ge_opt('ge_facebook') ) : ?>
					<a href="<?php echo esc_url($facebook_url); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M14 13.5H16.5L17.5 9.5H14V7.5C14 6.47 14 5.5 16 5.5H17.5V2.14C17.174 2.097 15.943 2 14.643 2C11.928 2 10 3.657 10 6.7V9.5H7V13.5H10V22H14V13.5Z"/></svg>
					</a>
				<?php endif; ?>
				<?php if ( $instagram_url = ge_opt('ge_instagram') ) : ?>
					<a href="<?php echo esc_url($instagram_url); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
					</a>
				<?php endif; ?>
				<?php if ( $twitter_url = ge_opt('ge_twitter') ) : ?>
					<a href="<?php echo esc_url($twitter_url); ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M22.46 6C21.71 6.31 20.91 6.53 20.06 6.62C20.94 6.11 21.62 5.32 21.94 4.38C21.11 4.85 20.21 5.19 19.24 5.38C18.46 4.56 17.33 4 16.08 4C13.68 4 11.72 5.96 11.72 8.36C11.72 8.71 11.76 9.06 11.84 9.4C8.24 9.22 5.12 7.55 3 4.79C2.63 5.42 2.42 6.16 2.42 6.94C2.42 8.43 3.17 9.75 4.26 10.54C3.57 10.52 2.92 10.33 2.36 10.03C2.36 10.05 2.36 10.07 2.36 10.09C2.36 12.23 3.89 14.01 5.96 14.41C5.6 14.51 5.22 14.56 4.83 14.56C4.56 14.56 4.3 14.54 4.04 14.49C4.6 16.22 6.19 17.47 8.1 17.51C6.58 18.67 4.69 19.36 2.65 19.36C2.3 19.36 1.96 19.34 1.62 19.29C3.62 20.59 5.96 21.36 8.5 21.36C16.07 21.36 20.29 15.1 20.29 9.69C20.29 9.5 20.29 9.3 20.28 9.11C21.11 8.5 21.85 7.69 22.46 6Z"/></svg>
					</a>
				<?php endif; ?>
			</div>
			<div class="ge-topbar__contact">
				<?php if ( $phone = ge_opt('ge_phone') ) : ?>
					<a class="ge-phone" href="tel:<?php echo esc_attr( preg_replace('/\s+/', '', $phone ) ); ?>">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
						<span><?php echo esc_html($phone); ?></span>
					</a>
				<?php endif; ?>
				<a class="ge-btn ge-btn--sm" href="<?php echo esc_url( home_url('/contacto') ); ?>"><?php esc_html_e('Contacto', 'gandara-estate'); ?></a>
			</div>
		</div>
	</div>

	<div class="ge-main-header">
		<div class="ge-container ge-container--flex">
			<div class="ge-main-header__logo">
				<?php if ( has_custom_logo() ) { the_custom_logo(); } else { ?>
					<a class="ge-site-title" href="<?php echo esc_url( home_url('/') ); ?>"><?php bloginfo('name'); ?></a>
				<?php } ?>
			</div>
			<nav class="ge-nav-desktop" aria-label="<?php esc_attr_e( 'Menú principal', 'gandara-estate' ); ?>">
				<?php
				wp_nav_menu(array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'ge-menu'
				));
				?>
			</nav>
            <button class="ge-nav-mobile-toggle" aria-expanded="false" aria-controls="ge-mobile-menu-overlay">
                <i class="fas fa-bars"></i>
                <span class="ge-sr-only"><?php esc_html_e( 'Menú', 'gandara-estate' ); ?></span>
            </button>
		</div>
	</div>
</header>

<div id="ge-mobile-menu-overlay" class="ge-mobile-menu-overlay" aria-hidden="true">
    <button class="ge-mobile-menu__close">
        <i class="fas fa-times"></i>
        <span class="ge-sr-only"><?php esc_html_e('Cerrar menú', 'gandara-estate'); ?></span>
    </button>
    <nav class="ge-mobile-menu" aria-label="<?php esc_attr_e('Menú móvil', 'gandara-estate'); ?>">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'primary',
            'container' => false,
            'menu_class' => 'ge-menu--mobile'
        ));
        ?>
    </nav>
</div>

<?php
// Muestra la cabecera de página si no es la portada y tiene imagen destacada.
if ( ! is_front_page() && has_post_thumbnail() ) :
    $slogan = get_post_meta( get_the_ID(), '_ge_header_slogan', true );
?>
<div class="ge-page-header">
    <?php the_post_thumbnail('page-header'); ?>
    <div class="ge-page-header__overlay"></div>
    <?php if ( ! empty( $slogan ) ) : ?>
        <div class="ge-page-header__slogan">
            <div class="ge-container">
                <h2><?php echo esc_html( $slogan ); ?></h2>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php endif; ?>

<main class="ge-main">
