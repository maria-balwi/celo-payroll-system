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
                <div class="flex flex-1 p-2 text-2xl font-bold items-center">
                    <div>
                        Daily Time Records
                    </div>    

                    <!-- <div class="static inline-block text-right ml-3">
                        <select class="form-select inline-flex justify-center rounded-md border border-gray-300 shadow-sm pr-4 bg-white text-sm font-medium text-gray-700">
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                        </select>
                    </div> -->

                    <div class="static inline-block text-right ml-3 mr-1">
                        <select id="filterMonth" class="form-select inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-6 bg-white text-sm font-medium text-gray-700">
                            <!-- <option disabled selected>Select Payroll Cycle FROM</option> -->
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
                <div class="p-4 m-0 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">

                    <!-- DATATABLE -->
                    <div class="container mx-auto overflow-auto">
                        <table id="dtrTable" class="table text-center table-striped table-bordered table-auto pt-3" style="width: 100%;">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Face DTR</th>
                                    <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Day</th>
                                    <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Shift</th>
                                    <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Time In</th>
                                    <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Time Out</th>
                                    
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="userDTRsection">
                                <?php
                                    if (isset($_POST['filterMonth'])) {
                                        $yearMonth = date('Y-') . $_POST['filterMonth'];
                                        $userDTRQuery = mysqli_query($conn, $employees->viewDTR($_SESSION['id'], $yearMonth));

                                        $dtrGroupedByDate = [];
                                        $ongoingShift = null;

                                        while ($userDTRdetails = mysqli_fetch_array($userDTRQuery)) {
                                            $date = $userDTRdetails['attendanceDate'];
                                            $time = $userDTRdetails['attendanceTime'];
                                            $logTypeID = $userDTRdetails['logTypeID'];
                                            $dayOfWeek = $userDTRdetails['dayOfWeek'];
                                            $filterDate = $userDTRdetails['filterDate'];
                                            // $shift = $userDTRdetails['startTime'] . ' - ' . $userDTRdetails['endTime'];
                                            $shift = $userDTRdetails['shift'];

                                            $sortableDate = date('Y/m/d', strtotime($date));

                                            // Check if the date exists in the dtrGroupedByDate array
                                            if (!isset($dtrGroupedByDate[$sortableDate])) {
                                                $dtrGroupedByDate[$sortableDate] = [
                                                    'timeIn' => null, 
                                                    'timeOut' => null, 
                                                    'dayOfWeek' => $dayOfWeek, 
                                                    'timeInDate' => null, 
                                                    'timeOutDate' => null,
                                                    'shift' => $shift, 
                                                    'displayDate' => $date
                                                ];
                                            }
                                            
                                            // Handle Time In (LogTypeID 1 or 2)
                                            if ($logTypeID == 1 || $logTypeID == 2) {
                                                if (!$dtrGroupedByDate[$sortableDate]['timeIn'] || $time < $dtrGroupedByDate[$sortableDate]['timeIn']) {
                                                    $dtrGroupedByDate[$sortableDate]['timeIn'] = $time;
                                                    $dtrGroupedByDate[$sortableDate]['dayOfWeek'] = $dayOfWeek;
                                                    $dtrGroupedByDate[$sortableDate]['timeInDate'] = $filterDate;
                                                }
                                                $ongoingShift = ['date' => $sortableDate, 'timeIn' => $time]; // Start new shift
                                            }

                                            // Handle Time Out (LogTypeID 3 or 4)
                                            if ($logTypeID == 3 || $logTypeID == 4) {
                                                if ($ongoingShift && $ongoingShift['date'] !== $sortableDate) {
                                                    // Time out belongs to the ongoing shift from the previous day
                                                    $dtrGroupedByDate[$ongoingShift['date']]['timeOut'] = $time;
                                                    $dtrGroupedByDate[$ongoingShift['date']]['timeOutDate'] = $filterDate;
                                                    $ongoingShift = null; // Reset ongoing shift
                                                } else {
                                                    $dtrGroupedByDate[$sortableDate]['timeOut'] = $time;
                                                    $dtrGroupedByDate[$sortableDate]['timeOutDate'] = $filterDate;
                                                }
                                            }
                                        }

                                        ksort($dtrGroupedByDate);
                                        $timeInDate = null;
                                        $timeOutDate = null;

                                        foreach ($dtrGroupedByDate as $date => $dtr) {
                                            $dayOfWeek = $dtr['dayOfWeek'];
                                            $timeIn = $dtr['timeIn'] !== null ? $dtr['timeIn'] : '-';
                                            $timeOut = $dtr['timeOut'] !== null ? $dtr['timeOut'] : '-';
                                            $timeInDate = $dtr['timeInDate'];
                                            $timeOutDate = $dtr['timeOutDate'];
                                        
                                            // Create faceDTR button only if timeIn is not null
                                            $faceDTRhtml = '
                                                <button class="whitespace-nowrap viewFaceDTR" data-id="' . $timeInDate . '" data-id2="' . $timeOutDate . '" data-id3="' . $_SESSION['employeeID'] . '">
                                                    <svg class="h-6 w-6 text-gray-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    </svg>
                                                </button>';
                                        
                                            $faceDTR = $dtr['timeIn'] !== null || $dtr['timeOut'] !== null ? $faceDTRhtml : '';

                                            // Directly output the table row
                                            echo '<tr>';
                                            echo '<td class="whitespace-nowrap">' . $faceDTR . '</td>';
                                            echo '<td class="whitespace-nowrap">' . $date . '</td>';
                                            echo '<td class="whitespace-nowrap">' . $dayOfWeek . '</td>';
                                            echo '<td class="whitespace-nowrap">' . $shift . '</td>';
                                            echo '<td class="whitespace-nowrap">' . $timeIn . '</td>';
                                            echo '<td class="whitespace-nowrap">' . $timeOut . '</td>';
                                            echo '</tr>';
                                        }
                                    }
                                    else {
                                        $yearMonth = date('Y-m');
                                        $userDTRQuery = mysqli_query($conn, $employees->viewDTR($_SESSION['id'], $yearMonth));

                                        $dtrGroupedByDate = [];
                                        $ongoingShift = null;

                                        while ($userDTRdetails = mysqli_fetch_array($userDTRQuery)) {
                                            $date = $userDTRdetails['attendanceDate'];
                                            $time = $userDTRdetails['attendanceTime'];
                                            $logTypeID = $userDTRdetails['logTypeID'];
                                            $dayOfWeek = $userDTRdetails['dayOfWeek'];
                                            $filterDate = $userDTRdetails['filterDate'];
                                            // $shift = $userDTRdetails['startTime'] . ' - ' . $userDTRdetails['endTime'];
                                            $shift = $userDTRdetails['shift'];

                                            $sortableDate = date('Y/m/d', strtotime($date));

                                            // Check if the date exists in the dtrGroupedByDate array
                                            if (!isset($dtrGroupedByDate[$sortableDate])) {
                                                $dtrGroupedByDate[$sortableDate] = [
                                                    'timeIn' => null, 
                                                    'timeOut' => null, 
                                                    'dayOfWeek' => $dayOfWeek, 
                                                    'timeInDate' => null, 
                                                    'timeOutDate' => null,
                                                    'shift' => $shift, 
                                                    'displayDate' => $date
                                                ];
                                            }
                                            
                                            // Handle Time In (LogTypeID 1 or 2)
                                            if ($logTypeID == 1 || $logTypeID == 2) {
                                                if (!$dtrGroupedByDate[$sortableDate]['timeIn'] || $time < $dtrGroupedByDate[$sortableDate]['timeIn']) {
                                                    $dtrGroupedByDate[$sortableDate]['timeIn'] = $time;
                                                    $dtrGroupedByDate[$sortableDate]['dayOfWeek'] = $dayOfWeek;
                                                    $dtrGroupedByDate[$sortableDate]['timeInDate'] = $filterDate;
                                                }
                                                $ongoingShift = ['date' => $sortableDate, 'timeIn' => $time]; // Start new shift
                                            }

                                            // Handle Time Out (LogTypeID 3 or 4)
                                            if ($logTypeID == 3 || $logTypeID == 4) {
                                                if ($ongoingShift && $ongoingShift['date'] !== $sortableDate) {
                                                    // Time out belongs to the ongoing shift from the previous day
                                                    $dtrGroupedByDate[$ongoingShift['date']]['timeOut'] = $time;
                                                    $dtrGroupedByDate[$ongoingShift['date']]['timeOutDate'] = $filterDate;
                                                    $ongoingShift = null; // Reset ongoing shift
                                                } else {
                                                    $dtrGroupedByDate[$sortableDate]['timeOut'] = $time;
                                                    $dtrGroupedByDate[$sortableDate]['timeOutDate'] = $filterDate;
                                                }
                                            }
                                        }

                                        ksort($dtrGroupedByDate);
                                        $timeInDate = null;
                                        $timeOutDate = null;

                                        foreach ($dtrGroupedByDate as $date => $dtr) {
                                            $dayOfWeek = $dtr['dayOfWeek'];
                                            $timeIn = $dtr['timeIn'] !== null ? $dtr['timeIn'] : '-';
                                            $timeOut = $dtr['timeOut'] !== null ? $dtr['timeOut'] : '-';
                                            $timeInDate = $dtr['timeInDate'];
                                            $timeOutDate = $dtr['timeOutDate'];
                                        
                                            // Create faceDTR button only if timeIn is not null
                                            $faceDTRhtml = '
                                                <button class="whitespace-nowrap viewFaceDTR" data-id="' . $timeInDate . '" data-id2="' . $timeOutDate . '" data-id3="' . $_SESSION['employeeID'] . '">
                                                    <svg class="h-6 w-6 text-gray-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    </svg>
                                                </button>';
                                        
                                            $faceDTR = $dtr['timeIn'] !== null || $dtr['timeOut'] !== null ? $faceDTRhtml : '';

                                            // Directly output the table row
                                            echo '<tr>';
                                            echo '<td class="whitespace-nowrap">' . $faceDTR . '</td>';
                                            echo '<td class="whitespace-nowrap">' . $date . '</td>';
                                            echo '<td class="whitespace-nowrap">' . $dayOfWeek . '</td>';
                                            echo '<td class="whitespace-nowrap">' . $shift . '</td>';
                                            echo '<td class="whitespace-nowrap">' . $timeIn . '</td>';
                                            echo '<td class="whitespace-nowrap">' . $timeOut . '</td>';
                                            echo '</tr>';
                                        }
                                    }

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