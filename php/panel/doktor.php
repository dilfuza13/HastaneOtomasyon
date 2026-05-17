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

	<div class="container my-5">

	<div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
		<h2 class="m-0 fw-bold text-dark">Doktor Profil: <span class="text-primary"><?=$doctor['name'];?></span></h2>
		<a href="doktorlar.php" class="btn btn-outline-secondary btn-sm">Geri Dön</a>
	</div>

	<div class="row g-4">
		<div class="col-lg-8">
			<!-- Düzenleme Formu -->
			<div class="card border-0 shadow-sm rounded-4 h-100">
				<div class="card-body p-4 p-md-5">
					<h5 class="card-title fw-bold text-secondary mb-4">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square me-2 mb-1" viewBox="0 0 16 16">
						  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
						  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
						</svg>
						Bilgileri Düzenle
					</h5>
					
					<form action="actions.php" method="post">
						<div class="row g-4">
							<div class="col-md-6">
								<div class="form-floating">
									<input type="text" name="name" id="name" class="form-control bg-light border-0" value="<?=$doctor['name'];?>" placeholder="Doktor Adı" required>
									<label for="name" class="text-muted">Doktor Adı</label>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-floating">
									<select name="specialization" id="specialization" required class="form-select bg-light border-0">
										<option value="">- SEÇİNİZ -</option>
										<?PHP $subSql = $mysqli->query("select * from specialization order by specialization asc"); while($ss=mysqli_fetch_array($subSql)){ ?>
										<option value="<?=$ss['id'];?>" <?=($ss['id']==$doctor['specialization'])?"selected":"";?>><?=$ss['specialization'];?></option>
										<?PHP } ?>
									</select>
									<label for="specialization" class="text-muted">Uzmanlığı</label>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-floating">
									<input type="text" name="phone" id="phone" class="form-control bg-light border-0" value="<?=$doctor['phone'];?>" placeholder="Telefon" required>
									<label for="phone" class="text-muted">Telefon</label>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-floating">
									<select name="status" id="status" required class="form-select bg-light border-0">
										<option value="0">PASİF</option>
										<option value="1" <?=$doctor['status']?"selected":"";?>>AKTİF</option>
									</select>
									<label for="status" class="text-muted">Durum</label>
								</div>
							</div>

							<div class="col-12">
								<div class="form-floating">
									<textarea name="description" id="description" class="form-control bg-light border-0" placeholder="Doktor hakkında" style="height: 100px" required><?=$doctor['description'];?></textarea>
									<label for="description" class="text-muted">Doktor Hakkında</label>
								</div>
							</div>

							<div class="col-12 mt-5 text-end">
								<input type="hidden" name="action" value="editdoctor">
								<input type="hidden" name="id" value="<?=$doctor['id'];?>">
								<button type="submit" class="btn btn-primary btn-lg px-5 py-3 fw-bold rounded-pill shadow custom-save-btn d-inline-flex align-items-center gap-2">
									<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
									  <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
									  <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
									</svg>
									DEĞİŞİKLİKLERİ KAYDET
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="col-lg-4">
			<!-- Profil Fotoğrafı -->
			<div class="card border-0 shadow-sm rounded-4 text-center h-100 overflow-hidden">
				<div class="bg-light p-4">
					<img src="../uploads/<?=$doctor['profilephoto'] ?? "placeholder.png";?>" class="img-fluid rounded-circle shadow-sm border border-3 border-white mb-3" style="width: 180px; height: 180px; object-fit: cover;" alt="Profil Fotoğrafı">
					<h4 class="fw-bold mb-0 text-dark"><?=$doctor['name'];?></h4>
					<p class="text-primary small fw-semibold mt-1 mb-0">
						<?PHP 
							$spec_id = $doctor['specialization'];
							if($spec_id) {
								$spec_q = $mysqli->query("select specialization from specialization where id='$spec_id'");
								if($spec_q && $spec_res = mysqli_fetch_assoc($spec_q)) {
									echo $spec_res['specialization'];
								}
							}
						?>
					</p>
				</div>
				<div class="card-body p-4">
					<h6 class="card-title fw-bold text-secondary mb-3">Fotoğrafı Güncelle</h6>
					<form action="actions.php" method="post" enctype="multipart/form-data" class="d-flex flex-column align-items-center">
						<div class="mb-3 w-100">
							<input type="file" class="form-control form-control-sm bg-light" name="fileToUpload" id="fileToUpload" required>
						</div>
						<input type="hidden" name="action" value="editdoctorprofilephoto">
						<input type="hidden" name="id" value="<?=$doctor['id'];?>">
						<button type="submit" class="btn btn-outline-primary fw-bold rounded-pill px-4 w-100 d-inline-flex justify-content-center align-items-center gap-2">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-upload" viewBox="0 0 16 16">
							  <path fill-rule="evenodd" d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383"/>
							  <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708z"/>
							</svg>
							YENİ FOTOĞRAF YÜKLE
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<style>
		/* Özel animasyonlar ve gölgeler */
		.form-floating > .form-control:focus, .form-floating > .form-select:focus {
			box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
			border: 1px solid #86b7fe !important;
		}
		.custom-save-btn {
			transition: all 0.3s ease;
			background: linear-gradient(135deg, #0d6efd, #0098f0);
			border: none;
		}
		.custom-save-btn:hover {
			transform: translateY(-2px);
			box-shadow: 0 10px 20px rgba(13, 110, 253, 0.3) !important;
			background: linear-gradient(135deg, #0b5ed7, #0081cc);
		}
		.rounded-4 {
			border-radius: 1rem !important;
		}
		body {
			background-color: #f8f9fa;
		}
	</style>

	</div>
	</body>
</html>