<?php 
    require_once __DIR__ . '/../init.php';
    require_once __DIR__ . '/sentry_fetch_logs.php';

    // DATABASE CONNECTION
    $conn = $database->dbConnect();

    // ERROR LOGGING FOR DEBUGGING
    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
    ini_set('error_log', __DIR__ . '/sentry_cron_error.log');
    file_put_contents(__DIR__ . '/sentry_cron.log', date('Y-m-d H:i:s') . " TEST\n", FILE_APPEND);

    // GET RECENT SYNC DETAILS
    $lastSyncQuery = mysqli_query($conn, $attendance->getLastSyncDetails());
    $lastSync = $lastSyncQuery->fetch_assoc()['last_sync_datetime'];
    // $lastSync = '2025-01-01 00:00:00';

    // SET START AND END DATE WITH BUFFER
    $startDate = date("Y-m-d", strtotime($lastSync . ' -2 days'));
    $endDateCandidate = date("Y-m-d", strtotime($lastSync . ' +7 days'));
    $endDate = ($endDateCandidate > date("Y-m-d")) ? date("Y-m-d") : $endDateCandidate;

    // FETCH EMPLOYEE ID (TBL_ATTENDANCE) / PERSONNEL NUMBER (SENTRY)
    $employees = mysqli_query($conn, $attendance->getEmployeeID());

    $newestLog = $lastSync;

    while ($emp = $employees->fetch_assoc()) {
        $logs = $attendance->previewSentryLogs(
            $emp['employeeID'],
            $startDate,
            $endDate
        );
        // $logs = json_decode($logsJson, true);
        if (!is_array($logs) || empty($logs)) continue;
        
        // LOOPING THROUGH LOGS
        foreach ($logs as $log) {
            // BUILD DATETIME & NORMALIZE TIMEZONE
            $logDateTime = date('Y-m-d H:i:s',strtotime($log['logdate'] . ' ' . $log['logtime']));

            // if ($logDateTime <= $lastSync) continue;

            $date = date("Y-m-d", strtotime(($log['logdate'])));
            $time = date("H:i:s", strtotime(($log['logtime'])));   
            $logTypeID = $log['logtype'] == 0 ? 1 : 4;

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