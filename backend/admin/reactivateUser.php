<?php 
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $loggedInUserPassword = $_POST['loggedInUserPassword'];
    $password = md5($_POST['password']);
    $userID = $_POST['userID'];

    if ($loggedInUserPassword == $password) {
        mysqli_query($conn, $employees->reactivateUser($userID));

        // GET AFFECTED USER
        $query = mysqli_query($conn, $employees->viewUser($userID));
        $queryDetails = mysqli_fetch_array($query);
        $at_affectedEmpID = $queryDetails['empID'];

        // AUDIT TRAIL
        $at_empID = $_SESSION['id'];
        $at_module = "Admin - User List";
        $at_action = "Reactivated User";
        mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $at_affectedEmpID));

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