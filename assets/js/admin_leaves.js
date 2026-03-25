$(document).ready(function() {

    $('#leavesTable').DataTable({
        order: [] // Disable default sorting
    });

    $('#approveLeave').hide();
    $('#disapproveLeave').hide();

    // VIEW LEAVE APPLICATION
    var array = [];
    $(document).on('click', '.leaveView', function() {
        var leave_id = $(this).data('id');
        var designationID = $(this).data('designation');
        console.log({designationID});
        array.push(leave_id);
        var id_leave = array[array.length - 1];

        // VIEW LEAVE
        $.ajax({
            type: "GET",
            url: "../backend/admin/leaveModal.php?leave_id=" + id_leave + "&designationID=" + designationID,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                var userDept = $('#userDept').val();

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
                    if (res.data.isPaid == 1 && res.data.status == "Approved") {
                        $('#viewStatus').val(res.data.status + ' (Paid)');
                    }
                    else if (res.data.isPaid == 0 && res.data.status == "Approved") {
                        $('#viewStatus').val(res.data.status + ' (Unpaid)');
                    }
                    $('#approveLeave').hide();
                    $('#disapproveLeave').hide();

                    if (res.data.attachment == 1) {
                        $("#viewWithAttachmentRow").show();
                        $("#viewWithoutAttachmentRow").hide();
                    } else if (res.data.attachment == 0) {
                        $("#viewWithAttachmentRow").hide();
                        $("#viewWithoutAttachmentRow").show();
                    } else {
                        $("#viewWithAttachmentRow").hide();
                        $("#viewWithoutAttachmentRow").hide();
                    }
                    $("#viewLeaveModal").modal("show");
                }
                else if (res.status == 200 && (userDept == 3 && res.data.status == "Pending")) {
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

                    if (res.isCheck) {
                        $('#approveLeave').show();
                        $('#disapproveLeave').show();
                    }

                    if (res.data.attachment == 1) {
                        $("#viewWithAttachmentRow").show();
                        $("#viewWithoutAttachmentRow").hide();
                    } else if (res.data.attachment == 0) {
                        $("#viewWithAttachmentRow").hide();
                        $("#viewWithoutAttachmentRow").show();
                    } else {
                        $("#viewWithAttachmentRow").hide();
                        $("#viewWithoutAttachmentRow").hide();
                    }
                    $("#viewLeaveModal").modal("show");
                }
                else if (res.status == 200 && (userDept == 5 && res.data.status == "Pending")) {
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
                    $('#approveLeave').show();
                    $('#disapproveLeave').show();

                    if (res.data.attachment == 1) {
                        $("#viewWithAttachmentRow").show();
                        $("#viewWithoutAttachmentRow").hide();
                    } else if (res.data.attachment == 0) {
                        $("#viewWithAttachmentRow").hide();
                        $("#viewWithoutAttachmentRow").show();
                    } else {
                        $("#viewWithAttachmentRow").hide();
                        $("#viewWithoutAttachmentRow").hide();
                    }
                    $("#viewLeaveModal").modal("show");
                }
            }
        });

        // APPROVE LEAVE APPPLICATION
        $(document).on('click', '.approveLeave', function() {
            var id_leave = array[array.length - 1];

            $.ajax({
                type: "GET",
                url: "../backend/admin/leaveModal.php?leave_id=" + id_leave,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {
                        alert(res.message);
                    } else if (res.status == 200) {

                        Swal.fire({
                            icon: 'question',
                            title: 'Approve Leave Application',
                            text: 'Are you sure you want to approve this leave application?',
                            showDenyButton: true,
                            showCancelButton: true,

                            confirmButtonColor: '#28a745',
                            denyButtonColor: '#d4ba24',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Yes - Paid Leave',
                            denyButtonText: 'Yes - Unpaid Leave',
                            cancelButtonText: 'Cancel',

                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "../backend/admin/leaveAction.php",
                                    type: 'POST',
                                    data: {
                                        id_leave: id_leave,
                                        action: 'approve', 
                                        isPaid: 1
                                    },
                                    cache: false,
                                    success: function(data) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success',
                                            text: 'Leave application has been approved!',
                                            timer: 2000,
                                            showConfirmButton: false,
                                        }).then(() => {
                                            updateLeaveModal(id_leave, designationID);
                                        })
                                    }
                                })
                            }
                            else if (result.isDenied) {
                                $.ajax({
                                    url: "../backend/admin/leaveAction.php",
                                    type: 'POST',
                                    data: {
                                        id_leave: id_leave,
                                        action: 'approve',
                                        isPaid: 0
                                    },
                                    cache: false,
                                    success: function(data) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success',
                                            text: 'Leave application has been approved!',
                                            timer: 2000,
                                            showConfirmButton: false,
                                        }).then(() => {
                                            updateLeaveModal(id_leave, designationID);
                                        })
                                    }
                                })
                            }
                        })
                    }
                }
            });
        })

        // DISAPPROVE LEAVE APPPLICATION
        $(document).on('click', '.disapproveLeave', function() {
            var id_leave = array[array.length - 1];

            $.ajax({
                type: "GET",
                url: "../backend/admin/leaveModal.php?leave_id=" + id_leave,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {
                        alert(res.message);
                    } else if (res.status == 200) {

                        Swal.fire({
                            icon: 'question',
                            title: 'Disapprove Leave Application',
                            text: 'Are you sure you want to disapprove this leave application?',
                            showCancelButton: true,
                            cancelButtonColor: '#6c757d',
                            confirmButtonColor: '#28a745',
                            confirmButtonText: 'Yes',

                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "../backend/admin/leaveAction.php",
                                    type: 'POST',
                                    data: {
                                        id_leave: id_leave,
                                        action: 'disapprove'
                                    },
                                    cache: false,
                                    success: function(data) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success',
                                            text: 'Leave application has been disapproved!',
                                            timer: 2000,
                                            showConfirmButton: false,
                                        }).then(() => {
                                            // window.location.reload();
                                            updateLeaveModal(id_leave);
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

    function updateLeaveModal(id_leave, designationID) {
        $.ajax({
            type: "GET",
            url: "../backend/admin/leaveModal.php?leave_id=" + id_leave + "&designationID=" + designationID,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                var userDept = $('#userDept').val();

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
                    if (res.data.isPaid == 1 && res.data.status == "Approved") {
                        $('#viewStatus').val(res.data.status + ' (Paid)');
                    }
                    else if (res.data.isPaid == 0 && res.data.status == "Approved") {
                        $('#viewStatus').val(res.data.status + ' (Unpaid)');
                    }
                    $('#approveLeave').hide();
                    $('#disapproveLeave').hide();

                    if (res.data.attachment == 1) {
                        $("#viewWithAttachmentRow").show();
                        $("#viewWithoutAttachmentRow").hide();
                    } else if (res.data.attachment == 0) {
                        $("#viewWithAttachmentRow").hide();
                        $("#viewWithoutAttachmentRow").show();
                    } else {
                        $("#viewWithAttachmentRow").hide();
                        $("#viewWithoutAttachmentRow").hide();
                    }
                }
                else if (res.status == 200 && (userDept == 3 && res.data.status == "Pending")) {
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

                    if (res.isCheck) {
                        $('#approveLeave').show();
                        $('#disapproveLeave').show();
                    }

                    if (res.data.attachment == 1) {
                        $("#viewWithAttachmentRow").show();
                        $("#viewWithoutAttachmentRow").hide();
                    } else if (res.data.attachment == 0) {
                        $("#viewWithAttachmentRow").hide();
                        $("#viewWithoutAttachmentRow").show();
                    } else {
                        $("#viewWithAttachmentRow").hide();
                        $("#viewWithoutAttachmentRow").hide();
                    }
                }
                else if (res.status == 200 && (userDept == 5 && res.data.status == "Pending")) {
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
                    $('#approveLeave').show();
                    $('#disapproveLeave').show();

                    if (res.data.attachment == 1) {
                        $("#viewWithAttachmentRow").show();
                        $("#viewWithoutAttachmentRow").hide();
                    } else if (res.data.attachment == 0) {
                        $("#viewWithAttachmentRow").hide();
                        $("#viewWithoutAttachmentRow").show();
                    } else {
                        $("#viewWithAttachmentRow").hide();
                        $("#viewWithoutAttachmentRow").hide();
                    }
                }
            }
        });
    }

    $('#btnClose').on('click', function() {
        window.location.reload();
    });
});