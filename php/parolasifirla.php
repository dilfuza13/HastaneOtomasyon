<?PHP
    require_once("inc_config.php");
    require_once("smtp/PHPMailerAutoload.php");


    $email = p('email');
    if($email==''){echo "Lütfen e-posta adresinizi giriniz."; exit;}

    $patient = mysqli_fetch_assoc($mysqli->query("SELECT * FROM patient WHERE email='$email'"));
    if(!$patient){echo "E-posta adresi bulunamadı."; exit;}

    $resetcode = uniqid();
    $link = "$siteurl/parolasifirlama.php?resetcode=$resetcode&email=$email";


    $to = $email;
    $subject = "$sitename - Parola Sıfırlama Talebi";
    $message = "Merhaba, Şifrenizi sıfırlamak için aşağıdaki bağlantıya tıklayın: <a href='$link'>Şifre Sıfırla</a>";

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: ".$sitename." <$info_mail>";
    $headers .= "To: ".$patient['name']." <$email>";


    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->CharSet = 'UTF-8';
    $mail->Host = 'mail.ox.web.tr';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = "novacare@ox.web.tr";
    $mail->Password = 'Dilfuza2026?';
    $mail->SMTPSecure = 'tls';

    $mail->setFrom($info_mail, $sitename);
    $mail->addAddress($email, $patient['name']);
    $mail->Subject = $subject;
    $mail->msgHTML($message);

    if (!$mail->send()) {echo "Hata: " . $mail->ErrorInfo; exit;}
    
    $mysqli->query("INSERT INTO resetpassword (`patient`, `resetcode`, `status`, `expiredtime`) VALUES 
                    ('$patient[id]', '$resetcode', '0', DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 MINUTE))");

    echo "E-posta başarıyla gönderildi.";
    header("Location: $siteurl");

    

?>