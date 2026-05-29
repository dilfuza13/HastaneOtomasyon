<?PHP
	require_once("../ayarlar.php");


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

	<h2>Tahliller Tetkikler</h2>
	<hr>

	<div class="row g-3">

		<div class="col-md-12">
			

			<h3>Sonuç Bekleyenler</h3>
			<?PHP
				$sql = $mysqli->query("SELECT l.*, p.name  FROM laboratory_tests as l INNER JOIN patient p ON l.patient = p.id where l.status = '0'  ORDER BY id DESC");
				if($sql->num_rows > 0){ ?>

				<table class="table">
					<thead>
						<tr>
							<th>Tarih</th>
                            <th>Hasta Adı</th>
							<th>Tahlil Türü</th>
							<th>Sonuç</th>
							<th>Durum</th>
							<th>İşlem</th>
						</tr>
					</thead>
					<tbody>
						<?PHP
						while($row = mysqli_fetch_assoc($sql)){?>
                        <form action="islemler.php" method="POST">
                            <input type="hidden" name="islem" value="testsonucugir">
                            <input type="hidden" name="id" value="<?=$row['id']?>">
							<tr>
								<td><?=$row['createdtime']?></td>
								<td><a href="hasta.php?id=<?=$row['id']?>" target="_blank"><?=$row['name']?></a></td>
								<td><?=$row['test']?></td>
								<td>
                                    <textarea name="result" id="result" cols="30" rows="10"><?=$row['result']?></textarea>
                                </td>
                                <td>
                                    <select name="status" id="status">
                                        <option value="0">Bekliyor</option>
                                        <option value="1">Tamamlandı</option>
                                    </select>
                                </td>
								<td><input type="submit" value="Kaydet"></td>
							</tr>
                        </form>
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
			

			<h3>Sonuç Çıkanlar</h3>
			<?PHP
				$sql = $mysqli->query("SELECT l.*, p.name  FROM laboratory_tests as l INNER JOIN patient p ON l.patient = p.id where l.status = '1'  ORDER BY id DESC");
				if($sql->num_rows > 0){ ?>

				<table class="table">
					<thead>
						<tr>
							<th>Tarih</th>
                            <th>Hasta Adı</th>
							<th>Tahlil Türü</th>
							<th>Sonuç</th>
							<th>Durum</th>
						</tr>
					</thead>
					<tbody>
						<?PHP
						while($row = mysqli_fetch_assoc($sql)){?>
							<tr>
								<td><?=$row['createdtime']?></td>
								<td><a href="hasta.php?id=<?=$row['id']?>" target="_blank"><?=$row['name']?></a></td>
								<td><?=$row['test']?></td>
								<td><?=$row['result']?></td>
								<td><?=$row['status']? 'Tamamlandı':'Bekliyor'?></td>
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