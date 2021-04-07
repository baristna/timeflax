<?php /**
 * HTMLMail()
 * 
 * Mail fonksiyonu ile HTML mail göndermenizi sağlar
 * 
 * @param mixed $gidecekMail
 * @param mixed $gonderenAd
 * @param mixed $gonderenMail
 * @param mixed $konu
 * @param mixed $mesaj
 * @return
 */
function HTMLMail($gidecekMail,$gonderenAd,$gonderenMail,$konu,$mesaj) {
    $headers  = "MIME-Version: 1.0n";
    $headers .= "Content-type: text/html; charset=UTF-8n";
    $headers .= "X-Mailer: PHPn";
    $headers .= "X-Sender: PHPn";
    $headers .= "From: $gonderenAd<$gonderenMail>n";
    $headers .= "Reply-To: $gonderenAd<$gonderenMail>n";
    $headers .= "Return-Path: $gonderenAd<$gonderenMail>n";
    mail($gidecekMail,$konu,$mesaj,$headers);
}
// no-reply@trkodlama.com'dan gidiyormuş gibi info@trkodlama.com adresine mail gönderelim
HTMLMail("info@trkodlama.com", "TR Kodlama / no-reply", "no-reply@trkodlama.com", "Konumuz Yok", "<p>Mesajımız deneme olsun, deneme mesajı ve örnektir.</p><p>Bunlarda paragraflarımız</p>");
?>