<?php
    include '../../init.php';
    session_start();
    $conn = $database->dbConnect();

    /**
     * ============================================
     * MAIN PROCESS
     * ============================================
     */

    $payrollCycleFrom = "2026-02-11";
    $payrollCycleTo   = "2026-02-25";
    $extendedTo = date('Y-m-d', strtotime($payrollCycleTo . ' +1 day'));

    $query = mysqli_query($conn, "
        SELECT * FROM tbl_attendance 
        WHERE empID = 3 
        AND logTypeID IN (1,2,3,4) 
        AND attendanceDate BETWEEN '$payrollCycleFrom' AND '$extendedTo'
        ORDER BY attendanceDate ASC, attendanceTime ASC
    ");

    $timeIn = null;
    $timeOut = null;
    $dateIn = null;

    $totalNightHours = 0;
    $totalRegularHolidayHours = 0;
    $totalRegularHolidayNightHours = 0;
    $totalSpecialHolidayHours = 0;
    $totalSpecialHolidayNightHours = 0;

    while ($row = mysqli_fetch_assoc($query)) {

        $attendanceDate = $row['attendanceDate'];
        $attendanceTime = $row['attendanceTime'];
        $logTypeID = $row['logTypeID'];
        $lateMins = $row['lateMins'];

        $currentDateTime = ($attendanceDate . ' ' . $attendanceTime);
        $attendance = new DateTime($attendanceDate . ' ' . $attendanceTime);

        $result = $payroll->calculateNightDifferential(
            $currentDateTime,
            $logTypeID,
            $lateMins,
            $payrollCycleFrom,
            $payrollCycleTo,
            $attendanceDate,
            3
        );

        if ($logTypeID == 1 || $logTypeID == 2) {
            $timeIn = $attendance;
            $dateIn = $attendanceDate;
        }

        // -----------------------------
        // TIME OUT → PROCESS HERE
        // -----------------------------
        if (($logTypeID == 3 || $logTypeID == 4) && $timeIn !== null) {

            $timeOut = $attendance;

            // DEBUG
            echo "Time In: " . $timeIn->format('Y-m-d H:i:s') . "<br>";
            echo "Time Out: " . $timeOut->format('Y-m-d H:i:s') . "<br>";
            echo "ND Hours (Shift): " . $result['totalRegularNightHours'] . "<br>";
            echo "RH Hours (Shift): " . $result['totalRegularHolidayHours'] . "<br>";
            echo "RHN Hours (Shift): " . $result['totalRegularHolidayNightHours'] . "<br>";
            echo "SH Hours (Shift): " . $result['totalSpecialHolidayHours'] . "<br>";
            echo "SHN Hours (Shift): " . $result['totalSpecialHolidayNightHours'] . "<br><br>";

            $totalNightHours += $result['totalRegularNightHours'];
            $totalRegularHolidayHours += $result['totalRegularHolidayHours'];
            $totalRegularHolidayNightHours += $result['totalRegularHolidayNightHours'];
            $totalSpecialHolidayHours += $result['totalSpecialHolidayHours'];
            $totalSpecialHolidayNightHours += $result['totalSpecialHolidayNightHours'];
        }
    }

    // -----------------------------
    // FINAL TOTALS
    // -----------------------------
    echo "<hr>";
    echo "Total Regular Night Hours: " . $totalNightHours . "<br>";
    echo "Total Regular Holiday Hours: " . $totalRegularHolidayHours . "<br>";
    echo "Total Regular Holiday Night Hours: " . $totalRegularHolidayNightHours . "<br>";
    echo "Total Special Holiday Hours: " . $totalSpecialHolidayHours . "<br>";
    echo "Total Special Holiday Night Hours: " . $totalSpecialHolidayNightHours . "<br>";
?>