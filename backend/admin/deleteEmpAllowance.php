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
    else {
        $em = "Allowance ID Not Found";
        $error = array('error' => 1, 'em' => $em);
    }
    
    echo json_encode($error);
    exit();
?>