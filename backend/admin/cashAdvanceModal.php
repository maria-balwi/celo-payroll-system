<?php 

    include '../../init.php';
    session_start();
    $conn = $database->dbConnect();

    function formatDate($date) {
        // GET CURRENT YEAR
        $currentYear = date('Y');

        // APPEND THE CURRENT YEAR TO THE INPUT DATE
        $dateWithYear = $date . '-' . $currentYear;

        // CREATE DATETIME OBJECT FROM THE STRING AND RETURN THE FORMATTED DATE
        $dateTime = DateTime::createFromFormat('m-d-Y', $dateWithYear);

        return $dateTime->format('Y-m-d');
    }

    if (isset($_GET['requestID'])) {
        $request_id = mysqli_real_escape_string($conn, $_GET['requestID']);
        $getCashAdvanceQuery = $payroll->getCashAdvanceInfo($request_id);
        $getCashAdvanceResult = mysqli_query($conn, $getCashAdvanceQuery);

        $cashAdvance = mysqli_fetch_array($getCashAdvanceResult);
        
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