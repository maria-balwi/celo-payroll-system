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
                <div class="container mx-auto overflow-auto">
                    <table id="teamDTRTable" class="table table-striped table-bordered min-w-full divide-y divide-gray-200 text-center">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Employee ID</th>
                                <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Shift</th>
                                <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Days Worked</th>
                                <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Leaves</th>
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
                                    $availableLeaves = $itTeamDetails['availableLeaves']; ?>
                                <tr data-id="<?php echo $teamIT_id ?>">
                                    <td class="whitespace-nowrap"><?php echo $teamIT_employeeID ?></td>
                                    <td class="whitespace-nowrap text-left"><?php echo $teamIT_employeeName ?></td>
                                    <td class="whitespace-nowrap"><?php echo $teamIT_shift ?></td>
                                    <td class="whitespace-nowrap"><?php echo $monthlyAttendance ?></td>
                                    <td class="whitespace-nowrap"><?php echo $availableLeaves ?></td>
                                    <td class="whitespace-nowrap"><?php echo $monthlyAbsences ?></td>
                                    <td class="whitespace-nowrap"><?php echo $monthlyLates ?></td>
                                    <td class="whitespace-nowrap"><?php echo $monthlyUndertimes; } ?></td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </main>
    
        <script src="../assets/js/team_dtr.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>