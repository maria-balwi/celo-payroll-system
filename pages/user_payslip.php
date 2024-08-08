<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- HEADER -->
        <?php include('../includes/header.php'); ?>
    </head>
    <body>
        <!-- SIDEBAR -->
        <?php include('../includes/sidebar.php'); ?>	

        <style>
            .center {
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 50%;
            }
        </style>
 
        <!-- MAIN CONTENT -->
        <main class="flex-1 p-3">
            <div class="flex-1 p-2 text-2xl font-bold">
                Payslip

                <!-- YEAR DROPDOWN MENU -->
                <div class="static inline-block text-right">
                    <select id="filter_year" class="form-select inline-flex justify-center rounded-md border text-left border-gray-300 shadow-sm px-4 bg-white text-sm font-medium text-gray-700">
                        <option disabled selected class="text-left">Year</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="2024">2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="2023">2023</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="2022">2022</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="2021">2021</option>
                    </select>
                </div>

                <!-- PAYSLIP CYCLYE RANGE FROM DROPDOWN MENU -->
                <div class="static inline-block text-right">
                    <select id="filter_cycleFrom" class="form-select inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-3 bg-white text-sm font-medium text-gray-700">
                        <!-- <option disabled selected>Select Payroll Cycle FROM</option> -->
                        <option disabled selected>Select Payroll Cycle</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="1">1 - Dec 26, 2024 to Jan 10, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="2">2 - Jan 11, 2024 to Jan 25, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="3">3 - Jan 26, 2024 to Feb 10, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="4">4 - Feb 11, 2024 to Feb 25, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="5">5 - Feb 26, 2024 to Mar 10, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="6">6 - Mar 11, 2024 to Mar 25, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="7">7 - Mar 26, 2024 to Apr 10, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="8">8 - Apr 11, 2024 to Apr 25, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="9">9 - Apr 26, 2024 to May 10, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="10">10 - May 11, 2024 to May 25, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="11">11 - May 26, 2024 to Jun 10, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="12">12 - Jun 11, 2024 to Jun 25, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="13">13 - Jun 26, 2024 to Jul 10, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="14">14 - Jul 11, 2024 to Jul 25, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="15">15 - Jul 26, 2024 to Aug 10, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="16">16 - Aug 11, 2024 to Aug 25, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="17">17 - Aug 26, 2024 to Sep 10, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="18">18 - Sep 11, 2024 to Sep 25, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="19">19 - Sep 26, 2024 to Oct 10, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="20">20 - Oct 11, 2024 to Oct 25, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="21">21 - Oct 26, 2024 to Nov 10, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="22">22 - Nov 11, 2024 to Nov 25, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="23">23 - Nov 26, 2024 to Dec 10, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="24">24 - Dec 11, 2024 to Dec 25, 2024</option>
                    </select>
                </div>

                <!-- PAYSLIP CYCLYE RANGE UNTIL DROPDOWN MENU -->
                <!-- <div class="static inline-block text-right">
                    <select id="filter_cycleUntil" class="form-select inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-3 bg-white text-sm font-medium text-gray-700">
                        <option disabled selected>Select Payroll Cycle UNTIL</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="1">1 - Dec 26, 2024 to Jan 10, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="2">2 - Jan 11, 2024 to Jan 25, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="3">3 - Jan 26, 2024 to Feb 10, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="4">4 - Feb 11, 2024 to Feb 25, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="5">5 - Feb 26, 2024 to Mar 10, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="6">6 - Mar 11, 2024 to Mar 25, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="7">7 - Mar 26, 2024 to Apr 10, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="8">8 - Apr 11, 2024 to Apr 25, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="9">9 - Apr 26, 2024 to May 10, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="10">10 - May 11, 2024 to May 25, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="11">11 - May 26, 2024 to Jun 10, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="12">12 - Jun 11, 2024 to Jun 25, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="13">13 - Jun 26, 2024 to Jul 10, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="14">14 - Jul 11, 2024 to Jul 25, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="15">15 - Jul 26, 2024 to Aug 10, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="16">16 - Aug 11, 2024 to Aug 25, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="17">17 - Aug 26, 2024 to Sep 10, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="18">18 - Sep 11, 2024 to Sep 25, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="19">19 - Sep 26, 2024 to Oct 10, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="20">20 - Oct 11, 2024 to Oct 25, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="21">21 - Oct 26, 2024 to Nov 10, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="22">22 - Nov 11, 2024 to Nov 25, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="23">23 - Nov 26, 2024 to Dec 10, 2024</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="24">24 - Dec 11, 2024 to Dec 25, 2024</option>
                    </select>
                </div> -->

                 <!-- GENERATE PAYSLIP CHANGE BUTTON -->
                 <div class="static inline-block text-right">
                    <button class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none" id="btnGeneratePayslip">
                    Generate Payslip
                    </button>
                </div>

                <!-- PRINT PAYSLIP CHANGE BUTTON -->
                <div class="static inline-block text-right">
                    <button class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none" id="bntPrintPayslip">
                    Print Payslip
                    </button>
                </div>
            </div>
            
            <!-- CONTENT -->
            <div class="p-4 m-1 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                
                <!-- DATA TABLE -->
                <!-- <div class="container mx-auto overflow-auto">
                    <table id="payslipTable" class="table table-striped table-bordered min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Filed</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Leave Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sub Leave Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Days</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Inclusive Dates</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Purpose | Remarks</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Attachments</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paid</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 whitespace-nowrap">RC 1-1</td>
                                <td class="px-6 whitespace-nowrap">RC 1-2</td>
                                <td class="px-6 whitespace-nowrap">RC 1-3</td>
                                <td class="px-6 whitespace-nowrap">RC 1-4</td>
                                <td class="px-6 whitespace-nowrap">RC 1-5</td>
                                <td class="px-6 whitespace-nowrap">RC 1-6</td>
                                <td class="px-6 whitespace-nowrap">RC 1-7</td>
                                <td class="px-6 whitespace-nowrap">RC 1-8</td>
                                <td class="px-6 whitespace-nowrap">RC 1-9</td>
                                <td class="px-6 whitespace-nowrap">RC 1-10</td>
                            </tr>

                            <tr>
                                <td class="px-6 whitespace-nowrap">RC 2-1</td>
                                <td class="px-6 whitespace-nowrap">RC 2-2</td>
                                <td class="px-6 whitespace-nowrap">RC 2-3</td>
                                <td class="px-6 whitespace-nowrap">RC 2-4</td>
                                <td class="px-6 whitespace-nowrap">RC 2-5</td>
                                <td class="px-6 whitespace-nowrap">RC 2-6</td>
                                <td class="px-6 whitespace-nowrap">RC 2-7</td>
                                <td class="px-6 whitespace-nowrap">RC 2-8</td>
                                <td class="px-6 whitespace-nowrap">RC 2-9</td>
                                <td class="px-6 whitespace-nowrap">RC 2-10</td>
                            </tr>

                            <tr>
                                <td class="px-6 whitespace-nowrap">RC 3-1</td>
                                <td class="px-6 whitespace-nowrap">RC 3-2</td>
                                <td class="px-6 whitespace-nowrap">RC 3-3</td>
                                <td class="px-6 whitespace-nowrap">RC 3-4</td>
                                <td class="px-6 whitespace-nowrap">RC 3-5</td>
                                <td class="px-6 whitespace-nowrap">RC 3-6</td>
                                <td class="px-6 whitespace-nowrap">RC 3-7</td>
                                <td class="px-6 whitespace-nowrap">RC 3-8</td>
                                <td class="px-6 whitespace-nowrap">RC 3-9</td>
                                <td class="px-6 whitespace-nowrap">RC 3-10</td>
                            </tr>
                        </tbody>
                    </table>
                </div> -->

                <div class="container mx-auto overflow-auto">
                    <div class="loader" id="loader"></div>
                    <!-- <div id="payslipContainer" class="col-span-12 md:col-span-4 table text-center border border-gray-300 table-auto">
                        <div class="row mb-2">
                            <div class="col-12">
                                <p>CYCLE</p>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-12">
                                <p>CELO BUSINESS SOLUTIONS, INC.</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <p>65 PANAY AVENUE BARANGAY PALIGSAHAN QUEZON CITY</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <p>PAYSLIP</p>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-1">
                                <p>NO.</p>
                            </div>
                            <div class="col-2">
                                <p>NAME</p>
                            </div>
                            <div class="col-3">
                                <p>PAYROLL PERIOD</p>
                            </div>
                            <div class="col-3">
                                <p>EMPLOYMENT STAGE</p>
                            </div>
                            <div class="col-3">
                                <p>PAYMENT TYPE</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-1">
                                <p>000-396</p>
                            </div>
                            <div class="col-2">
                                <p>REYES, MARIA PATRICE A.</p>
                            </div>
                            <div class="col-3">
                                <p>JUL 11, 2024 - JUL 25, 2024</p>
                            </div>
                            <div class="col-3">
                                <p>PROBATIONARY</p>
                            </div>
                            <div class="col-3">
                                <p>DAILY RATED</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>BASIC PAY</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>DAILY RATE</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>HOURLY RATE</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>NO. OF DAYS</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>TOTAL HOURS</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>REGULAR HOURS</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>PAY</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>REG NIGHT DIFF</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>PAY</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>REGULAR OT</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>PAY</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>REG OT NIGHT DIFF</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>PAY</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>REST DAY OT</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>PAY</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>RDOT NIGHT DIFF</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>PAY</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>SPECIAL HOLIDAY</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>PAY</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>S.H.DAY NIGHT DIFF</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>PAY</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>HOLIDAY</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>PAY</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>HOLIDAY NIGHT DIFF</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>PAY</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>GROSS PAY</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>ALLOWANCE</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>COMMUNICATION ALLOWANCE</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>TOTAL GROSS PAY</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <p>DEDUCTIONS</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>WTAX</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>SSS</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>PHIC</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>HDMF</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>ADVANCES</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>SALARY LOAN</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>PAGIBIG MPL</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>SMART</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>ADJUSTMENT +,-</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p>NET PAY</p>
                            </div>
                            <div class="col-4">
                                <p>NET PAY</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p>CASH ADVANCE</p>
                            </div>
                            <div class="col-4">
                                <p>TOTAL C.A.</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <p></p>
                            </div>
                            <div class="col-4">
                                <p>BALANCE C.A.</p>
                            </div>
                            <div class="col-4">
                                <p>0.00</p>
                            </div>
                        </div>
                    </div> -->

                    <div id="payslipContainer" class="col-span-12 md:col-span-4 table text-center table-auto">
                        <!-- <table class="table table-striped table-bordered text-center table-responsive">
                            <thead>
                                <! -- <tr><th colspan="4">Jul 11, 2024 - Jul 25, 2025</th></tr> - ->
                                <tr><th colspan="4">CELO BUSINES SOLUTIONS, INC.</th></tr>
                                <tr><th colspan="4">65 PANAY AVENUE BARANGAY PALIGSAHAN QUEZON CITY</th></tr>
                                <tr><th colspan="4">PAYSLIP</th></tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>No.</td>
                                    <td>Name</td>
                                    <td>Payroll Period</td>
                                    <td>Payment Type</td>
                                </tr>
                                <tr>
                                    <td>000-396</td>
                                    <td>Reyes, Maria Patrice A.</td>
                                    <td>Jul 11, 2024 - Jul 25, 2025</td>
                                    <td>Daily Rated</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>Basic Pay</td>
                                    <td>18,000.00</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>Daily Rate</td>
                                    <td>827.59</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>Hourly Rate</td>
                                    <td>103.45</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>No. of Days</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>Total Hours</td>
                                    <td>106.00</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>Regular Hours</td>
                                    <td>64.00</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>PAY</td>
                                    <td>6,620.69</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>Regular Night Diff (15%)</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>PAY</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>Regular OT (25%)</td>
                                    <td>2.00</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>PAY</td>
                                    <td>258.63</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>RegOT Night Diff</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>PAY</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>Rest Day OT</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>PAY</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>RDOT Night Diff</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>PAY</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>Special Holiday</td>
                                    <td>8.00</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>PAY</td>
                                    <td>1,075.86</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>S.H.day Night Diff</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>PAY</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>Holiday</td>
                                    <td>32.00</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>PAY</td>
                                    <td>6,620.69</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>Holiday Night Diff</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>PAY</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td colspan="4">DEDUCTIONS</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>WTAX</td>
                                    <td>514.33</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>SSS</td>
                                    <td>405.00</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>PHIC</td>
                                    <td>225.00</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>HDMF</td>
                                    <td>100.00</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>Advances</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>Salary Loan</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>Pagibig MPL</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>Smart</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>Adjustment +,-</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="2">Net Pay</td>
                                    <td>NET PAY</td>
                                    <td>13,831.53</td>
                                </tr>
                                <tr>
                                    <td colspan="2">CASH ADVANCE</td>
                                    <td>Total C.A.</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>Balance C.A.</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table> -->
                    </div>
                </div>
            </div>
        </main>
    
        <script src="../assets/js/user_payslip.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>