<?php
ob_start();
require_once('header.html');
require_once("auth.php");
require_once("config.php");

if (empty($_SESSION["user"])) {
    header("Location:login.php");
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    return $data;
}

$flag = true;
$address = '';
$notes = '';
$service = '';
$date = '';
$classic_check = '';
$expert_check = '';

if (isset($_POST['checkout'])) {
    $tshirt = $_POST['tshirt'];
    if ($tshirt < 0) {
        $error = "number cannot be lower than 0";
        $flag = false;
    }
    $pants = $_POST['pants'];
    if ($pants < 0) {
        $error = "number cannot be lower than 0";
        $flag = false;
    }
    $jacket = $_POST['jacket'];
    if ($jacket < 0) {
        $error = "number cannot be lower than 0";
        $flag = false;
    }
    $underwear = $_POST['underwear'];
    if ($underwear < 0) {
        $error = "number cannot be lower than 0";
        $flag = false;
    }
    $socks = $_POST['socks'];
    if ($socks < 0) {
        $error = "number cannot be lower than 0";
        $flag = false;
    }
    $service = test_input($_POST['service']);
    if ($service == "classic") {
        $classic_check = "checked";
        $expert_check = '';
    } elseif ($service == "expert") {
        $expert_check = "checked";
        $classic_check = '';
    } else {
        $classic_check = '';
        $expert_check = '';
    }
    if (empty($service)) {
        $error = "please select your service";
        $flag = false;
    }
    $address = test_input($_POST['address']);
    if (empty($address)) {
        $error = "please put your address";
        $flag = false;
    }
    $date = test_input($_POST['date']);
    if (empty($date)) {
        $error = "please put your date of pick up";
        $flag = false;
    }
    $notes = test_input($_POST['notes']);
    if ($service == 'classic') {
        $harga_tshirt = 1500;
        $harga_pants = 2500;
        $harga_jacket = 3000;
        $harga_underwear = 500;
        $harga_socks = 1000;
    } else {
        $harga_tshirt = 2000;
        $harga_pants = 3000;
        $harga_jacket = 4000;
        $harga_underwear = 1500;
        $harga_socks = 1000;
    }
    $harga = ($tshirt * $harga_tshirt) + ($pants * $harga_pants) + ($jacket * $harga_jacket) + ($underwear * $harga_underwear) + ($socks * $harga_socks);

    if ($flag) {
        $params = array(
            ":userid" => $_SESSION["user"]["user_id"],
            ":tshirt" => $tshirt,
            ":pants" => $pants,
            ":jacket" => $jacket,
            ":underwear" => $underwear,
            ":socks" => $socks,
            ":service" => $service,
            ":address" => $address,
            ":date" => $date,
            ":notes" => $notes,
            ":price" => $harga,
            ":status" => 1
        );
        $sql = "INSERT INTO orderlaundry (user_id,tshirt,pants,jacket,underwear,socks,service,address,date,notes,price,status) 
            VALUES (:userid, :tshirt, :pants, :jacket, :underwear,:socks,:service,:address,:date,:notes,:price,:status)";
        $stmt = $db->prepare($sql);
        $saved = false;
        $saved = $stmt->execute($params);

        if ($saved) {
            $sql_orderid = "SELECT * FROM orderlaundry WHERE user_id = :userid AND date = :date AND price = :price";
            $params_orderid = array(
                ":userid" => $_SESSION["user"]["user_id"],
                ":date" => $date,
                ":price" => $harga
            );
            $stmt2 = $db->prepare($sql_orderid);
            $stmt2->execute($params_orderid);
            $user = $stmt2->fetch(PDO::FETCH_ASSOC);

            // jika user terdaftar
            if ($user) {
                header("Location: checkout.php?order_id=" . $user["order_id"]);
                echo "sukses";
            } else {
                echo "<h2>failed</h2>";
            }
        }
    }
}


if (empty($tshirt)) {
    $tshirt = 0;
}

if (empty($pants)) {
    $pants = 0;
}

if (empty($jacket)) {
    $jacket = 0;
}

if (empty($underwear)) {
    $underwear = 0;
}

if (empty($socks)) {
    $socks = 0;
}


if (!isset($_POST['checkout']) || $flag == false) {
    echo '
    <head>
    <link rel="stylesheet" href="order.css?v=<?php echo time(); ?>">
    </head>
    <body>
        <div id="header">
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
            </ul>
        </div>
        <main>
            <div class="container">
              <div class="row g-3 content">
                <form action="" method="POST">
                    <div class="form-group">
                        <p id="labelform">Pilih jenis pakaian yang mau di laundry :</p>
                        <div style="
                        display : flex;
                        flex-direction : row;
                        justify-content: space-between;
                        align-items: start;" id="inputform">
                        <div>
                            <label for="tshirt" id="tshirt">Baju</label>
                            <input class="form-control" type="number" name="tshirt" id="label1" value = "' . $tshirt . '"/>
                        </div>
                        <div>
                            <label for="pants" id="pants">Celana</label>
                            <input class="form-control" type="number" name="pants" id="label1" value = "' . $pants . '"/>
                        </div>
                        <div>
                            <label for="jacket" id="jacket">Jaket</label>
                            <input class="form-control" type="number" name="jacket" id="label1" value = "' . $jacket . '"/>
                        </div>
                        <div>
                            <label for="underwear" id="underwear">Pakaian Dalam</label>
                            <input class="form-control" type="number" name="underwear" id="label1" value = "' . $underwear . '"/>
                        </div>
                        <div>
                            <label for="socks" id="socks">Kaos Kaki</label>
                            <input class="form-control" type="number" name="socks" id="label1" value = "' . $socks . '"/>
                        </div>
                        </div>
                    </div>
                    <p id="labelform">Pilih Layanan Paket :</p>
                    <div class ="form-check" id="inputform">
                        <label class="form-check-label">
                        <input type="radio" class ="form-check-input" name="service" value="classic" ' . $classic_check . '>The Classic (3-4 days)
                        </label>
                    </div>
                    <div class ="form-check" id="inputform">
                        <label class="form-check-label">
                        <input type="radio" class ="form-check-input" name="service" value="expert" ' . $expert_check . '>The Expert (1-2 days)
                        </label>
                    </div>
      
                  <div class="form-group">
                    <label for="address" id="address">Address</label>
                    <input class="form-control" type="text" name="address" value="' . $address . '"/>
                  </div>

                  <div class="form-group">
                    <label for="date" id="date">Date of Pick up</label>
                    <input class="form-control" type="date" name="date" value="' . $date . '"/>
                  </div>
      
                  <div class="form-group">
                    <label for="notes" id="notes">Notes</label>
                    <textarea class="form-control rounded-3" rows="3" name ="notes">' . $notes . '</textarea>
                  </div>
                
                  <div class="d-flex justify-content-center">
                    <input type="submit" class="btn btn-class mt-4" name="checkout" value="Check Out" id="checkoutbutton"/>
                  </div>
                </form>';
    if (isset($_POST["checkout"]) && $flag == false) {
        echo '<p id="errortext">' . $error . '</p>';
    }
}
?>
</div>
</main>
</div>

<!-- bagian footer -->
<link rel="stylesheet" href="footer.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
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
    <!-- akhir bagian footer -->