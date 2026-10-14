<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $empID   = (int)($_SESSION['id'] ?? 0);
    $notifID = (int)($_POST['notificationID'] ?? 0);

    if ($empID <= 0 || $notifID <= 0) {
        echo json_encode(['error' => 1, 'em' => 'Invalid ID']);
        exit;
    }

    $sql = "
        INSERT INTO tbl_notification_reads (notificationID, empID)
        SELECT n.notificationID, ?
        FROM tbl_notifications n
        WHERE n.notificationID = ?
          AND (n.target_empID IS NULL OR n.target_empID = ?)
          AND NOT EXISTS (
              SELECT 1 FROM tbl_notification_reads r
              WHERE r.notificationID = n.notificationID AND r.empID = ?
          )
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiii", $empID, $notifID, $empID, $empID);
    $stmt->execute();

    echo json_encode(['error' => 0, 'em' => 'Successfully marked as read']);
    exit();
?>