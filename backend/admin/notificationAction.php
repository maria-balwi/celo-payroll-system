<?php 
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    if (isset($_POST['action']) && $_POST['action'] == "add") {
        $title   = trim($_POST['notificationName'] ?? '');
        $titleHolder = str_replace(' ', '', $title);
        $action = $_POST['action'];
        $empID = $_SESSION['id'];

        if (!isset($_FILES['notificationPhoto']) || $_FILES['notificationPhoto']['error'] !== UPLOAD_ERR_OK) {
            die("Upload failed.");
        }

        if (isset($_FILES['notificationPhoto']) && $_FILES['notificationPhoto']['error'] == 0) {
            // DIRECTORY TO SAVE UPLOADED PHOTO
            $uploadDir = __DIR__ . '/../../assets/images/notifications/';

            // CHECK THE DIRECTORY FOLDER IF EXISTING, IF NOT CREATES IT
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // GENERATE NEW FILE NAME
            $newFileName = $titleHolder . '.png';
            $uploadFile = $uploadDir . $newFileName;
            $photoPath = '../assets/images/notifications/' . $newFileName;

            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (in_array($_FILES['notificationPhoto']['type'], $allowedTypes)) {
                if (move_uploaded_file($_FILES['notificationPhoto']['tmp_name'], $uploadFile)) {
                    // ADD NOTIFICATION QUERY
                    mysqli_query($conn, $employees->addNotification($title, $photoPath, $empID));

                    $lastIDQuery = mysqli_query($conn, $employees->viewLastNotificationAdded());
                    $lastIDResult = mysqli_fetch_array($lastIDQuery);
                    $lastID = $lastIDResult['notificationID'];

                    $em = "Memo Added Successfully";
                    $error = ['error' => 0, 'id' => $lastID, 'em' => $em];
                } else {
                    $em = "Failed to move uploaded file.";
                    $error = ['error' => 2, 'em' => $em];
                }
            } else {
                $em = "Invalid file type";
                $error = ['error' => 2, 'em' => $em];
            }
        } else {
            $em = "No file uploaded.";
            $error = ['error' => 2, 'em' => $em];
        }

    }
    else if (isset($_POST['action']) && $_POST['action'] == "update") {
        $updateTitle   = trim($_POST['updateTitle'] ?? '');
        $title = str_replace(' ', '', $updateTitle);
        $notificationID = $_POST['updateNotificationID'] ?? ''; 
        $isUploadPhoto = $_POST['isUploadPhoto'];

        $oldPhotoQuery = mysqli_query($conn, $employees->getNotificationInfo($notificationID));
        $oldPhotoResult = mysqli_fetch_array($oldPhotoQuery);
        $photoDir = __DIR__ . '/../../assets/images/notifications/'; 
        $oldTitle = str_replace(' ', '', $oldPhotoResult['title']);
        $oldFile = $photoDir . $oldTitle . '.png';

        if ($isUploadPhoto == 0) {
            // RENAME MEMO PHOTO    
            $newFile = $photoDir . $title . '.png';
            if (file_exists($oldFile)) {
                rename($oldFile, $newFile);
            }
            $photoPath = '../assets/images/notifications/' . $title . '.png';

            // UPDATE NOTIIFICATION QUERY
            mysqli_query($conn, $employees->updateNotification($notificationID, $updateTitle, $photoPath));

            $em = "Memo Updated Successfully";
            $error = ['error' => 0, 'id' => $notificationID, 'em' => $em];
        }
        else {
            if (!isset($_FILES['uploadPhoto']) || $_FILES['uploadPhoto']['error'] !== UPLOAD_ERR_OK) {
                die("Upload failed.");
            }

            if (isset($_FILES['uploadPhoto']) && $_FILES['uploadPhoto']['error'] == 0) {
                // DIRECTORY TO SAVE UPLOADED PHOTO
                $uploadDir = __DIR__ . '/../../assets/images/notifications/';

                // CHECK THE DIRECTORY FOLDER IF EXISTING, IF NOT CREATES IT
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                // GENERATE NEW FILE NAME
                $newFileName = $title . '.png';
                $uploadFile = $uploadDir . $newFileName;
                $photoPath = '../assets/images/notifications/' . $newFileName;

                // DELETE OLD MEMO PHOTO
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }

                $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                if (in_array($_FILES['uploadPhoto']['type'], $allowedTypes)) {
                    if (move_uploaded_file($_FILES['uploadPhoto']['tmp_name'], $uploadFile)) {
                        // UPDATE NOTIIFICATION QUERY
                        mysqli_query($conn, $employees->updateNotification($notificationID, $updateTitle, $photoPath));

                        $em = "Memo Updated Successfully";
                        $error = ['error' => 0, 'id' => $notificationID, 'em' => $em];
                    } else {
                        $em = "Failed to move uploaded file.";
                        $error = ['error' => 2, 'em' => $em];
                    }
                } else {
                    $em = "Invalid file type";
                    $error = ['error' => 2, 'em' => $em];
                }
            } else {
                $em = "No file uploaded.";
                $error = ['error' => 2, 'em' => $em];
            }
        }
    }
    else if (isset($_POST['action']) && $_POST['action'] == "delete") {
        $notificationID = $_POST['id_notification'] ?? ''; 

        $notificationQuery = mysqli_query($conn, $employees->getNotificationInfo($notificationID));
        $notificationResult = mysqli_fetch_array($notificationQuery);
        $photoDir = __DIR__ . '/../../assets/images/notifications/'; 
        $title = str_replace(' ', '', $notificationResult['title']);
        $file = $photoDir . $title . '.png';
        
        // DELETE NOTIFICATION
        mysqli_query($conn, $employees->deleteNotification($notificationID));
        
        // DELETE NOTIFICATION PHOTO
        if (file_exists($file)) {
            unlink($file);
        }
    }

    echo json_encode($error);
    exit();
?>