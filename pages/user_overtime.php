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
                    Overtimes
                </div>    

                <!-- REQUEST SHIFT CHANGE BUTTON -->
                <div class="static inline-block text-right">
                    <button class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none" data-bs-toggle="modal" data-bs-target="#fileOTmodal">
                    File Overtime
                    </button>
                </div>
            </div>
            
            <!-- CONTENT -->
            <div class="p-4 m-1 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                <!-- DATA TABLE -->
                <div class="container mx-auto overflow-auto">
                    <table id="overtimeTable" class="table table-bordered table-striped min-w-full divide-y divide-gray-200 text-center">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider" rowspan="2">Date Filed</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider" rowspan="2">OT Date</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider" colspan="2">Actual OT</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider" colspan="2">Approved OT</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider" rowspan="2">Purpose</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider" rowspan="2">Status</th>
                            </tr>
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Hours</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Minutes</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Hours</th>
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

                                $filedOTquery = mysqli_query($conn, $employees->viewFiledOT($_SESSION['id']));
                                while ($otDetails = mysqli_fetch_array($filedOTquery)) {

                                    $OT_id = $otDetails['requestID'];
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
                                    echo "<td ='px-6 whitespace-nowrap'>" . $OT_dateFiled . "</td>";
                                    echo "<td ='px-6 whitespace-nowrap'>" . $OT_otDate . "</td>";
                                    echo "<td ='px-6 whitespace-nowrap'>" . $OT_actualOThours . "</td>";
                                    
                                    if ($OT_actualOTmins == 0) {
                                        echo "<td ='px-6 whitespace-nowrap'>-</td>";
                                    }
                                    else {
                                        echo "<td ='px-6 whitespace-nowrap'>" . $OT_actualOTmins . "</td>";
                                    }

                                    if ($OT_status == "Pending") {
                                        echo "<td ='px-6 whitespace-nowrap'>-</td>";
                                        echo "<td ='px-6 whitespace-nowrap'>-</td>";
                                        echo "<td ='px-6 whitespace-nowrap'>" . $OT_remarks . "</td>";
                                        echo "<td><p class='inline-block bg-yellow-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $OT_status . "</p></td>";
                                    }
                                    else if ($OT_status == "Approved") {
                                        echo "<td ='px-6 whitespace-nowrap'>" . $OT_approvedOThours . "</td>";
                                        if ($OT_approvedOTmins == 0) {
                                            echo "<td ='px-6 whitespace-nowrap'>-</td>";
                                        }
                                        else {
                                            echo "<td ='px-6 whitespace-nowrap'>" . $OT_approvedOTmins . "</td>";
                                        }
                                        echo "<td ='px-6 whitespace-nowrap'>" . $OT_remarks . "</td>";
                                        echo "<td><p class='inline-block bg-green-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $OT_status . "</p></td>";
                                    }
                                    else if ($OT_status == "Disapproved") {
                                        echo "<td ='px-6 whitespace-nowrap'>-</td>";
                                        echo "<td ='px-6 whitespace-nowrap'>-</td>";
                                        echo "<td ='px-6 whitespace-nowrap'>" . $OT_remarks . "</td>";
                                        echo "<td><p class='inline-block bg-red-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $OT_status . "</p></td>";
                                    }
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
            <!---------------------------------------------------------------- FILE OVERTIME -------------------------------------------------------------->
            <form id="fileOTform">
                <div class="modal fade" id="fileOTmodal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                    <div class="modal-dialog modal-none modal-dialog-centered">
                        <div class="modal-content" id="fileOTmodal">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="userFormLabel">File Overtime</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3 mb-2">
                                    <div class="col-6">
                                        <label for="dateFiled">Date Filed:</label>
                                    </div>
                                    <div class="col-6">
                                        <label for="otDate">OT Date:</label>
                                    </div>
                                </div>

                                <div class="row g-3 mb-2">
                                    <div class="col-6">
                                        <input type="text" class="form-control" id="dateFiled" value="<?php echo date("M d, Y") ?>" disabled readonly>
                                    </div>
                                    <div class="col-6">
                                        <input type="date" class="form-control" id="otDate" name="otDate">
                                    </div>
                                </div>   
                                
                                <div class="row g-3 mb-2">
                                    <div class="col-6">
                                        <label for="actualOThours">Actual OT - Hours</label>
                                    </div>
                                    <div class="col-6">
                                        <label for="actualOTmins">Actual OT - Minutes</label>
                                    </div>
                                </div>

                                <div class="row g-3 mb-2">
                                    <div class="col-6">
                                        <input type="number" class="form-control" id="actualOThour" name="actualOThours">
                                    </div>
                                    <div class="col-6">
                                        <input type="number" class="form-control" id="actualOTmins" name="actualOTmins">
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
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    
        <script src="../assets/js/user_overtime.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>