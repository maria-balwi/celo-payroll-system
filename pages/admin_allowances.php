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
                    Allowances
                </div>    
            </div>
            
            <!-- CONTENT -->
            <div class="bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <!-- DATATABLE -->
                        <div class="mx-auto my-3 overflow-auto">
                            <table id="allowancesTable" class="table table-striped table-bordered min-w-full divide-y divide-gray-200 text-center pt-3">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                        <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php
                                        $allowanceQuery = mysqli_query($conn, $employees->viewAllowances());
                                        while ($allowanceDetails = mysqli_fetch_array($allowanceQuery)) {

                                            $allowance_id = $allowanceDetails['allowanceID'];
                                            $allowance_name = $allowanceDetails['allowanceName'];


                                            echo "<tr data-id='" . $allowance_id . "' class='allowanceView cursor-pointer'>";
                                            echo "<td class = 'whitespace-nowrap'>" . $allowance_id . "</td>";
                                            echo "<td class = 'whitespace-nowrap'>" . $allowance_name . "</td>";
                                            echo "</td>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- CARD FOOTER DATA ENTRY BUTTON -->
                    <div class="card-footer d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary me-md-2" type="button" data-bs-toggle="modal" data-bs-target="#addAllowanceModal">Add Allowance</button>
                    </div>
                </div>
            </div>
            

            <!-- ======================================================================================================================================= -->
            <!-- ================================================================= MODAL =============================================================== -->
            <!-- ======================================================================================================================================= -->

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!------------------------------------------------------------ ADD ALLOWANCE MODAL ------------------------------------------------------------>
            <form id="addAllowanceForm">
                <div class="modal fade" id="addAllowanceModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                    <div class="modal-dialog modal-none modal-sm modal-dialog-centered">
                        <div class="modal-content" id="addAllowanceModal">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="userFormLabel">New Allowance</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-2 mb-1">
                                    <div class="col-12">
                                        <label for="allowanceName">Allowance:</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <div class="col-12">
                                        <input type="text" class="form-control" id="allowanceName" name="allowanceName">
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
            <!------------------------------------------------------------ VIEW ALLOWANCE MODAL ----------------------------------------------------------->
            <div class="modal fade" id="viewAllowanceModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                <div class="modal-dialog modal-none modal-sm modal-dialog-centered">
                    <div class="modal-content" id="viewAllowanceModal">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="userFormLabel">View Allowance</h1>
                            <input type="hidden" id="viewAllowanceID">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-2 mb-1">
                                <div class="col-12">
                                    <label for="viewAllowanceName">Allowance:</label>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
                                <div class="col-12">
                                    <input type="text" class="form-control" id="viewAllowanceName" disabled readonly>
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
                            <button type="button" class="btn btn-primary allowanceUpdate">Update</button>
                            <button type="button" class="btn btn-danger allowanceDelete">Delete</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnClose">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!------------------------------------------------------------ UPDATE ALLOWANCE MODAL --------------------------------------------------------->
            <form id="updateAllowanceForm">
                <div class="modal fade" id="updateAllowanceModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                    <div class="modal-dialog modal-none modal-sm modal-dialog-centered">
                        <div class="modal-content" id="updateAllowanceModal">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="userFormLabel">Update Allowance</h1>
                                <input type="hidden" id="updateAllowanceID" name="updateAllowanceID">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-2 mb-1">
                                    <div class="col-12">
                                        <label for="updateAllowanceName">Allowance:</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <div class="col-12">
                                        <input type="text" class="form-control" id="updateAllowanceName" name="updateAllowanceName">
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
    
        <script src="../assets/js/admin_allowances.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>