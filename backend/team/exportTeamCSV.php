<?php
    include '../../init.php';
    session_start();
    $conn = $database->dbConnect();

    if ($_SESSION['departmentID'] == 1) { // OPERATIONS TEAM
        if ($_SESSION['designationID'] == 5) {
            $teamQuery = mysqli_query($conn, $employees->viewTeamOperations());
        }
        else {
            $teamQuery = mysqli_query($conn, $employees->viewOperationsTLTeam($_SESSION['teamID']));
        }
    }
    else { // IT TEAM
        $teamQuery = mysqli_query($conn, $employees->viewTeamIT());
    }

    // WIPE OUT ANY OUTPUT THAT LEAKED BEFORE THIS POINT
    if (ob_get_length()) {
        ob_end_clean();
    }

    // CSV HEADERS
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=team_export_' . date('Y-m-d') . '.csv');
    header('Pragma: no-cache');
    header('Expires: 0');

    $output = fopen('php://output', 'w');

    // HEADER ROW
    fputcsv($output, ['Name', 'Email', 'Employee ID', 'Shift - In', 'Shift - Out']);

    // DATA ROWS
    while ($teamDetails = mysqli_fetch_array($teamQuery)) {
        $name = $teamDetails['lastName'] . ', ' . $teamDetails['firstName'];
        fputcsv($output, [
            $name, 
            $teamDetails['emailAddress'],
            $teamDetails['employeeID'], 
            $teamDetails['startTime'], 
            $teamDetails['endTime']
        ]); 
    }

    fclose($output);
    exit();
?>