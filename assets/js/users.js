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
}); 