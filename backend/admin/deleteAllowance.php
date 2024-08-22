<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $id_allowance = $_POST['id_allowance'];
    
    mysqli_query($conn, $employees->deleteAllowance($id_allowance));

    $em = "Allowance Deleted Successfully";
    $error = array('error' => 0, 'em' => $em);
    echo json_encode($error);
    exit();
?>