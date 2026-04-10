<?php
    include '../../init.php';
    session_start();
    $conn = $database->dbConnect();

    /**
     * ============================================
     * CALCULATE NIGHT DIFFERENTIAL (SHIFT-BASED)
     * ============================================
     */
    function calculateSegmentHours(
        $attendanceDate,
        $empID,
        $payrollCycleFrom,
        $payrollCycleTo,
        $conn
    ) {

        static $holidays = null;

        // -----------------------------
        // LOAD HOLIDAYS (ONCE)
        // -----------------------------
        if ($holidays === null) {
            $holidays = [];
            $res = mysqli_query($conn, "
                SELECT dateFrom, type 
                FROM tbl_holidays 
                WHERE dateFrom BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo'
            ");

            while ($h = mysqli_fetch_assoc($res)) {
                $holidays[$h['dateFrom']] = $h['type'];
            }
        }

        // -----------------------------
        // GET SHIFT SCHEDULE
        // -----------------------------
        $sch = $conn->query("
            SELECT startTime, endTime
            FROM tbl_employee 
            INNER JOIN tbl_shiftschedule
            ON tbl_employee.shiftID = tbl_shiftschedule.shiftID
            WHERE tbl_employee.id = '$empID'
        ")->fetch_assoc();

        $scheduledStart = new DateTime($attendanceDate . " " . $sch['startTime']);
        $scheduledEnd   = new DateTime($attendanceDate . " " . $sch['endTime']);

        // Handle overnight shift
        if ($scheduledEnd <= $scheduledStart) {
            $scheduledEnd->modify("+1 day");
        }

        $nightHours = 0;
        $regularHolidayHours = 0;
        $regularHolidayNightHours = 0;
        $specialHolidayHours = 0;
        $specialHolidayNightHours = 0;

        // -----------------------------
        // REGULAR HOURS (SHIFT ONLY)
        // -----------------------------
        $interval = $scheduledStart->diff($scheduledEnd);
        $hoursWorked = $interval->h + ($interval->i / 60);

        if (isset($holidays[$attendanceDate])) {
            if ($holidays[$attendanceDate] === "Legal") {
                $regularHolidayHours += $hoursWorked;
            } else {
                $specialHolidayHours += $hoursWorked;
            }
        }

        // -----------------------------
        // NIGHT DIFFERENTIAL
        // -----------------------------
        $baseDate = $scheduledStart->format('Y-m-d');
        $nextDate = (new DateTime($baseDate))->modify('+1 day')->format('Y-m-d');

        // Segment 1: 22:00 → 00:00
        $nightStart1 = new DateTime($attendanceDate . " 22:00");
        $nightEnd1   = new DateTime($nextDate . " 00:00");

        // Segment 2: 00:00 → 06:00
        $nightStart2 = new DateTime($nextDate . " 00:00");
        $nightEnd2   = new DateTime($nextDate . " 06:00");

        // -------- SEGMENT 1 --------
        $seg1Start = max($scheduledStart, $nightStart1);
        $seg1End   = min($scheduledEnd, $nightEnd1);

        if ($seg1Start < $seg1End) {
            $interval = $seg1Start->diff($seg1End);
            $hours = $interval->h + ($interval->i / 60);

            if (isset($holidays[$attendanceDate])) {
                if ($holidays[$attendanceDate] === "Legal") {
                    $regularHolidayNightHours += $hours;
                } else {
                    $specialHolidayNightHours += $hours;
                }
            } else {
                $nightHours += $hours;
            }
        }

        // -------- SEGMENT 2 --------
        $seg2Start = max($scheduledStart, $nightStart2);
        $seg2End   = min($scheduledEnd, $nightEnd2);

        if ($seg2Start < $seg2End) {
            $interval = $seg2Start->diff($seg2End);
            $hours = $interval->h + ($interval->i / 60);

            if (isset($holidays[$nextDate])) {
                if ($holidays[$nextDate] === "Legal") {
                    $regularHolidayNightHours += $hours;
                } else {
                    $specialHolidayNightHours += $hours;
                }
            } else {
                $nightHours += $hours;
            }
        }

        // =============================
        // BREAK DEDUCTION (1 HOUR)
        // =============================

        // Example break: 02:00 → 03:00 (next day)
        $breakStart = new DateTime($nextDate . " 02:00");
        $breakEnd   = new DateTime($nextDate . " 03:00");

        // Check overlap with shift
        $breakOverlapStart = max($scheduledStart, $breakStart);
        $breakOverlapEnd   = min($scheduledEnd, $breakEnd);

        if ($breakOverlapStart < $breakOverlapEnd) {
            $interval = $breakOverlapStart->diff($breakOverlapEnd);
            $breakHours = $interval->h + ($interval->i / 60);

            // Deduct from NIGHT HOURS ONLY
            $nightHours -= $breakHours;

            if ($nightHours < 0) {
                $nightHours = 0;
            }
        }

        return [
            'nightHours' => $nightHours,
            'regularHolidayHours' => $regularHolidayHours,
            'regularHolidayNightHours' => $regularHolidayNightHours,
            'specialHolidayHours' => $specialHolidayHours,
            'specialHolidayNightHours' => $specialHolidayNightHours
        ];
    }


    /**
     * ============================================
     * MAIN PROCESS
     * ============================================
     */

    $payrollFrom = "2026-02-11";
    $payrollTo   = "2026-02-25";
    $extendedTo = date('Y-m-d', strtotime($payrollTo . ' +1 day'));

    $query = mysqli_query($conn, "
        SELECT * FROM tbl_attendance 
        WHERE empID = 3 
        AND logTypeID IN (1,2,3,4) 
        AND attendanceDate BETWEEN '$payrollFrom' AND '$extendedTo'
        ORDER BY attendanceDate ASC, attendanceTime ASC
    ");

    $timeIn = null;
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

        $currentDateTime = new DateTime($attendanceDate . ' ' . $attendanceTime);

        // -----------------------------
        // TIME IN
        // -----------------------------
        if ($logTypeID == 1 || $logTypeID == 2) {
            $timeIn = clone $currentDateTime;
            $dateIn = $attendanceDate;
        }

        // -----------------------------
        // TIME OUT → PROCESS HERE
        // -----------------------------
        if (($logTypeID == 3 || $logTypeID == 4) && $timeIn !== null) {

            $timeOut = clone $currentDateTime;

            if ($timeOut < $timeIn) {
                $timeOut->modify('+1 day');
            }

            // 🔥 FILTER: only count shifts within payroll range
            if ($dateIn < $payrollFrom || $dateIn > $payrollTo) {
                $timeIn = null;
                $dateIn = null;
                continue;
            }

            $result = calculateSegmentHours(
                $dateIn,
                3,
                $payrollFrom,
                $payrollTo,
                $conn
            );

            $totalNightHours += $result['nightHours'];
            $totalRegularHolidayHours += $result['regularHolidayHours'];
            $totalRegularHolidayNightHours += $result['regularHolidayNightHours'];
            $totalSpecialHolidayHours += $result['specialHolidayHours'];
            $totalSpecialHolidayNightHours += $result['specialHolidayNightHours'];

            // DEBUG
            echo "Time In: " . $timeIn->format('Y-m-d H:i:s') . "<br>";
            echo "Time Out: " . $timeOut->format('Y-m-d H:i:s') . "<br>";
            echo "ND Hours (Shift): " . $result['nightHours'] . "<br>";
            echo "RH Hours (Shift): " . $result['regularHolidayHours'] . "<br>";
            echo "RHN Hours (Shift): " . $result['regularHolidayNightHours'] . "<br>";
            echo "SH Hours (Shift): " . $result['specialHolidayHours'] . "<br>";
            echo "SHN Hours (Shift): " . $result['specialHolidayNightHours'] . "<br><br>";

            // RESET
            $timeIn = null;
            $dateIn = null;
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