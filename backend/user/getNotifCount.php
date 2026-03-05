<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $empID = (int)($_SESSION['id'] ?? 0);
    if ($empID <= 0) { 
        echo json_encode(['count' => 0]); 
        exit; 
    }

    $sql = "
        SELECT COUNT(*) AS total
        FROM tbl_notifications n
        LEFT JOIN tbl_notification_reads r
        ON r.notificationID = n.notificationID AND r.empID = ?
        WHERE r.id IS NULL
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $empID);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();

    echo json_encode(['count' => (int)$row['total']]);
?>
