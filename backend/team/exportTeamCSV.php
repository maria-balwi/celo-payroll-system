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

    // CSV HEADERS
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=team_export_' . date('Y-m-d') . '.csv');

    $output = fopen('php://output', 'w');

    // HEADER ROW
    fputcsv($output, ['Name', 'Email', 'Employee ID']);


    // DATA ROWS
    while ($teamDetails = mysqli_fetch_array($teamQuery)) {
        $name = $teamDetails['firstName'] . ' ' . $teamDetails['lastName'];
        fputcsv($output, [
            $name, 
            $teamDetails['email'],, 
            $teamDetails['employeeID']
        ]); 
    }

    fclose($output);
    exit();
?>