<?php 

    include '../../init.php';
    session_start();
    $conn = $database->dbConnect();

    if (isset($_GET['disputeID'])) {
        $dispute_id = mysqli_real_escape_string($conn, $_GET['disputeID']);
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
                    'message' => 'Attendance found',
                    'data' => $attendance
                ];
                echo json_encode($res);
                exit;
            }
        }
        else if ($dispute['leaveID']) {
            
        }
        else if ($dispute['overtimeID']) {
            
        }
        
        if (mysqli_num_rows($getCashAdvanceResult) == 1)
        {
            $payrollCutoffStart = $cashAdvance['payrollCutoffStart'];
            $payrollCutoffEnd = $cashAdvance['payrollCutoffEnd'];
            $caBreakdown = [];

            if ($payrollCutoffStart > $payrollCutoffEnd) {
                $maxCycle = 24;
                $minCycle = 1;

                $caBreakdownQuery = mysqli_query($conn, $payroll->viewCABreakdown($payrollCutoffStart, $maxCycle));
                while ($caBreakdownResult = mysqli_fetch_array($caBreakdownQuery)) {
                    $caBreakdown[] = $caBreakdownResult;
                }
                $caBreakdownQuery = mysqli_query($conn, $payroll->viewCABreakdown($minCycle, $payrollCutoffEnd));
            }
            else {
                $caBreakdownQuery = mysqli_query($conn, $payroll->viewCABreakdown($payrollCutoffStart, $payrollCutoffEnd));
            }
            while ($caBreakdownResult = mysqli_fetch_array($caBreakdownQuery)) {
                $caBreakdown[] = $caBreakdownResult;
            }

            $caPaymentHistory = [];
            $caPaymentHistoryQuery = mysqli_query($conn, $payroll->viewCAPaymentHistory($request_id));
            while ($caPaymentHistoryResult = mysqli_fetch_array($caPaymentHistoryQuery)) {
                $caPaymentHistory[] = $caPaymentHistoryResult;
            }
            
            $res = [
                'status' => 200,
                'message' => 'Cash Advance Fetch Successfully by id',
                'data' => $cashAdvance,
                'caBreakdown' => $caBreakdown, 
                'caPaymentHistory' => $caPaymentHistory
            ];

            echo json_encode($res);
            return;
        }
        else
        {
            $res = [
                'status' => 404,
                'message' => 'Cash Advance id not found'
            ];
            echo json_encode($res);
            return;
        } 
    }
?>