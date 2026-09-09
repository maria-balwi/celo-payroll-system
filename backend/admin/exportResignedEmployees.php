<?php
    include '../../init.php';
    session_start();
    $conn = $database->dbConnect();

    $payrollCycleID = $_GET['payrollCycleID'];
    $query = mysqli_query($conn, $employees->getAllResignedEmployeesForThisCutOff($payrollCycleID));

    // WIPE OUT ANY OUTPUT THAT LEAKED BEFORE THIS POINT
    if (ob_get_length()) {
        ob_end_clean();
    }

    // CSV HEADERS
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=ResignedEmployeeList_' . date('Y-m-d') . '.csv');
    header('Pragma: no-cache');
    header('Expires: 0');

    $output = fopen('php://output', 'w');

    // HEADER ROW
    fputcsv($output, ['Name', 'Email', 'Employee ID']);

    // DATA ROWS
    while ($employeeDetails = mysqli_fetch_array($query)) {
        $name = $employeeDetails['lastName'] . ', ' . $employeeDetails['firstName'];
        fputcsv($output, [
            $name, 
            $employeeDetails['emailAddress'],
            $employeeDetails['employeeID']
        ]); 
    }

    fclose($output);
    exit();
?>