<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $holidayName = $_POST['holidayName'];
    $holidayDateFrom = $_POST['dateFrom'];
    $holidayDateTo= $_POST['dateTo'];
    $holidayType= $_POST['holidayType'];

    mysqli_query($conn, $payroll->addHoliday($holidayName, $holidayDateFrom, $holidayDateTo, $holidayType));

    $lastIDQuery = mysqli_query($conn, $payroll->viewLastHoliday());
    $lastIDResult = mysqli_fetch_array($lastIDQuery);
    $lastID = $lastIDResult['holidayID'];

    $em = "Holiday Added Successfully";
    $error = array('error' => 0, 'id' => $lastID, 'em' => $em);
    echo json_encode($error);
    exit();
?>