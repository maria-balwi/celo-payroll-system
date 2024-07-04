<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $employeeName = $_POST['employeeName'];
    $gender = $_POST['gender'];
    $civilStatus = $_POST['civilStatus'];
    $address = $_POST['address'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $placeOfBirth = $_POST['placeOfBirth'];
    $sss = $_POST['sss'];
    $pagIbig = $_POST['pagIbig'];
    $philhealth = $_POST['philhealth'];
    $emailAddress = $_POST['emailAddress'];
    $employeeID = $_POST['employeeID'];
    $mobileNumber = $_POST['mobileNumber'];
    $departmentID = $_POST['department'];
    $designationID = $_POST['designation'];
    $shiftID = $_POST['shiftID'];

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
        mysqli_query($conn, $employees->addNewEmployee($employeeName, $gender, $civilStatus, $address, $dateOfBirth, $placeOfBirth, 
        $sss, $pagIbig, $philhealth, $emailAddress, $employeeID, $mobileNumber, $departmentID, $designationID, $shiftID));

        $em = "Employee Added Successfully";
        $error = array('error' => 0, 'em' => $em);
        echo json_encode($error);
        exit();
    }
?>