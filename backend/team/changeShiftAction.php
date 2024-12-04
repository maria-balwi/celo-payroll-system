<?php 

    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $changeshift_id = $_POST['id_changeshift'];
    $action = $_POST['action'];

    if ($action == "approve") {
        mysqli_query($conn, $employees->approveChangeShift($changeshift_id));

        // GET AFFECTED USER
        $getChangeshiftQuery = mysqli_query($conn, $employees->viewChangeShiftInfo($changeshift_id));
        $changeShiftResult = mysqli_fetch_array($getChangeshiftQuery);
        $id = $changeShiftResult['empID'];
        $requestedShift = $changeShiftResult['requestedShift'];
        mysqli_query($conn, $employees->updateShift($id, $requestedShift));

        // AUDIT TRAIL
        $at_empID = $_SESSION['id'];
        $at_module = "Team - Change Shift Request";
        $at_action = "Approved Request";
        mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $id));
        
        // ERROR MESSAGE
        $em = "Change Shift Request Approved Successfully";
        // RESPONSE ARRAY
        $error = array('error' => 0, 'em' => $em);
    }

    else if ($action == "disapprove") {
        mysqli_query($conn, $employees->disapproveChangeShift($changeshift_id));

        // GET AFFECTED USER
        $getChangeshiftQuery = mysqli_query($conn, $employees->viewChangeShiftInfo($changeshift_id));
        $changeShiftResult = mysqli_fetch_array($getChangeshiftQuery);
        $id = $changeShiftResult['empID'];
        $requestedShift = $changeShiftResult['requestedShift'];
        mysqli_query($conn, $employees->updateShift($id, $requestedShift));
        
        // AUDIT TRAIL
        $at_empID = $_SESSION['id'];
        $at_module = "Team - Change Shift Request";
        $at_action = "Disapproved Request";
        mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $id));

        // ERROR MESSAGE
        $em = "Change Shift Request Disapproved Successfully";
        // RESPONSE ARRAY
        $error = array('error' => 0, 'em' => $em);
    }
    
    echo json_encode($error);
    exit();

?>