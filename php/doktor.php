<?PHP include('inc_config.php');?>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Hastane Otomasyon</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

	</head>
	<body>



	<header class="p-3 text-bg-dark">
		<div class="container">
			<div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
				<a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
					<svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
						<use xlink:href="#bootstrap"></use></svg>
				</a>
				<ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
					<li><a href="uzmanliklar.php" class="nav-link px-2 text-white">Uzmanlıklar</a></li>
					<li><a href="doktorlar.php" class="nav-link px-2 text-white">Doktorlar</a></li>
					<li><a href="hastalar.php" class="nav-link px-2 text-white">Hastalar</a></li>
				</ul>
				<form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
					<input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..." aria-label="Search">
				</form>
				<div class="text-end">
					<button type="button" class="btn btn-outline-light me-2">Login</button>
					<button type="button" class="btn btn-warning">Sign-up</button>
				</div>
			</div>
		</div>
	</header>

    <hr>

    
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
                        <h4>Malahat Karimova</h4>
                        <small><cite title="San Francisco, USA">çok iyi kalpli bir kadın <i class="glyphicon glyphicon-map-marker">
                        </i></cite></small>
                        <p>
                            <i class="glyphicon glyphicon-envelope"></i>malahat@karimova.com                            <br />
                            <i class="glyphicon glyphicon-globe"></i><a href="tel:1234567">1234567</a>
                            <br />
                            <i class="glyphicon glyphicon-gift"></i>June 02, 1988</p>
                        <!-- Split button -->

                        <form action="actions.php" method="post" onsubmit="return confirm('Doktor Malahat Karimova kaydını silmek istediğinize emin misiniz?');">
                         <div class="btn-group">
                            <button type="submit" class="btn btn-danger">SİL</button>                           
                        </div>
                        <input type="hidden" name="action" value="deletedoctor">
                        <input type="hidden" name="id" value="2">
                        </form>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<hr>



<form action="actions.php" method="post">
    <input type="text" name="doctorname" id="doctorname" require placeholder="Doktor ismi..." value="Malahat Karimova" ><br>
    <input type="mail" name="doctormail" id="doctormail" require placeholder="Doktor e-posta..." value="malahat@karimova.com" ><br>
    <input type="password" name="password" id="password" require placeholder="Doktor parola..." value="12345" ><br> <!-- parola hassasiyetini şimdilik görmezden geliyoruz  -->
    <input type="phone" name="phone" id="phone" require placeholder="Doktor telefon..." value="1234567" ><br>
    <input type="text" name="description" id="description" require placeholder="Doktor hakkında..." value="çok iyi kalpli bir kadın" ><br>
    <button type="submit" class="btn btn-primary">DÜZENLE</button>                    
    <input type="hidden" name="action" value="editdoctor">
    <input type="hidden" name="id" value="2">
</form>




	</body>
</html>