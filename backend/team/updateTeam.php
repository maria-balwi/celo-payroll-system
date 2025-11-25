<?php
  include '../../init.php';
  $conn = $database->dbConnect();
  session_start();
  
  $updateID = $_POST['updateID'];

  if (isset($_POST['update_wo_mon'])) {
        $wo_mon = 1;
    }
    else {
        $wo_mon = 0;
    }

    if (isset($_POST['update_wo_tue'])) {
        $wo_tue = 1;
    }
    else {
        $wo_tue = 0;
    }

    if (isset($_POST['update_wo_wed'])) {
        $wo_wed = 1;
    }
    else {
        $wo_wed = 0;
    }

    if (isset($_POST['update_wo_thu'])) {
        $wo_thu = 1;
    }
    else {
        $wo_thu = 0;
    }

    if (isset($_POST['update_wo_fri'])) {
        $wo_fri = 1;
    }
    else {
        $wo_fri = 0;
    }

    if (isset($_POST['update_wo_sat'])) {
        $wo_sat = 1;
    }
    else {
        $wo_sat = 0;
    }

    if (isset($_POST['update_wo_sun'])) {
        $wo_sun = 1;
    }
    else {
        $wo_sun = 0;
    }

    mysqli_query($conn, $employees->updateEmployeeWeekOff($updateID, $wo_mon, $wo_tue, $wo_wed, $wo_thu, $wo_fri, $wo_sat, $wo_sun));
	// SUCCESSFULLY UPDATED FILE
    $em = "Team Updated Successfully";
    $error = array('error' => 0, 'em' => $em);
    echo json_encode($error);
    exit();
?>