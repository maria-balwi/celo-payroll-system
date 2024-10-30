<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    if (isset($_POST['payrollCycleID'])) {
        $payrollCycleID = $_POST['payrollCycleID'];
        $status = "New";
        mysqli_query($conn, $payroll->createPayroll($payrollCycleID, $status));
        $em = "Payroll Created Successfully";
        $error = array('error' => 0, 'em' => $em);
        echo json_encode($error);
    }
    else {
        $em = "Please select one payroll cycle ". $_POST['payrollCycleID']."";
        $error = array('error' => 1, 'em' => $em);
        echo json_encode($error);
    }
    exit();
?>