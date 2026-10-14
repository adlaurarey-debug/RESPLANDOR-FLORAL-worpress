<?php
/**
 * The template for displaying all pages
 *
 * @package Resplandor_Floral
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php while ( have_posts() ) : the_post(); ?>

        <header class="page-header-area">
            <div class="container">
                <h1><?php the_title(); ?></h1>
            </div>
        </header>

        <div class="content-area-standard">
            <div class="container">
                <article id="post-<?php the_ID(); ?>" <?php body_class( 'page-content-wrapper' ); ?>>
                    
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-featured-image">
                            <?php the_post_thumbnail( 'large' ); ?>
                        </div>
                    <?php endif; ?>

                    <div class="entry-content">
                        <?php
                        the_content();

                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . esc_html__( 'Páginas:', 'resplandor-floral' ),
                            'after'  => '</div>',
                        ) );
                        ?>
                    </div>

                    <?php
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                    ?>

                </article>
            </div>
        </div>

    <?php endwhile; ?>

</main>

<?php
get_footer();
