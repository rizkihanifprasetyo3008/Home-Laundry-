<?php

$db_host = "sql204.epizy.com";
$db_user = "epiz_32723533";
$db_pass = "YZTApYhz6e";
$db_name = "epiz_32723533_homelaundry";

try {    
    //create PDO connection 
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
} catch(PDOException $e) {
    //show error
    die("Terjadi masalah: " . $e->getMessage());
}