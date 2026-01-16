<?php 
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $employeeID = $_SESSION['id'];
    $user = $_POST['user'];
    $otDate = $_POST['otDate'];
    $otType = $_POST['otType'];
    $fromTime = $_POST['fromTime'];
    $toTime = $_POST['toTime'];
    $purpose = $_POST['purpose'];

    // INSERT TO tbl_filedot
    // mysqli_query($conn, $employees->fileOT($employeeID, $otDate, $otType, $fromTime, $toTime, $purpose));
    mysqli_query($conn, $employees->fileOT($user, $otDate, $otType, $fromTime, $toTime, $purpose));

    // GET LAST ID
    $lastIDQuery = mysqli_query($conn, $employees->viewLastOT());
    $lastIDResult = mysqli_fetch_array($lastIDQuery);
    $lastID = $lastIDResult['requestID'];

    $em = "Overtime Filed Successfully";
    $error = array('error' => 0, 'id' => $lastID, 'em' => $em);
    echo json_encode($error);
    exit();
?>