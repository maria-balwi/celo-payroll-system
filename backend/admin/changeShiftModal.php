<?php 

    include '../../init.php';
    session_start();
    $conn = $database->dbConnect();

    if (isset($_GET['changeshift_id'])) {
        $changeshift_id = mysqli_real_escape_string($conn, $_GET['changeshift_id']);
        $getChangeshiftQuery = $employees->getChangeShiftInfo($changeshift_id);
        $getChangeShiftResult = mysqli_query($conn, $getChangeshiftQuery);

        if(mysqli_num_rows($getChangeShiftResult) == 1)
        {
            $leave = mysqli_fetch_array($getChangeShiftResult);
            $isCheck = $leave['designationID'] == 7 ? true : false;
            $res = [
                'status' => 200,
                'message' => 'Leave Fetch Successfully by id',
                'isCheck' => $isCheck,
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