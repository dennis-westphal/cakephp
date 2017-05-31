$(document).ready(function() {
    var roomInput = $('select#room');
    var dateInput = $('input#date');
    var timeInput = $('input#time');
    var saveButton = $('button#save');

    var momentDateFormat = dateTimeOptions.dateFormat
        .replace('d', 'DD')
        .replace('m', 'MM')
        .replace('Y', 'YYYY');

    var datepickerDateFormat = dateTimeOptions.dateFormat
        .replace('d', 'dd')
        .replace('m', 'mm')
        .replace('Y', 'yy');

    dateInput.datepicker({
        dateFormat: datepickerDateFormat,
        minDate: moment(dateTimeOptions.minDate, momentDateFormat).toDate(),
        maxDate: moment(dateTimeOptions.maxDate, momentDateFormat).toDate()
    });

    var roomOccupationData = {};

    var roomDataReceived = function(data) {
        roomOccupationData = data;

        dateInput.prop('disabled', false);
    };

    roomInput.change(function() {
        if($(this).val()) {
            $.ajax({
                dataType: 'json',
                accepts: {
                    text: "application/json"
                },
                url: roomPresentationsUrl + '/' + $(this).val(),
                success: roomDataReceived
            });

            dateInput.val('');
            timeInput.val('');
        }
        else {
            dateInput.prop('disabled', true).val('');
            timeInput.prop('disabled', true).val('');
        }
    });

    dateInput.change(function() {
        if($(this).val()) {
            timeInput.prop('disabled', false);

            disableTimeRanges = [];

            if(typeof(roomOccupationData[$(this).val()]) !== 'undefined') {
                disableTimeRanges = roomOccupationData[$(this).val()];
            }

            timeInput.timepicker('remove');

            timeInput.timepicker({
                timeFormat: 'H:i',
                minTime: dateTimeOptions.minTime,
                maxTime: dateTimeOptions.maxTime,
                step: dateTimeOptions.interval,
                disableTimeRanges: disableTimeRanges
            });
        }
        else {
            timeInput.prop('disabled', true);
        }
    });

    timeInput.change(function() {
       if($(this).val()) {
           saveButton.prop('disabled', false);
       }
       else {
           saveButton.prop('disabled', true);
       }
    });
});
