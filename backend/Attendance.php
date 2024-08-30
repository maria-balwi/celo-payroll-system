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
        private $filedOT = 'tbl_filedot';
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

        public function getPresentOperations() {
            $presentOperations = "
                SELECT * FROM ".$this->attendance." AS attendance
                INNER JOIN ".$this->employees." AS employees
                ON attendance.empID = employees.id
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                WHERE employees.departmentID = 1 AND
                attendanceDate = CURRENT_DATE() AND
                logTypeID IN (1, 2)";
            return $presentOperations;
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

        public function getAbsentOperations() {
            $absentOperations = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                WHERE employees.departmentID = 1 AND id NOT IN 
                (SELECT empID FROM ".$this->attendance."
                WHERE attendanceDate = CURRENT_DATE() AND
                logTypeID IN (1, 2))";
            return $absentOperations;
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

        public function getLateOperations() {
            $lateOperations = "
                SELECT * FROM ".$this->attendance." AS attendance
                INNER JOIN ".$this->employees." AS employees
                ON attendance.empID = employees.id
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                WHERE employees.departmentID = 1 AND
                attendanceDate = CURRENT_DATE() AND
                logTypeID = 2";
            return $lateOperations;
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

        public function getUndertimeOperations() {
            $undertimeOperations = "
                SELECT * FROM ".$this->attendance." AS attendance
                INNER JOIN ".$this->employees." AS employees
                ON attendance.empID = employees.id
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                WHERE employees.departmentID = 1 AND
                attendanceDate = CURRENT_DATE() AND
                logTypeID = 3";
            return $undertimeOperations;
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

        public function getPendingOvertimes() {
            $pendingChangeShifts = "
                SELECT * FROM ".$this->filedOT."
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

        public function getPendingOperationsLeaves() {
            $pendingLeaves = "
                SELECT * FROM ".$this->leaves." AS leaves
                INNER JOIN ".$this->employees." AS employees
                ON leaves.empID = employees.id
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                WHERE employees.departmentID = 1 AND status = 'Pending'";
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

        public function getPendingOperationsChangeShift() {
            $pendingChangeShifts = "
                SELECT * FROM ".$this->changeShift." AS changeShift
                INNER JOIN ".$this->employees." AS employees
                ON changeShift.empID = employees.id
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                WHERE employees.departmentID = 1 AND status = 'Pending'";
            return $pendingChangeShifts;
        }

        public function getPendingITOvertime() {
            $pendingOvertimes = "
                SELECT * FROM ".$this->filedOT." AS filedOT
                INNER JOIN ".$this->employees." AS employees
                ON filedOT.empID = employees.id
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                WHERE employees.departmentID = 4 AND status = 'Pending'";
            return $pendingOvertimes;
        }

        public function getPendingOperationsOvertime() {
            $pendingOvertimes = "
                SELECT * FROM ".$this->filedOT." AS filedOT
                INNER JOIN ".$this->employees." AS employees
                ON filedOT.empID = employees.id
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                WHERE employees.departmentID = 1 AND status = 'Pending'";
            return $pendingOvertimes;
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

        public function viewITTeams($yearMonth) {
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
                INNER JOIN ".$this->attendance." AS attendance
                ON employees.id = attendance.empID
                WHERE employees.departmentID = 4 AND 
                DATE_FORMAT(attendanceDate, '%Y-%m') = '2024-07'
                GROUP BY id";
            return $ITteam;
        }

        public function viewOperationsTeam() {
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
                INNER JOIN ".$this->attendance." AS attendance
                ON employees.id = attendance.empID
                WHERE employees.departmentID = 1 AND 
                DATE_FORMAT(attendanceDate, '%Y-%m') = '2024-08'";
            return $ITteam;
        }

        public function dailyAttendance_timeIn($id) {
            $dailyAttendanceIT_timeIn = "
                SELECT DATE_FORMAT(attendanceTime, '%h:%i %p') AS attendanceTime 
                FROM ".$this->attendance."
                WHERE empID = $id AND
                attendanceDate = CURRENT_DATE() AND
                logTypeID IN (1, 2)";
            return $dailyAttendanceIT_timeIn;
        }

        public function dailyAttendance_timeOut($id) {
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

        public function getEmployeeInfo($id) {
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
                    attendanceDate,
                    attendanceTime
                FROM 
                    (SELECT 
                        CURDATE() - INTERVAL (DAY(CURDATE()) - 1) DAY + INTERVAL seq.seq DAY AS date
                    FROM 
                        (SELECT 0 AS seq UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9
                        UNION ALL SELECT 10 UNION ALL SELECT 11 UNION ALL SELECT 12 UNION ALL SELECT 13 UNION ALL SELECT 14 UNION ALL SELECT 15 UNION ALL SELECT 16 UNION ALL SELECT 17 UNION ALL SELECT 18 UNION ALL SELECT 19
                        UNION ALL SELECT 20 UNION ALL SELECT 21 UNION ALL SELECT 22 UNION ALL SELECT 23 UNION ALL SELECT 24 UNION ALL SELECT 25 UNION ALL SELECT 26 UNION ALL SELECT 27 UNION ALL SELECT 28 UNION ALL SELECT 29
                        UNION ALL SELECT 30 UNION ALL SELECT 31) AS seq
                    WHERE 
                        CURDATE() - INTERVAL (DAY(CURDATE()) - 1) DAY + INTERVAL seq.seq DAY <= LAST_DAY(CURDATE())
                    ) d
                CROSS JOIN 
                    (SELECT DISTINCT empID FROM ".$this->attendance." WHERE empID = $id) attendance
                LEFT JOIN 
                    ".$this->attendance." a ON a.empID = e.empID AND a.attendanceDate = d.date
                ORDER BY 
                    e.empID, d.date";
            return $checkDTR;
        }

        public function getWorkingDaysInMonth($yearMonth) {
            $start_date = date("$yearMonth-01");
            $end_date = date("Y-m-t", strtotime($start_date)); // last day of the month
            
            $work_days = 0;
            $day_counter = $start_date;
            
            while (strtotime($day_counter) <= strtotime($end_date)) {
                if (date('N', strtotime($day_counter)) < 6) { // 1 (for Monday) through 5 (for Friday)
                    $work_days++;
                }
                $day_counter = date("Y-m-d", strtotime($day_counter . ' +1 day'));
            }
            
            return $work_days;
        }

        public function getITAttendance($id, $date) {
            $attendance = "
                SELECT * FROM ".$this->attendance." 
                WHERE empID = $id AND 
                DATE_FORMAT(attendanceDate, '%Y-%m') = '$date'";
            return $attendance;
        }
    }

?>