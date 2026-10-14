<?php
/**
 * The Footer for Resplandor Floral theme
 *
 * @package Resplandor_Floral
 */
?>

<!-- Pie de Página -->
<footer class="site-footer" id="site-footer">
    <div class="container">
        <div class="footer-grid">
            
            <!-- Columna 1: Enlaces útiles -->
            <div class="footer-col">
                <h5><?php esc_html_e( 'Enlaces útiles', 'resplandor-floral' ); ?></h5>
                <?php
                if ( has_nav_menu( 'footer' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'footer',
                        'container'      => false,
                        'menu_class'     => 'footer-links',
                        'depth'          => 1,
                    ) );
                } else {
                    ?>
                    <ul class="footer-links">
                        <li><a href="<?php echo is_front_page() ? '#inicio' : esc_url( home_url( '/#inicio' ) ); ?>"><?php esc_html_e( 'Inicio', 'resplandor-floral' ); ?></a></li>
                        <li><a href="<?php echo is_front_page() ? '#calidad' : esc_url( home_url( '/#calidad' ) ); ?>"><?php esc_html_e( 'Calidad', 'resplandor-floral' ); ?></a></li>
                        <li><a href="<?php echo is_front_page() ? '#coleccion' : esc_url( home_url( '/#coleccion' ) ); ?>"><?php esc_html_e( 'Productos', 'resplandor-floral' ); ?></a></li>
                        <li><a href="<?php echo is_front_page() ? '#nosotros' : esc_url( home_url( '/#nosotros' ) ); ?>"><?php esc_html_e( 'Sobre nosotros', 'resplandor-floral' ); ?></a></li>
                        <li><a href="#contacto" onclick="openContactModal(); return false;"><?php esc_html_e( 'Contáctanos', 'resplandor-floral' ); ?></a></li>
                    </ul>
                    <?php
                }
                ?>
            </div>

            <!-- Columna 2: Sobre nosotros -->
            <div class="footer-col">
                <h5><?php esc_html_e( 'Sobre nosotros', 'resplandor-floral' ); ?></h5>
                <p><?php echo esc_html( get_theme_mod( 'resplandor_footer_about', 'Somos un equipo apasionado por crear cremas que cuidan, hidratan y transforman la piel. Desarrollamos fórmulas efectivas para resolver necesidades reales de belleza y bienestar.' ) ); ?></p>
                <p style="margin-top: 12px;"><?php esc_html_e( 'Nuestras cremas están pensadas para personas que buscan resultados visibles y una rutina de cuidado confiable.', 'resplandor-floral' ); ?></p>
            </div>

            <!-- Columna 3: Información de contacto & Redes Sociales -->
            <div class="footer-col">
                <h5><?php esc_html_e( 'Contáctanos', 'resplandor-floral' ); ?></h5>
                <div class="contact-info">
                    
                    <?php 
                    $email = get_theme_mod( 'resplandor_email', 'hola@tucrema.ejemplo.com' );
                    if ( $email ) : 
                    ?>
                    <div class="contact-item">
                        <i class="fa-solid fa-envelope" aria-hidden="true"></i>
                        <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
                    </div>
                    <?php endif; ?>

                    <?php 
                    $phone = get_theme_mod( 'resplandor_phone', '+1 555-555-5556' );
                    if ( $phone ) : 
                        $clean_phone = preg_replace( '/[^0-9+]/', '', $phone );
                    ?>
                    <div class="contact-item">
                        <i class="fa-solid fa-phone" aria-hidden="true"></i>
                        <a href="tel:<?php echo esc_attr( $clean_phone ); ?>"><?php echo esc_html( $phone ); ?></a>
                    </div>
                    <?php endif; ?>

                    <?php 
                    $location = get_theme_mod( 'resplandor_location', 'Colombia' );
                    if ( $location ) : 
                    ?>
                    <div class="contact-item">
                        <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                        <span><?php echo esc_html( $location ); ?></span>
                    </div>
                    <?php endif; ?>

                </div>

                <!-- Redes Sociales -->
                <div class="social-icons">
                    <?php
                    $fb = get_theme_mod( 'resplandor_social_facebook', '#' );
                    $ig = get_theme_mod( 'resplandor_social_instagram', '#' );
                    $tw = get_theme_mod( 'resplandor_social_twitter', '#' );
                    $wa_num = preg_replace( '/[^0-9]/', '', get_theme_mod( 'resplandor_whatsapp', '+573000000000' ) );
                    $wa_url = get_theme_mod( 'resplandor_social_whatsapp', 'https://wa.me/' . $wa_num );
                    ?>
                    <?php if ( $fb ) : ?><a href="<?php echo esc_url( $fb ); ?>" target="_blank" rel="noopener" class="social-icon" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a><?php endif; ?>
                    <?php if ( $ig ) : ?><a href="<?php echo esc_url( $ig ); ?>" target="_blank" rel="noopener" class="social-icon" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a><?php endif; ?>
                    <?php if ( $tw ) : ?><a href="<?php echo esc_url( $tw ); ?>" target="_blank" rel="noopener" class="social-icon" aria-label="X Twitter"><i class="fa-brands fa-x-twitter"></i></a><?php endif; ?>
                    <?php if ( $wa_url ) : ?><a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" rel="noopener" class="social-icon" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a><?php endif; ?>
                </div>
            </div>

        </div>

        <!-- Copyright inferior -->
        <div class="footer-bottom">
            <div><?php echo esc_html( get_theme_mod( 'resplandor_footer_copy', 'Derechos reservados © Resplandor Floral' ) ); ?></div>
            <div><?php esc_html_e( 'Cosmética y Cuidado Facial Natural', 'resplandor-floral' ); ?></div>
        </div>
    </div>
