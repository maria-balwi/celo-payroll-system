<?php 
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $employeeID = $_SESSION['id'];
    $otDate = $_POST['otDate'];
    $actualOThours = $_POST['actualOThours'];
    $actualOTmins = $_POST['actualOTmins'];
    $purpose = $_POST['purpose'];

    

    // DEFAULT VALUES
    $status = "Pending";

    if ($actualOTmins == 0 || $actualOTmins == null) {
        mysqli_query($conn, $employees->fileOT_null($employeeID, $otDate, $actualOThours, $actualOTmins, $purpose, $status));
    }
    else {
        mysqli_query($conn, $employees->fileOT($employeeID, $otDate, $actualOThours, $actualOTmins, $purpose, $status));
    }

    $lastIDQuery = mysqli_query($conn, $employees->viewLastOT());
    $lastIDResult = mysqli_fetch_array($lastIDQuery);
    $lastID = $lastIDResult['requestID'];

    $em = "Overtime Filed Successfully";
    $error = array('error' => 0, 'id' => $lastID, 'em' => $em);
    echo json_encode($error);
    exit();
?>