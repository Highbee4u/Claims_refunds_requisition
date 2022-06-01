<?php require '../includes/header.php';   ?>

<?php require_once '../../../model/Claim.php'; ?>
<?php require '../../../model/Department.php'; ?>
<?php require '../../../model/User.php'; ?>
<?php $userslist = $user->fetch_all(); ?>

        <!-- ============================================================== -->
        <?php require '../includes/menu.php'; ?>
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
                        <h4 class="page-title">Claims History List(s)</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Claims</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">History</li>
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
                    <div class="col-md-12">
                      <div class="card">
                          <di class="card-header">Filters</di>
                          <div class="card-body">
                              <form method="post" id="frmfilter" onsubmit="return false">
                                  <div class="form-group">
                                      <label for="">User</label>
                                      <select name="filter" id="filter" class="form-control" onchange="myfilter(this.value)">
                                          <option value="">Select User..</option>
                                          <?php foreach($userslist as $users){ ?>
                                              <option value="<?php echo $users['email']; ?>"><?php echo $users['name']; ?></option>
                                          <?php } ?>
                                      </select>
                                      <span id="filtererror"></span>
                                  </div>
                                  <div class="form-group d-flex justify-content-between">
                                      <button type="submit" class="btn btn-primary btn-sm" onclick="clear_filter()">Clear Filter</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>&nbsp;</th>
                                                <th>Claim. No</th>
                                                <th>Initiated. By</th>
                                                <th>Staff. No</th>
                                                <th>Category</th>
                                                <th>Payee Name</th>
                                                <th>Amount</th>
                                                <th>HR Status</th>
                                                <th>Auditor Status</th>
                                                <th>MD Status</th>
                                               
                                                <th>Paymt. Status</th>
                                                <?php  if($user->is_accountant($_SESSION['user'][0]['id'])) { ?>
                                                <th>Paymt. Proc. Status</th>
                                                <?php } ?>
                                                <th>Paymt. Date</th>
                                                <th> Created Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                if(isset($_GET['filter']) && !empty($_GET['filter'])){
                                                        $data = $claim->fetch_by_criterial(array('Approved'=> 1, 'Audited'=> 1, 'Enteredby'=>$_GET['filter']), 'claims_header');
                                                } else{
                                                    $data = $claim->fetch_by_criterial(array('Approved'=> 1, 'Audited'=> 1), 'claims_header');
                                                }
                                            ?>
                                            <?php if(count($data) > 0) {  ?> 
                                                <?php foreach($data as $dt){  ?>
                                    <tr>
                                        <td>
                                            <a href="view.php?id=<?php echo $dt['id']; ?>"><i class="fa fa-eye"></i></i></a>
                                            <a href="printable.php?id=<?php echo $dt['id']; ?>"><i class="fa fa-print"></i></a>
                                        </td>
                                        <td><?php echo $dt['id']; ?></td>
                                        <td><?php echo isset($dt['Enteredby']) ? $user->get_user_name_by_email($dt['Enteredby']) : ""; ?></td>
                                        <td><?php echo isset($dt['hospital_no']) && $dt['hospital_no'] != '0' ? $dt['hospital_no'] : "---"; ?></td>
                                        <td><?php echo isset($dt['claim_categoryid']) ? $claim->get_category_name_by_id($dt['claim_categoryid']) : ""; ?></td>
                                        <td><?php echo isset($dt['Payee']) && $dt['Payee'] !="" ? $dt['Payee'] : "------------"; ?></td>

                                        <td><?php echo isset($dt['Amount']) && $dt['Amount'] !="" ? $dt['Amount'] : "--------------"; ?></td>
                                        <td>
                                            <?php if($dt['hrrequired'] == 1){ ?>
                                                <?php if($dt['hrstatus'] == 1) {?>
                                                    <span class="bg-success" style = "color: white">Approved</span><br><?php echo $dt['hrapproveddate']; ?>
                                                <?php } else { ?>
                                                    <span class="bg-danger" style="color: white">Pending</span>
                                                <?php } ?>
                                            <?php }  else { ?>
                                                <span class="bg-danger" style ="color: white"">NOT Applicable</span>
                                            <?php } ?>          

                                        </td>        

                                        <td>
                                            <?php  if($dt['Audited'] == 0 ){ 
                                                echo '<span class="bg-danger" style = "color: white">Pending</span>'; 
                                            } else { 
                                                echo '<span class="bg-success" style = "color: white">Approved</span><br>'.$dt['auditeddate']; 
                                            } ?>
                                        </td>
                                        <td>
                                            <?php  if($dt['Approved'] == 0){ 
                                                echo '<span class="bg-danger" style = "color: white">Pending</span>'; 
                                            } else if($dt['Approved'] == 1 ){ 
                                            echo '<span class="bg-success" style = "color: white">Approved</span><br>'.$dt['Approveddate'];  
                                            } ?>
                                        </td>
                                        
                                       
                                        <td>
                                            <?php if($dt['Accounting_status'] == 0){ ?>
                                                <?php if($user->is_accountant($_SESSION['user'][0]['id'])) { ?>
                                                    <button class="btn btn-xs btn-primary" onclick="update_payment_status('<?php echo $dt['id'] ?>','<?php echo isset($_SESSION['user']) ? $_SESSION['user'][0]['id'] : '' ; ?>')">Update</button>
                                                <?php } else { 
                                                    echo '<span class="bg-danger" style = "color: white">Pending</span>'; 
                                                } ?> 
                                                        
                                            <?php } else if($dt['Accounting_status'] == 1 ){ 
                                                
                                                if(isset($dt['paidby']) && $dt['paidby'] != NULL){
                                                    echo '<span class="bg-success" style = "color: white">Paid</span><br> By: '.$user->get_user_name_by_id($dt['paidby']);
                                                }else{
                                                    echo '<span class="bg-success" style = "color: white">Paid</span>';
                                                }     
                                            } ?>
                                        </td>

                                            <?php if($user->is_accountant($_SESSION['user'][0]['id'])) { ?>
                                                <td>
                                                    <?php if($dt['payment_process_status'] == 0){ ?>
                                                        <button class="btn btn-xs btn-primary" onclick="update_payment_process_status('<?php echo $dt['id'] ?>')">Update</button>
                                                    <?php } else { 
                                                            echo 'Processed'; 
                                                    } ?>
                                                </td>
                                            <?php } ?>
                                        <td>
                                            <?php if($dt['payment_date'] == "0000-00-00" || $dt['payment_date'] == NULL){ 
                                                    echo ' -------- '; 
                                            } else if($dt['payment_date'] != "0000-00-00" ){ 
                                                    echo $dt['payment_date']; 
                                            } ?>
                                        </td>
                                        <td><?php echo isset($dt['Created_date']) ? $dt['Created_date'] : "" ?></td>
                                    </tr>
                                <?php } ?>
                                            <?php } else { ?>
                                                <tr>
                                                    <td colspan="10" class="text-center">No Record To Display</td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
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
<script>

    let base_url = "http://localhost/requisitionclaims/claims/pages/claims/history.php";

    function myfilter(param){
            if(param.length != ""){
                window.location.href = base_url + "?filter="+param;
            }
      }

    function clear_filter(){
        window.location.href = base_url;
    }

    function update_payment_status(id, userid){
      if(id.length != ""){
          if(confirm("Are you sure you have made payment!?\r\n this cannot be Reverse")){
            $.ajax({
                url: "../../../library/request.php?action=updatereclaimpaymentstatus",
                type: 'POST',
                data: {"id":id, "userid":userid},
                dataType: 'JSON',
                success:function(data){
                    if(data == 1){
                        alert("Payment Status Updated Successfully");
                        window.location.reload();
                    }else{
                        alert("Unable to update status, try later");
                    }
                    
                }, 
                error: function(error){
                    console.log(error);
                }
            })
          }
      }
    }
    function update_payment_process_status(id){
      if(id.length != ""){
          if(confirm("Are you sure you have processed this payment!?\r\n this cannot be Reverse")){
            $.ajax({
                url: "../../../library/request.php?action=updatereclaimpaymentprocessstatus",
                type: 'POST',
                data: {"id":id},
                dataType: 'JSON',
                success:function(data){
                    if(data == 1){
                        alert("Payment Marked as Processed");
                        window.location.reload();
                    }else{
                        alert("Unable to update status, try later");
                    }
                    
                }, 
                error: function(error){
                    console.log(error);
                }
            })
          }
      }
    }



</script>