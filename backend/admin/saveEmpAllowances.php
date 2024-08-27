<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    if (isset($_POST['allowances'])) {
        $allowancesString = $_POST['allowances']; // Get the allowances as a string
        error_log("Received allowances: " . $allowancesString); // Log to verify the value
        
        $allowances = json_decode($allowancesString, true);

        if (!empty($allowances) && is_array($allowances)) {
            foreach ($allowances as $allowance) {
                $id = $allowance['id'];
                $allowanceID = $allowance['allowanceID'];
                $allowanceAmount = $allowance['amount'];
                $allowanceType = $allowance['type'];

                $checkEmpAllowanceQuery = $payroll->checkEmpAllowance($id, $allowanceID);
                $checkEmpAllowanceResult = mysqli_query($conn, $checkEmpAllowanceQuery);
                $checkEmpAllowance = mysqli_num_rows($checkEmpAllowanceResult);

                if ($checkEmpAllowance > 0) {
                    $em = "Allowance already exists!";
                    $error = array('error' => 1, 'em' => $em);
                }
                else {
                    if ($allowanceType == "3") {
                        $allowanceEffectiveDate = $allowance['date'];
                        mysqli_query($conn, $payroll->addEmpAllowance_once($id, $allowanceID, $allowanceType, $allowanceAmount, $allowanceEffectiveDate));
    
                        $em = "Allowance Added Successfully";
                        $error = array('error' => 0, 'id' => $id, 'em' => $em);
                    } else {
                        mysqli_query($conn, $payroll->addEmpAllowance($id, $allowanceID, $allowanceType, $allowanceAmount));
    
                        $em = "Allowance Added Successfully";
                        $error = array('error' => 0, 'id' => $id, 'em' => $em);
                    }
                }
            }
        } else {
            $em = "Error in saving allowances!";
            $error = array('error' => 1, 'em' => $em);
        }
    } else {
        $em = "No allowances data received!";
        $error = array('error' => 1, 'em' => $em);
    }

    echo json_encode($error);
    exit();
?>