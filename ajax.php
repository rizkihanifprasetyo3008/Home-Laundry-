<?php
    $conn = mysqli_connect("sql204.epizy.com", "epiz_32723533", "YZTApYhz6e", "epiz_32723533_homelaundry");
    $order_id = $_GET['order_id'];
	$status = $_GET['status'];
    $params = array(
        ":status" => $status,
        ":order_id" => $order_id,
      );
	//Asign a query
    $saved = false;
	$query = "UPDATE orderlaundry SET status=".$status." WHERE order_id=".$order_id;
    $connect = mysqli_query($conn, $query);

    if ($connect){
        echo "<p>UPDATE SUCCESSFUL </p>";
    }
    else{
        echo $order_id.' '.$status;
    }

?>