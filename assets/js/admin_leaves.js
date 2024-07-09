$(document).ready(function() {

    $('#leavesTable').DataTable();

    $('#dropdownButton').on('click', function() {
        $('#dropdownMenu').toggleClass('hidden');
    });

    // Close the dropdown if the user clicks outside of it
    $(document).on('click', function(event) {
        if (!$(event.target).closest('#dropdownButton').length && !$(event.target).closest('#dropdownMenu').length) {
        $('#dropdownMenu').addClass('hidden');
        }
    });

    // VIEW LEAVE APPLICATION
    var array = [];
    $(document).on('click', '.leaveView', function() {
        var leave_id = $(this).data('id');
        array.push(leave_id);
        var id_leave = array[array.length - 1];

        // VIEW LEAVE
        $.ajax({
            type: "GET",
            url: "../backend/admin/leaveModal.php?leave_id=" + id_leave,
            success: function(response) {

                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } 
                // EMPLOYEE
                else if (res.status == 200) {
                    $('#viewLeaveID').val(res.data.requestID);
                    $('#viewEmpID').val(res.data.employeeID);
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewName').val(res.data.employeeName);
                    $('#viewLeaveType').val(res.data.leaveType);
                    // $('#viewInclusiveDates').val(res.data.effectivityStartDate+' - '+res.data.effectivityEndDate);
                    $('#viewStartDate').val(res.data.effectivityStartDate);
                    $('#viewEndDate').val(res.data.effectivityEndDate);
                    $('#viewPurpose').val(res.data.remarks);
                    $('#viewStatus').val(res.data.status);
                    $('#viewLeaveModal').modal('show');
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

        
    });
    
});