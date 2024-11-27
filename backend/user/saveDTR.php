<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    if (isset($_POST['imgBase64'])) {
        $img = $_POST['imgBase64'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);

        $id = $_SESSION['id'];
        $faceDTR_action = $_POST['faceDTR_action'];

        $shiftQuery = mysqli_query($conn, $users->getShiftInfo($id));
        $shiftResult = mysqli_fetch_array($shiftQuery); 
        $startTime = $shiftResult['startTime'];
        $endTime = $shiftResult['endTime'];

        // SETTING TIMEZONE
        date_default_timezone_set('Asia/Manila');
        $currentDate = date('Y-m-d'); // Actual current date
        $currentTime = date('H:i:s'); // Actual current time

        // Convert the startTime and currentTime to timestamps
        $startTimeModified = strtotime($startTime);
        $endTimeModified = strtotime($endTime);
        $currentTimeModified = strtotime($currentTime);

        $lateMins = 0; // Default value for late minutes

        $lastAttendanceQuery = mysqli_query($conn, $users->checkLastDTR($id));
        $lastAttendance = mysqli_fetch_array($lastAttendanceQuery);
        $lastLogType = $lastAttendance['logTypeID'];
        // SETTING LOG TYPE ID BASED ON ACTION
        if ($faceDTR_action == 'time_in') {
            if ($lastLogType == 3 || $lastLogType == 4 || $lastLogType == 0) {
                $logTypeID = ($currentTimeModified <= $startTimeModified) ? 1 : 2;
                if ($logTypeID == 2) {
                    // Calculate the late minutes
                    $lates = $currentTimeModified - $startTimeModified;
                    $lateMins = floor($lates / 60); // Get late minutes

                    // Handle case if late minutes are negative
                    if ($lateMins < 0) {
                        $lateMins = 0; // Reset to 0 if negative
                    }
                }
            }
            else if ($lastLogType == 1 || $lastLogType == 2 || $lastLogType == 0) {
                $lastAttendanceDate = $lastAttendance['attendanceDate'];
                echo $lastAttendanceDate;
                $lastAttendanceTime = $lastAttendance['attendanceTime'];

                // Create DateTime objects from the original date and time
                $lastAttendanceDateModified = new DateTime($lastAttendanceDate);
                $lastAttendanceTimeModified = new DateTime($lastAttendanceTime);

                // Drop the minutes from the time
                $lastAttendanceTimeModified->setTime($lastAttendanceTimeModified->format('H'), 0, 0);

                // Define midnight for comparison
                $midnight = new DateTime("00:00:00");

                // Modify time and adjust date if needed based on log type
                if ($lastLogType == 1) {
                    $lastAttendanceTimeModified->modify('+10 hours');
                } else {
                    $lastAttendanceTimeModified->modify('+9 hours');
                }

                // Check if the time is past midnight and adjust the date
                if ($lastAttendanceTimeModified->format('H') < 9) {
                    // date adjusted to next day
                    $lastAttendanceDateModified->modify('+1 day');
                }

                // Format date and time for the database
                $lastAttendanceTimeModified = $lastAttendanceTimeModified->format('H:i:s');
                $lastAttendanceDateModified = $lastAttendanceDateModified->format('Y-m-d');

                // Execute the query
                mysqli_query($conn, $users->saveMissingDTR($_SESSION['id'], 4, $lastAttendanceDateModified, $lastAttendanceTimeModified));

                echo "<br>";
                echo "Modified Date: " . $lastAttendanceDateModified . "<br>";
                echo "Modified Time: " . $lastAttendanceTimeModified . "<br>";

                $logTypeID = ($currentTimeModified <= $startTimeModified) ? 1 : 2;
                if ($logTypeID == 2) {
                    // Calculate the late minutes
                    $lates = $currentTimeModified - $startTimeModified;
                    $lateMins = floor($lates / 60); // Get late minutes

                    // Handle case if late minutes are negative
                    if ($lateMins < 0) {
                        $lateMins = 0; // Reset to 0 if negative
                    }
                }
            }
            
        }
        else if ($faceDTR_action == 'time_out') {
            $logTypeID = ($currentTime >= $endTime) ? 4 : 3;
            if ($logTypeID == 3) {
                // Calculate the undertime minutes
                $undertimes = $endTimeModified - $currentTimeModified;
                $undertimeMins = floor($undertimes / 60); // Get undertime minutes

                // Handle case if undertime minutes are negative
                if ($undertimeMins < 0) {
                    $undertimeMins = 0; // Reset to 0 if negative
                }
            }
        }

        // ENSURE THE 'ATTENDANCE' DIRECTORY EXISTS
        $baseDir = '../../assets/images/';
        $uploadDir = $baseDir . 'attendance/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // GENERATE CUSTOM FILE NAME USING USER EMPLOYEE ID, DATE, AND ACTION
        $fileName = isset($_POST['faceDTR_action']) ? preg_replace('/-/', '', $_SESSION['employeeID']) . '_' . date("Y.m.d") . '_' . $_POST['faceDTR_action'] . '.png' : 'image_' . uniqid() . '.png';

        if ($logTypeID == 2) { // LATE
            mysqli_query($conn, $users->saveDTRLate($_SESSION['id'], $logTypeID, $currentDate, $currentTime, $lateMins));
        }
        else if ($logTypeID == 3) { // UNDERTIME
            mysqli_query($conn, $users->saveDTRUndertime($_SESSION['id'], $logTypeID, $currentDate, $currentTime, $undertimeMins));
        }
        else { // ONTIME
            mysqli_query($conn, $users->saveDTR($_SESSION['id'], $logTypeID, $currentDate, $currentTime));
        }
        

        // SAVE THE FILE
        $file = $uploadDir. '/' . $fileName;
        $success = file_put_contents($file, $data);

    } else {
        echo 'No image data found.';
    }
    exit();
?>