<?php 

    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $changeshift_id = $_POST['id_changeshift'];
    $action = $_POST['action'];

    if ($action == "approve") {
        $sql = $conn->query("
            UPDATE tbl_changeshiftrequests SET
            status = 'Approved'
            WHERE requestID = '$changeshift_id'");
        // ERROR MESSAGE
        $em = "Change Shift Request Approved Successfully";
        // RESPONSE ARRAY
        $error = array('error' => 0, 'em' => $em);
    }

    else if ($action == "disapprove") {
        $sql = $conn->query("
            UPDATE tbl_changeshiftrequests SET
            status = 'Disapproved'
            WHERE requestID = '$changeshift_id'");
        // ERROR MESSAGE
        $em = "Change Shift Request Disapproved Successfully";
        // RESPONSE ARRAY
        $error = array('error' => 0, 'em' => $em);
    }
    
    echo json_encode($error);
    exit();

?>