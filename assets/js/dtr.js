// function loadCalendar(employeeID, month) {
//     $.ajax({
//         url: 'getCalendarData.php',
//         method: 'GET',
//         data: { employee_id: employeeID, month: month },
//         dataType: 'json',
//         success: function(res) {
//             renderCalendar(month, res);
//         }
//     });
// }

// function renderCalendar(month, leaveData) {
//     let date = new Date(month + "-01");
//     let firstDay = date.getDay();
//     let daysInMonth = new Date(date.getFullYear(), date.getMonth()+1, 0).getDate();

//     let html = "<tr>";
//     let dayCount = 0;

//     // empty cells before first day
//     for (let i = 0; i < firstDay; i++) {
//         html += "<td></td>";
//         dayCount++;
//     }

//     for (let d = 1; d <= daysInMonth; d++) {
//         let fullDate = month + "-" + (d < 10 ? "0"+d : d);

//         html += `<td><strong>${d}</strong>`;

//         if (leaveData[fullDate]) {
//             leaveData[fullDate].forEach(type => {
//                 let className = type.toLowerCase(); // vl, sl, off
//                 html += `<span class="leave ${className}">${type}</span>`;
//             });
//         }

//         html += "</td>";

//         dayCount++;
//         if (dayCount % 7 === 0) html += "</tr><tr>";
//     }

//     html += "</tr>";

//     $("#calendarBody").html(html);
// }

// $(document).ready(function() {

//     loadCalendar(1, "2025-10");

//     $(document).on("click", ".calendar td", function() {
//         let date = $(this).find("strong").text();
//         // open modal
//     });
// });


function loadCalendar() {
    let employeeID = $("#employee").val();
    let month = $("#month").val();

    $.ajax({
        url: "../backend/user/getCalendarData.php",
        method: "GET",
        data: { employee_id: employeeID, month: month },
        dataType: "json",
        success: function(res) {
            renderCalendar(month, res.calendar, res.weekOff);
        }
    });
}

function renderCalendar(month, data, weekOff) {

    let date = new Date(month + "-01");
    let year = date.getFullYear();
    let monthIndex = date.getMonth();

    let firstDay = new Date(year, monthIndex, 1).getDay();
    let daysInMonth = new Date(year, monthIndex + 1, 0).getDate();

    let html = "<tr>";
    let count = 0;

    // Empty cells before start
    for (let i = 0; i < firstDay; i++) {
        html += "<td></td>";
        count++;
    }

    for (let d = 1; d <= daysInMonth; d++) {

        let fullDate = month + "-" + (d < 10 ? "0" + d : d);
        let dayOfWeek = new Date(fullDate).getDay();

        html += `<td>`;
        html += `<div class="day-number">${d}</div>`;

        // Week Off (Sunday)
        // if (dayOfWeek === 0) {
        //     html += `<span class="label off">OFF</span>`;
        // }
        let isOff = false;
        if (dayOfWeek === 0 && weekOff.wo_sun == "1") isOff = true;
        if (dayOfWeek === 1 && weekOff.wo_mon == "1") isOff = true;
        if (dayOfWeek === 2 && weekOff.wo_tue == "1") isOff = true;
        if (dayOfWeek === 3 && weekOff.wo_wed == "1") isOff = true;
        if (dayOfWeek === 4 && weekOff.wo_thu == "1") isOff = true;
        if (dayOfWeek === 5 && weekOff.wo_fri == "1") isOff = true;
        if (dayOfWeek === 6 && weekOff.wo_sat == "1") isOff = true;

        if (isOff) {
            html += `<span class="label off">OFF</span>`;
        }

        if (data[fullDate]) {

            // // Attendance
            // if (data[fullDate].attendance) {
            //     html += `<span class="label att">ATT</span>`;
            // }

            // // Leaves
            // if (data[fullDate].leaves) {
            //     data[fullDate].leaves.forEach(type => {
            //         html += `<span class="label ${type.toLowerCase()}">${type}</span>`;
            //     });
            // }

            // // Overtime
            // if (data[fullDate].overtime) {
            //     let hours = data[fullDate].overtime[0];
            //     html += `<span class="label ot">OT (${hours}h)</span>`;
            // }

            // // Holiday (optional)
            // if (data[fullDate].holiday) {
            //    
            
            let hasAttendance = false;
            let isLate = false;
            let isUndertime = false;

            // Check attendance
            if (data[fullDate] && data[fullDate].attendance) {

                hasAttendance = true;

                data[fullDate].attendance.forEach(type => {
                    if (type == 2) isLate = true;
                    if (type == 3) isUndertime = true;
                });
            }

            // Leaves
            let hasLeave = data[fullDate] && data[fullDate].leaves;

            // ✅ PRIORITY DISPLAY

            // 1. Leave (highest priority)
            if (hasLeave) {
                data[fullDate].leaves.forEach(type => {
                    html += `<span class="label ${type.toLowerCase()}">${type}</span>`;
                });
            }

            // 2. Week Off
            else if (isOff) {
                html += `<span class="label off">OFF</span>`;
            }

            // 3. Attendance
            else if (hasAttendance) {

                html += `<span class="label att">ATT</span>`;

                if (isLate) {
                    html += `<span class="label late">LATE</span>`;
                }

                if (isUndertime) {
                    html += `<span class="label undertime">UT</span>`;
                }
            }

            // 4. Absent
            else {
                html += `<span class="label absent">ABSENT</span>`;
            }

            // 5. Overtime (can exist with others)
            if (data[fullDate] && data[fullDate].overtime) {
                let hours = data[fullDate].overtime[0];
                html += `<span class="label ot">OT (${hours}h)</span>`;
            }
        }

        html += `</td>`;

        count++;
        if (count % 7 === 0) html += "</tr><tr>";
    }

    html += "</tr>";

    $("#calendarBody").html(html);
}

// Auto load on page load
$(document).ready(function() {
    loadCalendar();
});