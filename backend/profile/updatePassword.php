<?php 

    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $userID = $_POST['userID'];
    $newPassword = $_POST['newPassword'];
    $retypePassword = $_POST['retypePassword'];
    $storedPassword = $_SESSION['hashedPassword'];

    // CHECK NEW PASSWORD AND STORED PASSWORD
    if (md5($newPassword) == $storedPassword)
    {
        // NEW PASSWORD SAME WITH CURRENT PASSWORD
        $data = [
            'status' => 200,
            'error' => 1,
            'message' => 'New password must be different from current password'
        ];
    }
    // CHECK CURRENT PASSWORD
    else if ($newPassword == $retypePassword) 
    {
        if (preg_match('/^(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $newPassword))
        {
            // UPDATE PASSWORD
            $newPassword = md5($newPassword);
            mysqli_query($conn, $users->updatePassword($userID, $newPassword));
            $_SESSION['activated'] = 1;
            $_SESSION['password'] = $retypePassword;
            $_SESSION['hashedPassword'] = $newPassword;
            $data = [
                'status' => 200,
                'error' => 0,
                'message' => 'Password Changed Successfully'
            ];
        }
        else 
        {
            // PASSWORD RESTRICTIONS
            $data = [
                'status' => 200,
                'error' => 1,
                'message' => 'Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number and one special character'
            ];
        }
    }
    else 
    {
        // WRONG CURRENT PASSWORD
        $data = [
            'status' => 200,
            'error' => 1,
            'message' => 'Password mismatch'
        ];
    }

    echo json_encode($data);
    return;
?>