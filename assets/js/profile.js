$(document).ready(function() {

    $('#example').DataTable();

    $('#dropdownButton').on('click', function() {
        $('#dropdownMenu').toggleClass('hidden');
    });

    // Close the dropdown if the user clicks outside of it
    $(document).on('click', function(event) {
        if (!$(event.target).closest('#dropdownButton').length && !$(event.target).closest('#dropdownMenu').length) {
        $('#dropdownMenu').addClass('hidden');
        }
    });

    // CHANGE PASSWORD
    $("#changePasswordForm").submit(function (e) {
        
        e.preventDefault();

        let resetPassword = new FormData();
        var userID = $("#userID").val();
        var currentPassword = $("#currentPassword").val();
        var currentPass = $("#currentPass").val();
        var newPass = $("#newPass").val();
        var retypePass = $("#retypePass").val();

        if (currentPass == '' || newPass == '' || retypePass == '') {

            Swal.fire({
                icon: 'warning',
                title: 'Required Information',
                text: 'Please fill up all the required Information',

            })

        } else {
            Swal.fire({
                icon: 'question',
                title: 'Change Password',
                text: 'Are you sure you want to change your password?',
                showCancelButton: true,
                cancelButtonColor: '#6c757d',
                confirmButtonColor: '#28a745',
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed)
                {
                    resetPassword.append("userID", userID);
                    resetPassword.append("currentPassword", currentPassword);
                    resetPassword.append("currentPass", currentPass);
                    resetPassword.append("newPass", newPass);
                    resetPassword.append("retypePass", retypePass);

                    $.ajax({
                        url: '../backend/profile/changePassword.php',
                        type: 'POST',
                        data: resetPassword,
                        contentType: false,
                        processData: false,
                        success: function(res) {
                            const data = JSON.parse(res);
                            var message = data.em;
                            if (data.status == 404) {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Warning',
                                    text: message,
                                })
                            }
                            else if (data.status == 200 && data.error == 1)
                            {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Warning',
                                    text: message,
                                })
                                $("#currentPass").val('');
                                $("#newPass").val('');
                                $("#retypePass").val('');
                            }
                            else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: message,
                                    timer: 2000,
                                    showConfirmButton: false,
                                }).then(() => {
                                    window.location.reload();
                                })
                            }
                        }
                    })
                }
            })
        }         

    });

});