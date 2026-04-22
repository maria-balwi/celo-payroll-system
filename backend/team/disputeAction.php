<?php 

    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $action = $_POST['action'];

    if ($action == "fileDispute") {
        $dataType = $_POST['dataType'];
        $empID = $_POST['empID'];
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

            // AUDIT TRAIL
            $at_empID = $_SESSION['id'];
            $at_module = "Admin - Dispute";
            $at_action = "Filed Attendance Dispute";
            mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $empID));

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
        $type = $_POST['type'];

        if ($type == "attendance") {
            $getAttendanceQuery = $payroll->getAttendanceInfo($dispute['attendanceID']);
            $getAttendanceResult = mysqli_query($conn, $getAttendanceQuery);

            $attendance = mysqli_fetch_array($getAttendanceResult);
            $empID = $attendance['empID'];
            $attendanceDate_timeIn = $attendance['date_timeIn'];
            $attendanceTime_timeIn = $attendance['attendanceTime_timeIn'];
            $logType_timeIn = $attendance['logTypeID_timeIn'];
            $attendanceDate_timeOut = $attendance['date_timeOut'];
            $attendanceTime_timeOut = $attendance['attendanceTime_timeOut'];
            $logType_timeOut = $attendance['logTypeID_timeOut'];
            $lateMins = $attendance['lateMins'];
            $undertimeMins = $attendance['undertimeMins'];

            // INSERT INTO DTR TABLE
            if ($logType_timeIn == 2) { // LATE
                mysqli_query($conn, $users->saveDTRLate($_SESSION['id'], $logTypeID, $currentDate, $currentTime, $lateMins));
            }
            else {
                mysqli_query($conn, $users->saveDTR($empID, $logType_timeIn, $attendanceDate_timeIn, $attendanceTime_timeIn));
            }
            
            if ($logType_timeOut == 3) { // UNDERTIME
                mysqli_query($conn, $users->saveDTRUndertime($empID, $logType_timeOut, $attendanceDate_timeOut, $attendanceTime_timeOut, $undertimeMins));
            }
            else {
                mysqli_query($conn, $users->saveDTR($empID, $logType_timeOut, $attendanceDate_timeOut, $attendanceTime_timeOut));
            }

            // UPDATE DISPUTE STATUS
            mysqli_query($conn, $payroll->updateDisputeStatus($disputeID, "Approved"));

            // AUDIT TRAIL
            $at_empID = $_SESSION['id'];
            $at_module = "Admin - Dispute";
            $at_action = "Approved Attendance Dispute";
            mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $empID));

            // ERROR MESSAGE
            $em = "Attendance Dispute Approved Successfully";
            // RESPONSE ARRAY
            $error = array('error' => 0, 'id' => $disputeID, 'em' => $em);
        }
        else if ($type == "leave") {
            $getLeaveQuery = $payroll->getLeaveInfo($dispute['leaveID']);
            $getLeaveResult = mysqli_query($conn, $getLeaveQuery);
            $isPaid = $_POST['isPaid'];

            $leave = mysqli_fetch_array($getLeaveResult);
            $empID = $leave['empID'];
            $dateFiled = $leave['dateFiled'];
            $leaveType = $leave['leaveTypeID'];
            $startDate = $leave['effectivityStartDate'];
            $endDate = $leave['effectivityEndDate'];
            $attachment = $leave['attachment'];
            $remarks = $leave['remarks'] . " - (From Disputes)";
            $status = "Approved";

            
            // INSERT INTO LEAVE APPLICATIONS TABLE
            if ($leaveType == 1 || $leaveType == 3 || $leaveType == 4 || $leaveType == 5 || $leaveType == 6 || $leaveType == 7 || $leaveType == 8) {
                mysqli_query($conn, $payroll->fileLeaveWithAttachment($empID, $leaveType, $startDate, $endDate, $remarks, $status, $attachment, $isPaid));
                
                if ($isPaid == 1) {
                    if ($leaveType == 1) {
                        mysqli_query($conn, $employees->deductSickLeave($empID));
                    }
                    else if ($leaveType == 2 || $leaveType == 6) {
                        mysqli_query($conn, $employees->deductVacationLeave($empID));
                    }
                }
            }
            else {
                mysqli_query($conn, $payroll->fileLeave($empID, $leaveType, $startDate, $endDate, $remarks, $status, $isPaid));

                if ($isPaid == 1) {
                    if ($leaveType == 1) {
                        mysqli_query($conn, $employees->deductSickLeave($empID));
                    }
                    else if ($leaveType == 2 || $leaveType == 6) {
                        mysqli_query($conn, $employees->deductVacationLeave($empID));
                    }
                }
            }

            // UPDATE ISPAID
            mysqli_query($conn, $payroll->updateLeaveStatus($dispute['leaveID'], $isPaid));

            // UPDATE DISPUTE STATUS
            mysqli_query($conn, $payroll->updateDisputeStatus($disputeID, "Approved"));

            // AUDIT TRAIL
            $at_empID = $_SESSION['id'];
            $at_module = "Admin - Dispute";
            $at_action = "Approved Leave Dispute";
            mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $empID));

            // ERROR MESSAGE
            $em = "Leave Dispute Approved Successfully";
            // RESPONSE ARRAY
            $error = array('error' => 0, 'id' => $disputeID, 'em' => $em);
        }
        else if ($type == "overtime") {
            $getOvertimeQuery = $payroll->getOvertimeInfo($dispute['overtimeID']);
            $getOvertimeResult = mysqli_query($conn, $getOvertimeQuery);
            $isPaid = $_POST['isPaid'];

            $overtime = mysqli_fetch_array($getOvertimeResult);
            $empID = $overtime['empID'];
            $dateFiled = $overtime['filedDate'];
            $otDate = $overtime['overtimeDate'];
            $otType = $overtime['otType'];
            $fromTime = $overtime['fromTime'];
            $toTime = $overtime['toTime'];
            $remarks = $overtime['remarks'] . " - (From Disputes)";
            $status = 1;
            
            // INSERT INTO OVERTIME TABLE
            mysqli_query($conn, $payroll->fileOT($empID, $dateFiled, $otDate, $otType, $fromTime, $toTime, $remarks, $status, $isPaid));

            // UPDATE ISPAID
            mysqli_query($conn, $payroll->updateOvertimeStatus($dispute['overtimeID'], $isPaid));
            
            // UPDATE DISPUTE STATUS
            mysqli_query($conn, $payroll->updateDisputeStatus($disputeID, "Approved"));
            
            // AUDIT TRAIL
            $at_empID = $_SESSION['id'];
            $at_module = "Admin - Dispute";
            $at_action = "Approved Overtime Dispute";
            mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $empID));
            
            // ERROR MESSAGE
            $em = "Overtime Dispute Approved Successfully";
            // RESPONSE ARRAY
            $error = array('error' => 0, 'id' => $disputeID, 'em' => $em);
        }
    }

    else if ($action == "disapprove") {
        $disputeID = $_POST['id_dispute'];
        $getDisputeQuery = $payroll->getDisputeInfo($disputeID);
        $getDisputeResult = mysqli_query($conn, $getDisputeQuery);
        $dispute = mysqli_fetch_array($getDisputeResult);
        $type = $_POST['type'];

        if ($type == "attendance") {
            $getAttendanceQuery = $payroll->getAttendanceInfo($dispute['attendanceID']);
            $getAttendanceResult = mysqli_query($conn, $getAttendanceQuery);

            $attendance = mysqli_fetch_array($getAttendanceResult);
            $empID = $attendance['empID'];

            // UPDATE DISPUTE STATUS
            mysqli_query($conn, $payroll->updateDisputeStatus($disputeID, "Disapproved"));

            // AUDIT TRAIL
            $at_empID = $_SESSION['id'];
            $at_module = "Admin - Dispute";
            $at_action = "Disapproved Attendance Dispute";
            mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $empID));

            // ERROR MESSAGE
            $em = "Attendance Dispute Disapproved Successfully";
            // RESPONSE ARRAY
            $error = array('error' => 0, 'id' => $disputeID, 'em' => $em);
        }
        else if ($type == "leave") {
            $getLeaveQuery = $payroll->getLeaveInfo($dispute['leaveID']);
            $getLeaveResult = mysqli_query($conn, $getLeaveQuery);

            $leave = mysqli_fetch_array($getLeaveResult);
            $empID = $leave['empID'];

            // UPDATE DISPUTE STATUS
            mysqli_query($conn, $payroll->updateDisputeStatus($disputeID, "Disapproved"));

            // AUDIT TRAIL
            $at_empID = $_SESSION['id'];
            $at_module = "Admin - Dispute";
            $at_action = "Disapproved Leave Dispute";
            mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $empID));

            // ERROR MESSAGE
            $em = "Leave Dispute Disapproved Successfully";
            // RESPONSE ARRAY
            $error = array('error' => 0, 'id' => $disputeID, 'em' => $em);
        }
        else if ($type == "overtime") {
            $getOvertimeQuery = $payroll->getOvertimeInfo($dispute['overtimeID']);
            $getOvertimeResult = mysqli_query($conn, $getOvertimeQuery);

            $overtime = mysqli_fetch_array($getOvertimeResult);
            $empID = $overtime['empID'];

            // UPDATE DISPUTE STATUS
            mysqli_query($conn, $payroll->updateDisputeStatus($disputeID, "Disapproved"));

            // AUDIT TRAIL
            $at_empID = $_SESSION['id'];
            $at_module = "Admin - Dispute";
            $at_action = "Disapproved Overtime Dispute";
            mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $empID));

            // ERROR MESSAGE
            $em = "Overtime Dispute Disapproved Successfully";
            // RESPONSE ARRAY
            $error = array('error' => 0, 'id' => $disputeID, 'em' => $em);
        }
    }
    
    echo json_encode($error);
    exit();

?>