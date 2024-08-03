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
            <div class="px-3 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                
                <!-- DATATABLE -->
                <div class="container mx-auto my-3 overflow-auto">
                    <table id="dtr" class="table table-auto table-striped table-bordered min-w-full divide-y divide-gray-200 text-center">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Employee ID</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Shift</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Days Worked</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Leave</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Absents</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Lates</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Undertime</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Overtime</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php
                                $attendanceQuery = mysqli_query($conn, $employees->viewEmployeeAttendance());
                                while ($attendanceDetails = mysqli_fetch_array($attendanceQuery)) {

                                    $attendance_id = $attendanceDetails['id'];
                                    $attendance_employeeName = $attendanceDetails['firstName'] . " " . $attendanceDetails['lastName'];
                                    $attendance_emailAddress = $attendanceDetails['emailAddress'];
                                    $attendance_mobileNumber = $attendanceDetails['mobileNumber'];
                                    $attendance_employeeID = $attendanceDetails['employeeID'];
                                    $attendance_shift = $attendanceDetails['startTime'] . " - " . $attendanceDetails['endTime'];

                                    // GET DAYS wORKED
                                    $monthlyAttendanceQuery = mysqli_query($conn, $attendance->getMonthlyAttendance($attendance_id));
                                    $attendance_daysWorked = mysqli_num_rows($monthlyAttendanceQuery);

                                    // GET ABSENTS
                                    $year = date('Y');
                                    $month = date('m');

                                    $workingDays = $attendance->getWorkingDaysInMonth($year, $month);
                                    $attendance_absences = $workingDays - $attendance_daysWorked;

                                    // GET LATES
                                    $monthlyLatesQuery = mysqli_query($conn, $attendance->getMonthlyLates($attendance_id));
                                    $attendance_lates = mysqli_num_rows($monthlyLatesQuery);

                                    // GET UNDERTIMES
                                    $monthlyUndertimesQuery = mysqli_query($conn, $attendance->getMonthlyUndertimes($attendance_id));
                                    $attendance_undertimes = mysqli_num_rows($monthlyUndertimesQuery);


                                    echo "<tr data-id='" . $attendance_id . "' class='attendanceView'>";
                                    echo "<td ='px-6 py-4 whitespace-nowrap'>" . $attendance_employeeID . "</td>";
                                    echo "<td ='px-6 py-4 text-left whitespace-nowrap'>" . $attendance_employeeName . "</td>";
                                    echo "<td ='px-6 py-4 whitespace-nowrap'>" . $attendance_shift . "</td>";
                                    echo "<td ='px-6 py-4 whitespace-nowrap'>". $attendance_daysWorked ."</td>";
                                    echo "<td ='px-6 py-4 whitespace-nowrap'>5</td>";
                                    echo "<td ='px-6 py-4 whitespace-nowrap'>".$attendance_absences."</td>";
                                    echo "<td ='px-6 py-4 whitespace-nowrap'>".$attendance_lates."</td>";
                                    echo "<td ='px-6 py-4 whitespace-nowrap'>".$attendance_undertimes."</td>";
                                    echo "<td ='px-6 py-4 whitespace-nowrap'>6</td>";
                                    echo "</td>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </main>
    
        <script src="../assets/js/admin_dtr.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>