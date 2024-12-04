<?php 

    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $userID = $_POST['id_user'];

    mysqli_query($conn, $employees->deactivateUser($userID));

    // GET AFFECTED USER
    $query = mysqli_query($conn, $employees->viewUser($userID));
    $queryDetails = mysqli_fetch_array($query);
    $at_affectedEmpID = $queryDetails['empID'];

    // AUDIT TRAIL
    $at_empID = $_SESSION['id'];
    $at_module = "Admin - User List";
    $at_action = "Deactivated User";
    mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $at_affectedEmpID));
    
    // ERROR MESSAGE
    $em = "User Account Deactivated Successfully";
    // RESPONSE ARRAY
    $error = array('error' => 0, 'em' => $em);
    echo json_encode($error);
    exit();
?>