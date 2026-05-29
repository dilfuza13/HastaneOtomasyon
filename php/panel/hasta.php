<?PHP
	require_once("../ayarlar.php");

	if(!isset($_GET['id'])){
		header("Location: hastalar.php");
		exit;
	}
	$patientid = $_GET['id'];
	$patient = mysqli_fetch_assoc($mysqli->query("SELECT * FROM patient WHERE id='$patientid'"));
	if(!$patient){
		header("Location: hastalar.php");
		exit;
	}
?>

<html>
	<head>
		<meta charset="utf-8" />
		<title><?=_SiteAdi;?></title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

	</head>
	<body>
	
	
	<!-- her sayfada aynı olacak olan "header"ı tek bir yerde tanımlayıp include ediyoruz -->
	<?PHP include("navbar.php");?>

	<hr>
		<div class="container">

			<h2><?=$patient['name']?> - Detaylar</h2>
			<hr>
			<div class="col-md-12">

			<form action="islemler.php" method="post">
				<table class="table">

				<tr>
					<td>TCKNO</td>
					<td>Hasta Adı</td>
					<td>E-posta</td>
					<td>Telefon</td>
					<td>Doğum Yılı</td>
					<td>İşlem</td>
				</tr>
				
				
					<tr>
					<td><input type="text" name="tckno" value="<?=$patient['tckno']?>" placeholder="TCKNO"></td>
					<td><input type="text" name="name" value="<?=$patient['name']?>" placeholder="Hasta Adı"></td>
					<td><input type="email" name="email" value="<?=$patient['email']?>" placeholder="E-posta"></td>
					<td><input type="tel" name="phone" value="<?=$patient['phone']?>" placeholder="Telefon"></td>
					<td><input type="number" name="birthyear" value="<?=$patient['birthyear']?>" placeholder="Doğum Yılı"></td>
					<td><input type="submit" value="Güncelle">
						<input type="hidden" name="islem" value="hastaduzenle">
						<input type="hidden" name="id" value="<?=$patientid?>">
					</td>
					</tr>
			
				</table>	</form>
			</div>
		

			<hr>

			<h2>Randevuları</h2>
			<hr>
			<div class="col-md-12">

			<?PHP
				$query = "SELECT a.id, a.doctor, a.status, d.name as doctorname, a.timeslot, s.specialization 
					FROM appointment a
					LEFT JOIN doctor d on d.id = a.doctor
					LEFT JOIN specialization s on s.id = d.specialization
					WHERE a.patient = '$patientid' 
					ORDER BY a.timeslot DESC";

				
				$sql = $mysqli->query($query);
				if($sql->num_rows > 0){ ?>
				<table class="table">
					<thead>
						<tr>
							<th>Tarih Saat</th>	
							<th>Poliklinik</th>
							<th>Doktor</th>
							<th>Durum</th>
							<th>İşlem</th>
							
						</tr>
					</thead>
					<tbody>
					<?PHP
					while($row = mysqli_fetch_assoc($sql)){
						?>
						<tr>
							<td><?=$row['timeslot']?></td>
							<td><?=$row['specialization']?></td>
							<td><?=$row['doctorname']?></td>
							<td><?=$row['status']?"Oluşturuldu":"İptal Edildi"?></td>
							<?PHP if($row['status'] == "0"){
							?>
							<td><form action="islemler.php" method="post"><input type="hidden" name="id" value="<?=$row['id']?>"><input type="hidden" name="islem" value="deleteappointment"><input type="submit" value="İptal Et"></form></td>
							<?PHP }else{?>
								<td>-</td>
							<?PHP }?>
						</tr>
						<?PHP } ?>
					</tbody>
				</table>
				<?PHP }else{ echo "Henüz randevu bulunamadı."; }
			?>
			</div>

			<hr>

			<div class="col-md-12">
				<h2>Yeni Tahlil Talebi</h2>
				<form action="islemler.php" method="post">
					<input type="text" name="test" placeholder="Test adı..." required>
					<input type="submit" value="Kaydet">
					<input type="hidden" name="islem" value="testiste">
					<input type="hidden" name="patient" value="<?=$patientid?>">
				</form>				

				<h3>Tahlil Sonuçları</h3>
				<?PHP
					$sql = $mysqli->query("SELECT * FROM laboratory_tests WHERE patient='$patientid'");
					if($sql->num_rows > 0){ ?>

					<table class="table">
						<thead>
							<tr>
								<th>Test</th>
								<th>Sonuç</th>
								<th>Durum</th>
								<th>İşlem</th>
							</tr>
						</thead>
						<tbody>
							<?PHP
							while($row = mysqli_fetch_assoc($sql)){?>
								<tr>
									<td><?=$row['test']?></td>
									<td><?=$row['result']?></td>
									<td><?=$row['status']?"Tamamlandı":"Bekliyor"?></td>
									<?PHP if($row['status']=="0"){?>
									<td>
										<form action='islemler.php' method='post'>
											<input type='hidden' name='id' value='<?=$row['id']?>'>
											<input type='hidden' name='patient' value='<?=$patientid?>'>
											<input type='hidden' name='action' value='testsil'>
											<input type='submit' value='Sil'>
										</form>
									</td>
									<?PHP }else{?>
										<td>-</td>
									<?PHP }?>
								</tr>
							<?PHP } ?>
						</tbody>
					</table>
						
					<?PHP }else{
						echo "Henüz laboratuvar sonucu bulunamadı.";
					}
				?>
				
			</div>

			<hr>

			<div class="col-md-12">
				<h2>Yeni Dosya Yükle</h2>
				<form action="islemler.php" method="post" enctype="multipart/form-data">
					<input type="text" name="title" placeholder="Dosya Adı" required>
					<input type="file" name="file" required>
					<input type="hidden" name="islem" value="dosyayukle">
					<input type="hidden" name="patient" value="<?=$patientid?>">
					<input type="submit" value="Kaydet">
				</form>

				<hr>

				<h3>Yüklenen Dosyalar</h3>
				<?PHP
					$sql = $mysqli->query("SELECT * FROM uploads WHERE patient='$patientid'");
					if($sql->num_rows > 0){ ?>

					<table class="table">
						<thead>
							<tr>
								<th>Tarih</th>
								<th>Dosyalar</th>
							</tr>
						</thead>
						<tbody>
							<?PHP
							while($row = mysqli_fetch_assoc($sql)){?>
								<tr>
									<td><?=$row['createdtime']?></td>
									<td><a href="../uploads/<?=$row['fileurl']?>" target="_blank"><?=$row['title'];?></a></td>
								</tr>
							<?PHP } ?>
						</tbody>
					</table>
						
					<?PHP }else{
						echo "Henüz laboratuvar sonucu bulunamadı.";
					}
				?>
				
			</div>


		</div>

	</div>

	
	</body>
</html>