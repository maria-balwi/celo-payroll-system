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
                    $('#viewEmployeeName').val(res.data.employeeName);
                    $('#viewEmailAdd').val(res.data.emailAddress);
                    $('#viewEmployeeID').val(res.data.employeeID);
                    $('#viewDepartment').val(res.data.departmentName+' - '+res.data.position);
                    $('#viewUserModal').modal('show');
                }
            }
        });

        // // UPDATE USER
        // $(document).on('click', '.userUpdate', function() {
        //     $('#viewUserModal').modal('hide');
        //     var id_user = array[array.length - 1];

        //     $.ajax({
        //         type: "GET",
        //         url: "../backend/users/userModal.php?user_ID=" + id_user,
        //         success: function(response) {

        //             var res = jQuery.parseJSON(response);
        //             if (res.status == 404) {
        //                 alert(res.message);
        //             } 
        //             else if (res.status == 200 && res.group == 1) {
        //                 $('#updateUserID').val(res.data.userID);
        //                 $('#updateName').val(res.data.personnelName);
        //                 $('#updateEmailAdd').val(res.data.emailAddress);
        //                 $('#updateEmployeeID').val(res.data.employeeID);
        //                 $('#updateDepartment').val(res.data.deptName);
        //                 $('#updateDesignation').val(res.data.position);
        //                 $('#updateGroup').val(res.data.groupName);
        //                 $('#view_group').val(res.data.groupID);
        //                 $('#viewID').val(res.data.personnelID);
        //                 $('#old_email').val(res.data.emailAddress);
        //                 $('#old_employeeID').val(res.data.employeeID);
        //                 $('#old_departmentID').val(res.data.departmentID);
        //                 $('#updateUserModal').modal('show');
        //             }
        //             else if (res.status == 200 && res.group == 3) {
        //                 $('#updateUserID').val(res.data.userID);
        //                 $('#updateName').val(res.data.hrstaffName);
        //                 $('#updateEmailAdd').val(res.data.emailAddress);
        //                 $('#updateEmployeeID').val(res.data.employeeID);
        //                 $('#updateDepartment').val(res.data.deptName);
        //                 $('#updateDesignation').val(res.data.position);
        //                 $('#updateGroup').val(res.data.groupName);
        //                 $('#view_group').val(res.data.groupID);
        //                 $('#viewID').val(res.data.hrstaffID);
        //                 $('#old_email').val(res.data.emailAddress);
        //                 $('#old_employeeID').val(res.data.employeeID);
        //                 $('#old_departmentID').val(res.data.departmentID);
        //                 $('#updateUserModal').modal('show');
        //             }
        //             else if (res.status == 200 && res.group == 4) {
        //                 $('#updateUserID').val(res.data.userID);
        //                 $('#updateName').val(res.data.financestaffName);
        //                 $('#updateEmailAdd').val(res.data.emailAddress);
        //                 $('#updateEmployeeID').val(res.data.employeeID);
        //                 $('#updateDepartment').val(res.data.deptName);
        //                 $('#updateDesignation').val(res.data.position);
        //                 $('#updateGroup').val(res.data.groupName);
        //                 $('#view_group').val(res.data.groupID);
        //                 $('#viewID').val(res.data.financestaffID);
        //                 $('#old_email').val(res.data.emailAddress);
        //                 $('#old_employeeID').val(res.data.employeeID);
        //                 $('#old_departmentID').val(res.data.departmentID);
        //                 $('#updateUserModal').modal('show');
        //             }
        //             else if (res.status == 200 && res.group == 5) {
        //                 $('#updateUserID').val(res.data.userID);
        //                 $('#updateName').val(res.data.itstaffName);
        //                 $('#updateEmailAdd').val(res.data.emailAddress);
        //                 $('#updateEmployeeID').val(res.data.employeeID);
        //                 $('#updateDepartment').val(res.data.deptName);
        //                 $('#updateDesignation').val(res.data.position);
        //                 $('#updateGroup').val(res.data.groupName);
        //                 $('#view_group').val(res.data.groupID);
        //                 $('#viewID').val(res.data.itstaffID);
        //                 $('#old_email').val(res.data.emailAddress);
        //                 $('#old_employeeID').val(res.data.employeeID);
        //                 $('#old_departmentID').val(res.data.departmentID);
        //                 $('#updateUserModal').modal('show');
        //             }
        //             else {
        //                 $('#updateUserID').val(res.data.userID);
        //                 $('#updateName').val(res.data.directorName);
        //                 $('#updateEmailAdd').val(res.data.emailAddress);
        //                 $('#updateEmployeeID').val(res.data.employeeID);
        //                 $('#updateDepartment').val(res.data.deptName);
        //                 $('#updateDesignation').val(res.data.position);
        //                 $('#updateGroup').val(res.data.groupName);
        //                 $('#view_group').val(res.data.groupID);
        //                 $('#updateUserModal').modal('show');
        //             }
        //         }
        //     });
        // })

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

        // // RESET PASSWORD USER
        // $(document).on('click', '.userResetPassword', function() {
        //     $('#viewUserModal').modal('hide');
        //     var id_user = array[array.length - 1];

        //     $.ajax({
        //         type: "GET",
        //         url: "../backend/users/userModal.php?user_ID=" + id_user,
        //         success: function(response) {

        //             var res = jQuery.parseJSON(response);
        //             if (res.status == 404) {
        //                 alert(res.message);
        //             } 
        //             else if (res.status == 200) {
        //                 $('#viewID').val(res.data.userID);
        //                 $('#resetPassModal').modal('show');
        //             }
        //         }
        //     });
        // })
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
                    $('#viewInactiveEmployeeName').val(res.data.employeeName);
                    $('#viewInactiveEmailAdd').val(res.data.emailAddress);
                    $('#viewInactiveEmpID').val(res.data.employeeID);
                    $('#viewInactiveDept').val(res.data.departmentName + ' - ' + res.data.position);
                    $('#viewInactiveUserModal').modal('show');
                }
            }
        });

        // // REACTIVATE USER
        // $(document).on('click', '.userReactivate', function() {
        //     $('#viewInactiveUserModal').modal('hide');
        //     var id_user = inactive_array[inactive_array.length - 1];

        //     $.ajax({
        //         type: "GET",
        //         url: "../backend/users/userModal.php?user_ID=" + id_user,
        //         success: function(response) {

        //             var res = jQuery.parseJSON(response);
        //             if (res.status == 404) {
        //                 alert(res.message);
        //             } else if (res.status == 200) {
        //                 $('#confirmPassModal').modal('show');
        //             }
        //         }
        //     });
        // })

    });
}); 