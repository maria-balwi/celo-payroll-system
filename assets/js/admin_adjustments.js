$(document).ready(function() {

    $('#allowancesTable').DataTable();
    $('#reimbursementsTable').DataTable();
    $('#deductionsTable').DataTable();
    $('#adjustmentsTable').DataTable();

    // ADD ADJUSTMENT 
    $('#adjustmentLabel').hide();
    $('#adjustment').hide();

    $('#dataType').change(function() {
        if ($(this).val() == 4) {
            $('#adjustmentLabel').show();
            $('#adjustment').show();
        } else {
            $('#adjustmentLabel').hide();
            $('#adjustment').hide();
        }
    });
    
    // ADD ALLOWANCE
    $("#addDataForm").submit(function (e) {

        e.preventDefault();

        var dataType = $("#dataType").val();
        var name = $("#name").val();

        if (dataType == '' || name == '') {
            Swal.fire({
                icon: 'warning',
                title: 'Required Information',
                text: 'Please fill up all the required Information',
            })
        } else {
            Swal.fire({
                icon: 'question',
                title: 'Add Data',
                text: 'Are you sure you want to add this data?',
                showCancelButton: true,
                cancelButtonColor: '#6c757d',
                confirmButtonColor: '#28a745',
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: "POST",
                        url: "../backend/admin/addAdjustment.php",
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

    // ALLOWANCES SECTION
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
                else if (res.status == 200) {
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
                                    url: "../backend/admin/deleteAllowance.php",
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
                        url: '../backend/admin/updateAllowance.php',
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
                                    // window.location.reload();
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
                else if (res.status == 200) {
                    $('#viewAllowanceID').val(res.data.allowanceID);
                    $('#viewAllowanceName').val(res.data.allowanceName);
                }
            }
        });
    }


    // REIMBURSEMENTS SECTION
    // VIEW AND UPDATE REIMBURSEMENTS
    var array = [];
    $(document).on('click', '.reimbursementView', function() {
        var reimbursement_id = $(this).data('id');
        array.push(reimbursement_id);
        var id_reimbursement = array[array.length - 1];

        // VIEW ALLOWANCE
        $.ajax({
            type: "GET",
            url: "../backend/admin/adjustmentModal.php?reimbursement_id=" + id_reimbursement,
            success: function(response) {

                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } 
                else if (res.status == 200) {
                    $('#viewReimbursementID').val(res.data.reimbursementID);
                    $('#viewReimbursementName').val(res.data.reimbursementName);
                    $('#viewReimbursementModal').modal('show');
                }
            }
        });

        // UPDATE ALLOWANCE
        $(document).on('click', '.reimbursementUpdate', function() {
            $('#viewAllowanceviewReimbursementModalModal').modal('hide');
            var id_reimbursement = array[array.length - 1];

            $.ajax({
                type: "GET",
                url: "../backend/admin/adjustmentModal.php?reimbursement_id=" + id_reimbursement,
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
        $(document).on('click', '.reimbursementDelete', function() {
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
                                    url: "../backend/admin/deleteAllowance.php",
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


    // DEDUCTIONS SECTION
    // VIEW AND UPDATE DEDUCTION
    var array = [];
    $(document).on('click', '.deductionView', function() {
        var deduction_id = $(this).data('id');
        array.push(deduction_id);
        var id_deduction = array[array.length - 1];

        // VIEW DEDUCTION
        $.ajax({
            type: "GET",
            url: "../backend/admin/adjustmentModal.php?deduction_id=" + id_deduction,
            success: function(response) {

                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } 
                else if (res.status == 200) {
                    $('#viewDeductionID').val(res.data.deductionID);
                    $('#viewDeductionName').val(res.data.deductionName);
                    $('#viewDeductionAmount').val(res.data.deductionAmount);
                    $('#viewDeductionModal').modal('show');
                }
            }
        });

        // UPDATE DEDUCTION
        $(document).on('click', '.deductionUpdate', function() {
            $('#viewDeductionModal').modal('hide');
            var id_deduction = array[array.length - 1];

            $.ajax({
                type: "GET",
                url: "../backend/admin/adjustmentModal.php?deduction_id=" + id_deduction,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {
                        alert(res.message);
                    } 
                    else if (res.status == 200) {
                        $('#updateDeductionID').val(res.data.deductionID);
                        $('#updateDeductionName').val(res.data.deductionName);
                        $('#updateDeductionAmount').val(res.data.deductionAmount);
                        $('#updateDeductionModal').modal('show');
                    }
                }
            });
        })

        // DELETE DEDUCTION
        $(document).on('click', '.deductionDelete', function() {
            var id_deduction = array[array.length - 1];

            $.ajax({
                type: "GET",
                url: "../backend/admin/adjustmentModal.php?deduction_id=" + id_deduction,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {
                        alert(res.message);
                    } else if (res.status == 200) {

                        Swal.fire({
                            icon: 'question',
                            title: 'Delete Deduction',
                            text: 'Are you sure you want to delete this deduction?',
                            showCancelButton: true,
                            cancelButtonColor: '#6c757d',
                            confirmButtonColor: '#28a745',
                            confirmButtonText: 'Yes',

                        }).then((result) => {
                            if (result.isConfirmed) {

                                $.ajax({
                                    url: "../backend/admin/deleteDeduction.php",
                                    type: 'POST',
                                    data: {
                                        id_deduction: id_deduction
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

    // UPDATE EMPLOYEE
    $("#updateDeductionForm").submit(function (e) {
        
        e.preventDefault();

        var updateDeductionName = $("#updateDeductionName").val();
        var updateDeductionAmount = $("#updateDeductionAmount").val();

        if (updateDeductionName == '' || updateDeductionAmount == '') {

            Swal.fire({
                icon: 'warning',
                title: 'Required Information',
                text: 'Please fill up all the required Information',

            })

        } else {
            Swal.fire({
                icon: 'question',
                title: 'Update Deduction Information',
                text: 'Are you sure you want to save the changes you made?',
                showCancelButton: true,
                cancelButtonColor: '#6c757d',
                confirmButtonColor: '#28a745',
                confirmButtonText: 'Yes',

            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: '../backend/admin/updateDeduction.php',
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
                                    // window.location.reload();
                                    // Refresh the View Employee Modal with new added data
                                    $('#updateDeductionModal').modal('hide');
                                    $('#viewDeductionModal').modal('show');
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

    function loadDeductionData(id_deduction) {
        $.ajax({
            type: "GET",
            url: "../backend/admin/adjustmentModal.php?deduction_id=" + id_deduction,
            success: function(response) {

                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } 
                else if (res.status == 200) {
                    $('#viewDeductionID').val(res.data.deductionID);
                    $('#viewDeductionName').val(res.data.deductionName);
                    $('#viewDeductionAmount').val(res.data.deductionAmount);
                }
            }
        });
    }


    // ADJUSTMENTS SECTION
    // VIEW AND UPDATE ADJUSTMENTS
    var array = [];
    $(document).on('click', '.adjustmentView', function() {
        var adjustment_id = $(this).data('id');
        array.push(adjustment_id);
        var id_adjustment = array[array.length - 1];

        // VIEW ADJUSTMENTS
        $.ajax({
            type: "GET",
            url: "../backend/admin/adjustmentModal.php?adjustment_id=" + id_adjustment,
            success: function(response) {

                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } 
                else if (res.status == 200) {
                    $('#viewAdjustmentName').val(res.data.adjustmentID);
                    $('#viewAdjustmentName').val(res.data.adjustmentName);
                    $('#viewAdjustmentType').val(res.data.adjustmentType);
                    $('#viewAdjustmentModal').modal('show');
                }
            }
        });

        // UPDATE ADJUSTMENTS
        $(document).on('click', '.adjustmentUpdate', function() {
            $('#viewAdjustmentModal').modal('hide');
            var id_adjustment = array[array.length - 1];

            $.ajax({
                type: "GET",
                url: "../backend/admin/adjustmentModal.php?adjustment_id=" + id_adjustment,
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

        // DELETE ADJUSTMENTS
        $(document).on('click', '.adjustmentUpdate', function() {
            var id_adjustment = array[array.length - 1];

            $.ajax({
                type: "GET",
                url: "../backend/admin/adjustmentModal.php?adjustment_id=" + id_adjustment,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {
                        alert(res.message);
                    } else if (res.status == 200) {

                        Swal.fire({
                            icon: 'question',
                            title: 'Delete Adjustment',
                            text: 'Are you sure you want to delete this adjustment?',
                            showCancelButton: true,
                            cancelButtonColor: '#6c757d',
                            confirmButtonColor: '#28a745',
                            confirmButtonText: 'Yes',

                        }).then((result) => {
                            if (result.isConfirmed) {

                                $.ajax({
                                    url: "../backend/admin/deleteAllowance.php",
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

    $('#btnClose_allowance').on('click', function() {
        window.location.reload();
    });

    $('#btnClose_deduction').on('click', function() {
        window.location.reload();
    });
});