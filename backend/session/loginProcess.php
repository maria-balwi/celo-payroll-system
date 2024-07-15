<?php

    //LOGIN PROCESS
    include '../../init.php';
    session_start();
    $conn = $database->dbConnect();

    $email = $_POST['email'];
    $password = $_POST['password'];

    $loginResult = $users->login();

    // USER LEVEL
    if (isset($loginResult[0])) {
        if ($loginResult[0] == 0) {
            $em = "Incorrect email address or password.";
            $error = array('error' => 1, 'em' => $em);
            echo json_encode($error);
            exit();
        }
        else {
            $error = array('level' => $loginResult[1], 'activated' => $_SESSION['activated']);
            echo json_encode($error);
        exit();
        }
    }

    // SUPER ADMIN LEVEL 
    else if ($email == 'superadmin@celoph.com') {
        if ($password == 'C3l0p@ssw0rd@65') {
            $_SESSION['logged_in'] = TRUE;
            $_SESSION['employeeName'] = 'Super Admin';
            $_SESSION['levelID'] = '0';
            $_SESSION['activated'] = '1';
            $_SESSION['start'] = time();
            $_SESSION['expire'] = $_SESSION['start'] + (60 * 60);

            $error = array('level' => 0);
            echo json_encode($error);
            exit();
        }
        // INCORRECT PASSWORD
        else {
            $em = "Incorrect email address or password.";
            $error = array('error' => 1, 'em' => $em);
            echo json_encode($error);
            exit();
        }
        
    }

    // USER DOES NOT EXIST
    else {
        $em = "Username does not exist in the system!";
        $error = array('error' => 0, 'em' => $em);
        echo json_encode($error);
        exit();
    }

?>