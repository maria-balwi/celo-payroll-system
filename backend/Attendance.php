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
        private $weekOff = 'tbl_empweekoff';
        private $dbConnect = false;
        public function __construct() {
            $this->dbConnect = $this->dbConnect();
        }

        public function getPresentEmployees() {
            $presentEmployees = "
                SELECT * FROM ".$this->attendance." AS attendance
                INNER JOIN ".$this->employees." AS employees
                ON attendance.empID = employees.id
                WHERE attendanceDate = CURRENT_DATE() AND
                logTypeID IN (1, 2) AND employees.e_status = 'Active'";
            return $presentEmployees;
        }

        public function oldgetAbsentEmployees() {
            $absentEmployees = "
                SELECT * FROM ".$this->employees." 
                WHERE employees.id NOT IN
                (SELECT * FROM ".$this->attendance."
                WHERE attendanceDate = CURRENT_DATE() AND
                logTypeID IN (1, 2))";
            return $absentEmployees;
        }

        public function getAbsentEmployees() {
            $absentEmployees = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                INNER JOIN ".$this->shifts." AS shifts
                ON shifts.shiftID = employees.shiftID
                INNER JOIN ".$this->weekOff." AS weekoff
                ON weekoff.empID = employees.id
                WHERE employees.id NOT IN
                (SELECT empID FROM ".$this->attendance."
                WHERE attendanceDate = CURRENT_DATE() AND
                logTypeID IN (1, 2)) 
                AND shifts.startTime < CURRENT_TIME() 
                AND shifts.endTime > CURRENT_TIME()
                AND (
                    CASE DAYNAME(CURRENT_DATE())
                        WHEN 'Monday' THEN weekoff.wo_mon
                        WHEN 'Tuesday' THEN weekoff.wo_tue
                        WHEN 'Wednesday' THEN weekoff.wo_wed
                        WHEN 'Thursday' THEN weekoff.wo_thu
                        WHEN 'Friday' THEN weekoff.wo_fri
                        WHEN 'Saturday' THEN weekoff.wo_sat
                        WHEN 'Sunday' THEN weekoff.wo_sun
                    END
                ) = 0
                AND designationID != 12
                AND employees.e_status = 'Active'";
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
                logTypeID IN (1, 2)
                AND employees.e_status = 'Active'";
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
                logTypeID IN (1, 2)
                AND employees.e_status = 'Active'";
            return $presentOperations;
        }

        public function getAbsentIT() {
            $absentIT = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                INNER JOIN ".$this->shifts." AS shifts
                ON shifts.shiftID = employees.shiftID
                INNER JOIN ".$this->weekOff." AS weekoff
                ON weekoff.empID = employees.id
                WHERE employees.departmentID = 4 
                AND employees.id NOT IN 
                (SELECT empID FROM ".$this->attendance."
                WHERE attendanceDate = CURRENT_DATE() AND
                logTypeID IN (1, 2))
                AND shifts.startTime < CURRENT_TIME() 
                AND shifts.endTime > CURRENT_TIME()
                AND (
                    CASE DAYNAME(CURRENT_DATE())
                        WHEN 'Monday' THEN weekoff.wo_mon
                        WHEN 'Tuesday' THEN weekoff.wo_tue
                        WHEN 'Wednesday' THEN weekoff.wo_wed
                        WHEN 'Thursday' THEN weekoff.wo_thu
                        WHEN 'Friday' THEN weekoff.wo_fri
                        WHEN 'Saturday' THEN weekoff.wo_sat
                        WHEN 'Sunday' THEN weekoff.wo_sun
                    END
                ) = 0
                AND employees.e_status = 'Active'";
            return $absentIT;
        }

        public function getAbsentOperations() {
            $absentOperations = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                INNER JOIN ".$this->shifts." AS shifts
                ON shifts.shiftID = employees.shiftID
                INNER JOIN ".$this->weekOff." AS weekoff
                ON weekoff.empID = employees.id
                WHERE employees.departmentID = 1 
                AND employees.id NOT IN 
                (SELECT empID FROM ".$this->attendance."
                WHERE attendanceDate = CURRENT_DATE() AND
                logTypeID IN (1, 2))
                AND shifts.startTime < CURRENT_TIME() 
                AND shifts.endTime > CURRENT_TIME()
                AND (
                    CASE DAYNAME(CURRENT_DATE())
                        WHEN 'Monday' THEN weekoff.wo_mon
                        WHEN 'Tuesday' THEN weekoff.wo_tue
                        WHEN 'Wednesday' THEN weekoff.wo_wed
                        WHEN 'Thursday' THEN weekoff.wo_thu
                        WHEN 'Friday' THEN weekoff.wo_fri
                        WHEN 'Saturday' THEN weekoff.wo_sat
                        WHEN 'Sunday' THEN weekoff.wo_sun
                    END
                ) = 0
                AND employees.e_status = 'Active'";
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
                logTypeID = 2
                AND employees.e_status = 'Active'";
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
                logTypeID = 2
                AND employees.e_status = 'Active'";
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
                logTypeID = 3
                AND employees.e_status = 'Active'";
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
                logTypeID = 3
                AND employees.e_status = 'Active'";
            return $undertimeOperations;
        }

        public function getAllPendingLeaves() {
            $pendingLeaves = "
                SELECT * FROM ".$this->leaves."
                WHERE status = 'Pending'";
            return $pendingLeaves;
        }

        public function getDirectorPendingLeaves() {
            $pendingLeaves = "
                SELECT * FROM ".$this->leaves." AS leaves
                INNER JOIN ".$this->employees." AS employees
                ON leaves.empID = employees.id
                WHERE leaves.status = 'Pending' AND employees.designationID IN (5,8,9)";
            return $pendingLeaves;
        }

        public function getAdminPendingLeaves() {
            $pendingLeaves = "
                SELECT * FROM ".$this->leaves." AS leaves
                INNER JOIN ".$this->employees." AS employees
                ON leaves.empID = employees.id
                WHERE leaves.status = 'Pending' AND employees.designationID NOT IN (8,9)";
            return $pendingLeaves;
        }

        public function getAllPendingChangeShift() {
            $pendingChangeShifts = "
                SELECT * FROM ".$this->changeShift." AS changeShift
                INNER JOIN ".$this->employees." AS employees
                ON changeShift.empID = employees.id
                WHERE changeShift.status = 'Pending'";
            return $pendingChangeShifts;
        }

        public function getDirectorPendingChangeShift() {
            $pendingChangeShifts = "
                SELECT * FROM ".$this->changeShift." AS changeShift
                INNER JOIN ".$this->employees." AS employees
                ON changeShift.empID = employees.id
                WHERE changeShift.status = 'Pending' AND employees.designationID IN (5,8,9)";
            return $pendingChangeShifts;
        }

        public function getAdminPendingChangeShift() {
            $pendingChangeShifts = "
                SELECT * FROM ".$this->changeShift." AS changeShift
                INNER JOIN ".$this->employees." AS employees
                ON changeShift.empID = employees.id
                WHERE changeShift.status = 'Pending' AND employees.designationID NOT IN (8,9)";
            return $pendingChangeShifts;
        }

        public function getAllPendingOvertimes() {
            $pendingChangeShifts = "
                SELECT * FROM ".$this->filedOT." AS filedOT
                INNER JOIN ".$this->employees." AS employees
                ON filedOT.empID = employees.id
                WHERE filedOT.status IS NULL";
            return $pendingChangeShifts;
        }

        public function getDirectorPendingOvertimes() {
            $pendingChangeShifts = "
                SELECT * FROM ".$this->filedOT." AS filedOT
                INNER JOIN ".$this->employees." AS employees
                ON filedOT.empID = employees.id
                WHERE filedOT.status IS NULL AND employees.designationID IN (5,8,9)";
            return $pendingChangeShifts;
        }

        public function getAdminPendingOvertimes() {
            $pendingChangeShifts = "
                SELECT * FROM ".$this->filedOT." AS filedOT
                INNER JOIN ".$this->employees." AS employees
                ON filedOT.empID = employees.id
                WHERE filedOT.status IS NULL AND employees.designationID NOT IN (8,9)";
            return $pendingChangeShifts;
        }

        public function getPendingITLeaves() {
            $pendingLeaves = "
                SELECT * FROM ".$this->leaves." AS leaves
                INNER JOIN ".$this->employees." AS employees
                ON leaves.empID = employees.id
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                WHERE employees.designationID = 10 AND status = 'Pending'";
            return $pendingLeaves;
        }

        public function getPendingOperationsLeavesTL() {
            $pendingLeaves = "
                SELECT * FROM ".$this->leaves." AS leaves
                INNER JOIN ".$this->employees." AS employees
                ON leaves.empID = employees.id
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                WHERE employees.designationID IN (1,2,3) AND status = 'Pending'";
            return $pendingLeaves;
        }

        public function getPendingOperationsLeavesManager() {
            $pendingLeaves = "
                SELECT * FROM ".$this->leaves." AS leaves
                INNER JOIN ".$this->employees." AS employees
                ON leaves.empID = employees.id
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                WHERE employees.designationID IN (4,11) AND status = 'Pending'";
            return $pendingLeaves;
        }

        public function getPendingITChangeShift() {
            $pendingChangeShifts = "
                SELECT * FROM ".$this->changeShift." AS changeShift
                INNER JOIN ".$this->employees." AS employees
                ON changeShift.empID = employees.id
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                WHERE employees.designationID = 10 AND status = 'Pending'";
            return $pendingChangeShifts;
        }

        public function getPendingOperationsChangeShiftTL() {
            $pendingChangeShifts = "
                SELECT * FROM ".$this->changeShift." AS changeShift
                INNER JOIN ".$this->employees." AS employees
                ON changeShift.empID = employees.id
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                WHERE employees.designationID IN (1,2,3) AND status = 'Pending'";
            return $pendingChangeShifts;
        }

        public function getPendingOperationsChangeShiftManager() {
            $pendingChangeShifts = "
                SELECT * FROM ".$this->changeShift." AS changeShift
                INNER JOIN ".$this->employees." AS employees
                ON changeShift.empID = employees.id
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                WHERE employees.designationID IN (4,11) AND status = 'Pending'";
            return $pendingChangeShifts;
        }

        public function getPendingITOvertime() {
            $pendingOvertimes = "
                SELECT * FROM ".$this->filedOT." AS filedOT
                INNER JOIN ".$this->employees." AS employees
                ON filedOT.empID = employees.id
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                WHERE employees.designationID = 10 AND status IS NULL";
            return $pendingOvertimes;
        }

        public function getPendingOperationsOvertimeTL() {
            $pendingOvertimes = "
                SELECT * FROM ".$this->filedOT." AS filedOT
                INNER JOIN ".$this->employees." AS employees
                ON filedOT.empID = employees.id
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                WHERE employees.designationID IN (1,2,3) AND status IS NULL";
            return $pendingOvertimes;
        }

        public function getPendingOperationsOvertimeManager() {
            $pendingOvertimes = "
                SELECT * FROM ".$this->filedOT." AS filedOT
                INNER JOIN ".$this->employees." AS employees
                ON filedOT.empID = employees.id
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                WHERE employees.designationID IN (4,11) AND status IS NULL";
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
                WHERE employees.departmentID = 4
                AND employees.e_status = 'Active'";
            return $ITteam;
        }

        public function viewOperationsTeamManager() {
            $ManagerTeam = "
                SELECT id, firstName, lastName, employeeID, availableVL, availableSL,
                DATE_FORMAT(startTime, '%h:%i %p') AS startTime, 
                DATE_FORMAT(endTime, '%h:%i %p') AS endTime,
                departmentName
                FROM ".$this->employees." AS employees
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                INNER JOIN ".$this->shifts." AS shifts
                ON employees.shiftID = shifts.shiftID
                WHERE employees.departmentID = 1 AND designationID != 5
                ORDER BY employeeID ASC";
            return $ManagerTeam;
        } 

        public function viewOperationsTeamTL() {
            $TLTeam = "
                SELECT id, firstName, lastName, employeeID, availableVL, availableSL,
                DATE_FORMAT(startTime, '%h:%i %p') AS startTime, 
                DATE_FORMAT(endTime, '%h:%i %p') AS endTime,
                departmentName
                FROM ".$this->employees." AS employees
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                INNER JOIN ".$this->shifts." AS shifts
                ON employees.shiftID = shifts.shiftID
                WHERE employees.departmentID = 1 AND designationID IN (1,2,3)
                ORDER BY employeeID ASC";
            return $TLTeam;
        }

        public function getShiftDetails($id) {
            $dailyAttendanceIT_timeIn = "
                SELECT 
                    s.startTime,
                    s.endTime,
                    CASE DAYNAME(CURRENT_DATE())
                        WHEN 'Monday' THEN w.wo_mon
                        WHEN 'Tuesday' THEN w.wo_tue
                        WHEN 'Wednesday' THEN w.wo_wed
                        WHEN 'Thursday' THEN w.wo_thu
                        WHEN 'Friday' THEN w.wo_fri
                        WHEN 'Saturday' THEN w.wo_sat
                        WHEN 'Sunday' THEN w.wo_sun
                    END AS isWeekOff
                FROM " . $this->employees . " AS e
                LEFT JOIN " . $this->shifts . " AS s ON s.shiftID = e.shiftID
                LEFT JOIN " . $this->weekOff . " AS w ON w.empID = e.id
                WHERE e.id = $id";
            return $dailyAttendanceIT_timeIn;
        }

        public function dailyAttendance_timeIn($id) {
            $getAttendanceToday = "
                SELECT attendanceTime
                FROM " . $this->attendance . " AS attendance
                WHERE empID = $id
                AND attendanceDate = CURRENT_DATE()
                AND logTypeID IN (1, 2)";
            return $getAttendanceToday;
        }

        public function dailyAttendance_timeOut($id) {
            $dailyAttendanceIT_timeOut = "
                SELECT attendanceTime
                FROM " . $this->attendance . " AS attendance
                WHERE empID = $id
                AND attendanceDate = CURRENT_DATE()
                AND logTypeID IN (3, 4)";
            return $dailyAttendanceIT_timeOut;
        }

        public function getMonthlyAttendance($id, $year, $month) {
            $monthlyAttendance = "
                SELECT * FROM ".$this->attendance."
                WHERE empID = $id AND
                logTypeID IN (1, 2) AND
                YEAR(attendanceDate) = '$year'
                AND MONTH(attendanceDate) = '$month'";
            return $monthlyAttendance;
        }

        public function getMonthlyUndertimes($id, $year, $month) {
            $monthlyUndertimes = "
                SELECT * FROM ".$this->attendance."
                WHERE empID = $id AND
                logTypeID = 3 AND
                YEAR(attendanceDate) = '$year'
                AND MONTH(attendanceDate) = '$month'";
            return $monthlyUndertimes;
        }

        public function getMonthlyLates($id, $year, $month) {
            $monthlyLates = "
                SELECT * FROM ".$this->attendance."
                WHERE empID = $id AND
                logTypeID = 2 AND
                YEAR(attendanceDate) = '$year'
                AND MONTH(attendanceDate) = '$month'";
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

        public function getWorkingDaysInMonth($year, $month) {
            $start_date = date("$year-$month-01");
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