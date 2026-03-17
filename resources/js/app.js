document.addEventListener("DOMContentLoaded", function () {
    // ── NAVBAR SCROLL & TOGGLE ──
    const nav = document.getElementById("mainNav");
    if (nav) {
        window.addEventListener("scroll", () => {
            nav.classList.toggle("scrolled", window.scrollY > 20);
        });
    }

    const toggler = document.getElementById("navToggler");
    const navLinks = document.getElementById("navLinks");
    const togglerIcon = document.getElementById("togglerIcon");

    if (toggler) {
        toggler.addEventListener("click", () => {
            const open = navLinks.classList.toggle("open");
            togglerIcon.className = open ? "fas fa-times" : "fas fa-bars";
        });
        navLinks.querySelectorAll("a").forEach((link) => {
            link.addEventListener("click", () => {
                navLinks.classList.remove("open");
                togglerIcon.className = "fas fa-bars";
            });
        });
    }

    // ── WA FLOATING ──
    const popup = document.getElementById("waPopup");
    const waBtn = document.getElementById("waBtn");
    const waClose = document.getElementById("waClose");

    if (popup && waBtn) {
        waBtn.addEventListener("click", () => popup.classList.toggle("open"));
        waClose?.addEventListener("click", () =>
            popup.classList.remove("open"),
        );
        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") popup.classList.remove("open");
        });
    }
});
