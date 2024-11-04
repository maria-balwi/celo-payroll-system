<?php 

    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $id_holiday = $_POST['id_holiday'];

    mysqli_query($conn, $payroll->deleteHoliday($id_holiday));
    
    // ERROR MESSAGE
    $em = "Holiday Delete Successfully";
    // RESPONSE ARRAY
    $error = array('error' => 0, 'em' => $em);
    echo json_encode($error);
    exit();
?>