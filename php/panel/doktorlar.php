<?PHP
require_once("../ayarlar.php");
?>
<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8" />
    <title><?=_SiteAdi;?> - Doktor Yönetimi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        /* Oval Satır Tasarımı */
        .doctor-row { 
            background: white; border-radius: 100px; padding: 10px 30px; 
            margin-bottom: 12px; display: flex; align-items: center; 
            box-shadow: 0 2px 5px rgba(0,0,0,0.05); border: 1px solid #eee;
        }
        .img-circle { width: 55px; height: 55px; border-radius: 50%; object-fit: cover; border: 2px solid #0d6efd; margin-right: 20px; flex-shrink: 0; }
        .input-minimal { border: 1px solid #eee; background: #fcfcfc; border-radius: 30px; padding: 6px 15px; font-size: 0.9rem; }
        /* Satır içi hızlı düzenleme inputları için görünmez kenarlık */
        .input-row-edit { border: none !important; background: transparent !important; padding: 5px; font-size: 0.95rem; width: 100%; }
        .input-row-edit:focus { outline: none; border-bottom: 1px dashed #0d6efd !important; }
        
        .btn-round { border-radius: 30px; font-weight: 600; padding: 6px 20px; font-size: 0.8rem; }
        .label-style { font-size: 0.7rem; font-weight: 800; color: #0d6efd; margin-left: 15px; margin-bottom: 3px; display: block; }
        
        /* Form Card Tasarımı */
        .admin-card { background: white; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

    <?PHP if(file_exists('navbar.php')) { include("navbar.php"); } ?>
    <hr>

    <div class="container mb-5">
        <h2 class="fw-bold">DOKTOR YÖNETİMİ</h2>
        <hr>

        <?PHP if(isset($_SESSION['alert'])){?>
            <div class="alert alert-success rounded-pill px-4" role="alert"> <?=$_SESSION['alert'];?> </div>
        <?PHP unset($_SESSION['alert']); } ?>

        <!-- YENİ DOKTOR EKLEME FORMU -->
        <div class="card admin-card border-0 mb-5">
            <div class="card-body p-4">
                <form action="islemler.php" method="POST" class="row g-3 align-items-end">
                    <div class="col-lg-3 col-md-6">
                        <span class="label-style">AD SOYAD</span>
                        <input type="text" name="name" class="form-control input-minimal" placeholder="Dr. Adı Soyadı" required>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <span class="label-style">UZMANLIK</span>
                        <select name="specialization" class="form-select input-minimal">
                            <?php
                            $u_s = $mysqli->query("SELECT * FROM specialization");
                            while($u = $u_s->fetch_assoc()){ echo "<option value='{$u['id']}'>{$u['specialization']}</option>"; }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <span class="label-style">DOKTOR HAKKINDA</span>
                        <input type="text" name="description" class="form-control input-minimal" placeholder="Kısa özgeçmiş...">
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <span class="label-style">İLETİŞİM</span>
                        <input type="text" name="phone" class="form-control input-minimal" placeholder="05XX...">
                    </div>
                    <div class="col-lg-2 text-end">
                        <button type="submit" name="ekle" class="btn btn-primary btn-round w-100">KAYDET</button>
                    </div>
                    <input type="hidden" name="islem" value="doktorekle">
                </form>
            </div>
        </div>

        <h5 class="mb-4 text-muted fw-bold" style="margin-left: 10px;">Kayıtlı Doktor Listesi (Satır Üzerinden Düzenleyebilirsiniz)</h5>

        <!-- KAYITLI DOKTOR LİSTESİ -->
        <?PHP
        // Ön yüzde yaptığımız gibi klasördeki yedek resimleri hafızaya alalım
        $hastane_resimleri = [];
        if (is_dir("../Hastaneresim")) {
            $dir = opendir("../Hastaneresim");
            while (($file = readdir($dir)) !== false) {
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                    $hastane_resimleri[] = "../Hastaneresim/" . $file;
                }
            }
            closedir($dir);
        }
        sort($hastane_resimleri);
        $resim_sayisi = count($hastane_resimleri);

        $sorgu = $mysqli->query("SELECT d.*, s.specialization as uzmanlik FROM doctor d LEFT JOIN specialization s ON d.specialization = s.id ORDER BY d.id DESC");

        while($row = $sorgu->fetch_assoc()){

        ?>
        <div class="doctor-row shadow-sm">
            <form action="islemler.php" method="POST" class="d-flex align-items-center w-100 gap-3">
                <input type="hidden" name="id" value="<?=$row['id'];?>">
                
                <!-- Doktor Profil Resmi -->
                <img src="../uploads/<?=$row['profilephoto']??"placeholder.png";?>" class="img-circle" alt="Doktor">
                
                <!-- Doktor Adı Soyadı (Düzenlenebilir input haline getirildi) -->
                <div style="flex: 1.5;">
                    <h5><a href="doktor.php?id=<?=$row['id'];?>"><?= 'Dr. ' . $row['name']; ?></a></h5>
                </div>
                
                <!-- Uzmanlık Seçimi -->
                <div style="flex: 1.2;">
                    <select name="specialization" class="form-select input-minimal">
                        <?php
                        $u_s2 = $mysqli->query("SELECT * FROM specialization");
                        while($u2 = $u_s2->fetch_assoc()){
                            $sel = ($u2['id'] == $row['specialization']) ? "selected" : "";
                            echo "<option value='{$u2['id']}' $sel>{$u2['specialization']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Doktor Açıklaması (Düzenlenebilir input haline getirildi) -->
                <div style="flex: 2;">
                    <h5><?=substr($row['description']??"-",0,30); ?></h5>
                </div>

                <!-- Telefon Numarası (Düzenlenebilir input haline getirildi) -->
                <div style="flex: 1;">
                    <h5><?=substr($row['phone']??"-",0,30); ?></h5>
                </div>

                <!-- Durum (Aktif/Pasif Hatası Giderildi) -->
                <div style="flex: 1;">
                    <select name="status" class="form-select input-minimal">
                        <option value="0" <?= ($row['status'] == 0) ? "selected" : ""; ?>>Pasif</option>    
                        <option value="1" <?= ($row['status'] == 1) ? "selected" : ""; ?>>Aktif</option>
                    </select>
                </div>

                <!-- Güncelleme Butonu -->
                <div style="flex: 0.8;">
                    <button type="submit" name="guncelle" class="btn btn-outline-primary btn-round w-100">KAYDET</button>
                </div>
                <input type="hidden" name="islem" value="doktorduzenlehizli">
            </form>
        </div>
        <?PHP } ?>

    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>