<?php 
    include '../../init.php';
    $conn = $database->dbConnect();

    $email = trim($_POST['forgot_email']);
    $otp = trim($_POST['forgot_otp']);

    // VALIDATE EMAIL
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode([
            'status' => '1',
            'title' => 'Invalid Email',
            'message' => 'Please provide a valid email address.'
        ]);
        exit();
    }

    // VALIDATE OTP 
    if (!preg_match('/^\d{6}$/', $otp)) {
        echo json_encode([
            'status' => '1',
            'title' => 'Invalid OTP',
            'message' => 'Please provide a valid 6-digit OTP.'
        ]);
        exit();
    }

    // CHECK EMAIL QUERY
    $result = mysqli_query($conn, $employees->searchEmail($email));
    // USER NOT FOUND
    if (mysqli_num_rows($result) == 0) {
        echo json_encode([
            'status' => '1',
            'title' => 'User not found',
            'message' => 'Email does not exist in the system.'
        ]);
        exit();
    }

    $row = mysqli_fetch_assoc($result);
    $userID = $row['userID'];
    $otpHash = $row['reset_otp_hash'];
    $expires = $row['reset_otp_expires'];
    $attempts = $row['reset_otp_attempts'];
    $used = (int)$row['reset_otp_used'];

    // CHECK IF ALREADY USED
    if ($used === 1) {
        echo json_encode([
            'status' => '1',
            'title' => 'OTP Already Used',
            'message' => 'This OTP has already been used.'
        ]);
        exit();
    }

    // CHECK EXPIRY
    if (!$expires || strtotime($expires) < time()) {
        echo json_encode([
            'status' => '1',
            'title' => 'OTP Expired',
            'message' => 'This OTP has expired. Please request a new one.'
        ]);
        exit();
    }

    // ATTEMPT LIMIT
    if ($attempts >= 3) {
        echo json_encode([
            'status' => '1',
            'title' => 'Too Many Attempts',
            'message' => 'Too many attempts. Request a new OTP.'
        ]);
        exit();
    }

    // VERIFY OTP
    if (!password_verify($otp, $otpHash)) {
        // INCREMENT ATTEMPT
        $attempts++;
        mysqli_query($conn, $employees->updateResetOTPAttempts($userID, $attempts));
        echo json_encode([
            'status' => '1',
            'title' => 'Invalid OTP',
            'message' => 'Invalid OTP. Please try again.'
        ]);
        exit();
    }

    // CORRECT OTP -> MARK AS VERIFIED (NOT USED YET)
    mysqli_query($conn, $employees->updateResetOTPAttempts($userID, 1));
    
    echo json_encode([
        'status' => '0',
        'title' => 'OTP Verified',
        'message' => 'OTP verified successfully. You can now reset your password.',
        'userID' => $userID
    ]);
?>
