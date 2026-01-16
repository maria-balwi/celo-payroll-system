<?php 

    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $ot_id = $_POST['id_ot'];
    $action = $_POST['action'];

    if ($action == "approve") {
        mysqli_query($conn, $employees->approveFiledOT($ot_id));

        // GET AFFECTED USER
        $query = mysqli_query($conn, $employees->viewOTInfo($ot_id));
        $queryDetails = mysqli_fetch_array($query);
        $at_affectedEmpID = $queryDetails['empID'];

        // AUDIT TRAIL
        $at_empID = $_SESSION['id'];
        $at_module = "Admin - OT Form";
        $at_action = "Approved Request";
        mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $at_affectedEmpID));

        // ERROR MESSAGE
        $em = "OT Form Approved Successfully";
        // RESPONSE ARRAY
        $error = array('error' => 0, 'em' => $em);
    }

    else if ($action == "disapprove") {
        mysqli_query($conn, $employees->disapproveFiledOT($ot_id));

        // GET AFFECTED USER
        $query = mysqli_query($conn, $employees->viewOTInfo($ot_id));
        $queryDetails = mysqli_fetch_array($query);
        $at_affectedEmpID = $queryDetails['empID'];

        // AUDIT TRAIL
        $at_empID = $_SESSION['id'];
        $at_module = "Admin - OT Form";
        $at_action = "Disapproved Request";
        mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $at_affectedEmpID));

        // ERROR MESSAGE
        $em = "OT Form Disapproved Successfully";
        // RESPONSE ARRAY
        $error = array('error' => 0, 'em' => $em);
    }
    
    echo json_encode($error);
    exit();

?>