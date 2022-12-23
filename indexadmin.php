<?php
require_once("authadmin.php");
include('header.php');

$conn = mysqli_connect("sql204.epizy.com", "epiz_32723533", "YZTApYhz6e", "epiz_32723533_homelaundry");

// if ($conn) {
//     echo "Connection Succesfully";
// } else {
//     echo "Can't connect to Database";
// }

$query = "SELECT * FROM orderlaundry ORDER BY order_id DESC";
$connect = mysqli_query($conn, $query);
// $num = mysqli_num_rows($connect);

// $sqlimage  = "SELECT image FROM pembayaran where `id` = $id1";
// $imageresult1 = mysqli_query($conn, $sqlimage);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="indexadmin.css?v=<?php echo time(); ?>">
    <title>Admin HomeLaundry</title>

    <!-- menyisipkan bootstrap -->
</head>
<body>
    

<section id ="nav">
    <!-- <div class="row"> -->
    <!-- <div class="col-md-12"> -->
    <!-- <img class="img img-responsive" src="img/connect.png" /> -->
    <div class="card">
        <div class="text-center pt-2 mb-5">
            <h2>Laundry Order</h2>
        </div>
        <!-- <div class="text-center">
            <a class="btn btn-primary" href="ubahstatus.php">Ubah Status</a><br><br>
        </div> -->
    </div>
    </div>
</section>
<div id="status">
    <p id="db_status"></p>
    <div class="text-right">
        <table class="table table-striped">
            <tr>
                <th>Order ID</th>
                <th>User ID</th>
                <th>Baju</th>
                <th>Celana</th>
                <th>Jaket</th>
                <th>Pakaian Dalam</th>
                <th>Kaos Kaki</th>
                <th>Layanan</th>
                <th>Alamat</th>
                <th>Tanggal Pengambilan</th>
                <th>Catatan</th>
                <th>Harga</th>
                <th>Status</th>
            </tr>
            <?php
            while ($data = $connect->fetch_object()) {
                echo '<tr>';
                //order id
                echo '<th>' . $data->order_id . '</th>';
    
                //user_id
                echo '<th>' . $data->user_id . '</th>';

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

                $st_pemb = $data->status;
                if ($st_pemb == 1){
                    $selectstatus1 = "selected = true";
                    $selectstatus2 = "";
                    $selectstatus3 = "";
                }
                elseif ($st_pemb == 2){
                    $selectstatus1 = "";
                    $selectstatus2 = "selected = true";
                    $selectstatus3 = "";
                }
                elseif ($st_pemb == 3){
                    $selectstatus1 = "";
                    $selectstatus2 = "";
                    $selectstatus3 = "selected = true";
                }
                echo '
                <form method="GET" action="">
                <th>
                <select id="'.$data->order_id.'" name="status_ord" class="form-control" onchange="changeStatus('.$data->order_id.')">
                    <option value="1"'.$selectstatus1.'>Order received</option>
                    <option value="2"'.$selectstatus2.'>Laundrying</option>
                    <option value="3"'.$selectstatus3.'>Order finished</option>
                </select>
                </form>
                </th>';
            }
            ?>
        </table>
        <script>
        console.log("testtest")
        function getXMLHTTPRequest() {
            if (window.XMLHttpRequest) {
                return new XMLHttpRequest();
            } else {
                return new ActiveXObject("Microsoft.XMLHTTP");
            }
        }

        function changeStatus(order_id) {
            console.log("clicked")
            document.getElementById("db_status").innerHTML = "connect to JS"
            var xmlhttp = getXMLHTTPRequest()
            var status = document.getElementById(order_id).value;
            var url = "ajax.php?order_id=" + order_id + "&status=" + status;
            var inner = "add_response";
            xmlhttp.open('GET', url, true);
            xmlhttp.onreadystatechange = function() {
                if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)) {
                    document.getElementById("db_status").innerHTML = xmlhttp.responseText;
                }
                return false;
            }
            xmlhttp.send(null);
        }
        </script>
    </div>
</div>


</body>



</html>