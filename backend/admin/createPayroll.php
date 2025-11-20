<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    if (isset($_POST['payrollCycleID'])) {
        $payrollCycleID = $_POST['payrollCycleID'];
        $status = "New";
        mysqli_query($conn, $payroll->createPayroll($payrollCycleID, $status));

        // AUDIT TRAIL
        $at_empID = $_SESSION['id'];
        $at_module = "Admin - Payroll";
        $at_action = "Triggered Create Payroll";
        mysqli_query($conn, $employees->auditTrailPayroll($at_empID, $at_module, $at_action));  

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