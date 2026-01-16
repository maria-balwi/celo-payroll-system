<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    if (isset($_POST['updateAllowanceID'])) {
        $updateAllowanceID = $_POST['updateAllowanceID'];
        $updateAllowanceName = $_POST['updateAllowanceName'];

        mysqli_query($conn, $payroll->updateAllowance($updateAllowanceID, $updateAllowanceName));

        $em = "Allowance Updated Successfully";
        $error = array('error' => 0, 'em' => $em);
        echo json_encode($error);
        exit();
    }
    else if (isset($_POST['updateReimbursementID'])) {
        $updateReimbursementID = $_POST['updateReimbursementID'];
        $updateReimbursementName = $_POST['updateReimbursementName'];

        mysqli_query($conn, $payroll->updateReimbursement($updateReimbursementID, $updateReimbursementName));

        $em = "Reimbursement Updated Successfully";
        $error = array('error' => 0, 'em' => $em);
        echo json_encode($error);
        exit();
    }
    else if (isset($_POST['updateDeductionID'])) {
        $updateDeductionID = $_POST['updateDeductionID'];
        $updateDeductionName = $_POST['updateDeductionName'];

        mysqli_query($conn, $payroll->updateDeduction($updateDeductionID, $updateDeductionName));

        $em = "Deduction Updated Successfully";
        $error = array('error' => 0, 'em' => $em);
        echo json_encode($error);
        exit();
    }
    else if (isset($_POST['updateAdjustmentID'])) {
        $updateAdjustmentID = $_POST['updateAdjustmentID'];
        $updateAdjustmentName = $_POST['updateAdjustmentName'];
        $updateAdjustmentType = $_POST['updateAdjustmentType'];

        mysqli_query($conn, $payroll->updateAdjustment($updateAdjustmentID, $updateAdjustmentName, $updateAdjustmentType));

        $em = "Adjustment Updated Successfully";
        $error = array('error' => 0, 'em' => $em);
        echo json_encode($error);
        exit();
    }
?>