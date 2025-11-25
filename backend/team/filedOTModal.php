<?php 

    include '../../init.php';
    session_start();
    $conn = $database->dbConnect();

    if (isset($_GET['ot_id'])) {
        $ot_id = mysqli_real_escape_string($conn, $_GET['ot_id']);
        $getFiledOTQuery = $employees->getOTInfo($ot_id);
        $getFiledOTResult = mysqli_query($conn, $getFiledOTQuery);

        if(mysqli_num_rows($getFiledOTResult) == 1)
        {
            $ot = mysqli_fetch_array($getFiledOTResult);
            
            $res = [
                'status' => 200,
                'message' => 'Filed OT Fetch Successfully by id',
                'data' => $ot
            ];

            echo json_encode($res);
            return;
        }
        else
        {
            $res = [
                'status' => 404,
                'message' => 'OT id not found'
            ];
            echo json_encode($res);
            return;
        } 
    }
?>