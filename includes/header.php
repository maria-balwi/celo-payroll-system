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
            $lastDTRQuery = mysqli_query($conn, $users->checkLastDTR($_SESSION['id']));
            if (mysqli_num_rows($lastDTRQuery) == 0) {

            }
            else {
                $lastDTR = mysqli_fetch_array($lastDTRQuery);
                $logType = $lastDTR['logType'];
                $attendanceDate = $lastDTR['attendanceDate'];
                $attendanceTime = $lastDTR['attendanceTime'];

                // COMBINE DATE AND TIME
                $dtrDateTime = $attendanceDate . " " . $attendanceTime;
                $dtrDateTime = new DateTime($dtrDateTime);

                // ADD 15 HOURS
                $interval = new DateInterval('PT14H');
                $updatedDateTime = $dtrDateTime->add($interval);

                // SETTING TIME BEFORE GETTING CURRENT DATE AND TIME
                date_default_timezone_set('Asia/Manila');
                $currentDateTime = new DateTime(); 
                
                // SESSION VARIABLE FOR DTR
                $_SESSION['dtr'] = 'forTimeIn';

                if ($logType == "Time In" || $logType == "Late") 
                {
                    if ($currentDateTime < $updatedDateTime) 
                    {
                        $_SESSION['dtr'] = 'forTimeOut';
                    }
                }
                else if ($logType == "Time Out" || $logType == "Undertime")
                {
                    if ($currentDateTime < $updatedDateTime)
                    {
                        $_SESSION['dtr'] = 'forWaiting';
                    }
                }
            }

            // ====== CHECK DATE FOR LEAVE POINTS AND REGULARIZATION ========
            $currentDate = date('Y-m-d');
            static $dateChecker = null;
            static $tomorrow = null;
            static $counter = 0;

            // BEGINNING OF THE YEAR
            $newYear = date('Y-11-22');

            // END OF THE MONTH DATES
            $febMonth = date('Y-02-28');
            $febMonthLY = date('Y-02-29');
            $thirtyDays = date('Y-m-30');
            $thirtyOneDays = date('Y-m-31');

            // Initialize static variables on the first run or if reset
            if ($dateChecker === null || $tomorrow === null) {
                $dateChecker = new DateTime($currentDate);
                $tomorrow = (clone $dateChecker)->modify('+1 day');
            }

            // Check if the current date equals `$dateChecker`'s date
            if ($currentDate == $dateChecker->format('Y-m-d')) {
                $counter++;

                if ($counter == 1) {
                    $employeesQuery = mysqli_query($conn, $employees->viewActiveEmployees());
                    while ($employeeDetails = mysqli_fetch_array($employeesQuery)) {
                        $id = $employeeDetails['id'];
                        $employmentStatus = $employeeDetails['employmentStatus'];

                        // Handle New Year Leave Reset
                        if ($currentDate == $newYear) {
                            $leavePoints = $employeeDetails['leavePoints'];
                            mysqli_query($conn, $employees->resetLeavePoints($id, $leavePoints));
                        }
                        // Handle 31-Day Month Leave Points Addition
                        elseif ($currentDate == $thirtyOneDays) {
                            $vl = $employeeDetails['availableVL'];
                            if ($employmentStatus == "Regular") {
                                $addLeavePoints = ($vl == 10) ? 0.83 : 1.25;
                                mysqli_query($conn, $employees->addLeavePoints($id, $leavePoints));
                            }
                        }

                        // Handle Regularization After 6 Months
                        $dateHired = $employeeDetails['dateHired'];
                        $dateRegularized = new DateTime($dateHired);
                        $dateRegularized->modify('+6 months');
                        $dateRegularized = $dateRegularized->format('Y-m-d');

                        if ($currentDate == $dateRegularized && $employmentStatus == "Probationary") {
                            mysqli_query($conn, $employees->updateEmploymentStatus($id, $dateRegularized));
                        }
                    }
                }
            } elseif ($currentDate == $tomorrow->format('Y-m-d')) {
                // Reset static variables if the date is tomorrow
                $dateChecker = null;
                $tomorrow = null;
                $counter = 0;
            }
            
        ?>
    </head>