// animations.js - Enhanced Version

document.addEventListener("DOMContentLoaded", () => {
    gsap.registerPlugin(ScrollTrigger);

    // Performance optimization - reduce lag on mobile
    ScrollTrigger.normalizeScroll(true);

    // Prevent animations from running too frequently
    ScrollTrigger.config({ limitCallbacks: true });

    const animate = (selector, options = {}) => {
        gsap.utils.toArray(selector).forEach((el) => {
            const delay = parseFloat(el.dataset.delay) || options.delay || 0;
            const duration =
                parseFloat(el.dataset.duration) || options.duration || 1.2;
            const ease = el.dataset.ease || options.ease || "power3.out";

            gsap.from(el, {
                ...options,
                duration,
                delay,
                ease,
                scrollTrigger: {
                    trigger: el,
                    start: options.start || "top 85%",
                    once: true, // Only animate once
                    markers: false, // Set to true for debugging
                },
            });
        });
    };

    // ======================
    // SMOOTH ENTRANCE ANIMATIONS
    // ======================

    // Enhanced slide animations with smooth parallax effect
    animate(".slide-left", {
        x: -120,
        opacity: 0,
        ease: "power3.out",
        duration: 1.4,
    });

    animate(".slide-right", {
        x: 120,
        opacity: 0,
        ease: "power3.out",
        duration: 1.4,
    });

    animate(".slide-up", {
        y: 80,
        opacity: 0,
        ease: "power3.out",
        duration: 1.4,
    });

    animate(".slide-down", {
        y: -80,
        opacity: 0,
        ease: "power3.out",
        duration: 1.4,
    });

    // Smooth fade animations
    animate(".fade-in", {
        opacity: 0,
        ease: "power2.out",
        duration: 1.2,
    });

    animate(".fade-up", {
        opacity: 0,
        y: 50,
        ease: "power2.out",
        duration: 1.3,
    });

    animate(".fade-down", {
        opacity: 0,
        y: -50,
        ease: "power2.out",
        duration: 1.3,
    });

    // ======================
    // NEW ADVANCED ANIMATIONS
    // ======================

    // 3D-like scale animations
    animate(".scale-in", {
        scale: 0.7,
        opacity: 0,
        ease: "back.out(1.7)",
        duration: 1.5,
    });

    animate(".scale-up", {
        scale: 0.8,
        y: 60,
        opacity: 0,
        ease: "power3.out",
        duration: 1.4,
    });

    // Rotate animations
    animate(".rotate-in", {
        rotate: -15,
        opacity: 0,
        ease: "power3.out",
        duration: 1.3,
    });

    animate(".rotate-in-slow", {
        rotate: -180,
        opacity: 0,
        ease: "power2.inOut",
        duration: 2,
    });

    // Flip animations
    animate(".flip-in-x", {
        rotateX: 90,
        opacity: 0,
        ease: "power3.out",
        duration: 1.4,
        transformOrigin: "center center",
    });

    animate(".flip-in-y", {
        rotateY: 90,
        opacity: 0,
        ease: "power3.out",
        duration: 1.4,
        transformOrigin: "center center",
    });

    // Blur animations
    animate(".blur-in", {
        opacity: 0,
        filter: "blur(20px)",
        ease: "power2.out",
        duration: 1.5,
    });

    // Bounce animations
    animate(".bounce-in", {
        y: -100,
        opacity: 0,
        ease: "bounce.out",
        duration: 1.6,
    });

    // Elastic animations
    animate(".elastic-in", {
        scale: 0.5,
        opacity: 0,
        ease: "elastic.out(1, 0.5)",
        duration: 1.8,
    });

    // ======================
    // TEXT-SPECIFIC ANIMATIONS
    // ======================

    // Character by character animation
    gsap.utils.toArray(".char-split").forEach((el) => {
        const text = el.textContent;
        el.innerHTML = text
            .split("")
            .map(
                (char) =>
                    `<span class="char">${
                        char === " " ? "&nbsp;" : char
                    }</span>`
            )
            .join("");

        gsap.from(el.querySelectorAll(".char"), {
            y: 40,
            opacity: 0,
            duration: 0.8,
            ease: "power3.out",
            stagger: 0.05,
            scrollTrigger: {
                trigger: el,
                start: "top 90%",
                once: true,
            },
        });
    });

    // Word by word animation
    gsap.utils.toArray(".word-split").forEach((el) => {
        const words = el.textContent.split(" ");
        el.innerHTML = words
            .map((word) => `<span class="word">${word}</span>`)
            .join(" ");

        gsap.from(el.querySelectorAll(".word"), {
            y: 30,
            opacity: 0,
            duration: 0.8,
            ease: "power3.out",
            stagger: 0.2,
            scrollTrigger: {
                trigger: el,
                start: "top 85%",
                once: true,
            },
        });
    });

    // ======================
    // ENHANCED STAGGER ANIMATIONS
    // ======================

    gsap.utils.toArray(".stagger-up").forEach((container) => {
        const staggerDelay = parseFloat(container.dataset.stagger) || 0.15;
        const duration = parseFloat(container.dataset.duration) || 0.9;

        gsap.from(container.children, {
            y: 60,
            opacity: 0,
            scale: 0.95,
            duration,
            ease: "power3.out",
            stagger: {
                amount: staggerDelay,
                from: container.dataset.staggerFrom || "start",
            },
            scrollTrigger: {
                trigger: container,
                start: "top 85%",
                once: true,
            },
        });
    });

    // New grid stagger animation
    gsap.utils.toArray(".stagger-grid").forEach((container) => {
        gsap.from(container.children, {
            y: 40,
            opacity: 0,
            scale: 0.9,
            duration: 0.8,
            ease: "power3.out",
            stagger: {
                grid: "auto",
                amount: 0.6,
                from: "center",
            },
            scrollTrigger: {
                trigger: container,
                start: "top 85%",
                once: true,
            },
        });
    });

    // ======================
    // HERO TIMELINE - ENHANCED
    // ======================

    if (document.querySelector(".hero-title")) {
        const tl = gsap.timeline({
            defaults: { ease: "power3.out" },
        });

        tl.from(".hero-title", {
            x: -100,
            opacity: 0,
            duration: 1.4,
            delay: 0.2,
        })
            .from(
                ".hero-text",
                {
                    y: 40,
                    opacity: 0,
                    duration: 1.2,
                },
                "-=0.5"
            )
            .from(
                ".hero-btn",
                {
                    y: 30,
                    opacity: 0,
                    duration: 1,
                    scale: 0.95,
                },
                "-=0.4"
            )
            .from(
                ".hero-bg",
                {
                    scale: 1.1,
                    opacity: 0,
                    duration: 1.8,
                    ease: "power2.inOut",
                },
                "-=1.2"
            );
    }

    // ======================
    // SMOOTH COUNTER UP
    // ======================

    gsap.utils.toArray(".counter").forEach((el) => {
        let value = parseInt(el.getAttribute("data-target"));
        const duration = parseFloat(el.dataset.duration) || 2.5;

        gsap.fromTo(
            el,
            { innerText: 0 },
            {
                innerText: value,
                duration: duration,
                ease: "power2.out",
                snap: { innerText: 1 },
                scrollTrigger: {
                    trigger: el,
                    start: "top 90%",
                    once: true,
                },
                onUpdate: function () {
                    // Format number with commas
                    const currentValue = Math.floor(
                        this.targets()[0].innerText
                    );
                    this.targets()[0].innerText = currentValue.toLocaleString();
                },
            }
        );
    });

    // ======================
    // HOVER ANIMATIONS
    // ======================

    // Add hover effects to cards
    gsap.utils.toArray(".hover-card").forEach((card) => {
        const hoverTl = gsap.timeline({ paused: true });

        hoverTl
            .to(card, {
                y: -10,
                scale: 1.03,
                duration: 0.3,
                ease: "power2.out",
            })
            .to(
                card,
                {
                    boxShadow: "0 20px 40px rgba(0,0,0,0.15)",
                    duration: 0.3,
                },
                "<"
            );

        card.addEventListener("mouseenter", () => hoverTl.play());
        card.addEventListener("mouseleave", () => hoverTl.reverse());
    });

    // ======================
    // PARALLAX EFFECTS
    // ======================

    // Simple parallax for hero sections
    gsap.utils.toArray(".parallax-bg").forEach((bg) => {
        const depth = parseFloat(bg.dataset.depth) || 0.5;

        gsap.to(bg, {
            y: () => window.innerHeight * depth,
            ease: "none",
            scrollTrigger: {
                trigger: bg.parentElement,
                start: "top top",
                end: "bottom top",
                scrub: 1,
            },
        });
    });

    // ======================
    // REVEAL ANIMATIONS
    // ======================

    // Line reveal effect
    gsap.utils.toArray(".line-reveal").forEach((element) => {
        const line = element.querySelector(".reveal-line");
        if (!line) return;

        gsap.to(line, {
            scaleX: 1,
            duration: 1.5,
            ease: "power3.inOut",
            scrollTrigger: {
                trigger: element,
                start: "top 85%",
                once: true,
            },
        });
    });

    // ======================
    // PROGRESS ANIMATIONS
    // ======================

    // Animate progress bars
    gsap.utils.toArray(".progress-bar").forEach((bar) => {
        const width = bar.dataset.width || "100%";
        const fill = bar.querySelector(".progress-fill");

        if (fill) {
            gsap.to(fill, {
                width: width,
                duration: 2,
                ease: "power2.out",
                scrollTrigger: {
                    trigger: bar,
                    start: "top 90%",
                    once: true,
                },
            });
        }
    });

    // ======================
    // INFINITE ANIMATIONS
    // ======================

    // Subtle floating animation
    gsap.utils.toArray(".float").forEach((el) => {
        gsap.to(el, {
            y: "-=20",
            duration: 3,
            repeat: -1,
            yoyo: true,
            ease: "sine.inOut",
        });
    });

    // Subtle pulse animation
    gsap.utils.toArray(".pulse").forEach((el) => {
        gsap.to(el, {
            scale: 1.05,
            duration: 2,
            repeat: -1,
            yoyo: true,
            ease: "sine.inOut",
        });
    });

    // ======================
    // PAGE TRANSITION
    // ======================

    // Smooth page load animation
    gsap.from("body", {
        opacity: 0,
        duration: 0.8,
        ease: "power2.out",
    });

    // ======================
    // PERFORMANCE OPTIMIZATION
    // ======================

    // Clean up ScrollTriggers on unmount
    window.addEventListener("beforeunload", () => {
        ScrollTrigger.getAll().forEach((trigger) => trigger.kill());
    });

    // Recalculate on resize for responsive design
    let resizeTimer;
    window.addEventListener("resize", () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            ScrollTrigger.refresh();
        }, 250);
    });
});
