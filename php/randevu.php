<!doctype html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <title>Nova Care | Randevu Sistemi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 5.3 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      padding-top: 110px;
      background-color: #f8f9fa;
      font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
    }

    .hero {
      background: linear-gradient(90deg, #0d6efd, #4dabf7);
      color: white;
      padding: 80px 0;
      border-radius: 18px;
      margin-bottom: 60px;
    }

    .panel {
      background: white;
      padding: 28px;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0,0,0,.08);
    }

    .times {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 10px;
      margin-top: 10px;
    }

    .time-btn {
      padding: 12px 0;
      border-radius: 8px;
      border: none;
      font-weight: 600;
      background: #e3f2fd;
      transition: .2s;
    }

    .time-btn:hover { background: #bbdefb; }

    .time-btn.unset {
      background: #e0e0e0;
      color: #888;
      cursor: not-allowed;
    }

    .time-btn.selected {
      background: #0d6efd;
      color: #fff;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold text-primary" href="#">Nova Care</a>
  </div>
</nav>

<div class="container">
  <div class="hero text-center">
    <h1 class="fw-bold">RANDEVU SİSTEMİ</h1>
    <p class="lead mt-3">Uzman doktor kadromuz ile yanınızdayız</p>
  </div>
</div>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
      <div class="panel">
        <h3 class="text-center mb-4 fw-bold">Hastane Randevu Alma</h3>

        <label class="form-label">Poliklinik</label>
        <select class="form-select mb-3">
          <option>Dahiliye</option>
          <option>Kardiyoloji</option>
          <option>Cildiye</option>
        </select>

        <label class="form-label">Doktor</label>
        <select class="form-select mb-3">
          <option>Dr. Ahmet Yılmaz</option>
          <option>Dr. Ayşe Demir</option>
        </select>

        <label class="form-label">Tarih</label>
        <input type="date" class="form-control mb-3">

        <label class="form-label">Saat</label>
        <div class="times" id="times"></div>

        <button class="btn btn-success w-100 mt-4" id="confirm" disabled>
          Randevuyu Onayla
        </button>
      </div>
    </div>
  </div>
</div>

<script>
  const hours = ['09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00'];
  const unsetHours = ['10:00','14:00','16:00'];

  const container = document.getElementById('times');
  const confirmBtn = document.getElementById('confirm');

  hours.forEach(hour => {
    const btn = document.createElement('button');
    btn.type = "button";
    btn.className = 'time-btn';
    btn.innerText = hour;

    if (unsetHours.includes(hour)) {
      btn.classList.add('unset');
      btn.innerText = hour + ' (Dolu)';
      btn.disabled = true;
    }

    btn.onclick = () => {
      document.querySelectorAll('.time-btn').forEach(b => b.classList.remove('selected'));
      btn.classList.add('selected');
      confirmBtn.disabled = false;
    };

    container.appendChild(btn);
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
