<?php 

    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $dataType = $_POST['dataType'];
    $empID = $_SESSION['id'];
    $remarks = $_POST['remarks'];

    if ($dataType == 1) {
        $attendanceDate_timeIn = $_POST['attendanceDate_timeIn'];
        $attendanceTime_timeIn = $_POST['attendanceTime_timeIn'];
        $attendanceDate_timeOut = $_POST['attendanceDate_timeOut'];
        $attendanceTime_timeOut = $_POST['attendanceTime_timeOut'];
        $logTypeID_timeIn = $_POST['logTypeID_timeIn'];
        $logTypeID_timeOut = $_POST['logTypeID_timeOut'];

        // FILE ATTENDANCE DISPUTE
        mysqli_query($conn, $payroll->fileAttendanceDispute($empID, $attendanceDate_timeIn, $attendanceTime_timeIn, $logTypeID_timeIn, $attendanceDate_timeOut, $attendanceTime_timeOut, $logTypeID_timeOut, $remarks));

        // GET LAST DISPUTE ID
        $lastDisputeIDQuery = mysqli_query($conn, $payroll->viewLastDisputeAttendance());
        $lastDisputeIDDetails = mysqli_fetch_array($lastDisputeIDQuery);
        $lastDisputeID = $lastDisputeIDDetails['attendanceID'];

        // INSERT INTO DISPUTES TABLE
        mysqli_query($conn, $payroll->addDispute_attendance($lastDisputeID, $remarks));

        $lastIDQuery = mysqli_query($conn, $payroll->viewLastDisputeID());
        $lastIDDetails = mysqli_fetch_array($lastIDQuery);
        $lastID = $lastIDDetails['disputeID'];

        // // AUDIT TRAIL
        // $at_empID = $_SESSION['id'];
        // $at_module = "Admin - Dispute";
        // $at_action = "Filed Attendance Dispute";
        // mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $empID));

        // ERROR MESSAGE
        $em = "Attendance Dispute Filed Successfully";
        // RESPONSE ARRAY
        $error = array('error' => 0, 'id' => $lastID, 'em' => $em);
    }
    else if ($dataType == 2) {
        $leaveType = $_POST['leaveType'];
        $leaveStartDate = $_POST['leaveStartDate'];
        $leaveEndDate = $_POST['leaveEndDate'];

        if (isset($_POST['withAttachment']))
        {
            $attachment = 1;
        }
        else if (isset($_POST['withoutAttachment']))
        {
            $attachment = 0;
        }
        else {
            $attachment = 0;
        }

        // FILE LEAVE DISPUTE
        mysqli_query($conn, $payroll->fileLeaveDispute($empID, $leaveType, $leaveStartDate, $leaveEndDate, $attachment));

        // GET LAST DISPUTE ID
        $lastDisputeIDQuery = mysqli_query($conn, $payroll->viewLastDisputeLeave());
        $lastDisputeIDDetails = mysqli_fetch_array($lastDisputeIDQuery);
        $lastDisputeID = $lastDisputeIDDetails['leaveID'];

        // INSERT INTO DISPUTES TABLE
        mysqli_query($conn, $payroll->addDispute_leave($lastDisputeID, $remarks));

        // // AUDIT TRAIL
        // $at_empID = $_SESSION['id'];
        // $at_module = "Admin - Dispute";
        // $at_action = "Filed Leave Dispute";
        // mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $empID));

        // GET LAST DISPUTE ID
        $lastIDQuery = mysqli_query($conn, $payroll->viewLastDisputeID());
        $lastIDDetails = mysqli_fetch_array($lastIDQuery);
        $lastID = $lastIDDetails['disputeID'];

        // ERROR MESSAGE
        $em = "Leave Dispute Filed Successfully";
        // RESPONSE ARRAY
        $error = array('error' => 0, 'id' => $lastID, 'em' => $em);
    }
    else if ($dataType == 3) {
        $overtimeOTDate = $_POST['overtimeOTDate'];
        $otType = $_POST['otType'];
        $overtimeFromTime = $_POST['overtimeFromTime'];
        $overtimeToTime = $_POST['overtimeToTime'];

        // FILE OVERTIME DISPUTE
        mysqli_query($conn, $payroll->fileOvertimeDispute($empID, $overtimeOTDate, $otType, $overtimeFromTime, $overtimeToTime));

        // GET LAST DISPUTE ID
        $lastDisputeIDQuery = mysqli_query($conn, $payroll->viewLastDisputeOvertime());
        $lastDisputeIDDetails = mysqli_fetch_array($lastDisputeIDQuery);
        $lastDisputeID = $lastDisputeIDDetails['overtimeID'];

        // INSERT INTO DISPUTES TABLE
        mysqli_query($conn, $payroll->addDispute_overtime($lastDisputeID, $remarks));

        // GET LAST DISPUTE ID
        $lastIDQuery = mysqli_query($conn, $payroll->viewLastDisputeID());
        $lastIDDetails = mysqli_fetch_array($lastIDQuery);
        $lastID = $lastIDDetails['disputeID'];

        // // AUDIT TRAIL   
        // $at_empID = $_SESSION['id'];
        // $at_module = "Admin - Dispute";
        // $at_action = "Filed Overtime Dispute";
        // mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $empID));

        // ERROR MESSAGE
        $em = "Overtime Dispute Filed Successfully";
        // RESPONSE ARRAY
        $error = array('error' => 0, 'id' => $lastID, 'em' => $em);
    }

    echo json_encode($error);
    exit();
?>