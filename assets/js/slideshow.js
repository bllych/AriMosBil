// Improved slideshow script with fade transition, pause on hover, arrows, dots, and accessibility
document.addEventListener('DOMContentLoaded', function() {
    const slideshowContainer = document.querySelector('.slideshow-container');
    const slidesWrapper = document.querySelector('.slides-wrapper');
    const slides = document.querySelectorAll('.slide');
    let currentIndex = 0;
    let autoSlideInterval;
    const autoSlideDelay = 3000; // 3 seconds

    // Create navigation elements
    const prevButton = document.createElement('button');
    prevButton.className = 'slide-nav prev';
    prevButton.innerHTML = '&#10094;';
    prevButton.setAttribute('aria-label', 'Previous slide');

    const nextButton = document.createElement('button');
    nextButton.className = 'slide-nav next';
    nextButton.innerHTML = '&#10095;';
    nextButton.setAttribute('aria-label', 'Next slide');

    const dotsContainer = document.createElement('div');
    dotsContainer.className = 'slide-dots';

    // Add dots
    slides.forEach((_, index) => {
        const dot = document.createElement('button');
        dot.className = 'slide-dot';
        dot.setAttribute('aria-label', `Go to slide ${index + 1}`);
        dot.addEventListener('click', () => goToSlide(index));
        dotsContainer.appendChild(dot);
    });

    // Append navigation elements
    slideshowContainer.appendChild(prevButton);
    slideshowContainer.appendChild(nextButton);
    slideshowContainer.appendChild(dotsContainer);

    // Update dots
    function updateDots() {
        const dots = document.querySelectorAll('.slide-dot');
        dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === currentIndex);
        });
    }

    // Go to specific slide
    function goToSlide(index) {
        currentIndex = index;
        slidesWrapper.style.opacity = '0';
        setTimeout(() => {
            slidesWrapper.style.transform = `translateX(-${currentIndex * 100}%)`;
            slidesWrapper.style.opacity = '1';
        }, 300);
        updateDots();
    }

    // Next slide
    function nextSlide() {
        currentIndex = (currentIndex + 1) % slides.length;
        goToSlide(currentIndex);
    }

    // Previous slide
    function prevSlide() {
        currentIndex = (currentIndex - 1 + slides.length) % slides.length;
        goToSlide(currentIndex);
    }

    // Start auto slide
    function startAutoSlide() {
        autoSlideInterval = setInterval(nextSlide, autoSlideDelay);
    }

    // Stop auto slide
    function stopAutoSlide() {
        clearInterval(autoSlideInterval);
    }

    // Event listeners
    prevButton.addEventListener('click', prevSlide);
    nextButton.addEventListener('click', nextSlide);

    // Pause on hover
    slideshowContainer.addEventListener('mouseenter', stopAutoSlide);
    slideshowContainer.addEventListener('mouseleave', startAutoSlide);

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') {
            prevSlide();
        } else if (e.key === 'ArrowRight') {
            nextSlide();
        }
    });

    // Initialize
    updateDots();
    startAutoSlide();
});
