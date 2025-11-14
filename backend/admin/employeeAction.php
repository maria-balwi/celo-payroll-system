<?php 

    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $id = $_POST['id_employee'];

    if (isset($_POST['action']) && $_POST['action'] == "resign") {
        $resignationStatus = $_POST['resignationStatus'];
        $employeeID = $_POST['employeeID'];

        if (isset($_FILES['clearanceForm']) && $_FILES['clearanceForm']['error'] == 0) {
            // DIRECTORY TO SAVE UPLOADED FILES
            $uploadDir = __DIR__ . '/../../assets/images/clearanceForms/';

            // CHECK THE DIRECTORY FOLDER IF EXISTING, IF NOT CREATES IT
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // VALIDATE FILE TYPE
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $_FILES['clearanceForm']['tmp_name']);
            finfo_close($finfo);
            $allowedTypes = ['application/pdf'];
            // if (in_array($mimeType, $allowedTypes)) {
            //     if (move_uploaded_file($_FILES['clearanceForm']['tmp_name'], $uploadFile)) {
            //         // SUCCESSFULLY UPLOADED FILE                    
            //     } 
            //     else {
            //         $em = "Failed to move uploaded file.";
            //         $error = array('error' => 2, 'em' => $em);
            //         echo json_encode($error);
            //         exit();
            //     }
            // } 
            // else {
            //     $em = "Invalid file type";
            //     $error = array('error' => 2, 'em' => $em);
            //     echo json_encode($error);
            //     exit();
            // }

            if (!in_array($mimeType, $allowedTypes)) {
                $em = "Invalid file type. Only PDF allowed.";
                $error = array('error' => 2, 'em' => $em);
                echo json_encode($error);           
            }

            // GENERATE NEW NAME
            $modified_employeeID = str_replace("-", "", $employeeID);
            $ext = pathinfo($_FILES['clearanceForm']['name'], PATHINFO_EXTENSION);
            $newFileName = 'ClearanceForm-' . $modified_employeeID.'-'.date("m.d.Y"). '.' . $ext; 

            // if ($mimeType === 'application/pdf') {
            //     // FILE IS PDF
            //     $ext = pathinfo($_FILES['clearanceForm']['name'], PATHINFO_EXTENSION);
            //     $newFileName = 'ClearanceForm-' . $modified_employeeID.'-'.date("m.d.Y"). '.' . $ext; 
            // }

            // if ($mimeType === 'image/jpeg' || $mimeType === 'image/jpg' || $mimeType === 'image/png') {
            //     // FILE IS IMAGE
            //     $newFileName = 'ClearanceForm-' . $modified_employeeID.'-'.date("m.d.Y"). '.png';
            // }

            // The complete path to save the uploaded file
            $uploadFile = $uploadDir . $newFileName;

            // Upload file
            if (!move_uploaded_file($_FILES['clearanceForm']['tmp_name'], $uploadFile)) {
                $em = "Failed to move uploaded file.";
                $error = array('error' => 2, 'em' => $em);
                echo json_encode($error);
            }
            else {
                mysqli_query($conn, $employees->resignEmployee($id, $resignationStatus, $newFileName));

                $em = "Employee Resigned Successfully";
                $error = array('error' => 0, 'em' => $em);
                echo json_encode($error);
            }
        }
        
        // AUDIT TRAIL
        $at_empID = $_SESSION['id'];
        $at_module = "Admin - Employee List";
        $at_action = "Resigned Employee";
        mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $id));
    }
    else if (isset($_POST['action']) && $_POST['action'] == "rehire") {
        mysqli_query($conn, $employees->rehireEmployee($id));

        // AUDIT TRAIL
        $at_empID = $_SESSION['id'];
        $at_module = "Admin - Employee List";
        $at_action = "Rehired Employee";
        mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $id));

        $em = "Employee Rehired Successfully";
        $error = array('error' => 0, 'em' => $em);
        echo json_encode($error);
    }

    exit();
?>