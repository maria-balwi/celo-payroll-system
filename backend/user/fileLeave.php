<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $employeeID = $_SESSION['id'];
    $leaveType = $_POST['leaveType'];
    $startDate = $_POST['effectivityStartDate'];
    $endDate = $_POST['effectivityEndDate'];
    $purpose = $_POST['purpose'];
    
    // DEFAULT VALUES
    $status = "Pending";

    mysqli_query($conn, $employees->fileLeave($employeeID, $leaveType, $startDate, $endDate, $purpose, $status));

    $lastIDQuery = mysqli_query($conn, $employees->viewLastLeave());
    $lastIDResult = mysqli_fetch_array($lastIDQuery);
    $lastID = $lastIDResult['requestID'];

    $em = "Leave Filed Successfully";
    $error = array('error' => 0, 'id' => $lastID, 'em' => $em);
    echo json_encode($error);
    exit();
?>