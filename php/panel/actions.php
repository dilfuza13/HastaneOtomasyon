<?PHP

	//ayarları yaptığımız config dosyasını çağırıyoruz
	//require_once "1 kere çağır" demek, birden fazla çağırırsak ilk olanı işleme alacak
	require_once("inc_config.php");


	$action = $_POST['action'];

	echo $action."<hr>";

	$name = "Dilfuza";



	//Doktor ekleme işlemi bu bölümde yapılacak
	if($action=='adddoctor'){
		echo 'doktor eklenecek<br>';

		$doctorname = p('doctorname'); //$_POST['doctorname'];
		$doctormail = g('doctormail'); //$_POST['doctormail'];
		$password = $_POST['password'];
		$phone = $_POST['phone'];
		$description = $_POST['description'];

		echo $doctorname.' > '.$doctormail.' > '.$password.' > '.$phone.' > '.$description;

		$result = $mysqli->query("INSERT INTO `doctor` (`name`, `mail`, `password`, `phone`, `description`, `status`)
						VALUES ('$doctorname', '$doctormail', '$password', '$phone', '$description', '1');");

		if($result){
			//echo 'Tebrikler eklendi';

			$id = $mysqli->insert_id;

			$_SESSION['alert'] = "Doktor <b>" . $doctorname . "</b> başarıyla eklendi";

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
		$doctorname = $_POST['doctorname'];
		$doctormail = $_POST['doctormail'];
		$password = $_POST['password'];
		$phone = $_POST['phone'];
		$description = $_POST['description'];

		echo $doctorname.' > '.$doctormail.' > '.$password.' > '.$phone.' > '.$description;

		$myQuery = "UPDATE `doctor` SET
						`name` = '$doctorname',
						`mail` = '$doctormail',
						`password` = '$password',
						`phone` = '$phone',
						`description` = '$description'
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


	if($action=="setslot"){

		$slotstatus = $_POST['slotstatus'] ?? false;
		$slottime = $_POST['slottime'];

		echo $slottime.'>'.$slotstatus;

		exit;

	}



?>