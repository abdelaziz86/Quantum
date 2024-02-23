<?php
namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Repository\ContactRepository;
use PHPMailer\PHPMailer\PHPMailer;

class EmailService
{
    

    public function sendEmail($recipient, $subject, $body) {
        $mail = new PHPMailer(true); // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->isSMTP(); // Use SMTP
            $mail->Host = 'smtp.hostinger.com'; // Set the SMTP server to send through
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = 'business@thequantum.marketing'; // SMTP username
            $mail->Password = 'Aliswell123&'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port = 465; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('business@thequantum.marketing', 'Quantum Marketing');
            $mail->addAddress($recipient); // Add a recipient

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

     
}
