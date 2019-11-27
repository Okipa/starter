require('clipboard');

console.log('test');

$('.clipboard-copy').click(function(e){
    const libraryMediaId = $(this).data('libraryMediaId');
    const type = $(this).data('type');
    let route = app.libraryMedia.clipboardCopy.route;
    route = route.replace('__ID__', libraryMediaId);
    route = route.replace('__TYPE__', type);
    axios.get(route).then((response) => {
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


//new ClipboardJS('.btn');
//reorganizables($('.table tbody'), 'tr', app.slides.route.reorganize);
