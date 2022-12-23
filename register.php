<?php

session_start();
$query_ok= TRUE;

if (isset($_SESSION["user"])) {
  header("Location: index.php");
  exit;
}

require_once("config.php");

if (isset($_POST['register'])) {

  // filter data yang diinputkan
  $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
  $no_telp = filter_input(INPUT_POST, 'no_telp', FILTER_SANITIZE_STRING);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
  $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);



if($name =='' || $username == '' || $no_telp == '' ||$password == '' || $email == ''){
    $query_ok = FALSE;
}
  // menyiapkan query
  $sql = "INSERT INTO user (nama, username, email,no_telp, password) 
            VALUES (:name, :username, :email, :no_telp, :password)";
  $stmt = $db->prepare($sql);

  // bind parameter ke query
  $params = array(
    ":email" => $email,
    ":password" => $password,
    ":name" => $name,
    ":no_telp" => $no_telp,
    ":username" => $username

  );
  $saved = FALSE;
  // eksekusi query untuk menyimpan ke database
  if ($query_ok){
    $saved = $stmt->execute($params);
  }


  // jika query simpan berhasil, maka user sudah terdaftar
  // maka alihkan ke halaman login
  if ($saved) header("Location: login.php");
}

  


?>

<!DOCTYPE HTML>

<head>
  <title>REGISTER</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Home Laundry</title>
  <link rel="stylesheet" href="register.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="home.css?v=<?php echo time(); ?>">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Cairo+Play:wght@200&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Italiana&family=Roboto+Flex:opsz,wght@8..144,100;8..144,400&display=swap');
  </style>
</head>

<body>
  <section class="section-sign-up " id="main-menu">
    <div class="header-signup">
      <h3 id="titlesignup">Buat Akun Baru</h3>
    </div>
    <div class="main-menu container">
        <form action="" method="POST" id="buatakun">
          <div class="form-group">
            <label for="name" id="uname">Nama Lengkap</label>
            <input class="form-control" type="text" name="name" placeholder="Nama Lengkap"/>
          </div>

          <div class="form-group">
            <label for="username" id="uname">Username</label>
            <input class="form-control" type="text" name="username" placeholder="username" />
          </div>

          <div class="form-group">
            <label for="email" id="uname">No Telepon</label>
            <input class="form-control" type="text" name="no_telp" placeholder="Nomor Telepon" />
          </div>

          <div class="form-group">
            <label for="email" id="uname">Email</label>
            <input class="form-control" type="email" name="email" placeholder="Email"/>
          </div>

          <div class="form-group">
            <label for="password" id="pword">Password</label>
            <input class="form-control" type="password" name="password" placeholder="password"/>
          </div>
          <br>
        

          <div class="col-12 d-flex justify-content-center button-signup" id="ctn-signup">
            <input type="submit" class="btn btn-class mt-4" name="register" value="SIGN UP" id="signupbutton" />
          </div>
          <ul>
            
          <li><?php if (!$query_ok) {
          ?> 
          <p1 id="warningakun">*please fill in all the required information </p1> <?php
                                                                                      } ?></li>
          <li><p1 class="pt-3" id="already">Already have an account? <a id="loginhere" href="login.php"> Log in here!</a></p1></li>
          </ul>
        </form>
      </div>
  </section>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="FrontEnd/libraries/jquery/jquery-3.6.0.min.js"></script>
  <script src="Frontend/libraries/js/bootstrap.js"></script>
  <script src="FrontEnd/libraries/retina js/retina.min.js"></script>
  <style>
    .main-menu{
      height: 100vh;
    }
  </style>
</body>

</html>