<?php 
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $employeeID = $_SESSION['id'];
    $newShift = $_POST['newShift'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $purpose = $_POST['purpose'];

    // DEFAULT VALUES
    $status = "Pending";

    $currentShiftQuery = mysqli_query($conn, $employees->viewCurrentShift($employeeID));
    $currentShiftDetails = mysqli_fetch_array($currentShiftQuery);
    $currentShift = $currentShiftDetails['shiftID'];

    if ($newShift == $currentShift) {
        $error = array('error' => 1, 'em' => "You are already on this shift");
        echo json_encode($error);
        exit();
    }
    else {
        mysqli_query($conn, $employees->fileRequest($employeeID, $newShift, $startDate, $endDate, $purpose, $status));
        
        $em = "Request Filed Successfully";
        $error = array('error' => 0, 'em' => $em);
        echo json_encode($error);
        exit();
    }
?>