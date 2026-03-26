<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $employeeID = $_SESSION['id'];
    $leaveType = $_POST['leaveType'];
    $startDate = $_POST['effectivityStartDate'];
    $endDate = $_POST['effectivityEndDate'];
    $purpose = $_POST['purpose'];

    $modified_employeeID = str_replace("-", "", $_SESSION['employeeID']);
    $newFileName = $modified_employeeID.'-'.date("m.d.Y"). '.png'; 
    $uploadDir = ''; // DIRECTORY TO SAVE UPLOADED FILES

    if (isset($_POST['withAttachment']))
    {
        $attachment = 1;
    }
    else if (isset($_POST['withoutAttachment']))
    {
        $attachment = 0;
    }
    else {
        $attachment = 0;
    }

    // DEFAULT VALUES
    $status = "Pending";

    // if ($leaveType == 1) {
    //     $uploadDir = '../../assets/images/medicalCertificates/';
    //     mysqli_query($conn, $employees->fileLeaveWithPhoto($employeeID, $leaveType, $startDate, $endDate, $purpose, $status, $newFileName));
    // }
    // else if ($leaveType == 3) {
    //     $uploadDir = '../../assets/images/bereavementLeaves/';
    //     mysqli_query($conn, $employees->fileLeaveWithPhoto($employeeID, $leaveType, $startDate, $endDate, $purpose, $status, $newFileName));
    // }
    // else if ($leaveType == 4) {
    //     $uploadDir = '../../assets/images/maternityLeaves/';
    //     mysqli_query($conn, $employees->fileLeaveWithPhoto($employeeID, $leaveType, $startDate, $endDate, $purpose, $status, $newFileName));
    // }
    // else if ($leaveType == 5) {
    //     $uploadDir = '../../assets/images/paternityLeaves/';
    //     mysqli_query($conn, $employees->fileLeaveWithPhoto($employeeID, $leaveType, $startDate, $endDate, $purpose, $status, $newFileName));
    // }
    if ($leaveType == 1 || $leaveType == 3 || $leaveType == 4 || $leaveType == 5 || $leaveType == 6 || $leaveType == 7 || $leaveType == 8) {
        mysqli_query($conn, $employees->fileLeaveWithAttachment($employeeID, $leaveType, $startDate, $endDate, $purpose, $status, $attachment));
    }
    else {
        mysqli_query($conn, $employees->fileLeave($employeeID, $leaveType, $startDate, $endDate, $purpose, $status));
    }

    $lastIDQuery = mysqli_query($conn, $employees->viewLastLeave());
    $lastIDResult = mysqli_fetch_array($lastIDQuery);
    $lastID = $lastIDResult['requestID'];

    $em = "Leave Filed Successfully";
    $error = array('error' => 0, 'id' => $lastID, 'em' => $em);
    echo json_encode($error);

    // if (isset($_FILES['photoUpload']) && $_FILES['photoUpload']['error'] == 0 && ($leaveType == 1 || $leaveType == 3 || $leaveType == 4 || $leaveType == 5)) {
    //     // $uploadDir = '../../assets/images/medicalCertificates/'; // DIRECTORY TO SAVE UPLOADED FILES

    //     // GENERATE NEW NAME
    //     // $modified_employeeID = str_replace("-", "", $_SESSION['employeeID']);
    //     // $newFileName = $modified_employeeID.'-'.date("m.d.Y"). '.png'; 

    //     // The complete path to save the uploaded file
    //     $uploadFile = $uploadDir . $newFileName;

    //     // CHECK THE DIRECTORY FOLDER IF EXISTING, IF NOT CREATES IT
    //     if (!file_exists($uploadDir)) {
    //         mkdir($uploadDir, 0755, true);
    //     }

    //     // VALIDATE FILE TYPE
    //     $allowedTypes = ['image/jpeg', 'image/png'];
    //     if (in_array($_FILES['photoUpload']['type'], $allowedTypes)) {
    //         if (move_uploaded_file($_FILES['photoUpload']['tmp_name'], $uploadFile)) {
    //             // SUCCESSFULLY UPLOADED FILE                    
    //         } 
    //         else {
    //             $em = "Failed to move uploaded file.";
    //             $error = array('error' => 2, 'em' => $em);
    //             echo json_encode($error);
    //             exit();
    //         }
    //     } 
    //     else {
    //         $em = "Invalid file type";
    //         $error = array('error' => 2, 'em' => $em);
    //         echo json_encode($error);
    //         exit();
    //     }
    // }
    exit();
?>