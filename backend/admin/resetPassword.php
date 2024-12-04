<?php 

    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $userID = $_POST['userID'];
    $newPass = $_POST['newPass'];
    $retypePass = $_POST['retypePass'];

    if (isset($userID) || isset($newPass) || isset($retypePass))
    {
        if ($newPass == $retypePass)
        {
            if ($userID != $_SESSION["userID"])
            {
                if (preg_match('/^(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $newPass))
                {
                    $newPass = md5($newPass);
                    // UPDATE PASSWORD
                    mysqli_query($conn, $users->changePassword($userID, $newPass));

                    // GET AFFECTED USER
                    $query = mysqli_query($conn, $employees->viewUser($userID));
                    $queryDetails = mysqli_fetch_array($query);
                    $at_affectedEmpID = $queryDetails['empID'];

                    // AUDIT TRAIL
                    $at_empID = $_SESSION['id'];
                    $at_module = "Admin - User List";
                    $at_action = "Reset Password";
                    mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $at_affectedEmpID));

                    $data = [
                        'status' => 200,
                        'result' => 0,
                        'message' => 'Password Changed Successfully'
                    ];
                }
                else 
                {
                    // ERROR MESSAGE
                    $data = [
                        'status' => 200,
                        'result' => 2,
                        'message' => 'Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number and one special character'
                    ];
                }
            }
            else 
            {
                // ERROR MESSAGE
                $data = [
                    'status' => 200,
                    'result' => 2,
                    'message' => 'Change your password on the Profile section.'
                ];
            }
        }
        else 
        {
            // ERROR MESSAGE
            $data = [
                'status' => 200,
                'result' => 1,
                'message' => 'Password Mismatch'
            ];
        }
        
    }
    else 
    {
        // ERROR MESSAGE
        $data = [
            'status' => 404,
            'message' => 'User was not existing'
        ];
    }

    echo json_encode($data);
    return;

?>