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
                    <!-- <a href="forgotPassword.php" class="text-blue-500 hover:text-blue-600 no-underline">Forgot Password?</a> -->
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
        <form id="forgotPasswordForm" enctype="multipart/form-data">
            <div class="modal fade" id="forgotPasswordModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                <div class="modal-dialog modal-none modal-sm modal-dialog-centered">
                    <div class="modal-content position-relative" id="forgotPasswordModal">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="userFormLabel">Forgot Password</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row g-2">
                                <div class="col-12">
                                    <label for="email">Email:</label>
                                    <input type="text" id="forgot_email" name="forgot_email" class="form-control" autofocus placeholder="Enter your email">
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