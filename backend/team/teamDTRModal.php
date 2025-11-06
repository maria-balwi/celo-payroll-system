<?php 

    include '../../init.php';
    session_start();
    $conn = $database->dbConnect();

    if (isset($_GET['team_id'])) {
        $team_id = mysqli_real_escape_string($conn, $_GET['team_id']);
        $filterMonth = mysqli_real_escape_string($conn, $_GET['filterMonth']);
        $filterYear = mysqli_real_escape_string($conn, $_GET['filterYear']);
        $getTeamQuery = $attendance->getTeamMemberInfo($team_id);
        $getTeamResult = mysqli_query($conn, $getTeamQuery);

        if(mysqli_num_rows($getTeamResult) == 1)
        {
            $team = mysqli_fetch_array($getTeamResult);

            // $yearMonth = date('Y-') . $filterMonth;
            $yearMonth = $filterYear . '-' . $filterMonth;

            $teamQuery = mysqli_query($conn, $employees->viewDTR($team_id, $yearMonth));
            $teamDTR = [];
            while ($teamResult = mysqli_fetch_array($teamQuery)) {
                $teamDTR[] = $teamResult;
            }
            
            $res = [
                'status' => 200,
                'message' => 'Employee Fetch Successfully by id',
                'data' => $team, 
                'teamDTR' => $teamDTR
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