$(window).on('load', () => {
    _.each($('.carousel'), (carousel) => {
        const $carousel = $(carousel);
        const sizes = $carousel.find('.carousel-item.active > img').attr('sizes');
        $carousel.find('.carousel-item:not(.active) > img').attr('sizes', sizes);
    });
});
