document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('container');
    const overlayBtn = document.getElementById('overlayBtn');

    overlayBtn.addEventListener('click', () => {
        container.classList.toggle('right-panel-active');
        overlayBtn.classList.remove('btnscaled');
        window.requestAnimationFrame(() => {
            overlayBtn.classList.add('btnscaled');
        });
    });
});