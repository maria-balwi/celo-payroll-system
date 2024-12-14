<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($_POST['action'] == "generate") {
            $payrollCycleID = $_POST['payrollCycleID'];
            $payrollIDQuery = mysqli_query($conn, $payroll->getPayrollID($payrollCycleID));

            if (mysqli_num_rows($payrollIDQuery) == 0) {
                $em = "<i>Payslip for this payroll cycle not yet generated.</i>";
                echo $em;
                exit();
            }
            else {
                $payrollDetails = mysqli_fetch_array($payrollIDQuery);
                $payrollID = $payrollDetails['payrollID'];
                $empID = $_SESSION['id'];

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

                function formatDates($date1, $date2) {
                    // Get the current year
                    $currentYear = date('Y');
                    $nextYear = date('Y') + 1;

                    $date1 = new DateTime($date1);
                    $date2 = new DateTime($date2);
                    
                    $date1_formatted = $date1->format(  'F d');
                    $date2_formatted = $date2->format('F d');
                    
                    if ($date1->format('m') === '12' && $date2->format('m') === '01') {
                        $date = $date1_formatted . ', ' . $currentYear . ' - ' . $date2_formatted . ', ' . $nextYear;
                    }
                    else {
                        $date = $date1_formatted . ' - ' . $date2_formatted . ', ' . $currentYear;
                    }
                    
                    return $date;
                }

                // GET PAYROLL CYCLE DETAILS
                $payrollCycleFrom_date = mysqli_query($conn, "SELECT * FROM tbl_payrollcycle WHERE payrollCycleID = $payrollCycleID")->fetch_assoc()['payrollCycleFrom']; 
                $payrollCycleTo_date = mysqli_query($conn, "SELECT * FROM tbl_payrollcycle WHERE payrollCycleID = $payrollCycleID")->fetch_assoc()['payrollCycleTo'];
                $payrollCycleFrom = formatDate($payrollCycleFrom_date);
                $payrollCycleTo = formatDate($payrollCycleTo_date);

                $date = formatDates($payrollCycleFrom, $payrollCycleTo);

                $query = mysqli_query($conn, "SELECT * FROM tbl_holidays WHERE dateFrom BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo'");
                $holidayCount = mysqli_num_rows($query);
                $isHoliday = $holidayCount > 0 ? 1 : 0;

                $payslipQuery = mysqli_query($conn, $payroll->viewPayslip($payrollID, $empID));
                $payslipDetails = mysqli_fetch_array($payslipQuery);
                $payslip_id = $payslipDetails['payslipID'];
                $payslip_payrollID = $payslipDetails['payrollID'];
                $payslip_empID = $payslipDetails['employeeID'];
                $payslip_position = $payslipDetails['position'];
                $payslip_employmentStatus = $payslipDetails['employmentStatus'];
                $payslip_employeeID = $payslipDetails['employeeID'];
                $payslip_employeeName = $payslipDetails['lastName'] . ", " . $payslipDetails['firstName'];
                $payslip_basicPay = number_format($payslipDetails['basicPay'], 2);
                $payslip_dailyRate = number_format($payslipDetails['dailyRate'], 2);
                $payslip_hourlyRate = number_format($payslipDetails['hourlyRate'], 2);
                $payslip_daysWorked = $payslipDetails['daysWorked'] == 0 ? "-" : $payslipDetails['daysWorked'];
                $payslip_grossPay = $payslipDetails['grossPay'] == 0 ? "-" : number_format($payslipDetails['grossPay'] , 2);
                $payslip_regNightDiff = $payslipDetails['regNightDiff'] == 0 ? "-" : number_format($payslipDetails['regNightDiff'], 2);
                $payslip_regNightDiffPay = $payslipDetails['pay_regNightDiff'] == 0 ? "-" : number_format($payslipDetails['pay_regNightDiff'], 2);
                $payslip_regularOT = $payslipDetails['regularOT'] == 0 ? "-" : number_format($payslipDetails['regularOT'], 2);
                $payslip_regularOTPay = $payslipDetails['pay_regularOT'] == 0 ? "-" : number_format($payslipDetails['pay_regularOT'], 2);
                $payslip_regularOTND = $payslipDetails['regularOTND'] == 0 ? "-" : number_format($payslipDetails['regularOTND'], 2);
                $payslip_regularOTNDPay = $payslipDetails['pay_regularOTND'] == 0 ? "-" : number_format($payslipDetails['pay_regularOTND'], 2);
                $payslip_RDOT = $payslipDetails['rdot'] == 0 ? "-" : number_format($payslipDetails['rdot'], 2);
                $payslip_RDOTPay = $payslipDetails['pay_rdot'] == 0 ? "-" : number_format($payslipDetails['pay_rdot'], 2);
                $payslip_RDOTND = $payslipDetails['rdotND'] == 0 ? "-" : number_format($payslipDetails['rdotND'], 2);
                $payslip_RDOTNDPay = $payslipDetails['pay_rdotND'] == 0 ? "-" : number_format($payslipDetails['pay_rdotND'], 2);
                $payslip_specialHoliday = $payslipDetails['specialHoliday'] == 0 ? "-" : $payslipDetails['specialHoliday'];
                $payslip_specialHolidayPay = $payslipDetails['pay_specialHoliday'] == 0 ? "-" : number_format($payslipDetails['pay_specialHoliday'], 2);
                $payslip_specialHolidayND = $payslipDetails['specialHolidayND'] == 0 ? "-" : number_format($payslipDetails['specialHolidayND'], 2);
                $payslip_specialHolidayNDPay = $payslipDetails['pay_specialHolidayND'] == 0 ? "-" : number_format($payslipDetails['pay_specialHolidayND'], 2);
                $payslip_regularHoliday = $payslipDetails['regularHoliday'] == 0 ? "-" : number_format($payslipDetails['regularHoliday'], 2);
                $payslip_regularHolidayPay = $payslipDetails['pay_regularHoliday'] == 0 ? "-" : number_format($payslipDetails['pay_regularHoliday'], 2);
                $payslip_regularHolidayND = $payslipDetails['regularHolidayND'] == 0 ? "-" : number_format($payslipDetails['regularHolidayND'], 2);
                $payslip_regularHolidayNDPay = $payslipDetails['pay_regularHolidayND'] == 0 ? "-" : number_format($payslipDetails['pay_regularHolidayND'], 2);
                $payslip_regularHolidayOT = $payslipDetails['regularHolidayOT'] == 0 ? "-" : number_format($payslipDetails['regularHolidayOT'], 2);
                $payslip_regularHolidayOTPay = $payslipDetails['pay_regularHolidayOT'] == 0 ? "-" : number_format($payslipDetails['pay_regularHolidayOT'], 2);
                $payslip_regularHolidayOTND = $payslipDetails['regularHolidayOTND'] == 0 ? "-" : number_format($payslipDetails['regularHolidayOTND'], 2);
                $payslip_regularHolidayOTNDPay = $payslipDetails['pay_regularHolidayOTND'] == 0 ? "-" : number_format($payslipDetails['pay_regularHolidayOTND'], 2);
                $payslip_specialHolidayOT = $payslipDetails['specialHolidayOT'] == 0 ? "-" : number_format($payslipDetails['specialHolidayOT'], 2);
                $payslip_specialHolidayOTPay = $payslipDetails['pay_specialHolidayOT'] == 0 ? "-" : number_format($payslipDetails['pay_specialHolidayOT'], 2);
                $payslip_specialHolidayOTND = $payslipDetails['specialHolidayOTND'] == 0 ? "-" : number_format($payslipDetails['specialHolidayOTND'], 2);
                $payslip_specialHolidayOTNDPay = $payslipDetails['pay_specialHolidayOTND'] == 0 ? "-" : number_format($payslipDetails['pay_specialHolidayOTND'], 2);
                $payslip_RDOTSH = $payslipDetails['rdotSH'] == 0 ? "-" : number_format($payslipDetails['rdotSH'], 2);
                $payslip_RDOTSHPay = $payslipDetails['pay_rdotSH'] == 0 ? "-" : number_format($payslipDetails['pay_rdotSH'], 2);
                $payslip_RDOTSHND = $payslipDetails['rdotSHND'] == 0 ? "-" : number_format($payslipDetails['rdotSHND'], 2);
                $payslip_RDOTSHNDPay = $payslipDetails['pay_rdotSHND'] == 0 ? "-" : number_format($payslipDetails['pay_rdotSHND'], 2);
                $payslip_RDOTRH = $payslipDetails['rdotRH'] == 0 ? "-" : number_format($payslipDetails['rdotRH'], 2);
                $payslip_RDOTRHPay = $payslipDetails['pay_rdotRH'] == 0 ? "-" : number_format($payslipDetails['pay_rdotRH'], 2);
                $payslip_RDOTRHND = $payslipDetails['rdotRHND'] == 0 ? "-" : number_format($payslipDetails['rdotRHND'], 2);
                $payslip_RDOTRHNDPay = $payslipDetails['pay_rdotRHND'] == 0 ? "-" : number_format($payslipDetails['pay_rdotRHND'], 2);
                $payslip_RDOTOT = $payslipDetails['rdotOT'] == 0 ? "-" : number_format($payslipDetails['rdotOT'], 2);
                $payslip_RDOTOTPay = $payslipDetails['pay_rdotOT'] == 0 ? "-" : number_format($payslipDetails['pay_rdotOT'], 2);
                $payslip_RDOTOTND = $payslipDetails['rdotOTND'] == 0 ? "-" : number_format($payslipDetails['rdotOTND'], 2);
                $payslip_RDOTOTNDPay = $payslipDetails['pay_rdotOTND'] == 0 ? "-" : number_format($payslipDetails['pay_rdotOTND'], 2);
                $payslip_doubleHoliday = $payslipDetails['doubleHoliday'] == 0 ? "-" : number_format($payslipDetails['doubleHoliday'], 2);
                $payslip_doubleHolidayPay = $payslipDetails['pay_doubleHoliday'] == 0 ? "-" : number_format($payslipDetails['pay_doubleHoliday'], 2);
                $payslip_doubleHolidayND = $payslipDetails['doubleHolidayND'] == 0 ? "-" : number_format($payslipDetails['doubleHolidayND'], 2);
                $payslip_doubleHolidayNDPay = $payslipDetails['pay_doubleHolidayND'] == 0 ? "-" : number_format($payslipDetails['pay_doubleHolidayND'], 2);
                $payslip_allowances = $payslipDetails['payslip_allowances'] == 0 ? "-" : number_format($payslipDetails['payslip_allowances'], 2);
                $payslip_communication = $payslipDetails['payslip_communication'] == 0 ? "-" : number_format($payslipDetails['payslip_communication'], 2);
                $payslip_totalGrossPay = $payslipDetails['totalGrossPay'] == 0 ? "-" : number_format($payslipDetails['totalGrossPay'] , 2);
                $payslip_sss = $payslipDetails['payslip_sss'] == 0 ? "-" : number_format($payslipDetails['payslip_sss'], 2);
                $payslip_phic = $payslipDetails['payslip_phic'] == 0 ? "-" : number_format($payslipDetails['payslip_phic'], 2);
                $payslip_hdmf = $payslipDetails['payslip_hdmf'] == 0 ? "-" : number_format($payslipDetails['payslip_hdmf'], 2);
                $payslip_wtax = $payslipDetails['payslip_wtax'] == 0 ? "-" : number_format($payslipDetails['payslip_wtax'], 2);
                $payslip_salaryLoan = $payslipDetails['payslip_salaryLoan'] == 0 ? "-" : number_format($payslipDetails['payslip_salaryLoan'], 2);
                $payslip_mpl = $payslipDetails['payslip_mpl'] == 0 ? "-" : number_format($payslipDetails['payslip_mpl'], 2);
                $payslip_smart = $payslipDetails['payslip_smart'] == 0 ? "-" : number_format($payslipDetails['payslip_smart'], 2);
                $payslip_reimbursements = $payslipDetails['payslip_reimbursements'] == 0 ? "-" : number_format($payslipDetails['payslip_reimbursements'], 2);
                $payslip_adjustments = $payslipDetails['payslip_adjustments'] == 0 ? "-" : number_format($payslipDetails['payslip_adjustments'], 2);
                $payslip_cashAdvanceDeduction = $payslipDetails['payslip_cashAdvanceDeduction'] == 0 ? "-" : number_format($payslipDetails['payslip_cashAdvanceDeduction'], 2);
                $payslip_cashAdvanceBalance = $payslipDetails['payslip_cashAdvanceBalance'] == 0 ? "-" : number_format($payslipDetails['payslip_cashAdvanceBalance'], 2);
                $payslip_netPay = $payslipDetails['netPay'] == 0 ? "-" : number_format($payslipDetails['netPay'], 2);

                if ($isHoliday == 0) {
                    $payslip = '
                        <div>
                            <div class="text-center font-bold text-xl bg-green-300 py-2">For the Period of '.$date.'
                                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-red-500 font-bold text-4xl opacity-20 rotate-45">Confidential</div>
                            </div>
                            <div class="text-center font-bold text-lg">CELO BUSINESS SOLUTIONS, INC.</div>
                            <div class="text-center font-bold text-md mb-4 bg-green-300">PAYSLIP</div>

                            <table class="w-full text-sm mb-4">
                                <tr class="bg-green-300 font-bold">
                                    <td class="border px-2 py-1">Employee ID</td>
                                    <td class="border px-2 py-1">Name</td>
                                    <td class="border px-2 py-1">Position</td>
                                    <td class="border px-2 py-1">Employment Status</td>
                                </tr>
                                <tr>
                                    <td class="border px-2 py-1">'.$payslip_empID.'</td>
                                    <td class="border px-2 py-1">'.$payslip_employeeName.'</td>
                                    <td class="border px-2 py-1">'.$payslip_position.'</td>
                                    <td class="border px-2 py-1">'.$payslip_employmentStatus.'</td>
                                </tr>
                                <tr class="bg-green-300 font-bold">
                                    <td class="border px-2 py-1">Pay Frequency</td>
                                    <td class="border px-2 py-1">Monthly Rate</td>
                                    <td class="border px-2 py-1">Daily Rate</td>
                                    <td class="border px-2 py-1">Hourly Rate</td>
                                </tr>
                                <tr>
                                    <td class="border px-2 py-1">Semi-Monthly</td>
                                    <td class="border px-2 py-1">'.$payslip_basicPay.'</td>
                                    <td class="border px-2 py-1">'.$payslip_dailyRate.'</td>
                                    <td class="border px-2 py-1">'.$payslip_hourlyRate.'</td>
                                </tr>
                                <tr>
                                    <td class="px-2 py-1" colspan="4"></td>
                                <tr class="bg-green-300 font-bold">
                                    <td class="border px-2 py-1" colspan="2">EARNINGS</td>
                                    <td class="border px-2 py-1" colspan="2">DEDUCTIONS</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">No. of Days Worked</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_daysWorked.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">WTAX</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_wtax.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Reg Night</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regNightDiff.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">SSS</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_sss.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">PAY</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regNightDiffPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">PHIC</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_phic.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Regular OT</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularOT.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">HDMF</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_hdmf.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">PAY</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularOTPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Advances</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_cashAdvanceDeduction.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Reg OT Night</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularOTND.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Salary Loan</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_salaryLoan.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">PAY</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularOTNDPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">PAGIBIG MPL</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_mpl.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Rest Day OT</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_RDOT.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Smart</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_smart.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">PAY</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_RDOTPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Reimbursements</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_reimbursements.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">RDOT Night</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_RDOTND.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Adjustment +,-</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_adjustments.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">PAY</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_RDOTNDPay.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Special Holiday</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHoliday.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">PAY</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayPay.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1 text-left">SH Night</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayND.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">PAY</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayNDPay.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Holiday</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularHoliday.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">PAY</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularHolidayPay.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Holiday Night</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularHolidayND.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">PAY</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularHolidayNDPay.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">GROSS PAY</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_grossPay.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Allowance</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_allowances.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Communication</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_communication.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Balance C.A.</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_cashAdvanceBalance.'</td>
                                </tr>
                                <tr class="bg-green-300 font-bold">
                                    <td class="border-l-2 border-t-2 text-left px-2 py-1">Total Gross Pay</td>
                                    <td class="border-r-2 border-t-2 px-2 py-1 text-right">'.$payslip_totalGrossPay.'</td>
                                    <td class="border-l-2 border-t-2  text-left px-2 py-1">Net Pay</td>
                                    <td class="border-r-2 border-t-2 px-2 py-1 text-right">'.$payslip_netPay.'</td>
                                </tr>
                            </table>
                        </div>
                    ';
                    echo $payslip;
                }
                else {
                    $payslip2 = '
                        <div>
                            <div class="text-center font-bold text-xl bg-green-300 py-2">For the Period of '.$date.'
                                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-red-500 font-bold text-4xl opacity-20 rotate-45">Confidential</div>
                            </div>
                            <div class="text-center font-bold text-lg">CELO BUSINESS SOLUTIONS, INC.</div>
                            <div class="text-center font-bold text-md mb-4 bg-green-300">PAYSLIP</div>

                            <table class="w-full text-sm mb-4">
                                <tr class="bg-green-300 font-bold">
                                    <td class="border px-2 py-1">Employee ID</td>
                                    <td class="border px-2 py-1">Name</td>
                                    <td class="border px-2 py-1">Position</td>
                                    <td class="border px-2 py-1">Employment Status</td>
                                </tr>
                                <tr>
                                    <td class="border px-2 py-1">'.$payslip_empID.'</td>
                                    <td class="border px-2 py-1">'.$payslip_employeeName.'</td>
                                    <td class="border px-2 py-1">'.$payslip_position.'</td>
                                    <td class="border px-2 py-1">'.$payslip_employmentStatus.'</td>
                                </tr>
                                <tr class="bg-green-300 font-bold">
                                    <td class="border px-2 py-1">Pay Frequency</td>
                                    <td class="border px-2 py-1">Monthly Rate</td>
                                    <td class="border px-2 py-1">Daily Rate</td>
                                    <td class="border px-2 py-1">Hourly Rate</td>
                                </tr>
                                <tr>
                                    <td class="border px-2 py-1">Semi-Monthly</td>
                                    <td class="border px-2 py-1">'.$payslip_basicPay.'</td>
                                    <td class="border px-2 py-1">'.$payslip_dailyRate.'</td>
                                    <td class="border px-2 py-1">'.$payslip_hourlyRate.'</td>
                                </tr>
                                <tr>
                                    <td class="px-2 py-1" colspan="4"></td>
                                <tr class="bg-green-300 font-bold">
                                    <td class="border px-2 py-1" colspan="4">EARNINGS</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">No. of Days Worked</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_daysWorked.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Reg Holiday OT</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularHolidayOT.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Reg Night</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regNightDiff.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">PAY</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularHolidayOTPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">PAY</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regNightDiffPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Reg Holiday OT Night</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularHolidayOTND.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Regular OT</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularOT.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">PAY</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularHolidayOTNDPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">PAY</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularOTPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Special Holiday OT</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayOT.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Reg OT Night</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularOTND.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">PAY</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayOTPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">PAY</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularOTNDPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Special Holiday OT Night</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayOTND.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Rest Day OT</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_RDOT.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">PAY</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayOTNDPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">PAY</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_RDOTPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">RDOT Special Holiday</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_RDOTSH.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">RDOT Night</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_RDOTND.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">PAY</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_RDOTSHPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">PAY</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_RDOTNDPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">RDOT Special Holiday Night</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_RDOTSHND.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Special Holiday</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHoliday.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">PAY</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_RDOTSHNDPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">PAY</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">RDOT Holiday</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_RDOTRH.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1 text-left">SH Night</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayND.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">PAY</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_RDOTRHPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">PAY</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayNDPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">RDOT Holiday Night</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_RDOTRHND.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Holiday</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularHoliday.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">PAY</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_RDOTRHNDPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">PAY</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularHolidayPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">RDOT OT</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_RDOTOT.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Holiday Night</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularHolidayND.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">PAY</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_RDOTOTPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">PAY</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularHolidayNDPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">RDOT OT Night</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_RDOTOTND.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Double Holiday</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_doubleHoliday.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">PAY</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_RDOTOTNDPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">PAY</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_doubleHolidayPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">GROSS PAY</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_grossPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Double Holiday Night</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_doubleHolidayND.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Allowance</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_allowances.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">PAY</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_doubleHolidayNDPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Communication</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_communication.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1" colspan="2"></td>
                                    <td class="border-l-2 text-left px-2 py-1">Balance C.A.</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_cashAdvanceBalance.'</td>
                                </tr>
                                <tr class="bg-green-300 font-bold">
                                    <td class="border-r-2 border-t-2 px-2 py-1 text-left" colspan="2">DEDUCTIONS</td>
                                    <td class="border-l-2 border-t-2 text-left px-2 py-1">Total Gross Pay</td>
                                    <td class="border-r-2 border-t-2 px-2 py-1 text-right">'.$payslip_totalGrossPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">WTAX</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_wtax.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Reimbursements</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_reimbursements.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">SSS</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_sss.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Adjustment +,-</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_adjustments.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">PHIC</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_phic.'</td>
                                    <td class="border-l-2 text-left px-2 py-1" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">HDMF</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_hdmf.'</td>
                                    <td class="border-l-2 text-left px-2 py-1" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Advances</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_cashAdvanceDeduction.'</td>
                                    <td class="border-l-2 text-left px-2 py-1" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Salary Loan</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_salaryLoan.'</td>
                                    <td class="border-l-2 text-left px-2 py-1" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">PAGIBIG MPL</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_mpl.'</td>
                                    <td class="border-l-2 text-left px-2 py-1" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Smart</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_smart.'</td>
                                    <td class="border-l-2 text-left px-2 py-1" colspan="2"></td>
                                </tr>
                                <tr class="bg-green-300 font-bold">
                                    <td class="border-l-2 border-t-2  text-left px-2 py-1" colspan="2"></td>
                                    <td class="border-l-2 border-t-2  text-left px-2 py-1">Net Pay</td>
                                    <td class="border-r-2 border-t-2 px-2 py-1 text-right">'.$payslip_netPay.'</td>
                                </tr>
                            </table>
                        </div>
                    ';
                    echo $payslip2;
                }

                // AUDIT TRAIL
                $at_empID = $_SESSION['id'];
                $at_module = "User - Payslip";
                $at_action = "Generated Payslip";
                mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $at_empID));
            }
        }
        else {
            // AUDIT TRAIL
            $at_empID = $_SESSION['id'];
            $at_module = "User - Payslip";
            $at_action = "Downloaded Payslip";
            mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $at_empID));
        }
    }
?>