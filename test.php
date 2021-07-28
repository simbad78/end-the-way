<?php 

require 'cisco.php';
require 'koneksi.php';
//username dan pasword telnet
$cisco->connect();
$password1 = 'labjarkom';

$name = $_POST["nama_acl"];
$kondisi = $_POST["kondisi"];
$host = $_POST["host"];
$ip = $_POST["ipv4"];
$wildcard = $_POST["wildcard"];
//print_r($kondisi);die();
$comand = '';

foreach($kondisi as $key => $knds){
   //echo $password1.$name. $knds.' '.$host[$key].' '.$ip[$key].' '.$wildcard[$key].'</br>';
    
    $cisco->create_acl($password1,$name,$host[$key],$knds, $ip[$key], $wildcard[$key]);
}

header('Location: home.php');
/*$datas = array(
    "nama" => $name,
    "kondisi" => $kondisi,
    "host" => $host,
    "ipv" => $ip,
    "wildcard" => $wildcard
);*/

?>

