<?php
session_start();
$db = mysqli_connect("sql204.epizy.com","epiz_32723533", "YZTApYhz6e", "epiz_32723533_homelaundry");
$id = $_GET["id"];

if($_SESSION['user']['user_id'] != $id){
  header("Location:index.php");
}



function query($query){
    global $db;
    $result = mysqli_query($db,$query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;

}


$profilakun = query("SELECT * FROM user WHERE user_id = $id")[0];


function ubah($data){
    global $db;
    $id = $data['id']; 
    $nama = htmlspecialchars($data["nama"]);
    $username = htmlspecialchars($data["username"]);
    $no_telp = htmlspecialchars($data["no_telp"]);
    $email = htmlspecialchars($data["email"]);
    $password = htmlspecialchars($data["password"]);

    $query = "UPDATE user SET 
                nama = '$nama',
                username = '$username',
                no_telp = '$no_telp',
                email = '$email',
                password = '$password'

                WHERE user_id = $id;
                ";

    mysqli_query($db,$query);
    return mysqli_affected_rows($db);

}


if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $username = $user['nama'];
  
    
  }
if(isset($_POST['edit'])){
    if(ubah($_POST) > 0){
        echo "
        <script>
            alert('Profil Berhasil di edit');
            document.location.href = 'profil.php';
        </script>
        
        ";
    }else{
        echo "
        <script>
            alert('Profil Gagal di edit');
            document.location.href = 'edit.php';
        </script>
        
        ";
    }
  }






?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="footer.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="register.css?v=<?php echo time();?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montagu+Slab:opsz@16..144&family=Poppins&family=Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
    <title>Edit Profil Akun</title>
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
  <!-- Bagian Edit Profil -->
  <section class="section-sign-up " id="main-menu">
    <div class="header-signup">
      <h3 id="titlesignup">Edit Profile Anda</h3>
    </div>
    <div class="main-menu container">
        <form action="" method="POST" id="buatakun">
            <input type="hidden" name="id" value= "<?= $profilakun['user_id'];?>"/>
          <div class="form-group">
            <label for="name" id="uname">Nama Lengkap</label>
            <input class="form-control" type="text" name="nama" placeholder="Nama Lengkap" value = "<?=$profilakun['nama'];?>"/>
          </div>

          <div class="form-group">
            <label for="username" id="uname">Username</label>
            <input class="form-control" type="text" name="username" placeholder="username" value = "<?=$profilakun['username'];?>"/>
          </div>

          <div class="form-group">
            <label for="email" id="uname">No Telepon</label>
            <input class="form-control" type="text" name="no_telp" placeholder="Nomor Telepon" value = "<?=$profilakun['no_telp'];?>" />
          </div>

          <div class="form-group">
            <label for="email" id="uname">Email</label>
            <input class="form-control" type="email" name="email" placeholder="Email" value = "<?=$profilakun['email'];?>"/>
          </div>

          <div class="form-group">
            <label for="password" id="pword">Password</label>
            <input class="form-control" type="password" name="password" placeholder="password" value = "<?=$profilakun['password'];?>"/>
          </div>
          <br>
          <div class="col-12 d-flex justify-content-center button-signup" id="ctn-signup">
            <input type="submit" class="btn btn-class mt-4" name="edit" value="edit" id="signupbutton" />
          </div>
        </form>
      </div>
  </section>

  <!-- Akhir Bagian Edit Profil -->
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