<?php
require_once("auth.php");
require_once("config.php");

if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
  $id = $user['user_id'];
}
else{
  header("Location: login.php");
}

$sql = "SELECT * FROM user WHERE user_id=:userid";
  $stmt = $db->prepare($sql);

  // bind parameter ke query
  $params = array(
    ":userid" => $id,
  );

  $stmt->execute($params);
  $profil = $stmt->fetch(PDO::FETCH_ASSOC);
  $namauser = $profil['nama'];
  $usernameuser = $profil['username'];
  $notelpuser = $profil['no_telp'];
  $emailuser = $profil['email'];
  $fotouser = $profil['photo'];
?>





<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="profil.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="home.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="footer.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="register.css?v=<?php echo time(); ?>">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="footer.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montagu+Slab:opsz@16..144&family=Poppins&family=Raleway&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
  <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
  <title>Profil Akun</title>
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
      </ul>
    </nav>
  </div>
  <!-- Akhir Bagian Header Jika Sudah Login -->
  <!-- Bagian Utama Profil Akun -->
  <?php if ($user) { ?>
    <div class="d-flex justify-content-center align-items-center vh-100">
      <div class="pembungkus">
        <div class="shadow w-350 p-3 text-center">
          <h2>Profil Akun Anda</h2>
          <img src="image/<?= $fotouser ?>" class="img-fluid rounded-circle">
          <h3 class="display-4 "><?= $namauser ?></h3>
          <a href="edit.php?id=<?= $user['user_id'] ;?>" class="btn btn-primary">
            Edit Profile
          </a>
          <a href="logout.php" class="btn btn-warning">
            Logout
          </a>
        </div>
        <div class="pembungkusprofil">
          <ul>
            <li><p>Nama : <?= $namauser;?></p></li>
            <li><p>Username : <?= $usernameuser;?></p></li>
            <li><p>No Telp. : <?= $notelpuser;?></p></li>
            <li><p>Email : <?= $emailuser;?></p></li>
          </ul>
        </div>

      </div>
    </div>
  <?php } else {
    header("Location: login.php");
    exit;
  } ?>
  <!-- Akhir Bagian Utama Profil Akun -->

  <footer class="footer-distributed">

    <div class="footer-left">
      <h3>Home<span>Laundry</span></h3>

      <p class="footer-links">
        <a href="index.php">Home</a>
        |
        <a href="orderhistory.php">History</a>
        |
        <a href="profil.php">Profile</a>
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

  <!-- Footernya -->
  <footer>
    <div class="headerisi">
      <small>© ; 2022 <b>HomeLaundry</b>All Rights Reserved.</small>
    </div>
  </footer>
</body>

</html>


</body>

<style>
  .w-450 {
    width: 450px;
  }

  .vh-100 {
    min-height: 100vh;
  }

  .w-350 {
    width: 500px;
    height: 500px;
    background-color: #8BBCCC;
    border-radius: 10px;
    box-shadow: 30px 5px 10px 30px rgba(0, 0, 0, 0.5);
    ;
  }

  .w-350 h2 {
    margin-bottom: 30px;
  }

  .shadow img {
    width: 250px;
    height: 250px;
    margin-top: 20px;
  }

  .w-350 h3 {
    margin-top: 30px;
    font-size: 30px;
    text-transform: uppercase;
    margin-bottom: 20px;
  }

  .pembungkus {
    display: flex;
  }
  .pembungkusprofil {
    background-color: lightgray;
    border-radius: 5px;
    width: 50%;
  }
  .pembungkusprofil ul{
    margin-top: 160px;
    display: grid;
    justify-content: center;
    align-items: center;
  }
  .pembungkusprofil ul li{
    list-style: none;
    letter-spacing: 2px;
  }
</style>

</html>