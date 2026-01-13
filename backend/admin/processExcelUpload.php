<?php
    header("Content-Type: application/json");
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $userPassword = $_POST['userPassword'];
    $userRetypePassword = $_POST['userRetypePassword'];

    // CHECK FILE 
    if(!isset($_FILES['csvFile'])){
        echo json_encode([
            'error' => 1, 
            'em' => 'No file uploaded'
        ]);
        exit;
    }

    $file = $_FILES['csvFile']['tmp_name'];

    // OPEN CSV FILE 
    if(!file_exists($file) || !is_readable($file)){
        echo json_encode([
            'error' => 1, 
            'em' => 'CSV file not readable'
        ]);
        exit;
    }

    // DEPARTMENT MAPPING
    $departmentMap = [];

    $deptQuery = mysqli_query($conn, $employees->viewDepartment()) ;
    while ($row = mysqli_fetch_array($deptQuery)) {
        $departmentMap[strtolower(trim($row['departmentName']))] = $row['departmentID'];
    }

    // DESIGNATION MAPPING
    $designationMap = [];

    $designationQuery = mysqli_query($conn, $employees->viewDesignation());
    while ($row = mysqli_fetch_array($designationQuery)) {
        $designationMap[strtolower(trim($row['position']))] = $row['designationID'];
    }

    // MAP CSV HEADERS AS FIELDS
    $columnMap = [
        'First Name'               => 'firstName',
        'Last Name'                => 'lastName',
        'Address'                  => 'address',
        'Date of Birth'            => 'dateOfBirth',
        'Place of Birth'           => 'placeOfBirth',
        'Gender'                   => 'gender',
        'Civil Status'             => 'civilStatus',
        'Mobile Number'            => 'mobileNumber',
        'Email Address'            => 'emailAddress',
        'Employee ID'              => 'employeeID',
        'Department'               => 'departmentID',
        'Designation'              => 'designationID',
        'SSS'                      => 'sss',
        'PAGIBIG'                  => 'pagIbig',
        'PhilHealth'               => 'philhealth',
        'TIN'                      => 'tin',
        'Employment Status'        => 'employmentStatus',
        'Date Hired'               => 'dateHired',
        'Basic Pay'                => 'basicPay',
        'Vacation Leave'           => 'availableVL',
        'Sick Leave'               => 'availableSL', 
        'NBI (Y/N)'                => 'req_nbi', 
        'Medical Exam (Y/N)'       => 'req_medicalExam', 
        '2x2 Pic (Y/N)'            => 'req_2x2pic', 
        'Vaccine Card (Y/N)'       => 'req_vaccineCard', 
        'PSA (Y/N)'                => 'req_psa', 
        'Valid ID (Y/N)'           => 'req_validID', 
        'Hello Money (Y/N)'        => 'req_helloMoney'
    ];


    $inserted = 0;
    $errors = [];

    if (isset($userPassword) && isset($userRetypePassword)) {
        if ($userPassword == $userRetypePassword) {
            if (preg_match('/^(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $userPassword)) {
                $userPassword = md5($userPassword);
                
                if (($handle = fopen($file, "r")) !== false) {
                    $rowIndex = 0;
                    $headers = [];

                    mysqli_begin_transaction($conn);

                    try {
                        while (($row = fgetcsv($handle, 1000, ",")) !== false) {
                            $rowIndex++;

                            // HEADER ROW
                            if($rowIndex == 1){
                                $headers = $row;
                                continue;
                            }

                            // MAP CSV DATA
                            $rowData = [];
                            foreach($headers as $colIndex => $header){
                                $header = trim($header);
                                if(isset($columnMap[$header])){
                                    $rowData[$columnMap[$header]] = trim($row[$colIndex]);
                                }
                            }

                            // VALIDATE REQUIRED FIELDS
                            if(empty($rowData['firstName']) || empty($rowData['lastName'])){
                                $errors[] = "Row $rowIndex: missing first or last name";
                                continue;
                            }

                            // DEPARTMENT NAME TO ID
                            $deptKey = strtolower(trim($rowData['departmentID']));
                            if (!isset($departmentMap[$deptKey])) {
                                $errors[] = "Row $rowIndex: department '{$rowData['departmentID']}' not found";
                                continue;
                            }
                            $departmentID = $departmentMap[$deptKey];

                            // DESIGNATION TO ID
                            $designationKey = strtolower(trim($rowData['designationID']));
                            if (!isset($designationMap[$designationKey])) {
                                $errors[] = "Row $rowIndex: designation '{$rowData['designationID']}' not found";
                                continue;
                            }
                            $designationID = $designationMap[$designationKey];

                            // VALIDATE DATE OF BIRTH
                            $dateOfBirth = $rowData['dateOfBirth'] ?? null;
                            if($dateOfBirth && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateOfBirth)){
                                $errors[] = "Row $rowIndex: invalid date format";
                                continue;
                            }

                            // VALIDATE DATE HIRED
                            $dateHired = $rowData['dateHired'] ?? null;
                            if($dateHired && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateHired)){
                                $errors[] = "Row $rowIndex: invalid date format";
                                continue;
                            }

                            // VALIDATE SSS, PAGIBIG, PHILHEALTH, AND TIN
                            $sss = isset($rowData['sss']) && $rowData['sss'] == "" ? null : $rowData['sss'];
                            $req_sss = isset($sss) ? 1 : 0;

                            $pagIbig = isset($rowData['pagIbig']) && $rowData['pagIbig'] == "" ? null : $rowData['pagIbig'];
                            $req_pagIbig = isset($pagIbig) ? 1 : 0;

                            $philhealth = isset($rowData['philhealth']) && $rowData['philhealth'] == "" ? null : $rowData['philhealth'];
                            $req_philhealth = isset($philhealth) ? 1 : 0;

                            $tin = isset($rowData['tin']) && $rowData['tin'] == "" ? null : $rowData['tin'];
                            $req_tin = isset($tin) ? 1 : 0;

                            $req_nbi = $rowData['req_nbi'] == 'Y' ? 1 : 0;
                            $req_medicalExam = $rowData['req_medicalExam'] == 'Y' ? 1 : 0;
                            $req_2x2pic = $rowData['req_2x2pic'] == 'Y' ? 1 : 0;
                            $req_vaccineCard = $rowData['req_vaccineCard'] == 'Y' ? 1 : 0;
                            $req_psa = $rowData['req_psa'] == 'Y' ? 1 : 0;
                            $req_validID = $rowData['req_validID'] == 'Y' ? 1 : 0;
                            $req_helloMoney = $rowData['req_helloMoney'] == 'Y' ? 1 : 0;
                            
                            // GET REGULARIZATION DATE
                            $date = new DateTime($dateHired);
                            $date->modify('+6 months');
                            $dateRegularized = $date->format('Y-m-d');

                            // COMPUTATION OF DAILY AND HOURLY RATE
                            $basicPay = $rowData['basicPay'] ?? null;
                            $dailyRate = round(($basicPay * 12) / 261, 2);
                            $hourlyRate = round($dailyRate / 8, 2);

                            // DEFAULT WEEK OFF
                            $wo_mon = 0;
                            $wo_tue = 0;
                            $wo_wed = 0;
                            $wo_thu = 0;
                            $wo_fri = 0;
                            $wo_sat = 1;
                            $wo_sun = 1;
                            
                            // DEFAULT SHIFT
                            $shiftID = 10;
                            $e_status = "Active";

                            // ADD DATA TO EMPLOYEES TABLE
                            $stmt = mysqli_prepare($conn, "INSERT INTO tbl_employee (firstName,lastName, address, dateOfBirth, placeOfBirth, gender, civilStatus, mobileNumber, emailAddress, employeeID, departmentID, designationID, sss, pagIbig, philhealth, tin, shiftID, employmentStatus, dateHired, dateRegularized, basicPay, dailyRate, hourlyRate, availableVL, availableSL, e_status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                            mysqli_stmt_bind_param($stmt, "ssssssssssiissssisssdddiis",
                                $rowData['firstName'], 
                                $rowData['lastName'], 
                                $rowData['address'],
                                $dateOfBirth, 
                                $rowData['placeOfBirth'],
                                $rowData['gender'],
                                $rowData['civilStatus'],
                                $rowData['mobileNumber'],
                                $rowData['emailAddress'],
                                $rowData['employeeID'],
                                $departmentID,
                                $designationID,
                                $rowData['sss'],
                                $rowData['pagIbig'],
                                $rowData['philhealth'],
                                $rowData['tin'],
                                $shiftID,
                                $rowData['employmentStatus'],
                                $rowData['dateHired'],
                                $dateRegularized,
                                $rowData['basicPay'],
                                $dailyRate,
                                $hourlyRate,
                                $rowData['availableVL'],
                                $rowData['availableSL'], 
                                $e_status
                            );
                            if (!mysqli_stmt_execute($stmt)) {
                                $errors[] = "Row $rowIndex: database insert failed";
                                continue;
                            }

                            $lastIDQuery = mysqli_query($conn, $employees->viewLastEmployee());
                            $lastIDResult = mysqli_fetch_array($lastIDQuery);
                            $lastID = $lastIDResult['id'];

                            // ADD DATA TO REQUIREMENTS TABLE
                            $stmt = mysqli_prepare($conn, "INSERT INTO tbl_requirements (empID, req_sss, req_pagIbig, req_philhealth, req_tin, req_nbi, req_medicalExam, req_2x2pic, req_vaccineCard, req_psa, req_validID, req_helloMoney) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
                            mysqli_stmt_bind_param($stmt, "iiiiiiiiiiii",
                                $lastID, 
                                $req_sss, 
                                $req_pagIbig, 
                                $req_philhealth, 
                                $req_tin, 
                                $req_nbi, 
                                $req_medicalExam, 
                                $req_2x2pic, 
                                $req_vaccineCard, 
                                $req_psa, 
                                $req_validID, 
                                $req_helloMoney
                            );
                            if (!mysqli_stmt_execute($stmt)) {
                                $errors[] = "Row $rowIndex: database insert failed";
                                continue;
                            }

                            // ADD DATA TO WEEK OFF TABLE
                            $stmt = mysqli_prepare($conn, "INSERT INTO tbl_empweekoff (empID, wo_mon, wo_tue, wo_wed, wo_thu, wo_fri, wo_sat, wo_sun) VALUES (?,?,?,?,?,?,?,?)");
                            mysqli_stmt_bind_param($stmt, "iiiiiiii",
                                $lastID,    
                                $wo_mon, 
                                $wo_tue, 
                                $wo_wed, 
                                $wo_thu, 
                                $wo_fri, 
                                $wo_sat,
                                $wo_sun
                            );
                            if (!mysqli_stmt_execute($stmt)) {
                                $errors[] = "Row $rowIndex: database insert failed";
                                continue;
                            }

                            // ADD DATA TO USER TABLE
                            if (($departmentID == 4 && $designationID == 11) || ($departmentID == 1 && $designationID == 4))
                            {
                                $levelID = 2; // TEAM LEAD & IT SUPERVISOR & MANAGER LEVEL
                            }
                            else if (($departmentID == 3 || $departmentID == 5) && ($designationID == 8 || $designationID == 9 || $designationID == 12 || $designationID == 18))
                            {
                                $levelID = 3; // ADMIN LEVEL
                            }
                            else if ($departmentID == 3 && $designationID == 7)
                            {
                                $levelID = 4; // HR & ADMIN STAFF LEVEL
                            }
                            else if ($departmentID == 3 && $designationID == 15) {
                                $levelID = 5; // HR GENERALIST LEVEL
                            }
                            else if ($departmentID == 4 && ($designationID == 10 || $designationID == 13 || $designationID == 19)) {
                                $levelID = 6; // IT LEVEL
                            }
                            else  
                            {
                                $levelID = 1; // USER LEVEL
                            }

                            // DEFAULT VALUES
                            $activated = 0;
                            $status = "Active";

                            mysqli_query($conn, $users->addUser($lastID, $levelID, $userPassword, $activated, $status));

                            $inserted++;
                        }

                        fclose($handle);
                        if (!empty($errors)) {
                            mysqli_rollback($conn);
                            
                            echo json_encode([
                                'error' => 1,
                                'em' => implode("\n", $errors)
                            ]);
                            exit;
                        }

                        // SUCCESS
                        mysqli_commit($conn);

                        echo json_encode([
                            'error' => 0,
                            'em' => "Inserted $inserted rows successfuly"
                        ]);
                        exit;

                    } catch(Exception $e){
                        echo json_encode([
                            'error' => 1,
                            'em' => 'Upload failed: ' . $e->getMessage()
                        ]);
                        exit;
                    }
                }
            }
            else {
                echo json_encode([
                    'error' => 1,
                    'em' => 'Password must be at least 8 characters long and contain at least one special character, one number, one uppercase and one lowercase letter!'
                ]);
                exit;
            }
        }
    }
?>