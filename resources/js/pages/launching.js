// ── Modal ──
window.openModal = function (card) {
    const m = document.getElementById("lcModal");
    const isActive = card.dataset.status === "active";

    document.getElementById("modalImage").src = card.dataset.image;
    document.getElementById("modalImgTitle").textContent = card.dataset.title;
    document.getElementById("modalDesc").textContent =
        card.dataset.desc || "Tidak ada deskripsi.";
    document.getElementById("modalLocation").textContent =
        card.dataset.location || "-";
    document.getElementById("modalDeveloper").textContent =
        card.dataset.developer || "-";
    document.getElementById("modalDate").textContent = card.dataset.date || "-";
    document.getElementById("modalStatus").textContent =
        card.dataset.statusLabel;

    const pill = document.getElementById("modalPill");
    pill.className = "mi-pill " + (isActive ? "active" : "coming");
    pill.innerHTML = isActive
        ? '<i class="fas fa-check-circle"></i> Tersedia'
        : '<i class="fas fa-hourglass-half"></i> Coming Soon';

    const msg = encodeURIComponent(
        "Halo, saya ingin mengetahui lebih lanjut tentang " +
            card.dataset.title,
    );
    document.getElementById("modalWa").href =
        "https://wa.me/082274226163?text=" + msg;

    m.classList.add("open");
    document.body.style.overflow = "hidden";
};

window.closeModal = function () {
    document.getElementById("lcModal").classList.remove("open");
    document.body.style.overflow = "";
};

window.closeModalOutside = function (e) {
    if (e.target === document.getElementById("lcModal")) window.closeModal();
};

document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") window.closeModal();
});

// ── Filter ──
document.querySelectorAll(".lc-filter-btn").forEach((btn) => {
    btn.addEventListener("click", function () {
        document
            .querySelectorAll(".lc-filter-btn")
            .forEach((b) => b.classList.remove("active"));
        this.classList.add("active");
        const filter = this.dataset.filter;
        document.querySelectorAll(".lc-card").forEach((card) => {
            card.style.display =
                filter === "all" || card.dataset.status === filter
                    ? ""
                    : "none";
        });
    });
});
