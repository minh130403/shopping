import './bootstrap';

document.addEventListener("DOMContentLoaded", () => {
    const navType = performance.getEntriesByType("navigation")[0]?.type;

    if (navType === "back_forward") {
        window.location.reload();
    }
});
