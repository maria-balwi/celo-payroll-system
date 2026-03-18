<?php 
    include '../../init.php';
    $conn = $database->dbConnect();

    $newPassword = trim($_POST['newPassword']);
    $retypePassword = trim($_POST['retypePassword']);
    $userID = trim($_POST['userID']);

    // VALIDATE PASSWORD
    if (preg_match('/^(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $newPassword))
    {
        // UPDATE PASSWORD
        $newPassword = md5($newPassword);
        mysqli_query($conn, $users->userResetPassword($userID, $newPassword));
        echo json_encode([
            'status' => 0,
            'title' => 'Password Reset',
            'message' => 'Password Changed Successfully'
        ]);
    }
    else 
    {
        // PASSWORD RESTRICTIONS
        echo json_encode([
            'status' => 1,
            'title' => 'Invalid Password',
            'message' => 'Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number and one special character'
        ]);
    }
    exit();
?>
