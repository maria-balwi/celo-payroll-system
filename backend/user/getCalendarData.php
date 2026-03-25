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
    SELECT attendanceDate, logTypeID
    FROM tbl_attendance
    WHERE empID = '$employeeID'
    AND DATE_FORMAT(attendanceDate, '%Y-%m') = '$month'
    ";

    $res = mysqli_query($conn, $q1);

    while ($row = mysqli_fetch_assoc($res)) {
        $date = $row['attendanceDate'];
        $calendar[$date]['attendance'][] = $row['logTypeID'];
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
            case 5: return "pl";
            case 6: return "el";
            default: return "lv";
        }
    }

    $q2 = "
    SELECT effectivityStartDate, effectivityEndDate, leaveTypeID, isPaid
    FROM tbl_leaveapplications
    WHERE empID = '$employeeID'
    AND (
        DATE_FORMAT(effectivityStartDate, '%Y-%m') = '$month'
        OR DATE_FORMAT(effectivityEndDate, '%Y-%m') = '$month'
    )
    ";

    $res = mysqli_query($conn, $q2);

    while ($row = mysqli_fetch_assoc($res)) {

        $start = new DateTime($row['effectivityStartDate']);
        $end = new DateTime($row['effectivityEndDate']);

        // loop each day
        while ($start <= $end) {
            $date = $start->format('Y-m-d');    

            $type = getLeaveName($row['leaveTypeID']);

            // CHECK IF PAID FOR SL AND VL
            if (in_array($row['leaveTypeID'], [1, 2])) {
            if ((int)$row['isPaid'] === 1) {
                $type .= "-paid";
            } else {
                $type .= "-unpaid";
            }
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