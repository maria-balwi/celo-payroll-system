<?php

    class Attendance extends Database
    {
        private $employees = 'tbl_employee';
        private $users = 'tbl_users';
        private $department = 'tbl_department';
        // private $designation = 'tbl_designation';
        private $attendance = 'tbl_attendance';
        private $logtype = 'tbl_logtype';
        private $shifts = 'tbl_shiftschedule';
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
            $undertimeEmployees = "
                SELECT * FROM ".$this->attendance."
                WHERE attendanceDate = CURRENT_DATE() AND
                logTypeID = 3";
            return $undertimeEmployees;
        }

        public function getPresentIT() {
            $presentIT = "
                SELECT * FROM ".$this->attendance." AS attendance
                INNER JOIN ".$this->employees." AS employees
                ON attendance.empID = employees.id
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                WHERE employees.departmentID = 4 AND
                attendanceDate = CURRENT_DATE() AND
                logTypeID IN (1, 2)";
            return $presentIT;
        }

        public function getAbsentIT() {
            $absentIT = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                WHERE employees.departmentID = 4 AND id NOT IN 
                (SELECT empID FROM ".$this->attendance."
                WHERE attendanceDate = CURRENT_DATE() AND
                logTypeID IN (1, 2))";
            return $absentIT;
        }

        public function getLateIT() {
            $lateIT = "
                SELECT * FROM ".$this->attendance." AS attendance
                INNER JOIN ".$this->employees." AS employees
                ON attendance.empID = employees.id
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                WHERE employees.departmentID = 4 AND
                attendanceDate = CURRENT_DATE() AND
                logTypeID = 2";
            return $lateIT;
        }

        public function getUndertimeIT() {
            $undertimeIT = "
                SELECT * FROM ".$this->attendance." AS attendance
                INNER JOIN ".$this->employees." AS employees
                ON attendance.empID = employees.id
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                WHERE employees.departmentID = 4 AND
                attendanceDate = CURRENT_DATE() AND
                logTypeID = 3";
            return $undertimeIT;
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

        public function getPendingITLeaves() {
            $pendingLeaves = "
                SELECT * FROM ".$this->leaves." AS leaves
                INNER JOIN ".$this->employees." AS employees
                ON leaves.empID = employees.id
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                WHERE employees.departmentID = 4 AND status = 'Pending'";
            return $pendingLeaves;
        }

        public function getPendingITChangeShift() {
            $pendingChangeShifts = "
                SELECT * FROM ".$this->changeShift." AS changeShift
                INNER JOIN ".$this->employees." AS employees
                ON changeShift.empID = employees.id
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                WHERE employees.departmentID = 4 AND status = 'Pending'";
            return $pendingChangeShifts;
        }

        public function viewITTeam() {
            $ITteam = "
                SELECT id, firstName, lastName, 
                DATE_FORMAT(startTime, '%h:%i %p') AS startTime, 
                DATE_FORMAT(endTime, '%h:%i %p') AS endTime,
                departmentName
                FROM ".$this->employees." AS employees
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                INNER JOIN ".$this->shifts." AS shifts
                ON employees.shiftID = shifts.shiftID
                WHERE employees.departmentID = 4";
            return $ITteam;
        }

        public function dailyAttendanceIT_timeIn($id) {
            $dailyAttendanceIT_timeIn = "
                SELECT DATE_FORMAT(attendanceTime, '%h:%i %p') AS attendanceTime 
                FROM ".$this->attendance."
                WHERE empID = $id AND
                attendanceDate = CURRENT_DATE() AND
                logTypeID IN (1, 2)";
            return $dailyAttendanceIT_timeIn;
        }

        public function dailyAttendanceIT_timeOut($id) {
            $dailyAttendanceIT_timeOut = "
                SELECT DATE_FORMAT(attendanceTime, '%h:%i %p') AS attendanceTime 
                FROM ".$this->attendance."
                WHERE empID = $id AND
                attendanceDate = CURRENT_DATE() AND
                logTypeID IN (3, 4)";
            return $dailyAttendanceIT_timeOut;
        }
    }

?>