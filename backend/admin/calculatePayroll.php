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

    exit();
?>