<style>
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
</style>
<nav class="navbar navbar-expand-lg bg-white shadow-sm fixed-top">
  <div class="container">

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-between" id="mainNavbar">

      <ul class="navbar-nav mx-auto gap-4">
        <li class="nav-item"><a class="nav-link" href="index.html">Anasayfa</a></li>
        <li class="nav-item"><a class="nav-link" href="uzmanliklar">Uzmanlıklar</a></li>
        <li class="nav-item"><a class="nav-link" href="randevu.html">Randevu</a></li>
      </ul>

      <a class="navbar-brand position-absolute start-50 translate-middle-x" href="#">
        Nova Care
      </a>

      <ul class="navbar-nav mx-auto gap-4">
        <li class="nav-item"><a class="nav-link" href="doktor.html">Doktorlar</a></li>
        <li class="nav-item"><a class="nav-link" href="haberler.html">Haberler</a></li>
        <li class="nav-item"><a class="nav-link" href="iletisim.html">İletişim</a></li>
      </ul>

    </div>
  </div>
</nav>