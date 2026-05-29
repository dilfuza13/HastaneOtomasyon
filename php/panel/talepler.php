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

	<h2>Hasta Talepleri</h2>
	<hr>

	<div class="row g-3">

		<div class="col-md-12">
			
			<?PHP
				$sql = $mysqli->query("SELECT r.*, p.name FROM requests as r INNER JOIN patient as p ON r.patient = p.id where r.status = '0' ORDER BY r.id DESC");
				if($sql->num_rows > 0){ ?>

				<table class="table">
					<thead>
						<tr>
							<th>Tarih</th>
                            <th>Hasta Adı</th>
							<th>Konu Başlığı</th>
							<th>Mesaj</th>
						</tr>
					</thead>
					<tbody>
						<?PHP while($row = mysqli_fetch_assoc($sql)){?>

							<?PHP
								$request_id = $row['id'];
								$mesajSayisi = mysqli_num_rows($mysqli->query("SELECT * FROM request_answers WHERE request='$request_id' and sender = '1' and status=0"));	
							?>

							<tr>
								<td><?=$row['createdtime']?></td>
								<td><?=$row['name']?></td>
								<td><a href="talep.php?id=<?=$row['id']?>" target="_blank"><?=$row['story']?></a></td>
								<td><?PHP if($mesajSayisi>0){?>
									<span class="badge bg-danger"><?=$mesajSayisi. " yeni mesaj"?></span>
								<?}else{?>
									<span class="badge bg-success"><?=$mesajSayisi. " hepsi görüldü." ?></span>
								<?}?>								
								</td>
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