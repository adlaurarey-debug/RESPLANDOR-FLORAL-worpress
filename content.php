<?php
/**
 * Template part for displaying posts in a grid
 *
 * @package Resplandor_Floral
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>

    <?php if ( has_post_thumbnail() ) : ?>
        <a href="<?php the_permalink(); ?>" class="post-card-thumb" aria-hidden="true" tabindex="-1">
            <?php the_post_thumbnail( 'medium_large' ); ?>
        </a>
    <?php else : ?>
        <a href="<?php the_permalink(); ?>" class="post-card-thumb" aria-hidden="true" tabindex="-1">
            <img src="<?php echo esc_url( resplandor_asset_image( 'calidad-1.jpg' ) ); ?>" alt="<?php the_title_attribute(); ?>">
        </a>
    <?php endif; ?>

    <div class="post-card-body">
        <div style="font-size: 0.85rem; color: #a855f7; font-weight: 600; margin-bottom: 8px;">
            <?php echo get_the_date(); ?>
        </div>

        <h3 class="post-card-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <div class="post-card-excerpt">
            <?php the_excerpt(); ?>
        </div>

        <div style="margin-top: auto; padding-top: 14px;">
            <a href="<?php the_permalink(); ?>" class="btn btn-outline" style="padding: 8px 18px; font-size: 0.88rem;">
                <span><?php esc_html_e( 'Leer artículo', 'resplandor-floral' ); ?></span>
                <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
            </a>
        </div>
    </div>

</article>
