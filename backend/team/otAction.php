<?php 

    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $ot_id = $_POST['id_ot'];
    $action = $_POST['action'];

    if ($action == "approve") {
        $sql = $conn->query("
            UPDATE tbl_filedot SET
            status = 'Approved'
            WHERE requestID = '$ot_id'");
        // ERROR MESSAGE
        $em = "OT Form Approved Successfully";
        // RESPONSE ARRAY
        $error = array('error' => 0, 'em' => $em);
    }

    else if ($action == "disapprove") {
        $sql = $conn->query("
            UPDATE tbl_filedot SET
            status = 'Disapproved'
            WHERE requestID = '$ot_id'");
        // ERROR MESSAGE
        $em = "OT Form Disapproved Successfully";
        // RESPONSE ARRAY
        $error = array('error' => 0, 'em' => $em);
    }
    
    echo json_encode($error);
    exit();

?>