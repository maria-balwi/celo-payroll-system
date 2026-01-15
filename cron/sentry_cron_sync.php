<?php 

    require_once __DIR__ . '/../init.php';
    require_once __DIR__ . '/sentry_fetch_logs.php';

    // DATABASE CONNECTION
    $conn = $database->dbConnect();

    // ERROR LOGGING FOR DEBUGGING
    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
    ini_set('error_log', __DIR__ . '/sentry_cron_error.log');

    // GET RECENT SYNC DETAILS
    $lastSyncQuery = mysqli_query($conn, $attendance->getLastSyncDetails());
    $lastSync = $lastSyncQuery->fetch_assoc()['last_sync_datetime'];
    // $lastSync = '2025-01-01 00:00:00';

    // SET START AND END DATE WITH BUFFER
    $startDate = date("Y-m-d", strtotime($lastSync . ' -2 days'));
    $endDate = date("Y-m-d");

    // FETCH EMPLOYEE ID (TBL_ATTENDANCE) / PERSONNEL NUMBER (SENTRY)
    $employees = mysqli_query($conn, $attendance->getEmployeeID());

    $newestLog = $lastSync;

    while ($emp = $employees->fetch_assoc()) {
        $logsJson = $attendance->previewSentryLogs(
            $emp['employeeID'],
            $startDate,
            $endDate
        );
        $logs = json_decode($logsJson, true);
        if (!is_array($logs) || empty($logs)) continue;
        
        // LOOPING THROUGH LOGS
        foreach ($logs as $log) {
            // BUILD DATETIME & NORMALIZE TIMEZONE
            $logDateTime = $log['logdate'] . ' ' . $log['logtime'];
            // $dt = new DateTime($logDateTime, new DateTimeZone('UTC'));
            // $dt->setTimezone(new DateTimeZone('Asia/Manila')); 
            $logDateTime = date('Y-m-d H:i:s', strtotime($logDateTime));
            // $logDateTimeLocal = $dt->format('Y-m-d H:i:s');

            if ($logDateTime <= $lastSync) continue;

            $date = date("Y-m-d", strtotime(($log['logdate'])));
            $time = date("H:i:s", strtotime(($log['logtime'])));
            // $date = $dt->format('Y-m-d');
            // $time = $dt->format('H:i:s');   
            $logTypeID = $log['logtype'] == 0 ? 1 : 4;

            // // CHECK SHIFT SCHEDULE - LATE OR UNDERTIME
            // $shiftQuery = mysqli_query($conn, $users->getShiftInfo($emp['id']));
            // $shiftResult = mysqli_fetch_array($shiftQuery); 
            // $startTime = $shiftResult['startTime'];
            // $endTime = $shiftResult['endTime'];

            // // CONVERT TIME TO TIMESTAMPS
            // $startTimeModified = strtotime($startTime);
            // $endTimeModified = strtotime($endTime);
            // $timeModified = strtotime($time);
            
            // $lateMins = 0; // DEFAULT VALUE FOR LATE MINUTES

            // // CHECK LAST DTR DETAILS
            // $lastAttendanceQuery = mysqli_query($conn, $users->checkLastDTR($emp['id']));
            // $lastAttendance = mysqli_fetch_array($lastAttendanceQuery);
            // $lastLogType = $lastAttendance['logTypeID'];
            // $attendanceLogs = mysqli_num_rows($lastAttendanceQuery);

            // if ($logTypeID == 1) {
            //     if ($lastLogType == 3 || $lastLogType == 4) {
            //         $logTypeID = ($currentTimeModified <= $startTimeModified) ? 1 : 2;
            //         if ($logTypeID == 2) {
            //             // CALCUALTE THE LATE MINUTES
            //             $lates = $currentTimeModified - $startTimeModified;
            //             $lateMins = floor($lates / 60); // GET LATE MMINUTES

            //             // HANDLE CASE IF LATE MINUTES ARE NEGATIVE
            //             if ($lateMins < 0) {
            //                 $lateMins = 0; // RESET TO 0 IF NEGATIVE
            //             }
            //         }
            //     }
            //     else if ($lastLogType == 1 || $lastLogType == 2) {
            //         $lastAttendanceDate = $lastAttendance['attendanceDate'];
            //         $lastAttendanceTime = $lastAttendance['attendanceTime'];

            //         // CREATE DATETIME OBJECTS FROM THE ORIGINAL DATE AND TIME 
            //         $lastAttendanceDateModified = new DateTime($lastAttendanceDate);
            //         $lastAttendanceTimeModified = new DateTime($lastAttendanceTime);

            //         // DROP THE MIINUTES FROM THE TIME
            //         $lastAttendanceTimeModified->setTime($lastAttendanceTimeModified->format('H'), 0, 0);

            //         // DEFINE MIDNIGHT FOR COMPARISON
            //         $midnight = new DateTime("00:00:00");

            //         // MODIFY TIME AND ADJUST DATE IF NEEDED BASED ON LOG TYPE
            //         if ($lastLogType == 1) {
            //             $lastAttendanceTimeModified->modify('+10 hours');
            //         } else {
            //             $lastAttendanceTimeModified->modify('+9 hours');
            //         }

            //         // CHECK IF THE DATE IS PAST MIDNIGHT AND ADJUST THE DATE
            //         if ($lastAttendanceTimeModified->format('H') < 9) {
            //             // DATE ADJUSTED TO NEXT DAY
            //             $lastAttendanceDateModified->modify('+1 day');
            //         }

            //         // FORMAT DATE AND TIME FOR THE DATABASE
            //         $lastAttendanceTimeModified = $lastAttendanceTimeModified->format('H:i:s');
            //         $lastAttendanceDateModified = $lastAttendanceDateModified->format('Y-m-d');

            //         // EXECUTE THE QUERY
            //         mysqli_query($conn, $users->saveMissingDTR($_SESSION['id'], 4, $lastAttendanceDateModified, $lastAttendanceTimeModified));

            //         $logTypeID = ($currentTimeModified <= $startTimeModified) ? 1 : 2;
            //         if ($logTypeID == 2) {
            //             // CALCULATE THE LATE MINUTES
            //             $lates = $currentTimeModified - $startTimeModified;
            //             $lateMins = floor($lates / 60); // GET LATE MIINUTES

            //             // HANDLE CASE IF LATE MINUTES ARE NEGATIVE
            //             if ($lateMins < 0) {
            //                 $lateMins = 0; // RESET TO 0 IF NEGATIVE
            //             }
            //         }
            //     }
            //     else if ($attendanceLogs == 0) {
            //         $logTypeID = ($currentTimeModified <= $startTimeModified) ? 1 : 2;
            //         if ($logTypeID == 2) {
            //             // CALCULATE THE LATE MINUTES
            //             $lates = $currentTimeModified - $startTimeModified;
            //             $lateMins = floor($lates / 60); // GET LATE MINUTES

            //             // HANDLE CASE IF LATE MINUTES ARE NEGATIVE
            //             if ($lateMins < 0) {
            //                 $lateMins = 0; // RESET TO 0 IF NEGATIVE
            //             }
            //         }
            //     }
            // }
            // else if ($logTypeID == 4) {
            //     $logTypeID = ($time >= $endTime) ? 4 : 3;
            //     if ($logTypeID == 3) {
            //         $undertimes = $endTimeModified - $timeModified;
            //         $undertimeMins = floor($undertimes / 60); // GET UNDERTIME IN MINUTES

            //         // HANDLE CASE IF UNDERTIME MINUTES ARE NEGATIVE
            //         if ($undertimeMins < 0) {
            //             $undertimeMins = 0; // RESET TO 0 IF NEGATIVE
            //         }
            //     }
            // }

            $attendanceSource = 'SENTRY';
            $stmt = $conn->prepare("INSERT IGNORE INTO tbl_attendance (empID, logTypeID, attendanceDate, attendanceTime, attendanceSource) VALUES (?,?,?,?,?)");
            $stmt->bind_param(
                'iisss', 
                $emp['id'],
                $logTypeID,
                $date, 
                $time, 
                $attendanceSource
            );

            $stmt->execute();

            if ($logDateTime > $newestLog) {
                $newestLog = $logDateTime;
            }
        }
    }
    // UPDATE SYNC TRACKER
    if ($newestLog > $lastSync) {
        mysqli_query($conn, $attendance->syncLatestAttendance($newestLog));
    }


?>