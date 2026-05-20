/* =====================================================
   RisingStarChows - JavaScript
   Animations, Interactions & Magic
   ===================================================== */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize AOS Animation Library
    AOS.init({
        duration: 800,
        easing: 'ease-out-cubic',
        once: true,
        offset: 100,
        disable: 'mobile'
    });

    // =====================================================
    // Navbar Scroll Effect
    // =====================================================
    const navbar = document.querySelector('.navbar');
    const heroSection = document.querySelector('.hero-section');

    function handleNavbarScroll() {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }

    window.addEventListener('scroll', handleNavbarScroll);
    handleNavbarScroll(); // Check on load

    // =====================================================
    // Active Navigation Link on Scroll
    // =====================================================
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link');

    function highlightNavOnScroll() {
        const scrollY = window.pageYOffset;

        sections.forEach(section => {
            const sectionHeight = section.offsetHeight;
            const sectionTop = section.offsetTop - 100;
            const sectionId = section.getAttribute('id');

            if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === '#' + sectionId) {
                        link.classList.add('active');
                    }
                });
            }
        });
    }

    window.addEventListener('scroll', highlightNavOnScroll);

    // =====================================================
    // Smooth Scrolling for Navigation Links
    // =====================================================
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));

            if (target) {
                const headerOffset = 80;
                const elementPosition = target.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });

                // Close mobile menu if open
                const navbarCollapse = document.querySelector('.navbar-collapse');
                if (navbarCollapse.classList.contains('show')) {
                    const bsCollapse = new bootstrap.Collapse(navbarCollapse);
                    bsCollapse.hide();
                }
            }
        });
    });

    // =====================================================
    // Back to Top Button
    // =====================================================
    const backToTop = document.getElementById('backToTop');

    function toggleBackToTop() {
        if (window.scrollY > 500) {
            backToTop.classList.add('visible');
        } else {
            backToTop.classList.remove('visible');
        }
    }

    window.addEventListener('scroll', toggleBackToTop);

    // =====================================================
    // Counter Animation for Stats
    // =====================================================
    function animateCounter(element, target, duration = 2000) {
        let start = 0;
        const increment = target / (duration / 16);

        function updateCounter() {
            start += increment;
            if (start < target) {
                element.textContent = Math.floor(start) + '+';
                requestAnimationFrame(updateCounter);
            } else {
                element.textContent = target + '+';
            }
        }

        updateCounter();
    }

    // Intersection Observer for counter animation
    const statNumbers = document.querySelectorAll('.stat-box h3, .achievement-card h3');
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
                entry.target.classList.add('counted');
                const targetNumber = parseInt(entry.target.textContent);
                if (!isNaN(targetNumber)) {
                    animateCounter(entry.target, targetNumber);
                }
            }
        });
    }, { threshold: 0.5 });

    statNumbers.forEach(stat => counterObserver.observe(stat));

    // =====================================================
    // Carousel Enhanced Animations
    // =====================================================
    const heroCarousel = document.getElementById('heroCarousel');

    if (heroCarousel) {
        heroCarousel.addEventListener('slide.bs.carousel', function(e) {
            const activeCaption = e.relatedTarget.querySelector('.carousel-caption');
            const elements = activeCaption.querySelectorAll('.animate-title, .animate-subtitle, .animate-btn');

            elements.forEach(el => {
                el.style.opacity = '0';
                el.style.animation = 'none';
            });
        });

        heroCarousel.addEventListener('slid.bs.carousel', function(e) {
            const activeCaption = e.relatedTarget.querySelector('.carousel-caption');
            const title = activeCaption.querySelector('.animate-title');
            const subtitle = activeCaption.querySelector('.animate-subtitle');
            const btn = activeCaption.querySelector('.animate-btn');

            if (title) {
                title.style.animation = 'fadeInUp 1s ease-out forwards';
            }
            if (subtitle) {
                subtitle.style.animation = 'fadeInUp 1s ease-out 0.3s forwards';
            }
            if (btn) {
                btn.style.animation = 'fadeInUp 1s ease-out 0.6s forwards';
            }
        });
    }

    // =====================================================
    // Parallax Effect for Hero Section
    // =====================================================
    function parallaxEffect() {
        const scrolled = window.pageYOffset;
        const heroImages = document.querySelectorAll('.carousel-item img');

        heroImages.forEach(img => {
            img.style.transform = `scale(1.1) translateY(${scrolled * 0.3}px)`;
        });
    }

    window.addEventListener('scroll', () => {
        requestAnimationFrame(parallaxEffect);
    });

    // =====================================================
    // Puppy Reservation Form Handler
    // =====================================================
    // COMMENTED OUT: Old form handler for previous reservation form structure
    // The new reservation form submits directly to Laravel backend
    // and uses SweetAlert for notifications (handled in blade template)
    /*
    const reservationForm = document.querySelector('.puppy-reservation-form');

    if (reservationForm) {
        reservationForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Get form values
            const name = document.getElementById('reservationName').value;
            const email = document.getElementById('reservationEmail').value;
            const phone = document.getElementById('reservationPhone').value;
            const puppyChoice = document.getElementById('puppyChoice').value;
            const dogExperience = document.getElementById('dogExperience').value;
            const homeType = document.getElementById('homeType').value;
            const agreementCheck = document.getElementById('agreementCheck').checked;

            // Validation
            if (!name || !email || !phone || !puppyChoice || !dogExperience || !homeType) {
                showNotification('Please fill in all required fields', 'error');
                return;
            }

            if (!agreementCheck) {
                showNotification('Please accept the terms and conditions', 'error');
                return;
            }

            // Simulate form submission
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;

            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Processing...';
            submitBtn.disabled = true;

            // Simulate API call
            setTimeout(() => {
                submitBtn.innerHTML = '<i class="bi bi-check-circle-fill me-2"></i>Reservation Submitted!';
                submitBtn.classList.remove('btn-primary');
                submitBtn.classList.add('btn-success');

                // Reset form
                setTimeout(() => {
                    this.reset();
                    submitBtn.innerHTML = originalText;
                    submitBtn.classList.remove('btn-success');
                    submitBtn.classList.add('btn-primary');
                    submitBtn.disabled = false;
                    showNotification(`Thank you ${name}! Your reservation request for ${puppyChoice} has been submitted. We'll contact you soon!`, 'success');
                }, 2000);
            }, 2000);
        });
    }
    */

    // Contact form submits directly to the backend (see routes/web.php contact.submit)

    // =====================================================
    // Notification System
    // =====================================================
    function showNotification(message, type = 'info') {
        // Remove existing notifications
        const existingNotification = document.querySelector('.custom-notification');
        if (existingNotification) {
            existingNotification.remove();
        }

        // Create notification element
        const notification = document.createElement('div');
        notification.className = `custom-notification ${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <i class="bi ${type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-circle-fill'}"></i>
                <span>${message}</span>
            </div>
        `;

        // Add styles
        notification.style.cssText = `
            position: fixed;
            top: 100px;
            right: 20px;
            padding: 1rem 1.5rem;
            background: ${type === 'success' ? '#198754' : '#dc3545'};
            color: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            z-index: 9999;
            animation: slideInRight 0.5s ease-out;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        `;

        // Add animation keyframes
        if (!document.querySelector('#notification-styles')) {
            const style = document.createElement('style');
            style.id = 'notification-styles';
            style.textContent = `
                @keyframes slideInRight {
                    from {
                        transform: translateX(100%);
                        opacity: 0;
                    }
                    to {
                        transform: translateX(0);
                        opacity: 1;
                    }
                }
                @keyframes slideOutRight {
                    from {
                        transform: translateX(0);
                        opacity: 1;
                    }
                    to {
                        transform: translateX(100%);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        }

        document.body.appendChild(notification);

        // Remove after 4 seconds
        setTimeout(() => {
            notification.style.animation = 'slideOutRight 0.5s ease-out forwards';
            setTimeout(() => notification.remove(), 500);
        }, 4000);
    }

    // =====================================================
    // Mouse Trail Effect (Magical Sparkles)
    // =====================================================
    function createSparkle(x, y) {
        const sparkle = document.createElement('div');
        sparkle.className = 'sparkle';
        sparkle.style.cssText = `
            position: fixed;
            pointer-events: none;
            width: 8px;
            height: 8px;
            background: radial-gradient(circle, #c41e3a, transparent);
            border-radius: 50%;
            left: ${x}px;
            top: ${y}px;
            animation: sparkleAnimation 1s ease-out forwards;
            z-index: 9999;
        `;

        // Add sparkle animation if not exists
        if (!document.querySelector('#sparkle-styles')) {
            const style = document.createElement('style');
            style.id = 'sparkle-styles';
            style.textContent = `
                @keyframes sparkleAnimation {
                    0% {
                        transform: scale(1);
                        opacity: 1;
                    }
                    100% {
                        transform: scale(0) translateY(-50px);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        }

        document.body.appendChild(sparkle);
        setTimeout(() => sparkle.remove(), 1000);
    }

    // Throttle mouse move for performance
    let lastSparkle = 0;
    document.addEventListener('mousemove', (e) => {
        const now = Date.now();
        if (now - lastSparkle > 50) {
            if (Math.random() > 0.7) { // Only 30% chance to create sparkle
                createSparkle(e.clientX, e.clientY);
            }
            lastSparkle = now;
        }
    });

    // =====================================================
    // Dog Cards Tilt Effect
    // =====================================================
    const dogCards = document.querySelectorAll('.dog-card');

    dogCards.forEach(card => {
        card.addEventListener('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            const rotateX = (y - centerY) / 10;
            const rotateY = (centerX - x) / 10;

            this.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-10px)`;
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateY(0)';
        });
    });

    // =====================================================
    // Typing Effect for Hero Title (Optional Enhancement)
    // =====================================================
    function typeWriter(element, text, speed = 100) {
        let i = 0;
        element.textContent = '';

        function type() {
            if (i < text.length) {
                element.textContent += text.charAt(i);
                i++;
                setTimeout(type, speed);
            }
        }

        type();
    }

    // =====================================================
    // Preloader (Optional)
    // =====================================================
    window.addEventListener('load', function() {
        const loader = document.querySelector('.page-loader');
        if (loader) {
            setTimeout(() => {
                loader.classList.add('hidden');
            }, 500);
        }
    });

    // =====================================================
    // Intersection Observer for Fade-in Elements
    // =====================================================
    const fadeElements = document.querySelectorAll('.fade-in-element');

    const fadeObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    fadeElements.forEach(el => fadeObserver.observe(el));

    // =====================================================
    // Console Easter Egg
    // =====================================================
    console.log('%c🐕 RisingStarChows 🐕', 'font-size: 24px; font-weight: bold; color: #c41e3a;');
    console.log('%cWhere Champions Are Born & Raised', 'font-size: 14px; color: #d4af37;');
});

// =====================================================
// Open Reservation Form with Pre-selected Puppy
// =====================================================
function openReservationForm(puppyName) {
    // Find the reservation form section
    const reservationSection = document.querySelector('.reservation-form-container');

    if (reservationSection) {
        // Scroll to the form with smooth animation
        const headerOffset = 100;
        const elementPosition = reservationSection.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

        window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth'
        });

        // Pre-select the puppy in the dropdown after a short delay
        setTimeout(() => {
            const puppySelect = document.getElementById('puppyChoice');
            if (puppySelect) {
                // Find and select the option that matches the puppy name
                for (let option of puppySelect.options) {
                    if (option.value === puppyName) {
                        puppySelect.value = puppyName;

                        // Add a highlight animation to the form
                        reservationSection.style.animation = 'pulse-highlight 1s ease-out';
                        setTimeout(() => {
                            reservationSection.style.animation = '';
                        }, 1000);

                        break;
                    }
                }
            }
        }, 800);
    }
}

// Add pulse highlight animation
const style = document.createElement('style');
style.textContent = `
    @keyframes pulse-highlight {
        0%, 100% {
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
        }
        50% {
            box-shadow: 0 20px 60px rgba(196, 30, 58, 0.6);
            transform: scale(1.01);
        }
    }
`;
document.head.appendChild(style);
