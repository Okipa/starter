window.moment = require('moment-timezone');
//window.moment = require('moment-timezone');
//import * as moment from 'moment-timezone';
moment.locale(app.locale);
window.timezone = moment.tz.guess();
