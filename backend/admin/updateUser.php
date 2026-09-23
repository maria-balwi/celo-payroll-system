<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $userID = $_POST['updateUserID'];
    $levelID = $_POST['updateLevelID'];
    $activated = $_POST['updateStatus'] == 'Activated' ? 1 : 0;

    $employeeQuery = mysqli_query($conn, $users->updateUser($userID, $levelID, $activated));

    $em = "User Update Successfully!";
    $error = array('error' => 0, 'em' => $em);
    echo json_encode($error);
    exit();
?>