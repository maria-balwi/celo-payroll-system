$(document).ready(function() {

    $('#teamDTRTable').DataTable();

    var filterYear = (new Date). getFullYear();
    const d = new Date();
    var filterMonth = d.getMonth() + 1;

    function nightDiffDTR(timeInDate) {
        var timeOutHolder = new Date(timeInDate.replace(/\./g, '/'));
        timeOutHolder.setDate(timeOutHolder.getDate() + 1);
        timeOutDate = timeOutHolder.getFullYear() + '.' + 
                    (timeOutHolder.getMonth() + 1).toString().padStart(2, '0') + '.' + 
                    timeOutHolder.getDate().toString().padStart(2, '0');
        return timeOutDate;
    }

    function formatTimeString(timeString) {
        // Parse the time string
        const [time, modifier] = timeString.split(' ');
        let [hours, minutes] = time.split(':');
    
        // Convert to 24-hour format
        if (modifier === 'PM' && hours !== '12') {
            hours = parseInt(hours, 10) + 12;
        }
        if (modifier === 'AM' && hours === '12') {
            hours = '00';
        }
    
        // Ensure minutes are two digits
        minutes = minutes.padStart(2, '0');
    
        // Return in the desired format (e.g., "HH:MM")
        return `${hours}:${minutes}`;
    }

    document.getElementById('filterYear').addEventListener('change', function() {
        filterYear = null;
        filterYear = $('#filterYear').val();

        document.getElementById('filterMonth').addEventListener('change', function() {
            filterMonth = null;
            filterMonth = $('#filterMonth').val();
        
            $.ajax({
                url: '../backend/team/filteredDTRtable.php', 
                type: 'POST',
                data: { filterYear: filterYear,
                    filterMonth: filterMonth },
                success: function(response) {
                    $('#teamDTRTable').DataTable().clear().destroy(); 
                    $('#teamDTRTable tbody').html(response);
                    $('#teamDTRTable').DataTable({});
                }
            });
        });
    
        $.ajax({
            url: '../backend/team/filteredDTRtable.php', 
            type: 'POST',
            data: { filterYear: filterYear,
                filterMonth: filterMonth },
            success: function(response) {
                $('#teamDTRTable').DataTable().clear().destroy(); 
                $('#teamDTRTable tbody').html(response);
                $('#teamDTRTable').DataTable({});
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
                url: '../backend/team/filteredDTRtable.php', 
                type: 'POST',
                data: { filterYear: filterYear,
                    filterMonth: filterMonth },
                success: function(response) {
                    $('#teamDTRTable').DataTable().clear().destroy(); 
                    $('#teamDTRTable tbody').html(response);
                    $('#teamDTRTable').DataTable({});
                }
            });
        });
    
        $.ajax({
            url: '../backend/team/filteredDTRtable.php', 
            type: 'POST',
            data: { filterYear: filterYear,
                filterMonth: filterMonth },
            success: function(response) {
                $('#teamDTRTable').DataTable().clear().destroy(); 
                $('#teamDTRTable tbody').html(response);
                $('#teamDTRTable').DataTable({});
            }
        });
    });

    // VIEW TEAM MEMBER DTR 
    var array = [];
    $(document).on('click', '.teamDTRview', function() {
        var team_id = $(this).data('id');
        array.push(team_id);
        var id_team = array[array.length - 1];

        // VIEW
        $.ajax({
            type: "GET",
            url: "../backend/team/teamDTRModal.php",
            data: { 
                team_id: id_team,
                filterMonth: filterMonth, 
                filterYear: filterYear
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

                    var employeeID = res.data.employeeID;
                    
                    // EMPLOYEE DTR SECTION
                    var teamdtrHTML = '';
                    var dtrGroupedByDate = {};

                    // Initialize object to keep track of ongoing shifts
                    var ongoingShift = null;

                    res.teamDTR.forEach(function($teamdtr) {
                        var date = $teamdtr.attendanceDate;
                        var time = $teamdtr.attendanceTime;
                        var logTypeID = $teamdtr.logTypeID;
                        var dayOfWeek = $teamdtr.dayOfWeek;
                        var filterDate = $teamdtr.filterDate;
                        var lateMins = $teamdtr.lateMins;
                        var undertimeMins = $teamdtr.undertimeMins;

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
                                dtrGroupedByDate[ongoingShift.date].timeOutDate = filterDate;
                                dtrGroupedByDate[ongoingShift.date].undertimeMins = undertimeMins;
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

                        // Get week-off values from response (since they're same for the whole employee)
                        var wo_mon = res.teamDTR[0].wo_mon;
                        var wo_tue = res.teamDTR[0].wo_tue;
                        var wo_wed = res.teamDTR[0].wo_wed;
                        var wo_thu = res.teamDTR[0].wo_thu;
                        var wo_fri = res.teamDTR[0].wo_fri;
                        var wo_sat = res.teamDTR[0].wo_sat;
                        var wo_sun = res.teamDTR[0].wo_sun;

                        // Determine if this day is a week off
                        var isWeekOff = false;
                        switch (dayOfWeek) {
                            case 'Mon': if (wo_mon == 1) isWeekOff = true; break;
                            case 'Tue': if (wo_tue == 1) isWeekOff = true; break;
                            case 'Wed': if (wo_wed == 1) isWeekOff = true; break;
                            case 'Thu': if (wo_thu == 1) isWeekOff = true; break;
                            case 'Fri': if (wo_fri == 1) isWeekOff = true; break;
                            case 'Sat': if (wo_sat == 1) isWeekOff = true; break;
                            case 'Sun': if (wo_sun == 1) isWeekOff = true; break;
                        }

                        if (isWeekOff) {
                            teamdtrHTML += `
                                <tr class="bg-gray-100 text-center text-gray-500">
                                    <td></td>
                                    <td>${date}</td>
                                    <td>${dayOfWeek}</td>
                                    <td colspan="4" class="text-primary font-semibold">WEEK OFF</td>
                                </tr>
                            `;
                            continue;
                        }

                        // IF NOT WEEK OFF
                        var faceDTRhtml = 
                            '<button class="whitespace-nowrap viewFaceDTR" data-id="' + timeInDate + '" data-id2="' + timeOutDate + '" data-id3="' + timeIn + '" data-id4="' + timeOut + '">' +
                            '<svg class="h-6 w-6 text-gray-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">' +
                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>' +
                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>' +
                            '</svg></button>';

                        var faceDTR = dtrGroupedByDate[date].timeIn !== null || dtrGroupedByDate[date].timeOut !== null ? faceDTRhtml : '';

                        teamdtrHTML += `
                            <tr>
                                <td>${faceDTR}</td>
                                <td>${date}</td>
                                <td>${dayOfWeek}</td>
                                <td>${timeIn}</td>
                                <td>${timeOut}</td>
                                <td>${lateMins}</td>
                                <td>${undertimeMins}</td>
                            </tr>
                        `;
                    }

                    // FOR VIEWING FACE DTR
                    $(document).on('click', '.viewFaceDTR', function() {
                        var timeInDate = null;
                        var timeOutDate = null;
                        timeInDate = $(this).data('id');
                        timeOutDate = $(this).data('id2');
                        timeIn = formatTimeString($(this).data('id3'));
                        timeOut = formatTimeString($(this).data('id4'));
                        let newTimeOutDate = timeIn >= timeOut ? nightDiffDTR(timeInDate) : timeOutDate;

                        const timeInImagePath = '../assets/images/attendance/' + employeeID.replace("-", "") + '_' + timeInDate + '_time_in.png'; 
                        const timeOutImagePath = '../assets/images/attendance/' + employeeID.replace("-", "") + '_' + newTimeOutDate + '_time_out.png'; 
                        
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
                    
                            // // Check if time-in image exists
                            // if (image1Src) {
                            //     htmlContent += `
                            //         <div class="text-center">
                            //             <img src="${image1Src}" alt="Log In" style="height:300px; width: 300px">
                            //             <p>Time In</p>
                            //         </div>
                            //     `;
                            // } else {
                                
                            // }
                    
                            // // Check if time-out image exists
                            // if (image2Src) {
                            //     htmlContent += `
                            //         <div class="text-center">
                            //             <img src="${image2Src}" alt="Log Out" style="height:300px; width: 300px">
                            //             <p>Time Out</p>
                            //         </div>
                            //     `;
                            // } else {
                                
                            // }

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

                    $('#empDTRsection').html(teamdtrHTML);

                    $('#viewTeamDTRModal').modal('show');
                }
            }
        });
    });
});