$(document).ready(function() {

    $('#dtr').DataTable({});

    var filterYear = (new Date). getFullYear();
    const d = new Date();
    var filterMonth = d.getMonth() + 1;

    document.getElementById('filterYear').addEventListener('change', function() {
        filterYear = null;
        filterYear = $('#filterYear').val();

        document.getElementById('filterMonth').addEventListener('change', function() {
            filterMonth = null;
            filterMonth = $('#filterMonth').val();
        
            $.ajax({
                url: '../backend/admin/filteredDTRtable.php', 
                type: 'POST',
                data: { filterYear: filterYear,
                    filterMonth: filterMonth },
                success: function(response) {
                    $('#dtr').DataTable().clear().destroy(); 
                    $('#dtr tbody').html(response);
                    $('#dtr').DataTable({});
                }
            });
        });
    
        $.ajax({
            url: '../backend/admin/filteredDTRtable.php', 
            type: 'POST',
            data: { filterYear: filterYear,
                filterMonth: filterMonth },
            success: function(response) {
                $('#dtr').DataTable().clear().destroy(); 
                $('#dtr tbody').html(response);
                $('#dtr').DataTable({});
            }
        });
    });

    document.getElementById('filterMonth').addEventListener('change', function() {
        filterMonth = null;
        filterMonth = $('#filterMonth').val();
        // $('#filterYear').prop('disabled', true);

        document.getElementById('filterYear').addEventListener('change', function() {
            filterYear = null;
            filterYear = $('#filterYear').val();
        
            $.ajax({
                url: '../backend/admin/filteredDTRtable.php', 
                type: 'POST',
                data: { filterYear: filterYear,
                    filterMonth: filterMonth },
                success: function(response) {
                    $('#dtr').DataTable().clear().destroy(); 
                    $('#dtr tbody').html(response);
                    $('#dtr').DataTable({});
                }
            });
        });
    
        $.ajax({
            url: '../backend/admin/filteredDTRtable.php', 
            type: 'POST',
            data: { filterYear: filterYear,
                filterMonth: filterMonth },
            success: function(response) {
                $('#dtr').DataTable().clear().destroy(); 
                $('#dtr tbody').html(response);
                $('#dtr').DataTable({});
            }
        });
    });

    var employeeID;

    // VIEW EMPLOYEE DTR 
    var array = [];
    $(document).on('click', '.employeeDTRview', function() {
        var employee_id = $(this).data('id');
        array.push(employee_id);
        var id_employee = array[array.length - 1];
        
        // VIEW
        $.ajax({
            type: "GET",
            url: "../backend/admin/employeeDTRModal.php",
            data: { 
                employee_id: id_employee, 
                filterMonth: filterMonth 
            },
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

                    employeeID = res.data.employeeID;
                    
                    // EMPLOYEE DTR SECTION
                    var employeedtrHTML = '';
                    var dtrGroupedByDate = {};

                    // Initialize object to keep track of ongoing shifts
                    var ongoingShift = null;

                    res.employeeDTR.forEach(function($employeedtr) {
                        var date = $employeedtr.attendanceDate;
                        var time = $employeedtr.attendanceTime;
                        var logTypeID = $employeedtr.logTypeID;
                        var dayOfWeek = $employeedtr.dayOfWeek;
                        var filterDate = $employeedtr.filterDate;
                        var lateMins = $employeedtr.lateMins;
                        var undertimeMins = $employeedtr.undertimeMins;

                        // Initialize the date entry if it doesn't exist
                        if (!dtrGroupedByDate[date]) {
                            dtrGroupedByDate[date] = { timeIn: null, timeOut: null, dayOfWeek: dayOfWeek, timeInDate: null, timeOutDate: null, lateMins: lateMins, undertimeMins: undertimeMins };
                        }

                        // Handle Time In (LogTypeID 1 or 2)
                        if (logTypeID == 1 || logTypeID == 2) {
                            if (!dtrGroupedByDate[date].timeIn || time < dtrGroupedByDate[date].timeIn) {
                                dtrGroupedByDate[date].timeIn = time;
                                dtrGroupedByDate[date].dayOfWeek = dayOfWeek;
                                dtrGroupedByDate[date].timeInDate = filterDate;
                                dtrGroupedByDate[date].lateMins = lateMins;
                            }
                            ongoingShift = { date: date, timeIn: time }; // Start new shift
                        }

                        // Handle Time Out (LogTypeID 3 or 4)
                        if (logTypeID == 3 || logTypeID == 4) {
                            if (ongoingShift && ongoingShift.date !== date) {
                                // Time out belongs to the ongoing shift from the previous day
                                dtrGroupedByDate[ongoingShift.date].timeOut = time;
                                dtrGroupedByDate[date].timeOutDate = filterDate;
                                dtrGroupedByDate[date].undertimeMins = undertimeMins;
                                ongoingShift = null; // Reset ongoing shift
                            } else {
                                dtrGroupedByDate[date].timeOut = time;
                                dtrGroupedByDate[date].timeOutDate = filterDate;
                                dtrGroupedByDate[date].undertimeMins = undertimeMins;
                            }
                        }
                    });
                    
                    var timeInDate = null;
                    var timeOutDate = null;

                    // DISPLAY EMPLOYEE DTR
                    for (var date in dtrGroupedByDate) {
                        var dayOfWeek = dtrGroupedByDate[date].dayOfWeek;
                        var lateMins = dtrGroupedByDate[date].lateMins;
                        var undertimeMins = dtrGroupedByDate[date].undertimeMins;
                        var timeIn = dtrGroupedByDate[date].timeIn !== null ? dtrGroupedByDate[date].timeIn : '-';
                        var timeOut = dtrGroupedByDate[date].timeOut !== null ? dtrGroupedByDate[date].timeOut : '-';
                        timeInDate = dtrGroupedByDate[date].timeInDate;
                        timeOutDate = dtrGroupedByDate[date].timeOutDate;
                        var faceDTRhtml = 
                            '<button class="whitespace-nowrap viewFaceDTR" data-id="' + timeInDate + '" data-id2="' + timeOutDate + '"><svg class="h-6 w-6 text-gray-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg></button>';
                        var faceDTR = dtrGroupedByDate[date].timeIn !== null || dtrGroupedByDate[date].timeOut !== null ? faceDTRhtml : '';
                    
                        employeedtrHTML += '<tr>';
                        employeedtrHTML += '<td class="whitespace-nowrap">' + faceDTR + '</td>';
                        employeedtrHTML += '<td class="whitespace-nowrap">' + date + '</td>';
                        employeedtrHTML += '<td class="whitespace-nowrap">' + dayOfWeek + '</td>';
                        employeedtrHTML += '<td class="whitespace-nowrap">' + timeIn + '</td>';
                        employeedtrHTML += '<td class="whitespace-nowrap">' + timeOut + '</td>';
                        employeedtrHTML += '<td class="whitespace-nowrap">' + lateMins + '</td>';
                        employeedtrHTML += '<td class="whitespace-nowrap">' + undertimeMins + '</td>';
                        employeedtrHTML += '</tr>';
                    }

                    // FOR VIEWING FACE DTR
                    $(document).on('click', '.viewFaceDTR', function() {
                        var timeInDate = null;
                        var timeOutDate = null;
                        timeInDate = $(this).data('id');
                        timeOutDate = $(this).data('id2');
                        const timeInImagePath = '../assets/images/attendance/' + employeeID.replace("-", "") + '_' + timeInDate + '_time_in.png'; 
                        const timeOutImagePath = '../assets/images/attendance/' + employeeID.replace("-", "") + '_' + timeOutDate + '_time_out.png'; 
                        
                        // Use the fetch API to check if the images exist
                        Promise.allSettled([fetch(timeInImagePath), fetch(timeOutImagePath)])
                        .then(results => {
                            const img1Result = results[0];
                            const img2Result = results[1];
                    
                            const image1Src = img1Result.status === 'fulfilled' && img1Result.value.ok 
                                ? timeInImagePath 
                                : null;
                    
                            const image2Src = img2Result.status === 'fulfilled' && img2Result.value.ok 
                                ? timeOutImagePath 
                                : null;
                    
                            let htmlContent = '<div class="flex justify-center space-x-6">';

                            if ((image1Src == null) && (image2Src == null)) {
                                htmlContent += `
                                    <div class="text-center ">
                                        <p>No Face DTR Recorded</p>
                                    </div>
                                `;
                            }
                            else {
                                // Check if time-in image exists
                                if (image1Src) {
                                    htmlContent += `
                                        <div class="text-center">
                                            <img src="${image1Src}" alt="Log In" style="height:300px; width: 300px">
                                            <p>Time In</p>
                                        </div>
                                    `;
                                } else {
                                    
                                }
                        
                                // Check if time-out image exists
                                if (image2Src) {
                                    htmlContent += `
                                        <div class="text-center">
                                            <img src="${image2Src}" alt="Log Out" style="height:300px; width: 300px">
                                            <p>Time Out</p>
                                        </div>
                                    `;
                                } else {
                                    
                                }
                            }
                    
                            htmlContent += '</div>';
                    
                            Swal.fire({
                                title: 'FaceDTR',
                                html: htmlContent,
                                showCloseButton: false,
                                showConfirmButton: true,
                                width: 600,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    timeInDate = null;
                                    timeOutDate = null;
                                }
                            });
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'An error occurred while fetching the images.',
                            });
                            console.error('Error fetching images:', error);
                        });
                    });                    

                    $('#empDTRsection').html(employeedtrHTML);

                    $('#viewEmployeeDTRModal').modal('show');
                }
            }
        });
    });

    $('#btnClose').on('click', function() {
        employeeID = null;
    });
    
});