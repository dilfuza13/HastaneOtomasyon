<?PHP 
include('inc_config.php');

if(!isset($_SESSION['patient']['id'])){header("Location: index.php");  exit;}
$patientid = $_SESSION['patient']['id'];
$pInfo = mysqli_fetch_assoc($mysqli->query("SELECT * FROM patient WHERE id='$patientid'"));

if(!isset($_GET['id'])){header("Location: index.php"); exit;}

$requestid = g('id');

$query = $mysqli->query("select * from requests where id='" .$requestid. "' AND patient='$patientid'");
if($query->num_rows == 0){ header("Location: index.php"); exit; }
$r = mysqli_fetch_assoc($query);

$doctor = mysqli_fetch_assoc($mysqli->query("select * from doctor where id='" .$r['doctor']. "'"));
$policlin = mysqli_fetch_assoc($mysqli->query("select * from specialization where id='" .$doctor['specialization']. "'"));

?>
<!doctype html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <title>Nova Care | Hesabım</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <style>
    :root { --primary-color: #0d6efd; --success-color: #198754; --bg-light: #f4f7fe; }
    body { background-color: var(--bg-light); font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; padding-top: 100px; }
    
    .main-card { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); background: #fff; }
    .header-gradient { background: linear-gradient(45deg, #0d6efd, #0046b8); color: white; border-radius: 20px; padding: 30px; margin-bottom: 30px; }
    
    .form-select { border-radius: 10px; border: 1px solid #e0e0e0; padding: 12px; cursor: pointer; }
    .btn-appointment { border-radius: 12px; padding: 12px 30px; font-weight: 600; text-transform: uppercase; }
    
    .slot-container { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 15px; }
    .btn-check:checked + .btn-outline-primary { background-color: var(--primary-color); color: white; box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3); }
    
    .status-badge { padding: 6px 12px; border-radius: 8px; font-size: 0.85rem; font-weight: 600; }
    .table thead { background-color: #f8f9fa; }
  </style>

  <script>
    function git(url){ window.document.location.href=url; }
  </script>
</head>
<body>

<?PHP include('inc_header.php');?>

<div class="container mb-5">
  
  <div class="header-gradient shadow-sm d-flex justify-content-between align-items-center">
    <div>
        <h2 class="fw-bold mb-1">Merhaba, <?=$pInfo['name'];?>! 👋</h2>
        <p class="mb-0 opacity-75">Nova Care sağlık panelinize hoş geldiniz.</p>
    </div>
    <div class="d-none d-md-block">
        <i class="fa-solid fa-notes-medical fa-3x opacity-25"></i>
    </div>
  </div>

  <div class="row g-4">
    <div class="col-lg-12">
      <div class="main-card p-4 shadow-sm">
        <div class="d-flex align-items-center mb-4">
            <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3">
                <i class="fa-solid fa-calendar-plus text-primary"></i>
            </div>
            <h5 class="mb-0 fw-bold">Doktordan Görüş Al (<small><?PHP echo $r['createdtime'];?></small>)</h5>
        </div>

          <div class="row g-3">

            <div class="col-md-6">
                <label class="form-label small fw-bold text-muted">Doktor   </label>
                <h3 class="fw-bold">Dr. <?PHP echo $doctor['name'];?></h3>
            </div>


            <div class="col-md-6">
                <label class="form-label small fw-bold text-muted">Poliklinik</label>
                <h3 class="fw-bold"><?PHP echo $policlin['specialization'];?></h3>
            </div>

          </div>

            <hr>
          <div class="row g-3">

          

            <div class="col-md-12">
                <label class="form-label small fw-bold text-muted">Derdiniz</label>
                <h5 class="fw-bold"><?PHP echo $r['story'];?></h5>
            </div>

            </div>

            <hr>
          <div class="row g-3">

        

            <div class="col-md-12">
                <label class="form-label small fw-bold text-muted">Dosyalar</label>
                <h5 class="fw-bold">
                    <?PHP
                    $filequery = $mysqli->query("SELECT * FROM uploads WHERE request='$requestid'");
                    while($f = mysqli_fetch_assoc($filequery)){
                        echo '<a href="./uploads/' . $f['fileurl'] . '" target="_blank">' . $f['fileurl'] . '</a><br>';
                    }
                    ?>
                </h5>
            </div>

            </div>

            <hr>
          <div class="row g-3">

            <div class="col-md-6">
                <form action="action.php" method="post">
                   
                <label class="form-label small fw-bold text-muted">Ekleme Yap</label>
                <textarea name="story" required class="form-select" placeholder="Eklemek istediğiniz bir şey var mı?..."></textarea>
                <button type="submit">KAYDET</button>
                <input type="hidden" name="action" value="addstory">
                 <input type="hidden" name="patient" value="<?=$patientid;?>">
                    <input type="hidden" name="request" value="<?=$requestid;?>">
                </form>
            </div>



            <div class="col-md-6">
                <form action="action.php" method="post" enctype="multipart/form-data">
                <label class="form-label small fw-bold text-muted">Dosya Yükle</label>
                <input type="file" name="file" class="form-select">
                <button type="submit">YÜKLE</button>
                <input type="hidden" name="action" value="addfile">
                <input type="hidden" name="patient" value="<?=$patientid;?>">
                <input type="hidden" name="request" value="<?=$requestid;?>">
                </form>
            </div>

             
          </div>
           
          </div>
      </div>
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>