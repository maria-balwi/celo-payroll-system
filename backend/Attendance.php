<?php

    class Attendance extends Database
    {
        private $employees = 'tbl_employee';
        private $users = 'tbl_users';
        private $department = 'tbl_department';
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
                SELECT id, firstName, lastName, employeeID, availableVL, availableSL,
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

        public function getMonthlyAttendance($id) {
            $monthlyAttendance = "
                SELECT * FROM ".$this->attendance."
                WHERE empID = $id AND
                logTypeID IN (1, 2) AND
                YEAR(attendanceDate) = YEAR(CURRENT_DATE())
                AND MONTH(attendanceDate) = MONTH(CURRENT_DATE())";
            return $monthlyAttendance;
        }

        public function getMonthlyUndertimes($id) {
            $monthlyUndertimes = "
                SELECT * FROM ".$this->attendance."
                WHERE empID = $id AND
                logTypeID = 3 AND
                YEAR(attendanceDate) = YEAR(CURRENT_DATE())
                AND MONTH(attendanceDate) = MONTH(CURRENT_DATE())";
            return $monthlyUndertimes;
        }

        public function getMonthlyLates($id) {
            $monthlyLates = "
                SELECT * FROM ".$this->attendance."
                WHERE empID = $id AND
                logTypeID = 2 AND
                YEAR(attendanceDate) = YEAR(CURRENT_DATE())
                AND MONTH(attendanceDate) = MONTH(CURRENT_DATE())";
            return $monthlyLates;
        }

        public function getTeamMemberInfo($id) {
            $employeeInfo = "
                SELECT id, lastName, firstName, gender, civilStatus, address, dateOfBirth, 
                placeOfBirth, sss, pagIbig, philhealth, tin, emailAddress, employeeID, 
                mobileNumber, departmentName, basicPay, dailyRate, hourlyRate,
                DATE_FORMAT(shifts.startTime, '%h:%i %p') AS startTime, 
                DATE_FORMAT(shifts.endTime, '%h:%i %p') AS endTime
                FROM ".$this->employees." AS employees
                INNER JOIN ".$this->shifts." AS shifts
                ON shifts.shiftID = employees.shiftID
                INNER JOIN ".$this->department." AS department
                ON department.departmentID = employees.departmentID
                WHERE id = '$id'";
            return $employeeInfo;
        }

        public function checkDTR($id) {
            $checkDTR = "
                SELECT 
                    id, 
                    attendanceDate,
                    DATE_FORMAT(attendanceTime, '%h:%i %p') AS attendanceTime
                FROM 
                    (SELECT 
                        CURDATE() - INTERVAL (DAY(CURDATE()) - 1) DAY + INTERVAL seq.day DAY AS date
                    FROM 
                        (SELECT 0 AS day UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
                        CROSS JOIN (SELECT 0 AS day UNION ALL SELECT 10 UNION ALL SELECT 20 UNION ALL SELECT 30) AS b
                        CROSS JOIN (SELECT 0 AS day UNION ALL SELECT 100) AS c
                        CROSS JOIN (SELECT 0 AS day UNION ALL SELECT 200) AS d
                        CROSS JOIN (SELECT 0 AS day UNION ALL SELECT 400) AS e
                        CROSS JOIN (SELECT 0 AS day UNION ALL SELECT 800) AS f
                        CROSS JOIN (
                            SELECT 
                                (a.day + b.day + c.day + d.day + e.day + f.day) AS day
                            FROM 
                                (SELECT 0 AS day UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
                                CROSS JOIN (SELECT 0 AS day UNION ALL SELECT 10 UNION ALL SELECT 20 UNION ALL SELECT 30) AS b
                        ) AS seq
                    WHERE 
                        CURDATE() - INTERVAL (DAY(CURDATE()) - 1) DAY + INTERVAL seq.day DAY <= LAST_DAY(CURDATE())
                    ) d
                CROSS JOIN 
                    (SELECT DISTINCT id FROM ".$this->employees." WHERE id = $id) e
                LEFT JOIN 
                    ".$this->attendance." a ON a.empID = e.id AND a.date = d.date
                ORDER BY 
                    e.id, d.date";
            return $checkDTR;
        }
    }

?>