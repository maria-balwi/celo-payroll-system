<?php 
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $employeeID = $_SESSION['id'];
    $newShift = $_POST['newShift'];
    $dates = FALSE;
    if ($_POST['effectivityStartDate'] && $_POST['effectivityEndDate']) {
        $startDate = $_POST['effectivityStartDate'];
        $endDate = $_POST['effectivityEndDate'];
        $dates = TRUE;
    }
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
        if ($dates) {
            mysqli_query($conn, $employees->fileRequestWithDate($employeeID, $newShift, $startDate, $endDate, $purpose, $status));
        }
        else {
            mysqli_query($conn, $employees->fileRequest($employeeID, $newShift, $purpose, $status));
        }

        $lastIDQuery = mysqli_query($conn, $employees->viewLastRequest());
        $lastIDResult = mysqli_fetch_array($lastIDQuery);
        $lastID = $lastIDResult['requestID'];
        
        $em = "Request Filed Successfully";
        $error = array('error' => 0, 'id' => $lastID, 'em' => $em);
        echo json_encode($error);
        exit();
    }
?>