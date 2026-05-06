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

    $("#updateNameIfMarriedLabel").hide();

    $("#mobileNumber").inputmask("0999-999-9999", {
        placeholder: "XXXX-XXX-XXXX",
    });

    // UPDATE NAME IF CIVIL STATUS - MARRIED
    $("select[id='civilStatus']").on("change", function () {
        if ($(this).val() == "Married") {
            $("#updateNameIfMarriedLabel").show();
        } else {
            $("#updateNameIfMarriedLabel").hide();
        }
    });

    // UPDATE PASSWORD
    $("#updatePasswordForm").submit(function (e) {
        
        e.preventDefault();

        let updatePassword = new FormData();
        var userID = $("#userID").val();
        var newPassword = $("#newPassword").val();
        var retypePassword = $("#retypePassword").val();

        if (newPassword == '' || retypePassword == '') {

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
                    updatePassword.append("userID", userID);
                    updatePassword.append("newPassword", newPassword);
                    updatePassword.append("retypePassword", retypePassword);

                    $.ajax({
                        url: '../backend/profile/updatePassword.php',
                        type: 'POST',
                        data: updatePassword,
                        contentType: false,
                        processData: false,
                        success: function(res) {
                            const data = JSON.parse(res);
                            var message = data.message;
                            if (data.status == 200 && data.error == 1) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Warning',
                                    text: message,
                                })
                                $("#newPassword").val('');
                                $("#retypePassword").val('');
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

    // UPDATE VITAL INFORMATION 
    $("#updateVitalInfoForm").submit(function (e) {
        e.preventDefault();

        let updateEmpInfo = new FormData();
        var lastName = $("#lastName").val();
        var firstName = $("#firstName").val();
        var gender = $("#gender").val();
        var civilStatus = $("#civilStatus").val();
        var mobileNumber = $("#mobileNumber").val();
        var address = $("#address").val();

        if (civilStatus == "Married" && (lastName == '' || firstName == '' || gender == '' || mobileNumber == '' || address == '')) {
            Swal.fire({
                icon: 'warning',
                title: 'Required Information',
                text: 'Please fill up all the required Information',
            })
            return;
        } 
        else if (civilStatus != "Married" && (gender == '' || mobileNumber == '' || address == '')) {
            Swal.fire({
                icon: 'warning',
                title: 'Required Information',
                text: 'Please fill up all the required Information',
            })
            return;
        }    
        else {
            Swal.fire({
                icon: 'question',
                title: 'Update Vital Information',
                text: 'Are you sure you want to update your personal information?',
                showCancelButton: true,
                cancelButtonColor: '#6c757d',
                confirmButtonColor: '#28a745',
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed)
                {
                    updateEmpInfo.append("lastName", lastName);
                    updateEmpInfo.append("firstName", firstName);
                    updateEmpInfo.append("gender", gender);
                    updateEmpInfo.append("civilStatus", civilStatus);
                    updateEmpInfo.append("mobileNumber", mobileNumber);
                    updateEmpInfo.append("address", address);

                    $.ajax({
                        url: '../backend/profile/updateEmpInfo.php',
                        type: 'POST',
                        data: updateEmpInfo,
                        contentType: false,
                        processData: false,
                        success: function(res) {
                            const data = JSON.parse(res);
                            var message = data.em;
                            if (data.error == 1) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Warning',
                                    text: message,
                                })
                                $("#lastName").val('');
                                $("#firstName").val('');
                                $("#gender").val('');
                                $("#civilStatus").val('');
                                $("#mobileNumber").val('');
                                $("#address").val('');
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