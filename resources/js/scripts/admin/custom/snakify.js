const $snakifyElements = $('[data-snakify]');

window.triggerSnakifyElementsDetection = () => {
    $snakifyElements.each((key, element) => {
        const $this = $(element);
        $this.on('propertychange change keyup input paste script', (event) => {
            const slug = $(event.target).val().toLowerCase().replace(/[^a-zA-Z0-9]+/g, '_');
            $this.val(slug);
        });
    });
};

if ($snakifyElements.length) {
    triggerSnakifyElementsDetection();
}
