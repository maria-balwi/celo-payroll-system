<?php 

    include '../../init.php';
    session_start();
    $conn = $database->dbConnect();

    if (isset($_GET['salary_id'])) {
        $salary_id = mysqli_real_escape_string($conn, $_GET['salary_id']);
        $getSalaryQuery = $payroll->getSalaryInfoAT($salary_id);
        $getSalaryResult = mysqli_query($conn, $getSalaryQuery);

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