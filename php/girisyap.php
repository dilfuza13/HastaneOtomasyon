<?PHP
    require_once("ayarlar.php");

    // gelen verileri temizliyoruz
    $email = p('email');
    $password = p('password');

    // bilgiler eksikse hata veriyoruz
    if($email=='' || $password==''){echo 'Bilgiler eksik veya hatalı!'; exit;}

    // e-posta veya TCKN ile kullanıcı arıyoruz
    $patient = mysqli_fetch_assoc($mysqli->query("select * from patient where email='$email' or tckno='$email'"));

    // kullanıcı yoksa hata veriyoruz
    if(!$patient){echo 'E-Posta veya TCKN ve Parola hatalı!'; exit;}

    // şifreler eşleşmiyorsa hata veriyoruz
    if($password!==$patient['password']){echo 'E-Posta veya TCKN ve Parola hatalı!'; exit;}
   
    // hasta bilgileriyle oturum başlatıyoruz
    $_SESSION['patient'] = [
        "login"     => true,
        "id"        => $patient['id'],
        "name"      => $patient['name']
    ];

    // kullanıcıyı hesabım sayfasına yönlendiriyoruz
    header("Location:hesabim.php");
    exit;
?>