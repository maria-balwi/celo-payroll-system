<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $empID = (int)($_SESSION['id'] ?? 0);
    $notifID = (int)($_POST['notificationID'] ?? 0);

    if ($empID <= 0 || $notifID <= 0) {
        $error = array('error' => 1, 'em' => 'Invalid ID');
        echo json_encode($error);
        exit;
    }

    $sql = "INSERT IGNORE INTO tbl_notification_reads (notificationID, empID) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $notifID, $empID);
    $stmt->execute();

    $error = array('error' => 0, 'em' => 'Successfully marked as read');
    echo json_encode($error);
    exit();
?>