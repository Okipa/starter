window.triggerSlugifyElementsDetection = () => {
    const slugifyElements = $('.slugify');
    if (slugifyElements.length) {
        slugifyElements.each((key, element) => {
            const $this = $(element);
            const autofillFrom = $this.data('autofillFrom');
            let manualInterventionRealized = false;
            if (! $this.val()) {
                $(autofillFrom).on('propertychange change keyup input paste', (event) => {
                    if (! manualInterventionRealized) {
                        const slug = $(event.target).val().toLowerCase().replace(/[^a-zA-Z0-9]+/g, '-');
                        $this.val(slug);
                    }
                });
            }
            $(autofillFrom).focusout(() => {
                manualInterventionRealized = true;
            });
            $this.on('propertychange change keyup input paste', (event) => {
                const slug = $(event.target).val().toLowerCase().replace(/[^a-zA-Z0-9]+/g, '-');
                $this.val(slug);
            });
        });
    }
};
triggerSlugifyElementsDetection();
