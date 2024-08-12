$(document).ready(function() {

    $('#teamDTRTable').DataTable();
    $('#attendanceTable').DataTable();

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
                    $('#viewID').val(res.data.id);
                    $('#viewEmployeeName').val(res.data.firstName + ' ' + res.data.lastName);
                    $('#viewEmailAddress').val(res.data.emailAddress);
                    $('#viewEmployeeID').val(res.data.employeeID);
                    $('#viewShiftID').val(res.data.startTime + ' - ' + res.data.endTime);
                    $('#viewTeamDTRModal').modal('show');

                    // AUTOMATICALLY SEND VIEWID TO PHP
                    var viewID = $('#viewID').val();

                    $.ajax({
                        type: "POST",
                        url: "../backend/team/processViewID.php", // The PHP file that will process the data
                        data: { id: viewID },
                        success: function(response) {
                            // console.log('Response from PHP: ' + response);
                            // Additional actions after success (if needed)
                        },
                        error: function(xhr, status, error) {
                            console.error('Error: ' + error);
                        }
                    });
                }
            }
        });
    });
});