$(document).ready(function() {

    $('#changeShiftTable').DataTable();

    // FILE REQUEST BUTTON
    $("#fileRequestForm").submit(function (e) {

        e.preventDefault();

        let requestForm = new FormData();
        var employeeID = $('#employeeID').val();
        var newShift = $('#newShift').val();
        var startDate = $('#effectivityStartDate').val();
        var endDate = $('#effectivityEndDate').val();
        var purpose = $('#purpose').val();

        if (employeeID == "" || newShift == "" || startDate == "" || endDate == "" || purpose == "") {
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
                    requestForm.append("employeeID", employeeID);
                    requestForm.append("newShift", newShift);
                    requestForm.append("startDate", startDate);
                    requestForm.append("endDate", endDate);
                    requestForm.append("purpose", purpose);

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
                    // $('#viewInclusiveDates').val(res.data.effectivityStartDate+' - '+res.data.effectivityEndDate);
                    $('#viewStartDate').val(res.data.effectivityStartDate);
                    $('#viewEndDate').val(res.data.effectivityEndDate);
                    $('#viewPurpose').val(res.data.remarks);
                    $('#viewStatus').val(res.data.status);
                    $('#viewRequestModal').modal('show');
                }
            }
        });

    });
    
});