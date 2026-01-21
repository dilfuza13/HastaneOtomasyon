<?PHP include('inc_config.php');?>
<!doctype html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <title>Nova Care</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 5.3 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    /* =====================
       GENEL
    ===================== */
    body {
      padding-top: 110px;
      background-color: #f8f9fa;
      font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
    }

    /* =====================
       NAVBAR
    ===================== */
    .navbar {
      padding: 22px 0;
    }

    .navbar-brand {
      color: #0d6efd !important;
      font-size: 1.9rem;
      font-weight: 700;
      letter-spacing: 1px;
    }

    .nav-link {
      font-weight: 500;
      position: relative;
    }

    .nav-link:hover {
      color: #0d6efd !important;
    }

    .nav-link::after {
      content: "";
      position: absolute;
      left: 0;
      bottom: -6px;
      width: 0;
      height: 2px;
      background: #0d6efd;
      transition: .3s;
    }

    .nav-link:hover::after {
      width: 100%;
    }

    /* =====================
       HERO
    ===================== */
    .hero {
      background: linear-gradient(90deg, #0d6efd, #4dabf7);
      color: white;
      padding: 80px 0;
      border-radius: 18px;
      margin-bottom: 60px;
    }

    /* =====================
       DOCTOR CARD
    ===================== */
    .doctor-card img {
      height: 240px;
      object-fit: cover;
    }

    /* =====================
       FORM
    ===================== */
    .appointment-form {
      background: white;
      padding: 28px;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0,0,0,.08);
    }
  </style>


<script>

    function git(url){
        window.document.location.href=url;
    }

</script>

</head>

<body>

<!-- =====================
     NAVBAR (AYNI)
===================== -->
<?PHP include('inc_header.php');?>



<!-- =====================
     DOCTORS + FORM
===================== -->
<div class="container">
  <div class="row g-4">

    
   

    <!-- Form -->
    <div class="col col-md-12">
      <div class="appointment-form">
        <form action="randevual.php" method="post">
        <h5 class="mb-3">YENİ RANDEVU AL</h5>

        <div class="row">
            <div class="col col-md-2 mb-3">
                <label for="specialization">Klinik</label>
                <select name="specialization" required class="form-control" onchange="git('hesabim.php?klinik='+this.options[this.selectedIndex].value);">
                    <option value="">-SEÇİNİZ-</option>
                    <?PHP $subSql = $mysqli->query("select * from specialization order by specialization asc"); while($ss=mysqli_fetch_array($subSql)){ ?>
                    <option value="<?=$ss['id'];?>" <?=($ss['id']==g('klinik'))?"selected":"";?>><?=$ss['specialization'];?></option>
                    <?PHP } ?>
                </select>
            </div>

            <div class="col col-md-2 mb-3">
                <label for="doctor">Doktor</label>
                <select name="doctor" required class="form-control" onchange="git('hesabim.php?klinik=<?=g('klinik');?>&doktor='+this.options[this.selectedIndex].value);">
                    <?PHP if(isset($_GET['klinik'])){?>
                    <option value="">-SEÇİNİZ-</option>
                    <?PHP $subSql = $mysqli->query("select * from doctor order by name asc"); while($ss=mysqli_fetch_array($subSql)){ ?>
                    <option value="<?=$ss['id'];?>" <?=($ss['id']==g('doktor'))?"selected":"";?>><?=$ss['name'];?></option>
                    <?PHP } ?>
                    <?PHP }else{?>
                    <option value="">-ÖNCE KLİNİK SEÇİNİZ-</option>
                    <?PHP } ?>
                </select>
            </div>

            <div class="col col-md-2 mb-3">
                <label for="tarih">Tarih</label>
                <select name="tarih" required class="form-control" onchange="git('hesabim.php?klinik=<?=g('klinik');?>&doktor=<?=g('doktor');?>&tarih='+this.options[this.selectedIndex].value);">
                   
                    <option value="">-SEÇİNİZ-</option>
                    <?PHP $tarih = new DateTime( date("Y-m-d",time())); for ($i = 0; $i <= 10; $i++) { $tarih->modify('+1 day'); $date1 = $tarih->format('Y-m-d'); $date2 = $tarih->format('d.m.Y'); ?>
                    <option value="<?=$date1;?>" <?=($date1==g('tarih'))?"selected":"";?> <?= (date('N', strtotime($date1)) >= 6)?"disabled":"";?>><?=$date2;?></option>
                    <?PHP } ?>
                   
                </select>
            </div>

