<?PHP
    
    // ayarları dahil ediyoruz
    include("ayarlar.php");

    // POST verilerini alıyoruz
    $name = p('name');
    $email = p('email');
    $password = p('password');
    $phone = p('phone');
    $address = p('address');
    $birthyear = p('birthyear');
    $relative = p('relative');
    $tckno = p('tckno');

    // bu bilgilerle hasta var mı diye kontrol ediyoruz.
    $patient = mysqli_fetch_assoc($mysqli->query("select id from patient where email='$email' or tckno='$tckno'"));
    if($patient){echo 'bu eposta veya TCKN ile zaten bir hesap var!'; exit;}

    // yeni hasta oluşturuluyor
    $ekle = $mysqli->query("insert into patient(name, email, password, phone, birthyear, address, relative, tckno)
                        values('$name','$email','$password','$phone','$birthyear','$address','$relative','$tckno')");


    // eklenemediye hata veriyoruz
    if(!$ekle){
        echo 'Üyelik oluşturulamadı!';
        exit;
    }

    // kullanıcı bilgileriyle oturum başlatıyoruz.
    $_SESSION['patient'] = [
        "login" => true,
        "id" => $mysqli->insert_id, // son eklenen üyenin id'si
        "name" => $name
    ];

    // kullanıcı yönlendiriliyor
    header("Location:hesabim.php");
    exit;
    

    
?>