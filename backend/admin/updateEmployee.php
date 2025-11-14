<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $updateID = $_POST['updateID'];
    $updateLastName = $_POST['updateLastName'];
    $updateFirstName = $_POST['updateFirstName'];
    $updateGender = $_POST['updateGender'];
    $updateCivilStatus = $_POST['updateCivilStatus'];
    $updateAddress = $_POST['updateAddress'];
    $updateDateOfBirth = $_POST['updateDateOfBirth'];
    $updatePlaceOfBirth = $_POST['updatePlaceOfBirth'];
    $updateSSS = $_POST['updateSSS'];
    $updatePagIbig = $_POST['updatePagIbig'];
    $updatePhilhealth = $_POST['updatePhilhealth'];
    $updateTIN = $_POST['updateTIN'];
    $updateEmailAddress = $_POST['updateEmailAddress'];
    $updateEmployeeID = $_POST['updateEmployeeID'];
    $updateMobileNumber = $_POST['updateMobileNumber'];
    $updateDepartmentID = $_POST['updateDepartment'];
    $updateDesignationID = $_POST['updateDesignation'];
    $updateShiftID = $_POST['updateShiftID'];
    $updateBasicPay = $_POST['updateBasicPay'];
    $updateDailyRate = $_POST['updateDailyRate'];
    $updateHourlyRate = $_POST['updateHourlyRate'];
    $updateVacationLeaves = $_POST['updateVacationLeaves'];
    $updateSickLeaves = $_POST['updateSickLeaves'];
    $updateCashAdvance = $_POST['updateCashAdvance'];
    $updateEmploymentStatus = $_POST['updateEmploymentStatus'];
    $updateDateHired = $_POST['updateDateHired'];

    if (isset($_POST['updateCashAdvance']) && $_POST['updateCashAdvance'] != "") {
        $updateCashAdvance = $_POST['updateCashAdvance'];
    }
    else {
        $updateCashAdvance = 0.0;
    }

    if (str_replace(" ", "",$_POST['updateSSS'])) {
		$req_sss = 1;
	}
	else {
		$req_sss = 0;
	}

    if(str_replace(" ", "",$_POST['updatePagIbig'])) {
		$req_pagIbig = 1;
	}
	else {
		$req_pagIbig = 0;
	}

    if(str_replace(" ", "",$_POST['updatePhilhealth'])) {
		$req_philhealth = 1;
	}
	else {
		$req_philhealth = 0;
	}

    if(str_replace(" ", "",$_POST['updateTIN'])) {
		$req_tin = 1;
	}
	else {
		$req_tin = 0;
	}

    if(isset($_POST['update_req_nbi'])) {
		$req_nbi = 1;
	}
	else {
		$req_nbi = 0;
	}

    if(isset($_POST['update_req_medicalExam'])) {
		$req_medicalExam = 1;
	}
	else {
		$req_medicalExam = 0;
	}

    if(isset($_POST['update_req_2x2pic'])) {
		$req_2x2pic = 1;
	}
	else {
		$req_2x2pic = 0;
	}

    if(isset($_POST['update_req_vaccineCard'])) {
		$req_vaccineCard = 1;
	}
	else {
		$req_vaccineCard = 0;
	}

    if(isset($_POST['update_req_psa'])) {
		$req_psa = 1;
	}
	else {
		$req_psa = 0;
	}

    if(isset($_POST['update_req_validID'])) {
		$req_validID = 1;
	}
	else {
		$req_validID = 0;
	}
    
    if(isset($_POST['update_req_helloMoney'])) {
		$req_helloMoney = 1;
	}
	else {
		$req_helloMoney = 0;
	}

    if (isset($_POST['update_wo_mon'])) {
        $wo_mon = 1;
    }
    else {
        $wo_mon = 0;
    }

    if (isset($_POST['update_wo_tue'])) {
        $wo_tue = 1;
    }
    else {
        $wo_tue = 0;
    }

    if (isset($_POST['update_wo_wed'])) {
        $wo_wed = 1;
    }
    else {
        $wo_wed = 0;
    }

    if (isset($_POST['update_wo_thu'])) {
        $wo_thu = 1;
    }
    else {
        $wo_thu = 0;
    }

    if (isset($_POST['update_wo_fri'])) {
        $wo_fri = 1;
    }
    else {
        $wo_fri = 0;
    }

    if (isset($_POST['update_wo_sat'])) {
        $wo_sat = 1;
    }
    else {
        $wo_sat = 0;
    }

    if (isset($_POST['update_wo_sun'])) {
        $wo_sun = 1;
    }
    else {
        $wo_sun = 0;
    }


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
            if ($updateEmploymentStatus == "Regular")
            {
                // UPDATE REGULAR EMPLOYEE
                $updateDateRegularized = new DateTime($updateDateHired);
                $updateDateRegularized->modify('+6 months');
                $updateDateRegularized = $updateDateRegularized->format('Y-m-d');

                mysqli_query($conn, $employees->updateEmployeeInfo_reg($updateID, $updateLastName, $updateFirstName, $updateGender, $updateCivilStatus, $updateAddress, 
                $updateDateOfBirth, $updatePlaceOfBirth, $updateSSS, $updatePagIbig, $updatePhilhealth, $updateTIN, $updateEmailAddress, 
                $updateEmployeeID, $updateMobileNumber, $updateDepartmentID, $updateDesignationID, $updateShiftID, $updateBasicPay, $updateDailyRate, $updateHourlyRate, $updateVacationLeaves, $updateSickLeaves, $updateCashAdvance, $updateEmploymentStatus, $updateDateHired, $updateDateRegularized));

                // AUDIT TRAIL
                $at_empID = $_SESSION['id'];
                $at_module = "Admin - Employee List";
                $at_action = "Updated Employee Information";
                mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $updateID));
            }
            else 
            {
                // UPDATE PROBATIONARY EMPLOYEE
                mysqli_query($conn, $employees->updateEmployeeInfo_prob($updateID, $updateLastName, $updateFirstName, $updateGender, $updateCivilStatus, $updateAddress, 
                $updateDateOfBirth, $updatePlaceOfBirth, $updateSSS, $updatePagIbig, $updatePhilhealth, $updateTIN, $updateEmailAddress, 
                $updateEmployeeID, $updateMobileNumber, $updateDepartmentID, $updateDesignationID, $updateShiftID, $updateBasicPay, $updateDailyRate, $updateHourlyRate, $updateVacationLeaves, $updateSickLeaves, $updateCashAdvance, $updateEmploymentStatus, $updateDateHired));
            
                // AUDIT TRAIL
                $at_empID = $_SESSION['id'];
                $at_module = "Admin - Employee List";
                $at_action = "Updated Employee Information";
                mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $updateID));
            }
            
            mysqli_query($conn, $employees->updateEmployeeRequirements($updateID, $req_sss, $req_pagIbig, $req_philhealth, $req_tin, $req_nbi, $req_medicalExam, $req_2x2pic, $req_vaccineCard, $req_psa, $req_validID, $req_helloMoney));
            mysqli_query($conn, $employees->updateEmployeeWeekOff($updateID, $wo_mon, $wo_tue, $wo_wed, $wo_thu, $wo_fri, $wo_sat, $wo_sun));

            // PROCESS UPLOADED PHOTO
            if (isset($_FILES['updateProfilePhoto']) && $_FILES['updateProfilePhoto']['error'] == 0) {
                // DIRECTORY TO SAVE UPLOADED FILES
                $uploadDir = __DIR__ . '/../../assets/images/profiles/'; 

                // CHECK THE DIRECTORY FOLDER IF EXISTING, IF NOT CREATES IT
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                // GENERATE NEW NAME
                $modified_employeeID = str_replace("-", "", $updateEmployeeID);
                $newFileName = $modified_employeeID. '.png';
                $uploadFile = $uploadDir . $newFileName;

                // VALIDATE FILE TYPE
                $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                if (in_array($_FILES['updateProfilePhoto']['type'], $allowedTypes)) {
                    if (move_uploaded_file($_FILES['updateProfilePhoto']['tmp_name'], $uploadFile)) {
                        // SUCCESSFULLY UPLOADED FILE
                        $em = "Employee Updated Successfully";
                        $error = array('error' => 0, 'em' => $em);
                        echo json_encode($error);
                        exit();
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
            else {
                $em = "Employee Updated Successfully";
                $error = array('error' => 0, 'em' => $em);
                echo json_encode($error);
                exit();
            }

        }
        // DIFFERENT EMPLOYEE ID
        else 
        {
            // IF NEW EMPLOYEE ID ALREADY EXISTS
            if (mysqli_num_rows($checkEmployeeID) == 1)
            {
                $em = "Employee ID already exists on the system!";
                $error = array('error' => 1, 'em' => $em);
            }
            // IF NEW EMPLOYEE ID DOES NOT EXISTS
            else 
            {
                if ($updateEmploymentStatus == "Regular")
                {
                    // ADD REGULAR EMPLOYEE
                    $updateDateRegularized = new DateTime($updateDateHired);
                    $updateDateRegularized->modify('+6 months');
                    $updateDateRegularized = $updateDateRegularized->format('Y-m-d');

                    mysqli_query($conn, $employees->updateEmployeeInfo_reg($updateID, $updateLastName, $updateFirstName, $updateGender, $updateCivilStatus, $updateAddress, 
                    $updateDateOfBirth, $updatePlaceOfBirth, $updateSSS, $updatePagIbig, $updatePhilhealth, $updateTIN, $updateEmailAddress, 
                    $updateEmployeeID, $updateMobileNumber, $updateDepartmentID, $updateDesignationID, $updateShiftID, $updateBasicPay, $updateDailyRate, $updateHourlyRate, $updateVacationLeaves, $updateSickLeaves, $updateCashAdvance, $updateEmploymentStatus, $updateDateHired, $updateDateRegularized));

                    // AUDIT TRAIL
                    $at_empID = $_SESSION['id'];
                    $at_module = "Admin - Employee List";
                    $at_action = "Updated Employee Information";
                    mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $updateID));
                }
                else 
                {
                    mysqli_query($conn, $employees->updateEmployeeInfo_prob($updateID, $updateLastName, $updateFirstName, $updateGender, $updateCivilStatus, $updateAddress, 
                    $updateDateOfBirth, $updatePlaceOfBirth, $updateSSS, $updatePagIbig, $updatePhilhealth, $updateTIN, $updateEmailAddress, 
                    $updateEmployeeID, $updateMobileNumber, $updateDepartmentID, $updateDesignationID, $updateShiftID, $updateBasicPay, $updateDailyRate, $updateHourlyRate, $updateVacationLeaves, $updateSickLeaves, $updateCashAdvance, $updateEmploymentStatus, $updateDateHired));
                
                    // AUDIT TRAIL
                    $at_empID = $_SESSION['id'];
                    $at_module = "Admin - Employee List";
                    $at_action = "Updated Employee Information";
                    mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $updateID));
                }
                
                mysqli_query($conn, $employees->updateEmployeeRequirements($updateID, $req_sss, $req_pagIbig, $req_philhealth, $req_tin, $req_nbi, $req_medicalExam, $req_2x2pic, $req_vaccineCard, $req_psa, $req_validID, $req_helloMoney));
                mysqli_query($conn, $employees->updateEmployeeWeekOff($updateID, $wo_mon, $wo_tue, $wo_wed, $wo_thu, $wo_fri, $wo_sat, $wo_sun));

                // PROCESS UPLOADED PHOTO
                if (isset($_FILES['updateProfilePhoto']) && $_FILES['updateProfilePhoto']['error'] == 0) {
                    // DIRECTORY TO SAVE UPLOADED FILES
                    $uploadDir = __DIR__ . '/../../assets/images/profiles/'; 

                    // CHECK THE DIRECTORY FOLDER IF EXISTING, IF NOT CREATES IT
                    if (!file_exists($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }

                    // GENERATE NEW NAME
                    $modified_employeeID = str_replace("-", "", $updateEmployeeID);
                    $newFileName = $modified_employeeID. '.png';
                    $uploadFile = $uploadDir . $newFileName;

                    // DELETE EXISTING PROFILE PHOTO
                    $oldEmpID = str_replace("-", "", $oldEmployeeID);
                    $deleteOldPhoto = $uploadDir . $oldEmpID . '.png';
                    if (file_exists($deleteOldPhoto)) {
                        unlink($deleteOldPhoto);
                    }

                    // VALIDATE FILE TYPE
                    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                    if (in_array($_FILES['updateProfilePhoto']['type'], $allowedTypes)) {
                        if (move_uploaded_file($_FILES['updateProfilePhoto']['tmp_name'], $uploadFile)) {
                            // SUCCESSFULLY UPLOADED FILE
                            $em = "Employee Updated Successfully";
                            $error = array('error' => 0, 'em' => $em);
                            echo json_encode($error);
                            exit();
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
                else {
                    // RENAME EXISTING PROFILE PHOTO
                    $uploadDir = __DIR__ . '/../../assets/images/profiles/'; 

                    $modified_employeeID = str_replace("-", "", $updateEmployeeID);
                    $newFileName = $modified_employeeID. '.png';
                    $uploadFile = $uploadDir . $newFileName;

                    $oldEmpID = str_replace("-", "", $oldEmployeeID);
                    $oldFile = $uploadDir . $oldEmpID . '.png';
                    if (file_exists($oldFile)) {
                        rename($oldFile, $uploadFile);
                    }

                    $em = "Employee Updated Successfully";
                    $error = array('error' => 0, 'em' => $em);
                    echo json_encode($error);
                    exit();
                }
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
        }
        else 
        {
            // IF SAME EMPLOYEE ID (OLD AND NEW)
            if ($updateEmployeeID == $oldEmployeeID)
            {
                if ($updateEmploymentStatus == "Regular")
                {
                    // UPDATE REGULAR EMPLOYEE
                    $updateDateRegularized = new DateTime($updateDateHired);
                    $updateDateRegularized->modify('+6 months');
                    $updateDateRegularized = $updateDateRegularized->format('Y-m-d');

                    mysqli_query($conn, $employees->updateEmployeeInfo_reg($updateID, $updateLastName, $updateFirstName, $updateGender, $updateCivilStatus, $updateAddress, 
                    $updateDateOfBirth, $updatePlaceOfBirth, $updateSSS, $updatePagIbig, $updatePhilhealth, $updateTIN, $updateEmailAddress, 
                    $updateEmployeeID, $updateMobileNumber, $updateDepartmentID, $updateDesignationID, $updateShiftID, $updateBasicPay, $updateDailyRate, $updateHourlyRate, $updateVacationLeaves, $updateSickLeaves, $updateCashAdvance, $updateEmploymentStatus, $updateDateHired, $updateDateRegularized));

                    // AUDIT TRAIL
                    $at_empID = $_SESSION['id'];
                    $at_module = "Admin - Employee List";
                    $at_action = "Updated Employee Information";
                    mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $updateID));
                }
                else 
                {
                    // UPDATE PROBATIONARY EMPLOYEE
                    mysqli_query($conn, $employees->updateEmployeeInfo_prob($updateID, $updateLastName, $updateFirstName, $updateGender, $updateCivilStatus, $updateAddress, 
                    $updateDateOfBirth, $updatePlaceOfBirth, $updateSSS, $updatePagIbig, $updatePhilhealth, $updateTIN, $updateEmailAddress, 
                    $updateEmployeeID, $updateMobileNumber, $updateDepartmentID, $updateDesignationID, $updateShiftID, $updateBasicPay, $updateDailyRate, $updateHourlyRate, $updateVacationLeaves, $updateSickLeaves, $updateCashAdvance, $updateEmploymentStatus, $updateDateHired));
                
                    // AUDIT TRAIL
                    $at_empID = $_SESSION['id'];
                    $at_module = "Admin - Employee List";
                    $at_action = "Updated Employee Information";
                    mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $updateID));
                }
                
                mysqli_query($conn, $employees->updateEmployeeRequirements($updateID, $req_sss, $req_pagIbig, $req_philhealth, $req_tin, $req_nbi, $req_medicalExam, $req_2x2pic, $req_vaccineCard, $req_psa, $req_validID, $req_helloMoney));
                mysqli_query($conn, $employees->updateEmployeeWeekOff($updateID, $wo_mon, $wo_tue, $wo_wed, $wo_thu, $wo_fri, $wo_sat, $wo_sun));

                // PROCESS UPLOADED PHOTO
                if (isset($_FILES['updateProfilePhoto']) && $_FILES['updateProfilePhoto']['error'] == 0) {
                    // DIRECTORY TO SAVE UPLOADED FILES
                    $uploadDir = __DIR__ . '/../../assets/images/profiles/'; 

                    // CHECK THE DIRECTORY FOLDER IF EXISTING, IF NOT CREATES IT
                    if (!file_exists($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }

                    // GENERATE NEW NAME
                    $modified_employeeID = str_replace("-", "", $updateEmployeeID);
                    $newFileName = $modified_employeeID. '.png';
                    $uploadFile = $uploadDir . $newFileName;

                    // VALIDATE FILE TYPE
                    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                    if (in_array($_FILES['updateProfilePhoto']['type'], $allowedTypes)) {
                        if (move_uploaded_file($_FILES['updateProfilePhoto']['tmp_name'], $uploadFile)) {
                            // SUCCESSFULLY UPLOADED FILE
                            $em = "Employee Updated Successfully";
                            $error = array('error' => 0, 'em' => $em);
                            echo json_encode($error);
                            exit();
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
                else {
                    $em = "Employee Updated Successfully";
                    $error = array('error' => 0, 'em' => $em);
                    echo json_encode($error);
                    exit();
                }
            }
            // DIFFERENT EMPLOYEE ID
            else 
            {
                // IF NEW EMPLOYEE ID ALREADY EXISTS
                if (mysqli_num_rows($checkEmployeeID) == 1)
                {
                    $em = "Employee ID already exists on the system!";
                    $error = array('error' => 1, 'em' => $em);
                }
                // IF NEW EMPLOYEE ID DOES NOT EXISTS
                else 
                {
                    if ($updateEmploymentStatus == "Regular")
                    {
                        // UPDATE REGULAR EMPLOYEE
                        $updateDateRegularized = new DateTime($updateDateHired);
                        $updateDateRegularized->modify('+6 months');
                        $updateDateRegularized = $updateDateRegularized->format('Y-m-d');

                        mysqli_query($conn, $employees->updateEmployeeInfo_reg($updateID, $updateLastName, $updateFirstName, $updateGender, $updateCivilStatus, $updateAddress, 
                        $updateDateOfBirth, $updatePlaceOfBirth, $updateSSS, $updatePagIbig, $updatePhilhealth, $updateTIN, $updateEmailAddress, 
                        $updateEmployeeID, $updateMobileNumber, $updateDepartmentID, $updateDesignationID, $updateShiftID, $updateBasicPay, $updateDailyRate, $updateHourlyRate, $updateVacationLeaves, $updateSickLeaves, $updateCashAdvance, $updateEmploymentStatus, $updateDateHired, $updateDateRegularized));

                        // AUDIT TRAIL
                        $at_empID = $_SESSION['id'];
                        $at_module = "Admin - Employee List";
                        $at_action = "Updated Employee Information";
                        mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $updateID));
                    }
                    else 
                    {
                        // UPDATE PROBATIONARY EMPLOYEE
                        mysqli_query($conn, $employees->updateEmployeeInfo_prob($updateID, $updateLastName, $updateFirstName, $updateGender, $updateCivilStatus, $updateAddress, 
                        $updateDateOfBirth, $updatePlaceOfBirth, $updateSSS, $updatePagIbig, $updatePhilhealth, $updateTIN, $updateEmailAddress, 
                        $updateEmployeeID, $updateMobileNumber, $updateDepartmentID, $updateDesignationID, $updateShiftID, $updateBasicPay, $updateDailyRate, $updateHourlyRate, $updateVacationLeaves, $updateSickLeaves, $updateCashAdvance, $updateEmploymentStatus, $updateDateHired));
                    
                        // AUDIT TRAIL
                        $at_empID = $_SESSION['id'];
                        $at_module = "Admin - Employee List";
                        $at_action = "Updated Employee Information";
                        mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $updateID));
                    }
                    
                    mysqli_query($conn, $employees->updateEmployeeRequirements($updateID, $req_sss, $req_pagIbig, $req_philhealth, $req_tin, $req_nbi, $req_medicalExam, $req_2x2pic, $req_vaccineCard, $req_psa, $req_validID, $req_helloMoney));
                    mysqli_query($conn, $employees->updateEmployeeWeekOff($updateID, $wo_mon, $wo_tue, $wo_wed, $wo_thu, $wo_fri, $wo_sat, $wo_sun));

                    // PROCESS UPLOADED PHOTO
                    if (isset($_FILES['updateProfilePhoto']) && $_FILES['updateProfilePhoto']['error'] == 0) {
                        // DIRECTORY TO SAVE UPLOADED FILES
                        $uploadDir = __DIR__ . '/../../assets/images/profiles/'; 

                        // CHECK THE DIRECTORY FOLDER IF EXISTING, IF NOT CREATES IT
                        if (!file_exists($uploadDir)) {
                            mkdir($uploadDir, 0755, true);
                        }

                        // GENERATE NEW NAME
                        $modified_employeeID = str_replace("-", "", $updateEmployeeID);
                        $newFileName = $modified_employeeID. '.png';
                        $uploadFile = $uploadDir . $newFileName;

                        // DELETE EXISTING PROFILE PHOTO
                        $oldEmpID = str_replace("-", "", $oldEmployeeID);
                        $deleteOldPhoto = $uploadDir . $oldEmpID . '.png';
                        if (file_exists($deleteOldPhoto)) {
                            unlink($deleteOldPhoto);
                        }

                        // VALIDATE FILE TYPE
                        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                        if (in_array($_FILES['updateProfilePhoto']['type'], $allowedTypes)) {
                            if (move_uploaded_file($_FILES['updateProfilePhoto']['tmp_name'], $uploadFile)) {
                                // SUCCESSFULLY UPLOADED FILE
                                $em = "Employee Updated Successfully";
                                $error = array('error' => 0, 'em' => $em);
                                echo json_encode($error);
                                exit();
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
                    else {
                        // RENAME EXISTING PROFILE PHOTO
                        $uploadDir = __DIR__ . '/../../assets/images/profiles/'; 

                        $modified_employeeID = str_replace("-", "", $updateEmployeeID);
                        $newFileName = $modified_employeeID. '.png';
                        $uploadFile = $uploadDir . $newFileName;

                        $oldEmpID = str_replace("-", "", $oldEmployeeID);
                        $oldFile = $uploadDir . $oldEmpID . '.png';
                        if (file_exists($oldFile)) {
                            rename($oldFile, $uploadFile);
                        }

                        $em = "Employee Updated Successfully";
                        $error = array('error' => 0, 'em' => $em);
                        echo json_encode($error);
                        exit();
                    }
                }
            }
        }
    }
?>