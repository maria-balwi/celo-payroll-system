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
                Payroll 
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
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle whitespace-nowrap">Hourly Rate</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle whitespace-nowrap">Days Worked</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle whitespace-nowrap">Gross Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle whitespace-nowrap">Total Night Hours</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php
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

                                        $payrollCycleID = 17;
                                        $payrollCycleFrom_date = mysqli_query($conn, "SELECT * FROM tbl_payrollcycle WHERE payrollCycleID = $payrollCycleID")->fetch_assoc()['payrollCycleFrom']; 
                                        $payrollCycleTo_date = mysqli_query($conn, "SELECT * FROM tbl_payrollcycle WHERE payrollCycleID = $payrollCycleID")->fetch_assoc()['payrollCycleTo'];
                                        $payrollCycleFrom = formatDate($payrollCycleFrom_date);
                                        $payrollCycleTo = formatDate($payrollCycleTo_date);
                                        $employees = mysqli_query($conn, "SELECT * FROM tbl_employee WHERE id=2");
                                        while ($employeeDetails = mysqli_fetch_array($employees)) {
                                            $employee_id = $employeeDetails['id'];
                                            $employee_employeeID = $employeeDetails['employeeID'];
                                            $employee_employeeName = $employeeDetails['lastName'] . ", " . $employeeDetails['firstName'];
                                            $employee_basicPay = number_format($employeeDetails['basicPay'], 2);
                                            $employee_dailyRate = $employeeDetails['dailyRate'];
                                            $employee_hourlyRate = $employeeDetails['hourlyRate'];

                                            $daysWorkedQuery = mysqli_query($conn, "SELECT * FROM tbl_attendance WHERE empID = $employee_id AND (logTypeID IN (1, 2) OR logTypeID IN (3, 4)) AND (attendanceDate BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo')");
                                            $employee_daysWorked = round(mysqli_num_rows($daysWorkedQuery) / 2);
                                            $employee_grossPay = $employee_dailyRate * $employee_daysWorked;

                                            $totalNightHours = 0;
                                            while ($attendanceLogs = mysqli_fetch_array($daysWorkedQuery)) {
                                                $date = $attendanceLogs['attendanceDate'];
                                                $attendanceTime = $attendanceLogs['attendanceTime'];
                                                $logTypeID = $attendanceLogs['logTypeID'];
                                                $nightHours = $payroll->calculateNightDifferential($attendanceDate, $attendanceTime, $logTypeID);
                                                $totalNightHours += $nightHours;
                                                
                                            }
                                            echo "<tr>";
                                            echo "<td class ='whitespace-nowrap'>" . $employee_employeeID . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $employee_employeeName . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $employee_basicPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $employee_dailyRate . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $employee_hourlyRate . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $employee_daysWorked . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $employee_grossPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $totalNightHours . "</td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- CARD FOOTER DATA ENTRY BUTTON -->
                    <div class="card-footer d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary me-md-2" type="button" data-bs-toggle="modal" data-bs-target="#addPayrollModal">Create Payroll</button>
                    </div>
                </div>
            </div>
        </main>
    
        <script src="../assets/js/admin_payroll.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>