<?PHP require_once("inc_config.php"); ?>
<!doctype html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <title>Doktorlarımız - Nova Care</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { padding-top: 110px; background-color: #f8f9fa; }
    .hero { background: linear-gradient(90deg, #0d6efd, #4dabf7); color: white; padding: 60px 0; border-radius: 18px; margin-bottom: 40px; }
    .doctor-card { border: none; border-radius: 20px; overflow: hidden; background: #fff; height: 100%; transition: 0.3s; }
    .doctor-card:hover { transform: translateY(-10px); box-shadow: 0 15px 30px rgba(13,110,253,0.1); }
    .doctor-img { height: 320px; overflow: hidden; }
    .doctor-img img { width: 100%; height: 100%; object-fit: cover; }
    .spec-badge { background: rgba(13, 110, 253, 0.1); color: #0d6efd; padding: 5px 15px; border-radius: 50px; font-size: 0.8rem; font-weight: 700; display: inline-block; margin-bottom: 10px; }
  </style>
</head>
<body>

<?PHP if(file_exists('inc_header.php')) { include('inc_header.php'); } ?>

<div class="container">
  <div class="hero text-center">
    <h1 class="fw-bold display-4">Nova Care Doktorlarımız</h1>
    <p class="lead mt-3">Sağlığınız İçin Uzman Kadromuzla Yanınızdayız.</p>
  </div>

  <div class="row g-4 mb-5">
    <?PHP
    $query = "SELECT d.*, s.specialization as uzmanlik
                FROM doctor d 
                LEFT JOIN specialization s ON d.specialization = s.id 
                WHERE d.status = 1
                ORDER BY d.id DESC";
    
    $sorgu = $mysqli->query($query);
    while($row = $sorgu->fetch_assoc()){
        // Resim yolu tamiri:
        $resim_yolu = (!empty($row['image'])) ? "uploads/".$row['image']."?v=".time() : "https://via.placeholder.com/400x500";
    ?>
    <div class="col-lg-4 col-md-6 text-center">
      <div class="card doctor-card shadow-sm">
        <div class="doctor-img"><img src="<?=$resim_yolu;?>"></div>
        <div class="card-body p-4">
          <span class="spec-badge"><?=htmlspecialchars($row['uzmanlik']);?></span>
          <h4 class="fw-bold mb-3">Dr. <?=htmlspecialchars($row['name']);?></h4>
          <div class="d-grid"><a href="hesabim.php?klinik=<?=$row['specialization'];?>&doktor=<?=$row['id'];?>" target="_blank" class="btn btn-primary rounded-pill fw-bold">Online Randevu</a></div>
          <br>
          <div class="d-grid"><a href="gorusal.php?klinik=<?=$row['specialization'];?>&doktor=<?=$row['id'];?>" target="_blank" class="btn btn-success rounded-pill fw-bold">Doktordan Görüş Al</a></div>
        </div>
      </div>
    </div>
    <?PHP } ?>
  </div>
</div>
</body>
</html>