<?PHP
    ob_start(); // Çıktı tamponlamayı başlat (Hataları önler)
    require_once("inc_config.php");

    // Giriş yapmış kullanıcı kontrolü
    // inc_config içinde session_start() olduğu için burada tekrar başlatmıyoruz
    $patientid = $_SESSION['patient']['id'] ?? null;

    if(!$patientid){
        die("Randevu alabilmek için önce giriş yapmalısınız. <a href='index.php'>Giriş Yap</a>");
    }

    // Formdan gelen verileri alıyoruz
    $doctor       = p('doctor');
    $tarih        = p('tarih');
    $timeslot_raw = p('timeslot'); // Örn: 09:00

    if(empty($doctor) || empty($tarih) || empty($timeslot_raw)){
        die("Bilgiler eksik veya hatalı! Lütfen tüm alanları seçtiğinizden emin olun. <a href='hesabim.php'>Geri Dön</a>");
    }

    // Veritabanındaki datetime formatıyla (Y-m-d H:i:s) tam eşitleme yapıyoruz
    $full_timeslot = $tarih . ' ' . $timeslot_raw . ':00';

    // 1. Slotun hala MÜSAİT (status=1) olup olmadığını kontrol et
    $check_sql = "SELECT id FROM timeslot WHERE doctor='$doctor' AND timeslot='$full_timeslot' AND status=1";
    $slot_res = $mysqli->query($check_sql);
    $slot = mysqli_fetch_assoc($slot_res);

    if(!$slot){
        die("Seçtiğiniz randevu saati (".$timeslot_raw.") artık uygun değil. Lütfen başka bir saat seçin. <a href='hesabim.php'>Geri Dön</a>");
    }

    $slot_id = $slot['id'];

    // 2. Slotu rezerve et (Status: 2 -> DOLU yap)
    $update_slot = $mysqli->query("UPDATE timeslot SET status=2 WHERE id='$slot_id'");

    if($mysqli->affected_rows > 0){
        
        // 3. Appointment (Randevular) tablosuna kaydı ekle
        $createAppointment = $mysqli->query("INSERT INTO appointment (doctor, patient, timeslot, status) 
                                             VALUES ('$doctor', '$patientid', '$full_timeslot', '1')");

        if($createAppointment){
            // BAŞARILI: Kullanıcıyı kendi paneline geri gönder
            header("Location:hesabim.php?islem=basarili");
            exit;
        } else {
            // Randevu tablosuna yazılamazsa, slotu tekrar MÜSAİT (status=1) yap
            $mysqli->query("UPDATE timeslot SET status=1 WHERE id='$slot_id'");
            die("Randevu kaydı oluşturulurken bir hata oluştu: " . $mysqli->error);
        }

    } else {
        die("Sistem hatası: Randevu saati güncellenemedi.");
    }
    ob_end_flush();
?>