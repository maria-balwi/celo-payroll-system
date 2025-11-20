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
                    Change Shift Requests
                </div>  
            </div>
            
            <!-- CONTENT -->
            <div class="px-3 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                <!-- DATATABLE -->
                <div class="mx-auto my-3 overflow-auto">
                    <table id="changeShiftTable" class="table table-striped table-bordered table-auto min-w-full divide-y divide-gray-200 text-center pt-3">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Date Filed</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Employee</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Current Shift</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Requested Shift</th>
                                <!-- <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Inclusive Dates</th> -->
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Reason / Remarks</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
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

                                if ($_SESSION['departmentID'] == 3) {
                                    $shiftQuery = mysqli_query($conn, $employees->viewAdminChangeShiftRequest());
                                    while ($shiftDetails = mysqli_fetch_array($shiftQuery)) {

                                        $shift_id = $shiftDetails['requestID'];
                                        $shift_dateFiled = $shiftDetails['dateFiled'];
                                        $shift_employeeName = $shiftDetails['firstName'] . " " . $shiftDetails['lastName'];
                                        $shift_currentShift = $shiftDetails['currentShift'];
                                        $shift_requestedShift = $shiftDetails['requestedShift'];
                                        // $shift_effectivityStartDate = $shiftDetails['effectivityStartDate'];
                                        // $shift_effectivityEndDate = $shiftDetails['effectivityEndDate'];
                                        $shift_remarks = $shiftDetails['remarks'];
                                        $shift_status = $shiftDetails['status'];

                                        $shift_dateFiled = formatDate($shift_dateFiled);
                                        // $shift_effectivityStartDate = formatDate($shift_effectivityStartDate);
                                        // $shift_effectivityEndDate = formatDate($shift_effectivityEndDate);
                                        // $shift_effectivityDate = $shift_effectivityStartDate . " - " . $shift_effectivityEndDate;

                                        echo "<tr data-id='" . $shift_id . "' class='changeshiftView cursor-pointer'>";
                                        echo "<td class ='whitespace-nowrap'>" . $shift_dateFiled . "</td>";
                                        echo "<td class ='whitespace-nowrap'>" . $shift_employeeName . "</td>";
                                        echo "<td class ='whitespace-nowrap'>" . $shift_currentShift . "</td>";
                                        echo "<td class ='whitespace-nowrap'>" . $shift_requestedShift . "</td>";
                                        // echo "<td class ='whitespace-nowrap'>" . $shift_effectivityDate . "</td>";
                                        echo "<td class ='whitespace-nowrap'>" . $shift_remarks . "</td>";
                                        if ($shift_status == "Pending") {
                                            echo "<td><p class='inline-block bg-yellow-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $shift_status . "</p></td>";
                                        }
                                        else if ($shift_status == "Approved") {
                                            echo "<td><p class='inline-block bg-green-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $shift_status . "</p></td>";
                                        }
                                        else if ($shift_status == "Disapproved") {
                                            echo "<td><p class='inline-block bg-red-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $shift_status . "</p></td>";
                                        }
                                        echo "</td>";
                                    }
                                }   
                                else if ($_SESSION['departmentID'] == 5) {
                                    $shiftQuery = mysqli_query($conn, $employees->viewDirectorChangeShiftRequest());
                                    while ($shiftDetails = mysqli_fetch_array($shiftQuery)) {

                                        $shift_id = $shiftDetails['requestID'];
                                        $shift_dateFiled = $shiftDetails['dateFiled'];
                                        $shift_employeeName = $shiftDetails['firstName'] . " " . $shiftDetails['lastName'];
                                        $shift_currentShift = $shiftDetails['currentShift'];
                                        $shift_requestedShift = $shiftDetails['requestedShift'];
                                        // $shift_effectivityStartDate = $shiftDetails['effectivityStartDate'];
                                        // $shift_effectivityEndDate = $shiftDetails['effectivityEndDate'];
                                        $shift_remarks = $shiftDetails['remarks'];
                                        $shift_status = $shiftDetails['status'];

                                        $shift_dateFiled = formatDate($shift_dateFiled);
                                        // $shift_effectivityStartDate = formatDate($shift_effectivityStartDate);
                                        // $shift_effectivityEndDate = formatDate($shift_effectivityEndDate);
                                        // $shift_effectivityDate = $shift_effectivityStartDate . " - " . $shift_effectivityEndDate;

                                        echo "<tr data-id='" . $shift_id . "' class='changeshiftView cursor-pointer'>";
                                        echo "<td class ='whitespace-nowrap'>" . $shift_dateFiled . "</td>";
                                        echo "<td class ='whitespace-nowrap'>" . $shift_employeeName . "</td>";
                                        echo "<td class ='whitespace-nowrap'>" . $shift_currentShift . "</td>";
                                        echo "<td class ='whitespace-nowrap'>" . $shift_requestedShift . "</td>";
                                        // echo "<td class ='whitespace-nowrap'>" . $shift_effectivityDate . "</td>";
                                        echo "<td class ='whitespace-nowrap'>" . $shift_remarks . "</td>";
                                        if ($shift_status == "Pending") {
                                            echo "<td><p class='inline-block bg-yellow-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $shift_status . "</p></td>";
                                        }
                                        else if ($shift_status == "Approved") {
                                            echo "<td><p class='inline-block bg-green-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $shift_status . "</p></td>";
                                        }
                                        else if ($shift_status == "Disapproved") {
                                            echo "<td><p class='inline-block bg-red-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $shift_status . "</p></td>";
                                        }
                                        echo "</td>";
                                    }
                                }
                                else if ($_SESSION['levelID'] == 0) {
                                    $shiftQuery = mysqli_query($conn, $employees->viewAllChangeShiftRequest());
                                    while ($shiftDetails = mysqli_fetch_array($shiftQuery)) {

                                        $shift_id = $shiftDetails['requestID'];
                                        $shift_dateFiled = $shiftDetails['dateFiled'];
                                        $shift_employeeName = $shiftDetails['firstName'] . " " . $shiftDetails['lastName'];
                                        $shift_currentShift = $shiftDetails['currentShift'];
                                        $shift_requestedShift = $shiftDetails['requestedShift'];
                                        // $shift_effectivityStartDate = $shiftDetails['effectivityStartDate'];
                                        // $shift_effectivityEndDate = $shiftDetails['effectivityEndDate'];
                                        $shift_remarks = $shiftDetails['remarks'];
                                        $shift_status = $shiftDetails['status'];

                                        $shift_dateFiled = formatDate($shift_dateFiled);
                                        // $shift_effectivityStartDate = formatDate($shift_effectivityStartDate);
                                        // $shift_effectivityEndDate = formatDate($shift_effectivityEndDate);
                                        // $shift_effectivityDate = $shift_effectivityStartDate . " - " . $shift_effectivityEndDate;

                                        echo "<tr data-id='" . $shift_id . "' class='changeshiftView cursor-pointer'>";
                                        echo "<td class ='whitespace-nowrap'>" . $shift_dateFiled . "</td>";
                                        echo "<td class ='whitespace-nowrap'>" . $shift_employeeName . "</td>";
                                        echo "<td class ='whitespace-nowrap'>" . $shift_currentShift . "</td>";
                                        echo "<td class ='whitespace-nowrap'>" . $shift_requestedShift . "</td>";
                                        // echo "<td class ='whitespace-nowrap'>" . $shift_effectivityDate . "</td>";
                                        echo "<td class ='whitespace-nowrap'>" . $shift_remarks . "</td>";
                                        if ($shift_status == "Pending") {
                                            echo "<td><p class='inline-block bg-yellow-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $shift_status . "</p></td>";
                                        }
                                        else if ($shift_status == "Approved") {
                                            echo "<td><p class='inline-block bg-green-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $shift_status . "</p></td>";
                                        }
                                        else if ($shift_status == "Disapproved") {
                                            echo "<td><p class='inline-block bg-red-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $shift_status . "</p></td>";
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
            <!------------------------------------------------------------------ VIEW CHANGE SHIFT FORM --------------------------------------------------->
            <div class="modal fade" id="viewChangeShiftModal" tabindex="-1" aria-labelledby="viewLeaveLabel" aria-hidden="true">
                <div class="modal-dialog modal-none modal-dialog-centered modal-scrollable">
                    <div class="modal-content" id="viewChangeShiftModal">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="viewLeaveLabel">View Change Shift</h1>
                            <input type="hidden" id="viewLeaveID">
                            <input type="hidden" id="userDept" value="<?php echo $_SESSION['departmentID']; ?>">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="row g-2 mb-1">
                                    <div class="col-6">
                                        <label for="viewDateFiled">Date Filed:</label>
                                    </div>  
                                    <div class="col-6">
                                        <label for="viewStatus">Status:</label>
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

                                <div class="row g-2 mb-1">
                                    <div class="col-3">
                                        <label for="viewEmpID">Employee ID:</label>
                                    </div>
                                    <div class="col-9">
                                        <label for="viewName">Employee Name:</label>
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
                                    <div class="col-6">
                                        <label for="viewCurrentShift">Current Shift:</label>
                                    </div>
                                    <div class="col-6">
                                        <label for="viewRequestedShift">Requested Shift:</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <div class="col-6">
                                        <input type="text" class="form-control" id="viewCurrentShift" disabled>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" id="viewRequestedShift" disabled>
                                    </div>
                                </div>

                                <!-- <div class="row g-2 mb-1">
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
                                </div> -->

                                <div class="row g-2 mb-1">
                                    <div class="col-3">
                                        <label for="viewPurpose">Reason / Remarks:</label>
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
                            <button type="button" class="btn btn-success approveChangeShift" id="approveChangeShift">Approve</button>
                            <button type="button" class="btn btn-danger disapproveChangeShift" id="disapproveChangeShift">Disapprove</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnClose">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    
        <script src="../assets/js/admin_changeShift.js?v=<?php echo $version; ?>"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>