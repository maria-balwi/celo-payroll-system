<?php

    class Employees extends Database
    {
        private $employees = 'tbl_employee';
        // private $users = 'tbl_users';
        private $department = 'tbl_department';
        // private $designation = 'tbl_designation';
        private $dbConnect = false;
        public function __construct() {
            $this->dbConnect = $this->dbConnect();
        }

        public function viewTeam() {
            $team = "
                SELECT * FROM ".$this->employees." AS employees
                INNER JOIN ".$this->department." AS department
                ON employees.departmentID = department.departmentID";
            return $team;
        }

    }

?>