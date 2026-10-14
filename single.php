<?php
/**
 * The template for displaying all single posts
 *
 * @package Resplandor_Floral
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php while ( have_posts() ) : the_post(); ?>

        <header class="page-header-area">
            <div class="container">
                <div style="margin-bottom: 12px;">
                    <?php
                    $categories = get_the_category();
                    if ( ! empty( $categories ) ) {
                        echo '<span style="background: #f5edfc; color: #9b51e0; font-size: 0.85rem; font-weight: 700; padding: 4px 14px; border-radius: 9999px;">' . esc_html( $categories[0]->name ) . '</span>';
                    }
                    ?>
                </div>
                <h1><?php the_title(); ?></h1>
                <div class="post-meta-bar" style="justify-content: center; border: none; margin-bottom: 0; padding-bottom: 0;">
                    <span><i class="fa-regular fa-calendar" aria-hidden="true"></i> <?php echo get_the_date(); ?></span>
                    <span><i class="fa-regular fa-user" aria-hidden="true"></i> <?php the_author(); ?></span>
                    <?php if ( comments_open() ) : ?>
                        <span><i class="fa-regular fa-comment" aria-hidden="true"></i> <?php comments_number( '0 comentarios', '1 comentario', '% comentarios' ); ?></span>
                    <?php endif; ?>
                </div>
            </div>
        </header>

        <div class="content-area-standard">
            <div class="container">
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post-article' ); ?>>

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

                    <!-- Navegación entre entradas -->
                    <div style="margin-top: 48px; padding-top: 24px; border-top: 1px solid #f1f5f9; display: flex; justify-content: space-between; gap: 20px; flex-wrap: wrap;">
                        <div>
                            <?php previous_post_link( '%link', '<i class="fa-solid fa-arrow-left"></i> %title' ); ?>
                        </div>
                        <div>
                            <?php next_post_link( '%link', '%title <i class="fa-solid fa-arrow-right"></i>' ); ?>
                        </div>
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
