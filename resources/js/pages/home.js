// ── HERO SWIPER ──
new Swiper(".hero-swiper", {
    loop: true,
    autoplay: { delay: 5500, disableOnInteraction: false },
    pagination: { el: ".swiper-pagination", clickable: true },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    effect: "fade",
    fadeEffect: { crossFade: true },
});

// ── WA FLOATING ──
document.addEventListener("DOMContentLoaded", function () {
    const waBtn = document.getElementById("waBtn");
    const waPopup = document.getElementById("waPopup");
    const waClose = document.getElementById("waClose");

    if (waBtn && waPopup) {
        waBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            waPopup.classList.toggle("open");
        });
        waClose?.addEventListener("click", (e) => {
            e.stopPropagation();
            waPopup.classList.remove("open");
        });
        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") waPopup.classList.remove("open");
        });
    }
});
