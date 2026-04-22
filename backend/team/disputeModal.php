<?php 

    include '../../init.php';
    session_start();
    $conn = $database->dbConnect();

    if (isset($_GET['dispute_id'])) {
        $dispute_id = mysqli_real_escape_string($conn, $_GET['dispute_id']);
        $getDisputeQuery = $payroll->getDisputeInfo($dispute_id);
        $getDisputeResult = mysqli_query($conn, $getDisputeQuery);

        $dispute = mysqli_fetch_array($getDisputeResult);

        if ($dispute['attendanceID']) {
            $getAttendanceQuery = $payroll->getAttendanceInfo($dispute['attendanceID']);
            $getAttendanceResult = mysqli_query($conn, $getAttendanceQuery);

            if ($getAttendanceResult === false) {
                echo json_encode([
                    'status' => 404,
                    'message' => 'Query failed',
                    'sql_error' => mysqli_error($conn),
                    'sql' => $getAttendanceQuery
                ]);
                exit;
            }

            if (mysqli_num_rows($getAttendanceResult) == 1) 
            {
                $attendance = mysqli_fetch_array($getAttendanceResult);
                $res = [
                    'status' => 200,
                    'message' => 'Attendance ID found',
                    'data' => $attendance
                ];
                echo json_encode($res);
                exit;
            }
            else
            {
                $res = [
                    'status' => 404,
                    'message' => 'Attendance ID not found' 
                ];
                echo json_encode($res);
                exit;
            }
        }
        else if ($dispute['leaveID']) {
            $getLeaveQuery = $payroll->getLeaveInfo($dispute['leaveID']);
            $getLeaveResult = mysqli_query($conn, $getLeaveQuery);

            if ($getLeaveResult === false) {
                echo json_encode([
                    'status' => 404, 
                    'message' => 'Query failed',
                    'sql_error' => mysqli_error($conn),
                    'sql' => $getLeaveQuery
                ]);
                exit;
            }

            if (mysqli_num_rows($getLeaveResult) == 1) 
            {
                $leave = mysqli_fetch_array($getLeaveResult);
                $res = [
                    'status' => 200, 
                    'message' => 'Leave ID found', 
                    'data' => $leave
                ];
                echo json_encode($res);
                exit;
            }
            else 
            {
                $res = [
                    'status' => 404,
                    'message' => 'Leave ID not found' 
                ];
                echo json_encode($res);
                exit;
            }
        }
        else if ($dispute['overtimeID']) {
            $getOvertimeQuery = $payroll->getOvertimeInfo($dispute['overtimeID']);
            $getOvertimeResult = mysqli_query($conn, $getOvertimeQuery);

            if ($getOvertimeResult === false) {
                echo json_encode([
                    'status' => 404, 
                    'message' => 'Query failed',
                    'sql_error' => mysqli_error($conn),
                    'sql' => $getOvertimeQuery
                ]);
                exit;
            }

            if (mysqli_num_rows($getOvertimeResult) == 1) 
            {
                $overtime = mysqli_fetch_array($getOvertimeResult);
                $res = [
                    'status' => 200, 
                    'message' => 'Overtime ID found', 
                    'data' => $overtime
                ];
                echo json_encode($res);
                exit;
            }
            else 
            {
                $res = [
                    'status' => 404,
                    'message' => 'Overtime ID not found' 
                ];
                echo json_encode($res);
                exit;
            }
        }
    }
?>