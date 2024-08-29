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
                    
                    // EMPLOYEE DTR SECTION
                    var teamdtrHTML = '';
                    res.teamDTR.forEach(function($teamdtr) {
                        teamdtrHTML += '<tr>';
                        teamdtrHTML += '<td class="whitespace-nowrap text-left">' + $teamdtr.attendanceDate + '</td>';
                        teamdtrHTML += '<td class="whitespace-nowrap">' + $teamdtr.logType + '</td>';
                        teamdtrHTML += '<td class="whitespace-nowrap">' + $teamdtr.attendanceTime + '</td>';
                        teamdtrHTML += '</tr>';
                    })
                    $('#empDTRsection').html(teamdtrHTML);
                    
                    $('#viewTeamDTRModal').modal('show');
                }
            }
        });
    });
});