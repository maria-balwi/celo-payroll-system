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

    mysqli_query($conn, $employees->fileOT($employeeID, $otDate, $actualOThours, $actualOTmins, $purpose, $status));

    $em = "Overtime Filed Successfully";
    $error = array('error' => 0, 'em' => $em);
    echo json_encode($error);
    exit();
?>