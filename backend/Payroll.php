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
        private $allowances = 'tbl_allowances';
        private $deductions = 'tbl_deductions';

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
    }
?>