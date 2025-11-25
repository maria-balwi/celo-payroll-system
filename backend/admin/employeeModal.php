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

            // REIMBURSEMENTS QUERY
            $getEmpReimbursementsQuery = $payroll->getAllEmpReimbursements($employee_id);
            $getEmpReimbursementsResult = mysqli_query($conn, $getEmpReimbursementsQuery);
            $reimbursements = [];
            while ($reimbursement = mysqli_fetch_array($getEmpReimbursementsResult)) {
                $reimbursements[] = $reimbursement;
            }

            // DEDUCTIONS QUERY
            $getEmpDeductionsQuery = $payroll->getAllEmpADeductions($employee_id);
            $getEmpDeductionsResult = mysqli_query($conn, $getEmpDeductionsQuery);
            $deductions = [];
            while ($deduction = mysqli_fetch_array($getEmpDeductionsResult)) {
                $deductions[] = $deduction;
            }

            // ADJUSTMENTS QUERY
            $getEmpAdjustmentsQuery = $payroll->getAllEmpAdjustments($employee_id);
            $getEmpAdjustmentsResult = mysqli_query($conn, $getEmpAdjustmentsQuery);
            $adjustments = [];
            while ($adjustment = mysqli_fetch_array($getEmpAdjustmentsResult)) {
                $adjustments[] = $adjustment;
            }
            
            $res = [
                'status' => 200,
                'message' => 'Employee Fetch Successfully by id',
                'data' => $employee, 
                'allowances' => $allowances, 
                'reimbursements' => $reimbursements,
                'deductions' => $deductions, 
                'adjustments' => $adjustments
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