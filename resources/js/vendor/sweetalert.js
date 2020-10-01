window.notify = swal.mixin({
    customClass: {
        confirmButton: 'btn btn-primary mx-2',
        cancelButton: 'btn btn-danger mx-2'
    },
    cancelButtonText: app.sweetalert.cancel,
    buttonsStyling: false
});

notify.toast = notify.mixin({
    toast: true,
    position: 'top-end',
    timer: 8000
});

notify.toastSuccess = (title, html) => {
    return notify.toast.fire({
        icon: 'success',
        title,
        html
    });
};

notify.toastError = (title, html) => {
    return notify.toast.fire({
        icon: 'error',
        title,
        html
    });
};

notify.toastInfo = (title, html) => {
    return notify.toast.fire({
        icon: 'info',
        title,
        html
    });
};

notify.info = (html, title, config = {}) => {
    return notify.fire({
        icon: 'info',
        title,
        html,
        allowOutsideClick: false,
        ...config
    });
};

notify.question = (html, title, config = {}) => {
    return notify.fire({
        icon: 'question',
        title,
        html,
        allowOutsideClick: false,
        ...config
    });
};

notify.loading = (html = app.sweetalert.loading, title = app.sweetalert.please_wait, config = {}) => {
    return swal.fire({
        icon: 'info',
        title,
        html,
        allowOutsideClick: false,
        showConfirmButton: false,
        timerProgressBar: true,
        onBeforeOpen: () => {
            swal.showLoading();
        },
        ...config
    });
};

notify.confirm = (html, title = app.sweetalert.confirm_request, config = {}) => {
    return notify.fire({
        icon: 'warning',
        title,
        html,
        allowOutsideClick: false,
        showCancelButton: true,
        confirmButtonText: app.sweetalert.confirm,
        cancelButtonText: app.sweetalert.cancel,
        ...config
    });
};

notify.error = (html = app.sweetalert.unexpected, title = app.sweetalert.error, config = {}) => {
    return notify.fire({
        icon: 'error',
        title: title,
        html: html,
        allowOutsideClick: false,
        ...config
    });
};

if (app.swalConfig) {
    notify.fire(app.swalConfig);
}
