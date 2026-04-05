<?PHP
// Ayarları yaptığımız config dosyasını çağırıyoruz
require_once("../inc_config.php");

// Güvenlik: p() fonksiyonu tanımlı değilse hata vermemesi için basit bir kontrol
if (!function_exists('p')) {
    function p($val) {
        return isset($_POST[$val]) ? trim($_POST[$val]) : '';
    }
}

$action = $_POST['action'] ?? '';

// --- SLOT AYARLAMA ---
if($action=="setslot"){
    $doctor     = $_POST['doctor'];
    $timeslot   = $_POST['timeslot'];
    $slotstatus = $_POST['slotstatus'] ?? 0;

    $slot = mysqli_fetch_assoc($mysqli->query("select id, status from timeslot where doctor='$doctor' and timeslot='$timeslot'"));
    if($slot){
        if($slot['status']==2){
            $_SESSION['alert'] = "Slot dolu, hasta randevusu olduğu için iptal edilemez!";
            header("Location:slotlar.php?doctor=$doctor");
            exit;
        }

        if($slot['status'] != $slotstatus){
            $mysqli->query("update timeslot set status=$slotstatus where id='{$slot['id']}'");
            $_SESSION['alert'] = "Slot Güncellendi";
        }
    }else{
        $mysqli->query("insert into timeslot(doctor, timeslot, status) values('$doctor','$timeslot','$slotstatus')");
        $_SESSION['alert'] = "Yeni Slot Eklendi";
    }
    header("Location:slotlar.php?doctor=$doctor");
    exit;
}

// --- PERSONEL EKLE/DÜZENLE ---
if($action=='adduser'){
    $name = p('name');
    $username = p('username');
    $password = p('password');
    $result = $mysqli->query("INSERT INTO `user` (`name`, `username`, `password`, `status`) VALUES ('$name', '$username', '$password', '1')");
    if($result) { $_SESSION['alert'] = "Personel eklendi"; header("Location:personel.php"); exit; }
}

// --- DOKTOR EKLEME (Fotoğraflı) ---
if($action=='adddoctor'){
    $name = p('name'); 
    $specialization = p('specialization');
    $description = p('description');
    $phone = p('phone');

    $check = mysqli_fetch_assoc($mysqli->query("SELECT id FROM doctor WHERE name='$name'"));
    if($check){ $_SESSION['alert'] = "Doktor zaten mevcut!"; header("Location:doktorlar.php"); exit; }
    
    /*
    // Fotoğraf İşlemi
    $profilephoto = "placeholder.png"; 
    if(isset($_FILES['profilephoto']) && $_FILES['profilephoto']['error'] == 0){
        $target_dir = "../uploads/";
        if (!file_exists($target_dir)) { mkdir($target_dir, 0777, true); }
        $file_ext = pathinfo($_FILES["profilephoto"]["name"], PATHINFO_EXTENSION);
        $new_name = time() . "_" . rand(1000,9999) . "." . $file_ext;
        
        if (move_uploaded_file($_FILES["profilephoto"]["tmp_name"], $target_dir . $new_name)) {
            $profilephoto = $new_name;
        }
    }
        */

    $sql = "INSERT INTO `doctor` (`name`, `specialization`, `description`, `phone`, `profilephoto`, `status`) 
            VALUES ('$name', '$specialization', '$description', '$phone', '$profilephoto', '1')";
    
    if($mysqli->query($sql)){
        $_SESSION['alert'] = "Doktor <b>$name</b> başarıyla eklendi.";
        header("Location:doktorlar.php");
    } else {
        echo "Hata: " . $mysqli->error;
    }
    exit;
}


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


// --- DOKTOR DÜZENLEME ---
if($action=="editdoctor"){
    $id = p('id');
    $name = p('name');
    $specialization = p('specialization');
    $description = p('description');
    $phone = p('phone');
    $status = p('status');

    $mysqli->query("UPDATE `doctor` SET `name`='$name', `specialization`='$specialization', `description`='$description', `phone`='$phone', `status`='$status' WHERE `id`='$id'");
    
    $_SESSION['alert'] = "Doktor bilgileri güncellendi.";
    header("Location:doktor.php?id=$id");
    exit;
}

// --- DOKTOR DÜZENLEME ---
if($action=="editdoctorfast"){
    $id = p('id');
    $specialization = p('specialization');
    $status = p('status');

    $mysqli->query("UPDATE `doctor` SET `specialization`='$specialization', `status`='$status' WHERE `id`='$id'");
    
    $_SESSION['alert'] = "Doktor bilgileri güncellendi.";
    header("Location:doktorlar.php");
    exit;
}

// --- DOKTOR PROFİL FOTO GÜNCELLEME ---
if($action=="editdoctorprofilephoto"){
    $id = p('id');
    $target_dir = "../uploads/";
    
    if(isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] == 0){
        $file_ext = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
        $new_name = "doc_" . $id . "_" . time() . "." . $file_ext;

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $new_name)) {
            $mysqli->query("UPDATE `doctor` SET `profilephoto` = '$new_name' WHERE `id` = '$id'");
            $_SESSION['alert'] = "Fotoğraf güncellendi.";
        }
    }
    header("Location:doktor.php?id=$id");
    exit;
}

// --- DOKTOR SİLME ---
if($action=="deletedoctor"){
    $id = p('id');
    $mysqli->query("DELETE FROM doctor WHERE `id` = '$id'");
    $_SESSION['alert'] = "Doktor kaydı silindi.";
    header("Location:doktorlar.php");
    exit;
}
?>