window.triggerEditorElementsDetection = () => {
    const editorElements = $('textarea[data-editor]');
    if (editorElements.length) {
        const EasyMde = require('easymde');
        editorElements.each((key, editor) => {
            const easyMde = new EasyMde({
                element: editor,
                forceSync: true,
                spellChecker: false,
                hideIcons: ['image'],
                showIcons: ['table'],
                status: [
                    'lines',
                    'words',
                    {
                        className: 'characters',
                        defaultValue: (el) => {
                            el.innerHTML = '0';
                        },
                        onUpdate: (el) => {
                            el.innerHTML = easyMde.value().length;
                        }
                    }
                ]
            });
        });
    }
};

triggerEditorElementsDetection();
