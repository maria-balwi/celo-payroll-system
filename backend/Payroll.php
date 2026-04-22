<?php

    class Payroll extends Database
    {
        private $employees = 'tbl_employee';
        private $department = 'tbl_department';
        private $designation = 'tbl_designation';
        private $requirements = 'tbl_requirements';
        private $shifts = 'tbl_shiftschedule';
        private $allowances = 'tbl_allowances';
        private $deductions = 'tbl_deductions';
        private $reimbursements = 'tbl_reimbursements';
        private $adjustments = 'tbl_adjustments';
        private $empAllowances = 'tbl_empallowances';
        private $empReimbursements = 'tbl_empreimbursements';
        private $empDeductions = 'tbl_empdeductions';
        private $empAdjustments = 'tbl_empadjustments';
        private $holidays = 'tbl_holidays';
        private $payroll = 'tbl_payroll';
        private $payrollCycle = 'tbl_payrollcycle';
        private $payslip = 'tbl_payslip';
        private $attendance = 'tbl_attendance';
        private $weekOff = 'tbl_empweekoff';
        private $leaves = 'tbl_leaveapplications';
        private $filedOT = 'tbl_filedot';
        private $cashAdvance = 'tbl_cashadvance';
        private $referral = 'tbl_referral';
        private $salaryadj = 'tbl_salaryadj';
        private $auditTrail = 'tbl_audittrail';
        private $caPaymentHistory = 'tbl_caPaymentHistory';
        private $disputes = 'tbl_disputes';
        private $disputeAttendance = 'tbl_disputeattendance';
        private $disputeLeaves = 'tbl_disputeleaves';
        private $disputeOvertime = 'tbl_disputeovertime';

        private $dbConnect = false;
        public function __construct() {
            $this->dbConnect = $this->dbConnect();
        }

        public function viewAllAllowances() {
            $allowances = "
                SELECT * FROM ".$this->allowances;
            return $allowances;
        }

        public function viewAllDeductions() {
            $deductions = "
                SELECT * FROM ".$this->deductions;
            return $deductions;
        }

        public function viewAllReimbursements() {
            $reimbursements = "
                SELECT * FROM ".$this->reimbursements;
            return $reimbursements;
        }

        public function viewAllAdjustments() {
            $adjustments = "
                SELECT * FROM ".$this->adjustments;
            return $adjustments;
        }

        public function viewAllSalaryAdj() {
            $salaryadj = "
                SELECT * FROM {$this->salaryadj} AS sa
                INNER JOIN {$this->employees} AS e
                ON sa.empID = e.id";
            return $salaryadj;
        }

        public function getAllowanceInfo($allowanceID) {
            $allowance = "
                SELECT * FROM ".$this->allowances."
                WHERE allowanceID = '$allowanceID'";
            return $allowance;
        }

        public function getReimbursementInfo($reimbursementID) {
            $reimbursement = "
                SELECT * FROM ".$this->reimbursements."
                WHERE reimbursementID = '$reimbursementID'";
            return $reimbursement;
        }

        public function getDeductionInfo($deductionID) {
            $deduction = "
                SELECT * FROM ".$this->deductions."
                WHERE deductionID = '$deductionID'";
            return $deduction;
        }

        public function getAdjustmentInfo($adjustmentID) {
            $adjustment = "
                SELECT * FROM ".$this->adjustments."
                WHERE adjustmentID = '$adjustmentID'";
            return $adjustment;
        }

        public function getSalaryInfo($salaryAdjID) {
            $salaryAdj = "
                SELECT * FROM {$this->salaryadj} AS sa
                INNER JOIN {$this->employees} AS e
                ON sa.empID = e.id
                WHERE sa.salaryAdjID = '$salaryAdjID'";
            return $salaryAdj;
        }

        public function approveSalaryAdjustment($salaryAdjID) {
            $approveSalaryAdjustment = "
                UPDATE ".$this->salaryadj." 
                SET status = 'Approved'
                WHERE salaryAdjID = '$salaryAdjID'";
            return $approveSalaryAdjustment;
        }

        public function disapproveSalaryAdjustment($salaryAdjID) {
            $disapproveSalaryAdjustment = "
                UPDATE ".$this->salaryadj." 
                SET status = 'Disapproved'
                WHERE salaryAdjID = '$salaryAdjID'";
            return $disapproveSalaryAdjustment;
        }

        public function getSalaryInfoAT($auditTrailID) {
          $salaryAdj = "
            SELECT action, dateFiled, emp.employeeID, 
            emp.firstName AS affectedFirstName, 
            emp.lastName AS affectedLastName,
            e.firstName AS firstName,
            e.lastName AS lastName, currentSalary, 
            suggestedSalary, reason
            FROM {$this->auditTrail} AS at
            INNER JOIN {$this->salaryadj} AS sa
            ON at.salaryAdjID = sa.salaryAdjID
            INNER JOIN {$this->employees} AS e
            ON at.empID = e.id
            INNER JOIN {$this->employees} AS emp
            ON at.affected_empID = emp.id
            WHERE at.auditTrailID = '$auditTrailID'";
          return $salaryAdj;
        }

        public function addAllowance($allowanceName) {
            $addAllowance = "
                INSERT INTO ".$this->allowances." (allowanceName)
                VALUES ('$allowanceName')";
            return $addAllowance;
        }

        public function addReimbursement($reimbursementName) {
            $addReimbursement = "
                INSERT INTO ".$this->reimbursements." (reimbursementName)
                VALUES ('$reimbursementName')";
            return $addReimbursement;
        }

        public function addDeduction($deductionName) {
            $addDeduction = "
                INSERT INTO ".$this->deductions." (deductionName)
                VALUES ('$deductionName')";
            return $addDeduction;
        }

        public function addAdjustment($adjustmentName, $adjustmentType) {
            $addAdjustment = "
                INSERT INTO ".$this->adjustments." (adjustmentName, adjustmentType)
                VALUES ('$adjustmentName', '$adjustmentType')";
            return $addAdjustment;
        }

        public function fileSalaryAdjustment($empID, $currentSalary, $suggestedSalary, $reason, $status) {
            $fileSalaryAdjustment = "
                INSERT INTO ".$this->salaryadj." (empID, currentSalary, suggestedSalary, reason, dateFiled, status)
                VALUES ('$empID', '$currentSalary', '$suggestedSalary', '$reason', CURRENT_DATE(), '$status')";
            return $fileSalaryAdjustment;
        }

        public function updateAllowance($allowanceID, $allowanceName) {
            $updateAllowance = "
                UPDATE ".$this->allowances."
                SET allowanceName = '$allowanceName'
                WHERE allowanceID = '$allowanceID'";
            return $updateAllowance;
        }

        public function updateReimbursement($reimbursementID, $reimbursementName) {
            $updateReimbursement = "
                UPDATE ".$this->reimbursements."
                SET reimbursementName = '$reimbursementName'
                WHERE reimbursementID = '$reimbursementID'";
            return $updateReimbursement;
        }


        public function updateDeduction($deductionID, $deductionName) {
            $updateDeduction = "
                UPDATE ".$this->deductions."
                SET deductionName = '$deductionName'
                WHERE deductionID = '$deductionID'";
            return $updateDeduction;
        }


        public function updateAdjustment($adjustmentID, $adjustmentName, $adjustmentType) {
            $updateAdjustment = "
                UPDATE ".$this->adjustments."
                SET adjustmentName = '$adjustmentName', 
                adjustmentType = '$adjustmentType'
                WHERE adjustmentID = '$adjustmentID'";
            return $updateAdjustment;
        }

        public function deleteAllowance($allowanceID) {
            $deleteAllowance = "
                DELETE FROM ".$this->allowances."
                WHERE allowanceID = '$allowanceID'";
            return $deleteAllowance;
        }

        public function deleteReimbursement($reimbursementID) {
            $deleteReimbursement = "
                DELETE FROM ".$this->reimbursements."
                WHERE reimbursementID = '$reimbursementID'";
            return $deleteReimbursement;
        }

        public function deleteDeduction($deductionID) {
            $deleteDeduction = "
                DELETE FROM ".$this->deductions."
                WHERE deductionID = '$deductionID'";
            return $deleteDeduction;
        }

        public function deleteAdjustment($adjustmentID) {
            $deleteAdjustment = "
                DELETE FROM ".$this->adjustments."
                WHERE adjustmentID = '$adjustmentID'";
            return $deleteAdjustment;
        }

        public function viewLastAllowance() {
            $allowance = "
                SELECT allowanceID
                FROM ".$this->allowances."
                ORDER BY allowanceID DESC
                LIMIT 1";
            return $allowance;
        }

        public function viewLastReimbursement() {
            $reimbursement = "
                SELECT reimbursementID
                FROM ".$this->reimbursements."
                ORDER BY reimbursementID DESC
                LIMIT 1";
            return $reimbursement;
        }

        public function viewLastDeduction() {
            $allowance = "
                SELECT deductionID
                FROM ".$this->deductions."
                ORDER BY deductionID DESC
                LIMIT 1";
            return $allowance;
        }

        public function viewLastAdjustment() {
            $adjustment = "
                SELECT adjustmentID
                FROM ".$this->adjustments."
                ORDER BY adjustmentID DESC
                LIMIT 1";
            return $adjustment;
        }

        public function viewLastSalaryAdjustment() {
            $salaryAdjustment = "
                SELECT salaryAdjID
                FROM ".$this->salaryadj." 
                ORDER BY salaryAdjID DESC
                LIMIT 1";
            return $salaryAdjustment;
        }

        public function getAllEmpAllowances($id) {
            $empAllowances = "
                SELECT empAllowances.empID, empAllowances.allowanceID, 
                empAllowanceID, allowanceName, amount
                FROM ".$this->empAllowances." AS empAllowances
                INNER JOIN ".$this->allowances." AS allowances
                ON empAllowances.allowanceID = allowances.allowanceID
                INNER JOIN ".$this->employees." AS employees
                ON empAllowances.empID = employees.id
                WHERE empAllowances.empID = '$id'";
            return $empAllowances;
        }

        public function getAllEmpReimbursements($id) {
            $empReimbursements = "
                SELECT empReimbursements.empID, empReimbursements.reimbursementID, 
                empReimbursementID, reimbursementName, amount
                FROM ".$this->empReimbursements." AS empReimbursements
                INNER JOIN ".$this->reimbursements." AS reimbursements
                ON empReimbursements.reimbursementID = reimbursements.reimbursementID
                INNER JOIN ".$this->employees." AS employees
                ON empReimbursements.empID = employees.id
                WHERE empReimbursements.empID = '$id'";
            return $empReimbursements;
        }

        public function getAllEmpADeductions($id) {
            $empAllowances = "
                SELECT empDeductions.empID, empDeductions.deductionID, 
                empDeductionID, deductionName, amount
                FROM ".$this->empDeductions." AS empDeductions
                INNER JOIN ".$this->deductions." AS deductions
                ON empDeductions.deductionID = deductions.deductionID
                INNER JOIN ".$this->employees." AS employees
                ON empDeductions.empID = employees.id
                WHERE empDeductions.empID = '$id'";
            return $empAllowances;
        }

        public function getAllEmpAdjustments($id) {
            $empAdjustments = "
                SELECT empAdjustments.empID, empAdjustments.adjustmentID, 
                empAdjustmentID, adjustmentName, amount, adjustmentType
                FROM ".$this->empAdjustments." AS empAdjustments
                INNER JOIN ".$this->adjustments." AS adjustments
                ON empAdjustments.adjustmentID = adjustments.adjustmentID
                INNER JOIN ".$this->employees." AS employees
                ON empAdjustments.empID = employees.id
                WHERE empAdjustments.empID = '$id'";
            return $empAdjustments;
        }

        public function checkEmpAllowance($id, $allowanceID) {
            $checkEmpAllowance = "
                SELECT * FROM ".$this->empAllowances."
                WHERE empID = '$id'
                AND allowanceID = '$allowanceID'";
            return $checkEmpAllowance;
        }

        public function checkEmpReimbursement($id, $reimbursementID) {
            $checkEmpReimbursement = "
                SELECT * FROM ".$this->empReimbursements."
                WHERE empID = '$id'
                AND reimbursementID = '$reimbursementID'";
            return $checkEmpReimbursement;
        }

        public function checkEmpDeduction($id, $deductionID) {
            $checkEmpDeduction = "
                SELECT * FROM ".$this->empDeductions."
                WHERE empID = '$id'
                AND deductionID = '$deductionID'";
            return $checkEmpDeduction;
        }

        public function checkEmpAdjustment($id, $adjustmentID) {
            $checkEmpAdjustment = "
                SELECT * FROM ".$this->empAdjustments."
                WHERE empID = '$id'
                AND adjustmentID = '$adjustmentID'";
            return $checkEmpAdjustment;
        }

        public function addEmpAllowance($id, $allowanceID, $allowanceType, $amount) {
            $addEmpAllowance = "
                INSERT INTO ".$this->empAllowances." (empID, allowanceID, type, amount, dateCreated)
                VALUES ('$id', '$allowanceID', '$allowanceType', '$amount', CURRENT_TIMESTAMP())";
            return $addEmpAllowance;
        }

        public function addEmpReimbursement($id, $reimbursementID, $reimbursementType, $amount) {
            $addEmpReimbursement = "
                INSERT INTO ".$this->empReimbursements." (empID, reimbursementID, type, amount, dateCreated)
                VALUES ('$id', '$reimbursementID', '$reimbursementType', '$amount', CURRENT_TIMESTAMP())";
            return $addEmpReimbursement;
        }

        public function addEmpDeduction($id, $deductionID, $deductionType, $amount) {
            $addEmpADeduction = "
                INSERT INTO ".$this->empDeductions." (empID, deductionID, type, amount, dateCreated)
                VALUES ('$id', '$deductionID', '$deductionType', '$amount', CURRENT_TIMESTAMP())";
            return $addEmpADeduction;
        }

        public function addEmpAdjustment($id, $adjustmentID, $adjustmentType, $amount) {
            $addEmpAdjustment = "
                INSERT INTO ".$this->empAdjustments." (empID, adjustmentID, type, amount, dateCreated)
                VALUES ('$id', '$adjustmentID', '$adjustmentType', '$amount', CURRENT_TIMESTAMP())";
            return $addEmpAdjustment;
        }

        public function addEmpAllowance_once($id, $allowanceID, $allowanceType, $amount, $effectiveDate) {
            $addEmpAllowance = "
                INSERT INTO ".$this->empAllowances." (empID, allowanceID, type, amount, effectiveDate, dateCreated)
                VALUES ('$id', '$allowanceID', '$allowanceType', '$amount', '$effectiveDate', CURRENT_TIMESTAMP())";
            return $addEmpAllowance;
        }

        public function addEmpReimbursement_once($id, $reimbursementID, $reimbursementType, $amount, $reimbursement_payrollCycleID) {
            $addEmpReimbursement = "
                INSERT INTO ".$this->empReimbursements." (empID, reimbursementID, type, amount, payrollCycleID, dateCreated)
                VALUES ('$id', '$reimbursementID', '$reimbursementType', '$amount', '$reimbursement_payrollCycleID', CURRENT_TIMESTAMP())";
            return $addEmpReimbursement;
        }

        public function addEmpDeduction_once($id, $deductionID, $deductionType, $amount, $deduction_payrollCycleID) {
            $addEmpADeduction = "
                INSERT INTO ".$this->empDeductions." (empID, deductionID, type, amount, payrollCycleID, dateCreated)
                VALUES ('$id', '$deductionID', '$deductionType', '$amount', '$deduction_payrollCycleID', CURRENT_TIMESTAMP())";
            return $addEmpADeduction;
        }

        public function addEmpAdjustment_once($id, $adjustmentID, $adjustmentType, $amount, $adjustment_payrollCycleID) {
            $addEmpAdjustment = "
                INSERT INTO ".$this->empAdjustments." (empID, adjustmentID, type, amount, payrollCycleID, dateCreated)
                VALUES ('$id', '$adjustmentID', '$adjustmentType', '$amount', '$adjustment_payrollCycleID', CURRENT_TIMESTAMP())";
            return $addEmpAdjustment;
        }

        public function deleteEmpAllowance($empAllowanceID) {
            $deleteEmpAllowance = "
                DELETE FROM ".$this->empAllowances."
                WHERE empAllowanceID = '$empAllowanceID'";
            return $deleteEmpAllowance;
        }

        public function deleteEmpReimbursement($empReimbursementID) {
            $deleteEmpReimbursement = "
                DELETE FROM ".$this->empReimbursements."
                WHERE empReimbursementID = '$empReimbursementID'";
            return $deleteEmpReimbursement;
        }

        public function deleteEmpDeduction($empDeductionID) {
            $deleteEmpADeduction = "
                DELETE FROM ".$this->empDeductions."
                WHERE empDeductionID = '$empDeductionID'";
            return $deleteEmpADeduction;
        }

        public function deleteEmpAdjustment($empAdjustmentID) {
            $deleteEmpAdjustment = "
                DELETE FROM ".$this->empAdjustments."
                WHERE empAdjustmentID = '$empAdjustmentID'";
            return $deleteEmpAdjustment;
        }

        public function deleteEmpReferral($referralID) {
            $deleteEmpReferral = "
                DELETE FROM ".$this->referral." 
                WHERE referralID = $referralID";
            return $deleteEmpReferral;
        }

        public function viewHolidays() {
            $holidays = "
                SELECT * FROM ".$this->holidays
                ." WHERE YEAR(dateFrom) = YEAR(CURDATE())
                ORDER BY dateFrom ASC";
            return $holidays;
        }

        public function getHolidayInfo($holidayID) {
            $holiday = "
                SELECT * FROM ".$this->holidays."
                WHERE holidayID = '$holidayID'";
            return $holiday;
        }

        public function viewLastHoliday() {
            $lastHoliday = "
                SELECT * FROM ".$this->holidays."
                ORDER BY holidayID DESC
                LIMIT 1";
            return $lastHoliday;
        }
        
        public function addHoliday($name, $dateFrom, $type) {
            $addHoliday = "
                INSERT INTO ".$this->holidays." (holidayName, dateFrom, type)
                VALUES ('$name', '$dateFrom', '$type')";
            return $addHoliday;
        }

        public function updateHoliday($holidayID, $name, $dateFrom, $type) {
            $updateHoliday = "
                UPDATE ".$this->holidays." SET 
                holidayName = '$name', 
                dateFrom = '$dateFrom', 
                type = '$type'
                WHERE holidayID = '$holidayID'";
            return $updateHoliday;
        }

        public function deleteHoliday($holidayID) {
            $deleteHoliday = "
                DELETE FROM ".$this->holidays."
                WHERE holidayID = '$holidayID'";
            return $deleteHoliday;
        }

        public function pendingDisputesAttendance() {
            $attendanceDisputes = "
                SELECT disputeID, employeeID, firstName, lastName,
                attendanceDate_timeIn, attendanceTime_timeIn,
                attendanceDate_timeOut, attendanceTime_timeOut, 
                remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeAttendance." AS disputeAttendance
                ON dispute.attendanceID = disputeAttendance.attendanceID
                INNER JOIN ".$this->employees." AS employee
                ON disputeAttendance.empID = employee.id
                WHERE dispute.status = 'Pending'";
            return $attendanceDisputes;
        }

        public function pendingDisputesAttendanceOpsManager() {
            $attendanceDisputes = "
                SELECT disputeID, employeeID, firstName, lastName,
                attendanceDate_timeIn, attendanceTime_timeIn,
                attendanceDate_timeOut, attendanceTime_timeOut, 
                remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeAttendance." AS disputeAttendance
                ON dispute.attendanceID = disputeAttendance.attendanceID
                INNER JOIN ".$this->employees." AS employee
                ON disputeAttendance.empID = employee.id
                WHERE dispute.status = 'Pending' AND
                employee.designationID IN (1,2,3,4,11,14)";
            return $attendanceDisputes;
        }

        public function pendingDisputesAttendanceOpsTL() {
            $attendanceDisputes = "
                SELECT disputeID, employeeID, firstName, lastName,
                attendanceDate_timeIn, attendanceTime_timeIn,
                attendanceDate_timeOut, attendanceTime_timeOut, 
                remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeAttendance." AS disputeAttendance
                ON dispute.attendanceID = disputeAttendance.attendanceID
                INNER JOIN ".$this->employees." AS employee
                ON disputeAttendance.empID = employee.id
                WHERE dispute.status = 'Pending' AND
                employee.departmentID = 1 AND employee.designationID IN (1,2,3,14)";
            return $attendanceDisputes;
        }

        public function pendingDisputesAttendanceIT() {
            $attendanceDisputes = "
                SELECT disputeID, employeeID, firstName, lastName,
                attendanceDate_timeIn, attendanceTime_timeIn,
                attendanceDate_timeOut, attendanceTime_timeOut, 
                remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeAttendance." AS disputeAttendance
                ON dispute.attendanceID = disputeAttendance.attendanceID
                INNER JOIN ".$this->employees." AS employee
                ON disputeAttendance.empID = employee.id
                WHERE dispute.status = 'Pending' AND
                employee.departmentID = 4 AND employee.designationID IN (10, 13, 19)";
            return $attendanceDisputes;
        }

        public function approvedDisputesAttendance() {
            $attendanceDisputes = "
                SELECT disputeID, employeeID, firstName, lastName,
                attendanceDate_timeIn, attendanceTime_timeIn,
                attendanceDate_timeOut, attendanceTime_timeOut, 
                remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeAttendance." AS disputeAttendance
                ON dispute.attendanceID = disputeAttendance.attendanceID
                INNER JOIN ".$this->employees." AS employee
                ON disputeAttendance.empID = employee.id
                WHERE dispute.status = 'Approved'";
            return $attendanceDisputes;
        }

        public function approvedDisputesAttendanceOpsManager() {
            $attendanceDisputes = "
                SELECT disputeID, employeeID, firstName, lastName,
                attendanceDate_timeIn, attendanceTime_timeIn,
                attendanceDate_timeOut, attendanceTime_timeOut, 
                remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeAttendance." AS disputeAttendance
                ON dispute.attendanceID = disputeAttendance.attendanceID
                INNER JOIN ".$this->employees." AS employee
                ON disputeAttendance.empID = employee.id
                WHERE dispute.status = 'Approved' AND 
                employee.designationID IN (1,2,3,4,11,14)";
            return $attendanceDisputes;
        }

        public function approvedDisputesAttendanceOpsTL() {
            $attendanceDisputes = "
                SELECT disputeID, employeeID, firstName, lastName,
                attendanceDate_timeIn, attendanceTime_timeIn,
                attendanceDate_timeOut, attendanceTime_timeOut, 
                remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeAttendance." AS disputeAttendance
                ON dispute.attendanceID = disputeAttendance.attendanceID
                INNER JOIN ".$this->employees." AS employee
                ON disputeAttendance.empID = employee.id
                WHERE dispute.status = 'Approved' AND 
                employee.departmentID = 1 AND employee.designationID IN (1,2,3,14)";
            return $attendanceDisputes;
        }

        public function approvedDisputesAttendanceIT() {
            $attendanceDisputes = "
                SELECT disputeID, employeeID, firstName, lastName,
                attendanceDate_timeIn, attendanceTime_timeIn,
                attendanceDate_timeOut, attendanceTime_timeOut, 
                remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeAttendance." AS disputeAttendance
                ON dispute.attendanceID = disputeAttendance.attendanceID
                INNER JOIN ".$this->employees." AS employee
                ON disputeAttendance.empID = employee.id
                WHERE dispute.status = 'Approved' AND 
                employee.departmentID = 4 AND employee.designationID IN (10, 13, 19)";
            return $attendanceDisputes;
        }

        public function disapprovedDisputesAttendance() {
            $attendanceDisputes = "
                SELECT disputeID, employeeID, firstName, lastName,
                attendanceDate_timeIn, attendanceTime_timeIn,
                attendanceDate_timeOut, attendanceTime_timeOut, 
                remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeAttendance." AS disputeAttendance
                ON dispute.attendanceID = disputeAttendance.attendanceID
                INNER JOIN ".$this->employees." AS employee
                ON disputeAttendance.empID = employee.id
                WHERE dispute.status = 'Disapproved'";
            return $attendanceDisputes;
        }

        public function disapprovedDisputesAttendanceOpsManager() {
            $attendanceDisputes = "
                SELECT disputeID, employeeID, firstName, lastName,
                attendanceDate_timeIn, attendanceTime_timeIn,
                attendanceDate_timeOut, attendanceTime_timeOut, 
                remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeAttendance." AS disputeAttendance
                ON dispute.attendanceID = disputeAttendance.attendanceID
                INNER JOIN ".$this->employees." AS employee
                ON disputeAttendance.empID = employee.id
                WHERE dispute.status = 'Disapproved' AND
                employee.designationID IN (1,2,3,4,11,14)";
            return $attendanceDisputes;
        }

        public function disapprovedDisputesAttendanceOpsTL() {
            $attendanceDisputes = "
                SELECT disputeID, employeeID, firstName, lastName,
                attendanceDate_timeIn, attendanceTime_timeIn,
                attendanceDate_timeOut, attendanceTime_timeOut, 
                remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeAttendance." AS disputeAttendance
                ON dispute.attendanceID = disputeAttendance.attendanceID
                INNER JOIN ".$this->employees." AS employee
                ON disputeAttendance.empID = employee.id
                WHERE dispute.status = 'Disapproved' AND
                employee.departmentID = 1 AND employee.designationID IN (1,2,3,14)";
            return $attendanceDisputes;
        }

        public function disapprovedDisputesAttendanceIT() {
            $attendanceDisputes = "
                SELECT disputeID, employeeID, firstName, lastName,
                attendanceDate_timeIn, attendanceTime_timeIn,
                attendanceDate_timeOut, attendanceTime_timeOut, 
                remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeAttendance." AS disputeAttendance
                ON dispute.attendanceID = disputeAttendance.attendanceID
                INNER JOIN ".$this->employees." AS employee
                ON disputeAttendance.empID = employee.id
                WHERE dispute.status = 'Disapproved' AND
                employee.departmentID = 4 AND employee.designationID IN (10, 13, 19)";
            return $attendanceDisputes;
        }

        public function pendingDisputesLeaves() {
            $leavesDisputes = "
                SELECT disputeID, disputeLeaves.dateFiled, firstName, lastName,
                leaveType, startDate, endDate, remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeLeaves." AS disputeLeaves
                ON dispute.leaveID = disputeLeaves.leaveID
                INNER JOIN tbl_leavetype AS leaves
                ON disputeLeaves.leaveTypeID = leaves.leaveTypeID
                INNER JOIN ".$this->employees." AS employee
                ON disputeLeaves.empID = employee.id
                WHERE dispute.status = 'Pending'";
            return $leavesDisputes;
        }

        public function pendingDisputesLeavesOpsManager() {
            $leavesDisputes = "
                SELECT disputeID, disputeLeaves.dateFiled, firstName, lastName,
                leaveType, startDate, endDate, remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeLeaves." AS disputeLeaves
                ON dispute.leaveID = disputeLeaves.leaveID
                INNER JOIN tbl_leavetype AS leaves
                ON disputeLeaves.leaveTypeID = leaves.leaveTypeID
                INNER JOIN ".$this->employees." AS employee
                ON disputeLeaves.empID = employee.id
                WHERE dispute.status = 'Pending' AND
                employee.designationID IN (1,2,3,4,11,14)";
            return $leavesDisputes;
        }

        public function pendingDisputesLeavesOpsTL() {
            $leavesDisputes = "
                SELECT disputeID, disputeLeaves.dateFiled, firstName, lastName,
                leaveType, startDate, endDate, remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeLeaves." AS disputeLeaves
                ON dispute.leaveID = disputeLeaves.leaveID
                INNER JOIN tbl_leavetype AS leaves
                ON disputeLeaves.leaveTypeID = leaves.leaveTypeID
                INNER JOIN ".$this->employees." AS employee
                ON disputeLeaves.empID = employee.id
                WHERE dispute.status = 'Pending' AND 
                employee.departmentID = 1 AND employee.designationID IN (1,2,3,14)";
            return $leavesDisputes;
        }

        public function pendingDisputesLeavesIT() {
            $leavesDisputes = "
                SELECT disputeID, disputeLeaves.dateFiled, firstName, lastName,
                leaveType, startDate, endDate, remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeLeaves." AS disputeLeaves
                ON dispute.leaveID = disputeLeaves.leaveID
                INNER JOIN tbl_leavetype AS leaves
                ON disputeLeaves.leaveTypeID = leaves.leaveTypeID
                INNER JOIN ".$this->employees." AS employee
                ON disputeLeaves.empID = employee.id
                WHERE dispute.status = 'Pending' AND 
                employee.departmentID = 4 AND employee.designationID IN (10, 13, 19)";
            return $leavesDisputes;
        }

        public function approvedDisputesLeaves() {
            $pendingDisputes = "
                SELECT disputeID, disputeLeaves.dateFiled, firstName, lastName,
                leaveType, startDate, endDate, remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeLeaves." AS disputeLeaves
                ON dispute.leaveID = disputeLeaves.leaveID
                INNER JOIN tbl_leavetype AS leaves
                ON disputeLeaves.leaveTypeID = leaves.leaveTypeID
                INNER JOIN ".$this->employees." AS employee
                ON disputeLeaves.empID = employee.id
                WHERE dispute.status = 'Approved'";
            return $pendingDisputes;
        }

        public function approvedDisputesLeavesOpsManager() {
            $pendingDisputes = "
                SELECT disputeID, disputeLeaves.dateFiled, firstName, lastName,
                leaveType, startDate, endDate, remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeLeaves." AS disputeLeaves
                ON dispute.leaveID = disputeLeaves.leaveID
                INNER JOIN tbl_leavetype AS leaves
                ON disputeLeaves.leaveTypeID = leaves.leaveTypeID
                INNER JOIN ".$this->employees." AS employee
                ON disputeLeaves.empID = employee.id
                WHERE dispute.status = 'Approved' AND
                employee.designationID IN (1,2,3,4,11,14)";
            return $pendingDisputes;
        }

        public function approvedDisputesLeavesOpsTL() {
            $pendingDisputes = "
                SELECT disputeID, disputeLeaves.dateFiled, firstName, lastName,
                leaveType, startDate, endDate, remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeLeaves." AS disputeLeaves
                ON dispute.leaveID = disputeLeaves.leaveID
                INNER JOIN tbl_leavetype AS leaves
                ON disputeLeaves.leaveTypeID = leaves.leaveTypeID
                INNER JOIN ".$this->employees." AS employee
                ON disputeLeaves.empID = employee.id
                WHERE dispute.status = 'Approved' AND 
                employee.departmentID = 1 AND employee.designationID IN (1,2,3,14)";
            return $pendingDisputes;
        }

        public function approvedDisputesLeavesIT() {
            $pendingDisputes = "
                SELECT disputeID, disputeLeaves.dateFiled, firstName, lastName,
                leaveType, startDate, endDate, remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeLeaves." AS disputeLeaves
                ON dispute.leaveID = disputeLeaves.leaveID
                INNER JOIN tbl_leavetype AS leaves
                ON disputeLeaves.leaveTypeID = leaves.leaveTypeID
                INNER JOIN ".$this->employees." AS employee
                ON disputeLeaves.empID = employee.id
                WHERE dispute.status = 'Approved' AND 
                employee.departmentID = 4 AND employee.designationID IN (10, 13, 19)";
            return $pendingDisputes;
        }

        public function disapprovedDisputesLeaves() {
            $pendingDisputes = "
                SELECT disputeID, disputeLeaves.dateFiled, firstName, lastName,
                leaveType, startDate, endDate, remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeLeaves." AS disputeLeaves
                ON dispute.leaveID = disputeLeaves.leaveID
                INNER JOIN tbl_leavetype AS leaves
                ON disputeLeaves.leaveTypeID = leaves.leaveTypeID
                INNER JOIN ".$this->employees." AS employee
                ON disputeLeaves.empID = employee.id
                WHERE dispute.status = 'Disapproved'";
            return $pendingDisputes;
        }

        public function disapprovedDisputesLeavesOpsManager() {
            $pendingDisputes = "
                SELECT disputeID, disputeLeaves.dateFiled, firstName, lastName,
                leaveType, startDate, endDate, remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeLeaves." AS disputeLeaves
                ON dispute.leaveID = disputeLeaves.leaveID
                INNER JOIN tbl_leavetype AS leaves
                ON disputeLeaves.leaveTypeID = leaves.leaveTypeID
                INNER JOIN ".$this->employees." AS employee
                ON disputeLeaves.empID = employee.id
                WHERE dispute.status = 'Disapproved' AND
                employee.designationID IN (1,2,3,4,11,14)";
            return $pendingDisputes;
        }

        public function disapprovedDisputesLeavesOpsTL() {
            $pendingDisputes = "
                SELECT disputeID, disputeLeaves.dateFiled, firstName, lastName,
                leaveType, startDate, endDate, remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeLeaves." AS disputeLeaves
                ON dispute.leaveID = disputeLeaves.leaveID
                INNER JOIN tbl_leavetype AS leaves
                ON disputeLeaves.leaveTypeID = leaves.leaveTypeID
                INNER JOIN ".$this->employees." AS employee
                ON disputeLeaves.empID = employee.id
                WHERE dispute.status = 'Disapproved' AND 
                employee.departmentID = 1 AND employee.designationID IN (1,2,3,14)";
            return $pendingDisputes;
        }

        public function disapprovedDisputesLeavesIT() {
            $pendingDisputes = "
                SELECT disputeID, disputeLeaves.dateFiled, firstName, lastName,
                leaveType, startDate, endDate, remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeLeaves." AS disputeLeaves
                ON dispute.leaveID = disputeLeaves.leaveID
                INNER JOIN tbl_leavetype AS leaves
                ON disputeLeaves.leaveTypeID = leaves.leaveTypeID
                INNER JOIN ".$this->employees." AS employee
                ON disputeLeaves.empID = employee.id
                WHERE dispute.status = 'Disapproved' AND 
                employee.departmentID = 4 AND employee.designationID IN (10, 13, 19)";
            return $pendingDisputes;
        }

        public function pendingDisputesOvertime() {
            $overtimeDisputes = "
                SELECT disputeID, disputeOvertime.dateFiled, firstName, lastName,
                otDate, otType, remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeOvertime." AS disputeOvertime
                ON dispute.overtimeID = disputeOvertime.overtimeID
                INNER JOIN ".$this->employees." AS employee
                ON disputeOvertime.empID = employee.id
                WHERE dispute.status = 'Pending'";
            return $overtimeDisputes;
        }

        public function pendingDisputesOvertimeOpsManager() {
            $overtimeDisputes = "
                SELECT disputeID, disputeOvertime.dateFiled, firstName, lastName,
                otDate, otType, remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeOvertime." AS disputeOvertime
                ON dispute.overtimeID = disputeOvertime.overtimeID
                INNER JOIN ".$this->employees." AS employee
                ON disputeOvertime.empID = employee.id
                WHERE dispute.status = 'Pending' AND 
                employee.designationID IN (1,2,3,4,11,14)";
            return $overtimeDisputes;
        }

        public function pendingDisputesOvertimeOpsTL() {
            $overtimeDisputes = "
                SELECT disputeID, disputeOvertime.dateFiled, firstName, lastName,
                otDate, otType, remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeOvertime." AS disputeOvertime
                ON dispute.overtimeID = disputeOvertime.overtimeID
                INNER JOIN ".$this->employees." AS employee
                ON disputeOvertime.empID = employee.id
                WHERE dispute.status = 'Pending' AND 
                employee.departmentID = 1 AND employee.designationID IN (1,2,3,14)";
            return $overtimeDisputes;
        }

        public function pendingDisputesOvertimeIT() {
            $overtimeDisputes = "
                SELECT disputeID, disputeOvertime.dateFiled, firstName, lastName,
                otDate, otType, remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeOvertime." AS disputeOvertime
                ON dispute.overtimeID = disputeOvertime.overtimeID
                INNER JOIN ".$this->employees." AS employee
                ON disputeOvertime.empID = employee.id
                WHERE dispute.status = 'Pending' AND 
                employee.departmentID = 4 AND employee.designationID IN (10, 13, 19)";
            return $overtimeDisputes;
        }

        public function approvedDisputesOvertime() {
            $overtimeDisputes = "
                SELECT disputeID, disputeOvertime.dateFiled, firstName, lastName,
                otDate, otType, remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeOvertime." AS disputeOvertime
                ON dispute.overtimeID = disputeOvertime.overtimeID
                INNER JOIN ".$this->employees." AS employee
                ON disputeOvertime.empID = employee.id
                WHERE dispute.status = 'Approved'";
            return $overtimeDisputes;
        }

        public function approvedDisputesOvertimeOpsManager() {
            $overtimeDisputes = "
                SELECT disputeID, disputeOvertime.dateFiled, firstName, lastName,
                otDate, otType, remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeOvertime." AS disputeOvertime
                ON dispute.overtimeID = disputeOvertime.overtimeID
                INNER JOIN ".$this->employees." AS employee
                ON disputeOvertime.empID = employee.id
                WHERE dispute.status = 'Approved' AND 
                employee.designationID IN (1,2,3,4,11,14)";
            return $overtimeDisputes;
        }

        public function approvedDisputesOvertimeOpsTL() {
            $overtimeDisputes = "
                SELECT disputeID, disputeOvertime.dateFiled, firstName, lastName,
                otDate, otType, remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeOvertime." AS disputeOvertime
                ON dispute.overtimeID = disputeOvertime.overtimeID
                INNER JOIN ".$this->employees." AS employee
                ON disputeOvertime.empID = employee.id
                WHERE dispute.status = 'Approved' AND 
                employee.departmentID = 1 AND employee.designationID IN (1,2,3,14)";
            return $overtimeDisputes;
        }

        public function approvedDisputesOvertimeIT() {
            $overtimeDisputes = "
                SELECT disputeID, disputeOvertime.dateFiled, firstName, lastName,
                otDate, otType, remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeOvertime." AS disputeOvertime
                ON dispute.overtimeID = disputeOvertime.overtimeID
                INNER JOIN ".$this->employees." AS employee
                ON disputeOvertime.empID = employee.id
                WHERE dispute.status = 'Approved' AND 
                employee.departmentID = 4 AND employee.designationID IN (10, 13, 19)";
            return $overtimeDisputes;
        }

        public function disapprovedDisputesOvertime() {
            $overtimeDisputes = "
                SELECT disputeID, disputeOvertime.dateFiled, firstName, lastName,
                otDate, otType, remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeOvertime." AS disputeOvertime
                ON dispute.overtimeID = disputeOvertime.overtimeID
                INNER JOIN ".$this->employees." AS employee
                ON disputeOvertime.empID = employee.id
                WHERE dispute.status = 'Disapproved'";
            return $overtimeDisputes;
        }

        public function disapprovedDisputesOvertimeOpsManager() {
            $overtimeDisputes = "
                SELECT disputeID, disputeOvertime.dateFiled, firstName, lastName,
                otDate, otType, remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeOvertime." AS disputeOvertime
                ON dispute.overtimeID = disputeOvertime.overtimeID
                INNER JOIN ".$this->employees." AS employee
                ON disputeOvertime.empID = employee.id
                WHERE dispute.status = 'Disapproved' AND
                employee.designationID IN (1,2,3,4,11,14)";
            return $overtimeDisputes;
        }

        public function disapprovedDisputesOvertimeOpsTL() {
            $overtimeDisputes = "
                SELECT disputeID, disputeOvertime.dateFiled, firstName, lastName,
                otDate, otType, remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeOvertime." AS disputeOvertime
                ON dispute.overtimeID = disputeOvertime.overtimeID
                INNER JOIN ".$this->employees." AS employee
                ON disputeOvertime.empID = employee.id
                WHERE dispute.status = 'Disapproved' AND 
                employee.departmentID = 1 AND employee.designationID IN (1,2,3,14)";
            return $overtimeDisputes;
        }

        public function disapprovedDisputesOvertimeIT() {
            $overtimeDisputes = "
                SELECT disputeID, disputeOvertime.dateFiled, firstName, lastName,
                otDate, otType, remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeOvertime." AS disputeOvertime
                ON dispute.overtimeID = disputeOvertime.overtimeID
                INNER JOIN ".$this->employees." AS employee
                ON disputeOvertime.empID = employee.id
                WHERE dispute.status = 'Disapproved' AND 
                employee.departmentID = 4 AND employee.designationID IN (10, 13, 19)";
            return $overtimeDisputes;
        }

        public function fileAttendanceDispute($empID, $attendanceDate_timeIn, $attendanceTime_timeIn, $logTypeID_timeIn, $attendanceDate_timeOut, $attendanceTime_timeOut, $logTypeID_timeOut) {
            $fileAttendanceDispute = "
                INSERT INTO ".$this->disputeAttendance." (empID, dateFiled, attendanceDate_timeIn, attendanceTime_timeIn, logTypeID_timeIn, attendanceDate_timeOut, attendanceTime_timeOut, logTypeID_timeOut) 
                VALUES ('$empID', CURRENT_DATE(), '$attendanceDate_timeIn', '$attendanceTime_timeIn', '$logTypeID_timeIn', '$attendanceDate_timeOut', '$attendanceTime_timeOut', '$logTypeID_timeOut')";
            return $fileAttendanceDispute;
        }

        public function fileLeaveDispute($empID, $leaveTypeID, $startDate, $endDate, $attachment) {
            $fileLeaveDispute = "
                INSERT INTO ".$this->disputeLeaves." (empID, dateFiled, leaveTypeID, startDate, endDate, attachment) 
                VALUES ('$empID', CURRENT_DATE(), '$leaveTypeID', '$startDate', '$endDate', '$attachment')";
            return $fileLeaveDispute;
        }

        public function fileOvertimeDispute($empID, $otDate, $otType, $fromTime, $toTime) {
            $fileOvertimeDispute = "
                INSERT INTO ".$this->disputeOvertime." (empID, dateFiled, otDate, otType, fromTime, toTime) 
                VALUES ('$empID', CURRENT_DATE(), '$otDate', '$otType', '$fromTime', '$toTime')";
            return $fileOvertimeDispute;
        }

        public function viewLastDisputeID() {
            $lastID = "
                SELECT * FROM ".$this->disputes." ORDER BY disputeID DESC LIMIT 1";
            return $lastID;
        }

        public function viewLastDisputeAttendance() {
            $lastID = "
                SELECT * FROM ".$this->disputeAttendance." ORDER BY attendanceID DESC LIMIT 1";
            return $lastID;
        }

        public function viewLastDisputeLeave() {
            $lastID = "
                SELECT * FROM ".$this->disputeLeaves." ORDER BY leaveID DESC LIMIT 1";
            return $lastID;
        }

        public function viewLastDisputeOvertime() {
            $lastID = "
                SELECT * FROM ".$this->disputeOvertime." ORDER BY overtimeID DESC LIMIT 1";
            return $lastID;
        }

        public function addDispute_attendance($attendanceID, $remarks) {
            $fileDisputeAttendance = "
                INSERT INTO ".$this->disputes." (attendanceID, remarks, status)
                VALUES ('$attendanceID', '$remarks', 'Pending')";
            return $fileDisputeAttendance;
        }

        public function addDispute_leave($leaveID, $remarks) {
            $fileDisputeLeave = "
                INSERT INTO ".$this->disputes." (leaveID, remarks, status)
                VALUES ('$leaveID', '$remarks', 'Pending')";
            return $fileDisputeLeave;
        }

        public function addDispute_overtime($overtimeID, $remarks) {
            $fileDisputeOvertime = "
                INSERT INTO ".$this->disputes." (overtimeID, remarks, status)
                VALUES ('$overtimeID', '$remarks', 'Pending')";
            return $fileDisputeOvertime;
        }

        public function getDisputeInfo($disputeID) {
            $dispute = "
                SELECT * FROM ".$this->disputes." WHERE disputeID = '$disputeID'";
            return $dispute;
        }

        public function getAttendanceInfo($attendanceID) {
            $attendanceInfo = "
                SELECT disputeID, empID, employeeID, firstName, lastName,
                DATE_FORMAT(dateFiled, '%M %d, %Y') AS dateFiled,
                attendanceDate_timeIn AS date_timeIn, attendanceDate_timeOut AS date_timeOut,
                DATE_FORMAT(attendanceDate_timeIn, '%M %d, %Y') AS attendanceDate_timeIn,
                DATE_FORMAT(attendanceDate_timeOut, '%M %d, %Y') AS attendanceDate_timeOut,
                attendanceTime_timeIn, attendanceTime_timeOut, lateMins, undertimeMins,
                logTypeID_timeIn, logTypeID_timeOut, remarks, dispute.status
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeAttendance." AS disputeAttendance
                ON dispute.attendanceID = disputeAttendance.attendanceID
                INNER JOIN ".$this->employees." AS employee
                ON disputeAttendance.empID = employee.id
                WHERE dispute.attendanceID = '$attendanceID'";
            return $attendanceInfo;
        }

        public function getLeaveInfo($leaveID) {
            $leaveDispute = "
                SELECT disputeID, empID, employeeID, firstName, lastName,
                DATE_FORMAT(dateFiled, '%M %d, %Y') AS dateFiled,
                DATE_FORMAT(startDate, '%M %d, %Y') AS startDate,
                DATE_FORMAT(endDate, '%M %d, %Y') AS endDate,
                attachment, leaveType, disputeLeaves.leaveTypeID, remarks, 
                dispute.status, startDate AS effectivityStartDate, endDate AS effectivityEndDate
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeLeaves." AS disputeLeaves
                ON dispute.leaveID = disputeLeaves.leaveID
                INNER JOIN tbl_leavetype AS leaves
                ON disputeLeaves.leaveTypeID = leaves.leaveTypeID
                INNER JOIN ".$this->employees." AS employee
                ON disputeLeaves.empID = employee.id
                WHERE dispute.leaveID = '$leaveID'";
            return $leaveDispute;
        }

        public function getOvertimeInfo($overtimeID) {
            $overtimeDispute = "
                SELECT disputeID, empID, employeeID, firstName, lastName,
                DATE_FORMAT(dateFiled, '%M %d, %Y') AS dateFiled,
                DATE_FORMAT(otDate, '%M %d, %Y') AS otDate,
                otType, fromTime, toTime, remarks, dispute.status, 
                otDate AS overtimeDate, dateFiled AS filedDate
                FROM ".$this->disputes." AS dispute
                INNER JOIN ".$this->disputeOvertime." AS disputeOvertime
                ON dispute.overtimeID = disputeOvertime.overtimeID
                INNER JOIN ".$this->employees." AS employee
                ON disputeOvertime.empID = employee.id
                WHERE dispute.overtimeID = '$overtimeID'";
            return $overtimeDispute;
        }

        public function fileOT($employeeID, $dateFiled, $otDate, $otType, $fromTime, $toTime, $remarks, $status, $isPaid) {
            $fileOT = "
                INSERT INTO ".$this->filedOT." (empID, dateFiled, otDate, otType, fromTime, toTime, remarks, status, isPaid)
                VALUES ('$employeeID', '$dateFiled', '$otDate', '$otType', '$fromTime', '$toTime', '$remarks', '$status', '$isPaid')";
            return $fileOT;
        }

        public function fileLeaveWithAttachment($employeeID, $leaveTypeID, $effectivityStartDate, $effectivityEndDate, $remarks, $status, $attachment, $isPaid) {
            $fileLeave = "
                INSERT INTO ".$this->leaves." (empID, dateFiled, leaveTypeID, effectivityStartDate, effectivityEndDate, remarks, status, attachment, isPaid)
                VALUES ('$employeeID', CURRENT_TIMESTAMP, '$leaveTypeID', '$effectivityStartDate', '$effectivityEndDate', '$remarks', '$status', '$attachment', '$isPaid')";
            return $fileLeave;
        }

        public function fileLeave($employeeID, $leaveTypeID, $effectivityStartDate, $effectivityEndDate, $remarks, $status, $isPaid) {
            $fileLeave = "
                INSERT INTO ".$this->leaves." (empID, dateFiled, leaveTypeID, effectivityStartDate, effectivityEndDate, remarks, status, attachment, isPaid)
                VALUES ('$employeeID', CURRENT_TIMESTAMP, '$leaveTypeID', '$effectivityStartDate', '$effectivityEndDate', '$remarks', '$status', NULL, '$isPaid')";
            return $fileLeave;
        }

        public function updateDisputeStatus($disputeID, $status) {
            $updateDisputeStatus = "UPDATE ".$this->disputes." SET status = '$status' WHERE disputeID = '$disputeID'";
            return $updateDisputeStatus;
        }

        public function updateLeaveStatus($leaveID, $isPaid) {
            $updateLeaveStatus = "UPDATE ".$this->disputeLeaves." SET isPaid = '$isPaid' WHERE leaveID = '$leaveID'";
            return $updateLeaveStatus;
        }

        public function updateOvertimeStatus($overtimeID, $isPaid) {
            $updateOvertimeStatus = "UPDATE ".$this->disputeOvertime." SET isPaid = '$isPaid' WHERE overtimeID = '$overtimeID'";
            return $updateOvertimeStatus;
        }

        public function getCashAdvanceInfo($requestID) {
            $cashAdvance = "
                SELECT requestID, employees.employeeID, employees.firstName AS firstName, employees.lastName AS lastName, 
                requestor.firstName AS requestorFirstName, requestor.lastName AS requestorLastName,
                DATE_FORMAT(dateFiled, '%M %d, %Y') AS dateFiled, amount, remainingAmount,
                monthsToPay, monthlyAmmortization, empID, requestorID,
                DATE_FORMAT(cutoffStart, '%M %d, %Y') AS cutoffStart,
                ca_status, requestorID, request_status, payrollCutoffStart, payrollCutoffEnd
                FROM {$this->cashAdvance} AS cashAdvance
                INNER JOIN {$this->employees} AS employees
                ON cashAdvance.empID = employees.id
                INNER JOIN {$this->employees} AS requestor
                ON cashAdvance.requestorID = requestor.id
                WHERE requestID = '$requestID'";
            return $cashAdvance;
        }

        public function viewCABreakdown ($payrollcutoffStart, $payrollcutoffEnd) {
            $caBreakdown = "
                SELECT payrollCycleID, payrollCycleFrom, payrollCycleTo 
                FROM {$this->payrollCycle}
                WHERE payrollCycleID >= $payrollcutoffStart AND 
                payrollCycleID <= $payrollcutoffEnd";
            return $caBreakdown;
        }

        public function viewCAPaymentHistory($requestID) {
            $caPaymentHistory = "
                SELECT p.payrollCycleID FROM {$this->caPaymentHistory} AS cap
                INNER JOIN {$this->payroll} AS p
                ON cap.payrollID = p.payrollID
                WHERE requestID = $requestID";
            return $caPaymentHistory;
        }
        
        public function viewAllPayroll() {
            $payroll = "
                SELECT payrollID, payroll.payrollCycleID, 
                payrollCycleFrom, payrollCycleTo, status, dateCreated 
                FROM ".$this->payroll." AS payroll
                INNER JOIN ".$this->payrollCycle." AS payrollCycle
                ON payroll.payrollCycleID = payrollCycle.payrollCycleID";
            return $payroll;
        }

        public function createPayroll($payrollCycleID, $status) {
            $createPayroll = "
                INSERT INTO ".$this->payroll." (payrollCycleID, dateCreated, status)
                VALUES ('$payrollCycleID', CURRENT_TIMESTAMP(), '$status')";
            return $createPayroll;
        }

        public function viewAllPayrollCycle() {
            $payrollCycle = "
                SELECT * FROM ".$this->payrollCycle . " AS payrollCycle
                WHERE payrollCycleID NOT IN (SELECT payrollCycleID FROM ".$this->payroll." AS payroll)
                ORDER BY payrollCycle.payrollCycleID ASC";
            return $payrollCycle;
        }

        public function viewAvailablePayrollCycle() {
            $payrollCycle = "
                SELECT * FROM ".$this->payrollCycle . " AS payrollCycle
                ORDER BY payrollCycle.payrollCycleID ASC";
            return $payrollCycle;
        }

        public function viewPayrollCycle($payrollCycleID) {
            $viewPayrollCycle = "
                SELECT * FROM ".$this->payrollCycle."
                WHERE payrollCycleID = '$payrollCycleID'";
            return $viewPayrollCycle;
        }

        // OLD CODE
        // public function calculateNightDifferential($attendanceDateTime, $logTypeID, $lateMins, $payrollCycleFrom, $payrollCycleTo, $attendanceDate, $empID) {
        //     static $timeIn = null;
        //     static $timeOut = null;
        //     static $date_in = null;
        //     static $static_lateMins = null;

        //     $totalRegularNightHours = 0;
        //     $totalRegularHolidayHours = 0;
        //     $totalRegularHolidayNightHours = 0;
        //     $totalSpecialHolidayHours = 0;
        //     $totalSpecialHolidayNightHours = 0;

        //     $sch = $this->dbConnect()->query("
        //         SELECT startTime, endTime
        //         FROM tbl_employee INNER JOIN tbl_shiftschedule
        //         ON tbl_employee.shiftID = tbl_shiftschedule.shiftID
        //         WHERE tbl_employee.id = '$empID'
        //     ")->fetch_assoc();

        //     $shiftStartTime = $sch['startTime'];
        //     $shiftEndTime   = $sch['endTime']; 

        //     // TIME IN (logTypeID 1 or 2)
        //     if ($logTypeID == 1 || $logTypeID == 2) {
        //         // if ($logTypeID == 1){
        //         //     $timeIn = new DateTime($attendanceDate . ' ' . $shiftStartTime);
        //         // } 
        //         // else {
        //         //     $timeIn = new DateTime($attendanceDateTime);
        //         // }
        //         $timeIn = new DateTime($attendanceDate . ' ' . $shiftStartTime);
        //         $date_in = $attendanceDate;
        //         $static_lateMins = $lateMins;
        //     }

        //     // TIME OUT (logTypeID 3 or 4)
        //     if ($logTypeID == 3 || $logTypeID == 4) {
        //         // if ($logTypeID == 4) {
        //         //     $timeOut = new DateTime($attendanceDate . ' ' . $shiftEndTime);
        //         // }
        //         // else {
        //         //     $timeOut = new DateTime($attendanceDateTime);
        //         // }
        //         $timeOut = new DateTime($attendanceDate . ' ' . $shiftEndTime);
        //     }

        //     // Only compute when BOTH logs are captured
        //     if ($timeIn && $timeOut) {

        //         // Overnight adjustment
        //         if ($timeOut < $timeIn) {
        //             $timeOut->modify('+1 day');
        //         }

        //         // Deduct late
        //         $adjustedTimeIn = clone $timeIn;
        //         if ($static_lateMins > 0) {
        //             $adjustedTimeIn->modify("+{$static_lateMins} minutes");
        //         }

        //         // Do ND computation
        //         $this->calculateSegmentHours(clone $adjustedTimeIn, clone $timeOut, $payrollCycleFrom, $payrollCycleTo, $date_in, $empID, $totalRegularNightHours, $totalRegularHolidayHours, $totalRegularHolidayNightHours, $totalSpecialHolidayHours, $totalSpecialHolidayNightHours);

        //         // reset static variables for next IN/OUT pair
        //         $timeIn = null;
        //         $timeOut = null;
        //         $date_in = null;
        //         $static_lateMins = null;
        //     }

        //     return [
        //         'totalRegularNightHours' => $totalRegularNightHours,
        //         'totalRegularHolidayHours' => $totalRegularHolidayHours,
        //         'totalRegularHolidayNightHours' => $totalRegularHolidayNightHours,
        //         'totalSpecialHolidayHours' => $totalSpecialHolidayHours,
        //         'totalSpecialHolidayNightHours' => $totalSpecialHolidayNightHours
        //     ];
        // }

        // NEW CODE
        public function calculateNightDifferential($attendanceDateTime, $logTypeID, $lateMins, $payrollCycleFrom, $payrollCycleTo, $attendanceDate, $empID) {
            static $timeIn = null;
            static $timeOut = null;
            static $date_in = null;
            static $static_lateMins = null;
        
            $totalRegularNightHours = 0;
            $totalRegularHolidayHours = 0;
            $totalRegularHolidayNightHours = 0;
            $totalSpecialHolidayHours = 0;
            $totalSpecialHolidayNightHours = 0;

            $attendance = new DateTime($attendanceDateTime);
        
            // TIME IN
            if ($logTypeID == 1 || $logTypeID == 2) {
                $timeIn = clone $attendance;
                $date_in = $attendanceDate;
                $static_lateMins = $lateMins;
            }
        
            // TIME OUT
            if (($logTypeID == 3 || $logTypeID == 4) && $timeIn !== null) {
                $timeOut = clone $attendance;

                // Overnight fix
                if ($timeOut < $timeIn) {
                    $timeOut->modify('+1 day');
                }

                // FILTER:  ONLY COUNT SHIFTS WITHIN PAYROLL RANGE
                if ($date_in < $payrollCycleFrom || $date_in > $payrollCycleTo) {
                    $timeIn = null;
                    $date_in = null;
                }
        
                // Compute segments
                $this->calculateSegmentHours(
                    $payrollCycleFrom,
                    $payrollCycleTo,
                    $date_in,
                    $empID,
                    $totalRegularNightHours,
                    $totalRegularHolidayHours,
                    $totalRegularHolidayNightHours,
                    $totalSpecialHolidayHours,
                    $totalSpecialHolidayNightHours
                );
        
                // Reset
                $timeIn = null;
                $timeOut = null;
                $date_in = null;
                $static_lateMins = null;
            }    
            return [
                'totalRegularNightHours' => $totalRegularNightHours,
                'totalRegularHolidayHours' => $totalRegularHolidayHours,
                'totalRegularHolidayNightHours' => $totalRegularHolidayNightHours,
                'totalSpecialHolidayHours' => $totalSpecialHolidayHours,
                'totalSpecialHolidayNightHours' => $totalSpecialHolidayNightHours
            ];
        }

        // OLD CODE
        // private function calculateSegmentHours($start, $end, $payrollCycleFrom, $payrollCycleTo, $attendanceDate, $empID, &$totalRegularNightHours, &$totalRegularHolidayHours, &$totalRegularHolidayNightHours, &$totalSpecialHolidayHours, &$totalSpecialHolidayNightHours) {
        //     // -----------------------------
        //     // 1. LOAD HOLIDAYS (cached)
        //     // -----------------------------
        //     static $holidays = null;

        //     if ($holidays === null) {
        //         $holidays = [];
        //         $res = $this->dbConnect()->query("
        //             SELECT dateFrom, type 
        //             FROM tbl_holidays
        //             WHERE dateFrom BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo'
        //         ");
        //         while ($h = mysqli_fetch_assoc($res)) {
        //             $holidays[$h['dateFrom']] = $h['type']; // Legal or Special
        //         }
        //     }

        //     // -----------------------------
        //     // 2. GET SHIFT SCHEDULE
        //     // -----------------------------
        //     $sch = $this->dbConnect()->query("
        //         SELECT startTime, endTime
        //         FROM tbl_employee INNER JOIN tbl_shiftschedule
        //         ON tbl_employee.shiftID = tbl_shiftschedule.shiftID
        //         WHERE tbl_employee.id = '$empID'
        //     ")->fetch_assoc();

        //     $shiftStartTime = $sch['startTime'];
        //     $shiftEndTime   = $sch['endTime']; 

        //     // -----------------------------
        //     // 3. CREATE SHIFT BOUNDARIES
        //     // -----------------------------
        //     $scheduledStart = new DateTime($attendanceDate . " " . $shiftStartTime);
        //     $scheduledEnd   = new DateTime($attendanceDate . " " . $shiftEndTime);

        //     // Handle overnight shifts (example: 22:00 → 06:00 next day)
        //     if ($scheduledEnd <= $scheduledStart) {
        //         $scheduledEnd->modify("+1 day");
        //     }

        //     // -----------------------------
        //     // 4. CLAMP ACTUAL IN/OUT TO SHIFT
        //     // -----------------------------
        //     $clampedStart = max($start, $scheduledStart);
        //     $clampedEnd   = min($end, $scheduledEnd);

        //     // if ($clampedStart < $scheduledStart) {
        //     //     $clampedStart = clone $scheduledStart;
        //     // }
        //     // if ($clampedEnd > $scheduledEnd) {
        //     //     $clampedEnd = clone $scheduledEnd;
        //     // }

        //     // -----------------------------
        //     // 5. COMPUTE REGULAR HOURS (DROP MINUTES)
        //     // -----------------------------
        //     if ($clampedEnd > $clampedStart) {
        //         $interval = $clampedStart->diff($clampedEnd);
        //         $hoursWorked = $interval->h + ($interval->i / 60);

        //         // Holiday Check
        //         if (isset($holidays[$attendanceDate])) {
        //             if ($holidays[$attendanceDate] === "Legal") {
        //                 $totalRegularHolidayHours += $hoursWorked;
        //             } else {
        //                 $totalSpecialHolidayHours += $hoursWorked;
        //             }
        //         }
        //     }

        //     // ---------------------------------------------------
        //     // 6. NIGHT DIFFERENTIAL (22:00 → 06:00 actual values)
        //     // ---------------------------------------------------
        //     $nightStart = new DateTime($attendanceDate . " 22:00");
        //     $nightEnd   = new DateTime($attendanceDate . " 06:00");
        //     $nightEnd->modify("+1 day");

        //     // Compute overlap with ORIGINAL actual start/end (not clamped!)
        //     $effectiveStart = max($start, $nightStart);
        //     $effectiveEnd   = min($end, $nightEnd);

        //     if ($effectiveStart < $effectiveEnd) {
        //         $ndInterval = $effectiveStart->diff($effectiveEnd);
        //         $nightHours = $ndInterval->h + ($ndInterval->i / 60);

        //         if (isset($holidays[$attendanceDate])) {
        //             if ($holidays[$attendanceDate] === "Legal") {
        //                 $totalRegularHolidayNightHours += $nightHours;
        //             } else {
        //                 $totalSpecialHolidayNightHours += $nightHours;
        //             }
        //         } else {
        //             $totalRegularNightHours += $nightHours;
        //         }
        //     }
        // }

        // NEW CODE
        private function calculateSegmentHours($payrollCycleFrom, $payrollCycleTo, $attendanceDate, $empID, &$totalRegularNightHours, &$totalRegularHolidayHours, &$totalRegularHolidayNightHours, &$totalSpecialHolidayHours, &$totalSpecialHolidayNightHours) {
            // -----------------------------
            // 1. LOAD HOLIDAYS
            // -----------------------------
            static $holidays = null;

            if ($holidays === null) {
                $holidays = [];
                $res = $this->dbConnect()->query("
                    SELECT dateFrom, type 
                    FROM tbl_holidays
                    WHERE dateFrom BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo'
                ");
                while ($h = mysqli_fetch_assoc($res)) {
                    $holidays[$h['dateFrom']] = $h['type'];
                }
            }

            // -----------------------------
            // 2. SHIFT SCHEDULE
            // -----------------------------
            $sch = $this->dbConnect()->query("
                SELECT startTime, endTime
                FROM tbl_employee 
                INNER JOIN tbl_shiftschedule
                ON tbl_employee.shiftID = tbl_shiftschedule.shiftID
                WHERE tbl_employee.id = '$empID'
            ")->fetch_assoc();

            $scheduledStart = new DateTime($attendanceDate . " " . $sch['startTime']);
            $scheduledEnd   = new DateTime($attendanceDate . " " . $sch['endTime']);

            // Handle overnight shift
            if ($scheduledEnd <= $scheduledStart) {
                $scheduledEnd->modify("+1 day");
            }

            // Base + next date (BASED ON SHIFT, NOT attendanceDate blindly)
            $baseDate = $scheduledStart->format('Y-m-d');
            $nextDate = (clone $scheduledStart)->modify('+1 day')->format('Y-m-d');

            // -----------------------------
            // 3. DAY HOURS (06:00 → 22:00)
            // -----------------------------
            $dayStart = new DateTime($baseDate . " 06:00");
            $dayEnd   = new DateTime($baseDate . " 22:00");

            $daySegStart = max($scheduledStart, $dayStart);
            $daySegEnd   = min($scheduledEnd, $dayEnd);

            if ($daySegStart < $daySegEnd) {
                $interval = $daySegStart->diff($daySegEnd);
                $hours = $interval->h + ($interval->i / 60);

                // Break (12–1)
                $breakStart = new DateTime($baseDate . " 12:00");
                $breakEnd   = new DateTime($baseDate . " 13:00");

                $breakOverlapStart = max($daySegStart, $breakStart);
                $breakOverlapEnd   = min($daySegEnd, $breakEnd);

                if ($breakOverlapStart < $breakOverlapEnd) {
                    $intervalBreak = $breakOverlapStart->diff($breakOverlapEnd);
                    $breakHours = $intervalBreak->h + ($intervalBreak->i / 60);
                    $hours -= $breakHours;
                }

                if ($hours < 0) {
                    $hours = 0;
                }

                if (isset($holidays[$baseDate])) {
                    if ($holidays[$baseDate] === "Legal") {
                        $totalRegularHolidayHours += $hours;
                    } else {
                        $totalSpecialHolidayHours += $hours;
                    }
                }
            }

            // -----------------------------
            // 4. NEXT DAY DAY HOURS (if overnight)
            // -----------------------------
            if ($scheduledEnd->format('Y-m-d') !== $baseDate) {
                $nextDayStart = new DateTime($nextDate . " 06:00");
                $nextDayEnd   = new DateTime($nextDate . " 22:00");

                $nextSegStart = max($scheduledStart, $nextDayStart);
                $nextSegEnd   = min($scheduledEnd, $nextDayEnd);

                if ($nextSegStart < $nextSegEnd) {
                    $interval = $nextSegStart->diff($nextSegEnd);
                    $hours = $interval->h + ($interval->i / 60);

                    if (isset($holidays[$nextDate])) {
                        if ($holidays[$nextDate] === "Legal") {
                            $totalRegularHolidayHours += $hours;
                        } else {
                            $totalSpecialHolidayHours += $hours;
                        }
                    }
                }
            }

            // =====================================================
            // 5. NIGHT DIFFERENTIAL
            // =====================================================
            // Segment 1: 22:00 → 00:00 (always base date)
            $nightStart1 = new DateTime($baseDate . " 22:00");
            $nightEnd1   = new DateTime($nextDate . " 00:00");

            $seg1Start = max($scheduledStart, $nightStart1);
            $seg1End   = min($scheduledEnd, $nightEnd1);

            if ($seg1Start < $seg1End) {
                $interval = $seg1Start->diff($seg1End);
                $hours = $interval->h + ($interval->i / 60);

                if (isset($holidays[$baseDate])) {
                    if ($holidays[$baseDate] === "Legal") {
                        $totalRegularHolidayNightHours += $hours;
                    } else {
                        $totalSpecialHolidayNightHours += $hours;
                    }
                } else {
                    $totalRegularNightHours += $hours;
                }
            }

            // Segment 2: 00:00 → 06:00 (DYNAMIC DATE FIX)
            $isBreak = false;
            if ($scheduledEnd->format('Y-m-d') !== $baseDate) {
                // Overnight shift → next day
                $nightStart2 = new DateTime($nextDate . " 00:00");
                $nightEnd2   = new DateTime($nextDate . " 06:00");
                $isBreak = true;
                $holidayCheckDate = $nextDate;
            } else {
                // Same-day shift (e.g., 5AM–2PM)
                $nightStart2 = new DateTime($baseDate . " 00:00");
                $nightEnd2   = new DateTime($baseDate . " 06:00");
                $holidayCheckDate = $baseDate;
                $isBreak = false;
            }

            $seg2Start = max($scheduledStart, $nightStart2);
            $seg2End   = min($scheduledEnd, $nightEnd2);

            if ($seg2Start < $seg2End) {
                $interval = $seg2Start->diff($seg2End);
                $hours = $interval->h + ($interval->i / 60);

                // Safe break deduction
                if ($isBreak) {
                    $hours = max(0, $hours - 1);
                }

                if (isset($holidays[$holidayCheckDate])) {
                    if ($holidays[$holidayCheckDate] === "Legal") {
                        $totalRegularHolidayNightHours += $hours;
                    } else {
                        $totalSpecialHolidayNightHours += $hours;
                    }
                } else {
                    $totalRegularNightHours += $hours;
                }
            }
        }
        
        public function calculateOvertimeND($fromTime, $toTime) {
            $nightStart = new DateTime("22:00");
            $nightEnd = (new DateTime("06:00"))->modify('+1 day'); // Extend to the next day
        
            $totalOvertimeHours = 0;
            $totalOvertimeNDHours = 0;
        
            // Calculate total overtime hours
            $interval = $fromTime->diff($toTime);
            $totalOvertimeHours = $interval->h + ($interval->i >= 30 ? 1 : 0);
        
            // Check for overlap with the night differential period
            if ($toTime > $nightStart || $fromTime < $nightEnd) {
                $ndStart = ($fromTime > $nightStart) ? $fromTime : $nightStart; // Start within night diff
                $ndEnd = ($toTime < $nightEnd) ? $toTime : $nightEnd;           // End within night diff
        
                if ($ndStart < $ndEnd) { // Ensure there is an overlap
                    $ndInterval = $ndStart->diff($ndEnd);
                    $totalOvertimeNDHours = $ndInterval->h + ($ndInterval->i >= 30 ? 1 : 0);
                }
            }
        
            return [
                'totalOvertimeHours' => $totalOvertimeHours,
                'totalOvertimeNDHours' => $totalOvertimeNDHours
            ];
        }

        public function getCutOffAbsences($id, $cutOffStart, $cutOffEnd) {
            $cutOffAbsences = "
                WITH RECURSIVE calendar_days AS (
                    SELECT DATE('$cutOffStart') AS date_day
                    UNION ALL
                    SELECT DATE_ADD(date_day, INTERVAL 1 DAY)
                    FROM calendar_days
                    WHERE date_day < DATE('$cutOffEnd')
                )

                SELECT COUNT(*) AS total_absences
                FROM calendar_days cd

                LEFT JOIN {$this->attendance} AS att
                    ON att.empID = $id
                    AND att.attendanceDate = cd.date_day
                    AND att.logTypeID IN (1, 2)   -- Time In or Late

                LEFT JOIN {$this->leaves} AS leaves
                    ON leaves.empID = $id
                    AND leaves.status = 'Approved'
                    AND cd.date_day BETWEEN leaves.effectivityStartDate AND leaves.effectivityEndDate

                LEFT JOIN {$this->weekOff} AS weekoff
                    ON weekoff.empID = $id

                WHERE 
                    att.empID IS NULL             -- No attendance = absent
                    AND leaves.empID IS NULL      -- Not on approved leave
                    AND (
                        CASE DAYNAME(cd.date_day)
                            WHEN 'Monday' THEN weekoff.wo_mon
                            WHEN 'Tuesday' THEN weekoff.wo_tue
                            WHEN 'Wednesday' THEN weekoff.wo_wed
                            WHEN 'Thursday' THEN weekoff.wo_thu
                            WHEN 'Friday' THEN weekoff.wo_fri
                            WHEN 'Saturday' THEN weekoff.wo_sat
                            WHEN 'Sunday' THEN weekoff.wo_sun
                        END
                    ) = 0                          -- Not a week-off
            ";
            return $cutOffAbsences;
        }

        public function getLeavesForPayroll($empID, $from, $to): string {
            return "
                SELECT la.empID, lt.leaveTypeID
                FROM tbl_leaveapplications la
                INNER JOIN tbl_leavetype lt 
                    ON la.leaveTypeID = lt.leaveTypeID
                WHERE la.empID = $empID
                AND la.status = 'Approved'
                AND la.effectivityStartDate <= '$to'
                AND la.effectivityEndDate   >= '$from'
                AND la.dateFiled BETWEEN '$from' AND '$to'
            ";
        }

        public function getLateFiledLeaves($empID, $from, $to) {
            return "
                SELECT 
                    la.empID,
                    lt.leaveTypeID
                FROM tbl_leaveapplications la
                INNER JOIN tbl_leavetype lt 
                    ON la.leaveTypeID = lt.leaveTypeID
                WHERE la.empID = $empID
                AND la.status = 'Approved'
                AND la.effectivityStartDate < '$from'
                AND la.dateFiled BETWEEN '$from' AND '$to';

            ";
        }

        public function calculatePayroll($payrollID, $payrollCycleID) {
            function formatDate($date) {
                // GET CURRENT YEAR
                $currentYear = date('Y');

                // APPEND THE CURRENT YEAR TO THE INPUT DATE
                $dateWithYear = $date . '-' . $currentYear;

                // CREATE DATETIME OBJECT FROM THE STRING AND RETURN THE FORMATTED DATE
                $dateTime = DateTime::createFromFormat('m-d-Y', $dateWithYear);

                return $dateTime->format('Y-m-d');
            }

            // GET PAYROLL CYCLE DETAILS
            $payrollCycleFrom_date = $this->dbConnect()->query("SELECT * FROM tbl_payrollcycle WHERE payrollCycleID = $payrollCycleID")->fetch_assoc()['payrollCycleFrom'];
            $payrollCycleTo_date = $this->dbConnect()->query("SELECT * FROM tbl_payrollcycle WHERE payrollCycleID = $payrollCycleID")->fetch_assoc()['payrollCycleTo'];
            $payrollCycleFrom = formatDate($payrollCycleFrom_date);
            $payrollCycleTo = formatDate($payrollCycleTo_date);

            $counter = 0;

            // GET EMPLOYEE DETAILS
            $employees = $this->dbConnect()->query("SELECT * FROM tbl_employee WHERE designationID != 12 AND e_status = 'Active' ORDER BY lastName");
            while ($employeeDetails = mysqli_fetch_array($employees)) {
                $employee_id = $employeeDetails['id'];
                $employee_basicPay = $employeeDetails['basicPay'];
                $employee_dailyRate = $employeeDetails['dailyRate'];
                $employee_hourlyRate = $employeeDetails['hourlyRate'];
                $employeee_department = $employeeDetails['departmentID'];

                // COMPUTE DAYS WORKED
                $daysWorkedQuery = $this->dbConnect()->query("SELECT * FROM tbl_attendance WHERE empID = $employeeDetails[id] AND (logTypeID IN (1, 2)) AND attendanceDate BETWEEN DATE(CONCAT(YEAR(CURDATE()), '-', MONTH('$payrollCycleFrom'), '-', DAY('$payrollCycleFrom'))) AND DATE(CONCAT(YEAR(CURDATE()), '-', MONTH('$payrollCycleTo'), '-', DAY('$payrollCycleTo')))");
                $employee_daysWorked = mysqli_num_rows($daysWorkedQuery);

                // CHECK FOR HOLIDAYS
                $holidaysQuery = $this->dbConnect()->query("SELECT * FROM tbl_holidays WHERE dateFrom BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo'");
                $holidays = [];
                while ($holidayDetails = mysqli_fetch_array($holidaysQuery)) {
                    $holidays[$holidayDetails['dateFrom']] = $holidayDetails['type'];
                }

                // INITIALIZE VARIABLES FOR HOURS WORKED COMPUTATION
                $totalOvertimeHours = 0;
                $totalRDOTHours = 0;
                $totalRDOTOTHours = 0;

                $totalSpecialHolidayHours = 0;
                $totalSpecialHolidayOTHours = 0;
                $totalSpecialHolidayRDOTHours = 0;
                $totalSpecialHolidayRDOTOTHours = 0;

                $totalRegularHolidayHours = 0;
                $totalRegularHolidayOTHours = 0;
                $totalRegularHolidayRDOTHours = 0;
                $totalRegularHolidayRDOTOTHours = 0;


                $totalNightHours = 0;
                $totalOvertimeNDHours = 0;
                $totalRDOTNDhours = 0;
                $totalRDOTOTNDHours = 0;

                $totalSpecialHolidayNDHours = 0;
                $totalSpecialHolidayOTNDHours = 0;
                $totalSpecialHolidayRDOTNDHours = 0;
                $totalSpecialHolidayRDOTOTNDHours = 0;

                $totalRegularHolidayNDHours = 0;
                $totalRegularHolidayOTNDHours = 0;
                $totalRegularHolidayRDOTNDHours = 0;
                $totalRegularHolidayRDOTOTNDHours = 0;


                // INITIALIZE VARILABLES FOR PAY COMPUTATIONS
                $overtimePay = 0;
                $RDOTPay = 0;
                $RDOTOTPay = 0;

                $specialHolidayPay = 0;
                $specialHolidayOTPay = 0;
                $specialHolidayRDOTPay = 0;
                $specialHolidayRDOTOTPay = 0;

                $regularHolidayPay = 0;
                $regularHolidayOTPay = 0;
                $regularHolidayRDOTPay = 0;
                $regularHolidayRDOTOTPay = 0;

                
                $nightDiffPay = 0;
                $overtimeNDPay = 0;
                $RDOTNDPay = 0;
                $RDOTOTNDPay = 0;

                $specialHolidayNDPay = 0;
                $specialHolidayOTNDPay = 0;
                $specialHolidayRDOTNDPay = 0;
                $specialHolidayRDOTOTNDPay = 0;

                $regularHolidayNDPay = 0;
                $regularHolidayOTNDPay = 0;
                $regularHolidayRDOTNDPay = 0;
                $regularHolidayRDOTOTNDPay = 0;

                // INITIALIZE VARIABLES FOR DAYS WORKED (HOLIDAYS) COMPUTATION
                $specialHolidaysWorked = 0;
                $regularHolidaysWorked = 0;

                // ALLOWANCES, DEDUCTIONS, REIMBURSEMENTS, AND ADJUSTMENTS (+, -) COMPUTATION
                $sss = 0;
                $sssmpf = 0;
                $phic = 0;
                $hdmf = 0;  
                
                $salaryLoan = 0;
                $hdmfSalaryLoan = 0;
                // $hdmfLoan = 0;
                $smart = 0;

                // CASH ADVANCE
                $requestID = 0;
                $cashAdvance = 0;
                $remainingAmount = 0;
                $remainingBalance = 0;
                $ca_status = "";

                $totalAllowances = 0;
                $communication = 0;
                $totalReimbursements = 0;
                $totalAdjustments = 0;

                // INITIALIZE VARIABLES FOR LEAVE COMPUTATION
                $totalSickLeaves = 0;
                $totalVacationLeaves = 0;
                $sickLeavePay = 0;
                $vacationLeavePay = 0;

                // INITIALIZE VARIABLES FOR REFERRAL INCENTIVE COMPUTATION
                $referralCount = 0;
                $referralIncentivePay = 0;

                // INITIALIZE VARIABLES FOR LATE MINS AND ABSENCES COMPUTATION
                $totalAbsences = 0;
                $absencesAmt = 0;
                $totalLateMins = 0;
                $lateMinsAmt = 0;

                // INITIALIZE VARIABLES FOR PAYROLL COMPUTATION
                $basePay = 0;
                $grossPay = 0;
                $netPay = 0;

                // NEW CODE
                // $attendanceQuery = $this->dbConnect()->query("
                //     SELECT *
                //     FROM tbl_attendance
                //     WHERE empID = {$employeeDetails['id']}
                //     AND logTypeID IN (1,2,3,4)
                //     AND attendanceDate BETWEEN 
                //         DATE(CONCAT(YEAR(CURDATE()), '-', MONTH('$payrollCycleFrom'), '-', DAY('$payrollCycleFrom')))
                //         AND
                //         DATE(CONCAT(YEAR(CURDATE()), '-', MONTH('$payrollCycleTo'), '-', DAY('$payrollCycleT')))
                //     ORDER BY attendanceDate ASC, attendanceTime ASC
                // ");
                $extendedTo = date('Y-m-d', strtotime($payrollCycleTo . ' +1 day'));
                $attendanceQuery = $this->dbConnect()->query("
                    SELECT *
                    FROM tbl_attendance
                    WHERE empID = {$employeeDetails['id']}
                    AND logTypeID IN (1,2,3,4)
                    AND attendanceDate BETWEEN '$payrollCycleFrom' AND '$extendedTo'
                    ORDER BY attendanceDate ASC, attendanceTime ASC
                ");
                while ($attendanceLogs = mysqli_fetch_array($attendanceQuery)) {
                    // FULL DATETIME
                    $attendanceDate = $attendanceLogs['attendanceDate'];
                    $attendanceTime = $attendanceLogs['attendanceTime'];
                    $fullDateTime = $attendanceDate . ' ' . $attendanceTime;

                    $logTypeID = $attendanceLogs['logTypeID'];
                    $lateMins = $attendanceLogs['lateMins'];
                    $totalLateMins += $lateMins;

                    $result = $this->calculateNightDifferential(
                        $fullDateTime,
                        $logTypeID,
                        $lateMins,
                        $payrollCycleFrom,
                        $payrollCycleTo,
                        $attendanceDate,
                        $employee_id
                    );

                    $totalNightHours += $result['totalRegularNightHours'];
                    $totalRegularHolidayHours += $result['totalRegularHolidayHours'];
                    $totalRegularHolidayNDHours += $result['totalRegularHolidayNightHours'];
                    $totalSpecialHolidayHours += $result['totalSpecialHolidayHours'];
                    $totalSpecialHolidayNDHours += $result['totalSpecialHolidayNightHours'];
                }


                // COMPUTE OVERTIME HOURS
                $overtimeQuery = $this->dbConnect()->query(("SELECT * FROM tbl_filedot WHERE empID = $employee_id AND (otDate BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo') AND status = '1'"));
                while ($overtime = mysqli_fetch_array($overtimeQuery)) {
                    if (isset($holidays[$overtime['otDate']])) {
                        // REGULAR HOLIDAY
                        if ($holidays[$overtime['otDate']] == "Legal") {
                            // REGULAR OVERTIME
                            if ($overtime['otType'] == "Regular") {
                                $from = new DateTime($overtime['fromTime']);
                                $to = new DateTime($overtime['toTime']);

                                $result = $this->calculateOvertimeND($from, $time);
                                $totalRegularHolidayOTHours += $result['totalOvertimeHours'];
                                $totalRegularHolidayOTNDHours += $result['totalOvertimeNDHours'];
                            }
                            // REST DAY
                            else if ($overtime['otType'] == "Rest Day") {
                                $from = new DateTime($overtime['fromTime']);
                                $to = new DateTime($overtime['toTime']);
                                $to->modify(('-1 hour'));

                                $result = $this->calculateOvertimeND($from, $to);
                                $totalRegularHolidayRDOTHours += $result['totalOvertimeHours'];
                                $totalRegularHolidayRDOTNDHours += $result['totalOvertimeNDHours'];
                            }
                            // REST DAY, OVERTIME
                            else {
                                $from = new DateTime($overtime['fromTime']);
                                $to = new DateTime($overtime['toTime']);

                                $result = $this->calculateOvertimeND($from, $to);
                                $totalRegularHolidayRDOTOTHours += $result['totalOvertimeHours'];
                                $totalRegularHolidayRDOTOTNDHours += $result['totalOvertimeNDHours'];
                            }
                        }
                        // SPECIAL HOLIDAY
                        else if ($holidays[$overtime['otDate']] == "Special") {
                            // REGULAR OVERTIME
                            if ($overtime['otType'] == "Regular") {
                                $from = new DateTime($overtime['fromTime']);
                                $to = new DateTime($overtime['toTime']);

                                $result = $this->calculateOvertimeND($from, $to);
                                $totalSpecialHolidayOTHours += $result['totalOvertimeHours'];
                                $totalSpecialHolidayOTNDHours += $result['totalOvertimeNDHours'];
                            }
                            // REST DAY
                            else if ($overtime['otType'] == "Rest Day") {
                                $from = new DateTime($overtime['fromTime']);
                                $to = new DateTime($overtime['toTime']);
                                $to->modify('-1 hour');

                                $result = $this->calculateOvertimeND($from, $to);
                                $totalSpecialHolidayRDOTHours += $result['totalOvertimeHours'];
                                $totalSpecialHolidayRDOTNDHours += $result['totalOvertimeNDHours'];
                            }
                            // REST DAY, OVERTIME
                            else {
                                $from = new DateTime($overtime['fromTime']);
                                $to = new DateTime($overtime['toTime']);

                                $result = $this->calculateOvertimeND($from, $to);
                                $totalSpecialHolidayRDOTOTHours += $result['totalOvertimeHours'];
                                $totalSpecialHolidayRDOTOTNDHours += $result['totalOvertimeNDHours'];
                            }
                        }
                    }
                    else {
                        // REGULAR OVERTIME
                        if ($overtime['otType'] == "Regular") {
                            $from = new DateTime($overtime['fromTime']);
                            $to = new DateTime($overtime['toTime']);

                            $result = $this->calculateOvertimeND($from, $to);
                            $totalOvertimeHours += $result['totalOvertimeHours'];
                            $totalOvertimeNDHours += $result['totalOvertimeNDHours'];
                        }
                        // REST DAY
                        else if ($overtime['otType'] == "Rest Day") {
                            $from = new DateTime($overtime['fromTime']);
                            $to = new DateTime($overtime['toTime']);
                            $to->modify('-1 hour');

                            $result = $this->calculateOvertimeND($from, $to);
                            $totalRDOTHours += $result['totalOvertimeHours'];
                            $totalRDOTNDhours += $result['totalOvertimeNDHours'];
                        }
                        // REST DAY, OVERTIME
                        else {
                            $from = new DateTime($overtime['fromTime']);
                            $to = new DateTime($overtime['toTime']);

                            $result = $this->calculateOvertimeND($from, $to);
                            $totalRDOTOTHours += $result['totalOvertimeHours'];
                            $totalRDOTOTNDHours += $result['totalOvertimeNDHours'];
                        }
                    }
                }

                // COMPUTATION FOR ALLOWANCES
                $allowancesQuery = $this->dbConnect()->query("SELECT amount, type FROM tbl_empallowances INNER JOIN tbl_allowances ON tbl_empallowances.allowanceID = tbl_allowances.allowanceID WHERE empID = $employee_id AND allowanceName NOT IN ('Communication', 'Communication Allowance')");
                while ($allowanceDetails = mysqli_fetch_array($allowancesQuery)) {
                    if ($allowanceDetails['type'] == 1 && $payrollCycleID % 2 == 0) { // MONTHLY
                        $totalAllowances += $allowanceDetails['amount'];
                    } elseif ($allowanceDetails['type'] == 2) { // SEMI-MONTHLY
                        $totalAllowances += ($allowanceDetails['amount'] / 2);
                    }
                }

                // COMPUTATION FOR COMMUNICATION ALLOWANCE
                $allowancesQuery = $this->dbConnect()->query("SELECT amount, type FROM tbl_empallowances INNER JOIN tbl_allowances ON tbl_empallowances.allowanceID = tbl_allowances.allowanceID WHERE empID = $employee_id AND allowanceName IN ('Communication', 'Communication Allowance')");
                while ($allowanceDetails = mysqli_fetch_array($allowancesQuery)) {
                    if ($allowanceDetails['type'] == 1 && $payrollCycleID % 2 == 0) { // MONTHLY
                        $communication += $allowanceDetails['amount'];
                    } elseif ($allowanceDetails['type'] == 2) { // SEMI-MONTHLY
                        $communication += ($allowanceDetails['amount'] / 2);
                    }
                }

                // COMPUTATION FOR DEDUCTIONS
                $deductionsQuery = $this->dbConnect()->query("SELECT amount, deductionName, type, payrollCycleID FROM tbl_empdeductions INNER JOIN tbl_deductions ON tbl_empdeductions.deductionID = tbl_deductions.deductionID WHERE empID = $employee_id");
                while ($deductionDetails = mysqli_fetch_array($deductionsQuery)) {
                    if ($deductionDetails['deductionName'] == "SSS") {
                        $sss = $deductionDetails['amount'] / 2;
                    }
                    else if ($deductionDetails['deductionName'] == "SSS MPF") {
                        $sssmpf = $deductionDetails['amount'] / 2;
                    }
                    else if ($deductionDetails['deductionName'] == "PhilHealth") {
                        $phic = $deductionDetails['amount'] / 2;
                    }
                    else if ($deductionDetails['deductionName'] == "HDMF") {
                        $hdmf = $deductionDetails['amount'] / 2;
                    }
                    else if ($deductionDetails['deductionName'] == "SSS Salary Loan") {
                        $salaryLoan = $deductionDetails['amount'];
                    }
                    else if ($deductionDetails['deductionName'] == "HDMF Salary Loan") {
                        $hdmfSalaryLoan = $deductionDetails['amount'];
                    }
                    // else if ($deductionDetails['deductionName'] == "HDMF Loan") {
                    //     $hdmfLoan = $deductionDetails['amount'];
                    // }
                    else if ($deductionDetails['deductionName'] == "Smart Communication") {
                        $smart = $deductionDetails['amount'];
                    }
                }

                // COMPUTATION FOR CASH ADVANCES
                $cashAdvanceQuery = $this->dbConnect()->query("SELECT * FROM tbl_cashAdvance ca WHERE ca.empID = $employee_id AND ca.request_status = 'Approved' AND ((ca.ca_status = 'New' AND ca.payrollCutoffStart <= $payrollCycleFrom) OR (ca.ca_status = 'Ongoing'))");
                while ($cashAdvanceDetails = mysqli_fetch_array($cashAdvanceQuery)) {
                    $requestID = $cashAdvanceDetails['requestID'];
                    $cashAdvance = $cashAdvanceDetails['monthlyAmmortization'];
                    $remainingAmount = $cashAdvanceDetails['remainingAmount'];
                    $ca_status = $cashAdvanceDetails['ca_status'];
                }

                // COMPUTATION FOR REIMBURSEMENTS
                $reimbursementsQuery = $this->dbConnect()->query("SELECT amount, type, payrollCycleID FROM tbl_empreimbursements INNER JOIN tbl_reimbursements ON tbl_empreimbursements.reimbursementID = tbl_reimbursements.reimbursementID WHERE empID = $employee_id");
                while ($reimbursementDetails = mysqli_fetch_array($reimbursementsQuery)) {
                    if ($reimbursementDetails['type'] == 1 && $payrollCycleID % 2 == 0) { // MONTHLY
                        $totalReimbursements += $reimbursementDetails['amount'];
                    } elseif ($reimbursementDetails['type'] == 2) { // SEMI-MONTHLY
                        $totalReimbursements += ($reimbursementDetails['amount'] / 2);
                    } elseif ($reimbursementDetails['type'] == 3 && $reimbursementDetails['payrollCycleID'] == $payrollCycleID) { // ONCE
                        $totalReimbursements += $reimbursementDetails['amount'];
                    }
                }

                // COMPUTATION FOR ADJUSTMENTS
                $adjustmentsQuery = $this->dbConnect()->query("SELECT amount, type, payrollCycleID, adjustmentType FROM tbL_empadjustments INNER JOIN tbl_adjustments ON tbL_empadjustments.adjustmentID = tbl_adjustments.adjustmentID WHERE empID = $employee_id");
                while ($adjustmentDetails = mysqli_fetch_array($adjustmentsQuery)) {
                    if ($adjustmentDetails['type'] == 1 && $payrollCycleID % 2 == 1) { // MONTHLY
                        if ($adjustmentDetails['adjustmentType'] == "Add") {
                            $totalAdjustments += $adjustmentDetails['amount'];
                        }
                        else {
                            $totalAdjustments -= $adjustmentDetails['amount'];
                        }
                    } elseif ($adjustmentDetails['type'] == 2) { // SEMI-MONTHLY
                        if ($adjustmentDetails['adjustmentType'] == "Add") {
                            $totalAdjustments += $adjustmentDetails['amount'];
                        }
                        else {
                            $totalAdjustments -= $adjustmentDetails['amount'];
                        }
                    } elseif ($adjustmentDetails['type'] == 3 && $adjustmentDetails['payrollCycleID'] == $payrollCycleID) { // ONCE
                        if ($adjustmentDetails['adjustmentType'] == "Add") {
                            $totalAdjustments += $adjustmentDetails['amount'];
                        }
                        else {
                            $totalAdjustments -= $adjustmentDetails['amount'];
                        }
                    }
                }

                // COMPUTATION FOR LEAVES
                // $leaveQuery = $this->dbConnect()->query("SELECT empID, lt.leaveTypeID, effectivityStartDate, effectivityEndDate FROM tbl_leaveapplications AS la INNER JOIN tbl_leavetype AS lt ON la.leaveTypeID = lt.leaveTypeID WHERE effectivityStartDate BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo' AND effectivityEndDate BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo' AND status = 'Approved' AND empID=$employee_id");
                $sql = $this->getLeavesForPayroll($employee_id, $payrollCycleFrom, $payrollCycleTo);
                $leaveQuery = $this->dbConnect()->query($sql);
                while ($leaveDetails = mysqli_fetch_array($leaveQuery)) {
                    if ($leaveDetails['leaveTypeID'] == 1) {
                        $totalSickLeaves++;
                    }
                    else if ($leaveDetails['leaveTypeID'] == 2) {
                        $totalVacationLeaves++;
                    }
                }
                $lateFiledLeavesQuery = $this->getLateFiledLeaves($employee_id, $payrollCycleFrom, $payrollCycleTo);
                $lateFiledLeaveQuery = $this->dbConnect()->query($lateFiledLeavesQuery);
                while ($lateFLDetails = mysqli_fetch_array($lateFiledLeaveQuery)) {
                    if ($lateFLDetails['leaveTypeID'] == 1) {
                        $totalSickLeaves++;
                    }
                    else if ($lateFLDetails['leaveTypeID'] == 2) {
                        $totalVacationLeaves++;
                    }
                }
                $sickLeavePay = round($totalSickLeaves * $employee_dailyRate, 2);
                $vacationLeavePay = round($totalVacationLeaves * $employee_dailyRate, 2);

                // COMPUTATION FOR REFERRAL INCENTIVE
                $referralQuery = $this->dbConnect()->query("SELECT * FROM tbl_referral WHERE referrer_empID = $employee_id AND ((threeMonths BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo' AND threeMonths_status = 0) OR (sixMonths BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo' AND sixMonths_status = 0))");
                while ($referralDetails = mysqli_fetch_array($referralQuery)) {
                    $referralCount++;
                }
                $referralIncentivePay = round($referralCount * 2500, 2);

                //COMPUTATION FOR NIGHT DIFFERENTIAL PAY
                $totalNightHours = round($totalNightHours, 0);
                $nightDiffPay = round(($employee_hourlyRate * .15) * $totalNightHours, 2);

                // COMPUTATION FOR OVERTIME PAY
                $overtimePay = round(($employee_hourlyRate * .25) * $totalOvertimeHours, 2);
                $overtimeNDPay = round((($employee_hourlyRate * 1.25) * 15) * $totalOvertimeNDHours, 2);

                // COMPUTATION FOR REST DAY PAY
                $RDOTPay = round(($employee_hourlyRate * .3) * $totalRDOTHours, 2);
                $RDOTNDPay = round((($employee_hourlyRate * 1.3) * .15) * $totalRDOTNDhours, 2);

                // COMPUTATION FOR REST DAY OVERTIME PAY
                $RDOTOTPay = round(($employee_hourlyRate * 1.3) * $totalRDOTOTHours, 2);
                $RDOTOTNDPay = round(($employee_hourlyRate * .3) * $totalRDOTOTNDHours, 2);

                // COMPUTATION FOR SPECIAL HOLIDAY PAY
                $specialHolidayPay = round(($employee_hourlyRate * .3) * $totalSpecialHolidayHours, 2);
                $specialHolidayOTPay = round(($employee_hourlyRate * .69) * $totalSpecialHolidayOTHours, 2);
                $specialHolidayRDOTPay = round(($employee_hourlyRate * .5) * $totalSpecialHolidayRDOTHours, 2);
                $specialHolidayRDOTOTPay = round(($employee_hourlyRate * .95) * $totalSpecialHolidayRDOTOTHours, 2);

                $specialHolidayNDPay = round(($employee_hourlyRate * .495) * $totalSpecialHolidayNDHours, 2);
                $specialHolidayOTNDPay = round(($employee_hourlyRate * .9435) * $totalSpecialHolidayOTNDHours, 2);
                $specialHolidayRDOTNDPay = round(($employee_hourlyRate * .725) * $totalSpecialHolidayRDOTNDHours, 2);
                $specialHolidayRDOTOTNDPay = round(($employee_hourlyRate * 1.2425) * $totalSpecialHolidayRDOTOTNDHours, 2);

                // COMPUTATION FOR REGULAR HOLIDAY PAY
                $regularHolidayPay = round($employee_hourlyRate * $totalRegularHolidayHours, 2);
                $regularHolidayOTPay = round(($employee_hourlyRate * 1.6) * $totalRegularHolidayOTHours, 2);
                $regularHolidayRDOTPay = round(($employee_hourlyRate * 1.6) * $totalRegularHolidayRDOTHours, 2);
                $regularHolidayRDOTOTPay = round(($employee_hourlyRate * 2.38) * $totalRegularHolidayRDOTOTHours, 2);

                $regularHolidayNDPay = round(($employee_hourlyRate * 1.3) * $totalRegularHolidayNDHours, 2);
                $regularHolidayOTNDPay = round(($employee_hourlyRate * 1.99) * $totalRegularHolidayOTNDHours, 2);
                $regularHolidayRDOTNDPay = round(($employee_hourlyRate * 1.99) * $totalRegularHolidayRDOTNDHours, 2);
                $regularHolidayRDOTOTNDPay = round(($employee_hourlyRate * 2.887) * $totalRegularHolidayRDOTOTNDHours, 2);

                // COMPUTATION FOR LATE MINUTES
                $lateMinsAmt = round(($employee_hourlyRate / 60) * $totalLateMins, 2);

                if ($employeee_department == 3 || $employeee_department == 4) {
                    $absencesQuery = $this->dbConnect()->query($this->getCutOffAbsences($employee_id, $payrollCycleFrom, $payrollCycleTo));
                    $absencesDetails = mysqli_fetch_array($absencesQuery);
                    $totalAbsences = (int)$absencesDetails['total_absences'];
                    $absencesAmt = round($employee_dailyRate * $totalAbsences, 2);
                    $basePay = round($employee_basicPay / 2, 2);
                }
                else {
                    $basePay = round($employee_dailyRate * $employee_daysWorked, 2);
                }
                $grossPay = round($basePay + $totalAllowances + $communication + $totalReimbursements + $totalAdjustments + $nightDiffPay +$overtimePay + $overtimeNDPay + $RDOTPay + $RDOTNDPay + $RDOTOTPay + $RDOTOTNDPay + $specialHolidayPay + $specialHolidayOTPay + $specialHolidayRDOTPay + $specialHolidayRDOTOTPay + $specialHolidayNDPay + $specialHolidayOTNDPay + $specialHolidayRDOTNDPay + $specialHolidayRDOTOTNDPay + $regularHolidayPay + $regularHolidayOTPay + $regularHolidayRDOTPay + $regularHolidayRDOTOTPay + $regularHolidayNDPay + $regularHolidayOTNDPay + $regularHolidayRDOTNDPay + $regularHolidayRDOTOTNDPay + $sickLeavePay + $vacationLeavePay + $referralIncentivePay - $absencesAmt - $lateMinsAmt, 2);
                
                // COMPUTATION FOR WTAX
                $deductedGrossPay = round($grossPay - $sss - $sssmpf - $phic - $hdmf, 2);
                if ($deductedGrossPay <= 10417) {
                    $wtax = 0;
                }
                else if (($deductedGrossPay > 10417) && $deductedGrossPay <= 16666) {
                    $wtax = ($deductedGrossPay - 10417) * .15;
                }
                else if (($deductedGrossPay > 16667) && $deductedGrossPay <= 33332) {
                    $wtax = (($deductedGrossPay - 16667) * .2) + 937.5;
                }
                else if (($deductedGrossPay > 33333) && $deductedGrossPay <= 83332) {
                    $wtax = (($deductedGrossPay - 33333) * .25) + 4270.70;
                }
                else if (($deductedGrossPay > 83333) && $deductedGrossPay <= 333332) {
                    $wtax = (($deductedGrossPay - 83333) * .3) + 16770.70;
                }
                else if ($deductedGrossPay > 333333) {
                    $wtax = (($deductedGrossPay - 333333) * .35) + 91770.70;
                }

                // COMPUTE NET PAY
                $netPay = round($grossPay - $sss - $sssmpf - $phic - $hdmf - $wtax - $salaryLoan - $hdmfSalaryLoan -  $cashAdvance - $smart, 2);
                $remainingBalance = $remainingAmount - $cashAdvance;

                $counter++;
                
                // ADD ALL PAYROLL DATA TO PAYSLIP TABLE
                $this->dbConnect()->query("INSERT INTO $this->payslip (payrollID, counter, empID, daysWorked, basePay, regNightDiff, pay_regNightDiff, regOT, pay_regOT, regOTND, pay_regOTND, regRDOT, pay_regRDOT, regRDOTND, pay_regRDOTND, regRDOTOT, pay_regRDOTOT, regRDOTOTND, pay_regRDOTOTND, specialHoliday, pay_specialHoliday, specialHolidayND, pay_specialHolidayND, specialHolidayOT, pay_specialHolidayOT, specialHolidayOTND, pay_specialHolidayOTND, specialHolidayRDOT, pay_specialHolidayRDOT, specialHolidayRDOTND, pay_specialHolidayRDOTND, specialHolidayRDOTOT, pay_specialHolidayRDOTOT, specialHolidayRDOTOTND, pay_specialHolidayRDOTOTND, regularHoliday, pay_regularHoliday, regularHolidayND, pay_regularHolidayND, regularHolidayOT, pay_regularHolidayOT, regularHolidayOTND, pay_regularHolidayOTND, regularHolidayRDOT, pay_regularHolidayRDOT, regularHolidayRDOTND, pay_regularHolidayRDOTND, regularHolidayRDOTOT, pay_regularHolidayRDOTOT, regularHolidayRDOTOTND, pay_regularHolidayRDOTOTND, payslip_allowances, payslip_communication, grossPay, payslip_sss, payslip_sssMPF, payslip_phic, payslip_hdmf, payslip_wtax, payslip_salaryLoan, payslip_hdmfSalaryLoan, payslip_smart, payslip_reimbursements, payslip_adjustments, sickLeaveCount, pay_sickLeave, vacationLeaveCount, pay_vacationLeave, pay_referralIncentive, totalAbsences, payslip_absences, totalLateMins, payslip_lateMins, payslip_cashAdvanceDeduction, netPay) VALUES ($payrollID, $counter, $employee_id, $employee_daysWorked, $basePay, $totalNightHours, $nightDiffPay, $totalOvertimeHours, $overtimePay, $totalOvertimeNDHours, $overtimeNDPay, $totalRDOTHours, $RDOTPay, $totalRDOTNDhours, $RDOTNDPay, $totalRDOTOTHours, $RDOTOTPay, $totalRDOTOTNDHours, $RDOTOTNDPay, $totalSpecialHolidayHours, $specialHolidayPay, $totalSpecialHolidayNDHours, $specialHolidayNDPay, $totalSpecialHolidayOTHours, $specialHolidayOTPay, $totalSpecialHolidayOTNDHours, $specialHolidayOTNDPay, $totalSpecialHolidayRDOTHours, $specialHolidayRDOTPay, $totalSpecialHolidayRDOTNDHours, $specialHolidayRDOTNDPay, $totalSpecialHolidayRDOTOTHours, $specialHolidayRDOTOTPay, $totalSpecialHolidayRDOTOTNDHours, $specialHolidayRDOTOTNDPay, $totalRegularHolidayHours, $regularHolidayPay, $totalRegularHolidayNDHours, $regularHolidayNDPay, $totalRegularHolidayOTHours, $regularHolidayOTPay, $totalRegularHolidayOTNDHours, $regularHolidayOTNDPay, $totalRegularHolidayRDOTHours, $regularHolidayRDOTPay, $totalRegularHolidayRDOTNDHours, $regularHolidayRDOTNDPay, $totalRegularHolidayRDOTOTHours, $regularHolidayRDOTOTPay, $totalRegularHolidayRDOTOTNDHours, $regularHolidayRDOTOTNDPay, $totalAllowances, $communication, $grossPay, $sss, $sssmpf, $phic, $hdmf, $wtax, $salaryLoan, $hdmfSalaryLoan, $smart, $totalReimbursements, $totalAdjustments, $totalSickLeaves, $sickLeavePay, $totalVacationLeaves, $vacationLeavePay, $referralIncentivePay, $totalAbsences, $absencesAmt, $totalLateMins, $lateMinsAmt, $cashAdvance, $netPay)");

                // UPDATE CASH ADVANCE PAYMENT HISTORY
                if ($remainingBalance > 0) {
                    $this->dbConnect()->query("INSERT INTO tbl_caPaymentHistory (requestID, payrollID, amountDeducted, remainingBalance, dateDeducted) VALUES ($requestID, $payrollID, $cashAdvance, $remainingBalance, CURRENT_DATE())");
                    if ($ca_status == "New") {
                        $this->dbConnect()->query("UPDATE tbl_cashAdvance SET remainingAmount = $remainingBalance, ca_status = 'Ongoing' WHERE requestID = $requestID");
                    }
                    else if ($remainingBalance == 0) {
                        $this->dbConnect()->query("UPDATE tbl_cashAdvance SET remainingAmount = $remainingBalance, ca_status = 'Paid' WHERE requestID = $requestID");
                    } 
                    else {
                        $this->dbConnect()->query("UPDATE tbl_cashAdvance SET remainingAmount = $remainingBalance WHERE requestID = $requestID");
                    }
                }

                if ($referralCount > 0) {
                    $this->dbConnect()->query("
                        SELECT * 
                        FROM tbl_referral 
                        WHERE referrer_empID = $employee_id 
                        AND (
                            (threeMonths BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo' AND threeMonths_status = 0)
                            OR
                            (sixMonths BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo' AND sixMonths_status = 0))");

                    // UPDATE 3-MONTH STATUS
                    $this->dbConnect()->query("
                        UPDATE tbl_referral 
                        SET threeMonths_status = 1 
                        WHERE referrer_empID = $employee_id 
                        AND threeMonths BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo'
                        AND threeMonths_status = 0
                    ");

                    // UPDATE 6-MONTH STATUS
                    $this->dbConnect()->query("
                        UPDATE tbl_referral 
                        SET sixMonths_status = 1 
                        WHERE referrer_empID = $employee_id 
                        AND sixMonths BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo'
                        AND sixMonths_status = 0
                    ");

                } 
            }
        }

        public function reCalculatePayroll($payrollID, $payrollCycleID) {
            // UPDATE CASH ADVANCE DETAILS
            $cashAdvanceQuery = $this->dbConnect()->query($this->resetCAPaymentHistory($payrollID));
            while ($cashAdvanceDetails = mysqli_fetch_array($cashAdvanceQuery)) {
                $requestID = $cashAdvanceDetails['requestID'];
                $cashAdvance = $cashAdvanceDetails['amountDeducted'];
                $remainingBalance = $cashAdvanceDetails['remainingBalance'];
                $remainingBalance = $remainingBalance + $cashAdvance;
                $ca_status = $cashAdvanceDetails['ca_status'];
                $request_payrollID = $cashAdvanceDetails['payrollID'];

                if ($request_payrollID == $payrollID) {
                    $this->dbConnect()->query($this->resetNewCAstatus($requestID, $remainingBalance));
                }
                else if ($ca_status == "Paid") {
                    $this->dbConnect()->query($this->resetOngoingCAstatus($requestID, $remainingBalance));
                }
                else {
                    $this->dbConnect()->query($this->resetCAstatus($requestID, $remainingBalance));
                }
            }

            // DELETE CURRENT CA PAYMENT HISTORY, RE-CALCULATE FUNCTION
            $this->dbConnect()->query($this->deleteCAPaymentHistory($payrollID));

            // DELETE CURRENT PAYSLIP - RE-CALCULATE FUNCTION
            $this->dbConnect()->query($this->deletePayslip($payrollID));

            function formatDate($date) {
                // GET CURRENT YEAR
                $currentYear = date('Y');

                // APPEND THE CURRENT YEAR TO THE INPUT DATE
                $dateWithYear = $date . '-' . $currentYear;

                // CREATE DATETIME OBJECT FROM THE STRING AND RETURN THE FORMATTED DATE
                $dateTime = DateTime::createFromFormat('m-d-Y', $dateWithYear);

                return $dateTime->format('Y-m-d');
            }

            // GET PAYROLL CYCLE DETAILS
            $payrollCycleFrom_date = $this->dbConnect()->query("SELECT * FROM tbl_payrollcycle WHERE payrollCycleID = $payrollCycleID")->fetch_assoc()['payrollCycleFrom'];
            $payrollCycleTo_date = $this->dbConnect()->query("SELECT * FROM tbl_payrollcycle WHERE payrollCycleID = $payrollCycleID")->fetch_assoc()['payrollCycleTo'];
            $payrollCycleFrom = formatDate($payrollCycleFrom_date);
            $payrollCycleTo = formatDate($payrollCycleTo_date);

            $counter = 0;

            // GET EMPLOYEE DETAILS
            $employees = $this->dbConnect()->query("SELECT * FROM tbl_employee WHERE designationID != 12 AND e_status = 'Active' ORDER BY lastName");
            while ($employeeDetails = mysqli_fetch_array($employees)) {
                $employee_id = $employeeDetails['id'];
                $employee_basicPay = $employeeDetails['basicPay'];
                $employee_dailyRate = $employeeDetails['dailyRate'];
                $employee_hourlyRate = $employeeDetails['hourlyRate'];
                $employeee_department = $employeeDetails['departmentID'];

                // COMPUTE DAYS WORKED
                $daysWorkedQuery = $this->dbConnect()->query("SELECT * FROM tbl_attendance WHERE empID = $employeeDetails[id] AND (logTypeID IN (1, 2)) AND attendanceDate BETWEEN DATE(CONCAT(YEAR(CURDATE()), '-', MONTH('$payrollCycleFrom'), '-', DAY('$payrollCycleFrom'))) AND DATE(CONCAT(YEAR(CURDATE()), '-', MONTH('$payrollCycleTo'), '-', DAY('$payrollCycleTo')))");
                $employee_daysWorked = mysqli_num_rows($daysWorkedQuery);

                // CHECK FOR HOLIDAYS
                $holidaysQuery = $this->dbConnect()->query("SELECT * FROM tbl_holidays WHERE dateFrom BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo'");
                $holidays = [];
                while ($holidayDetails = mysqli_fetch_array($holidaysQuery)) {
                    $holidays[$holidayDetails['dateFrom']] = $holidayDetails['type'];
                }

                // INITIALIZE VARIABLES FOR HOURS WORKED COMPUTATION
                $totalOvertimeHours = 0;
                $totalRDOTHours = 0;
                $totalRDOTOTHours = 0;

                $totalSpecialHolidayHours = 0;
                $totalSpecialHolidayOTHours = 0;
                $totalSpecialHolidayRDOTHours = 0;
                $totalSpecialHolidayRDOTOTHours = 0;

                $totalRegularHolidayHours = 0;
                $totalRegularHolidayOTHours = 0;
                $totalRegularHolidayRDOTHours = 0;
                $totalRegularHolidayRDOTOTHours = 0;


                $totalNightHours = 0;
                $totalOvertimeNDHours = 0;
                $totalRDOTNDhours = 0;
                $totalRDOTOTNDHours = 0;

                $totalSpecialHolidayNDHours = 0;
                $totalSpecialHolidayOTNDHours = 0;
                $totalSpecialHolidayRDOTNDHours = 0;
                $totalSpecialHolidayRDOTOTNDHours = 0;

                $totalRegularHolidayNDHours = 0;
                $totalRegularHolidayOTNDHours = 0;
                $totalRegularHolidayRDOTNDHours = 0;
                $totalRegularHolidayRDOTOTNDHours = 0;


                // INITIALIZE VARILABLES FOR PAY COMPUTATIONS
                $overtimePay = 0;
                $RDOTPay = 0;
                $RDOTOTPay = 0;

                $specialHolidayPay = 0;
                $specialHolidayOTPay = 0;
                $specialHolidayRDOTPay = 0;
                $specialHolidayRDOTOTPay = 0;

                $regularHolidayPay = 0;
                $regularHolidayOTPay = 0;
                $regularHolidayRDOTPay = 0;
                $regularHolidayRDOTOTPay = 0;

                
                $nightDiffPay = 0;
                $overtimeNDPay = 0;
                $RDOTNDPay = 0;
                $RDOTOTNDPay = 0;

                $specialHolidayNDPay = 0;
                $specialHolidayOTNDPay = 0;
                $specialHolidayRDOTNDPay = 0;
                $specialHolidayRDOTOTNDPay = 0;

                $regularHolidayNDPay = 0;
                $regularHolidayOTNDPay = 0;
                $regularHolidayRDOTNDPay = 0;
                $regularHolidayRDOTOTNDPay = 0;

                // INITIALIZE VARIABLES FOR DAYS WORKED (HOLIDAYS) COMPUTATION
                $specialHolidaysWorked = 0;
                $regularHolidaysWorked = 0;

                // ALLOWANCES, DEDUCTIONS, REIMBURSEMENTS, AND ADJUSTMENTS (+, -) COMPUTATION
                $sss = 0;
                $sssmpf = 0;
                $phic = 0;
                $hdmf = 0;  
                
                $salaryLoan = 0;
                $hdmfSalaryLoan = 0;
                // $hdmfLoan = 0;
                $smart = 0;

                // CASH ADVANCE
                $requestID = 0;
                $cashAdvance = 0;
                $remainingAmount = 0;
                $remainingBalance = 0;
                $ca_status = "";

                $totalAllowances = 0;
                $communication = 0;
                $totalReimbursements = 0;
                $totalAdjustments = 0;

                // INITIALIZE VARIABLES FOR LEAVE COMPUTATION
                $totalSickLeaves = 0;
                $totalVacationLeaves = 0;
                $sickLeavePay = 0;
                $vacationLeavePay = 0;

                // INITIALIZE VARIABLES FOR REFERRAL INCENTIVE COMPUTATION
                $referralCount = 0;
                $referralIncentivePay = 0;

                // INITIALIZE VARIABLES FOR LATE MINS AND ABSENCES COMPUTATION
                $totalAbsences = 0;
                $absencesAmt = 0;
                $totalLateMins = 0;
                $lateMinsAmt = 0;

                // INITIALIZE VARIABLES FOR PAYROLL COMPUTATION
                $basePay = 0;
                $grossPay = 0;
                $netPay = 0;

                // NEW CODE
                // $attendanceQuery = $this->dbConnect()->query("
                //     SELECT *
                //     FROM tbl_attendance
                //     WHERE empID = {$employeeDetails['id']}
                //     AND logTypeID IN (1,2,3,4)
                //     AND attendanceDate BETWEEN 
                //         DATE(CONCAT(YEAR(CURDATE()), '-', MONTH('$payrollCycleFrom'), '-', DAY('$payrollCycleFrom')))
                //         AND
                //         DATE(CONCAT(YEAR(CURDATE()), '-', MONTH('$payrollCycleTo'), '-', DAY('$payrollCycleT')))
                //     ORDER BY attendanceDate ASC, attendanceTime ASC
                // ");
                $extendedTo = date('Y-m-d', strtotime($payrollCycleTo . ' +1 day'));
                $attendanceQuery = $this->dbConnect()->query("
                    SELECT *
                    FROM tbl_attendance
                    WHERE empID = {$employeeDetails['id']}
                    AND logTypeID IN (1,2,3,4)
                    AND attendanceDate BETWEEN '$payrollCycleFrom' AND '$extendedTo'
                    ORDER BY attendanceDate ASC, attendanceTime ASC
                ");
                while ($attendanceLogs = mysqli_fetch_array($attendanceQuery)) {
                    // FULL DATETIME
                    $attendanceDate = $attendanceLogs['attendanceDate'];
                    $attendanceTime = $attendanceLogs['attendanceTime'];
                    $fullDateTime = $attendanceDate . ' ' . $attendanceTime;

                    $logTypeID = $attendanceLogs['logTypeID'];
                    $lateMins = $attendanceLogs['lateMins'];
                    $totalLateMins += $lateMins;

                    $result = $this->calculateNightDifferential(
                        $fullDateTime,
                        $logTypeID,
                        $lateMins,
                        $payrollCycleFrom,
                        $payrollCycleTo,
                        $attendanceDate,
                        $employee_id
                    );

                    $totalNightHours += $result['totalRegularNightHours'];
                    $totalRegularHolidayHours += $result['totalRegularHolidayHours'];
                    $totalRegularHolidayNDHours += $result['totalRegularHolidayNightHours'];
                    $totalSpecialHolidayHours += $result['totalSpecialHolidayHours'];
                    $totalSpecialHolidayNDHours += $result['totalSpecialHolidayNightHours'];
                }


                // COMPUTE OVERTIME HOURS
                $overtimeQuery = $this->dbConnect()->query(("SELECT * FROM tbl_filedot WHERE empID = $employee_id AND (otDate BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo') AND status = '1'"));
                while ($overtime = mysqli_fetch_array($overtimeQuery)) {
                    if (isset($holidays[$overtime['otDate']])) {
                        // REGULAR HOLIDAY
                        if ($holidays[$overtime['otDate']] == "Legal") {
                            // REGULAR OVERTIME
                            if ($overtime['otType'] == "Regular") {
                                $from = new DateTime($overtime['fromTime']);
                                $to = new DateTime($overtime['toTime']);

                                $result = $this->calculateOvertimeND($from, $time);
                                $totalRegularHolidayOTHours += $result['totalOvertimeHours'];
                                $totalRegularHolidayOTNDHours += $result['totalOvertimeNDHours'];
                            }
                            // REST DAY
                            else if ($overtime['otType'] == "Rest Day") {
                                $from = new DateTime($overtime['fromTime']);
                                $to = new DateTime($overtime['toTime']);
                                $to->modify(('-1 hour'));

                                $result = $this->calculateOvertimeND($from, $to);
                                $totalRegularHolidayRDOTHours += $result['totalOvertimeHours'];
                                $totalRegularHolidayRDOTNDHours += $result['totalOvertimeNDHours'];
                            }
                            // REST DAY, OVERTIME
                            else {
                                $from = new DateTime($overtime['fromTime']);
                                $to = new DateTime($overtime['toTime']);

                                $result = $this->calculateOvertimeND($from, $to);
                                $totalRegularHolidayRDOTOTHours += $result['totalOvertimeHours'];
                                $totalRegularHolidayRDOTOTNDHours += $result['totalOvertimeNDHours'];
                            }
                        }
                        // SPECIAL HOLIDAY
                        else if ($holidays[$overtime['otDate']] == "Special") {
                            // REGULAR OVERTIME
                            if ($overtime['otType'] == "Regular") {
                                $from = new DateTime($overtime['fromTime']);
                                $to = new DateTime($overtime['toTime']);

                                $result = $this->calculateOvertimeND($from, $to);
                                $totalSpecialHolidayOTHours += $result['totalOvertimeHours'];
                                $totalSpecialHolidayOTNDHours += $result['totalOvertimeNDHours'];
                            }
                            // REST DAY
                            else if ($overtime['otType'] == "Rest Day") {
                                $from = new DateTime($overtime['fromTime']);
                                $to = new DateTime($overtime['toTime']);
                                $to->modify('-1 hour');

                                $result = $this->calculateOvertimeND($from, $to);
                                $totalSpecialHolidayRDOTHours += $result['totalOvertimeHours'];
                                $totalSpecialHolidayRDOTNDHours += $result['totalOvertimeNDHours'];
                            }
                            // REST DAY, OVERTIME
                            else {
                                $from = new DateTime($overtime['fromTime']);
                                $to = new DateTime($overtime['toTime']);

                                $result = $this->calculateOvertimeND($from, $to);
                                $totalSpecialHolidayRDOTOTHours += $result['totalOvertimeHours'];
                                $totalSpecialHolidayRDOTOTNDHours += $result['totalOvertimeNDHours'];
                            }
                        }
                    }
                    else {
                        // REGULAR OVERTIME
                        if ($overtime['otType'] == "Regular") {
                            $from = new DateTime($overtime['fromTime']);
                            $to = new DateTime($overtime['toTime']);

                            $result = $this->calculateOvertimeND($from, $to);
                            $totalOvertimeHours += $result['totalOvertimeHours'];
                            $totalOvertimeNDHours += $result['totalOvertimeNDHours'];
                        }
                        // REST DAY
                        else if ($overtime['otType'] == "Rest Day") {
                            $from = new DateTime($overtime['fromTime']);
                            $to = new DateTime($overtime['toTime']);
                            $to->modify('-1 hour');

                            $result = $this->calculateOvertimeND($from, $to);
                            $totalRDOTHours += $result['totalOvertimeHours'];
                            $totalRDOTNDhours += $result['totalOvertimeNDHours'];
                        }
                        // REST DAY, OVERTIME
                        else {
                            $from = new DateTime($overtime['fromTime']);
                            $to = new DateTime($overtime['toTime']);

                            $result = $this->calculateOvertimeND($from, $to);
                            $totalRDOTOTHours += $result['totalOvertimeHours'];
                            $totalRDOTOTNDHours += $result['totalOvertimeNDHours'];
                        }
                    }
                }

                // COMPUTATION FOR ALLOWANCES
                $allowancesQuery = $this->dbConnect()->query("SELECT amount, type FROM tbl_empallowances INNER JOIN tbl_allowances ON tbl_empallowances.allowanceID = tbl_allowances.allowanceID WHERE empID = $employee_id AND allowanceName NOT IN ('Communication', 'Communication Allowance')");
                while ($allowanceDetails = mysqli_fetch_array($allowancesQuery)) {
                    if ($allowanceDetails['type'] == 1 && $payrollCycleID % 2 == 0) { // MONTHLY
                        $totalAllowances += $allowanceDetails['amount'];
                    } elseif ($allowanceDetails['type'] == 2) { // SEMI-MONTHLY
                        $totalAllowances += ($allowanceDetails['amount'] / 2);
                    }
                }

                // COMPUTATION FOR COMMUNICATION ALLOWANCE
                $allowancesQuery = $this->dbConnect()->query("SELECT amount, type FROM tbl_empallowances INNER JOIN tbl_allowances ON tbl_empallowances.allowanceID = tbl_allowances.allowanceID WHERE empID = $employee_id AND allowanceName IN ('Communication', 'Communication Allowance')");
                while ($allowanceDetails = mysqli_fetch_array($allowancesQuery)) {
                    if ($allowanceDetails['type'] == 1 && $payrollCycleID % 2 == 0) { // MONTHLY
                        $communication += $allowanceDetails['amount'];
                    } elseif ($allowanceDetails['type'] == 2) { // SEMI-MONTHLY
                        $communication += ($allowanceDetails['amount'] / 2);
                    }
                }

                // COMPUTATION FOR DEDUCTIONS
                $deductionsQuery = $this->dbConnect()->query("SELECT amount, deductionName, type, payrollCycleID FROM tbl_empdeductions INNER JOIN tbl_deductions ON tbl_empdeductions.deductionID = tbl_deductions.deductionID WHERE empID = $employee_id");
                while ($deductionDetails = mysqli_fetch_array($deductionsQuery)) {
                    if ($deductionDetails['deductionName'] == "SSS") {
                        $sss = $deductionDetails['amount'] / 2;
                    }
                    else if ($deductionDetails['deductionName'] == "SSS MPF") {
                        $sssmpf = $deductionDetails['amount'] / 2;
                    }
                    else if ($deductionDetails['deductionName'] == "PhilHealth") {
                        $phic = $deductionDetails['amount'] / 2;
                    }
                    else if ($deductionDetails['deductionName'] == "HDMF") {
                        $hdmf = $deductionDetails['amount'] / 2;
                    }
                    else if ($deductionDetails['deductionName'] == "SSS Salary Loan") {
                        $salaryLoan = $deductionDetails['amount'];
                    }
                    else if ($deductionDetails['deductionName'] == "HDMF Salary Loan") {
                        $hdmfSalaryLoan = $deductionDetails['amount'];
                    }
                    // else if ($deductionDetails['deductionName'] == "HDMF Loan") {
                    //     $hdmfLoan = $deductionDetails['amount'];
                    // }
                    else if ($deductionDetails['deductionName'] == "Smart Communication") {
                        $smart = $deductionDetails['amount'];
                    }
                }

                // COMPUTATION FOR CASH ADVANCES
                $cashAdvanceQuery = $this->dbConnect()->query("SELECT * FROM tbl_cashAdvance ca WHERE ca.empID = $employee_id AND ca.request_status = 'Approved' AND ((ca.ca_status = 'New' AND ca.payrollCutoffStart <= $payrollCycleFrom) OR (ca.ca_status = 'Ongoing'))");
                while ($cashAdvanceDetails = mysqli_fetch_array($cashAdvanceQuery)) {
                    $requestID = $cashAdvanceDetails['requestID'];
                    $cashAdvance = $cashAdvanceDetails['monthlyAmmortization'];
                    $remainingAmount = $cashAdvanceDetails['remainingAmount'];
                    $ca_status = $cashAdvanceDetails['ca_status'];
                }

                // COMPUTATION FOR REIMBURSEMENTS
                $reimbursementsQuery = $this->dbConnect()->query("SELECT amount, type, payrollCycleID FROM tbl_empreimbursements INNER JOIN tbl_reimbursements ON tbl_empreimbursements.reimbursementID = tbl_reimbursements.reimbursementID WHERE empID = $employee_id");
                while ($reimbursementDetails = mysqli_fetch_array($reimbursementsQuery)) {
                    if ($reimbursementDetails['type'] == 1 && $payrollCycleID % 2 == 0) { // MONTHLY
                        $totalReimbursements += $reimbursementDetails['amount'];
                    } elseif ($reimbursementDetails['type'] == 2) { // SEMI-MONTHLY
                        $totalReimbursements += ($reimbursementDetails['amount'] / 2);
                    } elseif ($reimbursementDetails['type'] == 3 && $reimbursementDetails['payrollCycleID'] == $payrollCycleID) { // ONCE
                        $totalReimbursements += $reimbursementDetails['amount'];
                    }
                }

                // COMPUTATION FOR ADJUSTMENTS
                $adjustmentsQuery = $this->dbConnect()->query("SELECT amount, type, payrollCycleID, adjustmentType FROM tbL_empadjustments INNER JOIN tbl_adjustments ON tbL_empadjustments.adjustmentID = tbl_adjustments.adjustmentID WHERE empID = $employee_id");
                while ($adjustmentDetails = mysqli_fetch_array($adjustmentsQuery)) {
                    if ($adjustmentDetails['type'] == 1 && $payrollCycleID % 2 == 1) { // MONTHLY
                        if ($adjustmentDetails['adjustmentType'] == "Add") {
                            $totalAdjustments += $adjustmentDetails['amount'];
                        }
                        else {
                            $totalAdjustments -= $adjustmentDetails['amount'];
                        }
                    } elseif ($adjustmentDetails['type'] == 2) { // SEMI-MONTHLY
                        if ($adjustmentDetails['adjustmentType'] == "Add") {
                            $totalAdjustments += $adjustmentDetails['amount'];
                        }
                        else {
                            $totalAdjustments -= $adjustmentDetails['amount'];
                        }
                    } elseif ($adjustmentDetails['type'] == 3 && $adjustmentDetails['payrollCycleID'] == $payrollCycleID) { // ONCE
                        if ($adjustmentDetails['adjustmentType'] == "Add") {
                            $totalAdjustments += $adjustmentDetails['amount'];
                        }
                        else {
                            $totalAdjustments -= $adjustmentDetails['amount'];
                        }
                    }
                }

                // COMPUTATION FOR LEAVES
                // $leaveQuery = $this->dbConnect()->query("SELECT empID, lt.leaveTypeID, effectivityStartDate, effectivityEndDate FROM tbl_leaveapplications AS la INNER JOIN tbl_leavetype AS lt ON la.leaveTypeID = lt.leaveTypeID WHERE effectivityStartDate BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo' AND effectivityEndDate BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo' AND status = 'Approved' AND empID=$employee_id");
                $sql = $this->getLeavesForPayroll($employee_id, $payrollCycleFrom, $payrollCycleTo);
                $leaveQuery = $this->dbConnect()->query($sql);
                while ($leaveDetails = mysqli_fetch_array($leaveQuery)) {
                    if ($leaveDetails['leaveTypeID'] == 1) {
                        $totalSickLeaves++;
                    }
                    else if ($leaveDetails['leaveTypeID'] == 2) {
                        $totalVacationLeaves++;
                    }
                }
                $lateFiledLeavesQuery = $this->getLateFiledLeaves($employee_id, $payrollCycleFrom, $payrollCycleTo);
                $lateFiledLeaveQuery = $this->dbConnect()->query($lateFiledLeavesQuery);
                while ($lateFLDetails = mysqli_fetch_array($lateFiledLeaveQuery)) {
                    if ($lateFLDetails['leaveTypeID'] == 1) {
                        $totalSickLeaves++;
                    }
                    else if ($lateFLDetails['leaveTypeID'] == 2) {
                        $totalVacationLeaves++;
                    }
                }
                $sickLeavePay = round($totalSickLeaves * $employee_dailyRate, 2);
                $vacationLeavePay = round($totalVacationLeaves * $employee_dailyRate, 2);

                // COMPUTATION FOR REFERRAL INCENTIVE
                $referralQuery = $this->dbConnect()->query("SELECT * FROM tbl_referral WHERE referrer_empID = $employee_id AND ((threeMonths BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo' AND threeMonths_status = 0) OR (sixMonths BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo' AND sixMonths_status = 0))");
                while ($referralDetails = mysqli_fetch_array($referralQuery)) {
                    $referralCount++;
                }
                $referralIncentivePay = round($referralCount * 2500, 2);

                //COMPUTATION FOR NIGHT DIFFERENTIAL PAY
                $totalNightHours = round($totalNightHours, 0);
                $nightDiffPay = round(($employee_hourlyRate * .15) * $totalNightHours, 2);

                // COMPUTATION FOR OVERTIME PAY
                $overtimePay = round(($employee_hourlyRate * .25) * $totalOvertimeHours, 2);
                $overtimeNDPay = round((($employee_hourlyRate * 1.25) * 15) * $totalOvertimeNDHours, 2);

                // COMPUTATION FOR REST DAY PAY
                $RDOTPay = round(($employee_hourlyRate * .3) * $totalRDOTHours, 2);
                $RDOTNDPay = round((($employee_hourlyRate * 1.3) * .15) * $totalRDOTNDhours, 2);

                // COMPUTATION FOR REST DAY OVERTIME PAY
                $RDOTOTPay = round(($employee_hourlyRate * 1.3) * $totalRDOTOTHours, 2);
                $RDOTOTNDPay = round(($employee_hourlyRate * .3) * $totalRDOTOTNDHours, 2);

                // COMPUTATION FOR SPECIAL HOLIDAY PAY
                $specialHolidayPay = round(($employee_hourlyRate * .3) * $totalSpecialHolidayHours, 2);
                $specialHolidayOTPay = round(($employee_hourlyRate * .69) * $totalSpecialHolidayOTHours, 2);
                $specialHolidayRDOTPay = round(($employee_hourlyRate * .5) * $totalSpecialHolidayRDOTHours, 2);
                $specialHolidayRDOTOTPay = round(($employee_hourlyRate * .95) * $totalSpecialHolidayRDOTOTHours, 2);

                $specialHolidayNDPay = round(($employee_hourlyRate * .495) * $totalSpecialHolidayNDHours, 2);
                $specialHolidayOTNDPay = round(($employee_hourlyRate * .9435) * $totalSpecialHolidayOTNDHours, 2);
                $specialHolidayRDOTNDPay = round(($employee_hourlyRate * .725) * $totalSpecialHolidayRDOTNDHours, 2);
                $specialHolidayRDOTOTNDPay = round(($employee_hourlyRate * 1.2425) * $totalSpecialHolidayRDOTOTNDHours, 2);

                // COMPUTATION FOR REGULAR HOLIDAY PAY
                $regularHolidayPay = round($employee_hourlyRate * $totalRegularHolidayHours, 2);
                $regularHolidayOTPay = round(($employee_hourlyRate * 1.6) * $totalRegularHolidayOTHours, 2);
                $regularHolidayRDOTPay = round(($employee_hourlyRate * 1.6) * $totalRegularHolidayRDOTHours, 2);
                $regularHolidayRDOTOTPay = round(($employee_hourlyRate * 2.38) * $totalRegularHolidayRDOTOTHours, 2);

                $regularHolidayNDPay = round(($employee_hourlyRate * 1.3) * $totalRegularHolidayNDHours, 2);
                $regularHolidayOTNDPay = round(($employee_hourlyRate * 1.99) * $totalRegularHolidayOTNDHours, 2);
                $regularHolidayRDOTNDPay = round(($employee_hourlyRate * 1.99) * $totalRegularHolidayRDOTNDHours, 2);
                $regularHolidayRDOTOTNDPay = round(($employee_hourlyRate * 2.887) * $totalRegularHolidayRDOTOTNDHours, 2);

                // COMPUTATION FOR LATE MINUTES
                $lateMinsAmt = round(($employee_hourlyRate / 60) * $totalLateMins, 2);

                if ($employeee_department == 3 || $employeee_department == 4) {
                    $absencesQuery = $this->dbConnect()->query($this->getCutOffAbsences($employee_id, $payrollCycleFrom, $payrollCycleTo));
                    $absencesDetails = mysqli_fetch_array($absencesQuery);
                    $totalAbsences = (int)$absencesDetails['total_absences'];
                    $absencesAmt = round($employee_dailyRate * $totalAbsences, 2);
                    $basePay = round($employee_basicPay / 2, 2);
                }
                else {
                    $basePay = round($employee_dailyRate * $employee_daysWorked, 2);
                }
                $grossPay = round($basePay + $totalAllowances + $communication + $totalReimbursements + $totalAdjustments + $nightDiffPay +$overtimePay + $overtimeNDPay + $RDOTPay + $RDOTNDPay + $RDOTOTPay + $RDOTOTNDPay + $specialHolidayPay + $specialHolidayOTPay + $specialHolidayRDOTPay + $specialHolidayRDOTOTPay + $specialHolidayNDPay + $specialHolidayOTNDPay + $specialHolidayRDOTNDPay + $specialHolidayRDOTOTNDPay + $regularHolidayPay + $regularHolidayOTPay + $regularHolidayRDOTPay + $regularHolidayRDOTOTPay + $regularHolidayNDPay + $regularHolidayOTNDPay + $regularHolidayRDOTNDPay + $regularHolidayRDOTOTNDPay + $sickLeavePay + $vacationLeavePay + $referralIncentivePay - $absencesAmt - $lateMinsAmt, 2);
                
                // COMPUTATION FOR WTAX
                $deductedGrossPay = round($grossPay - $sss - $sssmpf - $phic - $hdmf, 2);
                if ($deductedGrossPay <= 10417) {
                    $wtax = 0;
                }
                else if (($deductedGrossPay > 10417) && $deductedGrossPay <= 16666) {
                    $wtax = ($deductedGrossPay - 10417) * .15;
                }
                else if (($deductedGrossPay > 16667) && $deductedGrossPay <= 33332) {
                    $wtax = (($deductedGrossPay - 16667) * .2) + 937.5;
                }
                else if (($deductedGrossPay > 33333) && $deductedGrossPay <= 83332) {
                    $wtax = (($deductedGrossPay - 33333) * .25) + 4270.70;
                }
                else if (($deductedGrossPay > 83333) && $deductedGrossPay <= 333332) {
                    $wtax = (($deductedGrossPay - 83333) * .3) + 16770.70;
                }
                else if ($deductedGrossPay > 333333) {
                    $wtax = (($deductedGrossPay - 333333) * .35) + 91770.70;
                }

                // COMPUTE NET PAY
                $netPay = round($grossPay - $sss - $sssmpf - $phic - $hdmf - $wtax - $salaryLoan - $hdmfSalaryLoan -  $cashAdvance - $smart, 2);
                $remainingBalance = $remainingAmount - $cashAdvance;

                $counter++;
                
                // ADD ALL PAYROLL DATA TO PAYSLIP TABLE
                $this->dbConnect()->query("INSERT INTO $this->payslip (payrollID, counter, empID, daysWorked, basePay, regNightDiff, pay_regNightDiff, regOT, pay_regOT, regOTND, pay_regOTND, regRDOT, pay_regRDOT, regRDOTND, pay_regRDOTND, regRDOTOT, pay_regRDOTOT, regRDOTOTND, pay_regRDOTOTND, specialHoliday, pay_specialHoliday, specialHolidayND, pay_specialHolidayND, specialHolidayOT, pay_specialHolidayOT, specialHolidayOTND, pay_specialHolidayOTND, specialHolidayRDOT, pay_specialHolidayRDOT, specialHolidayRDOTND, pay_specialHolidayRDOTND, specialHolidayRDOTOT, pay_specialHolidayRDOTOT, specialHolidayRDOTOTND, pay_specialHolidayRDOTOTND, regularHoliday, pay_regularHoliday, regularHolidayND, pay_regularHolidayND, regularHolidayOT, pay_regularHolidayOT, regularHolidayOTND, pay_regularHolidayOTND, regularHolidayRDOT, pay_regularHolidayRDOT, regularHolidayRDOTND, pay_regularHolidayRDOTND, regularHolidayRDOTOT, pay_regularHolidayRDOTOT, regularHolidayRDOTOTND, pay_regularHolidayRDOTOTND, payslip_allowances, payslip_communication, grossPay, payslip_sss, payslip_sssMPF, payslip_phic, payslip_hdmf, payslip_wtax, payslip_salaryLoan, payslip_hdmfSalaryLoan, payslip_smart, payslip_reimbursements, payslip_adjustments, sickLeaveCount, pay_sickLeave, vacationLeaveCount, pay_vacationLeave, pay_referralIncentive, totalAbsences, payslip_absences, totalLateMins, payslip_lateMins, payslip_cashAdvanceDeduction, netPay) VALUES ($payrollID, $counter, $employee_id, $employee_daysWorked, $basePay, $totalNightHours, $nightDiffPay, $totalOvertimeHours, $overtimePay, $totalOvertimeNDHours, $overtimeNDPay, $totalRDOTHours, $RDOTPay, $totalRDOTNDhours, $RDOTNDPay, $totalRDOTOTHours, $RDOTOTPay, $totalRDOTOTNDHours, $RDOTOTNDPay, $totalSpecialHolidayHours, $specialHolidayPay, $totalSpecialHolidayNDHours, $specialHolidayNDPay, $totalSpecialHolidayOTHours, $specialHolidayOTPay, $totalSpecialHolidayOTNDHours, $specialHolidayOTNDPay, $totalSpecialHolidayRDOTHours, $specialHolidayRDOTPay, $totalSpecialHolidayRDOTNDHours, $specialHolidayRDOTNDPay, $totalSpecialHolidayRDOTOTHours, $specialHolidayRDOTOTPay, $totalSpecialHolidayRDOTOTNDHours, $specialHolidayRDOTOTNDPay, $totalRegularHolidayHours, $regularHolidayPay, $totalRegularHolidayNDHours, $regularHolidayNDPay, $totalRegularHolidayOTHours, $regularHolidayOTPay, $totalRegularHolidayOTNDHours, $regularHolidayOTNDPay, $totalRegularHolidayRDOTHours, $regularHolidayRDOTPay, $totalRegularHolidayRDOTNDHours, $regularHolidayRDOTNDPay, $totalRegularHolidayRDOTOTHours, $regularHolidayRDOTOTPay, $totalRegularHolidayRDOTOTNDHours, $regularHolidayRDOTOTNDPay, $totalAllowances, $communication, $grossPay, $sss, $sssmpf, $phic, $hdmf, $wtax, $salaryLoan, $hdmfSalaryLoan, $smart, $totalReimbursements, $totalAdjustments, $totalSickLeaves, $sickLeavePay, $totalVacationLeaves, $vacationLeavePay, $referralIncentivePay, $totalAbsences, $absencesAmt, $totalLateMins, $lateMinsAmt, $cashAdvance, $netPay)");

                // UPDATE CASH ADVANCE PAYMENT HISTORY
                if ($remainingBalance > 0) {
                    $this->dbConnect()->query("INSERT INTO tbl_caPaymentHistory (requestID, payrollID, amountDeducted, remainingBalance, dateDeducted) VALUES ($requestID, $payrollID, $cashAdvance, $remainingBalance, CURRENT_DATE())");
                    if ($ca_status == "New") {
                        $this->dbConnect()->query("UPDATE tbl_cashAdvance SET remainingAmount = $remainingBalance, ca_status = 'Ongoing' WHERE requestID = $requestID");
                    }
                    else if ($remainingBalance == 0) {
                        $this->dbConnect()->query("UPDATE tbl_cashAdvance SET remainingAmount = $remainingBalance, ca_status = 'Paid' WHERE requestID = $requestID");
                    } 
                    else {
                        $this->dbConnect()->query("UPDATE tbl_cashAdvance SET remainingAmount = $remainingBalance WHERE requestID = $requestID");
                    }
                }

                if ($referralCount > 0) {
                    $this->dbConnect()->query("
                        SELECT * 
                        FROM tbl_referral 
                        WHERE referrer_empID = $employee_id 
                        AND (
                            (threeMonths BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo' AND threeMonths_status = 0)
                            OR
                            (sixMonths BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo' AND sixMonths_status = 0))");

                    // UPDATE 3-MONTH STATUS
                    $this->dbConnect()->query("
                        UPDATE tbl_referral 
                        SET threeMonths_status = 1 
                        WHERE referrer_empID = $employee_id 
                        AND threeMonths BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo'
                        AND threeMonths_status = 0
                    ");

                    // UPDATE 6-MONTH STATUS
                    $this->dbConnect()->query("
                        UPDATE tbl_referral 
                        SET sixMonths_status = 1 
                        WHERE referrer_empID = $employee_id 
                        AND sixMonths BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo'
                        AND sixMonths_status = 0
                    ");

                } 
            }
        }

        public function resetCAPaymentHistory($payrollID) {
            $resetQuery = "
                SELECT * FROM {$this->caPaymentHistory} cap
                INNER JOIN {$this->cashAdvance} AS ca
                ON cap.requestID = ca.requestID
                WHERE payrollID = $payrollID";
            return $resetQuery;
        }

        public function resetNewCAstatus($requestID, $remainingAmount) {
            $newCAstatus = "
                UPDATE {$this->cashAdvance} SET
                remainingAmount = $remainingAmount, 
                ca_status = 'New'
                WHERE requestID = $requestID";
            return $newCAstatus;
        }

        public function resetOngoingCAstatus($requestID, $remainingAmount) {
            $ongoingCAstatus = "
                UPDATE {$this->cashAdvance} SET
                remainingAmount = $remainingAmount, 
                ca_status = 'Ongoing'
                WHERE requestID = $requestID";
            return $ongoingCAstatus;
        }

        public function resetCAstatus($requestID, $remainingAmount) {
            $ongoingCAstatus = "
                UPDATE {$this->cashAdvance} SET
                remainingAmount = $remainingAmount
                WHERE requestID = $requestID";
            return $ongoingCAstatus;
        }

        public function deleteCAPaymentHistory($payrollID) {
            $deleteCAPaymentHistory = "
                DELETE FROM {$this->caPaymentHistory} WHERE payrollID = $payrollID";
            return $deleteCAPaymentHistory;
        }

        public function updateCalculatedPayroll($payrollID) {
            $updatePayroll = "
                UPDATE ".$this->payroll." SET status = 'Calculated' WHERE payrollID = $payrollID";
            return $updatePayroll;
        }

        public function deletePayroll($payrollID) {
            $deletePayroll = "
                DELETE FROM ".$this->payroll." WHERE payrollID = $payrollID";
            return $deletePayroll;
        }

        public function deletePayslip($payrollID) {
            $deletePayslip = "
                DELETE FROM ".$this->payslip." WHERE payrollID = $payrollID";
            return $deletePayslip;
        }

        public function viewAllPayslips($payrollID) {
            $viewAllPayslips = "
                SELECT * FROM ".$this->payslip . " AS payslip
                INNER JOIN ".$this->employees." AS employee 
                ON payslip.empID = employee.id
                INNER JOIN ".$this->department." AS department 
                ON employee.departmentID = department.departmentID
                WHERE payrollID = $payrollID";
            return $viewAllPayslips;
        }

        public function getPayrollID($payrollCycleID) {
            $getPayrollID = "
                SELECT * FROM ".$this->payroll." WHERE payrollCycleID = $payrollCycleID";
            return $getPayrollID;
        }

        public function viewPayslip($payrollID, $empID) {
            $viewPayslip = "
                SELECT * FROM ".$this->payslip . " AS payslip
                INNER JOIN ".$this->employees." AS employee 
                ON payslip.empID = employee.id
                INNER JOIN ".$this->requirements." AS requirements
                ON employee.id = requirements.empID
                INNER JOIN ".$this->designation." AS designation 
                ON employee.designationID = designation.designationID
                INNER JOIN ".$this->department." AS department
                ON employee.departmentID = department.departmentID
                WHERE payrollID = $payrollID AND payslip.empID = $empID";
            return $viewPayslip;
        }

        public function updateEmploymentStatus($id, $dateRegularized) {
            $employee = "
                UPDATE ".$this->employees." SET 
                employmentStatus = 'Regular',
                dateRegularized = '$dateRegularized'
                WHERE id = '$id' AND e_status = 'Active'";
            return $employee;
        }


        public function addLeavePoints($id, $addLeavePoints) {
            $employee = "
                UPDATE ".$this->employees." SET 
                leavePoints = ROUND(leavePoints + $addLeavePoints, 2)
                WHERE id = '$id' AND designationID != 12 AND e_status = 'Active'";
            return $employee;
        }

        public function resetLeavePoints($id) {
            $employee = "
                UPDATE ".$this->employees." SET 
                leavePoints = 0.00
                WHERE (id = '$id' AND employmentStatus = 'Regular') AND (designationID != 4 AND e_status = 'Active')";
            return $employee;
        }

        public function resetLeavePointsTL($id, $leavePoints) {
            $employee = "
                UPDATE ".$this->employees." SET 
                leavePoints = 0.00, 
                carryOverVLPoints = '$leavePoints'
                WHERE (id = '$id' AND employmentStatus = 'Regular') AND (designationID = 4 AND e_status = 'Active')";
            return $employee;
        }

        public function runLeaveManagement() {
            $currentDate = date('Y-m-d');

            // CHECK IF THE SCRIPT HAS BEEN RUN TODAY
            $checkLogQuery = "SELECT 1 FROM script_logs WHERE run_date = '$currentDate' LIMIT 1";
            $logResult = $this->dbConnect()->query($checkLogQuery);

            if (mysqli_num_rows($logResult) === 0) {
                // BEGINNING OF THE YEAR
                $newYear = date('Y-01-01');

                // END OF THE MONTH DATES
                // $febMonth = date('Y-02-28');
                // $febMonthLY = date('Y-02-29');
                // $thirtyDays = date('Y-m-30');
                // $thirtyOneDays = date('Y-m-02');
                $isLastDayOfMonth = (date('Y-m-d') === date('Y-m-t'));

                $employeesQuery = $this->dbConnect()->query("SELECT * FROM ".$this->employees." WHERE designationID != 12 AND e_status = 'Active'");
                while ($employeeDetails = mysqli_fetch_assoc($employeesQuery)) {
                    $id = $employeeDetails['id'];
                    $employmentStatus = $employeeDetails['employmentStatus'];

                    // NEW YEAR LEAVE POINTS RESET
                    if ($currentDate === $newYear) {
                        $leavePoints = $employeeDetails['leavePoints'];

                        // RESET LEAVE POINTS FOR TL
                        $resetTLQuery =$this->resetLeavePointsTL($id, $leavePoints);
                        $this->dbConnect()->query($resetTLQuery);
                        
                        // RESET LEAVE POINTS FOR REGULAR EMPLOYEES
                        $resetQuery =$this->resetLeavePoints($id);
                        $this->dbConnect()->query($resetQuery);
                    }
                    // LEAVE POINTS ACCUMULATION
                    // elseif (($currentDate == $febMonth || $currentDate == $febMonthLY || $currentDate == $thirtyDays || $currentDate == $thirtyOneDays) && $employmentStatus == "Regular") {
                    elseif ($isLastDayOfMonth && $employmentStatus === "Regular") {
                        $vl = $employeeDetails['availableVL'];
                        $addLeavePoints = ($vl == 10) ? 0.83 : 1.25;
                        $addLeavePointsQuery = $this->addLeavePoints($id, $addLeavePoints);
                        $this->dbConnect()->query($addLeavePointsQuery);
                    }

                    // REGULARIZATION
                    $dateHired = $employeeDetails['dateHired'];
                    $dateRegularized = (new DateTime($dateHired))->modify('+6 months')->format('Y-m-d');

                    if ($currentDate === $dateRegularized && $employmentStatus === "Probationary") {
                        $updateEmploymentStatusQuery = $this->updateEmploymentStatus($id, $dateRegularized);
                        $this->dbConnect()->query($updateEmploymentStatusQuery);
                    }
                }

                // LOG THAT THE SCRIPT HAS BEEN RUN
                $logScriptQuery = "INSERT INTO script_logs (run_date) VALUES ('$currentDate')";
                $this->dbConnect()->query($logScriptQuery);
            } 
        }
    }
?>