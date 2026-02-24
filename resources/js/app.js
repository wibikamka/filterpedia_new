import "./bootstrap";
import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.data("slider", (slidesCount = 3, interval = 3000) => ({
    active: 0,
    slidesCount,
    interval,
    timer: null,

    start() {
        this.stop(); // pastikan tidak double timer
        this.timer = setInterval(() => {
            this.next();
        }, this.interval);
    },

    stop() {
        if (this.timer) clearInterval(this.timer);
        this.timer = null;
    },

    next() {
        this.active = (this.active + 1) % this.slidesCount;
    },

    prev() {
        this.active = (this.active - 1 + this.slidesCount) % this.slidesCount;
    },
}));

Alpine.start();
