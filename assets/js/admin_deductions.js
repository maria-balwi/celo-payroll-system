$(document).ready(function() {

    var deductionsTable = $('#deductionsTable').DataTable();
    deductionsTable.order([[0, "desc"]]).draw();
    
    // ADD DEDUCTION
    $("#addDeductionForm").submit(function (e) {

        e.preventDefault();

        var deductionName = $("#deductionName").val();
        var deductionAmount = $("#deductionAmount").val();

        if (deductionName == '' || deductionAmount == '') {
            Swal.fire({
                icon: 'warning',
                title: 'Required Information',
                text: 'Please fill up all the required Information',
            })
        } else {
            Swal.fire({
                icon: 'question',
                title: 'Add Employee',
                text: 'Are you sure you want to add this employee?',
                showCancelButton: true,
                cancelButtonColor: '#6c757d',
                confirmButtonColor: '#28a745',
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: "POST",
                        url: "../backend/admin/addDeduction.php",
                        data: $(this).serialize(),
                        cache: false,
                        success: function (res) {
                            const data = JSON.parse(res);
                            var message = data.em;
                            if (data.error == 0) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: message,
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    window.location.reload();
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

    // VIEW AND UPDATE DEDUCTION
    var array = [];
    $(document).on('click', '.deductionView', function() {
        var deduction_id = $(this).data('id');
        array.push(deduction_id);
        var id_deduction = array[array.length - 1];

        // VIEW EMPLOYEE
        $.ajax({
            type: "GET",
            url: "../backend/admin/deductionModal.php?deduction_id=" + id_deduction,
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

        // UPDATE EMPLOYEE
        $(document).on('click', '.deductionUpdate', function() {
            $('#viewDeductionModal').modal('hide');
            var id_deduction = array[array.length - 1];

            $.ajax({
                type: "GET",
                url: "../backend/admin/deductionModal.php?deduction_id=" + id_deduction,
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
                                    window.location.reload();
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
});