<?php 
    include '../../init.php';
    $conn = $database->dbConnect();

    require '../../PHPMailer/src/Exception.php';
    require '../../PHPMailer/src/PHPMailer.php';
    require '../../PHPMailer/src/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    // TRIM EMAIL ADDRESS
    $email = trim($_POST['forgot_email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode([
            'status' => '1',
            'title' => 'Invalid Email',
            'message' => 'Please provide a valid email address.'
        ]);
        exit();
    }

    // CHECK IF EMAIL EXISTS
    $result = mysqli_query($conn, $employees->searchEmail($email));
    if ($result && mysqli_num_rows($result) > 0) {
        
        // SET USERID VARIABLE
        $row = $result->fetch_assoc();
        $userID = $row['userID'];

        // CHECK IF OTP WAS SENT LESS THAN 60 SECONDS AGO
        $now  = time();
        $lastSent = strtotime($row['reset_otp_last_sent']);

        if ($lastSent && ($now - $lastSent) < 60) {
            echo json_encode([
                'status' => '1',
                'title' => 'OTP Request Limit',
                'message' => 'Please wait before requesting another OTP'
            ]);
            exit();
        } 
        else {
            $otp = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $otpHash = password_hash($otp, PASSWORD_DEFAULT);
            $expiresAt = date('Y-m-d H:i:s', strtotime('+10 minutes'));

            // SAVE OTP TO DATABASE
            mysqli_query($conn, $employees->sendOTP($userID, $otpHash, $expiresAt));

            $mail = new PHPMailer(true);

            try {

                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;

                $mail->Username = MAIL_USERNAME;
                $mail->Password = MAIL_PASSWORD;

                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom(MAIL_USERNAME, 'CBSI Automated Email System');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = 'Password Reset OTP';
                $mail->Body = "
                    <p>Hello,</p>
                    <p>Your One-Time-Password (OTP) is:</p>
                    <b>$otp</b>
                    <br>
                    <p>This code is valid for <b>10 minutes</b>. Please enter this code to continue with your request.</p>
                    <p>If you did not request this code, please ignore this email.</p>
                    <p>For your security, <b>do not share this code with anyone</b>.</p>
                    <p><b><i style='color: #E4E100;'>This is an automated message, please do not reply to this email.</i></b></p>
                ";

                $mail->send();

                echo json_encode([
                    'status' => 0,
                    'message' => 'OTP sent successfully'
                ]);

            } catch (Exception $e) {
                echo json_encode([
                    'status' => '1',
                    'title' => 'Email Send Failed',
                    'message' => $mail->ErrorInfo
                ]);
            }
        }
    } 
    // EMAIL NOT FOUND
    else {
        echo json_encode([
            'status' => '1',
            'title' => 'User not found',
            'message' => 'Email does not exist in the system.'
        ]);
    }
    exit();
?>