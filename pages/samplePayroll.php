<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- HEADER -->
        <?php include('../includes/header.php'); ?>
    </head>
    <body>
        <!-- SIDEBAR -->
        <?php include('../includes/sidebar.php'); ?>	
 
        <!-- MAIN CONTENT -->
        <main class="flex-1 p-3">
            <div class="flex flex-1 p-2 text-2xl font-bold items-center">
                <button id="btnBack">
                    <svg class="h-8 w-8 text-gray-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                
                <?php 
                    function formatDate($date) {
                        // Get the current year
                        $currentYear = date('Y');
                        
                        // Append the current year to the input date
                        $dateWithYear = $date . '-' . $currentYear;
                        
                        // Create a DateTime object from the string (expects format MM-DD-YYYY)
                        $dateTime = DateTime::createFromFormat('m-d-Y', $dateWithYear);
                        
                        // Format the date as 'M d, Y'
                        return $dateTime->format('F d, Y');
                    }

                    // $payrollID = $_GET['id']; 
                    // $payrollCycleID = mysqli_query($conn, "SELECT payrollCycleID FROM tbl_payroll WHERE payrollID = $payrollID")->fetch_assoc()['payrollCycleID']; 
                    $payrollCycleID = 7;
                    $payrollCycleFrom_date = mysqli_query($conn, "SELECT * FROM tbl_payrollcycle WHERE payrollCycleID = $payrollCycleID")->fetch_assoc()['payrollCycleFrom'];
                    $payrollCycleTo_date = mysqli_query($conn, "SELECT * FROM tbl_payrollcycle WHERE payrollCycleID = $payrollCycleID")->fetch_assoc()['payrollCycleTo'];
                    $payrollCycleFrom = formatDate($payrollCycleFrom_date);
                    $payrollCycleTo = formatDate($payrollCycleTo_date);
                    echo "Payroll from " . $payrollCycleFrom . " to " . $payrollCycleTo;
                ?>
                
            </div>
            
            <!-- CONTENT -->
            <div class="bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="card shadow-sm bInfo">
                    <div class="card-body">
                        <!-- DATATABLE -->
                        <div class="mx-auto overflow-auto">
                            <table id="payrollListTable" class="table table-auto min-w-full divide-y divide-gray-200 table-striped table-bordered text-center pt-3">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle whitespace-nowrap">Employee ID</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle whitespace-nowrap">Employee Name</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle whitespace-nowrap">Basic Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle whitespace-nowrap">Daily Rate</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Hourly Rate</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">No. Of Days</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Gross Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Reg Night Diff (15%)</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Regular OT (25%)</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Pay</th>
                                        <!-- <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Regular OT Night Diff</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Pay</th> -->
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">RDOT</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Pay</th>
                                        <!-- <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">RDOT Night Diff</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Pay</th> -->
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Special Holiday</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">S.H. Day Night Diff</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Holiday</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Holiday Night Diff</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Allowance</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Communication</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Total Gross Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">SSS</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">PHIC</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">HDMF</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">WTAX</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Reimbursements</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Adjustments</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Net Pay</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php
                                        // // CONTENT OF THIS TABLE WILL BE GENERATED FROM THE DATABASE - PAYSLIP TABLE
                                        
                                        function modifyDate($date) {
                                            // Get the current year
                                            $currentYear = date('Y');
                                            
                                            // Append the current year to the input date
                                            $dateWithYear = $date . '-' . $currentYear;
                                            
                                            // Create a DateTime object from the string (expects format MM-DD-YYYY)
                                            $dateTime = DateTime::createFromFormat('m-d-Y', $dateWithYear);
                                            
                                            // Format the date as 'M d, Y'
                                            return $dateTime->format('Y-m-d');
                                        }

                                        $payrollCycleID = 7; 
                                        $payrollCycleFrom_date = mysqli_query($conn, "SELECT * FROM tbl_payrollcycle WHERE payrollCycleID = $payrollCycleID")->fetch_assoc()['payrollCycleFrom']; 
                                        $payrollCycleTo_date = mysqli_query($conn, "SELECT * FROM tbl_payrollcycle WHERE payrollCycleID = $payrollCycleID")->fetch_assoc()['payrollCycleTo'];
                                        $payrollCycleFrom = modifyDate($payrollCycleFrom_date);
                                        $payrollCycleTo = modifyDate($payrollCycleTo_date);
                                        // Fetch employee details
                                        $employees = mysqli_query($conn, "SELECT * FROM tbl_employee");
                                        while ($employeeDetails = mysqli_fetch_array($employees)) {
                                            $employee_id = $employeeDetails['id'];
                                            $employee_employeeID = $employeeDetails['employeeID'];
                                            $employee_employeeName = $employeeDetails['lastName'] . ", " . $employeeDetails['firstName'];
                                            $employee_basicPay = number_format($employeeDetails['basicPay'], 2);
                                            $employee_dailyRate = $employeeDetails['dailyRate'];
                                            $employee_hourlyRate = $employeeDetails['hourlyRate'];

                                            // Fetch attendance records within the payroll cycle
                                            $daysWorkedQuery = mysqli_query($conn, "SELECT * FROM tbl_attendance WHERE empID = $employee_id AND (logTypeID IN (1, 2) OR logTypeID IN (3, 4)) AND (attendanceDate BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo')");
                                            $employee_daysWorked = floor(mysqli_num_rows($daysWorkedQuery) / 2);

                                            // Fetch holidays within the payroll cycle and store in an array
                                            $holidaysQuery = mysqli_query($conn, "SELECT * FROM tbl_holidays WHERE dateFrom BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo'");
                                            $holidays = [];
                                            while ($holidayDetails = mysqli_fetch_array($holidaysQuery)) {
                                                $holidays[$holidayDetails['dateFrom']] = $holidayDetails['type'];
                                            }

                                            $totalNightHours = 0;
                                            $specialHolidaysWorked = 0;
                                            $regularHolidaysWorked = 0;
                                            $totalSpecialHolidayHours = 0;
                                            $totalSpecialHolidayNDHours = 0;
                                            $totalRegularHolidayHours = 0;
                                            $totalRegularHolidayNDHours = 0;

                                            // ALLOWANCES, DEDUCTIONS, REIMBURSEMENTS, AND ADJUSTMENTS (=,-) COMPUTATION
                                            $totalAllowances = 0;
                                            $communication = 0;
                                            $sss = 0;
                                            $phic = 0;
                                            $hdmf = 0;
                                            $wtax = 0;
                                            $totalReimbursements = 0;
                                            $totalAdjustments = 0;

                                            // Process attendance records
                                            while ($attendanceLogs = mysqli_fetch_array($daysWorkedQuery)) {
                                                $date = $attendanceLogs['attendanceDate'];
                                                $attendanceTime = $attendanceLogs['attendanceTime'];
                                                $logTypeID = $attendanceLogs['logTypeID'];
                                                $lateMins = $attendanceLogs['lateMins'];
                                                $undertimeMins = $attendanceLogs['undertimeMins'];

                                                // // Check if the attendance date is a holiday
                                                // if (isset($holidays[$date]) && $holidays[$date] == "Regular") {
                                                //     // Calculate special holiday night differential hours
                                                //     $regularHolidayNDHours = $payroll->calculateNightDifferential($attendanceTime, $logTypeID, $lateMins, $undertimeMins);
                                                //     $totalRegularHolidayNDHours += $regularHolidayNDHours;
                                                //     $regularHolidaysWorked++;
                                                // }
                                                // else if (isset($holidays[$date]) && $holidays[$date] == "Special") {
                                                //     // Calculate special holiday night differential hours
                                                //     $specialHolidayNDHours = $payroll->calculateNightDifferential($attendanceTime, $logTypeID, $lateMins, $undertimeMins);
                                                //     $totalSpecialHolidayNDHours += $specialHolidayNDHours;
                                                //     $specialHolidaysWorked++;
                                                // }
                                                // else {
                                                //     // Calculate regular night differential hours
                                                //     $nightHours = $payroll->calculateNightDifferential($attendanceTime, $logTypeID, $lateMins, $undertimeMins);
                                                //     $totalNightHours += $nightHours;
                                                // }
                                                $result = $payroll->calculateNightDifferential($attendanceTime, $logTypeID, $lateMins, $payrollCycleFrom, $payrollCycleTo, $date);             
                                                $totalNightHours += $result['totalRegularNightHours'];
                                                $totalRegularHolidayHours += $result['totalRegularHolidayHours'];
                                                $totalRegularHolidayNDHours += $result['totalRegularHolidayNightHours'];
                                                $totalSpecialHolidayHours += $result['totalSpecialHolidayHours'];
                                                $totalSpecialHolidayNDHours += $result['totalSpecialHolidayNightHours'];
                                            }

                                            // COMPUTATION FOR NIGHT DIFFERENTIAL PAY
                                            $employee_nightDiffPay = 0;
                                            $totalNightHours = round($totalNightHours, 0);
                                            $employee_nightDiffPay = round(($employee_hourlyRate * 0.15) * $totalNightHours, 2);

                                            // GET OVERTIMES AND OVERTIME PAY
                                            $overtimesQuery = mysqli_query($conn, "SELECT * FROM tbl_filedot WHERE empID = $employee_id AND (otDate BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo') AND status = '2'");
                                            $totalOvertimeHours = 0;
                                            $totalRDOTHours = 0;
                                            while ($overtime = mysqli_fetch_array($overtimesQuery)) {
                                                if ($overtime['otType'] == "Regular") {
                                                    $totalOvertimeHours += $overtime['approvedOThours'];
                                                    if ($overtime['approvedOTmins'] >= 30) {
                                                        $totalOvertimeHours += 1;
                                                    }
                                                }
                                                else { // RDOT
                                                    $totalRDOTHours += $overtime['approvedOThours'];
                                                    if ($overtime['approvedOTmins'] >= 30) {
                                                        $totalRDOTHours += 1;
                                                    }
                                                }
                                            }
                                            $employee_overtimePay = round(($employee_hourlyRate * .25) * $totalOvertimeHours, 2);
                                            $employee_RDOTPay = round(($employee_hourlyRate * .3) * $totalRDOTHours, 2);

                                            // COMPUTATION FOR ALLOWANCES
                                            $allowancesQuery = mysqli_query($conn, "SELECT amount, type FROM tbl_empallowances INNER JOIN tbl_allowances ON tbl_empallowances.allowanceID = tbl_allowances.allowanceID WHERE empID = $employee_id AND allowanceName NOT IN ('Communication', 'Communication Allowance')");
                                            while ($allowanceDetails = mysqli_fetch_array($allowancesQuery)) {
                                                if ($allowanceDetails['type'] == 1 && $payrollCycleID % 2 == 1) { // MONTHLY
                                                    $totalAllowances += $allowanceDetails['amount'];
                                                } elseif ($allowanceDetails['type'] == 2) { // SEMI-MONTHLY
                                                    $totalAllowances += $allowanceDetails['amount'];
                                                }
                                            }

                                            // COMPUTATION FOR COMMUNICATION ALLOWANCE
                                            $allowancesQuery = mysqli_query($conn, "SELECT amount, type FROM tbl_empallowances INNER JOIN tbl_allowances ON tbl_empallowances.allowanceID = tbl_allowances.allowanceID WHERE empID = $employee_id AND allowanceName IN ('Communication', 'Communication Allowance')");
                                            while ($allowanceDetails = mysqli_fetch_array($allowancesQuery)) {
                                                if ($allowanceDetails['type'] == 1 && $payrollCycleID % 2 == 1) { // MONTHLY
                                                    $communication += $allowanceDetails['amount'];
                                                } elseif ($allowanceDetails['type'] == 2) { // SEMI-MONTHLY
                                                    $communication += $allowanceDetails['amount'];
                                                }
                                            }

                                            // COMPUTATION FOR DEDUCTIONS
                                            $deductionsQuery = mysqli_query($conn, "SELECT amount, deductionName FROM tbl_empdeductions INNER JOIN tbl_deductions ON tbl_empdeductions.deductionID = tbl_deductions.deductionID WHERE empID = $employee_id");
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
                                                else if ($deductionDetails['deductionName'] == "WTAX") {
                                                    $wtax = $deductionDetails['amount'];
                                                }
                                            }

                                            // COMPUTATION FOR REIMBURSEMENTS
                                            $reimbursementsQuery = mysqli_query($conn, "SELECT amount, type, payrollCycleID FROM tbl_empreimbursements INNER JOIN tbl_reimbursements ON tbl_empreimbursements.reimbursementID = tbl_reimbursements.reimbursementID WHERE empID = $employee_id");
                                            while ($reimbursementDetails = mysqli_fetch_array($reimbursementsQuery)) {
                                                if ($reimbursementDetails['type'] == 1 && $payrollCycleID % 2 == 1) { // MONTHLY
                                                    $totalReimbursements += $reimbursementDetails['amount'];
                                                } elseif ($reimbursementDetails['type'] == 2) { // SEMI-MONTHLY
                                                    $totalReimbursements += $reimbursementDetails['amount'];
                                                } elseif ($reimbursementDetails['type'] == 3 && $reimbursementDetails['payrollCycleID'] == $payrollCycleID) { // ONCE
                                                    $totalReimbursements += $reimbursementDetails['amount'];
                                                }
                                            }

                                            // COMPUTATION FOR ADJUSTMENTS
                                            $adjustmentsQuery = mysqli_query($conn, "SELECT amount, type, payrollCycleID, adjustmentType FROM tbL_empadjustments INNER JOIN tbl_adjustments ON tbL_empadjustments.adjustmentID = tbl_adjustments.adjustmentID WHERE empID = $employee_id");
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

                                            // COMPUTATION FOR SPECIAL HOLIDAY PAY
                                            $employee_specialHolidayPay = 0;
                                            $employee_specialHolidayNDPay = 0;
                                            if ($totalSpecialHolidayNDHours == 0) {
                                                $totalSpecialHolidayHours = $specialHolidaysWorked / 2 * 8;
                                                $employee_specialHolidayPay = round(($employee_hourlyRate * 0.3) * $totalSpecialHolidayHours, 2);
                                            }
                                            else {
                                                $totalSpecialHolidayHours = ($specialHolidaysWorked * 8) - $totalSpecialHolidayNDHours;
                                                $employee_specialHolidayNDPay = round(($employee_hourlyRate * 1.3) * $totalSpecialHolidayHours, 2);
                                                $employee_specialHolidayNDPay = round(($employee_hourlyRate * 1.3) * $totalSpecialHolidayHours, 2);
                                            }

                                            // COMPUTATION FOR REGULAR HOLIDAY PAY
                                            $employee_regularHolidayPay = 0;
                                            $employee_regularHolidayNDPay = 0;
                                            if ($totalRegularHolidayNDHours == 0) {
                                                $totalRegularHolidayHours = $regularHolidaysWorked / 2 * 8;
                                                $employee_regularHolidayPay = round($employee_hourlyRate  * $totalRegularHolidayHours, 2);
                                            }
                                            else {
                                                $totalRegularHolidayHours = ($regularHolidaysWorked * 8) - $totalRegularHolidayNDHours;
                                                $employee_regularHolidayPay = round($employee_hourlyRate  * $totalRegularHolidayHours, 2);
                                                $employee_regularHolidayNDPay = round((($employee_hourlyRate * 2) * .15) * $totalRegularHolidayNDHours, 2);
                                            }

                                            $totalNightHours = round($totalNightHours, 0);
                                            $employee_nightDiffPay = round(($employee_hourlyRate * .15) * $totalNightHours, 2);
                                            $employee_grossPay = number_format($employee_dailyRate * $employee_daysWorked, 2);
                                            $employee_totalGrossPay = round($employee_dailyRate * $employee_daysWorked + $employee_nightDiffPay + $employee_overtimePay + $employee_RDOTPay + $employee_specialHolidayPay + $employee_specialHolidayNDPay + $employee_regularHolidayPay + $employee_regularHolidayNDPay + $totalAllowances + $communication, 2);
                                            $employee_netPay = round($employee_totalGrossPay - $sss - $phic - $hdmf - $wtax + $totalReimbursements + $totalAdjustments, 2);
                                            
                                            echo "<tr>";
                                            echo "<td class ='whitespace-nowrap'>" . $employee_employeeID . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $employee_employeeName . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $employee_basicPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $employee_dailyRate . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $employee_hourlyRate . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $employee_daysWorked . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $employee_grossPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $totalNightHours . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $employee_nightDiffPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $totalOvertimeHours . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $employee_overtimePay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $totalRDOTHours . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $employee_RDOTPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $totalSpecialHolidayHours . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $employee_specialHolidayPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $totalSpecialHolidayNDHours . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $employee_specialHolidayNDPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $totalRegularHolidayHours . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $employee_regularHolidayPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $totalRegularHolidayNDHours . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $employee_regularHolidayNDPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $totalAllowances . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $communication . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . number_format($employee_totalGrossPay, 2) . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $sss . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $phic . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $hdmf . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $wtax . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $totalReimbursements . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $totalAdjustments . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . number_format($employee_netPay, 2) . "</td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- CARD FOOTER DATA ENTRY BUTTON -->
                    <div class="card-footer d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary me-md-2" type="button" data-bs-toggle="modal" data-bs-target="#addPayrollModal">Re-Calculate Payroll</button>
                    </div>
                </div>
            </div>
        </main>
    
        <script src="../assets/js/admin_payroll.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>