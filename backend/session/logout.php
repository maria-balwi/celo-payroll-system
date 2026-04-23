<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    // AUDIT TRAIL
    $at_empID = $_SESSION['id'];
    $at_module = "Login Page";
    $at_action = "User logged out";
    mysqli_query($conn, $employees->auditTrailLoginLogout($at_empID, $at_module, $at_action));

    $users->logout();

    $em = "Logged out Successfully";
    $error = array('error' => 0, 'em' => $em);
    echo json_encode($error);
    exit();
?>