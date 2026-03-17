<?PHP
ob_start();
// Oturum zaten başlatılmışsa tekrar başlatma hatasını önlemek için kontrol ekledik
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once("../inc_config.php");

// 1. DOKTOR EKLEME
if(isset($_POST['ekle'])){
    $name = mysqli_real_escape_string($mysqli, $_POST['name']);
    $spec = intval($_POST['specialization']);
    $desc = mysqli_real_escape_string($mysqli, $_POST['description']);
    $phone = mysqli_real_escape_string($mysqli, $_POST['phone']);
    
    $mysqli->query("INSERT INTO doctor (name, specialization, description, phone, status) VALUES ('$name', '$spec', '$desc', '$phone', 1)");
    $yeni_id = $mysqli->insert_id;

    if(isset($_FILES['profilephoto']) && $_FILES['profilephoto']['error'] == 0){
        $yeni_ad = "dr_" . $yeni_id . "_" . time() . ".jpg";
        if(move_uploaded_file($_FILES['profilephoto']['tmp_name'], "../uploads/" . $yeni_ad)){
            $mysqli->query("UPDATE doctor SET image = '$yeni_ad' WHERE id = '$yeni_id'");
        }
    }
    $_SESSION['alert'] = "Doktor başarıyla eklendi.";
    header("Location: doktorlar.php");
    exit;
}

// 2. DOKTOR GÜNCELLEME
if(isset($_POST['guncelle'])){
    $id = intval($_POST['id']);
    $name = mysqli_real_escape_string($mysqli, $_POST['name']);
    $spec = intval($_POST['specialization']);
    $desc = mysqli_real_escape_string($mysqli, $_POST['description']);
    $phone = mysqli_real_escape_string($mysqli, $_POST['phone']);
    
    $mysqli->query("UPDATE doctor SET name='$name', specialization='$spec', description='$desc', phone='$phone' WHERE id='$id'");

    if(isset($_FILES['profilephoto']) && $_FILES['profilephoto']['error'] == 0){
        $yeni_ad = "dr_" . $id . "_" . time() . ".jpg";
        if(move_uploaded_file($_FILES['profilephoto']['tmp_name'], "../uploads/" . $yeni_ad)){
            $mysqli->query("UPDATE doctor SET image = '$yeni_ad' WHERE id = '$id'");
        }
    }
    $_SESSION['alert'] = "Bilgiler güncellendi.";
    header("Location: doktorlar.php");
    exit;
}
?>
<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8" />
    <title><?=_SiteName;?> - Doktor Yönetimi</title>
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
        .btn-round { border-radius: 30px; font-weight: 600; padding: 6px 20px; font-size: 0.8rem; }
        .label-style { font-size: 0.7rem; font-weight: 800; color: #0d6efd; margin-left: 15px; margin-bottom: 3px; display: block; }
        
        /* Form Card Tasarımı */
        .admin-card { background: white; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

    <?PHP include("inc_header.php");?>
    <hr>

    <div class="container">
        <h2 class="fw-bold">DOKTOR YÖNETİMİ</h2>
        <hr>

        <?PHP if(isset($_SESSION['alert'])){?>
            <div class="alert alert-success rounded-pill px-4" role="alert"> <?=$_SESSION['alert'];?> </div>
        <?PHP unset($_SESSION['alert']); } ?>

        <div class="card admin-card border-0 mb-5">
            <div class="card-body p-4">
                <form action="" method="POST" enctype="multipart/form-data" class="row g-2 align-items-end">
                    <div class="col">
                        <span class="label-style">AD SOYAD</span>
                        <input type="text" name="name" class="form-control input-minimal" placeholder="Dr. Adı Soyadı" required>
                    </div>
                    <div class="col">
                        <span class="label-style">UZMANLIK</span>
                        <select name="specialization" class="form-select input-minimal">
                            <?php
                            $u_s = $mysqli->query("SELECT * FROM specialization");
                            while($u = $u_s->fetch_assoc()){ echo "<option value='{$u['id']}'>{$u['specialization']}</option>"; }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <span class="label-style">DOKTOR HAKKINDA</span>
                        <input type="text" name="description" class="form-control input-minimal" placeholder="Kısa özgeçmiş...">
                    </div>
                    <div class="col">
                        <span class="label-style">İLETİŞİM</span>
                        <input type="text" name="phone" class="form-control input-minimal" placeholder="05XX...">
                    </div>
                    <div class="col">
                        <span class="label-style">RESİM</span>
                        <input type="file" name="profilephoto" class="form-control input-minimal">
                    </div>
                    <div class="col-auto">
                        <button type="submit" name="ekle" class="btn btn-primary btn-round">KAYDET</button>
                    </div>
                </form>
            </div>
        </div>

        <h5 class="mb-4 text-muted fw-bold" style="margin-left: 10px;">Kayıtlı Doktor Listesi</h5>

        <?PHP
        $sorgu = $mysqli->query("SELECT d.*, s.specialization as uzmanlik FROM doctor d LEFT JOIN specialization s ON d.specialization = s.id ORDER BY d.id DESC");
        while($row = $sorgu->fetch_assoc()){
            $resim = (!empty($row['image'])) ? "../uploads/".$row['image']."?v=".time() : "https://via.placeholder.com/100";
        ?>
        <div class="doctor-row shadow-sm">
            <form method="POST" enctype="multipart/form-data" class="d-flex align-items-center w-100 gap-2">
                <input type="hidden" name="id" value="<?=$row['id'];?>">
                
                <img src="<?=$resim;?>" class="img-circle" alt="Doktor">
                
                <div style="flex: 1.5;">
                    <input type="text" name="name" class="form-control input-minimal fw-bold" value="<?=$row['name'];?>">
                </div>
                
                <div style="flex: 1;">
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

                <div style="flex: 2;">
                    <input type="text" name="description" class="form-control input-minimal" value="<?=$row['description'];?>">
                </div>

                <div style="flex: 1;">
                    <input type="text" name="phone" class="form-control input-minimal" value="<?=$row['phone'];?>">
                </div>

                <div style="flex: 1;">
                    <input type="file" name="profilephoto" class="form-control input-minimal" style="font-size: 0.7rem;">
                </div>

                <div style="flex: 0.7;">
                    <button type="submit" name="guncelle" class="btn btn-outline-primary btn-round w-100">DÜZENLE</button>
                </div>
            </form>
        </div>
        <?PHP } ?>

    </div>
</body>
</html>