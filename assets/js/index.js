$(document).ready(function() {
    
    // LOGIN FUNCTION
    $("#loginForm").submit(function (e) {
        e.preventDefault();

        let login = new FormData();
        var email = $("#email").val();
        var password = $("#password").val();

        console.log({email});
        console.log({password});


        if (email == '' || password == '') {

            Swal.fire({
                icon: 'warning',
                title: 'Required Information',
                text: 'Please fill up all the required Information',

            })

        } else {
            Swal.fire({
                icon: 'question',
                title: 'Login',
                text: 'Are you sure you want to submit this credentials?',
                showCancelButton: true,
                cancelButtonColor: '#6c757d',
                confirmButtonColor: '#28a745',
                confirmButtonText: 'Yes',

            }).then((result) => {
                if (result.isConfirmed) {
                    
                    login.append('email', email);
                    login.append('password', password);

                    $.ajax ({
                        type: 'POST',
                        url: 'backend/session/loginProcess.php',
                        data: login,
                        contentType: false,
                        processData: false,
                        success: function (res) {
                            const data = JSON.parse(res);
                            if (data.level == 1) {
                                window.location.href = "pages/user_dashboard.php";
                            }
                            else if (data.level == 2 || data.level == 0) {
                                window.location.href = "pages/team_dashboard.php";
                            }
                            else if (data.level == 3) {
                                window.location.href = "pages/admin_dashboard.php";
                            }
                            else if (data.error == 1) {
                                var message = data.em
                                Swal.fire ({
                                    icon: 'error',
                                    title: 'Incorrect credentials',
                                    text: message,
                                }).then(() => {
                                    window.location.reload();
                                })
                                $("#email").val('');
                                $("#password").val('');
                            }
                            else {
                                var message = data.em
                                Swal.fire ({
                                    icon: 'error',
                                    title: 'User does not exist',
                                    text: message,
                                }).then(() => {
                                    window.location.reload();
                                })
                                $("#email").val('');
                                $("#password").val('');
                            }
                        }
                    });
                }
            });
        }
    });
});