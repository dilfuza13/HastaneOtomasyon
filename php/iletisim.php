<?PHP include('ayarlar.php');?>
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
   HERO (İKİ SAYFADA DA MİLİMETRİK EŞİT KUTU)
===================== */
.hero {
  background: linear-gradient(90deg, #0d6efd, #4dabf7);
  color: white;
  
  /* Yüksekliği tam olarak buraya kilitliyoruz */
  height: 250px; /* Eğer daha büyük istersen burayı 300px veya 350px yapabilirsin */
  
  border-radius: 18px;
  margin-bottom: 40px;
  
  /* Yazıların kutuyu büyütmesini engelleyen, dikeyde ve yatayda ortalayan sihirli kodlar: */
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 0 20px; /* Sadece sağdan soldan güvenli boşluk, yukarı-aşağı YASAK */
  box-sizing: border-box;
}

/* =====================
   RESİMLER (Senin Gönderdiğin Orijinal Kod)
===================== */
.hero-img {
  width: 100%;
  height: 350px;
  object-fit: cover;
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
<?PHP include('navbar.php');?>

<div class="container">
  <div class="hero text-center">
    <h1>Bizimle İletişime Geçin</h1>
    <p class="lead mb-0">İletişim Numaramız: 0532 468 80 09</p>
  </div>
</div>

<div class="container mb-5">
  <div class="row g-4">
    <div class="col-md-6">
      <img src="Hastaneresim/maxresdefault.jpg" alt="Görsel 1" class="img-fluid rounded shadow-sm hero-img">
    </div>
    <div class="col-md-6">
     <img src="Hastaneresim/hemsire-cagri-sistemi-telefon.jpg" alt="Görsel 2" class="img-fluid rounded shadow-sm hero-img">
    </div>
  </div>
</div>


   

      

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
