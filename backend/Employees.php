<?php

    class Employees extends Database
    {
        private $employees = 'tbl_employee';
        // private $users = 'tbl_users';
        private $department = 'tbl_department';
        // private $designation = 'tbl_designation';
        private $attendance = 'tbl_attendance';
        private $logtype = 'tbl_logtype';
        private $shift = 'tbl_shiftschedule';
        private $dbConnect = false;
        public function __construct() {
            $this->dbConnect = $this->dbConnect();
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
                SELECT * FROM ".$this->attendance." AS attendance INNER JOIN ".$this->employees." AS employees
                ON attendance.empID = employees.id
                INNER JOIN ".$this->logtype." AS logtype ON attendance.logTypeID = logtype.logTypeID INNER JOIN ".$this->shift." AS shift ON employees.shiftID = shift.shiftID
                WHERE empID='$id'";
            return $dtr;
        }

    }

?>