window.notify = swal.mixin({
    customClass: {
        confirmButton: 'btn btn-outline-primary mx-2',
        cancelButton: 'btn btn-outline-danger mx-2'
    },
    cancelButtonText: app.static.action.cancel,
    buttonsStyling: false
});

notify.toast = notify.mixin({
    toast: true,
    position: 'top-end'
});

notify.loading = (html = app.templates.loading, title = app.notifications.title.loading) => {
    return notify.fire({
        title: title,
        html: html,
        type: 'info',
        showConfirmButton: false,
        showCloseButton: false,
        allowOutsideClick: false
    });
};

notify.warning = (html, title = app.notifications.title.confirm) => {
    return notify.fire({
        title: title,
        html: html,
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: app.static.action.confirm,
        cancelButtonText: app.static.action.cancel
    });
};

if (app.swalConfig) {
    notify.fire(app.swalConfig);
}
