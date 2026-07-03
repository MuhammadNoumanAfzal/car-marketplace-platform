import './bootstrap';

const sliders = document.querySelectorAll('[data-slider]');

sliders.forEach((slider) => {
    const backgrounds = slider.querySelectorAll('[data-slide-bg]');
    const panels = slider.querySelectorAll('[data-slide-panel]');
    const dots = slider.querySelectorAll('[data-slide-to]');
    const prev = slider.querySelector('[data-slide-prev]');
    const next = slider.querySelector('[data-slide-next]');
    const intervalDelay = Number(slider.dataset.sliderInterval || 5500);
    let currentIndex = 0;
    let timerId = null;

    const setActiveSlide = (index) => {
        currentIndex = (index + panels.length) % panels.length;

        backgrounds.forEach((background, backgroundIndex) => {
            background.classList.toggle('is-active', backgroundIndex === currentIndex);
        });

        panels.forEach((panel, panelIndex) => {
            panel.classList.toggle('is-active', panelIndex === currentIndex);
        });

        dots.forEach((dot, dotIndex) => {
            dot.classList.toggle('is-active', dotIndex === currentIndex);
        });
    };

    const restartAutoPlay = () => {
        if (timerId) {
            window.clearInterval(timerId);
        }

        timerId = window.setInterval(() => {
            setActiveSlide(currentIndex + 1);
        }, intervalDelay);
    };

    prev?.addEventListener('click', () => {
        setActiveSlide(currentIndex - 1);
        restartAutoPlay();
    });

    next?.addEventListener('click', () => {
        setActiveSlide(currentIndex + 1);
        restartAutoPlay();
    });

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            setActiveSlide(index);
            restartAutoPlay();
        });
    });

    slider.addEventListener('mouseenter', () => {
        if (timerId) {
            window.clearInterval(timerId);
        }
    });

    slider.addEventListener('mouseleave', restartAutoPlay);

    setActiveSlide(0);
    restartAutoPlay();
});

const detailTabs = document.querySelectorAll('[data-detail-tabs]');

detailTabs.forEach((tabBar) => {
    const links = Array.from(tabBar.querySelectorAll('[data-detail-tab-link]'));
    const sections = links
        .map((link) => document.querySelector(link.getAttribute('href')))
        .filter(Boolean);

    if (!links.length || !sections.length) {
        return;
    }

    const setActiveLink = (id) => {
        links.forEach((link) => {
            const isActive = link.getAttribute('href') === `#${id}`;
            link.classList.toggle('is-active', isActive);
        });
    };

    links.forEach((link) => {
        link.addEventListener('click', () => {
            const targetId = link.getAttribute('href').replace('#', '');
            setActiveLink(targetId);
        });
    });

    const observer = new IntersectionObserver(
        (entries) => {
            const visibleEntry = entries
                .filter((entry) => entry.isIntersecting)
                .sort((a, b) => b.intersectionRatio - a.intersectionRatio)[0];

            if (visibleEntry?.target?.id) {
                setActiveLink(visibleEntry.target.id);
            }
        },
        {
            rootMargin: '-25% 0px -55% 0px',
            threshold: [0.2, 0.4, 0.6],
        }
    );

    sections.forEach((section) => observer.observe(section));
});

const carousels = document.querySelectorAll('[data-carousel]');

carousels.forEach((carousel) => {
    const viewport = carousel.querySelector('.testimonial-slider__viewport');
    const track = carousel.querySelector('[data-carousel-track]');
    const slides = carousel.querySelectorAll('[data-carousel-slide]');
    const dots = carousel.querySelectorAll('[data-carousel-dot]');
    const prev = carousel.querySelector('[data-carousel-prev]');
    const next = carousel.querySelector('[data-carousel-next]');
    const intervalDelay = 4500;
    let currentIndex = 0;
    let timerId = null;

    const updateCarousel = (index) => {
        currentIndex = (index + slides.length) % slides.length;
        const slide = slides[currentIndex];

        if (!track || !slide) {
            return;
        }

        const rawOffset = slide.offsetLeft;
        const maxOffset = Math.max(
            0,
            (track.scrollWidth || 0) - (viewport?.clientWidth || 0)
        );
        const offset = Math.min(rawOffset, maxOffset);

        track.style.transform = `translateX(-${offset}px)`;

        dots.forEach((dot, dotIndex) => {
            dot.classList.toggle('is-active', dotIndex === currentIndex);
        });
    };

    const restartAutoPlay = () => {
        if (timerId) {
            window.clearInterval(timerId);
        }

        timerId = window.setInterval(() => {
            updateCarousel(currentIndex + 1);
        }, intervalDelay);
    };

    prev?.addEventListener('click', () => {
        updateCarousel(currentIndex - 1);
        restartAutoPlay();
    });

    next?.addEventListener('click', () => {
        updateCarousel(currentIndex + 1);
        restartAutoPlay();
    });

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            updateCarousel(index);
            restartAutoPlay();
        });
    });

    window.addEventListener('resize', () => updateCarousel(currentIndex));

    updateCarousel(0);
    restartAutoPlay();
});

const revealItems = document.querySelectorAll('[data-reveal]');

if (revealItems.length) {
    const revealObserver = new IntersectionObserver(
        (entries, observer) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }

                const delay = entry.target.dataset.revealDelay || '0';
                entry.target.style.setProperty('--reveal-delay', `${delay}ms`);
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            });
        },
        {
            rootMargin: '0px 0px -12% 0px',
            threshold: 0.12,
        }
    );

    revealItems.forEach((item) => revealObserver.observe(item));
}
