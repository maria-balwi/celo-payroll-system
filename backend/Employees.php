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
        private $weekOff = 'tbl_empWeekOff';
        private $allowances = 'tbl_allowances';
        private $deductions = 'tbl_deductions';
        private $auditTrail = 'tbl_audittrail';
        private $dbConnect = false;
        public function __construct() {
            $this->dbConnect = $this->dbConnect();
        }

        public function viewActiveEmployees() {
            $team = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                INNER JOIN ".$this->shifts." AS shifts
                ON employees.shiftID = shifts.shiftID
                WHERE designationID != 12 AND 
                employees.e_status = 'Active'";
            return $team;
        }

        public function viewAllEmployees() {
            $team = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                INNER JOIN ".$this->shifts." AS shifts
                ON employees.shiftID = shifts.shiftID
                WHERE designationID != 12 AND 
                employees.e_status = 'Active'
                ORDER BY employees.lastName ASC";
            return $team;
        }

        public function viewAllOperations() {
            $team = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                INNER JOIN ".$this->shifts." AS shifts
                ON employees.shiftID = shifts.shiftID
                WHERE designationID != 12 AND 
                department.departmentID = 1 AND
                employees.e_status = 'Active'
                ORDER BY employees.lastName ASC";
            return $team;
        }

        public function viewAllIT() {
            $team = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                INNER JOIN ".$this->shifts." AS shifts
                ON employees.shiftID = shifts.shiftID
                WHERE designationID != 12 AND 
                department.departmentID = 4 AND
                employees.e_status = 'Active'
                ORDER BY employees.lastName ASC";
            return $team;
        }
        
        public function viewResignedEmployees() {
            $team = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                INNER JOIN ".$this->shifts." AS shifts
                ON employees.shiftID = shifts.shiftID
                WHERE designationID != 12 AND
                employees.e_status = 'Inactive'";
            return $team;
        }

        public function recentlyAddedEmployees() {
            $team = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                INNER JOIN ".$this->shifts." AS shifts
                ON employees.shiftID = shifts.shiftID
                WHERE designationID != 12
                ORDER BY employees.id DESC
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

        public function viewTeamIT() {
            $team = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                WHERE employees.departmentID = 4
                AND employees.e_status = 'Active'";
            return $team;
        }

        public function viewTeamOperations() {
            $team = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID
                WHERE employees.departmentID = 1
                AND employees.e_status = 'Active'";
            return $team;
        }

        // OLD CODE
        // public function viewDTR($id, $yearMonth) {
        //     $dtr = "
        //         SELECT 
        //             DATE_FORMAT(all_dates.attendanceDate, '%m/%d/%Y') AS attendanceDate,
        //             DATE_FORMAT(all_dates.attendanceDate, '%Y.%m.%d') AS filterDate,
        //             DATE_FORMAT(all_dates.attendanceDate, '%a') AS dayOfWeek,
        //             CONCAT(DATE_FORMAT(shift.startTime, '%h:%i %p'), ' - ', DATE_FORMAT(shift.endTime, '%h:%i %p')) AS shift,
        //             COALESCE(id, '-') AS id, 
        //             COALESCE(attendance.logTypeID, '-') AS logTypeID, 
        //             COALESCE(logtype.logType, '-') AS logType, 
        //             COALESCE(attendance.lateMins, '-') AS lateMins, 
        //             COALESCE(attendance.undertimeMins, '-') AS undertimeMins, 
        //             COALESCE(DATE_FORMAT(attendance.attendanceTime, '%h:%i %p'), '-') AS attendanceTime
        //         FROM 
        //             (
        //                 SELECT DATE('$yearMonth-01') + INTERVAL (a.a + (10 * b.a)) DAY AS attendanceDate
        //                 FROM (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
        //                 CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2) AS b
        //                 LIMIT 31
        //             ) AS all_dates
        //         LEFT JOIN 
        //             ".$this->employees." AS employees ON employees.id = '$id'
        //         LEFT JOIN 
        //             ".$this->shift." AS shift ON employees.shiftID = shift.shiftID
        //         LEFT JOIN 
        //             ".$this->attendance." AS attendance 
        //         ON all_dates.attendanceDate = attendance.attendanceDate AND attendance.empID = '$id'
                
        //         LEFT JOIN 
        //             ".$this->logtype." AS logtype ON attendance.logTypeID = logtype.logTypeID 
        //         ORDER BY 
        //             all_dates.attendanceDate, attendance.attendanceTime
        //         ";
        //     return $dtr;
        // }

        // NEW CODE - currently working
        // public function viewDTR($id, $yearMonth) {
        //     $dtr = "
        //         SELECT 
        //             DATE_FORMAT(all_dates.attendanceDate, '%m/%d/%Y') AS attendanceDate,
        //             DATE_FORMAT(all_dates.attendanceDate, '%Y.%m.%d') AS filterDate,
        //             DATE_FORMAT(all_dates.attendanceDate, '%a') AS dayOfWeek,
        //             CONCAT(DATE_FORMAT(shift.startTime, '%h:%i %p'), ' - ', DATE_FORMAT(shift.endTime, '%h:%i %p')) AS shift,
        //             COALESCE(id, '-') AS id, 
        //             COALESCE(attendance.logTypeID, '-') AS logTypeID, 
        //             COALESCE(logtype.logType, '-') AS logType, 
        //             COALESCE(attendance.lateMins, '-') AS lateMins, 
        //             COALESCE(attendance.undertimeMins, '-') AS undertimeMins, 
        //             COALESCE(DATE_FORMAT(attendance.attendanceTime, '%h:%i %p'), '-') AS attendanceTime
        //         FROM 
        //             (
        //                 SELECT DATE('$yearMonth-01') + INTERVAL (a.a + (10 * b.a)) DAY AS attendanceDate
        //                 FROM 
        //                     (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL 
        //                             SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL 
        //                             SELECT 8 UNION ALL SELECT 9) AS a
        //                 CROSS JOIN 
        //                     (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3) AS b
        //                 WHERE 
        //                     DATE('$yearMonth-01') + INTERVAL (a.a + (10 * b.a)) DAY 
        //                     <= LAST_DAY('$yearMonth-01')
        //             ) AS all_dates
        //         LEFT JOIN 
        //             ".$this->employees." AS employees ON employees.id = '$id'
        //         LEFT JOIN 
        //             ".$this->shift." AS shift ON employees.shiftID = shift.shiftID
        //         LEFT JOIN 
        //             ".$this->attendance." AS attendance 
        //         ON all_dates.attendanceDate = attendance.attendanceDate AND attendance.empID = '$id'
                
        //         LEFT JOIN 
        //             ".$this->logtype." AS logtype ON attendance.logTypeID = logtype.logTypeID 
        //         ORDER BY 
        //             all_dates.attendanceDate, attendance.attendanceTime
        //         ";
        //     return $dtr;
        // }

        // TESTING NEW CODE
        public function viewDTR($id, $yearMonth) {
            $dtr = "
                SELECT 
                    DATE_FORMAT(all_dates.attendanceDate, '%m/%d/%Y') AS attendanceDate,
                    DATE_FORMAT(all_dates.attendanceDate, '%Y.%m.%d') AS filterDate,
                    DATE_FORMAT(all_dates.attendanceDate, '%a') AS dayOfWeek,
                    CONCAT(DATE_FORMAT(shift.startTime, '%h:%i %p'), ' - ', DATE_FORMAT(shift.endTime, '%h:%i %p')) AS shift,
                    COALESCE(id, '-') AS id, 
                    COALESCE(attendance.logTypeID, '-') AS logTypeID, 
                    COALESCE(logtype.logType, '-') AS logType, 
                    COALESCE(attendance.lateMins, '-') AS lateMins, 
                    COALESCE(attendance.undertimeMins, '-') AS undertimeMins, 
                    COALESCE(DATE_FORMAT(attendance.attendanceTime, '%h:%i %p'), '-') AS attendanceTime,
                    weekoff.wo_mon,
                    weekoff.wo_tue,
                    weekoff.wo_wed,
                    weekoff.wo_thu,
                    weekoff.wo_fri,
                    weekoff.wo_sat,
                    weekoff.wo_sun
                FROM 
                    (
                        SELECT DATE('$yearMonth-01') + INTERVAL (a.a + (10 * b.a)) DAY AS attendanceDate
                        FROM 
                            (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL 
                                    SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL 
                                    SELECT 8 UNION ALL SELECT 9) AS a
                        CROSS JOIN 
                            (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3) AS b
                        WHERE 
                            DATE('$yearMonth-01') + INTERVAL (a.a + (10 * b.a)) DAY 
                            <= LAST_DAY('$yearMonth-01')
                    ) AS all_dates
                LEFT JOIN 
                    {$this->employees} AS employees ON employees.id = '$id'
                LEFT JOIN 
                    {$this->shift} AS shift ON employees.shiftID = shift.shiftID
                LEFT JOIN 
                    {$this->attendance} AS attendance 
                    ON all_dates.attendanceDate = attendance.attendanceDate 
                    AND attendance.empID = '$id'
                LEFT JOIN 
                    {$this->logtype} AS logtype ON attendance.logTypeID = logtype.logTypeID 
                LEFT JOIN 
                    {$this->weekOff} AS weekoff ON weekoff.empID = employees.id
                ORDER BY 
                    all_dates.attendanceDate, attendance.attendanceTime
            ";
            return $dtr;
        }

        // NEW CODE
        // public function userViewDTR($id, $yearMonth) {
        //     $dtr = "
        //         SELECT 
        //             all_dates.attendanceDate,
        //             COALESCE(attendance.id, '-') AS id, 
        //             COALESCE(attendance.logTypeID, '-') AS logTypeID, 
        //             COALESCE(logtype.logType, '-') AS logType, 
        //             COALESCE(DATE_FORMAT(attendance.attendanceTime, '%h:%i %p'), '-') AS attendanceTime, 
        //             COALESCE(DATE_FORMAT(shift.startTime, '%h:%i %p'), '-') AS startTime, 
        //             COALESCE(DATE_FORMAT(shift.endTime, '%h:%i %p'), '-') AS endTime
        //         FROM 
        //             (
        //                 SELECT 
        //                     DATE('$yearMonth-01') + INTERVAL n DAY AS attendanceDate
        //                 FROM (
        //                     SELECT a.a + (10 * b.a) + (100 * c.a) AS n
        //                     FROM 
        //                         (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL 
        //                                 SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
        //                     CROSS JOIN 
        //                         (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3) AS b
        //                     CROSS JOIN 
        //                         (SELECT 0 AS a) AS c
        //                 ) AS days
        //                 WHERE DATE('$yearMonth-01') + INTERVAL n DAY <= LAST_DAY('$yearMonth-01')
        //             ) AS all_dates
        //         LEFT JOIN 
        //             ".$this->attendance." AS attendance 
        //             ON all_dates.attendanceDate = attendance.attendanceDate AND attendance.empID = ?
        //         LEFT JOIN 
        //             ".$this->employees." AS employees ON attendance.empID = employees.id
        //         LEFT JOIN 
        //             ".$this->logtype." AS logtype ON attendance.logTypeID = logtype.logTypeID 
        //         LEFT JOIN 
        //             ".$this->shift." AS shift ON employees.shiftID = shift.shiftID
        //         ORDER BY 
        //             all_dates.attendanceDate, attendance.attendanceTime;
        //     ";
        //     return $dtr;
        // }

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
                SELECT requestID, dateFiled, otDate, otType,
                DATE_FORMAT(fromTime, '%h:%i %p') AS fromTime,
                DATE_FORMAT(toTime, '%h:%i %p') AS toTime,
                remarks, status
                FROM ".$this->filedOT." AS filedOT
                INNER JOIN ".$this->employees." AS employees
                ON filedOT.empID = employees.id
                WHERE empID='$id'
                ORDER BY dateFiled DESC";
            return $request;
        }

        public function viewAllFiledOT() {
            $request = "
                SELECT requestID, dateFiled, otDate, employeeID, otType,
                CONCAT(firstName , ' ', lastName) AS employeeName,
                DATE_FORMAT(fromTime, '%h:%i %p') AS fromTime,
                DATE_FORMAT(toTime, '%h:%i %p') AS toTime,
                remarks, status
                FROM ".$this->filedOT." AS filedOT
                INNER JOIN ".$this->employees." AS employees
                ON filedOT.empID = employees.id";
            return $request;
        }

        public function viewDirectorFiledOT() {
            $request = "
                SELECT requestID, dateFiled, otDate, employeeID, otType,
                CONCAT(firstName , ' ', lastName) AS employeeName,
                DATE_FORMAT(fromTime, '%h:%i %p') AS fromTime,
                DATE_FORMAT(toTime, '%h:%i %p') AS toTime,
                remarks, status
                FROM ".$this->filedOT." AS filedOT
                INNER JOIN ".$this->employees." AS employees
                ON filedOT.empID = employees.id
                WHERE employees.designationID IN (5,8,9)";
            return $request;
        }

        public function viewAdminFiledOT() {
            $request = "
                SELECT requestID, dateFiled, otDate, employeeID, otType,
                CONCAT(firstName , ' ', lastName) AS employeeName,
                DATE_FORMAT(fromTime, '%h:%i %p') AS fromTime,
                DATE_FORMAT(toTime, '%h:%i %p') AS toTime,
                remarks, status
                FROM ".$this->filedOT." AS filedOT
                INNER JOIN ".$this->employees." AS employees
                ON filedOT.empID = employees.id
                WHERE employees.designationID NOT IN (8,9)
                ORDER BY dateFiled DESC";
            return $request;
        }

        public function viewTeamITFiledOT() {
            $request = "
                SELECT requestID, dateFiled, otDate, employeeID, otType,
                CONCAT(firstName , ' ', lastName) AS employeeName,
                DATE_FORMAT(fromTime, '%h:%i %p') AS fromTime,
                DATE_FORMAT(toTime, '%h:%i %p') AS toTime,
                remarks, status
                FROM ".$this->filedOT." AS filedOT
                INNER JOIN ".$this->employees." AS employees
                ON filedOT.empID = employees.id
                INNER JOIN ".$this->department." AS department
                ON department.departmentID = employees.departmentID
                WHERE employees.departmentID = 4 AND employees.designationID = 10";
            return $request;
        }

        public function viewTeamOperationsFiledOTManager() {
            $request = "
                SELECT requestID, dateFiled, otDate, employeeID, otType,
                CONCAT(firstName , ' ', lastName) AS employeeName,
                DATE_FORMAT(fromTime, '%h:%i %p') AS fromTime,
                DATE_FORMAT(toTime, '%h:%i %p') AS toTime,
                remarks, status
                FROM ".$this->filedOT." AS filedOT
                INNER JOIN ".$this->employees." AS employees
                ON filedOT.empID = employees.id
                INNER JOIN ".$this->department." AS department
                ON department.departmentID = employees.departmentID
                WHERE employees.designationID IN (4,11)";
            return $request;
        }

        public function viewTeamOperationsFiledOTTL() {
            $request = "
                SELECT requestID, dateFiled, otDate, employeeID, otType,
                CONCAT(firstName , ' ', lastName) AS employeeName,
                DATE_FORMAT(fromTime, '%h:%i %p') AS fromTime,
                DATE_FORMAT(toTime, '%h:%i %p') AS toTime,
                remarks, status
                FROM ".$this->filedOT." AS filedOT
                INNER JOIN ".$this->employees." AS employees
                ON filedOT.empID = employees.id
                INNER JOIN ".$this->department." AS department
                ON department.departmentID = employees.departmentID
                WHERE employees.departmentID = 1 AND employees.designationID IN (1,2,3)";
            return $request;
        }

        public function approveFiledOT($requestID) {
            $request = "
                UPDATE ".$this->filedOT." SET status = 1
                WHERE requestID = '$requestID'";
            return $request;
        }

        public function disapproveFiledOT($requestID) {
            $request = "
                UPDATE ".$this->filedOT." SET status = 0
                WHERE requestID = '$requestID'";
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
                WHERE empID='$id'
                ORDER BY dateFiled DESC";
            return $request;
        }
        
        public function viewAllChangeShiftRequest() {
            $request = "
                SELECT requestID, dateFiled, lastName, firstName, effectivityStartDate, 
                effectivityEndDate, remarks, status, designationID,
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

        public function viewDirectorChangeShiftRequest() {
            $request = "
                SELECT requestID, dateFiled, lastName, firstName, effectivityStartDate, 
                effectivityEndDate, remarks, status, designationID,
                CONCAT(DATE_FORMAT(shift_1.startTime, '%h:%i %p'), ' - ', DATE_FORMAT(shift_1.endTime, '%h:%i %p')) AS currentShift, 
                CONCAT(DATE_FORMAT(shift_2.startTime, '%h:%i %p'), ' - ', DATE_FORMAT(shift_2.endTime, '%h:%i %p')) AS requestedShift
                FROM ".$this->changeShift." AS changeShift
                INNER JOIN ".$this->employees." AS employees
                ON changeShift.empID = employees.id
                INNER JOIN ".$this->shift." AS shift_1
                ON shift_1.shiftID = employees.shiftID
                INNER JOIN ".$this->shift." AS shift_2
                ON shift_2.shiftID = changeShift.requestedShift
                WHERE employees.designationID IN (5,8,9)";
            return $request;
        }

        public function viewAdminChangeShiftRequest() {
            $request = "
                SELECT requestID, dateFiled, lastName, firstName, effectivityStartDate, 
                effectivityEndDate, remarks, status, designationID,
                CONCAT(DATE_FORMAT(shift_1.startTime, '%h:%i %p'), ' - ', DATE_FORMAT(shift_1.endTime, '%h:%i %p')) AS currentShift, 
                CONCAT(DATE_FORMAT(shift_2.startTime, '%h:%i %p'), ' - ', DATE_FORMAT(shift_2.endTime, '%h:%i %p')) AS requestedShift
                FROM ".$this->changeShift." AS changeShift
                INNER JOIN ".$this->employees." AS employees
                ON changeShift.empID = employees.id
                INNER JOIN ".$this->shift." AS shift_1
                ON shift_1.shiftID = employees.shiftID
                INNER JOIN ".$this->shift." AS shift_2
                ON shift_2.shiftID = changeShift.requestedShift
                WHERE employees.designationID NOT IN (8,9)
                ORDER BY dateFiled DESC";
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
                WHERE employees.departmentID = 4 AND employees.designationID = 10
                ORDER BY dateFiled DESC";
            return $request;
        }

        public function viewChangeShiftRequestOperationsManager() {
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
                WHERE employees.designationID IN (4,11)
                ORDER BY dateFiled DESC";
            return $request;
        }

        public function viewChangeShiftRequestOperationsTL() {
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
                WHERE employees.departmentID = 1 AND employees.designationID IN (1,2,3)
                ORDER BY dateFiled DESC";
            return $request;
        }

        public function viewLeaves($id) {
            $request = "
                SELECT * FROM ".$this->leaves." AS leaves
                INNER JOIN ".$this->employees." AS employees
                ON leaves.empID = employees.id
                INNER JOIN ".$this->leaveType." AS leaveType
                ON leaveType.leaveTypeID = leaves.leaveTypeID
                WHERE empID='$id'
                ORDER BY dateFiled DESC";
            return $request;
        }

        public function viewAdminLeaveRequests() {
            $request = "
                SELECT * FROM ".$this->leaves." AS leaves
                INNER JOIN ".$this->employees." AS employees
                ON leaves.empID = employees.id
                INNER JOIN ".$this->leaveType." AS leaveType
                ON leaveType.leaveTypeID = leaves.leaveTypeID
                WHERE employees.designationID NOT IN (8,9)
                ORDER BY dateFiled DESC";
            return $request;
        }

        public function viewDirectorLeaveRequests() {
            $request = "
                SELECT * FROM ".$this->leaves." AS leaves
                INNER JOIN ".$this->employees." AS employees
                ON leaves.empID = employees.id
                INNER JOIN ".$this->leaveType." AS leaveType
                ON leaveType.leaveTypeID = leaves.leaveTypeID
                WHERE employees.designationID IN (5,8,9)";
            return $request;
        }

        public function viewAllLeaveRequests() {
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
                WHERE employees.departmentID = 4 AND employees.designationID = 10";
            return $request;
        }

        public function viewLeaveRequestsOperationsTL() {
            $request = "
                SELECT * FROM ".$this->leaves." AS leaves
                INNER JOIN ".$this->employees." AS employees
                ON leaves.empID = employees.id
                INNER JOIN ".$this->department." AS department
                ON department.departmentID = employees.departmentID
                INNER JOIN ".$this->leaveType." AS leaveType
                ON leaveType.leaveTypeID = leaves.leaveTypeID
                WHERE employees.departmentID = 1 AND employees.designationID IN (1,2,3)";
            return $request;
        }

        public function viewLeaveRequestsOperationsManager() {
            $request = "
                SELECT * FROM ".$this->leaves." AS leaves
                INNER JOIN ".$this->employees." AS employees
                ON leaves.empID = employees.id
                INNER JOIN ".$this->department." AS department
                ON department.departmentID = employees.departmentID
                INNER JOIN ".$this->leaveType." AS leaveType
                ON leaveType.leaveTypeID = leaves.leaveTypeID
                WHERE employees.designationID IN (4,11)";
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
                WHERE users.status = 'Active' AND designationID = 12";
            return $allAdmin;
        }

        public function viewInactiveDirectors() {
            $inactiveAdmin = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->users." AS users
                ON employees.id = users.empID
                WHERE users.status = 'Inactive' AND designationID = 12";
            return $inactiveAdmin;
        }

        public function deactivateUser($id) {
            $deactivate = "
                UPDATE ".$this->users." SET status = 'Inactive' WHERE userID = '$id'";
            return $deactivate;
        }

        public function reactivateUser($id) {
            $reactivate = "
                UPDATE ".$this->users." SET status = 'Active' WHERE userID = '$id'";
            return $reactivate;
        }

        public function viewUser($id) {
            $user = "
                SELECT * FROM ".$this->users." WHERE userID = '$id'";
            return $user;
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

        public function addNewEmployee_prob($lastName, $firstName, $gender, $civilStatus, $address, $dateOfBirth, $placeOfBirth, 
            $sss, $pagIbig, $philhealth, $tin, $emailAddress, $employeeID, $mobileNumber, $departmentID, $designationID, $shiftID, 
            $basicPay, $dailyRate, $hourlyRate, $vacationLeaves, $sickLeaves, $employmentStatus, $dateHired) {
            $addEmployee = "
                INSERT INTO ".$this->employees." (lastName, firstName, gender, civilStatus, address, dateOfBirth, placeOfBirth, 
                sss, pagIbig, philhealth, tin, emailAddress, employeeID, mobileNumber, departmentID, designationID, shiftID, basicPay, dailyRate, hourlyRate, availableVL, availableSL, employmentStatus, dateHired, e_status)
                VALUES ('".$lastName."', '".$firstName."', '".$gender."', '".$civilStatus."', '".$address."', '".$dateOfBirth."', '".$placeOfBirth."',
                '".$sss."', '".$pagIbig."', '".$philhealth."', '".$tin."', '".$emailAddress."', '".$employeeID."', '".$mobileNumber."', 
                '".$departmentID."', '".$designationID."', '".$shiftID."', '".$basicPay."', '".$dailyRate."', '".$hourlyRate."', '".$vacationLeaves."', '".$sickLeaves."', '".$employmentStatus."', '".$dateHired."', 'Active')";
            return $addEmployee;
        }

        public function addNewEmployee_reg($lastName, $firstName, $gender, $civilStatus, $address, $dateOfBirth, $placeOfBirth, 
            $sss, $pagIbig, $philhealth, $tin, $emailAddress, $employeeID, $mobileNumber, $departmentID, $designationID, $shiftID, 
            $basicPay, $dailyRate, $hourlyRate, $vacationLeaves, $sickLeaves, $employmentStatus, $dateHired, $dateRegularized) {
            $addEmployee = "
                INSERT INTO ".$this->employees." (lastName, firstName, gender, civilStatus, address, dateOfBirth, placeOfBirth, 
                sss, pagIbig, philhealth, tin, emailAddress, employeeID, mobileNumber, departmentID, designationID, shiftID, basicPay, dailyRate, hourlyRate, availableVL, availableSL, employmentStatus, dateHired, dateRegularized, e_status)
                VALUES ('".$lastName."', '".$firstName."', '".$gender."', '".$civilStatus."', '".$address."', '".$dateOfBirth."', '".$placeOfBirth."',
                '".$sss."', '".$pagIbig."', '".$philhealth."', '".$tin."', '".$emailAddress."', '".$employeeID."', '".$mobileNumber."', 
                '".$departmentID."', '".$designationID."', '".$shiftID."', '".$basicPay."', '".$dailyRate."', '".$hourlyRate."', '".$vacationLeaves."', '".$sickLeaves."', '".$employmentStatus."', '".$dateHired."', '".$dateRegularized."', 'Active')";
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

        public function addEmployeeWeekOff($employeeID, $wo_mon, $wo_tue, $wo_wed, $wo_thu, $wo_fri, $wo_sat, $wo_sun) {
            $addWeekOff = "
                INSERT INTO ".$this->weekOff." (empID, wo_mon, wo_tue, wo_wed, wo_thu, wo_fri, wo_sat, wo_sun)
                VALUES ('".$employeeID."', '".$wo_mon."', '".$wo_tue."', '".$wo_wed."', '".$wo_thu."', '".$wo_fri."', '".$wo_sat."', '".$wo_sun."')";
            return $addWeekOff;
        }

        public function updateEmployeeInfo_reg($updateUserID, $updateLastName, $updateFirstName, $updateGender, $updateCivilStatus, $updateAddress, 
            $updateDateOfBirth, $updatePlaceOfBirth, $updateSSS, $updatePagIbig, $updatePhilhealth, $updateTIN, $updateEmailAddress, 
            $updateEmployeeID, $updateMobileNumber, $updateDepartmentID, $updateDesignationID, $updateShiftID, $updateBasicPay, $updateDailyRate, $updateHourlyRate, 
            $updateVacationLeaves, $updateSickLeaves, $updateCashAdvance, $updateEmploymentStatus, $updateDateHired, $updateDateRegularized) {
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
                availableSL = '$updateSickLeaves', 
                cashAdvance = '$updateCashAdvance', 
                employmentStatus = '$updateEmploymentStatus',
                dateHired = '$updateDateHired',
                dateRegularized = '$updateDateRegularized'
                WHERE id = '$updateUserID'";
            return $updateEmployee;
        }

        public function updateEmployeeInfo_prob($updateUserID, $updateLastName, $updateFirstName, $updateGender, $updateCivilStatus, $updateAddress, 
            $updateDateOfBirth, $updatePlaceOfBirth, $updateSSS, $updatePagIbig, $updatePhilhealth, $updateTIN, $updateEmailAddress, 
            $updateEmployeeID, $updateMobileNumber, $updateDepartmentID, $updateDesignationID, $updateShiftID, $updateBasicPay, $updateDailyRate, $updateHourlyRate, 
            $updateVacationLeaves, $updateSickLeaves, $updateCashAdvance, $updateEmploymentStatus, $updateDateHired) {
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
                availableSL = '$updateSickLeaves', 
                cashAdvance = '$updateCashAdvance', 
                employmentStatus = '$updateEmploymentStatus',
                dateHired = '$updateDateHired'
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

        public function updateEmployeeWeekOff($empID, $wo_mon, $wo_tue, $wo_wed, $wo_thu, $wo_fri, $wo_sat, $wo_sun) {
            $updateWeekOff = "
                UPDATE ".$this->weekOff." AS weekOff SET
                wo_mon = '$wo_mon',
                wo_tue = '$wo_tue',
                wo_wed = '$wo_wed',
                wo_thu = '$wo_thu',
                wo_fri = '$wo_fri',
                wo_sat = '$wo_sat',
                wo_sun = '$wo_sun'
                WHERE empID = '$empID'";
            return $updateWeekOff;
        }

        public function getEmployeeInfo($id) {
            $employeeInfo = "
                SELECT id, lastName, firstName, gender, civilStatus, address, dateOfBirth, cashAdvance,
                placeOfBirth, sss, pagIbig, philhealth, tin, emailAddress, employeeID, 
                mobileNumber, departmentName, position, basicPay, dailyRate, hourlyRate,
                availableVL, availableSL, req_sss, req_pagIbig, req_philhealth, req_tin, req_nbi,
                req_medicalExam, req_2x2pic, req_vaccineCard, req_psa, req_validID, req_helloMoney,
                employmentStatus, dateHired, dateRegularized, leavePoints, clearanceForm, resignationStatus,
                wo_mon, wo_tue, wo_wed, wo_thu, 
                wo_fri, wo_sat, wo_sun, renderedDays,
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
                INNER JOIN ".$this->weekOff." AS weekOff
                ON weekOff.empID = employees.id
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
                SELECT requestID, employeeID, leaves.leaveTypeID,
                leaveType, remarks, status, medCert, designationID,
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
                CONCAT(firstName, ' ', lastName) AS employeeName, designationID,
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
                SELECT requestID, employeeID, remarks, status, otType, designationID,
                DATE_FORMAT(fromTime, '%h:%i %p') AS fromTime,
                DATE_FORMAT(toTime, '%h:%i %p') AS toTime,
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

        public function fileOT($employeeID, $otDate, $otType, $fromTime, $toTime, $remarks) {
            $fileOT = "
                INSERT INTO ".$this->filedOT." (empID, dateFiled, otDate, otType, fromTime, toTime, remarks)
                VALUES ('$employeeID', CURRENT_TIMESTAMP, '$otDate', '$otType', '$fromTime', '$toTime', '$remarks')";
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

        public function fileSickLeave($employeeID, $leaveTypeID, $effectivityStartDate, $effectivityEndDate, $remarks, $status, $medCert) {
            $fileLeave = "
                INSERT INTO ".$this->leaves." (empID, dateFiled, leaveTypeID, effectivityStartDate, effectivityEndDate, remarks, status, medCert)
                VALUES ('$employeeID', CURRENT_TIMESTAMP, '$leaveTypeID', '$effectivityStartDate', '$effectivityEndDate', '$remarks', '$status', '$medCert')";
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

        public function fileRequest($employeeID, $newshift, $remarks, $status) {
            $fileRequest = "
                INSERT INTO ".$this->changeShift." (empID, dateFiled, requestedShift, remarks, status)
                VALUES ('$employeeID', CURRENT_TIMESTAMP, '$newshift', '$remarks', '$status')";
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

        public function approveLeave($requestID) {
            $approveRequest = "
                UPDATE ".$this->leaves." SET status = 'Approved'
                WHERE requestID = '$requestID'";
            return $approveRequest;
        }

        public function approveChangeShift($requestID) {
            $approveRequest = "
                UPDATE ".$this->changeShift." SET status = 'Approved'
                WHERE requestID = '$requestID'";
            return $approveRequest;
        }

        public function disapproveLeave($requestID) {
            $disapproveRequest = "
                UPDATE ".$this->leaves." SET status = 'Disapproved'
                WHERE requestID = '$requestID'";
            return $disapproveRequest;
        }

        public function viewLeaveInfo($requestID) {
            $request = "
                SELECT empID
                FROM ".$this->leaves." AS leaves
                INNER JOIN ".$this->employees." AS employees
                ON leaves.empID = employees.id
                INNER JOIN ".$this->leaveType." AS leaveType
                ON leaveType.leaveTypeID = leaves.leaveTypeID
                WHERE requestID = '$requestID'";
            return $request;
        }

        public function viewChangeShiftInfo($requestID) {
            $request = "
                SELECT requestID, empID, requestedShift
                FROM ".$this->changeShift." AS changeShift
                INNER JOIN ".$this->employees." AS employees
                ON changeShift.empID = employees.id
                INNER JOIN ".$this->shift." AS shift_1
                ON shift_1.shiftID = employees.shiftID
                INNER JOIN ".$this->shift." AS shift_2
                ON shift_2.shiftID = changeShift.requestedShift
                WHERE requestID = '$requestID'";
            return $request;
        }

        public function viewOTInfo($requestID) {
            $request = "
                SELECT empID
                FROM ".$this->filedOT." AS filedOT
                INNER JOIN ".$this->employees." AS employees
                ON filedOT.empID = employees.id
                WHERE requestID = '$requestID'";
            return $request;
        }

        public function updateShift($empID, $shiftID) {
            $updateShift = "
                UPDATE ".$this->employees." SET shiftID = '$shiftID'
                WHERE id = '$empID'";
            return $updateShift;
        }

        public function disapproveChangeShift($requestID) {
            $disapproveRequest = "
                UPDATE ".$this->changeShift." SET status = 'Disapproved'
                WHERE requestID = '$requestID'";
            return $disapproveRequest;
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
                ON employees.shiftID = shifts.shiftID
                WHERE designationID != 12
                ORDER BY employeeID ASC";
            return $employeeAttendance;
        }
        
        public function viewEmployee($id) {
            $employee = "
                SELECT * FROM ".$this->employees."
                WHERE id = '$id'";
            return $employee;
        }

        public function viewApprovedSickLeaves($id) {
            $approvedSickLeaves = "
                SELECT * FROM ".$this->leaves." AS leaves
                INNER JOIN ".$this->employees." AS employees
                ON leaves.empID = employees.id
                INNER JOIN ".$this->leaveType." AS leaveType
                ON leaveType.leaveTypeID = leaves.leaveTypeID
                WHERE empID = '$id' AND 
                (leaves.leaveTypeID = 1 AND leaves.status = 'Approved')";
            return $approvedSickLeaves;
        }

        public function viewLeavePoints($id) {
            $leavePoints = "
                SELECT leavePoints, carryOverVLPoints
                FROM ".$this->employees."
                WHERE id = '$id'";
            return $leavePoints;
        }

        public function resignEmployee($id, $resignationStatus, $clearanceForm) {
            $resignEmployee = "
                UPDATE ".$this->employees." SET 
                employmentStatus = 'Resigned',
                resignationStatus = '$resignationStatus',
                e_status = 'Inactive',
                clearanceForm = '$clearanceForm'
                WHERE id = '$id'";    
            return $resignEmployee;
        }

        public function resignIncompleteEmployee($id, $resignationStatus, $clearanceForm, $renderedDays) {
            $resignEmployee = "
                UPDATE ".$this->employees." SET 
                employmentStatus = 'Resigned',
                resignationStatus = '$resignationStatus',
                e_status = 'Inactive',
                clearanceForm = '$clearanceForm',
                renderedDays = '$renderedDays'
                WHERE id = '$id'";
            return $resignEmployee;
        }

        public function rehireEmployee($id) {
            $employee = "
                UPDATE ".$this->employees." SET 
                employmentStatus = 'Probationary',
                e_status = 'Active'
                WHERE id = '$id'";    
            return $employee;
        }

        // OLD CODE
        // public function viewAuditTrail() {
        //     $auditTrail = "
        //         SELECT auditTrailID, date, employees.firstName, employees.lastName, module, action, affected.firstName AS affectedFirstName, affected.lastName AS affectedLastName FROM ".$this->auditTrail ." AS auditTrail
        //         INNER JOIN ".$this->employees." AS employees
        //         ON auditTrail.empID = employees.id
        //         INNER JOIN ".$this->employees." AS affected
        //         ON auditTrail.affected_empID = affected.id
        //         ORDER BY auditTrail.auditTrailID DESC";
        //     return $auditTrail;
        // }

        // NEW CODE
        public function viewAuditTrail() {
            $auditTrail = "
                SELECT auditTrailID, date, employees.firstName, employees.lastName, module, action, affected_empID 
                FROM ".$this->auditTrail ." AS auditTrail
                INNER JOIN ".$this->employees." AS employees
                ON auditTrail.empID = employees.id
                ORDER BY auditTrail.auditTrailID DESC";
            return $auditTrail;
        }

        public function viewAuditTrailEmployee() {
            $auditTrail = "
                SELECT auditTrailID, date, employees.firstName, employees.lastName, module, action, affected_empID 
                FROM ".$this->auditTrail ." AS auditTrail
                INNER JOIN ".$this->employees." AS employees
                ON auditTrail.empID = employees.id
                WHERE module LIKE '%Employee%'
                ORDER BY auditTrail.auditTrailID DESC";
            return $auditTrail;
        }

        public function viewAffectedUser($empID) {
            $affectedUser = "
                SELECT firstName AS affectedFirstName, lastName AS affectedLastName
                FROM ".$this->employees." AS employees
                WHERE id = '$empID'";
            return $affectedUser;
        }

        public function viewAuditTrailPayroll() {
            $payroll = "
                SELECT auditTrailID, date, employees.firstName, employees.lastName, module, action, affected_empID 
                FROM ".$this->auditTrail." AS auditTrail
                INNER JOIN ".$this->employees." AS employees
                ON auditTrail.empID = employees.id
                WHERE module LIKE '%Payroll%'
                ORDER BY auditTrail.auditTrailID DESC";
            return $payroll;
        }

        public function viewAuditTrailLeave() {
            $leave = "
                SELECT auditTrailID, date, employees.firstName, employees.lastName, module, action, affected_empID 
                FROM ".$this->auditTrail." AS auditTrail
                INNER JOIN ".$this->employees." AS employees
                ON auditTrail.empID = employees.id
                WHERE module LIKE '%Leave%'
                ORDER BY auditTrail.auditTrailID DESC";
            return $leave;
        }

        public function viewAuditTrailChangeShift() {
            $changeShift = "
                SELECT auditTrailID, date, employees.firstName, employees.lastName, module, action, affected_empID 
                FROM ".$this->auditTrail." AS auditTrail
                INNER JOIN ".$this->employees." AS employees
                ON auditTrail.empID = employees.id
                WHERE module LIKE '%Change Shift%'
                ORDER BY auditTrail.auditTrailID DESC";
            return $changeShift;
        }

        public function viewAuditTrailOvertime() {
            $overtime = "
                SELECT auditTrailID, date, employees.firstName, employees.lastName, module, action, affected_empID 
                FROM ".$this->auditTrail." AS auditTrail
                INNER JOIN ".$this->employees." AS employees
                ON auditTrail.empID = employees.id
                WHERE module LIKE '%OT%' OR module LIKE '%Overtime%'
                ORDER BY auditTrail.auditTrailID DESC";
            return $overtime;
        }

        public function viewAuditTrailAdjustments() {
            $adjustments = "
                SELECT auditTrailID, date, employees.firstName, employees.lastName, module, action, affected_empID FROM ".$this->auditTrail." AS auditTrail
                INNER JOIN ".$this->employees." AS employees
                ON auditTrail.empID = employees.id
                WHERE module LIKE '%Adjustments%'
                ORDER BY auditTrail.auditTrailID DESC";
            return $adjustments;
        }

        public function viewAuditTrailUsers() {
            $users = "
                SELECT auditTrailID, date, employees.firstName, employees.lastName, module, action, affected_empID FROM ".$this->auditTrail." AS auditTrail
                INNER JOIN ".$this->employees." AS employees
                ON auditTrail.empID = employees.id
                WHERE module LIKE '%User%'
                ORDER BY auditTrail.auditTrailID DESC";
            return $users;
        }
        
        public function auditTrail($empID, $module, $action, $affected_empID) {
            $auditTrail = "
                INSERT INTO ".$this->auditTrail." (date, empID, module, action, affected_empID)
                VALUES (CURRENT_TIMESTAMP, '$empID', '$module', '$action', '$affected_empID')";
            return $auditTrail;
        }

        public function auditTrailPayroll($empID, $module, $action) {
            $auditTrail = "
                INSERT INTO ".$this->auditTrail." (date, empID, module, action)
                VALUES (CURRENT_TIMESTAMP, '$empID', '$module', '$action')";
            return $auditTrail;
        }
    }

?>