</footer>

<!-- Modal de Contacto y Pedidos Interactivo -->
<div id="contactModal" class="modal-overlay" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
    <div class="modal-content">
        <button type="button" class="close-modal" onclick="closeContactModal();" aria-label="<?php esc_attr_e( 'Cerrar ventana', 'resplandor-floral' ); ?>">&times;</button>
        
        <h3 id="modalTitle" class="modal-title"><?php esc_html_e( 'Escríbenos', 'resplandor-floral' ); ?></h3>
        <p class="modal-subtitle"><?php esc_html_e( 'Déjanos un mensaje y te responderemos a la brevedad con la asesoría que tu piel necesita.', 'resplandor-floral' ); ?></p>
        
        <form id="resplandorContactForm">
            <div class="form-group">
                <label for="resplandor_name"><?php esc_html_e( 'Nombre completo *', 'resplandor-floral' ); ?></label>
                <input type="text" id="resplandor_name" name="name" class="form-control" placeholder="<?php esc_attr_e( 'Tu nombre', 'resplandor-floral' ); ?>" required>
            </div>

            <div class="form-group">
                <label for="resplandor_phone"><?php esc_html_e( 'Teléfono / WhatsApp *', 'resplandor-floral' ); ?></label>
                <input type="tel" id="resplandor_phone" name="phone" class="form-control" placeholder="<?php esc_attr_e( '+57 300 000 0000', 'resplandor-floral' ); ?>" required>
            </div>

            <div class="form-group">
                <label for="resplandor_email"><?php esc_html_e( 'Correo electrónico (opcional)', 'resplandor-floral' ); ?></label>
                <input type="email" id="resplandor_email" name="email" class="form-control" placeholder="<?php esc_attr_e( 'tucorreo@ejemplo.com', 'resplandor-floral' ); ?>">
            </div>

            <div class="form-group">
                <label for="resplandor_cream"><?php esc_html_e( 'Producto de interés', 'resplandor-floral' ); ?></label>
                <select id="resplandor_cream" name="cream" class="form-control">
                    <option value="Crema Reparadora ($35.000)"><?php esc_html_e( 'Crema hidratante Reparadora ($35.000)', 'resplandor-floral' ); ?></option>
                    <option value="Crema Rejuvenecedora ($40.000)"><?php esc_html_e( 'Crema Rejuvenecedora ($40.000)', 'resplandor-floral' ); ?></option>
                    <option value="Crema Premium ($48.000)"><?php esc_html_e( 'Crema Premium ($48.000)', 'resplandor-floral' ); ?></option>
                    <option value="Piel Mixta ($30.000)"><?php esc_html_e( 'Crema Piel Mixta ($30.000)', 'resplandor-floral' ); ?></option>
                    <option value="Piel Grasa ($32.000)"><?php esc_html_e( 'Crema Piel Grasa ($32.000)', 'resplandor-floral' ); ?></option>
                    <option value="Piel Seca ($35.000)"><?php esc_html_e( 'Crema Piel Seca ($35.000)', 'resplandor-floral' ); ?></option>
                    <option value="Consulta general"><?php esc_html_e( 'Consulta general / Asesoría para mi piel', 'resplandor-floral' ); ?></option>
                </select>
            </div>

            <div class="form-group">
                <label for="resplandor_message"><?php esc_html_e( 'Mensaje o preguntas', 'resplandor-floral' ); ?></label>
                <textarea id="resplandor_message" name="message" class="form-control" rows="3" placeholder="<?php esc_attr_e( '¿Cómo podemos ayudarte?', 'resplandor-floral' ); ?>"></textarea>
            </div>

            <div id="formStatus" class="form-status"></div>

            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px;">
                <?php esc_html_e( 'Enviar mensaje', 'resplandor-floral' ); ?>
            </button>
        </form>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>
