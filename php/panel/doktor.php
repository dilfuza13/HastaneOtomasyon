<?PHP
	require_once("config.php");


 $id = $_GET['id'];


 $myQuery = "SELECT * FROM `doctor` WHERE id='$id'";

 $result = $mysqli->query($myQuery);

 $doctor = mysqli_fetch_assoc($result);

 

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

    <hr>

<style>
    body{padding-top:30px;}

.glyphicon {  margin-bottom: 10px;margin-right: 10px;}

small {
display: block;
line-height: 1.428571429;
color: #999;
}
</style>



    <div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="well well-sm">
                <div class="row">
 
                    <div class="col-sm-6 col-md-8">
                        <h4><?=$doctor['name'];?></h4>
                        <small><cite title="San Francisco, USA"><?=$doctor['description'];?> <i class="glyphicon glyphicon-map-marker">
                        </i></cite></small>
                        <p>
                            <i class="glyphicon glyphicon-envelope"></i><?=$doctor['mail'];?>
                            <br />
                            <i class="glyphicon glyphicon-globe"></i><a href="tel:<?=$doctor['phone'];?>"><?=$doctor['phone'];?></a>
                            <br />
                            <i class="glyphicon glyphicon-gift"></i>June 02, 1988</p>
                        <!-- Split button -->

                        <form action="actions.php" method="post" onsubmit="return confirm('Doktor <?=$doctor['name'];?> kaydını silmek istediğinize emin misiniz?');">
                         <div class="btn-group">
                            <button type="submit" class="btn btn-danger">SİL</button>                           
                        </div>
                        <input type="hidden" name="action" value="deletedoctor">
                        <input type="hidden" name="id" value="<?= $doctor['id'];?>">
                        </form>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<hr>



<form action="actions.php" method="post">
    <input type="text" name="doctorname" id="doctorname" require placeholder="Doktor ismi..." value="<?=$doctor['name'];?>" ><br>
    <input type="mail" name="doctormail" id="doctormail" require placeholder="Doktor e-posta..." value="<?=$doctor['mail'];?>" ><br>
    <input type="password" name="password" id="password" require placeholder="Doktor parola..." value="<?=$doctor['password'];?>" ><br> <!-- parola hassasiyetini şimdilik görmezden geliyoruz  -->
    <input type="phone" name="phone" id="phone" require placeholder="Doktor telefon..." value="<?=$doctor['phone'];?>" ><br>
    <input type="text" name="description" id="description" require placeholder="Doktor hakkında..." value="<?=$doctor['description'];?>" ><br>
    <button type="submit" class="btn btn-primary">DÜZENLE</button>                    
    <input type="hidden" name="action" value="editdoctor">
    <input type="hidden" name="id" value="<?= $doctor['id'];?>">
</form>




	</body>
</html>