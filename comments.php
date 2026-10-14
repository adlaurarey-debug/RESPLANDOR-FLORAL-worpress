<?php
/**
 * The template for displaying comments
 *
 * @package Resplandor_Floral
 */

if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area" style="margin-top: 48px; padding-top: 36px; border-top: 1px solid #f1f5f9;">

    <?php if ( have_comments() ) : ?>
        <h3 class="comments-title" style="margin-bottom: 24px;">
            <?php
            $comment_count = get_comments_number();
            if ( '1' === $comment_count ) {
                printf(
                    /* translators: 1: title. */
                    esc_html__( 'Un comentario en &ldquo;%1$s&rdquo;', 'resplandor-floral' ),
                    '<span>' . wp_kses_post( get_the_title() ) . '</span>'
                );
            } else {
                printf(
                    /* translators: 1: comment count number, 2: title. */
                    esc_html( _nx( '%1$s comentario en &ldquo;%2$s&rdquo;', '%1$s comentarios en &ldquo;%2$s&rdquo;', $comment_count, 'comments title', 'resplandor-floral' ) ),
                    number_format_i18n( $comment_count ),
                    '<span>' . wp_kses_post( get_the_title() ) . '</span>'
                );
            }
            ?>
        </h3>

        <ol class="comment-list" style="list-style: none; padding: 0; margin-bottom: 32px;">
            <?php
            wp_list_comments( array(
                'style'      => 'ol',
                'short_ping' => true,
                'avatar_size'=> 48,
            ) );
            ?>
        </ol>

        <?php the_comments_navigation(); ?>

        <?php if ( ! comments_open() ) : ?>
            <p class="no-comments" style="color: #64748b; font-style: italic;"><?php esc_html_e( 'Los comentarios están cerrados.', 'resplandor-floral' ); ?></p>
        <?php endif; ?>

    <?php endif; ?>

    <?php comment_form(); ?>

</div>
