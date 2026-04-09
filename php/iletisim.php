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
     HERO
===================== -->
<div class="container">
  <div class="hero text-center">
    <h1 class="fw-bold">İLETİŞİM</h1>
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
