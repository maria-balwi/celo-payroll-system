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

    $payrollcycleStart = 0;
    $payrollcycleEnd = 0;
    $maxCycle = 24;
    $cutoffs = $monthsToPay * 2;

    function formatDate($date) {
        // GET CURRENT YEAR
        $currentYear = date('Y');

        // APPEND THE CURRENT YEAR TO THE INPUT DATE
        $dateWithYear = $date . '-' . $currentYear;

        // CREATE DATETIME OBJECT FROM THE STRING AND RETURN THE FORMATTED DATE
        $dateTime = DateTime::createFromFormat('m-d-Y', $dateWithYear);

        return $dateTime->format('Y-m-d');
    }

    $cutoffStartDate = new DateTime($cutoffStart);

    $payrollcycleQuery = mysqli_query($conn, $payroll->viewAvailablePayrollCycle());
    while ($payrollCycleDetails = mysqli_fetch_array($payrollcycleQuery)) {
        $cycleID = $payrollCycleDetails['payrollCycleID'];
        $from = DateTime::createFromFormat('m-d', $payrollCycleDetails['payrollCycleFrom']);
        $to = DateTime::createFromFormat('m-d', $payrollCycleDetails['payrollCycleTo']);

        // Adjust year for cycles that span year end
        $from->setDate($cutoffStartDate->format('Y'), $from->format('m'), $from->format('d'));
        $to->setDate($cutoffStartDate->format('Y'), $to->format('m'), $to->format('d'));
        if ($to < $from) {
            // cycle wraps to next year
            $to->modify('+1 year');
        }

        if ($cutoffStartDate >= $from && $cutoffStartDate <= $to) {
            $payrollcycleStart = $cycleID;
            $payrollcycleEnd = (($payrollcycleStart - 1 + $cutoffs - 1) % $maxCycle) + 1;
            break; // found the correct cycle
        }
    }


    // INSERT TO tbl_cashAdvance
    mysqli_query($conn, $employees->fileCashAdvance($id, $amount, $monthsToPay, $monthlyAmmortization, $remainingAmount, $cutoffStart, $payrollcycleStart, $payrollcycleEnd, $ca_status, $requestorID, $request_status));

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