<?php
/**
 * The Front Page template for Resplandor Floral
 *
 * @package Resplandor_Floral
 */

get_header();

// Obtener catálogo de productos
$catalog_items = resplandor_get_catalog_items();

// Agrupar productos por categoría
$categories = array();
foreach ( $catalog_items as $item ) {
    $cat = ! empty( $item['category'] ) ? $item['category'] : 'Cremas faciales';
    $categories[$cat][] = $item;
}
?>

<main id="primary" class="site-main">

    <!-- 1. Hero Section (Portada) -->
    <section id="inicio" class="hero">
        <div class="container hero-content">
            <img 
                src="<?php echo esc_url( resplandor_asset_image( 'logo.png' ) ); ?>" 
                alt="<?php bloginfo( 'name' ); ?> Logo" 
                class="hero-logo-img"
                width="260"
                height="260"
            >
            <h1><?php echo esc_html( get_theme_mod( 'resplandor_hero_title', 'RESPLANDOR FLORAL' ) ); ?></h1>
            <p><?php echo esc_html( get_theme_mod( 'resplandor_hero_desc', 'Esencias naturales que florecen en tu piel, diseñadas para brindar una experiencia sensorial relajante y de autocuidado.' ) ); ?></p>
            <a href="#coleccion" class="btn btn-primary btn-lg">
                <span><?php echo esc_html( get_theme_mod( 'resplandor_hero_btn_text', 'Conozca nuestras cremas' ) ); ?></span>
                <i class="fa-solid fa-arrow-down" aria-hidden="true"></i>
            </a>
        </div>
    </section>

    <!-- 2. Calidad Section -->
    <section id="calidad" class="calidad-section">
        <div class="container">
            <div class="calidad-grid">
                
                <div class="calidad-card">
                    <h2><?php echo esc_html( get_theme_mod( 'resplandor_calidad_title', 'Calidad' ) ); ?></h2>
                    <p><?php echo wp_kses_post( get_theme_mod( 'resplandor_calidad_text', 'Nuestras fórmulas están diseñadas para diferentes tipos de piel y contienen esencias de flores como <strong>rosa, lavanda, jazmín y manzanilla</strong>, que aportan aromas agradables y una experiencia sensorial relajante.' ) ); ?></p>
                </div>

                <div class="calidad-images">
                    <div class="calidad-img-box">
                        <img 
                            src="<?php echo esc_url( resplandor_asset_image( 'calidad-1.jpg' ) ); ?>" 
                            alt="<?php esc_attr_e( 'Ingredientes naturales y cuidado botánico', 'resplandor-floral' ); ?>"
                            loading="lazy"
                        >
                    </div>
                    <div class="calidad-img-box">
                        <img 
                            src="<?php echo esc_url( resplandor_asset_image( 'calidad-2.jpg' ) ); ?>" 
                            alt="<?php esc_attr_e( 'Cosmética floral y cuidado facial', 'resplandor-floral' ); ?>"
                            loading="lazy"
                        >
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 3. Colección & Lista de Precios Editorial (Nuestra Colección) -->
    <section id="coleccion" class="collection-section" style="background-image: url('<?php echo esc_url( resplandor_asset_image( 'collection-bg.jpg' ) ); ?>');">
        <div class="container collection-container">
            <div class="menu-card">
                
                <div class="menu-header">
                    <h2><?php echo esc_html( get_theme_mod( 'resplandor_coleccion_title', 'Nuestra colección de cremas' ) ); ?></h2>
                    <p><?php echo esc_html( get_theme_mod( 'resplandor_coleccion_desc', 'Somos una empresa dedicada a la creación y comercialización de cremas hidratantes con esencias florales naturales, que combinan el cuidado de la piel con una experiencia de bienestar.' ) ); ?></p>
                </div>

                <?php foreach ( $categories as $cat_name => $products ) : ?>
                    <h3 class="category-title">
                        <span>✽</span> <?php echo esc_html( $cat_name ); ?>
                    </h3>

                    <?php foreach ( $products as $prod ) : ?>
                        <article class="product-item">
                            <div class="product-top">
                                <span class="product-name"><?php echo esc_html( $prod['name'] ); ?></span>
                                <span class="product-dots" aria-hidden="true"></span>
                                <span class="product-price"><?php echo esc_html( $prod['price'] ); ?></span>
                            </div>
                            <p class="product-desc"><?php echo esc_html( $prod['desc'] ); ?></p>
                        </article>
                    <?php endforeach; ?>

                <?php endforeach; ?>

                <div style="text-align: center; margin-top: 40px;">
                    <button type="button" onclick="openContactModal();" class="btn btn-primary btn-lg">
                        <i class="fa-solid fa-bag-shopping" aria-hidden="true"></i>
                        <span><?php esc_html_e( 'Hacer un Pedido', 'resplandor-floral' ); ?></span>
                    </button>
                </div>

            </div>
        </div>
    </section>

    <!-- 4. Features Wall / Nosotros Floral -->
    <section id="nosotros" class="features-section">
        <div class="container">
            <div class="features-grid">
                
                <!-- Columna 1: Presentación Institucional -->
                <div class="about-text-col">
                    <h2>🌸 RESPLANDOR FLORAL</h2>
                    <p><?php esc_html_e( 'En Resplandor Floral creemos que el cuidado de la piel también puede ser un momento para consentirte, relajarte y reconectar contigo. Por eso creamos una línea de cremas hidratantes faciales con esencias florales, diseñadas para brindar hidratación, suavidad y una agradable experiencia sensorial.', 'resplandor-floral' ); ?></p>
                    <p><?php esc_html_e( 'Nuestra línea cuenta con opciones pensadas para diferentes tipos de piel, incorporando ingredientes como aloe vera, glicerina, caléndula, ácido hialurónico, hidrolatos y esencias florales, seleccionados de acuerdo con las necesidades de cada producto.', 'resplandor-floral' ); ?></p>
                    
                    <div class="about-list">
                        <div class="about-list-item">
                            <span aria-hidden="true">🌷</span>
                            <div><strong><?php esc_html_e( 'Hidratación y cuidado:', 'resplandor-floral' ); ?></strong> <?php esc_html_e( 'ayuda a mantener la piel suave y confortable.', 'resplandor-floral' ); ?></div>
                        </div>
                        <div class="about-list-item">
                            <span aria-hidden="true">🌿</span>
                            <div><strong><?php esc_html_e( 'Esencias florales:', 'resplandor-floral' ); ?></strong> <?php esc_html_e( 'aportan una experiencia sensorial agradable durante el cuidado facial.', 'resplandor-floral' ); ?></div>
                        </div>
                        <div class="about-list-item">
                            <span aria-hidden="true">✨</span>
                            <div><strong><?php esc_html_e( 'Para diferentes tipos de piel:', 'resplandor-floral' ); ?></strong> <?php esc_html_e( 'opciones orientadas a piel seca, grasa y mixta.', 'resplandor-floral' ); ?></div>
                        </div>
                        <div class="about-list-item">
                            <span aria-hidden="true">💗</span>
                            <div><strong><?php esc_html_e( 'Cuidado personal:', 'resplandor-floral' ); ?></strong> <?php esc_html_e( 'convierte tu rutina facial en un momento para ti.', 'resplandor-floral' ); ?></div>
                        </div>
                    </div>

                    <p style="font-weight: 600; color: #a855f7; margin-top: 24px; font-style: italic;">
                        "<?php echo esc_html( get_theme_mod( 'resplandor_slogan', 'Esencias que florecen, belleza que se siente.' ) ); ?>"
                    </p>
                </div>

                <!-- Columna 2: Imágenes y Cajas de Características -->
                <div>
                    <div class="feature-img-card">
                        <img 
                            src="<?php echo esc_url( resplandor_asset_image( 'feature-1.jpg' ) ); ?>" 
                            alt="<?php esc_attr_e( 'Cremas faciales botánicas', 'resplandor-floral' ); ?>"
                            loading="lazy"
                        >
                    </div>

                    <div class="feature-box">
                        <h3><?php esc_html_e( 'Cremas faciales', 'resplandor-floral' ); ?></h3>
                        <p><?php esc_html_e( 'Encuentre la crema perfecta con nuestra exclusiva gama de cremas. Diseñadas para hidratar y cuidar su piel durante todo el día.', 'resplandor-floral' ); ?></p>
                    </div>

                    <div class="feature-img-card">
                        <img 
                            src="<?php echo esc_url( resplandor_asset_image( 'feature-2.jpg' ) ); ?>" 
                            alt="<?php esc_attr_e( 'Textura hidratante floral', 'resplandor-floral' ); ?>"
                            loading="lazy"
                        >
                    </div>
                </div>

                <!-- Columna 3: Características e Imágenes -->
                <div>
                    <div class="feature-box">
                        <h3><?php esc_html_e( 'Cremas naturales para la piel', 'resplandor-floral' ); ?></h3>
                        <p><?php esc_html_e( 'Revitalice su piel con nuestra línea de cremas orgánicas libres de químicos. Están diseñadas para todo tipo de piel.', 'resplandor-floral' ); ?></p>
                    </div>

                    <div class="feature-img-card">
                        <img 
                            src="<?php echo esc_url( resplandor_asset_image( 'feature-3.jpg' ) ); ?>" 
                            alt="<?php esc_attr_e( 'Ingredientes botánicos y extractos', 'resplandor-floral' ); ?>"
                            loading="lazy"
                        >
                    </div>

                    <div class="feature-box">
                        <h3><?php esc_html_e( 'Colección de cremas premium', 'resplandor-floral' ); ?></h3>
                        <p><?php esc_html_e( 'Explore nuestra lujosa selección de cremas. Encontrará texturas suaves y fórmulas duraderas para que su piel luzca de maravilla todos los días.', 'resplandor-floral' ); ?></p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 5. Banner Panorámico Frame -->
    <section class="banner-section">
        <div class="container">
            <div class="banner-container">
                <img 
                    src="<?php echo esc_url( resplandor_asset_image( 'banner-main.jpg' ) ); ?>" 
                    alt="<?php esc_attr_e( 'Resplandor Floral Selección Botánica', 'resplandor-floral' ); ?>"
                    loading="lazy"
                >
            </div>
        </div>
    </section>

    <!-- 6. Call To Action (CTA) -->
    <section id="contacto" class="cta-section">
        <div class="container">
            <h2><?php echo nl2br( esc_html( get_theme_mod( 'resplandor_cta_title', "La crema \nes aburrida si no la haces tuya con tu estilo." ) ) ); ?></h2>
            <p><?php echo esc_html( get_theme_mod( 'resplandor_cta_desc', 'Únete a nosotros y disfruta del placer de cuidar tu piel.' ) ); ?></p>
            <button type="button" onclick="openContactModal();" class="btn btn-primary btn-lg">
                <i class="fa-solid fa-paper-plane" aria-hidden="true"></i>
                <span><?php esc_html_e( 'Contáctanos Ahora', 'resplandor-floral' ); ?></span>
            </button>
        </div>
    </section>

    <?php
    // Si la página de inicio tiene contenido Gutenberg adicional en el editor de WordPress, renderizarlo limpiamente
    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();
            $content = get_the_content();
            if ( ! empty( trim( $content ) ) ) :
                ?>
                <section class="content-area-standard">
                    <div class="container page-content-wrapper">
                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </section>
                <?php
            endif;
        endwhile;
    endif;
    ?>

</main>

<?php
get_footer();
