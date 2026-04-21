<?php 

    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $action = $_POST['action'];
    $type = $_POST['type'];

    if ($action == "fileDispute") {
        $dataType = $_POST['dataType'];
        $empID = $_POST['empID'];
        $remarks = $_POST['remarks'];

        if ($dataType == 1) {
            $attendanceDate_timeIn = $_POST['attendanceDate_timeIn'];
            $attendanceTime_timeIn = $_POST['attendanceTime_timeIn'];
            $attendanceDate_timeOut = $_POST['attendanceDate_timeOut'];
            $attendanceTime_timeOut = $_POST['attendanceTime_timeOut'];

            // FILE ATTENDANCE DISPUTE
            mysqli_query($conn, $payroll->fileAttendanceDispute($empID, $attendanceDate_timeIn, $attendanceTime_timeIn, $attendanceDate_timeOut, $attendanceTime_timeOut));

            // GET LAST DISPUTE ID
            $lastDisputeIDQuery = mysqli_query($conn, $payroll->viewLastDisputeAttendance());
            $lastDisputeIDDetails = mysqli_fetch_array($lastDisputeIDQuery);
            $lastDisputeID = $lastDisputeIDDetails['attendanceID'];

            // INSERT INTO DISPUTES TABLE
            mysqli_query($conn, $payroll->addDispute_attendance($lastDisputeID, $remarks));

            // AUDIT TRAIL
            $at_empID = $_SESSION['id'];
            $at_module = "Admin - Dispute";
            $at_action = "Filed Attendance Dispute";
            mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $empID));

            // ERROR MESSAGE
            $em = "Attendance Dispute Filed Successfully";
            // RESPONSE ARRAY
            $error = array('error' => 0, 'em' => $em);
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

            // AUDIT TRAIL
            $at_empID = $_SESSION['id'];
            $at_module = "Admin - Dispute";
            $at_action = "Filed Leave Dispute";
            mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $empID));

            // ERROR MESSAGE
            $em = "Leave Dispute Filed Successfully";
            // RESPONSE ARRAY
            $error = array('error' => 0, 'em' => $em);
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

            // AUDIT TRAIL
            $at_empID = $_SESSION['id'];
            $at_module = "Admin - Dispute";
            $at_action = "Filed Overtime Dispute";
            mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $empID));

            // ERROR MESSAGE
            $em = "Overtime Dispute Filed Successfully";
            // RESPONSE ARRAY
            $error = array('error' => 0, 'em' => $em);
        }
    }
    else if ($action == "approve") {
        $disputeID = $_POST['id_dispute'];
        $getDisputeQuery = $payroll->getDisputeInfo($disputeID);
        $getDisputeResult = mysqli_query($conn, $getDisputeQuery);
        $dispute = mysqli_fetch_array($getDisputeResult);

        if ($type == "attendance") {
            $getAttendanceQuery = $payroll->getAttendanceInfo($dispute['attendanceID']);
            $getAttendanceResult = mysqli_query($conn, $getAttendanceQuery);

            $attendance = mysqli_fetch_array($getAttendanceResult);
            $
        }
        else if ($type == "leave") {
        
        }
        else if ($type == "overtime") {
        
        }
        

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
        if ($type == "attendance") {

        }
        else if ($type == "leave") {
        
        }
        else if ($type == "overtime") {
        
        }
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