function formatDate(dateStr) {
    if (!dateStr) return '';

    var dateObj = new Date(dateStr);

    return dateObj.toLocaleDateString("en-US", {
        month: "short",
        day: "2-digit",
        year: "numeric"
    });
}

function formatNumberWithCommas(number) {
    number = parseFloat(number);
    if (isNaN(number)) return "0.00";
    return number.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

$(document).ready(function() {

    // DISABLE DEFAULT SORTING
    $('#pendingAttendanceTable').DataTable({
        order: [] 
    });
    $('#approvedAttendanceTable').DataTable({
        order: [] 
    });
    $('#disapprovedAttendanceTable').DataTable({
        order: [] 
    });
    $('#pendingLeavesTable').DataTable({
        order: [] 
    });
    $('#approvedLeavesTable').DataTable({
        order: [] 
    });
    $('#disapprovedLeavesTable').DataTable({
        order: [] 
    });
    $('#pendingOvertimeTable').DataTable({
        order: [] 
    });
    $('#approvedOvertimeTable').DataTable({
        order: [] 
    });
    $('#disapprovedOvertimeTable').DataTable({
        order: [] 
    });

    // ADD ADJUSTMENT 
    $('.attendanceSection').hide();
    $('.dateFiledSection').hide();
    $('.employeeSection').hide();
    $('.leaveSection').hide();
    $('.overtimeSection').hide();
    $('.remarksSection').hide();

    $('#dataType').change(function() {
        if ($(this).val() == 1) {
            $('.attendanceSection').show();
            $('.dateFiledSection').show();
            $('.employeeSection').show();
            $('.leaveSection').hide();
            $('.overtimeSection').hide();
            $('.remarksSection').show();
        }
        else if ($(this).val() == 2) {
            $('.leaveSection').show();
            $('.dateFiledSection').show();
            $('.employeeSection').show();
            $('.attendanceSection').hide();
            $('.overtimeSection').hide();
            $('.remarksSection').show();
        }
        else {
            $('.overtimeSection').show();
            $('.dateFiledSection').show();
            $('.employeeSection').show();
            $('.attendanceSection').hide();
            $('.leaveSection').hide();
            $('.remarksSection').show();
        }
    });

    $("#viewWithAttachmentRow").hide();
    $("#viewWithoutAttachmentRow").hide();

    $('#employeeID').inputmask('999-999', {
        placeholder: 'XXX-XXX'
    });

    // REFERRAL SECTION - SEARCH EMPLOYEES
    let employeeTypingTimer; // OUTSIDE THE EVENT
    const debounceDelay = 400; // ms

    $("#employeeID").on("input", function() {
        clearTimeout(employeeTypingTimer);

        let employeeID = $(this).val().trim();

        if (employeeID === "") {
            $("#employeeName").val("");
            $("#currentSalary").val("");
            return;
        }

        employeeTypingTimer = setTimeout(function() {
            $.ajax({
                type: "GET",
                url: "../backend/team/fetchEmployees.php",
                data: { employeeID: employeeID },
                success: function (response) {
                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        $("#employeeName").val(res.data.firstName + " " + res.data.lastName);
                        $("#currentSalary").val(formatNumberWithCommas(res.data.basicPay));
                        $("#empID").val(res.data.id);
                    } else {
                        $("#employeeName").val("");
                        $("#currentSalary").val("");
                        $("#empID").val("");
                    }
                },
            });
        }, debounceDelay);
    });

    $('#approveDispute').hide();
    $('#disapproveDispute').hide();

    $("input.attachment[type='checkbox']").on("change", function () {
        const $checkboxes = $("input.attachment[type='checkbox']");
        const checkedCount = $checkboxes.filter(":checked").length;

        if (checkedCount >= 1) {
            // Disable all unchecked boxes
            $checkboxes.not(":checked").prop("disabled", true);
        } else {
            // Re-enable all boxes
            $checkboxes.prop("disabled", false);
        }
    });
    
    // ADD DATA
    $("#fileDisputeForm").submit(function (e) {
        e.preventDefault();

        let fileDispute = new FormData(this);
        var dataType = $("#dataType").val(); 
        var empID = $("#empID").val();
        var action = "fileDispute";

        var attendanceDate_timeIn = $("#attendanceDate_timeIn").val();
        var attendanceTime_timeIn = $("#attendanceTime_timeIn").val();
        var attendanceDate_timeOut = $("#attendanceDate_timeOut").val();
        var attendanceTime_timeOut = $("#attendanceTime_timeOut").val();
        var logTypeID_timeIn = $("#attendanceLogType_timeIn").val();
        var logTypeID_timeOut = $("#attendanceLogType_timeOut").val();

        var leaveType = $("#leaveType").val();
        var leaveStartDate = $("#leaveStartDate").val();
        var leaveEndDate = $("#leaveEndDate").val();
        var withAttachment = $("#withAttachment").val();
        var withoutAttachment = $("#withoutAttachment").val();

        var overtimeOTDate = $("#overtimeOTDate").val();
        var otType = $("#otType").val();
        var overtimeFromTime = $("#overtimeFromTime").val();
        var overtimeToTime = $("#overtimeToTime").val();

        var remarks = $("#remarks").val();

        if (dataType == '') {
            if (dataType == 1 && empID && (attendanceDate_timeIn == '' || attendanceTime_timeIn == '' || logTypeID_timeIn == '' || attendanceDate_timeOut == '' || attendanceTime_timeOut == '' || logTypeID_timeOut == '' || remarks == '')) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Required Information',
                    text: 'Please fill up all the required Information',
                })
            }
            else if (dataType == 2 && empID && (leaveType == '' || leaveStartDate == '' || leaveEndDate == '' || withAttachment == '' || withoutAttachment == '' || remarks == '')) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Required Information',
                    text: 'Please fill up all the required Information',
                })
            }
            else if (dataType == 3 && empID && (overtimeOTDate == '' || otType == '' || overtimeFromTime == '' || overtimeToTime == '' || remarks == '')) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Required Information',
                    text: 'Please fill up all the required Information',
                })
            }
        } else {
            Swal.fire({
                icon: 'question',
                title: 'Add Data',
                text: 'Are you sure you want to file this dispute?',
                showCancelButton: true,
                cancelButtonColor: '#6c757d',
                confirmButtonColor: '#28a745',
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed) {
                    fileDispute.append('dataType', dataType);
                    fileDispute.append('empID', empID);
                    fileDispute.append('remarks', remarks);
                    fileDispute.append('action', action);

                    fileDispute.append('attendanceDate_timeIn', attendanceDate_timeIn);
                    fileDispute.append('attendanceTime_timeIn', attendanceTime_timeIn);
                    fileDispute.append('logTypeID_timeIn', logTypeID_timeIn);
                    fileDispute.append('attendanceDate_timeOut', attendanceDate_timeOut);
                    fileDispute.append('attendanceTime_timeOut', attendanceTime_timeOut);
                    fileDispute.append('logTypeID_timeOut', logTypeID_timeOut);

                    fileDispute.append('leaveType', leaveType);
                    fileDispute.append('leaveStartDate', leaveStartDate);
                    fileDispute.append('leaveEndDate', leaveEndDate);
                    fileDispute.append('withAttachment', withAttachment);
                    fileDispute.append('withoutAttachment', withoutAttachment);

                    fileDispute.append('overtimeOTDate', overtimeOTDate);
                    fileDispute.append('otType', otType);
                    fileDispute.append('overtimeFromTime', overtimeFromTime);
                    fileDispute.append('overtimeToTime', overtimeToTime);

                    $.ajax({
                        type: "POST",
                        url: "../backend/team/disputeAction.php",
                        data: fileDispute,
                        contentType: false,
                        processData: false,
                        success: function (res) {
                            const data = JSON.parse(res);
                            var message = data.em;
                            if (data.error == 0) {
                                var id = data.id;
                                if (dataType == 1) {
                                    loadAttendanceDispute(id);
                                }
                                else if (dataType == 2) {
                                    loadLeaveDispute(id);
                                }
                                else if (dataType == 3) {
                                    loadOvertimeDispute(id);
                                }
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: message,
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    $('#fileDisputeModal').modal('hide');
                                    $('#viewModal').modal('show');
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

    // VIEW AND UPDATE ATTENDANCE DISPUTE
    var array = [];
    $(document).on('click', '.attendanceView', function() {
        var dispute_id = $(this).data('id');
        array.push(dispute_id);
        var id_dispute = array[array.length - 1];

        // VIEW ATTENDANCE DISPUTE
        $.ajax({
            type: "GET",
            url: "../backend/team/disputeModal.php?dispute_id=" + id_dispute,
            success: function(response) {
                var res = jQuery.parseJSON(response);
                var userDept = $('#userDept').val();

                $('.attendanceSection').show();
                $('.dateFiledSection').show();
                $('.employeeSection').show();
                $('.leaveSection').hide();
                $('.overtimeSection').hide();
                $('.remarksSection').show();

                if (res.status == 404) {
                    alert(res.message);
                } 
                else if (res.status == 200 && (res.data.status == "Approved" || res.data.status == "Disapproved")) {
                    $('#viewDisputeID').val(res.data.disputeID);
                    $('#viewDataType').val("Attendance");
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewStatus').val(res.data.status);
                    $('#viewEmployeeID').val(res.data.employeeID);
                    $('#viewEmployeeName').val(res.data.firstName + " " + res.data.lastName);
                    $('#viewAttendanceDate_timeIn').val(res.data.attendanceDate_timeIn);
                    $('#viewAttendanceTime_timeIn').val(res.data.attendanceTime_timeIn);
                    $('#viewAttendanceLogType_timeIn').val(res.data.logTypeID_timeIn == 1 ? 'Time In' : 'Late');
                    $('#viewAttendanceDate_timeOut').val(res.data.attendanceDate_timeOut);
                    $('#viewAttendanceTime_timeOut').val(res.data.attendanceTime_timeOut);
                    $('#viewAttendanceLogType_timeOut').val(res.data.logTypeID_timeOut == 3 ? 'Undertime' : 'Time Out');
                    $('#viewRemarks').val(res.data.remarks);
                    
                    $('#approveDispute').hide();
                    $('#disapproveDispute').hide();

                    $("#viewModal").modal("show");
                }
                else if (res.status == 200 && res.data.status == "Pending") {
                    $('#viewDisputeID').val(res.data.disputeID);
                    $('#viewDataType').val("Attendance");
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewStatus').val(res.data.status);
                    $('#viewEmployeeID').val(res.data.employeeID);
                    $('#viewEmployeeName').val(res.data.firstName + " " + res.data.lastName);
                    $('#viewAttendanceDate_timeIn').val(res.data.attendanceDate_timeIn);
                    $('#viewAttendanceTime_timeIn').val(res.data.attendanceTime_timeIn);
                    $('#viewAttendanceLogType_timeIn').val(res.data.logTypeID_timeIn == 1 ? 'Time In' : 'Late');
                    $('#viewAttendanceDate_timeOut').val(res.data.attendanceDate_timeOut);
                    $('#viewAttendanceTime_timeOut').val(res.data.attendanceTime_timeOut);
                    $('#viewAttendanceLogType_timeOut').val(res.data.logTypeID_timeOut == 3 ? 'Undertime' : 'Time Out');
                    $('#viewRemarks').val(res.data.remarks);
                    
                    $('#approveDispute').show();
                    $('#disapproveDispute').show();

                    $("#viewModal").modal("show");
                }
            }
        });

        // APPROVE ATTENDANCE DISPUTE
        $(document).on('click', '.approveDispute', function() {
            var id_dispute = array[array.length - 1];

            $.ajax({
                type: "GET",
                url: "../backend/team/disputeModal.php?dispute_id=" + id_dispute,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {
                        alert(res.message);
                    } else if (res.status == 200) {

                        Swal.fire({
                            icon: 'question',
                            title: 'Approve Attendance Dispute',
                            text: 'Are you sure you want to approve this attendance dispute?',
                            showCancelButton: true,

                            confirmButtonColor: '#28a745',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'Cancel',

                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "../backend/team/disputeAction.php",
                                    type: 'POST',
                                    data: {
                                        id_dispute: id_dispute,
                                        type: 'attendance',
                                        action: 'approve'
                                    },
                                    cache: false,
                                    success: function(data) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success',
                                            text: 'Attendance dispute has been approved!',
                                            timer: 2000,
                                            showConfirmButton: false,
                                        }).then(() => {
                                            loadAttendanceDispute(id_dispute);
                                            $("#viewModal").modal("show");
                                        })
                                    }
                                })
                            }
                        })
                    }
                }
            });
        })

        // DISAPPROVE ATTENDANCE DISPUTE
        $(document).on('click', '.disapproveDispute', function() {
            var id_dispute = array[array.length - 1];

            $.ajax({
                type: "GET",
                url: "../backend/team/disputeModal.php?dispute_id=" + id_dispute,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {
                        alert(res.message);
                    } else if (res.status == 200) {

                        Swal.fire({
                            icon: 'question',
                            title: 'Disapprove Attendance Dispute',
                            text: 'Are you sure you want to disapprove this attendance dispute?',
                            showCancelButton: true,
                            cancelButtonColor: '#6c757d',
                            confirmButtonColor: '#28a745',
                            confirmButtonText: 'Yes',

                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "../backend/team/disputeAction.php",
                                    type: 'POST',
                                    data: {
                                        id_dispute: id_dispute,
                                        type: 'attendance',
                                        action: 'disapprove'
                                    },
                                    cache: false,
                                    success: function(data) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success',
                                            text: 'Attendance Dispute has been disapproved!',
                                            timer: 2000,
                                            showConfirmButton: false,
                                        }).then(() => {
                                            loadAttendanceDispute(id_dispute);
                                            $("#viewModal").modal("show");
                                        })
                                    }
                                })
                            }
                        })
                    }
                }
            });
        })

        // // UPDATE ATTENDANCE
        // $(document).on('click', '.allowanceUpdate', function() {
        //     $('#viewAllowanceModal').modal('hide');
        //     var id_allowance = array[array.length - 1];

        //     $.ajax({
        //         type: "GET",
        //         url: "../backend/team/adjustmentModal.php?allowance_id=" + id_allowance,
        //         success: function(response) {

        //             var res = jQuery.parseJSON(response);
        //             if (res.status == 404) {
        //                 alert(res.message);
        //             } 
        //             else if (res.status == 200) {
        //                 $('#updateAllowanceID').val(res.data.allowanceID);
        //                 $('#updateAllowanceName').val(res.data.allowanceName);
        //                 $('#updateAllowanceModal').modal('show');
        //             }
        //         }
        //     });
        // })

        // // DELETE ATTENDANCE
        // $(document).on('click', '.allowanceDelete', function() {
        //     var id_allowance = array[array.length - 1];

        //     $.ajax({
        //         type: "GET",
        //         url: "../backend/team/adjustmentModal.php?allowance_id=" + id_allowance,
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
        //                             url: "../backend/team/deleteAdjustment.php",
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

    // VIEW AND UPDATE LEAVE DISPUTE
    var array = [];
    $(document).on('click', '.leaveView', function() {
        var dispute_id = $(this).data('id');
        array.push(dispute_id);
        var id_dispute = array[array.length - 1];

        // VIEW LEAVE DISPUTE
        $.ajax({
            type: "GET",
            url: "../backend/team/disputeModal.php?dispute_id=" + id_dispute,
            success: function(response) {
                var res = jQuery.parseJSON(response);
                var userDept = $('#userDept').val();

                $('.leaveSection').show();
                $('.dateFiledSection').show();
                $('.employeeSection').show();
                $('.attendanceSection').hide();
                $('.overtimeSection').hide();
                $('.remarksSection').show();

                if (res.status == 404) {
                    alert(res.message);
                } 
                else if (res.status == 200 && (res.data.status == "Approved" || res.data.status == "Disapproved")) {
                    $('#viewDisputeID').val(res.data.disputeID);
                    $('#viewDataType').val("Leave");
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewEmployeeID').val(res.data.employeeID);
                    $('#viewEmployeeName').val(res.data.firstName + " " + res.data.lastName);
                    $('#viewLeaveType').val(res.data.leaveType);
                    $('#viewLeaveStartDate').val(res.data.startDate);
                    $('#viewLeaveEndDate').val(res.data.endDate);
                    $('#viewRemarks').val(res.data.remarks);
                    $('#viewStatus').val(res.data.status);
                    
                    $('#approveDispute').hide();
                    $('#disapproveDispute').hide();

                    if (res.data.attachment == 1) {
                        $("#viewWithAttachmentRow").show();
                        $("#viewWithoutAttachmentRow").hide();
                    } else if (res.data.attachment == 0) {
                        $("#viewWithAttachment").hide();
                        $("#viewWithoutAttachment").show();
                    } else {
                        $("#viewWithAttachment").hide();
                        $("#viewWithoutAttachment").hide();
                    }
                    $("#viewModal").modal("show");
                }
                else if (res.status == 200 && res.data.status == "Pending") {
                    $('#viewDisputeID').val(res.data.disputeID);
                    $('#viewDataType').val("Leave");
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewStatus').val(res.data.status);
                    $('#viewEmployeeID').val(res.data.employeeID);
                    $('#viewEmployeeName').val(res.data.firstName + " " + res.data.lastName);
                    $('#viewLeaveType').val(res.data.leaveType);
                    $('#viewLeaveStartDate').val(res.data.startDate);
                    $('#viewLeaveEndDate').val(res.data.endDate);
                    $('#viewRemarks').val(res.data.remarks);

                    $('#approveDispute').show();
                    $('#disapproveDispute').show();
                    
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
                    $("#viewModal").modal("show");
                }
            }
        });

        // APPROVE LEAVE DISPUTE
        $(document).on('click', '.approveDispute', function() {
            var id_dispute = array[array.length - 1];

            $.ajax({
                type: "GET",
                url: "../backend/team/disputeModal.php?dispute_id=" + id_dispute,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {
                        alert(res.message);
                    } else if (res.status == 200) {

                        Swal.fire({
                            icon: 'question',
                            title: 'Approve Attendance Dispute',
                            text: 'Are you sure you want to approve this attendance dispute?',
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
                                    url: "../backend/team/disputeAction.php",
                                    type: 'POST',
                                    data: {
                                        id_dispute: id_dispute,
                                        type: 'leave',
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
                                            loadLeaveDispute(id_dispute);
                                            $("#viewModal").modal("show");
                                        })
                                    }
                                })
                            }
                            else if (result.isDenied) {
                                $.ajax({
                                    url: "../backend/team/disputeAction.php",
                                    type: 'POST',
                                    data: {
                                        id_dispute: id_dispute,
                                        type: 'leave',
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
                                            loadLeaveDispute(id_dispute);
                                            $("#viewModal").modal("show");
                                        })
                                    }
                                })
                            }
                        })
                    }
                }
            });
        })

        // DISAPPROVE LEAVE DISPUTE
        $(document).on('click', '.disapproveDispute', function() {
            var id_dispute = array[array.length - 1];

            $.ajax({
                type: "GET",
                url: "../backend/team/disputeModal.php?dispute_id=" + id_dispute,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {
                        alert(res.message);
                    } else if (res.status == 200) {

                        Swal.fire({
                            icon: 'question',
                            title: 'Disapprove Leave Dispute',
                            text: 'Are you sure you want to disapprove this leave dispute?',
                            showCancelButton: true,
                            cancelButtonColor: '#6c757d',
                            confirmButtonColor: '#28a745',
                            confirmButtonText: 'Yes',

                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "../backend/team/disputeAction.php",
                                    type: 'POST',
                                    data: {
                                        id_dispute: id_dispute,
                                        type: 'leave',
                                        action: 'disapprove'
                                    },
                                    cache: false,
                                    success: function(data) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success',
                                            text: 'Leave dispute has been disapproved!',
                                            timer: 2000,
                                            showConfirmButton: false,
                                        }).then(() => {
                                            loadLeaveDispute(id_dispute);
                                            $("#viewModal").modal("show");
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

    // VIEW AND UPDATE OVERTIME DISPUTE
    var array = [];
    $(document).on('click', '.overtimeView', function() {
        var dispute_id = $(this).data('id');
        array.push(dispute_id);
        var id_dispute = array[array.length - 1];

        // VIEW OVERTIME DISPUTE
        $.ajax({
            type: "GET",
            url: "../backend/team/disputeModal.php?dispute_id=" + id_dispute,
            success: function(response) {
                var res = jQuery.parseJSON(response);
                var userDept = $('#userDept').val();

                $('.overtimeSection').show();
                $('.dateFiledSection').show();
                $('.employeeSection').show();
                $('.attendanceSection').hide();
                $('.leaveSection').hide();
                $('.remarksSection').show();

                if (res.status == 404) {
                    alert(res.message);
                } 
                else if (res.status == 200 && (res.data.status == "Approved" || res.data.status == "Disapproved")) {
                    $('#viewDisputeID').val(res.data.disputeID);
                    $('#viewDataType').val("Overtime");
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewEmployeeID').val(res.data.employeeID);
                    $('#viewEmployeeName').val(res.data.firstName + " " + res.data.lastName);
                    $('#viewOvertimeOTDate').val(res.data.otDate);
                    $('#viewOtType').val(res.data.otType);
                    $('#viewOvertimeFromTime').val(res.data.fromTime);
                    $('#viewOvertimeToTime').val(res.data.toTime);
                    $('#viewRemarks').val(res.data.remarks);
                    $('#viewStatus').val(res.data.status);

                    $('#approveDispute').hide();
                    $('#disapproveDispute').hide();

                    $("#viewModal").modal("show");
                }
                else if (res.status == 200 && res.data.status == "Pending") {
                    $('#viewDisputeID').val(res.data.disputeID);
                    $('#viewDataType').val("Overtime");
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewStatus').val(res.data.status);
                    $('#viewEmployeeID').val(res.data.employeeID);
                    $('#viewEmployeeName').val(res.data.firstName + " " + res.data.lastName);
                    $('#viewOvertimeOTDate').val(res.data.otDate);
                    $('#viewOtType').val(res.data.otType);
                    $('#viewOvertimeFromTime').val(res.data.fromTime);
                    $('#viewOvertimeToTime').val(res.data.toTime);
                    $('#viewRemarks').val(res.data.remarks);
                    
                    $('#approveDispute').show();
                    $('#disapproveDispute').show();

                    $("#viewModal").modal("show");
                }
            }
        });

        // APPROVE OVERTIME DISPUTE
        $(document).on('click', '.approveDispute', function() {
            var id_dispute = array[array.length - 1];

            $.ajax({
                type: "GET",
                url: "../backend/team/disputeModal.php?dispute_id=" + id_dispute,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {
                        alert(res.message);
                    } else if (res.status == 200) {

                        Swal.fire({
                            icon: 'question',
                            title: 'Approve Overtime Dispute',
                            text: 'Are you sure you want to approve this overtime dispute?',
                            showDenyButton: true,
                            showCancelButton: true,

                            confirmButtonColor: '#28a745',
                            denyButtonColor: '#d4ba24',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Yes - Paid Overtime',
                            denyButtonText: 'Yes - Unpaid Overtime',
                            cancelButtonText: 'Cancel',

                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "../backend/team/disputeAction.php",
                                    type: 'POST',
                                    data: {
                                        id_dispute: id_dispute,
                                        type: 'overtime',
                                        action: 'approve', 
                                        isPaid: 1
                                    },
                                    cache: false,
                                    success: function(data) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success',
                                            text: 'Overtime dispute has been approved!',
                                            timer: 2000,
                                            showConfirmButton: false,
                                        }).then(() => {
                                            loadOvertimeDispute(id_dispute);
                                            $("#viewModal").modal("show");
                                        })
                                    }
                                })
                            }
                            else if (result.isDenied) {
                                $.ajax({
                                    url: "../backend/team/disputeAction.php",
                                    type: 'POST',
                                    data: {
                                        id_dispute: id_dispute,
                                        type: 'overtime',
                                        action: 'approve', 
                                        isPaid: 0
                                    },
                                    cache: false,
                                    success: function(data) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success',
                                            text: 'Overtime dispute has been approved!',
                                            timer: 2000,
                                            showConfirmButton: false,
                                        }).then(() => {
                                            loadOvertimeDispute(id_dispute);
                                            $("#viewModal").modal("show");
                                        })
                                    }
                                })
                            }
                        })
                    }
                }
            });
        })

        // DISAPPROVE OVERTIME DISPUTE
        $(document).on('click', '.disapproveDispute', function() {
            var id_dispute = array[array.length - 1];

            $.ajax({
                type: "GET",
                url: "../backend/team/disputeModal.php?dispute_id=" + id_dispute,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {
                        alert(res.message);
                    } else if (res.status == 200) {

                        Swal.fire({
                            icon: 'question',
                            title: 'Disapprove Overtime Dispute',
                            text: 'Are you sure you want to disapprove this overtime dispute?',
                            showCancelButton: true,
                            cancelButtonColor: '#6c757d',
                            confirmButtonColor: '#28a745',
                            confirmButtonText: 'Yes',

                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "../backend/team/disputeAction.php",
                                    type: 'POST',
                                    data: {
                                        id_dispute: id_dispute,
                                        type: 'overtime',
                                        action: 'disapprove'
                                    },
                                    cache: false,
                                    success: function(data) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success',
                                            text: 'Overtime dispute has been disapproved!',
                                            timer: 2000,
                                            showConfirmButton: false,
                                        }).then(() => {
                                            loadOvertimeDispute(id_dispute);
                                            $("#viewModal").modal("show");
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

    // // UPDATE ALLOWANCE
    // $("#updateAllowanceForm").submit(function (e) {
        
    //     e.preventDefault();

    //     var updateAllowanceID = $("#updateAllowanceID").val();
    //     var updateAllowanceName = $("#updateAllowanceName").val();

    //     if (updateAllowanceName == '') {

    //         Swal.fire({
    //             icon: 'warning',
    //             title: 'Required Information',
    //             text: 'Please fill up all the required Information',

    //         })

    //     } else {
    //         Swal.fire({
    //             icon: 'question',
    //             title: 'Update Allowance Information',
    //             text: 'Are you sure you want to save the changes you made?',
    //             showCancelButton: true,
    //             cancelButtonColor: '#6c757d',
    //             confirmButtonColor: '#28a745',
    //             confirmButtonText: 'Yes',

    //         }).then((result) => {
    //             if (result.isConfirmed) {

    //                 $.ajax({
    //                     url: '../backend/team/updateAdjustment.php',
    //                     type: 'POST',
    //                     data: $(this).serialize(),
    //                     cache: false,
    //                     success: function(res) {
    //                         const data = JSON.parse(res);
    //                         if (data.error == 0) {
    //                             var message = data.em
    //                             Swal.fire({
    //                                 icon: 'success',
    //                                 title: 'Success',
    //                                 text: message,
    //                                 timer: 2000, 
    //                                 showConfirmButton: false,
    //                             }).then(() => {
    //                                 loadAllowanceData(updateAllowanceID);
    //                                 $('#updateAllowanceModal').modal('hide');
    //                                 $('#viewAllowanceModal').modal('show');
    //                             })
    //                         } else {
    //                             var message = data.em
    //                             Swal.fire({
    //                                 icon: 'warning',
    //                                 title: 'Warning', 
    //                                 text: message,
    //                             })
    //                         }
    //                     }
    //                 })
    //             }
    //         })
    //     }       

    // });

    function loadAttendanceDispute(id_dispute) {
        $.ajax({
            type: "GET",
            url: "../backend/team/disputeModal.php?dispute_id=" + id_dispute,
            success: function(response) {
                var res = jQuery.parseJSON(response);
                var userDept = $('#userDept').val();

                $('.attendanceSection').show();
                $('.dateFiledSection').show();
                $('.employeeSection').show();
                $('.leaveSection').hide();
                $('.overtimeSection').hide();
                $('.remarksSection').show();

                if (res.status == 404) {
                    alert(res.message);
                } 
                else if (res.status == 200 && (res.data.status == "Approved" || res.data.status == "Disapproved")) {
                    $('#viewDisputeID').val(res.data.disputeID);
                    $('#viewDataType').val("Attendance");
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewStatus').val(res.data.status);
                    $('#viewEmployeeID').val(res.data.employeeID);
                    $('#viewEmployeeName').val(res.data.firstName + " " + res.data.lastName);
                    $('#viewAttendanceDate_timeIn').val(res.data.attendanceDate_timeIn);
                    $('#viewAttendanceTime_timeIn').val(res.data.attendanceTime_timeIn);
                    $('#viewAttendanceLogType_timeIn').val(res.data.logTypeID_timeIn == 1 ? 'Time In' : 'Late');
                    $('#viewAttendanceDate_timeOut').val(res.data.attendanceDate_timeOut);
                    $('#viewAttendanceTime_timeOut').val(res.data.attendanceTime_timeOut);
                    $('#viewAttendanceLogType_timeOut').val(res.data.logTypeID_timeOut == 3 ? 'Undertime' : 'Time Out');
                    $('#viewRemarks').val(res.data.remarks);
                    
                    $('#approveDispute').hide();
                    $('#disapproveDispute').hide();
                }
                else if (res.status == 200 && res.data.status == "Pending") {
                    $('#viewDisputeID').val(res.data.disputeID);
                    $('#viewDataType').val("Attendance");
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewStatus').val(res.data.status);
                    $('#viewEmployeeID').val(res.data.employeeID);
                    $('#viewEmployeeName').val(res.data.firstName + " " + res.data.lastName);
                    $('#viewAttendanceDate_timeIn').val(res.data.attendanceDate_timeIn);
                    $('#viewAttendanceTime_timeIn').val(res.data.attendanceTime_timeIn);
                    $('#viewAttendanceLogType_timeIn').val(res.data.logTypeID_timeIn == 1 ? 'Time In' : 'Late');
                    $('#viewAttendanceDate_timeOut').val(res.data.attendanceDate_timeOut);
                    $('#viewAttendanceTime_timeOut').val(res.data.attendanceTime_timeOut);
                    $('#viewAttendanceLogType_timeOut').val(res.data.logTypeID_timeOut == 3 ? 'Undertime' : 'Time Out');
                    $('#viewRemarks').val(res.data.remarks);
                    
                    $('#approveDispute').show();
                    $('#disapproveDispute').show();
                }
            }
        });
    }

    function loadLeaveDispute(id_dispute) {
        $.ajax({
            type: "GET",
            url: "../backend/team/disputeModal.php?dispute_id=" + id_dispute,
            success: function(response) {
                var res = jQuery.parseJSON(response);
                var userDept = $('#userDept').val();

                $('.leaveSection').show();
                $('.dateFiledSection').show();
                $('.employeeSection').show();
                $('.attendanceSection').hide();
                $('.overtimeSection').hide();
                $('.remarksSection').show();

                if (res.status == 404) {
                    alert(res.message);
                } 
                else if (res.status == 200 && (res.data.status == "Approved" || res.data.status == "Disapproved")) {
                    $('#viewDisputeID').val(res.data.disputeID);
                    $('#viewDataType').val("Leave");
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewEmployeeID').val(res.data.employeeID);
                    $('#viewEmployeeName').val(res.data.firstName + " " + res.data.lastName);
                    $('#viewLeaveType').val(res.data.leaveType);
                    $('#viewLeaveStartDate').val(res.data.startDate);
                    $('#viewLeaveEndDate').val(res.data.endDate);
                    $('#viewRemarks').val(res.data.remarks);
                    $('#viewStatus').val(res.data.status);
                    
                    $('#approveDispute').hide();
                    $('#disapproveDispute').hide();

                    if (res.data.attachment == 1) {
                        $("#viewWithAttachmentRow").show();
                        $("#viewWithoutAttachmentRow").hide();
                    } else if (res.data.attachment == 0) {
                        $("#viewWithAttachment").hide();
                        $("#viewWithoutAttachment").show();
                    } else {
                        $("#viewWithAttachment").hide();
                        $("#viewWithoutAttachment").hide();
                    }
                }
                else if (res.status == 200 && res.data.status == "Pending") {
                    $('#viewDisputeID').val(res.data.disputeID);
                    $('#viewDataType').val("Leave");
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewStatus').val(res.data.status);
                    $('#viewEmployeeID').val(res.data.employeeID);
                    $('#viewEmployeeName').val(res.data.firstName + " " + res.data.lastName);
                    $('#viewLeaveType').val(res.data.leaveType);
                    $('#viewLeaveStartDate').val(res.data.startDate);
                    $('#viewLeaveEndDate').val(res.data.endDate);
                    $('#viewRemarks').val(res.data.remarks);

                    $('#approveDispute').show();
                    $('#disapproveDispute').show();
                    
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

    function loadOvertimeDispute(id_dispute) {
        $.ajax({
            type: "GET",
            url: "../backend/team/disputeModal.php?dispute_id=" + id_dispute,
            success: function(response) {
                var res = jQuery.parseJSON(response);
                var userDept = $('#userDept').val();

                $('.overtimeSection').show();
                $('.dateFiledSection').show();
                $('.employeeSection').show();
                $('.attendanceSection').hide();
                $('.leaveSection').hide();
                $('.remarksSection').show();

                if (res.status == 404) {
                    alert(res.message);
                } 
                else if (res.status == 200 && (res.data.status == "Approved" || res.data.status == "Disapproved")) {
                    $('#viewDisputeID').val(res.data.disputeID);
                    $('#viewDataType').val("Overtime");
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewEmployeeID').val(res.data.employeeID);
                    $('#viewEmployeeName').val(res.data.firstName + " " + res.data.lastName);
                    $('#viewOvertimeOTDate').val(res.data.otDate);
                    $('#viewOtType').val(res.data.otType);
                    $('#viewOvertimeFromTime').val(res.data.fromTime);
                    $('#viewOvertimeToTime').val(res.data.toTime);
                    $('#viewRemarks').val(res.data.remarks);
                    $('#viewStatus').val(res.data.status);

                    $('#approveDispute').hide();
                    $('#disapproveDispute').hide();
                }
                else if (res.status == 200 && res.data.status == "Pending") {
                    $('#viewDisputeID').val(res.data.disputeID);
                    $('#viewDataType').val("Overtime");
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewStatus').val(res.data.status);
                    $('#viewEmployeeID').val(res.data.employeeID);
                    $('#viewEmployeeName').val(res.data.firstName + " " + res.data.lastName);
                    $('#viewOvertimeOTDate').val(res.data.otDate);
                    $('#viewOtType').val(res.data.otType);
                    $('#viewOvertimeFromTime').val(res.data.fromTime);
                    $('#viewOvertimeToTime').val(res.data.toTime);
                    $('#viewRemarks').val(res.data.remarks);
                    
                    $('#approveDispute').show();
                    $('#disapproveDispute').show();
                }
            }
        });
    }

    $('#btnClose').on('click', function() {
        window.location.reload();
    });
});