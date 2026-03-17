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
<nav class="navbar navbar-expand-lg bg-white shadow-sm fixed-top">
  <div class="container">

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-between" id="mainNavbar">

      <ul class="navbar-nav mx-auto gap-4">
        <li class="nav-item"><a class="nav-link" href="#">Anasayfa</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Uzmanlıklar</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Randovu</a></li>
      </ul>

      <a class="navbar-brand position-absolute start-50 translate-middle-x" href="#">
        Nova Care
      </a>

      <ul class="navbar-nav mx-auto gap-4">
        <li class="nav-item"><a class="nav-link" href="#">Doktorlar</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Haberler</a></li>
        <li class="nav-item"><a class="nav-link" href="#">İletişim</a></li>
      </ul>

    </div>
  </div>
</nav>

<!-- =====================
     HERO
===================== -->
<div class="container">
  <div class="hero text-center">
    <h1 class="fw-bold">Sağlığınız Bizim Önceliğimiz</h1>
    <p class="lead mt-3">Uzman doktor kadromuz ile yanınızdayız</p>
    <button class="btn btn-light btn-lg mt-3">Randevu Al</button>
  </div>
</div>

<!-- =====================
     DOCTORS + FORM
===================== -->
<div class="container">
  <div class="row g-4">

    <!-- Doktorlar -->
    <div class="col-lg-8">
      <div class="row g-4">

        <div class="col-md-6">
          <div class="card doctor-card shadow-sm">
            <img src="Nova Care_files/doktorresimleri/istockphoto-2158610739-1024x1024.jpg" class="card-img-top img-fluid">
            <div class="card-body">
              <h5 class="card-title">Dr. Ahmet Yılmaz</h5>
              <p class="text-muted">Kardiyoloji Uzmanı</p>
              <button class="btn btn-primary btn-sm">Detay</button>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card doctor-card shadow-sm">
            <img src="Nova Care_files/doktorresimleri/istockphoto-1633320190-1024x1024 (1).jpg" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Dr. Ayşe Demir</h5>
              <p class="text-muted">Dahiliye Uzmanı</p>
              <button class="btn btn-primary btn-sm">Detay</button>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- Form -->
    <div class="col-lg-4">
      <div class="appointment-form">
        <h5 class="mb-3">Randevu Oluştur</h5>

        <div class="form-floating mb-3">
          <input class="form-control" placeholder="Ad Soyad">
          <label>Ad Soyad</label>
        </div>

        <div class="form-floating mb-3">
          <input type="tel" class="form-control" placeholder="Telefon">
          <label>Telefon</label>
        </div>

        <div class="form-floating mb-3">
          <select class="form-select">
            <option>Kardiyoloji</option>
            <option>Dahiliye</option>
            <option>Ortopedi</option>
          </select>
          <label>Uzmanlık</label>
        </div>

        <button class="btn btn-primary w-100">Randevu Al</button>
      </div>
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
