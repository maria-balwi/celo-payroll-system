<?php 

    include '../../init.php';
    session_start();
    $conn = $database->dbConnect();

    if (isset($_GET['employee_id'])) {
        $employee_id = mysqli_real_escape_string($conn, $_GET['employee_id']);
        $getEmployeeQuery = $employees->getEmployeeInfo($employee_id);
        $getEmployeeResult = mysqli_query($conn, $getEmployeeQuery);

        if(mysqli_num_rows($getEmployeeResult) == 1)
        {
            $employee = mysqli_fetch_array($getEmployeeResult);

            // ALLOWANCES QUERY
            $getEmpAllowancesQuery = $payroll->getAllEmpAllowances($employee_id);
            $getEmpAllowancesResult = mysqli_query($conn, $getEmpAllowancesQuery);
            $allowances = [];
            while ($allowance = mysqli_fetch_array($getEmpAllowancesResult)) {
                $allowances[] = $allowance;
            }

            // DEDUCTIONS QUERY
            $getEmpDeductionsQuery = $payroll->getAllEmpADeductions($employee_id);
            $getEmpDeductionsResult = mysqli_query($conn, $getEmpDeductionsQuery);
            $deductions = [];
            while ($deduction = mysqli_fetch_array($getEmpDeductionsResult)) {
                $deductions[] = $deduction;
            }
            
            $res = [
                'status' => 200,
                'message' => 'Employee Fetch Successfully by id',
                'data' => $employee, 
                'allowances' => $allowances, 
                'deductions' => $deductions
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