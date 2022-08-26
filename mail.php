<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->CharSet = 'UTF-8';
    $mail->SMTPDebug = 0; // debug on - off
    $mail->isSMTP();
    $mail->Host = 'smtp'; // SMTP sunucusu örnek : mail.alanadi.com
    $mail->SMTPAuth = true; // SMTP Doğrulama
    $mail->Username = 'isim@alanadiniz.com'; // Mail kullanıcı adı
    $mail->Password = 'sifre'; // Mail şifresi
    $mail->SMTPSecure = 'ssl'; // Şifreleme
    $mail->Port = 465; // SMTP Port
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    //Alıcılar
    $mail->setfrom('noreply@deneme.com.tr', 'İlker Tuncer');
    $mail->addAddress($_POST['mail']);
    $mail->addReplyTo($_POST['mail'], $_POST['name']);
    //İçerik
    $mail->isHTML(true);
    $mail->Subject = 'baslik.';
    $mail->Body = $_POST['message'];

    $mail->send();
    echo "Mesajınız İletildi --> ".$_POST['mail']."<br>";
} catch (Exception $e) {
    echo 'Mesajınız İletilemedi. Hata: ', $mail->ErrorInfo;
}

?>