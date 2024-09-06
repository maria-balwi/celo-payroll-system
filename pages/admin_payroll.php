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

                <!-- YEAR DROPDOWN MENU -->
                <!-- PAYSLIP CYCLYE RANGE FROM DROPDOWN MENU -->
                <div class="static inline-block text-right ml-3 mr-1">
                    <select id="filterCycle" class="form-select inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-3 bg-white text-sm font-medium text-gray-700">
                        <!-- <option disabled selected>Select Payroll Cycle FROM</option> -->
                        <option disabled selected>Select Payroll Cycle</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="1">1 - Dec 26, <?php echo date('Y') - 1; ?> to Jan 10, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="2">2 - Jan 11, <?php echo date('Y'); ?> to Jan 25, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="3">3 - Jan 26, <?php echo date('Y'); ?> to Feb 10, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="4">4 - Feb 11, <?php echo date('Y'); ?> to Feb 25, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="5">5 - Feb 26, <?php echo date('Y'); ?> to Mar 10, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="6">6 - Mar 11, <?php echo date('Y'); ?> to Mar 25, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="7">7 - Mar 26, <?php echo date('Y'); ?> to Apr 10, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="8">8 - Apr 11, <?php echo date('Y'); ?> to Apr 25, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="9">9 - Apr 26, <?php echo date('Y'); ?> to May 10, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="10">10 - May 11, <?php echo date('Y'); ?> to May 25, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="11">11 - May 26, <?php echo date('Y'); ?> to Jun 10, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="12">12 - Jun 11, <?php echo date('Y'); ?> to Jun 25, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="13">13 - Jun 26, <?php echo date('Y'); ?> to Jul 10, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="14">14 - Jul 11, <?php echo date('Y'); ?> to Jul 25, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="15">15 - Jul 26, <?php echo date('Y'); ?> to Aug 10, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="16">16 - Aug 11, <?php echo date('Y'); ?> to Aug 25, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="17">17 - Aug 26, <?php echo date('Y'); ?> to Sep 10, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="18">18 - Sep 11, <?php echo date('Y'); ?> to Sep 25, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="19">19 - Sep 26, <?php echo date('Y'); ?> to Oct 10, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="20">20 - Oct 11, <?php echo date('Y'); ?> to Oct 25, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="21">21 - Oct 26, <?php echo date('Y'); ?> to Nov 10, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="22">22 - Nov 11, <?php echo date('Y'); ?> to Nov 25, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="23">23 - Nov 26, <?php echo date('Y'); ?> to Dec 10, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="24">24 - Dec 11, <?php echo date('Y'); ?> to Dec 25, <?php echo date('Y'); ?></option>
                    </select>
                </div>
                
                <!-- PRINT PAYROLL BUTTON -->
                <div class="static inline-block text-right">
                    <button id="generatePayroll" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-blue-500 hover:bg-blue-500 hover:text-white-500 focus:outline-none">
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