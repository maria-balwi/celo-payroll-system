<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $lastName = $_POST['lastName'];
    $firstName = $_POST['firstName'];
    $gender = $_POST['gender'];
    $civilStatus = $_POST['civilStatus'];
    $address = $_POST['address'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $placeOfBirth = $_POST['placeOfBirth'];
    $sss = $_POST['sss'];
    $pagIbig = $_POST['pagIbig'];
    $philhealth = $_POST['philhealth'];
    $tin = $_POST['tin'];
    $emailAddress = $_POST['emailAddress'];
    $employeeID = $_POST['employeeID'];
    $mobileNumber = $_POST['mobileNumber'];
    $departmentID = $_POST['department'];
    $designationID = $_POST['designation'];
    $shiftID = $_POST['shiftID'];
    $employmentStatus = $_POST['employmentStatus'];
    $dateHired = $_POST['dateHired'];
    $basicPay = $_POST['basicPay'];
    $dailyRate = $_POST['dailyRate'];
    $hourlyRate = $_POST['hourlyRate'];
    $vacationLeaves = $_POST['vacationLeaves'];
    $sickLeaves = $_POST['sickLeaves'];

    if (str_replace(" ", "",$_POST['sss']))
    {
        $req_sss = 1;
    }
    else
    {
        $req_sss = 0;
    }

    if (str_replace(" ", "",$_POST['pagIbig']))
    {
        $req_pagIbig = 1;
    }
    else
    {
        $req_pagIbig = 0;
    }

    if (str_replace(" ", "",$_POST['philhealth']))
    {
        $req_philhealth = 1;
    }
    else
    {
        $req_philhealth = 0;
    }

    if (str_replace(" ", "",$_POST['tin']))
    {
        $req_tin = 1;
    }
    else
    {
        $req_tin = 0;
    }

    if (isset($_POST['req_nbi']))
    {
        $req_nbi = 1;
    }
    else
    {
        $req_nbi = 0;
    }

    if (isset($_POST['req_medicalExam']))
    {
        $req_medicalExam = 1;
    }
    else
    {
        $req_medicalExam = 0;
    }

    if (isset($_POST['req_2x2pic']))
    {
        $req_2x2pic = 1;
    }
    else
    {
        $req_2x2pic = 0;
    }

    if (isset($_POST['req_vaccineCard']))
    {
        $req_vaccineCard = 1;
    }
    else
    {
        $req_vaccineCard = 0;
    }

    if (isset($_POST['req_psa']))
    {
        $req_psa = 1;
    }
    else
    {
        $req_psa = 0;
    }

    if (isset($_POST['req_validID']))
    {
        $req_validID = 1;
    }
    else
    {
        $req_validID = 0;
    }

    if (isset($_POST['req_helloMoney']))
    {
        $req_helloMoney = 1;
    }
    else
    {
        $req_helloMoney = 0;
    }

    if (isset($_POST['wo_mon']))
    {
        $wo_mon = 1;
    }
    else
    {
        $wo_mon = 0;
    }

    if (isset($_POST['wo_tue']))
    {
        $wo_tue = 1;
    }
    else
    {
        $wo_tue = 0;
    }

    if (isset($_POST['wo_wed']))
    {
        $wo_wed = 1;
    }
    else
    {
        $wo_wed = 0;
    }

    if (isset($_POST['wo_thu']))
    {
        $wo_thu = 1;
    }
    else
    {
        $wo_thu = 0;
    }

    if (isset($_POST['wo_fri']))
    {
        $wo_fri = 1;
    }
    else
    {
        $wo_fri = 0;
    }

    if (isset($_POST['wo_sat']))
    {
        $wo_sat = 1;
    }
    else
    {
        $wo_sat = 0;
    }

    if (isset($_POST['wo_sun']))
    {
        $wo_sun = 1;
    }
    else
    {
        $wo_sun = 0;
    }

    // PENDING TO GET ID
    $designationQuery = mysqli_query($conn, $employees->viewDesignation());
    while ($designationDetails = mysqli_fetch_array($designationQuery)) {
        if ($designationDetails['position'] == $designationID)
        {
            $designationID = $designationDetails['designationID'];
        }
    }
    
    // CHECK EMAILS 
    $checkEmail = mysqli_query($conn, $employees->checkEmail($emailAddress));

    // CHECK EMPLOYEE ID 
    $checkEmployeeID = mysqli_query($conn, $employees->checkEmployeeID($employeeID));

    if (mysqli_num_rows($checkEmail) == 1) 
    {
        $em = "Email Address already exists on the system!";
        $error = array('error' => 1, 'em' => $em);
    }
    else if (mysqli_num_rows($checkEmployeeID) == 1)
    {
        $em = "Employee ID already exists on the system!";
        $error = array('error' => 1, 'em' => $em);
    }
    else {
        if ($employmentStatus == "Regular")
        {
            // ADD REGULAR EMPLOYEE
            $dateRegularized = new DateTime($dateHired);
            $dateRegularized->modify('+6 months');
            $dateRegularized = $dateRegularized->format('Y-m-d');
            mysqli_query($conn, $employees->addNewEmployee_reg($lastName, $firstName, $gender, $civilStatus, $address, $dateOfBirth, $placeOfBirth, $sss, $pagIbig, $philhealth, $tin, $emailAddress, $employeeID, $mobileNumber, $departmentID, $designationID, $shiftID, $basicPay, $dailyRate, $hourlyRate, $vacationLeaves, $sickLeaves, $employmentStatus, $dateHired, $dateRegularized));
        }
        else 
        {
            // ADD PROBATIONARY EMPLOYEE
            mysqli_query($conn, $employees->addNewEmployee_prob($lastName, $firstName, $gender, $civilStatus, $address, $dateOfBirth, $placeOfBirth, $sss, $pagIbig, $philhealth, $tin, $emailAddress, $employeeID, $mobileNumber, $departmentID, $designationID, $shiftID, $basicPay, $dailyRate, $hourlyRate, $vacationLeaves, $sickLeaves, $employmentStatus, $dateHired));
        }

        $lastIDQuery = mysqli_query($conn, $employees->viewLastEmployee());
        $lastIDResult = mysqli_fetch_array($lastIDQuery);
        $lastID = $lastIDResult['id'];

        mysqli_query($conn, $employees->addEmployeeRequirements($lastID, $req_sss, $req_pagIbig, $req_philhealth, $req_tin, $req_nbi, $req_medicalExam, $req_2x2pic, $req_vaccineCard, $req_psa, $req_validID, $req_helloMoney));
        mysqli_query($conn, $employees->addEmployeeWeekOff($lastID, $wo_mon, $wo_tue, $wo_wed, $wo_thu, $wo_fri, $wo_sat, $wo_sun));
        
        $lastIDQuery = mysqli_query($conn, $employees->viewLastEmployee());
        $lastIDResult = mysqli_fetch_array($lastIDQuery);
        $lastID = $lastIDResult['id'];

        // AUDIT TRAIL
        $at_empID = $_SESSION['id'];
        $at_module = "Admin - Employee List";
        $at_action = "Added New Employee";
        mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $lastID));


        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
            // DIRECTORY TO SAVE UPLOADED PHOTO
            $uploadDir = __DIR__ . '/../../assets/images/profiles/';

            // CHECK THE DIRECTORY FOLDER IF EXISTING, IF NOT CREATES IT
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // GENERATE NEW FILE NAME
            $modified_employeeID = str_replace("-", "", $employeeID);
            $newFileName = $modified_employeeID . '.png';
            $uploadFile = $uploadDir . $newFileName;

            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (in_array($_FILES['photo']['type'], $allowedTypes)) {
                if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
                    $em = "Employee Added Successfully";
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

    echo json_encode($error);
    exit();
?>