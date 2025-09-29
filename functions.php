<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Setup del Tema
 */
add_action( 'after_setup_theme', function(){
	// Soportes básicos del tema
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array(
		'height'      => 100, // Aumentamos la altura permitida
		'width'       => 300, // Aumentamos la anchura permitida
		'flex-width'  => true,
		'flex-height' => true,
	) );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	// Menús de navegación
	register_nav_menus(array(
		'primary' => __( 'Menú principal', 'gandara-estate' ),
		'footer_about' => __( 'Menú Pie - Sobre Nosotros', 'gandara-estate' ),
		'footer_services' => __( 'Menú Pie - Servicios', 'gandara-estate' ),
	));

	// Tamaños de imagen personalizados
	add_image_size( 'property-card', 600, 400, true );

    // Eliminar el recorte de la imagen del logo para evitar pixelación
    add_filter('get_custom_logo', function($html) {
        return preg_replace('/(width|height)="\d*"\s/', "", $html);
    });

} );

/**
 * Encolar Scripts y Estilos
 */
add_action( 'wp_enqueue_scripts', function(){
	wp_enqueue_style( 'gandara-theme-style', get_stylesheet_uri(), array(), '1.1.1' );
	wp_enqueue_style( 'gandara-fonts', 'https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&display=swap', array(), null );
	wp_enqueue_script( 'gandara-theme', get_template_directory_uri() . '/assets/js/theme.js', array(), '1.1.1', true );
} );

/**
 * Registro de Áreas de Widgets (Sidebars)
 */
add_action( 'widgets_init', function(){
	register_sidebar(array(
		'name'          => __('Pie de página: Contacto', 'gandara-estate'),
		'id'            => 'footer-1',
		'before_widget' => '<section class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget__title">',
		'after_title'   => '</h3>'
	));
	register_sidebar(array(
		'name'          => __('Pie de página: Sobre Nosotros', 'gandara-estate'),
		'id'            => 'footer-2',
		'before_widget' => '<section class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget__title">',
		'after_title'   => '</h3>'
	));
	register_sidebar(array(
		'name'          => __('Pie de página: Servicios', 'gandara-estate'),
		'id'            => 'footer-3',
		'before_widget' => '<section class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget__title">',
		'after_title'   => '</h3>'
	));
} );


/**
 * Personalizador de WordPress (Customizer)
 */
add_action( 'customize_register', function( $wp_customize ){
	$wp_customize->add_section( 'ge_brand', array(
		'title' => __( 'Identidad Inmobiliaria', 'gandara-estate' ),
		'priority' => 30
	) );

	// Información de contacto
	$wp_customize->add_setting( 'ge_phone', array('default' => '', 'sanitize_callback'=>'sanitize_text_field') );
	$wp_customize->add_control( 'ge_phone', array('label'=>__('Teléfono principal','gandara-estate'),'section'=>'ge_brand','type'=>'text') );

	$wp_customize->add_setting( 'ge_email', array('default' => '', 'sanitize_callback'=>'sanitize_email') );
	$wp_customize->add_control( 'ge_email', array('label'=>__('Email de contacto','gandara-estate'),'section'=>'ge_brand','type'=>'email') );

	$wp_customize->add_setting( 'ge_address', array('default' => '', 'sanitize_callback'=>'sanitize_text_field') );
    $wp_customize->add_control( 'ge_address', array('label'=>__('Dirección','gandara-estate'),'section'=>'ge_brand','type'=>'textarea') );

	// Redes Sociales
	$wp_customize->add_setting( 'ge_facebook', array('default' => '', 'sanitize_callback'=>'esc_url_raw') );
	$wp_customize->add_control( 'ge_facebook', array('label'=>__('URL de Facebook','gandara-estate'),'section'=>'ge_brand','type'=>'url') );

	$wp_customize->add_setting( 'ge_instagram', array('default' => '', 'sanitize_callback'=>'esc_url_raw') );
	$wp_customize->add_control( 'ge_instagram', array('label'=>__('URL de Instagram','gandara-estate'),'section'=>'ge_brand','type'=>'url') );

	$wp_customize->add_setting( 'ge_twitter', array('default' => '', 'sanitize_callback'=>'esc_url_raw') );
	$wp_customize->add_control( 'ge_twitter', array('label'=>__('URL de Twitter','gandara-estate'),'section'=>'ge_brand','type'=>'url') );

	// Hero Section
	$wp_customize->add_setting( 'ge_hero_heading', array('default'=>'Encuentra la propiedad de tus sueños', 'sanitize_callback'=>'sanitize_text_field') );
	$wp_customize->add_control( 'ge_hero_heading', array('label'=>__('Título hero','gandara-estate'),'section'=>'ge_brand','type'=>'text') );

	$wp_customize->add_setting( 'ge_hero_image', array('default'=>'', 'sanitize_callback'=>'absint') );
	$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'ge_hero_image', array(
		'label'=>__('Imagen de portada (hero)','gandara-estate'),'section'=>'ge_brand','mime_type'=>'image'
	) ) );

	// Colores
	$wp_customize->add_setting( 'ge_primary_color', array('default' => '#0e7b6c', 'sanitize_callback'=>'sanitize_hex_color') );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ge_primary_color', array('label'=>__('Color principal','gandara-estate'),'section'=>'ge_brand') ) );
} );

/**
 * Función para obtener valores del personalizador de forma segura.
 */
function ge_opt( $key, $default = '' ){
	return get_theme_mod( $key, $default );
}

/**
 * Generar CSS dinámico desde el Personalizador
 */
add_action('wp_head', function(){
    $primary_color = ge_opt('ge_primary_color', '#0e7b6c');
    ?>
    <style type="text/css">
        :root {
            --ge-primary-color: <?php echo esc_attr($primary_color); ?>;
        }
    </style>
    <?php
});

/**
 * Breadcrumbs (Migas de pan)
 */
function ge_breadcrumbs(){
	if ( is_front_page() ) return;
	echo '<nav class="ge-breadcrumbs" aria-label="breadcrumbs"><a href="'. esc_url( home_url('/') ) .'">'. esc_html__( 'Inicio','gandara-estate' ) .'</a>';
	if ( is_singular( 'property' ) ) {
		echo ' › <a href="'. esc_url( get_post_type_archive_link('property') ) .'">'. esc_html__( 'Propiedades','gandara-estate' ) .'</a>';
		echo ' › <span>'. esc_html( get_the_title() ) .'</span>';
	} elseif ( is_post_type_archive('property') ) {
		echo ' › <span>'. esc_html__( 'Propiedades','gandara-estate' ) .'</span>';
	} elseif ( is_page() ) {
		echo ' › <span>'. esc_html( get_the_title() ) .'</span>';
	} elseif (is_search()) {
        echo ' › <span>'. esc_html__('Resultados de búsqueda','gandara-estate') .'</span>';
    }
	echo '</nav>';
}
