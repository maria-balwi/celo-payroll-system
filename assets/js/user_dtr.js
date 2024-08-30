$(document).ready(function() {

    // var dtrTable = $('#dtrTable').DataTable();
    // dtrTable.order([[1, "desc"]]).draw();
    $('#dtrTable').DataTable();
    
    var userdtrHTML = '';
    var dtrGroupedByDate = {};

    // Initialize object to keep track of ongoing shifts
    var ongoingShift = null;

    res.employeeDTR.forEach(function($employeedtr) {
        var date = $employeedtr.attendanceDate;
        var time = $employeedtr.attendanceTime;
        var logTypeID = $employeedtr.logTypeID;

        // Initialize the date entry if it doesn't exist
        if (!dtrGroupedByDate[date]) {
            dtrGroupedByDate[date] = { timeIn: null, timeOut: null };
        }

        // Handle Time In (LogTypeID 1 or 2)
        if (logTypeID == 1 || logTypeID == 2) {
            if (!dtrGroupedByDate[date].timeIn || time < dtrGroupedByDate[date].timeIn) {
                dtrGroupedByDate[date].timeIn = time;
            }
            ongoingShift = { date: date, timeIn: time }; // Start new shift
        }

        // Handle Time Out (LogTypeID 3 or 4)
        if (logTypeID == 3 || logTypeID == 4) {
            if (ongoingShift && ongoingShift.date !== date) {
                // Time out belongs to the ongoing shift from the previous day
                dtrGroupedByDate[ongoingShift.date].timeOut = time;
                ongoingShift = null; // Reset ongoing shift
            } else {
                dtrGroupedByDate[date].timeOut = time;
            }
        }
    });

    // Display the results
    for (var date in dtrGroupedByDate) {
        var timeIn = dtrGroupedByDate[date].timeIn !== null ? dtrGroupedByDate[date].timeIn : '-';
        var timeOut = dtrGroupedByDate[date].timeOut !== null ? dtrGroupedByDate[date].timeOut : '-';

        userdtrHTML += '<tr>';
        userdtrHTML += '<td class="whitespace-nowrap">' + date + '</td>';
        userdtrHTML += '<td class="whitespace-nowrap">' + timeIn + '</td>';
        userdtrHTML += '<td class="whitespace-nowrap">' + timeOut + '</td>';
        userdtrHTML += '</tr>';
    }
    $('#userDTRsection').html(userdtrHTML);
});