<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $updateAllowanceID = $_POST['updateAllowanceID'];
    $updateAllowanceName = $_POST['updateAllowanceName'];

    mysqli_query($conn, $employees->updateAllowance($updateAllowanceID, $updateAllowanceName));

    $em = "Allowance Updated Successfully";
    $error = array('error' => 0, 'em' => $em);
    echo json_encode($error);
    exit();
?>