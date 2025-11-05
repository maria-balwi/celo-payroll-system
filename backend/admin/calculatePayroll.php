<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    if (isset($_POST['action']) && $_POST['action'] == "calculate") {
        $payrollID = $_POST['payrollID'];
        $payrollCycleID = $_POST['payrollCycleID'];
        $payroll->calculatePayroll($payrollID, $payrollCycleID);
        mysqli_query($conn, $payroll->updateCalculatedPayroll($payrollID));
        $em = "Payroll Calculated Successfully";
        $error = array('error' => 0, 'em' => $em);
        echo json_encode($error);
    }
    else if (isset($_POST['action']) && $_POST['action'] == "view") {
        $payrollID = $_POST['payrollID'];
        $payrollCycleID = $_POST['payrollCycleID'];
        $payrollDateCreated = $_POST['payrollDateCreated'];
        $em = "Payroll ID Fetched Successfully";
        $error = array('error' => 0, 'id' => $payrollID, 'cycleID' => $payrollCycleID, 'dateCreated' => $payrollDateCreated, 'em' => $em);
        echo json_encode($error);
    }
    else if (isset($_POST['action']) && $_POST['action'] == "delete") {
        $payrollID = $_POST['payrollID'];
        mysqli_query($conn, $payroll->deletePayroll($payrollID));
        mysqli_query($conn, $payroll->deletePayslip($payrollID));
        $em = "Payroll Deleted Successfully";
        $error = array('error' => 0, 'em' => $em);
        echo json_encode($error);
    }
    else if (isset($_POST['action']) && $_POST['action'] == "recalculate") {
        $payrollID = $_POST['payrollID'];
        $payrollCycleID = $_POST['payrollCycleID'];
        $payroll->reCalculatePayroll($payrollID, $payrollCycleID);
        $em = "Payroll Recalculated Successfully";
        $error = array('error' => 0, 'em' => $em);
        echo json_encode($error);
    }

    exit();
?>