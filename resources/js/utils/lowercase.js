const $lowerCaseElements = $('[data-lowercase]');

window.triggerLowerCaseElementsDetection = () => {
    $lowerCaseElements.each((key, input) => {
        const $input = $(input);
        $input.on('propertychange change keyup input paste script', () => {
            const lowercase = $this.val().toLowerCase();
            $input.val(lowercase);
        });
    });
};

if ($lowerCaseElements.length) {
    triggerLowerCaseElementsDetection();
}
