<?php 

    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $updateHolidayID = $_POST['updateHolidayID'];
    $updateHolidayName = $_POST['updateHolidayName'];
    $updateDateFrom = $_POST['updateDateFrom'];
    // $updateDateTo = $_POST['updateDateTo'];
    $updateHolidayType = $_POST['updateHolidayType'];

    mysqli_query($conn, $payroll->updateHoliday($updateHolidayID, $updateHolidayName, $updateDateFrom, $updateHolidayType));
    
    // ERROR MESSAGE
    $em = "Holiday Information Updated Successfully";
    // RESPONSE ARRAY
    $error = array('error' => 0, 'em' => $em);
    echo json_encode($error);
    exit();
?>