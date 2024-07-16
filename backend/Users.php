<?php

    class Users extends Database
    {
        private $employees = 'tbl_employee';
        private $users = 'tbl_users';
        private $department = 'tbl_department';
        private $designation = 'tbl_designation';
        private $shifts = 'tbl_shiftschedule';
        private $dbConnect = false;
        public function __construct() {
            $this->dbConnect = $this->dbConnect();
        }

        public function isLoggedIn() {
            if ($_SESSION["logged_in"] == TRUE) {
                return true;
            }
            else {
                return false;
            }
        }

        public function login() {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $pass_word = $password;
            
            $userQuery = "SELECT * FROM ".$this->users." AS users INNER JOIN ".$this->employees." AS employees ON users.empID = employees.id WHERE emailAddress = '$email'";

            $userResult = mysqli_query($this->dbConnect, $userQuery);
            $isUserValid = mysqli_num_rows($userResult);
            $userDetails = mysqli_fetch_array($userResult);

            $result = [];

            if ($isUserValid == 1) {
                $storedHashedPassword = $userDetails['password'];
                $password = md5($password);
                if ($storedHashedPassword == $password) {
                    // SET SESSION VARIABLES
                    $_SESSION["logged_in"] = TRUE;
                    $_SESSION['userID'] = $userDetails['userID'];
                    $_SESSION['id'] = $userDetails['id'];
                    $_SESSION['employeeName'] = $userDetails['employeeName'];
                    // $_SESSION['department'] = $userDetails['departmentName'];
                    // $_SESSION['designation'] = $userDetails['position'];
                    $_SESSION['levelID'] = $userDetails['levelID']; 
                    $_SESSION['email'] = $userDetails['emailAddress'];
                    $_SESSION['hashedPassword'] = $userDetails['password'];
                    $_SESSION['password'] = $pass_word;
                    $_SESSION['activated'] = $userDetails['activated']; 

                    // 1 HR SESSION 
                    $_SESSION['start'] = time();
                    $_SESSION['expire'] = $_SESSION['start'] + (60 * 60);

                    // RETURN VALUES
                    $result[0] = '1';
                    $result[1] = $userDetails['levelID'];
                    return $result;
                }
                else {
                    // INCORRECT PASSWORD
                    $result[0] = '0';
                    return $result;
                }
            }
        }

        public function logout() {
            session_start();

            // REMOVE ALL SESSION VARIABLES
            session_unset();

            // DESTROY THE SESSION
            session_destroy();
            return TRUE;
        }

        public function changePassword($id, $newPass) {
            $changePassword = "
                UPDATE ".$this->users." SET
                password = '$newPass'
                WHERE employeeID = ".$id."";
            return $changePassword;
        }

        public function updatePassword($userID, $newPass) {
            $updatePassword = "
                UPDATE ".$this->users." SET
                password = '$newPass', 
                activated = 1
                WHERE userID = ".$userID."";
            return $updatePassword;
        }

        public function viewUser($id) {
            $user = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                INNER JOIN ".$this->designation." AS designation
                ON employees.designationID = designation.designationID
                INNER JOIN ".$this->shifts." AS shifts
                ON employees.shiftID = shifts.shiftID
                WHERE employees.id = '$id'";
            return $user;
        }

        public function addUser($employeeID, $levelID, $password, $activated, $status) {
            $addUser = "
                INSERT INTO ".$this->users." (employeeID, levelID, password, activated, status)
                VALUES ('$employeeID', '$levelID', '$password', '$activated', '$status')";
            return $addUser;
        }

        public function getUserInfo($userID) {
            $userInfo = "
                SELECT * FROM ".$this->users." AS users
                INNER JOIN ".$this->employees." AS employees
                ON users.empID = employees.id
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                INNER JOIN ".$this->designation." AS designation
                ON employees.designationID = designation.designationID
                WHERE userID = ".$userID."";
            return $userInfo;
        }
    }

?>