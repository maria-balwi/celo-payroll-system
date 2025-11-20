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
                    function formatDate($date, $dateCreated) {
                        // Get the current year
                        $currentYear = date('Y');

                        $dateCreatedYear = date('Y', strtotime($dateCreated));

                        if ($dateCreatedYear == $currentYear) {
                            $finalYear = $currentYear;
                        }
                        else {
                            $finalYear = $dateCreatedYear;
                        }
                        
                        // Append the current year to the input date
                        $dateWithYear = $date . '-' . $finalYear;
                        
                        // Create a DateTime object from the string (expects format MM-DD-YYYY)
                        $dateTime = DateTime::createFromFormat('m-d-Y', $dateWithYear);
                        
                        // Format the date as 'M d, Y'
                        return $dateTime->format('F d, Y');
                    }

                    $payrollID = $_GET['id']; 
                    $payrollCycleID = $_GET['cycleID']; 
                    $payrollDateCreated = $_GET['dateCreated']; 
                    // $payrollCycleID = mysqli_query($conn, "SELECT payrollCycleID FROM tbl_payroll WHERE payrollID = $payrollID")->fetch_assoc()['payrollCycleID']; 
                    $payrollCycleFrom_date = mysqli_query($conn, "SELECT * FROM tbl_payrollcycle WHERE payrollCycleID = $payrollCycleID")->fetch_assoc()['payrollCycleFrom'];
                    $payrollCycleTo_date = mysqli_query($conn, "SELECT * FROM tbl_payrollcycle WHERE payrollCycleID = $payrollCycleID")->fetch_assoc()['payrollCycleTo'];
                    $payrollCycleFrom = formatDate($payrollCycleFrom_date, $payrollDateCreated);
                    $payrollCycleTo = formatDate($payrollCycleTo_date, $payrollDateCreated);
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
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle whitespace-nowrap" rowspan="2">Employee ID</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Name</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle whitespace-nowrap" rowspan="2">Basic Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle whitespace-nowrap" rowspan="2">Daily Rate</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Hourly Rate</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">No. Of Days</th>  
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle whitespace-nowrap" rowspan="2">Base Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">Reg Night Diff (15%)</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">Regular OT (25%)</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">Regular OT Night Diff</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">RDOT</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">RDOT w/ Night Diff</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">RDOT OT</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">RDOT OT w/ Night Diff</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>

                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">Special Holiday</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">S.H. Night Diff</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">Special Holiday OT</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">S.H. OT w/ Night Diff</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">RDOT Special Holiday</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">RDOT S.H. w/ Night Diff</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">RDOT OT Special Holiday</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">RDOT OT S.H. w/ Night Diff</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>

                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">Regular Holiday</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">R.H Night Diff</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">Regular Holiday OT</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">R.H. OT w/ Night Diff</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">RDOT Regular Holiday</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">RDOT R.H. w/ Night Diff</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">RDOT OT Regular Holiday</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">RDOT OT R.H. w/ Night Diff</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Pay</th>
                                        
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">Allowance</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">Communication Allowance</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle whitespace-nowrap" rowspan="2">Gross Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" colspan="8">Deductions</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">Reimbursements</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">Adjustment +,-</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle" rowspan="2">Net Pay</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 tracking-wider align-middle" rowspan="2">C/A Balance</th> 
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
                                            $payslip_basePay = $payslipDetails['basePay'];
                                            $payslip_regNightDiff = $payslipDetails['regNightDiff'];
                                            $payslip_regNightDiffPay = number_format($payslipDetails['pay_regNightDiff'], 2);
                                            $payslip_regularOT = $payslipDetails['regOT'];
                                            $payslip_regularOTPay = number_format($payslipDetails['pay_regOT'], 2);
                                            $payslip_regularOTND = $payslipDetails['regOTND'];
                                            $payslip_regularOTNDPay = number_format($payslipDetails['pay_regOTND'], 2);
                                            $payslip_regRDOT = $payslipDetails['regRDOT'];
                                            $payslip_regRDOTPay = number_format($payslipDetails['pay_regRDOT'], 2);
                                            $payslip_regRDOTND = $payslipDetails['regRDOTND'];
                                            $payslip_regRDOTNDPay = number_format($payslipDetails['pay_regRDOTND'], 2);
                                            $payslip_regRDOTOT = $payslipDetails['regRDOTOT'];
                                            $payslip_regRDOTOTPay = number_format($payslipDetails['pay_regRDOTOT'], 2);
                                            $payslip_regRDOTOTND = $payslipDetails['regRDOTOTND'];
                                            $payslip_regRDOTOTNDPay = number_format($payslipDetails['pay_regRDOTOTND'], 2);

                                            $payslip_specialHoliday = $payslipDetails['specialHoliday'];
                                            $payslip_specialHolidayPay = number_format($payslipDetails['pay_specialHoliday'], 2);
                                            $payslip_specialHolidayND = $payslipDetails['specialHolidayND'];
                                            $payslip_specialHolidayNDPay = number_format($payslipDetails['pay_specialHolidayND'], 2);
                                            $payslip_specialHolidayOT = $payslipDetails['specialHolidayOT'];
                                            $payslip_specialHolidayOTPay = number_format($payslipDetails['pay_specialHolidayOT'], 2);
                                            $payslip_specialHolidayOTND = $payslipDetails['specialHolidayOTND'];
                                            $payslip_specialHolidayOTNDPay = number_format($payslipDetails['pay_specialHolidayOTND'], 2);
                                            $payslip_specialHolidayRDOT = $payslipDetails['specialHolidayRDOT'];
                                            $payslip_specialHolidayRDOTPay = number_format($payslipDetails['pay_specialHolidayRDOT'], 2);
                                            $payslip_specialHolidayRDOTND = $payslipDetails['specialHolidayRDOTND'];
                                            $payslip_specialHolidayRDOTNDPay = number_format($payslipDetails['pay_specialHolidayRDOTND'], 2);
                                            $payslip_specialHolidayRDOTOT = $payslipDetails['specialHolidayRDOTOT'];
                                            $payslip_specialHolidayRDOTOTPay = number_format($payslipDetails['pay_specialHolidayRDOTOT'], 2);
                                            $payslip_specialHolidayRDOTOTND = $payslipDetails['specialHolidayRDOTOTND'];
                                            $payslip_specialHolidayRDOTOTNDPay = number_format($payslipDetails['pay_specialHolidayRDOTOTND'], 2);

                                            $payslip_regularHoliday = $payslipDetails['regularHoliday'];
                                            $payslip_regularHolidayPay = number_format($payslipDetails['pay_regularHoliday'], 2);
                                            $payslip_regularHolidayND = $payslipDetails['regularHolidayND'];
                                            $payslip_regularHolidayNDPay = number_format($payslipDetails['pay_regularHolidayND'], 2);
                                            $payslip_regularHolidayOT = $payslipDetails['regularHolidayOT'];
                                            $payslip_regularHolidayOTPay = number_format($payslipDetails['pay_regularHolidayOT'], 2);
                                            $payslip_regularHolidayOTND = $payslipDetails['regularHolidayOTND'];
                                            $payslip_regularHolidayOTNDPay = number_format($payslipDetails['pay_regularHolidayOTND'], 2);
                                            $payslip_regularHolidayRDOT = $payslipDetails['regularHolidayRDOT'];
                                            $payslip_regularHolidayRDOTPay = number_format($payslipDetails['pay_regularHolidayRDOT'], 2);
                                            $payslip_regularHolidayRDOTND = $payslipDetails['regularHolidayRDOTND'];
                                            $payslip_regularHolidayRDOTNDPay = number_format($payslipDetails['pay_regularHolidayRDOTND'], 2);
                                            $payslip_regularHolidayRDOTOT = $payslipDetails['regularHolidayRDOTOT'];
                                            $payslip_regularHolidayRDOTOTPay = number_format($payslipDetails['pay_regularHolidayRDOTOT'], 2);
                                            $payslip_regularHolidayRDOTOTND = $payslipDetails['regularHolidayRDOTOTND'];
                                            $payslip_regularHolidayRDOTOTNDPay = number_format($payslipDetails['pay_regularHolidayRDOTOTND'], 2);
                                            
                                            $payslip_allowances = $payslipDetails['payslip_allowances'];
                                            $payslip_communication = $payslipDetails['payslip_communication'];
                                            $payslip_grossPay = $payslipDetails['grossPay'];
                                            $payslip_sss = $payslipDetails['payslip_sss'];
                                            $payslip_phic = $payslipDetails['payslip_phic'];
                                            $payslip_hdmf = $payslipDetails['payslip_hdmf'];
                                            $payslip_wtax = $payslipDetails['payslip_wtax'];
                                            $payslip_salaryLoan = $payslipDetails['payslip_salaryLoan'];
                                            $payslip_mpl = $payslipDetails['payslip_mpl'];
                                            $payslip_smart = $payslipDetails['payslip_smart'];
                                            $payslip_reimbursements = $payslipDetails['payslip_reimbursements'];
                                            $payslip_adjustments = $payslipDetails['payslip_adjustments'];
                                            $payslip_cashAdvanceDeduction = $payslipDetails['payslip_cashAdvanceDeduction'];
                                            $payslip_cashAdvanceBalance = $payslipDetails['payslip_cashAdvanceBalance'];
                                            $payslip_netPay = $payslipDetails['netPay'];

                                            if ($payslip_regNightDiff == 0) {
                                                $payslip_regNightDiff = "-";
                                                $payslip_regNightDiffPay = "-";
                                            }
                                            if ($payslip_regularOT == 0) {
                                                $payslip_regularOT = "-";
                                                $payslip_regularOTPay = "-";
                                            }
                                            if ($payslip_regularOTND == 0) {
                                                $payslip_regularOTND = "-";
                                                $payslip_regularOTNDPay = "-";
                                            }
                                            if ($payslip_regRDOT == 0) {
                                                $payslip_regRDOT = "-";
                                                $payslip_regRDOTPay = "-";
                                            }
                                            if ($payslip_regRDOTND == 0) {
                                                $payslip_regRDOTND = "-";
                                                $payslip_regRDOTNDPay = "-";
                                            }
                                            if ($payslip_regRDOTOT == 0) {
                                                $payslip_regRDOTOT = "-";
                                                $payslip_regRDOTOTPay = "-";
                                            }
                                            if ($payslip_regRDOTOTND == 0) {
                                                $payslip_regRDOTOTND = "-";
                                                $payslip_regRDOTOTNDPay = "-";
                                            }

                                            if ($payslip_specialHoliday == 0) {
                                                $payslip_specialHoliday = "-";
                                                $payslip_specialHolidayPay = "-";
                                            }
                                            if ($payslip_specialHolidayND == 0) {
                                                $payslip_specialHolidayND = "-";
                                                $payslip_specialHolidayNDPay = "-";
                                            }
                                            if ($payslip_specialHolidayOT == 0) {
                                                $payslip_specialHolidayOT = "-";
                                                $payslip_specialHolidayOTPay = "-";
                                            }
                                            if ($payslip_specialHolidayOTND == 0) {
                                                $payslip_specialHolidayOTND = "-";
                                                $payslip_specialHolidayOTNDPay = "-";
                                            }
                                            if ($payslip_specialHolidayRDOT == 0) {
                                                $payslip_specialHolidayRDOT = "-"; 
                                                $payslip_specialHolidayRDOTPay = "-";
                                            }
                                            if ($payslip_specialHolidayRDOTND == 0) {
                                                $payslip_specialHolidayRDOTND = "-";
                                                $payslip_specialHolidayRDOTNDPay = "-";
                                            }
                                            if ($payslip_specialHolidayRDOTOT == 0) {
                                                $payslip_specialHolidayRDOTOT = "-";
                                                $payslip_specialHolidayRDOTOTPay = "-";
                                            }
                                            if ($payslip_specialHolidayRDOTOTND == 0) {
                                                $payslip_specialHolidayRDOTOTND = "-";
                                                $payslip_specialHolidayRDOTOTNDPay = "-";
                                            }

                                            if ($payslip_regularHoliday == 0) {
                                                $payslip_regularHoliday = "-";
                                                $payslip_regularHolidayPay = "-";
                                            }
                                            if ($payslip_regularHolidayND == 0) {
                                                $payslip_regularHolidayND = "-";
                                                $payslip_regularHolidayNDPay = "-";
                                            }
                                            if ($payslip_regularHolidayOT == 0) {
                                                $payslip_regularHolidayOT = "-";
                                                $payslip_regularHolidayOTPay = "-";
                                            }
                                            if ($payslip_regularHolidayOTND == 0) {
                                                $payslip_regularHolidayOTND = "-";
                                                $payslip_regularHolidayOTNDPay = "-";
                                            }
                                            if ($payslip_regularHolidayRDOT == 0) {
                                                $payslip_regularHolidayRDOT = "-";
                                                $payslip_regularHolidayRDOTPay = "-";
                                            }
                                            if ($payslip_regularHolidayRDOTND == 0) {
                                                $payslip_regularHolidayRDOTND = "-";    
                                                $payslip_regularHolidayRDOTNDPay = "-";
                                            }
                                            if ($payslip_regularHolidayRDOTOT == 0) {
                                                $payslip_regularHolidayRDOTOT = "-";
                                                $payslip_regularHolidayRDOTOTPay = "-";
                                            }
                                            if ($payslip_regularHolidayRDOTOTND == 0) {
                                                $payslip_regularHolidayRDOTOTND = "-";    
                                                $payslip_regularHolidayRDOTOTNDPay = "-";
                                            }

                                            // ALLOWANCES 
                                            if ($payslip_allowances != 0) {
                                                $payslip_allowances = number_format($payslip_allowances, 2);
                                            }
                                            else {
                                                $payslip_allowances = "-";
                                            }
                                            if ($payslip_communication != 0) {
                                                $payslip_communication = number_format($payslip_communication, 2);
                                            }
                                            else {
                                                $payslip_communication = "-";
                                            }

                                            // DEDUCTIONS
                                            if ($payslip_sss != 0) {
                                                $payslip_sss = number_format($payslip_sss, 2);
                                            }
                                            else {
                                                $payslip_sss = "-";
                                            }
                                            if ($payslip_phic != 0) {
                                                $payslip_phic = number_format($payslip_phic, 2);
                                            }
                                            else {
                                                $payslip_phic = "-";
                                            }
                                            if ($payslip_hdmf != 0) {
                                                $payslip_hdmf = number_format($payslip_hdmf, 2);
                                            }
                                            else {
                                                $payslip_hdmf = "-";
                                            }
                                            if ($payslip_wtax != 0) {
                                                $payslip_wtax = number_format($payslip_wtax, 2);
                                            }
                                            else {
                                                $payslip_wtax = "-";
                                            }
                                            if ($payslip_salaryLoan != 0) {
                                                $payslip_salaryLoan = number_format($payslip_salaryLoan, 2);
                                            }
                                            else {
                                                $payslip_salaryLoan = "-";
                                            }
                                            if ($payslip_mpl != 0) {
                                                $payslip_mpl = number_format($payslip_mpl, 2);
                                            }
                                            else {
                                                $payslip_mpl = "-";
                                            }
                                            if ($payslip_smart != 0) {
                                                $payslip_smart = number_format($payslip_smart, 2);
                                            }
                                            else {
                                                $payslip_smart = "-";
                                            }

                                            // REIMBURSEMENTS & ADJUSTMENTS +,-
                                            if ($payslip_reimbursements != 0) {
                                                $payslip_reimbursements = number_format($payslip_reimbursements, 2);
                                            }
                                            else {
                                                $payslip_reimbursements = "-";
                                            }
                                            if ($payslip_adjustments != 0) {
                                                $payslip_adjustments = number_format($payslip_adjustments, 2);
                                            }
                                            else {
                                                $payslip_adjustments = "-";
                                            }

                                            // CASH ADVANCE DEDUCTIONS & BALANCE
                                            if ($payslip_cashAdvanceDeduction != 0) {
                                                $payslip_cashAdvanceDeduction = number_format($payslip_cashAdvanceDeduction, 2);
                                            }
                                            else {
                                                $payslip_cashAdvanceDeduction = "-";
                                            }
                                            if ($payslip_cashAdvanceBalance != 0) {
                                                $payslip_cashAdvanceBalance = number_format($payslip_cashAdvanceBalance, 2);
                                            }
                                            else {
                                                $payslip_cashAdvanceBalance = "-";
                                            }

                                            // GROSS, TOTAL GROSS, AND NET PAYS
                                            if ($payslip_basePay != 0) {
                                                $payslip_basePay = number_format($payslip_basePay, 2);
                                            }
                                            if ($payslip_grossPay != 0) {
                                                $payslip_grossPay = number_format($payslip_grossPay, 2);
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
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_basePay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regNightDiff . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regNightDiffPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regularOT . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regularOTPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regularOTND . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regularOTNDPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regRDOT . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regRDOTPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regRDOTND . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regRDOTNDPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regRDOTOT . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regRDOTOTPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regRDOTOTND . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regRDOTOTNDPay . "</td>";
                                            
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_specialHoliday . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_specialHolidayPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_specialHolidayND . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_specialHolidayNDPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_specialHolidayOT . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_specialHolidayOTPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_specialHolidayOTND . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_specialHolidayOTNDPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_specialHolidayRDOT . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_specialHolidayRDOTPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_specialHolidayRDOTND . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_specialHolidayRDOTNDPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_specialHolidayRDOTOT . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_specialHolidayRDOTOTPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_specialHolidayRDOTOTND . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_specialHolidayRDOTOTNDPay . "</td>";

                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regularHoliday . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regularHolidayPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regularHolidayND . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regularHolidayNDPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regularHolidayOT . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regularHolidayOTPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regularHolidayOTND . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regularHolidayOTNDPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regularHolidayRDOT . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regularHolidayRDOTPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regularHolidayRDOTND . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regularHolidayRDOTNDPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regularHolidayRDOTOT . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regularHolidayRDOTOTPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regularHolidayRDOTOTND . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_regularHolidayRDOTOTNDPay . "</td>";

                                            echo "<td class ='whitespace-nowrap'>" . $payslip_allowances . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_communication . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_grossPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_wtax . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_sss . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_phic . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_hdmf . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_cashAdvanceDeduction . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_salaryLoan . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_mpl . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_smart . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_reimbursements . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_adjustments . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_netPay . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . $payslip_cashAdvanceBalance . "</td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- CARD FOOTER DATA ENTRY BUTTON -->
                    <div class="card-footer d-grid d-md-flex justify-content-md-end">
                        <button class="btn btn-primary me-md-2 recalculatePayroll" type="button" data-id="<?php echo $payrollID; ?>" data-cycle="<?php echo $payrollCycleID; ?>">Re-Calculate Payroll</button>
                        <!-- <button class="btn btn-warning me-md-2 exportPayroll" type="button" data-id="<?php echo $payrollID; ?>" data-cycle="<?php echo $payrollCycleID; ?>">Export CSV File</button> -->
                    </div>
                </div>
            </div>
        </main>
    
        <script src="../assets/js/admin_payroll.js?v=<?php echo $version; ?>"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>