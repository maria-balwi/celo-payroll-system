<?php 

    require_once __DIR__ . '/../init.php';
    require_once __DIR__ . '/sentry_fetch_logs.php';

    // DATABASE CONNECTION
    $conn = $database->dbConnect();

    // ERROR LOGGING FOR DEBUGGING
    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
    ini_set('error_log', __DIR__ . '/sentry_cron_error.log');

    // --- DEBUG ---
    echo "Starting Sentry sync debug...<br>";

    // GET RECENT SYNC DETAILS
    // For local testing, hardcode last sync far in the past
    $lastSync = '2025-01-01 00:00:00';
    echo "Last sync datetime: $lastSync<br>";

    // SET START AND END DATE
    $startDate = date("Y-m-d", strtotime($lastSync));
    $endDate = date("Y-m-d");
    echo "Fetching logs from $startDate to $endDate<br>";

    // FETCH EMPLOYEES
    $employees = mysqli_query($conn, $attendance->getEmployeeID());
    if (!$employees) {
        die("Failed to fetch employees: " . mysqli_error($conn) . "\n");
    }

    $newestLog = $lastSync;

    // LOOP THROUGH EMPLOYEES
    while ($emp = $employees->fetch_assoc()) {
        echo "Processing employee: {$emp['employeeID']} (DB id: {$emp['id']})";

        // FETCH LOGS FROM SENTRY
        $logsJson = fetchSentryLogs($emp['employeeID'], $startDate, $endDate);
        $logs = json_decode($logsJson, true);
        if (!is_array($logs) || empty($logs)) {
            echo "  No logs returned from Sentry for this employee.<br>";
            continue;
        }

        // LOOP THROUGH LOGS
        foreach ($logs as $log) {
            echo "  Log fetched: " . print_r($log, true) . "\n";
            $logDateTime = $log['logdate'] . ' ' . $log['logtime'];

            if ($logDateTime <= $lastSync) {
                echo "    Skipped: LogDateTime <= lastSync\n";
                continue;
            }

            $date = date("Y-m-d", strtotime($log['logdate']));
            $time = date("H:i:s", strtotime($log['logtime']));
            $logTypeID = $log['logtype'] == 0 ? 1 : 4;

            echo "    Inserting: empID={$emp['id']}, logTypeID={$logTypeID}, date={$date}, time={$time}\n";

            // ADD LOGS INTO TBL_ATTENDANCE
            $stmt = $conn->prepare("INSERT IGNORE INTO tbl_attendance (empID, logTypeID, attendanceDate, attendanceTime) VALUES (?,?,?,?)");
            if (!$stmt) {
                echo "    Prepare failed: " . $conn->error . "\n";
                continue;
            }

            $stmt->bind_param('iiss', $emp['id'], $logTypeID, $date, $time);
            if (!$stmt->execute()) {
                echo "    Insert failed: " . $stmt->error . "\n";
            } else {
                echo "    Insert successful\n";
            }

            if ($logDateTime > $newestLog) {
                $newestLog = $logDateTime;
            }
        }
    }

    // OPTIONAL: Update sync tracker (comment out for initial local testing)
    echo "Newest log datetime processed: $newestLog\n";
    // mysqli_query($conn, $attendance->syncLatestAttendance($newestLog));

    echo "Sentry sync debug complete.\n";

?>
