<?php 
include('_partials/head.php');
include('_partials/header.php');
require('cisco.php');
include('koneksi.php');
$cisco->connect();

?>

<!-- sweet alert 2 -->
  <link href="assets/css/sweetalert2.min.css" rel="stylesheet">
  <script src="assets/js/sweetalert2.min.js"></script>


<!--judul-->
<header class="masthead" >
  <div class="intro-text intro-lead-in">
    <div class="container ">
      <div class="row row justify-content-center gambar bg text-white"> 
        <div class="container pt-7" style="text-align: center; font-size: 45px; padding-top: 5px">
        <p style="font-size: 20px; padding-top: 10px"> Configuration </p>
        </div>
      </div>
    </div>

<div class="container">
  <div class="row justify-content-center">
    <div class="dropdown">
      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdown-menu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >INTERFACE</button>
        <div class="dropdown-menu dropdown-primary">
          <a class="dropdown-item" data-target="#modalCreateInterface" data-toggle="modal" href="#modalCreateInterface">CREATE INTERFACE</a>
          <a class="dropdown-item" data-target="#modalDeleteInterface" data-toggle="modal" href="#modalDeleteInterface">DELETE INTERFACE</a>
        </div>
    </div>
    
    <div class="dropdown">
      <button class="btn btn-primary dropdown-toggle ml-3" type="button" id="dropdown-menu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >ROUTING OSPF SINGLE AREA</button>
        <div class="dropdown-menu dropdown-primary">
          <a class="dropdown-item" data-target="#modalCreateRouting" data-toggle="modal" href="modalRoutingOspf">CREATE ROUTING OSPF SINGLE AREA</a>
          <a class="dropdown-item" data-target="#modalDeleteOspf" data-toggle="modal" href="modalDeleteOspf">DELETE OSPF</a>
          <a class="dropdown-item" data-target="#modalDeleteNetwork" data-toggle="modal" href="#modalDeleteNetwork">DELETE NETWORK OSPF</a>
        </div>
    </div>

<!--------------------CREATE INTERFACE---------------------->

    <div class="modal fade" id="modalCreateInterface" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
<!--             <h4 class="modal-title" id="exampleModalLabel">Create Interface</h4> -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <!--inputan-->
            <div class="row row justify-content-center panel-bg">
              <div class="col-md-10 pt-2 mt-1 pb-2">
                <form method="POST">
                  <input type="hidden" name="action" value="create_interface">
                  <div class="form-group-md" style="padding-top: 7px ">
                  <input type="text" id="ip" class="form-control" name="ip" placeholder="Name" maxlength="20">
                </div>
                <div class="form-group-md" style="padding-top: 7px ">
                  <input type="text" id="subnet" class="form-control" name="subnet" placeholder="Wildcard" maxlength="20">
                </div>
                <div>
                  <select class="form-control selectpicker" name="port" >
                  <option selected disabled>pilih port</option>
                  <?php
                  for ($a=0; $a<2; $a++) {
                  echo "<option value='Permit$a'>Deny$a </option>";
                  }
                  ?>
                  </select>
                </div>
                
                <div class="Submit" style="padding-top: 10px">
                  <button  style="font-size: 13px" name="submit" class="btn btn-primary" >Submit</button>
                </div>
                <?
                if ($port == ' ' && $ip == ' ' && $subnet == ' ') {
                   header('Location: config.php');
                } else {
                  echo "<script>
                  alert('success');
                  window.location.href='index.html';
                  </script>";
                }
                ?>
              </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php
if (isset($_POST['action'])) {
  if ($_POST['action'] == 'create_interface') {
      $port=($_POST['port']);
      $ip=($_POST['ip']);
      $subnet=($_POST['subnet']);
      $data = $cisco->create_interface($password1, $port, $ip, $subnet);
       echo ("<script>swal.fire('Success !');</script>");
  } else {
      echo ("<script>swal.fire('Oppss !,'error');</script>");

  }
}
?>


<!--------------------DELETE INTERFACE---------------------->

    <div class="modal fade" id="modalDeleteInterface" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
<!--             <h4 class="modal-title" id="exampleModalLabel">Create Interface</h4> -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <!--inputan-->
            <div class="row row justify-content-center panel-bg">
              <div class="col-md-10 pt-2 mt-1 pb-2">
                <form method="POST">
                  <input type="hidden" name="action_delete" value="delete_interface">
                <div>
                  <select class="form-control selectpicker" id="int_del" name="int_del" required>
                  <option selected disabled>pilih port</option>
                  <?php
                    for ($a=0; $a<2; $a++) {
                    echo "<option value='Fa0/$a'>Fa 0/$a </option>";
                    }
                  ?>
                  </select>
                <div class="Submit" style="padding-top: 10px">
                  <button  style="font-size: 13px" name="submit_delete" class="btn btn-primary" >Submit</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php
