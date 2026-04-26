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
