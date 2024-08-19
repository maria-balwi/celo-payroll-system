<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $employeeID = $_POST['employeeID'];
    $password = $_POST['password'];
    $retypePassword = $_POST['retypePassword'];

    $employeeQuery = mysqli_query($conn, $employees->viewEmployee($employeeID));
    $employeeResult = mysqli_fetch_array($employeeQuery);
    $departmentID = $employeeResult['departmentID'];
    $designationID = $employeeResult['designationID'];

    if (($departmentID == 4 && $designationID == 11) || ($departmentID == 1 && $designationID == 4))
    {
        $levelID = 2;
    }
    else if ($departmentID == 3 && ($designationID == 8 || $designationID == 9))
    {
        $levelID = 3;
    }
    else  
    {
        $levelID = 1;
    }
    
    // DEFAULT VALUES
    $activated = 0;
    $status = "Active";

    if ($password == $retypePassword) 
    {
        // PASSWORD RESTRICTIONS
        if (preg_match('/^(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $password))
        {
            $password = md5($password);
            mysqli_query($conn, $users->addUser($employeeID, $levelID, $password, $activated, $status));
            $em = "User Added Successfully";
            $error = array('error' => 0, 'em' => $em);
            echo json_encode($error);
            exit();
        }
        // PASSWORD RESTRICTIONS
        else 
        {
            $em = "Password must be at least 8 characters long and contain at least one special character, one number, one uppercase and one lowercase letter!";
            $error = array('error' => 2, 'em' => $em);
            echo json_encode($error);
            exit();
        }
    }
    // PASSWORDS DO NOT MATCH
    else 
    {
        $em = "Passwords do not match!";
        $error = array('error' => 1, 'em' => $em);
        echo json_encode($error);
        exit();
    }
?>