<?php 

    include '../../init.php';
    session_start();
    $conn = $database->dbConnect();

    if (isset($_GET['user_ID'])) {
        $user_ID = mysqli_real_escape_string($conn, $_GET['user_ID']);
        $getUserQuery = $users->getUserInfo($user_ID);
        $getUserResult = mysqli_query($conn, $getUserQuery);

        if(mysqli_num_rows($getUserResult) == 1)
        {
            $user = mysqli_fetch_array($getUserResult);
            
            $res = [
                'status' => 200,
                'message' => 'User Fetch Successfully by id',
                'data' => $user
            ];

            echo json_encode($res);
            return;
        }
        else
        {
            $res = [
                'status' => 404,
                'message' => 'User Id not found'
            ];
            echo json_encode($res);
            return;
        } 
    }


?>