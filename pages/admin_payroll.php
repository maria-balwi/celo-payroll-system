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
            <div class="flex flex-1 p-2 text-2xl font-bold justify-between items-center">
                Payroll 
                
                <!-- PRINT PAYROLL BUTTON -->
                <div class="static inline-block text-right">
                    <button id="" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-blue-500 hover:bg-blue-500 hover:text-white-500 focus:outline-none">
                    Generate Payroll
                    </button>
                </div>
            </div>
            
            <!-- CONTENT -->
            <div class="px-3 m-1 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                
                <!-- DATATABLE -->
                <div class="container mx-auto my-3 py-2 overflow-auto">
                    <table id="payrollTable" class="table table-striped table-bordered table-auto text-center pt-3">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle whitespace-nowrap" rowspan="2">Employee ID</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Name</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle whitespace-nowrap" rowspan="2">Basic Pay</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle whitespace-nowrap" rowspan="2">Daily Rate</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Hourly Rate</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">No. Of Days</th>  
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Total Hours</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">Regular Hours/Days</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">Reg Night Diff (15%)</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">Regular OT (25%)</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">Regular OT Night Diff</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">RDOT</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">RDOT Night Diff</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">Special Holiday</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">S.H. Day Night Diff</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Holiday</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">HOLIDAY Night Diff</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle whitespace-nowrap" rowspan="2">Gross Pay</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">Allowance</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">Communication Allowance</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle whitespace-nowrap" rowspan="2">Total Gross Pay</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" colspan="8">Deductions</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">Adjustment +,-</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Net Pay</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">C/A Balance</th> 
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2"></th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Holiday OT</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">HOLIDAY OT w/ Night Diff</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">Special Holiday OT</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">Special Holiday OT w/ Night Diff</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">RDOT SH</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">RDOT SH w/ Night Diff</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">RDOT LH</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">RDOT LH w/ Night Diff</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">RDOT OT</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">Double Holiday (300%)</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">Double Holiday w/ Night Diff (300%)</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">Double Holiday (200%)</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">13th Month</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">Separation Pay</th>
                            </tr>
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">WTAX</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">SSS</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">PHIC</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">HDMF</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Advances</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">SSS Salary Loan</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Pagibig MPL</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle">Smart</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php
                                $employeeQuery = mysqli_query($conn, $employees->viewEmployees());
                                while ($employeeDetails = mysqli_fetch_array($employeeQuery)) {

                                    $employee_id = $employeeDetails['id'];
                                    $employee_employeeID = $employeeDetails['employeeID'];
                                    $employee_employeeName = $employeeDetails['lastName'] . ", " . $employeeDetails['firstName'];
                                    $employee_basicPay = number_format($employeeDetails['basicPay'], 2);
                                    $employee_dailyRate = number_format($employeeDetails['dailyRate'], 2);
                                    $employee_hourlyRate = number_format($employeeDetails['hourlyRate'], 2);


                                    echo "<tr data-id='" . $employee_id . "' class='employeeView'>";
                                    echo "<td class = ' whitespace-nowrap'>" . $employee_employeeID . "</td>"; ?>
                                    <!-- echo "<td class = ' whitespace-nowrap'>" . $employee_employeeName . "</td>"; 
                                    echo "<td class = ' text-right whitespace-nowrap'>".$employee_basicPay."</td>";
                                    echo "<td class = ' text-right whitespace-nowrap'>".$employee_dailyRate."</td>";
                                    echo "<td class = ' text-right whitespace-nowrap'>".$employee_hourlyRate."</td>";-->
                                    <td  class="px-6 text-left whitespace-nowrap"><?php echo $employee_employeeName; ?></td>
                                    <td class="px-6 text-right whitespace-nowrap"><?php echo $employee_basicPay; ?></td>
                                    <td class="px-6 text-right whitespace-nowrap"><?php echo $employee_dailyRate; ?></td>
                                    <td class="px-6 text-right whitespace-nowrap"><?php echo $employee_hourlyRate; ?></td>
                                    
                                    <?php 
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "<td class ='whitespace-nowrap'>-</td>";
                                    echo "</td>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </main>
    
        <script src="../assets/js/admin_payroll.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>