const copyToClipboard = (string) => {
    const el = document.createElement('textarea');
    el.value = string;
    document.body.appendChild(el);
    el.select();
    document.execCommand('copy');
    document.body.removeChild(el);
};

$('.clipboard-copy').click(function (e) {
    e.preventDefault();
    const libraryMediaId = $(this).data('libraryMediaId');
    const type = $(this).data('type');
    const locale = $(this).closest('.component-container').find('.component').data('locale');
    let route = app.libraryMedia.clipboardCopy.route;
    route = route.replace('__ID__', libraryMediaId);
    route = route.replace('__TYPE__', type);
    route = route.replace('__LOCALE__', locale || '');
    axios.get(route).then((response) => {
        copyToClipboard(response.data.clipboardContent);
        notify.toast.fire({
            icon: 'success',
            title: response.data.message
        });
    }).catch((error) => {
        console.error(error);
        notify.toast.fire({
            icon: 'error',
            title: error.response.data.message
        });
    });
});
