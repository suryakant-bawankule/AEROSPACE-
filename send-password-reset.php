<?php
// Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'test';

// Connect to database
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer
require_once 'PHPMailer/PHPMailer.php';
require_once 'PHPMailer/SMTP.php';
require_once 'PHPMailer/Exception.php';

// Create a new PHPMailer instance
$mail = new PHPMailer();

// Forgot password form submission
if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // Check if email exists in database
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();

        // Generate new password
        $new_password = generate_password(8);

        // Update password in database
        $query = "UPDATE users SET password = '". password_hash($new_password, PASSWORD_BCRYPT). "' WHERE email = '$email'";
        $conn->query($query);

        // Send email with new password
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Username = 'suryakantbawankule@gmail.com';
        $mail->Password = 'lneg rfht jtfb cxup';

        $mail->setFrom('suryakantbawankule@gmail.com', 'AEROSPACE');
        $mail->addAddress($email, 'AEROSPACE');
        $mail->Subject = 'New Password';
        $mail->Body ="Hello dear user, We have generated a new password for you:  $new_password  Please login with this new password and change it to a secure one.";

        if (!$mail->send()) {
            echo 'Mailer Error: '. $mail->ErrorInfo;
        } else {
            echo 'New password has been sent to your email.';
            header('location:login.html');
        }
    } else {
        echo 'Email not found in our database.';
    }
}

// Function to generate random password
function generate_password($length = 8) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $random_password = '';
    for ($i = 0; $i < $length; $i++) {
        $random_password.= $characters[rand(0, strlen($characters) - 1)];
    }
    return $random_password;
}
?>