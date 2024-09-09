<?php 

    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();
    
    if (isset($_POST['filterYear']) || isset($_POST['filterMonth'])) {
        $filterYear = $_POST['filterYear'];
        $filterMonth = $_POST['filterMonth'];
        $attendanceQuery = mysqli_query($conn, $employees->viewEmployeeAttendance());

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
            $monthlyAttendanceQuery = mysqli_query($conn, $attendance->getMonthlyAttendance($attendance_id, $filterYear, $filterMonth));
            $attendance_daysWorked = mysqli_num_rows($monthlyAttendanceQuery);

            // GET ABSENTS
            $workingDays = $attendance->getWorkingDaysInMonth($filterYear, $filterMonth);
            $attendance_absences = $workingDays - $attendance_daysWorked;

            // GET LATES
            $monthlyLatesQuery = mysqli_query($conn, $attendance->getMonthlyLates($attendance_id, $filterYear, $filterMonth));
            $attendance_lates = mysqli_num_rows($monthlyLatesQuery);

            // GET UNDERTIMES
            $monthlyUndertimesQuery = mysqli_query($conn, $attendance->getMonthlyUndertimes($attendance_id, $filterYear, $filterMonth));
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
            echo "</tr>";
        }
        return;
    }

?>