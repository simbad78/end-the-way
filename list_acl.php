<?php

require 'cisco.php';
require 'koneksi.php';
//username dan pasword telnet
$cisco->connect();

$listAcl = $cisco->get_list_acl('labjarkom');
    print_r($listAcl);

?>