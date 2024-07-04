<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $updateID = $_POST['updateID'];
    $updateEmployeeName = $_POST['updateEmployeeName'];
    $updateGender = $_POST['updateGender'];
    $updateCivilStatus = $_POST['updateCivilStatus'];
    $updateAddress = $_POST['updateAddress'];
    $updateDateOfBirth = $_POST['updateDateOfBirth'];
    $updatePlaceOfBirth = $_POST['updatePlaceOfBirth'];
    $updateSSS = $_POST['updateSSS'];
    $updatePagIbig = $_POST['updatePagIbig'];
    $updatePhilhealth = $_POST['updatePhilhealth'];
    $updateEmailAddress = $_POST['updateEmailAddress'];
    $updateEmployeeID = $_POST['updateEmployeeID'];
    $updateMobileNumber = $_POST['updateMobileNumber'];
    $updateDepartmentID = $_POST['updateDepartment'];
    $updateDesignationID = $_POST['updateDesignation'];
    $updateShiftID = $_POST['updateShiftID'];

    // OLD DATA
    $oldEmailAddress = $_POST['oldEmailAddress'];
    $oldEmployeeID = $_POST['oldEmployeeID'];

    // PENDING TO GET ID
    $departmentQuery = mysqli_query($conn, $employees->viewDepartment());
    while ($departmentDetails = mysqli_fetch_array($departmentQuery)) {
        if ($departmentDetails['departmentName'] == $updateDepartmentID)
        {
            $updateDepartmentID = $departmentDetails['departmentID'];
        }
    }

    $designationQuery = mysqli_query($conn, $employees->viewDesignation());
    while ($designationDetails = mysqli_fetch_array($designationQuery)) {
        if ($designationDetails['position'] == $updateDesignationID)
        {
            $updateDesignationID = $designationDetails['designationID'];
        }
    }

    $shiftQuery = mysqli_query($conn, $employees->viewAllShifts());
    while ($shiftDetails = mysqli_fetch_array($shiftQuery)) {
        if ($shiftDetails['shift'] == $updateShiftID)
        {
            $updateShiftID = $shiftDetails['shiftID'];
        }
    }
    
    // CHECK EMAILS 
    $checkEmail = mysqli_query($conn, $employees->checkEmail($updateEmailAddress));

    // CHECK EMPLOYEE ID 
    $checkEmployeeID = mysqli_query($conn, $employees->checkEmployeeID($updateEmployeeID));

    // IF SAME EMAIL ADDRESS (OLD AND NEW)
    if ($updateEmailAddress == $oldEmailAddress) 
    {
        // IF SAME EMPLOYEE ID (OLD AND NEW)
        if ($updateEmployeeID == $oldEmployeeID)
        {
            mysqli_query($conn, $employees->updateEmployeeInfo($updateID, $updateEmployeeName, $updateGender, $updateCivilStatus, $updateAddress, 
            $updateDateOfBirth, $updatePlaceOfBirth, $updateSSS, $updatePagIbig, $updatePhilhealth, $updateEmailAddress, 
            $updateEmployeeID, $updateMobileNumber, $updateDepartmentID, $updateDesignationID, $updateShiftID));

            $em = "Employee Updated Successfully";
            $error = array('error' => 0, 'em' => $em);
            echo json_encode($error);
            exit();
        }
        // DIFFERENT EMPLOYEE ID
        else 
        {
            // IF NEW EMPLOYEE ID ALREADY EXISTS
            if (mysqli_num_rows($checkEmployeeID) == 1)
            {
                $em = "Employee ID already exists on the system!";
                $error = array('error' => 1, 'em' => $em);
                echo json_encode($error);
                exit();
            }
            // IF NEW EMPLOYEE ID DOES NOT EXISTS
            else 
            {
                mysqli_query($conn, $employees->updateEmployeeInfo($updateID, $updateEmployeeName, $updateGender, $updateCivilStatus, $updateAddress, 
                $updateDateOfBirth, $updatePlaceOfBirth, $updateSSS, $updatePagIbig, $updatePhilhealth, $updateEmailAddress, 
                $updateEmployeeID, $updateMobileNumber, $updateDepartmentID, $updateDesignationID, $updateShiftID));

                $em = "Employee Added Successfully";
                $error = array('error' => 0, 'em' => $em);
                echo json_encode($error);
                exit();
            }
        }
    }
    // DIFFERENT EMAIL ADDRESS
    else 
    {
        // IF EMAIL ADDRESS ALREADY EXISTS
        if (mysqli_num_rows($checkEmail) == 1) 
        {
            $em = "Email Address already exists on the system!";
            $error = array('error' => 1, 'em' => $em);
            echo json_encode($error);
            exit();
        }
        else 
        {
            // IF SAME EMPLOYEE ID (OLD AND NEW)
            if ($updateEmployeeID == $oldEmployeeID)
            {
                mysqli_query($conn, $employees->updateEmployeeInfo($updateID, $updateEmployeeName, $updateGender, $updateCivilStatus, $updateAddress, 
                $updateDateOfBirth, $updatePlaceOfBirth, $updateSSS, $updatePagIbig, $updatePhilhealth, $updateEmailAddress, 
                $updateEmployeeID, $updateMobileNumber, $updateDepartmentID, $updateDesignationID, $updateShiftID));

                $em = "Employee Updated Successfully";
                $error = array('error' => 0, 'em' => $em);
                echo json_encode($error);
                exit();
            }
            // DIFFERENT EMPLOYEE ID
            else 
            {
                // IF NEW EMPLOYEE ID ALREADY EXISTS
                if (mysqli_num_rows($checkEmployeeID) == 1)
                {
                    $em = "Employee ID already exists on the system!";
                    $error = array('error' => 1, 'em' => $em);
                    echo json_encode($error);
                    exit();
                }
                // IF NEW EMPLOYEE ID DOES NOT EXISTS
                else 
                {
                    mysqli_query($conn, $employees->updateEmployeeInfo($updateID, $updateEmployeeName, $updateGender, $updateCivilStatus, $updateAddress, 
                    $updateDateOfBirth, $updatePlaceOfBirth, $updateSSS, $updatePagIbig, $updatePhilhealth, $updateEmailAddress, 
                    $updateEmployeeID, $updateMobileNumber, $updateDepartmentID, $updateDesignationID, $updateShiftID));

                    $em = "Employee Added Successfully";
                    $error = array('error' => 0, 'em' => $em);
                    echo json_encode($error);
                    exit();
                }
            }
        }
    }
?>