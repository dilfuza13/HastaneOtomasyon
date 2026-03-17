<?PHP 
ob_start();
include('inc_config.php');

// Oturum kontrolü: Giriş yapmamışsa index'e at
if(!isset($_SESSION['patient']['id']) || !isset($_GET['id'])){
    header("Location: index.php");
    exit;
}

$id = intval($_GET['id']); // Randevu ID'sini güvenli al
$patientid = $_SESSION['patient']['id']; // Sadece kendi randevusunu silebilsin diye

// 1. Önce bu randevu gerçekten bu hastaya mı ait kontrol edelim (Güvenlik)
$checkQuery = $mysqli->query("SELECT * FROM appointment WHERE id='$id' AND patient='$patientid'");
$randevu = mysqli_fetch_assoc($checkQuery);

if($randevu){
    // 2. Randevuyu sil
    $sil = $mysqli->query("DELETE FROM appointment WHERE id='$id' AND patient='$patientid'");
    
    if($sil){
        // Başarılıysa hesaba geri dön, mesaj gönder (isteğe bağlı)
        header("Location: hesabim.php?durum=iptal_basarili");
    } else {
        // SQL hatası oluşursa
        header("Location: hesabim.php?durum=hata");
    }
} else {
    // Randevu bulunamadıysa veya başkasının randevusunu silmeye çalışıyorsa
    header("Location: hesabim.php?durum=yetkisiz");
}

ob_end_flush();
?>