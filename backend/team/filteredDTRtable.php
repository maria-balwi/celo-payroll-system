<?php 

    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();
    
    if (isset($_POST['filterMonth'])) {
        $filterMonth = $_POST['filterMonth'];

        if ($_SESSION['departmentID'] == 1) // GET OPERATIONS TEAM
        {
            $operationsTeamQuery = mysqli_query($conn, $attendance->viewOperationsTeam());
            while ($operationsTeamDetails = mysqli_fetch_array($operationsTeamQuery)) {

                $teamOperations_id = $operationsTeamDetails['id'];
                $teamOperations_employeeID = $operationsTeamDetails['employeeID'];
                $teamOperations_employeeName = $operationsTeamDetails['firstName'] . " " . $operationsTeamDetails['lastName'];
                $teamOperations_shift = $operationsTeamDetails['startTime'] . " - " . $operationsTeamDetails['endTime'];
                $availableSL = $operationsTeamDetails['availableSL']; 
                $availableVL = $operationsTeamDetails['availableVL']; 

                // GET MONTHLY ATTENDANCE
                $monthlyAttendanceQuery = mysqli_query($conn, $attendance->getMonthlyAttendance($teamOperations_id, $filterMonth));
                $monthlyAttendance = mysqli_num_rows($monthlyAttendanceQuery);

                // GET MONTHLY ABSENCES
                $workingDays = $attendance->getWorkingDaysInMonth($filterMonth);
                $monthlyAbsences = $workingDays - $monthlyAttendance;

                // GET MONTHLY LATES
                $monthlyLatesQuery = mysqli_query($conn, $attendance->getMonthlyLates($teamOperations_id, $filterMonth));
                $monthlyLates = mysqli_num_rows($monthlyLatesQuery);

                // GET MONTHLY UNDERTIMES
                $monthlyUndertimesQuery = mysqli_query($conn, $attendance->getMonthlyUndertimes($teamOperations_id, $filterMonth));
                $monthlyUndertimes = mysqli_num_rows($monthlyUndertimesQuery); 

                echo "<tr data-id='" . $teamOperations_id . "' class='teamDTRview cursor-pointer'>";
                echo "<td class='whitespace-nowrap'>" . $teamOperations_employeeID . "</td>";
                echo "<td class='whitespace-nowrap text-left'>" . $teamOperations_employeeName . "</td>";
                echo "<td class='whitespace-nowrap'>" . $teamOperations_shift . "</td>";
                echo "<td class='whitespace-nowrap'>" . $monthlyAttendance . "</td>";
                echo "<td class='whitespace-nowrap'>" . $availableVL . "</td>";
                echo "<td class='whitespace-nowrap'>" . $availableSL . "</td>";
                echo "<td class='whitespace-nowrap'>" . $monthlyAbsences . "</td>";
                echo "<td class='whitespace-nowrap'>" . $monthlyLates . "</td>";
                echo "<td class='whitespace-nowrap'>" . $monthlyUndertimes . "</td>";
                echo "</tr>";
            }
        }
        else // GET IT TEAM
        {
            $itTeamQuery = mysqli_query($conn, $attendance->viewITTeam());
            while ($itTeamDetails = mysqli_fetch_array($itTeamQuery)) {

                $teamIT_id = $itTeamDetails['id'];
                $teamIT_employeeID = $itTeamDetails['employeeID'];
                $teamIT_employeeName = $itTeamDetails['firstName'] . " " . $itTeamDetails['lastName'];
                $teamIT_shift = $itTeamDetails['startTime'] . " - " . $itTeamDetails['endTime'];
                $availableSL = $itTeamDetails['availableSL']; 
                $availableVL = $itTeamDetails['availableVL']; 

                // GET MONTHLY ATTENDANCE
                $monthlyAttendanceQuery = mysqli_query($conn, $attendance->getMonthlyAttendance($teamIT_id, $filterMonth));
                $monthlyAttendance = mysqli_num_rows($monthlyAttendanceQuery);

                // GET MONTHLY ABSENCES
                $workingDays = $attendance->getWorkingDaysInMonth($filterMonth);
                $monthlyAbsences = $workingDays - $monthlyAttendance;

                // GET MONTHLY LATES
                $monthlyLatesQuery = mysqli_query($conn, $attendance->getMonthlyLates($teamIT_id, $filterMonth));
                $monthlyLates = mysqli_num_rows($monthlyLatesQuery);

                // GET MONTHLY UNDERTIMES
                $monthlyUndertimesQuery = mysqli_query($conn, $attendance->getMonthlyUndertimes($teamIT_id, $filterMonth));
                $monthlyUndertimes = mysqli_num_rows($monthlyUndertimesQuery); 

                echo "<tr data-id='" . $teamIT_id . "' class='teamDTRview cursor-pointer'>";
                echo "<td class='whitespace-nowrap'>" . $teamIT_employeeID . "</td>";
                echo "<td class='whitespace-nowrap text-left'>" . $teamIT_employeeName . "</td>";
                echo "<td class='whitespace-nowrap'>" . $teamIT_shift . "</td>";
                echo "<td class='whitespace-nowrap'>" . $monthlyAttendance . "</td>";
                echo "<td class='whitespace-nowrap'>" . $availableVL . "</td>";
                echo "<td class='whitespace-nowrap'>" . $availableSL . "</td>";
                echo "<td class='whitespace-nowrap'>" . $monthlyAbsences . "</td>";
                echo "<td class='whitespace-nowrap'>" . $monthlyLates . "</td>";
                echo "<td class='whitespace-nowrap'>" . $monthlyUndertimes . "</td>";
                echo "</tr>";
            }
        }

        return;
    }

?>