<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    if(isset($_POST['empDeductionID'])) {
        $empDeductionID = $_POST['empDeductionID'];
    
        mysqli_query($conn, $payroll->deleteEmpADeduction($empDeductionID));
    
        $em = "Deduction Deleted Successfully";
        $error = array('error' => 0, 'em' => $em);
    }
    else {
        $em = "Deduction ID Not Found";
        $error = array('error' => 1, 'em' => $em);
    }
    
    echo json_encode($error);
    exit();
?>