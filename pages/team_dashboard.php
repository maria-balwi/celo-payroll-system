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
            <main class="flex-1 p-3 overflow-auto">
                <div class="flex-1 p-2 mt-none text-2xl font-bold">
                    Team Dashboard
                </div>

                <!-- CONTENT -->
                <!-- CARDS -->
                <div class="grid grid-cols-6 md:grid-cols-6 gap-3 overflow-auto">
                    <!-- Card 1 -->
                    <div class="bg-white p-4 rounded-lg col-span-6 lg:col-span-2 shadow-md">
                        <svg class="h-16 w-16 text-gray-600"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <h2 class="text-xl font-bold mb-2">
                            <?php  
                                if ($_SESSION['departmentID'] == 1) 
                                {
                                    $totalOperationsTeamQuery = mysqli_query($conn, $employees->viewTeamOperations());
                                    $totalOperationsTeam = mysqli_num_rows($totalOperationsTeamQuery);
                                    echo $totalOperationsTeam;
                                }
                                else 
                                {
                                    $totalITTeamQuery = mysqli_query($conn, $employees->viewTeam());
                                    $totalITTeam = mysqli_num_rows($totalITTeamQuery);
                                    echo $totalITTeam;
                                }
                            ?>
                        </h2>
                        <p class="text-gray-700 font-semibold">Total Team Members</p>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-white p-4 rounded-lg col-span-3 lg:col-span-1 shadow-md text-center">
                        <svg class="h-16 w-16 text-gray-600 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h2 class="text-xl font-bold mb-1">
                            <?php  
                                if ($_SESSION['departmentID'] == 1) 
                                {
                                    $presentOperationsQuery = mysqli_query($conn, $attendance->getPresentOperations());
                                    $presentOperations = mysqli_num_rows($presentOperationsQuery);
                                    echo $presentOperations;
                                }
                                else
                                {
                                    $presentITQuery = mysqli_query($conn, $attendance->getPresentIT());
                                    $presentIT = mysqli_num_rows($presentITQuery);
                                    echo $presentIT;
                                }
                            ?>
                        </h2>
                        <p class="text-gray-700">Present</p>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-white p-4 rounded-lg col-span-3 lg:col-span-1 shadow-md text-center">
                        <svg class="h-16 w-16 text-gray-600 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h2 class="text-xl font-bold mb-1">
                            <?php  
                                if ($_SESSION['departmentID'] == 1) 
                                {
                                    $absentOperationsQuery = mysqli_query($conn, $attendance->getAbsentOperations());
                                    $absentOperations = mysqli_num_rows($absentOperationsQuery);
                                    echo $absentOperations;
                                }
                                else
                                {
                                    $absentITQuery = mysqli_query($conn, $attendance->getAbsentIT());
                                    $absentIT = mysqli_num_rows($absentITQuery);
                                    echo $absentIT;
                                }
                            ?>
                        </h2>
                        <p class="text-gray-700">Absent</p>
                    </div>

                    <!-- Card 4 -->
                    <div class="bg-white p-4 rounded-lg col-span-3 lg:col-span-1 shadow-md text-center">
                        <svg class="h-16 w-16 text-gray-600 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h2 class="text-xl font-bold mb-1">
                            <?php  
                                if ($_SESSION['departmentID'] == 1) 
                                {
                                    $lateOperationsQuery = mysqli_query($conn, $attendance->getLateOperations());
                                    $lateOperations = mysqli_num_rows($lateOperationsQuery);
                                    echo $lateOperations;
                                }
                                else
                                {
                                    $lateITQuery = mysqli_query($conn, $attendance->getLateIT());
                                    $lateIT = mysqli_num_rows($lateITQuery);
                                    echo $lateIT;
                                }
                            ?>
                        </h2>
                        <p class="text-gray-700">Late</p>
                    </div>

                    <!-- Card 5 -->
                    <div class="bg-white p-4 rounded-lg col-span-3 lg:col-span-1 shadow-md text-center">
                        <svg class="h-16 w-16 text-gray-600 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h2 class="text-xl font-bold mb-1">
                            <?php  
                                if ($_SESSION['departmentID'] == 1) 
                                {
                                    $undertimeOperationsQuery = mysqli_query($conn, $attendance->getUndertimeOperations());
                                    $undertimeOperations = mysqli_num_rows($undertimeOperationsQuery);
                                    echo $undertimeOperations;
                                }
                                else
                                {
                                    $undertimeITQuery = mysqli_query($conn, $attendance->getUndertimeIT());
                                    $undertimeIT = mysqli_num_rows($undertimeITQuery);
                                    echo $undertimeIT;
                                }
                            ?>
                        </h2>
                        <p class="text-gray-700">Undertime</p>
                        <!-- <p class="text-gray-700">On Leave</p> -->
                    </div>

                    <!-- Card 6 -->
                    <div class="bg-white p-4 rounded-lg col-span-6 lg:col-span-2 shadow-md">
                        <h2 class="text-xl font-bold mb-2">Pending Requests</h2>
                        <?php  
                            if ($_SESSION['departmentID'] == 1) 
                            {
                                if ($_SESSION['designationID'] == 5) {
                                    $getPendingLeavesQuery = mysqli_query($conn, $attendance->getPendingOperationsLeavesManager());
                                    $getPendingLeaves = mysqli_num_rows($getPendingLeavesQuery);

                                    $getPendingChangeShiftQuery = mysqli_query($conn, $attendance->getPendingOperationsChangeShiftManager());
                                    $getPendingChangeShift = mysqli_num_rows($getPendingChangeShiftQuery);
                                    
                                    $getPendingOvertimeQuery = mysqli_query($conn, $attendance->getPendingOperationsOvertimeManager());
                                    $getPendingOvertime = mysqli_num_rows($getPendingOvertimeQuery);
                                }
                                else {
                                    $getPendingLeavesQuery = mysqli_query($conn, $attendance->getPendingOperationsLeavesTL());
                                    $getPendingLeaves = mysqli_num_rows($getPendingLeavesQuery);

                                    $getPendingChangeShiftQuery = mysqli_query($conn, $attendance->getPendingOperationsChangeShiftTL());
                                    $getPendingChangeShift = mysqli_num_rows($getPendingChangeShiftQuery);
                                    
                                    $getPendingOvertimeQuery = mysqli_query($conn, $attendance->getPendingOperationsOvertimeTL());
                                    $getPendingOvertime = mysqli_num_rows($getPendingOvertimeQuery);
                                }
                            }
                            else 
                            {
                                $getPendingLeavesQuery = mysqli_query($conn, $attendance->getPendingITLeaves());
                                $getPendingLeaves = mysqli_num_rows($getPendingLeavesQuery);

                                $getPendingChangeShiftQuery = mysqli_query($conn, $attendance->getPendingITChangeShift());
                                $getPendingChangeShift = mysqli_num_rows($getPendingChangeShiftQuery);

                                $getPendingOvertimeQuery = mysqli_query($conn, $attendance->getPendingITOvertime());
                                $getPendingOvertime = mysqli_num_rows($getPendingOvertimeQuery);
                            }

                            if ($getPendingLeaves != 0) { ?>
                                <!-- ======== LEAVE APPLICATIONS ======== -->
                                <a href="team_leaves.php" class="no-underline text-gray-700">
                                    <div class="flex gap-2 p-2 rounded-lg hover:bg-blue-100 px-auto">
                                        <div class="my-auto pb-3">
                                            <svg class="h-10 w-10 text-gray-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <div class="py-auto px-auto">
                                            <h2 class="text-lg mb-0 font-semibold">Leave Applications</h2>
                                            <p class="text-gray-500 text-sm">Pending leave requests</p>
                                        </div>
                                        <div class="bg-yellow-200 text-gray-700 px-3 py-2 rounded-lg my-auto text-center font-semibold">
                                            <?php echo $getPendingLeaves ?>
                                        </div>
                                    </div>
                                </a>
                        <?php } 
                            if ($getPendingChangeShift != 0) { ?>
                                <!-- ======== CHANGE SHIFT REQUESTS ======== -->
                                <a href="team_changeShift.php" class="no-underline text-gray-700">
                                    <div class="flex gap-2 p-2 rounded-lg hover:bg-blue-100 px-auto">
                                        <div class="my-auto pb-3">
                                            <svg class="h-10 w-10 text-gray-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                            </svg>
                                        </div>
                                        <div class="py-auto px-auto">
                                            <h2 class="text-lg mb-0 font-semibold">Change of Shift</h2>
                                            <p class="text-gray-500 text-sm">Pending change of shift requests</p>
                                        </div>
                                        <div class="bg-yellow-200 text-gray-700 px-3 py-2 rounded-lg my-auto text-center font-semibold">
                                            <?php echo $getPendingChangeShift ?>
                                        </div>
                                    </div>
                                </a>

                        <?php } 
                            if ($getPendingOvertime != 0) { ?>
                                <!-- ======== FILED OTs ======== -->
                                <a href="team_overtime.php" class="no-underline text-gray-700">
                                    <div class="flex gap-2 p-2 rounded-lg hover:bg-blue-100 px-auto">
                                        <div class="my-auto pb-3">
                                            <svg class="h-10 w-10 text-gray-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </div>
                                        <div class="py-auto px-auto">
                                            <h2 class="text-lg mb-0 font-semibold">Filed OTs</h2>
                                            <p class="text-gray-500 text-sm">Pending filed overtimes</p>
                                        </div>
                                        <div class="bg-yellow-200 text-gray-700 px-3 py-2 rounded-lg my-auto text-center font-semibold">
                                            <?php echo $getPendingOvertime ?>
                                        </div>
                                    </div>
                                </a>
                        <?php }
                            if ($getPendingLeaves == 0 && $getPendingChangeShift == 0 && $getPendingOvertime == 0) { ?>
                                <!-- ======== NO PENDING REQUESTS ======== -->
                                <div class="mt-3">
                                    <p class="text-gray-700">There are no pending requests at the moment.</p>
                                </div>
                        <?php } ?>
                    </div>

                    <!-- Card 7 -->
                    <div class="bg-white p-4 rounded-lg col-span-6 lg:col-span-4 shadow-md">
                        <h2 class="text-xl font-bold mb-2">
                            Attendance for Today: 
                            <?php 
                                // GET CURRENT DATE
                                $currentDate = date('Y-m-d');

                                // Create a DateTime object from the string
                                $dateTime = new DateTime($currentDate);
                                
                                // Format the date
                                echo $dateTime->format('F j, Y - l');
                            ?>
                        </h2>
                        <!-- DATATABLE -->
                        <div class="container mx-auto overflow-auto">
                            <table id="attendanceTable" class="table table-auto min-w-full divide-y divide-gray-200 table-striped table-bordered text-center pt-3">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="text-xs font-medium text-yellow-500 uppercase tracking-wider">Name</th>
                                        <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Shift</th>
                                        <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Log In</th>
                                        <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Log Out</th>
                                        <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php
                                        if ($_SESSION['departmentID'] == 1) 
                                        {
                                            if ($_SESSION['designationID'] == 5) {
                                                $operationsTeamQuery = mysqli_query($conn, $attendance->viewOperationsTeamManager());
                                                while ($operationsTeamDetails = mysqli_fetch_array($operationsTeamQuery)) {
                                                    $teamOperations_id = $operationsTeamDetails['id'];
                                                    $teamOperations_employeeName = $operationsTeamDetails['firstName'] . " " . $operationsTeamDetails['lastName'];
                                                    $teamOperations_shift = $operationsTeamDetails['startTime'] . " - " . $operationsTeamDetails['endTime'];
                                                    $teamOperations_status = "Absent";
                                                    $team_timeIn = "-";
                                                    $team_timeOut = "-";

                                                    // GET ATTENDANCE TIME - TIME IN
                                                    $dailyAttendanceQuery_timeIn = mysqli_query($conn, $attendance->dailyAttendance_timeIn($teamOperations_id));
                                                    $dailyAttendance_timeInDetails = mysqli_fetch_array($dailyAttendanceQuery_timeIn);
                                                    if (isset($dailyAttendance_timeInDetails['attendanceTime']))
                                                    {
                                                        $team_timeIn = $dailyAttendance_timeInDetails['attendanceTime'];
                                                        $teamOperations_status = "Present";
                                                    }

                                                    // GET ATTENDANCE TIME - TIME OUT
                                                    $dailyAttendanceQuery_timeOut = mysqli_query($conn, $attendance->dailyAttendance_timeOut($teamOperations_id));
                                                    $dailyAttendance_timeOutDetails = mysqli_fetch_array($dailyAttendanceQuery_timeOut);
                                                    if (isset($dailyAttendance_timeOutDetails['attendanceTime']) && $teamOperations_status == "Present")
                                                    {
                                                        $team_timeOut = $dailyAttendance_timeOutDetails['attendanceTime'];
                                                    }
                                                    
                                                    echo "<tr data-id='" . $teamOperations_id . "'>"; 
                                                    echo "<td class ='whitespace-nowrap text-left'>" . $teamOperations_employeeName . "</td>";
                                                    echo "<td class ='whitespace-nowrap'>" . $teamOperations_shift . "</td>";
                                                    echo "<td class ='whitespace-nowrap'>" . $team_timeIn . "</td>";
                                                    echo "<td class ='whitespace-nowrap'>" . $team_timeOut . "</td>";
                                                    if ($teamOperations_status == "Present") { 
                                                        echo "<td class ='whitespace-nowrap text-green-500'>" . $teamOperations_status . "</td>";
                                                    }
                                                    else { 
                                                        echo "<td class ='whitespace-nowrap text-red-500'>" . $teamOperations_status . "</td>";
                                                    }
                                                    echo "</tr>";
                                                }
                                            }
                                            else if ($_SESSION['designationID'] == 4) {
                                                $operationsTeamQuery = mysqli_query($conn, $attendance->viewOperationsTeamTL());
                                                while ($operationsTeamDetails = mysqli_fetch_array($operationsTeamQuery)) {
                                                    $teamOperations_id = $operationsTeamDetails['id'];
                                                    $teamOperations_employeeName = $operationsTeamDetails['firstName'] . " " . $operationsTeamDetails['lastName'];
                                                    $teamOperations_shift = $operationsTeamDetails['startTime'] . " - " . $operationsTeamDetails['endTime'];
                                                    $teamOperations_status = "Absent";
                                                    $team_timeIn = "-";
                                                    $team_timeOut = "-";

                                                    // GET ATTENDANCE TIME - TIME IN
                                                    $dailyAttendanceQuery_timeIn = mysqli_query($conn, $attendance->dailyAttendance_timeIn($teamOperations_id));
                                                    $dailyAttendance_timeInDetails = mysqli_fetch_array($dailyAttendanceQuery_timeIn);
                                                    if (isset($dailyAttendance_timeInDetails['attendanceTime']))
                                                    {
                                                        $team_timeIn = $dailyAttendance_timeInDetails['attendanceTime'];
                                                        $teamOperations_status = "Present";
                                                    }

                                                    // GET ATTENDANCE TIME - TIME OUT
                                                    $dailyAttendanceQuery_timeOut = mysqli_query($conn, $attendance->dailyAttendance_timeOut($teamOperations_id));
                                                    $dailyAttendance_timeOutDetails = mysqli_fetch_array($dailyAttendanceQuery_timeOut);
                                                    if (isset($dailyAttendance_timeOutDetails['attendanceTime']) && $teamOperations_status)
                                                    {
                                                        $team_timeOut = $dailyAttendance_timeOutDetails['attendanceTime'];
                                                    }

                                                    echo "<tr data-id='" . $teamOperations_id . "'>"; 
                                                    echo "<td class ='whitespace-nowrap text-left'>" . $teamOperations_employeeName . "</td>";
                                                    echo "<td class ='whitespace-nowrap'>" . $teamOperations_shift . "</td>";
                                                    echo "<td class ='whitespace-nowrap'>" . $team_timeIn . "</td>";
                                                    echo "<td class ='whitespace-nowrap'>" . $team_timeOut . "</td>";
                                                    if ($teamOperations_status == "Present") { 
                                                        echo "<td class ='whitespace-nowrap text-green-500'>" . $teamOperations_status . "</td>";
                                                    }
                                                    else { 
                                                        echo "<td class ='whitespace-nowrap text-red-500'>" . $teamOperations_status . "</td>";
                                                    }
                                                    echo "</tr>";
                                                }
                                            }
                                        }
                                        else 
                                        {
                                            $itTeamQuery = mysqli_query($conn, $attendance->viewITTeam());
                                            while ($itTeamDetails = mysqli_fetch_array($itTeamQuery)) {
                                                $teamIT_id = $itTeamDetails['id'];
                                                $teamIT_employeeName = $itTeamDetails['firstName'] . " " . $itTeamDetails['lastName'];
                                                $teamIT_shift = $itTeamDetails['startTime'] . " - " . $itTeamDetails['endTime'];
                                                $teamIT_status = "Absent";
                                                $team_timeIn = "-";
                                                $team_timeOut = "-";

                                                // GET ATTENDANCE TIME - TIME IN
                                                $dailyAttendanceQuery_timeIn = mysqli_query($conn, $attendance->dailyAttendance_timeIn($teamIT_id));
                                                $dailyAttendance_timeInDetails = mysqli_fetch_array($dailyAttendanceQuery_timeIn);
                                                $dateTime;
                                                if (isset($dailyAttendance_timeInDetails['attendanceTime']))
                                                {
                                                    $team_timeIn = $dailyAttendance_timeInDetails['attendanceTime'];
                                                    $teamIT_status = "Present";
                                                }

                                                // GET ATTENDANCE TIME - TIME OUT
                                                $dailyAttendanceQuery_timeOut = mysqli_query($conn, $attendance->dailyAttendance_timeOut($teamIT_id));
                                                $dailyAttendance_timeOutDetails = mysqli_fetch_array($dailyAttendanceQuery_timeOut);
                                                if (isset($dailyAttendance_timeOutDetails['attendanceTime']) && $teamIT_status == "Present")
                                                {
                                                    $team_timeOut = $dailyAttendance_timeOutDetails['attendanceTime'];
                                                }

                                                echo "<tr data-id='" . $teamIT_id . "'>"; 
                                                echo "<td class ='whitespace-nowrap text-left'>" . $teamIT_employeeName . "</td>";
                                                echo "<td class ='whitespace-nowrap'>" . $teamIT_shift . "</td>";
                                                echo "<td class ='whitespace-nowrap'>" . $team_timeIn . "</td>";
                                                echo "<td class ='whitespace-nowrap'>" . $team_timeOut . "</td>";
                                                if ($teamIT_status == "Present") { 
                                                    echo "<td class ='whitespace-nowrap text-green-500'>" . $teamIT_status . "</td>";
                                                }
                                                else { 
                                                    echo "<td class ='whitespace-nowrap text-red-500'>" . $teamIT_status . "</td>";
                                                }
                                                echo "</tr>";
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            
        </div>

        <script src="../assets/js/team_dashboard.js?v=<?php echo $version; ?>"></script>
    
        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>