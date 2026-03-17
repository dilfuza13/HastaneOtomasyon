<?PHP
    ob_start(); // Çıktı tamponlamayı başlat (Hataları önler)
    require_once("inc_config.php");


    // Giriş yapmış kullanıcı kontrolü
    // inc_config içinde session_start() olduğu için burada tekrar başlatmıyoruz
    $patientid = $_SESSION['patient']['id'] ?? null;

    if(!$patientid){
        die("Görüş Alabilmek için önce giriş yapmalısınız. <a href='index.php'>Giriş Yap</a>");
    }

    // Formdan gelen verileri alıyoruz
    $doctor       = p('doctor');
    $story        = p('story');

    if(empty($doctor) || empty($story)){
        die("Bilgiler eksik veya hatalı! Lütfen tüm alanları seçtiğinizden emin olun. <a href='hesabim.php'>Geri Dön</a>");
    }

    $create = $mysqli->query("insert into requests (doctor, patient, story, status) values('$doctor', '$patientid', '$story', '0')");
    if(!$create){echo 'Requests Eklenemedi!'; exit;}

    $id = $mysqli->insert_id;

    header("Location:talep.php?id=$id");
    exit;

?>