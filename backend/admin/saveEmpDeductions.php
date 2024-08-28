<?php
    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    if (isset($_POST['deductions'])) {
        $deductionsString = $_POST['deductions']; // Get the deductions as a string
        error_log("Received deductions: " . $deductionsString); // Log to verify the value
        
        $deductions = json_decode($deductionsString, true);

        if (!empty($deductions) && is_array($deductions)) {
            foreach ($deductions as $deduction) {
                $id = $deduction['id'];
                $deductionID = $deduction['deductionID'];
                $deductionAmount = $deduction['amount'];
                $deductionType = $deduction['type'];

                $checkEmpDeductionQuery = $payroll->checkEmpDeduction($id, $deductionID);
                $checkEmpADeductionResult = mysqli_query($conn, $checkEmpDeductionQuery);
                $checkEmpDeduction = mysqli_num_rows($checkEmpADeductionResult);

                if ($checkEmpDeduction > 0) {
                    $em = "Deduction already exists!";
                    $error = array('error' => 1, 'em' => $em);
                }
                else {
                    if ($deductionType == "3") {
                        $deductionEffectiveDate = $deduction['date'];
                        mysqli_query($conn, $payroll->addEmpDeduction_once($id, $deductionID, $deductionType, $deductionAmount, $deductionEffectiveDate));
    
                        $em = "Deduction Added Successfully";
                        $error = array('error' => 0, 'id' => $id, 'em' => $em);
                    } else {
                        mysqli_query($conn, $payroll->addEmpDeduction($id, $deductionID, $deductionType, $deductionAmount));
    
                        $em = "Deduction Added Successfully";
                        $error = array('error' => 0, 'id' => $id, 'em' => $em);
                    }
                }
            }
        } else {
            $em = "Error in saving deductions!";
            $error = array('error' => 1, 'em' => $em);
        }
    } else {
        $em = "No deductions data received!";
        $error = array('error' => 1, 'em' => $em);
    }

    echo json_encode($error);
    exit();
?>