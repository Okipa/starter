// Notifications config
const notify = swal.mixin({
    customClass: {
        confirmButton: 'btn btn-primary mx-2',
        cancelButton: 'btn btn-secondary mx-2'
    },
    buttonsStyling: false,
});

const popin = notify.mixin({
    showConfirmButton: true,
    showCancelButton: false,
    allowOutsideClick: false,
    confirmButtonText: app.sweetalert.confirm,
    cancelButtonText: app.sweetalert.cancel,
});

const toast = notify.mixin({
    toast: true,
    position: 'top-end',
    timer: 10000,
    showConfirmButton: false,
});

// Notifications triggering from session
if (app.swalConfig) {
    notify.fire(app.swalConfig);
}

// Alerts notifications
notify.loading = (html = app.sweetalert.loading, title = app.sweetalert.please_wait, config = {}) => {
    return swal.fire({
        icon: 'info',
        title,
        html,
        showConfirmButton: false,
        showCancelButton: false,
        allowOutsideClick: false,
        timerProgressBar: true,
        onBeforeOpen: () => {
            swal.showLoading();
        },
        ...config
    });
};

notify.info = (html, title, config = {}) => {
    return popin.fire({
        icon: 'info',
        title,
        html,
        ...config
    });
};

notify.question = (html, title, config = {}) => {
    return popin.fire({
        icon: 'question',
        title,
        html,
        ...config
    });
};

notify.confirm = (html, title = app.sweetalert.confirm_request, config = {}) => {
    return popin.fire({
        icon: 'warning',
        title,
        html,
        showCancelButton: true,
        ...config
    });
};

notify.error = (html = app.sweetalert.unexpected, title = app.sweetalert.error, config = {}) => {
    return popin.fire({
        icon: 'error',
        title: title,
        html: html,
        ...config
    });
};

// Toast notifications
notify.toastInfo = (title, html) => {
    return toast.fire({
        icon: 'info',
        title,
        html
    });
};

notify.toastWarning = (title, html) => {
    return toast.fire({
        icon: 'warning',
        title,
        html
    });
};

notify.toastSuccess = (title, html) => {
    return toast.fire({
        icon: 'success',
        title,
        html
    });
};

notify.toastError = (title, html) => {
    return toast.fire({
        icon: 'error',
        title,
        html
    });
};

export default notify;
