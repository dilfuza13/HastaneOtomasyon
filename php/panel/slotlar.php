<?PHP
	require_once("inc_config.php");
	$doctor = $_GET['doctor'] ?? null;

	if(isset($_GET['doctor'])){
		$dr = mysqli_fetch_assoc($mysqli->query("select * from doctor where id='$doctor'"));

		if(!$dr){
			$_SESSION['alert'] = "Doktor bulunamadı!";
			header("Location:slotlar.php");
			exit;
		}

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

<?PHP
$myQuery = "select d.*, s.specialization from doctor as d inner join specialization as s on s.id=d.specialization";
$result = $mysqli->query($myQuery);
?>
<form action="slotlar.php" method="get">
<select name="doctor" required>
	<option value="">-DOKTOR SEÇİNİZ-</option>
	<?PHP while($rs = mysqli_fetch_array($result)){?>
	<option value="<?=$rs['id'];?>" <?=($rs['id']==$doctor)?"selected":"";?>><?=$rs['name'];?> - <?=$rs['specialization'];?></option>
	<?PHP } ?>
</select>
<button type="submit">LİSTELE</button>
</form>
		
	<hr>
	
<?PHP if($doctor){?>

<?PHP
	$slotlar = [];
	$querySlotlar = $mysqli->query("select * from timeslot where doctor='$doctor'");
	while($ss=mysqli_fetch_array($querySlotlar)){
		$slotlar[$ss['timeslot']]=$ss['status'];
	}

	//print_r($slotlar); //tüm diziyi yazdırır

?>



	<h2>SLOTLAR - <?=$dr['name'];?></h2>
	<hr>



	<table class="table table-sm table-striped  table-hover">
	<?PHP
		//$tarih = new DateTime();

		$tarih = new DateTime( date("Y-m-d",time()));

	// $tarih = mktime(0,0,0,$now->mont)



		//echo "Önümüzdeki 20 Gün:\n".$tarih;

		for ($i = 0; $i <= 10; $i++) {
			// Her döngüde tarihe 1 gün ekle
			$tarih->modify('+1 day');
			
			// İstediğin formatta ekrana yazdır (Gün.Ay.Yıl)
			$date1 = $tarih->format('Y-m-d');
			$date2 = $tarih->format('d.m.Y');


			$slot09 = isset($slotlar[$date1." 09:00:00"])?($slotlar[$date1." 09:00:00"]==2?"checked disabled":($slotlar[$date1." 09:00:00"]==1?"checked":"")):"";
			$slot10 = isset($slotlar[$date1." 10:00:00"])?($slotlar[$date1." 10:00:00"]==2?"checked disabled":($slotlar[$date1." 10:00:00"]==1?"checked":"")):"";
			$slot11 = isset($slotlar[$date1." 11:00:00"])?($slotlar[$date1." 11:00:00"]==2?"checked disabled":($slotlar[$date1." 11:00:00"]==1?"checked":"")):"";
			$slot12 = isset($slotlar[$date1." 12:00:00"])?($slotlar[$date1." 12:00:00"]==2?"checked disabled":($slotlar[$date1." 12:00:00"]==1?"checked":"")):"";
			$slot13 = isset($slotlar[$date1." 13:00:00"])?($slotlar[$date1." 13:00:00"]==2?"checked disabled":($slotlar[$date1." 13:00:00"]==1?"checked":"")):"";
			$slot14 = isset($slotlar[$date1." 14:00:00"])?($slotlar[$date1." 14:00:00"]==2?"checked disabled":($slotlar[$date1." 14:00:00"]==1?"checked":"")):"";
			$slot15 = isset($slotlar[$date1." 15:00:00"])?($slotlar[$date1." 15:00:00"]==2?"checked disabled":($slotlar[$date1." 15:00:00"]==1?"checked":"")):"";
			$slot16 = isset($slotlar[$date1." 16:00:00"])?($slotlar[$date1." 16:00:00"]==2?"checked disabled":($slotlar[$date1." 16:00:00"]==1?"checked":"")):"";
			$slot17 = isset($slotlar[$date1." 17:00:00"])?($slotlar[$date1." 17:00:00"]==2?"checked disabled":($slotlar[$date1." 17:00:00"]==1?"checked":"")):"";

			//$slot13 = isset($slotlar[$date1." 13:00:00"])?($slotlar[$date1." 13:00:00"]==0?"disabled":($slotlar[$date1." 13:00:00"]==1?"checked":"checked disabled")):"";


			// hasta için $slot12 = isset($slotlar[$date1." 12:00:00"])?($slotlar[$date1." 12:00:00"]==0?"disabled":($slotlar[$date1." 12:00:00"]==1?"checked":"checked disabled")):"disabled";
	?>
	<tr>

		<td><?=$date2;?></td>
		<td>
			<form action="actions.php" method="post">
				<div class="form-check form-switch">
					<input class="form-check-input" type="checkbox" name="slotstatus" role="switch" id="switchCheckChecked" value="1" onchange="this.form.submit();" <?=$slot09;?>>
					<label class="form-check-label" for="switchCheckChecked">09:00</label>
				</div>
				<input type="hidden" name="action" value="setslot">
				<input type="hidden" name="doctor" value="<?=$doctor;?>">
				<input type="hidden" name="timeslot" value="<?=$date1;?> 09:00:00">
			</form>
		</td>
		<td>
			<form action="actions.php" method="post">
				<div class="form-check form-switch">
					<input class="form-check-input" type="checkbox" name="slotstatus" role="switch" id="switchCheckChecked" value="1" onchange="this.form.submit();" <?=$slot10;?>>
					<label class="form-check-label" for="switchCheckChecked">10:00</label>
				</div>
				<input type="hidden" name="action" value="setslot">
				<input type="hidden" name="doctor" value="<?=$doctor;?>">
				<input type="hidden" name="timeslot" value="<?=$date1;?> 10:00:00">
			</form>
		</td>
		<td>
			<form action="actions.php" method="post">
				<div class="form-check form-switch">
					<input class="form-check-input" type="checkbox" name="slotstatus" role="switch" id="switchCheckChecked" value="1" onchange="this.form.submit();" <?=$slot11;?>>
					<label class="form-check-label" for="switchCheckChecked">11:00</label>
				</div>
				<input type="hidden" name="action" value="setslot">
				<input type="hidden" name="doctor" value="<?=$doctor;?>">
				<input type="hidden" name="timeslot" value="<?=$date1;?> 11:00:00">
			</form>
		</td>
		<td>
			<form action="actions.php" method="post">
				<div class="form-check form-switch">
					<input class="form-check-input" type="checkbox" name="slotstatus" role="switch" id="switchCheckChecked" value="1" onchange="this.form.submit();" <?=$slot12;?>>
					<label class="form-check-label" for="switchCheckChecked">12:00</label>
				</div>
				<input type="hidden" name="action" value="setslot">
				<input type="hidden" name="doctor" value="<?=$doctor;?>">
				<input type="hidden" name="timeslot" value="<?=$date1;?> 12:00:00">
			</form>
		</td>
		<td>
			<form action="actions.php" method="post">
			<div class="form-check form-switch">
				<input class="form-check-input" type="checkbox" name="slotstatus" role="switch" id="switchCheckChecked" value="1" onchange="this.form.submit();" <?=$slot14;?> >
				<label class="form-check-label" for="switchCheckChecked">14:00</label>
			</div>
			<input type="hidden" name="action" value="setslot">
			<input type="hidden" name="doctor" value="<?=$doctor;?>">
			<input type="hidden" name="timeslot" value="<?=$date1;?> 14:00:00">
			</form>
		</td>
		<td>
			<form action="actions.php" method="post">
			<div class="form-check form-switch">
				<input class="form-check-input" type="checkbox" name="slotstatus" role="switch" id="switchCheckChecked" value="1" onchange="this.form.submit();" <?=$slot15;?> >
				<label class="form-check-label" for="switchCheckChecked">15:00</label>
			</div>
			<input type="hidden" name="action" value="setslot">
			<input type="hidden" name="doctor" value="<?=$doctor;?>">
			<input type="hidden" name="timeslot" value="<?=$date1;?> 15:00:00">
			</form>
		</td>
		<td>
			<form action="actions.php" method="post">
			<div class="form-check form-switch">
				<input class="form-check-input" type="checkbox" name="slotstatus" role="switch" id="switchCheckChecked" value="1" onchange="this.form.submit();" <?=$slot16;?> >
				<label class="form-check-label" for="switchCheckChecked">16:00</label>
			</div>
			<input type="hidden" name="action" value="setslot">
			<input type="hidden" name="doctor" value="<?=$doctor;?>">
			<input type="hidden" name="timeslot" value="<?=$date1;?> 16:00:00">
			</form>
		</td>
		<td>
			<form action="actions.php" method="post">
			<div class="form-check form-switch">
				<input class="form-check-input" type="checkbox" name="slotstatus" role="switch" id="switchCheckChecked" value="1" onchange="this.form.submit();" <?=$slot17;?> >
				<label class="form-check-label" for="switchCheckChecked">17:00</label>
			</div>
			<input type="hidden" name="action" value="setslot">
			<input type="hidden" name="doctor" value="<?=$doctor;?>">
			<input type="hidden" name="timeslot" value="<?=$date1;?> 17:00:00">
			</form>
		</td>
	</tr>




	<?PHP } ?>

	</table>

<?PHP } ?>

<div>
	</body>
</html>


