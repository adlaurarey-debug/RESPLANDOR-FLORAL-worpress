<?php
/**
 * The main template file
 *
 * @package Resplandor_Floral
 */

get_header();
?>

<main id="primary" class="site-main">

    <header class="page-header-area">
        <div class="container">
            <h1><?php esc_html_e( 'Blog y Actualidad Botánica', 'resplandor-floral' ); ?></h1>
            <p><?php esc_html_e( 'Consejos de cuidado facial, bienestar y secretos de las esencias florales.', 'resplandor-floral' ); ?></p>
        </div>
    </header>

    <div class="content-area-standard">
        <div class="container">
            <?php if ( have_posts() ) : ?>
                <div class="posts-grid">
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        get_template_part( 'template-parts/content', get_post_format() );
                    endwhile;
                    ?>
                </div>

                <div style="margin-top: 48px; text-align: center;">
                    <?php
                    the_posts_pagination( array(
                        'mid_size'  => 2,
                        'prev_text' => '<i class="fa-solid fa-arrow-left"></i> ' . __( 'Anterior', 'resplandor-floral' ),
                        'next_text' => __( 'Siguiente', 'resplandor-floral' ) . ' <i class="fa-solid fa-arrow-right"></i>',
                    ) );
                    ?>
                </div>

            <?php else : ?>
                <?php get_template_part( 'template-parts/content', 'none' ); ?>
            <?php endif; ?>
        </div>
    </div>

</main>

<?php
get_footer();
