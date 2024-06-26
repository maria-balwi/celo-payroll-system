<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();
    
    // CHECKS IF SOMEONE IS LOGGED IN
    if ($users->isLoggedIn()) 
    {
        $now = time();

        if ($now > $_SESSION['expire'])
        {
            session_unset();
            session_destroy();

            $data = [
                'status' => 200,
                'result' => 1,
                'message' => 'Session Expired'
            ];
        }

    }
    else 
    {
        // NO ONE IS LOGGED IN
        $data = [
            'status' => 404,
            'message' => 'No one is logged in'
        ];
    }
    echo json_encode($data);
?>