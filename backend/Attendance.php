<?php

    class Attendance extends Database
    {
        private $employees = 'tbl_employee';
        private $users = 'tbl_users';
        // private $department = 'tbl_department';
        // private $designation = 'tbl_designation';
        private $attendance = 'tbl_attendance';
        private $logtype = 'tbl_logtype';
        private $shift = 'tbl_shiftschedule';
        private $changeShift = 'tbl_changeshiftrequests';
        private $leaves = 'tbl_leaveapplications';
        private $dbConnect = false;
        public function __construct() {
            $this->dbConnect = $this->dbConnect();
        }

        public function getPresentEmployees() {
            $presentEmployees = "
                SELECT * FROM ".$this->attendance."
                WHERE attendanceDate = CURRENT_DATE() AND
                logTypeID IN (1, 2)";
            return $presentEmployees;
        }

        public function getAbsentEmployees() {
            $absentEmployees = "
                SELECT * FROM ".$this->employees."
                WHERE id NOT IN
                (SELECT empID FROM ".$this->attendance."
                WHERE attendanceDate = CURRENT_DATE() AND
                logTypeID IN (1, 2))";
            return $absentEmployees;
        }

        public function getLateEmployees() {
            $lateEmployees = "
                SELECT * FROM ".$this->attendance."
                WHERE attendanceDate = CURRENT_DATE() AND
                logTypeID = 2";
            return $lateEmployees;
        }

        public function getUndertimeEmployees() {
            $lateEmployees = "
                SELECT * FROM ".$this->attendance."
                WHERE attendanceDate = CURRENT_DATE() AND
                logTypeID = 3";
            return $lateEmployees;
        }

        public function getPendingLeaves() {
            $pendingLeaves = "
                SELECT * FROM ".$this->leaves."
                WHERE status = 'Pending'";
            return $pendingLeaves;
        }

        public function getPendingChangeShift() {
            $pendingChangeShifts = "
                SELECT * FROM ".$this->changeShift."
                WHERE status = 'Pending'";
            return $pendingChangeShifts;
        }
    }

?>