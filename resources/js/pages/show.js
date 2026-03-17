// ── Hero Swiper ──
document.addEventListener("DOMContentLoaded", function () {
    new Swiper(".propHeroSwiper", {
        loop:
            document.querySelectorAll(".propHeroSwiper .swiper-slide").length >
            1,
        speed: 650,
        autoplay: { delay: 5000, disableOnInteraction: false },
        navigation: {
            nextEl: ".propHeroSwiper .swiper-button-next",
            prevEl: ".propHeroSwiper .swiper-button-prev",
        },
        pagination: {
            el: ".propHeroSwiper .swiper-pagination",
            clickable: true,
        },
    });
});

// ── Modal Gallery ──
const allImages = window.propImages || [];
let modalSwiper = null;

function updateCounter(index, total) {
    document.getElementById("modalCounter").textContent =
        index + 1 + " / " + total;
}

window.openModal = function (startIndex) {
    const wrapper = document.getElementById("modalSwiperWrapper");
    wrapper.innerHTML = allImages
        .map(
            (p, i) =>
                `<div class="swiper-slide"><img src="/storage/${p}" alt="Foto ${i + 1}"></div>`,
        )
        .join("");

    if (modalSwiper) {
        modalSwiper.destroy(true, true);
        modalSwiper = null;
    }

    document.getElementById("imgModal").classList.add("open");
    document.body.style.overflow = "hidden";

    modalSwiper = new Swiper(".modalSwiper", {
        initialSlide: startIndex || 0,
        loop: allImages.length > 1,
        speed: 400,
        keyboard: { enabled: true },
        navigation: {
            nextEl: ".modalSwiper .swiper-button-next",
            prevEl: ".modalSwiper .swiper-button-prev",
        },
        pagination: { el: ".modalSwiper .swiper-pagination", clickable: true },
        on: {
            slideChange() {
                updateCounter(this.realIndex, allImages.length);
            },
            init() {
                updateCounter(this.realIndex, allImages.length);
            },
        },
    });
};

window.closeModal = function () {
    document.getElementById("imgModal").classList.remove("open");
    document.body.style.overflow = "";
};

window.showAll = function () {
    const grid = document.getElementById("galGrid");
    grid.innerHTML = allImages
        .map(
            (p, i) =>
                `<div class="g-item" onclick="openModal(${i})">
            <img src="/storage/${p}" alt="Foto ${i + 1}" loading="lazy">
            <div class="g-ov"><i class="fas fa-expand"></i></div>
        </div>`,
        )
        .join("");
    document.querySelector(".btn-more-gal")?.remove();
};

document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") window.closeModal();
});
