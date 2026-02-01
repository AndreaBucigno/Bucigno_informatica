<?php
// inc/mailer.inc.php


require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Configurazione di esempio — modifica con i tuoi dati reali o caricali da env/config
$MAIL_CONFIG = [
    'host' => 'smtp.example.com',
    'username' => 'user@example.com',
    'password' => 'secret',
    'port' => 587,
    'smtp_secure' => PHPMailer::ENCRYPTION_STARTTLS,
    'from_email' => 'from@example.com',
    'from_name' => 'Your App',
    'is_smtp' => true,
    'auth' => true,
    'charset' => 'UTF-8',
];


function send_mail($to, $subject, $htmlBody, $altBody = '', $from = null, $fromName = null, $attachments = [])
{
    global $MAIL_CONFIG;

    $mail = new PHPMailer(true);
    try {
        if (!empty($MAIL_CONFIG['is_smtp'])) {
            $mail->isSMTP();
            $mail->Host = $MAIL_CONFIG['host'];
            $mail->SMTPAuth = $MAIL_CONFIG['auth'];
            $mail->Username = $MAIL_CONFIG['username'];
            $mail->Password = $MAIL_CONFIG['password'];
            $mail->SMTPSecure = $MAIL_CONFIG['smtp_secure'];
            $mail->Port = $MAIL_CONFIG['port'];
        }

        $mail->CharSet = $MAIL_CONFIG['charset'] ?? 'UTF-8';
        $mail->setFrom($from ?? $MAIL_CONFIG['from_email'], $fromName ?? $MAIL_CONFIG['from_name']);

        if (is_array($to)) {
            foreach ($to as $addr) $mail->addAddress($addr);
        } else {
            $mail->addAddress($to);
        }

        foreach ($attachments as $att) {
            if (is_array($att) && isset($att['path'])) {
                $mail->addAttachment($att['path'], $att['name'] ?? '');
            } else {
                $mail->addAttachment($att);
            }
        }

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $htmlBody;
        $mail->AltBody = $altBody ?: strip_tags($htmlBody);

        $mail->send();
        return true;
    } catch (Exception $e) {

        return $e->getMessage();
    }
}
