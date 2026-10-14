/**
 * Resplandor Floral - Theme JavaScript
 * Version: 1.0.0
 */

document.addEventListener('DOMContentLoaded', function () {
    'use strict';

    // Elements
    const siteHeader = document.querySelector('.site-header');
    const menuToggle = document.querySelector('.menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    const contactModal = document.getElementById('contactModal');
    const closeModalBtn = document.querySelector('.close-modal');
    const contactForm = document.getElementById('resplandorContactForm');
    const formStatus = document.getElementById('formStatus');

    /* ==========================================
       1. Header Scroll Shadow
       ========================================== */
    function checkHeaderScroll() {
        if (!siteHeader) return;
        if (window.scrollY > 20) {
            siteHeader.classList.add('scrolled');
        } else {
            siteHeader.classList.remove('scrolled');
        }
    }

    window.addEventListener('scroll', checkHeaderScroll);
    checkHeaderScroll();

    /* ==========================================
       2. Mobile Menu Toggle
       ========================================== */
    if (menuToggle && navMenu) {
        menuToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            const isExpanded = navMenu.classList.toggle('active');
            menuToggle.setAttribute('aria-expanded', isExpanded);
            const icon = menuToggle.querySelector('i');
            if (icon) {
                if (isExpanded) {
                    icon.classList.remove('fa-bars');
                    icon.classList.add('fa-xmark');
                } else {
                    icon.classList.remove('fa-xmark');
                    icon.classList.add('fa-bars');
                }
            }
        });

        // Close when clicking any menu link
        navMenu.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                navMenu.classList.remove('active');
                if (menuToggle) {
                    menuToggle.setAttribute('aria-expanded', 'false');
                    const icon = menuToggle.querySelector('i');
                    if (icon) {
                        icon.classList.remove('fa-xmark');
                        icon.classList.add('fa-bars');
                    }
                }
            });
        });

        // Close when clicking outside
        document.addEventListener('click', function (e) {
            if (!navMenu.contains(e.target) && !menuToggle.contains(e.target)) {
                navMenu.classList.remove('active');
                if (menuToggle) {
                    menuToggle.setAttribute('aria-expanded', 'false');
                    const icon = menuToggle.querySelector('i');
                    if (icon) {
                        icon.classList.remove('fa-xmark');
                        icon.classList.add('fa-bars');
                    }
                }
            }
        });
    }

    /* ==========================================
       3. Modal Contact Form
       ========================================== */
    window.openContactModal = function (productName) {
        if (!contactModal) return;
        contactModal.classList.add('active');
        document.body.style.overflow = 'hidden';

        if (productName) {
            const productSelect = document.getElementById('resplandor_cream');
            if (productSelect) {
                for (let i = 0; i < productSelect.options.length; i++) {
                    if (productSelect.options[i].text.toLowerCase().includes(productName.toLowerCase())) {
                        productSelect.selectedIndex = i;
                        break;
                    }
                }
            }
        }

        // Focus first input
        setTimeout(function () {
            const nameInput = document.getElementById('resplandor_name');
            if (nameInput) nameInput.focus();
        }, 100);
    };

    window.closeContactModal = function () {
        if (!contactModal) return;
        contactModal.classList.remove('active');
        document.body.style.overflow = '';
        if (formStatus) {
            formStatus.className = 'form-status';
            formStatus.style.display = 'none';
        }
    };

    if (closeModalBtn) {
        closeModalBtn.addEventListener('click', window.closeContactModal);
    }

    if (contactModal) {
        contactModal.addEventListener('click', function (e) {
            if (e.target === contactModal) {
                window.closeContactModal();
            }
        });
    }

    // Close on Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && contactModal && contactModal.classList.contains('active')) {
            window.closeContactModal();
        }
    });

    /* ==========================================
       4. Contact Form Submission (AJAX + WhatsApp)
       ========================================== */
    if (contactForm) {
        contactForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const submitBtn = contactForm.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn ? submitBtn.innerHTML : 'Enviar mensaje';

            const name = document.getElementById('resplandor_name')?.value || '';
            const phone = document.getElementById('resplandor_phone')?.value || '';
            const email = document.getElementById('resplandor_email')?.value || '';
            const cream = document.getElementById('resplandor_cream')?.value || '';
            const message = document.getElementById('resplandor_message')?.value || '';

            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Enviando...';
            }

            // Prepare FormData
            const formData = new FormData();
            formData.append('action', 'resplandor_send_contact');
            if (window.resplandor_vars && window.resplandor_vars.nonce) {
                formData.append('nonce', window.resplandor_vars.nonce);
            }
            formData.append('name', name);
            formData.append('phone', phone);
            formData.append('email', email);
            formData.append('cream', cream);
            formData.append('message', message);

            const ajaxUrl = (window.resplandor_vars && window.resplandor_vars.ajax_url) 
                ? window.resplandor_vars.ajax_url 
                : '/wp-admin/admin-ajax.php';

            fetch(ajaxUrl, {
                method: 'POST',
                body: formData
            })
            .then(function (res) { return res.json(); })
            .then(function (data) {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;
                }

                if (formStatus) {
                    formStatus.style.display = 'block';
                    if (data.success) {
                        formStatus.className = 'form-status success';
                        formStatus.innerHTML = `<strong>¡Gracias, ${name}!</strong> ${data.data || 'Tu solicitud ha sido recibida con éxito. Nos pondremos en contacto contigo muy pronto.'}`;
                        contactForm.reset();
                        setTimeout(function () {
                            window.closeContactModal();
                        }, 3000);
                    } else {
                        formStatus.className = 'form-status error';
                        formStatus.innerHTML = data.data || 'Ocurrió un error al procesar tu solicitud. Por favor intenta de nuevo.';
                    }
                } else {
                    alert(`¡Gracias, ${name}! Tu solicitud para "${cream}" ha sido enviada con éxito.`);
                    contactForm.reset();
                    window.closeContactModal();
                }
            })
            .catch(function () {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;
                }

                // Friendly fallback message + option to open WhatsApp directly
                if (formStatus) {
                    formStatus.style.display = 'block';
                    formStatus.className = 'form-status success';
                    formStatus.innerHTML = `<strong>¡Gracias, ${name}!</strong> Tu pedido para "${cream}" ha sido registrado.`;
                }

                const waPhone = (window.resplandor_vars && window.resplandor_vars.whatsapp_number) 
                    ? window.resplandor_vars.whatsapp_number.replace(/[^0-9]/g, '') 
                    : '';

                if (waPhone) {
                    const waText = encodeURIComponent(`Hola Resplandor Floral, mi nombre es ${name}. Me interesa la crema: ${cream}. Teléfono: ${phone}. ${message ? 'Mensaje: ' + message : ''}`);
                    window.open(`https://wa.me/${waPhone}?text=${waText}`, '_blank');
                }

                setTimeout(function () {
                    contactForm.reset();
                    window.closeContactModal();
                }, 2500);
            });
        });
    }

    /* ==========================================
       5. Smooth Anchor Scrolling
       ========================================== */
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href === '#' || href === '#contacto') return;

            const targetElement = document.querySelector(href);
            if (targetElement) {
                e.preventDefault();
                const headerHeight = siteHeader ? siteHeader.offsetHeight : 80;
                const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - headerHeight;
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
});
