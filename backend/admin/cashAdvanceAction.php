<?php 

    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $request_id = $_POST['id_request'];
    $action = $_POST['action'];

    if ($action == "approve") {
        mysqli_query($conn, $employees->approveCashAdvance($request_id));

        // GET AFFECTED USER
        $query = mysqli_query($conn, $employees->viewCashAdvanceInfo($request_id));
        $queryDetails = mysqli_fetch_array($query);
        $at_affectedEmpID = $queryDetails['empID'];
        
        // AUDIT TRAIL
        $at_empID = $_SESSION['id'];
        $at_module = "Admin - Cash Advance Application";
        $at_action = "Approved Application";
        mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $at_affectedEmpID));

        // ERROR MESSAGE
        $em = "Cash Advance Application Approved Successfully";
        // RESPONSE ARRAY
        $error = array('error' => 0, 'em' => $em);
    }

    else if ($action == "disapprove") {
        mysqli_query($conn, $employees->disapproveCashAdvance($request_id));
        
        // GET AFFECTED USER
        $query = mysqli_query($conn, $employees->viewCashAdvanceInfo($request_id));
        $queryDetails = mysqli_fetch_array($query);
        $at_affectedEmpID = $queryDetails['empID'];

        // AUDIT TRAIL
        $at_empID = $_SESSION['id'];
        $at_module = "Admin - Cash Advance Application";
        $at_action = "Disapproved Application";
        mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $at_affectedEmpID));
        
        // ERROR MESSAGE
        $em = "Cash Advance Application Disapproved Successfully";
        // RESPONSE ARRAY
        $error = array('error' => 0, 'em' => $em);
    }
    
    echo json_encode($error);
    exit();

?>