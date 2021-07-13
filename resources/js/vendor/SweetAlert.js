import {get} from 'lodash';

// For more information: https://github.com/sweetalert2/sweetalert2

const baseConfig = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success mx-2',
        cancelButton: 'btn btn-secondary mx-2'
    },
    buttonsStyling: false
});

const popInConfig = baseConfig.mixin({
    showCloseButton: true,
    showConfirmButton: false,
    showCancelButton: true,
    allowOutsideClick: false,
    cancelButtonText: app.notify.close
});

const toastConfig = baseConfig.mixin({
    toast: true,
    position: 'top-end',
    timer: 8000,
    showConfirmButton: false,
    showCloseButton: true
});

/**
 * @param {Object} args
 * @return Object
 */
const formatArgumentsFromEvent = (args) => {
    if (get(args, 'willOpen')) {
        args.willOpen = setTimeout(args.willOpen, 0);
    }
    if (get(args, 'didOpen')) {
        args.didOpen = setTimeout(args.didOpen, 0);
    }
    if (get(args, 'didRender')) {
        args.didRender = setTimeout(args.didRender, 0);
    }
    if (get(args, 'willClose')) {
        args.willClose = setTimeout(args.willClose, 0);
    }
    if (get(args, 'didClose')) {
        args.didClose = setTimeout(args.didClose, 0);
    }
    if (get(args, 'didDestroy')) {
        args.didDestroy = setTimeout(args.didDestroy, 0);
    }

    return args;
};

export default class SweetAlert {

    static init() {
        this.triggerFromSession();
        this.listenToEvents();
    }

    static triggerFromSession() {
        if (app.session_notify_config) {
            baseConfig.fire(app.session_notify_config);
        }
    }

    /**
     * @param {string} html
     * @param {string} title
     * @param {Object} config
     */
    static alertSuccess(html, title = app.notify.success, config = {}) {
        return popInConfig.fire({icon: 'success', title, html, ...config});
    }

    /**
     * @param {string} html
     * @param {string} title
     * @param {Object} config
     */
    static alertError(html = app.notify.unexpected, title = app.notify.error, config = {}) {
        return popInConfig.fire({icon: 'error', title, html, ...config});
    }

    /**
     * @param {string} html
     * @param {string} title
     * @param {Object} config
     */
    static alertInfo(html, title = app.notify.info, config = {}) {
        return popInConfig.fire({icon: 'info', title, html, ...config});
    }

    /**
     * @param {string} html
     * @param {string} title
     * @param {Object} config
     */
    static alertQuestion(html, title = app.notify.question, config = {}) {
        return popInConfig.fire({icon: 'question', title, html, ...config});
    }

    /**
     * @param {string} html
     * @param {string} title
     * @param {Object} config
     */
    static alertWarning(html, title = app.notify.warning, config = {}) {
        return popInConfig.fire({icon: 'warning', title, html, ...config});
    }

    /**
     * @param {string} html
     * @param {string} title
     * @param {Object} config
     */
    static alertLoading(html = app.notify.loading, title = app.notify.please_wait, config = {}) {
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
    }

    /**
     * @param {string} html
     * @param {string} title
     * @param {Object} config
     */
    static alertConfirm(html, title = app.notify.confirm_request, config = {}) {
        return popInConfig.fire({
            icon: 'warning',
            title,
            html,
            showConfirmButton: true,
            showCancelButton: true,
            confirmButtonText: app.notify.confirm,
            cancelButtonText: app.notify.cancel,
            ...config
        });
    }

    /**
     * @param {string} title
     * @param {string|null} html
     * @param {Object} config
     */
    static toastSuccess(title, html = null, config = {}) {
        return toastConfig.fire({icon: 'success', title, html, ...config});
    }

    /**
     * @param {string|null} title
     * @param {string|null} html
     * @param {Object} config
     */
    static toastError(title = app.notify.unexpected, html = null, config = {}) {
        return toastConfig.fire({icon: 'error', title, html, ...config});
    }

    /**
     * @param {string} title
     * @param {string|null} html
     * @param {Object} config
     */
    static toastInfo(title, html = null, config = {}) {
        return toastConfig.fire({icon: 'info', title, html, ...config});
    }

    /**
     * @param {string} title
     * @param {string|null} html
     * @param {Object} config
     */
    static toastQuestion(title, html = null, config = {}) {
        return toastConfig.fire({icon: 'question', title, html, ...config});
    }

    /**
     * @param {string} title
     * @param {string|null} html
     * @param {Object} config
     */
    static toastWarning(title, html = null, config = {}) {
        return toastConfig.fire({icon: 'warning', title, html, ...config});
    }

    /**
     * @param {string} title
     * @param {string|null} html
     * @param {Object} config
     */
    static toastInvalid(title = app.notify.invalid, html = null, config = {}) {
        return toastConfig.fire({icon: 'error', title, html, ...config});
    }

    static listenToEvents() {
        window.addEventListener('popin', event => {
            return popInConfig.fire(formatArgumentsFromEvent(event.detail));
        });
        window.addEventListener('popin:success', event => {
            return this.alertSuccess(
                event.detail.html,
                event.detail.title,
                formatArgumentsFromEvent(event.detail.config)
            );
        });
        window.addEventListener('popin:error', event => {
            return this.alertError(
                event.detail.html,
                event.detail.title,
                formatArgumentsFromEvent(event.detail.config)
            );
        });
        window.addEventListener('popin:info', event => {
            return this.alertInfo(
                event.detail.html,
                event.detail.title,
                formatArgumentsFromEvent(event.detail.config)
            );
        });
        window.addEventListener('popin:question', event => {
            return this.alertQuestion(
                event.detail.html,
                event.detail.title,
                formatArgumentsFromEvent(event.detail.config)
            );
        });
        window.addEventListener('popin:warning', event => {
            return this.alertWarning(
                event.detail.html,
                event.detail.title,
                formatArgumentsFromEvent(event.detail.config)
            );
        });
        window.addEventListener('popin:loading', event => {
            return this.alertLoading(
                event.detail.html,
                event.detail.title,
                formatArgumentsFromEvent(event.detail.config)
            );
        });
        window.addEventListener('popin:confirm', event => {
            return this.alertConfirm(
                event.detail.html,
                event.detail.title,
                formatArgumentsFromEvent(event.detail.config)
            );
        });
        window.addEventListener('toast', event => {
            return toastConfig.fire(formatArgumentsFromEvent(event.detail));
        });
        window.addEventListener('toast:success', event => {
            return this.toastSuccess(
                event.detail.title,
                event.detail.html,
                formatArgumentsFromEvent(event.detail.config)
            );
        });
        window.addEventListener('toast:error', event => {
            return this.toastError(
                event.detail.title,
                event.detail.html,
                formatArgumentsFromEvent(event.detail.config)
            );
        });
        window.addEventListener('toast:info', event => {
            return this.toastInfo(
                event.detail.title,
                event.detail.html,
                formatArgumentsFromEvent(event.detail.config)
            );
        });
        window.addEventListener('toast:question', event => {
            return this.toastQuestion(
                event.detail.title,
                event.detail.html,
                formatArgumentsFromEvent(event.detail.config)
            );
        });
        window.addEventListener('toast:warning', event => {
            return this.toastWarning(
                event.detail.title,
                event.detail.html,
                formatArgumentsFromEvent(event.detail.config)
            );
        });
        window.addEventListener('toast:invalid', event => {
            return this.toastInvalid(
                event.detail.title,
                event.detail.html,
                formatArgumentsFromEvent(event.detail.config)
            );
        });
    }

}
