<?php

    class Employees extends Database
    {
        private $employees = 'tbl_employee';
        private $users = 'tbl_users';
        private $department = 'tbl_department';
        private $designation = 'tbl_designation';
        private $attendance = 'tbl_attendance';
        private $logtype = 'tbl_logtype';
        private $shift = 'tbl_shiftschedule';
        private $changeShift = 'tbl_changeshiftrequests';
        private $leaves = 'tbl_leaveapplications';
        private $leaveType = 'tbl_leavetype';
        private $shifts = 'tbl_shiftschedule';
        private $requirements = 'tbl_requirements';
        private $dbConnect = false;
        public function __construct() {
            $this->dbConnect = $this->dbConnect();
        }

        public function viewEmployees() {
            $team = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                INNER JOIN ".$this->shifts." AS shifts
                ON employees.shiftID = shifts.shiftID";
            return $team;
        }

        public function viewRecentEmployees() {
            $team = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                ORDER BY employees.id DESC 
                LIMIT 5";
            return $team;
        }

        public function viewTeam() {
            $team = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                WHERE employees.departmentID = 4";
            return $team;
        }

        public function viewDTR($id) {
            $dtr = "
                SELECT * FROM ".$this->attendance." AS attendance 
                INNER JOIN ".$this->employees." AS employees
                ON attendance.empID = employees.id
                INNER JOIN ".$this->logtype." AS logtype 
                ON attendance.logTypeID = logtype.logTypeID 
                INNER JOIN ".$this->shift." AS shift 
                ON employees.shiftID = shift.shiftID
                WHERE empID='$id'";
            return $dtr;
        }

        public function viewChangeShift($id) {
            $request = "
                SELECT * FROM ".$this->changeShift." AS changeShift
                INNER JOIN ".$this->employees." AS employees
                ON changeShift.empID = employees.id
                INNER JOIN ".$this->shift." AS shift
                ON shift.shiftID = changeShift.requestedShift
                WHERE empID='$id'";
            return $request;
        }

        public function viewAdminChangeShiftRequest() {
            $request = "
                SELECT requestID, dateFiled, lastName, firstName, effectivityStartDate, 
                effectivityEndDate, CONCAT(shift_1.startTime, ' - ', shift_1.endTime) AS currentShift, 
                CONCAT(shift_2.startTime, ' - ', shift_2.endTime) AS requestedShift,  remarks, status  
                FROM ".$this->changeShift." AS changeShift
                INNER JOIN ".$this->employees." AS employees
                ON changeShift.empID = employees.id
                INNER JOIN ".$this->shift." AS shift_1
                ON shift_1.shiftID = employees.shiftID
                INNER JOIN ".$this->shift." AS shift_2
                ON shift_2.shiftID = changeShift.requestedShift";
            return $request;
        }

        public function viewChangeShiftRequest() {
            $request = "
                SELECT requestID, dateFiled, employeeName, effectivityStartDate, 
                effectivityEndDate, CONCAT(shift_1.startTime, ' - ', shift_1.endTime) AS currentShift, 
                CONCAT(shift_2.startTime, ' - ', shift_2.endTime) AS requestedShift,  remarks, status  
                FROM ".$this->changeShift." AS changeShift
                INNER JOIN ".$this->employees." AS employees
                ON changeShift.empID = employees.id
                INNER JOIN ".$this->shift." AS shift_1
                ON shift_1.shiftID = employees.shiftID
                INNER JOIN ".$this->shift." AS shift_2
                ON shift_2.shiftID = changeShift.requestedShift";
            return $request;
        }

        public function viewLeaves($id) {
            $request = "
                SELECT * FROM ".$this->leaves." AS leaves
                INNER JOIN ".$this->employees." AS employees
                ON leaves.empID = employees.id
                INNER JOIN ".$this->leaveType." AS leaveType
                ON leaveType.leaveTypeID = leaves.leaveTypeID
                WHERE empID='$id'";
            return $request;
        }

        public function viewAdminLeaveRequests() {
            $request = "
                SELECT * FROM ".$this->leaves." AS leaves
                INNER JOIN ".$this->employees." AS employees
                ON leaves.empID = employees.id
                INNER JOIN ".$this->leaveType." AS leaveType
                ON leaveType.leaveTypeID = leaves.leaveTypeID";
            return $request;
        }

        public function viewLeaveRequests() {
            $request = "
                SELECT * FROM ".$this->leaves." AS leaves
                INNER JOIN ".$this->employees." AS employees
                ON leaves.empID = employees.id
                INNER JOIN ".$this->leaveType." AS leaveType
                ON leaveType.leaveTypeID = leaves.leaveTypeID";
            return $request;
        }

        public function viewPersonnel() {
            $allPersonnel = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->users." AS users
                ON employees.id = users.empID
                WHERE users.status = 'Active' AND designationID = 1";
            return $allPersonnel;
        }

        public function viewInactivePersonnel() {
            $inactivePersonnel = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->users." AS users
                ON employees.id = users.empID
                WHERE users.status = 'Inactive'";
            return $inactivePersonnel;
        }

        public function viewTLQA() {
            $allTLQA = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->users." AS users
                ON employees.id = users.empID
                WHERE users.status = 'Active' AND designationID IN (2,3,4,5) ";
            return $allTLQA;
        }

        public function viewInactiveTLQA() {
            $allTLQA = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->users." AS users
                ON employees.id = users.empID
                WHERE users.status = 'Inactive' AND designationID IN (2,3,4,5) ";
            return $allTLQA;
        }

        public function viewFacilities() {
            $allHR = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->users." AS users
                ON employees.id = users.empID
                WHERE users.status = 'Active' AND designationID = 6";
            return $allHR;
        }

        public function viewInactiveFacilities() {
            $allHR = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->users." AS users
                ON employees.id = users.empID
                WHERE users.status = 'Inactive' AND designationID = 6";
            return $allHR;
        }

        public function viewHR() {
            $allHR = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->users." AS users
                ON employees.id = users.empID
                WHERE users.status = 'Active' AND designationID = 7";
            return $allHR;
        }

        public function viewInactiveHR() {
            $inactiveHR = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->users." AS users
                ON employees.id = users.empID
                WHERE users.status = 'Inactive' AND designationID = 7";
            return $inactiveHR;
        }

        public function viewFinance() {
            $allFinance = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->users." AS users
                ON employees.id = users.empID
                WHERE users.status = 'Active' AND designationID = 8";
            return $allFinance;
        }

        public function viewInactiveFinance() {
            $inactiveFinance = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->users." AS users
                ON employees.id = users.empID
                WHERE users.status = 'Inactive' AND designationID = 8";
            return $inactiveFinance;
        }

        public function viewIT() {
            $allAdmin = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->users." AS users
                ON employees.id = users.empID
                WHERE users.status = 'Active' AND departmentID = 4";
            return $allAdmin;
        }

        public function viewInactiveIT() {
            $inactiveAdmin = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->users." AS users
                ON employees.id = users.empID
                WHERE users.status = 'Inactive' AND departmentID = 4";
            return $inactiveAdmin;
        }

        public function viewDirectors() {
            $allAdmin = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->users." AS users
                ON employees.id = users.empID
                WHERE users.status = 'Active' AND departmentID = 5";
            return $allAdmin;
        }

        public function viewInactiveDirectors() {
            $inactiveAdmin = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->users." AS users
                ON employees.id = users.empID
                WHERE users.status = 'Inactive' AND departmentID = 5";
            return $inactiveAdmin;
        }

        public function viewShifts() {
            $allShifts = "
                SELECT * FROM ".$this->shifts;
            return $allShifts;
        }

        public function viewCurrentShift($id) {
            $currentShift = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->shifts." AS shifts
                ON employees.shiftID = shifts.shiftID
                WHERE employees.id = '$id'";
            return $currentShift;
        } 

        public function viewAllEmployee() {
            $allEmployee = "
                SELECT * FROM ".$this->employees."
                WHERE id NOT IN 
                    (SELECT employeeID FROM ".$this->users.")";
            return $allEmployee;
        }

        public function viewDepartment() {
            $department = "
                SELECT * FROM ".$this->department."";
            return $department;
        }

        public function viewDesignation() {
            $designation = "
                SELECT * FROM ".$this->designation."";
            return $designation;
        }

        public function viewAllShifts() {
            $allShifts = "
                SELECT shiftID, CONCAT(startTime, ' - ', endTime) AS shift 
                FROM ".$this->shifts;
            return $allShifts;
        }

        public function checkEmail($emailAddress) {
            $checkEmail = "
                SELECT * FROM ".$this->employees." 
                WHERE emailAddress = '".$emailAddress."'";
            return $checkEmail;
        }

        public function checkEmployeeID($employeeID) {
            $checkEmployeeID = "
                SELECT * FROM ".$this->employees." 
                WHERE employeeID = '".$employeeID."'";
            return $checkEmployeeID;
        }

        public function addNewEmployee($lastName, $firstName, $gender, $civilStatus, $address, $dateOfBirth, $placeOfBirth, 
            $sss, $pagIbig, $philhealth, $tin, $emailAddress, $employeeID, $mobileNumber, $departmentID, $designationID, $shiftID) {
            $addPersonnel = "
                INSERT INTO ".$this->employees." (lastName, firstName, gender, civilStatus, address, dateOfBirth, placeOfBirth, 
                sss, pagIbig, philhealth, tin, emailAddress, employeeID, mobileNumber, departmentID, designationID, shiftID)
                VALUES ('".$lastName."', '".$firstName."', '".$gender."', '".$civilStatus."', '".$address."', '".$dateOfBirth."', '".$placeOfBirth."',
                '".$sss."', '".$pagIbig."', '".$philhealth."', '".$tin."', '".$emailAddress."', '".$employeeID."', '".$mobileNumber."', 
                '".$departmentID."', '".$designationID."', '".$shiftID."')";
            return $addPersonnel;
        }

        public function viewLastEmployee() {
            $lastEmployee = "
                SELECT id FROM ".$this->employees." 
                ORDER BY id DESC LIMIT 1";
            return $lastEmployee;
        }

        public function addEmployeeRequirements($employeeID, $req_sss, $req_pagIbig, $req_philhealth, $req_tin, $req_nbi) {
            $addRequirement = "
                INSERT INTO ".$this->requirements." (empID, req_sss, req_pagIbig, req_philhealth, req_tin, req_nbi)
                VALUES ('".$employeeID."', '".$req_sss."', '".$req_pagIbig."', '".$req_philhealth."', '".$req_tin."', '".$req_nbi."')";
            return $addRequirement;
        }

        public function updateEmployeeInfo($updateUserID, $updateLastName, $updateFirstName, $updateGender, $updateCivilStatus, $updateAddress, 
            $updateDateOfBirth, $updatePlaceOfBirth, $updateSSS, $updatePagIbig, $updatePhilhealth, $updateTIN, $updateEmailAddress, 
            $updateEmployeeID, $updateMobileNumber, $updateDepartmentID, $updateDesignationID, $updateShiftID) {
            $updateEmployee = "
                UPDATE ".$this->employees." AS employees 
                SET lastName = '$updateLastName',
                firstName = '$updateFirstName',
                gender = '$updateGender',
                civilStatus = '$updateCivilStatus',
                address = '$updateAddress',
                dateOfBirth = '$updateDateOfBirth',
                placeOfBirth = '$updatePlaceOfBirth',
                sss = '$updateSSS',
                pagIbig = '$updatePagIbig',
                philhealth = '$updatePhilhealth',
                tin = '$updateTIN',
                emailAddress = '$updateEmailAddress',
                employeeID = '$updateEmployeeID',
                mobileNumber = '$updateMobileNumber',
                departmentID = '$updateDepartmentID',
                designationID = '$updateDesignationID',
                shiftID = '$updateShiftID'
                WHERE id = '$updateUserID'";
            return $updateEmployee;
        }

        public function updateEmployeeRequirements($empID, $updateSSS, $updatePagIbig, $updatePhilhealth, $updateTIN, $updateNBI) {
            $updateRequirement = "
                UPDATE ".$this->requirements." AS requirements SET
                req_sss = '$updateSSS',
                req_pagIbig = '$updatePagIbig',
                req_philhealth = '$updatePhilhealth',
                req_tin = '$updateTIN',
                req_nbi = '$updateNBI'
                WHERE empID = '$empID'";
            return $updateRequirement;
        }

        public function getEmployeeInfo($id) {
            $employeeInfo = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->shifts." AS shifts
                ON shifts.shiftID = employees.shiftID
                INNER JOIN ".$this->department." AS department
                ON department.departmentID = employees.departmentID
                INNER JOIN ".$this->designation." AS designation
                ON designation.designationID = employees.designationID
                INNER JOIN ".$this->requirements." AS requirements
                ON requirements.empID = employees.id
                WHERE id = '$id'";
            return $employeeInfo;
        }

        public function viewAttendance(){
            $attendance = "
                SELECT * FROM ".$this->attendance." AS attendance
                INNER JOIN ".$this->employees." AS employees
                ON attendance.empID = employees.id
                INNER JOIN ".$this->logtype." AS logtype
                ON attendance.logTypeID = logtype.logTypeID
                INNER JOIN ".$this->shift." AS shift
                ON employees.shiftID = shift.shiftID";
            return $attendance;
        }

        public function getLeaveInfo($leaveID) {
            $request = "
                SELECT requestID, lastName, firstName, employeeID,
                leaveType, remarks, status,
                DATE_FORMAT(dateFiled, '%M %d, %Y') AS dateFiled,
                DATE_FORMAT(effectivityStartDate, '%M %d, %Y') AS effectivityStartDate,
                DATE_FORMAT(effectivityEndDate, '%M %d, %Y') AS effectivityEndDate
                FROM ".$this->leaves." AS leaves
                INNER JOIN ".$this->employees." AS employees
                ON leaves.empID = employees.id
                INNER JOIN ".$this->leaveType." AS leaveType
                ON leaveType.leaveTypeID = leaves.leaveTypeID
                WHERE requestID = '$leaveID'";
            return $request;
        }

        public function getChangeShiftInfo($changeShiftID) {
            $request = "
                SELECT requestID, employeeID, lastName, firstName, CONCAT(shift_1.startTime, ' - ', shift_1.endTime) AS currentShift, 
                CONCAT(shift_2.startTime, ' - ', shift_2.endTime) AS requestedShift,  remarks, status,
                DATE_FORMAT(dateFiled, '%M %d, %Y') AS dateFiled,
                DATE_FORMAT(effectivityStartDate, '%M %d, %Y') AS effectivityStartDate, 
                DATE_FORMAT(effectivityEndDate, '%M %d, %Y') AS effectivityEndDate
                FROM ".$this->changeShift." AS changeShift
                INNER JOIN ".$this->employees." AS employees
                ON changeShift.empID = employees.id
                INNER JOIN ".$this->shift." AS shift_1
                ON shift_1.shiftID = employees.shiftID
                INNER JOIN ".$this->shift." AS shift_2
                ON shift_2.shiftID = changeShift.requestedShift
                WHERE requestID = '$changeShiftID'";
            return $request;
        }

        public function viewAllLeaveType() {
            $leaveType = "SELECT * FROM ".$this->leaveType;
            return $leaveType;
        }

        public function fileLeave($employeeID, $leaveTypeID, $effectivityStartDate, $effectivityEndDate, $remarks, $status) {
            $fileLeave = "
                INSERT INTO ".$this->leaves." (empID, dateFiled, leaveTypeID, effectivityStartDate, effectivityEndDate, remarks, status)
                VALUES ('$employeeID', CURRENT_TIMESTAMP, '$leaveTypeID', '$effectivityStartDate', '$effectivityEndDate', '$remarks', '$status')";
            return $fileLeave;
        }

        public function fileRequest($employeeID, $newshift, $effectivityStartDate, $effectivityEndDate, $remarks, $status) {
            $fileRequest = "
                INSERT INTO ".$this->changeShift." (empID, dateFiled, requestedShift, effectivityStartDate, effectivityEndDate, remarks, status)
                VALUES ('$employeeID', CURRENT_TIMESTAMP, '$newshift', '$effectivityStartDate', '$effectivityEndDate', '$remarks', '$status')";
            return $fileRequest;
        }
    }

?>