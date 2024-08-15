<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- HEADER -->
        <?php include('../includes/header.php'); ?>
    </head>
    <body>
        <!-- SIDEBAR -->
        <?php include('../includes/sidebar.php'); ?>
        <?php include('../backend/team/processViewID.php'); ?>	
 
        <!-- MAIN CONTENT -->
        <main class="flex-1 p-3">
            <div class="flex flex-1 p-2 text-2xl font-bold items-center">
                <div class="mr-4">
                    Daily Time Records
                </div>   
                
                <!-- DATA RANGE DROPDOWN MENU -->
                <div class="relative inline-block text-right">
                    <select class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-2 py-2 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 focus:outline-none">
                        <option value="2024-01">January</option>
                        <option value="2024-02">February</option>
                        <option value="2024-03">March</option>
                        <option value="2024-04">April</option>
                        <option value="2024-05">May</option>
                        <option value="2024-06">June</option>
                        <option value="2024-07">July</option>
                        <option value="2024-08">August</option>
                        <option value="2024-09">September</option>
                        <option value="2024-10">October</option>
                        <option value="2024-11">November</option>
                        <option value="2024-12">December</option>
                    </select>
                </div>
            </div>
            
            <!-- CONTENT -->
            <div class="p-4 m-1 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">

                <!-- DATATABLE -->
                <div class="container mx-auto overflow-auto">
                    <table id="teamDTRTable" class="table table-striped table-bordered min-w-full divide-y divide-gray-200 text-center">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Employee ID</th>
                                <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Shift</th>
                                <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Days Worked</th>
                                <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Vacation Leave</th>
                                <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Sick Leave</th>
                                <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Absences</th>
                                <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Lates</th>
                                <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Undertime</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                    <?php
                        $year = date('Y');
                        $month = date('m');

                        // GET IT TEAM
                        $itTeamQuery = mysqli_query($conn, $attendance->viewITTeam());
                        while ($itTeamDetails = mysqli_fetch_array($itTeamQuery)) {

                            $teamIT_id = $itTeamDetails['id'];
                            $teamIT_employeeID = $itTeamDetails['employeeID'];
                            $teamIT_employeeName = $itTeamDetails['firstName'] . " " . $itTeamDetails['lastName'];
                            $teamIT_shift = $itTeamDetails['startTime'] . " - " . $itTeamDetails['endTime'];

                            // GET MONTHLY ATTENDANCE
                            $monthlyAttendanceQuery = mysqli_query($conn, $attendance->getMonthlyAttendance($itTeamDetails['id']));
                            $monthlyAttendance = mysqli_num_rows($monthlyAttendanceQuery);

                            // GET MONTHLY ABSENCES
                            $workingDays = $attendance->getWorkingDaysInMonth($year, $month);
                            $monthlyAbsences = $workingDays - $monthlyAttendance;

                            // GET MONTHLY LATES
                            $monthlyLatesQuery = mysqli_query($conn, $attendance->getMonthlyLates($itTeamDetails['id']));
                            $monthlyLates = mysqli_num_rows($monthlyLatesQuery);

                            // GET MONTHLY UNDERTIMES
                            $monthlyUndertimesQuery = mysqli_query($conn, $attendance->getMonthlyUndertimes($itTeamDetails['id']));
                            $monthlyUndertimes = mysqli_num_rows($monthlyUndertimesQuery); 
                            $availableSL = $itTeamDetails['availableSL']; 
                            $availableVL = $itTeamDetails['availableVL']; 
                    ?>
                            <tr data-id="<?php echo $teamIT_id ?>">
                                <td class="whitespace-nowrap"><?php echo $teamIT_employeeID ?></td>
                                <td class="whitespace-nowrap text-left"><?php echo $teamIT_employeeName ?></td>
                                <td class="whitespace-nowrap"><?php echo $teamIT_shift ?></td>
                                <td class="whitespace-nowrap"><?php echo $monthlyAttendance ?></td>
                                <td class="whitespace-nowrap"><?php echo $availableVL ?></td>
                                <td class="whitespace-nowrap"><?php echo $availableSL ?></td>
                                <td class="whitespace-nowrap"><?php echo $monthlyAbsences ?></td>
                                <td class="whitespace-nowrap"><?php echo $monthlyLates ?></td>
                                <td class="whitespace-nowrap"><?php echo $monthlyUndertimes; } ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            

            <!-- ======================================================================================================================================= -->
            <!-- ================================================================= MODAL =============================================================== -->
            <!-- ======================================================================================================================================= -->

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!--------------------------------------------------------------- VIEW TEAM MEMBER DTR -------------------------------------------------------->
            <div class="modal fade" id="viewTeamDTRModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                <div class="modal-dialog modal-none modal-xl modal-dialog-centered">
                    <div class="modal-content" id="viewTeamDTRModal">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="userFormLabel">View Team Member DTR</h1>
                            <input type="hidden" id="viewID">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-2 mb-2">
                                <div class="col-2">
                                    <label for="viewEmployeeID">Employee ID:</label>
                                </div>
                                <div class="col-3">
                                    <label for="viewEmployeeName">Name:</label>
                                </div>
                                <div class="col-4">
                                    <label for="viewEmailAddress">Email Address:</label>
                                </div>
                                <div class="col-3">
                                    <label for="viewShiftID">Shift:</label>
                                </div>
                            </div> 

                            <div class="row g-2 mb-4">
                                <div class="col-2">
                                    <input type="email" class="form-control" id="viewEmployeeID" disabled readonly>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="viewEmployeeName" disabled readonly>
                                </div>
                                <div class="col-4">
                                    <input type="email" class="form-control" id="viewEmailAddress" disabled readonly>
                                </div>
                                <div class="col-3">
                                    <input type="email" class="form-control" id="viewShiftID" disabled readonly>
                                </div>
                            </div>

                            <!-- <div class="row g-2 mb-2">
                                <div class="container mx-auto overflow-auto">
                                    <table id="attendanceTable" class="table table-auto table-striped table-bordered text-center">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="text-xs font-medium text-yellow-500 uppercase tracking-wider">Date</th>
                                                <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Log In</th>
                                                <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Log Out</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            < ?php
                                                $yearMonth = date('2024-07');
                                                globalVariable();

                                                $itTeamQuery = mysqli_query($conn, $employees->viewDTR($id));
                                                while ($itTeamDetails = mysqli_fetch_array($itTeamQuery)) {

                                                    // $teamIT_id = $itTeamDetails['id'];
                                                    $teamIT_attendanceDate = $itTeamDetails['attendanceDate'];
                                                    $teamIT_timeIn = $itTeamDetails['attendanceTime'];
                                                    $teamIT_timeOut = $itTeamDetails['attendanceTime'];
                                                    echo "<tr>"; 
                                                    ?>
                                                    
                                                    <td class="whitespace-nowrap text-left">< ?php echo $teamIT_attendanceDate ?></td>
                                                    <td class="whitespace-nowrap">< ?php echo $teamIT_timeIn ?></td>
                                                    <td class="whitespace-nowrap">< ?php echo $teamIT_timeOut ?></td>
                                                < ?php } ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div> -->
                        </div>

                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-primary employeeUpdate">Update</button> -->
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    
        <script src="../assets/js/team_dtr.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>