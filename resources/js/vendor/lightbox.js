// Individual lightbox
_.each(document.querySelectorAll('[data-lightbox]'), (item) => {
    item.addEventListener('click', function (e) {
        e.preventDefault();
        const lightbox = GLightbox({
            elements: [{href: this.getAttribute('href')}],
            zoomable: false
        });
        lightbox.open();
    });
});
// Gallery
GLightbox({
    selector: '[data-gallery]',
    zoomable: false
});
