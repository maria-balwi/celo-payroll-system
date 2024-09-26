<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $employeeID = $_SESSION['id'];
    $leaveType = $_POST['leaveType'];
    $startDate = $_POST['effectivityStartDate'];
    $endDate = $_POST['effectivityEndDate'];
    $purpose = $_POST['purpose'];
    
    // DEFAULT VALUES
    $status = "Pending";

    mysqli_query($conn, $employees->fileLeave($employeeID, $leaveType, $startDate, $endDate, $purpose, $status));

    $lastIDQuery = mysqli_query($conn, $employees->viewLastLeave());
    $lastIDResult = mysqli_fetch_array($lastIDQuery);
    $lastID = $lastIDResult['requestID'];

    $em = "Leave Filed Successfully";
    $error = array('error' => 0, 'id' => $lastID, 'em' => $em);
    echo json_encode($error);

    if (isset($_FILES['medCert']) && $_FILES['medCert']['error'] == 0 && $leaveType == 1) {
        $uploadDir = '../../assets/images/medicalCertificates/'; // DIRECTORY TO SAVE UPLOADED FILES

        // GENERATE NEW NAME
        $modified_employeeID = str_replace("-", "", $_SESSION['employeeID']);
        $newFileName = $modified_employeeID.'-'.date("m.d.Y"). '.png'; 

        // The complete path to save the uploaded file
        $uploadFile = $uploadDir . $newFileName;

        // CHECK THE DIRECTORY FOLDER IF EXISTING, IF NOT CREATES IT
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // VALIDATE FILE TYPE
        $allowedTypes = ['image/jpeg', 'image/png'];
        if (in_array($_FILES['medCert']['type'], $allowedTypes)) {
            if (move_uploaded_file($_FILES['medCert']['tmp_name'], $uploadFile)) {
                // SUCCESSFULLY UPLOADED FILE                    
            } 
            else {
                $em = "Failed to move uploaded file.";
                $error = array('error' => 2, 'em' => $em);
                echo json_encode($error);
                exit();
            }
        } 
        else {
            $em = "Invalid file type";
            $error = array('error' => 2, 'em' => $em);
            echo json_encode($error);
            exit();
        }
    }
    exit();
?>