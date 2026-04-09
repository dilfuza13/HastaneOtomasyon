<?PHP include('inc_config.php');?>
<!doctype html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <title>Nova Care</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/style.css" rel="stylesheet">

</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg bg-white fixed-top">
  <div class="container">
    <a class="navbar-brand mx-auto" href="#">Nova Care</a>
  </div>
</nav>

<!-- DOKTOR BİLGİLERİ -->
<div class="container-fluid mt-4">
  <div class="row">
    <div class="col-md-6 ps-0">
      <div class="doctor-wrapper">

        <!-- RESİM -->
        <img
          src="Nova Care_files/doktorresimleri/woman-doctor-5321351_640.jpg"
          class="doctor-photo"
          alt="Malahat Karimova"
        >

        <!-- BİLGİLER -->
        <div>
          <h4>Malahat Karimova</h4>
          <small>çok iyi kalpli bir kadın</small>

          <p class="mt-2">Ayşe@demir.com</p>
          <p>05338568933</p>
          <p>June 02, 1974</p>

          <!-- SİL -->
          <form
            action="actions.php"
            method="post"
            class="delete-form"
            onsubmit="return confirm('Doktor Malahat Karimova kaydını silmek istediğinize emin misiniz?');"
          >
            <button type="submit" class="btn btn-danger btn-sm">SİL</button>
            <input type="hidden" name="action" value="deletedoctor">
            <input type="hidden" name="id" value="2">
          </form>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- DÜZENLE FORMU -->
<form action="actions.php" method="post" class="edit-form">
  <input type="text" name="doctorname" value="Malahat Karimova">
  <input type="email" name="doctormail" value="malahat@karimova.com">
  <input type="password" name="password" value="12345">
  <input type="text" name="phone" value="1234567">
  <input type="text" name="description" value="çok iyi kalpli bir kadın">

  <button type="submit" class="btn btn-primary">DÜZENLE</button>

  <input type="hidden" name="action" value="editdoctor">
  <input type="hidden" name="id" value="2">
</form>

</body>
</html>
