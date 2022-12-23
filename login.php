<?php

session_start();

if (isset($_SESSION["user"])) {
  header("Location: index.php");
  exit;
}

require_once("config.php");
$query_ok = TRUE;

if (isset($_POST['login'])) {

  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

  $sql = "SELECT * FROM user WHERE username=:username OR email=:email";
  $stmt = $db->prepare($sql);

  // bind parameter ke query
  $params = array(
    ":username" => $username,
    ":email" => $username
  );

  $stmt->execute($params);

  $user = $stmt->fetch(PDO::FETCH_ASSOC);


  // jika user terdaftar
  if ($user) {
    // verifikasi password
    if ($password == $user["password"]) {
      session_start();
      $_SESSION["user"] = $user;
      // login sukses, alihkan ke halaman timeline
      header("Location: index.php");
    } else {
      $query_ok = FALSE;
    }
  } else {
    $query_ok = FALSE;
  }
}
?>
<!DOCTYPE html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Home Laundry Login</title>
  <link rel="stylesheet" href="login.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="home.css?v=<?php echo time(); ?>">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Cairo+Play:wght@200&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Italiana&family=Roboto+Flex:opsz,wght@8..144,100;8..144,400&display=swap');
  </style>
</head>

<body>
  <section id="main-menu">
    <div class="main-menu  container">
      <div id="loginform">
      <h2 id="titlelogin">Login Akun Home Laundry</h2>
        <div class="form-group" id="uname">
          <form action="" method="POST">
            <label for="username">Username</label>
            <input class="form-control" type="text" name="username" placeholder="Ketik Username Disini" />
        </div>
        <div class="form-group" id="pword">
          <label for="password">Password</label>
          <input class="form-control" type="password" name="password" placeholder="Ketik Password Disini" />
        </div>
        <?php if (!$query_ok) {
        ?> <p1 id="warning">*Username or password is incorrect </p1> <?php
                                                            } ?>
        <div class="d-flex justify-content-center">
          <input type="submit" class="btn btn-class mt-4" name="login" value="Log in" id="loginbutton" />
        </div>
        </form>
        <div class="d-flex justify-content-center">
          <button id="createbutton" onclick="location.href='register.php'">Belum Punya Akun?</button>
        </div>
      </div>
    </div>
  </section>
</body>

</html>