if (isset($_POST['submit_delete'])) {
  // if ($_POST['action_delete'] == 'delete_interface') {
      // $port_delete=$_POST['port_delete'];
      $int_del=$_POST['int_del'];
      $data = $cisco->interface_del($password1, $int_del);
      echo ("<script>swal.fire('Success !');</script>");
  } else {
      echo ("<script>swal.fire('Oppss !,'error');</script>");

  
}
?>

<!--------------------CREATE ROUTING OSPF---------------------->

  <div class="modal fade" id="modalCreateRouting" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <div class="row row justify-content-center panel-bg">
              <div class="col-md-10 pt-2 mt-1 pb-2">
                <form method="POST">
                  <input type="hidden" name="action" value="create_ospf">
                <div class="form-group-md" style="padding-top: 7px ">
                  <input type="text" id="ospf" class="form-control" name="ospf" placeholder="ospf" maxlength="20">
                </div>
                <div class="form-group-md" style="padding-top: 7px ">
                  <input type="text" id="network" class="form-control " name="network" placeholder="network address" maxlength="20">
                </div>
                <div class="form-group-md" style="padding-top: 7px ">
                  <input type="text" id="wildcard" class="form-control " name="wildcard" placeholder="wildcard mask" maxlength="20">
                </div>
                <div class="Submit" style="padding-top: 10px">
                  <button  style="font-size: 13px" name="submit" class="btn btn-primary" >Submit</button>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>

<?php
if (isset($_POST['action'])) {
  if ($_POST['action'] == 'create_ospf') {
      $ospf=($_POST['ospf']);
      $network=($_POST['network']);
      $wildcard=($_POST['wildcard']);
      $data = $cisco->create_ospf($password1, $ospf, $network, $wildcard);
      echo ("<script>swal.fire('Success !');</script>");
  } else {
      echo ("<script>swal.fire('Oppss !,'error');</script>");

  }
}
?>

<!--------------------DELETE ROUTING OSPF---------------------->

   <div class="modal fade" id="modalDeleteOspf" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <div class="row row justify-content-center panel-bg">
              <div class="col-md-10 pt-2 mt-1 pb-2">
                <form method="POST">
                  <input type="hidden" name="action" value="delete_ospf">
                    <div class="form-group-md" style="padding-top: 7px ">
                      <input type="text" id="ospf" class="form-control " name="ospf" placeholder="ospf" maxlength="20">
                    </div>
                    <div class="Submit" style="padding-top: 10px">
                      <button  style="font-size: 13px" name="submit" class="btn btn-primary" >Submit</button>
                    </div>
                </form>
              </div>
            </div>
        </div>
      </div>
    </div>

<?php
if (isset($_POST['action'])) {
  if ($_POST['action'] == 'delete_ospf') {
      $ospf=($_POST['ospf']);
      $data = $cisco->delete_ospf($password1, $ospf);
      echo ("<script>swal.fire('Success !');</script>");
  } else {
      echo ("<script>swal.fire('Oppss !,'error');</script>");

  }
}
?>

<!--------------------DELETE NETWORK OSPF---------------------->

    <div class="modal fade" id="modalDeleteNetwork" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="row row justify-content-center panel-bg">
            <div class="col-md-10 pt-2 mt-1 pb-2">
              <form method="POST">
                <input type="hidden" name="action" value="delete_network">
                <div class="form-group-md" style="padding-top: 7px ">
                  <input type="text" id="ospf" class="form-control " name="ospf" placeholder="ospf" maxlength="20">
                </div>
                <div class="form-group-md" style="padding-top: 7px ">
                   <input type="text" id="network" class="form-control " name="network" placeholder="network address" maxlength="20">
                </div>
                <div class="form-group-md" style="padding-top: 7px ">
                    <input type="text" id="wildcard" class="form-control " name="wildcard" placeholder="wildcard mask" maxlength="20">
                </div>
                <div class="Submit" style="padding-top: 10px">
                  <button  style="font-size: 13px" name="submit" class="btn btn-primary" >Submit</button>
                </div>                
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php
if (isset($_POST['action'])) {
  if ($_POST['action'] == 'delete_network') {
      $ospf=($_POST['ospf']);
      $network=($_POST['network']);
      $wildcard=($_POST['wildcard']);
      $data = $cisco->delete_network($password1, $ospf, $network, $wildcard);
       echo ("<script>swal.fire('Success !');</script>");
  } else {
      echo ("<script>swal.fire('Oppss !,'error');</script>");


  }
}
?>

<br>
<br>

</header>

<?php include('_partials/bottom.php') ;
$cisco->close();
// print_r($_POST);
?>


