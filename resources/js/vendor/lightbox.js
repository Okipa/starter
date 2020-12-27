const lightboxes = document.querySelectorAll('[data-lightbox]');
if (lightboxes.length) {
    const GLightbox = require('glightbox');
    GLightbox({selector: 'data-lightbox'});
}
