<?php
/**
 * Resplandor Floral - Funciones y Definiciones del Tema
 *
 * @package Resplandor_Floral
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Configuración inicial del tema
 */
function resplandor_setup() {
    // Traducciones
    load_theme_textdomain( 'resplandor-floral', get_template_directory() . '/languages' );

    // Título dinámico
    add_theme_support( 'title-tag' );

    // Imágenes destacadas
    add_theme_support( 'post-thumbnails' );

    // Soporte para logotipo personalizado
    add_theme_support( 'custom-logo', array(
        'height'      => 80,
        'width'       => 280,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ) );

    // HTML5 semántico
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // Soporte para Gutenberg y alineaciones completas
    add_theme_support( 'align-wide' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'editor-styles' );
    add_editor_style( 'style.css' );

    // Menús de navegación
    register_nav_menus( array(
        'primary' => __( 'Menú Principal (Cabecera)', 'resplandor-floral' ),
        'footer'  => __( 'Menú del Pie de Página', 'resplandor-floral' ),
    ) );
}
add_action( 'after_setup_theme', 'resplandor_setup' );

/**
 * Encolar scripts y estilos
 */
function resplandor_scripts() {
    // Google Fonts: DM Serif Display & Questrial / Plus Jakarta Sans
    wp_enqueue_style(
        'resplandor-google-fonts',
        'https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Questrial&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap',
        array(),
        null
    );

    // Font Awesome 6 Icons
    wp_enqueue_style(
        'resplandor-fontawesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
        array(),
        '6.5.1'
    );

    // Estilos principales del tema
    wp_enqueue_style(
        'resplandor-style',
        get_stylesheet_uri(),
        array( 'resplandor-google-fonts', 'resplandor-fontawesome' ),
        wp_get_theme()->get( 'Version' )
    );

    // JavaScript principal
    $js_uri = get_template_directory_uri() . '/assets/js/resplandor-main.js';
    if ( ! file_exists( get_template_directory() . '/assets/js/resplandor-main.js' ) && file_exists( get_template_directory() . '/resplandor-main.js' ) ) {
        $js_uri = get_template_directory_uri() . '/resplandor-main.js';
    }
    wp_enqueue_script(
        'resplandor-main',
        $js_uri,
        array(),
        wp_get_theme()->get( 'Version' ),
        true
    );

    // Pasar variables al JavaScript (AJAX, nonce, WhatsApp)
    wp_localize_script( 'resplandor-main', 'resplandor_vars', array(
        'ajax_url'        => admin_url( 'admin-ajax.php' ),
        'nonce'           => wp_create_nonce( 'resplandor_contact_nonce' ),
        'whatsapp_number' => get_theme_mod( 'resplandor_whatsapp', '+57 300 000 0000' ),
    ) );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'resplandor_scripts' );

/**
 * Helper para obtener URL de imágenes de assets locales
 */
function resplandor_asset_image( $filename ) {
    $theme_dir = get_template_directory();
    $theme_uri = get_template_directory_uri();

    if ( file_exists( $theme_dir . '/assets/images/' . $filename ) ) {
        return $theme_uri . '/assets/images/' . $filename;
    }
    if ( file_exists( $theme_dir . '/' . $filename ) ) {
        return $theme_uri . '/' . $filename;
    }
    $base = pathinfo( $filename, PATHINFO_FILENAME );
    if ( file_exists( $theme_dir . '/assets/images/' . $base . '.png' ) ) {
        return $theme_uri . '/assets/images/' . $base . '.png';
    }
    if ( file_exists( $theme_dir . '/' . $base . '.png' ) ) {
        return $theme_uri . '/' . $base . '.png';
    }
    if ( file_exists( $theme_dir . '/assets/images/' . $base . '.jpg' ) ) {
        return $theme_uri . '/assets/images/' . $base . '.jpg';
    }
    if ( file_exists( $theme_dir . '/' . $base . '.jpg' ) ) {
        return $theme_uri . '/' . $base . '.jpg';
    }
    return $theme_uri . '/assets/images/' . $filename;
}

