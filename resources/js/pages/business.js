/* STATE */
let activecat = "";
let searchQ = "";

/* FILTER ENGINE */
function escapeRe(s) {
    return s.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
}

// ── Format deskripsi jadi paragraf ──
function formatDesc(text) {
    if (!text) return "<p>-</p>";
    return text
        .split(/\n\s*\n/) // pisah per paragraf (baris kosong)
        .map((para) => para.trim())
        .filter((para) => para.length > 0)
        .map((para) => {
            // cek apakah paragraph ini adalah bullet list
            const lines = para.split("\n");
            const isList = lines.every((l) => /^[-•]\s/.test(l.trim()));
            if (isList) {
                const items = lines
                    .map((l) => `<li>${l.replace(/^[-•]\s/, "").trim()}</li>`)
                    .join("");
                return `<ul>${items}</ul>`;
            }
            // paragraf biasa — ganti newline tunggal jadi <br>
            return `<p>${lines.join("<br>")}</p>`;
        })
        .join("");
}

function runFilter() {
    const items = document.querySelectorAll(".bp-item");
    let visible = 0;
    const q = searchQ.toLowerCase().trim();

    items.forEach((item) => {
        const catMatch = !activecat || item.dataset.cat === activecat;
        const textMatch =
            !q ||
            item.dataset.title.includes(q) ||
            item.dataset.location.includes(q);
        const show = catMatch && textMatch;
        item.classList.toggle("hidden", !show);

        // Highlight match in title
        const titleEl = item.querySelector(".bp-item-title");
        if (titleEl) {
            const raw = titleEl.getAttribute("data-raw") || titleEl.textContent;
            titleEl.setAttribute("data-raw", raw);
            if (q && show && raw.toLowerCase().includes(q)) {
                const re = new RegExp(`(${escapeRe(q)})`, "gi");
                titleEl.innerHTML = raw.replace(re, "<mark>$1</mark>");
            } else {
                titleEl.innerHTML = raw;
            }
        }
        if (show) visible++;
    });

    document.getElementById("bpResultCount").textContent = visible;
    document
        .getElementById("bpEmptyState")
        .classList.toggle("show", visible === 0);
    document
        .getElementById("bpResetAll")
        .classList.toggle("visible", !!(activecat || searchQ));
}

/* SEARCH */
const searchInput = document.getElementById("bpSearch");
const searchClear = document.getElementById("bpSearchClear");

searchInput?.addEventListener("input", function () {
    searchQ = this.value;
    searchClear.classList.toggle("visible", searchQ.length > 0);
    runFilter();
});

window.clearSearch = function () {
    searchInput.value = "";
    searchQ = "";
    searchClear.classList.remove("visible");
    runFilter();
    searchInput.focus();
};

/* CATEGORY DROPDOWN */
window.toggleCatDropdown = function () {
    const btn = document.getElementById("bpCatBtn");
    const panel = document.getElementById("bpCatPanel");
    const isOpen = panel.classList.contains("open");
    if (isOpen) {
        btn.classList.remove("open");
        panel.classList.remove("open");
    } else {
        const rect = btn.getBoundingClientRect();
        panel.style.top = rect.bottom + 8 + "px";
        panel.style.left = "auto";
        panel.style.right = window.innerWidth - rect.right + "px";
        btn.classList.add("open");
        panel.classList.add("open");
    }
};

window.selectCat = function (el) {
    document
        .querySelectorAll(".bp-cat-option")
        .forEach((o) => o.classList.remove("active"));
    el.classList.add("active");
    activecat = el.dataset.cat;
    document.getElementById("bpCatLabel").textContent = el.dataset.label;
    document.getElementById("bpCatCount").textContent = el.dataset.count;
    toggleCatDropdown();
    runFilter();
};

document.addEventListener("click", (e) => {
    const dd = document.getElementById("bpCatDropdown");
    if (dd && !dd.contains(e.target)) {
        document.getElementById("bpCatBtn")?.classList.remove("open");
        document.getElementById("bpCatPanel")?.classList.remove("open");
    }
});

/* RESET ALL */
window.resetAll = function () {
    activecat = "";
    searchQ = "";
    searchInput.value = "";
    searchClear.classList.remove("visible");
    document
        .querySelectorAll(".bp-cat-option")
        .forEach((o) => o.classList.remove("active"));
    document
        .querySelector('.bp-cat-option[data-cat=""]')
        ?.classList.add("active");
    document.getElementById("bpCatLabel").textContent = "Semua Kategori";
    document.getElementById("bpCatCount").textContent =
        document.querySelector('.bp-cat-option[data-cat=""]')?.dataset.count ??
        0;
    runFilter();
};

/* MODAL */
let bpSwiper = null;

window.openBpModal = function (id) {
    const p = window.bpProps?.find((x) => x.id == id);
    if (!p) return;

    const slides = p.images.length
        ? p.images
              .map(
                  (img, i) =>
                      `<div class="swiper-slide"><img src="/storage/${img}" alt="${p.title} ${i + 1}"></div>`,
              )
              .join("")
        : `<div class="swiper-slide"><img src="https://images.unsplash.com/photo-1497366754035-f200968a6e72?w=900&h=400&fit=crop" alt="${p.title}"></div>`;

    document.getElementById("bpSwiperWrapper").innerHTML = slides;

    const avail = p.status === "available";
    const brochureBtn = p.brochure
        ? `<a href="${p.brochure}" class="btn-brochure-m" download><i class="fas fa-file-pdf"></i> E-Brochure</a>`
        : "";

    document.getElementById("bpModalBody").innerHTML = `
        <div class="bp-modal-top">
            <div>
                <h2>${p.title}</h2>
                <div class="bp-modal-loc"><i class="fas fa-map-marker-alt"></i> ${p.location}</div>
            </div>
            <span class="bp-modal-cat">${p.category}</span>
        </div>
        <div class="bp-modal-status ${avail ? "avail" : "sold"}">
            <span class="sdot"></span>${avail ? "Tersedia" : "Sold Out"}
        </div>
        <div class="bp-modal-rule"></div>
        
        <div class="bp-modal-desc">${formatDesc(p.description)}</div>

        
        <div class="bp-modal-actions">
            <a href="https://wa.me/082274226163?text=Saya%20tertarik%20dengan%20${encodeURIComponent(p.title)}"
               target="_blank" class="btn-wa-m">
                <i class="fab fa-whatsapp"></i> Hubungi via WhatsApp
            </a>
            ${brochureBtn}
        </div>`;

    if (bpSwiper) {
        bpSwiper.destroy(true, true);
        bpSwiper = null;
    }

    const total = p.images.length || 1;
    bpSwiper = new Swiper(".bpSwiper", {
        loop: total > 1,
        speed: 420,
        keyboard: { enabled: true },
        navigation: {
            nextEl: ".bpSwiper .swiper-button-next",
            prevEl: ".bpSwiper .swiper-button-prev",
        },
        pagination: { el: ".bpSwiper .swiper-pagination", clickable: true },
        on: {
            init() {
                document.getElementById("bpCounter").textContent =
                    `1 / ${total}`;
            },
            slideChange(s) {
                document.getElementById("bpCounter").textContent =
                    `${s.realIndex + 1} / ${total}`;
            },
        },
    });

    document.getElementById("bpModal").classList.add("open");
    document.body.style.overflow = "hidden";
};

window.closeBpModal = function () {
    document.getElementById("bpModal").classList.remove("open");
    document.body.style.overflow = "";
};

document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") window.closeBpModal();
});
