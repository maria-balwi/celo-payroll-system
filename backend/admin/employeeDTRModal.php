<?php 

    include '../../init.php';
    session_start();
    $conn = $database->dbConnect();

    if (isset($_GET['employee_id'])) {
        $employee_id = mysqli_real_escape_string($conn, $_GET['employee_id']);
        $getEmployeeQuery = $attendance->getEmployeeInfo($employee_id);
        $getEmployeeResult = mysqli_query($conn, $getEmployeeQuery);

        if(mysqli_num_rows($getEmployeeResult) == 1)
        {
            $employee = mysqli_fetch_array($getEmployeeResult);

            $yearMonth = date('Y-m');

            $employeeQuery = mysqli_query($conn, $employees->viewDTR($employee_id, $yearMonth));
            $employeeDTR = [];
            while ($employeeResult = mysqli_fetch_array($employeeQuery)) {
                $employeeDTR[] = $employeeResult;
            }
            
            $res = [
                'status' => 200,
                'message' => 'Employee Fetch Successfully by id',
                'data' => $employee, 
                'employeeDTR' => $employeeDTR
            ];

            echo json_encode($res);
            return;
        }
        else
        {
            $res = [
                'status' => 404,
                'message' => 'Employee Id not found'
            ];
            echo json_encode($res);
            return;
        } 
    }
?>