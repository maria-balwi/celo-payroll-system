<?php 

    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $leave_id = $_POST['id_leave'];
    $action = $_POST['action'];

    if ($action == "approve") {
        $sql = $conn->query("
            UPDATE tbl_leaveapplications SET
            status = 'Approved'
            WHERE requestID = '$leave_id'");
        // ERROR MESSAGE
        $em = "Leave Application Approved Successfully";
        // RESPONSE ARRAY
        $error = array('error' => 0, 'em' => $em);
    }

    else if ($action == "disapprove") {
        $sql = $conn->query("
            UPDATE tbl_leaveapplications SET
            status = 'Disapproved'
            WHERE requestID = '$leave_id'");
        // ERROR MESSAGE
        $em = "Leave Application Disapproved Successfully";
        // RESPONSE ARRAY
        $error = array('error' => 0, 'em' => $em);
    }
    
    echo json_encode($error);
    exit();

?>