<?php

    class Users extends Database
    {
        private $employees = 'tbl_employee';
        private $users = 'tbl_users';
        private $department = 'tbl_department';
        private $designation = 'tbl_designation';
        private $dbConnect = false;
        public function __construct() {
            $this->dbConnect = $this->dbConnect();
        }

        public function isLoggedIn() {
            if ($_SESSION["logged_in"] == TRUE) {
                return true;
            }
            else {
                return false;
            }
        }
    }

?>