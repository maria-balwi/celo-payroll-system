<?php 

    include '../../init.php';
    session_start();
    $conn = $database->dbConnect();

    if (isset($_GET['allowance_id'])) {
        $allowance_id = mysqli_real_escape_string($conn, $_GET['allowance_id']);
        $getAllowanceQuery = $payroll->getAllowanceInfo($allowance_id);
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
    else if (isset($_GET['reimbursement_id'])) {
        $reimbursement_id = mysqli_real_escape_string($conn, $_GET['reimbursement_id']);
        $getReimbursementQuery = $payroll->getReimbursementInfo($reimbursement_id);
        $getReimbursementResult = mysqli_query($conn, $getReimbursementQuery);

        if(mysqli_num_rows($getReimbursementResult) == 1)
        {
            $reimbursement = mysqli_fetch_array($getReimbursementResult);
            
            $res = [
                'status' => 200,
                'message' => 'Reimbursement Fetch Successfully by id',
                'data' => $reimbursement
            ];

            echo json_encode($res);
            return;
        }
        else
        {
            $res = [
                'status' => 404,
                'message' => 'Reimbursement Id not found'
            ];
            echo json_encode($res);
            return;
        } 
    }
    else if (isset($_GET['deduction_id'])) {
        $deduction_id = mysqli_real_escape_string($conn, $_GET['deduction_id']);
        $getDeductionQuery = $payroll->getDeductionInfo($deduction_id);
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
    else if (isset($_GET['adjustment_id'])) {
        $adjustment_id = mysqli_real_escape_string($conn, $_GET['adjustment_id']);
        $getAdjustmentQuery = $payroll->getAdjustmentInfo($adjustment_id);
        $getAdjustmentResult = mysqli_query($conn, $getAdjustmentQuery);

        if(mysqli_num_rows($getAdjustmentResult) == 1)
        {
            $deduction = mysqli_fetch_array($getAdjustmentResult);
            
            $res = [
                'status' => 200,
                'message' => 'Adjustment Fetch Successfully by id',
                'data' => $deduction
            ];

            echo json_encode($res);
            return;
        }
        else
        {
            $res = [
                'status' => 404,
                'message' => 'Adjustment Id not found'
            ];
            echo json_encode($res);
            return;
        } 
    }
?>