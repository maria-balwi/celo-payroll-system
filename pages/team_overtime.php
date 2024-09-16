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
            </div>
            
            <!-- CONTENT -->
            <div class="p-4 m-1 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                
                <!-- DATATABLE -->
                <div class="mx-auto overflow-auto">
                    <table id="overtimeTable" class="table table-bordered table-striped min-w-full divide-y divide-gray-200 text-center pt-3">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider" rowspan="2">Date Filed</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider" rowspan="2">Employee</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider" rowspan="2">Date</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider" colspan="2">Actual OT</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider" colspan="2">Approved OT</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider" rowspan="2">Purpose</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider" rowspan="2">Status</th>
                            </tr>
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Time Range</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Minutes</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Time Range</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Minutes</th>
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

                                if ($_SESSION['departmentID'] == 1) 
                                {
                                    $filedOTquery = mysqli_query($conn, $employees->viewTeamOperationsFiledOT());
                                    while ($otDetails = mysqli_fetch_array($filedOTquery)) {

                                        $OT_id = $otDetails['requestID'];
                                        $OT_employeeName = $otDetails['employeeName'];
                                        $OT_dateFiled = $otDetails['dateFiled'];
                                        $OT_otDate = $otDetails['otDate'];
                                        $OT_actualOThours = $otDetails['actualOThours'];
                                        $OT_actualOTmins = $otDetails['actualOTmins'];
                                        $OT_approvedOThours = $otDetails['approvedOThours'];
                                        $OT_approvedOTmins = $otDetails['approvedOTmins'];
                                        $OT_remarks = $otDetails['remarks'];
                                        $OT_status = $otDetails['status'];

                                        $OT_dateFiled = formatDate($OT_dateFiled);
                                        $OT_otDate = formatDate($OT_otDate);

                                        echo "<tr data-id='" . $OT_id . "' class='filedOTview cursor-pointer'>";
                                        echo "<td class = ' whitespace-nowrap'>" . $OT_dateFiled . "</td>";
                                        echo "<td class = ' whitespace-nowrap'>" . $OT_employeeName . "</td>";
                                        echo "<td class = ' whitespace-nowrap'>" . $OT_otDate . "</td>";
                                        echo "<td class = ' whitespace-nowrap'>" . $OT_actualOThours . "</td>";
                                        
                                        if ($OT_actualOTmins == 0) {
                                            echo "<td class = ' whitespace-nowrap'>-</td>";
                                        }
                                        else {
                                            echo "<td class = ' whitespace-nowrap'>" . $OT_actualOTmins . "</td>";
                                        }

                                        if ($OT_status == "Pending") {
                                            echo "<td class = ' whitespace-nowrap'>-</td>";
                                            echo "<td class = ' whitespace-nowrap'>-</td>";
                                            echo "<td class = ' whitespace-nowrap'>" . $OT_remarks . "</td>";
                                            echo "<td><p class='inline-block bg-yellow-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $OT_status . "</p></td>";
                                        }
                                        else if ($OT_status == "Approved") {
                                            echo "<td class = ' whitespace-nowrap'>" . $OT_approvedOThours . "</td>";
                                            if ($OT_approvedOTmins == 0) {
                                                echo "<td class = ' whitespace-nowrap'>-</td>";
                                            }
                                            else {
                                                echo "<td class = ' whitespace-nowrap'>" . $OT_approvedOTmins . "</td>";
                                            }
                                            echo "<td class = ' whitespace-nowrap'>" . $OT_remarks . "</td>";
                                            echo "<td><p class='inline-block bg-green-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $OT_status . "</p></td>";
                                        }
                                        else if ($OT_status == "Disapproved") {
                                            echo "<td class = ' whitespace-nowrap'>-</td>";
                                            echo "<td class = ' whitespace-nowrap'>-</td>";
                                            echo "<td class = ' whitespace-nowrap'>" . $OT_remarks . "</td>";
                                            echo "<td><p class='inline-block bg-red-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $OT_status . "</p></td>";
                                        }
                                        echo "</td>";
                                    }
                                }
                                else 
                                {
                                    $filedOTquery = mysqli_query($conn, $employees->viewTeamITFiledOT());
                                    while ($otDetails = mysqli_fetch_array($filedOTquery)) {

                                        $OT_id = $otDetails['requestID'];
                                        $OT_employeeName = $otDetails['employeeName'];
                                        $OT_dateFiled = $otDetails['dateFiled'];
                                        $OT_otDate = $otDetails['otDate'];
                                        $OT_actualOThours = $otDetails['actualOThours'];
                                        $OT_actualOTmins = $otDetails['actualOTmins'];
                                        $OT_approvedOThours = $otDetails['approvedOThours'];
                                        $OT_approvedOTmins = $otDetails['approvedOTmins'];
                                        $OT_remarks = $otDetails['remarks'];
                                        $OT_status = $otDetails['status'];

                                        $OT_dateFiled = formatDate($OT_dateFiled);
                                        $OT_otDate = formatDate($OT_otDate);

                                        echo "<tr data-id='" . $OT_id . "' class='filedOTview cursor-pointer'>";
                                        echo "<td class = ' whitespace-nowrap'>" . $OT_dateFiled . "</td>";
                                        echo "<td class = ' whitespace-nowrap'>" . $OT_employeeName . "</td>";
                                        echo "<td class = ' whitespace-nowrap'>" . $OT_otDate . "</td>";
                                        echo "<td class = ' whitespace-nowrap'>" . $OT_actualOThours . "</td>";
                                        
                                        if ($OT_actualOTmins == 0) {
                                            echo "<td class = ' whitespace-nowrap'>-</td>";
                                        }
                                        else {
                                            echo "<td class = ' whitespace-nowrap'>" . $OT_actualOTmins . "</td>";
                                        }

                                        if ($OT_status == "Pending") {
                                            echo "<td class = ' whitespace-nowrap'>-</td>";
                                            echo "<td class = ' whitespace-nowrap'>-</td>";
                                            echo "<td class = ' whitespace-nowrap'>" . $OT_remarks . "</td>";
                                            echo "<td><p class='inline-block bg-yellow-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $OT_status . "</p></td>";
                                        }
                                        else if ($OT_status == "Approved") {
                                            echo "<td class = ' whitespace-nowrap'>" . $OT_approvedOThours . "</td>";
                                            if ($OT_approvedOTmins == 0) {
                                                echo "<td class = ' whitespace-nowrap'>-</td>";
                                            }
                                            else {
                                                echo "<td class = ' whitespace-nowrap'>" . $OT_approvedOTmins . "</td>";
                                            }
                                            echo "<td class = ' whitespace-nowrap'>" . $OT_remarks . "</td>";
                                            echo "<td><p class='inline-block bg-green-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $OT_status . "</p></td>";
                                        }
                                        else if ($OT_status == "Disapproved") {
                                            echo "<td class = ' whitespace-nowrap'>-</td>";
                                            echo "<td class = ' whitespace-nowrap'>-</td>";
                                            echo "<td class = ' whitespace-nowrap'>" . $OT_remarks . "</td>";
                                            echo "<td><p class='inline-block bg-red-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $OT_status . "</p></td>";
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
            <!--------------------------------------------------------------- VIEW FILED OT --------------------------------------------------------------->
            <div class="modal fade" id="viewFiledOTModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                <div class="modal-dialog modal-none modal-dialog-centered">
                    <div class="modal-content" id="viewFiledOTModal">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="userFormLabel">View Filed OT</h1>
                            <input type="hidden" id="viewFiledOTID">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3 mb-2">
                                <div class="col-6">
                                    <label for="viewStatus">Status:</label>
                                </div>
                            </div>

                            <div class="row g-3 mb-2">
                                <div class="col-6">
                                    <input type="text" class="form-control" id="viewStatus" name="viewStatus" disabled readonly>
                                </div>
                            </div>   

                            <div class="row g-3 mb-2">
                                <div class="col-6">
                                    <label for="viewDateFiled">Date Filed:</label>
                                </div>
                                <div class="col-6">
                                    <label for="viewOTDate">OT Date:</label>
                                </div>
                            </div>

                            <div class="row g-3 mb-2">
                                <div class="col-6">
                                    <input type="text" class="form-control" id="viewDateFiled" disabled readonly>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" id="viewOTDate" name="viewOTDate" disabled readonly>
                                </div>
                            </div>   
                                
                            <div class="row g-3 mb-2">
                                <div class="col-6">
                                    <label for="viewActualOTHours">Actual OT - Hours</label>
                                </div>
                                <div class="col-6">
                                    <label for="viewActualOTMins">Actual OT - Minutes</label>
                                </div>
                                </div>
                
                            <div class="row g-3 mb-2">
                                <div class="col-6">
                                    <input type="text" class="form-control" id="viewActualOTHours" name="viewActualOTHours" disabled readonly>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" id="viewActualOTMins" name="viewActualOTMins" disabled readonly>
                                </div>  
                            </div>

                            <div class="row g-3 mb-2" id="approvedLabelRow">
                                <div class="col-6">
                                    <label for="viewApprovedOTHours">Approved OT - Hours</label>
                                </div>
                                <div class="col-6">
                                    <label for="viewApprovedOTMins">Approved OT - Minutes</label>
                                </div>
                            </div>
                
                            <div class="row g-3 mb-2" id="approvedInputRow">
                                <div class="col-6">
                                    <input type="text" class="form-control" id="viewApprovedOTHours" name="viewApprovedOTHours" disabled readonly>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" id="viewApprovedOTMins" name="viewApprovedOTMins" disabled readonly>
                                </div>  
                            </div>
                            
                            <div class="row g-3 mb-2">
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
    
        <script src="../assets/js/team_overtime.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>