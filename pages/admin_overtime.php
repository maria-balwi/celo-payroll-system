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
                    Overtime
                </div>  

                <!-- DATA RANGE DROPDOWN MENU -->
                <!-- <div class="relative inline-block text-right">
                    <button id="dropdownButton" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-blue-500 hover:bg-gray-50 focus:outline-none">
                    Jun 15, 2024 - Jun 21, 2024
                    <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.23 8.29a.75.75 0 01.02-1.06z" clip-rule="evenodd"/>
                    </svg>
                    </button>
                    <div id="dropdownMenu" class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden">
                        <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Today</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Yesterday</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Last 7 days</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Last 30 days</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">This Month</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Last Month</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Custom Range</a>
                        </div>
                    </div>
                </div> -->
            </div>
            
            <!-- CONTENT -->
            <div class="p-4 m-1 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                
                <!-- DATATABLE -->
                <div class="mx-auto overflow-auto">
                    <table id="overtimeTable" class="table table-bordered table-striped min-w-full divide-y divide-gray-200 text-center pt-3">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Date Filed</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">OT Date</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">From</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">To</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Employee Name</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Purpose</th>
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

                                if ($_SESSION['departmentID'] == 3) {
                                    $filedOTquery = mysqli_query($conn, $employees->viewAdminFiledOT());
                                    while ($otDetails = mysqli_fetch_array($filedOTquery)) {

                                        $OT_id = $otDetails['requestID'];
                                        $OT_dateFiled = $otDetails['dateFiled'];
                                        $OT_otDate = $otDetails['otDate'];
                                        $OT_otType = $otDetails['otType'];
                                        $OT_fromTime = $otDetails['fromTime'];
                                        $OT_toTime = $otDetails['toTime'];
                                        $OT_employeeName = $otDetails['employeeName'];
                                        $OT_remarks = $otDetails['remarks'];
                                        $OT_status = $otDetails['status'];

                                        echo "<tr data-id='" . $OT_id . "' data-designation='" . $_SESSION['designationID'] . "' class='filedOTview cursor-pointer'>";
                                        echo "<td class = ' whitespace-nowrap'>" . $OT_dateFiled . "</td>";
                                        echo "<td class = ' whitespace-nowrap'>" . $OT_otDate . "</td>";
                                        echo "<td class = ' whitespace-nowrap'>" . $OT_otType . "</td>";
                                        echo "<td class = ' whitespace-nowrap'>" . $OT_fromTime . "</td>";
                                        echo "<td class = ' whitespace-nowrap'>" . $OT_toTime . "</td>";
                                        echo "<td class = ' whitespace-nowrap'>" . $OT_employeeName . "</td>";
                                        echo "<td class = ' whitespace-nowrap'>" . $OT_remarks . "</td>";
                                        if ($OT_status == null) {
                                            echo "<td><p class='inline-block bg-yellow-500 text-white px-3 py-1 my-auto rounded-full text-sm'>Pending</p></td>";
                                        }
                                        else if ($OT_status == 1) {
                                            echo "<td><p class='inline-block bg-green-500 text-white px-3 py-1 my-auto rounded-full text-sm'>Approved</p></td>";
                                        }
                                        else if ($OT_status == 0) {
                                            echo "<td><p class='inline-block bg-red-500 text-white px-3 py-1 my-auto rounded-full text-sm'>Disapproved</p></td>";
                                        }
                                        // if ($OT_status == null) {
                                        //     echo "<td><p class='inline-block bg-yellow-500 text-white px-3 py-1 my-auto rounded-full text-sm'>Pending for 1st Approval</p></td>";
                                        // }
                                        // else if ($OT_status == 1) {
                                        //     echo "<td><p class='inline-block bg-yellow-500 text-white px-3 py-1 my-auto rounded-full text-sm'>Pending for 2nd Approval</p></td>";
                                        // }
                                        // else if ($OT_status == 2) {
                                        //     echo "<td><p class='inline-block bg-green-500 text-white px-3 py-1 my-auto rounded-full text-sm'>Approved</p></td>";
                                        // }
                                        // else if ($OT_status == 0) {
                                        //     echo "<td><p class='inline-block bg-red-500 text-white px-3 py-1 my-auto rounded-full text-sm'>Disapproved</p></td>";
                                        // }
                                    }
                                }
                                else if ($_SESSION['departmentID'] == 5){
                                    $filedOTquery = mysqli_query($conn, $employees->viewDirectorFiledOT());
                                    while ($otDetails = mysqli_fetch_array($filedOTquery)) {

                                        $OT_id = $otDetails['requestID'];
                                        $OT_dateFiled = $otDetails['dateFiled'];
                                        $OT_otDate = $otDetails['otDate'];
                                        $OT_otType = $otDetails['otType'];
                                        $OT_fromTime = $otDetails['fromTime'];
                                        $OT_toTime = $otDetails['toTime'];
                                        $OT_employeeName = $otDetails['employeeName'];
                                        $OT_remarks = $otDetails['remarks'];
                                        $OT_status = $otDetails['status'];

                                        echo "<tr data-id='" . $OT_id . "' class='filedOTview cursor-pointer'>";
                                        echo "<td class = ' whitespace-nowrap'>" . $OT_dateFiled . "</td>";
                                        echo "<td class = ' whitespace-nowrap'>" . $OT_otDate . "</td>";
                                        echo "<td class = ' whitespace-nowrap'>" . $OT_otType . "</td>";
                                        echo "<td class = ' whitespace-nowrap'>" . $OT_fromTime . "</td>";
                                        echo "<td class = ' whitespace-nowrap'>" . $OT_toTime . "</td>";
                                        echo "<td class = ' whitespace-nowrap'>" . $OT_employeeName . "</td>";
                                        echo "<td class = ' whitespace-nowrap'>" . $OT_remarks . "</td>";
                                        if ($OT_status == null) {
                                            echo "<td><p class='inline-block bg-yellow-500 text-white px-3 py-1 my-auto rounded-full text-sm'>Pending</p></td>";
                                        }
                                        else if ($OT_status == 1) {
                                            echo "<td><p class='inline-block bg-green-500 text-white px-3 py-1 my-auto rounded-full text-sm'>Approved</p></td>";
                                        }
                                        else if ($OT_status == 0) {
                                            echo "<td><p class='inline-block bg-red-500 text-white px-3 py-1 my-auto rounded-full text-sm'>Disapproved</p></td>";
                                        }
                                    }
                                }
                                else {
                                    $filedOTquery = mysqli_query($conn, $employees->viewAllFiledOT());
                                    while ($otDetails = mysqli_fetch_array($filedOTquery)) {

                                        $OT_id = $otDetails['requestID'];
                                        $OT_dateFiled = $otDetails['dateFiled'];
                                        $OT_otDate = $otDetails['otDate'];
                                        $OT_otType = $otDetails['otType'];
                                        $OT_fromTime = $otDetails['fromTime'];
                                        $OT_toTime = $otDetails['toTime'];
                                        $OT_employeeName = $otDetails['employeeName'];
                                        $OT_remarks = $otDetails['remarks'];
                                        $OT_status = $otDetails['status'];

                                        echo "<tr data-id='" . $OT_id . "' class='filedOTview cursor-pointer'>";
                                        echo "<td class = ' whitespace-nowrap'>" . $OT_dateFiled . "</td>";
                                        echo "<td class = ' whitespace-nowrap'>" . $OT_otDate . "</td>";
                                        echo "<td class = ' whitespace-nowrap'>" . $OT_otType . "</td>";
                                        echo "<td class = ' whitespace-nowrap'>" . $OT_fromTime . "</td>";
                                        echo "<td class = ' whitespace-nowrap'>" . $OT_toTime . "</td>";
                                        echo "<td class = ' whitespace-nowrap'>" . $OT_employeeName . "</td>";
                                        echo "<td class = ' whitespace-nowrap'>" . $OT_remarks . "</td>";
                                        if ($OT_status == null) {
                                            echo "<td><p class='inline-block bg-yellow-500 text-white px-3 py-1 my-auto rounded-full text-sm'>Pending</p></td>";
                                        }
                                        else if ($OT_status == 1) {
                                            echo "<td><p class='inline-block bg-green-500 text-white px-3 py-1 my-auto rounded-full text-sm'>Approved</p></td>";
                                        }
                                        else if ($OT_status == 0) {
                                            echo "<td><p class='inline-block bg-red-500 text-white px-3 py-1 my-auto rounded-full text-sm'>Disapproved</p></td>";
                                        }
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
            <!--------------------------------------------------------------- VIEW FILED OT --------------------------------------------------------------->
            <div class="modal fade" id="viewFiledOTModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                <div class="modal-dialog modal-none modal-dialog-centered">
                    <div class="modal-content" id="viewFiledOTModal">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="userFormLabel">View Filed OT</h1>
                            <input type="hidden" id="viewFiledOTID">
                            <input type="hidden" id="userDept" value="<?php echo $_SESSION['departmentID']; ?>">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3 mb-1">
                                <div class="col-6">
                                        <label for="viewDateFiled">Date Filed:</label>
                                    </div>    
                                <div class="col-6">
                                    <label for="viewStatus">Status:</label>
                                </div>
                            </div>
                
                            <div class="row g-3 mb-2">
                                <div class="col-6">
                                    <input type="text" class="form-control" id="viewDateFiled" disabled readonly>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" id="viewStatus" name="viewStatus" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-3 mb-1">
                                <div class="col-6">
                                    <label for="viewOTDate">OT Date:</label>
                                </div>
                                <div class="col-6">
                                    <label for="viewName">Employee Name:</label>
                                </div>
                            </div>

                            <div class="row g-3 mb-2">
                                <div class="col-6">
                                    <input type="text" class="form-control" id="viewOTDate" name="viewOTDate" disabled readonly>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" id="viewName" name="viewName" disabled readonly>
                                </div>
                            </div>   
                                
                            <div class="row g-3 mb-1">
                                <div class="col-6">
                                    <label for="viewFromTime">From:</label>
                                </div>
                                <div class="col-6">
                                    <label for="viewToTime">To:</label>
                                </div>
                                </div>
                
                            <div class="row g-3 mb-2">
                                <div class="col-6">
                                    <input type="text" class="form-control" id="viewFromTime" name="viewFromTime" disabled readonly>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" id="viewToTime" name="viewToTime" disabled readonly>
                                </div>  
                            </div>

                            <div class="row g-3 mb-1" id="approvedLabelRow">
                                <div class="col-6">
                                    <label for="viewOTType">Type:</label>
                                </div>
                            </div>
                
                            <div class="row g-3 mb-2" id="approvedInputRow">
                                <div class="col-6">
                                    <input type="text" class="form-control" id="viewOTType" name="viewOTType" disabled readonly>
                                </div>
                            </div>
                            
                            <div class="row g-3 mb-1">
                                <div class="col-12">
                                    <label for="viewPurpose">Purpose:</label>
                                </div>
                            </div>

                            <div class="row g-3 mb-2">
                                <div class="col-12">
                                    <textarea type="text" id="viewPurpose" name="viewPurpose" placeholder="Purpose" rows="3" class="form-control" disabled readonly></textarea>
                                </div>
                            </div>                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success approveOT" id="approveOT">Approve</button>
                            <button type="button" class="btn btn-danger disapproveOT" id="disapproveOT">Disapprove</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnClose">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    
        <script src="../assets/js/admin_overtime.js?v=<?php echo $version; ?>"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>