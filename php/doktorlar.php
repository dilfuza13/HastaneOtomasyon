<?PHP require_once("inc_config.php"); ?>
<!doctype html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <title>Doktorlarımız - Nova Care</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/style.css" rel="stylesheet">
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
                ORDER BY d.id DESC limit 6";
    
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
          <?PHP if(isset($_SESSION['patient'])){ ?>
          <div class="d-grid"><a href="hesabim.php?klinik=<?=$row['specialization'];?>&doktor=<?=$row['id'];?>" target="_blank" class="btn btn-primary rounded-pill fw-bold">Online Randevu</a></div>
          <br>
          <div class="d-grid"><a href="gorusal.php?klinik=<?=$row['specialization'];?>&doktor=<?=$row['id'];?>" target="_blank" class="btn btn-success rounded-pill fw-bold">Doktordan Görüş Al</a></div>
          <?PHP }else{ ?>
          <div class="d-grid"><a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn btn-primary rounded-pill fw-bold">Online Randevu</a></div>
          <br>
          <div class="d-grid"><a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn btn-success rounded-pill fw-bold">Doktordan Görüş Al</a></div>
          <?PHP } ?>
        </div>
      </div>
    </div>
    <?PHP } ?>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Giriş Yap</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <div class="appointment-form">
        <form action="girisyap.php" method="post">
        <h5 class="mb-3">Randevu Almak için veya Görüş Almak için Giriş Yapmalısınız</h5>

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
        <a href="parolamiunuttum.php">Parolamı unuttum</a>
      </div>
      </div>
      <div class="modal-footer">
        <a href="uyeislemleri.php" class="btn btn-primary">Üyelik Oluştur</a>  
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Vazgeç</button>
        
      </div>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>