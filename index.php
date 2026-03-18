<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- STYLESHEET -->
        <link href="assets/styles/output.css" rel="stylesheet">
        <link href="assets/styles/global-styles.css" rel="stylesheet">

        <!-- TAILWIND CSS DATATABLES WITH JQUERY -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

        <!-- SWEET ALERT 2 -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.all.min.js"></script>

        <!-- BOOTSTRAP ICON -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
              
        <!-- WEBSITE LOGO AND TITLE -->
        <link rel="icon" href="assets/images/logo.png" type="image/icon type">
        <title>Celo Payroll System</title>
    </head>
    <body class="bg-gray-100 flex items-center justify-center min-h-screen">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-sm">
            <h2 class="text-2xl font-bold mb-6 text-center">CELO Payroll System</h2>
            <form autocomplete="on" id="loginForm" class="form-container">
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 mb-2">Username</label>
                    <input type="text" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" autofocus>
                </div>
                <div class="mb-1">
                    <label for="password" class="block text-gray-700 mb-2">Password</label>
                    <input type="password" id="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4 text-right">
                    <button type="button" class="text-blue-500 hover:text-blue-600" id="btnForgotPassword" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">Forgot Password?</button>
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600" id="btnLogin">Login</button>
            </form>
        </div>

        <!-- ======================================================================================================================================= -->
        <!-- ================================================================= MODAL =============================================================== -->
        <!-- ======================================================================================================================================= -->

        <!--------------------------------------------------------------------------------------------------------------------------------------------->
        <!---------------------------------------------------------- FORGOT PASSWORD MODAL ------------------------------------------------------------>
        <!-- <form id="forgotPasswordForm" enctype="multipart/form-data">
            <div class="modal fade" id="forgotPasswordModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                <div class="modal-dialog modal-none modal-dialog-centered">
                    <div class="modal-content position-relative" id="forgotPasswordModal">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="userFormLabel">Forgot Password</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row g-2">
                                <div class="col-9">
                                    <label for="email">Email Address:</label>
                                    <input type="text" id="forgot_email" name="forgot_email" class="form-control" autofocus placeholder="Enter your email">
                                </div>
                                <div class="col-3">
                                    <label for="email">OTP:</label>
                                    <input type="text" id="forgot_otp" name="forgot_otp" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="btnSendOTP">Send OTP</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </form> -->

        <form id="forgotPasswordForm">
            <div class="modal fade" id="forgotPasswordModal" tabindex="-1" data-bs-backdrop="static">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Forgot Password</h5>
                        </div>

                        <div class="modal-body">

                            <!-- EMAIL + SEND OTP -->
                            <label>Email Address:</label>
                            <div class="input-group mb-2">
                                <input type="text" id="forgot_email" name="forgot_email"
                                    class="form-control" placeholder="Enter your email">

                                <button type="button" class="btn btn-primary" id="btnSendOTP">
                                    Send OTP
                                </button>
                            </div>

                            <!-- OPTIONAL TIMER TEXT -->
                            <small id="otpTimerText" class="text-muted"></small>

                            <!-- OTP FIELD (HIDDEN FIRST) -->
                            <div id="otpContainer" style="display:none;" class="mt-3">
                                <label>OTP:</label>
                                <div class="input-group">
                                    <input type="text" id="forgot_otp" name="forgot_otp"
                                        class="form-control" placeholder="Enter OTP">

                                    <button type="button" class="btn btn-success" id="btnVerifyOTP">
                                        Verify
                                    </button>
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </form>

        <!--------------------------------------------------------------------------------------------------------------------------------------------->
        <!-------------------------------------------------------------- RESET PASSWORD MODAL ------------------------------------------------------------->
        <form id="resetPasswordForm" enctype="multipart/form-data">
            <div class="modal fade" id="resetPasswordModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                <div class="modal-dialog modal-none modal-sm modal-dialog-centered">
                    <div class="modal-content position-relative" id="resetPasswordModal">
                        <div class="modal-header">
                                <h1 class="modal-title fs-5" id="resetPassLabel">Reset Password</h1>
                                <input type="hidden" id="userID" name="userID">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="newPassword">New Password</label>
                                    </div>
                                </div>
                                <div class="row g-3 mb-2">
                                    <div class="col-12">
                                        <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Password">
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="retypePassword">Retype New Password</label>
                                    </div>
                                </div>
                                <div class="row g-3 mb-2">
                                    <div class="col-12">
                                        <input type="password" class="form-control" id="retypePassword" name="retypePassword" placeholder="Password">
                                    </div>
                                </div>
                                <div class="row g-3 mb-2">
                                    <div class="col-12">
                                        <p class="text-muted small mb-0">Password must be:</p>
                                        <ul class="text-muted small" style="list-style-type: disc; padding-left: 20px; margin-bottom: 0;">
                                            <li>At least 8 characters long</li>
                                            <li>At least one uppercase letter</li>
                                            <li>At least one lowercase letter</li>
                                            <li>At least one number</li>
                                            <li>At least one special character</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Save</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                </div>
            </div>
        </form>

        <script src="assets/js/index.js"></script>
        <script>
            $(document).ready(function() {
                
            });
        </script>
        <!-- Bootstrap 5 -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>