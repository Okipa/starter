window.triggerInputFileChangeDetection = (fileInputElements) => {
    _.each(fileInputElements, (inputFileElement) => {
        const $this = $(inputFileElement);
        $this.change(() => {
            let fieldVal = $this.val();
            if (fieldVal !== undefined || fieldVal !== '') {
                fieldVal = fieldVal.replace('C:\\fakepath\\', '');
                $this.next('.custom-file-label').text(fieldVal);
            }
        });
    });
};

const fileInputElements = $('input[type=file]');

if (fileInputElements.length) {
    triggerInputFileChangeDetection(fileInputElements);
}
