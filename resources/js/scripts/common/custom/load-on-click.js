window.listenToLoadOnClickEvent = (loadOnClickElements) => {
    _.each(loadOnClickElements, (loadOnClickElement) => {
        const $this = $(loadOnClickElement);
        $this.on('click', (e) => {
            setTimeout(() => {
                notify.loading();
            }, 0);
        });
    });
};
const loadOnClickElements = $('.load-on-click');
if (loadOnClickElements.length) {
    listenToLoadOnClickEvent(loadOnClickElements);
}
