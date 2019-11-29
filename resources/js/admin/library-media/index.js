copyToClipboard = (string) => {
    const el = document.createElement('textarea');
    el.value = string;
    document.body.appendChild(el);
    el.select();
    document.execCommand('copy');
    document.body.removeChild(el);
};

$('.clipboard-copy').click(function (e) {
    const libraryMediaId = $(this).data('libraryMediaId');
    const type = $(this).data('type');
    let route = app.libraryMedia.clipboardCopy.route;
    route = route.replace('__ID__', libraryMediaId);
    route = route.replace('__TYPE__', type);
    axios.get(route).then((response) => {
        copyToClipboard(response.data.clipboardContent);
        notify.toast.fire({
            type: 'success',
            title: response.data.message
        });
    }).catch((error) => {
        console.error(error);
        notify.toast.fire({
            type: 'error',
            title: error.response.data.message
        });
    });
});
