$(document).ready(function() {

    $('#changeShiftTable').DataTable();

    $('#dropdownButton').on('click', function() {
        $('#dropdownMenu').toggleClass('hidden');
    });

    // Close the dropdown if the user clicks outside of it
    $(document).on('click', function(event) {
        if (!$(event.target).closest('#dropdownButton').length && !$(event.target).closest('#dropdownMenu').length) {
        $('#dropdownMenu').addClass('hidden');
        }
    });

    // VIEW CHANGE SHIFT REQUEST
    var array = [];
    $(document).on('click', '.changeshiftView', function() {
        var changeshift_id = $(this).data('id');
        array.push(changeshift_id);
        var id_changeshift = array[array.length - 1];

        // VIEW CHANGE SHIFT REQUEST
        $.ajax({
            type: "GET",
            url: "../backend/admin/changeShiftModal.php?changeshift_id=" + id_changeshift,
            success: function(response) {

                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } 
                // EMPLOYEE
                else if (res.status == 200 && (res.data.status == "Approved" || res.data.status == "Disapproved")) {
                    $('#viewLeaveID').val(res.data.requestID);
                    $('#viewEmpID').val(res.data.employeeID);
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewName').val(res.data.employeeName);
                    $('#viewCurrentShift').val(res.data.currentShift);
                    $('#viewRequestedShift').val(res.data.requestedShift);
                    $('#viewLeaveType').val(res.data.leaveType);
                    $('#viewStartDate').val(res.data.effectivityStartDate);
                    $('#viewEndDate').val(res.data.effectivityEndDate);
                    $('#viewPurpose').val(res.data.remarks);
                    $('#viewStatus').val(res.data.status);
                    $('#approveChangeShift').hide();
                    $('#disapproveChangeShift').hide();
                    $('#viewChangeShiftModal').modal('show');
                }
                else if (res.status == 200 && res.data.status == "Pending") {
                    $('#viewLeaveID').val(res.data.requestID);
                    $('#viewEmpID').val(res.data.employeeID);
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewName').val(res.data.employeeName);
                    $('#viewCurrentShift').val(res.data.currentShift);
                    $('#viewRequestedShift').val(res.data.requestedShift);
                    $('#viewLeaveType').val(res.data.leaveType);
                    $('#viewStartDate').val(res.data.effectivityStartDate);
                    $('#viewEndDate').val(res.data.effectivityEndDate);
                    $('#viewPurpose').val(res.data.remarks);
                    $('#viewStatus').val(res.data.status);
                    $('#viewChangeShiftModal').modal('show');
                }
            }
        });

        // APPROVE CHANGE SHIFT REQUEST
        $(document).on('click', '.approveChangeShift', function() {
            var id_changeshift = array[array.length - 1];

            $.ajax({
                type: "GET",
                url: "../backend/admin/changeShiftModal.php?changeshift_id=" + id_changeshift,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {
                        alert(res.message);
                    } else if (res.status == 200) {

                        Swal.fire({
                            icon: 'question',
                            title: 'Approve Change Shift Request',
                            text: 'Are you sure you want to approve this request?',
                            showCancelButton: true,
                            cancelButtonColor: '#6c757d',
                            confirmButtonColor: '#28a745',
                            confirmButtonText: 'Yes',

                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "../backend/admin/changeShiftAction.php",
                                    type: 'POST',
                                    data: {
                                        id_changeshift: id_changeshift,
                                        action: 'approve'
                                    },
                                    cache: false,
                                    success: function(data) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success',
                                            text: 'Change shift request has been approved!',
                                            timer: 2000,
                                            showConfirmButton: false,
                                        }).then(() => {
                                            // window.location.reload();
                                            updateChangeShiftModal(id_changeshift);
                                        })
                                    }
                                })
                            }
                        })
                    }
                }
            });
        })

        // DISAPPROVE CHANGE SHIFT REQUEST
        $(document).on('click', '.disapproveChangeShift', function() {
            var id_changeshift = array[array.length - 1];

            $.ajax({
                type: "GET",
                url: "../backend/admin/changeShiftModal.php?changeshift_id=" + id_changeshift,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {
                        alert(res.message);
                    } else if (res.status == 200) {

                        Swal.fire({
                            icon: 'question',
                            title: 'Disapprove Change Shift Request',
                            text: 'Are you sure you want to disapprove this request?',
                            showCancelButton: true,
                            cancelButtonColor: '#6c757d',
                            confirmButtonColor: '#28a745',
                            confirmButtonText: 'Yes',

                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "../backend/admin/changeShiftAction.php",
                                    type: 'POST',
                                    data: {
                                        id_changeshift: id_changeshift,
                                        action: 'disapprove'
                                    },
                                    cache: false,
                                    success: function(data) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success',
                                            text: 'Change Shift request has been disapproved!',
                                            timer: 2000,
                                            showConfirmButton: false,
                                        }).then(() => {
                                            // window.location.reload();
                                            updateChangeShiftModal(id_changeshift);
                                        })
                                    }
                                })
                            }
                        })
                    }
                }
            });
        })
    });

    function updateChangeShiftModal(id_changeshift) {
        $.ajax({
            type: "GET",
            url: "../backend/admin/changeShiftModal.php?changeshift_id=" + id_changeshift,
            success: function(response) {

                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } 
                // EMPLOYEE
                else if (res.status == 200 && (res.data.status == "Approved" || res.data.status == "Disapproved")) {
                    $('#viewLeaveID').val(res.data.requestID);
                    $('#viewEmpID').val(res.data.employeeID);
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewName').val(res.data.employeeName);
                    $('#viewCurrentShift').val(res.data.currentShift);
                    $('#viewRequestedShift').val(res.data.requestedShift);
                    $('#viewLeaveType').val(res.data.leaveType);
                    $('#viewStartDate').val(res.data.effectivityStartDate);
                    $('#viewEndDate').val(res.data.effectivityEndDate);
                    $('#viewPurpose').val(res.data.remarks);
                    $('#viewStatus').val(res.data.status);
                    $('#approveChangeShift').hide();
                    $('#disapproveChangeShift').hide();
                    $('#viewChangeShiftModal').modal('show');
                }
                else if (res.status == 200 && res.data.status == "Pending") {
                    $('#viewLeaveID').val(res.data.requestID);
                    $('#viewEmpID').val(res.data.employeeID);
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewName').val(res.data.employeeName);
                    $('#viewCurrentShift').val(res.data.currentShift);
                    $('#viewRequestedShift').val(res.data.requestedShift);
                    $('#viewLeaveType').val(res.data.leaveType);
                    $('#viewStartDate').val(res.data.effectivityStartDate);
                    $('#viewEndDate').val(res.data.effectivityEndDate);
                    $('#viewPurpose').val(res.data.remarks);
                    $('#viewStatus').val(res.data.status);
                    $('#viewChangeShiftModal').modal('show');
                }
            }
        });

        $('#btnClose').on('click', function() {
            window.location.reload();
        });
    }
});