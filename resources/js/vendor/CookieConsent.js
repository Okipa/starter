// For more information: https://github.com/osano/cookieconsent

export default class CookieConsent {

    static init() {
        window.cookieconsent.initialise({
            container: document.getElementById('layout'),
            content: {
                message: app.cookieconsent.message,
                dismiss: app.cookieconsent.dismiss,
                link: app.cookieconsent.link,
                href: app.gdprPage.route
            },
            elements: {
                dismiss: '<a'
                    + 'aria-label="dismiss cookie message"'
                    + 'tabindex="0"'
                    + 'class="cc-btn cc-dismiss btn btn-outline-primary">'
                    + '{{dismiss}}'
                    + '</a>'
            },
            revokable: false,
            law: {
                regionalLaw: false
            },
            location: false
        });
    }

}
