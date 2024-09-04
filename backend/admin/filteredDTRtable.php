<?php 

    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();
    
    if (isset($_POST['filterMonth'])) {
        echo $_POST['filterMonth'];
        $filterMonth = $_POST['filterMonth'];
        $attendanceQuery = mysqli_query($conn, $employees->viewEmployeeAttendance());

        $monthlyDTR = [];
        // Generate the table rows based on the filtered data
        while ($attendanceDetails = mysqli_fetch_array($attendanceQuery)) {
            // Your existing code to generate the table rows
            $attendance_id = $attendanceDetails['id'];
            $attendance_employeeName = $attendanceDetails['lastName'] . ", " . $attendanceDetails['firstName'];
            $attendance_employeeID = $attendanceDetails['employeeID'];
            $attendance_shift = $attendanceDetails['startTime'] . " - " . $attendanceDetails['endTime'];
            $attendance_vl = $attendanceDetails['availableVL'];
            $attendance_sl = $attendanceDetails['availableSL'];
            
            // GET DAYS wORKED
            $monthlyAttendanceQuery = mysqli_query($conn, $attendance->getMonthlyAttendance($attendance_id, $filterMonth));
            $attendance_daysWorked = mysqli_num_rows($monthlyAttendanceQuery);

            // GET ABSENTS
            $workingDays = $attendance->getWorkingDaysInMonth($filterMonth);
            $attendance_absences = $workingDays - $attendance_daysWorked;

            // GET LATES
            $monthlyLatesQuery = mysqli_query($conn, $attendance->getMonthlyLates($attendance_id, $filterMonth));
            $attendance_lates = mysqli_num_rows($monthlyLatesQuery);

            // GET UNDERTIMES
            $monthlyUndertimesQuery = mysqli_query($conn, $attendance->getMonthlyUndertimes($attendance_id, $filterMonth));
            $attendance_undertimes = mysqli_num_rows($monthlyUndertimesQuery);

            // $monthlyDTR[] = [
            //     'id' => $attendance_id,
            //     'employeeID' => $attendance_employeeID,
            //     'employeeName' => $attendance_employeeName,
            //     'shift' => $attendance_shift,
            //     'daysWorked' => $attendance_daysWorked,
            //     'availableVL' => $attendance_vl,
            //     'availableSL' => $attendance_sl,
            //     'absences' => $attendance_absences,
            //     'lates' => $attendance_lates,
            //     'undertimes' => $attendance_undertimes
            // ];
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
            echo "</tr>";
        }
        // $res = [
        //     'status' => 200,
        //     'message' => 'Employee Fetch Successfully by id',
        //     'monthlyDTR' => $monthlyDTR
        // ];
        // echo json_encode($res);
        return;
    }
    // else {
    //     $attendanceQuery = mysqli_query($conn, $employees->viewEmployeeAttendance());   
    //     while ($attendanceDetails = mysqli_fetch_array($attendanceQuery)) {

    //         $attendance_id = $attendanceDetails['id'];
    //         $attendance_employeeName = $attendanceDetails['lastName'] . ", " . $attendanceDetails['firstName'];
    //         $attendance_emailAddress = $attendanceDetails['emailAddress'];
    //         $attendance_mobileNumber = $attendanceDetails['mobileNumber'];
    //         $attendance_employeeID = $attendanceDetails['employeeID'];
    //         $attendance_shift = $attendanceDetails['startTime'] . " - " . $attendanceDetails['endTime'];
    //         $attendance_vl = $attendanceDetails['availableVL'];
    //         $attendance_sl = $attendanceDetails['availableSL'];

    //         $month = date('m');

    //         // GET DAYS wORKED
    //         $monthlyAttendanceQuery = mysqli_query($conn, $attendance->getMonthlyAttendance($attendance_id, $month));
    //         $attendance_daysWorked = mysqli_num_rows($monthlyAttendanceQuery);

    //         // GET ABSENTS
    //         $workingDays = $attendance->getWorkingDaysInMonth($month);
    //         $attendance_absences = $workingDays - $attendance_daysWorked;

    //         // GET LATES
    //         $monthlyLatesQuery = mysqli_query($conn, $attendance->getMonthlyLates($attendance_id, $month));
    //         $attendance_lates = mysqli_num_rows($monthlyLatesQuery);

    //         // GET UNDERTIMES
    //         $monthlyUndertimesQuery = mysqli_query($conn, $attendance->getMonthlyUndertimes($attendance_id, $month));
    //         $attendance_undertimes = mysqli_num_rows($monthlyUndertimesQuery);

    //         $monthlyDTR[] = [
    //             'id' => $attendance_id,
    //             'employeeID' => $attendance_employeeID,
    //             'employeeName' => $attendance_employeeName,
    //             'shift' => $attendance_shift,
    //             'daysWorked' => $attendance_daysWorked,
    //             'availableVL' => $attendance_vl,
    //             'availableSL' => $attendance_sl,
    //             'absences' => $attendance_absences,
    //             'lates' => $attendance_lates,
    //             'undertimes' => $attendance_undertimes
    //         ];

    //         // echo "<tr data-id='" . $attendance_id . "' class='employeeDTRview cursor-pointer'>";
    //         // echo "<td class ='whitespace-nowrap'>" . $attendance_employeeID . "</td>";
    //         // echo "<td class ='text-left whitespace-nowrap'>" . $attendance_employeeName . "</td>";
    //         // echo "<td class ='whitespace-nowrap'>" . $attendance_shift . "</td>";
    //         // echo "<td class ='whitespace-nowrap'>". $attendance_daysWorked ."</td>";
    //         // echo "<td class ='whitespace-nowrap'>".$attendance_vl."</td>";
    //         // echo "<td class ='whitespace-nowrap'>".$attendance_sl."</td>";
    //         // echo "<td class ='whitespace-nowrap'>".$attendance_absences."</td>";
    //         // echo "<td class ='whitespace-nowrap'>".$attendance_lates."</td>";
    //         // echo "<td class ='whitespace-nowrap'>".$attendance_undertimes."</td>";
    //         // echo "</tr>";
    //     }
    //     $res = [
    //         'status' => 200,
    //         'message' => 'Employee Fetch Successfully by id',
    //         'monthlyDTR' => $monthlyDTR
    //     ];
    //     echo json_encode($res);
    //     return;
    // }

?>