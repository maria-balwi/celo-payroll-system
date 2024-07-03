<?php 
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $loggedInUserPassword = $_POST['loggedInUserPassword'];
    $password = md5($_POST['password']);
    $userID = $_POST['userID'];

    if ($loggedInUserPassword == $password) {
        $sql = $conn->query("
        UPDATE tbl_users SET
        status = 'Active'
        WHERE userID = '$userID'");

        $em = "User Account Reactivated Successfully";
        $error = array('error' => 0, 'em' => $em);
        echo json_encode($error);
        exit();
    }
    else {
        $em = "Password does not match to the current logged in user.";
        $error = array('error' => 1, 'em' => $em);
        echo json_encode($error);
        exit();
    }
?>