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
                    <table id="dtr" class="table table-striped table-bordered table-auto text-center">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="py-3 text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Employee ID</th>
                                <th class="py-3 text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Name</th>
                                <th class="py-3 text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Shift</th>
                                <th class="py-3 text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Days Worked</th>
                                <th class="py-3 text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Vacation Leave</th>
                                <th class="py-3 text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Sick Leave</th>
                                <th class="py-3 text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Absents</th>
                                <th class="py-3 text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Lates</th>
                                <th class="py-3 text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Undertime</th>
                                <th class="py-3 text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Overtime</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php
                                $attendanceQuery = mysqli_query($conn, $employees->viewEmployeeAttendance());
                                while ($attendanceDetails = mysqli_fetch_array($attendanceQuery)) {

                                    $attendance_id = $attendanceDetails['id'];
                                    $attendance_employeeName = $attendanceDetails['lastName'] . ", " . $attendanceDetails['firstName'];
                                    $attendance_emailAddress = $attendanceDetails['emailAddress'];
                                    $attendance_mobileNumber = $attendanceDetails['mobileNumber'];
                                    $attendance_employeeID = $attendanceDetails['employeeID'];
                                    $attendance_shift = $attendanceDetails['startTime'] . " - " . $attendanceDetails['endTime'];
                                    $attendance_vl = $attendanceDetails['availableVL'];
                                    $attendance_sl = $attendanceDetails['availableSL'];

                                    // GET DAYS wORKED
                                    $monthlyAttendanceQuery = mysqli_query($conn, $attendance->getMonthlyAttendance($attendance_id));
                                    $attendance_daysWorked = mysqli_num_rows($monthlyAttendanceQuery);

                                    // GET ABSENTS
                                    $yearMonth = date('Y-m');

                                    $workingDays = $attendance->getWorkingDaysInMonth($yearMonth);
                                    $attendance_absences = $workingDays - $attendance_daysWorked;

                                    // GET LATES
                                    $monthlyLatesQuery = mysqli_query($conn, $attendance->getMonthlyLates($attendance_id));
                                    $attendance_lates = mysqli_num_rows($monthlyLatesQuery);

                                    // GET UNDERTIMES
                                    $monthlyUndertimesQuery = mysqli_query($conn, $attendance->getMonthlyUndertimes($attendance_id));
                                    $attendance_undertimes = mysqli_num_rows($monthlyUndertimesQuery);


                                    echo "<tr data-id='" . $attendance_id . "' class='employeeDTRview cursor-pointer'>";
                                    echo "<td class ='whitespace-nowrap'>" . $attendance_employeeID . "</td>";
                                    echo "<td class ='text-left whitespace-nowrap'>" . $attendance_employeeName . "</td>";
                                    echo "<td class ='whitespace-nowrap'>" . $attendance_shift . "</td>";
                                    echo "<td class ='whitespace-nowrap'>". $attendance_daysWorked ."</td>";
                                    echo "<td class ='whitespace-nowrap'>".$attendance_vl."</td>";
                                    echo "<td class ='whitespace-nowrap'>".$attendance_sl."</td>";
                                    echo "<td class ='whitespace-nowrap'>".$attendance_absences."</td>";
                                    echo "<td class ='whitespace-nowrap'>".$attendance_lates."</td>";
                                    echo "<td class ='whitespace-nowrap'>".$attendance_undertimes."</td>";
                                    echo "<td class ='whitespace-nowrap'>0</td>";
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
            <!--------------------------------------------------------------- VIEW TEAM MEMBER DTR -------------------------------------------------------->
            <div class="modal fade" id="viewEmployeeDTRModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                <div class="modal-dialog modal-none modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content" id="viewEmployeeDTRModal">
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

                            <!-- <div class="row g-2 mb-3">
                                <div class="col-2">
                                    <select class="form-select inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-2 py-2 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 focus:outline-none">
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                    </select>
                                </div>

                                <div class="col-3">
                                    <select class="form-select inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-2 py-2 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 focus:outline-none">
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                            </div> -->

                            <div class="row g-2 mb-2">
                                <div class="container mx-auto overflow-auto">
                                    <table id="attendanceTable" class="table table-auto table-striped table-bordered text-center pt-3">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="text-xs font-medium text-yellow-500 uppercase tracking-wider">Date</th>
                                                <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Log In</th>
                                                <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Log Out</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200" id="empDTRsection">
                                            
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
    
        <script src="../assets/js/admin_dtr.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>