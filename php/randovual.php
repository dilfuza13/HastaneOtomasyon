<?PHP
require_once("inc_config.php");

$doctor_id = $_GET['doctor'] ?? null;

if(!$doctor_id){
    header("Location:doktorlar.php");
    exit;
}

// Seçilen doktorun bilgilerini çekelim
$dr_query = $mysqli->query("SELECT d.*, s.specialization as uzmanlik FROM doctor d 
                            LEFT JOIN specialization s ON d.specialization = s.id 
                            WHERE d.id = '$doctor_id'");
$dr = $dr_query->fetch_assoc();
?>
<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <title>Randevu Al - <?=$dr['name'];?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link href="assets/style.css" rel="stylesheet">
</head>
<body>

<div class="container mb-5">
    <div class="row">
        <div class="col-lg-4">
            <div class="doctor-profile text-center mb-4">
                <img src="uploads/<?= !empty($dr['profilephoto']) ? $dr['profilephoto'] : 'placeholder.png'; ?>" 
                     class="rounded-circle mb-3 shadow" style="width: 150px; height: 150px; object-fit: cover;">
                <h4>Dr. <?=$dr['name'];?></h4>
                <p class="text-primary fw-bold"><?=$dr['uzmanlik'];?></p>
                <hr>
                <p class="text-muted small"><?=$dr['description'];?></p>
                <a href="doktorlar.php" class="btn btn-outline-secondary btn-sm">Geri Dön</a>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="bg-white p-4 rounded-4 shadow-sm">
                <h3 class="mb-4">Müsait Randevu Saatleri</h3>
                
                <?PHP
                // Veritabanındaki sadece "MÜSAİT" (status=1) olan slotları tarihe göre gruplayarak çekiyoruz
                $slots_query = $mysqli->query("SELECT * FROM timeslot 
                                               WHERE doctor = '$doctor_id' AND status = 1 
                                               AND timeslot >= NOW() 
                                               ORDER BY timeslot ASC");
                
                $current_date = "";
                if($slots_query->num_rows > 0){
                    while($s = $slots_query->fetch_assoc()){
                        $tarih_obj = new DateTime($s['timeslot']);
                        $gun = $tarih_obj->format('d.m.Y');
                        $saat = $tarih_obj->format('H:i');

                        // Eğer yeni bir güne geçtiysek tarih başlığı at
                        if($gun != $current_date){
                            if($current_date != "") echo '</div>'; // Önceki satırı kapat
                            echo '<div class="row mb-4">';
                            echo '<div class="col-12"><h5 class="day-title text-primary">'.$gun.'</h5></div>';
                            $current_date = $gun;
                        }
                        ?>
                        <div class="col-md-3 col-6">
                            <form action="randevu-onay.php" method="post">
                                <input type="hidden" name="slot_id" value="<?=$s['id'];?>">
                                <button type="submit" class="btn btn-outline-primary w-100 slot-btn">
                                    <?=$saat;?>
                                </button>
                            </form>
                        </div>
                        <?PHP
                    }
                    echo '</div>'; // Son satırı kapat
                } else {
                    echo '<div class="alert alert-warning">Üzgünüz, bu doktor için şu an aktif bir randevu saati bulunmamaktadır.</div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>