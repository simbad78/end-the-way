<?php

require 'cisco.php';
require 'koneksi.php';
//username dan pasword telnet
$cisco->connect();

$listAcl = $cisco->get_list_acl('labjarkom');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Halaman Delete</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>Delete ACL</h1>
        <form action="dodelete.php" method="POST">
            <div style="width: 200px">
                <table class="table">
                    <tbody>
                        <tr class="col-sm">
                            <td>
                                <div class="form-group">
                                    <label>ACL Name</label>
                                    <select name="name" class="form-control" id="exampleFormControlSelect1">
                                        <?php foreach ($listAcl as $list) : ?>
                                            <option><?php echo $list ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </td>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="home.php" style="font-size: 13px" class="btn btn-danger text-white">Back</a>
            </div>
        </form>

    </div>
</body>

</html>