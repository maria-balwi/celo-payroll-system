<?php 
    header("Content-Type: application/json");
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $password = $_POST['password'];
    $retypePassword = $_POST['retypePassword'];
    $userHashedPassword = $_POST['userHashedPassword'];

    // CHECK FILE
    if(!isset($_FILES['csvFile'])) {
        echo json_encode([
            'error' => 1,
            'em' => 'No file uploaded'
        ]);
        exit;
    }

    $file = $_FILES['csvFile']['tmp_name'];
    $fileName = $_FILES['csvFile']['name'];

    // OPEN THE CSV FILE
    if (!file_exists($file) || !is_readable($file)) {
        echo json_encode([
            'error' => 1,
            'em' => 'File not found or not readable'
        ]);
        exit;
    }

    // SHFIT SCHEDULE MAPPING 
    $shiftMap = [];

    $shiftQuery = mysqli_query($conn, "SELECT * FROM tbl_shiftschedule");
    while ($row = mysqli_fetch_array($shiftQuery)) {
        $shiftMap[$row['shiftID']] = [
            'startTime' => $row['startTime'],
            'endTime' => $row['endTime']
        ];
    }

    // MAP CSV HEADERS AS FIELDS
    $columnMap = [
        'Name'           => 'name', 
        'Email'          => 'emailAddress',
        'Employee ID'    => 'employeeID',
        'Shift - In'     => 'startTime', 
        'Shift - Out'    => 'endTime', 
    ];

    $inserted = 0;
    $errors = [];
    $totalRows = 0;

    if (md5($password) == $userHashedPassword) {
        if (($handle = fopen($file, 'r')) !== false) {
            $header = fgetcsv($handle);
            $mappedHeader = array_map(function($column) use ($columnMap) {
                return $columnMap[$column] ?? null;
            }, $header);

            while (($row = fgetcsv($handle)) !== false) {
                $totalRows++;
                $data = array_combine($mappedHeader, $row);
                if ($data) {
                    // MAP SHIFT ID BASED ON START AND END TIME
                    $shiftID = null;
                    foreach ($shiftMap as $id => $shift) {
                        if ($shift['startTime'] == $data['startTime'] && $shift['endTime'] == $data['endTime']) {
                            $shiftID = $id;
                            break;
                        }
                    }
                    // INSERT STATEMENT
                    $stmt = $conn->prepare("UPDATE tbl_employee SET shiftID = ? WHERE employeeID = ?");
                    if ($stmt->execute([$shiftID, $data['employeeID']])) {
                        $inserted++;
                    } else {
                        $errors[] = "Error updating row: " . implode(", ", $row);
                    }

                } else {
                    $errors[] = "Error mapping row: " . implode(", ", $row);
                }
            }
            fclose($handle);

            // DETERMINE BATCH UPLOAD STATUS
            $errorCount = count($errors);
            if ($errorCount == 0) {
                $batchUploadStatus = 'Completed';
            }
            else if ($inserted > 0) {
                $batchUploadStatus = 'Completed with errors';
            }
            else {
                $batchUploadStatus = 'Failed';
            }

            // LOG BATCH UPLOAD
            mysqli_query($conn, $payroll->logSchedUpload($fileName, $_SESSION['id'], $inserted, $errorCount, $totalRows, $batchUploadStatus));
        } else {
            echo json_encode([
                'error' => 1,
                'em' => 'Unable to open the file'
            ]);
            exit;
        }

        echo json_encode([
            'error' => 0,
            'em' => "Inserted $inserted out of $totalRows rows.",
            'totalRows' => $totalRows,
            'errors' => $errors
        ]);
    } else {
        echo json_encode([
            'error' => 1,
            'em' => 'Password incorrect. Please try again.'
        ]);
        
    }

?>