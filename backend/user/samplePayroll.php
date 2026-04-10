<?php
    include '../../init.php';
    session_start();
    $conn = $database->dbConnect();

    function calculateSegmentHours($start, $end, $payrollCycleFrom, $payrollCycleTo, $attendanceDate, $empID, $totalRegularNightHours, $totalRegularHolidayHours, $totalRegularHolidayNightHours, $totalSpecialHolidayHours, $totalSpecialHolidayNightHours, $conn, $nightHours) {
        $nightDifferential = 0;
        // -----------------------------
        // 1. LOAD HOLIDAYS
        // -----------------------------
        static $holidays = null;
    
        if ($holidays === null) {
            $holidays = [];
            $res = mysqli_query($conn, "SELECT dateFrom, type FROM tbl_holidays WHERE dateFrom BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo'");
            while ($h = mysqli_fetch_assoc($res)) {
                $holidays[$h['dateFrom']] = $h['type']; // Legal 
            }
        }
    
        // -----------------------------
        // 2. SHIFT SCHEDULE
        // -----------------------------
        $sch = $conn->query("
            SELECT startTime, endTime
            FROM tbl_employee 
            INNER JOIN tbl_shiftschedule
            ON tbl_employee.shiftID = tbl_shiftschedule.shiftID
            WHERE tbl_employee.id = '$empID'
        ")->fetch_assoc();
    
        $shiftStartTime = $sch['startTime'];
        $shiftEndTime   = $sch['endTime']; 
    
        // $scheduledStart = new DateTime($attendanceDate . " " . $shiftStartTime);
        // $scheduledEnd   = new DateTime($attendanceDate . " " . $shiftEndTime);
    
        // if ($scheduledEnd <= $scheduledStart) {
        //     $scheduledEnd->modify("+1 day");
        // }
    
        // -----------------------------
        // 3. CLAMP TO SHIFT
        // -----------------------------
        // $clampedStart = max($start, $scheduledStart);
        // $clampedEnd   = min($end, $scheduledEnd);
        $scheduledStart = new DateTime($attendanceDate . " " . $shiftStartTime);
        $scheduledEnd   = new DateTime($attendanceDate . " " . $shiftEndTime);

        if ($scheduledEnd <= $scheduledStart) {
            $scheduledEnd->modify("+1 day");
        }
    
        // -----------------------------
        // 4. REGULAR HOURS
        // -----------------------------
        if ($scheduledEnd > $scheduledStart) {
            $interval = $scheduledStart->diff($scheduledEnd);
            $hoursWorked = $interval->h + ($interval->i / 60);
    
            if (isset($holidays[$attendanceDate])) {
                if ($holidays[$attendanceDate] === "Legal") {
                    $totalRegularHolidayHours += $hoursWorked;
                } else {
                    $totalSpecialHolidayHours += $hoursWorked;
                }
            }
        }
    
        // =====================================================
        // 5. NIGHT DIFFERENTIAL (FIXED - SPLIT SEGMENTS)
        // =====================================================
    
        $baseDate = $scheduledStart->format('Y-m-d');
        $nextDate = (new DateTime($baseDate))->modify('+1 day')->format('Y-m-d');
    
        // Segment 1: 22:00 → 00:00 (same day)
        $nightStart1 = new DateTime($attendanceDate . " 22:00");
        $nightEnd1 = new DateTime($nextDate . " 00:00");
    
        // Segment 2: 00:00 → 06:00 (next day)
        $nightStart2 = new DateTime($nextDate . " 00:00");
        $nightEnd2   = new DateTime($nextDate . " 06:00");
    
    
        // ---------- SEGMENT 1 ----------
        $seg1Start = max($scheduledStart, $nightStart1);
        $seg1End   = min($scheduledEnd, $nightEnd1);
    
        if ($seg1Start < $seg1End) {
            $interval = $seg1Start->diff($seg1End);
            $hours = $interval->h + ($interval->i / 60);
            // $hours = floor(($seg1End->getTimestamp() - $seg1Start->getTimestamp()) / 3600);
    
            if (isset($holidays[$attendanceDate])) {
                if ($holidays[$attendanceDate] === "Legal") {
                    $totalRegularHolidayNightHours += $hours;
                } else {
                    $totalSpecialHolidayNightHours += $hours;
                }
            } else {
                $totalRegularNightHours += $hours;
                $nightHours += $hours;
            }
        }
    
        // ---------- SEGMENT 2 ----------
        $seg2Start = max($scheduledStart, $nightStart2);
        $seg2End   = min($scheduledEnd, $nightEnd2);
    
        if ($seg2Start < $seg2End) {
            $interval = $seg2Start->diff($seg2End);
            $hours = $interval->h + ($interval->i / 60);
            // $hours = floor(($seg2End->getTimestamp() - $seg2Start->getTimestamp()) / 3600);
    
            // IMPORTANT: next day holiday check
            if (isset($holidays[$nextDate])) {
                if ($holidays[$nextDate] === "Legal") {
                    $totalRegularHolidayNightHours += $hours;
                } else {
                    $totalSpecialHolidayNightHours += $hours;
                }
            } else {
                $totalRegularNightHours += $hours;
                $nightHours += $hours;
            }
        }

        return [
            'nightHours' => $nightHours,
            'totalRegularNightHours' => $totalRegularNightHours,
            'totalRegularHolidayHours' => $totalRegularHolidayHours,
            'totalRegularHolidayNightHours' => $totalRegularHolidayNightHours,
            'totalSpecialHolidayHours' => $totalSpecialHolidayHours,
            'totalSpecialHolidayNightHours' => $totalSpecialHolidayNightHours
        ];
    }

    $payrollFrom = "2026-02-11";
    $payrollTo = "2026-02-25";
    $attendanceQuery = mysqli_query($conn, "SELECT * FROM tbl_attendance WHERE empID = 3 AND logTypeID IN (1,2,3,4) AND attendanceDate BETWEEN '$payrollFrom' AND '$payrollTo' ORDER BY attendanceDate ASC, attendanceTime ASC");
    // $attendanceData = mysqli_fetch_all($attendanceQuery, MYSQLI_ASSOC);

    // echo "<pre>";
    // print_r($attendanceData);
    // echo "</pre>";
    $nightHours = 0;
    $totalNightHours = 0;
    $totalRegularHolidayHours = 0;
    $totalRegularHolidayNightHours = 0;
    $totalSpecialHolidayHours = 0;
    $totalSpecialHolidayNightHours = 0;

    while ($attendanceLogs = mysqli_fetch_array($attendanceQuery)) {
        static $timeIn = null;
        static $timeOut = null;
        static $dateIn = null;

        $attendanceDate = $attendanceLogs['attendanceDate'];
        $attendanceTime = $attendanceLogs['attendanceTime'];
        $fullDateTime = $attendanceDate . ' ' . $attendanceTime;
        $logTypeID = $attendanceLogs['logTypeID'];
        $lateMins = $attendanceLogs['lateMins'];

        if ($logTypeID == 1 || $logTypeID == 2) {
            $timeIn = new DateTime($attendanceDate . ' ' . $attendanceTime);
            $dateIn = $attendanceDate;
        }
        
        if ($logTypeID == 3 || $logTypeID == 4) {
            $timeOut = new DateTime($attendanceDate . ' ' . $attendanceTime);
        }

        if ($timeIn && $timeOut) {
            if ($timeOut < $timeIn) {
                $timeOut->modify('+1 day');
            }

            $nightDifferential = calculateSegmentHours($timeIn, $timeOut, $payrollFrom, $payrollTo, $dateIn, 3, $totalNightHours, $totalRegularHolidayHours, $totalRegularHolidayNightHours, $totalSpecialHolidayHours, $totalSpecialHolidayNightHours, $conn, $nightHours);

            $nightHours = $nightDifferential['nightHours'];
            $totalNightHours = $nightDifferential['totalRegularNightHours'];
            $totalRegularHolidayHours = $nightDifferential['totalRegularHolidayHours'];
            $totalRegularHolidayNightHours = $nightDifferential['totalRegularHolidayNightHours'];
            $totalSpecialHolidayHours = $nightDifferential['totalSpecialHolidayHours'];
            $totalSpecialHolidayNightHours = $nightDifferential['totalSpecialHolidayNightHours'];

            if ($timeIn !== null && $timeOut !== null) {
                echo "Time In: " . $timeIn->format('Y-m-d H:i:s') . "<br>";
                echo "Time Out: " . $timeOut->format('Y-m-d H:i:s') . "<br>";
            }

            echo "Total Night Hours of Shift: " . $nightHours . "<br>";
            echo "Total Regular Night Hours: " . $totalNightHours . "<br>";
            echo "Total Regular Holiday Hours: " . $totalRegularHolidayHours . "<br>";
            echo "Total Regular Holiday Night Hours: " . $totalRegularHolidayNightHours . "<br>";
            echo "Total Special Holiday Hours: " . $totalSpecialHolidayHours . "<br>";
            echo "Total Special Holiday Night Hours: " . $totalSpecialHolidayNightHours . "<br><br>";

            $timeIn = null;
            $timeOut = null;
            $dateIn = null;
        }
        
        // // Call the calculateNightDifferential function
        // $nightDifferential = $payroll->calculateNightDifferential($fullDateTime, $logTypeID, $lateMins, $payrollFrom, $payrollTo, $attendanceDate, 3);
        
        // $nightHours = $nightDifferential['totalRegularNightHours'];
        // $totalNightHours += $nightDifferential['totalRegularNightHours'];
        // $totalRegularHolidayHours += $nightDifferential['totalRegularHolidayHours'];
        // $totalRegularHolidayNightHours += $nightDifferential['totalRegularHolidayNightHours'];
        // $totalSpecialHolidayHours += $nightDifferential['totalSpecialHolidayHours'];
        // $totalSpecialHolidayNightHours += $nightDifferential['totalSpecialHolidayNightHours'];

        // if ($timeIn !== null && $timeOut !== null) {
        //     echo "Time In: " . $timeIn->format('Y-m-d H:i:s') . "<br>";
        //     echo "Time Out: " . $timeOut->format('Y-m-d H:i:s') . "<br>";
        // }

        // echo "Total Night Hours of Shift: " . $nightHours . "<br>";
        // echo "Total Regular Night Hours: " . $totalNightHours . "<br>";
        // echo "Total Regular Holiday Hours: " . $totalRegularHolidayHours . "<br>";
        // echo "Total Regular Holiday Night Hours: " . $totalRegularHolidayNightHours . "<br>";
        // echo "Total Special Holiday Hours: " . $totalSpecialHolidayHours . "<br>";
        // echo "Total Special Holiday Night Hours: " . $totalSpecialHolidayNightHours . "<br><br>";
    }
    echo "<br>";
    echo "Total Regular Night Hours: " . $totalNightHours . "<br>";
    echo "Total Regular Holiday Hours: " . $totalRegularHolidayHours . "<br>";
    echo "Total Regular Holiday Night Hours: " . $totalRegularHolidayNightHours . "<br>";
    echo "Total Special Holiday Hours: " . $totalSpecialHolidayHours . "<br>";
    echo "Total Special Holiday Night Hours: " . $totalSpecialHolidayNightHours . "<br>";

?>
