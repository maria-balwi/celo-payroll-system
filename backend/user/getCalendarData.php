<?php
    include '../../init.php';
    session_start();
    $conn = $database->dbConnect();

    $employeeID = $_SESSION['id'];
    $month = $_GET['month'];

    $calendar = [];

    /* =========================
    ATTENDANCE
    ========================= */
    $q1 = "
    SELECT attendanceDate, logTypeID, attendanceTime
    FROM tbl_attendance
    WHERE empID = '$employeeID'
    AND DATE_FORMAT(attendanceDate, '%Y-%m') = '$month'
    ";

    $res = mysqli_query($conn, $q1);

    while ($row = mysqli_fetch_assoc($res)) {
        $date = $row['attendanceDate'];
        $logTypeID = (int)$row['logTypeID'];
        $time = date("h:i A", strtotime($row['attendanceTime']));

        // INIT OBJECT
        if (!isset($calendar[$date]['attendance'])) {
            $calendar[$date]['attendance'] = [
                'time_in' => null,
                'time_out' => null,
                'late' => false,
                'undertime' => false
            ];
        }

        // MAP LOG TYPES
        if ($logTypeID == 1) {
            $calendar[$date]['attendance']['time_in'] = $time;
        }
        elseif ($logTypeID == 4) {
            $calendar[$date]['attendance']['time_out'] = $time;
        }
        elseif ($logTypeID == 2) {
            $calendar[$date]['attendance']['late'] = true;
        }
        elseif ($logTypeID == 3) {
            $calendar[$date]['attendance']['undertime'] = true;
        }
    }

    /* =========================
    LEAVES
    ========================= */
    function getLeaveName($leaveTypeID) {
        switch($leaveTypeID) {
            case 1: return "sl";
            case 2: return "vl";
            case 3: return "bl";
            case 4: return "ml";
            case 5: return "ml-solo";
            case 6: return "ml-mis";
            case 7: return "pl";
            case 8: return "spl";
            case 9: return "el";
            default: return "lv";
        }
    }

    $q2 = "
    SELECT effectivityStartDate, effectivityEndDate, leaveTypeID, isPaid
    FROM tbl_leaveapplications
    WHERE empID = '$employeeID'
    AND effectivityStartDate <= LAST_DAY('$month-01') 
    AND effectivityEndDate >= DATE_FORMAT('$month-01', '%Y-%m-01')
    AND status='Approved'
    ";

    $res = mysqli_query($conn, $q2);

    $monthStart = new DateTime($month . "-01");
    $monthEnd = new DateTime($month . "-" . date("t", strtotime($month . "-01")));

    while ($row = mysqli_fetch_assoc($res)) {

        $leaveStart = new DateTime($row['effectivityStartDate']);
        $leaveEnd   = new DateTime($row['effectivityEndDate']);

        // Clamp the leave range to the current month
        $start = max($leaveStart, $monthStart);
        $end   = min($leaveEnd, $monthEnd);

        while ($start <= $end) {
            $date = $start->format('Y-m-d');
            $type = getLeaveName($row['leaveTypeID']);

            // Check if Paid for SL/VL
            if (in_array($row['leaveTypeID'], [1,2])) {
                $type .= ((int)$row['isPaid'] === 1) ? "-paid" : "-unpaid";
            }

            $calendar[$date]['leaves'][] = $type;

            $start->modify('+1 day');
        }
    }

    /* =========================
    OVERTIME
    ========================= */
    $q3 = "
    SELECT otDate, fromTime, toTime
    FROM tbl_filedot
    WHERE empID = '$employeeID'
    AND DATE_FORMAT(otDate, '%Y-%m') = '$month'
    ";

    $res = mysqli_query($conn, $q3);

    while ($row = mysqli_fetch_assoc($res)) {
        $date = $row['otDate'];
        $calendar[$date]['overtime'][] = [
            'fromTime' => $row['fromTime'],
            'toTime' => $row['toTime']
        ];
    }

    // /* =========================
    // HOLIDAYS (Optional)
    // ========================= */
    // $q4 = "
    // SELECT holiday_date, holiday_name
    // FROM tbl_holidays
    // WHERE DATE_FORMAT(holiday_date, '%Y-%m') = '$month'
    // ";

    // $res = mysqli_query($conn, $q4);

    // while ($row = mysqli_fetch_assoc($res)) {
    //     $date = $row['holiday_date'];
    //     $calendar[$date]['holiday'] = $row['holiday_name'];
    // }

    
    /* =========================
    WEEK OFF
    ========================= */
    $q4 = "
    SELECT wo_mon, wo_tue, wo_wed, wo_thu, wo_fri, wo_sat, wo_sun
    FROM tbl_empweekoff
    WHERE empID = '$employeeID'
    LIMIT 1
    ";

    $res = mysqli_query($conn, $q4);
    $weekOff = mysqli_fetch_assoc($res);


    echo json_encode([
        'calendar' => $calendar,
        'weekOff' => $weekOff
    ]);
?>