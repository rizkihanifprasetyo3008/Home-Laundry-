<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="footer.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montagu+Slab:opsz@16..144&family=Poppins&family=Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
    <title>Document</title>
</head>
<body>




<?php 
ob_start();
require_once('nohead.html'); 
require_once("auth.php");
require_once("config.php");
$order_id = $_GET["order_id"];


if (!isset($_SESSION["user"])){
    header("Location:login.php");
}
            $sql_orderid = "SELECT * FROM orderlaundry WHERE order_id = :order_id"." ";
            $params_orderid = array(
                ":order_id" => $order_id,
            );
            $stmt2 = $db->prepare($sql_orderid);
            $stmt2->execute($params_orderid);
            $user = $stmt2->fetch(PDO::FETCH_ASSOC);

            if ($_SESSION["user"]["user_id"] != $user["user_id"]){
                header("Location:order.php");
            }

            $service = $user["service"];
            if ($service == 'classic'){
                $harga_tshirt = 1500;
                $harga_pants = 2500;
                $harga_jacket = 3000;
                $harga_underwear = 500;
                $harga_socks = 1000;
            }
            else{
                $harga_tshirt = 2000;
                $harga_pants = 3000;
                $harga_jacket = 4000;
                $harga_underwear = 1500;
                $harga_socks = 1000;
            }
            $tshirt = $user["tshirt"];
            $pants = $user["pants"];
            $jacket = $user["jacket"];
            $underwear = $user["underwear"];
            $socks = $user["socks"];
            $harga = $user["price"];
            $address = $user["address"];
            $notes = $user["notes"];
                        echo '
                        <section id ="orderlist">
                        <div class="container"
                        style="
                        background-color : #256D85;
                        ">
                        <form action="" method="POST">
                        <div id="finalprice">
                        <p id="labelform">Service : '.$service.'</p>
                        <table>
                          <tr>
                            <th id="items">Jenis Pakaian</th>
                            <th id="amount">Jumlah</th>
                            <th id="amount">Harga</th>
                            <th id="price">total per item</th>
                          </tr>
                          <tr>
                            <td id="items">Baju</th>
                            <td id="amount">'.$tshirt.'</th>
                            <td id="amount">'.$harga_tshirt.'</th>
                            <td id="price">'.$tshirt*$harga_tshirt.'</th>
                          </tr>
                          <tr>
                          <td id="items">Celana</th>
                          <td id="amount">'.$pants.'</th>
                          <td id="amount">'.$harga_pants.'</th>
                          <td id="price">'.$pants*$harga_pants.'</th>
                        </tr>
                        <tr>
                            <td id="items">Jacket</th>
                            <td id="amount">'.$jacket.'</th>
                            <td id="amount">'.$harga_jacket.'</th>
                            <td id="price">'.$jacket*$harga_jacket.'</th>
                        </tr>
                        <tr>
                            <td id="items">Pakaian Dalam</th>
                            <td id="amount">'.$underwear.'</th>
                            <td id="amount">'.$harga_underwear.'</th>
                            <td id="price">'.$underwear*$harga_underwear.'</th>
                        </tr>
                        <tr>
                            <td id="items">Kaos Kaki</th>
                            <td id="amount">'.$socks.'</th>
                            <td id="amount">'.$harga_socks.'</th>
                            <td id="price">'.$socks*$harga_socks.'</th>
                        </tr>
                          <tr id="totalrow">
                            <th colspan="3" id="totalcolspan">TOTAL</th>
                            <th id="totalprice">'.$harga.'</th>
                          </tr>
                        </table>
                        
                        <div class="d-flex justify-content-center">
                            <input type="submit" class="btn btn-class mt-4" name="order" value="Order" id="orderbutton"/>
                            <input type="submit" class="btn btn-class mt-4" name="cancel_button" value="Cancel" id="cancelbutton"/>
                        </div>
                        </form>
                      </div>
                      
            </div>
            </section>
        </main>
    <div style="color: white"> ';
    if (isset($_POST["cancel_button"])){
        $sql_delete = "DELETE FROM orderlaundry WHERE order_id =".$order_id." ";
        $result = $db->query($sql_delete);
    if (!$result){
        die ("Could not query the database: <br />". $db->error);
    }else{
        header("Location: order.php");
    }
    }
    if (isset($_POST["order"])){
        header("Location: confirmed.php?order_id=".$order_id."");
    }

?>

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

<footer>
        <div class="headerisi">
            <small>© ; 2022 <b>HomeLaundry</b>All Rights Reserved.</small>
        </div>
    </footer>




    </body>
</html>

<style>
    *{
        margin: auto;
        padding: 0;
    }
</style>


    
    