 

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <title>Halaman Ungrouping</title>
     <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
     <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
     <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
 </head>

 <body>
     <div class="container">
         <h1>Ungrouping</h1>
         <form action="doungrouping.php" method="POST">
             <div style="width: 300px">
                 <table class="table">
                     <tbody>
                         <tr class="col-sm">
                             <td>
                                 <div>
                                     <label>Port</label>
                                     <select id="port" class="form-control selectpicker" name="port">
                                         <option selected="selected" disabled="disabled">pilih port</option>
                                         <?php
                                            for ($a = 0; $a < 2; $a++) {
                                                echo "<option value='Fa0/$a'>Fa 0/$a </option>";
                                            }
                                            ?>
                                     </select>
                                 </div>
                             </td>
                             <td>
                                 <div class="form-group">
                                     <label>Direction</label>
                                     <select name="direction" class="form-control" id="direction">
                                         <option value="in">In</option>
                                         <option value="out">Out</option>
                                     </select>
                                 </div>
                             </td>

                         </tr>
                         <tr class="col-sm">


                             <td>
                                 <div class="form-group">
                                     <label>ACL Name</label>
                                     <select name="id" class="form-control" id="litacl">

                                     </select>
                                 </div>
                             </td>
                         </tr>
                     </tbody>

                 </table>
                 <button type="submit " class="btn btn-primary">Ungrouping</button>
                 <a href="home.php" style="font-size: 13px" class="btn btn-danger text-white">Back</a>
             </div>
         </form>

     </div>
     <script>
         $(document).ready(function() {
             $('#port').on('change', function() {
                 //alert($('#direction').val());
                 $.ajax({
                     url: "get_group.php",
                     method: "GET",
                     data: {
                         port: this.value,
                         direction: $('#direction').val()
                     },
                     success: function(result) {
                         //alert(result);
                         $('#litacl').html(result);
                     }
                 });
             });

             $('#direction').on('change', function() {
                 //alert($('#direction').val());
                 $.ajax({
                     url: "get_group.php",
                     method: "GET",
                     data: {
                         port: $('#port').val(),
                         direction: this.value
                     },
                     success: function(result) {
                         //alert(result);
                         $('#litacl').html(result);
                     }
                 });
             });
         });
     </script>
 </body>

 </html>