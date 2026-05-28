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

    // EMPTY CELLS BEFORE START
    for (let i = 0; i < firstDay; i++) {
        html += "<td></td>";
        count++;
    }

    for (let d = 1; d <= daysInMonth; d++) {

        let fullDate = month + "-" + (d < 10 ? "0" + d : d);
        let dayOfWeek = new Date(fullDate).getDay();

        html += `<td>`;
        html += `<div class="day-number">${d}</div>`;

        // WEEK OFF
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
            let dayData = data[fullDate];

            let hasLeave = dayData.leaves;
            let attendance = dayData.attendance;

            let isLate = attendance && attendance.late;
            let isUndertime = attendance && attendance.undertime;

            let transition = dayData.transition;

            // PRIORITY DISPLAY
            // 1. LEAVE (HIGHEST PRIORITY)
            if (hasLeave) {
                data[fullDate].leaves.forEach(type => {
                    html += `<span class="label ${type.toLowerCase()}">${type.toUpperCase()}</span>`;
                });
            }

            // TRANSITION
            else if (transition) {
                html += `<span class="label trans">TRANSITION</span>`;
            }

            // 3. WEEK OFF
            else if (isOff) {
                html += `<span class="label off">OFF</span>`;
            }

            // 4. ATTENDANCE
            else if (attendance) {
                let timeIn = attendance.time_in;
                let timeOut = attendance.time_out;

                // DISPLAY TIME
                if (isLate) {
                    html += `
                        <span class="label late">
                            LATE: ${timeIn}<br>
                        </span>
                    `;
                    if (isUndertime) {
                        html += `
                            <span class="label undertime">
                                UNDERTIME: ${timeOut}
                            </span>
                        `;
                    }
                    else if (timeOut) {
                        html += `
                            <span class="label attendance">
                                OUT: ${timeOut}
                            </span>
                        `;
                    }
                }
                else if (isUndertime) {
                    if (isLate) {
                        html += `
                            <span class="label late">
                                LATE: ${timeIn}<br>
                            </span>
                        `;
                    } 
                    else {
                        html += `
                            <span class="label attendance">
                                IN: ${timeIn}
                            </span>
                        `;
                    }
                    html += `
                        <span class="label undertime">
                            UNDERTIME: ${timeOut}
                        </span>
                    `;
                }
                else if (timeIn && timeOut) {
                    html += `
                        <span class="label attendance">
                            IN: ${timeIn}
                        </span>
                        <span class="label attendance">
                            OUT: ${timeOut}
                        </span>
                    `;
                } 
                else if (timeIn && !timeOut) {
                    html += `
                        <span class="label attendance">
                            IN: ${timeIn}
                        </span>
                    `;    
                }
                else if (!timeIn && timeOut) {
                    html += `
                        <span class="label attendance">
                            OUT: ${timeOut}
                        </span>
                    `;
                }
            }

            // 5. ABSENT
            else {
                html += `<span class="label absent">ABSENT</span>`;
            }

            // 6. OVERTIME (CAN EXIST WITH OTHERS)
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

// AUTO LOAD ON PAGE LOAD
$(document).ready(function() {
    loadCalendar();
});