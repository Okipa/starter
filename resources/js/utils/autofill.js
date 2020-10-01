const $autofillElements = $('[data-autofill-from]');

window.triggerAutofillElementsDetection = () => {
    $autofillElements.each((key, input) => {
        const $input = $(input);
        const inputLocale = $input.data('locale');
        let $sourceInput = $($input.data('autofillFrom'));
        $sourceInput = $sourceInput.length
            ? $sourceInput // monolingual source input
            : $($input.data('autofillFrom') + '-' + (inputLocale || app.locale)); // multilingual source input
        let manualInterventionRealized = false;
        const alreadyFilled = !! $input.val();
        $sourceInput.on('propertychange change keyup input paste', (event) => {
            if (! manualInterventionRealized && ! alreadyFilled) {
                const slug = $(event.target).val();
                $input.val(slug);
                $input.trigger('script');
            }
        });
        $sourceInput.focusout(() => {
            manualInterventionRealized = true;
        });
        $input.focusout(() => {
            manualInterventionRealized = true;
        });
    });
};

if ($autofillElements.length) {
    triggerAutofillElementsDetection();
}
