import { initFlowbite } from "flowbite";
import "./bootstrap";
import "flowbite";

document.addEventListener("livewire:navigated", () => {
    if (typeof initFlowbite === "function") {
        initFlowbite();
        const alert = document.getElementById("alert");
        if (alert) {
            setTimeout(() => {
                alert.classList.add("opacity-0");
                setTimeout(() => alert.remove(), 500);
            }, 3000);
        }
    }
});
document.addEventListener("upload-tugas", function (event) {
    const kodeTugas = event.detail.data;
    console.log("Open modal, kode tugas:", kodeTugas);
    const modal = document.getElementById("modal-tugas");
    if (!modal) return;
    if (!window.__lastTambahMkOpen) window.__lastTambahMkOpen = 0;
    const now = Date.now();
    if (now - window.__lastTambahMkOpen < 500) {
        console.debug("Ignored duplicate open-modal-tugas event");
        return;
    }
    window.__lastTambahMkOpen = now;
    if (modal.classList.contains("hidden")) {
        modal.classList.remove("hidden");
    }
    // // logika untuk memunculkan modal
    // const modal = document.getElementById("modal-tugas");
    // modal.classList.remove("hidden");
});
document.addEventListener("close-modal-tugas", function (event) {
    const kodeTugas = event.detail.data;
    console.log("close modal, kode tugas:", kodeTugas);
    const modal = document.getElementById("modal-tugas");
    if (modal) modal.classList.add("hidden");
});
document.addEventListener("livewire:load", () => {
    Livewire.hook("message.processed", (message, component) => {
        initFlowbite();
    });
});

window.addEventListener("open-tambah-mk", () => {
    const modal = document.getElementById("tambah-mk");
    if (!modal) return;
    if (!window.__lastTambahMkOpen) window.__lastTambahMkOpen = 0;
    const now = Date.now();
    if (now - window.__lastTambahMkOpen < 500) {
        console.debug("Ignored duplicate open-tambah-mk event");
        return;
    }
    window.__lastTambahMkOpen = now;
    if (modal.classList.contains("hidden")) {
        modal.classList.remove("hidden");
    }
});
window.addEventListener("close-tambah-mk", () => {
    const modal = document.getElementById("tambah-mk");
    if (modal) modal.classList.add("hidden");
});
document.addEventListener("open-modal-materi", function (event) {
    const modal = document.getElementById("modal-materi");
    if (!modal) return;
    if (!window.__lastTambahMateriOpen) window.__lastTambahMateriOpen = 0;
    const now = Date.now();
    if (now - window.__lastTambahMateriOpen < 500) {
        console.debug("Ignored duplicate open-tambah-Materi event");
        return;
    }
    window.__lastTambahMateriOpen = now;
    if (modal.classList.contains("hidden")) {
        modal.classList.remove("hidden");
    }
});
window.addEventListener("close-modal-materi", () => {
    const modal = document.getElementById("modal-materi");
    if (modal) modal.classList.add("hidden");
});
document.addEventListener("open-modal-tugas", function (event) {
    const modal = document.getElementById("modal-tugas");
    if (!modal) return;
    if (!window.__lastTambahtugasOpen) window.__lastTambahtugasOpen = 0;
    const now = Date.now();
    if (now - window.__lastTambahtugasOpen < 500) {
        console.debug("Ignored duplicate open-tambah-tugas event");
        return;
    }
    window.__lastTambahtugasOpen = now;
    if (modal.classList.contains("hidden")) {
        modal.classList.remove("hidden");
    }
});
window.addEventListener("close-modal-tugas", () => {
    const modal = document.getElementById("modal-tugas");
    if (modal) modal.classList.add("hidden");
});
window.addEventListener("open-generate-token", () => {
    const modal = document.getElementById("modal-token");
    if (!modal) return;
    if (!window.__lastTambahMkOpen) window.__lastTambahMkOpen = 0;
    const now = Date.now();
    if (now - window.__lastTambahMkOpen < 500) {
        console.debug("Ignored duplicate open-generate-token event");
        return;
    }
    window.__lastTambahMkOpen = now;
    if (modal.classList.contains("hidden")) {
        modal.classList.remove("hidden");
    }
});
window.addEventListener("close-modal-token", () => {
    const modal = document.getElementById("modal-token");
    if (modal) modal.classList.add("hidden");
});
document.addEventListener("livewire:initialized", () => {
    Livewire.on("close-dropdown", ({ id }) => {
        const dropdown = document.getElementById(id);
        if (dropdown) {
            dropdown.classList.add("hidden"); // sembunyikan dropdown
        }
    });
});
