<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $id = $_SESSION['id'];
    $gender = $_POST['gender'];
    $civilStatus = $_POST['civilStatus'];
    $mobileNumber = $_POST['mobileNumber'];
    $address = $_POST['address'];

    // FETCH SCHEDULED CHANGE INFO
    $scheduledChange = mysqli_query($conn, $employees->getScheduledChange($id));
    $scheduledChange = mysqli_fetch_assoc($scheduledChange);
    $nextChangeDate = $scheduledChange['nextChangeDate'];

    // FETCH USER DETAILS
    $userQuery = mysqli_query($conn, $users->getUserAccount($id));
    $userDetails = mysqli_fetch_assoc($userQuery);
    $activated = $userDetails['activated'];
    
    // CHECK PASSWORD ON CURRENTLY LOGGED IN USER
    if ($civilStatus == "Married") 
    {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];

        // UPDATE EMPLOYEE INFO
        mysqli_query($conn, $employees->updateMarriedEmpInfo($id, $firstName, $lastName, $gender, $civilStatus, $mobileNumber, $address));

        // UPDATE SCHEDULED EMP INFO TABLE
        mysqli_query($conn, $employees->updateEmpInfoSchedule($id, "Updated", $nextChangeDate));

        // UPDATE SESSION
        $_SESSION['employeeName'] = $firstName . ' ' . $lastName;
        $_SESSION['gender'] = $gender;
        $_SESSION['updateEmpInfo'] = 0;
        $_SESSION['activated'] = $activated;
        
        $em = "Employee info updated successfully.";
        $error = array('error' => 0, 'em' => $em);
    }
    else if ($civilStatus != "Married")
    {
        // UPDATE EMPLOYEE INFO
        mysqli_query($conn, $employees->updateEmpInfo($id, $gender, $civilStatus, $mobileNumber, $address));

        // UPDATE SCHEDULED EMP INFO TABLE
        mysqli_query($conn, $employees->updateEmpInfoSchedule($id, "Updated", $nextChangeDate));

        // UPDATE SESSION
        $_SESSION['gender'] = $gender;
        $_SESSION['updateEmpInfo'] = 0;
        $_SESSION['activated'] = $activated;
        
        $em = "Employee info updated successfully.";
        $error = array('error' => 0, 'em' => $em);
    }

    echo json_encode($error);
    exit();
?>