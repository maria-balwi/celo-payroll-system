<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $allowanceName = $_POST['allowanceName'];
    
    mysqli_query($conn, $employees->addAllowance($allowanceName));

    $em = "Allowance Added Successfully";
    $error = array('error' => 0, 'em' => $em);
    echo json_encode($error);
    exit();
?>