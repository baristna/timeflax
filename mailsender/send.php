<?php
require("class.phpmailer.php"); // PHPMailer dosyamizi �agiriyoruz
$mail = new PHPMailer(); // Sinifimizi $mail degiskenine atadik
IsSMTP(); // Mailimizin SMTP ile g�nderilecegini belirtiyoruz
$mail->From     = $_POST["kendi_mail"];//"admin@localhost"; //G�nderen kisminda yer alacak e-mail adresi
$mail->Sender   = $_POST["kendi_mail"];//"admin@localhost";//G�nderen Mail adresi
$mail->ReplyTo  = $_POST["kendi_mail"];//"admin@localhost";//Tekrar g�nderimdeki mail adersi
$mail->FromName = $_POST["isim"];//"PHP Mailer";//g�nderenin ismi
$mail->Host     = $_POST["smtp"];//"localhost"; //SMTP server adresi
$mail->SMTPAuth = true; //SMTP server'a kullanici adi ile baglanilcagini belirtiyoruz
$mail->Username = $_POST["kendi_mail"];//"admin@localhost"; //SMTP kullanici adi
$mail->Password    = $_POST["kendi_sifre"];//""; //SMTP sifre
$mail->WordWrap = 50;
$mail->IsHTML(true); //Mailimizin HTML formatinda hazirlanacagini bildiriyoruz.
$mail->Subject  = $_POST["konu"];//"Deneme Maili"; // Konu
//Mailimizin g�vdesi: (HTML ile)
$body = $_POST["metin"];//"Bu mail bir deneme mailidir. SMTP server ile g�nderilmistir.";
// HTML okuyamayan mail okuyucularda g�r�necek d�z metin:
$textBody = $_POST["metin"];//"Bu mail bir deneme mailidir. SMTP server ile g�nderilmistir.";
$mail->Body = $body;
$mail->AltBody = $text_body;
$mail->AddAddress($_POST["alici"]); // Mail g�nderilecek adresleri ekliyoruz.
if ($mail->Send()) echo "Mail g�nderildi";
else echo "Mail g�nderimi basarisiz";
$mail->ClearAddresses();
$mail->ClearAttachments();
?>