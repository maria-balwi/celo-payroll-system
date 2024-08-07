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
                    Daily Time Records
                </div>    
            </div>
            
            <!-- CONTENT -->
            <div class="p-4 m-1 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                
                <!-- DATATABLE -->
                <div class="container mx-auto overflow-auto relative z-10">
                    <table id="teamDTRTable" class="table table-striped table-bordered min-w-full divide-y divide-gray-200 text-center relative">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Employee ID</th>
                                <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Shift</th>
                                <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Days Worked</th>
                                <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Vacation Leaves</th>
                                <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Sick Leaves</th>
                                <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Absences</th>
                                <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Lates</th>
                                <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Undertime</th>
                                <!-- <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Overtime</th> -->
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php
                                $year = date('Y');
                                $month = date('m');

                                function getWorkingDaysInMonth($year, $month) {
                                    $start_date = date("$year-$month-01");
                                    $end_date = date("Y-m-t", strtotime($start_date)); // last day of the month
                                    
                                    $work_days = 0;
                                    $day_counter = $start_date;
                                
                                    while (strtotime($day_counter) <= strtotime($end_date)) {
                                        if (date('N', strtotime($day_counter)) < 6) { // 1 (for Monday) through 5 (for Friday)
                                            $work_days++;
                                        }
                                        $day_counter = date("Y-m-d", strtotime($day_counter . ' +1 day'));
                                    }
                                    
                                    return $work_days;
                                }

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
                                    $workingDays = getWorkingDaysInMonth($year, $month);
                                    $monthlyAbsences = $workingDays - $monthlyAttendance;

                                    // GET MONTHLY LATES
                                    $monthlyLatesQuery = mysqli_query($conn, $attendance->getMonthlyLates($itTeamDetails['id']));
                                    $monthlyLates = mysqli_num_rows($monthlyLatesQuery);

                                    // GET MONTHLY UNDERTIMES
                                    $monthlyUndertimesQuery = mysqli_query($conn, $attendance->getMonthlyUndertimes($itTeamDetails['id']));
                                    $monthlyUndertimes = mysqli_num_rows($monthlyUndertimesQuery); 
                                    $availableVL = $itTeamDetails['availableVL'];
                                    $availableSL = $itTeamDetails['availableSL'];

                                    echo "<tr data-id='" . $teamIT_id . "' class='teamDTRview'>";
                                ?>
                                <!-- <tr data-id="< ?php echo $teamIT_id ?>" class="teamDTRview"> -->
                                    <td class="whitespace-nowrap"><?php echo $teamIT_employeeID ?></td>
                                    <td class="whitespace-nowrap text-left"><?php echo $teamIT_employeeName ?></td>
                                    <td class="whitespace-nowrap"><?php echo $teamIT_shift ?></td>
                                    <td class="whitespace-nowrap"><?php echo $monthlyAttendance ?></td>
                                    <td class="whitespace-nowrap"><?php echo $availableVL ?></td>
                                    <td class="whitespace-nowrap"><?php echo $availableSL ?></td>
                                    <td class="whitespace-nowrap"><?php echo $monthlyAbsences ?></td>
                                    <td class="whitespace-nowrap"><?php echo $monthlyLates ?></td>
                                    <td class="whitespace-nowrap"><?php echo $monthlyUndertimes ?></td>
                                </tr>
                            <?php } ?>
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

                            <div class="row g-2 mb-2">
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
                                    <table id="attendaceTable" class="table table-auto table-striped table-bordered text-center">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="text-xs font-medium text-yellow-500 uppercase tracking-wider">Date</th>
                                                <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Log In</th>
                                                <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Log Out</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <?php
                                                $itTeamQuery = mysqli_query($conn, $attendance->viewITTeam());
                                                while ($itTeamDetails = mysqli_fetch_array($itTeamQuery)) {

                                                    $teamIT_id = $itTeamDetails['id'];
                                                    $teamIT_employeeName = $itTeamDetails['firstName'] . " " . $itTeamDetails['lastName'];
                                                    $teamIT_status = "Absent";
                                                    $teamIT_timeIn = "-";
                                                    $teamIT_timeOut = "-";

                                                    // GET ATTENDANCE TIME - TIME IN
                                                    $dailyAttendanceITQuery_timeIn = mysqli_query($conn, $attendance->dailyAttendanceIT_timeIn($teamIT_id));
                                                    $dailyAttendanceIT_timeInDetails = mysqli_fetch_array($dailyAttendanceITQuery_timeIn);
                                                    if (isset($dailyAttendanceIT_timeInDetails['attendanceTime']))
                                                    {
                                                        $teamIT_timeIn = $dailyAttendanceIT_timeInDetails['attendanceTime'];
                                                        $teamIT_status = "Present";
                                                    }

                                                    // GET ATTENDANCE TIME - TIME OUT
                                                    $dailyAttendanceITQuery_timeOut = mysqli_query($conn, $attendance->dailyAttendanceIT_timeOut($teamIT_id));
                                                    $dailyAttendanceIT_timeOutDetails = mysqli_fetch_array($dailyAttendanceITQuery_timeOut);
                                                    if (isset($dailyAttendanceIT_timeOutDetails['attendanceTime']))
                                                    {
                                                        $teamIT_timeOut = $dailyAttendanceIT_timeOutDetails['attendanceTime'];
                                                        $teamIT_status = "Present";
                                                    }
                                                    echo "<tr data-id='" . $teamIT_id . "'>"; 
                                                    ?>
                                                    
                                                    <td class="whitespace-nowrap text-left"><?php echo $teamIT_employeeName ?></td>
                                                    <td class="whitespace-nowrap"><?php echo $teamIT_timeIn ?></td>
                                                    <td class="whitespace-nowrap"><?php echo $teamIT_timeOut ?></td>
                                                <?php } ?>
                                            </tr>
                                        </tbody>
                                    </table>
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
    
        <script src="../assets/js/team_dtr.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>