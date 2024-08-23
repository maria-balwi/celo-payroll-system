<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $deductionName = $_POST['deductionName'];
    // $deductionAmount = $_POST['deductionAmount'];
    
    // mysqli_query($conn, $employees->addDeduction($deductionName, $deductionAmount));
    mysqli_query($conn, $employees->addDeduction($deductionName));

    $lastIDQuery = mysqli_query($conn, $employees->viewLastDeduction());
    $lastIDResult = mysqli_fetch_array($lastIDQuery);
    $lastID = $lastIDResult['deductionID'];

    $em = "Deduction Added Successfully";
    $error = array('error' => 0, 'id' => $lastID, 'em' => $em);
    echo json_encode($error);
    exit();
?>