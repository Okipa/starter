const $kebabCaseElements = $('[data-kebabcase]');

window.triggerKebabCaseElementsDetection = () => {
    $kebabCaseElements.each((key, input) => {
        const $input = $(input);
        $input.on('propertychange change keyup input paste script', () => {
            const kebabCase = $input.val()
                .match(/[A-Z]{2,}(?=[A-Z][a-z]+[0-9]*|\b)|[A-Z]?[a-z]+[0-9]*|[A-Z]|[0-9]+/g)
                .map(x => x.toLowerCase())
                .join('-');
            $input.val(kebabCase);
        });
    });
};

if ($kebabCaseElements.length) {
    triggerKebabCaseElementsDetection();
}
