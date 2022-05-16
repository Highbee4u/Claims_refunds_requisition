<?php !isset($_GET['id']) ? header("location:javascript://history.go(-1)") : ''; ?>
<?php  require '../includes/header.php';   ?>
<?php require '../../../model/Claim.php'; ?>
<?php require '../../../model/Department.php'; ?>
<?php require '../includes/menu.php'; ?>
<?php $header = $claim->fetch_by_criterial(array('id'=>$_GET['id']), 'claims_header')[0]; ?>

<!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                    Claims Detail For Claim ID: <b><?php echo isset($_GET['id']) ? $_GET['id'] : ""; ?></b>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Claims</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    
                    <div class="col-12">
                        <div class="card">
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                
                                    <table id="zero_config" class="table table-striped table-bordered">
                                      <tr>
                                          <td>Claim ID</td>
                                          <td><?php echo isset($_GET['id']) ? $_GET['id'] : ""; ?></td>
                                          <td>Staff Number:</td>
                                          <td><?php echo isset($header['hospital_no']) ? $header['hospital_no'] : ""; ?></td>
                                      </tr>
                                      <tr>
                                          <td>Initiated By:</td>
                                          <td><?php echo isset($header['Enteredby']) ? $user->get_user_name_by_email($header['Enteredby']) : "" ?></td>
                                          <td>Audited By:</td>
                                          <td><?php echo isset($header['Auditedby']) ? $user->get_user_name_by_id($header['Auditedby']) : ""; ?></td>
                                      </tr>
                                      <tr>
                                          
                                          <td>Payee Name:</td>
                                          <td><?php echo isset($header['Payee']) ? $header['Payee'] : ""; ?></td>

                                          <td>Bank Name:</td>
                                            <td><?php echo isset($header['bank_name']) && $header['bank_name'] != NULL  ? $header['bank_name'] : "Not Applicable"; ?></td>
                                      </tr>

                                      <tr>
                                          
                                            <td>Account Name:</td>
                                            <td><?php echo isset($header['account_name']) && $header['account_name'] != NULL ? $header['account_name'] : "Not Applicable"; ?></td>

                                            <td>Account Number:</td>
                                            <td><?php echo isset($header['account_number']) && $header['account_number'] != NULL  ? $header['account_number'] : "Not Applicable"; ?></td>
                                        </tr>
                                        <tr>
                                           
                                            <td>Approved By:</td>
                                            <td> <?php echo isset($header['Approvedby']) && !empty($header['Approvedby']) ? $user->get_user_name_by_id($header['Approvedby']) : ""; ?></td>

                                            <td>Creation Date:</td>
                                          <td><?php echo isset($header['Created_date']) ? $header['Created_date'] : ""; ?></td>

                                        </tr>
                                    
                                      <tr>
                                          <td>Total Amount:</td>
                                          <td><?php echo isset($header['Amount']) ? "#".number_format($header['Amount'],2,'.',',')  : ""; ?></td>
                                         
                                      </tr>
                                      <tr>
                                        <td>Category</td>
                                        <td colspan="3"><?php echo isset($header['claim_categoryid']) ? $claim->get_category_name_by_id($header['claim_categoryid']) : ""; ?></td>
                                      </tr>
                                    </table>
                                    <hr>
                                    <h4>Claims Break Down</h4></div><hr>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                          <tr>
                                              <th>&nbsp;</th>
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
                                                        <?php if($header['Audited'] == 1 || $header['Approved'] == 1){ ?>
                                                          <td>&nbsp;</td>
                                                        <?php }else{ ?>
                                                        <td>
                                                          <?php if($header['approvalRequest'] == 1) { ?>
                                                            &nbsp;
                                                          <?php } else { ?>
                                                              <a onclick = "deletedetail('<?php echo $dt['id']; ?>', '<?php echo $_GET['id']; ?>')"><i class="fa fa-trash"></i></a> | <a  onclick = "get_edit_modal('<?php echo $dt['id']; ?>')" ><i class="fa fa-edit"></i></a>
                                                          <?php } ?>
                                                        </td>
                                                        <?php } ?>
                                                        <td> <?php echo $counter ++; ?> </td>
                                                        <td><?php echo isset($dt['Description']) ? $dt['Description'] : ""; ?></td>
                                                        <td><?php echo isset($dt['Amount']) ? "#".number_format($dt['Amount'],2,'.',',') : ""; ?></td>
                                                      
                                                      </tr>
                                            <?php } 
                                              if(isset($_SESSION['user']) && ($_SESSION['user'][0]['user_roleid'] == '1' || $_SESSION['user'][0]['user_roleid'] == '-1' || $_SESSION['user'][0]['user_roleid'] == '2')){
                                                  echo "<tr><td colspan='3' class='text-right'>Total:</td><td>#".number_format($total,2,'.',',')."</td></tr>";
                                              }
                                                    
                                              } else { ?>
                                                <tr>
                                                    <td colspan="4" class="text-center">No Record To Display</td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <div>
                                      <?php if((!empty($header))  && ( $header['Audited'] == 1 || $header['Approved'] == 1)) { ?>
                                          <span class="btn btn-success dissabled">Approved</span>
                                      <?php } else if ((!empty($header))  && $header['approvalRequest'] != 1){ ?>
                                          <button class="btn btn-primary" onclick="get_modal()">New</button>
                                          <a class="btn btn-success" onclick="approval_request('<?php echo isset($header['id']) ? $header['id'] : '' ?>')">Request Approval</a>
                                      <?php } ?>

                                      <?php if(isset($_SESSION['user']) && $user->canAudit($_SESSION['user'][0]['id']) && $header['approvalRequest'] == 1 && $header['Audited'] == 0 ) {?>
                                              <a class="btn btn-success" onclick="audit('<?php echo isset($header['id']) ? $header['id'] : '' ?>')">Audit</a>
                                              <button class="btn btn-danger" onclick="get_return_modal('<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>')">Return</button>
                                      <?php } ?>
                                      <?php if(isset($_SESSION['user']) && $user->canApprove($_SESSION['user'][0]['id'])  && $header['approvalRequest'] == 1 && $header['Approved'] == 0) {?>
                                              <a class="btn btn-success" onclick="approve('<?php echo isset($header['id']) ? $header['id'] : '' ?>')">Approve</a>
                                              <button class="btn btn-danger" onclick="get_return_modal('<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>')">Return</button>

                                      <?php } ?>                                    
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->


<?php  require '../includes/footer.php'; ?>
