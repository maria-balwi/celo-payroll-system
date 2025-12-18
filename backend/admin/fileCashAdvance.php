<?php 
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $requestorID = $_SESSION['id'];
    $id = $_POST['id'];
    $amount = $_POST['amount'];
    $monthsToPay = $_POST['monthsToPay'];
    $monthlyAmmortization = $_POST['monthlyAmmortization'];
    $remainingAmount = $_POST['remainingAmount'];
    $cutoffStart = $_POST['cutoffStart'];
    $ca_status = "New";
    $request_status = "Pending";
    
    // INSERT TO tbl_cashAdvance
    mysqli_query($conn, $employees->fileCashAdvance($id, $amount, $monthsToPay, $monthlyAmmortization, $remainingAmount, $cutoffStart, $ca_status, $requestorID, $request_status));

    // GET LAST ID
    $lastIDQuery = mysqli_query($conn, $employees->viewLastCashAdvance());
    $lastIDResult = mysqli_fetch_array($lastIDQuery);
    $lastID = $lastIDResult['requestID'];

     // AUDIT TRAIL
    $at_empID = $_SESSION['id'];
    $at_module = "Team - Cash Advance";
    $at_action = "Filed Cash Advance";
    mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $id));

    $em = "Cash Advance Filed Successfully";
    $error = array('error' => 0, 'id' => $lastID, 'em' => $em);
    echo json_encode($error);
    exit();
?>