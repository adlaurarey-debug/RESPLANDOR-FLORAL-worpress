<?php
/**
 * The Header for Resplandor Floral theme
 *
 * @package Resplandor_Floral
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Header / Barra de Navegación -->
<header class="site-header" id="site-header">
    <div class="container nav-container">
        
        <!-- Logo / Marca -->
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand-logo" rel="home">
            <?php
            if ( has_custom_logo() ) {
                the_custom_logo();
            } else {
                $default_logo = resplandor_asset_image( 'logo.png' );
                ?>
                <img src="<?php echo esc_url( $default_logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" width="48" height="48">
                <?php
            }
            ?>
            <span class="site-title"><?php bloginfo( 'name' ); ?></span>
        </a>

        <!-- Menú de Navegación -->
        <?php
        if ( has_nav_menu( 'primary' ) ) {
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'container'      => 'nav',
                'container_id'   => 'site-navigation',
                'menu_class'     => 'nav-menu',
                'fallback_cb'    => false,
            ) );
        } else {
            // Fallback elegante con anclas a las secciones originales
            ?>
            <nav id="site-navigation" aria-label="<?php esc_attr_e( 'Navegación principal', 'resplandor-floral' ); ?>">
                <ul class="nav-menu">
                    <li><a href="<?php echo is_front_page() ? '#inicio' : esc_url( home_url( '/#inicio' ) ); ?>" class="nav-link active"><?php esc_html_e( 'Inicio', 'resplandor-floral' ); ?></a></li>
                    <li><a href="<?php echo is_front_page() ? '#calidad' : esc_url( home_url( '/#calidad' ) ); ?>" class="nav-link"><?php esc_html_e( 'Calidad', 'resplandor-floral' ); ?></a></li>
                    <li><a href="<?php echo is_front_page() ? '#coleccion' : esc_url( home_url( '/#coleccion' ) ); ?>" class="nav-link"><?php esc_html_e( 'Colección', 'resplandor-floral' ); ?></a></li>
                    <li><a href="<?php echo is_front_page() ? '#nosotros' : esc_url( home_url( '/#nosotros' ) ); ?>" class="nav-link"><?php esc_html_e( 'Nosotros', 'resplandor-floral' ); ?></a></li>
                    <li><a href="#contacto" onclick="openContactModal(); return false;" class="nav-link"><?php esc_html_e( 'Contacto', 'resplandor-floral' ); ?></a></li>
                </ul>
            </nav>
            <?php
        }
        ?>

        <!-- Acciones de Cabecera (Teléfono, Botón de Contacto, Menú Móvil) -->
        <div class="nav-actions">
            <?php
            $header_phone = get_theme_mod( 'resplandor_phone', '+1 555-555-5556' );
            if ( $header_phone ) :
                $clean_phone = preg_replace( '/[^0-9+]/', '', $header_phone );
            ?>
                <a href="tel:<?php echo esc_attr( $clean_phone ); ?>" class="phone-link" title="<?php esc_attr_e( 'Llamar a Resplandor Floral', 'resplandor-floral' ); ?>">
                    <i class="fa-solid fa-phone" aria-hidden="true"></i>
                    <span><?php echo esc_html( $header_phone ); ?></span>
                </a>
            <?php endif; ?>

            <a href="#contacto" onclick="openContactModal(); return false;" class="btn btn-primary">
                <?php esc_html_e( 'Contáctanos', 'resplandor-floral' ); ?>
            </a>

            <button class="menu-toggle" aria-label="<?php esc_attr_e( 'Abrir Menú de Navegación', 'resplandor-floral' ); ?>" aria-expanded="false" aria-controls="site-navigation">
                <i class="fa-solid fa-bars" aria-hidden="true"></i>
            </button>
        </div>

    </div>
</header>
