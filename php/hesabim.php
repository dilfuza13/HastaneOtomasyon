<?PHP 
ob_start();
include('inc_config.php');

if(!isset($_SESSION['patient']['id'])){
    header("Location: index.php");
    exit;
}
$patientid = $_SESSION['patient']['id'];

// Hasta bilgilerini çekelim
$pInfo = mysqli_fetch_assoc($mysqli->query("SELECT * FROM patient WHERE id='$patientid'"));
?>
<!doctype html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <title>Nova Care | Hesabım</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <style>
    :root { --primary-color: #0d6efd; --success-color: #198754; --bg-light: #f4f7fe; }
    body { background-color: var(--bg-light); font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; padding-top: 100px; }
    
    .main-card { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); background: #fff; }
    .header-gradient { background: linear-gradient(45deg, #0d6efd, #0046b8); color: white; border-radius: 20px; padding: 30px; margin-bottom: 30px; }
    
    .form-select { border-radius: 10px; border: 1px solid #e0e0e0; padding: 12px; cursor: pointer; }
    .btn-appointment { border-radius: 12px; padding: 12px 30px; font-weight: 600; text-transform: uppercase; }
    
    .slot-container { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 15px; }
    .btn-check:checked + .btn-outline-primary { background-color: var(--primary-color); color: white; box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3); }
    
    .status-badge { padding: 6px 12px; border-radius: 8px; font-size: 0.85rem; font-weight: 600; }
    .table thead { background-color: #f8f9fa; }
  </style>

  <script>
    function git(url){ window.document.location.href=url; }
  </script>
</head>
<body>

<?PHP include('inc_header.php');?>

<div class="container mb-5">
  
  <div class="header-gradient shadow-sm d-flex justify-content-between align-items-center">
    <div>
        <h2 class="fw-bold mb-1">Merhaba, <?=$pInfo['name'];?>! 👋</h2>
        <p class="mb-0 opacity-75">Nova Care sağlık panelinize hoş geldiniz.</p>
    </div>
    <div class="d-none d-md-block">
        <i class="fa-solid fa-notes-medical fa-3x opacity-25"></i>
    </div>
  </div>

  <div class="row g-4">
    <div class="col-lg-12">
      <div class="main-card p-4 shadow-sm">
        <div class="d-flex align-items-center mb-4">
            <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3">
                <i class="fa-solid fa-calendar-plus text-primary"></i>
            </div>
            <h5 class="mb-0 fw-bold">Yeni Randevu Al</h5>
        </div>

        <form action="randevu_onay.php" method="post">
          <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label small fw-bold text-muted">Poliklinik Seçiniz</label>
                <select name="specialization" required class="form-select" onchange="git('hesabim.php?klinik='+this.value);">
                    <option value="">- Klinik Seçiniz -</option>
                    <?PHP 
                    $subSql = $mysqli->query("SELECT * FROM specialization ORDER BY specialization ASC"); 
                    while($ss = mysqli_fetch_array($subSql)){ 
                        $selected = ($ss['id'] == g('klinik')) ? "selected" : "";
                        echo "<option value='{$ss['id']}' $selected>{$ss['specialization']}</option>";
                    } ?>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label small fw-bold text-muted">Doktor Seçimi</label>
                <select name="doctor" required class="form-select" onchange="git('hesabim.php?klinik=<?=g('klinik');?>&doktor='+this.value);">
                    <?PHP if(g('klinik')){ ?>
                        <option value="">- Doktor Seçiniz -</option>
                        <?PHP 
                        $klinik_id = g('klinik');
                        $docSql = $mysqli->query("SELECT * FROM doctor WHERE specialization='$klinik_id' ORDER BY name ASC"); 
                        while($ds = mysqli_fetch_array($docSql)){ 
                            $selected = ($ds['id'] == g('doktor')) ? "selected" : "";
                            echo "<option value='{$ds['id']}' $selected>Dr. {$ds['name']}</option>";
                        } ?>
                    <?PHP } else { ?>
                        <option value="">Lütfen Önce poliklinik seçin</option>
                    <?PHP } ?>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label small fw-bold text-muted">Tarih Seçimi</label>
                <select name="tarih" required class="form-select" onchange="git('hesabim.php?klinik=<?=g('klinik');?>&doktor=<?=g('doktor');?>&tarih='+this.value);">
                    <option value="">- Tarih Seçiniz -</option>
                    <?PHP 
                    $tarih_obj = new DateTime(); 
                    for ($i = 0; $i <= 10; $i++) { 
                        $tarih_obj->modify('+1 day'); 
                        $val = $tarih_obj->format('Y-m-d'); 
                        $dis = ($tarih_obj->format('N') >= 6) ? "disabled" : ""; 
                        $sel = ($val == g('tarih')) ? "selected" : "";
                        echo "<option value='$val' $sel $dis>".$tarih_obj->format('d.m.Y')."</option>";
                    } ?>
                </select>
            </div>

            <?PHP if(g('klinik') && g('doktor') && g('tarih')){ ?>
            <div class="col-12 mt-4 text-center">
                <label class="form-label small fw-bold text-muted d-block mb-3">Uygun Randevu Saatleri</label>
                <div class="slot-container justify-content-center">
                    <?PHP 
                    $t1 = g('tarih');
                    $doktor_id = g('doktor');
                    $slotlar = [];
                    $querySlotlar = $mysqli->query("SELECT timeslot FROM timeslot WHERE doctor='$doktor_id' AND timeslot LIKE '$t1%' AND status=1");
                    while($ss = mysqli_fetch_array($querySlotlar)){ $slotlar[] = date("H:i", strtotime($ss['timeslot'])); }
                    
                    $calisma_saatleri = ['09:00','10:00','11:00','12:00','14:00','15:00','16:00','17:00'];
                    foreach($calisma_saatleri as $saat){ 
                        $isDisabled = in_array($saat, $slotlar) ? "" : "disabled";
                    ?>
                        <input type="radio" class="btn-check" name="timeslot" id="st<?=$saat;?>" value="<?=$saat;?>" <?=$isDisabled;?> required>
                        <label class="btn btn-outline-primary px-4 rounded-pill" for="st<?=$saat;?>"><?=$saat;?></label>
                    <?PHP } ?>
                </div>
                <div class="mt-5">
                    <button type="submit" class="btn btn-primary btn-appointment shadow px-5">
                        <i class="fa-solid fa-check-circle me-2"></i> Randevuyu Tamamla
                    </button>
                </div>
            </div>
            <?PHP } ?>
          </div>
        </form>
      </div>
    </div>

    <div class="col-12">
      <div class="main-card p-4 shadow-sm">
        <h5 class="fw-bold mb-4 text-dark"><i class="fa-solid fa-clock-rotate-left me-2 text-success"></i> Aktif Randevularınız</h5>
        <div class="table-responsive">
          <table class="table align-middle">
            <thead class="table-light">
              <tr>
                <th>TARİH & SAAT</th>
                <th>POLİKLİNİK</th>
                <th>DOKTOR</th>
                <th class="text-center">DURUM</th>
                <th class="text-end">İŞLEM</th>
              </tr>
            </thead>
            <tbody>
              <?PHP
              // Sorguya a.id'yi aid olarak ekledim ki silme işlemi yapılabilsin
              $myQuery = "SELECT a.id as aid, a.timeslot, d.name as dname, s.specialization as kname 
                          FROM appointment a 
                          INNER JOIN doctor d ON d.id=a.doctor 
                          INNER JOIN specialization s ON s.id=d.specialization 
                          WHERE a.patient='$patientid' AND a.timeslot >= CURRENT_TIMESTAMP() ORDER BY a.timeslot ASC";
              $res = $mysqli->query($myQuery);
              if($res->num_rows > 0){
                while($rs = mysqli_fetch_array($res)){ ?>
                  <tr>
                    <td class="fw-bold text-dark"><?=date("d.m.Y H:i", strtotime($rs['timeslot']));?></td>
                    <td><span class="text-muted small"><?=$rs['kname'];?></span></td>
                    <td>Dr. <?=$rs['dname'];?></td>
                    <td class="text-center"><span class="status-badge bg-success bg-opacity-10 text-success">Aktif</span></td>
                    <td class="text-end">
                        <a href="iptal.php?id=<?=$rs['aid'];?>" class="btn btn-sm btn-outline-danger border-0" onclick="return confirm('Randevuyu iptal etmek istediğinize emin misiniz?');">
                            <i class="fa-solid fa-trash-can me-1"></i> İptal Et
                        </a>
                    </td>
                  </tr>
                <?PHP } 
              } else {
                  echo "<tr><td colspan='5' class='text-center py-5 text-muted'>Henüz bir randevunuz bulunmuyor.</td></tr>";
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- CopyRight Dilfuza Hanım -->
</body>
</html>