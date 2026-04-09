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
        <form action="girisyap.php" method="post">
        <h5 class="mb-3">Giriş Yap</h5>

        <div class="form-floating mb-3">
          <input type="text" name="email" class="form-control" placeholder="E-Posta" required>
          <label>E-Posta</label>
        </div>

        <div class="form-floating mb-3">
          <input type="password" name="password" class="form-control" placeholder="Parola" required>
          <label>Parola</label>
        </div>

        <button type="submit" class="btn btn-primary w-100">Giriş Yap</button>

        </form>
      </div>
    </div>


    <!-- Doktorlar -->
    <div class="col-lg-6">
        <div class="appointment-form">
          <form action="uyeol.php" method="post">
        <h5 class="mb-3">Hesap Oluştur</h5>

         <div class="form-floating mb-3">
          <input type="text" name="email" class="form-control" placeholder="E-Posta" required>
          <label>E-Posta</label>
        </div>

        <div class="form-floating mb-3">
          <input type="password" name="password" class="form-control" placeholder="Parola" required>
          <label>Parola</label>
        </div>

        <div class="form-floating mb-3">
          <input type="text" name="name" class="form-control" placeholder="Ad Soyad" required>
          <label>Ad Soyad</label>
        </div>

        <div class="form-floating mb-3">
          <input type="tel" name="phone" class="form-control" placeholder="Telefon">
          <label>Telefon</label>
        </div>

        <div class="form-floating mb-3">
          <input type="text" name="address" class="form-control" placeholder="Adress">
          <label>Adress</label>
        </div>

        <div class="form-floating mb-3">
          <input type="number" min="1900" max="2026" step="1" name="birthyear" class="form-control" placeholder="Doğum yılı" required>
          <label>Doğum Yılı</label>
        </div>

        <div class="form-floating mb-3">
          <input type="text" name="relative" class="form-control" placeholder="Hasta Yakını">
          <label>Hasta Yakını</label>
        </div>

        <button class="btn btn-primary w-100">Hesap Oluştur</button>
        </form>
      </div>
    </div>
    

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
