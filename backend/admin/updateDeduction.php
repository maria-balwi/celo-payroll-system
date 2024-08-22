<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $updateDeductionID = $_POST['updateDeductionID'];
    $updateDeductionName = $_POST['updateDeductionName'];
    // $updateDeductionAmount = $_POST['updateDeductionAmount'];
    
    // mysqli_query($conn, $employees->updateDeduction($updateDeductionID, $updateDeductionName, $updateDeductionAmount));
    mysqli_query($conn, $employees->updateDeduction($updateDeductionID, $updateDeductionName));

    $em = "Deduction Updated Successfully";
    $error = array('error' => 0, 'em' => $em);
    echo json_encode($error);
    exit();
?>