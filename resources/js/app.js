import "./bootstrap";
import Alpine from "alpinejs";

window.Alpine = Alpine;

// Function untuk slider dengan parameter dinamis
Alpine.data("slider", (total = 5, autoplaySpeed = 4000) => ({
    active: 0,
    total: total,
    interval: null,

    start() {
        this.interval = setInterval(() => {
            this.next();
        }, autoplaySpeed);
    },

    next() {
        this.active = (this.active + 1) % this.total;
    },

    prev() {
        this.active = this.active === 0 ? this.total - 1 : this.active - 1;
    },

    // Cleanup ketika component di-destroy
    destroy() {
        if (this.interval) {
            clearInterval(this.interval);
        }
    },
}));

// Opsional: tetap buat carousel juga jika ada yang pakai
Alpine.data("carousel", () => ({
    active: 0,
    total: 5,
    interval: null,

    start() {
        this.interval = setInterval(() => {
            this.next();
        }, 4000);
    },

    next() {
        this.active = (this.active + 1) % this.total;
    },

    prev() {
        this.active = this.active === 0 ? this.total - 1 : this.active - 1;
    },
}));

Alpine.start();
