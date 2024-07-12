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
                <div class="container mx-auto overflow-auto">
                    <table id="teamTable" class="table min-w-full divide-y divide-gray-200 table-striped table-bordered">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Number</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php
                                $teamQuery = mysqli_query($conn, $employees->viewTeam());
                                while ($teamDetails = mysqli_fetch_array($teamQuery)) {

                                    $team_id = $teamDetails['id'];
                                    $team_employeeName = $teamDetails['employeeName'];
                                    $team_emailAddress = $teamDetails['emailAddress'];
                                    $team_mobileNumber = $teamDetails['mobileNumber'];
                                    $team_department = $teamDetails['departmentName'];


                                    echo "<tr data-id='" . $team_id . "' class='teamView'>";
                                    echo "<td ='px-6 whitespace-nowrap'>" . $team_employeeName . "</td>";
                                    echo "<td ='px-6 whitespace-nowrap'>" . $team_emailAddress . "</td>";
                                    echo "<td ='px-6 whitespace-nowrap'>" . $team_mobileNumber . "</td>";
                                    echo "<td ='px-6 whitespace-nowrap'>" . $team_department . "</td>";
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
            <!------------------------------------------------------------------ VIEW EMPLOYEE FORM ------------------------------------------------------->
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
                        </div>

                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-primary employeeUpdate">Update</button> -->
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    
        <script src="../assets/js/team.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>