<?php 

    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $leave_id = $_POST['id_leave'];
    $action = $_POST['action'];

    if ($action == "approve") {
        mysqli_query($conn, $employees->approveLeave($leave_id));

        // GET AFFECTED USER
        $query = mysqli_query($conn, $employees->viewLeaveInfo($leave_id));
        $queryDetails = mysqli_fetch_array($query);
        $at_affectedEmpID = $queryDetails['empID'];
        
        // AUDIT TRAIL
        $at_empID = $_SESSION['id'];
        $at_module = "Team - Leave Application";
        $at_action = "Approved Request";
        mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $at_affectedEmpID));

        // ERROR MESSAGE
        $em = "Leave Application Approved Successfully";
        // RESPONSE ARRAY
        $error = array('error' => 0, 'em' => $em);
    }

    else if ($action == "disapprove") {
        mysqli_query($conn, $employees->disapproveLeave($leave_id));
        
        // GET AFFECTED USER
        $query = mysqli_query($conn, $employees->viewLeaveInfo($leave_id));
        $queryDetails = mysqli_fetch_array($query);
        $at_affectedEmpID = $queryDetails['empID'];

        // AUDIT TRAIL
        $at_empID = $_SESSION['id'];
        $at_module = "Team - Leave Application";
        $at_action = "Disapproved Request";
        mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $at_affectedEmpID));

        // ERROR MESSAGE
        $em = "Leave Application Disapproved Successfully";
        // RESPONSE ARRAY
        $error = array('error' => 0, 'em' => $em);
    }
    
    echo json_encode($error);
    exit();

?>