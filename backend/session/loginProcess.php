<?php

    //LOGIN PROCESS
    include '../../init.php';
    session_start();
    // $conn = $database->dbConnect();

    $email = $_POST['email'];
    $password = $_POST['password'];

    // ADMIN LEVEL
    if ($email == 'admin@celoph.com' && $password == 'admin') {
        $_SESSION["user"] = "admin";

        // // ending a session in 1 hr from the starting time
        // $_SESSION["expire"] = $_SESSION["start"] + (60 * 60);

        $error = array('level' => 1);
        echo json_encode($error);
    }

    //  USER LEVEL
    else if ($email == 'user@celoph.com' && $password == 'user') {
        $_SESSION["user"] = "user";

        // // ending a session in 1 hr from the starting time
        // $_SESSION["expire"] = $_SESSION["start"] + (60 * 60);

        $error = array('level' => 0);
        echo json_encode($error);
    }


    else {
        $em = "Username does not exist in the system!";
        $error = array('error' => 1, 'em' => $em);
        echo json_encode($error);
        exit();
    }

?>