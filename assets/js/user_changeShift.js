$(document).ready(function() {

    $('#changeShiftTable').DataTable({
        order: [] // Disable default sorting
    });

    // FILE REQUEST BUTTON
    $("#fileRequestForm").submit(function (e) {

        e.preventDefault();

        let requestForm = new FormData(this);
        var newShift = $('#newShift').val();
        // var startDate = $('#effectivityStartDate').val();
        // var endDate = $('#effectivityEndDate').val();
        var purpose = $('#purpose').val();

        if (newShift == "" || purpose == "") {
            Swal.fire({
                icon: 'warning',
                title: 'Required Information',
                text: 'Please fill up all the required Information',
            })
        } else {
            Swal.fire({
                icon: 'question',
                title: 'Submit Change Shift Request',
                text: 'Are you sure you want to change your shift?',
                showCancelButton: true,
                cancelButtonColor: '#6c757d',
                confirmButtonColor: '#28a745',
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "../backend/user/fileRequest.php",
                        data: requestForm,
                        processData: false,
                        contentType: false,
                        success: function (res) {
                            const data = JSON.parse(res);
                            var message = data.em
                            if (data.error == 0) {
                                var id = data.id;
                                loadEmployeeData(id);
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: message,
                                    timer: 2000,
                                    showConfirmButton: false,
                                }).then(() => {
                                    // window.location.reload();
                                    $('#fileRequestModal').modal('hide');
                                    $('#viewRequestModal').modal('show');
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: message,
                                })
                            }
                        }
                    });
                }
            });
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
            url: "../backend/user/changeShiftModal.php?changeshift_id=" + id_changeshift,
            success: function(response) {

                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } 
                else if (res.status == 200) {
                    $('#viewLeaveID').val(res.data.requestID);
                    $('#viewEmpID').val(res.data.employeeID);
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewName').val(res.data.employeeName);
                    $('#viewRequestedShift').val(res.data.requestedShift);
                    $('#viewPurpose').val(res.data.remarks);
                    $('#viewStatus').val(res.data.status);
                    $('#viewRequestModal').modal('show');
                }
            }
        });
    });
    
    function loadEmployeeData(changeshift_id) {
        $.ajax({
            type: "GET",
            url: "../backend/user/changeShiftModal.php?changeshift_id=" + changeshift_id,
            success: function(response) {

                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } 
                else if (res.status == 200) {
                    $('#viewLeaveID').val(res.data.requestID);
                    $('#viewEmpID').val(res.data.employeeID);
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewName').val(res.data.employeeName);
                    $('#viewRequestedShift').val(res.data.requestedShift);
                    $('#viewPurpose').val(res.data.remarks);
                    $('#viewStatus').val(res.data.status);
                }
            }
        });

        $('#btnClose').on('click', function() {
            window.location.reload();
        });
    }
});