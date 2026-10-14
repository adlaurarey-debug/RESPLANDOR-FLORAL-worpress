<?php
/**
 * The template for displaying archive pages
 *
 * @package Resplandor_Floral
 */

get_header();
?>

<main id="primary" class="site-main">

    <header class="page-header-area">
        <div class="container">
            <?php
            the_archive_title( '<h1>', '</h1>' );
            the_archive_description( '<div class="archive-description"><p>', '</p></div>' );
            ?>
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
