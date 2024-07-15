<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $employeeID = $_SESSION['id'];
    $currentPassword = $_POST['currentPassword']; //  SESSION PASSWORD
    $currentPass = $_POST['currentPass']; // TYPED PASSWORD
    $newPassword = $_POST['newPass'];
    $retypePassword = $_POST['retypePass'];
    
    // CHECK PASSWORD ON CURRENTLY LOGGED IN USER
    if ($currentPassword == md5($currentPass)) 
    {
        // CHECK IF NEW PASSWORD IS THE SAME AS THE CURRENT PASSWORD
        if ($currentPass != $newPassword) 
        {
            // PASSWORD RESTRICTIONS
            if (preg_match('/^(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $newPassword))
            {
                // CHECK IF RETYPE PASSWORD IS THE SAME AS THE NEW PASSWORD
                if ($newPassword == $retypePassword)
                {
                    $newPassword = md5($newPassword);
                    mysqli_query($conn, $users->changePassword($employeeID, $newPassword));
                    $_SESSION['password'] = $retypePassword;
                    $_SESSION['storedPassword'] = $newPassword;
                    
                    $em = "Changed Password Successfully";
                    $error = array('error' => 0, 'em' => $em);
                }
                else 
                {
                    $em = "Retyped new password does not match to the new password.";
                    $error = array('error' => 1, 'em' => $em);
                }
            }
            else 
            {
                $em = "Password must be at least 8 characters long and contain at least one special character, one number, one uppercase and one lowercase letter!";
                $error = array('error' => 1, 'em' => $em);
            }
        }
        else 
        {
            $em = "New password cannot be the same as the current password.";
        $error = array('error' => 1, 'em' => $em);
        }
    }
    else 
    {
        $em = "Current password does not match to the current logged in user.";
        $error = array('error' => 1, 'em' => $em); 
    }

    echo json_encode($error);
    exit();
?>