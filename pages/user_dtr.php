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
                <div class="flex-1 p-2 text-2xl font-bold">
                    Daily Time Record
                </div>

                <!-- CONTENT -->
                <div class="p-4 m-0 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">

                    <!-- DATATABLE -->
                    <div class="container mx-auto overflow-auto">
                        <table id="dtrTable" class="table text-center table-striped table-bordered table-auto pt-3" style="width: 100%;">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Face DTR</th>
                                    <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Shift</th>
                                    <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Attendance Type</th>
                                    <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                                    
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="userDTRsection">
                                <?php
                                    $yearMonth = date('Y-m');

                                    $dtrQuery = mysqli_query($conn, $employees->oldViewDTR($_SESSION['id']));
                                    while ($dtrDetails = mysqli_fetch_array($dtrQuery)) {

                                        $dtr_id = $dtrDetails['id'];
                                        $dtr_attendanceDate = $dtrDetails['attendanceDate'];
                                        $dtr_attendanceTime = $dtrDetails['attendanceTime'];
                                        $dtr_logType = $dtrDetails['logType'];
                                        $dtr_time = $dtrDetails['startTime'] . ' - ' . $dtrDetails['endTime'];
                                        
                                        $dateTime = new DateTime($dtr_attendanceDate);
                                        $formattedDate = $dateTime->format('M d, Y');                                      

                                        echo "<tr data-id='" . $dtr_id . "' class='odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700'>";
                                        echo "<td class=' whitespace-nowrap'>
                                                <svg class='h-8 w-8 text-gray-500 mx-auto'  fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                                                    <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z'/>
                                                    <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15 13a3 3 0 11-6 0 3 3 0 016 0z'/>
                                                </svg>
                                            </td>";
                                        echo "<td ='whitespace-nowrap'>" . $formattedDate . "</td>";
                                        echo "<td ='whitespace-nowrap'>" . $dtr_time . "</td>";
                                        if ($dtr_logType == "Time In") {
                                            echo "<td><p class='inline-block bg-green-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $dtr_logType . "</p></td>";
                                        }
                                        else if ($dtr_logType == "Time Out" || $dtr_logType == "OT Out") {
                                            echo "<td><p class='inline-block bg-red-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $dtr_logType . "</p></td>";
                                        }
                                        // else if ($dtr_logType == "Start of Break" || $dtr_logType == "End of Break") {
                                        //     echo "<td><p class='inline-block bg-purple-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $dtr_logType . "</p></td>";
                                        // }
                                        // else if ($dtr_logType == "OT In") {
                                        //     echo "<td><p class='inline-block bg-blue-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $dtr_logType . "</p></td>";
                                        // }
                                        else if ($dtr_logType == "Late") {
                                            echo "<td><p class='inline-block bg-yellow-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $dtr_logType . "</p></td>";
                                        }
                                        else if ($dtr_logType == "Undertime") {
                                            echo "<td><p class='inline-block bg-purple-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $dtr_logType . "</p></td>";
                                        }
                                        echo "<td =' whitespace-nowrap'>" . $dtr_attendanceTime . "</td>";
                                        echo "</td>";
                                    }
                                ?>

                                <?php 
                                    // $dtrQuery = mysqli_query($conn, $attendance->checkDTR($_SESSION['id']));
                                    // while ($dtrDetails = mysqli_fetch_array($dtrQuery)) {

                                    //     $dtr_id = $dtrDetails['id'];
                                    //     $dtr_attendanceDate = $dtrDetails['attendanceDate'];
                                    //     $dtr_attendanceTime = $dtrDetails['attendanceTime'];
                                    //     $dtr_logType = $dtrDetails['attendanceDate'];
                                    //     $dtr_time = $dtrDetails['attendanceTime'] . ' - ' . $dtrDetails['attendanceTime '];
                                        
                                    // }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    
                </div>  
            </main>
            
        </div>
    
        <script src="../assets/js/user_dtr.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>