<?php 

    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $ot_id = $_POST['id_ot'];
    $action = $_POST['action'];

    if ($action == "approve") {
        $filedOTQuery = mysqli_query($conn, $employees->viewOT($ot_id));
        $filedOTResult = mysqli_fetch_array($filedOTQuery);
        $actualOThours = $filedOTResult['actualOThours'];
        $actualOTmins = $filedOTResult['actualOTmins'] == NULL ? NULL : $filedOTResult['actualOTmins'];
        echo $actualOTmins;

        $sql = $conn->query("
            UPDATE tbl_filedot SET
            status = 1
            WHERE requestID = '$ot_id'");
        // ERROR MESSAGE
        $em = "OT Form Approved Successfully";
        // RESPONSE ARRAY
        $error = array('error' => 0, 'em' => $em);
    }

    else if ($action == "disapprove") {
        $sql = $conn->query("
            UPDATE tbl_filedot SET
            status = 0
            WHERE requestID = '$ot_id'");
        // ERROR MESSAGE
        $em = "OT Form Disapproved Successfully";
        // RESPONSE ARRAY
        $error = array('error' => 0, 'em' => $em);
    }
    
    echo json_encode($error);
    exit();

?>