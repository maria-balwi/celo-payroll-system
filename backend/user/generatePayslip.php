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
                // $holidayCount = mysqli_num_rows($query);
                // $isHoliday = $holidayCount > 0 ? 1 : 0;
                $isLegal = 0;
                $isSpecial = 0;
                while ($holidayDetails = mysqli_fetch_array($query)) {
                    if ($holidayDetails['type'] == "Legal") {
                        $isLegal = 1;
                    }
                    else if ($holidayDetails['type'] == "Special") {
                        $isSpecial = 1;
                    }
                }
                $isHoliday = $isLegal && $isSpecial ? 1 : 0;

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
                $payslip_basePay = number_format($payslipDetails['basePay'], 2);
                $payslip_sssnum = $payslipDetails['sss'] == '' ? "-" : $payslipDetails['sss'];
                $payslip_pagIbignum = $payslipDetails['pagIbig'] == '' ? "-": $payslipDetails['pagIbig'];
                $payslip_philhealthnum = $payslipDetails['philhealth'] == '' ? "-" : $payslipDetails['philhealth'];
                $payslip_tinnum = $payslipDetails['tin'] == '' ? "-" : $payslipDetails['tin'];
                $payslip_daysWorked = $payslipDetails['daysWorked'] == 0 ? "-" : $payslipDetails['daysWorked'];
                $payslip_hoursWorked = $payslipDetails['daysWorked'] == 0 ? "-" : $payslipDetails['daysWorked'] * 8;

                $payslip_regularOT = $payslipDetails['regOT'] == 0 ? "-" : $payslipDetails['regOT'];
                $payslip_regularOTPay = $payslipDetails['pay_regOT'] == 0 ? "-" : number_format($payslipDetails['pay_regOT'], 2);
                $payslip_regRDOT = $payslipDetails['regRDOT'] == 0 ? "-" : $payslipDetails['regRDOT'];
                $payslip_regRDOTPay = $payslipDetails['pay_regRDOT'] == 0 ? "-" : number_format($payslipDetails['pay_regRDOT'], 2);
                $payslip_regRDOTOT = $payslipDetails['regRDOTOT'] == 0 ? "-" : $payslipDetails['regRDOTOT'];
                $payslip_regRDOTOTPay = $payslipDetails['pay_regRDOTOT'] == 0 ? "-" : number_format($payslipDetails['pay_regRDOTOT'], 2);
                $payslip_specialHoliday = $payslipDetails['specialHoliday'] == 0 ? "-" : $payslipDetails['specialHoliday'];
                $payslip_specialHolidayPay = $payslipDetails['pay_specialHoliday'] == 0 ? "-" : number_format($payslipDetails['pay_specialHoliday'], 2);
                $payslip_specialHolidayOT = $payslipDetails['specialHolidayOT'] == 0 ? "-" : $payslipDetails['specialHolidayOT'];
                $payslip_specialHolidayOTPay = $payslipDetails['pay_specialHolidayOT'] == 0 ? "-" : number_format($payslipDetails['pay_specialHolidayOT'], 2);
                $payslip_specialHolidayRDOT = $payslipDetails['specialHolidayRDOT'] == 0 ? "-" : $payslipDetails['specialHolidayRDOT'];
                $payslip_specialHolidayRDOTPay = $payslipDetails['pay_specialHolidayRDOT'] == 0 ? "-" : number_format($payslipDetails['pay_specialHolidayRDOT'], 2);
                $payslip_specialHolidayRDOTOT = $payslipDetails['specialHolidayRDOTOT'] == 0 ? "-" : $payslipDetails['specialHolidayRDOTOT'];
                $payslip_specialHolidayRDOTOTPay = $payslipDetails['pay_specialHolidayRDOTOT'] == 0 ? "-" : number_format($payslipDetails['pay_specialHolidayRDOTOT'], 2);
                
                $payslip_regularHoliday = $payslipDetails['regularHoliday'] == 0 ? "-" : $payslipDetails['regularHoliday'];
                $payslip_regularHolidayPay = $payslipDetails['pay_regularHoliday'] == 0 ? "-" : number_format($payslipDetails['pay_regularHoliday'], 2);
                $payslip_regularHolidayOT = $payslipDetails['regularHolidayOT'] == 0 ? "-" : $payslipDetails['regularHolidayOT'];
                $payslip_regularHolidayOTPay = $payslipDetails['pay_regularHolidayOT'] == 0 ? "-" : number_format($payslipDetails['pay_regularHolidayOT'], 2);
                $payslip_regularHolidayRDOT = $payslipDetails['regularHolidayRDOT'] == 0 ? "-" : $payslipDetails['regularHolidayRDOT'];
                $payslip_regularHolidayRDOTPay = $payslipDetails['pay_regularHolidayRDOT'] == 0 ? "-" : number_format($payslipDetails['pay_regularHolidayRDOT'], 2);
                $payslip_regularHolidayRDOTOT = $payslipDetails['regularHolidayRDOTOT'] == 0 ? "-" : $payslipDetails['regularHolidayRDOTOT'];
                $payslip_regularHolidayRDOTOTPay = $payslipDetails['pay_regularHolidayRDOTOT'] == 0 ? "-" : number_format($payslipDetails['pay_regularHolidayRDOTOT'], 2);

                $payslip_regNightDiff = $payslipDetails['regNightDiff'] == 0 ? "-" : $payslipDetails['regNightDiff'];
                $payslip_regNightDiffPay = $payslipDetails['pay_regNightDiff'] == 0 ? "-" : number_format($payslipDetails['pay_regNightDiff'], 2);
                $payslip_regularOTND = $payslipDetails['regOTND'] == 0 ? "-" : $payslipDetails['regOTND'];
                $payslip_regularOTNDPay = $payslipDetails['pay_regOTND'] == 0 ? "-" : number_format($payslipDetails['pay_regOTND'], 2);
                $payslip_regRDOTND = $payslipDetails['regRDOTND'] == 0 ? "-" : $payslipDetails['regRDOTND'];
                $payslip_regRDOTNDPay = $payslipDetails['pay_regRDOTND'] == 0 ? "-" : number_format($payslipDetails['pay_regRDOTND'], 2);
                $payslip_regRDOTOTND = $payslipDetails['regRDOTOTND'] == 0 ? "-" : $payslipDetails['regRDOTOTND'];
                $payslip_regRDOTOTNDPay = $payslipDetails['pay_regRDOTOTND'] == 0 ? "-" : number_format($payslipDetails['pay_regRDOTOTND'], 2);
                
                $payslip_specialHolidayND = $payslipDetails['specialHolidayND'] == 0 ? "-" : $payslipDetails['specialHolidayND'];
                $payslip_specialHolidayNDPay = $payslipDetails['pay_specialHolidayND'] == 0 ? "-" : number_format($payslipDetails['pay_specialHolidayND'], 2);
                $payslip_specialHolidayOTND = $payslipDetails['specialHolidayOTND'] == 0 ? "-" : $payslipDetails['specialHolidayOTND'];
                $payslip_specialHolidayOTNDPay = $payslipDetails['pay_specialHolidayOTND'] == 0 ? "-" : number_format($payslipDetails['pay_specialHolidayOTND'], 2);
                $payslip_specialHolidayRDOTND = $payslipDetails['specialHolidayRDOTND'] == 0 ? "-" : $payslipDetails['specialHolidayRDOTND'];
                $payslip_specialHolidayRDOTNDPay = $payslipDetails['pay_specialHolidayRDOTND'] == 0 ? "-" : number_format($payslipDetails['pay_specialHolidayRDOTND'], 2);
                $payslip_specialHolidayRDOTOTND = $payslipDetails['specialHolidayRDOTOTND'] == 0 ? "-" : $payslipDetails['specialHolidayRDOTOTND'];
                $payslip_specialHolidayRDOTOTNDPay = $payslipDetails['pay_specialHolidayRDOTOTND'] == 0 ? "-" : number_format($payslipDetails['pay_specialHolidayRDOTOTND'], 2);
                
                $payslip_regularHolidayND = $payslipDetails['regularHolidayND'] == 0 ? "-" : $payslipDetails['regularHolidayND'];
                $payslip_regularHolidayNDPay = $payslipDetails['pay_regularHolidayND'] == 0 ? "-" : number_format($payslipDetails['pay_regularHolidayND'], 2);
                $payslip_regularHolidayOTND = $payslipDetails['regularHolidayOTND'] == 0 ? "-" : $payslipDetails['regularHolidayOTND'];
                $payslip_regularHolidayOTNDPay = $payslipDetails['pay_regularHolidayOTND'] == 0 ? "-" : number_format($payslipDetails['pay_regularHolidayOTND'], 2);
                $payslip_regularHolidayRDOTND = $payslipDetails['regularHolidayRDOTND'] == 0 ? "-" : $payslipDetails['regularHolidayRDOTND'];
                $payslip_regularHolidayRDOTNDPay = $payslipDetails['pay_regularHolidayRDOTND'] == 0 ? "-" : number_format($payslipDetails['pay_regularHolidayRDOTND'], 2);
                $payslip_regularHolidayRDOTOTND = $payslipDetails['regularHolidayRDOTOTND'] == 0 ? "-" : $payslipDetails['regularHolidayRDOTOTND'];
                $payslip_regularHolidayRDOTOTNDPay = $payslipDetails['pay_regularHolidayRDOTOTND'] == 0 ? "-" : number_format($payslipDetails['pay_regularHolidayRDOTOTND'], 2);
                
                $payslip_allowances = $payslipDetails['payslip_allowances'] == 0 ? "-" : number_format($payslipDetails['payslip_allowances'], 2);
                $payslip_communication = $payslipDetails['payslip_communication'] == 0 ? "-" : number_format($payslipDetails['payslip_communication'], 2);
                $payslip_grossPay = $payslipDetails['grossPay'] == 0 ? "-" : number_format($payslipDetails['grossPay'] , 2);
                $payslip_sss = $payslipDetails['payslip_sss'] == 0 ? "-" : number_format($payslipDetails['payslip_sss'], 2);
                $payslip_sssMPF = $payslipDetails['payslip_sssMPF'] == 0 ? "-" : number_format($payslipDetails['payslip_sssMPF'], 2);
                $payslip_phic = $payslipDetails['payslip_phic'] == 0 ? "-" : number_format($payslipDetails['payslip_phic'], 2);
                $payslip_hdmf = $payslipDetails['payslip_hdmf'] == 0 ? "-" : number_format($payslipDetails['payslip_hdmf'], 2);
                $payslip_wtax = $payslipDetails['payslip_wtax'] == 0 ? "-" : number_format($payslipDetails['payslip_wtax'], 2);
                $payslip_salaryLoan = $payslipDetails['payslip_salaryLoan'] == 0 ? "-" : number_format($payslipDetails['payslip_salaryLoan'], 2);
                $payslip_hdmfSalaryLoan = $payslipDetails['payslip_hdmfSalaryLoan'] == 0 ? "-" : number_format($payslipDetails['payslip_hdmfSalaryLoan'], 2);
                $payslip_smart = $payslipDetails['payslip_smart'] == 0 ? "-" : number_format($payslipDetails['payslip_smart'], 2);
                $payslip_reimbursements = $payslipDetails['payslip_reimbursements'] == 0 ? "-" : number_format($payslipDetails['payslip_reimbursements'], 2);
                $payslip_adjustments = $payslipDetails['payslip_adjustments'] == 0 ? "-" : number_format($payslipDetails['payslip_adjustments'], 2);
                $payslip_sickLeaveCount = $payslipDetails['sickLeaveCount'] == 0 ? "-" : $payslipDetails['sickLeaveCount'];
                $payslip_sickLeavePay = $payslipDetails['pay_sickLeave'] == 0 ? "-" : number_format($payslipDetails['pay_sickLeave'], 2);
                $payslip_vacationLeaveCount = $payslipDetails['vacationLeaveCount'] == 0 ? "-" : $payslipDetails['vacationLeaveCount'];
                $payslip_vacationLeavePay = $payslipDetails['pay_vacationLeave'] == 0 ? "-" : number_format($payslipDetails['pay_vacationLeave'], 2);
                $payslip_absences = $payslipDetails['totalAbsences'] == 0 ? "-" : number_format($payslipDetails['totalAbsences'], 2);
                $payslip_absencesAmt = $payslipDetails['payslip_absences'] == 0 ? "-" : number_format($payslipDetails['payslip_absences'], 2);
                $payslip_lateMins = $payslipDetails['totalLateMins'] == 0 ? "-" : number_format($payslipDetails['totalLateMins'], 2);
                $payslip_lateMinsAmt = $payslipDetails['payslip_lateMins'] == 0 ? "-" : number_format($payslipDetails['payslip_lateMins'], 2);
                $payslip_cashAdvanceDeduction = $payslipDetails['payslip_cashAdvanceDeduction'] == 0 ? "-" : number_format($payslipDetails['payslip_cashAdvanceDeduction'], 2);
                // $payslip_cashAdvanceBalance = $payslipDetails['payslip_cashAdvanceBalance'] == 0 ? "-" : number_format($payslipDetails['payslip_cashAdvanceBalance'], 2);
                // $payslip_caPettyCash = $payslipDetails['payslip_caPettyCash'] == 0 ? "-" : number_format($payslipDetails['payslip_caPettyCash'], 2);
                $payslip_netPay = $payslipDetails['netPay'] == 0 ? "-" : number_format($payslipDetails['netPay'], 2);

                $overtimeQuery = mysqli_query($conn, "SELECT * FROM tbl_filedot WHERE empID = $payslip_id AND (otDate BETWEEN '$payrollCycleFrom' AND '$payrollCycleTo') AND status = 1");
                $overtimeCount = mysqli_num_rows($overtimeQuery);
                $isOvertime = $overtimeCount > 0 ? 1 : 0;

                $payslip = '';
                if ($isHoliday == 0 && $isOvertime == 0) {
                    $payslip = '
                        <div>
                            <div class="text-center font-bold text-xl bg-green-300 py-2" id="payslipDate">For the Period of '.$date.'</div>
                            <div class="text-center font-bold text-lg">CELO BUSINESS SOLUTIONS INCORPORATED</div>
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
                                    <td class="border px-2 py-1">TIN</td>
                                    <td class="border px-2 py-1">SSS</td>
                                    <td class="border px-2 py-1">HDMF No.</td>
                                    <td class="border px-2 py-1">PHIC No.</td>
                                </tr>
                                <tr>
                                    <td class="border px-2 py-1">'.$payslip_tinnum.'</td>
                                    <td class="border px-2 py-1">'.$payslip_sssnum.'</td>
                                    <td class="border px-2 py-1">'.$payslip_pagIbignum.'</td>
                                    <td class="border px-2 py-1">'.$payslip_philhealthnum.'</td>
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
                                    <td class="border px-2 py-1 text-right" colspan="4"></td>
                                </tr>
                                <tr class="bg-green-300 font-bold">
                                    <td class="border px-2 py-1" colspan="2">EARNINGS</td>
                                    <td class="border px-2 py-1" colspan="2">DEDUCTIONS</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">No. of Hours Worked</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_hoursWorked.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">SSS</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_sss.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Total Regular Wage</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_basePay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">SSS MPF</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_sssMPF.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regNightDiff.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">PhilHealth</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_phic.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regNightDiffPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">HDMF</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_hdmf.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Absences</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_absences.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">WTAX</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_wtax.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Absences Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_absencesAmt.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">SSS Salary Loan</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_salaryLoan.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Late Mins</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_lateMins.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Cash Advances</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_cashAdvanceDeduction.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Late Mins Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_lateMinsAmt.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">HDMF Salary Loan</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_hdmfSalaryLoan.'</td>
                                </tr>
                                <tr>
                                    <td class="border px-2 py-1 bg-green-300 font-bold" colspan="2">ADDITIONS/ADJUSTMENTS</td>
                                    <td class="border-l-2 text-left px-2 py-1">Smart Communication</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_smart.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Allowance</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_allowances.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Communication</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_communication.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Sick Leave</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_sickLeaveCount.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Sick Leave Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_sickLeavePay.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Vacation Leave Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_vacationLeavePay.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr class="bg-green-300 font-bold">
                                    <td class="border-l-2 border-t-2 text-left px-2 py-1">Gross Pay</td>
                                    <td class="border-r-2 border-t-2 px-2 py-1 text-right">'.$payslip_grossPay.'</td>
                                    <td class="border-l-2 border-t-2  text-left px-2 py-1">Net Pay</td>
                                    <td class="border-r-2 border-t-2 px-2 py-1 text-right">'.$payslip_netPay.'</td>
                                </tr>
                            </table>
                        </div>
                    ';
                }
                else if ($isHoliday == 0 && $isOvertime == 1) {
                    $payslip = '
                        <div>
                            <div class="text-center font-bold text-xl bg-green-300 py-2" id="payslipDate">For the Period of '.$date.'</div>
                            <div class="text-center font-bold text-lg">CELO BUSINESS SOLUTIONS INCORPORATED</div>
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
                                    <td class="border px-2 py-1">TIN</td>
                                    <td class="border px-2 py-1">SSS</td>
                                    <td class="border px-2 py-1">HDMF No.</td>
                                    <td class="border px-2 py-1">PHIC No.</td>
                                </tr>
                                <tr>
                                    <td class="border px-2 py-1">'.$payslip_tinnum.'</td>
                                    <td class="border px-2 py-1">'.$payslip_sssnum.'</td>
                                    <td class="border px-2 py-1">'.$payslip_pagIbignum.'</td>
                                    <td class="border px-2 py-1">'.$payslip_philhealthnum.'</td>
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
                                    <td class="border px-2 py-1 text-right" colspan="4"></td>
                                </tr>
                                <tr class="bg-green-300 font-bold">
                                    <td class="border px-2 py-1" colspan="2">EARNINGS</td>
                                    <td class="border px-2 py-1" colspan="2">ADDITIONS/ADJUSTMENTS</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">No. of Hours Worked</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_hoursWorked.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Allowance</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_allowances.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Total Regular Wage</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_basePay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Communication</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_communication.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regNightDiff.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Sick Leave</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_sickLeaveCount.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regNightDiffPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Sick Leave Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_sickLeavePay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Regular OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularOT.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Vacation Leave</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_vacationLeaveCount.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Regular OT Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularOTPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Vacation Leave Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_vacationLeavePay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularOTND.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff OT Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularOTNDPay.'</td>
                                    <td class="border px-2 py-1 bg-green-300 font-bold" colspan="2">DEDUCTIONS</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Restday Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regRDOT.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">SSS</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_sss.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Restday Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regRDOTPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">SSS MPF</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_sssMPF.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Restday Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regRDOTND.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">PhilHealth</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_phic.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Restday Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regRDOTNDPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">HDMF</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_hdmf.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Restday OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regRDOTOT.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">WTAX</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_wtax.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Restday OT Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regRDOTOTPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">SSS Salary Loan</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_salaryLoan.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Restday OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regRDOTOTND.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Cash Advances</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_cashAdvanceDeduction.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Restday OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regRDOTOTND.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">HDMF Salary Loan</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_hdmfSalaryLoan.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Absences</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_absences.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Smart Communication</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_smart.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Absences Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_absencesAmt.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Late Mins</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_lateMins.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Late Mins Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_lateMinsAmt.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr class="bg-green-300 font-bold">
                                    <td class="border-l-2 border-t-2 text-left px-2 py-1">Gross Pay</td>
                                    <td class="border-r-2 border-t-2 px-2 py-1 text-right">'.$payslip_grossPay.'</td>
                                    <td class="border-l-2 border-t-2  text-left px-2 py-1">Net Pay</td>
                                    <td class="border-r-2 border-t-2 px-2 py-1 text-right">'.$payslip_netPay.'</td>
                                </tr>
                            </table>
                        </div>
                    ';
                }
                else if ($isSpecial == 1 && $isOvertime == 0) {
                    $payslip = '
                        <div>
                            <div class="text-center font-bold text-xl bg-green-300 py-2">For the Period of '.$date.'
                                
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
                                    <td class="border px-2 py-1">TIN</td>
                                    <td class="border px-2 py-1">SSS</td>
                                    <td class="border px-2 py-1">HDMF No.</td>
                                    <td class="border px-2 py-1">PHIC No.</td>
                                </tr>
                                <tr>
                                    <td class="border px-2 py-1">'.$payslip_tinnum.'</td>
                                    <td class="border px-2 py-1">'.$payslip_sssnum.'</td>
                                    <td class="border px-2 py-1">'.$payslip_pagIbignum.'</td>
                                    <td class="border px-2 py-1">'.$payslip_philhealthnum.'</td>
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
                                    <td class="border px-2 py-1 text-right" colspan="4"></td>
                                </tr>
                                <tr class="bg-green-300 font-bold">
                                    <td class="border px-2 py-1" colspan="2">EARNINGS</td>
                                    <td class="border px-2 py-1" colspan="2">DEDUCTIONS</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">No. of Hours Worked</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_hoursWorked.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">SSS</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_sss.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Total Regular Wage</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_basePay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">SSS MPF</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_sssMPF.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regNightDiff.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">PhilHealth</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_phic.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regNightDiffPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">HDMF</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_hdmf.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Special Holiday Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHoliday.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">WTAX</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_wtax.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Special Holiday Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">SSS Salary Loan</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_salaryLoan.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Special Holiday Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayND.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Cash Advances</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_cashAdvanceDeduction.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Special Holiday Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayNDPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">HDMF Salary Loan</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_hdmfSalaryLoan.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Absences</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_absences.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Smart Communication</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_smart.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Absences Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_absencesAmt.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Late Mins</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_lateMins.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Late Mins Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_lateMinsAmt.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border px-2 py-1 bg-green-300 font-bold" colspan="2">ADDITIONS/ADJUSTMENTS</td>
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
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Sick Leave</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_sickLeaveCount.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Sick Leave Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_sickLeavePay.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Vacation Leave Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_vacationLeavePay.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr class="bg-green-300 font-bold">
                                    <td class="border-l-2 border-t-2 text-left px-2 py-1">Gross Pay</td>
                                    <td class="border-r-2 border-t-2 px-2 py-1 text-right">'.$payslip_grossPay.'</td>
                                    <td class="border-l-2 border-t-2  text-left px-2 py-1">Net Pay</td>
                                    <td class="border-r-2 border-t-2 px-2 py-1 text-right">'.$payslip_netPay.'</td>
                                </tr>
                            </table>
                        </div>
                    ';
                }
                else if ($isSpecial == 1 && $isOvertime == 1) {
                    $payslip = '
                        <div>
                            <div class="text-center font-bold text-xl bg-green-300 py-2">For the Period of '.$date.'
                                
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
                                    <td class="border px-2 py-1">TIN</td>
                                    <td class="border px-2 py-1">SSS</td>
                                    <td class="border px-2 py-1">HDMF No.</td>
                                    <td class="border px-2 py-1">PHIC No.</td>
                                </tr>
                                <tr>
                                    <td class="border px-2 py-1">'.$payslip_tinnum.'</td>
                                    <td class="border px-2 py-1">'.$payslip_sssnum.'</td>
                                    <td class="border px-2 py-1">'.$payslip_pagIbignum.'</td>
                                    <td class="border px-2 py-1">'.$payslip_philhealthnum.'</td>
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
                                    <td class="border px-2 py-1 text-right" colspan="4"></td>
                                </tr>
                                <tr class="bg-green-300 font-bold">
                                    <td class="border px-2 py-1" colspan="4">EARNINGS</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">No. of Hours Worked</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_hoursWorked.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Special Holiday Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHoliday.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Total Regular Wage</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_basePay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Special Holiday Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regNightDiff.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Special Holiday Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayND.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regNightDiffPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Special Holiday Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayNDPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Regular OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularOT.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Special Holiday OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayOT.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Regular OT Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularOTPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Special Holiday OT Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayOTPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularOTND.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Special Holiday OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayOTND.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff OT Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularOTNDPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Special Holiday OT Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayOTNDPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Restday Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regRDOT.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Special Holiday Restday Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayRDOT.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Restday Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regRDOTPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Special Holiday Restday Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayRDOTPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Restday Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regRDOTND.'</td>
                                    <td class="border-l-2 px-2 py-1 text-left">Night Diff Special Holiday Restday Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayRDOTND.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Restday Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regRDOTNDPay.'</td>
                                    <td class="border-l-2 px-2 py-1 text-left">Night Diff Special Holiday Restday Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayRDOTNDPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Restday OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regRDOTOT.'</td>
                                    <td class="border-l-2 px-2 py-1 text-left">Special Holiday Restday OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayRDOTOT.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Restday OT Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regRDOTOTPay.'</td>
                                    <td class="border-l-2 px-2 py-1 text-left">Special Holiday Restday OT Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayRDOTOTPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Restday OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regRDOTOTND.'</td>
                                    <td class="border-l-2 px-2 py-1 text-left">Night Diff Special Holiday Restday OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayRDOTOTND.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Restday OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regRDOTOTND.'</td>
                                    <td class="border-l-2 px-2 py-1 text-left">Night Diff Special Holiday Restday OT Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayRDOTOTNDPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Absences</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_absences.'</td>
                                    <td class="border px-2 py-1 bg-green-300 font-bold" colspan="2">DEDUCTIONS</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Absences Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_absencesAmt.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">SSS</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_sss.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Late Minutes</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_lateMins.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">SSS MPF</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_sssMPF.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Late Minutes Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_lateMinsAmt.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">PhilHealth</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_phic.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 px-2 py-1 text-right" colspan="2"></td>
                                    <td class="border-l-2 text-left px-2 py-1">HDMF</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_hdmf.'</td>
                                </tr>
                                <tr>
                                    <td class="border px-2 py-1 bg-green-300 font-bold" colspan="2">ADDITIONS/ADJUSTMENTS</td>
                                    <td class="border-l-2 text-left px-2 py-1">WTAX</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_wtax.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Allowance</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_allowances.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">SSS Salary Loan</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_salaryLoan.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Communication</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_communication.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Cash Advances</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_cashAdvanceDeduction.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Sick Leave</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_sickLeaveCount.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">HDMF Salary Loan</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_hdmfSalaryLoan.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Sick Leave Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_sickLeavePay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Smart Communication</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_smart.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Vacation Leave Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_vacationLeavePay.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr class="bg-green-300 font-bold">
                                    <td class="border-l-2 border-t-2 text-left px-2 py-1">Gross Pay</td>
                                    <td class="border-r-2 border-t-2 px-2 py-1 text-right">'.$payslip_grossPay.'</td>
                                    <td class="border-l-2 border-t-2  text-left px-2 py-1">Net Pay</td>
                                    <td class="border-r-2 border-t-2 px-2 py-1 text-right">'.$payslip_netPay.'</td>
                                </tr>
                            </table>
                        </div>
                    ';
                }
                else if ($isLegal == 1 && $isOvertime == 0) {
                    $payslip = '
                        <div>
                            <div class="text-center font-bold text-xl bg-green-300 py-2">For the Period of '.$date.'
                                
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
                                    <td class="border px-2 py-1">TIN</td>
                                    <td class="border px-2 py-1">SSS</td>
                                    <td class="border px-2 py-1">HDMF No.</td>
                                    <td class="border px-2 py-1">PHIC No.</td>
                                </tr>
                                <tr>
                                    <td class="border px-2 py-1">'.$payslip_tinnum.'</td>
                                    <td class="border px-2 py-1">'.$payslip_sssnum.'</td>
                                    <td class="border px-2 py-1">'.$payslip_pagIbignum.'</td>
                                    <td class="border px-2 py-1">'.$payslip_philhealthnum.'</td>
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
                                    <td class="border px-2 py-1 text-right" colspan="4"></td>
                                </tr>
                                <tr class="bg-green-300 font-bold">
                                    <td class="border px-2 py-1" colspan="2">EARNINGS</td>
                                    <td class="border px-2 py-1" colspan="2">DEDUCTIONS</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">No. of Hours Worked</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_hoursWorked.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">SSS</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_sss.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Total Regular Wage</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_basePay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">SSS MPF</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_sssMPF.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regNightDiff.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">PhilHealth</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_phic.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regNightDiffPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">HDMF</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_hdmf.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Legal Holiday Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularHoliday.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">WTAX</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_wtax.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Legal Holiday Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularHolidayPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">SSS Salary Loan</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_salaryLoan.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Legal Holiday Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularHolidayND.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Cash Advances</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_cashAdvanceDeduction.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Legal Holiday Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularHolidayNDPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">HDMF Salary Loan</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_hdmfSalaryLoan.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Absences</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_absences.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Smart Communication</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_smart.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Absences Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_absencesAmt.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Late Mins</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_lateMins.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Late Mins Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_lateMinsAmt.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border px-2 py-1 bg-green-300 font-bold" colspan="2">ADDITIONS/ADJUSTMENTS</td>
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
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Sick Leave</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_sickLeaveCount.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Sick Leave Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_sickLeavePay.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Vacation Leave Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_vacationLeavePay.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr class="bg-green-300 font-bold">
                                    <td class="border-l-2 border-t-2 text-left px-2 py-1">Gross Pay</td>
                                    <td class="border-r-2 border-t-2 px-2 py-1 text-right">'.$payslip_grossPay.'</td>
                                    <td class="border-l-2 border-t-2  text-left px-2 py-1">Net Pay</td>
                                    <td class="border-r-2 border-t-2 px-2 py-1 text-right">'.$payslip_netPay.'</td>
                                </tr>
                            </table>
                        </div>
                    ';
                }
                else if ($isLegal == 1 && $isOvertime == 1) {
                    $payslip = '
                        <div>
                            <div class="text-center font-bold text-xl bg-green-300 py-2">For the Period of '.$date.'
                                
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
                                    <td class="border px-2 py-1">TIN</td>
                                    <td class="border px-2 py-1">SSS</td>
                                    <td class="border px-2 py-1">HDMF No.</td>
                                    <td class="border px-2 py-1">PHIC No.</td>
                                </tr>
                                <tr>
                                    <td class="border px-2 py-1">'.$payslip_tinnum.'</td>
                                    <td class="border px-2 py-1">'.$payslip_sssnum.'</td>
                                    <td class="border px-2 py-1">'.$payslip_pagIbignum.'</td>
                                    <td class="border px-2 py-1">'.$payslip_philhealthnum.'</td>
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
                                    <td class="border px-2 py-1 text-right" colspan="4"></td>
                                </tr>
                                <tr class="bg-green-300 font-bold">
                                    <td class="border px-2 py-1" colspan="4">EARNINGS</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">No. of Hours Worked</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_hoursWorked.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Legal Holiday Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHoliday.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Total Regular Wage</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_basePay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Legal Holiday Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regNightDiff.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Legal Holiday Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayND.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regNightDiffPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Legal Holiday Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayNDPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Regular OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularOT.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Legal Holiday OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayOT.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Regular OT Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularOTPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Legal Holiday OT Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayOTPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularOTND.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Legal Holiday OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayOTND.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff OT Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularOTNDPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Legal Holiday OT Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayOTNDPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Restday Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regRDOT.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Legal Holiday Restday Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayRDOT.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Restday Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regRDOTPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Legal Holiday Restday Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayRDOTPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Restday Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regRDOTND.'</td>
                                    <td class="border-l-2 px-2 py-1 text-left">Night Diff Legal Holiday Restday Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayRDOTND.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Restday Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regRDOTNDPay.'</td>
                                    <td class="border-l-2 px-2 py-1 text-left">Night Diff Legal Holiday Restday Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayRDOTNDPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Restday OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regRDOTOT.'</td>
                                    <td class="border-l-2 px-2 py-1 text-left">Legal Holiday Restday OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayRDOTOT.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Restday OT Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regRDOTOTPay.'</td>
                                    <td class="border-l-2 px-2 py-1 text-left">Legal Holiday Restday OT Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayRDOTOTPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Restday OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regRDOTOTND.'</td>
                                    <td class="border-l-2 px-2 py-1 text-left">Night Diff Legal Holiday Restday OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayRDOTOTND.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Restday OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regRDOTOTND.'</td>
                                    <td class="border-l-2 px-2 py-1 text-left">Night Diff Legal Holiday Restday OT Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayRDOTOTNDPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Absences</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_absences.'</td>
                                    <td class="border px-2 py-1 bg-green-300 font-bold" colspan="2">DEDUCTIONS</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Absences Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_absencesAmt.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">SSS</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_sss.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Late Minutes</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_lateMins.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">SSS MPF</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_sssMPF.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Late Minutes Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_lateMinsAmt.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">PhilHealth</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_phic.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 px-2 py-1 text-right" colspan="2"></td>
                                    <td class="border-l-2 text-left px-2 py-1">HDMF</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_hdmf.'</td>
                                </tr>
                                <tr>
                                    <td class="border px-2 py-1 bg-green-300 font-bold" colspan="2">ADDITIONS/ADJUSTMENTS</td>
                                    <td class="border-l-2 text-left px-2 py-1">WTAX</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_wtax.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Allowance</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_allowances.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">SSS Salary Loan</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_salaryLoan.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Communication</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_communication.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Cash Advances</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_cashAdvanceDeduction.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Sick Leave</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_sickLeaveCount.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">HDMF Salary Loan</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_hdmfSalaryLoan.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Sick Leave Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_sickLeavePay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Smart Communication</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_smart.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Vacation Leave Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_vacationLeavePay.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr class="bg-green-300 font-bold">
                                    <td class="border-l-2 border-t-2 text-left px-2 py-1">Gross Pay</td>
                                    <td class="border-r-2 border-t-2 px-2 py-1 text-right">'.$payslip_grossPay.'</td>
                                    <td class="border-l-2 border-t-2  text-left px-2 py-1">Net Pay</td>
                                    <td class="border-r-2 border-t-2 px-2 py-1 text-right">'.$payslip_netPay.'</td>
                                </tr>
                            </table>
                        </div>
                    ';
                }
                else if ($isHoliday == 1 && $isOvertime == 0) {
                    $payslip = '
                        <div>
                            <div class="text-center font-bold text-xl bg-green-300 py-2">For the Period of '.$date.'
                                
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
                                    <td class="border px-2 py-1">TIN</td>
                                    <td class="border px-2 py-1">SSS</td>
                                    <td class="border px-2 py-1">HDMF No.</td>
                                    <td class="border px-2 py-1">PHIC No.</td>
                                </tr>
                                <tr>
                                    <td class="border px-2 py-1">'.$payslip_tinnum.'</td>
                                    <td class="border px-2 py-1">'.$payslip_sssnum.'</td>
                                    <td class="border px-2 py-1">'.$payslip_pagIbignum.'</td>
                                    <td class="border px-2 py-1">'.$payslip_philhealthnum.'</td>
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
                                    <td class="border px-2 py-1 text-right" colspan="4"></td>
                                </tr>
                                <tr class="bg-green-300 font-bold">
                                    <td class="border px-2 py-1" colspan="2">EARNINGS</td>
                                    <td class="border px-2 py-1" colspan="2">DEDUCTIONS</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">No. of Hours Worked</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_hoursWorked.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">SSS</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_sss.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Total Regular Wage</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_basePay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">SSS MPF</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_sssMPF.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regNightDiff.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">PhilHealth</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_phic.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regNightDiffPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">HDMF</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_hdmf.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Special Holiday Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHoliday.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">WTAX</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_wtax.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Special Holiday Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">SSS Salary Loan</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_salaryLoan.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Special Holiday Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayND.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Cash Advances</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_cashAdvanceDeduction.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Special Holiday Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayNDPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">HDMF Salary Loan</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_hdmfSalaryLoan.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Legal Holiday Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHoliday.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Smart Communication</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_smart.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Legal Holiday Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayPay.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Legal Holiday Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayND.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Legal Holiday Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayNDPay.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Absences</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_absences.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Absences Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_absencesAmt.'</td>
                                    
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Late Mins</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_lateMins.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Late Mins Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_lateMinsAmt.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border px-2 py-1 bg-green-300 font-bold" colspan="2">ADDITIONS/ADJUSTMENTS</td>
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
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Sick Leave</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_sickLeaveCount.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Sick Leave Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_sickLeavePay.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Vacation Leave Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_vacationLeavePay.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr class="bg-green-300 font-bold">
                                    <td class="border-l-2 border-t-2 text-left px-2 py-1">Gross Pay</td>
                                    <td class="border-r-2 border-t-2 px-2 py-1 text-right">'.$payslip_grossPay.'</td>
                                    <td class="border-l-2 border-t-2  text-left px-2 py-1">Net Pay</td>
                                    <td class="border-r-2 border-t-2 px-2 py-1 text-right">'.$payslip_netPay.'</td>
                                </tr>
                            </table>
                        </div>
                    ';
                }
                else {
                    $payslip = '
                        <div>
                            <div class="text-center font-bold text-xl bg-green-300 py-2">For the Period of '.$date.'
                                
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
                                    <td class="border px-2 py-1">TIN</td>
                                    <td class="border px-2 py-1">SSS</td>
                                    <td class="border px-2 py-1">HDMF No.</td>
                                    <td class="border px-2 py-1">PHIC No.</td>
                                </tr>
                                <tr>
                                    <td class="border px-2 py-1">'.$payslip_tinnum.'</td>
                                    <td class="border px-2 py-1">'.$payslip_sssnum.'</td>
                                    <td class="border px-2 py-1">'.$payslip_pagIbignum.'</td>
                                    <td class="border px-2 py-1">'.$payslip_philhealthnum.'</td>
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
                                    <td class="border px-2 py-1 text-right" colspan="4"></td>
                                </tr>
                                <tr class="bg-green-300 font-bold">
                                    <td class="border px-2 py-1" colspan="4">EARNINGS</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">No. of Hours Worked</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_hoursWorked.'</td>
                                    <td class="border-l-2 px-2 py-1 text-left">Night Diff Special Holiday Restday OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayRDOTOTND.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Total Regular Wage</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_basePay.'</td>
                                    <td class="border-l-2 px-2 py-1 text-left">Night Diff Special Holiday Restday OT Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayRDOTOTNDPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regNightDiff.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Legal Holiday Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHoliday.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regNightDiffPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Legal Holiday Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Regular OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularOT.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Legal Holiday Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayND.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Regular OT Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularOTPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Legal Holiday Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayNDPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularOTND.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Legal Holiday OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayOT.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff OT Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regularOTNDPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Legal Holiday OT Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayOTPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Restday Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regRDOT.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Legal Holiday OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayOTND.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Restday Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regRDOTPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Legal Holiday OT Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayOTNDPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Restday Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regRDOTND.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Legal Holiday Restday Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayRDOT.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Restday Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regRDOTNDPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Legal Holiday Restday Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayRDOTPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Restday OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regRDOTOT.'</td>
                                    <td class="border-l-2 px-2 py-1 text-left">Night Diff Legal Holiday Restday Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayRDOTND.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Restday OT Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regRDOTOTPay.'</td>
                                    <td class="border-l-2 px-2 py-1 text-left">Night Diff Legal Holiday Restday Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayRDOTNDPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Restday OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regRDOTOTND.'</td>
                                    <td class="border-l-2 px-2 py-1 text-left">Legal Holiday Restday OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayRDOTOT.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Restday OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_regRDOTOTND.'</td>
                                    <td class="border-l-2 px-2 py-1 text-left">Legal Holiday Restday OT Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayRDOTOTPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Special Holiday Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHoliday.'</td>
                                    <td class="border-l-2 px-2 py-1 text-left">Night Diff Legal Holiday Restday OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayRDOTOTND.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Special Holiday Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayPay.'</td>
                                    <td class="border-l-2 px-2 py-1 text-left">Night Diff Legal Holiday Restday OT Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayRDOTOTNDPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Special Holiday Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayND.'</td>
                                    <td class="border-l-2 px-2 py-1 text-left">Special Holiday Restday OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayRDOTOT.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Special Holiday Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayNDPay.'</td>
                                    <td class="border-l-2 px-2 py-1 text-left">Special Holiday Restday OT Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayRDOTOTPay.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Special Holiday OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayOT.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Absences</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_absences.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Special Holiday OT Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayOTPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Absences Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_absencesAmt.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Special Holiday OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayOTND.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Late Minutes</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_lateMins.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Special Holiday OT Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayOTPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Late Minutes Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_lateMinsAmt.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Special Holiday OT Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayOTND.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Night Diff Special Holiday OT Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayOTNDPay.'</td>
                                    <td class="border px-2 py-1 bg-green-300 font-bold" colspan="2">DEDUCTIONS</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Special Holiday Restday Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayRDOT.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">SSS</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_sss.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Special Holiday Restday Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayRDOTPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">SSS MPF</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_sssMPF.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 px-2 py-1 text-left">Night Diff Special Holiday Restday Hrs</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayRDOTND.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">PhilHealth</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_phic.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 px-2 py-1 text-left">Night Diff Special Holiday Restday Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_specialHolidayRDOTNDPay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">HDMF</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_hdmf.'</td>
                                </tr>
                                <tr>
                                    <td class="border px-2 py-1 bg-green-300 font-bold" colspan="2">ADDITIONS/ADJUSTMENTS</td>
                                    <td class="border-l-2 text-left px-2 py-1">WTAX</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_wtax.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Allowance</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_allowances.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">SSS Salary Loan</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_salaryLoan.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Communication</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_communication.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Cash Advances</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_cashAdvanceDeduction.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Sick Leave</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_sickLeaveCount.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">HDMF Salary Loan</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_hdmfSalaryLoan.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Sick Leave Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_sickLeavePay.'</td>
                                    <td class="border-l-2 text-left px-2 py-1">Smart Communication</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_smart.'</td>
                                </tr>
                                <tr>
                                    <td class="border-l-2 text-left px-2 py-1">Vacation Leave Amt</td>
                                    <td class="border-r-2 px-2 py-1 text-right">'.$payslip_vacationLeavePay.'</td>
                                    <td class="border-r-2 px-2 py-1 text-right" colspan="2"></td>
                                </tr>
                                <tr class="bg-green-300 font-bold">
                                    <td class="border-l-2 border-t-2 text-left px-2 py-1">Gross Pay</td>
                                    <td class="border-r-2 border-t-2 px-2 py-1 text-right">'.$payslip_grossPay.'</td>
                                    <td class="border-l-2 border-t-2  text-left px-2 py-1">Net Pay</td>
                                    <td class="border-r-2 border-t-2 px-2 py-1 text-right">'.$payslip_netPay.'</td>
                                </tr>
                            </table>
                        </div>
                    ';
                }

                echo $payslip; 

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