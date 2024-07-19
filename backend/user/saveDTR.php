<?php
    session_start();

    if (isset($_POST['imgBase64'])) {
        $img = $_POST['imgBase64'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);

        // ENSURE THE 'UPLOADS' DIRECTORY EXISTS
        $baseDir = '../../assets/';
        $uploadDir = $baseDir . 'uploads/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // GENERATE CUSTOM FILE NAME USING USER EMPLOYEE ID, DATE, AND ACTION
        // $fileName = isset($_POST['fileName']) ? preg_replace('/[^A-Za-z0-9_\-]/', '', $_POST['fileName']) . '.png' : 'image_' . uniqid() . '.png';
        $fileName = isset($_POST['faceDTR_action']) ? preg_replace('/-/', '', $_SESSION['employeeID']) . '_' . date("Y.m.d") . '_' . $_POST['faceDTR_action'] . '.png' : 'image_' . uniqid() . '.png';

        // SAVE THE FILE
        $file = $uploadDir. '/' . $fileName;
        $success = file_put_contents($file, $data);

        echo $success ? $file : 'Unable to save the file.';
    } else {
        echo 'No image data found.';
    }
?>