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
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle whitespace-nowrap">Date From</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle whitespace-nowrap">Date To</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle whitespace-nowrap">Status</th>
                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle whitespace-nowrap">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php
                                        function modifyDate($date) {
                                            // Get the current year
                                            $currentYear = date('Y');
                                            
                                            // Append the current year to the input date
                                            $dateWithYear = $date . '-' . $currentYear;
                                            
                                            // Create a DateTime object from the string (expects format MM-DD-YYYY)
                                            $dateTime = DateTime::createFromFormat('m-d-Y', $dateWithYear);
                                            
                                            // Format the date as 'M d, Y'
                                            return $dateTime->format('F d, Y');
                                        }

                                        $payrollQuery = mysqli_query($conn, $payroll->viewAllPayroll());
                                        while ($payrollDetails = mysqli_fetch_array($payrollQuery)) {
                                            $payrollID = $payrollDetails['payrollID'];
                                            $payrollCycleID = $payrollDetails['payrollCycleID'];
                                            $payrollDateFrom = $payrollDetails['payrollCycleFrom'];
                                            $payrollDateTo = $payrollDetails['payrollCycleTo'];
                                            $payrollStatus = $payrollDetails['status'];

                                            echo "<tr>";
                                            echo "<td class ='whitespace-nowrap'>" . modifyDate($payrollDateFrom) . "</td>";
                                            echo "<td class ='whitespace-nowrap'>" . modifyDate($payrollDateTo) . "</td>";
                                            if ($payrollStatus == "New") {
                                                echo "<td><p class='inline-block bg-blue-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $payrollStatus . "</p></td>";
                                            }
                                            else {
                                                echo "<td><p class='inline-block bg-green-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $payrollStatus . "</p></td>";
                                            }
                                            echo "<td class ='whitespace-nowrap'>";
                                            if ($payrollStatus == "New") {
                                                echo "
                                                    <button class='btn btn-sm btn-outline-primary calculatePayroll' data-id='" . $payrollID . "' data-cycleID='" . $payrollCycleID . "'>Calculate</button>";
                                            }
                                            else {
                                                echo "
                                                    <button class='btn btn-sm btn-outline-primary hover:text-white-500 viewPayroll' data-id='" . $payrollID . "'>
                                                        <svg class='h-5 w-5 text-blue-500'  fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                                                            <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15 12a3 3 0 11-6 0 3 3 0 016 0z'/>
                                                            <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z'/>
                                                        </svg>
                                                    </button>
                                                ";
                                            }
                                            echo "
                                                    <button class='btn btn-sm btn-outline-danger hover:text-white-500 deletePayroll' data-id='" . $payrollID . "'>
                                                        <svg class='h-5 w-5 text-red-500'  fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                                                            <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16'/>
                                                        </svg>
                                                    </button>
                                                ";
                                            echo "</td>";
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

            <!-- ======================================================================================================================================= -->
            <!-- ================================================================= MODAL =============================================================== -->
            <!-- ======================================================================================================================================= -->

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!------------------------------------------------------------- CREATE PAYROLL FORM ----------------------------------------------------------->
            <form id="addPayrollForm" enctype="multipart/form-data">
                <div class="modal fade" id="addPayrollModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                    <div class="modal-dialog modal-none modal-sm modal-dialog-centered">
                        <div class="modal-content" id="addPayrollModal">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="userFormLabel">Create Payroll</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-2 mb-1">
                                    <div class="col-12">
                                        <label for="payrollCycle">Payroll Cycle:</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <div class="col-12">
                                        <select class="form-select" id="payrollCycleID" name="payrollCycleID">
                                            <option value="" selected disabled>Choose</option>
                                            <?php
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
                                                
                                                $payrollCycleQuery = mysqli_query($conn, $payroll->viewAllPayrollCycle2());
                                                while ($payrollCycleDetails = mysqli_fetch_array($payrollCycleQuery)) {
                                                    $payrollCycleID = $payrollCycleDetails['payrollCycleID'];
                                                    $payrollCycleFrom_date = $payrollCycleDetails['payrollCycleFrom'];
                                                    $payrollCycleTo_date = $payrollCycleDetails['payrollCycleTo'];

                                                    $payrollCycleFrom = formatDate($payrollCycleFrom_date);
                                                    $payrollCycleTo = formatDate($payrollCycleTo_date);
                                                ?>
                                                <option value="<?php echo $payrollCycleID; ?>">
                                                    <?php echo $payrollCycleFrom . ' to ' . $payrollCycleTo; ?>
                                                </option>
                                            <?php        
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>     
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Create</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            
        </main>
    
        <script src="../assets/js/admin_payroll.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>