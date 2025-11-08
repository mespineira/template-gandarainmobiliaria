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
    add_image_size( 'hero-slide', 1920, 1080, true ); 
    add_image_size( 'page-header', 1600, 336, true ); // Nuevo tamaño de imagen para cabeceras

    // Eliminar el recorte de la imagen del logo para evitar pixelación
    add_filter('get_custom_logo', function($html) {
        return preg_replace('/(width|height)="\d*"\s/', "", $html);
    });

} );

/**
 * Encolar Scripts y Estilos
 */
add_action( 'wp_enqueue_scripts', function(){
	wp_enqueue_style( 'gandara-theme-style', get_stylesheet_uri(), array(), '1.1.3' );
	wp_enqueue_style( 'gandara-fonts', 'https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&display=swap', array(), null );
	
    // Encolar Swiper JS y CSS para el slider
    if ( is_front_page() ) {
        wp_enqueue_style( 'swiper-css', 'https://unpkg.com/swiper/swiper-bundle.min.css', array(), '8.4.5' );
        wp_enqueue_script( 'swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', array(), '8.4.5', true );
    }
    
    // JS principal del tema
    wp_enqueue_script( 'gandara-theme', get_template_directory_uri() . '/assets/js/theme.js', array('jquery'), '1.1.3', true );
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

	// Slider Hero
	$wp_customize->add_section( 'ge_hero_slider', array( 'title' => __( 'Slider de Portada', 'gandara-estate' ), 'priority' => 35 ) );
	for ( $i = 1; $i <= 5; $i++ ) {
		$wp_customize->add_setting( "ge_hero_slide_image_$i", array('default'=>'', 'sanitize_callback'=>'absint') );
		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, "ge_hero_slide_image_$i", array( 'label'=>__('Imagen del Slide ','gandara-estate') . $i,'section'=>'ge_hero_slider','mime_type'=>'image' ) ) );
		$wp_customize->add_setting( "ge_hero_slide_title_$i", array('default'=>'', 'sanitize_callback'=>'sanitize_text_field') );
		$wp_customize->add_control( "ge_hero_slide_title_$i", array( 'label'=>__('Título del Slide ','gandara-estate') . $i,'section'=>'ge_hero_slider','type'=>'text' ) );
        $wp_customize->add_setting( "ge_hero_slide_subtitle_$i", array('default'=>'', 'sanitize_callback'=>'sanitize_text_field') );
		$wp_customize->add_control( "ge_hero_slide_subtitle_$i", array( 'label'=>__('Subtítulo del Slide ','gandara-estate') . $i,'section'=>'ge_hero_slider','type'=>'textarea' ) );
	}
    $wp_customize->remove_control('ge_hero_heading');
    $wp_customize->remove_control('ge_hero_image');

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
	} elseif ( is_page() || is_single() ) {
		echo ' › <span>'. esc_html( get_the_title() ) .'</span>';
	} elseif (is_search()) {
        echo ' › <span>'. esc_html__('Resultados de búsqueda','gandara-estate') .'</span>';
    }
	echo '</nav>';
}

/**
 * Añade campos personalizados a las páginas para el Slogan de la cabecera.
 */
add_action('add_meta_boxes', function(){
    add_meta_box(
        'ge_page_header_options',
        __('Opciones de Cabecera', 'gandara-estate'),
        'ge_render_page_header_metabox',
        'page', // Solo para páginas
        'side',
        'low'
    );
});

function ge_render_page_header_metabox($post){
    wp_nonce_field('ge_save_page_header_options', 'ge_page_header_nonce');
    $slogan = get_post_meta($post->ID, '_ge_header_slogan', true);
    ?>
    <p>
        <label for="ge_header_slogan"><?php _e('Slogan sobre la imagen:', 'gandara-estate'); ?></label>
        <textarea name="ge_header_slogan" id="ge_header_slogan" style="width:100%;"><?php echo esc_textarea($slogan); ?></textarea>
    </p>
    <?php
}

