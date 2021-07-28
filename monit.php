<?php
require 'cisco.php';
require 'koneksi.php';
//username dan pasword telnet
$cisco->connect();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Halaman Monitoring</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>

<body>
    <div class="container">
        <form action="domonitacl.php" method="GET">
            <div style="width: 200px">
                <table class="table">
                    <tbody>
                        <tr class="col-sm">
                            <td>
                            <div class=" ">
								<?php
								$cisco->connect();
								$cisco->sh_acl('labjarkom');
								$cisco->close();
								?> 
							</div>
                            </td>
                        </tr>
                </table>
                <button type="submit " class="btn btn-primary">Monit</button>
                <a href="home.php" style="font-size: 13px" class="btn btn-danger text-white">Back</a>
            </div>
        </form>
    </div>
</body>

</html>