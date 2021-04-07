<?php
require("class.phpmailer.php"); // PHPMailer dosyamizi çagiriyoruz
$mail = new PHPMailer(); // Sinifimizi $mail degiskenine atadik
IsSMTP(); // Mailimizin SMTP ile gönderilecegini belirtiyoruz
$mail->From     = $_POST["kendi_mail"];//"admin@localhost"; //Gönderen kisminda yer alacak e-mail adresi
$mail->Sender   = $_POST["kendi_mail"];//"admin@localhost";//Gönderen Mail adresi
$mail->ReplyTo  = $_POST["kendi_mail"];//"admin@localhost";//Tekrar gönderimdeki mail adersi
$mail->FromName = $_POST["isim"];//"PHP Mailer";//gönderenin ismi
$mail->Host     = $_POST["smtp"];//"localhost"; //SMTP server adresi
$mail->SMTPAuth = true; //SMTP server'a kullanici adi ile baglanilcagini belirtiyoruz
$mail->Username = $_POST["kendi_mail"];//"admin@localhost"; //SMTP kullanici adi
$mail->Password    = $_POST["kendi_sifre"];//""; //SMTP sifre
$mail->WordWrap = 50;
$mail->IsHTML(true); //Mailimizin HTML formatinda hazirlanacagini bildiriyoruz.
$mail->Subject  = $_POST["konu"];//"Deneme Maili"; // Konu
//Mailimizin gövdesi: (HTML ile)
$body = $_POST["metin"];//"Bu mail bir deneme mailidir. SMTP server ile gönderilmistir.";
// HTML okuyamayan mail okuyucularda görünecek düz metin:
$textBody = $_POST["metin"];//"Bu mail bir deneme mailidir. SMTP server ile gönderilmistir.";
$mail->Body = $body;
$mail->AltBody = $text_body;
$mail->AddAddress($_POST["alici"]); // Mail gönderilecek adresleri ekliyoruz.
if ($mail->Send()) echo "Mail gönderildi";
else echo "Mail gönderimi basarisiz";
$mail->ClearAddresses();
$mail->ClearAttachments();
?>