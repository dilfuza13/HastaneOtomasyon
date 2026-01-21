<?PHP
	require_once("../inc_config.php");

	$id = $_GET['id'];


	$myQuery = "SELECT * FROM `doctor` WHERE id='$id'";

	$result = $mysqli->query($myQuery);

	$doctor = mysqli_fetch_assoc($result);
	
	if(!$doctor){
		$_SESSION['alert'] = "Doktor bulunamadı!";
		header("Location:doktorlar.php");
		exit;
	}

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

	<?PHP if(isset($_SESSION['alert'])){?>
	<div class="alert alert-success" role="alert"> <?=$_SESSION['alert'];?> </div>
	<?PHP unset($_SESSION['alert']); } ?>

	<div class="container">

	<h2>Doktor: <?=$doctor['name'];?></h2>
	<hr>

		<form action="actions.php" method="post">
			<div class="row">

				<div class="col col-md-2">
					<label for="name">Doktor adı...</label>
					<input type="text" name="name" id="name" class="form-control" value="<?=$doctor['name'];?>" required>
				</div>

				<div class="col col-md-2">
					<label for="specialization">Uzmanlığı...</label>
					<select name="specialization" required class="form-control">
						<option value="">-SEÇİNİZ-</option>
						<?PHP $subSql = $mysqli->query("select * from specialization order by specialization asc"); while($ss=mysqli_fetch_array($subSql)){ ?>
						<option value="<?=$ss['id'];?>" <?=($ss['id']==$doctor['specialization'])?"selected":"";?>><?=$ss['specialization'];?></option>
						<?PHP } ?>
					</select>
				</div>

				<div class="col col-md-">
					<label for="description">Doktor hakkında...</label>
					<input type="text" name="description" id="description" class="form-control" value="<?=$doctor['description'];?>" required>
				</div>

				<div class="col col-md-">
					<label for="phone">Telefon...</label>
					<input type="text" name="phone" id="phone" class="form-control" value="<?=$doctor['phone'];?>" required>
				</div>

				<div class="col col-md-">
					<label for="status">Durum...</label>
					<select name="status" required class="form-control">
						<option value="0">PASİF</option>
						<option value="1" <?=$doctor['status']?"selected":"";?>>AKTİF</option>
					</select>
				</div>
				
				<div class="col col-md-2">
					<label for="status">Düzenle...</label>
					<button type="submit" class="btn btn-success">KAYDET</button>
				</div>
				<input type="hidden" name="action" value="editdoctor">
				<input type="hidden" name="id" value="<?=$doctor['id'];?>">

			</div>
			</form>

	<hr>


	<div class="card" style="width: 18rem;">
		<img src="../uploads/<?=$doctor['profilephoto'] ?? "placeholder.png";?>" class="card-img-top" width="400">
		<div class="card-body">
			<h5 class="card-title">Profil Fotoğrafı</h5>
			<form action="actions.php" method="post" enctype="multipart/form-data">
				
				<input type="file" name="fileToUpload" id="fileToUpload">
				<button class="btn btn-primary">YÜKLE</button>
				
				<input type="hidden" name="action" value="editdoctorprofilephoto">
				<input type="hidden" name="id" value="<?=$doctor['id'];?>">

			</form>
		</div>
	</div>


	<hr>


<div>
	</body>
</html>