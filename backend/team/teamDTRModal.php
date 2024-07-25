<?php 

    include '../../init.php';
    session_start();
    $conn = $database->dbConnect();

    if (isset($_GET['team_id'])) {
        $team_id = mysqli_real_escape_string($conn, $_GET['team_id']);
        $getTeamQuery = $attendance->getTeamMemberInfo($team_id);
        $getTeamResult = mysqli_query($conn, $getTeamQuery);

        if(mysqli_num_rows($getTeamResult) == 1)
        {
            $team = mysqli_fetch_array($getTeamResult);
            
            $res = [
                'status' => 200,
                'message' => 'Employee Fetch Successfully by id',
                'data' => $team
            ];

            echo json_encode($res);
            return;
        }
        else
        {
            $res = [
                'status' => 404,
                'message' => 'Employee Id not found'
            ];
            echo json_encode($res);
            return;
        } 
    }
?>