add_action('save_post', function($post_id){
    if (!isset($_POST['ge_page_header_nonce']) || !wp_verify_nonce($_POST['ge_page_header_nonce'], 'ge_save_page_header_options')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_page', $post_id)) return;

    if (isset($_POST['ge_header_slogan'])) {
        update_post_meta($post_id, '_ge_header_slogan', sanitize_text_field($_POST['ge_header_slogan']));
    }
});

/**
 * =========================================================================
 * SOLUCIÓN COMPLETA PARA SHORTCODES DE SERVICIOS (VERSIÓN CORREGIDA)
 * =========================================================================
 *
 * Parte 1: Funciones de Shortcode
 * Parte 2: Filtros para limpiar el formato automático de WordPress (wpautop)
 *
 */


/*
 * ------------------------------------------------------------------------
 * PARTE 1: Las funciones de shortcode
 * ------------------------------------------------------------------------
 */

/**
 * 1. El shortcode "padre" que crea la cuadrícula [ge_services_grid]
 *
 * Esta función ahora incluye una limpieza interna (preg_replace)
 * para eliminar los <p></p> que se cuelan *entre* los items.
 */
function ge_services_grid_shortcode( $atts, $content = null ) {
    
    // Procesa los shortcodes anidados (los items)
    $content = do_shortcode( $content );
    
    // --- INICIO DE LIMPIEZA INTERNA ---
    // Limpiamos CUALQUIER etiqueta <p> vacía o <br> que
    // WordPress haya podido añadir ENTRE los items.
    $content = preg_replace( '#<p>\s*</p>#i', '', $content );
    $content = str_replace( array( '<br />', '<br>' ), '', $content );
    // --- FIN DE LIMPIEZA INTERNA ---
    
    // Devuelve el HTML de la cuadrícula
    return '<div class="ge-services-grid">' . trim($content) . '</div>';
}
add_shortcode( 'ge_services_grid', 'ge_services_grid_shortcode' );


/**
 * 2. El shortcode "hijo" para cada tarjeta de servicio [ge_service_item]
 *
 * Esta función se mantiene igual: coge el texto plano y le da formato HTML.
 */
function ge_service_item_shortcode( $atts, $content = null ) {
    
    $a = shortcode_atts( array(
        'fa_icon' => 'fa-solid fa-star',
        'title'   => 'Título del Servicio',
    ), $atts );
    
    // wpautop es CORRECTO aquí, porque queremos formatear la descripción
    $content = wpautop( trim( $content ) );

    $html = '<div class="ge-service-item">';
    $html .= '<div class="ge-service-item__icon"><i class="' . esc_attr( $a['fa_icon'] ) . '"></i></div>';
    
    // --- INICIO DE LA CORRECCIÓN DEL ERROR CRÍTICO ---
    // La etiqueta </h3> debe estar FUERA de esc_html()
    $html .= '<h3 class="ge-service-item__title">' . esc_html( $a['title'] ) . '</h3>';
    // --- FIN DE LA CORRECCIÓN DEL ERROR CRÍTICO ---
    
    $html .= $content; // El contenido (descripción)
    $html .= '</div>';
    
    return $html;
}
add_shortcode( 'ge_service_item', 'ge_service_item_shortcode' );


/*
 * ------------------------------------------------------------------------
 * PARTE 2: Filtros de limpieza para wpautop
 * ------------------------------------------------------------------------
 *
 * Esto evita que WordPress envuelva nuestros shortcodes en etiquetas <p>
 * (Ej: <p>[ge_services_grid]</p>), lo que rompe el HTML.
 */
function ge_clean_shortcode_wpautop( $content ) {
    
    // Nuestros shortcodes que devuelven <div>s
    $shortcodes = array( 
        'ge_services_grid', 
        'ge_service_item'
    );

    foreach ( $shortcodes as $shortcode ) {
        // Expresión regular para buscar <p>[shortcode...]
        $pattern_open = '#<p>\s*(\[' . $shortcode . '.*?\])#i';
        // Expresión regular para buscar [/shortcode]</p>
        $pattern_close = '#(\[/' . $shortcode . '\])\s*</p>#i';
        // Expresión regular para buscar <p>[shortcode...]</p> (shortcodes sin contenido)
        $pattern_single = '#<p>\s*(\[' . $shortcode . '.*?\])\s*</p>#i';

        // Reemplazamos
        $content = preg_replace( $pattern_open, '$1', $content );
        $content = preg_replace( $pattern_close, '$1', $content );
        $content = preg_replace( $pattern_single, '$1', $content );
    }
    
    return $content;
}

// Ejecutamos nuestro filtro DESPUÉS de wpautop (prioridad 10)
add_filter( 'the_content', 'ge_clean_shortcode_wpautop', 11 );
// También en el filtro 'widget_text_content' por si usas los shortcodes en widgets
add_filter( 'widget_text_content', 'ge_clean_shortcode_wpautop', 11 );
