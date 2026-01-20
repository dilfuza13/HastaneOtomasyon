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

	<h2>DOKTORLAR</h2>
	<hr>

	<form action="actions.php" method="post">
		<input type="text" name="doctorname" id="doctorname" require placeholder="Doktor ismi..." ><br>
		<input type="mail" name="doctormail" id="doctormail" require placeholder="Doktor e-posta..." ><br>
		<input type="password" name="password" id="password" require placeholder="Doktor parola..." ><br>
		<input type="phone" name="phone" id="phone" require placeholder="Doktor telefon..." ><br>
		<input type="text" name="description" id="description" require placeholder="Doktor hakkında..." ><br>
		<button type="submit">EKLE</button>
		<input type="hidden" name="action" value="adddoctor">
	</form>

	<hr>

	<table class="table table-striped  table-hover">
		<thead>
			<tr>
			<th scope="col">#</th>
			<th scope="col">Doctor Name</th>
			<th scope="col">Mail</th>
			<th scope="col">Phone</th>
			<th scope="col">Description</th>
			<th scope="col">Status</th>
			<th scope="col">Date</th>
			</tr>
		</thead>
		<tbody>
<?PHP
$myQuery = "select id, name, mail, phone, description, status, createdtime from doctor";
$result = $mysqli->query($myQuery);
?>

<?PHP while($rs = mysqli_fetch_array($result)){?>
			<tr>
				<th scope="row"><?=$rs['id'];?></th>
				<td><a href="doktor.php?id=<?=$rs['id'];?>"><?PHP echo $rs['name'];?></a></td>
				<td><?=$rs['mail'];?></td>
				<td><?=$rs['phone'];?></td>
				<td><?=$rs['description'];?></td>
				<td><?=$rs['status'];?></td>
				<td><?=$rs['createdtime'];?></td>
			</tr>
<?PHP } ?>

		</tbody>
	</table>



	</body>
</html>