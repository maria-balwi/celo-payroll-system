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

    // SEND OTP BUTTON COOLDOWN - FOR 60 SECONDS
    let otpTimer;
    let timeLeft = 60;

    let otpRequestCount = 0;
    const maxOTPRequests = 3; // 1 send + 2 resends

    function startOTPCooldown() {
        timeLeft = 60;

        otpTimer = setInterval(function () {

            $('#btnSendOTP').text('Resend in ' + timeLeft + 's');
            $('#otpTimerText').text('You can resend OTP in ' + timeLeft + ' seconds');

            timeLeft--;

            if (timeLeft < 0) {
                clearInterval(otpTimer);

                // Only enable if NOT exceeded limit
                if (otpRequestCount < maxOTPRequests) {
                    $('#btnSendOTP')
                        .prop('disabled', false)
                        .text('Resend OTP');

                    $('#otpTimerText').text('');
                }
            }

        }, 1000);
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

    // RESET OTP TIMER WHEN MODAL IS CLOSED
    $('#forgotPasswordModal').on('hidden.bs.modal', function () {

        clearInterval(otpTimer);

        otpRequestCount = 0; // ✅ RESET COUNT

        $('#forgot_email').val('').prop('readonly', false);
        $('#forgot_otp').val('');

        $('#otpContainer').hide();

        $('#btnSendOTP')
            .prop('disabled', false)
            .text('Send OTP');

        $('#otpTimerText').text('');
    });

    // SEND OTP THRU EMAIL
    $('#btnSendOTP').click(function (e) {
        e.preventDefault();

        let email = $('#forgot_email').val();

        if (email === '') {
            Swal.fire({
                icon: 'warning',
                title: 'Required',
                text: 'Please enter your email',
                confirmButtonColor: '#1975ff'
            });
            return;
        }

        // LIMIT TO 3 REQUESTS OF OTP
        if (otpRequestCount >= maxOTPRequests) {
            Swal.fire({
                icon: 'error',
                title: 'Limit Reached',
                text: 'You have reached the maximum number of OTP requests.',
                confirmButtonColor: '#1975ff'
            });
            return;
        }

        $('#btnSendOTP').prop('disabled', true).text('Sending...');

        $.ajax({
            url: 'backend/session/sendForgotOTP.php',
            type: 'POST',
            data: { forgot_email: email },
            dataType: 'json',
            success: function (res) {
                if (res.status == 1) {
                    $('#btnSendOTP').prop('disabled', false).text('Send OTP');

                    Swal.fire({
                        icon: 'error',
                        title: res.title,
                        text: res.message,
                        confirmButtonColor: '#1975ff'
                    });

                } else if (res.status == 0) {

                    // INCREMENT COUNT
                    otpRequestCount++;

                    Swal.fire({
                        icon: 'success',
                        title: 'OTP Sent!',
                        text: 'Check your email for the OTP.',
                        confirmButtonColor: '#1975ff'
                    });

                    $('#otpContainer').fadeIn();
                    $('#forgot_email').prop('readonly', true);
                    $('#forgot_otp').val('');
                    $('#forgot_otp').focus();

                    // START OTP COOLDOWN
                    startOTPCooldown();

                    // IF MAX REQUEST REACHED, DISABLE BUTTON PERMANENTLY
                    if (otpRequestCount >= maxOTPRequests) {
                        $('#btnSendOTP')
                            .prop('disabled', true)
                            .text('Max OTP Requests Reached');

                        $('#otpTimerText').text('You cannot request another OTP.');
                    }
                }
            },
            error: function () {
                $('#btnSendOTP').prop('disabled', false).text('Send OTP');

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to send OTP.',
                    confirmButtonColor: '#1975ff'
                });
            }
        });
    });

    // VERIFY OTP
    $('#btnVerifyOTP').click(function (e) {
        e.preventDefault();

        let email = $('#forgot_email').val();
        let otp = $('#forgot_otp').val();

        if (otp === '') {
            Swal.fire({
                icon: 'warning',
                title: 'Required',
                text: 'Please enter OTP',
                confirmButtonColor: '#1975ff'
            });
            return;
        }

        $.ajax({
            url: 'backend/session/verifyOTP.php',
            type: 'POST',
            data: { 
                forgot_email: email, 
                forgot_otp: otp 
            },
            dataType: 'json',
            success: function (res) {

                if (res.status == 0) {
                    Swal.fire({
                        icon: 'success',
                        title: res.title,
                        text: res.message,
                        confirmButtonColor: '#1975ff'
                    }).then(() => {
                        // SHOW RESET PASSWORD MODAL
                        $('#forgotPasswordModal').modal('hide');
                        $('#resetPasswordModal').modal('show');
                        $('#userID').val(res.userID);
                    });

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: res.title,
                        text: res.message,
                        confirmButtonColor: '#1975ff'
                    });
                }
            }
        });
    });

    // RESET PASSWORD FORM
    $('#resetPasswordForm').on('submit', function(e) {
        e.preventDefault();
        
        var newPassword = $('#newPassword').val();
        var retypePassword = $('#retypePassword').val();
        var userID = $('#userID').val();

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
                        url: 'backend/session/resetPassword.php',
                        type: 'POST',
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function(res) {
                            var message = res.message;
                            var title = res.title;
                            if (res.status == 1) {
                                Swal.fire({
                                    icon: 'error',
                                    title: title,
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