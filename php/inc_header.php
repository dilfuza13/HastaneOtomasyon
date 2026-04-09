
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
        <li class="nav-item"><a class="nav-link" href="randevu.php">Randevu</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Hizmetler
          </a>
          <ul class="dropdown-menu shadow-sm" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Poliklinikler</a></li>
            <li><a class="dropdown-item" href="#">Laboratuvar</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Görüntüleme</a></li>
          </ul>
        </li>
        <?PHP if(isset($_SESSION['patient'])){?>
        <li class="nav-item"><a class="nav-link" href="hesabim.php">Hesabım</a></li>
        <li class="nav-item"><a class="nav-link" href="cikis.php">Çıkış</a></li>
        <?PHP }else{ ?>
        <li class="nav-item"><a class="nav-link" href="uyeislemleri.php">Üye İşlemleri</a></li>
        <?PHP } ?>
        <li class="nav-item"><a class="nav-link" href="iletisim.php">İletişim</a></li>
      </ul>

    </div>
  </div>
</nav>