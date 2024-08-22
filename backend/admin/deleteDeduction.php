<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $id_deduction = $_POST['id_deduction'];
    
    mysqli_query($conn, $employees->deleteDeduction($id_deduction));

    $em = "Deduction Deleted Successfully";
    $error = array('error' => 0, 'em' => $em);
    echo json_encode($error);
    exit();
?>