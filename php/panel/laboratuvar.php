<?PHP
	require_once("../inc_config.php");


?>

<html>
	<head>
		<meta charset="utf-8" />
		<title><?=_SiteName;?></title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

	</head>
	<body>
	
	
	<!-- her sayfada aynı olacak olan "header"ı tek bir yerde tanımlayıp include ediyoruz -->
	<?PHP include("inc_header.php");?>

	<hr>
		<div class="container">

	<h2><?=$patient['name']?> - Detaylar</h2>
	<hr>

	<div class="row g-3">
		<div class="col-md-6">
			
			<form action="actions.php" method="post">
				
				<input type="text" name="tckno" value="<?=$patient['tckno']?>" placeholder="TCKNO">
				<input type="text" name="name" value="<?=$patient['name']?>" placeholder="Hasta Adı">
				<input type="email" name="email" value="<?=$patient['email']?>" placeholder="E-posta">
				<input type="tel" name="phone" value="<?=$patient['phone']?>" placeholder="Telefon">
				<input type="number" name="birthyear" value="<?=$patient['birthyear']?>" placeholder="Doğum Yılı">
				<input type="submit" value="Kaydet">
				<input type="hidden" name="action" value="updatepatient">
				<input type="hidden" name="id" value="<?=$patientid?>">
			</form>

		</div>
		<hr>
		<div class="col-md-6">
			
			<form action="actions.php" method="post">
				<input type="text" name="test" value="" placeholder="Test">
				<input type="submit" value="Kaydet">
				<input type="hidden" name="action" value="addtest">
				<input type="hidden" name="patient" value="<?=$patientid?>">
			</form>

			<hr>

			<h2>Tahlil Sonuçları</h2>
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
								<td><?=$row['status']?></td>
								<td><form action='actions.php' method='post'><input type='hidden' name='id' value='<?=$row['id']?>'><input type='submit' value='Sil'></form></td>
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