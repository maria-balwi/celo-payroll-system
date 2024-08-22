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
            <main class="flex-1 p-3 overflow-auto">
                <div class="flex flex-1 p-2 text-2xl font-bold justify-between items-center">
                    <div>
                        Leaves
                    </div>    

                    <!-- REQUEST PRE-RENDER BUTTON -->
                    <div class="static inline-block text-right">
                        <button type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none no-underline" data-bs-toggle="modal" data-bs-target="#fileLeaveModal">File a Leave</button>
                    </div>
                </div>

                <!-- CONTENT -->
                <div class="p-4 m-0 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">

                    <!-- DATATABLE -->
                    <div class="container mx-auto overflow-auto">
                        <table id="leaveTable" class="table table-striped table-bordered text-center min-w-full divide-y divide-gray-200 pt-3">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Date Filed</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Leave Type</th>
                                    <!-- <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Sub Leave Type</th> -->
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Days</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Inclusive Dates</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Purpose | Remarks</th>
                                    <!-- <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Attachments</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Paid</th> -->
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php
                                    function formatDate($date) {
                                        // Create a DateTime object from the string
                                        $dateTime = new DateTime($date);
                                    
                                        // Format the date
                                        return $dateTime->format('M d, Y');
                                    }

                                    $leaveQuery = mysqli_query($conn, $employees->viewLeaves($_SESSION['id']));
                                    while ($leaveDetails = mysqli_fetch_array($leaveQuery)) {

                                        $leave_id = $leaveDetails['requestID'];
                                        $leave_dateFiled = $leaveDetails['dateFiled'];
                                        $leave_leaveType = $leaveDetails['leaveType'];
                                        $leave_effectivityStartDate = $leaveDetails['effectivityStartDate'];
                                        $leave_effectivityEndDate = $leaveDetails['effectivityEndDate'];
                                        $leave_remarks = $leaveDetails['remarks'];
                                        $leave_status = $leaveDetails['status'];

                                        $leave_dateFiled = formatDate($leave_dateFiled);
                                        $leave_effectivityStartDate = formatDate($leave_effectivityStartDate);
                                        $leave_effectivityEndDate = formatDate($leave_effectivityEndDate);
                                        $leave_effectivityDate = $leave_effectivityStartDate . " - " . $leave_effectivityEndDate;
                                        
                                        $startDate = new DateTime($leave_effectivityStartDate);
                                        $endDate = new DateTime($leave_effectivityEndDate);
                                        $endDate = $endDate->modify('+1 day');
                                        $leave_days = 0;

                                        while ($startDate < $endDate) {
                                            $leave_days++;
                                            $startDate->modify('+1 day');
                                        }

                                        if ($leave_days <= 1) {
                                            $leave_days = $leave_days . " day";
                                        }
                                        else {
                                            $leave_days = $leave_days . " days";
                                        }

                                        echo "<tr data-id='" . $leave_id . "' class='leaveView cursor-pointer'>";
                                        echo "<td class = ' whitespace-nowrap'>" . $leave_dateFiled . "</td>";
                                        echo "<td class = ' whitespace-nowrap'>" . $leave_leaveType . "</td>";
                                        echo "<td class = ' whitespace-nowrap'>" . $leave_days . "</td>";
                                        echo "<td class = ' whitespace-nowrap'>" . $leave_effectivityDate . "</td>";
                                        echo "<td class = ' whitespace-nowrap'>" . $leave_remarks . "</td>";
                                        if ($leave_status == "Pending") {
                                            echo "<td><p class='inline-block bg-yellow-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $leave_status . "</p></td>";
                                        }
                                        else if ($leave_status == "Approved") {
                                            echo "<td><p class='inline-block bg-green-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $leave_status . "</p></td>";
                                        }
                                        else if ($leave_status == "Disapproved") {
                                            echo "<td><p class='inline-block bg-red-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $leave_status . "</p></td>";
                                        }
                                        echo "</tr>";
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
                <!------------------------------------------------------------------ FILE LEAVE --------------------------------------------------------------->
                <form id="fileLeaveForm">
                    <div class="modal fade" id="fileLeaveModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                        <div class="modal-dialog modal-none modal-sm modal-dialog-centered">
                            <div class="modal-content" id="fileLeaveModal">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="userFormLabel">New User</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row g-3 mb-2">
                                        <div class="col-12">
                                            <label for="leaveType">Leave:</label>
                                        </div>
                                    </div>

                                    <div class="row g-3 mb-2">
                                        <div class="col-12">
                                            <select class="form-select border border-1" id="leaveType" name="leaveType" required>
                                                <option selected disabled>Choose Leave Type</option>
                                                <?php
                                                $allLeaveType = mysqli_query($conn, $employees->viewAllLeaveType());
                                                while ($allLeaveTypeResult = mysqli_fetch_array($allLeaveType)) {
                                                ?>
                                                    <option value="<?php echo $allLeaveTypeResult['leaveTypeID']; ?>">
                                                        <?php echo $allLeaveTypeResult['leaveType']; ?>
                                                    </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>   
                                    
                                    <div class="row g-3 mb-2">
                                        <div class="col-12">
                                            <label for="effectivityStartDate">Start Date</label>
                                        </div>
                                    </div>

                                    <div class="row g-3 mb-2">
                                        <div class="col-12">
                                            <input type="date" class="form-control" id="effectivityStartDate" name="effectivityStartDate">
                                        </div>
                                    </div>

                                    <div class="row g-3 mb-2">
                                        <div class="col-12">
                                            <label for="effectivityEndDate">End Date</label>
                                        </div>
                                    </div>

                                    <div class="row g-3 mb-2">
                                        <div class="col-12">
                                            <input type="date" class="form-control" id="effectivityEndDate" name="effectivityEndDate">
                                        </div>
                                    </div>
                                    
                                    <div class="row g-3 mb-2">
                                        <div class="col-12">
                                            <label for="purpose">Purpose:</label>
                                        </div>
                                    </div>

                                    <div class="row g-3 mb-2">
                                        <div class="col-12">
                                            <textarea type="text" id="purpose" name="purpose" placeholder="Purpose" rows="3" class="form-control" required></textarea>
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
                <!------------------------------------------------------------------ VIEW LEAVE --------------------------------------------------------------->
                <div class="modal fade" id="viewLeaveModal" tabindex="-1" aria-labelledby="viewLeaveLabel" aria-hidden="true">
                    <div class="modal-dialog modal-none modal-dialog-centered modal-scrollable">
                        <div class="modal-content" id="viewLeaveModal">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="viewLeaveLabel">View Leave</h1>
                                <input type="hidden" id="viewLeaveID">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="row g-2 mb-2">
                                        <div class="col-6">
                                            <label for="viewDateFiled">Date Filed</label>
                                        </div>
                                        <div class="col-6">
                                            <label for="viewStatus">Status</label>
                                        </div>
                                    </div>

                                    <div class="row g-2 mb-2">
                                        <div class="col-6">
                                            <input type="text" class="form-control" id="viewDateFiled" disabled readonly>
                                        </div>
                                        <div class="col-6">
                                            <input type="text" class="form-control" id="viewStatus" disabled>
                                        </div>
                                    </div>

                                    <div class="row g-2 mb-2">
                                        <div class="col-3">
                                            <label for="viewEmpID">Employee ID</label>
                                        </div>
                                        <div class="col-9">
                                            <label for="viewName">Employee Name</label>
                                        </div>
                                    </div>

                                    <div class="row g-2 mb-2">
                                        <div class="col-3">
                                            <input type="text" class="form-control" id="viewEmpID" disabled>
                                        </div>
                                        <div class="col-9">
                                            <input type="text" class="form-control" id="viewName" disabled>
                                        </div>
                                    </div>

                                    <div class="row g-2 mb-2">
                                        <div class="col-12">
                                            <label for="viewLeaveType">Leave Type</label>
                                        </div>
                                    </div>

                                    <div class="row g-2 mb-2">
                                        <div class="col-12">
                                            <input type="text" class="form-control" id="viewLeaveType" disabled>
                                        </div>
                                    </div>

                                    <div class="row g-2 mb-2">
                                        <div class="col-3">
                                            <label for="viewStartDate">Inclusive Dates</label>
                                        </div>
                                    </div>

                                    <div class="row g-2 mb-2">
                                        <div class="col-6">
                                            <input type="text" class="form-control" id="viewStartDate" disabled>
                                        </div>
                                        <div class="col-6">
                                            <input type="text" class="form-control" id="viewEndDate" disabled>
                                        </div>
                                    </div>

                                    <div class="row g-2 mb-2">
                                        <div class="col-3">
                                            <label for="viewPurpose">Purpose</label>
                                        </div>
                                    </div>

                                    <div class="row g-2 mb-2">
                                        <div class="col-12">
                                            <textarea type="text" class="form-control" id="viewPurpose" rows="3" disabled readonly>
                                            </textarea>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnClose">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            
        </div>

        <script src="../assets/js/user_leaves.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>