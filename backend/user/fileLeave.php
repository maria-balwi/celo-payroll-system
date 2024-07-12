<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $employeeID = $_POST['employeeID'];
    $leaveType = $_POST['leaveType'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $purpose = $_POST['purpose'];
    
    // DEFAULT VALUES
    $status = "Pending";

    mysqli_query($conn, $employees->fileLeave($employeeID, $leaveType, $startDate, $endDate, $purpose, $status));

    $em = "Leave Filed Successfully";
    $error = array('error' => 0, 'em' => $em);
    echo json_encode($error);
    exit();
?>