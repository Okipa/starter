const $lowercaseElements = $('[data-lowercase]');

window.triggerLowercaseElementsDetection = () => {
    $lowercaseElements.each((key, element) => {
        const $this = $(element);
        $this.on('propertychange change keyup input paste script', () => {
            const lowercase = $this.val().toLowerCase();
            $this.val(lowercase);
        });
    });
};

if ($lowercaseElements.length) {
    triggerLowercaseElementsDetection();
}
