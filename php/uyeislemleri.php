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
