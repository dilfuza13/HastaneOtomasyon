<?PHP
	require_once("inc_config.php");
	$name = "Dilfuza";

	if(!isset($_SESSION['user']) || !$_SESSION['user']['login']){header("Location:login.php"); exit;}
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

		<div class="container">
			<h2>PERSONEL</h2>

			<hr>
			<form action="actions.php" method="post">
			<div class="row">

				<div class="col col-md-2">
					<input type="text" name="name" placeholder="Personel..." required class="form-control">
				</div>
				<div class="col col-md-2">
					<input type="text" name="username" placeholder="Kullanıcı adı..." required class="form-control">
				</div>
				<div class="col col-md-2">
					<input type="password" name="password" placeholder="Parola..." required class="form-control">
				</div>
				<div class="col col-md-2">
					<input type="password" name="validate" placeholder="Parola tekrar..." required class="form-control">
				</div>
				<div class="col col-md-2">
					<button type="submit" class="btn btn-success">EKLE</button>
				</div>
				<input type="hidden" name="action" value="adduser">

			</div>
			</form>

			<hr>

			
			<table class="table table-striped  table-hover">
				<thead>
					<tr>
					<th scope="col">#</th>
					<th scope="col">Personel</th>
					<th scope="col">Kullancı Adı</th>
					<th scope="col">Durum</th>
					<th></th>
					<th scope="col">Date</th>
					</tr>
				</thead>
				<tbody>
		<?PHP
		$myQuery = "select * from user";
		$result = $mysqli->query($myQuery);
		?>

		<?PHP while($rs = mysqli_fetch_array($result)){?>

				<form action="actions.php" method="post">
					<tr>
						<th scope="row"><?=$rs['id'];?></th>
						<td><input type="text" name="name" placeholder="Personel..." maxlength="50" required value="<?=$rs['name'];?>" class="form-control"></td>
						<td><input type="text" name="username" placeholder="Kullanıcı adı..." maxlength="50" required value="<?=$rs['username'];?>" class="form-control"></td>
						<td><select name="status" required class="form-control"><option value="0">PASİF</option><option value="1" <?=($rs['status'])?"selected":"";?>>AKTİF</option></select></td>
						<td><button type="submit" class="btn btn-success">KAYDET</button></td>
						<td><?=$rs['createdtime'];?></td>
					</tr>
					<input type="hidden" name="action" value="edituser">
					<input type="hidden" name="id" value="<?=$rs['id'];?>">
				</form>
		<?PHP } ?>

				</tbody>
			</table>


		</div>
	</body>
</html>