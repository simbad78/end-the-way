<?php

require 'cisco.php';
require 'koneksi.php';
//username dan pasword telnet
$cisco->connect();

global $con;

$port = $_POST["port"];



$monit  = $cisco->sh_acl('labjarkom', $port);
if ($monit == true) {
    $query = mysqli_query($con, "INSERT INTO `list_grouping`(  `nama`, `port`,`direction` ) VALUES ('" . $name . "','" . $port . "','" . $direction . "')");
    if ($query) {
        header('Location: grouping.php');
    } else {
        echo ("Error description: " . mysqli_error($con));
    }
} else {
    echo "gagal";
}
