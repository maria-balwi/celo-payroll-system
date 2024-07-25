$(document).ready(function() {

    $('#teamDTRTable').DataTable();

    // VIEW TEAM MEMBER DTR 
    var array = [];
    $(document).on('click', '.teamDTRview', function() {
        var team_id = $(this).data('id');
        array.push(team_id);
        var id_team = array[array.length - 1];

        // VIEW
        $.ajax({
            type: "GET",
            url: "../backend/team/teamDTRModal.php?team_id=" + id_team,
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
                    $('#viewDesignation').val(res.data.civilStatus);
                    $('#viewShiftID').val(res.data.startTime + ' - ' + res.data.endTime);
                    $('#viewTeamDTRModal').modal('show');
                }
            }
        });
    });
});