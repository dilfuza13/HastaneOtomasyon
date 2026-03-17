<?PHP
    // Oturumun zaten başlatılıp başlatılmadığını kontrol ediyoruz
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    ob_start();

    // veri tabanı bağlantı bilgilerini tanımlıyoruz
    $DbHost     = "mysql";
    $DbUser     = "admindilfuza";
    $DbPass     = "dilfuzakarimova";
    $DbName     = "hastaneotomasyon";

    //vertabanına bağlanıyoruz
    $mysqli = new mysqli($DbHost, $DbUser, $DbPass, $DbName);

    //bağlantı kurulamazsa hata dönüyoruz
    if($mysqli->connect_errno){
        printf("Bağlantı Hatası: %s\n", $mysqli->connect_error);
        exit();
    }
    
    //bağlantı sağlandı, dil formatını UTF8 olarak tanımlıyoruz
    mysqli_query($mysqli ,"SET NAMES UTF8");

    $sitename = "Hastane Otomasyon"; 
    const _SiteName = "Hastane Otomasyon"; 
    const _CopyRight = "2026";

    //GET ile alınan verileri temizleyen fonksion
    function g($data){
        if(!isset($_GET[$data])){return false;} 
        $data = trim($_GET[$data]); 
        $data = strip_tags($data); 
        return $data; 
    }

    //POST ile alınan verileri temizleyen fonksion
    function p($data){
        if(!isset($_POST[$data])){return false;}
        $data = trim($_POST[$data]);
        $data = strip_tags($data);
        return $data;
    }
?>