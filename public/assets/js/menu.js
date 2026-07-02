document.addEventListener("DOMContentLoaded", function () {
    const menuBtn = document.getElementById("mobile-menu-btn");
    const closeBtn = document.getElementById("close-menu-btn");
    const mobileMenu = document.getElementById("mobile-menu");
    const mobileServicesBtn = document.getElementById("mobile-services-btn");
    const mobileServicesList = document.getElementById("mobile-services-list");

    // Open Menu Logic
    menuBtn.addEventListener("click", () => {
        mobileMenu.classList.remove("hidden");
        document.body.style.overflow = "hidden"; // Prevent background scroll
    });

    // Close Menu Logic
    const closeMenu = () => {
        mobileMenu.classList.add("hidden");
        document.body.style.overflow = "auto"; // Restore scroll
    };

    closeBtn.addEventListener("click", closeMenu);

    // Toggle Mobile Services Sub-menu
    mobileServicesBtn.addEventListener("click", (e) => {
        e.preventDefault();
        mobileServicesList.classList.toggle("hidden");
        mobileServicesList.classList.toggle("flex");
        // Rotate the arrow icon
        mobileServicesBtn.querySelector("i").classList.toggle("rotate-180");
    });

    // Close menu when clicking any link
    const links = mobileMenu.querySelectorAll("a");
    links.forEach((link) => {
        link.addEventListener("click", (e) => {
            // Only close if it's not the main Services link toggle
            if (!link.nextElementSibling?.id === "mobile-services-list") {
                closeMenu();
            }
        });
    });
});
