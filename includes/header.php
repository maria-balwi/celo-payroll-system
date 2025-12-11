<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- STYLESHEET -->
        <link href="../assets/styles/output.css" rel="stylesheet">
        <link href="../assets/styles/global-styles.css" rel="stylesheet">

        <!-- TAILWIND CSS DATATABLES WITH JQUERY -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

        <!-- SWEET ALERT 2 -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.all.min.js"></script>
              
        <!-- WEBSITE LOGO AND TITLE -->
        <link rel="icon" href="../assets/images/logo.png" type="image/icon type">
        <title>Celo Payroll System</title>
        
        <?php 
            include '../init.php';
            $conn = $database->dbConnect();
            session_start();

            // CHECKS IF SOMEONE IS LOGGED IN
            if (!($users->isLoggedIn())) {
                // FALSE
                header("Location: ../index.php");
            }

            // ====== CHECK LAST DTR INFO ========
            // FETCH DATA FROM DATABASE
            if ($_SESSION['levelID'] == 0) {
                $_SESSION['dtr'] = 'forWaiting';
            }
            else {
                $lastDTRQuery = mysqli_query($conn, $users->checkLastDTR($_SESSION['id']));
                date_default_timezone_set('Asia/Manila');
                if (mysqli_num_rows($lastDTRQuery) == 0) {
                    $_SESSION['dtr'] = 'forTimeIn';
                }
                else {
                    $lastDTR = mysqli_fetch_array($lastDTRQuery);
                    $logType = $lastDTR['logType'];
                    $attendanceDate = $lastDTR['attendanceDate'];
                    $attendanceTime = $lastDTR['attendanceTime'];
                    $shiftStart = $lastDTR['startTime'];
                    $shiftEnd = $lastDTR['endTime'];
                    $attendanceDateTime = new DateTime($attendanceDate . " " . $attendanceTime);

                    // INTERVAL AFTER SHIFT FOR POSSIBLE OVERTIME BEFORE AUTOMATIC TIMEOUT
                    // COMBINE DATE AND TIME
                    $dtrDateTime = $attendanceDate . " " . $shiftStart;
                    $dtrDateTime = new DateTime($dtrDateTime);

                    // SETTING TIME BEFORE GETTING CURRENT DATE AND TIME
                    $currentDateTime = new DateTime(); 

                    // ADD 8 HOURS TO ALLOW OVERTIME SUBMISSION
                    $interval = new DateInterval('PT17H');
                    $dtrDateTime->add($interval);
                    // SESSION VARIABLE FOR DTR
                    $_SESSION['dtr'] = 'forTimeIn';

                    if ($logType == "Time In" || $logType == "Late") 
                    {
                        // // CAN TIME OUT ANYTIME
                        // $_SESSION['dtr'] = 'forTimeOut';

                        if ($currentDateTime < $dtrDateTime) 
                        {
                            $_SESSION['dtr'] = 'forTimeOut';
                        }
                        else {
                            $assumedTimeIn = $attendanceDate . " " . $shiftStart;
                            $assumedTimeIn = new DateTime($assumedTimeIn);

                            $endOfShiftInterval = new DateInterval('PT9H');
                            $assumedTimeIn->add($endOfShiftInterval);

                            $newAttendanceDate = $assumedTimeIn->format('Y-m-d');

                            mysqli_query($conn, $attendance->addEmployeeTimeOut($_SESSION['id'], $newAttendanceDate, $shiftEnd));
                        }
                    }
                    else if ($logType == "Time Out" || $logType == "Undertime")
                    {
                        // // ADD 2 HOURS INTERVAL AFTER TIME OUT
                        // $interval = new DateInterval('PT2H');
                        // $updatedDateTime = $dtrDateTime->add($interval);

                        // if ($currentDateTime < $updatedDateTime)
                        // {
                        //     $_SESSION['dtr'] = 'forWaiting';
                        // }

                        $_SESSION['dtr'] = 'forTimeIn';
                    }
                }
            }
                
            // ====== CHECK DATE FOR LEAVE POINTS AND REGULARIZATION ========
            $payroll->runLeaveManagement();

            // ====== CHECK DATE FOR LEAVE POINTS AND REGULARIZATION ========
            $version = $users->cacheBusting();

            // SET TIMEZONE
            date_default_timezone_set('Asia/Manila');

        ?>
    </head>