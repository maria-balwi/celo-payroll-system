<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $empID = (int)($_SESSION['id'] ?? 0);
    if ($empID <= 0) { 
        echo json_encode(['items' => []]); 
        exit; 
    }

    // LIMITED TO 3 NOTIFS ONLY
    // $sql = "
    //     SELECT n.notificationID, n.photo_path, n.created_at, n.title,
    //             CASE WHEN r.notificationID IS NULL THEN 0 ELSE 1 END AS is_read
    //     FROM tbl_notifications n
    //     LEFT JOIN tbl_notification_reads r
    //         ON r.notificationID = n.notificationID AND r.empID = ?
    //     ORDER BY n.created_at DESC
    //     LIMIT 3
    // ";

    $sql = "
        SELECT n.notificationID, n.photo_path, n.created_at, n.title,
                CASE WHEN r.notificationID IS NULL THEN 0 ELSE 1 END AS is_read
        FROM tbl_notifications n
        LEFT JOIN tbl_notification_reads r
            ON r.notificationID = n.notificationID AND r.empID = ?
        ORDER BY n.created_at DESC
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $empID);
    $stmt->execute();
    $res = $stmt->get_result();

    $items = [];
    while ($r = $res->fetch_assoc()) {
    $items[] = [
        'notificationID' => (int)$r['notificationID'],
        'photo_path' => $r['photo_path'],
        'title' => $r['title'] ?? '',
        'created_at' => $r['created_at'],
        'is_read' => (int)$r['is_read']
    ];
    }
    echo json_encode(['items' => $items]);
?>
