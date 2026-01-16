<?php 

    include '../../init.php';
    session_start();
    $conn = $database->dbConnect();

    if (isset($_GET['holiday_id'])) {
        $holiday_id = mysqli_real_escape_string($conn, $_GET['holiday_id']);
        $getHolidayQuery = $payroll->getHolidayInfo($holiday_id);
        $getHolidayResult = mysqli_query($conn, $getHolidayQuery);

        if(mysqli_num_rows($getHolidayResult) == 1)
        {
            $holiday = mysqli_fetch_array($getHolidayResult);
            
            $res = [
                'status' => 200,
                'message' => 'Holiday Fetch Successfully by id',
                'data' => $holiday
            ];

            echo json_encode($res);
            return;
        }
        else
        {
            $res = [
                'status' => 404,
                'message' => 'Holiday id not found'
            ];
            echo json_encode($res);
            return;
        } 
    }
?>