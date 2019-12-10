window.notify = swal.mixin({
    customClass: {
        confirmButton: 'btn btn-outline-primary mx-2',
        cancelButton: 'btn btn-outline-danger mx-2'
    },
    cancelButtonText: app.sweetalert.cancel,
    buttonsStyling: false
});

notify.toast = notify.mixin({
    toast: true,
    position: 'top-end',
    timer: 10000
});

notify.loading = (title = app.sweetalert.loading, message = null) => {
    return swal.fire({
        toast: true,
        position: 'top-end',
        timer: 10000,
        type: 'info',
        title: title,
        html: message,
        timerProgressBar: true,
        onBeforeOpen: () => {
            swal.showLoading();
        },
    });
};

notify.warning = (html, title = app.notifications.title.confirm) => {
    return notify.fire({
        title: title,
        html: html,
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: app.sweetalert.confirm,
        cancelButtonText: app.sweetalert.cancel
    });
};

if (app.swalConfig) {
    notify.fire(app.swalConfig);
}
