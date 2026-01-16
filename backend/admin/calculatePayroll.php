<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    if (isset($_POST['action']) && $_POST['action'] == "calculate") {
        $payrollID = $_POST['payrollID'];
        $payrollCycleID = $_POST['payrollCycleID'];

        $payroll->calculatePayroll($payrollID, $payrollCycleID);
        mysqli_query($conn, $payroll->updateCalculatedPayroll($payrollID));
        
        // AUDIT TRAIL
        $at_empID = $_SESSION['id'];
        $at_module = "Admin - Payroll";
        $at_action = "Triggered Calculate Payroll";
        mysqli_query($conn, $employees->auditTrailPayroll($at_empID, $at_module, $at_action));
        
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

        $resetQuery = mysqli_query($conn, $payroll->resetCAPaymentHistory($payrollID));
        while ($cashAdvanceDetails = mysqli_fetch_array($resetQuery)) {
            $requestID = $cashAdvanceDetails['requestID'];
            $cashAdvance = $cashAdvanceDetails['amountDeducted'];
            $remainingBalance = $cashAdvanceDetails['remainingBalance'];
            $remainingBalance = $remainingBalance + $cashAdvance;
            $ca_status = $cashAdvanceDetails['ca_status'];
            $request_payrollID = $cashAdvanceDetails['payrollID'];

            if ($request_payrollID == $payrollID) {
                mysqli_query($conn, $payroll->resetNewCAstatus($requestID, $remainingBalance));
            }
            else if ($ca_status == "Paid") {
                mysqli_query($conn, $payroll->resetOngoingCAstatus($requestID, $remainingBalance));
            }
            else {
                mysqli_query($conn, $payroll->resetCAstatus($requestID, $remainingBalance));
            }
        }
        mysqli_query($conn, $payroll->deleteCAPaymentHistory($payrollID));

        // AUDIT TRAIL
        $at_empID = $_SESSION['id'];
        $at_module = "Admin - Payroll";
        $at_action = "Triggered Delete Payroll";
        mysqli_query($conn, $employees->auditTrailPayroll($at_empID, $at_module, $at_action));

        $em = "Payroll Deleted Successfully";
        $error = array('error' => 0, 'em' => $em);
        echo json_encode($error);
    }
    else if (isset($_POST['action']) && $_POST['action'] == "recalculate") {
        $payrollID = $_POST['payrollID'];
        $payrollCycleID = $_POST['payrollCycleID'];
        $payroll->reCalculatePayroll($payrollID, $payrollCycleID);

        // AUDIT TRAIL
        $at_empID = $_SESSION['id'];
        $at_module = "Admin - Payroll";
        $at_action = "Triggered Recalculate Payroll";
        mysqli_query($conn, $employees->auditTrailPayroll($at_empID, $at_module, $at_action));
        
        $em = "Payroll Recalculated Successfully";
        $error = array('error' => 0, 'em' => $em);
        echo json_encode($error);
    }

    exit();
?>