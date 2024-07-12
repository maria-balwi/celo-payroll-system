$(document).ready(function() {

    $('#leaveTable').DataTable();

    $('#dropdownButton').on('click', function() {
        $('#dropdownMenu').toggleClass('hidden');
    });

    // Close the dropdown if the user clicks outside of it
    $(document).on('click', function(event) {
        if (!$(event.target).closest('#dropdownButton').length && !$(event.target).closest('#dropdownMenu').length) {
        $('#dropdownMenu').addClass('hidden');
        }
    });

    // // FILE REQUEST BUTTON
    // $("#btnFileRequest").click(function (e) {

    //     e.preventDefault();
        
    //     Swal.fire({
    //         icon: 'question',
    //         title: 'Submit File Leave',
    //         text: 'Are you sure you want to file this leave?',
    //         showCancelButton: true,
    //         cancelButtonColor: '#6c757d',
    //         confirmButtonColor: '#28a745',
    //         confirmButtonText: 'Yes',
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             Swal.fire({
    //                 icon: 'success',
    //                 title: 'Success',
    //                 text: 'Leave Filed Successfully',
    //                 timer: 2000,
    //                 showConfirmButton: false,
    //             }).then(() => {
    //                 window.location.reload();
    //             })
    //         }
    //     })

    // });

    // FILE A LEAVE BUTTON
    $("#fileLeaveForm").submit(function (e) {

        e.preventDefault();

        let fileLeaveForm = new FormData();
        var employeeID = $('#employeeID').val();
        var leaveType = $('#leaveType').val();
        var startDate = $('#effectivityStartDate').val();
        var endDate = $('#effectivityEndDate').val();
        var purpose = $('#purpose').val();

        if (employeeID == "" || leaveType == "" || startDate == "" || endDate == "" || purpose == "") {
            Swal.fire({
                icon: 'warning',
                title: 'Required Information',
                text: 'Please fill up all the required Information',
            })
        } else {
            Swal.fire({
                icon: 'question',
                title: 'Submit File Leave',
                text: 'Are you sure you want to file this leave?',
                showCancelButton: true,
                cancelButtonColor: '#6c757d',
                confirmButtonColor: '#28a745',
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed) {
                    fileLeaveForm.append("employeeID", employeeID);
                    fileLeaveForm.append("leaveType", leaveType);
                    fileLeaveForm.append("startDate", startDate);
                    fileLeaveForm.append("endDate", endDate);
                    fileLeaveForm.append("purpose", purpose);

                    $.ajax({
                        type: "POST",
                        url: "../backend/user/fileLeave.php",
                        data: fileLeaveForm,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Leave Filed Successfully',
                                timer: 2000,
                                showConfirmButton: false,
                            }).then(() => {
                                // window.location.reload();
                            })
                        }
                    })
                }
            })
        }
    })

    // VIEW LEAVE APPLICATION
    var array = [];
    $(document).on('click', '.leaveView', function() {
        var leave_id = $(this).data('id');
        array.push(leave_id);
        var id_leave = array[array.length - 1];

        // VIEW LEAVE
        $.ajax({
            type: "GET",
            url: "../backend/admin/leaveModal.php?leave_id=" + id_leave,
            success: function(response) {

                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } 
                // LEAVE ALREADY APPROVED
                else if (res.status == 200 && (res.data.status == "Approved" || res.data.status == "Disapproved")) {
                    $('#viewLeaveID').val(res.data.requestID);
                    $('#viewEmpID').val(res.data.employeeID);
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewName').val(res.data.employeeName);
                    $('#viewLeaveType').val(res.data.leaveType);
                    // $('#viewInclusiveDates').val(res.data.effectivityStartDate+' - '+res.data.effectivityEndDate);
                    $('#viewStartDate').val(res.data.effectivityStartDate);
                    $('#viewEndDate').val(res.data.effectivityEndDate);
                    $('#viewPurpose').val(res.data.remarks);
                    $('#viewStatus').val(res.data.status);
                    $('#viewLeaveModal').modal('show');
                }
                else if (res.status == 200 && res.data.status == "Pending") {
                    $('#viewLeaveID').val(res.data.requestID);
                    $('#viewEmpID').val(res.data.employeeID);
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewName').val(res.data.employeeName);
                    $('#viewLeaveType').val(res.data.leaveType);
                    // $('#viewInclusiveDates').val(res.data.effectivityStartDate+' - '+res.data.effectivityEndDate);
                    $('#viewStartDate').val(res.data.effectivityStartDate);
                    $('#viewEndDate').val(res.data.effectivityEndDate);
                    $('#viewPurpose').val(res.data.remarks);
                    $('#viewStatus').val(res.data.status);
                    $('#viewLeaveModal').modal('show');
                }
            }
        });

    });
    
});