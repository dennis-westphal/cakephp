$(document).ready(function() {
    // Get all inputs
    var roomInput = $('select#room');
    var dateInput = $('input#date');
    var timeInput = $('input#time');
    var saveButton = $('button#save');

    // Get the date format used by the moment library
    var momentDateFormat = dateTimeOptions.dateFormat
        .replace('d', 'DD')
        .replace('m', 'MM')
        .replace('Y', 'YYYY');

    // Get the date format used by the datePicker
    var datepickerDateFormat = dateTimeOptions.dateFormat
        .replace('d', 'dd')
        .replace('m', 'mm')
        .replace('Y', 'yy');

    // Construct the datePicker; only allow dates specified
    dateInput.datepicker({
        dateFormat: datepickerDateFormat,
        minDate: moment(dateTimeOptions.minDate, momentDateFormat).toDate(),
        maxDate: moment(dateTimeOptions.maxDate, momentDateFormat).toDate()
    });

    var roomOccupationData = {};

    // When we received information about the rooms occupation, save it and enable the date input
    var roomDataReceived = function(data) {
        roomOccupationData = data;

        dateInput.prop('disabled', false);
    };

    // React on changes of the room select field
    roomInput.change(function() {
        // When a room was selected, get the occupation data for that room
        if($(this).val()) {
            $.ajax({
                dataType: 'json',
                accepts: {
                    text: 'application/json'
                },
                url: roomPresentationsUrl + '/' + $(this).val(),
                success: roomDataReceived
            });

            // Clear the existing input fields
            dateInput.val('');
            timeInput.val('');
        }
        // When no room was selected, disable the date and time input fields and the submit button
        else {
            dateInput.prop('disabled', true).val('');
            timeInput.prop('disabled', true).val('');
            saveButton.prop('disabled', false);
        }
    });

    // React on changes of the date field
    dateInput.change(function() {
        // When a date was selected, construct and enable the timepicker
        if($(this).val()) {
            timeInput.prop('disabled', false);

            // Check if we the room is occupied at certain times, and save these times
            disableTimeRanges = [];
            if(typeof(roomOccupationData[$(this).val()]) !== 'undefined') {
                disableTimeRanges = roomOccupationData[$(this).val()];
            }

            // Remove and existing timepicker
            timeInput.timepicker('remove');

            // Add the timepicker with the (new) unavailable times
            timeInput.timepicker({
                timeFormat: 'H:i',
                minTime: dateTimeOptions.minTime,
                maxTime: dateTimeOptions.maxTime,
                step: dateTimeOptions.interval,
                disableTimeRanges: disableTimeRanges
            });
        }
        // When no date was selected, disable the time input field and the submit button
        else {
            timeInput.prop('disabled', true);
            saveButton.prop('disabled', false);
        }
    });

    // React on changes of the time input field
    timeInput.change(function() {
        // When a time was selected, enable the submit button
       if($(this).val()) {
           saveButton.prop('disabled', false);
       }
       // When no time was selected, disable the submit button
       else {
           saveButton.prop('disabled', true);
       }
    });
});
