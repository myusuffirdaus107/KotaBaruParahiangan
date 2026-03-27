const sidebar = document.getElementById("sidebar");
const overlay = document.getElementById("sidebarOverlay");
const toggle = document.getElementById("sidebarToggle");

function openSidebar() {
    sidebar.classList.add("open");
    overlay.classList.add("show");
}
function closeSidebar() {
    sidebar.classList.remove("open");
    overlay.classList.remove("show");
}

toggle?.addEventListener("click", () =>
    sidebar.classList.contains("open") ? closeSidebar() : openSidebar(),
);
overlay?.addEventListener("click", closeSidebar);

document.querySelectorAll(".nav-link-item").forEach((link) => {
    link.addEventListener("click", () => {
        if (window.innerWidth <= 992) closeSidebar();
    });
});
