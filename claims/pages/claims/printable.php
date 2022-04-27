<?php !isset($_GET['id']) ? header("location:javascript://history.go(-1)") : ''; ?>
<?php require '../../../model/Claim.php'; ?>
<?php require '../../../model/Department.php'; ?>
<?php require '../../../model/User.php'; ?>
<?php $header = $claim->fetch_by_criterial(array('id'=>$_GET['id']), 'claims_header')[0]; ?>
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
    <!-- <h2>Claims Detail</h2> -->
    <h2>Claims Voucher</h2>
    
    <hr>
</div>
<br>
<div class="row mt-3">
    <div class="col-md-12">
        <table id="zero_config" class="table table-striped table-bordered">
          <tr>
              <td><strong>Claim ID</strong></td>
              <td><?php echo isset($_GET['id']) ? $_GET['id'] : ""; ?></td>
              <td><strong>Hospital Number:</strong></td>
              <td><?php echo isset($header['hospital_no']) && $header['hospital_no'] != NULL ? $header['hospital_no'] : "Not Applicable"; ?></td>
          </tr>
          <tr>
              <td><strong>Initiated By:</strong></td>
              <td><?php echo isset($header['Enteredby']) ? $user->get_user_name_by_email($header['Enteredby']) : "" ?></td>
              <td><strong>Audited By:</strong></td>
              <td><?php echo isset($header['Auditedby']) && !empty($header['Auditedby']) ? $user->get_user_name_by_id($header['Auditedby']) : ""; ?></td>
          </tr>
          <tr>
              <td><strong>Patient Name:</strong></td>
              <td><?php echo isset($header['Patient_name']) && $header['Patient_name'] != NULL  ? $header['Patient_name'] : "Not Applicable"; ?></td>
              <td><strong>Payee Name:</strong></td>
              <td><?php echo isset($header['Payee']) && $header['Payee'] != NULL ? $header['Payee'] : "Not Applicable"; ?></td>
          </tr>
          <tr>
                <td>Total Amount:</td>
                <td><?php echo isset($header['Amount']) ? $header['Amount'] : ""; ?></td>
                <td>Creation Date:</td>
                <td><?php echo isset($header['Created_date']) ? $header['Created_date'] : ""; ?></td>
            </tr>
            <tr>
                <td>Bank Name:</td>
                <td><?php echo isset($header['bank_name']) && $header['bank_name'] != NULL  ? $header['bank_name'] : "Not Applicable"; ?></td>
                <td>Account Name:</td>
                <td><?php echo isset($header['account_name']) && $header['account_name'] != NULL ? $header['account_name'] : "Not Applicable"; ?></td>
            </tr>
            <tr>
                <td>Account Number:</td>
                <td><?php echo isset($header['account_number']) && $header['account_number'] != NULL  ? $header['account_number'] : "Not Applicable"; ?></td>
                <td>Approved By:</td>
                <td> <?php echo isset($header['Approvedby']) && !empty($header['Approvedby']) ? $user->get_user_name_by_id($header['Approvedby']) : ""; ?></td>

            </tr>
        </table>
        <hr>
        <h4>Claims Break Down</h4></div><hr>
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
                  $data = $claim->fetch_by_criterial(array('claim_id'=>$_GET['id']), 'claims_detail');
                  if(count($data) > 0) {  
                      $counter = 1; 
                      $total = 0;
                  foreach($data as $dt){
                    $total += $dt['Amount'];
                      ?>
                          <tr>
                            <td> <?php echo $counter ++; ?> </td>
                            <td><?php echo isset($dt['Description']) ? $dt['Description'] : "----------"; ?></td>
                            <td><?php echo isset($dt['Amount']) ? $dt['Amount'] : ""; ?></td>
                          
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
                <td><strong>Audit Status:</strong></td>
                <td><?php echo (isset($header['audited']) && $header['audited'] == 1 ? "Audited": "Audited"); ?></td>
            </tr>
            <tr>
                <td><strong>Approval Status:</strong></td>
                <td><?php echo (isset($header['approved']) && $header['approved'] == 1 ? "Approved": "Approved"); ?></td>
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