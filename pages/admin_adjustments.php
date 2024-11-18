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
                <div>Adjustments</div>    
            </div>
            
            <!-- CONTENT -->
            <div class="bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">

                <div class="card shadow-sm bInfo">
                    <div class="card-header">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">

                            <li class="nav-item" role="presentation">
                                <!--ALLOWANCES BUTTON-->
                                <button class="nav-link active uncheck" id="pills-allowances-tab" data-bs-toggle="pill" data-bs-target="#pills-allowances" type="button" role="tab" aria-controls="pills-allowances" aria-selected="true">Allowances</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <!--REIMBURSEMENTS BUTTON-->
                                <button class="nav-link uncheck" id="pills-reimbursements-tab" data-bs-toggle="pill" data-bs-target="#pills-reimbursements" type="button" role="tab" aria-controls="pills-reimbursements" aria-selected="false">Reimbursements</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <!--DEDUCTIONS BUTTON-->
                                <button class="nav-link uncheck" id="pills-deductions-tab" data-bs-toggle="pill" data-bs-target="#pills-deductions" type="button" role="tab" aria-controls="pills-deductions" aria-selected="false">Deductions</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <!--ADJUSTMENTS BUTTON-->
                                <button class="nav-link uncheck" id="pills-adjustments-tab" data-bs-toggle="pill" data-bs-target="#pills-adjustments" type="button" role="tab" aria-controls="pills-adjustments" aria-selected="false">Adjustments</button>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content" id="pills-tabContent">

                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <!-- ------------------------------------------- ALLOWANCES TAB -------------------------------------- -->
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <div class="tab-pane fade show active" id="pills-allowances" role="tabpanel" aria-labelledby="pills-allowances-tab">
                                <div class="card border-0">
                                    <div class="tab-content" id="pills-tabContent">
                                        <table id="allowancesTable" class="table table-striped table-bordered min-w-full divide-y divide-gray-200 text-center pt-3">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                                    <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <?php
                                                    $allowanceQuery = mysqli_query($conn, $payroll->viewAllAllowances());
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
                            </div>
                            
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <!-- ----------------------------------------- REIMBURSEMENTS TAB ------------------------------------ -->
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <div class="tab-pane fade" id="pills-reimbursements" role="tabpanel" aria-labelledby="pills-reimbursements-tab">
                                <div class="card border-0">
                                    <div class="tab-content" id="pills-tabContent">
                                        <table id="reimbursementsTable" class="table table-striped table-bordered min-w-full divide-y divide-gray-200 text-center pt-3">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                                    <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <?php
                                                    $reimbursementQuery = mysqli_query($conn, $payroll->viewAllReimbursements());
                                                    while ($reimbursementDetails = mysqli_fetch_array($reimbursementQuery)) {

                                                        $reimbursement_id = $reimbursementDetails['reimbursementID'];
                                                        $reimbursement_name = $reimbursementDetails['reimbursementName'];


                                                        echo "<tr data-id='" . $reimbursement_id . "' class='reimbursementView cursor-pointer'>";
                                                        echo "<td class = 'whitespace-nowrap'>" . $reimbursement_id . "</td>";
                                                        echo "<td class = 'whitespace-nowrap'>" . $reimbursement_name . "</td>";
                                                        echo "</td>";
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <!-- ---------------------------------------- DEDUCTIONS TAB ----------------------------------------- -->
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <div class="tab-pane fade" id="pills-deductions" role="tabpanel" aria-labelledby="pills-deductions-tab">
                                <div class="card border-0">
                                    <div class="tab-content" id="pills-tabContent">
                                        <table id="deductionsTable" class="table table-striped table-bordered table-auto min-w-full divide-y divide-gray-200 text-center pt-3">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                                    <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <?php
                                                    $employeeQuery = mysqli_query($conn, $payroll->viewAllDeductions());
                                                    while ($employeeDetails = mysqli_fetch_array($employeeQuery)) {

                                                        $deduction_id = $employeeDetails['deductionID'];
                                                        $deduction_name = $employeeDetails['deductionName'];


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
                            </div>

                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <!-- ---------------------------------------- ADJUSTMENTS TAB ---------------------------------------- -->
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <div class="tab-pane fade" id="pills-adjustments" role="tabpanel" aria-labelledby="pills-adjustments-tab">
                                <div class="card border-0">
                                    <div class="tab-content" id="pills-tabContent">
                                        <table id="adjustmentsTable" class="table table-striped table-bordered table-auto min-w-full divide-y divide-gray-200 text-center pt-3">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                                    <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                    <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <?php
                                                    $adjustmentsQuery = mysqli_query($conn, $payroll->viewAllAdjustments());
                                                    while ($adjustmentsDetails = mysqli_fetch_array($adjustmentsQuery)) {

                                                        $adjustment_id = $adjustmentsDetails['adjustmentID'];
                                                        $adjustment_name = $adjustmentsDetails['adjustmentName'];
                                                        $adjustment_type = $adjustmentsDetails['adjustmentType'];

                                                        echo "<tr data-id='" . $adjustment_id . "' class='adjustmentView cursor-pointer'>";
                                                        echo "<td class = 'whitespace-nowrap'>" . $adjustment_id . "</td>";
                                                        echo "<td class = 'whitespace-nowrap'>" . $adjustment_name . "</td>";
                                                        echo "<td class = 'whitespace-nowrap'>" . $adjustment_type . "</td>";
                                                        echo "</td>";
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CARD FOOTER DATA ENTRY BUTTON -->
                    <div class="card-footer d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary me-md-2" type="button" data-bs-toggle="modal" data-bs-target="#addDataModal">Add Data</button>
                    </div>
                </div>
            </div>
            

            <!-- ======================================================================================================================================= -->
            <!-- ================================================================= MODAL =============================================================== -->
            <!-- ======================================================================================================================================= -->

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!----------------------------------------------------------------- ADD DATA MODAL ------------------------------------------------------------>
            <form id="addDataForm">
                <div class="modal fade" id="addDataModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                    <div class="modal-dialog modal-none modal-sm modal-dialog-centered">
                        <div class="modal-content" id="addDataModal">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="userFormLabel">New Data</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-2 mb-1">
                                    <div class="col-12">
                                        <label for="dataType">Type:</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <div class="col-12">
                                        <select class="form-select" id="dataType" name="dataType">
                                            <option disabled selected>Choose</option>
                                            <!-- <option value="1">Allowance</option> -->
                                            <option value="2">Reimbursement</option>
                                            <!-- <option value="3">Deduction</option> -->
                                            <option value="4">Adjustment</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row g-2 mb-1">
                                    <div class="col-12">
                                        <label for="name">Name:</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <div class="col-12">
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>
                                </div>

                                <div class="row g-2 mb-1">
                                    <div class="col-12">
                                        <label for="adjustment" id="adjustmentLabel">Action:</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <div class="col-12">
                                        <select class="form-select" id="adjustment" name="adjustment">
                                            <option disabled selected>Choose</option>
                                            <option value="Add">Add</option>
                                            <option value="Deduct">Deduct</option>
                                        </select>
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
                                    <label for="viewAllowanceName">Allowance Name:</label>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
                                <div class="col-12">
                                    <input type="text" class="form-control" id="viewAllowanceName" disabled readonly>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-primary allowanceUpdate" id="btnAllowanceUpdate">Update</button>
                            <button type="button" class="btn btn-danger allowanceDelete" id="btnAllowanceDelete">Delete</button> -->
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnClose_allowance">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!---------------------------------------------------------- VIEW REIMBURSEMENT MODAL --------------------------------------------------------->
            <div class="modal fade" id="viewReimbursementModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                <div class="modal-dialog modal-none modal-sm modal-dialog-centered">
                    <div class="modal-content" id="viewReimbursementModal">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="userFormLabel">View Reimbursement</h1>
                            <input type="hidden" id="viewReimbursementID">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-2 mb-1">
                                <div class="col-12">
                                    <label for="viewReimbursementName">Reimbursement Name:</label>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
                                <div class="col-12">
                                    <input type="text" class="form-control" id="viewReimbursementName" disabled readonly>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary reimbursementUpdate">Update</button>
                            <button type="button" class="btn btn-danger reimbursementDelete">Delete</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnClose_reimbursement">Close</button>
                        </div>
                    </div>
                </div>
            </div>

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
                                    <label for="viewDeductionName">Deduction Name:</label>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
                                <div class="col-12">
                                    <input type="text" class="form-control" id="viewDeductionName" disabled readonly>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-primary deductionUpdate">Update</button>
                            <button type="button" class="btn btn-danger deductionDelete">Delete</button> -->
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnClose_deduction">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!------------------------------------------------------------ VIEW ADJUSTMENT MODAL ---------------------------------------------------------->
            <div class="modal fade" id="viewAdjustmentModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                <div class="modal-dialog modal-none modal-sm modal-dialog-centered">
                    <div class="modal-content" id="viewAdjustmentModal">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="userFormLabel">View Adjustment</h1>
                            <input type="hidden" id="viewAdjustmentID">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-2 mb-1">
                                <div class="col-12">
                                    <label for="viewAdjustmentName">Adjustment Name:</label>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
                                <div class="col-12">
                                    <input type="text" class="form-control" id="viewAdjustmentName" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-2 mb-1">
                                <div class="col-12">
                                    <label for="viewAdjustmentType">Action:</label>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
                                <div class="col-12">
                                    <input type="text" class="form-control" id="viewAdjustmentType" disabled readonly>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary adjustmentUpdate">Update</button>
                            <button type="button" class="btn btn-danger adjustmentDelete">Delete</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnClose_adjustment">Close</button>
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
                                        <label for="updateAllowanceName">Allowance Name:</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <div class="col-12">
                                        <input type="text" class="form-control" id="updateAllowanceName" name="updateAllowanceName">
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Save</button>
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#viewAllowanceModal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!-------------------------------------------------------- UPDATE REIMBURSEMENT MODAL --------------------------------------------------------->
            <form id="updateReimbursementForm">
                <div class="modal fade" id="updateReimbursementModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                    <div class="modal-dialog modal-none modal-sm modal-dialog-centered">
                        <div class="modal-content" id="updateReimbursementModal">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="userFormLabel">Update Reimbursement</h1>
                                <input type="hidden" id="updateReimbursementID" name="updateReimbursementID">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-2 mb-1">
                                    <div class="col-12">
                                        <label for="updateReimbursementName">Reimbursement Name:</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <div class="col-12">
                                        <input type="text" class="form-control" id="updateReimbursementName" name="updateReimbursementName">
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Save</button>
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#viewReimbursementModal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

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
                                        <label for="updateDeductionName">Deduction Name:</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <div class="col-12">
                                        <input type="text" class="form-control" id="updateDeductionName" name="updateDeductionName">
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Save</button>
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#viewDeductionModal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!------------------------------------------------------------ UPDATE ADJUSTMENT MODAL --------------------------------------------------------->
            <form id="updateAdjustmentForm">
                <div class="modal fade" id="updateAdjustmentModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                    <div class="modal-dialog modal-none modal-sm modal-dialog-centered">
                        <div class="modal-content" id="updateAdjustmentModal">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="userFormLabel">Update Adjustment</h1>
                                <input type="hidden" id="updateAdjustmentID" name="updateAdjustmentID">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-2 mb-1">
                                    <div class="col-12">
                                        <label for="updateAdjustmentName">Adjustment Name:</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <div class="col-12">
                                        <input type="text" class="form-control" id="updateAdjustmentName" name="updateAdjustmentName">
                                    </div>
                                </div>

                                <div class="row g-2 mb-1">
                                    <div class="col-12">
                                        <label for="updateAdjustmentType">Adjustment Name:</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <div class="col-12">
                                        <select name="updateAdjustmentType" id="updateAdjustmentType" class="form-select">
                                            <option selected disabled>Choose</option>
                                            <option value="Add">Add</option>
                                            <option value="Deduct">Deduct</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Save</button>
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#viewAdjustmentModal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </main>
    
        <script src="../assets/js/admin_adjustments.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>