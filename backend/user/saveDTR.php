<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    if (isset($_POST['imgBase64'])) {
        $img = $_POST['imgBase64'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);

        $id = $_SESSION['id'];
        $faceDTR_action = $_POST['faceDTR_action'];

        $shiftQuery = mysqli_query($conn, $users->getShiftInfo($id));
        $shiftResult = mysqli_fetch_array($shiftQuery); 
        $startTime = $shiftResult['startTime'];
        $endTime = $shiftResult['endTime'];

        // SETTING TIMEZONE
        date_default_timezone_set('Asia/Manila');
        $currentTime = date('H:i:s');

        // SETTING LOG TYPE ID BASED ON ACTION
        if ($faceDTR_action == 'time_in') 
        {
            $logTypeID = ($currentTime <= $startTime) ? 1 : 2;
        }
        else if ($faceDTR_action == 'time_out')
        {
            $logTypeID = ($currentTime >= $endTime) ? 4 : 3;
        }
        echo 'startTime: ' . $startTime . '<br>';
        echo 'endTime: ' . $endTime . '<br>';
        echo 'currentTime: ' . $currentTime . '<br>';
        echo 'logTypeID: ' . $logTypeID;

        // ENSURE THE 'UPLOADS' DIRECTORY EXISTS
        $baseDir = '../../assets/';
        $uploadDir = $baseDir . 'uploads/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // GENERATE CUSTOM FILE NAME USING USER EMPLOYEE ID, DATE, AND ACTION
        $fileName = isset($_POST['faceDTR_action']) ? preg_replace('/-/', '', $_SESSION['employeeID']) . '_' . date("Y.m.d") . '_' . $_POST['faceDTR_action'] . '.png' : 'image_' . uniqid() . '.png';

        mysqli_query($conn, $users->saveDTR($_SESSION['id'], $logTypeID));

        // SAVE THE FILE
        $file = $uploadDir. '/' . $fileName;
        $success = file_put_contents($file, $data);

        echo $success ? $file : 'Unable to save the file.';
    } else {
        echo 'No image data found.';
    }
    exit();
?>