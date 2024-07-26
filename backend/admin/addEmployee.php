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
    $basicPay = $_POST['basicPay'];
    $dailyRate = $_POST['dailyRate'];
    $hourlyRate = $_POST['hourlyRate'];
    $vacationLeaves = $_POST['vacationLeaves'];
    $sickLeaves = $_POST['sickLeaves'];

    if (isset($_POST['req_sss']))
    {
        $req_sss = 1;
    }
    else
    {
        $req_sss = 0;
    }

    if (isset($_POST['req_pagIbig']))
    {
        $req_pagIbig = 1;
    }
    else
    {
        $req_pagIbig = 0;
    }

    if (isset($_POST['req_philhealth']))
    {
        $req_philhealth = 1;
    }
    else
    {
        $req_philhealth = 0;
    }

    if (isset($_POST['req_tin']))
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
        echo json_encode($error);
        exit();
    }
    else if (mysqli_num_rows($checkEmployeeID) == 1)
    {
        $em = "Employee ID already exists on the system!";
        $error = array('error' => 1, 'em' => $em);
        echo json_encode($error);
        exit();
    }
    else {
        mysqli_query($conn, $employees->addNewEmployee($lastName, $firstName, $gender, $civilStatus, $address, $dateOfBirth, $placeOfBirth, 
        $sss, $pagIbig, $philhealth, $tin, $emailAddress, $employeeID, $mobileNumber, $departmentID, $designationID, $shiftID, $basicPay, $dailyRate, $hourlyRate, $vacationLeaves, $sickLeaves));

        $lastIDQuery = mysqli_query($conn, $employees->viewLastEmployee());
        $lastIDResult = mysqli_fetch_array($lastIDQuery);
        $lastID = $lastIDResult['id'];

        mysqli_query($conn, $employees->addEmployeeRequirements($lastID, $req_sss, $req_pagIbig, $req_philhealth, $req_tin, $req_nbi));

        $em = "Employee Added Successfully";
        $error = array('error' => 0, 'em' => $em);
        echo json_encode($error);
        exit();
    }
?>