const listenToNoClickEvents = (noClickElements) => {
    noClickElements.click((event) => {
        event.preventDefault();
        return false;
    });
};
const noClickElements = $('[data-no-click]');
if(noClickElements.length){
    listenToNoClickEvents(noClickElements);
}
