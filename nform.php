<?php
// Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'test';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$profession = $_POST['profession'];
$course = $_POST['course'];

// Insert data into database
$sql = "INSERT INTO interests (name, phone, email, profession, course) VALUES ('$name', '$phone', '$email', '$profession', '$course')";
if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully";
    header('location:index.html');
} else {
    echo "Error: ". $sql. "<br>". $conn->error;
}

// Close connection
$conn->close();

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['submit']))
{
	$name = $_POST['name'];
	$phone =$_POST['phone'];
	$email =$_POST['email'];
	$profession = $_POST['profession'];
    $course = $_POST['course'];


//Load Composer's autoloader
require 'phpmailer/DSNConfigurator.php';
require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/POP3.php';
require 'phpmailer/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'suryakantbawankule@gmail.com';                     //SMTP username
    $mail->Password   = 'lneg rfht jtfb cxup';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('suryakantbawankule@gmail.com', 'AEROSPACE');
    $mail->addAddress($email, 'AEROSPACE');     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Thanks For Contacting Us!';
    $mail->Body    = "<b>Dear $name</b><br> Your Email-ID is $email<br>Thanks For Showing Intrests In This $course course<br><br><br><b>Team AEROSPACE</b> ";
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
    header('location:index.html');
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}

?>