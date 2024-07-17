$(document).ready(function() {

    $('#teamTable').DataTable();

    $('#dropdownButton').on('click', function() {
        $('#dropdownMenu').toggleClass('hidden');
    });

    // Close the dropdown if the user clicks outside of it
    $(document).on('click', function(event) {
        if (!$(event.target).closest('#dropdownButton').length && !$(event.target).closest('#dropdownMenu').length) {
        $('#dropdownMenu').addClass('hidden');
        }
    });

    // VIEW TEAM
    var array = [];
    $(document).on('click', '.teamView', function() {
        var employee_id = $(this).data('id');
        array.push(employee_id);
        var id_employee = array[array.length - 1];

        // VIEW USER
        $.ajax({
            type: "GET",
            url: "../backend/team/teamModal.php?employee_id=" + id_employee,
            success: function(response) {

                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } 
                else if (res.status == 200) {
                    $('#viewEmployeeName').val(res.data.firstName + ' ' + res.data.lastName);
                    $('#viewGender').val(res.data.gender);
                    $('#viewCivilStatus').val(res.data.civilStatus);
                    $('#viewAddress').val(res.data.address);
                    $('#viewDateOfBirth').val(res.data.dateOfBirth);
                    $('#viewPlaceOfBirth').val(res.data.placeOfBirth);
                    $('#viewsss').val(res.data.sss);
                    $('#viewpagIbig').val(res.data.pagIbig);
                    $('#viewphilheatlh').val(res.data.philhealth);
                    $('#viewEmailAddress').val(res.data.emailAddress);
                    $('#viewEmployeeID').val(res.data.employeeID);
                    $('#viewMobileNumber').val(res.data.mobileNumber);
                    $('#viewDepartment').val(res.data.departmentName);
                    $('#viewDesignation').val(res.data.position);
                    $('#viewShiftID').val(res.data.startTime + ' - ' + res.data.endTime);
                    $('#viewTeamModal').modal('show');
                }
            }
        });
    });
    
});