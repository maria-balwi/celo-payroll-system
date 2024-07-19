<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $deductionName = $_POST['deductionName'];
    $deductionAmount = $_POST['deductionAmount'];
    
    mysqli_query($conn, $employees->addDeduction($deductionName, $deductionAmount));

    $em = "Deduction Added Successfully";
    $error = array('error' => 0, 'em' => $em);
    echo json_encode($error);
    exit();
?>