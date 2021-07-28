<!DOCTYPE html>
<html>

<head>
    <title>Create ACL</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
</head>

<body>
    <div class="container">
        <form action="test.php" method="POST">
            <table id="myTable" class=" table order-list">
                <thead>
                    <tr>
                        <td>Nama ACL (Without Space)</td>
                    </tr>
                    <tr>
                        <td class="col-sm-3">
                            <input type="text" class="form-control " name="nama_acl" placeholder="Nama ACL" maxlength="20">

                        </td>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <td>Kondisi</td>
                        <td>Kategori</td>
                        <td>IPV4</td>
                        <td>Wildcard Mask</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col-sm-3">
                            <select name="kondisi[]">
                                <option value="permit">Permit</option>
                                <option value="deny">Deny</option>
                            </select>
                        </td>
                        <td class="col-sm-3">
                            <select id="inputhost" name="host[]">
                                <option value="network">Network</option>
                                <option value="host">Host</option>
                                <option value="any">Any</option>
                            </select>
                        </td>
                        <td class="col-sm-3">
                            <input id="ip" type="text" class="form-control " name="ipv4[]" placeholder="IP Address v4" maxlength="20">
                        </td>
                        <td class="col-sm-3">
                            <input id="wildcard" type="text" class="form-control " name="wildcard[]" placeholder="Wildcard Mask" maxlength="20">
                        </td>
                        <td class="col-sm-2"><a class="deleteRow"></a>

                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" style="text-align: left;">
                            <input type="button" class="btn btn-lg btn-block " id="addrow" value="Add Row" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" style="text-align: left;">
                            <input type="submit" class="btn btn-lg btn-block " id="addrow" onclick="ValidateIPaddress(document.form1.ip_address)" value="Submit" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" style="text-align: left;">
                            <a href="home.php" style="font-size: 13px" class="btn btn-danger text-white">Back</a>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#inputhost').on('change', function() {
            
                if (this.value == 'any') {
                    $("#wildcard").attr('readonly', true);
                    $("#ip").attr('readonly', true);
                } else if (this.value == 'host') {
                    $("#wildcard").attr('readonly', true);
                    $("#ip").removeAttr('readonly', true);
                } else {
                    $("#wildcard").removeAttr('readonly', true);
                    $("#ip").removeAttr('readonly', true);
                }

            });;
            var counter = 0;

            $("#addrow").on("click", function() {
                var newRow = $("<tr>");
                var cols = "";

                cols += '<td> <select name="kondisi[]"> <option value="permit">Permit</option> <option value="deny">Deny</option>  </select></td>';
                cols += '<td><select name="host[]"><option value="host">Host</option> <option value="network">Network</option> <option value="any">Any</option></select></td>';
                cols += ' <td class="col-sm-3"><input type="text" class="form-control " name="ipv4[]" placeholder="IP Address v4" maxlength="20"></td>';
                cols += ' <td class="col-sm-3"><input type="text" class="form-control " name="wildcard[]" placeholder="Wildcard Mask" maxlength="20"></td>';

                cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>';

                newRow.append(cols);
                $("table.order-list").append(newRow);
                counter++;
            });
            $("table.order-list").on("click", ".ibtnDel", function(event) {
                $(this).closest("tr").remove();
                counter -= 1
            });
        });

        function calculateRow(row) {
            var price = +row.find('input[name^="price"]').val();

        }

        function calculateGrandTotal() {
            var grandTotal = 0;
            $("table.order-list").find('input[name^="price"]').each(function() {
                grandTotal += +$(this).val();
            });
            $("#grandtotal").text(grandTotal.toFixed(2));
        }
    </script>
</body>

</html>