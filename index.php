<?php
require_once("config.php");
session_start();

if (isset($_SESSION['user'])){
  $user = $_SESSION['user'];
  $id = $user['user_id'];
  $sql = "SELECT * FROM user WHERE user_id=:userid";
  $stmt = $db->prepare($sql);

  // bind parameter ke query
  $params = array(
    ":userid" => $id,
  );

  $stmt->execute($params);
  $nama = $stmt->fetch(PDO::FETCH_ASSOC);
  $namauser = $nama['nama'];
}


?>

<!DOCTYPE html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Home Laundry</title>
  <link rel="stylesheet" href="home.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="footer.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montagu+Slab:opsz@16..144&family=Poppins&family=Raleway&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
  <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
</head>

<body>
  <!-- Bagian Header Jika Sudah Login -->
  <div id="header">
    <nav class="nav_navigationbar">
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link " href="index.php" id="navmenu">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profil.php" id="navmenu">Profil Akun</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="orderhistory.php" id="navmenu">History</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="order.php" id="navmenu">Order Now</a>
        </li>
        <li class="nav-item">
          <?php if (isset($_SESSION['user'])) : ?>
            <button id="login" class="nav-link" onclick="location.href='logout.php'" type="button">LOG OUT</button>
          <?php endif; ?>
        </li>
        <li class="nav-item">
          <?php if (!isset($_SESSION['user'])) : ?>
            <button id="login" class="nav-link" onclick="location.href='loginadmin.php'" type="button">LOGIN ADMIN</button>
          <?php endif; ?>
        </li>
      </ul>
    </nav>
  </div>
  <!-- Akhir Bagian Header Jika Sudah Login -->
  <!-- Bagian Menu utama -->
  <section id="main-menu">
    <div class="main-menu container">
      <div>
        <h1>HOME LAUNDRY <span></span></h1>
        <h1>Hemat,Praktis,& Terjamin <span></span></h1>
        <?php if (isset($_SESSION['user'])) : ?>
          <p id="welcome"> Selamat Datang <?php echo $namauser ?> <span></span></p>
          <button id="start" class="ctn" onclick="location.href='order.php'">ORDER NOW</button>
        <?php else : ?>
          <button class="ctn" id="start" onclick="location.href='login.php'">LOG IN</button>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <!-- Akhir Bagian Menu utama -->
  <!-- Bagian Footer -->
  <footer class="footer-distributed">

    <div class="footer-left">
      <h3>Home<span>Laundry</span></h3>

      <p class="footer-links">
        <a href="index.php">Home</a>
        |
        <a href="profil.php">Profile</a>
        |
        <a href="orderhistory.php">History</a>
      </p>

      <p class="footer-company-name">© 2022 Home Laundy Tembalang</p>
    </div>

    <div class="footer-center">
      <div>
        <i class="fa fa-map-marker"></i>
        <p><span>Jalan Gondang Raya no 747, Tembalang, Semarang</span>

      </div>

      <div>
        <i class="fa fa-phone"></i>
        <p>(024) 6712678</p>
      </div>
      <div>
        <i class="fa fa-envelope"></i>
        <p><a href="mailto:support@eduonix.com">HomeLaundry@gmail.com</a></p>
      </div>
    </div>
    <div class="footer-right">
      <p class="footer-company-about">
        <span>About the company</span>
        home laundry is a laundry company that is ready to serve you well and wash all your dirty clothes clean.
      </p>
      <div class="footer-icons">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-instagram"></i></a>
      </div>
    </div>
  </footer>


  <!-- Akhir Bagian Footer -->
  <!-- Footernya -->
  <footer>
        <div class="headerisi">
            <small>© ; 2022 <b>HomeLaundry</b>All Rights Reserved.</small>
        </div>
    </footer>



</body>

</html>


