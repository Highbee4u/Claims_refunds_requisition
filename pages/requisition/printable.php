<?php !isset($_GET['id']) ? header("location:javascript://history.go(-1)") : ''; ?>
<?php require '../../model/Requisition.php'; ?>
<?php require '../../model/Item.php'; ?>
<?php require '../../model/User.php'; ?>
<?php require '../../model/Department.php'; ?>

<?php $header = $req->fetch_by_criterial(array('reqnumber'=>$_GET['id']))[0]; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0-11/css/all.min.css">
<title>Title</title>
</head>
<body>
<div class="text-center">
    <h1>ISALU HOSPITAL</h1>
    <hr>
    <h2>Requisition Detail</h2>
    <hr>
</div>
<br>
<div class="row mt-3">
    <div class="col-md-12">
            <table class="table table-inbox table-hover">
                <tr>
                    <td>Requisition ID</td>
                    <td><?php echo isset($_GET['id']) ? $_GET['id'] : ""; ?></td>
                    <td>Requisition Date:</td>
                    <td><?php echo isset($header['reqdate']) ? $header['reqdate'] : ""; ?></td>
                </tr>
                <tr>
                    <td>Audited By:</td>
                    <td><?php echo isset($header['auditedby']) ? $user->get_user_name_by_id($header['auditedby']) : ""; ?></td>
                    <td>Approved By:</td>
                    <td><?php echo isset($header['approvedby']) ? $user->get_user_name_by_id($header['approvedby']) : ""; ?></td>
                </tr>
                <tr>
                    <td>Department:</td>
                    <td><?php echo isset($header['departmentid']) && $header['departmentid'] != 0 ? $department->get_depart_name_by_id($header['departmentid']) : ""; ?></td>
                    <td>Description:</td>
                    

                    <td><?php echo isset($header['description']) ? $header['description'] : ""; ?></td>

                </tr>
                <tr>
                    <td>Requisited By:</td>
                    <td colspan="3"><?php echo isset($header['reqby']) ? $user->get_user_name_by_email($header['reqby']) : "" ?></td>
                </tr>
                
            </table>

    </div>
    <br>
    
    <div class="col-md-12">
        <hr>
            <div class="mt-5"><h4  class="gen-case">Item Details</h4></div>
        <hr>
    </div>
    <div class="col-md-12">
        <table class="table table-inbox table-hover">
            <thead>
            <tr>
                <th>S/N</th>
                <th>Item Name</th>
                <th>UOM</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Sub total</th>
            </tr>
            </thead>
            <tbody>
                <?php 
                $data = $req->fetch_detail_by_criterial(array('reqnumber'=>$_GET['id']));
                if(count($data) > 0) {  
                    $counter = 1; 
                foreach($data as $dt){
                ?>
                    <td> <?php echo $counter ++; ?> </td>
                    <td><?php echo isset($dt['itemid']) ? $item->get_item_name_by_id($dt['itemid']) : ""; ?></td>
                    <td><?php echo isset($dt['uom']) ? $dt['uom'] : ""; ?></td>
                    <td><?php echo isset($dt['price']) ? $dt['price'] : ""; ?></td>
                    <td><?php echo isset($dt['qty']) ? $dt['qty'] : ""; ?></td>
                    <td><?php echo isset($dt['qty'], $dt['price']) ? ($dt['qty'] * $dt['price']) : 00; ?></td>
                    </tr>
                <?php } 
                    echo isset($_GET['id']) ? "<tr><td colspan='6' class='text-right'><b>Total: </b></td><td>#".$req->get_header_sum($_GET['id'])."</td></tr>" : "" ;
                    } else { ?>
                    <tr>
                        <td colspan="7" class="text-center">No Record To Display</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
   
    <div class="col-md-12 mt-5">
        <table class="table table-bordered">
            <tr>
                <td>Audit Status:</td>
                <td><?php echo (isset($header['audited']) && $header['audited'] == 1 ? "Audited": "Not yet Audited"); ?></td>
            </tr>
            <tr>
                <td>Approval Status:</td>
                <td><?php echo (isset($header['approved']) && $header['approved'] == 1 ? "Approve": "Not yet Approved"); ?></td>
            </tr>
        </table>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        window.print();
    });
</script>
</body>
</html>