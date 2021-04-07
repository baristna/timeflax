<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>
<body>
<form name="form1" method="post" action="mail_gonder.php">
<table width="100%" border="1">
 <tr align="center">
 <td colspan="2">Mail Gönderme </td>
</tr>
 <tr>
 <td width="193" align="right">Gönderen Ismi</td>
<td width="1042"><input name="isim" type="text" id="isim"></td>
</tr>
<tr>
<td align="right">Mail Adresiniz </td>
<td><input name="kendi_mail" type="text" id="kendi_mail" size="50"></td>
</tr>
<tr>
<td align="right">Sifreniz</td>
<td><input name="kendi_sifre" type="password" id="kendi_sifre"></td>
</tr>
<tr>
  <td align="right">Smtp Sunucusu Adresi </td>
  <td><input name="smtp" type="text" id="smtp" size="50"></td>
</tr>
<tr>
<td align="right">Gönderilecek Mail </td>
<td><input name="alici" type="text" id="alici" size="50"></td>
</tr>
<tr>
<td height="23" align="right">Konu</td>
 <td><input name="konu" type="text" id="konu" size="100"></td>
</tr>
<tr>
 <td rowspan="2" align="right">Mail Metni </td>
 <td height="23"><textarea name="metin" cols="100" id="metin"></textarea></td>
</tr>
<tr>
 <td height="23"><input type="submit" name="Submit" value="G&ouml;nder">
  <input type="reset" name="Reset" value="Formu Temizle"></td>
</tr>
</table>
</form>
</body>
</html>