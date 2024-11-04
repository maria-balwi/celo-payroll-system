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

    // DISPLAYING DATE
    function displayDate(day) {
        let date = new Date(day);
        let months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        let formattedDate = months[date.getMonth()] + " " + date.getDate() + ", " + date.getFullYear();
        return formattedDate;
    }

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


    // ADD HOLIDAY
    $("#addHolidayForm").submit(function (e) {

        e.preventDefault();

        var holidayName = $("#holidayName").val();
        var dateFrom = $("#dateFrom").val();
        var dateTo = $("#dateTo").val();
        var holidayType = $("#holidayType").val();

        if (holidayName == '' || dateFrom == '' || dateTo == '' || holidayType == '') {
            Swal.fire({
                icon: 'warning',
                title: 'Required Information',
                text: 'Please fill up all the required Information',
            })
        } else {
            Swal.fire({
                icon: 'question',
                title: 'Add Holiday',
                text: 'Are you sure you want to add this holiday?',
                showCancelButton: true,
                cancelButtonColor: '#6c757d',
                confirmButtonColor: '#28a745',
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: "POST",
                        url: "../backend/admin/addHoliday.php",
                        data: $(this).serialize(),
                        cache: false,
                        success: function (res) {
                            const data = JSON.parse(res);
                            var message = data.em;
                            if (data.error == 0) {
                                var id = data.holidayID;
                                loadHolidayData(id);
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: message,
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    // Refresh the View Employee Modal with new added data
                                    $('#addHolidayModal').modal('hide');
                                    $('#viewHolidayModal').modal('show');
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: message
                                }) 
                            }
                        }
                    });
                }
            });
        }
    });

    // VIEW AND UPDATE HOLIDAY
    var array = [];
    $(document).on('click', '.holidayView', function() {
        var holiday_id = $(this).data('id');
        array.push(holiday_id);
        var id_holiday = array[array.length - 1];

        // VIEW HOLIDAY
        $.ajax({
            type: "GET",
            url: "../backend/admin/holidayModal.php?holiday_id=" + id_holiday,
            success: function(response) {

                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } 
                else if (res.status == 200) {
                    $('#viewHolidayID').val(res.data.holidayID);
                    $('#view_holidayName').val(res.data.holidayName);
                    $('#view_dateFrom').val(displayDate(res.data.dateFrom));
                    $('#view_dateTo').val(displayDate(res.data.dateFrom));
                    $('#view_holidayType').val(res.data.type);
                    $('#viewHolidayModal').modal('show');
                }
            }
        });

        // UPDATE HOLIDAY
        $(document).on('click', '.holidayUpdate', function() {
            $('#viewHolidayModal').modal('hide');
            var id_holiday = array[array.length - 1];

            $.ajax({
                type: "GET",
                url: "../backend/admin/holidayModal.php?holiday_id=" + id_holiday,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {
                        alert(res.message);
                    } 
                    else if (res.status == 200) {
                        $('#updateHolidayID').val(res.data.holidayID);
                        $('#updateHolidayName').val(res.data.holidayName);
                        $('#updateDateFrom').val(res.data.dateFrom);
                        $('#updateDateTo').val(res.data.dateTo);
                        $('#updateHolidayType').val(res.data.type);
                        $('#updateHolidayModal').modal('show');
                    }
                }
            });
        })

        // // DELETE HOLIDAY
        // $(document).on('click', '.allowanceDelete', function() {
        //     var id_allowance = array[array.length - 1];

        //     $.ajax({
        //         type: "GET",
        //         url: "../backend/admin/allowanceModal.php?allowance_id=" + id_allowance,
        //         success: function(response) {

        //             var res = jQuery.parseJSON(response);
        //             if (res.status == 404) {
        //                 alert(res.message);
        //             } else if (res.status == 200) {

        //                 Swal.fire({
        //                     icon: 'question',
        //                     title: 'Delete Allowance',
        //                     text: 'Are you sure you want to delete this allowance?',
        //                     showCancelButton: true,
        //                     cancelButtonColor: '#6c757d',
        //                     confirmButtonColor: '#28a745',
        //                     confirmButtonText: 'Yes',

        //                 }).then((result) => {
        //                     if (result.isConfirmed) {

        //                         $.ajax({
        //                             url: "../backend/admin/deleteAllowance.php",
        //                             type: 'POST',
        //                             data: {
        //                                 id_allowance: id_allowance
        //                             },
        //                             cache: false,
        //                             success: function(data) {
        //                                 Swal.fire({
        //                                     icon: 'success',
        //                                     title: 'Success',
        //                                     text: 'Allowance Deleted Successfully',
        //                                     timer: 2000,
        //                                     showConfirmButton: false,
        //                                 }).then(() => {
        //                                     window.location.reload();
        //                                 })
        //                             }
        //                         })
        //                     }
        //                 })
        //             }
        //         }
        //     });
        // })
    });

    function loadHolidayData(id_holiday) {
        $.ajax({
            type: "GET",
            url: "../backend/admin/holidayModal.php?holiday_id=" + id_holiday,
            success: function(response) {

                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } 
                else if (res.status == 200) {
                    $('#viewHolidayID').val(res.data.holidayID);
                    $('#view_holidayName').val(res.data.holidayName);
                    $('#view_dateFrom').val(res.data.dateFrom);
                    $('#view_dateTo').val(res.data.dateTo);
                    $('#view_holidayType').val(res.data.type);
                    // $('#view_holidayCategory').val(res.data.category == 1 ? "Fixed Date" : "No Fixed Date");
                }
            }
        });
    }

    $('#btnClose').on('click', function() {
        window.location.reload();
    });
});