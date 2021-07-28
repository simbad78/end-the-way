<?php

require 'db.php';
require 'cisco.php';
require 'koneksi.php';
//username dan pasword telnet
$cisco->connect();

global $con;

$port = $_POST["port"];
$name = $_POST["name"];
$direction = $_POST["direction"];



$grouping  = $cisco->grouping_acl('labjarkom', $port, $name, $direction);
if ($grouping == true) {
    $query = mysqli_query($con, "INSERT INTO `list_grouping`(  `nama`, `port`,`direction` ) VALUES ('" . $name . "','" . $port . "','" . $direction . "')");
    if ($query) {
        header('Location: grouping.php');
    } else {
        echo ("Error description: " . mysqli_error($con));
    }
} else {
    echo "gagal";
}
