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

// ── CONTACT FORM → WA ──
document
    .getElementById("contactForm")
    ?.addEventListener("submit", function (e) {
        e.preventDefault();
        const n = encodeURIComponent(document.getElementById("name").value);
        const p = encodeURIComponent(document.getElementById("phone").value);
        const m = encodeURIComponent(document.getElementById("message").value);
        window.open(
            `https://wa.me/082274226163?text=Halo, nama saya ${n}, nomor ${p}. ${m}`,
            "_blank",
        );
    });

// ── Fix WA button di halaman home ──
document.addEventListener("DOMContentLoaded", function () {
    const waBtn = document.getElementById("waBtn");
    const waPopup = document.getElementById("waPopup");
    const waClose = document.getElementById("waClose");

    if (waBtn && waPopup) {
        waBtn.style.cssText +=
            ";z-index:99999!important;pointer-events:all!important;position:fixed!important;";
        waPopup.style.cssText +=
            ";z-index:99998!important;pointer-events:all!important;";

        waBtn.onclick = function (e) {
            e.stopPropagation();
            waPopup.classList.toggle("open");
        };
        if (waClose) {
            waClose.onclick = function (e) {
                e.stopPropagation();
                waPopup.classList.remove("open");
            };
        }
    }
});

// ── WA FLOATING ──
const popup = document.getElementById("waPopup");
document
    .getElementById("waBtn")
    ?.addEventListener("click", () => popup.classList.toggle("open"));
document
    .getElementById("waClose")
    ?.addEventListener("click", () => popup.classList.remove("open"));
document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") popup?.classList.remove("open");
});
