<?php 

    include '../../init.php';
    session_start();
    $conn = $database->dbConnect();

    if (isset($_GET['deduction_id'])) {
        $deduction_id = mysqli_real_escape_string($conn, $_GET['deduction_id']);
        $getDeductionQuery = $employees->getDeductionInfo($deduction_id);
        $getDeductionResult = mysqli_query($conn, $getDeductionQuery);

        if(mysqli_num_rows($getDeductionResult) == 1)
        {
            $deduction = mysqli_fetch_array($getDeductionResult);
            
            $res = [
                'status' => 200,
                'message' => 'Deduction Fetch Successfully by id',
                'data' => $deduction
            ];

            echo json_encode($res);
            return;
        }
        else
        {
            $res = [
                'status' => 404,
                'message' => 'Deduction Id not found'
            ];
            echo json_encode($res);
            return;
        } 
    }
?>