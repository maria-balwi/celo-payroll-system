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
        private $filedOT = 'tbl_filedot';
        private $shifts = 'tbl_shiftschedule';
        private $requirements = 'tbl_requirements';
        private $allowances = 'tbl_allowances';
        private $deductions = 'tbl_deductions';
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

        public function recentlyAddedEmployees() {
            $team = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                INNER JOIN ".$this->shifts." AS shifts
                ON employees.shiftID = shifts.shiftID
                LIMIT 5";
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

        public function viewTeamOperations() {
            $team = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                WHERE employees.departmentID = 1";
            return $team;
        }

        public function viewDTR($id) {
            $dtr = "
                SELECT attendanceDate, id, logType,   
                DATE_FORMAT(attendanceTime, '%h:%i %p') AS attendanceTime, 
                DATE_FORMAT(startTime, '%h:%i %p') AS startTime, 
                DATE_FORMAT(endTime, '%h:%i %p') AS endTime
                FROM ".$this->attendance." AS attendance 
                INNER JOIN ".$this->employees." AS employees
                ON attendance.empID = employees.id
                INNER JOIN ".$this->logtype." AS logtype 
                ON attendance.logTypeID = logtype.logTypeID 
                INNER JOIN ".$this->shift." AS shift 
                ON employees.shiftID = shift.shiftID
                WHERE empID='$id'
                ORDER BY attendanceDate DESC, attendanceTime DESC";
            return $dtr;
        } 
        public function viewDTR2($id, $yearMonth) {
            $dtr = "
                SELECT attendanceDate, id, attendance.logTypeID, logType,   
                DATE_FORMAT(attendanceTime, '%h:%i %p') AS attendanceTime, 
                DATE_FORMAT(startTime, '%h:%i %p') AS startTime, 
                DATE_FORMAT(endTime, '%h:%i %p') AS endTime
                FROM ".$this->attendance." AS attendance 
                INNER JOIN ".$this->employees." AS employees
                ON attendance.empID = employees.id
                INNER JOIN ".$this->logtype." AS logtype 
                ON attendance.logTypeID = logtype.logTypeID 
                INNER JOIN ".$this->shift." AS shift 
                ON employees.shiftID = shift.shiftID
                WHERE empID='$id'
                AND DATE_FORMAT(attendanceDate, '%Y-%m') = '$yearMonth'
                ORDER BY attendanceDate DESC, attendanceTime DESC";
            return $dtr;
        }

        public function viewOT($id) {
            $request = "
                SELECT requestID, dateFiled, otDate,
                actualOThours, actualOTmins,
                approvedOThours, approvedOTmins,
                remarks, status
                FROM ".$this->filedOT." AS filedOT
                INNER JOIN ".$this->employees." AS employees
                ON filedOT.empID = employees.id
                WHERE requestID='$id'";
            return $request;
        }

        public function viewFiledOT($id) {
            $request = "
                SELECT requestID, dateFiled, otDate,
                actualOThours, actualOTmins,
                approvedOThours, approvedOTmins,
                remarks, status
                FROM ".$this->filedOT." AS filedOT
                INNER JOIN ".$this->employees." AS employees
                ON filedOT.empID = employees.id
                WHERE empID='$id'";
            return $request;
        }

        public function viewAdminFiledOT() {
            $request = "
                SELECT requestID, dateFiled, otDate, employeeID,
                CONCAT(firstName , ' ', lastName) AS employeeName,
                actualOThours, actualOTmins,
                approvedOThours, approvedOTmins,
                remarks, status
                FROM ".$this->filedOT." AS filedOT
                INNER JOIN ".$this->employees." AS employees
                ON filedOT.empID = employees.id";
            return $request;
        }

        public function viewTeamITFiledOT() {
            $request = "
                SELECT requestID, dateFiled, otDate, employeeID,
                CONCAT(firstName , ' ', lastName) AS employeeName,
                actualOThours, actualOTmins,
                approvedOThours, approvedOTmins,
                remarks, status
                FROM ".$this->filedOT." AS filedOT
                INNER JOIN ".$this->employees." AS employees
                ON filedOT.empID = employees.id
                INNER JOIN ".$this->department." AS department
                ON department.departmentID = employees.departmentID
                WHERE employees.departmentID = 4";
            return $request;
        }

        public function viewTeamOperationsFiledOT() {
            $request = "
                SELECT requestID, dateFiled, otDate, employeeID,
                CONCAT(firstName , ' ', lastName) AS employeeName,
                actualOThours, actualOTmins,
                approvedOThours, approvedOTmins,
                remarks, status
                FROM ".$this->filedOT." AS filedOT
                INNER JOIN ".$this->employees." AS employees
                ON filedOT.empID = employees.id
                INNER JOIN ".$this->department." AS department
                ON department.departmentID = employees.departmentID
                WHERE employees.departmentID = 1";
            return $request;
        }

        public function viewChangeShift($id) {
            $request = "
                SELECT requestID, dateFiled, remarks, status, 
                effectivityStartDate, effectivityEndDate,
                DATE_FORMAT(shift.startTime, '%h:%i %p') AS startTime,
                DATE_FORMAT(shift.endTime, '%h:%i %p') AS endTime
                FROM ".$this->changeShift." AS changeShift
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
                effectivityEndDate, remarks, status, 
                CONCAT(DATE_FORMAT(shift_1.startTime, '%h:%i %p'), ' - ', DATE_FORMAT(shift_1.endTime, '%h:%i %p')) AS currentShift, 
                CONCAT(DATE_FORMAT(shift_2.startTime, '%h:%i %p'), ' - ', DATE_FORMAT(shift_2.endTime, '%h:%i %p')) AS requestedShift
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
                SELECT requestID, dateFiled, lastName, firstName, effectivityStartDate, remarks, status, effectivityEndDate, 
                CONCAT(DATE_FORMAT(shift_1.startTime, '%h:%i %p'), ' - ', DATE_FORMAT(shift_1.endTime, '%h:%i %p')) AS currentShift, 
                CONCAT(DATE_FORMAT(shift_2.startTime, '%h:%i %p'), ' - ', DATE_FORMAT(shift_2.endTime, '%h:%i %p')) AS requestedShift
                FROM ".$this->changeShift." AS changeShift
                INNER JOIN ".$this->employees." AS employees
                ON changeShift.empID = employees.id
                INNER JOIN ".$this->shift." AS shift_1
                ON shift_1.shiftID = employees.shiftID
                INNER JOIN ".$this->shift." AS shift_2
                ON shift_2.shiftID = changeShift.requestedShift";
            return $request;
        }

        public function viewChangeShiftRequestIT() {
            $request = "
                SELECT requestID, dateFiled, lastName, firstName, effectivityStartDate, remarks, status, effectivityEndDate, 
                CONCAT(DATE_FORMAT(shift_1.startTime, '%h:%i %p'), ' - ', DATE_FORMAT(shift_1.endTime, '%h:%i %p')) AS currentShift, 
                CONCAT(DATE_FORMAT(shift_2.startTime, '%h:%i %p'), ' - ', DATE_FORMAT(shift_2.endTime, '%h:%i %p')) AS requestedShift
                FROM ".$this->changeShift." AS changeShift
                INNER JOIN ".$this->employees." AS employees
                ON changeShift.empID = employees.id
                INNER JOIN ".$this->department." AS department
                ON department.departmentID = employees.departmentID
                INNER JOIN ".$this->shift." AS shift_1
                ON shift_1.shiftID = employees.shiftID
                INNER JOIN ".$this->shift." AS shift_2
                ON shift_2.shiftID = changeShift.requestedShift
                WHERE employees.departmentID = 4";
            return $request;
        }

        public function viewChangeShiftRequestOperations() {
            $request = "
                SELECT requestID, dateFiled, lastName, firstName, effectivityStartDate, remarks, status, effectivityEndDate, 
                CONCAT(DATE_FORMAT(shift_1.startTime, '%h:%i %p'), ' - ', DATE_FORMAT(shift_1.endTime, '%h:%i %p')) AS currentShift, 
                CONCAT(DATE_FORMAT(shift_2.startTime, '%h:%i %p'), ' - ', DATE_FORMAT(shift_2.endTime, '%h:%i %p')) AS requestedShift
                FROM ".$this->changeShift." AS changeShift
                INNER JOIN ".$this->employees." AS employees
                ON changeShift.empID = employees.id
                INNER JOIN ".$this->department." AS department
                ON department.departmentID = employees.departmentID
                INNER JOIN ".$this->shift." AS shift_1
                ON shift_1.shiftID = employees.shiftID
                INNER JOIN ".$this->shift." AS shift_2
                ON shift_2.shiftID = changeShift.requestedShift
                WHERE employees.departmentID = 1";
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

        public function viewLeaveRequestsIT() {
            $request = "
                SELECT * FROM ".$this->leaves." AS leaves
                INNER JOIN ".$this->employees." AS employees
                ON leaves.empID = employees.id
                INNER JOIN ".$this->department." AS department
                ON department.departmentID = employees.departmentID
                INNER JOIN ".$this->leaveType." AS leaveType
                ON leaveType.leaveTypeID = leaves.leaveTypeID
                WHERE employees.departmentID = 4";
            return $request;
        }

        public function viewLeaveRequestsOperations() {
            $request = "
                SELECT * FROM ".$this->leaves." AS leaves
                INNER JOIN ".$this->employees." AS employees
                ON leaves.empID = employees.id
                INNER JOIN ".$this->department." AS department
                ON department.departmentID = employees.departmentID
                INNER JOIN ".$this->leaveType." AS leaveType
                ON leaveType.leaveTypeID = leaves.leaveTypeID
                WHERE employees.departmentID = 1";
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
                WHERE users.status = 'Inactive' AND designationID IN (2,3,4,5)";
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
                WHERE users.status = 'Active' AND designationID IN (7,9)";
            return $allHR;
        }

        public function viewInactiveHR() {
            $inactiveHR = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->users." AS users
                ON employees.id = users.empID
                WHERE users.status = 'Inactive' AND designationID IN (7,9)";
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
                WHERE users.status = 'Active' AND departmentID = 12";
            return $allAdmin;
        }

        public function viewInactiveDirectors() {
            $inactiveAdmin = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->users." AS users
                ON employees.id = users.empID
                WHERE users.status = 'Inactive' AND departmentID = 12";
            return $inactiveAdmin;
        }

        public function viewShifts() {
            $allShifts = "
                SELECT shiftID, 
                DATE_FORMAT(startTime, '%h:%i %p') AS startTime, 
                DATE_FORMAT(endTime, '%h:%i %p') AS endTime 
                FROM ".$this->shifts;
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
                    (SELECT empID FROM ".$this->users.")";
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
                SELECT shiftID, CONCAT(DATE_FORMAT(startTime, '%h:%i %p'), ' - ', DATE_FORMAT(endTime, '%h:%i %p')) AS shift 
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
            $sss, $pagIbig, $philhealth, $tin, $emailAddress, $employeeID, $mobileNumber, $departmentID, $designationID, $shiftID, 
            $basicPay, $dailyRate, $hourlyRate, $vacationLeaves, $sickLeaves) {
            $addEmployee = "
                INSERT INTO ".$this->employees." (lastName, firstName, gender, civilStatus, address, dateOfBirth, placeOfBirth, 
                sss, pagIbig, philhealth, tin, emailAddress, employeeID, mobileNumber, departmentID, designationID, shiftID, basicPay, dailyRate, hourlyRate, availableVL, availableSL)
                VALUES ('".$lastName."', '".$firstName."', '".$gender."', '".$civilStatus."', '".$address."', '".$dateOfBirth."', '".$placeOfBirth."',
                '".$sss."', '".$pagIbig."', '".$philhealth."', '".$tin."', '".$emailAddress."', '".$employeeID."', '".$mobileNumber."', 
                '".$departmentID."', '".$designationID."', '".$shiftID."', '".$basicPay."', '".$dailyRate."', '".$hourlyRate."', '".$vacationLeaves."', '".$sickLeaves."')";
            return $addEmployee;
        }

        public function viewLastEmployee() {
            $lastEmployee = "
                SELECT id FROM ".$this->employees." 
                ORDER BY id DESC LIMIT 1";
            return $lastEmployee;
        }

        public function addEmployeeRequirements($employeeID, $req_sss, $req_pagIbig, $req_philhealth, $req_tin, $req_nbi, $req_medicalExam, $req_2x2pic, $req_vaccineCard, $req_psa, $req_validID, $req_helloMoney) {
            $addRequirement = "
                INSERT INTO ".$this->requirements." (empID, req_sss, req_pagIbig, req_philhealth, req_tin, req_nbi, req_medicalExam, req_2x2pic, req_vaccineCard, req_psa, req_validID, req_helloMoney)
                VALUES ('".$employeeID."', '".$req_sss."', '".$req_pagIbig."', '".$req_philhealth."', '".$req_tin."', '".$req_nbi."', '".$req_medicalExam."', '".$req_2x2pic."', '".$req_vaccineCard."', '".$req_psa."', '".$req_validID."', '".$req_helloMoney."')";
            return $addRequirement;
        }

        public function updateEmployeeInfo($updateUserID, $updateLastName, $updateFirstName, $updateGender, $updateCivilStatus, $updateAddress, 
            $updateDateOfBirth, $updatePlaceOfBirth, $updateSSS, $updatePagIbig, $updatePhilhealth, $updateTIN, $updateEmailAddress, 
            $updateEmployeeID, $updateMobileNumber, $updateDepartmentID, $updateDesignationID, $updateShiftID, $updateBasicPay, $updateDailyRate, $updateHourlyRate, 
            $updateVacationLeaves, $updateSickLeaves) {
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
                shiftID = '$updateShiftID', 
                basicPay = '$updateBasicPay',
                dailyRate = '$updateDailyRate',
                hourlyRate = '$updateHourlyRate',
                availableVL = '$updateVacationLeaves',
                availableSL = '$updateSickLeaves'
                WHERE id = '$updateUserID'";
            return $updateEmployee;
        }

        public function updateEmployeeRequirements($empID, $updateSSS, $updatePagIbig, $updatePhilhealth, $updateTIN, $updateNBI, $updateMedicalExam, $update2x2pic, $updateVaccineCard, $updatePSA, $updateValidID, $updateHelloMoney) {
            $updateRequirement = "
                UPDATE ".$this->requirements." AS requirements SET
                req_sss = '$updateSSS',
                req_pagIbig = '$updatePagIbig',
                req_philhealth = '$updatePhilhealth',
                req_tin = '$updateTIN',
                req_nbi = '$updateNBI', 
                req_medicalExam = '$updateMedicalExam',
                req_2x2pic = '$update2x2pic',
                req_vaccineCard = '$updateVaccineCard',
                req_psa = '$updatePSA',
                req_validID = '$updateValidID',
                req_helloMoney = '$updateHelloMoney'
                WHERE empID = '$empID'";
            return $updateRequirement;
        }

        public function getEmployeeInfo($id) {
            $employeeInfo = "
                SELECT id, lastName, firstName, gender, civilStatus, address, dateOfBirth, 
                placeOfBirth, sss, pagIbig, philhealth, tin, emailAddress, employeeID, 
                mobileNumber, departmentName, position, basicPay, dailyRate, hourlyRate,
                availableVL, availableSL, req_sss, req_pagIbig, req_philhealth, req_tin, req_nbi,
                req_medicalExam, req_2x2pic, req_vaccineCard, req_psa, req_validID, req_helloMoney,
                DATE_FORMAT(shifts.startTime, '%h:%i %p') AS startTime, 
                DATE_FORMAT(shifts.endTime, '%h:%i %p') AS endTime
                FROM ".$this->employees." AS employees
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
                SELECT id, firstName, lastName, emailAddress, 
                mobileNumber, employeeID, 
                DATE_FORMAT(startTime, '%h:%i %p') AS startTime, 
                DATE_FORMAT(endTime, '%h:%i %p') AS endTime
                FROM ".$this->attendance." AS attendance
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
                SELECT requestID, employeeID,
                leaveType, remarks, status,
                CONCAT(firstName, ' ', lastName) AS employeeName,
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
                SELECT requestID, employeeID, remarks, status,
                CONCAT(firstName, ' ', lastName) AS employeeName,
                CONCAT(DATE_FORMAT(shift_1.startTime, '%h:%i %p'), ' - ', DATE_FORMAT(shift_1.endTime, '%h:%i %p')) AS currentShift,
                CONCAT(DATE_FORMAT(shift_2.startTime, '%h:%i %p'), ' - ', DATE_FORMAT(shift_2.endTime, '%h:%i %p')) AS requestedShift,
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

        public function getOTInfo($otID) {
            $request = "
                SELECT requestID, employeeID, remarks, status,
                actualOThours, actualOTmins, approvedOThours, approvedOTmins,
                CONCAT(firstName, ' ', lastName) AS employeeName,
                DATE_FORMAT(dateFiled, '%M %d, %Y') AS dateFiled, 
                DATE_FORMAT(otDate, '%M %d, %Y') AS otDate
                FROM ".$this->filedOT." AS filedOT
                INNER JOIN ".$this->employees." AS employees
                ON filedOT.empID = employees.id
                WHERE requestID = '$otID'";
            return $request;
        }

        public function viewAllLeaveType() {
            $leaveType = "SELECT * FROM ".$this->leaveType;
            return $leaveType;
        }

        public function fileOT($employeeID, $otDate, $actualOThours, $actualOTmins, $remarks, $status) {
            $fileOT = "
                INSERT INTO ".$this->filedOT." (empID, dateFiled, otDate, actualOThours, actualOTmins, remarks, status)
                VALUES ('$employeeID', CURRENT_TIMESTAMP, '$otDate', '$actualOThours', '$actualOTmins', '$remarks', '$status')";
            return $fileOT;
        }

        public function fileOT_null($employeeID, $otDate, $actualOThours, $actualOTmins, $remarks, $status) {
            $fileOT = "
                INSERT INTO ".$this->filedOT." (empID, dateFiled, otDate, actualOThours, actualOTmins, remarks, status)
                VALUES ('$employeeID', CURRENT_TIMESTAMP, '$otDate', '$actualOThours', NULL, '$remarks', '$status')";
            return $fileOT;
        }

        public function viewLastOT() {
            $request = "
                SELECT requestID
                FROM ".$this->filedOT."
                ORDER BY requestID DESC
                LIMIT 1";
            return $request;
        }

        public function fileLeave($employeeID, $leaveTypeID, $effectivityStartDate, $effectivityEndDate, $remarks, $status) {
            $fileLeave = "
                INSERT INTO ".$this->leaves." (empID, dateFiled, leaveTypeID, effectivityStartDate, effectivityEndDate, remarks, status)
                VALUES ('$employeeID', CURRENT_TIMESTAMP, '$leaveTypeID', '$effectivityStartDate', '$effectivityEndDate', '$remarks', '$status')";
            return $fileLeave;
        }

        public function viewLastLeave() {
            $request = "
                SELECT requestID
                FROM ".$this->leaves."
                ORDER BY requestID DESC
                LIMIT 1";
            return $request;
        }

        public function fileRequest($employeeID, $newshift, $effectivityStartDate, $effectivityEndDate, $remarks, $status) {
            $fileRequest = "
                INSERT INTO ".$this->changeShift." (empID, dateFiled, requestedShift, effectivityStartDate, effectivityEndDate, remarks, status)
                VALUES ('$employeeID', CURRENT_TIMESTAMP, '$newshift', '$effectivityStartDate', '$effectivityEndDate', '$remarks', '$status')";
            return $fileRequest;
        }

        public function viewLastRequest() {
            $request = "
                SELECT requestID
                FROM ".$this->changeShift."
                ORDER BY requestID DESC
                LIMIT 1";
            return $request;
        }

        public function viewAllowances() {
            $allowance = "SELECT * FROM ".$this->allowances;
            return $allowance;
        }

        public function getAllowanceInfo($allowanceID) {
            $allowance = "
                SELECT * FROM ".$this->allowances."
                WHERE allowanceID = '$allowanceID'";
            return $allowance;
        }

        public function addAllowance($allowanceName) {
            $addAllowance = "
                INSERT INTO ".$this->allowances." (allowanceName)
                VALUES ('$allowanceName')";
            return $addAllowance;
        }

        public function updateAllowance($allowanceID, $allowanceName) {
            $updateAllowance = "
                UPDATE ".$this->allowances."
                SET allowanceName = '$allowanceName'
                WHERE allowanceID = '$allowanceID'";
            return $updateAllowance;
        }

        public function deleteAllowance($allowanceID) {
            $deleteAllowance = "
                DELETE FROM ".$this->allowances."
                WHERE allowanceID = '$allowanceID'";
            return $deleteAllowance;
        }

        public function viewLastAllowance() {
            $allowance = "
                SELECT allowanceID
                FROM ".$this->allowances."
                ORDER BY allowanceID DESC
                LIMIT 1";
            return $allowance;
        }

        public function viewDeductions() {
            $deduction = "SELECT * FROM ".$this->deductions;
            return $deduction;
        }

        public function getDeductionInfo($deductionID) {
            $deduction = "
                SELECT * FROM ".$this->deductions."
                WHERE deductionID = '$deductionID'";
            return $deduction;
        }

        public function addDeduction($deductionName) {
            // $addDeduction = "
            //     INSERT INTO ".$this->deductions." (deductionName, deductionAmount)
            //     VALUES ('$deductionName', '$deductionAmount')";
            $addDeduction = "
                INSERT INTO ".$this->deductions." (deductionName)
                VALUES ('$deductionName')";
            return $addDeduction;
        }

        public function updateDeduction($deductionID, $deductionName) {
            // $updateDeduction = "
            //     UPDATE ".$this->deductions."
            //     SET deductionName = '$deductionName', 
            //     deductionAmount = '$deductionAmount'
            //     WHERE deductionID = '$deductionID'";
            $updateDeduction = "
                UPDATE ".$this->deductions."
                SET deductionName = '$deductionName'
                WHERE deductionID = '$deductionID'";
            return $updateDeduction;
        }

        public function deleteDeduction($deductionID) {
            $deleteDeduction = "
                DELETE FROM ".$this->deductions."
                WHERE deductionID = '$deductionID'";
            return $deleteDeduction;
        }

        public function viewLastDeduction() {
            $allowance = "
                SELECT deductionID
                FROM ".$this->deductions."
                ORDER BY deductionID DESC
                LIMIT 1";
            return $allowance;
        }

        public function viewEmployeeAttendance() {
            $employeeAttendance = "
                SELECT id, firstName, lastName, mobileNumber, employeeID, 
                emailAddress, availableVL, availableSL,
                DATE_FORMAT(startTime, '%h:%i %p') AS startTime, 
                DATE_FORMAT(endTime, '%h:%i %p') AS endTime 
                FROM ".$this->employees." AS employees
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                INNER JOIN ".$this->shifts." AS shifts
                ON employees.shiftID = shifts.shiftID";
            return $employeeAttendance;
        }
        
        public function viewEmployee($id) {
            $employee = "
                SELECT * FROM ".$this->employees."
                WHERE id = '$id'";
            return $employee;
        }
    }

?>