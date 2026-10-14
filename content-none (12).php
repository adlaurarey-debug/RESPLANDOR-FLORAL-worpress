<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package Resplandor_Floral
 */
?>

<div class="no-results not-found" style="text-align: center; padding: 60px 20px; max-width: 600px; margin: 0 auto;">
    <div style="font-size: 3rem; margin-bottom: 16px;">🌸</div>
    <h2 style="margin-bottom: 16px;"><?php esc_html_e( 'No se encontraron publicaciones', 'resplandor-floral' ); ?></h2>
    
    <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
        <p style="margin-bottom: 24px;">
            <?php
            printf(
                wp_kses(
                    /* translators: 1: link to WP admin new post page. */
                    __( '¿Listo para publicar tu primera entrada? <a href="%1$s">Comienza aquí</a>.', 'resplandor-floral' ),
                    array(
                        'a' => array(
                            'href' => array(),
                        ),
                    )
                ),
                esc_url( admin_url( 'post-new.php' ) )
            );
            ?>
        </p>
    <?php elseif ( is_search() ) : ?>
        <p style="margin-bottom: 24px; color: #64748b;">
            <?php esc_html_e( 'Lo sentimos, no encontramos resultados que coincidan con tu búsqueda. Intenta con otros términos.', 'resplandor-floral' ); ?>
        </p>
        <?php get_search_form(); ?>
    <?php else : ?>
        <p style="margin-bottom: 24px; color: #64748b;">
            <?php esc_html_e( 'Parece que aún no hay contenidos en esta sección. Regresa pronto para conocer más novedades.', 'resplandor-floral' ); ?>
        </p>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">
            <?php esc_html_e( 'Volver a la portada', 'resplandor-floral' ); ?>
        </a>
    <?php endif; ?>
</div>
