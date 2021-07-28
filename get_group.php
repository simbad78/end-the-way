<?php

require 'db.php';
global $con;



$where = '';
if (isset($_GET["port"])) {
    $where .= "port = '" . $_GET["port"] . "'";
}
if (isset($_GET["direction"])) {
    $where .= "AND direction = '" . $_GET["direction"] . "'";
}
$query = mysqli_query($con, "SELECT * FROM `list_grouping` where " . $where . "");

$result = '';
while ($row = mysqli_fetch_assoc($query)) {
    $result .= '<option value="' . $row["id"] . '">' . $row["nama"] . '</option>';
}
echo $result;
