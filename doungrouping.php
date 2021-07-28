<?php

require 'db.php';
global $con;

require 'cisco.php';
require 'koneksi.php';
//username dan pasword telnet
$cisco->connect();

$id = $_POST["id"];

$query = mysqli_query($con, "SELECT * FROM `list_grouping` where id = '" . $id . "'");

$row = mysqli_fetch_assoc($query);
$id = $row["id"];
$name = $row["nama"];
$port =  $row["port"];
$direction = $row["direction"];
 

$ungrouping  = $cisco->ungrouping_acl('labjarkom', $port, $name, $direction);
if ($ungrouping == true) {
    $query = mysqli_query($con, "DELETE FROM `list_grouping` WHERE id = '" . $id . "'  ");
    if ($query) {
        header('Location: ungrouping.php');
    } else {
        echo ("Error description: " . mysqli_error($con));
    }
} else {
    echo "gagal";
}
