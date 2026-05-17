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
        <li class="nav-item"><a class="nav-link" href="index.php">Anasayfa</a></li>
        <li class="nav-item"><a class="nav-link" href="uzmanliklar.php">Hakkımızda</a></li>
        <li class="nav-item"><a class="nav-link" href="doktorlar.php">Doktorlarımız</a></li>
      </ul>

      <a class="navbar-brand position-absolute start-50 translate-middle-x" href="#">Nova Care</a>

      <ul class="navbar-nav mx-auto gap-4">
        <li class="nav-item"><a class="nav-link" href="uzmanliklar.php">Hizmetlerimiz</a></li>
        <li class="nav-item"><a class="nav-link" href="iletisim.php">İletişim</a></li>
       
        <?PHP if(isset($_SESSION['patient'])){?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Hesabım
          </a>
          <ul class="dropdown-menu shadow-sm" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="hesabim.php">Hesabım</a></li>  
            <li><a class="dropdown-item" href="hesabim.php">Randevularım</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="cikis.php">Çıkış</a></li>
          </ul>
        </li>
        <?PHP }else{ ?>
        <li class="nav-item"><a class="nav-link" href="uyeislemleri.php">Üye İşlemleri</a></li>
        <?PHP } ?>
        
      </ul>

    </div>
  </div>
</nav>