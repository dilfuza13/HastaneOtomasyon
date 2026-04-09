<?PHP 
include('inc_config.php');

// Veritabanından uzmanlıkları çekelim
$specializations = $mysqli->query("SELECT * FROM specialization");

// Eğer bir doktor seçildiyse onun bilgilerini alalım (AJAX kullanmadan en basit yöntem)
$selected_doctor = $_GET['doctor'] ?? null;
?>
<!doctype html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <title>Nova Care | Randevu Sistemi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { padding-top: 110px; background-color: #f8f9fa; }
    .hero { background: linear-gradient(90deg, #0d6efd, #4dabf7); color: white; padding: 60px 0; border-radius: 18px; margin-bottom: 30px; }
    .panel { background: white; padding: 28px; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,.08); }
    /* Saat butonları için senin tasarımını biraz daha işlevsel hale getirdik */
    .btn-check:disabled + .btn-secondary { opacity: 0.3; text-decoration: line-through; }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold text-primary" href="index.php">Nova Care</a>
  </div>
</nav>

<div class="container">
  <div class="hero text-center">
    <h1 class="fw-bold">RANDEVU SİSTEMİ</h1>
    <p class="lead mt-3">Sistemden doktor seçerek uygun saatleri görüntüleyin.</p>
  </div>

  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="panel">
        <form action="randevu-onay.php" method="post">
          <h3 class="text-center mb-4 fw-bold">Hızlı Randevu</h3>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Doktor Seçin</label>
              <select name="doctor" class="form-select" onchange="window.location.href='?doctor='+this.value" required>
                <option value="">- Doktor Seçiniz -</option>
                <?php 
                $docs = $mysqli->query("SELECT * FROM doctor WHERE status=1");
                while($d = $docs->fetch_assoc()){
                    $sel = ($selected_doctor == $d['id']) ? "selected" : "";
                    echo "<option value='{$d['id']}' $sel>{$d['name']}</option>";
                }
                ?>
              </select>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Tarih</label>
              <input type="date" name="tarih" class="form-control" min="<?=date('Y-m-d');?>" value="<?=date('Y-m-d');?>" required>
            </div>
          </div>

          <label class="form-label mt-3">Müsait Saatler</label>
          <div class="d-flex flex-wrap gap-2">
            <?php 
            if($selected_doctor){
                // Panelde (slotlar.php) açtığın ve henüz rezerve edilmemiş (status=1) saatleri çekiyoruz
                $slots = $mysqli->query("SELECT * FROM timeslot WHERE doctor='$selected_doctor' AND status=1 ORDER BY timeslot ASC");
                
                if($slots->num_rows > 0){
                    while($s = $slots->fetch_assoc()){
                        $saat = date('H:i', strtotime($s['timeslot']));
                        echo '
                        <input type="radio" class="btn-check" name="timeslot" id="slot'.$s['id'].'" value="'.$saat.'" required>
                        <label class="btn btn-outline-primary" for="slot'.$s['id'].'">'.$saat.'</label>';
                    }
                } else {
                    echo '<p class="text-danger small">Bu doktor için henüz müsait çalışma saati tanımlanmamış.</p>';
                }
            } else {
                echo '<p class="text-muted small">Saatleri görmek için önce doktor seçiniz.</p>';
            }
            ?>
          </div>

          <button type="submit" class="btn btn-success w-100 mt-4 py-3 fw-bold">
            Randevuyu Onayla
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

</body>
</html>