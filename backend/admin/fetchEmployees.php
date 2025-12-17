<?php 
    include '../../init.php';
    session_start();
    $conn = $database->dbConnect();

    if (isset($_GET['employeeID'])) {
        $employeeID = mysqli_real_escape_string($conn, $_GET['employeeID']);
        $fetchEmployeeQuery = $employees->searchEmployeeID($employeeID);
        $fetchEmployeeResult = mysqli_query($conn, $fetchEmployeeQuery);

        if (mysqli_num_rows($fetchEmployeeResult) == 1) 
        {
            $fetchEmployee = mysqli_fetch_array($fetchEmployeeResult);
            $res = [
                'status' => 200,
                'message' => 'Employee Fetch Successfully by id',
                'data' => $fetchEmployee
            ];
            echo json_encode($res);
            return;
        }
        else 
        {
            $res = [
                'status' => 404,
                'message' => 'Employee not found'
            ];
            echo json_encode($res);
            return;
        }
    }
?>