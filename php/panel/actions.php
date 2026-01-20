<?PHP

	//ayarları yaptığımız config dosyasını çağırıyoruz
	//require_once "1 kere çağır" demek, birden fazla çağırırsak ilk olanı işleme alacak
	require_once("inc_config.php");


	$action = $_POST['action'];

	echo $action."<hr>";

	$name = "Dilfuza";





	if($action=="setslot"){

		$doctor		= $_POST['doctor'];
		$timeslot	= $_POST['timeslot'];
		//$timeslot	= "2026-02-01 13:00";
		$slotstatus	= $_POST['slotstatus'] ?? 0;

		echo $timeslot.'>'.$slotstatus;

		$slot = mysqli_fetch_assoc($mysqli->query("select id, status from timeslot where doctor='$doctor' and timeslot='$timeslot'"));
		if($slot){
			echo 'slot var';
			if($slot['status']==2){echo 'Slot dolu, iptal edemezsiniz, hasta randevusunu iptal ettikten sonra iptal edebilirsiniz'; exit;}

			if($slot['status']!=$slotstatus){
	
				$mysqli->query("update timeslot set status=$slotstatus where id='{$slot['id']}'");

				if($mysqli -> affected_rows<1){
					echo 'Slot güncellenemedi!'; exit;
				}

				$_SESSION['alert'] = "Slot Güncellendi";

			}else{

				$_SESSION['alert'] = "Slot durumu zaten aynı";
			}

		}else{
			echo 'slot yok';

			$addslot = $mysqli->query("insert into timeslot(doctor, timeslot, status) values('$doctor','$timeslot','$slotstatus')");
			if(!$addslot){echo 'Slot eklenemedi!'; exit;}

			$_SESSION['alert'] = "Slot Güncellendi";	
		}
		
		
			
		header("Location:slotlar.php?doctor=$doctor");
		exit;
		

	}





	if($action=='adduser'){

		$name = $_POST['name'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$validate = $_POST['validate'];

		$result = $mysqli->query("INSERT INTO `user` (`name`, `username`, `password`, `status`)
						VALUES ('$name', '$username', '$password', '1');");

		if($result){
			$_SESSION['alert'] = "Personel <b>" . $name . "</b> başarıyla eklendi";
			header("Location:personel.php");
			exit;
		}else{
			echo 'Bir hata oluştu! '.$mysql->error;
			exit;
		}
	}




	if($action=="edituser"){

		$id = $_POST['id'];
		$name = $_POST['name'];
		$username = $_POST['username'];
		$status = $_POST['status'];		

		$myQuery = "UPDATE `user` SET
						`name` = '$name',
						`username` = '$username',
						`status` = '$status'
					WHERE `id` = '$id'";

		$result = $mysqli->query($myQuery);

		$_SESSION['alert'] = "Personel başarıyla düzenlendi";

		header("Location:personel.php");
		exit;
	}




	if($action=='addspecialization'){

		$specialization = $_POST['specialization'];
		$description = $_POST['description'];

		$result = $mysqli->query("INSERT INTO `specialization` (`specialization`, `description`, `status`)
						VALUES ('$specialization', '$description', '1');");

		if($result){
			$_SESSION['alert'] = "Uzmanlık <b>" . $specialization . "</b> başarıyla eklendi";
			header("Location:uzmanliklar.php");
			exit;
		}else{
			echo 'Bir hata oluştu! '.$mysql->error;
			exit;
		}
	}




	if($action=="editspecialization"){

		$id = $_POST['id'];
		$specialization = $_POST['specialization'];
		$description = $_POST['description'];
		$status = $_POST['status'];

		$myQuery = "UPDATE `specialization` SET
						`specialization` = '$specialization',
						`description` = '$description',
						`status` = '$status'
					WHERE `id` = '$id'";

		$result = $mysqli->query($myQuery);

		$_SESSION['alert'] = "Uzmanlık başarıyla düzenlendi";

		header("Location:uzmanliklar.php");
		exit;
	}



	//Doktor ekleme işlemi bu bölümde yapılacak
	if($action=='adddoctor'){
		echo 'doktor eklenecek<br>';

		$name = p('name'); //$_POST['doctorname'];
		$specialization = $_POST['specialization'];
		$description = $_POST['description'];
		$phone = $_POST['phone'];

		echo $name.' > '.$phone.' > '.$description;

		$result = $mysqli->query("INSERT INTO `doctor` (`name`, `specialization`, `description`, `phone`, `status`)
						VALUES ('$name', '$specialization', '$description', '$phone', '1');");

		if($result){
			//echo 'Tebrikler eklendi';

			$id = $mysqli->insert_id;

			$_SESSION['alert'] = "Doktor <b>" . $name . "</b> başarıyla eklendi";

			header("Location:doktor.php?id=$id");
			exit;
		}else{
			echo 'Bir hata oluştu! '.$mysql->error;
			exit;
		}
	}


	if($action=="editdoctor"){

		echo 'doktor düzenlenecek<hr>';

		$id = $_POST['id'];
		$name = $_POST['name'];
		$specialization = $_POST['specialization'];
		$description = $_POST['description'];
		$phone = $_POST['phone'];
		$status = $_POST['status'];

		echo $name.' > '.$phone.' > '.$description;

		$myQuery = "UPDATE `doctor` SET
						`name` = '$name',
						`specialization` = '$specialization',
						`description` = '$description',
						`phone` = '$phone',
						`status` = '$status'
					WHERE `id` = '$id'";

		$result = $mysqli->query($myQuery);

		$_SESSION['alert'] = "Doktor başarıyla düzenlendi";

		header("Location:doktor.php?id=$id");
		exit;
	}



	if($action=="deletedoctor"){

		$id = $_POST['id'];

		$myQuery = "DELETE FROM doctor WHERE `id` = '$id'";

		$mysqli->query($myQuery);

		$_SESSION['alert'] = "Doktor başarıyla silindi";

		header("Location:doktorlar.php");
		exit;
	}


	if($action=="editdoctorprofilephoto"){

		$id = $_POST['id'];

		$target_dir = "../uploads/";
		$base_name = basename($_FILES["fileToUpload"]["name"]);
		$target_file = $target_dir . $base_name;
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));



		if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			echo "Profil fotoğrafı güncellenemedi!"; exit;
		}

		$myQuery = "UPDATE `doctor` SET `profilephoto` = '$base_name' WHERE `id` = '$id'";
		$result = $mysqli->query($myQuery);

		header("Location:doktor.php?id=$id");
		exit;
	}



?>