const $upperCaseElements = $('[data-uppercase]');

window.triggerUpperCaseElementsDetection = () => {
    $upperCaseElements.each((key, input) => {
        const $input = $(input);
        $input.on('propertychange change keyup input paste script', () => {
            const upperCase = $input.val().toUpperCase();
            $input.val(upperCase);
        });
    });
};

if ($upperCaseElements.length) {
    triggerUpperCaseElementsDetection();
}