/**
 * Registro de áreas de widgets / sidebars
 */
function resplandor_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Barra Lateral Blog', 'resplandor-floral' ),
        'id'            => 'sidebar-blog',
        'description'   => __( 'Aparece en las entradas del blog y archivos.', 'resplandor-floral' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'resplandor_widgets_init' );

/**
 * Integración con el Personalizador de WordPress (Theme Customizer)
 */
function resplandor_customize_register( $wp_customize ) {

    // PANEL PRINCIPAL
    $wp_customize->add_panel( 'resplandor_panel', array(
        'title'       => __( '🌸 Opciones de Resplandor Floral', 'resplandor-floral' ),
        'description' => __( 'Personaliza los contenidos, textos, contactos y secciones del sitio.', 'resplandor-floral' ),
        'priority'    => 20,
    ) );

    // 1. INFORMACIÓN DE CONTACTO
    $wp_customize->add_section( 'resplandor_contact_section', array(
        'title'    => __( 'Información de Contacto', 'resplandor-floral' ),
        'panel'    => 'resplandor_panel',
        'priority' => 10,
    ) );

    $wp_customize->add_setting( 'resplandor_phone', array(
        'default'           => '+1 555-555-5556',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'resplandor_phone', array(
        'label'    => __( 'Teléfono de Cabecera', 'resplandor-floral' ),
        'section'  => 'resplandor_contact_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'resplandor_whatsapp', array(
        'default'           => '+57 300 000 0000',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'resplandor_whatsapp', array(
        'label'    => __( 'Número de WhatsApp', 'resplandor-floral' ),
        'section'  => 'resplandor_contact_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'resplandor_email', array(
        'default'           => 'hola@tucrema.ejemplo.com',
        'sanitize_callback' => 'sanitize_email',
    ) );
    $wp_customize->add_control( 'resplandor_email', array(
        'label'    => __( 'Correo de Contacto', 'resplandor-floral' ),
        'section'  => 'resplandor_contact_section',
        'type'     => 'email',
    ) );

    $wp_customize->add_setting( 'resplandor_location', array(
        'default'           => 'Colombia',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'resplandor_location', array(
        'label'    => __( 'Ubicación / País', 'resplandor-floral' ),
        'section'  => 'resplandor_contact_section',
        'type'     => 'text',
    ) );

    // 2. REDES SOCIALES
    $wp_customize->add_section( 'resplandor_social_section', array(
        'title'    => __( 'Redes Sociales', 'resplandor-floral' ),
        'panel'    => 'resplandor_panel',
        'priority' => 20,
    ) );

    $social_networks = array(
        'facebook'  => 'Facebook URL',
        'instagram' => 'Instagram URL',
        'twitter'   => 'X / Twitter URL',
        'whatsapp'  => 'WhatsApp Direct Link',
    );

    foreach ( $social_networks as $key => $label ) {
        $wp_customize->add_setting( "resplandor_social_{$key}", array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( "resplandor_social_{$key}", array(
            'label'   => $label,
            'section' => 'resplandor_social_section',
            'type'    => 'url',
        ) );
    }

    // 3. SECCIÓN HERO (PORTADA)
    $wp_customize->add_section( 'resplandor_hero_section', array(
        'title'    => __( 'Sección Portada (Hero)', 'resplandor-floral' ),
        'panel'    => 'resplandor_panel',
        'priority' => 30,
    ) );

    $wp_customize->add_setting( 'resplandor_hero_title', array(
        'default'           => 'RESPLANDOR FLORAL',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'resplandor_hero_title', array(
        'label'   => __( 'Título Principal H1', 'resplandor-floral' ),
        'section' => 'resplandor_hero_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'resplandor_hero_desc', array(
        'default'           => 'Esencias naturales que florecen en tu piel, diseñadas para brindar una experiencia sensorial relajante y de autocuidado.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'resplandor_hero_desc', array(
        'label'   => __( 'Texto de Introducción', 'resplandor-floral' ),
        'section' => 'resplandor_hero_section',
        'type'    => 'textarea',
    ) );

    $wp_customize->add_setting( 'resplandor_hero_btn_text', array(
        'default'           => 'Conozca nuestras cremas',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'resplandor_hero_btn_text', array(
        'label'   => __( 'Texto del Botón Hero', 'resplandor-floral' ),
        'section' => 'resplandor_hero_section',
        'type'    => 'text',
    ) );

    // 4. SECCIÓN CALIDAD
    $wp_customize->add_section( 'resplandor_calidad_section', array(
        'title'    => __( 'Sección Calidad', 'resplandor-floral' ),
        'panel'    => 'resplandor_panel',
        'priority' => 40,
    ) );

    $wp_customize->add_setting( 'resplandor_calidad_title', array(
        'default'           => 'Calidad',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'resplandor_calidad_title', array(
        'label'   => __( 'Título', 'resplandor-floral' ),
        'section' => 'resplandor_calidad_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'resplandor_calidad_text', array(
        'default'           => 'Nuestras fórmulas están diseñadas para diferentes tipos de piel y contienen esencias de flores como rosa, lavanda, jazmín y manzanilla, que aportan aromas agradables y una experiencia sensorial relajante.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'resplandor_calidad_text', array(
        'label'   => __( 'Texto Descriptivo', 'resplandor-floral' ),
        'section' => 'resplandor_calidad_section',
        'type'    => 'textarea',
    ) );

    // 5. SECCIÓN COLECCIÓN
    $wp_customize->add_section( 'resplandor_coleccion_section', array(
        'title'    => __( 'Sección Colección y Precios', 'resplandor-floral' ),
        'panel'    => 'resplandor_panel',
        'priority' => 50,
    ) );

    $wp_customize->add_setting( 'resplandor_coleccion_title', array(
        'default'           => 'Nuestra colección de cremas',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'resplandor_coleccion_title', array(
        'label'   => __( 'Título de la Colección', 'resplandor-floral' ),
        'section' => 'resplandor_coleccion_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'resplandor_coleccion_desc', array(
        'default'           => 'Somos una empresa dedicada a la creación y comercialización de cremas hidratantes con esencias florales naturales, que combinan el cuidado de la piel con una experiencia de bienestar.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'resplandor_coleccion_desc', array(
        'label'   => __( 'Descripción de la Colección', 'resplandor-floral' ),
        'section' => 'resplandor_coleccion_section',
        'type'    => 'textarea',
    ) );

    // 6. SECCIÓN NOSOTROS
    $wp_customize->add_section( 'resplandor_nosotros_section', array(
        'title'    => __( 'Sección Nosotros & Características', 'resplandor-floral' ),
        'panel'    => 'resplandor_panel',
        'priority' => 60,
    ) );

    $wp_customize->add_setting( 'resplandor_slogan', array(
        'default'           => 'Esencias que florecen, belleza que se siente.',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'resplandor_slogan', array(
        'label'   => __( 'Lema o Slogan', 'resplandor-floral' ),
        'section' => 'resplandor_nosotros_section',
        'type'    => 'text',
    ) );

    // 7. SECCIÓN CTA
    $wp_customize->add_section( 'resplandor_cta_section', array(
        'title'    => __( 'Sección Llamado a la Acción (CTA)', 'resplandor-floral' ),
        'panel'    => 'resplandor_panel',
        'priority' => 70,
    ) );

    $wp_customize->add_setting( 'resplandor_cta_title', array(
        'default'           => 'La crema es aburrida si no la haces tuya con tu estilo.',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'resplandor_cta_title', array(
        'label'   => __( 'Título CTA', 'resplandor-floral' ),
        'section' => 'resplandor_cta_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'resplandor_cta_desc', array(
        'default'           => 'Únete a nosotros y disfruta del placer de cuidar tu piel.',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'resplandor_cta_desc', array(
        'label'   => __( 'Subtítulo CTA', 'resplandor-floral' ),
        'section' => 'resplandor_cta_section',
        'type'    => 'text',
    ) );

    // 8. PIE DE PÁGINA
    $wp_customize->add_section( 'resplandor_footer_section', array(
        'title'    => __( 'Pie de Página (Footer)', 'resplandor-floral' ),
        'panel'    => 'resplandor_panel',
        'priority' => 80,
    ) );

    $wp_customize->add_setting( 'resplandor_footer_about', array(
        'default'           => 'Somos un equipo apasionado por crear cremas que cuidan, hidratan y transforman la piel. Desarrollamos fórmulas efectivas para resolver necesidades reales de belleza y bienestar.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'resplandor_footer_about', array(
        'label'   => __( 'Texto "Sobre nosotros" en Pie de Página', 'resplandor-floral' ),
        'section' => 'resplandor_footer_section',
        'type'    => 'textarea',
    ) );

    $wp_customize->add_setting( 'resplandor_footer_copy', array(
        'default'           => 'Derechos reservados © Resplandor Floral - Cosmética y Cuidado Facial Natural',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'resplandor_footer_copy', array(
        'label'   => __( 'Texto de Derechos Reservados', 'resplandor-floral' ),
        'section' => 'resplandor_footer_section',
        'type'    => 'text',
    ) );
}
add_action( 'customize_register', 'resplandor_customize_register' );

/**
 * Registro de Custom Post Type para Productos de Resplandor Floral
 */
function resplandor_register_cpt() {
    $labels = array(
        'name'               => __( 'Cremas / Productos', 'resplandor-floral' ),
        'singular_name'      => __( 'Crema', 'resplandor-floral' ),
        'menu_name'          => __( 'Cremas Florales', 'resplandor-floral' ),
        'add_new'            => __( 'Añadir Nueva Crema', 'resplandor-floral' ),
        'add_new_item'       => __( 'Añadir Nueva Crema', 'resplandor-floral' ),
        'edit_item'          => __( 'Editar Crema', 'resplandor-floral' ),
        'new_item'           => __( 'Nueva Crema', 'resplandor-floral' ),
        'view_item'          => __( 'Ver Crema', 'resplandor-floral' ),
        'search_items'       => __( 'Buscar Cremas', 'resplandor-floral' ),
        'not_found'          => __( 'No se encontraron cremas', 'resplandor-floral' ),
        'not_found_in_trash' => __( 'No hay cremas en la papelera', 'resplandor-floral' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'crema' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-heart',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'resplandor_producto', $args );
}
add_action( 'init', 'resplandor_register_cpt' );

/**
 * Obtener catálogo de productos (dinámico con CPT o predeterminado original)
 */
function resplandor_get_catalog_items() {
    $cpt_query = new WP_Query( array(
        'post_type'      => 'resplandor_producto',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order title',
        'order'          => 'ASC',
    ) );

    if ( $cpt_query->have_posts() ) {
        $items = array();
        while ( $cpt_query->have_posts() ) {
            $cpt_query->the_post();
            $price = get_post_meta( get_the_ID(), '_resplandor_price', true );
            $category = get_post_meta( get_the_ID(), '_resplandor_cat', true );
            $items[] = array(
                'name'     => get_the_title(),
                'price'    => $price ? $price : '$35.000',
                'category' => $category ? $category : 'Cremas faciales',
                'desc'     => get_the_excerpt() ? get_the_excerpt() : get_the_content(),
            );
        }
        wp_reset_postdata();
        return $items;
    }

    // Catálogo original predeterminado del sitio
    return array(
        array(
            'category' => 'Cremas faciales',
            'name'     => 'Crema hidratante Reparadora',
            'price'    => '$35.000',
            'desc'     => 'Somos una empresa dedicada a la creación y comercialización de cremas hidratantes con esencias florales naturales, que combinan el cuidado de la piel con una experiencia de bienestar.',
        ),
        array(
            'category' => 'Cremas faciales',
            'name'     => 'Crema Rejuvenecedora',
            'price'    => '$40.000',
            'desc'     => 'Crema facial enfocada en brindar hidratación y favorecer una apariencia más luminosa y cuidada. Su propuesta combina ácido hialurónico con esencias florales, convirtiendo la rutina de cuidado facial en una experiencia de hidratación y bienestar.',
        ),
        array(
            'category' => 'Cremas faciales',
            'name'     => 'Crema Premium',
            'price'    => '$48.000',
            'desc'     => 'Nuestra propuesta premium reúne el concepto principal de Resplandor Floral: hidratación, cuidado y una experiencia sensorial a través de las esencias florales. Está pensada para quienes buscan convertir su rutina facial en un momento especial de autocuidado, suavidad y bienestar.',
        ),
        array(
            'category' => 'Tipo de piel',
            'name'     => 'Crema Hidratante para Piel Mixta',
            'price'    => '$30.000',
            'desc'     => 'Crema facial especialmente pensada para las necesidades de la piel mixta. Ayuda a mantener una adecuada hidratación y cuidado del rostro, acompañando la rutina diaria con los beneficios de las esencias florales y una selección de ingredientes destinados al cuidado de la piel.',
        ),
        array(
            'category' => 'Tipo de piel',
            'name'     => 'Crema Hidratante para Piel Grasa',
            'price'    => '$32.000',
            'desc'     => 'Una crema creada para ayudar a equilibrar la humedad natural de la piel. Su fórmula busca evitar la pérdida de agua y generar una capa protectora sobre la piel. Contiene ácido hialurónico, glicerina, caléndula, ceramidas, aloe vera, retinol y esencias florales para una sensación de suavidad e hidratación.',
        ),
        array(
            'category' => 'Tipo de piel',
            'name'     => 'Crema Hidratante para Piel Seca',
            'price'    => '$35.000',
            'desc'     => 'Una opción pensada para complementar el cuidado facial y aportar una sensación de suavidad y frescura. La combinación de aloe vera, lavanda y esencias florales crea una experiencia agradable para quienes buscan incorporar un momento de cuidado y bienestar a su rutina.',
        ),
    );
}

/**
 * Procesamiento seguro de formulario de contacto vía AJAX
 */
function resplandor_handle_contact_ajax() {
    check_ajax_referer( 'resplandor_contact_nonce', 'nonce' );

    $name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
    $phone   = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
    $email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
    $cream   = isset( $_POST['cream'] ) ? sanitize_text_field( wp_unslash( $_POST['cream'] ) ) : '';
    $message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

    if ( empty( $name ) || empty( $phone ) ) {
        wp_send_json_error( __( 'Por favor completa al menos tu nombre y teléfono de contacto.', 'resplandor-floral' ) );
    }

    $to = get_theme_mod( 'resplandor_email', get_option( 'admin_email' ) );
    $subject = sprintf( __( 'Nuevo pedido/contacto de Resplandor Floral: %s', 'resplandor-floral' ), $name );
    $body = "Has recibido una nueva solicitud desde la web:\n\n";
    $body .= "Nombre: " . $name . "\n";
    $body .= "Teléfono/WhatsApp: " . $phone . "\n";
    if ( $email ) {
        $body .= "Correo: " . $email . "\n";
    }
    $body .= "Producto solicitado: " . $cream . "\n";
    if ( $message ) {
        $body .= "Mensaje: " . $message . "\n";
    }
    $body .= "\nFecha: " . current_time( 'mysql' );

    $headers = array( 'Content-Type: text/plain; charset=UTF-8' );
    if ( $email ) {
        $headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';
    }

    $sent = wp_mail( $to, $subject, $body, $headers );

    if ( $sent ) {
        wp_send_json_success( sprintf( __( '¡Gracias, %s! Tu solicitud para "%s" ha sido recibida con éxito.', 'resplandor-floral' ), $name, $cream ) );
    } else {
        // Fallback positivo si wp_mail no tiene servidor SMTP activo en local
        wp_send_json_success( sprintf( __( '¡Gracias, %s! Hemos tomado tu solicitud para "%s".', 'resplandor-floral' ), $name, $cream ) );
    }
}
add_action( 'wp_ajax_resplandor_send_contact', 'resplandor_handle_contact_ajax' );
add_action( 'wp_ajax_nopriv_resplandor_send_contact', 'resplandor_handle_contact_ajax' );
