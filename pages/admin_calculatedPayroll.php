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
                    $payrollCycleID = mysqli_query($conn, "SELECT payrollCycleID FROM tbl_payroll WHERE payrollID = $payrollID")->fetch_assoc()['payrollCycleID']; 
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
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Reg Night Diff (15%)</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Regular OT (25%)</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Gross Pay</th>
                                        <!-- <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Regular OT Night Diff</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">RDOT</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">RDOT Night Diff</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Special Holiday</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">S.H. Day Night Diff</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Holiday</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Holiday Night Diff</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Pay</th> -->
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php
                                        // // CONTENT OF THIS TABLE WILL BE GENERATED FROM THE DATABASE - PAYSLIP TABLE
                                        
                                        // function formatDate($date) {
                                        //     // Get the current year
                                        //     $currentYear = date('Y');
                                            
                                        //     // Append the current year to the input date
                                        //     $dateWithYear = $date . '-' . $currentYear;
                                            
                                        //     // Create a DateTime object from the string (expects format MM-DD-YYYY)
                                        //     $dateTime = DateTime::createFromFormat('m-d-Y', $dateWithYear);
                                            
                                        //     // Format the date as 'M d, Y'
                                        //     return $dateTime->format('Y-m-d');
                                        // }

                                        // $payrollCycleID = 21; // 19 for sample with late
                                        // $payrollCycleFrom_date = mysqli_query($conn, "SELECT * FROM tbl_payrollcycle WHERE payrollCycleID = $payrollCycleID")->fetch_assoc()['payrollCycleFrom']; 
                                        // $payrollCycleTo_date = mysqli_query($conn, "SELECT * FROM tbl_payrollcycle WHERE payrollCycleID = $payrollCycleID")->fetch_assoc()['payrollCycleTo'];
                                        // $payrollCycleFrom = formatDate($payrollCycleFrom_date);
                                        // $payrollCycleTo = formatDate($payrollCycleTo_date);
                                        // $employees = mysqli_query($conn, "SELECT * FROM tbl_employee");
                                        // while ($employeeDetails = mysqli_fetch_array($employees)) {
                                        //     $employee_id = $employeeDetails['id'];
                                        //     $employee_employeeID = $employeeDetails['employeeID'];
                                        //     $employee_employeeName = $employeeDetails['lastName'] . ", " . $employeeDetails['firstName'];
                                        //     $employee_basicPay = number_format($employeeDetails['basicPay'], 2);
                                        //     $employee_dailyRate = $employeeDetails['dailyRate'];
                                        //     $employee_hourlyRate = $employeeDetails['hourlyRate'];

                                        //     $daysWorkedQuery = mysqli_query($conn, "SELECT * FROM tbl_attendance WHERE empID = $employee_id AND (logTypeID IN (1, 2) OR logTypeID IN (3, 4)) AND (attendanceDate BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo')");
                                        //     $employee_daysWorked = floor(mysqli_num_rows($daysWorkedQuery) / 2);

                                        //     $totalNightHours = 0;
                                        //     while ($attendanceLogs = mysqli_fetch_array($daysWorkedQuery)) {
                                        //         $date = $attendanceLogs['attendanceDate'];
                                        //         $attendanceTime = $attendanceLogs['attendanceTime'];
                                        //         $logTypeID = $attendanceLogs['logTypeID'];
                                        //         $lateMins = $attendanceLogs['lateMins'];
                                        //         $undertimeMins = $attendanceLogs['undertimeMins'];
                                        //         $nightHours = $payroll->calculateNightDifferential($attendanceTime, $logTypeID, $lateMins, $undertimeMins);
                                        //         $totalNightHours += $nightHours;
                                        //     }
                                        //     if ($totalNightHours == 0) {
                                        //         $totalNightHours = "-";
                                        //         $employee_nightDiffPay = "-";
                                        //     }
                                        //     else {
                                        //         $totalNightHours = number_format($totalNightHours, 0);
                                        //         $employee_nightDiffPay = number_format(($employee_hourlyRate * .15) * $totalNightHours, 2);
                                        //     }
                                        //     if ($employee_daysWorked == 0) {
                                        //         $employee_grossPay = "-";
                                        //     }
                                        //     else {
                                        //         $employee_grossPay = number_format($employee_dailyRate * $employee_daysWorked, 2);
                                        //     }
                                        //     echo "<tr>";
                                        //     echo "<td class ='whitespace-nowrap'>" . $employee_employeeID . "</td>";
                                        //     echo "<td class ='whitespace-nowrap'>" . $employee_employeeName . "</td>";
                                        //     echo "<td class ='whitespace-nowrap'>" . $employee_basicPay . "</td>";
                                        //     echo "<td class ='whitespace-nowrap'>" . $employee_dailyRate . "</td>";
                                        //     echo "<td class ='whitespace-nowrap'>" . $employee_hourlyRate . "</td>";
                                        //     echo "<td class ='whitespace-nowrap'>" . $employee_daysWorked . "</td>";
                                        //     echo "<td class ='whitespace-nowrap'>" . $employee_grossPay . "</td>";
                                        //     echo "<td class ='whitespace-nowrap'>" . $totalNightHours . "</td>";
                                        //     echo "<td class ='whitespace-nowrap'>" . $employee_nightDiffPay . "</td>";
                                        //     echo "</tr>";
                                        // }
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
                                            $payslip_regNightDiff = $payslipDetails['regNightDiff'];
                                            $payslip_regNightDiffPay = number_format($payslipDetails['pay_regNightDiff'], 2);
                                            $payslip_regularOT = $payslipDetails['regularOT'];
                                            $payslip_regularOTPay = number_format($payslipDetails['pay_regularOT'], 2);
                                            $payslip_grossPay = $payslipDetails['grossPay'];

                                            if ($payslip_regNightDiff == 0) {
                                                $payslip_regNightDiff = "-";
                                                $payslip_regNightDiffPay = "-";
                                            }
                                            if ($payslip_regularOT == 0) {
                                                $payslip_regularOT = "-";
                                                $payslip_regularOTPay = "-";
                                            }
                                            if ($payslip_grossPay != 0) {
                                                $payslip_grossPay = number_format($payslip_grossPay, 2);
                                            }

                                            echo "<tr>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_employeeID . "</td>";
                                            echo "<td class ='whitespace-nowrap text-left'>" . $payslip_employeeName . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_basicPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_dailyRate . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_hourlyRate . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_daysWorked . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regNightDiff . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regNightDiffPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regularOT . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regularOTPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_grossPay . "</td>";
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