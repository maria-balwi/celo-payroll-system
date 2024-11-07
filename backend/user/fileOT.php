<?php 
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $employeeID = $_SESSION['id'];
    $otDate = $_POST['otDate'];
    $otType = $_POST['otType'];
    $actualOThours = $_POST['actualOThours'];
    $actualOTmins = $_POST['actualOTmins'];
    $purpose = $_POST['purpose'];

    if ($actualOTmins == 0 || $actualOTmins == null) {
        mysqli_query($conn, $employees->fileOT_null($employeeID, $otDate, $otType, $actualOThours, $actualOTmins, $purpose));
    }
    else {
        mysqli_query($conn, $employees->fileOT($employeeID, $otDate, $otType, $actualOThours, $actualOTmins, $purpose));
    }

    $lastIDQuery = mysqli_query($conn, $employees->viewLastOT());
    $lastIDResult = mysqli_fetch_array($lastIDQuery);
    $lastID = $lastIDResult['requestID'];

    $em = "Overtime Filed Successfully";
    $error = array('error' => 0, 'id' => $lastID, 'em' => $em);
    echo json_encode($error);
    exit();
?>