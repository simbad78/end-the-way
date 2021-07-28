<?php 
    require 'cisco.php';
    require 'koneksi.php';
    //username dan pasword telnet
    $cisco->connect();

    $name = $_POST['name'];
    
    $delete  = $cisco->del_acl('labjarkom', $name);
    if ($delete == true) {
        header('Location: delete.php');
    } else {
        echo "gagal";
    }
?>