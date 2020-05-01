import 'air-datepicker/src/js/air-datepicker';
import 'air-datepicker/dist/js/i18n/datepicker.fr';

// configuration
const moment = require('moment');
const baseConfig = {
    language: app.locale,
    navTitles: {days: 'MM yyyy'},
    position: 'top left'
};

const selectDateTime = (datePicker, $datePicker) => {
    const filledDate = moment($datePicker.val(), 'DD/MM/YYYY hh:mm');
    if (filledDate.isValid()) {
        const instance = datePicker.data('datepicker');
        const dateObject = filledDate.toDate();
        instance.selectDate(dateObject);
        instance.date = dateObject;
    }
};

window.triggerDateTimePickerElementsDetection = () => {
    const dateTimeElements = $('.datetime-picker');
    _.each(dateTimeElements, (dateTimeElement) => {
        const $datePicker = $(dateTimeElement);
        const datePicker = $datePicker.datepicker({
            ...baseConfig,
            ...{
                timepicker: true,
                dateFormat: 'dd/mm/yyyy',
                timeFormat: 'hh:ii'
            },
            onShow: () => selectDateTime(datePicker, $datePicker)
        });
    });
};

window.triggerDateTimePickerElementsDetection();
