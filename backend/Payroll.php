<?php

    class Payroll extends Database
    {
        // private $employees = 'tbl_employee';
        // private $users = 'tbl_users';
        // private $department = 'tbl_department';
        // private $attendance = 'tbl_attendance';
        // private $logtype = 'tbl_logtype';
        // private $shifts = 'tbl_shiftschedule';
        // private $changeShift = 'tbl_changeshiftrequests';
        // private $leaves = 'tbl_leaveapplications';
        // private $filedOT = 'tbl_filedot';
        private $employees = 'tbl_employee';
        private $allowances = 'tbl_allowances';
        private $deductions = 'tbl_deductions';
        private $reimbursements = 'tbl_reimbursements';
        private $adjustments = 'tbl_adjustments';
        private $empAllowances = 'tbl_empallowances';
        private $empDeductions = 'tbl_empdeductions';
        private $payroll = 'tbl_payroll';
        private $payrollCycle = 'tbl_payrollcycle';
        private $payslip = 'tbl_payslip';

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

        public function updateAllowance($allowanceID, $allowanceName) {
            $updateAllowance = "
                UPDATE ".$this->allowances."
                SET allowanceName = '$allowanceName'
                WHERE allowanceID = '$allowanceID'";
            return $updateAllowance;
        }

        public function updateDeduction($deductionID, $deductionName) {
            $updateDeduction = "
                UPDATE ".$this->deductions."
                SET deductionName = '$deductionName'
                WHERE deductionID = '$deductionID'";
            return $updateDeduction;
        }

        public function deleteAllowance($allowanceID) {
            $deleteAllowance = "
                DELETE FROM ".$this->allowances."
                WHERE allowanceID = '$allowanceID'";
            return $deleteAllowance;
        }

        public function deleteDeduction($deductionID) {
            $deleteDeduction = "
                DELETE FROM ".$this->deductions."
                WHERE deductionID = '$deductionID'";
            return $deleteDeduction;
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

        public function checkEmpAllowance($id, $allowanceID) {
            $checkEmpAllowance = "
                SELECT * FROM ".$this->empAllowances."
                WHERE empID = '$id'
                AND allowanceID = '$allowanceID'";
            return $checkEmpAllowance;
        }

        public function addEmpAllowance($id, $allowanceID, $allowanceType, $amount) {
            $addEmpAllowance = "
                INSERT INTO ".$this->empAllowances." (empID, allowanceID, type, amount, dateCreated)
                VALUES ('$id', '$allowanceID', '$allowanceType', '$amount', CURRENT_TIMESTAMP())";
            return $addEmpAllowance;
        }

        public function addEmpAllowance_once($id, $allowanceID, $allowanceType, $amount, $effectiveDate) {
            $addEmpAllowance = "
                INSERT INTO ".$this->empAllowances." (empID, allowanceID, type, amount, effectiveDate, dateCreated)
                VALUES ('$id', '$allowanceID', '$allowanceType', '$amount', '$effectiveDate', CURRENT_TIMESTAMP())";
            return $addEmpAllowance;
        }

        public function checkEmpDeduction($id, $deductionID) {
            $checkEmpDeduction = "
                SELECT * FROM ".$this->empDeductions."
                WHERE empID = '$id'
                AND deductionID = '$deductionID'";
            return $checkEmpDeduction;
        }

        public function addEmpDeduction($id, $deductionID, $deductionType, $amount) {
            $addEmpADeduction = "
                INSERT INTO ".$this->empDeductions." (empID, deductionID, type, amount, dateCreated)
                VALUES ('$id', '$deductionID', '$deductionType', '$amount', CURRENT_TIMESTAMP())";
            return $addEmpADeduction;
        }

        public function addEmpDeduction_once($id, $deductionID, $deductionType, $amount, $effectiveDate) {
            $addEmpADeduction = "
                INSERT INTO ".$this->empDeductions." (empID, deductionID, type, amount, effectiveDate, dateCreated)
                VALUES ('$id', '$deductionID', '$deductionType', '$amount', '$effectiveDate', CURRENT_TIMESTAMP())";
            return $addEmpADeduction;
        }

        public function deleteEmpAllowance($empAllowanceID) {
            $deleteEmpAllowance = "
                DELETE FROM ".$this->empAllowances."
                WHERE empAllowanceID = '$empAllowanceID'";
            return $deleteEmpAllowance;
        }

        public function deleteEmpADeduction($empDeductionID) {
            $deleteEmpADeduction = "
                DELETE FROM ".$this->empDeductions."
                WHERE empDeductionID = '$empDeductionID'";
            return $deleteEmpADeduction;
        }

        public function viewAllPayroll() {
            $payroll = "
                SELECT * FROM ".$this->payroll." AS payroll
                INNER JOIN ".$this->payrollCycle." AS payrollCycle
                ON payroll.payrollCycleID = payrollCycle.payrollCycleID";
            return $payroll;
        }

        public function viewAllPayrollCycle() {
            $payrollCycle = "
                SELECT * FROM ".$this->payrollCycle;
            return $payrollCycle;
        }
    }
?>