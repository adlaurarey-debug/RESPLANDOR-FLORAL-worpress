<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Resplandor_Floral
 */

get_header();
?>

<main id="primary" class="site-main">

    <div class="content-area-standard">
        <div class="container">
            <div class="error-404-container">
                
                <div class="error-404-code">404</div>
                
                <h1 style="margin-bottom: 16px;"><?php esc_html_e( 'Página no encontrada', 'resplandor-floral' ); ?></h1>
                
                <p style="margin-bottom: 32px; color: #64748b; font-size: 1.15rem;">
                    <?php esc_html_e( 'Lo sentimos, la página que buscas no existe o ha florecido en otro lugar. Te invitamos a explorar nuestra colección de cremas hidratantes.', 'resplandor-floral' ); ?>
                </p>

                <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary btn-lg">
                        <i class="fa-solid fa-house" aria-hidden="true"></i>
                        <span><?php esc_html_e( 'Volver al Inicio', 'resplandor-floral' ); ?></span>
                    </a>

                    <button type="button" onclick="openContactModal();" class="btn btn-outline btn-lg">
                        <i class="fa-solid fa-envelope" aria-hidden="true"></i>
                        <span><?php esc_html_e( 'Contáctanos', 'resplandor-floral' ); ?></span>
                    </button>
                </div>

            </div>
        </div>
    </div>

</main>

<?php
get_footer();
