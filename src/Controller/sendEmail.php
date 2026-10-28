<?php
namespace Login\Controller;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class sendEmail {
    private $content = '';
    public function sendEmail($email, $text) {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'armanggyt@gmail.com';
            $mail->Password   = 'rube wotv jlmm sduy';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ]
            ];
            $mail->setFrom('armanggyt@gmail.com', 'Arman');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Test Email';
            $mail->Body    = $text;

            $mail->send();
            $this->content = 'Message has been sent';
        } catch (Exception $e) {
            $this->content = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
        }
    }

    public function getTitle() {
        return 'Send email';
    }

    public function getContent() {
        return $this->content;
    }

    public function getTemplate() {
        return 'index.html.twig';
    }
}