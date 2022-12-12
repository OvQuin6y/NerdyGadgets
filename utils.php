<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once('lib/PHPMailer/src/Exception.php');
require_once('lib/PHPMailer/src/PHPMailer.php');
require_once('lib/PHPMailer/src/SMTP.php');


/**
 * Met deze functie kun je een e-mail versturen.
 * @param string $ontvanger Het e-mailadres van de ontvanger.
 * @param string $onderwerp Het onderwerp van de e-mail.
 * @param string $body De inhoud van de e-mail.
 * @return string Een melding dat de e-mail is verstuurd.
 */
function send_email(string $ontvanger, string $onderwerp, string $body): string{
    $error = 'false';
    $mail = new PHPMailer(true);
    try {
        $mail->IsSMTP();
//        $mail->SMTPDebug = 1;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Host = "smtp-mail.outlook.com";
        $mail->Username = 'groepje2kbs@hotmail.com';
        $mail->Password = 'urklove32';
        $mail->setFrom('groepje2kbs@hotmail.com', 'Beste Groepje');
        $mail->addAddress($ontvanger);
        $mail->isHTML(true);
        $mail->Subject = $onderwerp;
        $mail->Body = $body;
        $mail->send();
    } catch (Exception $e) {
        $error = $mail->ErrorInfo;
    }
    return $error;
}

function check_ini_file() {
    $inipath = php_ini_loaded_file();
    if ($inipath) {
        echo 'Loaded php.ini: ' . $inipath;
    } else {
        echo 'A php.ini file is not loaded';
    }
}