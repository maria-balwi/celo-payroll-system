<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    if (isset($_POST['id_allowance'])) {
        $id_allowance = $_POST['id_allowance'];
    
        mysqli_query($conn, $payroll->deleteAllowance($id_allowance));

        $em = "Allowance Deleted Successfully";
        $error = array('error' => 0, 'em' => $em);
        echo json_encode($error);
        exit();
    }
    else if (isset($_POST['id_reimbursement'])) {
        $id_reimbursement = $_POST['id_reimbursement'];
    
        mysqli_query($conn, $payroll->deleteReimbursement($id_reimbursement));

        $em = "Reimbursement Deleted Successfully";
        $error = array('error' => 0, 'em' => $em);
        echo json_encode($error);
        exit();
    }
    else if (isset($_POST['id_deduction'])) {
        $id_deduction = $_POST['id_deduction'];
    
        mysqli_query($conn, $payroll->deleteDeduction($id_deduction));

        $em = "Deduction Deleted Successfully";
        $error = array('error' => 0, 'em' => $em);
        echo json_encode($error);
        exit();
    }
    else if (isset($_POST['id_adjustment'])) {
        $id_adjustment = $_POST['id_adjustment'];
    
        mysqli_query($conn, $payroll->deleteAdjustment($id_adjustment));

        $em = "Adjustment Deleted Successfully";
        $error = array('error' => 0, 'em' => $em);
        echo json_encode($error);
        exit();
    }
?>