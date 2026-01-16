<?php 

    include '../../init.php';
    session_start();
    $conn = $database->dbConnect();

    if (isset($_GET['leave_id'])) {
        $leave_id = mysqli_real_escape_string($conn, $_GET['leave_id']);
        $getLeaveQuery = $employees->getLeaveInfo($leave_id);
        $getLeaveResult = mysqli_query($conn, $getLeaveQuery);

        if(mysqli_num_rows($getLeaveResult) == 1)
        {
            $leave = mysqli_fetch_array($getLeaveResult);
            
            $res = [
                'status' => 200,
                'message' => 'Leave Fetch Successfully by id',
                'data' => $leave
            ];

            echo json_encode($res);
            return;
        }
        else
        {
            $res = [
                'status' => 404,
                'message' => 'Leave Id not found'
            ];
            echo json_encode($res);
            return;
        } 
    }


?>