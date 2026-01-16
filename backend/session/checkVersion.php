<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();
    
    // Fetch the current version from the database
    $result = mysqli_query($conn, $users->checkVersion());

    if ($result) {
        $row = $result->fetch_assoc();
        echo json_encode(['version' => $row['version']]);
    } else {
        echo json_encode(['error' => 'Failed to fetch version']);
    }
    exit();
?>