<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = $_POST['to'];
    $cc = $_POST['cc'];
    $bcc = $_POST['bcc'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $mail_username; 
        $mail->Password = $mail_password; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('kmahesh060304@gmail.com', 'GUVI GEEK');

        if (!empty($to)) {
            foreach ($to as $recipient) {
                if (!empty($recipient)) {
                    $mail->addAddress($recipient);
                }
            }
        }

        if (!empty($cc)) {
            foreach ($cc as $recipient) {
                if (!empty($recipient)) {
                    $mail->addCC($recipient);
                }
            }
        }

        if (!empty($bcc)) {
            foreach ($bcc as $recipient) {
                if (!empty($recipient)) {
                    $mail->addBCC($recipient);
                }
            }
        }

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
