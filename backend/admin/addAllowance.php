<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $allowanceName = $_POST['allowanceName'];
    
    mysqli_query($conn, $employees->addAllowance($allowanceName));

    $lastIDQuery = mysqli_query($conn, $employees->viewLastAllowance());
    $lastIDResult = mysqli_fetch_array($lastIDQuery);
    $lastID = $lastIDResult['allowanceID'];

    $em = "Allowance Added Successfully";
    $error = array('error' => 0, 'id' => $lastID, 'em' => $em);
    echo json_encode($error);
    exit();
?>