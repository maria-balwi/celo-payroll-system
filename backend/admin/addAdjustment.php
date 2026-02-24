<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $dataType = $_POST['dataType'];

    if ($dataType == 1) { // ALLOWANCE
        $allowanceName = $_POST['name'];
    
        mysqli_query($conn, $payroll->addAllowance($allowanceName));

        $lastIDQuery = mysqli_query($conn, $payroll->viewLastAllowance());
        $lastIDResult = mysqli_fetch_array($lastIDQuery);
        $lastID = $lastIDResult['allowanceID'];

        $em = "Allowance Added Successfully";
        $error = array('error' => 0, 'id' => $lastID, 'em' => $em);
        echo json_encode($error);
        exit();
    }
    else if ($dataType == 2) { // REIMBURSEMENT
        $reimbursementName = $_POST['name'];
        
        mysqli_query($conn, $payroll->addReimbursement($reimbursementName));

        $lastIDQuery = mysqli_query($conn, $payroll->viewLastReimbursement());
        $lastIDResult = mysqli_fetch_array($lastIDQuery);
        $lastID = $lastIDResult['reimbursementID'];

        $em = "Reimbursement Added Successfully";
        $error = array('error' => 0, 'id' => $lastID, 'em' => $em);
        echo json_encode($error);
        exit();
    }
    else if ($dataType == 3) { // DEDUCTION
        $deductionName = $_POST['name'];

        mysqli_query($conn, $payroll->addDeduction($deductionName));

        $lastIDQuery = mysqli_query($conn, $payroll->viewLastDeduction());
        $lastIDResult = mysqli_fetch_array($lastIDQuery);
        $lastID = $lastIDResult['deductionID'];

        $em = "Deduction Added Successfully";
        $error = array('error' => 0, 'id' => $lastID, 'em' => $em);
        echo json_encode($error);
        exit();
    }
    else if ($dataType == 4){ // ADJUSTMENT
        $adjustmentName = $_POST['name'];
        $adjustmentType = $_POST['adjustment'];
        
        mysqli_query($conn, $payroll->addAdjustment($adjustmentName, $adjustmentType));

        $lastIDQuery = mysqli_query($conn, $payroll->viewLastAdjustment());
        $lastIDResult = mysqli_fetch_array($lastIDQuery);
        $lastID = $lastIDResult['adjustmentID'];

        $em = "Adjustment Added Successfully";
        $error = array('error' => 0, 'id' => $lastID, 'em' => $em);
        echo json_encode($error);
        exit();
    }
    else { // SALARY ADJUSTMENT
        $empID = $_POST['empID'];
        $suggestedSalary = $_POST['suggestedSalary'];
        $reason = $_POST['reason'];
        $status = "Pending";

        $salaryQuery = mysqli_query($conn, $employees->viewEmployee($empID));
        $salaryResult = mysqli_fetch_array($salaryQuery);
        $currentSalary = $salaryResult['basicPay'];

        mysqli_query($conn, $payroll->fileSalaryAdjustment($empID, $currentSalary, $suggestedSalary, $reason, $status));

        $lastIDQuery = mysqli_query($conn, $payroll->viewLastSalaryAdjustment());
        $lastIDResult = mysqli_fetch_array($lastIDQuery);
        $lastID = $lastIDResult['salaryAdjID'];
        
        $em = "Salary Adjustment Added Successfully";
        $error = array('error' => 0, 'id' => $lastID, 'em' => $em);
        echo json_encode($error);
        exit();
    }
?>