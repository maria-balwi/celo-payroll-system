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
    } 
    else if (isset($_POST['reimbursements'])) {
        $reimbursementsString = $_POST['reimbursements']; // Get the reimbursements as a string
        error_log("Received reimbursements: " . $reimbursementsString); // Log to verify the value
        
        $reimbursements = json_decode($reimbursementsString, true);

        if (!empty($reimbursements) && is_array($reimbursements)) {
            foreach ($reimbursements as $reimbursement) {
                $id = $reimbursement['id'];
                $reimbursementID = $reimbursement['reimbursementID'];
                $reimbursementAmount = $reimbursement['amount'];
                $reimbursementType = $reimbursement['type'];

                $checkEmpReimbursementQuery = $payroll->checkEmpReimbursement($id, $reimbursementID);
                $checkEmpReimbursementResult = mysqli_query($conn, $checkEmpReimbursementQuery);
                $checkEmpReimbursement = mysqli_num_rows($checkEmpReimbursementResult);

                if ($checkEmpReimbursement > 0) {
                    $em = "Reimbursement already exists!";
                    $error = array('error' => 1, 'em' => $em);
                }
                else {
                    if ($reimbursementType == "3") {
                        $reimbursementEffectiveDate = $reimbursement['date'];
                        mysqli_query($conn, $payroll->addEmpReimbursement_once($id, $reimbursementID, $reimbursementType, $reimbursementAmount, $reimbursementEffectiveDate));
    
                        $em = "Reimbursement Added Successfully";
                        $error = array('error' => 0, 'id' => $id, 'em' => $em);
                    } else {
                        mysqli_query($conn, $payroll->addEmpReimbursement($id, $reimbursementID, $reimbursementType, $reimbursementAmount));
    
                        $em = "Reimbursement Added Successfully";
                        $error = array('error' => 0, 'id' => $id, 'em' => $em);
                    }
                }
            }
        } else {
            $em = "Error in saving reimbursements!";
            $error = array('error' => 1, 'em' => $em);
        }
    } 
    else if (isset($_POST['deductions'])) {
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
                $checkEmpDeductionResult = mysqli_query($conn, $checkEmpDeductionQuery);
                $checkEmpDeduction = mysqli_num_rows($checkEmpDeductionResult);

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
    }
    else if (isset($_POST['adjustments'])) {
        $adjustmentsString = $_POST['adjustments']; // Get the deductions as a string
        error_log("Received adjustments: " . $adjustmentsString); // Log to verify the value
        
        $adjustments = json_decode($adjustmentsString, true);

        if (!empty($adjustments) && is_array($adjustments)) {
            foreach ($adjustments as $adjustment) {
                $id = $adjustment['id'];
                $adjustmentID = $adjustment['adjustmentID'];
                $adjustmentAmount = $adjustment['amount'];
                $adjustmentType = $adjustment['type'];

                $checkEmpAdjustmentQuery = $payroll->checkEmpAdjustment($id, $adjustmentID);
                $checkEmpAdjustmentResult = mysqli_query($conn, $checkEmpAdjustmentQuery);
                $checkEmpAdjustment = mysqli_num_rows($checkEmpAdjustmentResult);

                if ($checkEmpAdjustment > 0) {
                    $em = "Adjustment already exists!";
                    $error = array('error' => 1, 'em' => $em);
                }
                else {
                    if ($adjustmentType == "3") {
                        $adjustmentEffectiveDate = $adjustment['date'];
                        mysqli_query($conn, $payroll->addEmpAdjustment_once($id, $adjustmentID, $adjustmentType, $adjustmentAmount, $adjustmentEffectiveDate));
    
                        $em = "Adjustment Added Successfully";
                        $error = array('error' => 0, 'id' => $id, 'em' => $em);
                    } else {
                        mysqli_query($conn, $payroll->addEmpAdjustment($id, $adjustmentID, $adjustmentType, $adjustmentAmount));
    
                        $em = "Adjustment Added Successfully";
                        $error = array('error' => 0, 'id' => $id, 'em' => $em);
                    }
                }
            }
        } else {
            $em = "Error in saving adjustments!";
            $error = array('error' => 1, 'em' => $em);
        }
    }
    else {
        $em = "No data received!";
        $error = array('error' => 1, 'em' => $em);
    }

    echo json_encode($error);
    exit();
?>