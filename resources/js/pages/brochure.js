// ── Filter tabs ──
document.querySelectorAll(".br-ftab").forEach((btn) => {
    btn.addEventListener("click", function () {
        document
            .querySelectorAll(".br-ftab")
            .forEach((b) => b.classList.remove("active"));
        this.classList.add("active");
        const cat = this.dataset.cat;
        document.querySelectorAll(".br-card").forEach((card) => {
            card.style.display = !cat || card.dataset.cat === cat ? "" : "none";
        });
    });
});
