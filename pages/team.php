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
                    My Team
                </div>    
            </div>
            
            <!-- CONTENT -->
            <div class="p-4 m-1 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                
                <!-- DATATABLE -->
                <div class="mx-auto overflow-auto">
                    <table id="teamTable" class="table min-w-full divide-y divide-gray-200 table-striped table-bordered text-center pt-3">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Number</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php
                                if ($_SESSION['departmentID'] == 1) 
                                {
                                    // OPERATIONS TEAM
                                    $teamQuery = mysqli_query($conn, $employees->viewTeamOperations());
                                    while ($teamDetails = mysqli_fetch_array($teamQuery)) {

                                        $team_id = $teamDetails['id'];
                                        $team_employeeName = $teamDetails['firstName'] . " " . $teamDetails['lastName'];
                                        $team_emailAddress = $teamDetails['emailAddress'];
                                        $team_mobileNumber = $teamDetails['mobileNumber'];
                                        $team_department = $teamDetails['departmentName'];


                                        echo "<tr data-id='" . $team_id . "' class='teamView cursor-pointer'>";
                                        echo "<td class = ' whitespace-nowrap'>" . $team_employeeName . "</td>";
                                        echo "<td class = ' whitespace-nowrap'>" . $team_emailAddress . "</td>";
                                        echo "<td class = ' whitespace-nowrap'>" . $team_mobileNumber . "</td>";
                                        echo "<td class = ' whitespace-nowrap'>" . $team_department . "</td>";
                                        echo "</tr>";
                                    }
                                }
                                else 
                                {
                                    // IT TEAM
                                    $teamQuery = mysqli_query($conn, $employees->viewTeamIT());
                                    while ($teamDetails = mysqli_fetch_array($teamQuery)) {

                                        $team_id = $teamDetails['id'];
                                        $team_employeeName = $teamDetails['firstName'] . " " . $teamDetails['lastName'];
                                        $team_emailAddress = $teamDetails['emailAddress'];
                                        $team_mobileNumber = $teamDetails['mobileNumber'];
                                        $team_department = $teamDetails['departmentName'];


                                        echo "<tr data-id='" . $team_id . "' class='teamView cursor-pointer'>";
                                        echo "<td class = ' whitespace-nowrap'>" . $team_employeeName . "</td>";
                                        echo "<td class = ' whitespace-nowrap'>" . $team_emailAddress . "</td>";
                                        echo "<td class = ' whitespace-nowrap'>" . $team_mobileNumber . "</td>";
                                        echo "<td class = ' whitespace-nowrap'>" . $team_department . "</td>";
                                        echo "</tr>";
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
            <!-------------------------------------------------------------------- VIEW TEAM FORM --------------------------------------------------------->
            <div class="modal fade" id="viewTeamModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                <div class="modal-dialog modal-none modal-dialog-centered">
                    <div class="modal-content" id="viewTeamModal">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="userFormLabel">View Team</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-1 mb-2">
                                <div class="col-4">
                                    <label for="viewEmployeeName">Name:</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="viewEmployeeName" disabled readonly>
                                </div>
                            </div> 

                            <div class="row g-1 mb-2">
                                <div class="col-4">
                                    <label for="viewEmailAddress">Email Address:</label>
                                </div>
                                <div class="col-8">
                                    <input type="email" class="form-control" id="viewEmailAddress" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-1 mb-2">
                                <div class="col-4">
                                    <label for="viewEmployeeID">Employee ID:</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="viewEmployeeID" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-1 mb-2">
                                <div class="col-4">
                                    <label for="viewMobileNumber">Mobile Number:</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="viewMobileNumber" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-1 mb-2">
                                <div class="col-4">
                                    <label for="viewDepartment">Department:</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="viewDepartment" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-1 mb-2">
                                <div class="col-4">
                                    <label for="viewDesignation">Designation:</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="viewDesignation" disabled readonly>
                                </div>
                            </div>
                        
                            <div class="row g-1 mb-2">
                                <div class="col-4">
                                    <label for="viewShiftID">Shift:</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="viewShiftID" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-1 mb-2">
                                <div class="col-4">
                                    <label for="viewWeekOff">Week Off:</label>
                                </div>
                                <div class="col-8">
                                    <!-- <input type="text" class="form-control" id="viewWeekOff" disabled readonly> -->
                                    <div class="col-12">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="view_wo_monday" name="view_wo_monday" value="view_wo_monday" disabled readonly>
                                            <label class="form-check-label" for="view_wo_monday">Mon</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="view_wo_tuesday" name="view_wo_tuesday" value="view_wo_tuesday" disabled readonly>
                                            <label class="form-check-label" for="view_wo_tuesday">Tue</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="view_wo_wednesday" name="view_wo_wednesday" value="view_wo_wednesday" disabled readonly>
                                            <label class="form-check-label" for="view_wo_wednesday">Wed</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="view_wo_thursday" name="view_wo_thursday" value="view_wo_thursday" disabled readonly>
                                            <label class="form-check-label" for="view_wo_thursday">Thu</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="view_wo_friday" name="view_wo_friday" value="view_wo_friday" disabled readonly>
                                            <label class="form-check-label mr-3.5" for="view_wo_friday">Fri</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="view_wo_saturday" name="view_wo_saturday" value="view_wo_saturday" disabled readonly>
                                            <label class="form-check-label mr-1" for="view_wo_saturday">Sat</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="view_wo_sunday" name="view_wo_sunday" value="view_wo_sunday" disabled readonly>
                                            <label class="form-check-label" for="view_wo_sunday">Sun</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary teamUpdate" id="btnUpdateTeam">Update</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnClose">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!------------------------------------------------------------------- UPDATE TEAM FORM -------------------------------------------------------->
            <form id="updateTeamForm" enctype="multipart/form-data">
                <div class="modal fade" id="updateTeamModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                    <div class="modal-dialog modal-none modal-dialog-centered">
                        <div class="modal-content" id="updateTeamModal">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="userFormLabel">Update Team</h1>
                            <input type="hidden" id="updateID" name="updateID">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-1 mb-2">
                                <div class="col-4">
                                    <label for="updateEmployeeName">Name:</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="updateEmployeeName" disabled readonly>
                                </div>
                            </div> 

                            <div class="row g-1 mb-2">
                                <div class="col-4">
                                    <label for="updateEmailAddress">Email Address:</label>
                                </div>
                                <div class="col-8">
                                    <input type="email" class="form-control" id="updateEmailAddress" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-1 mb-2">
                                <div class="col-4">
                                    <label for="updateEmployeeID">Employee ID:</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="updateEmployeeID" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-1 mb-2">
                                <div class="col-4">
                                    <label for="updateMobileNumber">Mobile Number:</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="updateMobileNumber" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-1 mb-2">
                                <div class="col-4">
                                    <label for="updateDepartment">Department:</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="updateDepartment" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-1 mb-2">
                                <div class="col-4">
                                    <label for="updateDesignation">Designation:</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="updateDesignation" disabled readonly>
                                </div>
                            </div>
                        
                            <div class="row g-1 mb-2">
                                <div class="col-4">
                                    <label for="updateShiftID">Shift:</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="updateShiftID" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-1 mb-2">
                                <div class="col-4">
                                    <label for="updateWeekOff">Week Off:</label>
                                </div>
                                <div class="col-8">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input update_wo_day" type="checkbox" id="update_wo_mon" name="update_wo_mon" value="update_wo_mon">
                                        <label class="form-check-label" for="update_wo_mon">Mon</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input update_wo_day" type="checkbox" id="update_wo_tue" name="update_wo_tue" value="update_wo_tue">
                                        <label class="form-check-label" for="update_wo_tue">Tue</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input update_wo_day" type="checkbox" id="update_wo_wed" name="update_wo_wed" value="update_wo_wed">
                                        <label class="form-check-label" for="update_wo_wed">Wed</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input update_wo_day" type="checkbox" id="update_wo_thu" name="update_wo_thu" value="update_wo_thu">
                                        <label class="form-check-label" for="update_wo_thu">Thu</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input update_wo_day" type="checkbox" id="update_wo_fri" name="update_wo_fri" value="update_wo_fri">
                                        <label class="form-check-label" for="update_wo_fri">Fri</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input update_wo_day" type="checkbox" id="update_wo_sat" name="update_wo_sat" value="update_wo_sat">
                                        <label class="form-check-label" for="update_wo_sat">Sat</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input update_wo_day" type="checkbox" id="update_wo_sun" name="update_wo_sun" value="update_wo_sun">
                                        <label class="form-check-label" for="update_wo_sun">Sun</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Save Changes</button>
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#viewTeamModal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    
        <script src="../assets/js/team.js?v=<?php echo $version; ?>"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>