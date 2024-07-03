<?php 
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $newShift = $_POST['newShift'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $purpose = $_POST['purpose'];
    $employeeID = $_SESSION['id'];
    $status = "Pending";

    $currentShiftQuery = mysqli_query($conn, $employees->viewCurrentShift($_SESSION['id']));
    $currentShiftDetails = mysqli_fetch_array($currentShiftQuery);
    $currentShift = $currentShiftDetails['shiftID'];

    if ($newShift == $currentShift) {
        $error = array('error' => 1, 'em' => "You are already on this shift");
        echo json_encode($error);
        exit();
    }
    else {
        $addRequest = $conn->query("INSERT INTO `tbl_changeshiftrequests` 
        (`empID`, `dateFiled`, `requestedShift`, `effectivityStartDate`, `effectivityEndDate`, `remarks`, `status`) 
        VALUES 
        ('$employeeID', CURRENT_TIMESTAMP(), '$newShift', '$startDate', '$endDate', '$purpose', '$status')");
        
        $em = "Request Filed     Successfully";
        $error = array('error' => 0, 'em' => $em);
        echo json_encode($error);
        exit();
    }
?>