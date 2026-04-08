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
            $('.attendanceSection').hide();
            $('.leaveSection').hide();
            $('.remarksSection').show();
        }
    });

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
                url: "../backend/admin/fetchEmployees.php",
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
    
    // ADD DATA
    $("#fileDisputeForm").submit(function (e) {

        e.preventDefault();

        var dataType = $("#dataType").val(); 

        if (dataType == '') {
            Swal.fire({
                icon: 'warning',
                title: 'Required Information',
                text: 'Please fill up all the required Information',
            })
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

                    $.ajax({
                        type: "POST",
                        url: "../backend/admin/disputeAction.php",
                        data: $(this).serialize(),
                        cache: false,
                        success: function (res) {
                            const data = JSON.parse(res);
                            var message = data.em;
                            if (data.error == 0) {
                                var id = data.id;
                                if (dataType == 1) {
                                    loadAllowanceData(id);
                                }
                                else if (dataType == 2) {
                                    loadReimbursementData(id);
                                }
                                else if (dataType == 3) {
                                    loadDeductionData(id);
                                }
                                else if (dataType == 4) {
                                    loadAdjustmentData(id);
                                }
                                else if (dataType == 5) {
                                    loadSalaryAdjustmentData(id);
                                }
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: message,
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    $('#addDataModal').modal('hide');
                                    if (dataType == 1) {
                                        $('#viewAllowanceModal').modal('show');
                                    }
                                    else if (dataType == 2) {
                                        $('#viewReimbursementModal').modal('show');
                                    }
                                    else if (dataType == 3) {
                                        $('#viewDeductionModal').modal('show');
                                    }
                                    else if (dataType == 4) {
                                        $('#viewAdjustmentModal').modal('show');
                                    }
                                    else if (dataType == 5) {
                                        $('#viewSalaryAdjustmentModal').modal('show');
                                    }
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

    $('#btnAllowanceUpdate').hide();
    $('#btnAllowanceDelete').hide();

    // VIEW AND UPDATE ALLOWANCE
    var array = [];
    $(document).on('click', '.allowanceView', function() {
        var allowance_id = $(this).data('id');
        array.push(allowance_id);
        var id_allowance = array[array.length - 1];

        // VIEW ALLOWANCE
        $.ajax({
            type: "GET",
            url: "../backend/admin/adjustmentModal.php?allowance_id=" + id_allowance,
            success: function(response) {

                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } 
                else if (res.status == 200 && (res.data.allowanceName != "Transportation" || res.data.allowanceName != "Communication")) {
                    $('#btnAllowanceUpdate').show();
                    $('#btnAllowanceDelete').show();
                    $('#viewAllowanceID').val(res.data.allowanceID);
                    $('#viewAllowanceName').val(res.data.allowanceName);
                    $('#viewAllowanceModal').modal('show');
                }
                else {
                    $('#viewAllowanceID').val(res.data.allowanceID);
                    $('#viewAllowanceName').val(res.data.allowanceName);
                    $('#viewAllowanceModal').modal('show');
                }
            }
        });

        // UPDATE ALLOWANCE
        $(document).on('click', '.allowanceUpdate', function() {
            $('#viewAllowanceModal').modal('hide');
            var id_allowance = array[array.length - 1];

            $.ajax({
                type: "GET",
                url: "../backend/admin/adjustmentModal.php?allowance_id=" + id_allowance,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {
                        alert(res.message);
                    } 
                    else if (res.status == 200) {
                        $('#updateAllowanceID').val(res.data.allowanceID);
                        $('#updateAllowanceName').val(res.data.allowanceName);
                        $('#updateAllowanceModal').modal('show');
                    }
                }
            });
        })

        // DELETE ALLOWANCE
        $(document).on('click', '.allowanceDelete', function() {
            var id_allowance = array[array.length - 1];

            $.ajax({
                type: "GET",
                url: "../backend/admin/adjustmentModal.php?allowance_id=" + id_allowance,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {
                        alert(res.message);
                    } else if (res.status == 200) {

                        Swal.fire({
                            icon: 'question',
                            title: 'Delete Allowance',
                            text: 'Are you sure you want to delete this allowance?',
                            showCancelButton: true,
                            cancelButtonColor: '#6c757d',
                            confirmButtonColor: '#28a745',
                            confirmButtonText: 'Yes',

                        }).then((result) => {
                            if (result.isConfirmed) {

                                $.ajax({
                                    url: "../backend/admin/deleteAdjustment.php",
                                    type: 'POST',
                                    data: {
                                        id_allowance: id_allowance
                                    },
                                    cache: false,
                                    success: function(data) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success',
                                            text: 'Allowance Deleted Successfully',
                                            timer: 2000,
                                            showConfirmButton: false,
                                        }).then(() => {
                                            window.location.reload();
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


    // UPDATE ALLOWANCE
    $("#updateAllowanceForm").submit(function (e) {
        
        e.preventDefault();

        var updateAllowanceID = $("#updateAllowanceID").val();
        var updateAllowanceName = $("#updateAllowanceName").val();

        if (updateAllowanceName == '') {

            Swal.fire({
                icon: 'warning',
                title: 'Required Information',
                text: 'Please fill up all the required Information',

            })

        } else {
            Swal.fire({
                icon: 'question',
                title: 'Update Allowance Information',
                text: 'Are you sure you want to save the changes you made?',
                showCancelButton: true,
                cancelButtonColor: '#6c757d',
                confirmButtonColor: '#28a745',
                confirmButtonText: 'Yes',

            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: '../backend/admin/updateAdjustment.php',
                        type: 'POST',
                        data: $(this).serialize(),
                        cache: false,
                        success: function(res) {
                            const data = JSON.parse(res);
                            if (data.error == 0) {
                                var message = data.em
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: message,
                                    timer: 2000, 
                                    showConfirmButton: false,
                                }).then(() => {
                                    loadAllowanceData(updateAllowanceID);
                                    $('#updateAllowanceModal').modal('hide');
                                    $('#viewAllowanceModal').modal('show');
                                })
                            } else {
                                var message = data.em
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Warning', 
                                    text: message,
                                })
                            }
                        }
                    })
                }
            })
        }       

    });


    function loadAllowanceData(id_allowance) {
        $.ajax({
            type: "GET",
            url: "../backend/admin/adjustmentModal.php?allowance_id=" + id_allowance,
            success: function(response) {

                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } 
                else if (res.status == 200 && (res.data.allowanceName != "Transportation" || res.data.allowanceName != "Communication")) {
                    $('#btnAllowanceUpdate').show();
                    $('#btnAllowanceDelete').show();
                    $('#viewAllowanceID').val(res.data.allowanceID);
                    $('#viewAllowanceName').val(res.data.allowanceName);
                }
                else {
                    $('#viewAllowanceID').val(res.data.allowanceID);
                    $('#viewAllowanceName').val(res.data.allowanceName);
                }
            }
        });
    }

    $('#btnClose_allowance').on('click', function() {
        window.location.reload();
    });
});