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
                <div>
                    Daily Time Records
                </div>   
                    
                <div class="static inline-block text-right ml-3">
                    <select id="filterYear" class="form-select inline-flex justify-center rounded-md border border-gray-300 shadow-sm pr-4 bg-white text-sm font-medium text-gray-700">
                        <option disabled selected><?php echo date('Y'); ?></option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                    </select>
                </div>

                <div class="static inline-block text-right ml-1 mr-1">
                    <select id="filterMonth" class="form-select inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-6 bg-white text-sm font-medium text-gray-700">
                        <option disabled selected><?php echo date('F'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="01">January</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="02">February</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="03">March</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="04">April</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="05">May</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="06">June</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="07">July</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="08">August</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="09">September</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="10">October</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="11">November</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="12">December</option>
                    </select>
                </div>
            </div>
            
            <!-- CONTENT -->
            <div class="p-4 m-1 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                <!-- DATATABLE -->
                <div class="mx-auto overflow-auto">
                    <table id="teamDTRTable" class="table table-striped table-bordered min-w-full divide-y divide-gray-200 text-center pt-3">
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
                            if ($_SESSION['departmentID'] == 1) // GET OPERATIONS TEAM
                            {
                                if ($_SESSION['designationID'] == 5) {
                                    $operationsTeamQuery = mysqli_query($conn, $attendance->viewOperationsTeamManager());
                                    while ($operationsTeamDetails = mysqli_fetch_array($operationsTeamQuery)) {

                                        $teamOperations_id = $operationsTeamDetails['id'];
                                        $teamOperations_employeeID = $operationsTeamDetails['employeeID'];
                                        $teamOperations_employeeName = $operationsTeamDetails['firstName'] . " " . $operationsTeamDetails['lastName'];
                                        $teamOperations_shift = $operationsTeamDetails['startTime'] . " - " . $operationsTeamDetails['endTime'];
                                        $availableSL = $operationsTeamDetails['availableSL']; 
                                        $availableVL = $operationsTeamDetails['availableVL']; 

                                        $year = date('Y');
                                        $month = date('m');

                                        // GET MONTHLY ATTENDANCE
                                        $monthlyAttendanceQuery = mysqli_query($conn, $attendance->getMonthlyAttendance($teamOperations_id, $year, $month));
                                        // $monthlyAttendance = round(mysqli_num_rows($monthlyAttendanceQuery) / 2);
                                        $monthlyAttendance = mysqli_num_rows($monthlyAttendanceQuery);

                                        // GET MONTHLY ABSENCES
                                        $workingDays = $attendance->getWorkingDaysInMonth($year, $month);
                                        $monthlyAbsences = $workingDays - $monthlyAttendance;

                                        // GET MONTHLY LATES
                                        $monthlyLatesQuery = mysqli_query($conn, $attendance->getMonthlyLates($teamOperations_id, $year, $month));
                                        $monthlyLates = mysqli_num_rows($monthlyLatesQuery);

                                        // GET MONTHLY UNDERTIMES
                                        $monthlyUndertimesQuery = mysqli_query($conn, $attendance->getMonthlyUndertimes($teamOperations_id, $year, $month));
                                        $monthlyUndertimes = mysqli_num_rows($monthlyUndertimesQuery); 

                                        echo "<tr data-id='" . $teamOperations_id . "' class='teamDTRview cursor-pointer'>";
                                        echo "<td class='whitespace-nowrap'>" . $teamOperations_employeeID . "</td>";
                                        echo "<td class='whitespace-nowrap text-left'>" . $teamOperations_employeeName . "</td>";
                                        echo "<td class='whitespace-nowrap'>" . $teamOperations_shift . "</td>";
                                        echo "<td class='whitespace-nowrap'>" . $monthlyAttendance . "</td>";
                                        echo "<td class='whitespace-nowrap'>" . $availableVL . "</td>";
                                        echo "<td class='whitespace-nowrap'>" . $availableSL . "</td>";
                                        echo "<td class='whitespace-nowrap'>" . $monthlyAbsences . "</td>";
                                        echo "<td class='whitespace-nowrap'>" . $monthlyLates . "</td>";
                                        echo "<td class='whitespace-nowrap'>" . $monthlyUndertimes . "</td>";
                                        echo "</tr>";
                                    }
                                }
                                else if ($_SESSION['designationID'] == 4) {
                                    $operationsTeamQuery = mysqli_query($conn, $attendance->viewOperationsTeamTL());
                                    while ($operationsTeamDetails = mysqli_fetch_array($operationsTeamQuery)) {

                                        $teamOperations_id = $operationsTeamDetails['id'];
                                        $teamOperations_employeeID = $operationsTeamDetails['employeeID'];
                                        $teamOperations_employeeName = $operationsTeamDetails['firstName'] . " " . $operationsTeamDetails['lastName'];
                                        $teamOperations_shift = $operationsTeamDetails['startTime'] . " - " . $operationsTeamDetails['endTime'];
                                        $availableSL = $operationsTeamDetails['availableSL']; 
                                        $availableVL = $operationsTeamDetails['availableVL']; 

                                        $year = date('Y');
                                        $month = date('m');

                                        // GET MONTHLY ATTENDANCE
                                        $monthlyAttendanceQuery = mysqli_query($conn, $attendance->getMonthlyAttendance($teamOperations_id, $year, $month));
                                        // $monthlyAttendance = round(mysqli_num_rows($monthlyAttendanceQuery) / 2);
                                        $monthlyAttendance = mysqli_num_rows($monthlyAttendanceQuery);

                                        // GET MONTHLY ABSENCES
                                        $workingDays = $attendance->getWorkingDaysInMonth($year, $month);
                                        $monthlyAbsences = $workingDays - $monthlyAttendance;

                                        // GET MONTHLY LATES
                                        $monthlyLatesQuery = mysqli_query($conn, $attendance->getMonthlyLates($teamOperations_id, $year, $month));
                                        $monthlyLates = mysqli_num_rows($monthlyLatesQuery);

                                        // GET MONTHLY UNDERTIMES
                                        $monthlyUndertimesQuery = mysqli_query($conn, $attendance->getMonthlyUndertimes($teamOperations_id, $year, $month));
                                        $monthlyUndertimes = mysqli_num_rows($monthlyUndertimesQuery); 

                                        echo "<tr data-id='" . $teamOperations_id . "' class='teamDTRview cursor-pointer'>";
                                        echo "<td class='whitespace-nowrap'>" . $teamOperations_employeeID . "</td>";
                                        echo "<td class='whitespace-nowrap text-left'>" . $teamOperations_employeeName . "</td>";
                                        echo "<td class='whitespace-nowrap'>" . $teamOperations_shift . "</td>";
                                        echo "<td class='whitespace-nowrap'>" . $monthlyAttendance . "</td>";
                                        echo "<td class='whitespace-nowrap'>" . $availableVL . "</td>";
                                        echo "<td class='whitespace-nowrap'>" . $availableSL . "</td>";
                                        echo "<td class='whitespace-nowrap'>" . $monthlyAbsences . "</td>";
                                        echo "<td class='whitespace-nowrap'>" . $monthlyLates . "</td>";
                                        echo "<td class='whitespace-nowrap'>" . $monthlyUndertimes . "</td>";
                                        echo "</tr>";
                                    }
                                }
                            }
                            
                            else // GET IT TEAM
                            {   
                                $itTeamQuery = mysqli_query($conn, $attendance->viewITTeam());
                                while ($itTeamDetails = mysqli_fetch_array($itTeamQuery)) {

                                    $teamIT_id = $itTeamDetails['id'];
                                    $teamIT_employeeID = $itTeamDetails['employeeID'];
                                    $teamIT_employeeName = $itTeamDetails['firstName'] . " " . $itTeamDetails['lastName'];
                                    $teamIT_shift = $itTeamDetails['startTime'] . " - " . $itTeamDetails['endTime'];
                                    $availableSL = $itTeamDetails['availableSL']; 
                                    $availableVL = $itTeamDetails['availableVL']; 

                                    $year = date('Y');
                                    $month = date('m');

                                    // GET MONTHLY ATTENDANCE
                                    $monthlyAttendanceQuery = mysqli_query($conn, $attendance->getMonthlyAttendance($teamIT_id, $year, $month));
                                    // $monthlyAttendance = round(mysqli_num_rows($monthlyAttendanceQuery) / 2);
                                    $monthlyAttendance = mysqli_num_rows($monthlyAttendanceQuery);

                                    // GET MONTHLY ABSENCES
                                    $workingDays = $attendance->getWorkingDaysInMonth($year, $month);
                                    $monthlyAbsences = $workingDays - $monthlyAttendance;

                                    // GET MONTHLY LATES
                                    $monthlyLatesQuery = mysqli_query($conn, $attendance->getMonthlyLates($teamIT_id, $year, $month));
                                    $monthlyLates = mysqli_num_rows($monthlyLatesQuery);

                                    // GET MONTHLY UNDERTIMES
                                    $monthlyUndertimesQuery = mysqli_query($conn, $attendance->getMonthlyUndertimes($teamIT_id, $year, $month));
                                    $monthlyUndertimes = mysqli_num_rows($monthlyUndertimesQuery); 

                                    echo "<tr data-id='" . $teamIT_id . "' class='teamDTRview cursor-pointer'>";
                                    echo "<td class='whitespace-nowrap'>" . $teamIT_employeeID . "</td>";
                                    echo "<td class='whitespace-nowrap text-left'>" . $teamIT_employeeName . "</td>";
                                    echo "<td class='whitespace-nowrap'>" . $teamIT_shift . "</td>";
                                    echo "<td class='whitespace-nowrap'>" . $monthlyAttendance . "</td>";
                                    echo "<td class='whitespace-nowrap'>" . $availableVL . "</td>";
                                    echo "<td class='whitespace-nowrap'>" . $availableSL . "</td>";
                                    echo "<td class='whitespace-nowrap'>" . $monthlyAbsences . "</td>";
                                    echo "<td class='whitespace-nowrap'>" . $monthlyLates . "</td>";
                                    echo "<td class='whitespace-nowrap'>" . $monthlyUndertimes . "</td>";
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
            <!----------------------------------------------------------- VIEW TEAM MEMBER MONTHLY DTR ---------------------------------------------------->
            <div class="modal fade" id="viewTeamDTRModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                <div class="modal-dialog modal-none modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content" id="viewTeamDTRModal">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="userFormLabel">View Employee DTR</h1>
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

                            <div class="row g-2 mb-2">
                                <div class="container mx-auto overflow-auto">
                                    <table id="attendanceTable" class="table table-auto table-striped table-bordered text-center pt-3">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="text-xs font-medium text-yellow-500 uppercase tracking-tight">Face DTR</th>
                                                <th class="text-xs font-medium text-yellow-500 uppercase tracking-tight">Date</th>
                                                <th class="text-xs font-medium text-yellow-500 uppercase tracking-tight">Day</th>
                                                <th class="text-xs font-medium text-gray-500 uppercase tracking-tight">Time In</th>
                                                <th class="text-xs font-medium text-gray-500 uppercase tracking-tight">Time Out</th>
                                                <th class="text-xs font-medium text-gray-500 uppercase tracking-tight">Late</th>
                                                <th class="text-xs font-medium text-gray-500 uppercase tracking-tight">Undertime</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200" id="empDTRsection">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!----------------------------------------------------------- VIEW TEAM MEMBER FACE DTR ------------------------------------------------------->
            <div class="modal fade" id="viewFaceDTRModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                <div class="modal-dialog modal-none modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content" id="viewFaceDTRModal">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="userFormLabel">View Employee DTR</h1>
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

                            <div class="row g-2 mb-2">
                                <div class="container mx-auto overflow-auto">
                                    <table id="attendanceTable" class="table table-auto table-striped table-bordered text-center pt-3">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="text-xs font-medium text-yellow-500 uppercase tracking-tight">Face DTR</th>
                                                <th class="text-xs font-medium text-yellow-500 uppercase tracking-tight">Date</th>
                                                <th class="text-xs font-medium text-yellow-500 uppercase tracking-tight">Day</th>
                                                <th class="text-xs font-medium text-gray-500 uppercase tracking-tight">Time In</th>
                                                <th class="text-xs font-medium text-gray-500 uppercase tracking-tight">Time Out</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200" id="empDTRsection">
                                            
                                        </tbody>
                                    </table>
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
    
        <script src="../assets/js/team_dtr.js?v=<?php echo $version; ?>"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>