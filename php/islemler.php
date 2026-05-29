<?PHP

	// HASTANIN İŞLEMLERİNİ YAPTIĞI SAYFA

	// temel ayarları dahil ediyoruz
	include("ayarlar.php");

	// hastanın ID'sini kontrol ediyoruz
	if(!isset($_SESSION['patient']['id'])){header("Location: girisyap.php");  exit;}
	$patientid = $_SESSION['patient']['id'];

	// islem alınıyor
	if(!isset($_POST["islem"])){header("Location: $siteurl"); exit;}
	$islem = p("islem");


	if($islem == 'randevu_olustur'){
		//echo 'geldi'; exit;
		// Formdan gelen verileri alıyoruz
		$doctor		= p('doctor');
		$tarih		= p('tarih');
		$timeslot	= p('timeslot'); // Örn: 09:00

		if(empty($doctor) || empty($tarih) || empty($timeslot)){
			echo("Bilgiler eksik veya hatalı! Lütfen tüm alanları seçtiğinizden emin olun. <a href='hesabim.php'>Geri Dön</a>");
			exit;
		}

		// Veritabanındaki datetime formatıyla (Y-m-d H:i:s) tam eşitleme yapıyoruz
		$timeslotyeni = $tarih . ' ' . $timeslot . ':00';

		// Slotun müsaitliğini kontrol ediyoruz
		$sql = $mysqli->query("SELECT id FROM timeslot WHERE doctor='$doctor' AND timeslot='$timeslotyeni' AND status=1");
		$slot = $sql->fetch_assoc();

		// slot müsait değilse hata dönüyoruz
		if(!$slot){echo("Seçtiğiniz randevu saati (".$timeslot.") artık uygun değil. Lütfen başka bir saat seçin. <a href='hesabim.php'>Geri Dön</a>");	exit;}

		$slot_id = $slot['id'];

		// slotu rezerve ediyoruz (Status: 2 -> DOLU yap)
		$update_slot = $mysqli->query("UPDATE timeslot SET status=2 WHERE id='$slot_id'");

		// slot güncellenmezse hata dönüyoruz
		if($mysqli->affected_rows <= 0){echo("hata oluştu slot güncellenemedi."); exit;}

		// randevular tablosuna kaydı ekliyoruz
		$createAppointment = $mysqli->query("INSERT INTO appointment (doctor, patient, timeslot, status) 
												VALUES ('$doctor', '$patientid', '$timeslotyeni', '1')");

		// randevu eklenemediye slotu tekrar müsait yapıp hata dönüyoruz
		if(!$createAppointment){            
			// Randevu tablosuna yazılamazsa, slotu tekrar MÜSAİT (status=1) yap
			$mysqli->query("UPDATE timeslot SET status=1 WHERE id='$slot_id'");
			$mesaj = "Randevu kaydı oluşturulurken bir hata oluştu!";
			header("Location:hesabim.php?islem=basarisiz");
			exit;
		}

		header("Location:hesabim.php?islem=basarili");
		exit;

		
	}


	if($islem=='randevuiptalet'){
		$randevu = p('randevu');

		$randevubul = mysqli_fetch_assoc($mysqli->query("SELECT * FROM appointment WHERE id='$randevu' and patient='$patientid'"));
		if(!$randevubul){
			exit("Hata! Randevu bulunamadı!");
		}

		if($randevubul['status']!=1){
			exit("Hata! Randevu zaten iptal edilmiş veya dolu!");
		}

		$zaman = $randevubul['timeslot'];

		$date = new DateTime($zaman);
		$now = new DateTime();
		if ($date <= $now) {
			exit("Hata! Geçmiş randevular silinemez.");
		}
		
		if(!$mysqli->query("delete from appointment where id='$randevu' and patient='$patientid'")){
			exit("Hata! Randevu silinemedi.");
		}

		$mysqli->query("update timeslot set status='1' where doctor='{$randevubul['doctor']}' and timeslot='{$randevubul['timeslot']}'");

		header("Location: $siteurl/hesabim.php");
		exit;
	}



	if($islem=="addstory"){
		
		$patient = p("patient");
		$request = p("request");
		$message = p("message");

		if($patient=="" || $request=="" || $message==""){echo "Eksik veri"; exit;}

		$reqeust = mysqli_fetch_assoc($mysqli->query("SELECT * FROM requests WHERE id='$request' and patient='$patient'"));
		if(!$reqeust){echo "Talep bulunamadı veya hatalı"; exit;}
		
		$date = new DateTime();
		//echo $date->format('Y-m-d H:i:s');

		$newstory = $reqeust['story'] . "<br><small>" . $date->format('Y-m-d H:i:s') . "</small><br>" . $message;

		//$mysqli->query("UPDATE requests SET story='$newstory', status='2' WHERE id='$request'");

		$mysqli->query("INSERT INTO request_answers (request, sender, message, status) VALUES ('$request', '1', '$message', '0')");

		header("Location: $siteurl/talep.php?id=$request");

		exit;

	}

	if($islem=="addfile"){        
		$title = p("title");
		$file = $_FILES["file"];

		if($patientid=="" || $title=="" || $file==""){echo "eksik veri"; exit;}

		$fileurl = rand(00000, 99999)."-".rand(00000, 99999).$file["name"];
		
		if(!move_uploaded_file($file["tmp_name"], "uploads/" . $fileurl)){echo "Dosya yüklenemedi"; exit;}

		$mysqli->query("INSERT INTO uploads (patient, title, fileurl) VALUES ('$patientid', '$title', '$fileurl')");

		header("Location: $siteurl/hesabim.php");

		exit;

	}


?>