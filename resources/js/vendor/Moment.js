// For more information: https://github.com/moment/moment

import * as moment from 'moment';

export default class Moment {

    static init() {
        moment.locale(app.locale);
        window.timezone = moment.tz.guess();
    }

}

