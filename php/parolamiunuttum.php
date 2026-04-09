<?PHP include('inc_config.php');?>
<!doctype html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <title>Nova Care</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 5.3 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/style.css" rel="stylesheet">


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
    <div class="col-lg-6">
      <div class="appointment-form">
        <form action="parolasifirla.php" method="post">
        <h5 class="mb-3">Parolamı Unuttum</h5>

        <div class="form-floating mb-3">
          <input type="text" name="email" class="form-control" placeholder="E-Posta" required>
          <label>E-Posta</label>
        </div>

        <button type="submit" class="btn btn-primary w-100">Parolamı Sıfırla</button>

        </form>
      </div>
    </div>

    

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>