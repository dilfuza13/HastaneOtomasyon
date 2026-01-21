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
     HERO
===================== -->
<div class="container">
  <div class="hero text-center">
    <h1 class="fw-bold">UZMANLIKLAR</h1>
    <p class="lead mt-3">Uzman doktor kadromuz ile yanınızdayız</p>
   
  </div>
</div>

<!-- =====================
     DOCTORS + FORM
===================== -->
<div class="container">
  <div class="row g-4">


   

      

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
