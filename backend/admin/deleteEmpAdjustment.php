<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    if(isset($_POST['empAllowanceID'])) {
        $empAllowanceID = $_POST['empAllowanceID'];
    
        mysqli_query($conn, $payroll->deleteEmpAllowance($empAllowanceID));
    
        $em = "Allowance Deleted Successfully";
        $error = array('error' => 0, 'em' => $em);
    }
    else if(isset($_POST['empReimbursementID'])) {
        $empReimbursementID = $_POST['empReimbursementID'];
    
        mysqli_query($conn, $payroll->deleteEmpReimbursement($empReimbursementID));
    
        $em = "Reimbursement Deleted Successfully";
        $error = array('error' => 0, 'em' => $em);
    }
    else if(isset($_POST['empDeductionID'])) {
        $empDeductionID = $_POST['empDeductionID'];
    
        mysqli_query($conn, $payroll->deleteEmpDeduction($empDeductionID));
    
        $em = "Deduction Deleted Successfully";
        $error = array('error' => 0, 'em' => $em);
    }
    else if(isset($_POST['empAdjustmentID'])) {
        $empAdjustmentID = $_POST['empAdjustmentID'];
    
        mysqli_query($conn, $payroll->deleteEmpAdjustment($empAdjustmentID));
    
        $em = "Adjustment Deleted Successfully";
        $error = array('error' => 0, 'em' => $em);
    }
    else {
        $em = "ID Not Found";
        $error = array('error' => 1, 'em' => $em);
    }
    
    echo json_encode($error);
    exit();
?>