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

	<?PHP if(isset($_SESSION['alert'])){?>
	<div class="alert alert-success" role="alert"> <?=$_SESSION['alert'];?> </div>
	<?PHP unset($_SESSION['alert']); } ?>

	<div class="container">

	<h2>HASTALAR</h2>
	<hr>

	<table class="table table-striped  table-hover">
		<thead>
			<tr>
			<th scope="col">#</th>
			<th scope="col">Hasta Adı</th>
			<th scope="col">E-Mail</th>
			<th scope="col">Telefon</th>
			<th scope="col">D. Yılı</th>
			<th scope="col">Adres</th>
			<th scope="col">Yakını</th>
			<th scope="col">Hikayesi</th>
			<th scope="col">Kayıt Tarihi</th>
			</tr>
		</thead>
		<tbody>
<?PHP
$myQuery = "select * from patient";
$result = $mysqli->query($myQuery);
?>

<?PHP while($rs = mysqli_fetch_array($result)){?>
			<tr>
				<th scope="row"><?=$rs['id'];?></th>
				<td><?=$rs['name'];?></td>
				<td><?=$rs['email'];?></td>
				<td><?=$rs['phone'];?></td>
				<td><?=$rs['birthyear'];?></td>
				<td><?=$rs['address'];?></td>
				<td><?=$rs['relative'];?></td>
				<td><?=$rs['history'];?></td>
				<td><?=$rs['createdtime'];?></td>
			</tr>
<?PHP } ?>

		</tbody>
	</table>


<div>
	</body>
</html>