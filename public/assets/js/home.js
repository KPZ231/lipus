// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Mobile navigation toggle
    const navToggle = document.createElement('button');
    navToggle.className = 'nav-toggle';
    navToggle.innerHTML = '☰';
    navToggle.setAttribute('aria-label', 'Toggle navigation menu');
    
    const nav = document.querySelector('nav');
    nav.appendChild(navToggle);
    
    navToggle.addEventListener('click', function() {
        nav.classList.toggle('active');
        const isExpanded = nav.classList.contains('active');
        navToggle.setAttribute('aria-expanded', isExpanded);
    });
    
    // Scroll reveal animation
    const revealElements = document.querySelectorAll('section');
    revealElements.forEach(element => {
        element.classList.add('reveal');
    });
    
    // Function to check if element is in viewport
    function isInViewport(element) {
        const rect = element.getBoundingClientRect();
        return (
            rect.top <= (window.innerHeight || document.documentElement.clientHeight) * 0.8 &&
            rect.bottom >= 0
        );
    }
    
    // Function to handle scroll animations
    function handleScrollAnimations() {
        revealElements.forEach(element => {
            if (isInViewport(element)) {
                element.classList.add('active');
            }
        });
    }
    
    // Back to top button functionality
    const backToTopButton = document.getElementById('back-to-top');
    
    function toggleBackToTopButton() {
        if (window.pageYOffset > 300) {
            backToTopButton.classList.add('visible');
        } else {
            backToTopButton.classList.remove('visible');
        }
    }
    
    // Navigation scroll effect
    function handleNavScroll() {
        if (window.pageYOffset > 50) {
            nav.classList.add('scrolled');
        } else {
            nav.classList.remove('scrolled');
        }
    }
    
    // Initial check for elements in viewport and back to top button
    handleScrollAnimations();
    toggleBackToTopButton();
    handleNavScroll();
    
    // Listen for scroll events
    window.addEventListener('scroll', function() {
        handleScrollAnimations();
        toggleBackToTopButton();
        handleNavScroll();
    });
    
    // Back to top button click handler
    backToTopButton.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    
    // Fish species hover effect
    const fishItems = document.querySelectorAll('#fish-species li');
    fishItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px)';
        });
        
        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                const navHeight = nav.offsetHeight;
                
                window.scrollTo({
                    top: targetElement.offsetTop - navHeight,
                    behavior: 'smooth'
                });
                
                // Update URL without page reload
                history.pushState(null, null, targetId);
            }
        });
    });
    
    // Gallery image handling
    const galleryImages = document.querySelectorAll('.gallery-image');
    galleryImages.forEach((img) => {
        // Verify image source
        if (!img.src || img.src === 'undefined' || img.src.includes('undefined')) {
            console.error('Invalid image source:', img.src);
            img.src = '/assets/images/placeholder.jpg';
        }
        
        // Add loading animation
        img.addEventListener('load', function() {
            this.classList.add('loaded');
        });
        
        img.addEventListener('error', function() {
            console.error('Failed to load image:', this.src);
            this.src = '/assets/images/placeholder.jpg';
        });
    });
    
    // Add accessibility features
    const focusableElements = document.querySelectorAll('a, button, input, select, textarea, [tabindex]:not([tabindex="-1"])');
    focusableElements.forEach(el => {
        el.addEventListener('focus', function() {
            this.classList.add('focused');
        });
        
        el.addEventListener('blur', function() {
            this.classList.remove('focused');
        });
    });
    
    // Newsletter form submission
    const newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const emailInput = this.querySelector('input[type="email"]');
            
            if (emailInput.value) {
                // Here you would typically send this to your backend
                alert('Dziękujemy za zapisanie się do newslettera!');
                emailInput.value = '';
            }
        });
    }
    
    // Add parallax effect to header
    window.addEventListener('scroll', function() {
        const header = document.querySelector('header');
        const scrollPosition = window.pageYOffset;
        
        // Move the background slightly as user scrolls
        if (header) {
            header.style.backgroundPosition = `center ${scrollPosition * 0.4}px`;
        }
    });
});