<?PHP
if(isset($_GET['klinik']) && isset($_GET['doktor']) && isset($_GET['tarih'])){

$secilitarih =  new DateTime(g('tarih') );
$tarih1 = $secilitarih->format('Y-m-d');
$secilitarih->modify('+1 day');
$tarih2 = $secilitarih->format('Y-m-d');

$doktor = g('doktor');

$slotlar = [];

$querySlotlar = $mysqli->query("select * from timeslot where doctor='$doktor' and timeslot between '$tarih1' and '$tarih2' and status=1 ");
while($ss=mysqli_fetch_array($querySlotlar)){
    $slotlar[$ss['timeslot']]=$ss['status'];
}

//print_r($slotlar);

//echo '#<hr>#';


    $slot09 = isset($slotlar[$tarih1." 09:00:00"])?"":"disabled";
    $slot10 = isset($slotlar[$tarih1." 10:00:00"])?"":"disabled";
    $slot11 = isset($slotlar[$tarih1." 11:00:00"])?"":"disabled";
    $slot12 = isset($slotlar[$tarih1." 12:00:00"])?"":"disabled";
    $slot13 = isset($slotlar[$tarih1." 13:00:00"])?"":"disabled";
    $slot14 = isset($slotlar[$tarih1." 14:00:00"])?"":"disabled";
    $slot15 = isset($slotlar[$tarih1." 15:00:00"])?"":"disabled";
    $slot16 = isset($slotlar[$tarih1." 16:00:00"])?"":"disabled";
    $slot17 = isset($slotlar[$tarih1." 17:00:00"])?"":"disabled";

?>

            <div>

                <input type="radio" class="btn-check" name="timeslot" id="option1" value="09:00" <?=$slot09;?> required>
                <label class="btn btn-primary" for="option1">09:00</label>

                <input type="radio" class="btn-check" name="timeslot" id="option2" value="10:00" <?=$slot10;?> required>
                <label class="btn btn-primary" for="option2">10:00</label>

                <input type="radio" class="btn-check" name="timeslot" id="option3" value="11:00" <?=$slot11;?> required>
                <label class="btn btn-primary" for="option3">11:00</label>

                <input type="radio" class="btn-check" name="timeslot" id="option4" value="12:00" <?=$slot12;?> required>
                <label class="btn btn-primary" for="option4">12:00</label>

                <input type="radio" class="btn-check" name="timeslot" id="option5" value="14:00" <?=$slot14;?> required>
                <label class="btn btn-primary" for="option5">14:00</label>

                <input type="radio" class="btn-check" name="timeslot" id="option6" value="15:00" <?=$slot15;?> required>
                <label class="btn btn-primary" for="option6">15:00</label>

                <input type="radio" class="btn-check" name="timeslot" id="option7" value="16:00" <?=$slot16;?> required>
                <label class="btn btn-primary" for="option7">16:00</label>

                <input type="radio" class="btn-check" name="timeslot" id="option8" value="17:00" <?=$slot17;?> required>
                <label class="btn btn-primary" for="option8">17:00</label>
            </div>
            <hr>

        <button type="submit" class="btn btn-success">RANDEVU AL</button>

<?PHP } ?>

            
        
        </div>
        </form>
      </div>
    </div>


    <div class="col col-md-12">
        <div class="appointment-form">

        <h5 class="mb-3">GELECEK RANDEVULARIM</h5>

         
	<table class="table table-striped  table-hover">
		<thead>
			<tr>
			<th scope="col">#</th>
			<th scope="col">Randevu Tarihi</th>
            <th scope="col">Klinik</th>
            <th scope="col">Doktor</th>
			<th scope="col">Durum</th>
            <th scope="col">Oluşturma Tarihi</th>
			</tr>
		</thead>
		<tbody>
<?PHP
$patientid = $_SESSION['patient']['id'];
$myQuery = "select a.*, d.name, s.specialization from appointment as a inner join doctor as d on d.id=a.doctor inner join specialization as s on s.id=d.specialization where a.patient='$patientid' and timeslot>= CURRENT_TIMESTAMP() ";
$result = $mysqli->query($myQuery);
?>

<?PHP while($rs = mysqli_fetch_array($result)){?>
			<tr>
				<th scope="row"><?=$rs['id'];?></th>
                <td><?=$rs['timeslot'];?></td>
				<td><?=$rs['doctor'];?></td>
                <td><?=$rs['name'];?></td>
				<td><?=$rs['status']?"AKTİF":"PASİF";?></td>
				<td><?=$rs['createdtime'];?></td>
			</tr>
<?PHP } ?>

		</tbody>
	</table>


      </div>
    </div>


    <div class="col col-md-12">
        <div class="appointment-form">
          
        <h5 class="mb-3">GEÇMİŞ RANDEVULARIM</h5>


	<table class="table table-striped  table-hover">
		<thead>
			<tr>
			<th scope="col">#</th>
			<th scope="col">Randevu Tarihi</th>
            <th scope="col">Klinik</th>
            <th scope="col">Doktor</th>
			<th scope="col">Durum</th>
            <th scope="col">Oluşturma Tarihi</th>
			</tr>
		</thead>
		<tbody>
<?PHP
$patientid = $_SESSION['patient']['id'];
$myQuery = "select a.*, d.name, s.specialization from appointment as a inner join doctor as d on d.id=a.doctor inner join specialization as s on s.id=d.specialization where a.patient='$patientid' and timeslot<= CURRENT_TIMESTAMP()  ";
$result = $mysqli->query($myQuery);
?>

<?PHP while($rs = mysqli_fetch_array($result)){?>
			<tr>
				<th scope="row"><?=$rs['id'];?></th>
                <td><?=$rs['timeslot'];?></td>
				<td><?=$rs['doctor'];?></td>
                <td><?=$rs['name'];?></td>
				<td><?=$rs['status']?"AKTİF":"PASİF";?></td>
				<td><?=$rs['createdtime'];?></td>
			</tr>
<?PHP } ?>

		</tbody>
	</table>


      </div>
    </div>
    

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
