$(document).ready(function() {

    $('#overtimeTable').DataTable();

    // FILE OT BUTTON
    $("#fileOTform").submit(function (e) {

        e.preventDefault();

        // let fileOT = new FormData();
        var otDate = $('#otDate').val();
        var actualOThours = $('#actualOThours').val();
        var actualOTmins = $('#actualOTmins').val();
        var purpose = $('#purpose').val();

        if (otDate == "" || actualOThours == "" || actualOTmins == "" || purpose == "") {
            Swal.fire({
                icon: 'warning',
                title: 'Required Information',
                text: 'Please fill up all the required Information',
            })
        } else {
            Swal.fire({
                icon: 'question',
                title: 'File Overtime Form',
                text: 'Are you sure you want to file overtime?',
                showCancelButton: true,
                cancelButtonColor: '#6c757d',
                confirmButtonColor: '#28a745',
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed) {
                    // fileOT.append('otDate', otDate);
                    // fileOT.append('actualOThours', actualOThours);
                    // fileOT.append('actualOTmins', actualOTmins);
                    // fileOT.append('purpose', purpose);

                    $.ajax({
                        type: "POST",
                        url: "../backend/user/fileOT.php",
                        data: $(this).serialize(),
                        cache: false,
                        // data: fileOT,
                        // processData: false,
                        // contentType: false,
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
                                    // window.location.reload();
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