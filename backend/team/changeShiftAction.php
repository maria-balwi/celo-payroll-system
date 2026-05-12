<?php 
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $changeshift_id = $_POST['id_changeshift'];
    $action = $_POST['action'];

    if ($action == "approve") {
        mysqli_query($conn, $employees->approveChangeShift($changeshift_id));

        // GET AFFECTED USER
        $getChangeshiftQuery = mysqli_query($conn, $employees->viewChangeShiftInfo($changeshift_id));
        $changeShiftResult = mysqli_fetch_array($getChangeshiftQuery);
        $id = $changeShiftResult['empID'];
        $requestedShift = $changeShiftResult['requestedShift'];

        if ($changeShiftResult['effectivityStartDate'] == '' && $changeShiftResult['effectivityEndDate'] == '') {
            mysqli_query($conn, $employees->updateShift($id, $requestedShift));
        }
        else {
            // // FIND LAST WEEK OFF BEFORE NEW SHIFT
            // $checkWeekOffQuery = mysqli_query($conn, "SELECT 
            //     DATE_SUB('{$changeShiftResult['effectivityStartDate']}', INTERVAL 1 DAY) AS possibleOff1,
            //     DATE_SUB('{$changeShiftResult['effectivityStartDate']}', INTERVAL 2 DAY) AS possibleOff2");
            // $checkWeekOffResult = mysqli_fetch_array($checkWeekOffQuery);
            
            // // CHECK WHICH DATE IS WEEK OFF
            // $checkWeekOffQuery = mysqli_query($conn, "SELECT * FROM tbl_empweekoff WHERE empID = {$id} AND dayName = DAYNAME('{$checkWeekOffResult['possibleOff1']}')");
            // $checkWeekOffResult = mysqli_fetch_array($checkWeekOffQuery);
            
            // // INSERT TRANSITION DAY RECORD
            // $transitionDate = date('Y-m-d', strtotime($checkWeekOffResult['possibleOff1'] . ' + 1 day'));
            // mysqli_query($conn, $employees->insertTransitionDay($id, $transitionDate));

            // GET EMPLOYEE WEEK OFF
            $getWeekOffQuery = mysqli_query($conn, "SELECT * FROM tbl_empweekoff WHERE empID = '$id'");
            $weekOff = mysqli_fetch_array($getWeekOffQuery);

            // FIND LAST WEEK OFF BEFORE THE NEW SHIFT
            $lastOffDate = null;

            for($i = 1; $i <= 7; $i++){
                $checkDate = date('Y-m-d', strtotime($changeShiftResult['dateFiled'] . " +$i day"));
                $day = strtolower(date('D', strtotime($checkDate)));

                switch($day){
                    case 'mon':
                        $isOff = $weekOff['wo_mon'];
                        break;

                    case 'tue':
                        $isOff = $weekOff['wo_tue'];
                        break;

                    case 'wed':
                        $isOff = $weekOff['wo_wed'];
                        break;

                    case 'thu':
                        $isOff = $weekOff['wo_thu'];
                        break;

                    case 'fri':
                        $isOff = $weekOff['wo_fri'];
                        break;

                    case 'sat':
                        $isOff = $weekOff['wo_sat'];
                        break;

                    case 'sun':
                        $isOff = $weekOff['wo_sun'];
                        break;

                    default:
                        $isOff = 0;
                }

                // FOUND LAST WEEK OFF
                if($isOff == 1){
                    $lastOffDate = $checkDate;
                }
            }

            // CREATE TRANSITION DAY
            if($lastOffDate != null){
                $transitionDate = date('Y-m-d', strtotime($lastOffDate . ' +1 day'));
                mysqli_query($conn, $employees->insertTransitionDay($id, $transitionDate));
            }
        }

        // AUDIT TRAIL
        $at_empID = $_SESSION['id'];
        $at_module = "Team - Change Shift Request";
        $at_action = "Approved Request";
        mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $id));
        
        // ERROR MESSAGE
        $em = "Change Shift Request Approved Successfully";
        // RESPONSE ARRAY
        $error = array('error' => 0, 'em' => $em);
    }

    else if ($action == "disapprove") {
        mysqli_query($conn, $employees->disapproveChangeShift($changeshift_id));

        // GET AFFECTED USER
        $getChangeshiftQuery = mysqli_query($conn, $employees->viewChangeShiftInfo($changeshift_id));
        $changeShiftResult = mysqli_fetch_array($getChangeshiftQuery);
        $id = $changeShiftResult['empID'];
        $requestedShift = $changeShiftResult['requestedShift'];
        mysqli_query($conn, $employees->updateShift($id, $requestedShift));
        
        // AUDIT TRAIL
        $at_empID = $_SESSION['id'];
        $at_module = "Team - Change Shift Request";
        $at_action = "Disapproved Request";
        mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $id));

        // ERROR MESSAGE
        $em = "Change Shift Request Disapproved Successfully";
        // RESPONSE ARRAY
        $error = array('error' => 0, 'em' => $em);
    }
    
    echo json_encode($error);
    exit();
?>