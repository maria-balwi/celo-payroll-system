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
                    Change Shift
                </div>    

                <!-- REQUEST SHIFT CHANGE BUTTON -->
                <div class="static inline-block text-right">
                    <button class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none" data-bs-toggle="modal" data-bs-target="#fileRequestModal">
                    Request Shift Change
                    </button>
                </div>
            </div>
            
            <!-- CONTENT -->
            <div class="p-4 m-1 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                
                <!-- DATATABLE -->
                <div class="container mx-auto overflow-auto">
                    <table id="changeShiftTable" class="table min-w-full divide-y divide-gray-200 text-center table-auto table-striped table-bordered pt-3">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Date Filed</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Requested Shift</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Effectivity Date</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Reason | Remarks</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
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

                                $shiftQuery = mysqli_query($conn, $employees->viewChangeShift($_SESSION['id']));
                                while ($shiftDetails = mysqli_fetch_array($shiftQuery)) {

                                    $shift_id = $shiftDetails['requestID'];
                                    $shift_dateFiled = $shiftDetails['dateFiled'];
                                    $shift_shiftID = $shiftDetails['startTime'] . " - " . $shiftDetails['endTime'];
                                    $shift_effectivityStartDate = $shiftDetails['effectivityStartDate'];
                                    $shift_effectivityEndDate = $shiftDetails['effectivityEndDate'];
                                    $shift_remarks = $shiftDetails['remarks'];
                                    $shift_status = $shiftDetails['status'];

                                    $shift_dateFiled = formatDate($shift_dateFiled);
                                    $shift_effectivityStartDate = formatDate($shift_effectivityStartDate);
                                    $shift_effectivityEndDate = formatDate($shift_effectivityEndDate);
                                    $shift_effectivityDate = $shift_effectivityStartDate . " - " . $shift_effectivityEndDate;

                                    echo "<tr data-id='" . $shift_id . "' class='changeshiftView cursor-pointer'>";
                                    echo "<td ='px-6 whitespace-nowrap'>" . $shift_dateFiled . "</td>";
                                    echo "<td ='px-6 whitespace-nowrap'>" . $shift_shiftID . "</td>";
                                    echo "<td ='px-6 whitespace-nowrap'>" . $shift_effectivityDate . "</td>";
                                    echo "<td ='px-6 whitespace-nowrap'>" . $shift_remarks . "</td>";
                                    if ($shift_status == "Pending") {
                                        echo "<td><p class='inline-block bg-yellow-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $shift_status . "</p></td>";
                                    }
                                    else if ($shift_status == "Approved") {
                                        echo "<td><p class='inline-block bg-green-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $shift_status . "</p></td>";
                                    }
                                    else if ($shift_status == "Disapproved") {
                                        echo "<td><p class='inline-block bg-red-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $shift_status . "</p></td>";
                                    }
                                    // echo "<td class='px-6 whitespace-nowrap'>
                                    //     <svg class='h-6 w-6 text-gray-500'  fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                                    //         <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z'/>
                                    //         <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15 12a3 3 0 11-6 0 3 3 0 016 0z'/>
                                    //     </svg>
                                    // </td>";
                                    echo "</td>";
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
            <!--------------------------------------------------------- FILE CHANGE SHIFT REQUEST --------------------------------------------------------->
            <form id="fileRequestForm">
                <div class="modal fade" id="fileRequestModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                    <div class="modal-dialog modal-none modal-sm modal-dialog-centered">
                        <div class="modal-content" id="fileRequestModal">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="userFormLabel">New User</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3 mb-2">
                                    <div class="col-12">
                                        <label for="newShift">Shifts:</label>
                                    </div>
                                </div>

                                <div class="row g-3 mb-2">
                                    <div class="col-12">
                                        <select type="dropdown" id="newShift" class="form-select border border-1">
                                            <option value="" selected disabled>Choose Shift</option>
                                            <?php
                                                $shift = mysqli_query($conn, $employees->viewShifts());
                                                while ($shiftResult = mysqli_fetch_array($shift)) {
                                                ?>
                                                <option value="<?php echo $shiftResult['shiftID']; ?>">
                                                    <?php echo $shiftResult['startTime'] . ' - ' . $shiftResult['endTime']; ?>
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
                                        <input type="date" class="form-control" id="effectivityStartDate">
                                    </div>
                                </div>

                                <div class="row g-3 mb-2">
                                    <div class="col-12">
                                        <label for="effectivityEndDate">End Date</label>
                                    </div>
                                </div>

                                <div class="row g-3 mb-2">
                                    <div class="col-12">
                                        <input type="date" class="form-control" id="effectivityEndDate">
                                    </div>
                                </div>
                                
                                <div class="row g-3 mb-2">
                                    <div class="col-12">
                                        <label for="purpose">Purpose:</label>
                                    </div>
                                </div>

                                <div class="row g-3 mb-2">
                                    <div class="col-12">
                                        <textarea type="text" id="purpose" placeholder="Purpose" rows="3" class="form-control" required></textarea>
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
            <!------------------------------------------------------------ VIEW REQUEST ------------------------------------------------------------------->
            <div class="modal fade" id="viewRequestModal" tabindex="-1" aria-labelledby="viewLeaveLabel" aria-hidden="true">
                <div class="modal-dialog modal-none modal-dialog-centered modal-scrollable">
                    <div class="modal-content" id="viewRequestModal">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="viewLeaveLabel">View Change Shift</h1>
                            <input type="hidden" id="viewChangeShiftID">
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
                                        <label for="viewRequestedShift">Requested Shift</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <div class="col-12">
                                        <input type="text" class="form-control" id="viewRequestedShift" disabled>
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
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    
        <script src="../assets/js/user_changeShift.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>