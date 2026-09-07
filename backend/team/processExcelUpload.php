<?php 
    header("Content-Type: application/json");
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $password = $_POST['password'];
    $retypePassword = $_POST['retypePassword'];

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

    if (md5($retypePassword) == $SESSION['']) {
        
    }

?>