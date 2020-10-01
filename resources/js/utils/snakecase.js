const $snakeCaseElements = $('[data-snakecase]');

window.triggerSnakeCaseElementsDetection = () => {
    $snakeCaseElements.each((key, input) => {
        const $input = $(input);
        $input.on('propertychange change keyup input paste script', () => {
            const snakeCase = $input.val().match(/[A-Z]{2,}(?=[A-Z][a-z]+[0-9]*|\b)|[A-Z]?[a-z]+[0-9]*|[A-Z]|[0-9]+/g)
                .map(x => x.toLowerCase())
                .join('_');
            $input.val(snakeCase);
        });
    });
};

if ($snakeCaseElements.length) {
    triggerSnakeCaseElementsDetection();
}
