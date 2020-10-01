import 'air-datepicker/src/js/air-datepicker';
import 'air-datepicker/dist/js/i18n/datepicker.fr';

// configuration *******************************************************************************************************
const moment = require('moment');
const baseConfig = {
    language: app.locale,
    navTitles: {days: 'MM yyyy'},
    position: 'top left'
};

// date picker *********************************************************************************************************
const selectDate = (datePicker, $datePicker) => {
    const filledDate = moment($datePicker.val(), 'DD/MM/YYYY');
    if (filledDate.isValid()) {
        const instance = datePicker.data('datepicker');
        const dateObject = filledDate.toDate();
        instance.selectDate(dateObject);
        instance.date = dateObject;
    }
};
window.triggerDatePickerElementsDetection = () => {
    const $datePickers = $('[data-date-picker]');
    if ($datePickers.length) {
        _.each($datePickers, (item) => {
            const $datePicker = $(item);
            const datePicker = $datePicker.datepicker({
                ...baseConfig,
                ...{
                    dateFormat: 'dd/mm/yyyy'
                },
                onShow: () => selectDate(datePicker, $datePicker)
            });
        });
    }
};
triggerDatePickerElementsDetection();

// datetime picker *****************************************************************************************************
const selectDateTime = (dateTimePicker, $dateTimePicker) => {
    const filledDateTime = moment($dateTimePicker.val(), 'DD/MM/YYYY hh:mm');
    if (filledDateTime.isValid()) {
        const instance = dateTimePicker.data('datepicker');
        const dateObject = filledDateTime.toDate();
        instance.selectDate(dateObject);
        instance.date = dateObject;
    }
};
window.triggerDateTimePickerElementsDetection = () => {
    const $dateTimePickers = $('[data-datetime-picker]');
    _.each($dateTimePickers, (item) => {
        const $dateTimePicker = $(item);
        const dateTimePicker = $dateTimePicker.datepicker({
            ...baseConfig,
            ...{
                timepicker: true,
                dateFormat: 'dd/mm/yyyy',
                timeFormat: 'hh:ii'
            },
            onShow: () => selectDateTime(dateTimePicker, $dateTimePicker)
        });
    });
};
triggerDateTimePickerElementsDetection();

// month range picker **************************************************************************************************
const selectDateRange = (monthRangePicker, $monthRangePicker) => {
    let filledDates = $monthRangePicker.val().split(' - ');
    filledDates = _.map(filledDates, (date) => {
        const dateInstance = moment(date, 'MM/YYYY');
        return dateInstance.isValid() && dateInstance.toDate();
    });
    const instance = monthRangePicker.data('datepicker');
    instance.selectDate(filledDates);
    instance.date = filledDates;
};
window.triggerMonthRangePickerElementsDetection = () => {
    const $monthRangePickers = $('[data-month-range-picker]');
    if ($monthRangePickers.length) {
        _.each($monthRangePickers, (item) => {
            const $monthRangePicker = $(item);
            const monthRangePicker = $monthRangePicker.datepicker({
                ...baseConfig,
                ...{
                    range: true,
                    multipleDatesSeparator: ' - ',
                    minView: 'months',
                    view: 'months',
                    dateFormat: 'mm/yyyy',
                    toggleSelected: false,
                    maxDate: new Date()
                },
                onShow: () => selectDateRange(monthRangePicker, $monthRangePicker)
            });
        });
    }
};

triggerMonthRangePickerElementsDetection();
