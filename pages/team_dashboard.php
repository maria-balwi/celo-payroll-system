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
                                $totalITTeamQuery = mysqli_query($conn, $employees->viewTeam());
                                $totalITTeam = mysqli_num_rows($totalITTeamQuery);
                                echo $totalITTeam;
                            ?>
                        </h2>
                        <p class="text-gray-700 font-semibold">Total IT Team</p>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-white p-4 rounded-lg col-span-3 lg:col-span-1 shadow-md text-center">
                        <svg class="h-16 w-16 text-gray-600 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h2 class="text-xl font-bold mb-1">
                            <?php  
                                $presentITQuery = mysqli_query($conn, $attendance->getPresentIT());
                                $presentIT = mysqli_num_rows($presentITQuery);
                                echo $presentIT;
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
                                $absentITQuery = mysqli_query($conn, $attendance->getAbsentIT());
                                $absentIT = mysqli_num_rows($absentITQuery);
                                echo $absentIT;
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
                                $lateITQuery = mysqli_query($conn, $attendance->getLateIT());
                                $lateIT = mysqli_num_rows($lateITQuery);
                                echo $lateIT;
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
                                $undertimeITQuery = mysqli_query($conn, $attendance->getUndertimeIT());
                                $undertimeIT = mysqli_num_rows($undertimeITQuery);
                                echo $undertimeIT;
                            ?>
                        </h2>
                        <p class="text-gray-700">Undertime</p>
                        <!-- <p class="text-gray-700">On Leave</p> -->
                    </div>

                    <!-- Card 6 -->
                    <div class="bg-white p-4 rounded-lg col-span-6 lg:col-span-2 shadow-md">
                        <h2 class="text-xl font-bold mb-2">Pending Requests</h2>
                        <?php  
                            $getPendingLeavesQuery = mysqli_query($conn, $attendance->getPendingITLeaves());
                            $getPendingLeaves = mysqli_num_rows($getPendingLeavesQuery);

                            $getPendingChangeShiftQuery = mysqli_query($conn, $attendance->getPendingITChangeShift());
                            $getPendingChangeShift = mysqli_num_rows($getPendingChangeShiftQuery);

                            if ($getPendingLeaves != 0) { ?>
                                <!-- ======== LEAVE APPLICATIONS ======== -->
                                <a href="admin_leaves.php" class="no-underline text-gray-700">
                                    <div class="flex gap-2 p-2 rounded-lg hover:bg-blue-100 px-auto">
                                        <div class="my-auto">
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
                                <a href="admin_changeShift.php" class="no-underline text-gray-700">
                                    <div class="flex gap-2 p-2 rounded-lg hover:bg-blue-100 px-auto">
                                        <div class="my-auto">
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
                            else { ?>
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
                            <table id="attendaceTable" class="table table-auto min-w-full divide-y divide-gray-200 table-striped table-bordered text-center pt-3">
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
                                        $itTeamQuery = mysqli_query($conn, $attendance->viewITTeam());
                                        while ($itTeamDetails = mysqli_fetch_array($itTeamQuery)) {

                                            $teamIT_id = $itTeamDetails['id'];
                                            $teamIT_employeeName = $itTeamDetails['firstName'] . " " . $itTeamDetails['lastName'];
                                            $teamIT_shift = $itTeamDetails['startTime'] . " - " . $itTeamDetails['endTime'];
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
                                            <td class="whitespace-nowrap"><?php echo $teamIT_shift ?></td>
                                            <td class="whitespace-nowrap"><?php echo $teamIT_timeIn ?></td>
                                            <td class="whitespace-nowrap"><?php echo $teamIT_timeOut ?></td>
                                            <?php 
                                                if ($teamIT_status == "Present") { ?>
                                            <td class="whitespace-nowrap text-green-500"><?php echo $teamIT_status ?></td>
                                            <?php }
                                                else { ?>
                                            <td class="whitespace-nowrap text-red-500"><?php echo $teamIT_status ?></td>
                                        <?php } } ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            
        </div>

        <script src="../assets/js/team_dashboard.js"></script>
    
        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>