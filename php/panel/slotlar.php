<?PHP
    require_once("../inc_config.php");
    $doctor = $_GET['doctor'] ?? null;

    if($doctor){
        $dr = mysqli_fetch_assoc($mysqli->query("select * from doctor where id='$doctor'"));
        if(!$dr){
            $_SESSION['alert'] = "Doktor bulunamadı!";
            header("Location:slotlar.php");
            exit;
        }
    }

    // Mevcut slotları diziye çekme (Senin mantığın doğru, devam ediyoruz)
    $slotlar = [];
    if($doctor){
        $querySlotlar = $mysqli->query("select * from timeslot where doctor='$doctor'");
        while($ss=mysqli_fetch_array($querySlotlar)){
            $slotlar[$ss['timeslot']]=$ss['status'];
        }
    }

    // Hangi saatlerin görünmesini istiyorsan buraya ekle
    $saatler = ["09:00", "10:00", "11:00", "12:00", "14:00", "15:00", "16:00", "17:00"];
?>
<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8" />
    <title>Slot Yönetimi - <?=_SiteName;?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table td { vertical-align: middle; }
        .form-check-input:checked { background-color: #198754; border-color: #198754; }
        .form-check-input:disabled { opacity: 0.5; background-color: #dc3545; }
    </style>
</head>
<body class="bg-light">

<?PHP include("inc_header.php");?>

<div class="container mt-4">
    <div class="card shadow-sm p-4">
        <h2>SLOT YÖNETİMİ</h2>
        <form action="slotlar.php" method="get" class="row g-2 align-items-center">
            <div class="col-auto">
                <?PHP $result = $mysqli->query("select d.*, s.specialization from doctor as d inner join specialization as s on s.id=d.specialization"); ?>
                <select name="doctor" class="form-select" required>
                    <option value="">- DOKTOR SEÇİNİZ -</option>
                    <?PHP while($rs = mysqli_fetch_array($result)){?>
                        <option value="<?=$rs['id'];?>" <?=($rs['id']==$doctor)?"selected":"";?>><?=$rs['name'];?> (<?=$rs['specialization'];?>)</option>
                    <?PHP } ?>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">LİSTELE</button>
            </div>
        </form>

        <?PHP if($doctor): ?>
        <hr>
        <h4 class="text-primary">Dr. <?=$dr['name'];?> için Çalışma Saatleri</h4>
        <div class="table-responsive">
            <table class="table table-hover mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>Tarih</th>
                        <?PHP foreach($saatler as $s): ?> <th><?=$s;?></th> <?PHP endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                <?PHP
                    $tarih = new DateTime();
                    for ($i = 1; $i <= 10; $i++) {
                        $tarih->modify('+1 day');
                        $dateKey = $tarih->format('Y-m-d');
                        $dateShow = $tarih->format('d.m.Y');
                ?>
                    <tr>
                        <td class="fw-bold"><?=$dateShow;?></td>
                        <?PHP foreach($saatler as $saat): 
                            $fullTime = $dateKey . " " . $saat . ":00";
                            $status = $slotlar[$fullTime] ?? 0; // 0: kapalı, 1: açık, 2: dolu
                            
                            $checked = ($status == 1 || $status == 2) ? "checked" : "";
                            $disabled = ($status == 2) ? "disabled" : ""; // Randevu alınmışsa sekreter değiştiremez
                        ?>
                        <td>
                            <form action="actions.php" method="post" class="m-0">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="slotstatus" 
                                           onchange="this.form.submit();" value="1" 
                                           <?=$checked;?> <?=$disabled;?>>
                                </div>
                                <input type="hidden" name="action" value="setslot">
                                <input type="hidden" name="doctor" value="<?=$doctor;?>">
                                <input type="hidden" name="timeslot" value="<?=$fullTime;?>">
                            </form>
                        </td>
                        <?PHP endforeach; ?>
                    </tr>
                <?PHP } ?>
                </tbody>
            </table>
        </div>
        <div class="alert alert-info py-2">
            <small>* İşaretli olan saatler hastalar tarafından görülebilir. <b>Kırmızı/Devre dışı</b> olanlar randevu alınmış saatlerdir.</small>
        </div>
        <?PHP endif; ?>
    </div>
</div>

</body>
</html>