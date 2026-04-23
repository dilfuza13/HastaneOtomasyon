<?php
define('SMTP_HOST', 'mail.alanadi.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', "eposta adresiniz");
define('SMTP_PASSWORD', "epostanızın şifresi");
define('SMTP_TLS', false);

define('SMTP_SENDER_NAME', "Gönderen İsmi");

define('ALICI_ADRESI',"lütfen alıcı adresi buraya belirtin");
define('ALICI_ISMI', "Alıcı İsmi")

?>
<html>
<head>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv=”Content-Type” content=”text/html; charset=iso-8859-9″ />
	<title>Örnek iletişim formu</title>
</head>
<body>
<fieldset style="width:400px;">
	<h3><a href="iletisim.php">İletişim Formu</a></h3>
	<form method="post" action="iletisim.php?islem">
	<p><input type="text" name="isim" size="20" /> <label for="isim"> <b>Adınız</b> </label></p>

	<p><input type="text" name="eposta" size="20" /> <label for="eposta"> <b>Eposta Adresiniz</b> </label></p>

	<p><input type="text" name="konu" size="20" /> <label for="konu"> <b>Konu</b> </label></p>
	<p><textarea rows="6" name="mesaj" cols="30"></textarea> <label for="mesaj"> <b>Mesajınız</b> </label></p>

	<p><input type="reset" value="Sıfırla" /> <input type="submit" value="Gönder" /></p> 
<?php
header('Content-Type: text/html; charset=utf-8');
if (isset($_GET['islem'])) {
	
	if ($_POST['eposta']<>'' && $_POST['isim']<>'' && $_POST['konu']<>'' && $_POST['mesaj']<>'') {

	require_once("smtp/PHPMailerAutoload.php");

	$mail = new PHPMailer(true);
	$mail->IsSMTP();
	$mail->Host = SMTP_HOST;
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = SMTP_TLS;
	$mail->SMTPAutoTLS = SMTP_TLS;
	$mail->CharSet = 'UTF-8';
	$mail->Username = SMTP_USERNAME; 
	$mail->Password = SMTP_PASSWORD;
	$mail->From = SMTP_USERNAME; 
	$mail->FromName = SMTP_SENDER_NAME;
	$mail->AddAddress(ALICI_ADRESI,ALICI_ISMI); // Epostanın gideceği adres. Bu adres için iletişim formlarında yine yukarıdaki adres yazılabilir. Aynı adresin yazılması, mail formunun kendine gönderilmesini sağlar. Bu sayede mesaj kaybı yaşanma riski sıfıra yakındır. Yine de mail formu farklı bir adresede gönderilebilir.
	$mail->Subject = $_POST['konu'] ." - ". $_POST['eposta']; // Bu alanı değiştirmeyiniz.
	$mail->Body = $_POST['mesaj']; // Bu alanı değiştirmeyiniz.

	if(!$mail->Send())
	{
	   echo '<font color="#F62217"><b>Gönderim Hatası: ' . $mail->ErrorInfo . '</b></font>';
	   exit;
	}
	echo '<font color="#41A317"><b>Mesaj başarıyla gönderildi.</b></font>';
	} else {
		 echo '<font color="#F62217"><b>Tüm alanların doldurulması zorunludur.</b></font>';
	}
}
?>
	</form>
</fieldset>
</body>
</html>
