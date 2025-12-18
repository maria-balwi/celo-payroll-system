<?php 

    include '../../init.php';
    session_start();
    $conn = $database->dbConnect();

    if (isset($_GET['requestID'])) {
        $request_id = mysqli_real_escape_string($conn, $_GET['requestID']);
        $getCashAdvanceQuery = $payroll->getCashAdvanceInfo($request_id);
        $getCashAdvanceResult = mysqli_query($conn, $getCashAdvanceQuery);

        if(mysqli_num_rows($getCashAdvanceResult) == 1)
        {
            $cashAdvance = mysqli_fetch_array($getCashAdvanceResult);
            
            $res = [
                'status' => 200,
                'message' => 'Cash Advance Fetch Successfully by id',
                'data' => $cashAdvance
            ];

            echo json_encode($res);
            return;
        }
        else
        {
            $res = [
                'status' => 404,
                'message' => 'Cash Advance id not found'
            ];
            echo json_encode($res);
            return;
        } 
    }
?>