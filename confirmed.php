<?php 
ob_start();
require_once('header.html'); 
require_once("auth.php");
require_once("config.php");
$order_id = $_GET["order_id"];
if (!isset($_GET["order_id"])){
    header("Location:order.php");
}
$sql_orderid = "SELECT * FROM orderlaundry WHERE order_id =:order_id";
            $params_orderid = array(
                ":order_id" => $order_id,
            );
            $stmt2 = $db->prepare($sql_orderid);
            $stmt2->execute($params_orderid);
            $user = $stmt2->fetch(PDO::FETCH_ASSOC);
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

            if ($_SESSION["user"]["user_id"] != $user["user_id"]){
                header("Location:order.php");
            }
            else {
                echo '
                <div>
                <div id="confirmed">
                <h1 id="confirmtitle">ORDER Terkonfirmasi</h1>
                <h2 id="confirm2">Kurir kami akan mengambil laundry anda</h2>
                <h3 id="confirm3">Terima kasih telah memesan</h3>
                </div>
                <div>
                
                <form action="" method="POST">
                <div class="buttonorder" id ="historybuttondiv">
                <input type="submit" class="btn btn-class mt-4" name="orderHistory" value="SEE YOU ORDERS" id="historybutton"/>
                <a href="index.php" id="back">Kembali ke Halaman Utama</a>
                </div>
                </form>
                </body>
            
                </html>';
            }
            if (isset($_POST["orderHistory"])){
                header("Location: orderhistory.php");
            }
?>

<style>
    #confirmed {
        justify-content: center;
        align-items: center;
    }
    #back{
        font-size: 30px;
        text-decoration: none;
        color: #44dff3;
        padding: 5px;

    }
    #back:hover{
        color: black;
        transition: 0.3s ease-in-out;
    }
    #historybutton{
        margin-top: 50px;
        
    }
    #confirmed h1{
        font-size: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    #confirmed h2{
        font-size: 28px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    #confirmed h3{
        font-size: 28px;
        display: flex;
        justify-content: center;
        align-items: center;    
    }
    .buttonorder{
        display: grid;
        justify-content: center;
        align-items: center;  
    }
    .buttonorder #historybutton{
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: 30px;
    }
    .buttonorder #historybutton:hover{
        border: none;
    }
    .buttonorder #back{
        font-size: 20px;
    }
</style>