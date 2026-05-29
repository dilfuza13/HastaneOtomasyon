<?PHP

	// temel ayarları dahil ediyoruz
	require_once("../ayarlar.php");
	

	// formdaki işlemi alıyoruz
	$islem = p('islem');

	// işlem yoksa hata veriyoruz
	if(empty($islem)){
		echo 'İşlem gelmedi, neden geldin ki?';
		exit;
	}

	// Uzmanlık ekleme işlemi
	if($islem=="uzmanlikekle"){

		$specialization = p("specialization");
		$description = p("description");

		// zorunlu alanları kontrol ediyoruz
		if(empty($specialization) || empty($description)){ $_SESSION['alert'] = "Zorunlu alanlar boş!"; header("Location: uzmanliklar.php"); exit; }

		//bu isimde başka uzmanlık var mı check ediyoruz
		$check = mysqli_fetch_assoc($mysqli->query("SELECT id FROM specialization WHERE specialization='$specialization'"));
		if($check){ $_SESSION['alert'] = "Uzmanlık zaten mevcut!"; header("Location: uzmanliklar.php"); exit; }

		// veri tabanına uzmanlığı ekliyoruz
		$ekle = $mysqli->query("INSERT INTO specialization (specialization, description, status) VALUES ('$specialization', '$description', '1')");

		// veri eklenmediye hatayı yazdırıyoruz
		if(!$ekle){
			echo "Uzmanlık eklenirken hata oluştu. Hata: " . $mysqli->error; exit;
		}

		// sonuç mesajı veriyoruz
		$_SESSION['alert'] = "Uzmanlık eklendi.";

		// uzmanlıklar sayfasına geri dönüyoruz
		header("Location:uzmanliklar.php");
		exit;
	}


	// Uzmanlık düzenleme işlemi
	if($islem=="uzmanlikduzenle"){

		$id = p("id");
		$specialization = p("specialization");
		$description = p("description");
		$status = p("status");

		// önemli alanlar dolu mu kontrol ediyoruz
		if(!is_numeric($id) || empty($specialization) || empty($description) || empty($status)){
			echo "Bilgiler eksik veya hatalı!"; exit;
		}

		// veri tabanında bilgileri update ediyoruz
		$mysqli->query("UPDATE specialization SET specialization='$specialization', description='$description', status='$status' WHERE id='$id'");

		// veri tabanına kaydedilmezse hatayı yazdırıyoruz
		if($mysqli->error){
			echo "Uzmanlık güncellenirken hata oluştu. Hata: " . $mysqli->error; exit;
		}

		$_SESSION['alert'] = "Uzmanlık güncellendi.";

		// uzmanlıklar sayfasına geri dönüyoruz
		header("Location:uzmanliklar.php");
		exit;
	}



	// doktor ekleme işlemi
	if($islem == 'doktorekle'){
		$name = p('name'); 
		$specialization = p('specialization');
		$description = p('description');
		$phone = p('phone');

		// gelen verilerden önemli olanları kontrol ediyoruz
		if(empty($name) || empty($specialization)){ $_SESSION['alert'] = "Zorunlu alanlar boş!"; header("Location: doktorlar.php"); exit; }

		//bu isimde başka doktor var mı check ediyoruz
		$check = mysqli_fetch_assoc($mysqli->query("SELECT id FROM doctor WHERE name='$name'"));
		if($check){ $_SESSION['alert'] = "Doktor zaten mevcut!"; header("Location: doktorlar.php"); exit; }
		
		
		// veri tabanına doktoru ekliyoruz
		$doktorekle = $mysqli->query("INSERT INTO doctor (name, specialization, description, phone, status) VALUES ('$name', '$specialization', '$description', '$phone', 1)");
		
		// doktor eklenemezse hatayı yazdıralım
		if(!$doktorekle){echo "Doktor eklerken hata oluştur, hata: " . $mysqli->error; exit;}

		// eklenen doktorun id değerini alıyoruz
		$doktor_id = $mysqli->insert_id;

		// resim varsa yüklüyoruz
		if(isset($_FILES['profilephoto']) && $_FILES['profilephoto']['error'] == 0){

			// resmi yeniden adlandırıyoruz
			$uzanti = pathinfo($_FILES['profilephoto']['name'], PATHINFO_EXTENSION);
			$yeni_ad = "doc_" . $doktor_id . "_" . time() . "." . $uzanti;

			// resim yükleme
			if(move_uploaded_file($_FILES['profilephoto']['tmp_name'], "../uploads/" . $yeni_ad)){

				// doktorun resmini güncelliyoruz
				$mysqli->query("UPDATE doctor SET image = '$yeni_ad' WHERE id = '$doktor_id'");
			}else{
				$_SESSION['alert'] = "Doktor eklendi ama fotoğraf yüklenirken hata oluştu.";
				header("Location: doktorlar.php");
				exit;
			}
		}
		$_SESSION['alert'] = "Doktor başarıyla eklendi.";
		header("Location: doktorlar.php");
		exit;
	}



	// doktor bilgilerini detaylı düzenleme işlemi
	if($islem == "doktorduzenle"){

		$id				= p('id');
		$name			= p('name');
		$specialization = p('specialization');
		$description	= p('description');
		$phone			= p('phone');
		$status			= p('status');

		// önemli alanlar dolu mu kontrol ediyoruz
		if(!is_numeric($id) || empty($name) || empty($specialization)){ $_SESSION['alert'] = "Doktor adı veya uzmanlığı boş olamaz!"; header("Location:doktorlar.php"); exit; }

		// veri tabanında bilgileri update ediyoruz
		$mysqli->query("UPDATE doctor SET name='$name', specialization='$specialization', description='$description', phone='$phone', status='$status' WHERE id='$id'");

		// doktor güncellenmezse hata dönüyoruz
		if($mysqli->error){
			$_SESSION['alert'] = "Doktor bilgileri güncellenemedi!";
			header("Location:doktor.php?id=$id");
			exit;
		}
		
		$_SESSION['alert'] = "Doktor bilgileri güncellendi.";
		header("Location:doktor.php?id=$id");
		exit;
	}



	// doktor bilgilerini hızlı düzenleme işlemi
	if($islem=="doktorduzenlehizli"){

		$id				= p('id');
		$specialization	= p('specialization');
		$status			= p('status');

		if(!is_numeric($id)) { $_SESSION['alert'] = "Bilgiler eksik veya hatalı!"; header("Location:doktorlar.php"); exit; }

		$mysqli->query("UPDATE doctor SET specialization='$specialization', status='$status' WHERE id='$id'");

		// doktor güncellenmezse hata dönüyoruz
		if($mysqli->error){
			$_SESSION['alert'] = "Doktor bilgileri güncellenemedi!";
			header("Location:doktorlar.php");
			exit;
		}
		
		$_SESSION['alert'] = "Doktor bilgileri güncellendi.";
		header("Location:doktorlar.php");
		exit;
	}


	// doktor profil fotoğrafını değiştirme işlemi
	if($islem=="doktorprofilfotoduzenle"){
		
		$id		= p('id');
		$dosya	= $_FILES['fileToUpload'];;


		// id doğru formatta geldi mi diye bakıyoruz
		if(!is_numeric($id)) { echo 'bilgiler eksik veya hatalı'; exit; }
		
		// resim varsa yüklüyoruz
		if(!isset($dosya) || $dosya['error'] != 0){
			echo 'Dosya veya yükleme hatalı!'; exit;
		}


		$yukleme_yeri = "../uploads/";
		// resmi yeniden adlandırıyoruz
		$uzanti = pathinfo($dosya['name'], PATHINFO_EXTENSION);
		$yeni_resim = "doc_" . $id . "_" . time() . "." . $uzanti;

		// resim yükleme
		if (!move_uploaded_file($dosya['tmp_name'], $yukleme_yeri . $yeni_resim)) {
			echo 'Dosya veya yükleme hatalı!'; exit;
		}

		// dosya yüklendi, veri tabanında yeni fotoğrafı güncelliyoruz
		$mysqli->query("UPDATE doctor SET profilephoto = '$yeni_resim' WHERE id = '$id'");
		$_SESSION['alert'] = "Fotoğraf güncellendi.";
		
		header("Location:doktor.php?id=$id");
		exit;
	}


	



	// doktor silme işlemi
	if($islem=="doktorsil"){
		$id = p('id');
		$mysqli->query("DELETE FROM doctor WHERE 'id' = '$id'");
		$_SESSION['alert'] = "Doktor kaydı silindi.";
		header("Location:doktorlar.php");
		exit;
	}



	// randevu için slot ayarlama işlemi
	if($islem=="slotayarla"){

		// önemli alanları alıyoruz
		$doctor     = p('doctor');
		$timeslot   = p('timeslot');
		$slotstatus = p('slotstatus');

		// önemli alanlar dolu mu kontrol ediyoruz
		if(!is_numeric($doctor) || empty($timeslot)) { $_SESSION['alert'] = "Bilgiler eksik veya hatalı!"; header("Location:slotlar.php?doctor=$doctor"); exit; }

		// veritabanında o tarihlere slot var mı bakıyoruz
		$slot = mysqli_fetch_assoc($mysqli->query("select id, status from timeslot where doctor='$doctor' and timeslot='$timeslot'"));


		// slot yoksa müsait slot ekliyoruz
		if(!$slot){
			$slotekle = $mysqli->query("insert into timeslot(doctor, timeslot, status) values('$doctor','$timeslot','$slotstatus')");
			if(!$slotekle){
				echo "Slot eklerken hata oluştu!";
				exit;
			}


			$_SESSION['alert'] = "Yeni Slot Eklendi";
			header("Location:slotlar.php?doctor=$doctor");
			exit;
		}

		// slot varsa ve dolu ise randevu olduğu için düzenlenemez!
		if($slot['status'] == 2){
			$_SESSION['alert'] = "Slot dolu, hasta randevusu olduğu için iptal edilemez!";
			header("Location:slotlar.php?doctor=$doctor");
			exit;
		}

		// slot varsa ve boş ise statusunu güncelliyoruz
		$mysqli->query("update timeslot set status=$slotstatus where id='{$slot['id']}'");

		// slot güncellenmediyse hata yazdırıyoruz
		if ($mysqli->affected_rows <= 0) {
			echo "Slot güncellenirken hata oluştu!";
			exit;
		}

		$_SESSION['alert'] = "Slot Güncellendi";
		header("Location:slotlar.php?doctor=$doctor");
		exit;
	}



	// hasta biilgileri düzenleme
	if($islem=="hastaduzenle"){
		$id = p('id');
		$tckno = p('tckno');
		$name = p('name');
		$email = p('email');
		$phone = p('phone');
		$birthyear = p('birthyear');

		if(!is_numeric($id) || empty($tckno) || empty($name) || empty($email) || empty($phone) || empty($birthyear)) {
			$_SESSION['alert'] = "Bilgiler eksik veya hatalı!"; header("Location: hasta.php?id=$id");
			exit;
		}

		$mysqli->query("UPDATE patient SET tckno='$tckno', name='$name', email='$email', phone='$phone', birthyear='$birthyear' WHERE id='$id'");

		// hasta bilgileri güncellenmediyse hata yazdırıyoruz
		if ($mysqli->affected_rows <= 0) {
			echo "Hasta bilgileri güncellenirken hata oluştu!";
			exit;
		}
		
		$_SESSION['alert'] = "Hasta bilgileri güncellendi.";
		header("Location: hasta.php?id=$id");
		exit;
	}




	if($islem=='addmessage'){
		$requestid	= p('request');
		$message	= p('message');
		$sender		= '2'; // Doktor
		$status		= '0'; // Yeni

		$result = $mysqli->query("INSERT INTO request_answers (request, sender, message, status) VALUES ('$requestid', '$sender', '$message', '$status')");

		if($result) { 
			$_SESSION['alert'] = "Mesaj Gönderildi"; 
			header("Location:talep.php?id=$requestid"); 
			exit; 
		}else{
			$_SESSION['alert'] = "Mesaj Gönderilemedi!"; 
			header("Location:talep.php?id=$requestid"); 
			exit; 
		}
	}





	// --- PERSONEL EKLE/DÜZENLE ---
	if($islem=='adduser'){
		$name = p('name');
		$username = p('username');
		$password = p('password');
		$result = $mysqli->query("INSERT INTO user (name, username, password, status) VALUES ('$name', '$username', '$password', '1')");
		if($result) { $_SESSION['alert'] = "Personel eklendi"; header("Location:personel.php"); exit; }
	}

	// --- DOKTOR EKLEME (Fotoğraflı) ---
	if($islem=='doktorekle'){
		$name = p('name'); 
		$specialization = p('specialization');
		$description = p('description');
		$phone = p('phone');

		$check = mysqli_fetch_assoc($mysqli->query("SELECT id FROM doctor WHERE name='$name'"));
		if($check){ $_SESSION['alert'] = "Doktor zaten mevcut!"; header("Location:doktorlar.php"); exit; }
		

		$sql = "INSERT INTO doctor (name, specialization, description, phone, profilephoto, status) 
				VALUES ('$name', '$specialization', '$description', '$phone', '$profilephoto', '1')";
		
		if($mysqli->query($sql)){
			$_SESSION['alert'] = "Doktor <b>$name</b> başarıyla eklendi.";
			header("Location:doktorlar.php");
		} else {
			echo "Hata: " . $mysqli->error;
		}
		exit;
	}









	// hastadan test tahlil istiyoruz
	if($islem=="testiste"){


		$patient = p('patient');
		$test = p('test');


		// bilgileri kontrol ediyoruz
		if(!is_numeric($patient) || empty($test)){
			echo "Bilgiler eksik veya hatalı!";
			exit;
		}

		// hasta var mı kontrol ediyoruz
		$hasta = mysqli_fetch_assoc($mysqli->query("SELECT id FROM patient WHERE id='$patient'"));
		if(!$hasta){
			$_SESSION['alert'] = "Hasta bulunamadı!";
			header("Location: hasta.php?id=$patient");
			exit;
		}

		$mysqli->query("INSERT INTO laboratory_tests (patient, test, result, status) VALUES ('$patient', '$test', '$result', '0')");
		
		$_SESSION['alert'] = "Test eklendi.";
		header("Location: hasta.php?id=$patient");
		exit;
	}


	if($islem=="testsonucugir"){
		$id = p('id');
		$result = p('result');
		$status = p('status');

		if(!is_numeric($id) || $result=="" || !is_numeric($status) ){
			echo $id . " " . $result . " " . $status.'<br>';
			echo "bilgiler eksik veya hatalı";
			exit;
		}

		// test var mı diye kontrol ediyoruz
		$test = mysqli_fetch_assoc($mysqli->query("SELECT * FROM laboratory_tests WHERE id='$id'"));
		if(!$test){	echo "Test bulunamadı!";exit; }

		$mysqli->query("UPDATE laboratory_tests SET result='$result', status='$status' WHERE id='$id'");

		// test güncellenmediyse hata yazdırıyoruz
		if ($mysqli->affected_rows <= 0) {
			echo "Test güncellenirken hata oluştu!";
			exit;
		}
		
		$_SESSION['alert'] = "Test sonucu güncellendi.";
		header("Location: laboratuvar.php");
		exit;
	}



	if($islem=="testsil"){
		$id = p('id');
		$patient= p('patient');

		if(!is_numeric($id) || !is_numeric($patient)){
			echo "bilgiler eksik veya hatalı";
			exit;
		}

		$mysqli->query("DELETE FROM laboratory_tests WHERE id = '$id'");

		// test silinmediyse hata yazdırıyoruz
		if ($mysqli->affected_rows <= 0) {
			echo "Test silinirken hata oluştu!";
			exit;
		}

		$_SESSION['alert'] = "Test silindi.";
		header("Location: hasta.php?id=$patient");
		exit;
	}


	// hasta ekranına dosya yüklüyoruz
	if($islem=="dosyayukle"){
		$patient = p("patient");
		$title = p("title");
		$file = $_FILES["file"];

		if(!is_numeric($patient) || empty($title) || $file==""){echo "eksik veri"; exit;}

		// hasta var mı kontrol ediyoruz
		$hasta = mysqli_fetch_assoc($mysqli->query("SELECT id FROM patient WHERE id='$patient'"));
		if(!$hasta){
			$_SESSION['alert'] = "Hasta bulunamadı!";
			header("Location: hasta.php?id=$patient");
			exit;
		}

		$fileurl = rand(00000, 99999)."-".rand(00000, 99999).$file["name"];
		
		if(!move_uploaded_file($file["tmp_name"], "../uploads/" . $fileurl)){echo "Dosya yüklenemedi"; exit;}

		$mysqli->query("INSERT INTO uploads (patient, title, fileurl) VALUES ('$patient', '$title', '$fileurl')");

		header("Location: hasta.php?id=$patient");

		exit;

	}

?>