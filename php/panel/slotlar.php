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

	<h2>SLOTLAR</h2>
	<hr>

<table class="table table-sm table-striped  table-hover">
<?PHP
    //$tarih = new DateTime();

    $tarih		= mktime(0, 0, 0, date("m",time()), date("d",time())-1, date("Y",time()));

   // $tarih = mktime(0,0,0,$now->mont)



	//echo "Önümüzdeki 20 Gün:\n".$tarih;

    for ($i = 0; $i <= 20; $i++) {
		// Her döngüde tarihe 1 gün ekle
		$tarih->modify('+1 day');
		
		// İstediğin formatta ekrana yazdır (Gün.Ay.Yıl)
		$date = $tarih->format('d.m.Y');
?>
<tr>

    <td><?=$date;?></td>
    <td>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="switchCheckChecked" checked disabled>
            <label class="form-check-label" for="switchCheckChecked">10:00</label>
        </div>
    </td>
    <td>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="switchCheckChecked" disabled>
            <label class="form-check-label" for="switchCheckChecked">11:00</label>
        </div>
    </td>
    <td>
        <form action="actions.php" method="post">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="slotstatus" role="switch" id="switchCheckChecked" onchange="this.form.submit();">
                <label class="form-check-label" for="switchCheckChecked">12:00</label>
            </div>
            <input type="hidden" name="action" value="setslot">
            <input type="hidden" name="slottime" value="<?=$date;?> 12:00">
        </form>
    </td>
    <td>
        <form action="actions.php" method="post">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="slotstatus" role="switch" id="switchCheckChecked" checked onchange="this.form.submit();">
            <label class="form-check-label" for="switchCheckChecked">13:00</label>
        </div>
         <input type="hidden" name="action" value="setslot">
        <input type="hidden" name="slottime" value="<?=$date;?> 13:00">
        </form>
    </td>
</tr>




<?PHP } ?>

</table>


<div>
	</body>
</html>


