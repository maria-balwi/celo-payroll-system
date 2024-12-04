<?php 

    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $ot_id = $_POST['id_ot'];
    $action = $_POST['action'];

    if ($action == "approve") {
        mysqli_query($conn, $employees->approveFiledOT($ot_id));

        // ERROR MESSAGE
        $em = "OT Form Approved Successfully";
        // RESPONSE ARRAY
        $error = array('error' => 0, 'em' => $em);
    }

    else if ($action == "disapprove") {
        mysqli_query($conn, $employees->disapproveFiledOT($ot_id));

        // ERROR MESSAGE
        $em = "OT Form Disapproved Successfully";
        // RESPONSE ARRAY
        $error = array('error' => 0, 'em' => $em);
    }
    
    echo json_encode($error);
    exit();

?>