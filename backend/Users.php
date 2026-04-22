<?php

    class Users extends Database
    {
        private $employees = 'tbl_employee';
        private $users = 'tbl_users';
        private $department = 'tbl_department';
        private $designation = 'tbl_designation';
        private $attendance = 'tbl_attendance';
        private $logtype = 'tbl_logtype';
        private $shift = 'tbl_shiftschedule';
        private $requirements = 'tbl_requirements';
        private $settings = 'settings';
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

            $userResult = mysqli_query($this->dbConnect(), $userQuery);
            $isUserValid = mysqli_num_rows($userResult);
            $userDetails = mysqli_fetch_array($userResult);

            $result = [];

            if ($isUserValid == 1) {
                $storedHashedPassword = $userDetails['password'];
                $password = md5($password);
                if ($storedHashedPassword == $password && $userDetails['status'] == "Active") {
                    // SET SESSION VARIABLES
                    $_SESSION["logged_in"] = TRUE;
                    $_SESSION['userID'] = $userDetails['userID'];
                    $_SESSION['id'] = $userDetails['id'];
                    $_SESSION['employeeName'] = $userDetails['firstName']." ".$userDetails['lastName'];
                    $_SESSION['departmentID'] = $userDetails['departmentID'];
                    $_SESSION['designationID'] = $userDetails['designationID'];
                    $_SESSION['levelID'] = $userDetails['levelID']; 
                    $_SESSION['email'] = $userDetails['emailAddress'];
                    $_SESSION['employeeID'] = $userDetails['employeeID'];
                    $_SESSION['hashedPassword'] = $userDetails['password'];
                    $_SESSION['password'] = $pass_word;
                    $_SESSION['activated'] = $userDetails['activated']; 
                    $_SESSION['gender'] = $userDetails['gender'];

                    // SESSION TIMEOUT 
                    $_SESSION['start'] = time();
                    if ($userDetails['levelID'] == 1) {
                        $_SESSION['expire'] = $_SESSION['start'] + (60 * 5); // AGENT LEVEL
                    }
                    else if ($userDetails['levelID'] == 2 || $userDetails['levelID'] == 6) {
                        $_SESSION['expire'] = $_SESSION['start'] + (60 * 20); // TEAM LEAD & IT SUPERVISOR & MANAGER LEVEL
                    }
                    else if ($userDetails['levelID'] == 3) {
                        $_SESSION['expire'] = $_SESSION['start'] + (60 * 60); // ADMIN LEVEL
                    }
                    else if ($userDetails['levelID'] == 4 || $userDetails['levelID'] == 5) {
                        $_SESSION['expire'] = $_SESSION['start'] + (60 * 30); // HR & ADMIN STAFF , HR GENERALIST LEVEL
                    }

                    // RETURN VALUES
                    $result[0] = '1';
                    $result[1] = $userDetails['levelID'];
                    $result[2] = $userDetails['e_status'];
                    return $result;
                }
                else {
                    if ($userDetails['status'] == "Inactive") {
                        $result[0] = '2';
                        return $result;
                    }
                    else {
                        // INCORRECT PASSWORD
                        $result[0] = '0';
                        return $result;
                    }
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
                WHERE empID = ".$id."";
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

        public function resetPassword($userID, $newPass) {
            $resetPassword = "
                UPDATE ".$this->users." SET
                password = '$newPass', 
                activated = 0
                WHERE userID = ".$userID."";
            return $resetPassword;
        }

        public function userResetPassword($userID, $newPassword) { 
            $resetPassword = "
                UPDATE ".$this->users." SET
                password = '$newPassword'
                WHERE userID = '$userID'";
            return $resetPassword;
        }

        public function viewUser($id) {
            $user = "
                SELECT CONCAT(employees.firstName, ' ', employees.lastName) AS employeeName, 
                departmentName, position, emailAddress, mobileNumber, 
                address, dateOfBirth, placeOfBirth, gender, 
                civilStatus, sss, pagIbig, philhealth, tin, 
                DATE_FORMAT(startTime, '%h:%i %p') AS startTime,
                DATE_FORMAT(endTime, '%h:%i %p') AS endTime, 
                basicPay, dailyRate, hourlyRate, leavePoints, availableVL, availableSL,
                req_sss, req_pagIbig, req_philhealth, req_tin, req_nbi, 
                req_medicalExam, req_2x2pic, req_vaccineCard, req_psa,
                req_validID, req_helloMoney, employmentStatus, 
                DATE_FORMAT(dateHired, '%M %d, %Y') AS dateHired,
                DATE_FORMAT(dateRegularized, '%M %d, %Y') AS dateRegularized
                FROM ".$this->employees." AS employees
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                INNER JOIN ".$this->designation." AS designation
                ON employees.designationID = designation.designationID
                INNER JOIN ".$this->shift." AS shifts
                ON employees.shiftID = shifts.shiftID
                INNER JOIN ".$this->requirements." AS requirements
                ON employees.id = requirements.empID
                WHERE employees.id = '$id'";
            return $user;
        }

        public function addUser($employeeID, $levelID, $password, $activated, $status) {
            $addUser = "
                INSERT INTO ".$this->users." (empID, levelID, password, activated, status)
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

        public function viewLastUser() {
            $lastUser = "
                SELECT userID FROM ".$this->users." 
                ORDER BY userID DESC LIMIT 1";
            return $lastUser;
        }

        public function saveDTR($id, $logTypeID, $attendanceDate, $attendanceTime) {
            $saveDTR = "
                INSERT INTO ".$this->attendance." (empID, logTypeID, attendanceSource, attendanceDate, attendanceTime)
                VALUES ('$id', '$logTypeID', 'FACE', '$attendanceDate', '$attendanceTime')";
            return $saveDTR;
        }

        public function saveDTRLate($id, $logTypeID, $attendanceDate, $attendanceTime, $lateMins) {
            $saveDTR = "
                INSERT INTO ".$this->attendance." (empID, logTypeID, attendanceSource, attendanceDate, attendanceTime, lateMins)
                VALUES ('$id', '$logTypeID', 'FACE', '$attendanceDate', '$attendanceTime', '$lateMins')";
            return $saveDTR;
        }

        public function saveDTRUndertime($id, $logTypeID, $attendanceDate, $attendanceTime, $undertimeMins) {
            $saveDTR = "
                INSERT INTO ".$this->attendance." (empID, logTypeID, attendanceSource, attendanceDate, attendanceTime, undertimeMins)
                VALUES ('$id', '$logTypeID', 'FACE', '$attendanceDate', '$attendanceTime', '$undertimeMins')";
            return $saveDTR;
        }

        public function saveMissingDTR($id, $logTypeID, $attendanceDate, $attendanceTime) {
            $saveDTR = "
                INSERT INTO ".$this->attendance." (empID, logTypeID, attendanceSource, attendanceDate, attendanceTime)
                VALUES ('$id', '$logTypeID', 'FACE', '$attendanceDate', '$attendanceTime')";
            return $saveDTR;
        }

        public function getShiftInfo($id){
            $shift = "
                SELECT shifts.shiftID, startTime, endTime
                FROM ".$this->shift." AS shifts
                INNER JOIN ".$this->employees." AS employees
                ON employees.shiftID = shifts.shiftID
                WHERE employees.id = '$id'";
            return $shift;
        }

        public function getUserAccount($id) {
            $getUser = "SELECT * FROM {$this->users} WHERE empID = '$id'";
            return $getUser;
        }

        public function updateUserAccount($empID, $levelID) {
            $updateUser = "
                UPDATE {$this->users} 
                SET levelID = '$levelID' WHERE empID = '$empID'";
            return $updateUser;
        }

        public function checkLastDTR($id) {
            $checkLastDTR = "
                SELECT * FROM ".$this->attendance." AS attendance
                INNER JOIN ".$this->logtype." AS logtype
                ON attendance.logTypeID = logtype.logTypeID
                INNER JOIN ".$this->employees." AS employees
                ON attendance.empID = employees.id
                INNER JOIN ".$this->shift." AS shift
                ON employees.shiftID = shift.shiftID
                WHERE attendance.empID = '$id'
                ORDER BY attendanceID DESC
                LIMIT 1";
            return $checkLastDTR;
        }

        public function checkVersion() {
            $checkVersion = "
                SELECT version FROM ".$this->settings." ORDER BY id DESC LIMIT 1";
            return $checkVersion;
        }

        public function cacheBusting() {
            $db = $this->dbConnect();
            $query = $db->query($this->checkVersion());
            $version = $query ? $query->fetch_assoc()['version'] : '1.0.0';
            return $version;
        }
    }

?>