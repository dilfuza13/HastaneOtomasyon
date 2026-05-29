<?PHP
	require_once("../ayarlar.php");


if(!isset($_GET['id'])){header("Location: talepler.php"); exit;}

$id = g('id');

$query = $mysqli->query("select * from requests where id='" .$id. "'");
if($query->num_rows == 0){ header("Location: talepler.php"); exit; }
$r = mysqli_fetch_assoc($query);

$patient = mysqli_fetch_assoc($mysqli->query("select * from patient where id='" .$r['patient']. "'"));
$doctor = mysqli_fetch_assoc($mysqli->query("select * from doctor where id='" .$r['doctor']. "'"));
$policlin = mysqli_fetch_assoc($mysqli->query("select * from specialization where id='" .$doctor['specialization']. "'"));

?>

<html>
	<head>
		<meta charset="utf-8" />
		<title><?=_SiteAdi;?></title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

	</head>
	<body>
	
	
	<!-- her sayfada aynı olacak olan "header"ı tek bir yerde tanımlayıp include ediyoruz -->
	<?PHP include("navbar.php");?>

	<hr>
		<div class="container">

	<h2>Hasta Talebi (<?=$r['createdtime']?>)</h2>
	<hr>

	<div class="row g-3">

		<div class="col-md-12">
			
			<table class="table table-striped">
  <thead>
  <tr>
     <th>Tarih</th>
      <th>Gönderen</th>
    <th>Mesaj</th>
    <th>Durum</th>
  </tr>
  </thead>
  <tbody>
  <?PHP
              $messagequery = $mysqli->query("select * from request_answers where request='$id'");
              while ($m = mysqli_fetch_assoc($messagequery)) { ?>
              <tr>
                <td><?PHP echo $m['createdtime'];?></td>
                <td><?PHP echo $m['sender'] == '1' ? 'Hasta' : 'Doktor';?></td>
                <td><?PHP echo $m['message'];?></td>
                <td><?PHP echo $m['status'] == '0' ? 'Yeni' : 'Görüldü';?></td>
              </tr>
              
          <?PHP } ?>
          </tbody>
            </table>
			
		</div>

	</div>


            <hr>
          <div class="row g-3">

            <div class="col-md-6">
                <form action="islemler.php" method="post">
                   
                <label class="form-label small fw-bold text-muted">Cevap yaz</label>
                <textarea name="message" required class="form-select" placeholder="Eklemek istediğiniz bir şey var mı?..."></textarea>
                <button type="submit">KAYDET</button>
                <input type="hidden" name="islem" value="mesajekle"> 
                <input type="hidden" name="request" value="<?=$id;?>">
                </form>
            </div>
             
          </div>

	</div>

  <?PHP 
    // TÜM MESAJLARI OKUNDU OLARKA İŞARETLİYORUZ
    $mysqli->query("UPDATE request_answers SET status='1' WHERE request='$id' and sender='1'"); 
  
  ?>

	
	</body>
</html>