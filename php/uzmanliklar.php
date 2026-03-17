<?PHP include('inc_config.php');?>
<!doctype html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <title>Hakkımızda - Nova Care</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    /* GENEL */
    body {
      padding-top: 110px;
      background-color: #f8f9fa;
      font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
    }

    /* NAVBAR */
    .navbar { padding: 22px 0; }
    .navbar-brand {
      color: #0d6efd !important;
      font-size: 1.9rem;
      font-weight: 700;
      letter-spacing: 1px;
    }

    /* HERO (MAVİ BOX) - KORUNUYOR */
    .hero {
      background: linear-gradient(90deg, #0d6efd, #4dabf7);
      color: white;
      padding: 80px 0;
      border-radius: 18px;
      margin-bottom: 60px;
    }

    /* HAKKIMIZDA KARTLARI */
    .about-card {
      background: white;
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0,0,0,.05);
      height: 100%;
      border: none;
      transition: transform 0.3s;
    }
    .about-card:hover {
      transform: translateY(-5px);
    }
    .icon-circle {
      width: 60px;
      height: 60px;
      background: #0d6efd;
      color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 20px;
      font-size: 1.5rem;
      font-weight: bold;
    }
  </style>
</head>

<body>

<?PHP include('inc_header.php');?>

<div class="container">
  <div class="hero text-center">
    <h1 class="fw-bold display-5 text-uppercase">BİZ KİMİZ?</h1>
    <p class="lead mt-3">2026'dan beri sağlıkta güvenin ve teknolojinin adresiyiz.</p>
  </div>
</div>

<div class="container mb-5">
  <div class="row g-4">
    
    <div class="col-md-6">
      <div class="card about-card">
        <div class="icon-circle">M</div>
        <h2 class="fw-bold text-primary">Misyonumuz</h2>
        <p class="text-muted leading-relaxed">
          Nova Care olarak temel amacımız, her hastanın en yüksek kalitede sağlık hizmetine adil ve hızlı bir şekilde ulaşmasını sağlamaktır. Geliştirdiğimiz modern otomasyon sistemleri ile bürokrasiyi azaltıyor, doktorlarımızın hastalarına ayırdığı vaktin verimini artırıyoruz. Sadece tedavi etmiyor, sağlığınızı dijital dünyanın hızıyla koruma altına alıyoruz.
        </p>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card about-card">
        <div class="icon-circle">V</div>
        <h2 class="fw-bold text-primary">Vizyonumuz</h2>
        <p class="text-muted leading-relaxed">
          Sağlık teknolojilerinde Türkiye’nin öncü hastanesi olmak ve global standartlarda dijital bir ekosistem kurmaktır. Gelecekte, yapay zeka destekli randevu sistemlerimiz ve uzman kadromuzla, hastaneye gelmeden başlayan bir iyileşme sürecinin mimarı olmayı hedefliyoruz. Nova Care ismini, yenilikçilik ve şifa ile eş anlamlı kılmak en büyük vizyonumuzdur.
        </div>
    </div>

    <div class="col-12 mt-4">
      <div class="card about-card text-center">
        <h2 class="fw-bold text-primary mb-4">Temel Değerlerimiz</h2>
        <div class="row">
          <div class="col-md-3">
            <h5 class="fw-bold">Şeffaflık</h5>
            <p class="small text-muted">Tüm süreçlerimizde hastalarımıza karşı açık ve dürüstüz.</p>
          </div>
          <div class="col-md-3">
            <h5 class="fw-bold">Yenilikçilik</h5>
            <p class="small text-muted">En güncel tıbbi teknolojileri sistemimize entegre ediyoruz.</p>
          </div>
          <div class="col-md-3">
            <h5 class="fw-bold">Güven</h5>
            <p class="small text-muted">Verileriniz ve sağlığınız bizimle en güvenli ellerde.</p>
          </div>
          <div class="col-md-3">
            <h5 class="fw-bold">Erişilebilirlik</h5>
            <p class="small text-muted">Her an, her yerden randevu imkanıyla yanınızdayız.</p>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>