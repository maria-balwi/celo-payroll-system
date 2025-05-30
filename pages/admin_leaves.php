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
                <div class="mr-4">
                    Leave Applications
                </div>  
            </div>
            
            <!-- CONTENT -->
            <div class="px-3 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                
                <!-- DATATABLE -->
                <div class="mx-auto my-3 overflow-auto">
                    <table id="leavesTable" class="table table-auto table-striped table-bordered min-w-full divide-y divide-gray-200 text-center pt-3">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Date Filed</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Employee</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Leave Type</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Days</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Inclusive Dates</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Purpose</th>
                                <!-- <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Attachments</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Paid</th> -->
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <!-- <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                function formatDate($date) {
                                    // Create a DateTime object from the string
                                    $dateTime = new DateTime($date);
                                
                                    // Format the date
                                    return $dateTime->format('M d, Y');
                                }

                                if ($_SESSION['departmentID'] == 3) {
                                    $leaveQuery = mysqli_query($conn, $employees->viewAdminLeaveRequests());
                                    while ($leaveDetails = mysqli_fetch_array($leaveQuery)) {
    
                                        $leave_id = $leaveDetails['requestID'];
                                        $leave_dateFiled = $leaveDetails['dateFiled'];
                                        $leave_employeeName = $leaveDetails['firstName'] . " " . $leaveDetails['lastName'];
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
    
                                        echo "<tr data-id='" . $leave_id . "' data-designation='" . $_SESSION['designationID'] . "' class='leaveView cursor-pointer'>";
                                        echo "<td class ='whitespace-nowrap'>" . $leave_dateFiled . "</td>";
                                        echo "<td class ='whitespace-nowrap'>" . $leave_employeeName . "</td>";
                                        echo "<td class ='whitespace-nowrap'>" . $leave_leaveType . "</td>";
                                        echo "<td class ='whitespace-nowrap'>" . $leave_days . "</td>";
                                        echo "<td class ='whitespace-nowrap'>" . $leave_effectivityDate . "</td>";
                                        echo "<td class ='whitespace-nowrap'>" . $leave_remarks . "</td>";
                                        if ($leave_status == "Pending") {
                                            echo "<td><p class='inline-block bg-yellow-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $leave_status . "</p></td>";
                                        }
                                        else if ($leave_status == "Approved") {
                                            echo "<td><p class='inline-block bg-green-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $leave_status . "</p></td>";
                                        }
                                        else if ($leave_status == "Disapproved") {
                                            echo "<td><p class='inline-block bg-red-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $leave_status . "</p></td>";
                                        }
                                        echo "</td>";
                                    }
                                }
                                else if ($_SESSION['departmentID'] == 5) {
                                    $leaveQuery = mysqli_query($conn, $employees->viewDirectorLeaveRequests());
                                    while ($leaveDetails = mysqli_fetch_array($leaveQuery)) {
    
                                        $leave_id = $leaveDetails['requestID'];
                                        $leave_dateFiled = $leaveDetails['dateFiled'];
                                        $leave_employeeName = $leaveDetails['firstName'] . " " . $leaveDetails['lastName'];
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
    
                                        echo "<tr data-id='" . $leave_id . "' data-designation='" . $_SESSION['designationID'] . "' class='leaveView cursor-pointer'>";
                                        echo "<td class ='whitespace-nowrap'>" . $leave_dateFiled . "</td>";
                                        echo "<td class ='whitespace-nowrap'>" . $leave_employeeName . "</td>";
                                        echo "<td class ='whitespace-nowrap'>" . $leave_leaveType . "</td>";
                                        echo "<td class ='whitespace-nowrap'>" . $leave_days . "</td>";
                                        echo "<td class ='whitespace-nowrap'>" . $leave_effectivityDate . "</td>";
                                        echo "<td class ='whitespace-nowrap'>" . $leave_remarks . "</td>";
                                        if ($leave_status == "Pending") {
                                            echo "<td><p class='inline-block bg-yellow-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $leave_status . "</p></td>";
                                        }
                                        else if ($leave_status == "Approved") {
                                            echo "<td><p class='inline-block bg-green-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $leave_status . "</p></td>";
                                        }
                                        else if ($leave_status == "Disapproved") {
                                            echo "<td><p class='inline-block bg-red-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $leave_status . "</p></td>";
                                        }
                                        echo "</td>";
                                    }
                                }
                                else {
                                    $leaveQuery = mysqli_query($conn, $employees->viewAllLeaveRequests());
                                    while ($leaveDetails = mysqli_fetch_array($leaveQuery)) {
    
                                        $leave_id = $leaveDetails['requestID'];
                                        $leave_dateFiled = $leaveDetails['dateFiled'];
                                        $leave_employeeName = $leaveDetails['firstName'] . " " . $leaveDetails['lastName'];
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
    
                                        echo "<tr data-id='" . $leave_id . "' data-designation='" . $_SESSION['designationID'] . "' class='leaveView cursor-pointer'>";
                                        echo "<td class ='whitespace-nowrap'>" . $leave_dateFiled . "</td>";
                                        echo "<td class ='whitespace-nowrap'>" . $leave_employeeName . "</td>";
                                        echo "<td class ='whitespace-nowrap'>" . $leave_leaveType . "</td>";
                                        echo "<td class ='whitespace-nowrap'>" . $leave_days . "</td>";
                                        echo "<td class ='whitespace-nowrap'>" . $leave_effectivityDate . "</td>";
                                        echo "<td class ='whitespace-nowrap'>" . $leave_remarks . "</td>";
                                        if ($leave_status == "Pending") {
                                            echo "<td><p class='inline-block bg-yellow-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $leave_status . "</p></td>";
                                        }
                                        else if ($leave_status == "Approved") {
                                            echo "<td><p class='inline-block bg-green-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $leave_status . "</p></td>";
                                        }
                                        else if ($leave_status == "Disapproved") {
                                            echo "<td><p class='inline-block bg-red-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $leave_status . "</p></td>";
                                        }
                                        echo "</td>";
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
            <!---------------------------------------------------------------- VIEW LEAVES FORM ----------------------------------------------------------->
            <div class="modal fade" id="viewLeaveModal" tabindex="-1" aria-labelledby="viewLeaveLabel" aria-hidden="true">
                <div class="modal-dialog modal-none modal-dialog-centered modal-scrollable">
                    <div class="modal-content" id="viewLeaveModal">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="viewLeaveLabel">View Leave</h1>
                            <input type="hidden" id="viewLeaveID">
                            <input type="hidden" id="userDept" value="<?php echo $_SESSION['departmentID']; ?>">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="row g-2 mb-1">
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

                                <div class="row g-2 mb-1">
                                    <div class="col-12">
                                        <label for="viewLeaveType">Leave Type</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <div class="col-12">
                                        <input type="text" class="form-control" id="viewLeaveType" disabled>
                                    </div>
                                </div>

                                <div class="row g-2 mb-1">
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

                                <div class="row g-2 mb-1">
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

                                <div class="row g-2" id="viewMedCertRow">
                                    <div class="col-12">
                                        <button id="viewMedicalCert" class="text-blue-500">View Medical Certificate</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success approveLeave" id="approveLeave">Approve</button>
                            <button type="button" class="btn btn-danger disapproveLeave" id="disapproveLeave">Disapprove</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnClose">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    
        <script src="../assets/js/admin_leaves.js?v=<?php echo $version; ?>"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>