const html = $('html');
const modalElements = $('.modal');
let previousScrollY;
let processingModalOpening = false;

const applyHtmlNoScrollStyles = () => {
    if (! html.hasClass('modal-open')) {
        previousScrollY = window.scrollY;
        html.css('marginTop', - previousScrollY);
    }
    html.addClass('modal-open');
};

const removeHtmlNoScrollStyles = () => {
    html.css('marginTop', 0);
    html.removeClass('modal-open');
    window.scrollTo(0, previousScrollY);
};

modalElements.on('show.bs.modal', (e) => {
    processingModalOpening = true;
    modalElements.not(e.target).modal('hide');
    applyHtmlNoScrollStyles();
});

modalElements.on('shown.bs.modal', (e) => {
    processingModalOpening = false;
});

modalElements.on('hidden.bs.modal', () => {
    if (! processingModalOpening) {
        removeHtmlNoScrollStyles();
    }
});
