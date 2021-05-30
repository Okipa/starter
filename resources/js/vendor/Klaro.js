// For more information: https://github.com/kiprotect/klaro

import * as klaro from 'klaro';
import {each, flatten, isArray, map} from 'lodash';

const getTranslations = () => {
    let translations = {
        zz: {
            privacyPolicyUrl: app.gdpr_page_url,
            purposes: {}
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
    };
    each(app.cookie_categories, (cookieCategory) => {
        translations.zz['purposes'][cookieCategory.unique_key] = {
            title: cookieCategory.title[app.locale],
            description: cookieCategory.description[app.locale]
        };
    });

    return translations;
};

const getServices = () => {
    const services = [];
    each(flatten(map(app.cookie_categories, 'services')), (cookieService) => {
        // Replacing regex contained in string into real regex
        each(cookieService.cookies, (cookie, key) => {
            if (isArray(cookie)) {
                cookieService.cookies[key] = new RegExp(cookie);
            }
        });
        services.push({
            name: cookieService.unique_key,
            title: cookieService.title[app.locale],
            description: cookieService.description[app.locale] || null,
            purposes: map(cookieService.categories, 'unique_key'),
            required: cookieService.required,
            default: cookieService.enabled_by_default,
            cookies: cookieService.cookies || {}
        });
    });

    return services;
};

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
    // https://github.com/kiprotect/klaro/tree/master/src/translations
    // Example config that shows how to overwrite translations:
    // https://github.com/kiprotect/klaro/blob/master/dist/configs/i18n.js
    translations: getTranslations(),
    services: getServices()
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
