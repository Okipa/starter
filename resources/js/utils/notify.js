// Configuration
const notify = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success mx-2',
        cancelButton: 'btn btn-secondary mx-2'
    },
    buttonsStyling: false
});
const popin = notify.mixin({
    showCloseButton: true,
    showConfirmButton: true,
    showCancelButton: false,
    allowOutsideClick: false,
    confirmButtonText: app.notify.confirm,
    cancelButtonText: app.notify.cancel
});
const toast = notify.mixin({
    toast: true,
    position: 'top-end',
    timer: 8000,
    showConfirmButton: false,
    showCloseButton: true
});

// Pop-in
notify.success = (html, title = app.notify.success, config = {}) => {
    return popin.fire({icon: 'success', title, html, ...config});
};
notify.error = (html = app.notify.unexpected, title = app.notify.error, config = {}) => {
    return popin.fire({icon: 'error', title, html, ...config});
};
notify.info = (html, title, config = {}) => {
    return popin.fire({icon: 'info', title, html, ...config});
};
notify.question = (html, title, config = {}) => {
    return popin.fire({icon: 'question', title, html, ...config});
};
notify.warning = (html, title, config = {}) => {
    return popin.fire({icon: 'warning', title, html, ...config});
};
notify.loading = (html = app.notify.loading, title = app.notify.please_wait, config = {}) => {
    return Swal.fire({
        icon: 'info',
        title,
        html,
        showConfirmButton: false,
        showCancelButton: false,
        allowOutsideClick: false,
        timerProgressBar: true,
        willOpen: () => Swal.showLoading(),
        ...config
    });
};
notify.confirm = (html, title = app.notify.confirm_request, config = {}) => {
    return popin.fire({
        icon: 'warning',
        title,
        html,
        showCancelButton: true,
        ...config
    });
};

// Firing from session
if(app.session_notify_config) {
    notify.fire(app.session_notify_config);
}

// Toast
notify.toastSuccess = (title, html, config) => {
    return toast.fire({icon: 'success', title, html, ...config});
};
notify.toastError = (title, html, config) => {
    return toast.fire({icon: 'error', title, html, ...config});
};
notify.toastInfo = (title, html, config) => {
    return toast.fire({icon: 'info', title, html, ...config});
};
notify.toastQuestion = (title, html, config) => {
    return toast.fire({icon: 'question', title, html, ...config});
};
notify.toastWarning = (title, html, config) => {
    return toast.fire({icon: 'warning', title, html, ...config});
};
notify.toastInvalid = (title = app.notify.invalid, html, config) => {
    return toast.fire({icon: 'error', title, html, ...config});
};

// Events handling
const formatArgumentsFromEvent = (event) => {
    return {
        ...event.detail,
        ...{
            willOpen: () => event.detail.willOpen ? setTimeout(event.detail.willOpen, 0) : null,
            didOpen: () => event.detail.didOpen ? setTimeout(event.detail.didOpen, 0) : null,
            didRender: () => event.detail.didRender ? setTimeout(event.detail.didRender, 0) : null,
            willClose: () => event.detail.willClose ? setTimeout(event.detail.willClose, 0) : null,
            didClose: () => event.detail.didClose ? setTimeout(event.detail.didClose, 0) : null,
            didDestroy: () => event.detail.didDestroy ? setTimeout(event.detail.didDestroy, 0) : null
        }
    };
};
window.addEventListener('popin', event => {
    return popin.fire(formatArgumentsFromEvent(event));
});
window.addEventListener('popin:success', event => {
    return notify.success(event.detail.html, event.detail.title, event.detail.config);
});
window.addEventListener('popin:error', event => {
    return notify.error(event.detail.html, event.detail.title, event.detail.config);
});
window.addEventListener('popin:info', event => {
    return notify.info(event.detail.html, event.detail.title, event.detail.config);
});
window.addEventListener('popin:question', event => {
    return notify.question(event.detail.html, event.detail.title, event.detail.config);
});
window.addEventListener('popin:loading', event => {
    return notify.loading(event.detail.html, event.detail.title, event.detail.config);
});
window.addEventListener('popin:confirm', event => {
    return notify.loading(event.detail.html, event.detail.title, event.detail.config);
});
window.addEventListener('toast', event => {
    return toast.fire(formatArgumentsFromEvent(event));
});
window.addEventListener('toast:success', event => {
    return notify.toastSuccess(event.detail.title, event.detail.html, event.detail.config);
});
window.addEventListener('toast:error', event => {
    return notify.toastError(event.detail.title, event.detail.html, event.detail.config);
});
window.addEventListener('toast:info', event => {
    return notify.toastInfo(event.detail.title, event.detail.html, event.detail.config);
});
window.addEventListener('toast:question', event => {
    return notify.toastQuestion(event.detail.title, event.detail.html, event.detail.config);
});
window.addEventListener('toast:warning', event => {
    return notify.toastWarning(event.detail.title, event.detail.html, event.detail.config);
});
window.addEventListener('toast:invalid', event => {
    return notify.toastInvalid(event.detail.title, event.detail.html, event.detail.config);
});

export default notify;
