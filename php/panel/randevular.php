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

	<h2>RANDEVULAR</h2>
	<hr>

	<?PHP
$myQuery = "select d.*, s.specialization from doctor as d inner join specialization as s on s.id=d.specialization";
$result = $mysqli->query($myQuery);
?>
<form action="randevular.php" method="get">
<select name="doctor">
	<option value="">-TÜMÜNÜ DOKTORLAR-</option>
	<?PHP while($rs = mysqli_fetch_array($result)){?>
	<option value="<?=$rs['id'];?>" <?=($rs['id']==g('doctor'))?"selected":"";?>><?=$rs['name'];?> - <?=$rs['specialization'];?></option>
	<?PHP } ?>
</select>
<button type="submit">LİSTELE</button>
</form>
		
	<hr>


	<table class="table table-striped  table-hover">
		<thead>
			<tr>
			<th scope="col">#</th>
			<th scope="col">Randevu Tarihi</th>
			<th scope="col">Hasta</th>
			<th scope="col">Klinik</th>
			<th scope="col">Doktor</th>
			<th scope="col">Durum</th>
			<th scope="col">Oluşturma Tarihi</th>
			</tr>
		</thead>
		<tbody>
<?PHP
$doctor = g('doctor');
$myQuery = "select a.*, p.name as p_name, s.specialization, d.name as d_name from appointment as a
				inner join patient as p on p.id=a.patient
				inner join doctor as d on d.id=a.doctor
				inner join specialization as s on s.id=d.specialization
			where a.timeslot>= CURRENT_TIMESTAMP() ";
if($doctor!=''){$myQuery .= "and a.doctor='$doctor'";}
$result = $mysqli->query($myQuery);
?>

<?PHP while($rs = mysqli_fetch_array($result)){?>
			<tr>
				<th scope="row"><?=$rs['id'];?></th>
				<td><?=$rs['timeslot'];?></td>
				<td><?=$rs['p_name'];?></td>
				<td><?=$rs['specialization'];?></td>
				<td><?=$rs['d_name'];?></td>
				<td><?=$rs['status']?"AKTİF":"PASİF";?></td>
				<td><?=$rs['createdtime'];?></td>
			</tr>
<?PHP } ?>

		</tbody>
	</table>


<div>
	</body>
</html>