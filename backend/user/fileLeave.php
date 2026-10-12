<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $employeeID = $_SESSION['id'];
    $leaveType = $_POST['leaveType'];
    $startDate = $_POST['effectivityStartDate'];
    $endDate = $_POST['effectivityEndDate'];
    $purpose = $_POST['purpose'];

    $modified_employeeID = str_replace("-", "", $_SESSION['employeeID']);
    $newFileName = $modified_employeeID.'-'.date("m.d.Y"). '.png'; 
    $uploadDir = ''; // DIRECTORY TO SAVE UPLOADED FILES

    if (isset($_POST['withAttachment']))
    {
        $attachment = 1;
    }
    else if (isset($_POST['withoutAttachment']))
    {
        $attachment = 0;
    }
    else {
        $attachment = 0;
    }

    // DEFAULT VALUES
    $status = "Pending";

    if ($leaveType == 1 || $leaveType == 3 || $leaveType == 4 || $leaveType == 5 || $leaveType == 6 || $leaveType == 7 || $leaveType == 8) {
        mysqli_query($conn, $employees->fileLeaveWithAttachment($employeeID, $leaveType, $startDate, $endDate, $purpose, $status, $attachment));
    }
    else {
        mysqli_query($conn, $employees->fileLeave($employeeID, $leaveType, $startDate, $endDate, $purpose, $status));
    }

    $lastIDQuery = mysqli_query($conn, $employees->viewLastLeave());
    $lastIDResult = mysqli_fetch_array($lastIDQuery);
    $lastID = $lastIDResult['requestID'];

    $em = "Leave Filed Successfully";
    $error = array('error' => 0, 'id' => $lastID, 'em' => $em);
    echo json_encode($error);
    exit();
?>