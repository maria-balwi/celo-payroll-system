<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- HEADER -->
        <?php include('../includes/header.php'); ?>

        <style>
            #breakdownTable th {
                border: 1px solid black;
            }
            #breakdownTable td {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <!-- SIDEBAR -->
        <?php include('../includes/sidebar.php'); ?>	
 
        <!-- MAIN CONTENT -->
        <main class="flex-1 p-3">
            <div class="flex flex-1 p-2 text-2xl font-bold justify-between items-center">
                <div>
                    Cash Advances
                </div>  

                <!-- FILE CASH ADVANCE BUTTON -->
                <!-- <div class="static inline-block text-right">
                    <button class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none" data-bs-toggle="modal" data-bs-target="#fileCashAdvanceModal">
                    File Cash Advance
                    </button>
                </div> -->
            </div>
            
            <!-- CONTENT -->
            <div class="p-4 m-1 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                
                <!-- DATATABLE -->
                <div class="mx-auto overflow-auto">
                    <table id="cashAdvanceTable" class="table table-bordered table-striped min-w-full divide-y divide-gray-200 text-center pt-3">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Date Filed</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Employee Name</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Cash Advance Status</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Request Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php
                                function modifyDate($date) {
                                    // Create a DateTime object from the string
                                    $dateTime = new DateTime($date);
                                
                                    // Format the date
                                    return $dateTime->format('M d, Y');
                                }
                                
                                $cashAdvanceQuery = mysqli_query($conn, $employees->viewCashAdvanceApplications($_SESSION['id']));
                                while ($cashAdvanceDetails = mysqli_fetch_array($cashAdvanceQuery)) {

                                    $cashAdvance_requestID = $cashAdvanceDetails['requestID'];
                                    $cashAdvance_dateFiled = $cashAdvanceDetails['dateFiled'];
                                    $cashAdvance_employeeName = $cashAdvanceDetails['firstName'] . " " . $cashAdvanceDetails['lastName'];
                                    $cashAdvance_amount = $cashAdvanceDetails['amount'];
                                    $cashAdvance_monthsToPay = $cashAdvanceDetails['monthsToPay'];
                                    $cashAdvance_computedAmtMonthly = $cashAdvanceDetails['monthlyAmmortization'];
                                    $cashAdvance_cutoffStart = $cashAdvanceDetails['cutoffStart'];
                                    $cashAdvance_caStatus = $cashAdvanceDetails['ca_status'];
                                    $cashAdvance_requestStatus = $cashAdvanceDetails['request_status'];

                                    $cashAdvance_dateFiled = modifyDate($cashAdvance_dateFiled);    
                                    $cashAdvance_cutoffStart = modifyDate($cashAdvance_cutoffStart);    
                                    
                                    echo "<tr data-id='" . $cashAdvance_requestID . "' data-designation='" . $_SESSION['designationID'] . "' class='cashAdvanceView cursor-pointer'>";
                                    echo "<td class = ' whitespace-nowrap'>" . $cashAdvance_dateFiled . "</td>";
                                    echo "<td class = ' whitespace-nowrap'>" . $cashAdvance_employeeName . "</td>";
                                    echo "<td class = ' whitespace-nowrap'> ₱ " . number_format($cashAdvance_amount, 2) . "</td>";
                                    echo "<td class = ' whitespace-nowrap'>" . $cashAdvance_caStatus . "</td>";
                                    // if ($cashAdvance_caStatus == "New") {
                                    //     echo "<td><p class='inline-block text-yellow-500 px-3 py-1 my-auto text-md'>New</p></td>";
                                    // }
                                    // else if ($cashAdvance_caStatus == "Ongoing") {
                                    //     echo "<td><p class='inline-block text-blue-500 px-3 py-1 my-auto text-md'>Ongoing</p></td>";
                                    // }
                                    // else {
                                    //     echo "<td><p class='inline-block text-green-500 px-3 py-1 my-auto text-md'>Completed</p></td>";
                                    // }
                                    if ($cashAdvance_requestStatus == "Pending") {
                                        echo "<td><p class='inline-block bg-yellow-500 text-white px-3 py-1 my-auto rounded-full text-sm'>Pending</p></td>";
                                    }
                                    else if ($cashAdvance_requestStatus == "Approved") {
                                        echo "<td><p class='inline-block bg-green-500 text-white px-3 py-1 my-auto rounded-full text-sm'>Approved</p></td>";
                                    }
                                    else if ($cashAdvance_requestStatus == "Disapproved") {
                                        echo "<td><p class='inline-block bg-red-500 text-white px-3 py-1 my-auto rounded-full text-sm'>Disapproved</p></td>";
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ======================================================================================================================================= -->
            <!-- ================================================================= MODAL =============================================================== -->
            <!-- ======================================================================================================================================= -->

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!------------------------------------------------------------------- FILE CASH ADVANCE FORM -------------------------------------------------->
            <form id="fileCashAdvanceForm" enctype="multipart/form-data">
                <div class="modal fade" id="fileCashAdvanceModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                    <div class="modal-dialog modal-none modal-xl modal-dialog-centered">
                        <div class="modal-content" id="fileCashAdvanceModal">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="userFormLabel">File Cash Advance</h1>
                            </div>
                            <div class="modal-body">
                                <div class="row g-2 mb-2">
                                    <div class="col-3">
                                        <label for="dateFiled">Date Filed:</label>
                                        <input type="text" class="form-control" id="dateFiled" value="<?php echo date("F d, Y") ?>" disabled readonly>
                                    </div>
                                    <div class="col-3">
                                        <label for="employeeID">Employee ID:</label>
                                        <input type="text" class="form-control" id="employeeID" name="employeeID" placeholder="XXX-XXX">
                                    </div>
                                    <div class="col-3">
                                        <label for="employeeLastName">Employee Last Name:</label>
                                        <input type="text" class="form-control" id="employeeLastName" name="employeeLastName" disabled readonly>
                                    </div>
                                    <div class="col-3">
                                        <label for="employeeFirstName">Employee First Name:</label>
                                        <input type="text" class="form-control" id="employeeFirstName" name="employeeFirstName" disabled readonly>
                                    </div>
                                    <input type="hidden" id="id" name="id">
                                </div>

                                <div class="row g-2 mb-2">
                                    <div class="col-3">
                                        <label for="amount">Loan Amount:</label>
                                        <input type="number" class="form-control" id="amount" name="amount" placeholder="1.0" step="0.01">
                                    </div>
                                    <div class="col-3">
                                        <label for="totalAmountToBePaid">Total Amount to be Paid:</label>
                                        <input type="number" class="form-control" id="totalAmountToBePaid" name="totalAmountToBePaid" placeholder="1.0" step="0.01" readonly>
                                    </div>
                                    <div class="col-3">
                                        <label for="remainingAmount">Remaining Amount to be Paid:</label>
                                        <input type="number" class="form-control" id="remainingAmount" name="remainingAmount" placeholder="1.0" step="0.01" readonly>
                                    </div>
                                    <div class="col-3">
                                        <label for="monthlyAmmortization">Monthly Amortization:</label>
                                        <input type="number" class="form-control" id="monthlyAmmortization" name="monthlyAmmortization" placeholder="1.0" step="0.01" readonly>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <div class="col-3">
                                        <label for="monthsToPay">Term:</label>
                                        <select id="monthsToPay" name="monthsToPay" class="form-select">
                                            <option value="" selected disabled>Choose</option>
                                            <option value="1">1 Month</option>
                                            <option value="2">2 Months</option>
                                            <option value="3">3 Months</option>
                                            <option value="4">4 Months</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label for="cutoffStart">Start Date:</label>
                                        <input type="date" class="form-control" id="cutoffStart" name="cutoffStart">
                                        <!-- <select class="form-select" id="payrollCycleID" name="payrollCycleID">
                                            <option value="" selected disabled>Choose</option>
                                            < ?php
                                                function formatDate($date) {
                                                    // Get the current year
                                                    $currentYear = date('Y');
                                                    
                                                    // Append the current year to the input date
                                                    $dateWithYear = $date . '-' . $currentYear;
                                                    
                                                    // Create a DateTime object from the string (expects format MM-DD-YYYY)
                                                    $dateTime = DateTime::createFromFormat('m-d-Y', $dateWithYear);
                                                    
                                                    // Format the date as 'M d, Y'
                                                    return $dateTime->format('M d, Y');
                                                }

                                                function formatStartDate($date, $cycleID) {
                                                    // Get the current year
                                                    $currentYear = date('Y');

                                                    if ($cycleID == "1") {
                                                        $currentYear = date('Y') - 1;
                                                    }
                                                    
                                                    // Append the current year to the input date
                                                    $dateWithYear = $date . '-' . $currentYear;
                                                    
                                                    // Create a DateTime object from the string (expects format MM-DD-YYYY)
                                                    $dateTime = DateTime::createFromFormat('m-d-Y', $dateWithYear);
                                                    
                                                    // Format the date as 'M d, Y'
                                                    return $dateTime->format('M d, Y');
                                                }
                                                
                                                $payrollCycleQuery = mysqli_query($conn, $payroll->viewAvailablePayrollCycle());
                                                while ($payrollCycleDetails = mysqli_fetch_array($payrollCycleQuery)) {
                                                    $payrollCycleID = $payrollCycleDetails['payrollCycleID'];
                                                    $payrollCycleFrom_date = $payrollCycleDetails['payrollCycleFrom'];
                                                    $payrollCycleTo_date = $payrollCycleDetails['payrollCycleTo'];

                                                    $payrollCycleFrom = formatStartDate($payrollCycleFrom_date, $payrollCycleID);
                                                    $payrollCycleTo = formatDate($payrollCycleTo_date);
                                                ?>
                                                <option value="< ?php echo $payrollCycleID; ?>">
                                                    < ?php echo $payrollCycleFrom . ' to ' . $payrollCycleTo; ?>
                                                </option>
                                            < ?php        
                                                }
                                            ?>
                                        </select> -->
                                    </div>
                                    <div class="col-3">
                                        <label for="ca_status">Cash Advance Status:</label>
                                        <input type="text" class="form-control" id="ca_status" name="ca_status" value="New" disabled readonly>
                                    </div>
                                    <div class="col-3">
                                        <label for="request_status">Application Status:</label>
                                        <input type="text" class="form-control" id="request_status" name="request_status" value="Pending" disabled readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Add</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!----------------------------------------------------------- VIEW CASH ADVANCE PAYMENT HISTORY ----------------------------------------------->
            <div class="modal fade" id="viewCashAdvanceModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                <div class="modal-dialog modal-none modal-xl modal-dialog-centered modal-scrollable">
                    <div class="modal-content" id="viewCashAdvanceModal">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="userFormLabel">View Employee Cash Advance</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row g-2 mb-2">
                                <div class="col-3">
                                    <label for="viewFiledDate">Date Filed:</label>
                                    <input type="text" class="form-control" id="viewFiledDate" disabled readonly>
                                </div>
                                <div class="col-3">
                                    <label for="viewEmployeeID">Employee ID:</label>
                                    <input type="text" class="form-control" id="viewEmployeeID" disabled readonly>
                                </div>
                                <div class="col-3">
                                    <label for="viewEmployeeName">Employee Name:</label>
                                    <input type="text" class="form-control" id="viewEmployeeName" disabled readonly>
                                </div>
                                <div class="col-3" id="endorsedByRow">
                                    <label for="viewEmployeeName">Endorsed by:</label>
                                    <input type="text" class="form-control" id="viewRequestorName" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
                                <div class="col-3">
                                    <label for="viewLoanAmount">Loan Amount:</label>
                                    <input type="text" class="form-control" id="viewLoanAmount" disabled readonly>
                                </div>
                                <div class="col-3">
                                    <label for="viewTotalAmount">Total Amount to be Paid:</label>
                                    <input type="text" class="form-control" id="viewTotalAmount" disabled readonly>
                                </div>
                                <div class="col-3">
                                    <label for="viewRemainingAmount">Remaining Amount to be Paid:</label>
                                    <input type="text" class="form-control" id="viewRemainingAmount" disabled readonly>
                                </div>
                                <div class="col-3">
                                    <label for="viewMonthlyAmmortization">Monthly Amortization:</label>
                                    <input type="text" class="form-control" id="viewMonthlyAmmortization" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
                                <div class="col-3">
                                    <label for="viewMonthsToPay">Term:</label>
                                    <input type="text" class="form-control" id="viewMonthsToPay" disabled readonly>
                                </div>
                                <div class="col-3">
                                    <label for="viewCutoffStart">Start Date:</label>
                                    <input type="text" class="form-control" id="viewCutoffStart" disabled readonly>
                                </div>
                                <div class="col-3">
                                    <label for="viewCAStatus">Cash Advance Status:</label>
                                    <input type="text" class="form-control" id="viewCAStatus" disabled readonly>
                                </div>
                                <div class="col-3">
                                    <label for="viewRequestStatus">Application Status:</label>
                                    <input type="text" class="form-control" id="viewRequestStatus" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-2 my-2" id="breakdownDiv">
                                <h1 class="modal-subtitle fs-5" id="userFormLabel">CA Breakdown</h1>
                                <div class="container mx-auto overflow-auto">
                                    <table id="breakdownTable" class="table table-auto table-bordered text-center my-1 pt-3">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="text-xs font-medium text-yellow-500 uppercase tracking-tight">Payroll Cut Off</th>
                                                <th class="text-xs font-medium text-yellow-500 uppercase tracking-tight">Principal Balance</th>
                                                <th class="text-xs font-medium text-gray-500 uppercase tracking-tight">Monthly Amortization</th>
                                                <th class="text-xs font-medium text-gray-500 uppercase tracking-tight">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200" id="breakdownSection">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-primary employeeUpdate" id="btnUpdateEmployee">Update</button>
                            <button type="button" class="btn btn-danger employeeResign" id="btnResignEmployee">Resign</button> -->
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnClose">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    
        <script src="../assets/js/user_cashAdvance.js?v=<?php echo $version; ?>"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>