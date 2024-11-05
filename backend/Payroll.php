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
        private $empReimbursements = 'tbl_empreimbursements';
        private $empDeductions = 'tbl_empdeductions';
        private $empAdjustments = 'tbl_empadjustments';
        private $holidays = 'tbl_holidays';
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

        public function addEmpReimbursement_once($id, $reimbursementID, $reimbursementType, $amount, $effectiveDate) {
            $addEmpReimbursement = "
                INSERT INTO ".$this->empReimbursements." (empID, reimbursementID, type, amount, effectiveDate, dateCreated)
                VALUES ('$id', '$reimbursementID', '$reimbursementType', '$amount', '$effectiveDate', CURRENT_TIMESTAMP())";
            return $addEmpReimbursement;
        }

        public function addEmpDeduction_once($id, $deductionID, $deductionType, $amount, $effectiveDate) {
            $addEmpADeduction = "
                INSERT INTO ".$this->empDeductions." (empID, deductionID, type, amount, effectiveDate, dateCreated)
                VALUES ('$id', '$deductionID', '$deductionType', '$amount', '$effectiveDate', CURRENT_TIMESTAMP())";
            return $addEmpADeduction;
        }

        public function addEmpAdjustment_once($id, $adjustmentID, $adjustmentType, $amount, $effectiveDate) {
            $addEmpAdjustment = "
                INSERT INTO ".$this->empAdjustments." (empID, adjustmentID, type, amount, effectiveDate, dateCreated)
                VALUES ('$id', '$adjustmentID', '$adjustmentType', '$amount', '$effectiveDate', CURRENT_TIMESTAMP())";
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
        
        public function addHoliday($name, $dateFrom, $dateTo, $type) {
            $addHoliday = "
                INSERT INTO ".$this->holidays." (holidayName, dateFrom, dateTo, type)
                VALUES ('$name', '$dateFrom', '$dateTo', '$type')";
            return $addHoliday;
        }

        public function updateHoliday($holidayID, $name, $dateFrom, $dateTo, $type) {
            $updateHoliday = "
                UPDATE ".$this->holidays." SET 
                holidayName = '$name', 
                dateFrom = '$dateFrom', 
                dateTo = '$dateTo', 
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

        public function viewAllPayroll() {
            $payroll = "
                SELECT payrollID, payroll.payrollCycleID, 
                payrollCycleFrom, payrollCycleTo, status 
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

        // public function viewAllPayrollCycle() {
        //     $payrollCycle = "
        //         SELECT * FROM ".$this->payrollCycle;
        //     return $payrollCycle;
        // }

        public function viewAllPayrollCycle2() {
            $payrollCycle = "
                SELECT * FROM ".$this->payrollCycle . " AS payrollCycle
                WHERE payrollCycleID NOT IN (SELECT payrollCycleID FROM ".$this->payroll." AS payroll)
                ORDER BY payrollCycle.payrollCycleID ASC";
            return $payrollCycle;
        }

        public function viewPayrollCycle($payrollCycleID) {
            $viewPayrollCycle = "
                SELECT * FROM ".$this->payrollCycle."
                WHERE payrollCycleID = '$payrollCycleID'";
            return $viewPayrollCycle;
        }

        public function calculateNightDifferential($attendanceTime, $logTypeID, $lateMins, $undertimeMins) {
            // Define the start and end times for the night differential period
            $nightStart = new DateTime("22:00");
            $nightEnd = new DateTime("06:00");
            // Initialize variables to store Time In and Time Out
            static $timeIn = null;
            static $timeOut = null;
            static $static_lateMins = null;
            $totalNightHours = 0;
        
            // Assign Time In or Time Out based on logTypeID
            if ($logTypeID == 1 || $logTypeID == 2) { // Time In or Late
                $timeIn = new DateTime("{$attendanceTime}");
                $static_lateMins = $lateMins;
            } elseif ($logTypeID == 3 || $logTypeID == 4) { // Time Out or Undertime
                $timeOut = new DateTime("{$attendanceTime}");
            }

            if ($timeIn && $timeOut) {
                // Adjust if timeOut goes into the next day (past midnight)
                if ($timeOut < $timeIn) {
                    $timeOut->modify('+1 day');
                }

                // Deduct 1 hour for the lunch break
                $timeOut->modify('-1 hour');

                if ($static_lateMins > 0) {
                    $timeIn->modify('+1 hour');
                }
        
                // Adjust nightEnd to handle overnight span
                $nightEndAdjusted = (clone $nightEnd)->modify('+1 day');
        
                // Check if the shift period overlaps with the night differential period
                if ($timeOut > $nightStart || $timeIn < $nightEndAdjusted) {
                    // Calculate the overlap start and end times
                    $effectiveStart = max($timeIn, $nightStart);
                    $effectiveEnd = min($timeOut, $nightEndAdjusted);
        
                    // Calculate night differential hours if there is an overlap
                    if ($effectiveStart < $effectiveEnd) {
                        $interval = $effectiveStart->diff($effectiveEnd);
                        $hours = $interval->h + floor($interval->i / 60); // Convert minutes to hours
                        $totalNightHours += $hours;
                    }
                }
                // Reset Time In and Time Out for the next calculation
                $timeIn = null;
                $timeOut = null;
            }
            return $totalNightHours; // Return the calculated night differential hours
        } 
    
        public function calculatePayroll($payrollID, $payrollCycleID) {
            function formatDate($date) {
                // Get the current year
                $currentYear = date('Y');
                
                // Append the current year to the input date
                $dateWithYear = $date . '-' . $currentYear;
                
                // Create a DateTime object from the string (expects format MM-DD-YYYY)
                $dateTime = DateTime::createFromFormat('m-d-Y', $dateWithYear);
                
                // Format the date as 'M d, Y'
                return $dateTime->format('Y-m-d');
            }

            $payrollCycleFrom_date = $this->dbConnect()->query("SELECT * FROM tbl_payrollcycle WHERE payrollCycleID = $payrollCycleID")->fetch_assoc()['payrollCycleFrom']; 
            $payrollCycleTo_date = $this->dbConnect()->query("SELECT * FROM tbl_payrollcycle WHERE payrollCycleID = $payrollCycleID")->fetch_assoc()['payrollCycleTo'];
            $payrollCycleFrom = formatDate($payrollCycleFrom_date);
            $payrollCycleTo = formatDate($payrollCycleTo_date);
            $employees = $this->dbConnect()->query("SELECT * FROM tbl_employee");
            while ($employeeDetails = mysqli_fetch_array($employees)) {
                $employee_id = $employeeDetails['id'];
                $employee_dailyRate = $employeeDetails['dailyRate'];
                $employee_hourlyRate = $employeeDetails['hourlyRate'];

                $daysWorkedQuery = $this->dbConnect()->query("SELECT * FROM tbl_attendance WHERE empID = $employeeDetails[id] AND (logTypeID IN (1, 2) OR logTypeID IN (3, 4)) AND attendanceDate BETWEEN DATE(CONCAT(YEAR(CURDATE()), '-', MONTH('$payrollCycleFrom'), '-', DAY('$payrollCycleFrom'))) AND DATE(CONCAT(YEAR(CURDATE()), '-', MONTH('$payrollCycleTo'), '-', DAY('$payrollCycleTo')))");
                $employee_daysWorked = round(mysqli_num_rows($daysWorkedQuery) / 2);
                $employee_grossPay = round($employee_dailyRate * $employee_daysWorked, 2);

                $totalNightHours = 0;
                while ($attendanceLogs = mysqli_fetch_array($daysWorkedQuery)) {
                    // $date = $attendanceLogs['attendanceDate'];
                    $attendanceTime = $attendanceLogs['attendanceTime'];
                    $logTypeID = $attendanceLogs['logTypeID'];
                    $lateMins = $attendanceLogs['lateMins'];
                    $undertimeMins = $attendanceLogs['undertimeMins'];
                    $nightHours = $this->calculateNightDifferential($attendanceTime, $logTypeID, $lateMins, $undertimeMins);
                    $totalNightHours += $nightHours;
                }
                $totalNightHours = round($totalNightHours, 0);
                $employee_nightDiffPay = round(($employee_hourlyRate * .15) * $totalNightHours, 2);
                
                // ADD ALL PAYROLL DATA TO PAYSLIP TABLE
                $this->dbConnect()->query("INSERT INTO $this->payslip (payrollID, empID, daysWorked, regNightDiff, pay_regNightDiff, grossPay) VALUES ('$payrollID', '$employee_id', '$employee_daysWorked', '$totalNightHours', '$employee_nightDiffPay', '$employee_grossPay')");
            }
            return;
        }

        public function updateCalculatedPayroll($payrollID) {
            $updatePayroll = "
                UPDATE ".$this->payroll." SET status = 'Calculated' WHERE payrollID = $payrollID";
            return $updatePayroll;
        }

        public function viewAllPayslips($payrollID) {
            $viewAllPayslips = "
                SELECT * FROM ".$this->payslip . " AS payslip
                INNER JOIN ".$this->employees." AS employee ON payslip.empID = employee.id
                WHERE payrollID = $payrollID";
            return $viewAllPayslips;
        }

        public function reCalculatePayroll($payrollID, $payrollCycleID) {
            // DELETE CURRENT PAYSLIP - RE-CALCULATE FUNCTION
            $this->dbConnect()->query("DELETE FROM tbl_payslip WHERE payroll_id = $payrollID");

        }
    }
?>