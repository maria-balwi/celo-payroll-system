<?php 

    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $userID = $_POST['id_user'];

    $sql = $conn->query("
        UPDATE tbl_users SET
        status = 'Inactive'
        WHERE userID = '$userID'");
    
    // ERROR MESSAGE
    $em = "User Account Deactivated Successfully";
    // RESPONSE ARRAY
    $error = array('error' => 0, 'em' => $em);
    echo json_encode($error);
    exit();
?>