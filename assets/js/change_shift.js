$(document).ready(function() {

    $('#changeShiftTable').DataTable();
    $('#changeShiftTable2').DataTable();

    $('#dropdownButton').on('click', function() {
        $('#dropdownMenu').toggleClass('hidden');
    });

    // Close the dropdown if the user clicks outside of it
    $(document).on('click', function(event) {
        if (!$(event.target).closest('#dropdownButton').length && !$(event.target).closest('#dropdownMenu').length) {
        $('#dropdownMenu').addClass('hidden');
        }
    });

    // FILE REQUEST BUTTON
    $("#fileRequestForm").submit(function (e) {

        e.preventDefault();

        let requestForm = new FormData();
        var newShift = $('#newShift').val();
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();
        var purpose = $('#purpose').val();

        if (newShift == "" || startDate == "" || endDate == "" || purpose == "") {
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
                    requestForm.append("newShift", newShift);
                    requestForm.append("startDate", startDate);
                    requestForm.append("endDate", endDate);
                    requestForm.append("purpose", purpose);

                    $.ajax({
                        type: "POST",
                        url: "../backend/user/addChangeShiftRequest.php",
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
    
});