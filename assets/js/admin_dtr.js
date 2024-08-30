$(document).ready(function() {

    $('#dtr').DataTable();

    // VIEW TEAM MEMBER DTR 
    var array = [];
    $(document).on('click', '.employeeDTRview', function() {
        var employee_id = $(this).data('id');
        array.push(employee_id);
        var id_employee = array[array.length - 1];

        // VIEW
        $.ajax({
            type: "GET",
            url: "../backend/admin/employeeDTRModal.php?employee_id=" + id_employee,
            success: function(response) {

                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } 
                else if (res.status == 200) {
                    $('#viewID').val(res.data.id);
                    $('#viewEmployeeName').val(res.data.firstName + ' ' + res.data.lastName);
                    $('#viewEmailAddress').val(res.data.emailAddress);
                    $('#viewEmployeeID').val(res.data.employeeID);
                    $('#viewShiftID').val(res.data.startTime + ' - ' + res.data.endTime);
                    
                    // EMPLOYEE DTR SECTION
                    var employeedtrHTML = '';
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

                        employeedtrHTML += '<tr>';
                        employeedtrHTML += '<td class="whitespace-nowrap">' + date + '</td>';
                        employeedtrHTML += '<td class="whitespace-nowrap">' + timeIn + '</td>';
                        employeedtrHTML += '<td class="whitespace-nowrap">' + timeOut + '</td>';
                        employeedtrHTML += '</tr>';
                    }

                    $('#empDTRsection').html(employeedtrHTML);

                    $('#viewEmployeeDTRModal').modal('show');
                }
            }
        });
    });
    
});