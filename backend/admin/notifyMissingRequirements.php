<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $adminID = (int)($_SESSION['id'] ?? 0);
    if (!$adminID) {
        echo json_encode(['error' => 2, 'em' => 'Not logged in']);
        exit();
    }

    $TITLE = 'Missing Requirements';

    $requirements = [
        'req_sss'         => 'SSS',
        'req_pagibig'     => 'Pag-Ibig',
        'req_philhealth'  => 'PhilHealth',
        'req_tin'         => 'TIN',
        'req_nbi'         => 'NBI Clearance',
        'req_medicalexam' => 'Medical Exam',
        'req_2x2pic'      => '2x2 Picture',
        'req_vaccinecard' => 'Vaccine Card',
        'req_psa'         => 'PSA Birth Certificate',
        'req_validid'     => 'Valid ID',
        'req_hellomoney'  => 'HelloMoney',
    ];

    $find     = $conn->prepare("SELECT notificationID, caption FROM tbl_notifications WHERE target_empID = ? AND title = ? LIMIT 1");
    $insert   = $conn->prepare("INSERT INTO tbl_notifications (target_empID, title, caption, photo_path, created_by) VALUES (?, ?, ?, NULL, ?)");
    $update   = $conn->prepare("UPDATE tbl_notifications SET caption = ?, created_at = NOW() WHERE notificationID = ?");
    $delReads = $conn->prepare("DELETE FROM tbl_notification_reads WHERE notificationID = ?");
    $delNotif = $conn->prepare("DELETE FROM tbl_notifications WHERE notificationID = ?");

    $created = $updated = $cleared = 0;

    $result = mysqli_query($conn, "
        SELECT r.*
        FROM tbl_requirements r
        JOIN tbl_employee e ON e.id = r.empID
        WHERE e.e_status = 'Active'
    ");

    while ($row = mysqli_fetch_assoc($result)) {
        $row   = array_change_key_case($row, CASE_LOWER);
        $empID = (int)$row['empid'];

        $missing = [];
        foreach ($requirements as $col => $label) {
            if (!array_key_exists($col, $row)) {
                echo json_encode(['error' => 2, 'em' => "Column not found in tbl_requirements: $col"]);
                exit();
            }
            if (empty($row[$col])) $missing[] = $label;   // 0 or NULL
        }

        $find->bind_param('is', $empID, $TITLE);
        $find->execute();
        $existing = $find->get_result()->fetch_assoc();

        if ($missing) {
            $caption = mb_substr("Please submit your missing requirements:\n• " . implode("\n• ", $missing), 0, 255);

            if (!$existing) {
                $insert->bind_param('issi', $empID, $TITLE, $caption, $adminID);
                $insert->execute();
                $created++;
            } elseif ($existing['caption'] !== $caption) {
                $update->bind_param('si', $caption, $existing['notificationID']);
                $update->execute();
                $delReads->bind_param('i', $existing['notificationID']);
                $delReads->execute();           // shows as unread again
                $updated++;
            }
        } elseif ($existing) {
            $nid = (int)$existing['notificationID'];
            $delReads->bind_param('i', $nid);
            $delReads->execute();
            $delNotif->bind_param('i', $nid);
            $delNotif->execute();
            $cleared++;
        }
    }

    mysqli_query($conn, $employees->auditTrailMemo($adminID, "Admin - Memo Module", "Sent Missing Requirements Notices", 0));

    echo json_encode(['error' => 0, 'em' => "Created: $created, Updated: $updated, Cleared: $cleared"]);
    exit();
?>