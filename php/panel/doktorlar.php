<?PHP
	require_once("inc_config.php");

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

	<h2>DOKTORLAR</h2>
	<hr>

		<form action="actions.php" method="post">
			<div class="row">

				<div class="col col-md-2">
					<input type="text" name="name" id="name" placeholder="Doktor ismi..." class="form-control">
				</div>
				<div class="col col-md-2">
					<select name="specialization" required class="form-control">
						<option value="">-SEÇİNİZ-</option>
						<?PHP $subSql = $mysqli->query("select * from specialization order by specialization asc"); while($ss=mysqli_fetch_array($subSql)){ ?>
						<option value="<?=$ss['id'];?>"><?=$ss['specialization'];?></option>
						<?PHP } ?>
					</select>
				</div>
				<div class="col col-md-4">
					<input type="text" name="description" id="description" require placeholder="Doktor hakkında..." class="form-control" required>
				</div>
				<div class="col col-md-2">
					<input type="phone" name="phone" id="phone" require placeholder="Doktor telefon..." class="form-control" required>
				</div>
				<div class="col col-md-2">
					<button type="submit" class="btn btn-success">EKLE</button>
				</div>
				<input type="hidden" name="action" value="adddoctor">

			</div>
			</form>

	<hr>

	<table class="table table-striped  table-hover">
		<thead>
			<tr>
			<th scope="col">#</th>
			<th scope="col">Doktor Adı</th>
			<th scope="col">Uzmanlığı</th>			
			<th scope="col">Hakkında</th>
			<th scope="col">Teleefon</th>
			<th scope="col">Durum</th>
			<th scope="col">Date</th>
			</tr>
		</thead>
		<tbody>
<?PHP
$myQuery = "select d.*, s.specialization from doctor as d inner join specialization as s on s.id=d.specialization";
$result = $mysqli->query($myQuery);
?>

<?PHP while($rs = mysqli_fetch_array($result)){?>
			<tr>
				<th scope="row"><?=$rs['id'];?></th>
				<td><a href="doktor.php?id=<?=$rs['id'];?>"><?PHP echo $rs['name'];?></a></td>
				<td><?=$rs['specialization'];?></td>
				<td><?=$rs['description'];?></td>
				<td><?=$rs['phone'];?></td>
				<td><?=$rs['status']?"AKTİF":"PASİF";?></td>
				<td><?=$rs['createdtime'];?></td>
			</tr>
<?PHP } ?>

		</tbody>
	</table>


<div>
	</body>
</html>