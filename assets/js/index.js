$(document).ready(function() {

    // CHECK FOR MOBILE DEVICE
    function isMobileDevice() {
        const userAgent = navigator.userAgent || navigator.vendor || window.opera;
        return /Android|iPhone|iPad|iPod|BlackBerry|Windows Phone|webOS|Opera Mini|IEMobile|Mobile|Tablet|Kindle/i.test(userAgent);
    }

    function disableLoginOnMobile() {
        const loginButton = document.getElementById('btnLogin');
        if (isMobileDevice()) {
            loginButton.disabled = true;
            loginButton.classList.add('bg-gray-400', 'cursor-not-allowed');
            loginButton.classList.remove('bg-blue-500', 'hover:bg-blue-600');
            Swal.fire({
                icon: 'info',
                title: 'Mobile Device Detected',
                text: 'Login is disabled on mobile devices.',
            });
        } else {
            loginButton.disabled = false;
            loginButton.classList.remove('bg-gray-400', 'cursor-not-allowed');
            loginButton.classList.add('bg-blue-500', 'hover:bg-blue-600');
        }
    }

    // Run on page load
    disableLoginOnMobile();

    // CHECK VERSION
    $.ajax({
        url: 'backend/session/checkVersion.php', // Endpoint to check the version
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            if (data.version) {
                const serverVersion = data.version;
                const clientVersion = localStorage.getItem('websiteVersion');

                if (!clientVersion || clientVersion !== serverVersion) {
                    // Notify user about the update (optional)
                    Swal.fire({
                        icon: 'info',
                        title: 'New Version Available',
                        text: 'A new version of the website is available. Click "OK" to refresh the page.',
                        showCancelButton: true,
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Update client's version and reload the page
                            localStorage.setItem('websiteVersion', serverVersion);
                            location.reload(); // Reload to fetch new content
                        }
                    });
                }
            } else {
                console.error('Version check failed:', data.error);
            }
        },
        error: function () {
            console.error('Failed to connect to the version endpoint.');
        }
    });
    
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
                            if (data.activated == 0) {
                                window.location.href = "pages/profile.php";
                            }
                            else if (data.level == 1) {
                                window.location.href = "pages/user_dashboard.php";
                            }
                            else if (data.level == 2) {
                                window.location.href = "pages/team_dashboard.php";
                            }
                            else if (data.level == 3) {
                                window.location.href = "pages/admin_dashboard.php";
                            }
                            else if (data.level == 4) {
                                window.location.href = "pages/user_dashboard.php";
                            }
                            else if (data.level == 0) {
                                window.location.href = "pages/admin_dashboard.php";
                            }
                            else if (data.level == 5) {
                                window.location.href = "pages/admin_dashboard.php";
                            }
                            else if (data.level == 6) {
                                window.location.href = "pages/user_dashboard.php";
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
                            else if (data.error == 2) {
                                var message = data.em
                                Swal.fire ({
                                    icon: 'error',
                                    title: 'Inactive Account',
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

    // FORGOT PASSWORD
    $('#forgotPasswordForm').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: 'backend/session/sendForgotOTP.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(res) {

                if (res.status == 404) {
                    Swal.fire({
                        icon: 'error',
                        title: 'User not found',
                        text: res.message,
                        confirmButtonColor: '#1975ff',
                        confirmButtonText: 'OK'
                    });
                }
                else if (res.status == 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'OTP Sent!',
                        text: 'An OTP has been sent to your email address.',
                        confirmButtonColor: '#1975ff',
                        confirmButtonText: 'OK'
                    }).then((res) => {
                        if (res.isConfirmed) {
                            $('#forgotPasswordModal').modal('hide');
                            $('#verifyNewPassModal').modal('show');
                        }
                    });
                }
            },
            // error: function(xhr, status, error) {
            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Error',
            //         text: 'An error occurred while sending the OTP.',
            //         confirmButtonColor: '#3085d6',
            //         confirmButtonText: 'OK'
            //     });
            // }
        });
    });

    $('#resetPasswordForm').on('submit', function(e) {
        e.preventDefault();
        
        var newPassword = $('#newPassword').val();
        var retypePassword = $('#retypePassword').val();

        if (newPassword == '' || retypePassword == '') {
            Swal.fire({
                icon: 'warning',
                title: 'Required Information',
                text: 'Please fill up all the required Information',
            })
            return;
        }
        else if (newPassword != retypePassword) {
            Swal.fire({
                icon: 'warning',
                title: 'Required Information',
                text: 'Passwords do not match',
            })
            return;
        }
        else {
            Swal.fire({
                icon: 'question',
                title: 'Reset Password',
                text: 'Are you sure you want to reset your password?',
                showCancelButton: true,
                cancelButtonColor: '#6c757d',
                confirmButtonColor: '#28a745',
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'backend/session/verifyForgotOTP.php',
                        type: 'POST',
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function(res) {
                            const data = JSON.parse(res);
                            var message = data.message;
                            if (data.status == 200 && data.error == 1) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Warning',
                                    text: message
                                })
                                $('#newPassword').val('');
                                $('#retypePassword').val('');
                            }
                            else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: message, 
                                    timer: 2000, 
                                    showConfirmButton: false
                                }).then(() => {
                                    window.location.reload();
                                });
                            }
                        }
                    });
                }
            });
        }
    });
});