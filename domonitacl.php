<?php 
    require 'cisco.php';
    require 'koneksi.php';
    //username dan pasword telnet
    $cisco->connect();


    $shacl  = $cisco->sh_acl('labjarkom');
    if ($shacl == true) {
        header('Location: monitacl.php');
    } else {
        echo "gagal";
    }
?>