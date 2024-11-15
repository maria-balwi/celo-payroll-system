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

        // ORIGINAL
        // public function calculateNightDifferential($attendanceTime, $logTypeID, $lateMins) {
        //     // Define the start and end times for the night differential period
        //     $nightStart = new DateTime("22:00");
        //     $nightEnd = new DateTime("06:00");
        //     // Initialize variables to store Time In and Time Out
        //     static $timeIn = null;
        //     static $timeOut = null;
        //     static $static_lateMins = null;
        //     $totalNightHours = 0;
        
        //     // Assign Time In or Time Out based on logTypeID
        //     if ($logTypeID == 1 || $logTypeID == 2) { // Time In or Late
        //         $timeIn = new DateTime("{$attendanceTime}");
        //         $static_lateMins = $lateMins;
        //     } elseif ($logTypeID == 3 || $logTypeID == 4) { // Time Out or Undertime
        //         $timeOut = new DateTime("{$attendanceTime}");
        //     }

        //     if ($timeIn && $timeOut) {
        //         // Adjust if timeOut goes into the next day (past midnight)
        //         if ($timeOut < $timeIn) {
        //             $timeOut->modify('+1 day');
        //         }

        //         // Deduct 1 hour for the lunch break
        //         $timeOut->modify('-1 hour');

        //         if ($static_lateMins > 0) {
        //             $timeIn->modify('+1 hour');
        //         }
        
        //         // Adjust nightEnd to handle overnight span
        //         $nightEndAdjusted = (clone $nightEnd)->modify('+1 day');
        
        //         // Check if the shift period overlaps with the night differential period
        //         if ($timeOut > $nightStart || $timeIn < $nightEndAdjusted) {
        //             // Calculate the overlap start and end times
        //             $effectiveStart = max($timeIn, $nightStart);
        //             $effectiveEnd = min($timeOut, $nightEndAdjusted);
        
        //             // Calculate night differential hours if there is an overlap
        //             if ($effectiveStart < $effectiveEnd) {
        //                 $interval = $effectiveStart->diff($effectiveEnd);
        //                 $hours = $interval->h + floor($interval->i / 60); // Convert minutes to hours
        //                 $totalNightHours += $hours;
        //             }
        //         }
        //         // Reset Time In and Time Out for the next calculation
        //         $timeIn = null;
        //         $timeOut = null;
        //     }
        //     return $totalNightHours; // Return the calculated night differential hours
        // } 

        public function calculateNightDifferential($attendanceTime, $logTypeID, $lateMins, $payrollCycleFrom, $payrollCycleTo, $attendanceDate) {
            // Define the start and end times for the night differential period
            $nightStart = new DateTime("22:00");
            $nightEnd = new DateTime("06:00");

            // Initialize variables to store Time In and Time Out
            static $timeIn = null;
            static $timeOut = null;
            static $date_in = null;
            static $date_out = null;
            static $static_lateMins = null;
        
            // Initialize totals
            $totalRegularNightHours = 0;
            $totalRegularHolidayHours = 0;
            $totalRegularHolidayNightHours = 0;
            $totalSpecialHolidayHours = 0;
            $totalSpecialHolidayNightHours = 0;
        
            // Assign Time In or Time Out based on logTypeID
            if ($logTypeID == 1 || $logTypeID == 2) { // Time In or Late
                $timeIn = new DateTime("{$attendanceTime}");
                $static_lateMins = $lateMins;
                $date_in = $attendanceDate;
            } elseif ($logTypeID == 3 || $logTypeID == 4) { // Time Out or Undertime
                $timeOut = new DateTime("{$attendanceTime}");
                $date_out = $attendanceDate;
            }
        
            if ($timeIn && $timeOut) {
                // Adjust if timeOut goes into the next day (past midnight)
                if ($timeOut < $timeIn) {
                    $timeOut->modify('+1 day');
                }
        
                // Deduct 1 hour for lunch break if there's no late adjustment
                $timeOut->modify('-1 hour');
        
                // Add 1 hour for late adjustment
                if ($static_lateMins > 0) {
                    $timeIn->modify('+' . floor($static_lateMins / 60) . ' hour');
                }
        
                // Split into two segments if shift crosses midnight
                $midnight = new DateTime($timeIn->format('Y-m-d') . ' 23:59:59');
                $nightEndAdjusted = (clone $nightEnd)->modify('+1 day');
                
                if ($timeOut > $midnight) {
                    // Calculate hours for the first segment (timeIn to midnight)
                    $firstSegmentEnd = clone $midnight;
                    $this->calculateSegmentHours($timeIn, $firstSegmentEnd, $payrollCycleFrom, $payrollCycleTo, $date_in, $nightStart, $nightEndAdjusted, $totalRegularNightHours, $totalRegularHolidayHours, $totalRegularHolidayNightHours, $totalSpecialHolidayHours, $totalSpecialHolidayNightHours);
        
                    // Calculate hours for the second segment (midnight to timeOut)
                    $secondSegmentStart = (clone $midnight)->modify('+1 second');
                    $this->calculateSegmentHours($secondSegmentStart, $timeOut, $payrollCycleFrom, $payrollCycleTo, $date_out, $nightStart, $nightEndAdjusted, $totalRegularNightHours, $totalRegularHolidayHours, $totalRegularHolidayNightHours, $totalSpecialHolidayHours, $totalSpecialHolidayNightHours);
                } else {
                    // Single segment if timeOut does not cross midnight
                    $this->calculateSegmentHours($timeIn, $timeOut, $payrollCycleFrom, $payrollCycleTo, $date_in, $nightStart, $nightEndAdjusted, $totalRegularNightHours, $totalRegularHolidayHours, $totalRegularHolidayNightHours, $totalSpecialHolidayHours, $totalSpecialHolidayNightHours);
                }
        
                // Reset Time In and Time Out for the next calculation
                $timeIn = null;
                $timeOut = null;
                $date_in = null;
                $date_out = null;
            }
        
            // Return calculated totals
            return [
                'totalRegularNightHours' => $totalRegularNightHours,
                'totalRegularHolidayHours' => $totalRegularHolidayHours,
                'totalRegularHolidayNightHours' => $totalRegularHolidayNightHours,
                'totalSpecialHolidayHours' => $totalSpecialHolidayHours + $totalSpecialHolidayNightHours,
                'totalSpecialHolidayNightHours' => $totalSpecialHolidayNightHours
            ];
        }
        
        // Helper function to calculate hours for each segment
        private function calculateSegmentHours($start, $end, $payrollCycleFrom, $payrollCycleTo, $attendanceDate, $nightStart, $nightEndAdjusted, &$totalRegularNightHours, &$totalRegularHolidayHours, &$totalRegularHolidayNightHours, &$totalSpecialHolidayHours, &$totalSpecialHolidayNightHours) {
            // Fetch holidays within the payroll cycle and store in an array
            $holidaysQuery = $this->dbConnect()->query("SELECT * FROM tbl_holidays WHERE dateFrom BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo'");
            $holidays = [];
            while ($holidayDetails = mysqli_fetch_array($holidaysQuery)) {
                $holidays[$holidayDetails['dateFrom']] = $holidayDetails['type'];
            }
        
            // Calculate total hours for the segment
            $interval = $start->diff($end);
            $hoursWorked = $interval->h + floor($interval->i / 60); // Convert minutes to fractional hours
        
            // Add to holiday or regular hours based on holiday type
            if (isset($holidays[$attendanceDate]) && $holidays[$attendanceDate] == 'Regular') {
                $totalRegularHolidayHours += $hoursWorked;
            } elseif (isset($holidays[$attendanceDate]) && $holidays[$attendanceDate] == 'Special') {
                $totalSpecialHolidayHours += $hoursWorked;
            }
        
            // Calculate night differential hours if there is an overlap with the night period
            if ($end > $nightStart || $start < $nightEndAdjusted) {
                $effectiveStart = max($start, $nightStart);
                $effectiveEnd = min($end, $nightEndAdjusted);
        
                // Calculate night differential hours if there is an overlap
                if ($effectiveStart < $effectiveEnd) {
                    $nightInterval = $effectiveStart->diff($effectiveEnd);
                    $nightHours = $nightInterval->h + floor($nightInterval->i / 60); // Convert minutes to fractional hours
        
                    // Add to appropriate night differential total based on holiday type
                    if (isset($holidays[$attendanceDate]) && $holidays[$attendanceDate] == 'Regular') {
                        $totalRegularHolidayNightHours += abs($nightHours);
                    } elseif (isset($holidays[$attendanceDate]) && $holidays[$attendanceDate] == 'Special') {
                        $totalSpecialHolidayNightHours += abs($nightHours);
                    } else {
                        $totalRegularNightHours += abs($nightHours);
                    }
                }
            }
        }     
        
        // public function calculatePayroll($payrollID, $payrollCycleID) {
        //     function formatDate($date) {
        //         // Get the current year
        //         $currentYear = date('Y');
                
        //         // Append the current year to the input date
        //         $dateWithYear = $date . '-' . $currentYear;
                
        //         // Create a DateTime object from the string (expects format MM-DD-YYYY)
        //         $dateTime = DateTime::createFromFormat('m-d-Y', $dateWithYear);
                
        //         // Format the date as 'M d, Y'
        //         return $dateTime->format('Y-m-d');
        //     }

        //     // GET PAYROLL CYCLE DETAILS
        //     $payrollCycleFrom_date = $this->dbConnect()->query("SELECT * FROM tbl_payrollcycle WHERE payrollCycleID = $payrollCycleID")->fetch_assoc()['payrollCycleFrom']; 
        //     $payrollCycleTo_date = $this->dbConnect()->query("SELECT * FROM tbl_payrollcycle WHERE payrollCycleID = $payrollCycleID")->fetch_assoc()['payrollCycleTo'];
        //     $payrollCycleFrom = formatDate($payrollCycleFrom_date);
        //     $payrollCycleTo = formatDate($payrollCycleTo_date);

        //     // GET EMPLOYEE DETAILS
        //     $employees = $this->dbConnect()->query("SELECT * FROM tbl_employee");
        //     while ($employeeDetails = mysqli_fetch_array($employees)) {
        //         $employee_id = $employeeDetails['id'];
        //         $employee_dailyRate = $employeeDetails['dailyRate'];
        //         $employee_hourlyRate = $employeeDetails['hourlyRate'];

        //         // COMPUTE DAYS WORKED
        //         $daysWorkedQuery = $this->dbConnect()->query("SELECT * FROM tbl_attendance WHERE empID = $employeeDetails[id] AND (logTypeID IN (1, 2) OR logTypeID IN (3, 4)) AND attendanceDate BETWEEN DATE(CONCAT(YEAR(CURDATE()), '-', MONTH('$payrollCycleFrom'), '-', DAY('$payrollCycleFrom'))) AND DATE(CONCAT(YEAR(CURDATE()), '-', MONTH('$payrollCycleTo'), '-', DAY('$payrollCycleTo')))");
        //         $employee_daysWorked = round(mysqli_num_rows($daysWorkedQuery) / 2);

        //         // CHECK FOR HOLIDAYS
        //         $holidaysQuery = $this->dbConnect()->query("SELECT * FROM tbl_holidays WHERE dateFrom BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo'");
        //         $holidays = [];
        //         while ($holidayDetails = mysqli_fetch_array($holidaysQuery)) {
        //             $holidays[$holidayDetails['dateFrom']] = $holidayDetails['type'];
        //         }

        //         // INITIALIZE VARIABLES FOR HOURS WORKED COMPUTATION
        //         $totalNightHours = 0;
        //         $totalOvertimeHours = 0;
        //         $totalRDOTHours = 0;
        //         $totalSpecialHolidayHours = 0;
        //         $totalSpecialHolidayNDHours = 0;
        //         $totalRegularHolidayHours = 0;
        //         $totalRegularHolidayNDHours = 0;

        //         // INITIALIZE VARIABLES FOR DAYS WORKED (HOLIDAYS) COMPUTATION
        //         $specialHolidaysWorked = 0;
        //         $regularHolidaysWorked = 0;

        //         // INITIALIZE VARIABLES FOR PAYS COMPUTATION
        //         $employee_nightDiffPay = 0;
        //         $employee_overtimePay = 0;
        //         $employee_RDOTPay = 0;
        //         $employee_specialHolidayPay = 0;
        //         $employee_regularHolidayPay = 0;
        //         $employee_specialHolidayNDPay = 0;
        //         $employee_regularHolidayNDPay = 0;

        //         // ALLOWANCES, DEDUCTIONS, REIMBURSEMENTS, AND ADJUSTMENTS (=,-) COMPUTATION
        //         $totalAllowances = 0;
        //         $communication = 0;
        //         $sss = 0;
        //         $phic = 0;
        //         $hdmf = 0;
        //         $wtax = 0;
        //         $cashAdvance = 0;
        //         $totalReimbursements = 0;
        //         $totalAdjustments = 0;

        //         // COMPUTE HOURS WORKED
        //         while ($attendanceLogs = mysqli_fetch_array($daysWorkedQuery)) {
        //             $date = $attendanceLogs['attendanceDate'];
        //             $attendanceTime = $attendanceLogs['attendanceTime'];
        //             $logTypeID = $attendanceLogs['logTypeID'];
        //             $lateMins = $attendanceLogs['lateMins'];
        //             $undertimeMins = $attendanceLogs['undertimeMins'];

        //             if (isset($holidays[$date]) && $holidays[$date] == "Regular") {
        //                 // CALCULATE REGULAR HOLIDAY NIGHT DIFFERENTIAL HOURS
        //                 $regularHolidayNDHours = $this->calculateNightDifferential($attendanceTime, $logTypeID, $lateMins, $undertimeMins);
        //                 $totalRegularHolidayNDHours += $regularHolidayNDHours;
        //                 $regularHolidaysWorked++;
        //             }
        //             else if (isset($holidays[$date]) && $holidays[$date] == "Special") {
        //                 // CALCULATE SPECIAL HOLIDAY NIGHT DIFFERENTIAL HOURS
        //                 $specialHolidayNDHours = $this->calculateNightDifferential($attendanceTime, $logTypeID, $lateMins, $undertimeMins);
        //                 $totalSpecialHolidayNDHours += $specialHolidayNDHours;
        //                 $specialHolidaysWorked++;
        //             }
        //             else {
        //                 // CALCULATE REGULAR NIGHT DIFFERENTIAL HOURS
        //                 $nightHours = $this->calculateNightDifferential($attendanceTime, $logTypeID, $lateMins, $undertimeMins);
        //                 $totalNightHours += $nightHours;
        //             }
        //         }

        //         // COMPUTE OVERTIME HOURS
        //         $overtimesQuery = $this->dbConnect()->query("SELECT * FROM tbl_filedot WHERE empID = $employee_id AND (otDate BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo') AND status = '2'");
        //         while ($overtime = mysqli_fetch_array($overtimesQuery)) {
        //             if ($overtime['otType'] == "Regular") {
        //                 $totalOvertimeHours += $overtime['approvedOThours'];
        //                 if ($overtime['approvedOTmins'] >= 30) {
        //                     $totalOvertimeHours += 1;
        //                 }
        //             }
        //             else { // RDOT
        //                 $totalRDOTHours += $overtime['approvedOThours'];
        //                 if ($overtime['approvedOTmins'] >= 30) {
        //                     $totalRDOTHours += 1;
        //                 }
        //             }
        //         }

        //         // COMPUTATION FOR ALLOWANCES
        //         $allowancesQuery = $this->dbConnect()->query("SELECT amount, type FROM tbl_empallowances INNER JOIN tbl_allowances ON tbl_empallowances.allowanceID = tbl_allowances.allowanceID WHERE empID = $employee_id AND allowanceName NOT IN ('Communication', 'Communication Allowance')");
        //         while ($allowanceDetails = mysqli_fetch_array($allowancesQuery)) {
        //             if ($allowanceDetails['type'] == 1 && $payrollCycleID % 2 == 1) { // MONTHLY
        //                 $totalAllowances += $allowanceDetails['amount'];
        //             } elseif ($allowanceDetails['type'] == 2) { // SEMI-MONTHLY
        //                 $totalAllowances += $allowanceDetails['amount'];
        //             }
        //         }

        //         // COMPUTATION FOR COMMUNICATION ALLOWANCE
        //         $allowancesQuery = $this->dbConnect()->query("SELECT amount, type FROM tbl_empallowances INNER JOIN tbl_allowances ON tbl_empallowances.allowanceID = tbl_allowances.allowanceID WHERE empID = $employee_id AND allowanceName IN ('Communication', 'Communication Allowance')");
        //         while ($allowanceDetails = mysqli_fetch_array($allowancesQuery)) {
        //             if ($allowanceDetails['type'] == 1 && $payrollCycleID % 2 == 1) { // MONTHLY
        //                 $communication += $allowanceDetails['amount'];
        //             } elseif ($allowanceDetails['type'] == 2) { // SEMI-MONTHLY
        //                 $communication += $allowanceDetails['amount'];
        //             }
        //         }

        //         // COMPUTATION FOR DEDUCTIONS
        //         $deductionsQuery = $this->dbConnect()->query("SELECT amount, deductionName, type FROM tbl_empdeductions INNER JOIN tbl_deductions ON tbl_empdeductions.deductionID = tbl_deductions.deductionID WHERE empID = $employee_id");
        //         while ($deductionDetails = mysqli_fetch_array($deductionsQuery)) {
        //             if ($deductionDetails['deductionName'] == "SSS") {
        //                 $sss = $deductionDetails['amount'];
        //             }
        //             else if ($deductionDetails['deductionName'] == "PHIC") {
        //                 $phic = $deductionDetails['amount'];
        //             }
        //             else if ($deductionDetails['deductionName'] == "HDMF") {
        //                 $hdmf = $deductionDetails['amount'];
        //             }
        //             else if ($deductionDetails['deductionName'] == "WTAX") {
        //                 $wtax = $deductionDetails['amount'];
        //             }
        //             else if ($deductionDetails['deductionName'] == "CashAdvance") {
        //                 if ($deductionDetails['type'] == 1 && $payrollCycleID % 2 == 1) { // MONTHLY
        //                     $cashAdvance = $deductionDetails['amount'];
        //                 }
        //                 elseif ($deductionDetails['type'] == 2) { // SEMI-MONTHLY
        //                     $cashAdvance = $deductionDetails['amount'];
        //                 }
        //                 elseif ($deductionDetails['type'] == 3 && $deductionDetails['payrollCycleID'] == $payrollCycleID) { // ONCE
        //                     $cashAdvance = $deductionDetails['amount'];
        //                 }
        //             }
        //         }

        //         // COMPUTATION FOR REIMBURSEMENTS
        //         $reimbursementsQuery = $this->dbConnect()->query("SELECT amount, type, payrollCycleID FROM tbl_empreimbursements INNER JOIN tbl_reimbursements ON tbl_empreimbursements.reimbursementID = tbl_reimbursements.reimbursementID WHERE empID = $employee_id");
        //         while ($reimbursementDetails = mysqli_fetch_array($reimbursementsQuery)) {
        //             if ($reimbursementDetails['type'] == 1 && $payrollCycleID % 2 == 1) { // MONTHLY
        //                 $totalReimbursements += $reimbursementDetails['amount'];
        //             } elseif ($reimbursementDetails['type'] == 2) { // SEMI-MONTHLY
        //                 $totalReimbursements += $reimbursementDetails['amount'];
        //             } elseif ($reimbursementDetails['type'] == 3 && $reimbursementDetails['payrollCycleID'] == $payrollCycleID) { // ONCE
        //                 $totalReimbursements += $reimbursementDetails['amount'];
        //             }
        //         }

        //         // COMPUTATION FOR ADJUSTMENTS
        //         $adjustmentsQuery = $this->dbConnect()->query("SELECT amount, type, payrollCycleID, adjustmentType FROM tbL_empadjustments INNER JOIN tbl_adjustments ON tbL_empadjustments.adjustmentID = tbl_adjustments.adjustmentID WHERE empID = $employee_id");
        //         while ($adjustmentDetails = mysqli_fetch_array($adjustmentsQuery)) {
        //             if ($adjustmentDetails['type'] == 1 && $payrollCycleID % 2 == 1) { // MONTHLY
        //                 if ($adjustmentDetails['adjustmentType'] == "Add") {
        //                     $totalAdjustments += $adjustmentDetails['amount'];
        //                 }
        //                 else {
        //                     $totalAdjustments -= $adjustmentDetails['amount'];
        //                 }
        //             } elseif ($adjustmentDetails['type'] == 2) { // SEMI-MONTHLY
        //                 if ($adjustmentDetails['adjustmentType'] == "Add") {
        //                     $totalAdjustments += $adjustmentDetails['amount'];
        //                 }
        //                 else {
        //                     $totalAdjustments -= $adjustmentDetails['amount'];
        //                 }
        //             } elseif ($adjustmentDetails['type'] == 3 && $adjustmentDetails['payrollCycleID'] == $payrollCycleID) { // ONCE
        //                 if ($adjustmentDetails['adjustmentType'] == "Add") {
        //                     $totalAdjustments += $adjustmentDetails['amount'];
        //                 }
        //                 else {
        //                     $totalAdjustments -= $adjustmentDetails['amount'];
        //                 }
        //             }
        //         }

        //         // COMPUTATION FOR NIGHT DIFFERENTIAL PAY
        //         $totalNightHours = round($totalNightHours, 0);
        //         $employee_nightDiffPay = round(($employee_hourlyRate * .15) * $totalNightHours, 2);

        //         // COMPUTATION FOR OVERTIME PAY
        //         $employee_overtimePay = round(($employee_hourlyRate * .25) * $totalOvertimeHours, 2);
        //         $employee_RDOTPay = round(($employee_hourlyRate * .3) * $totalRDOTHours, 2);

        //         // COMPUTATION FOR SPECIAL HOLIDAY PAY
        //         if ($totalSpecialHolidayNDHours == 0) { // DAY SHIFT
        //             $totalSpecialHolidayHours = $specialHolidaysWorked / 2 * 8;
        //             $employee_specialHolidayPay = round(($employee_hourlyRate * 0.3) * $totalSpecialHolidayHours, 2);
        //         }
        //         else {  // NIGHT SHIFT
        //             $totalSpecialHolidayHours = ($specialHolidaysWorked * 8) - $totalSpecialHolidayNDHours;
        //             $employee_specialHolidayPay = round(($employee_hourlyRate * 1.3) * $totalSpecialHolidayHours, 2);
        //             $employee_specialHolidayNDPay = round(($employee_hourlyRate * 1.3) * $totalSpecialHolidayNDHours, 2);
        //         }

        //         // COMPUTATION FOR REGULAR HOLIDAY PAY
        //         if ($totalRegularHolidayNDHours == 0) { // DAY SHIFT
        //             $totalRegularHolidayHours = $regularHolidaysWorked / 2 * 8;
        //             $employee_regularHolidayPay = round($employee_hourlyRate  * $totalRegularHolidayHours, 2);
        //         }
        //         else { // NIGHT SHIFT
        //             $totalRegularHolidayHours = ($regularHolidaysWorked * 8) - $totalRegularHolidayNDHours;
        //             $employee_regularHolidayPay = round($employee_hourlyRate  * $totalRegularHolidayHours, 2);
        //             $employee_regularHolidayNDPay = round((($employee_hourlyRate * 2) * .15) * $totalRegularHolidayNDHours, 2);
        //         }

        //         // COMPUTE GROSS PAY
        //         $employee_grossPay = round($employee_dailyRate * $employee_daysWorked, 2);
        //         $employee_totalGrossPay = round($employee_dailyRate * $employee_daysWorked + $employee_nightDiffPay + $employee_overtimePay + $employee_RDOTPay + $employee_specialHolidayPay + $employee_regularHolidayPay + $totalAllowances + $communication, 2);
        //         $employee_netPay = round($employee_totalGrossPay - $sss - $phic - $hdmf - $wtax + $totalReimbursements + $totalAdjustments - $cashAdvance, 2);

        //         // ADD ALL PAYROLL DATA TO PAYSLIP TABLE
        //         $this->dbConnect()->query("INSERT INTO $this->payslip (payrollID, empID, daysWorked, grossPay, regNightDiff, pay_regNightDiff, regularOT, pay_regularOT, rdot, pay_rdot, specialHoliday, pay_specialHoliday, regularHoliday, pay_regularHoliday, payslip_allowances, payslip_communication, totalGrossPay, payslip_sss, payslip_phic, payslip_hdmf, payslip_wtax, payslip_reimbursements, payslip_adjustments, payslip_cashAdvance, netPay) VALUES ($payrollID, $employee_id, $employee_daysWorked, $employee_grossPay, $totalNightHours, $employee_nightDiffPay, $totalOvertimeHours, $employee_overtimePay, $totalRDOTHours, $employee_RDOTPay, $totalSpecialHolidayHours, $employee_specialHolidayPay, $totalRegularHolidayHours, $employee_regularHolidayPay, $totalAllowances, $communication, $employee_totalGrossPay, $sss, $phic, $hdmf, $wtax, $totalReimbursements, $totalAdjustments, $cashAdvance, $employee_netPay)");
                
        //         if ($cashAdvance > 0) {
        //             $this->dbConnect()->query("UPDATE tbl_employee SET cashAdvance = cashAdvance - $cashAdvance WHERE id = $employee_id");
        //         }
        //     }
        //     return;
        // }

        // public function reCalculatePayroll($payrollID, $payrollCycleID) {
        //     // UPDATE CASH ADVANCE DETAILS
        //     $cashAdvanceQuery = $this->dbConnect()->query("SELECT * FROM tbl_payslip WHERE payrollID = $payrollID AND payslip_cashAdvance > 0");
        //     while ($cashAdvanceDetails = mysqli_fetch_array($cashAdvanceQuery)) {
        //         $empID = $cashAdvanceDetails['empID'];
        //         $cashAdvance = $cashAdvanceDetails['payslip_cashAdvance'];
        //         $this->dbConnect()->query("UPDATE tbl_employee SET cashAdvance = cashAdvance + $cashAdvance WHERE id = $empID");
        //     }

        //     // DELETE CURRENT PAYSLIP - RE-CALCULATE FUNCTION
        //     $this->dbConnect()->query("DELETE FROM tbl_payslip WHERE payrollID = $payrollID");

        //     function modifyDate($date) {
        //         // Get the current year
        //         $currentYear = date('Y');
                
        //         // Append the current year to the input date
        //         $dateWithYear = $date . '-' . $currentYear;
                
        //         // Create a DateTime object from the string (expects format MM-DD-YYYY)
        //         $dateTime = DateTime::createFromFormat('m-d-Y', $dateWithYear);
                
        //         // Format the date as 'M d, Y'
        //         return $dateTime->format('Y-m-d');
        //     }

        //     // GET PAYROLL CYCLE DETAILS
        //     $payrollCycleFrom_date = $this->dbConnect()->query("SELECT * FROM tbl_payrollcycle WHERE payrollCycleID = $payrollCycleID")->fetch_assoc()['payrollCycleFrom']; 
        //     $payrollCycleTo_date = $this->dbConnect()->query("SELECT * FROM tbl_payrollcycle WHERE payrollCycleID = $payrollCycleID")->fetch_assoc()['payrollCycleTo'];
        //     $payrollCycleFrom = modifyDate($payrollCycleFrom_date);
        //     $payrollCycleTo = modifyDate($payrollCycleTo_date);

        //     // GET EMPLOYEE DETAILS
        //     $employees = $this->dbConnect()->query("SELECT * FROM tbl_employee");
        //     while ($employeeDetails = mysqli_fetch_array($employees)) {
        //         $employee_id = $employeeDetails['id'];
        //         $employee_dailyRate = $employeeDetails['dailyRate'];
        //         $employee_hourlyRate = $employeeDetails['hourlyRate'];

        //         // COMPUTE DAYS WORKED
        //         $daysWorkedQuery = $this->dbConnect()->query("SELECT * FROM tbl_attendance WHERE empID = $employeeDetails[id] AND (logTypeID IN (1, 2) OR logTypeID IN (3, 4)) AND attendanceDate BETWEEN DATE(CONCAT(YEAR(CURDATE()), '-', MONTH('$payrollCycleFrom'), '-', DAY('$payrollCycleFrom'))) AND DATE(CONCAT(YEAR(CURDATE()), '-', MONTH('$payrollCycleTo'), '-', DAY('$payrollCycleTo')))");
        //         $employee_daysWorked = round(mysqli_num_rows($daysWorkedQuery) / 2);

        //         // CHECK FOR HOLIDAYS
        //         $holidaysQuery = $this->dbConnect()->query("SELECT * FROM tbl_holidays WHERE dateFrom BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo'");
        //         $holidays = [];
        //         while ($holidayDetails = mysqli_fetch_array($holidaysQuery)) {
        //             $holidays[$holidayDetails['dateFrom']] = $holidayDetails['type'];
        //         }

        //         // INITIALIZE VARIABLES FOR HOURS WORKED COMPUTATION
        //         $totalNightHours = 0;
        //         $totalOvertimeHours = 0;
        //         $totalRDOTHours = 0;
        //         $totalSpecialHolidayHours = 0;
        //         $totalSpecialHolidayNDHours = 0;
        //         $totalRegularHolidayHours = 0;
        //         $totalRegularHolidayNDHours = 0;

        //         // INITIALIZE VARIABLES FOR DAYS WORKED (HOLIDAYS) COMPUTATION
        //         $specialHolidaysWorked = 0;
        //         $regularHolidaysWorked = 0;

        //         // INITIALIZE VARIABLES FOR PAYS COMPUTATION
        //         $employee_nightDiffPay = 0;
        //         $employee_overtimePay = 0;
        //         $employee_RDOTPay = 0;
        //         $employee_specialHolidayPay = 0;
        //         $employee_regularHolidayPay = 0;
        //         $employee_specialHolidayNDPay = 0;
        //         $employee_regularHolidayNDPay = 0;

        //         // ALLOWANCES, DEDUCTIONS, REIMBURSEMENTS, AND ADJUSTMENTS (=,-) COMPUTATION
        //         $totalAllowances = 0;
        //         $communication = 0;
        //         $sss = 0;
        //         $phic = 0;
        //         $hdmf = 0;
        //         $wtax = 0;
        //         $cashAdvance = 0;
        //         $totalReimbursements = 0;
        //         $totalAdjustments = 0;

        //         // COMPUTE HOURS WORKED
        //         while ($attendanceLogs = mysqli_fetch_array($daysWorkedQuery)) {
        //             $date = $attendanceLogs['attendanceDate'];
        //             $attendanceTime = $attendanceLogs['attendanceTime'];
        //             $logTypeID = $attendanceLogs['logTypeID'];
        //             $lateMins = $attendanceLogs['lateMins'];
        //             $undertimeMins = $attendanceLogs['undertimeMins'];

        //             if (isset($holidays[$date]) && $holidays[$date] == "Regular") {
        //                 // CALCULATE REGULAR HOLIDAY NIGHT DIFFERENTIAL HOURS
        //                 $regularHolidayNDHours = $this->calculateNightDifferential($attendanceTime, $logTypeID, $lateMins, $undertimeMins);
        //                 $totalRegularHolidayNDHours += $regularHolidayNDHours;
        //                 $regularHolidaysWorked++;
        //             }
        //             else if (isset($holidays[$date]) && $holidays[$date] == "Special") {
        //                 // CALCULATE SPECIAL HOLIDAY NIGHT DIFFERENTIAL HOURS
        //                 $specialHolidayNDHours = $this->calculateNightDifferential($attendanceTime, $logTypeID, $lateMins, $undertimeMins);
        //                 $totalSpecialHolidayNDHours += $specialHolidayNDHours;
        //                 $specialHolidaysWorked++;
        //             }
        //             else {
        //                 // CALCULATE REGULAR NIGHT DIFFERENTIAL HOURS
        //                 $nightHours = $this->calculateNightDifferential($attendanceTime, $logTypeID, $lateMins, $undertimeMins);
        //                 $totalNightHours += $nightHours;
        //             }
        //         }

        //         // COMPUTE OVERTIME HOURS
        //         $overtimesQuery = $this->dbConnect()->query("SELECT * FROM tbl_filedot WHERE empID = $employee_id AND (otDate BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo') AND status = '2'");
        //         while ($overtime = mysqli_fetch_array($overtimesQuery)) {
        //             if ($overtime['otType'] == "Regular") {
        //                 $totalOvertimeHours += $overtime['approvedOThours'];
        //                 if ($overtime['approvedOTmins'] >= 30) {
        //                     $totalOvertimeHours += 1;
        //                 }
        //             }
        //             else { // RDOT
        //                 $totalRDOTHours += $overtime['approvedOThours'];
        //                 if ($overtime['approvedOTmins'] >= 30) {
        //                     $totalRDOTHours += 1;
        //                 }
        //             }
        //         }

        //         // COMPUTATION FOR ALLOWANCES
        //         $allowancesQuery = $this->dbConnect()->query("SELECT amount, type FROM tbl_empallowances INNER JOIN tbl_allowances ON tbl_empallowances.allowanceID = tbl_allowances.allowanceID WHERE empID = $employee_id AND allowanceName NOT IN ('Communication', 'Communication Allowance')");
        //         while ($allowanceDetails = mysqli_fetch_array($allowancesQuery)) {
        //             if ($allowanceDetails['type'] == 1 && $payrollCycleID % 2 == 1) { // MONTHLY
        //                 $totalAllowances += $allowanceDetails['amount'];
        //             } elseif ($allowanceDetails['type'] == 2) { // SEMI-MONTHLY
        //                 $totalAllowances += $allowanceDetails['amount'];
        //             }
        //         }

        //         // COMPUTATION FOR COMMUNICATION ALLOWANCE
        //         $allowancesQuery = $this->dbConnect()->query("SELECT amount, type FROM tbl_empallowances INNER JOIN tbl_allowances ON tbl_empallowances.allowanceID = tbl_allowances.allowanceID WHERE empID = $employee_id AND allowanceName IN ('Communication', 'Communication Allowance')");
        //         while ($allowanceDetails = mysqli_fetch_array($allowancesQuery)) {
        //             if ($allowanceDetails['type'] == 1 && $payrollCycleID % 2 == 1) { // MONTHLY
        //                 $communication += $allowanceDetails['amount'];
        //             } elseif ($allowanceDetails['type'] == 2) { // SEMI-MONTHLY
        //                 $communication += $allowanceDetails['amount'];
        //             }
        //         }

        //         // COMPUTATION FOR DEDUCTIONS
        //         $deductionsQuery = $this->dbConnect()->query("SELECT amount, deductionName, type FROM tbl_empdeductions INNER JOIN tbl_deductions ON tbl_empdeductions.deductionID = tbl_deductions.deductionID WHERE empID = $employee_id");
        //         while ($deductionDetails = mysqli_fetch_array($deductionsQuery)) {
        //             if ($deductionDetails['deductionName'] == "SSS") {
        //                 $sss = $deductionDetails['amount'];
        //             }
        //             else if ($deductionDetails['deductionName'] == "PHIC") {
        //                 $phic = $deductionDetails['amount'];
        //             }
        //             else if ($deductionDetails['deductionName'] == "HDMF") {
        //                 $hdmf = $deductionDetails['amount'];
        //             }
        //             else if ($deductionDetails['deductionName'] == "WTAX") {
        //                 $wtax = $deductionDetails['amount'];
        //             }
        //             else if ($deductionDetails['deductionName'] == "CashAdvance") {
        //                 if ($deductionDetails['type'] == 1 && $payrollCycleID % 2 == 1) { // MONTHLY
        //                     $cashAdvance = $deductionDetails['amount'];
        //                 }
        //                 elseif ($deductionDetails['type'] == 2) { // SEMI-MONTHLY
        //                     $cashAdvance = $deductionDetails['amount'];
        //                 }
        //                 elseif ($deductionDetails['type'] == 3 && $deductionDetails['payrollCycleID'] == $payrollCycleID) { // ONCE
        //                     $cashAdvance = $deductionDetails['amount'];
        //                 }
        //             }
        //         }

        //         // COMPUTATION FOR REIMBURSEMENTS
        //         $reimbursementsQuery = $this->dbConnect()->query("SELECT amount, type, payrollCycleID FROM tbl_empreimbursements INNER JOIN tbl_reimbursements ON tbl_empreimbursements.reimbursementID = tbl_reimbursements.reimbursementID WHERE empID = $employee_id");
        //         while ($reimbursementDetails = mysqli_fetch_array($reimbursementsQuery)) {
        //             if ($reimbursementDetails['type'] == 1 && $payrollCycleID % 2 == 1) { // MONTHLY
        //                 $totalReimbursements += $reimbursementDetails['amount'];
        //             } elseif ($reimbursementDetails['type'] == 2) { // SEMI-MONTHLY
        //                 $totalReimbursements += $reimbursementDetails['amount'];
        //             } elseif ($reimbursementDetails['type'] == 3 && $reimbursementDetails['payrollCycleID'] == $payrollCycleID) { // ONCE
        //                 $totalReimbursements += $reimbursementDetails['amount'];
        //             }
        //         }

        //         // COMPUTATION FOR ADJUSTMENTS
        //         $adjustmentsQuery = $this->dbConnect()->query("SELECT amount, type, payrollCycleID, adjustmentType FROM tbL_empadjustments INNER JOIN tbl_adjustments ON tbL_empadjustments.adjustmentID = tbl_adjustments.adjustmentID WHERE empID = $employee_id");
        //         while ($adjustmentDetails = mysqli_fetch_array($adjustmentsQuery)) {
        //             if ($adjustmentDetails['type'] == 1 && $payrollCycleID % 2 == 1) { // MONTHLY
        //                 if ($adjustmentDetails['adjustmentType'] == "Add") {
        //                     $totalAdjustments += $adjustmentDetails['amount'];
        //                 }
        //                 else {
        //                     $totalAdjustments -= $adjustmentDetails['amount'];
        //                 }
        //             } elseif ($adjustmentDetails['type'] == 2) { // SEMI-MONTHLY
        //                 if ($adjustmentDetails['adjustmentType'] == "Add") {
        //                     $totalAdjustments += $adjustmentDetails['amount'];
        //                 }
        //                 else {
        //                     $totalAdjustments -= $adjustmentDetails['amount'];
        //                 }
        //             } elseif ($adjustmentDetails['type'] == 3 && $adjustmentDetails['payrollCycleID'] == $payrollCycleID) { // ONCE
        //                 if ($adjustmentDetails['adjustmentType'] == "Add") {
        //                     $totalAdjustments += $adjustmentDetails['amount'];
        //                 }
        //                 else {
        //                     $totalAdjustments -= $adjustmentDetails['amount'];
        //                 }
        //             }
        //         }

        //         // COMPUTATION FOR NIGHT DIFFERENTIAL PAY
        //         $totalNightHours = round($totalNightHours, 0);
        //         $employee_nightDiffPay = round(($employee_hourlyRate * .15) * $totalNightHours, 2);

        //         // COMPUTATION FOR OVERTIME PAY
        //         $employee_overtimePay = round(($employee_hourlyRate * .25) * $totalOvertimeHours, 2);
        //         $employee_RDOTPay = round(($employee_hourlyRate * .3) * $totalRDOTHours, 2);

        //         // COMPUTATION FOR SPECIAL HOLIDAY PAY
        //         if ($totalSpecialHolidayNDHours == 0) { // DAY SHIFT
        //             $totalSpecialHolidayHours = $specialHolidaysWorked / 2 * 8;
        //             $employee_specialHolidayPay = round(($employee_hourlyRate * 0.3) * $totalSpecialHolidayHours, 2);
        //         }
        //         else {  // NIGHT SHIFT
        //             $totalSpecialHolidayHours = ($specialHolidaysWorked * 8) - $totalSpecialHolidayNDHours;
        //             $employee_specialHolidayPay = round(($employee_hourlyRate * 1.3) * $totalSpecialHolidayHours, 2);
        //             $employee_specialHolidayNDPay = round(($employee_hourlyRate * 1.3) * $totalSpecialHolidayNDHours, 2);
        //         }

        //         // COMPUTATION FOR REGULAR HOLIDAY PAY
        //         if ($totalRegularHolidayNDHours == 0) { // DAY SHIFT
        //             $totalRegularHolidayHours = $regularHolidaysWorked / 2 * 8;
        //             $employee_regularHolidayPay = round($employee_hourlyRate  * $totalRegularHolidayHours, 2);
        //         }
        //         else { // NIGHT SHIFT
        //             $totalRegularHolidayHours = ($regularHolidaysWorked * 8) - $totalRegularHolidayNDHours;
        //             $employee_regularHolidayPay = round($employee_hourlyRate  * $totalRegularHolidayHours, 2);
        //             $employee_regularHolidayNDPay = round((($employee_hourlyRate * 2) * .15) * $totalRegularHolidayNDHours, 2);
        //         }

        //         // COMPUTE GROSS PAY
        //         $employee_grossPay = round($employee_dailyRate * $employee_daysWorked, 2);
        //         $employee_totalGrossPay = round($employee_dailyRate * $employee_daysWorked + $employee_nightDiffPay + $employee_overtimePay + $employee_RDOTPay + $employee_specialHolidayPay + $employee_regularHolidayPay + $totalAllowances + $communication, 2);
        //         $employee_netPay = round($employee_totalGrossPay - $sss - $phic - $hdmf - $wtax + $totalReimbursements + $totalAdjustments - $cashAdvance, 2);

        //         // ADD ALL PAYROLL DATA TO PAYSLIP TABLE
        //         $this->dbConnect()->query("INSERT INTO $this->payslip (payrollID, empID, daysWorked, grossPay, regNightDiff, pay_regNightDiff, regularOT, pay_regularOT, rdot, pay_rdot, specialHoliday, pay_specialHoliday, regularHoliday, pay_regularHoliday, payslip_allowances, payslip_communication, totalGrossPay, payslip_sss, payslip_phic, payslip_hdmf, payslip_wtax, payslip_reimbursements, payslip_adjustments, payslip_cashAdvance, netPay) VALUES ($payrollID, $employee_id, $employee_daysWorked, $employee_grossPay, $totalNightHours, $employee_nightDiffPay, $totalOvertimeHours, $employee_overtimePay, $totalRDOTHours, $employee_RDOTPay, $totalSpecialHolidayHours, $employee_specialHolidayPay, $totalRegularHolidayHours, $employee_regularHolidayPay, $totalAllowances, $communication, $employee_totalGrossPay, $sss, $phic, $hdmf, $wtax, $totalReimbursements, $totalAdjustments, $cashAdvance, $employee_netPay)");
                
        //         if ($cashAdvance > 0) {
        //             $this->dbConnect()->query("UPDATE tbl_employee SET cashAdvance = cashAdvance - $cashAdvance WHERE id = $employee_id");
        //         }
        //     }
        // }

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

        public function viewAllPayslips($payrollID) {
            $viewAllPayslips = "
                SELECT * FROM ".$this->payslip . " AS payslip
                INNER JOIN ".$this->employees." AS employee ON payslip.empID = employee.id
                WHERE payrollID = $payrollID";
            return $viewAllPayslips;
        }

        public function viewPayslip($payrollID, $empID) {
            $viewPayslip = "
                SELECT * FROM ".$this->payslip . " AS payslip
                INNER JOIN ".$this->employees." AS employee ON payslip.empID = employee.id
                WHERE payrollID = $payrollID AND empID = $empID";
            return $viewPayslip;
        }
    }
?>