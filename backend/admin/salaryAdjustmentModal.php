<?php 

    include '../../init.php';
    session_start();
    $conn = $database->dbConnect();

    if (isset($_GET['salaryadj_id'])) {
        $salaryadj_id = mysqli_real_escape_string($conn, $_GET['salaryadj_id']);
        $getSalaryQuery = $payroll->getSalaryInfoAT($salaryadj_id);
        $getSalaryResult = mysqli_query($conn, $getSalaryQuery);

        if ($getSalaryResult === false) {
            echo json_encode([
                'status' => 404,
                'message' => 'Query failed',
                'sql_error' => mysqli_error($conn),
                'sql' => $getSalaryQuery
            ]);
            exit;
        }

        if(mysqli_num_rows($getSalaryResult) == 1)
        {
            $salaryAdjustment = mysqli_fetch_array($getSalaryResult);
            
            $res = [
                'status' => 200,
                'message' => 'Salaray Adjustment Fetch Successfully by id',
                'data' => $salaryAdjustment
            ];

            echo json_encode($res);
            return;
        }
        else
        {
            $res = [
                'status' => 404,
                'message' => 'Salary Adjustment Id not found'
            ];
            echo json_encode($res);
            return;
        } 
    }
?>