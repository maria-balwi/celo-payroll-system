<?php 

    include '../../init.php';
    session_start();
    $conn = $database->dbConnect();

    if (isset($_GET['notification_id'])) {
        $notification_id = mysqli_real_escape_string($conn, $_GET['notification_id']);
        $getNotificationQuery = $employees->getNotificationInfo($notification_id);
        $getNotificationResult = mysqli_query($conn, $getNotificationQuery);

        if(mysqli_num_rows($getNotificationResult) == 1)
        {
            $notification = mysqli_fetch_array($getNotificationResult);
            
            $res = [
                'status' => 200,
                'message' => 'Notification Fetch Successfully by id',
                'data' => $notification
            ];

            echo json_encode($res);
            return;
        }
        else
        {
            $res = [
                'status' => 404,
                'message' => 'Notification id not found'
            ];
            echo json_encode($res);
            return;
        } 
    }
?>