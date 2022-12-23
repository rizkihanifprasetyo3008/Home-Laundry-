<?php
ob_start();
require_once('header.html');
require_once("auth.php");
require_once("config.php");

if (empty($_SESSION["user"])) {
    header("Location:login.php");
}


$idUser = $_SESSION["user"]["user_id"];


$conn = mysqli_connect("sql204.epizy.com", "epiz_32723533", "YZTApYhz6e", "epiz_32723533_homelaundry");


// if ($conn) {
//     echo "Connection Succesfully";
// } else {
//     echo "Can't connect to Database";
// }

$query = "SELECT * FROM orderlaundry WHERE user_id = $idUser ORDER BY order_id DESC";
$connect = mysqli_query($conn, $query);
// die;
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    return $data;
}

// $arrayTemp = [];
// $i = 0;
// while ($data = $connect->fetch_object()) {
//     $arrayTemp[$i]["order_id"] = $data->order_id;
// }
// var_dump($arrayTemp);
// die;



$statusArray = ["canceled", "order received", "laundrying", "order finished"];

?>
<link rel="stylesheet" href="home.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="footer.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
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
<h1 style="color:white; text-align:center;">ORDER HISTORY</h1>
<br>
<br>




<?php if (mysqli_affected_rows($conn)) : ?>
    <div class="tabelhistory"style="margin: 2px 20px 10px 20px">
        <table class="table table-striped" style="background-color: white;">
            <tr>
                <th>Baju</th>
                <th>Celana</th>
                <th>Jaket</th>
                <th>Pakaian Dalam</th>
                <th>Kaos Kaki</th>
                <th>Layanan</th>
                <th>Alamat</th>
                <th>Tanggal ambil</th>
                <th>Catatan</th>
                <th>Harga</th>
                <th>Status</th>
            </tr>
            <?php
            while ($data = $connect->fetch_object()) {
                echo '<tr>';

                //tshirt
                echo '<th>' . $data->tshirt . '</th>';

                //pants
                echo '<th>' . $data->pants . '</th>';

                //jacket
                echo '<th>' . $data->jacket . '</th>';

                //underwear
                echo '<th>' . $data->underwear . '</th>';

                //socks
                echo '<th>' . $data->socks . '</th>';

                //service
                echo '<th>' . $data->service . '</th>';

                //address
                echo '<th>' . $data->address . '</th>';

                //date
                echo '<th>' . $data->date . '</th>';

                //notes
                echo '<th>' . $data->notes . '</th>';

                //price
                echo '<th>' . $data->price . '</th>';

                //status
                echo '<th>' . $statusArray[$data->status] . '</th>';

                echo '</tr>';
            }
            ?>
            <!-- <?php var_dump($data) ?> -->
        </table>
    </div>
<?php else : ?>
    <h1 style="color:white; text-align:center;">Maaf, Kamu belum pernah order</h1>

<?php endif; ?>
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
					home laundry is a laundry company that is ready to serve you well and wash all your dirty clothes clean.</p>
				<div class="footer-icons">
					<a href="#"><i class="fa fa-facebook"></i></a>
					<a href="#"><i class="fa fa-twitter"></i></a>
					<a href="#"><i class="fa fa-instagram"></i></a>
				</div>
			</div>
		</footer>
    <footer>
        <div class="headerisi">
            <small>© ; 2022 <b>HomeLaundry</b>All Rights Reserved.</small>
        </div>
    </footer>
	</body>
</html>

<style>
    .table tr{
        justify-content: center;
        align-items: center;
        border: 1px solid black;
    }
    h1{
        margin-top: 100px;
    }
    .tabelhistory table tr{
      background-color: lightskyblue;
    }
</style>