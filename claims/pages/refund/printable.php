<?php !isset($_GET['id']) ? header("location:javascript://history.go(-1)") : ''; ?>
<?php require '../../../model/Refund.php'; ?>
<?php require '../../../model/Department.php'; ?>
<?php require '../../../model/User.php'; ?>
<?php $header = $refund->fetch_by_criterial(array('id'=>$_GET['id']), 'refunds_header')[0];  ?>
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
    <h2>Refunds Voucher</h2>
    <hr>
</div>
<br>
<div class="row mt-3">
    <div class="col-md-12">
    <table id="zero_config" class="table table-striped table-bordered">
        <tr>
            <td>Refund ID</td>
            <td><?php echo isset($_GET['id']) ? $_GET['id'] : ""; ?></td>
            <td>Hospital Number:</td>
            <td><?php echo isset($header['hospital_no']) ? $header['hospital_no'] : ""; ?></td>
        </tr>
        <tr>
            <td>Initiated By:</td>
            <td><?php echo isset($header['enteredby']) ? $user->get_user_name_by_email($header['enteredby']) : "" ?></td>
            <td>Audited By:</td>
            <td><?php echo isset($header['auditedby']) ? $user->get_user_name_by_id($header['auditedby']) : ""; ?></td>
        </tr>
        <tr>
            <td>Patient Name:</td>
            <td><?php echo isset($header['patient_name']) ? $header['patient_name'] : ""; ?></td>
            <td>Account Name:</td>
            <td><?php echo isset($header['account_name']) ? $header['account_name'] : ""; ?></td>
        </tr>
        <tr>
            <td>Account Number:</td>
            <td><?php echo isset($header['account_number']) ? $header['account_number'] : ""; ?></td>
            <td>Approved By:</td>
            <td><?php echo isset($header['approvedby']) ? $user->get_user_name_by_id($header['approvedby']) : ""; ?></td>
        </tr>

        <tr>
            <td>Bank Name:</td>
            <td><?php echo isset($header['bank_name']) ? $header['bank_name'] : ""; ?></td>
            <td>Payment Status:</td>
            <td><?php echo isset($header['accountant_status']) && $header['accountant_status'] == 1 ? 'Approved' : "Pending"; ?></td>
            </tr>

        <tr>
            <td>Total Amount:</td>
            <td><?php echo isset($header['amount']) ? $header['amount'] : ""; ?></td>
           
        </tr>
      </table>
      <hr>
      <h4>Refund Break Down</h4></div><hr>
      <table class="table table-striped table-bordered">
          <thead>
            <tr>
                <th>S/N</th>
                <th>Description</th>
                <th>Amount</th>
            </tr>
          </thead>
          <tbody>
              <?php 
                $data = $refund->fetch_by_criterial(array('refund_id'=>$_GET['id']), 'refunds_detail');

                if(count($data) > 0) {  
                    $counter = 1; 
                    $total = 0;
                foreach($data as $dt){
                  $total += $dt['amount'];

                    ?>
                        <tr>
                          <td> <?php echo $counter ++; ?> </td>
                          <td><?php echo isset($dt['Description']) ? $dt['Description'] : ""; ?></td>
                          <td><?php echo isset($dt['amount']) ? $dt['amount'] : ""; ?></td>
                        
                        </tr>
              <?php } 
                if(isset($_SESSION['user']) && ($_SESSION['user'][0]['user_roleid'] == '1' || $_SESSION['user'][0]['user_roleid'] == '-1' || $_SESSION['user'][0]['user_roleid'] == '2')){
                    echo "<tr><td colspan='3' class='text-right'>Total:</td><td>#".$total."</td></tr>";
                }
                      
                } else { ?>
                  <tr>
                      <td colspan="4" class="text-center">No Record To Display</td>
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
                <td><?php echo (isset($header['approval']) && $header['approval'] == 1 ? "Approved": "Not yet Approved"); ?></td>
            </tr>
            <tr>
            <td>HOD Approval Status:</td>
            <td>
                <?php if(isset($header['hodrequired']) && $header['hodrequired'] == 1){
                    echo (isset($header['is_hod']) && $header['is_hod'] == 0 ? "Approved": "Not yet Approved"); 
                }else{
                    echo "Not Applicable";
                }
                ?>
            </td>
            </tr>

            <tr>
            <td>BCC Approval Status:</td>
            <td>
                <?php if(isset($header['bcc']) && $header['bcc'] != 0){
                    echo (isset($header['is_bcc']) && $header['is_bcc'] == 0 ? "Approved": "Not yet Approved"); 
                }else{
                    echo "Not Applicable";
                }
                ?>
            </td>
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