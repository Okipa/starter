window.moment = require('moment-timezone');
moment.locale(app.locale);
window.timezone = moment.tz.guess();
