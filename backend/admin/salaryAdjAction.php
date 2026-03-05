<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $action = $_POST['action'];

    if ($action == 'approve') { // APPROVE
        $id_salary = $_POST['id_salary'];
        mysqli_query($conn, $payroll->approveSalaryAdjustment($id_salary));

        // GET AFFECTED USER
        $query = mysqli_query($conn, $employees->viewSalaryAdjInfo($id_salary));
        $queryDetails = mysqli_fetch_array($query);
        $at_affectedEmpID = $queryDetails['empID'];
        $empBasicPay = $queryDetails['basicPay'];
        $empSuggestedSalary = $queryDetails['suggestedSalary'];
        $newSalary = $empSuggestedSalary + $empBasicPay;
        $newDailyRate = round(($newSalary * 12) / 261, 2);
        $newHourlyRate = round($newDailyRate / 8, 2);
        mysqli_query($conn, $employees->updateEmployeeSalary($at_affectedEmpID, $newSalary, $newDailyRate, $newHourlyRate));
        
        // AUDIT TRAIL
        $at_empID = $_SESSION['id'];
        $at_module = "Admin - Salary Adjustment";
        $at_action = "Approved Salary Adjustment";
        mysqli_query($conn, $employees->auditTrailSalaryAdj($at_empID, $at_module, $id_salary, $at_action, $at_affectedEmpID));


        $em = "Salary Adjustment Approved Successfully";
        $error = array('error' => 0, 'id' => $id_salary, 'em' => $em);
        echo json_encode($error);
        exit();
    }
    else if ($action == 'disapprove') { // DISAPPROVE
        $id_salary = $_POST['id_salary'];
        mysqli_query($conn, $payroll->disapproveSalaryAdjustment($id_salary));

        // GET AFFECTED USER
        $query = mysqli_query($conn, $employees->viewSalaryAdjInfo($id_salary));
        $queryDetails = mysqli_fetch_array($query);
        $at_affectedEmpID = $queryDetails['empID'];
        
        // AUDIT TRAIL
        $at_empID = $_SESSION['id'];
        $at_module = "Admin - Salary Adjustment";
        $at_action = "Disapproved Salary Adjustment";
        mysqli_query($conn, $employees->auditTrailSalaryAdj($at_empID, $at_module, $id_salary, $at_action, $at_affectedEmpID));

        $em = "Salary Adjustment Disapproved Successfully";
        $error = array('error' => 0, 'id' => $id_salary, 'em' => $em);
        echo json_encode($error);
        exit();
    }
?>