<?php

    class Employees extends Database
    {
        private $employees = 'tbl_employee';
        private $users = 'tbl_users';
        private $department = 'tbl_department';
        // private $designation = 'tbl_designation';
        private $attendance = 'tbl_attendance';
        private $logtype = 'tbl_logtype';
        private $shift = 'tbl_shiftschedule';
        private $changeShift = 'tbl_changeshiftrequests';
        private $leaves = 'tbl_leaveapplications';
        private $leaveType = 'tbl_leavetype';
        private $dbConnect = false;
        public function __construct() {
            $this->dbConnect = $this->dbConnect();
        }

        public function viewEmployees() {
            $team = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID";
            return $team;
        }

        public function viewTeam() {
            $team = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID";
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
                SELECT id, dateFiled, employeeName, effectivityStartDate, 
                effectivityEndDate, shift_1.time AS currentShift, 
                shift_2.time AS requestedShift,  remarks, status  
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
                SELECT id, dateFiled, employeeName, effectivityStartDate, 
                effectivityEndDate, shift_1.time AS currentShift, 
                shift_2.time AS requestedShift,  remarks, status  
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
                ON employees.id = users.employeeID
                WHERE users.status = 'Active' AND designationID = 1";
            return $allPersonnel;
        }

        public function viewInactivePersonnel() {
            $inactivePersonnel = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->users." AS users
                ON employees.id = users.employeeID
                WHERE users.status = 'Inactive'";
            return $inactivePersonnel;
        }

        public function viewTLQA() {
            $allTLQA = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->users." AS users
                ON employees.id = users.employeeID
                WHERE users.status = 'Active' AND designationID IN (2,3,4,5) ";
            return $allTLQA;
        }

        public function viewInactiveTLQA() {
            $allTLQA = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->users." AS users
                ON employees.id = users.employeeID
                WHERE users.status = 'Inactive' AND designationID IN (2,3,4,5) ";
            return $allTLQA;
        }

        public function viewFacilities() {
            $allHR = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->users." AS users
                ON employees.id = users.employeeID
                WHERE users.status = 'Active' AND designationID = 6";
            return $allHR;
        }

        public function viewInactiveFacilities() {
            $allHR = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->users." AS users
                ON employees.id = users.employeeID
                WHERE users.status = 'Inactive' AND designationID = 6";
            return $allHR;
        }

        public function viewHR() {
            $allHR = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->users." AS users
                ON employees.id = users.employeeID
                WHERE users.status = 'Active' AND designationID = 7";
            return $allHR;
        }

        public function viewInactiveHR() {
            $inactiveHR = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->users." AS users
                ON employees.id = users.employeeID
                WHERE users.status = 'Inactive' AND designationID = 7";
            return $inactiveHR;
        }

        public function viewFinance() {
            $allFinance = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->users." AS users
                ON employees.id = users.employeeID
                WHERE users.status = 'Active' AND designationID = 8";
            return $allFinance;
        }

        public function viewInactiveFinance() {
            $inactiveFinance = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->users." AS users
                ON employees.id = users.employeeID
                WHERE users.status = 'Inactive' AND designationID = 8";
            return $inactiveFinance;
        }

        public function viewIT() {
            $allAdmin = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->users." AS users
                ON employees.id = users.employeeID
                WHERE users.status = 'Active'";
            return $allAdmin;
        }

        public function viewInactiveIT() {
            $inactiveAdmin = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->users." AS users
                ON employees.id = users.employeeID
                WHERE users.status = 'Inactive'";
            return $inactiveAdmin;
        }
    }

?>