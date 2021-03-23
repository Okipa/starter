// For more information: https://github.com/kiprotect/klaro

import * as klaro from 'klaro';

console.log(app.cookie_services);

// Example of config available here: /node_modules/klaro/dist/config.js
const klaroConfig = {
    version: '0.7.*',
    elementID: 'klaro',
    styling: {
        theme: ['light', 'bottom', 'left']
    },
    noAutoLoad: false,
    htmlTexts: true,
    embedded: false,
    groupByPurpose: true,
    storageMethod: 'cookie',
    cookieName: 'klaro',
    cookieExpiresAfterDays: 120,
    cookieDomain: '.' + app.domain,
    default: false,
    mustConsent: false,
    acceptAll: true,
    hideDeclineAll: false,
    hideLearnMore: false,
    noticeAsModal: false,
    disablePoweredBy: true,
    //additionalClass: 'my-klaro',
    lang: app.locale,
    // You can overwrite existing translations and add translations for your
    // service descriptions and purposes. See `src/translations/` for a full
    // list of translations that can be overwritten:
    // https://github.com/KIProtect/klaro/tree/master/src/translations
    // Example config that shows how to overwrite translations:
    // https://github.com/KIProtect/klaro/blob/master/src/configs/i18n.js
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
