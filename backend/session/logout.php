<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    $users->logout();

    $em = "Logged out Successfully";
    $error = array('error' => 0, 'em' => $em);
    echo json_encode($error);
    exit();
?>