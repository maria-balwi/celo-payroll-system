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

                    $payrollID = $_GET['id']; 
                    $payrollCycleID = $_GET['cycleID']; 
                    // $payrollCycleID = mysqli_query($conn, "SELECT payrollCycleID FROM tbl_payroll WHERE payrollID = $payrollID")->fetch_assoc()['payrollCycleID']; 
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
                                        <!-- <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">S.H. Day Night Diff</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Pay</th> -->
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Holiday</th>
                                        <!-- <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Holiday Night Diff</th> -->
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
                                        $payslipQuery = mysqli_query($conn, $payroll->viewAllPayslips($payrollID));
                                        while ($payslipDetails = mysqli_fetch_array($payslipQuery)) {
                                            $payslip_id = $payslipDetails['payslipID'];
                                            $payslip_payrollID = $payslipDetails['payrollID'];
                                            $payslip_empID = $payslipDetails['empID'];
                                            $payslip_employeeID = $payslipDetails['employeeID'];
                                            $payslip_employeeName = $payslipDetails['lastName'] . ", " . $payslipDetails['firstName'];
                                            $payslip_basicPay = number_format($payslipDetails['basicPay'], 2);
                                            $payslip_dailyRate = number_format($payslipDetails['dailyRate'], 2);
                                            $payslip_hourlyRate = number_format($payslipDetails['hourlyRate'], 2);
                                            $payslip_daysWorked = $payslipDetails['daysWorked'];
                                            $payslip_grossPay = $payslipDetails['grossPay'];
                                            $payslip_regNightDiff = $payslipDetails['regNightDiff'];
                                            $payslip_regNightDiffPay = number_format($payslipDetails['pay_regNightDiff'], 2);
                                            $payslip_regularOT = $payslipDetails['regularOT'];
                                            $payslip_regularOTPay = number_format($payslipDetails['pay_regularOT'], 2);
                                            $payslip_RDOT = $payslipDetails['rdot'];
                                            $payslip_RDOTPay = number_format($payslipDetails['pay_rdot'], 2);
                                            $payslip_specialHoliday = $payslipDetails['specialHoliday'];
                                            $payslip_specialHolidayPay = number_format($payslipDetails['pay_specialHoliday'], 2);
                                            $payslip_regularHoliday = $payslipDetails['regularHoliday'];
                                            $payslip_regularHolidayPay = number_format($payslipDetails['pay_regularHoliday'], 2);
                                            $payslip_allowances = $payslipDetails['payslip_allowances'];
                                            $payslip_communication = $payslipDetails['payslip_communication'];
                                            $payslip_totalGrossPay = $payslipDetails['totalGrossPay'];
                                            $payslip_sss = $payslipDetails['payslip_sss'];
                                            $payslip_phic = $payslipDetails['payslip_phic'];
                                            $payslip_hdmf = $payslipDetails['payslip_hdmf'];
                                            $payslip_wtax = $payslipDetails['payslip_wtax'];
                                            $payslip_reimbursements = $payslipDetails['payslip_reimbursements'];
                                            $payslip_adjustments = $payslipDetails['payslip_adjustments'];
                                            $payslip_netPay = $payslipDetails['netPay'];

                                            if ($payslip_regNightDiff == 0) {
                                                $payslip_regNightDiff = "-";
                                                $payslip_regNightDiffPay = "-";
                                            }
                                            if ($payslip_regularOT == 0) {
                                                $payslip_regularOT = "-";
                                                $payslip_regularOTPay = "-";
                                            }
                                            if ($payslip_RDOT == 0) {
                                                $payslip_RDOT = "-";
                                                $payslip_RDOTPay = "-";
                                            }
                                            if ($payslip_specialHoliday == 0) {
                                                $payslip_specialHoliday = "-";
                                                $payslip_specialHolidayPay = "-";
                                            }
                                            if ($payslip_regularHoliday == 0) {
                                                $payslip_regularHoliday = "-";
                                                $payslip_regularHolidayPay = "-";
                                            }
                                            if ($payslip_grossPay != 0) {
                                                $payslip_grossPay = number_format($payslip_grossPay, 2);
                                            }
                                            if ($payslip_totalGrossPay != 0) {
                                                $payslip_totalGrossPay = number_format($payslip_totalGrossPay, 2);
                                            }
                                            if ($payslip_allowances != 0) {
                                                $payslip_allowances = number_format($payslip_allowances, 2);
                                            }
                                            if ($payslip_communication != 0) {
                                                $payslip_communication = number_format($payslip_communication, 2);
                                            }
                                            if ($payslip_sss != 0) {
                                                $payslip_sss = number_format($payslip_sss, 2);
                                            }
                                            if ($payslip_phic != 0) {
                                                $payslip_phic = number_format($payslip_phic, 2);
                                            }
                                            if ($payslip_hdmf != 0) {
                                                $payslip_hdmf = number_format($payslip_hdmf, 2);
                                            }
                                            if ($payslip_wtax != 0) {
                                                $payslip_wtax = number_format($payslip_wtax, 2);
                                            }
                                            if ($payslip_reimbursements != 0) {
                                                $payslip_reimbursements = number_format($payslip_reimbursements, 2);
                                            }
                                            if ($payslip_adjustments != 0) {
                                                $payslip_adjustments = number_format($payslip_adjustments, 2);
                                            }
                                            if ($payslip_netPay != 0) {
                                                $payslip_netPay = number_format($payslip_netPay, 2);
                                            }
                                            
                                            echo "<tr>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_employeeID . "</td>";
                                            echo "<td class ='whitespace-nowrap text-left'>" . $payslip_employeeName . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_basicPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_dailyRate . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_hourlyRate . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_daysWorked . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_grossPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regNightDiff . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regNightDiffPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regularOT . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regularOTPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_RDOT . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_RDOTPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_specialHoliday . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_specialHolidayPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regularHoliday . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regularHolidayPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_allowances . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_communication . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_totalGrossPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_sss . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_phic . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_hdmf . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_wtax . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_reimbursements . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_adjustments . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_netPay . "</td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- CARD FOOTER DATA ENTRY BUTTON -->
                    <div class="card-footer d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary me-md-2 recalculatePayroll" type="button" data-id="<?php echo $payrollID; ?>" data-cycle="<?php echo $payrollCycleID; ?>">Re-Calculate Payroll</button>
                    </div>
                </div>
            </div>
        </main>
    
        <script src="../assets/js/admin_payroll.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>