$(document).ready(function() {
    $('#personnelTable').DataTable();
    $('#inactivePersonnelTable').DataTable();

    $('#tlqaTable').DataTable();
    $('#inactiveTlqaTable').DataTable();

    $('#facilitiesTable').DataTable();
    $('#inactiveFacilitiesTable').DataTable();

    $('#hrTable').DataTable();
    $('#inactiveHRtable').DataTable();

    $('#financeTable').DataTable();
    $('#inactiveFinanceTable').DataTable();

    $('#adminTable').DataTable();
    $('#inactiveAdminTable').DataTable();

    $('#directorsTable').DataTable();
    $('#inactiveDirectorsTable').DataTable();

    if ($('#adminID').val() == 9 || $('#adminID').val() == 10 || $('#adminID').val() == 11) {
        $('#btnAddUser').show();
        $('.userResetPassword').show();
        $('.userDeactivate').show();
        $('.userReactivate').show();
    }
    else {
        $('#btnAddUser').hide();
        $('.userResetPassword').hide();
        $('.userDeactivate').hide();
        $('.userReactivate').hide();
    }

    // ADD USER
    $("#addUserForm").submit(function (e) {
        e.preventDefault();

        let addUserForm = new FormData();
        var employeeID = $('#employeeID').val();
        var password = $('#password').val();
        var retypePassword = $('#retypePassword').val();

        if (employeeID == "" || password == "" || retypePassword == "") {
            Swal.fire({
                icon: 'warning',
                title: 'Required Information',
                text: 'Please fill up all the required Information',

            })
        } else {
            Swal.fire({
                icon: 'question',
                title: 'Add User',
                text: 'Are you sure you want to add this user?',
                showCancelButton: true,
                cancelButtonColor: '#6c757d',
                confirmButtonColor: '#28a745',
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed) {
                    addUserForm.append('employeeID', employeeID);
                    addUserForm.append('password', password);
                    addUserForm.append('retypePassword', retypePassword);
                    $.ajax({
                        type: "POST",
                        url: "../backend/admin/addUser.php",
                        data: addUserForm,
                        processData: false,
                        contentType: false,
                        success: function (res) {
                            const data = JSON.parse(res);
                            var message = data.em;
                            if (data.error == 0) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'User Added Successfully',
                                    timer: 2000,
                                    showConfirmButton: false,
                                }).then(() => {
                                    window.location.reload();
                                })
                            } else if (data.error == 1) {
                                $("#password").val('');
                                $("#retypePassword").val('');
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Password Mismatch',
                                    text: message,
                                });
                            }
                            else {
                                $("#password").val('');
                                $("#retypePassword").val('');
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Password Restrictions',
                                    text: message,
                                });
                            }
                        }
                    });
                }
            });
        }
    });

    // VIEW AND UPDATE ACTIVE USER
    var array = [];
    $(document).on('click', '.userView', function() {
        var user_ID = $(this).data('id');
        array.push(user_ID);
        var id_user = array[array.length - 1];

        // VIEW USER
        $.ajax({
            type: "GET",
            url: "../backend/admin/userModal.php?user_ID=" + id_user,
            success: function(response) {

                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } 
                // EMPLOYEE
                else if (res.status == 200) {
                    $('#viewUserID').val(res.data.userID);
                    $('#viewEmployeeName').val(res.data.firstName+' '+res.data.lastName);
                    $('#viewEmailAdd').val(res.data.emailAddress);
                    $('#viewEmployeeID').val(res.data.employeeID);
                    $('#viewDepartment').val(res.data.departmentName+' - '+res.data.position);
                    $('#viewUserModal').modal('show');
                }
            }
        });

        // DEACTIVATE USER
        $(document).on('click', '.userDeactivate', function() {
            var id_user = array[array.length - 1];

            $.ajax({
                type: "GET",
                url: "../backend/admin/userModal.php?user_ID=" + id_user,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {
                        alert(res.message);
                    } else if (res.status == 200) {

                        Swal.fire({
                            icon: 'question',
                            title: 'Deactivate User Account',
                            text: 'Are you sure you want to deactivate this user account?',
                            showCancelButton: true,
                            cancelButtonColor: '#6c757d',
                            confirmButtonColor: '#28a745',
                            confirmButtonText: 'Yes',

                        }).then((result) => {
                            if (result.isConfirmed) {

                                $.ajax({
                                    url: "../backend/admin/deactivateUser.php",
                                    type: 'POST',
                                    data: {
                                        id_user: id_user
                                    },
                                    cache: false,
                                    success: function(data) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success',
                                            text: 'User Account Deactivated Successfully',
                                            timer: 2000,
                                            showConfirmButton: false,
                                        }).then(() => {
                                            window.location.reload();
                                        })
                                    }
                                })
                            }
                        })
                    }
                }
            });
        })

        // RESET PASSWORD USER
        $(document).on('click', '.userResetPassword', function() {
            $('#viewUserModal').modal('hide');
            var id_user = array[array.length - 1];

            $.ajax({
                type: "GET",
                url: "../backend/admin/userModal.php?user_ID=" + id_user,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {
                        alert(res.message);
                    } 
                    else if (res.status == 200) {
                        $('#viewID').val(res.data.userID);
                        $('#resetPassModal').modal('show');
                    }
                }
            });
        })
    });

    // RESET PASSWORD 
    $("#resetPasswordForm").submit(function (e) {
        
        e.preventDefault();

        let resetPassword = new FormData();
        var userID = $("#viewID").val();
        var newPass = $("#newPass").val();
        var retypePass = $("#retypePass").val();

        if (userID == '' || newPass == '' || retypePass == '') {

            Swal.fire({
                icon: 'warning',
                title: 'Required Information',
                text: 'Please fill up all the required Information',

            })

        } else {
            Swal.fire({
                icon: 'question',
                title: 'Reset Password',
                text: 'Are you sure you want to save the changes you made?',
                showCancelButton: true,
                cancelButtonColor: '#6c757d',
                confirmButtonColor: '#28a745',
                confirmButtonText: 'Yes',

            }).then((result) => {
                if (result.isConfirmed) {
                    resetPassword.append("userID", userID);
                    resetPassword.append("newPass", newPass);
                    resetPassword.append("retypePass", retypePass);

                    $.ajax({
                        url: '../backend/admin/resetPassword.php',
                        type: 'POST',
                        data: resetPassword,
                        contentType: false,
                        processData: false,
                        success: function(res) {
                            const data = JSON.parse(res);
                            var message = data.message
                            if (data.status == 404) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Warning',
                                    text: message,
                                })
                            }
                            else if (data.status == 200 & data.result == 1) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Warning',
                                    text: message,
                                })
                                $("#newPass").val('');
                                $("#retypePass").val('');
                            } 
                            else if (data.status == 200 & data.result == 2) {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Warning',
                                    text: message,
                                })
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

    // VIEW AND UPDATE INACTIVE USER
    var inactive_array = [];
    $(document).on('click', '.inactiveUserView', function() {
        var user_ID = $(this).data('id');
        inactive_array.push(user_ID);
        var id_user = inactive_array[inactive_array.length - 1];

        // VIEW USER
        $.ajax({
            type: "GET",
            url: "../backend/admin/userModal.php?user_ID=" + id_user,
            success: function(response) {

                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } 
                else if (res.status == 200) {
                    $('#viewInactiveUserID').val(res.data.userID);
                    $('#viewInactiveEmployeeName').val(res.data.firstName+' '+res.data.lastName);
                    $('#viewInactiveEmailAdd').val(res.data.emailAddress);
                    $('#viewInactiveEmpID').val(res.data.employeeID);
                    $('#viewInactiveDept').val(res.data.departmentName + ' - ' + res.data.position);
                    $('#viewInactiveUserModal').modal('show');
                }
            }
        });

        // REACTIVATE USER
        $(document).on('click', '.userReactivate', function() {
            $('#viewInactiveUserModal').modal('hide');
            var id_user = inactive_array[inactive_array.length - 1];

            $.ajax({
                type: "GET",
                url: "../backend/admin/userModal.php?user_ID=" + id_user,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {
                        alert(res.message);
                    } else if (res.status == 200) {
                        $('#confirmPassModal').modal('show');
                    }
                }
            });
        })

    });

    // REACTIVATE USER ACOUNT
    $("#reactivateForm").submit(function (e) {
        
        e.preventDefault();

        let reactivateForm = new FormData();
        var loggedInUserPassword = $("#loggedInUserPassword").val();
        var password = $("#reactivate_password").val();
        var retypePassword = $("#reactivate_retypePassword").val();
        var id_user = inactive_array[inactive_array.length - 1];

        console.log({loggedInUserPassword});
        console.log({password});
        console.log({retypePassword});

        if (loggedInUserPassword == '' || password == '' || retypePassword == '') {

            Swal.fire({
                icon: 'warning',
                title: 'Required Information',
                text: 'Please fill up all the required Information',
            })

        } else {

            if (password == retypePassword) {

                Swal.fire({
                    icon: 'question',
                    title: 'Reactivate User Account',
                    text: 'Are you sure you want to reactivate this user account?',
                    showCancelButton: true,
                    cancelButtonColor: '#6c757d',
                    confirmButtonColor: '#28a745',
                    confirmButtonText: 'Yes',
    
                }).then((result) => {
                    if (result.isConfirmed) {
                        reactivateForm.append("loggedInUserPassword", loggedInUserPassword);
                        reactivateForm.append("password", password);
                        reactivateForm.append("userID", id_user);
                        
                        $.ajax({
                            url: "../backend/admin/reactivateUser.php",
                            type: 'POST',
                            data: reactivateForm,
                            contentType: false,
                            processData: false,
                            success: function(res) {
                                const data = JSON.parse(res);
                                var message = data.em;
                                if (data.error == 0) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'User Account Reactivated Successfully',
                                        timer: 2000,
                                        showConfirmButton: false,
                                    }).then(() => {
                                        window.location.reload();
                                    })
                                }
                                else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Incorrect Password', 
                                        text: message,
                                    })
                                    $("#reactivate_password").val('');
                                    $("#reactivate_retypePassword").val('');
                                }
                            }
                        })
                    }
                })
                
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Password Mismatch',
                    text: 'Password does not match.',
                })
                $("#reactivate_password").val('');
                $("#reactivate_retypePassword").val('');
            }

            
        }       

    });
}); 