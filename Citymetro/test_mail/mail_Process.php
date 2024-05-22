<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
$email = $_SESSION['user_email'];
$name = $_SESSION['user_name'];

require 'lib/PHPMailer-master/src/PHPMailer.php';
require 'lib/PHPMailer-master/src/Exception.php';
require 'lib/PHPMailer-master/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();                        // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';  // Set the SMTP server to send through
    $mail->SMTPAuth   = true;               // Enable SMTP authentication
    $mail->Username   = 'citymetromovers2k23@gmail.com'; // SMTP username
    $mail->Password   = 'hlcu vyoo bpjh axgd'; // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable explicit TLS encryption
    $mail->Port       = 587;                // TCP port to connect to; use 587 for TLS

    // Recipients
    $mail->setFrom('citymetromovers2k23@gmail.com', 'CityMetroMovers');
    $mail->addAddress("$email", "$name"); // Add a recipient

    // Content
    //$mail->isHTML(true);                    // Set email format to HTML
    $mail->Subject = 'Your Package';
    $mail->Body    = 'You have only three trips remaining please update your package';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();?>
    <script>
    window.location.href = '../index.php';
    </script>
<?php
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

