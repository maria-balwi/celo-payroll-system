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
                <div>
                    Deductions
                </div>    
            </div>
            
            <!-- CONTENT -->
            <div class="bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <!-- DATATABLE -->
                        <div class="container mx-auto my-3 overflow-auto">
                            <table id="deductionsTable" class="table table-striped table-bordered table-auto min-w-full divide-y divide-gray-200 text-center pt-3">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                        <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <!-- <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th> -->
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php
                                        $employeeQuery = mysqli_query($conn, $employees->viewDeductions());
                                        while ($employeeDetails = mysqli_fetch_array($employeeQuery)) {

                                            $deduction_id = $employeeDetails['deductionID'];
                                            $deduction_name = $employeeDetails['deductionName'];
                                            $deduction_amount = $employeeDetails['deductionAmount'];


                                            echo "<tr data-id='" . $deduction_id . "' class='deductionView cursor-pointer'>";
                                            echo "<td class = 'whitespace-nowrap'>" . $deduction_id . "</td>";
                                            echo "<td class = 'whitespace-nowrap'>" . $deduction_name . "</td>";
                                            echo "</td>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- CARD FOOTER DATA ENTRY BUTTON -->
                    <div class="card-footer d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary me-md-2" type="button" data-bs-toggle="modal" data-bs-target="#addDeductionModal">Add Deduction</button>
                    </div>
                </div>
            </div>
            

            <!-- ======================================================================================================================================= -->
            <!-- ================================================================= MODAL =============================================================== -->
            <!-- ======================================================================================================================================= -->

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!------------------------------------------------------------ ADD DEDUCTION MODAL ------------------------------------------------------------>
            <form id="addDeductionForm">
                <div class="modal fade" id="addDeductionModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                    <div class="modal-dialog modal-none modal-sm modal-dialog-centered">
                        <div class="modal-content" id="addDeductionModal">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="userFormLabel">New Deduction</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-2 mb-1">
                                    <div class="col-12">
                                        <label for="deductionName">Deduction:</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <div class="col-12">
                                        <input type="text" class="form-control" id="deductionName" name="deductionName">
                                    </div>
                                </div>

                                <!-- <div class="row g-2 mb-2">
                                    <div class="col-12">
                                        <label for="deductionAmount">Amount:</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <div class="col-12">
                                        <input type="number" class="form-control" id="deductionAmount" name="deductionAmount" placeholder="Amount" step="0.01">
                                    </div>
                                </div> -->
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
            <!------------------------------------------------------------ VIEW DEDUCTION MODAL ----------------------------------------------------------->
            <div class="modal fade" id="viewDeductionModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                <div class="modal-dialog modal-none modal-sm modal-dialog-centered">
                    <div class="modal-content" id="viewDeductionModal">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="userFormLabel">View Deduction</h1>
                            <input type="hidden" id="viewDeductionID">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-2 mb-1">
                                <div class="col-12">
                                    <label for="viewDeductionName">Deduction:</label>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
                                <div class="col-12">
                                    <input type="text" class="form-control" id="viewDeductionName" disabled readonly>
                                </div>
                            </div>

                            <!-- <div class="row g-2 mb-2">
                                <div class="col-12">
                                    <label for="viewDeductionAmount">Amount:</label>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
                                <div class="col-12">
                                    <input type="number" class="form-control" id="viewDeductionAmount" disabled readonly>
                                </div>
                            </div> -->
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary deductionUpdate">Update</button>
                            <button type="button" class="btn btn-danger deductionDelete">Delete</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnClose">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!------------------------------------------------------------ UPDATE DEDUCTION MODAL --------------------------------------------------------->
            <form id="updateDeductionForm">
                <div class="modal fade" id="updateDeductionModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                    <div class="modal-dialog modal-none modal-sm modal-dialog-centered">
                        <div class="modal-content" id="updateDeductionModal">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="userFormLabel">Update Deduction</h1>
                                <input type="hidden" id="updateDeductionID" name="updateDeductionID">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-2 mb-1">
                                    <div class="col-12">
                                        <label for="updateDeductionName">Deduction:</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <div class="col-12">
                                        <input type="text" class="form-control" id="updateDeductionName" name="updateDeductionName">
                                    </div>
                                </div>

                                <!-- <div class="row g-2 mb-2">
                                    <div class="col-12">
                                        <label for="updateDeductionAmount">Amount:</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <div class="col-12">
                                        <input type="number" class="form-control" id="updateDeductionAmount" name="updateDeductionAmount" placeholder="Amount" step="0.01">
                                    </div>
                                </div> -->
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Save</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </main>
    
        <script src="../assets/js/admin_deductions.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>