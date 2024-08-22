$(document).ready(function() {

    $('#allowancesTable').DataTable();
    
    // ADD ALLOWANCE
    $("#addAllowanceForm").submit(function (e) {

        e.preventDefault();

        var allowanceName = $("#allowanceName").val();

        if (allowanceName == '') {
            Swal.fire({
                icon: 'warning',
                title: 'Required Information',
                text: 'Please fill up all the required Information',
            })
        } else {
            Swal.fire({
                icon: 'question',
                title: 'Add Allowance',
                text: 'Are you sure you want to add this allowance?',
                showCancelButton: true,
                cancelButtonColor: '#6c757d',
                confirmButtonColor: '#28a745',
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: "POST",
                        url: "../backend/admin/addAllowance.php",
                        data: $(this).serialize(),
                        cache: false,
                        success: function (res) {
                            const data = JSON.parse(res);
                            var message = data.em;
                            if (data.error == 0) {
                                var id = data.id;
                                loadAllowanceData(id);
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: message,
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    // window.location.reload();
                                    // Refresh the View Employee Modal with new added data
                                    $('#addAllowanceModal').modal('hide');
                                    $('#viewAllowanceModal').modal('show');
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

    // VIEW AND UPDATE ALLOWANCE
    var array = [];
    $(document).on('click', '.allowanceView', function() {
        var allowance_id = $(this).data('id');
        array.push(allowance_id);
        var id_allowance = array[array.length - 1];

        // VIEW ALLOWANCE
        $.ajax({
            type: "GET",
            url: "../backend/admin/allowanceModal.php?allowance_id=" + id_allowance,
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
                url: "../backend/admin/allowanceModal.php?allowance_id=" + id_allowance,
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
                url: "../backend/admin/allowanceModal.php?allowance_id=" + id_allowance,
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
            url: "../backend/admin/allowanceModal.php?allowance_id=" + id_allowance,
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

    $('#btnClose').on('click', function() {
        window.location.reload();
    });
});