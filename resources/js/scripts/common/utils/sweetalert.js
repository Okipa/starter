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
    timer: 8000
});

notify.loading = (title = app.sweetalert.pleaseWait, message = app.sweetalert.loading) => {
    return swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'info',
        title: message,
        timerProgressBar: true,
        onBeforeOpen: () => {
            swal.showLoading();
        },
    });
};

notify.confirm = (html, title = app.sweetalert.confirmRequest) => {
    return notify.fire({
        title: title,
        html: html,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: app.sweetalert.confirm,
        cancelButtonText: app.sweetalert.cancel
    });
};

console.log(app.swalConfig);

if (app.swalConfig) {
    notify.fire(app.swalConfig);
}
