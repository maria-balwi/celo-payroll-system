<?php 

    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();
    
    if (isset($_POST['filterYear']) || isset($_POST['filterMonth'])) {
        $yearMonth = $_POST['filterYear'] . '-' . $_POST['filterMonth'];
        $userDTRQuery = mysqli_query($conn, $employees->viewDTR($_SESSION['id'], $yearMonth));

        $dtrGroupedByDate = [];
        $ongoingShift = null;

        while ($userDTRdetails = mysqli_fetch_array($userDTRQuery)) {
            $date = $userDTRdetails['attendanceDate'];
            $time = $userDTRdetails['attendanceTime'];
            $logTypeID = $userDTRdetails['logTypeID'];
            $dayOfWeek = $userDTRdetails['dayOfWeek'];
            $filterDate = $userDTRdetails['filterDate'];
            $shift = $userDTRdetails['shift'];
            $logType = $userDTRdetails['logType'];

            $sortableDate = date('Y/m/d', strtotime($date));

            // Check if the date exists in the dtrGroupedByDate array
            if (!isset($dtrGroupedByDate[$sortableDate])) {
                $dtrGroupedByDate[$sortableDate] = [
                    'timeIn' => null, 
                    'timeOut' => null, 
                    'dayOfWeek' => $dayOfWeek, 
                    'logTypeIn' => null,
                    'logTypeOut' => null,
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
                    $dtrGroupedByDate[$sortableDate]['logTypeIn'] = $logType;
                }
                $ongoingShift = ['date' => $sortableDate, 'timeIn' => $time]; // Start new shift
            }

            // Handle Time Out (LogTypeID 3 or 4)
            if ($logTypeID == 3 || $logTypeID == 4) {
                if ($ongoingShift && $ongoingShift['date'] !== $sortableDate) {
                    // Time out belongs to the ongoing shift from the previous day
                    $dtrGroupedByDate[$ongoingShift['date']]['timeOut'] = $time;
                    $dtrGroupedByDate[$ongoingShift['date']]['timeOutDate'] = $filterDate;
                    $dtrGroupedByDate[$sortableDate]['logTypeOut'] = $logType;
                    $ongoingShift = null; // Reset ongoing shift
                } else {
                    $dtrGroupedByDate[$sortableDate]['timeOut'] = $time;
                    $dtrGroupedByDate[$sortableDate]['timeOutDate'] = $filterDate;
                    $dtrGroupedByDate[$sortableDate]['logTypeOut'] = $logType;
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
            $logTypeIn = $dtr['logTypeIn'];
            $logTypeOut = $dtr['logTypeOut'];
        
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
            if ($logTypeIn == 'Late') {
                echo '<td class="whitespace-nowrap">' . $timeIn . '<p class="inline-block bg-yellow-500 text-white px-2 mx-2 my-auto rounded-full text-sm">Late</p></td>';
            }
            else {
                echo '<td class="whitespace-nowrap">' . $timeIn . '</td>';
            }
            if ($logTypeOut == 'Undertime') {
                echo '<td class="whitespace-nowrap">' . $timeOut . '<p class="inline-block bg-purple-500 text-white px-2 mx-2 my-auto rounded-full text-sm">Undertime</p></td>';
            }
            else {
                echo '<td class="whitespace-nowrap">' . $timeOut . '</td>';
            }
            echo '</tr>';
        }
    }

?>