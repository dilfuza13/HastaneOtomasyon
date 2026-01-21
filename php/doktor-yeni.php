<?PHP include('inc_config.php');?>
<!doctype html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <title>Nova Care</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      padding-top: 110px;
      background-color: #f8f9fa;
      font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
    }

    /* NAVBAR */
    .navbar {
      padding: 22px 0;
    }

    .navbar-brand {
      color: #0d6efd !important;
      font-weight: 700;
      font-size: 1.9rem;
    }

    /* ---- DOKTOR ALANI ---- */
    .doctor-wrapper {
      display: flex;
      align-items: flex-start;
      padding-left: 0;
    }

    .doctor-photo {
      width: 90px;          /* DAHA KÜÇÜK */
      height: auto;
      display: block;
      margin-right: 16px;
    }

    /* ---- SİL FORMU (ARKA PLAN YOK) ---- */
    .delete-form {
      background: none;
      padding: 0;
      margin: 0;
      box-shadow: none;
    }

    .delete-form button {
      box-shadow: none;
    }

    /* ---- DÜZENLE FORMU ---- */
    .edit-form {
      background: #fff;
      padding: 24px;
      border-radius: 12px;
      max-width: 520px;
      margin: 40px 0 40px 20px;
    }

    .edit-form input {
      border-radius: 10px;
      padding: 12px 14px;
      font-size: 15px;
      border: 1px solid #ced4da;
      margin-bottom: 12px;
    }

    .edit-form input:focus {
      border-color: #0d6efd;
      outline: none;
      box-shadow: none;
    }
  </style>
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
