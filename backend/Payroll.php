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
        private $empAllowances = 'tbl_empallowances';
        private $empDeductions = 'tbl_empdeductions';

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

        public function viewLastEmpAllowance() {
            $viewLastEmpAllowance = "
                SELECT * FROM ".$this->empAllowances."
                ORDER BY allowanceID DESC
                LIMIT 1";
            return $viewLastEmpAllowance;
        }

        public function checkEmpAllowance($id, $allowanceID) {
            $checkEmpAllowance = "
                SELECT * FROM ".$this->empAllowances."
                WHERE empID = '$id'
                AND allowanceID = '$allowanceID'";
            return $checkEmpAllowance;
        }
    }
?>