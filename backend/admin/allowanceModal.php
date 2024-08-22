<?php 

    include '../../init.php';
    session_start();
    $conn = $database->dbConnect();

    if (isset($_GET['allowance_id'])) {
        $allowance_id = mysqli_real_escape_string($conn, $_GET['allowance_id']);
        $getAllowanceQuery = $employees->getAllowanceInfo($allowance_id);
        $getAllowanceResult = mysqli_query($conn, $getAllowanceQuery);

        if(mysqli_num_rows($getAllowanceResult) == 1)
        {
            $allowance = mysqli_fetch_array($getAllowanceResult);
            
            $res = [
                'status' => 200,
                'message' => 'Allowance Fetch Successfully by id',
                'data' => $allowance
            ];

            echo json_encode($res);
            return;
        }
        else
        {
            $res = [
                'status' => 404,
                'message' => 'Allowance Id not found'
            ];
            echo json_encode($res);
            return;
        } 
    }
?>