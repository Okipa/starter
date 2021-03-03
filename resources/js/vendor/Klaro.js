// For more information: https://github.com/kiprotect/klaro

import * as klaro from 'klaro';

const klaroConfig = {
    styling: {
        theme: ['light', 'bottom', 'left']
    },
    default: true,
    acceptAll: true,
    hideLearnMore: false,
    disablePoweredBy: true,
    lang: app.locale,
    translations: {
        zz: {
            privacyPolicyUrl: app.gdpr_page_url,
        },
        fr: {
            decline: 'Refuser tout',
            ok: 'Accepter tout',
            acceptSelected: 'Enregistrer sélection'
        },
        en: {
            decline: 'Decline all',
            ok: 'Accept all',
            acceptSelected: 'Save selection'
        }
    },
    services: [
        {
            name: 'google-tag-manager',
            title: 'Google Tag Manager',
            purposes: ['analytics'],
            cookies: [
                // ToDo: set cookies to delete in case of refusal for preprod and production instances.
                // For more information:
                // https://developers.google.com/analytics/devguides/collection/analyticsjs/cookie-usage
                [/^_ga.*$/, '/', 'starter.test'],
                [/^_gid.*$/, '/', 'starter.test'],
                [/^_gat.*$/, '/', 'starter.test'],
                [/^_gac.*$/, '/', 'starter.test'],
                [/^AMP_TOKEN.*$/, '/', 'starter.test']
            ]
        }
    ]
};

export default class Klaro {

    static init() {
        klaro.render(klaroConfig);
        document.getElementById('change-cookie-preferences').addEventListener('click', (e) => {
            e.preventDefault();
            klaro.show(klaroConfig);
        });
    }

}
