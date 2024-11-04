$(document).ready(function() {

    $('#holidayTable').DataTable();

    // GENERATE CALENDAR
    const monthNames = ["January", "February", "March", 
                        "April", "May", "June",
                        "July", "August", "September", 
                        "October", "November", "December"];
    let today = new Date();
    let currentMonth = today.getMonth();
    let currentYear = today.getFullYear();

    function renderCalendar(month, year) {
        $('#monthYear').text(`${monthNames[month]} ${year}`);
        let firstDay = new Date(year, month).getDay();
        let daysInMonth = 32 - new Date(year, month, 32).getDate();
        $('#days').empty();
        
        // Create blank days for the first week
        for (let i = 0; i < firstDay; i++) {
            $('#days').append('<div class="text-gray-400"></div>');
        }

        // Create days of the month
        for (let i = 1; i <= daysInMonth; i++) {
            $('#days').append(`<div class="py-2 px-4 rounded cursor-pointer hover:bg-gray-200">${i}</div>`);
        }
    }

    $('#prev').click(function () {
        if (currentMonth === 0) {
            currentMonth = 11;
            currentYear--;
        } else {
            currentMonth--;
        }
        renderCalendar(currentMonth, currentYear);
    });

    $('#next').click(function () {
        if (currentMonth === 11) {
            currentMonth = 0;
            currentYear++;
        } else {
            currentMonth++;
        }
        renderCalendar(currentMonth, currentYear);
    });

    renderCalendar(currentMonth, currentYear);
});