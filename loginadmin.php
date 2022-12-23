<?php

session_start();

if (isset($_SESSION["admin"])) {
    header("Location: indexadmin.php");
    exit;
}

require_once("configadmin.php");

if (isset($_POST['login'])) {

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM admin WHERE username=:username";
    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = array(
        ":username" => $username
    );

    $stmt->execute($params);

    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    // jika user terdaftar
    if ($admin) {
        // verifikasi password
        if ($password == $admin["password"]) {
            // buat Session
            session_start();
            $_SESSION["admin"] = $admin;
            // login sukses, alihkan ke halaman timeline
            header("Location: indexadmin.php");
        } else {
            echo "
            <script>
                alert('Username dan password salah');
            
            </script>
            
            ";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login HomeLaundry</title>
    <link rel="stylesheet" href="loginadmin.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="home.css?v=<? echo time(); ?>">
    <link rel="stylesheet" href="footer.css?v=<? echo time();?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montagu+Slab:opsz@16..144&family=Poppins&family=Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
</head>

<body>
    <section id="loginadmin">
        <div class="loginadmin container">
            <div id="loginform">
                <h1>Login Admin Home Laundry</h1>
                    <div class="form-group" id="uname">
                    <form action="" method="POST">
                        <label for="username">Username : </label>
                        <input class="form-control" type="text" name="username" placeholder="Username atau email" id="formname"/>
                    </div>
                    <div class="form-group" id="pword">
                        <label for="password">Password : </label>
                        <input class="form-control" type="password" name="password" placeholder="Password" id="formpass" />
                    </div>
                    <input type="submit" class="btn btn-warning btn-block" name="login" value="Masuk" id="loginbutton"/>

                </form>
            </div>
        </div>
    </section>
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
<!-- Footernya -->
<footer>
        <div class="headerisi">
            <small>© ; 2022 <b>HomeLaundry</b>All Rights Reserved.</small>
        </div>
    </footer>


</body>

</html>