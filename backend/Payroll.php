<?php

    class Payroll extends Database
    {
        private $employees = 'tbl_employee';
        private $designation = 'tbl_designation';
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

        public function calculateNightDifferential($attendanceTime, $logTypeID, $lateMins, $payrollCycleFrom, $payrollCycleTo, $attendanceDate) {
            $nightStart = new DateTime("22:00");
            $nightEnd = new DateTime("06:00");
        
            static $timeIn = null;
            static $timeOut = null;
            static $date_in = null;
            static $date_out = null;
            static $static_lateMins = null;
        
            $totalRegularNightHours = 0;
            $totalRegularHolidayHours = 0;
            $totalRegularHolidayNightHours = 0;
            $totalSpecialHolidayHours = 0;
            $totalSpecialHolidayNightHours = 0;
        
            if ($logTypeID == 1 || $logTypeID == 2) {
                $timeIn = new DateTime($attendanceTime);
                $static_lateMins = $lateMins;
                $date_in = $attendanceDate;
            } elseif ($logTypeID == 3 || $logTypeID == 4) {
                $timeOut = new DateTime($attendanceTime);
                $date_out = $attendanceDate;
            }
        
            if ($timeIn && $timeOut) {
                if ($timeOut < $timeIn) {
                    $timeOut->modify('+1 day');
                }
        
                if ($static_lateMins > 0) {
                    $timeIn->modify('+' . floor($static_lateMins / 60) . ' hours ' . ($static_lateMins % 60) . ' minutes');
                }
                
                // // DEDUCT 1 HOUR FOR LUNCH BREAK
                // $timeOut->modify('-1 hour');
                
                $midnight = new DateTime($timeIn->format('Y-m-d') . ' 23:59:59');
                $nightEndAdjusted = (clone $nightEnd)->modify('+1 day');
        
                if ($timeOut > $midnight) {
                    // DEDUCT 1 HOUR FOR LUNCH BREAK
                    $timeOut->modify('-1 hour');
                    $this->calculateSegmentHours($timeIn, $midnight, $payrollCycleFrom, $payrollCycleTo, $date_in, $nightStart, $nightEndAdjusted, $totalRegularNightHours, $totalRegularHolidayHours, $totalRegularHolidayNightHours, $totalSpecialHolidayHours, $totalSpecialHolidayNightHours);
                    $this->calculateSegmentHours($midnight->modify('+1 second'), $timeOut, $payrollCycleFrom, $payrollCycleTo, $date_out, $nightStart, $nightEndAdjusted, $totalRegularNightHours, $totalRegularHolidayHours, $totalRegularHolidayNightHours, $totalSpecialHolidayHours, $totalSpecialHolidayNightHours);
                } else {
                    $timeIn->modify('+1 hour');
                    $this->calculateSegmentHours($timeIn, $timeOut, $payrollCycleFrom, $payrollCycleTo, $date_in, $nightStart, $nightEndAdjusted, $totalRegularNightHours, $totalRegularHolidayHours, $totalRegularHolidayNightHours, $totalSpecialHolidayHours, $totalSpecialHolidayNightHours);
                }
        
                $timeIn = null;
                $timeOut = null;
            }
        
            return [
                'totalRegularNightHours' => $totalRegularNightHours,
                'totalRegularHolidayHours' => $totalRegularHolidayHours,
                'totalRegularHolidayNightHours' => $totalRegularHolidayNightHours,
                'totalSpecialHolidayHours' => $totalSpecialHolidayHours,
                'totalSpecialHolidayNightHours' => $totalSpecialHolidayNightHours
            ];
        }
        
        private function calculateSegmentHours($start, $end, $payrollCycleFrom, $payrollCycleTo, $attendanceDate, $nightStart, $nightEndAdjusted, &$totalRegularNightHours, &$totalRegularHolidayHours, &$totalRegularHolidayNightHours, &$totalSpecialHolidayHours, &$totalSpecialHolidayNightHours) {
            static $holidays = null;
            
            if ($holidays === null) {
                $holidays = [];
                $holidaysQuery = $this->dbConnect()->query("SELECT * FROM tbl_holidays WHERE dateFrom BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo'");
                while ($holidayDetails = mysqli_fetch_array($holidaysQuery)) {
                    $holidays[$holidayDetails['dateFrom']] = $holidayDetails['type'];
                }
            }

            // CALCULATE HOURS WORKED DURING HOLIDAYS
            $interval = $start->diff($end);
            $hoursWorked = $interval->h + round($interval->i / 60);
        
            if (isset($holidays[$attendanceDate])) {
                if ($holidays[$attendanceDate] == 'Regular') {
                    $totalRegularHolidayHours += $hoursWorked;
                } elseif ($holidays[$attendanceDate] == 'Special') {
                    $totalSpecialHolidayHours += $hoursWorked;
                }
            }
        
            if ($end > $nightStart || $start < $nightEndAdjusted) {
                $effectiveStart = max($start, $nightStart);
                $effectiveEnd = min($end, $nightEndAdjusted);
        
                if ($effectiveStart < $effectiveEnd) {
                    $nightInterval = $effectiveStart->diff($effectiveEnd);
                    $nightHours = $nightInterval->h + round($nightInterval->i / 60);
        
                    if (isset($holidays[$attendanceDate])) {
                        if ($holidays[$attendanceDate] == 'Regular') {
                            $totalRegularHolidayNightHours += $nightHours;
                        } elseif ($holidays[$attendanceDate] == 'Special') {
                            $totalSpecialHolidayNightHours += $nightHours;
                        }
                    } else {
                        $totalRegularNightHours += $nightHours;
                    }
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
        
        public function testCalculatePayroll($payrollID, $payrollCycleID) {
            function formatDate($date) {
                // GET CURRENT YEAR
                $currentYear = date('Y');

                // APPEND THE CURRENT YEAR TO THE INPUT DATE
                $dateWithYear = $date . '-' . $currentYear;

                $dateTime = DateTime::createFromFormat('m-d-Y', $dateWithYear);

                return $dateTime->format('Y-m-d');
            }

            // GET PAYROLL CYCLE DETAILS
            $payrollCycleFrom_date = $this->dbConnect()->query("SELECT * FROM tbl_payrollcycle WHERE payrollCycleID = $payrollCycleID")->fetch_assoc()['payrollCycleFrom'];
            $payrollCycleTo_date = $this->dbConnect()->query("SELECT * FROM tbl_payrollcycle WHERE payrollCycleID = $payrollCycleID")->fetch_assoc()['payrollCycleTo'];
            $payrollCycleFrom = formatDate($payrollCycleFrom_date);
            $payrollCycleTo = formatDate($payrollCycleTo_date);

            // GET EMPLOYEE DETAILS
            $employees = $this->dbConnect()->query("SELECT * FROM tbl_employee WHERE designationID != 12");
            while ($employeeDetails = mysqli_fetch_array($employees)) {
                $employee_id = $employeeDetails['id'];
                $employee_dailyRate = $employeeDetails['dailyRate'];
                $employee_hourlyRate = $employeeDetails['hourlyRate'];
                $employee_cashAdvance = ($employeeDetails['cashAdvance'] != null) ? $employeeDetails['cashAdvance'] : null;

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
                $communication = 0;
                $sss = 0;
                $phic = 0;
                $hdmf = 0;  
                $salaryLoan = 0;
                $mpl = 0;
                $smart = 0;
                $cashAdvance = 0;
                $totalAllowances = 0;
                $totalReimbursements = 0;
                $totalAdjustments = 0;

                // INITIALIZE VARIABLES FOR PAYROLL COMPUTATION
                $basePay = 0;
                $grossPay = 0;
                $netPay = 0;

                
                // COMPUTE HOURS WORKED
                while ($attendanceLogs = mysqli_fetch_array($daysWorkedQuery)) {
                    $date = $attendanceLogs['attendanceDate'];
                    $attendanceTime = $attendanceLogs['attendanceTime'];
                    $logTypeID = $attendanceLogs['logTypeID'];
                    $lateMins = $attendanceLogs['lateMins'];
                    $undertimeMins = $attendanceLogs['undertimeMins'];
                    
                    $result = $this->calculateNightDifferential($attendanceTime, $logTypeID, $lateMins, $payrollCycleFrom, $payrollCycleTo, $date);
                    $totalNightHours += $result['totalRegularNightHours'];
                    $totalRegularHolidayHours += $result['totalRegularHolidayHours'];
                    $totalRegularHolidayNDHours += $result['totalRegularHolidayNightHours'];
                    $totalSpecialHolidayHours += $result['totalSpecialHolidayHours'];
                    $totalSpecialHolidayNDHours += $result['totalSpecialHolidayNightHours'];
                }

                // COMPUTE OVERTIME HOURS
                $overtimeQuery = $this->dbConnect()->query(("SELECT * FROM tbl_filedot WHERE empID = $employee_id AND (otDate BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo') AND status = '2'"));
                while ($overtime = mysqli_fetch_array($overtimeQuery)) {
                    if (isset($holidays[$overtime['otDate']])) {
                        // REGULAR HOLIDAY
                        if ($holidays[$overtime['otDate']] == "Regular") {
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
                        $sss = $deductionDetails['amount'];
                    }
                    else if ($deductionDetails['deductionName'] == "PHIC") {
                        $phic = $deductionDetails['amount'];
                    }
                    else if ($deductionDetails['deductionName'] == "HDMF") {
                        $hdmf = $deductionDetails['amount'];
                    }
                    else if ($deductionDetails['deductionName'] == "SSS Salary Loan") {
                        $salaryLoan = $deductionDetails['amount'];
                    }
                    else if ($deductionDetails['deductionName'] == "Pag_Ibig MPL") {
                        $mpl = $deductionDetails['amount'];
                    }
                    else if ($deductionDetails['deductionName'] == "Smart") {
                        $smart = $deductionDetails['amount'];
                    }
                    else if ($deductionDetails['deductionName'] == "Cash Advance") {
                        if ($deductionDetails['type'] == 1 && $payrollCycleID % 2 == 0) { // MONTHLY
                            $cashAdvance = $deductionDetails['amount'];
                        }
                        elseif ($deductionDetails['type'] == 2) { // SEMI-MONTHLY
                            $cashAdvance = $deductionDetails['amount'];
                        }
                        elseif ($deductionDetails['type'] == 3 && $deductionDetails['payrollCycleID'] == $payrollCycleID) { // ONCE
                            $cashAdvance = $deductionDetails['amount'];
                        }
                    }
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

                $basePay = round($employee_dailyRate * $employee_daysWorked, 2);
                $grossPay = round($basePay + $totalAllowances + $totalReimbursements + $totalAdjustments + $nightDiffPay +$overtimePay + $overtimeNDPay + $RDOTPay + $RDOTNDPay + $RDOTOTPay + $RDOTOTNDPay + $specialHolidayPay + $specialHolidayOTPay + $specialHolidayRDOTPay + $specialHolidayRDOTOTPay + $specialHolidayNDPay + $specialHolidayOTNDPay + $specialHolidayRDOTNDPay + $specialHolidayRDOTOTNDPay + $regularHolidayPay + $regularHolidayOTPay + $regularHolidayRDOTPay + $regularHolidayRDOTOTPay + $regularHolidayNDPay + $regularHolidayOTNDPay + $regularHolidayRDOTNDPay + $regularHolidayRDOTOTNDPay, 2);
                
                // COMPUTATION FOR WTAX
                $deductedGrossPay = round($grossPay - $sss - $phic - $hdmf, 2);
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
                $netPay = round($grossPay - $sss - $phic - $hdmf - $wtax + $totalReimbursements + $totalAdjustments - $cashAdvance + $totalAllowances + $communication, 2);
                $employee_cashAdvance -= $cashAdvance;
                
                // ADD ALL PAYROLL DATA TO PAYSLIP TABLE
                $this->dbConnect()->query("INSERT INTO $this->payslip (payrollID, empID, daysWorked, basePay, regNightDiff, pay_regNightDiff, regOT, pay_regOT, regOTND, pay_regOTND, regRDOT, pay_regRDOT, regRDOTND, pay_regRDOTND, regRDOTOT, pay_regRDOTOT, regRDOTOTND, pay_regRDOTOTND, specialHoliday, pay_specialHoliday, specialHolidayND, pay_specialHolidayND, specialHolidayOT, pay_specialHolidayOT,specialHolidayOTND, pay_specialHolidayOTND, specialHolidayRDOT, pay_specialHolidayRDOT, specialHolidayRDOTND, pay_specialHolidayRDOTND, specialHolidayRDOTOT, pay_specialHolidayRDOTOT, specialHolidayRDOTOTND, pay_specialHolidayRDOTOTND, regularHoliday, pay_regularHoliday, regularHolidayND, pay_regularHolidayND, regularHolidayOT, pay_regularHolidayOT, regularHolidayOTND, pay_regularHolidayOTND, regularHolidayRDOT, pay_regularHolidayRDOT, regularHolidayRDOTND, pay_regularHolidayRDOTND, regularHolidayRDOTOT, pay_regularHolidayRDOTOT, regularHolidayRDOTOTND, pay_regularHolidayRDOTOTND, payslip_allowances, payslip_communication, grossPay, payslip_sss, payslip_phic, payslip_hdmf, payslip_wtax, payslip_salaryLoan, payslip_mpl, payslip_smart, payslip_reimbursements, payslip_adjustments, payslip_cashAdvanceDeduction, payslip_cashAdvanceBalance, netPay) VALUES ($payrollID, $employee_id, $employee_daysWorked, $basePay, $totalNightHours, $nightDiffPay, $totalOvertimeHours, $overtimePay, $totalOvertimeNDHours, $overtimeNDPay, $totalRDOTHours, $RDOTPay, $totalRDOTNDhours, $RDOTNDPay, $totalRDOTOTHours, $RDOTOTPay, $totalRDOTOTNDHours, $RDOTOTNDPay, $totalSpecialHolidayHours, $specialHolidayPay, $totalSpecialHolidayNDHours, $specialHolidayNDPay, $totalSpecialHolidayOTHours, $specialHolidayOTPay, $totalSpecialHolidayOTNDHours, $specialHolidayOTNDPay, $totalSpecialHolidayRDOTHours, $specialHolidayRDOTPay, $totalSpecialHolidayRDOTNDHours, $specialHolidayRDOTNDPay, $totalSpecialHolidayRDOTOTHours, $specialHolidayRDOTOTPay, $totalSpecialHolidayRDOTOTNDHours, $specialHolidayRDOTOTNDPay, $totalRegularHolidayHours, $regularHolidayPay, $totalRegularHolidayNDHours, $regularHolidayNDPay, $totalRegularHolidayOTHours, $regularHolidayOTPay, $totalRegularHolidayOTNDHours, $regularHolidayOTNDPay, $totalRegularHolidayRDOTHours, $regularHolidayRDOTPay, $totalRegularHolidayRDOTNDHours, $regularHolidayRDOTNDPay, $totalRegularHolidayRDOTOTHours, $regularHolidayRDOTOTPay, $totalRegularHolidayRDOTOTNDHours, $regularHolidayRDOTOTNDPay, $totalAllowances, $communication, $grossPay, $sss, $phic, $hdmf, $wtax, $salaryLoan, $mpl, $smart, $totalReimbursements, $totalAdjustments, $cashAdvance, $employee_cashAdvance, $netPay)");

                if ($cashAdvance > 0) {
                    $this->dbConnect()->query("UPDATE tbl_employee SET cashAdvance = cashAdvance - $cashAdvance WHERE id = $employee_id");
                }
            }
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

            // GET EMPLOYEE DETAILS
            $employees = $this->dbConnect()->query("SELECT * FROM tbl_employee WHERE designationID != 12");
            while ($employeeDetails = mysqli_fetch_array($employees)) {
                $employee_id = $employeeDetails['id'];
                $employee_dailyRate = $employeeDetails['dailyRate'];
                $employee_hourlyRate = $employeeDetails['hourlyRate'];
                $employee_cashAdvance = ($employeeDetails['cashAdvance'] != null) ? $employeeDetails['cashAdvance'] : null;

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
                $communication = 0;
                $sss = 0;
                $phic = 0;
                $hdmf = 0;  
                $salaryLoan = 0;
                $mpl = 0;
                $smart = 0;
                $cashAdvance = 0;
                $totalAllowances = 0;
                $totalReimbursements = 0;
                $totalAdjustments = 0;

                // INITIALIZE VARIABLES FOR PAYROLL COMPUTATION
                $basePay = 0;
                $grossPay = 0;
                $netPay = 0;

                
                // COMPUTE HOURS WORKED
                while ($attendanceLogs = mysqli_fetch_array($daysWorkedQuery)) {
                    $date = $attendanceLogs['attendanceDate'];
                    $attendanceTime = $attendanceLogs['attendanceTime'];
                    $logTypeID = $attendanceLogs['logTypeID'];
                    $lateMins = $attendanceLogs['lateMins'];
                    $undertimeMins = $attendanceLogs['undertimeMins'];
                    
                    $result = $this->calculateNightDifferential($attendanceTime, $logTypeID, $lateMins, $payrollCycleFrom, $payrollCycleTo, $date);
                    $totalNightHours += $result['totalRegularNightHours'];
                    $totalRegularHolidayHours += $result['totalRegularHolidayHours'];
                    $totalRegularHolidayNDHours += $result['totalRegularHolidayNightHours'];
                    $totalSpecialHolidayHours += $result['totalSpecialHolidayHours'];
                    $totalSpecialHolidayNDHours += $result['totalSpecialHolidayNightHours'];
                }

                // COMPUTE OVERTIME HOURS
                $overtimeQuery = $this->dbConnect()->query(("SELECT * FROM tbl_filedot WHERE empID = $employee_id AND (otDate BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo') AND status = '2'"));
                while ($overtime = mysqli_fetch_array($overtimeQuery)) {
                    if (isset($holidays[$overtime['otDate']])) {
                        // REGULAR HOLIDAY
                        if ($holidays[$overtime['otDate']] == "Regular") {
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
                        $sss = $deductionDetails['amount'];
                    }
                    else if ($deductionDetails['deductionName'] == "PHIC") {
                        $phic = $deductionDetails['amount'];
                    }
                    else if ($deductionDetails['deductionName'] == "HDMF") {
                        $hdmf = $deductionDetails['amount'];
                    }
                    else if ($deductionDetails['deductionName'] == "SSS Salary Loan") {
                        $salaryLoan = $deductionDetails['amount'];
                    }
                    else if ($deductionDetails['deductionName'] == "Pag_Ibig MPL") {
                        $mpl = $deductionDetails['amount'];
                    }
                    else if ($deductionDetails['deductionName'] == "Smart") {
                        $smart = $deductionDetails['amount'];
                    }
                    else if ($deductionDetails['deductionName'] == "Cash Advance") {
                        if ($deductionDetails['type'] == 1 && $payrollCycleID % 2 == 0) { // MONTHLY
                            $cashAdvance = $deductionDetails['amount'];
                        }
                        elseif ($deductionDetails['type'] == 2) { // SEMI-MONTHLY
                            $cashAdvance = $deductionDetails['amount'];
                        }
                        elseif ($deductionDetails['type'] == 3 && $deductionDetails['payrollCycleID'] == $payrollCycleID) { // ONCE
                            $cashAdvance = $deductionDetails['amount'];
                        }
                    }
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

                $basePay = round($employee_dailyRate * $employee_daysWorked, 2);
                $grossPay = round($basePay + $totalAllowances + $totalReimbursements + $totalAdjustments + $nightDiffPay +$overtimePay + $overtimeNDPay + $RDOTPay + $RDOTNDPay + $RDOTOTPay + $RDOTOTNDPay + $specialHolidayPay + $specialHolidayOTPay + $specialHolidayRDOTPay + $specialHolidayRDOTOTPay + $specialHolidayNDPay + $specialHolidayOTNDPay + $specialHolidayRDOTNDPay + $specialHolidayRDOTOTNDPay + $regularHolidayPay + $regularHolidayOTPay + $regularHolidayRDOTPay + $regularHolidayRDOTOTPay + $regularHolidayNDPay + $regularHolidayOTNDPay + $regularHolidayRDOTNDPay + $regularHolidayRDOTOTNDPay, 2);
                
                // COMPUTATION FOR WTAX
                $deductedGrossPay = round($grossPay - $sss - $phic - $hdmf, 2);
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
                $netPay = round($grossPay - $sss - $phic - $hdmf - $wtax + $totalReimbursements + $totalAdjustments - $cashAdvance + $totalAllowances + $communication, 2);
                $employee_cashAdvance -= $cashAdvance;
                
                // ADD ALL PAYROLL DATA TO PAYSLIP TABLE
                $this->dbConnect()->query("INSERT INTO $this->payslip (payrollID, empID, daysWorked, basePay, regNightDiff, pay_regNightDiff, regOT, pay_regOT, regOTND, pay_regOTND, regRDOT, pay_regRDOT, regRDOTND, pay_regRDOTND, regRDOTOT, pay_regRDOTOT, regRDOTOTND, pay_regRDOTOTND, specialHoliday, pay_specialHoliday, specialHolidayND, pay_specialHolidayND, specialHolidayOT, pay_specialHolidayOT,specialHolidayOTND, pay_specialHolidayOTND, specialHolidayRDOT, pay_specialHolidayRDOT, specialHolidayRDOTND, pay_specialHolidayRDOTND, specialHolidayRDOTOT, pay_specialHolidayRDOTOT, specialHolidayRDOTOTND, pay_specialHolidayRDOTOTND, regularHoliday, pay_regularHoliday, regularHolidayND, pay_regularHolidayND, regularHolidayOT, pay_regularHolidayOT, regularHolidayOTND, pay_regularHolidayOTND, regularHolidayRDOT, pay_regularHolidayRDOT, regularHolidayRDOTND, pay_regularHolidayRDOTND, regularHolidayRDOTOT, pay_regularHolidayRDOTOT, regularHolidayRDOTOTND, pay_regularHolidayRDOTOTND, payslip_allowances, payslip_communication, grossPay, payslip_sss, payslip_phic, payslip_hdmf, payslip_wtax, payslip_salaryLoan, payslip_mpl, payslip_smart, payslip_reimbursements, payslip_adjustments, payslip_cashAdvanceDeduction, payslip_cashAdvanceBalance, netPay) VALUES ($payrollID, $employee_id, $employee_daysWorked, $basePay, $totalNightHours, $nightDiffPay, $totalOvertimeHours, $overtimePay, $totalOvertimeNDHours, $overtimeNDPay, $totalRDOTHours, $RDOTPay, $totalRDOTNDhours, $RDOTNDPay, $totalRDOTOTHours, $RDOTOTPay, $totalRDOTOTNDHours, $RDOTOTNDPay, $totalSpecialHolidayHours, $specialHolidayPay, $totalSpecialHolidayNDHours, $specialHolidayNDPay, $totalSpecialHolidayOTHours, $specialHolidayOTPay, $totalSpecialHolidayOTNDHours, $specialHolidayOTNDPay, $totalSpecialHolidayRDOTHours, $specialHolidayRDOTPay, $totalSpecialHolidayRDOTNDHours, $specialHolidayRDOTNDPay, $totalSpecialHolidayRDOTOTHours, $specialHolidayRDOTOTPay, $totalSpecialHolidayRDOTOTNDHours, $specialHolidayRDOTOTNDPay, $totalRegularHolidayHours, $regularHolidayPay, $totalRegularHolidayNDHours, $regularHolidayNDPay, $totalRegularHolidayOTHours, $regularHolidayOTPay, $totalRegularHolidayOTNDHours, $regularHolidayOTNDPay, $totalRegularHolidayRDOTHours, $regularHolidayRDOTPay, $totalRegularHolidayRDOTNDHours, $regularHolidayRDOTNDPay, $totalRegularHolidayRDOTOTHours, $regularHolidayRDOTOTPay, $totalRegularHolidayRDOTOTNDHours, $regularHolidayRDOTOTNDPay, $totalAllowances, $communication, $grossPay, $sss, $phic, $hdmf, $wtax, $salaryLoan, $mpl, $smart, $totalReimbursements, $totalAdjustments, $cashAdvance, $employee_cashAdvance, $netPay)");

                if ($cashAdvance > 0) {
                    $this->dbConnect()->query("UPDATE tbl_employee SET cashAdvance = cashAdvance - $cashAdvance WHERE id = $employee_id");
                }
            }
        }

        public function reCalculatePayroll($payrollID, $payrollCycleID) {
            // UPDATE CASH ADVANCE DETAILS
            $cashAdvanceQuery = $this->dbConnect()->query("SELECT * FROM tbl_payslip WHERE payrollID = $payrollID AND payslip_cashAdvanceDeduction > 0");
            while ($cashAdvanceDetails = mysqli_fetch_array($cashAdvanceQuery)) {
                $empID = $cashAdvanceDetails['empID'];
                $cashAdvance = $cashAdvanceDetails['payslip_cashAdvanceDeduction'];
                $this->dbConnect()->query("UPDATE tbl_employee SET cashAdvance = cashAdvance + $cashAdvance WHERE id = $empID");
            }

            // DELETE CURRENT PAYSLIP - RE-CALCULATE FUNCTION
            $this->dbConnect()->query("DELETE FROM tbl_payslip WHERE payrollID = $payrollID");

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

            // GET EMPLOYEE DETAILS
            $employees = $this->dbConnect()->query("SELECT * FROM tbl_employee WHERE designationID != 12");
            while ($employeeDetails = mysqli_fetch_array($employees)) {
                $employee_id = $employeeDetails['id'];
                $employee_dailyRate = $employeeDetails['dailyRate'];
                $employee_hourlyRate = $employeeDetails['hourlyRate'];
                $employee_cashAdvance = ($employeeDetails['cashAdvance'] != null) ? $employeeDetails['cashAdvance'] : null;

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
                $communication = 0;
                $sss = 0;
                $phic = 0;
                $hdmf = 0;  
                $salaryLoan = 0;
                $mpl = 0;
                $smart = 0;
                $cashAdvance = 0;
                $totalAllowances = 0;
                $totalReimbursements = 0;
                $totalAdjustments = 0;

                // INITIALIZE VARIABLES FOR PAYROLL COMPUTATION
                $basePay = 0;
                $grossPay = 0;
                $netPay = 0;

                
                // COMPUTE HOURS WORKED
                while ($attendanceLogs = mysqli_fetch_array($daysWorkedQuery)) {
                    $date = $attendanceLogs['attendanceDate'];
                    $attendanceTime = $attendanceLogs['attendanceTime'];
                    $logTypeID = $attendanceLogs['logTypeID'];
                    $lateMins = $attendanceLogs['lateMins'];
                    $undertimeMins = $attendanceLogs['undertimeMins'];
                    
                    $result = $this->calculateNightDifferential($attendanceTime, $logTypeID, $lateMins, $payrollCycleFrom, $payrollCycleTo, $date);
                    $totalNightHours += $result['totalRegularNightHours'];
                    $totalRegularHolidayHours += $result['totalRegularHolidayHours'];
                    $totalRegularHolidayNDHours += $result['totalRegularHolidayNightHours'];
                    $totalSpecialHolidayHours += $result['totalSpecialHolidayHours'];
                    $totalSpecialHolidayNDHours += $result['totalSpecialHolidayNightHours'];
                }

                // COMPUTE OVERTIME HOURS
                $overtimeQuery = $this->dbConnect()->query(("SELECT * FROM tbl_filedot WHERE empID = $employee_id AND (otDate BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo') AND status = '2'"));
                while ($overtime = mysqli_fetch_array($overtimeQuery)) {
                    if (isset($holidays[$overtime['otDate']])) {
                        // REGULAR HOLIDAY
                        if ($holidays[$overtime['otDate']] == "Regular") {
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
                        $sss = $deductionDetails['amount'];
                    }
                    else if ($deductionDetails['deductionName'] == "PHIC") {
                        $phic = $deductionDetails['amount'];
                    }
                    else if ($deductionDetails['deductionName'] == "HDMF") {
                        $hdmf = $deductionDetails['amount'];
                    }
                    else if ($deductionDetails['deductionName'] == "SSS Salary Loan") {
                        $salaryLoan = $deductionDetails['amount'];
                    }
                    else if ($deductionDetails['deductionName'] == "Pag_Ibig MPL") {
                        $mpl = $deductionDetails['amount'];
                    }
                    else if ($deductionDetails['deductionName'] == "Smart") {
                        $smart = $deductionDetails['amount'];
                    }
                    else if ($deductionDetails['deductionName'] == "Cash Advance") {
                        if ($deductionDetails['type'] == 1 && $payrollCycleID % 2 == 0) { // MONTHLY
                            $cashAdvance = $deductionDetails['amount'];
                        }
                        elseif ($deductionDetails['type'] == 2) { // SEMI-MONTHLY
                            $cashAdvance = $deductionDetails['amount'];
                        }
                        elseif ($deductionDetails['type'] == 3 && $deductionDetails['payrollCycleID'] == $payrollCycleID) { // ONCE
                            $cashAdvance = $deductionDetails['amount'];
                        }
                    }
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

                $basePay = round($employee_dailyRate * $employee_daysWorked, 2);
                $grossPay = round($basePay + $totalAllowances + $totalReimbursements + $totalAdjustments + $nightDiffPay +$overtimePay + $overtimeNDPay + $RDOTPay + $RDOTNDPay + $RDOTOTPay + $RDOTOTNDPay + $specialHolidayPay + $specialHolidayOTPay + $specialHolidayRDOTPay + $specialHolidayRDOTOTPay + $specialHolidayNDPay + $specialHolidayOTNDPay + $specialHolidayRDOTNDPay + $specialHolidayRDOTOTNDPay + $regularHolidayPay + $regularHolidayOTPay + $regularHolidayRDOTPay + $regularHolidayRDOTOTPay + $regularHolidayNDPay + $regularHolidayOTNDPay + $regularHolidayRDOTNDPay + $regularHolidayRDOTOTNDPay, 2);
                
                // COMPUTATION FOR WTAX
                $deductedGrossPay = round($grossPay - $sss - $phic - $hdmf, 2);
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
                $netPay = round($grossPay - $sss - $phic - $hdmf - $wtax + $totalReimbursements + $totalAdjustments - $cashAdvance + $totalAllowances + $communication, 2);
                $employee_cashAdvance -= $cashAdvance;
                
                // ADD ALL PAYROLL DATA TO PAYSLIP TABLE
                $this->dbConnect()->query("INSERT INTO $this->payslip (payrollID, empID, daysWorked, basePay, regNightDiff, pay_regNightDiff, regOT, pay_regOT, regOTND, pay_regOTND, regRDOT, pay_regRDOT, regRDOTND, pay_regRDOTND, regRDOTOT, pay_regRDOTOT, regRDOTOTND, pay_regRDOTOTND, specialHoliday, pay_specialHoliday, specialHolidayND, pay_specialHolidayND, specialHolidayOT, pay_specialHolidayOT,specialHolidayOTND, pay_specialHolidayOTND, specialHolidayRDOT, pay_specialHolidayRDOT, specialHolidayRDOTND, pay_specialHolidayRDOTND, specialHolidayRDOTOT, pay_specialHolidayRDOTOT, specialHolidayRDOTOTND, pay_specialHolidayRDOTOTND, regularHoliday, pay_regularHoliday, regularHolidayND, pay_regularHolidayND, regularHolidayOT, pay_regularHolidayOT, regularHolidayOTND, pay_regularHolidayOTND, regularHolidayRDOT, pay_regularHolidayRDOT, regularHolidayRDOTND, pay_regularHolidayRDOTND, regularHolidayRDOTOT, pay_regularHolidayRDOTOT, regularHolidayRDOTOTND, pay_regularHolidayRDOTOTND, payslip_allowances, payslip_communication, grossPay, payslip_sss, payslip_phic, payslip_hdmf, payslip_wtax, payslip_salaryLoan, payslip_mpl, payslip_smart, payslip_reimbursements, payslip_adjustments, payslip_cashAdvanceDeduction, payslip_cashAdvanceBalance, netPay) VALUES ($payrollID, $employee_id, $employee_daysWorked, $basePay, $totalNightHours, $nightDiffPay, $totalOvertimeHours, $overtimePay, $totalOvertimeNDHours, $overtimeNDPay, $totalRDOTHours, $RDOTPay, $totalRDOTNDhours, $RDOTNDPay, $totalRDOTOTHours, $RDOTOTPay, $totalRDOTOTNDHours, $RDOTOTNDPay, $totalSpecialHolidayHours, $specialHolidayPay, $totalSpecialHolidayNDHours, $specialHolidayNDPay, $totalSpecialHolidayOTHours, $specialHolidayOTPay, $totalSpecialHolidayOTNDHours, $specialHolidayOTNDPay, $totalSpecialHolidayRDOTHours, $specialHolidayRDOTPay, $totalSpecialHolidayRDOTNDHours, $specialHolidayRDOTNDPay, $totalSpecialHolidayRDOTOTHours, $specialHolidayRDOTOTPay, $totalSpecialHolidayRDOTOTNDHours, $specialHolidayRDOTOTNDPay, $totalRegularHolidayHours, $regularHolidayPay, $totalRegularHolidayNDHours, $regularHolidayNDPay, $totalRegularHolidayOTHours, $regularHolidayOTPay, $totalRegularHolidayOTNDHours, $regularHolidayOTNDPay, $totalRegularHolidayRDOTHours, $regularHolidayRDOTPay, $totalRegularHolidayRDOTNDHours, $regularHolidayRDOTNDPay, $totalRegularHolidayRDOTOTHours, $regularHolidayRDOTOTPay, $totalRegularHolidayRDOTOTNDHours, $regularHolidayRDOTOTNDPay, $totalAllowances, $communication, $grossPay, $sss, $phic, $hdmf, $wtax, $salaryLoan, $mpl, $smart, $totalReimbursements, $totalAdjustments, $cashAdvance, $employee_cashAdvance, $netPay)");

                if ($cashAdvance > 0) {
                    $this->dbConnect()->query("UPDATE tbl_employee SET cashAdvance = cashAdvance - $cashAdvance WHERE id = $employee_id");
                }
            }
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
                INNER JOIN ".$this->employees." AS employee ON payslip.empID = employee.id
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
                INNER JOIN ".$this->designation." AS designation 
                ON employee.designationID = designation.designationID
                WHERE payrollID = $payrollID AND empID = $empID";
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

        public function resetLeavePoints($id, $leavePoints) {
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
            $checkLogQuery = "SELECT * FROM script_logs WHERE run_date = '$currentDate'";
            $logResult = $this->dbConnect()->query($checkLogQuery);

            if (mysqli_num_rows($logResult) === 0) {
                // BEGINNING OF THE YEAR
                $newYear = date('Y-01-01');

                // END OF THE MONTH DATES
                $febMonth = date('Y-02-28');
                $febMonthLY = date('Y-02-29');
                $thirtyDays = date('Y-m-30');
                $thirtyOneDays = date('Y-m-02');

                $employeesQuery = $this->dbConnect()->query("SELECT * FROM ".$this->employees." WHERE designationID != 12 AND e_status = 'Active'");
                while ($employeeDetails = mysqli_fetch_array($employeesQuery)) {
                    $id = $employeeDetails['id'];
                    $employmentStatus = $employeeDetails['employmentStatus'];

                    // NEW YEAR LEAVE POINTS RESET
                    if ($currentDate == $newYear) {
                        $leavePoints = $employeeDetails['leavePoints'];

                        // RESET LEAVE POINTS FOR TL
                        $resetTLQuery =$this->resetLeavePointsTL($id, $leavePoints);
                        $this->dbConnect()->query($resetTLQuery);
                        
                        // RESET LEAVE POINTS FOR REGULAR EMPLOYEES
                        $resetQuery =$this->resetLeavePoints($id, $leavePoints);
                        $this->dbConnect()->query($resetQuery);
                    }
                    // LEAVE POINTS ACCUMULATION
                    elseif (($currentDate == $febMonth || $currentDate == $febMonthLY || $currentDate == $thirtyDays || $currentDate == $thirtyOneDays) && $employmentStatus == "Regular") {
                        $vl = $employeeDetails['availableVL'];
                        $addLeavePoints = ($vl == 10) ? 0.83 : 1.25;
                        $addLeavePointsQuery = $this->addLeavePoints($id, $addLeavePoints);
                        $this->dbConnect()->query($addLeavePointsQuery);
                    }

                    // REGULARIZATION
                    $dateHired = $employeeDetails['dateHired'];
                    $dateRegularized = (new DateTime($dateHired))->modify('+6 months')->format('Y-m-d');

                    if ($currentDate == $dateRegularized && $employmentStatus == "Probationary") {
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