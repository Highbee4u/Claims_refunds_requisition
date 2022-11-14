<?php !isset($_GET['id']) ? header("location:javascript://history.go(-1)") : ''; ?>
<?php  require '../includes/header.php';   ?>
<?php require '../../model/Consultant.php'; ?>
<?php require '../../model/Department.php'; ?>

        <!-- ============================================================== -->
        <?php require '../includes/menu.php'; ?>
<?php $header = $consultant->fetch_by_criterial(array('id'=>$_GET['id']), 'consultings_header')[0]; ?>

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
                    Consult Record Detail For Record ID: <b><?php echo isset($_GET['id']) ? $_GET['id'] : ""; ?></b>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Consult</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Record Detail</li>
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
                                          <td>Record ID</td>
                                          <td><?php echo isset($_GET['id']) ? $_GET['id'] : ""; ?></td>
                                          <td>Record Date:</td>
                                          <td><?php echo isset($header['Created_date']) ? $header['Created_date'] : ""; ?></td>
                                      </tr>
                                      <tr>
                                          <td>Category:</td>
                                          <td><?php echo isset($header['consulttype']) ? $consultant->get_category_name_by_id($header['consulttype']) : ""; ?></td>
                                          <td>Created By:</td>
                                          <td><?php echo isset($header['Enteredby']) ? $user->get_user_name_by_email($header['Enteredby']) : "" ?></td>
                                      </tr>
                                      <tr>
                                          <td>To be Audited By:</td>
                                          <td><?php echo isset($header['Auditedby']) ? $user->get_user_name_by_id($header['Auditedby']) : ""; ?></td>
                                          <td>To be Approved By:</td>
                                          <td><?php echo isset($header['Approvedby']) ? $user->get_user_name_by_id($header['Approvedby']) : ""; ?></td>
                                      </tr>
                                      <?php if(isset($header['returned']) && $header['returned'] == 1){ ?>
                                        <tr>
                                          <td>Status:</td>
                                          <td><?php echo isset($header['returned']) && $header['returned'] == 1 ? "<span class='bg-danger blink_text'>Returned</span><br><b>Returned On: </b>".(isset($header['returneddate']) ? $header['returneddate'] : "0000-00-00") : ""; ?></td>
                                          <td>Returned By:</td>
                                          <td><?php echo isset($header['returnedby']) ? $user->get_user_name_by_id($header['returnedby']) : ""; ?></td>
                                        </tr>
                                        <tr>
                                          <td>Return Comment:</td>
                                          <td colspan="3"><?php echo isset($header['comment']) ? $header['comment'] : ""; ?></td>
                                        </tr>
                                      <?php } ?>
                                    </table>
                                    <hr>
                                    <h4>Service Detail</h4></div><hr>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                          <tr>
                                              
                                              <th>S/N</th>
                                              <th>Patient Number</th>
                                              <th>Patient Name</th>
                                              <th>Amount</th>
                                              <th>Description</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $data = $consultant->fetch_detail_by_criterial(array('consult_id'=>$_GET['id']));
                                            if(count($data) > 0) {  
                                                $counter = 1; 
                                                $total = 0;
                                            foreach($data as $dt){
                                              $total += $dt['Amount'];
                                            ?>
                                                <tr>
                                                  
                                                <td> <?php echo $counter ++; ?> </td>
                                                <td><?php echo isset($dt['hospital_no']) ? $dt['hospital_no'] : ""; ?></td>
                                                <td><?php echo isset($dt['Patients_name']) ? $dt['Patients_name'] : ""; ?></td>
                                                <td><?php echo isset($dt['Amount']) ? $dt['Amount'] : ""; ?></td>
                                                <td><?php echo isset($dt['Description']) ? $dt['Description'] : ""; ?></td>
                                                </tr>
                                                <tr><td colspan='3' class='text-right'>Total:</td><td>#<?php echo $total ?></td></tr>
                                            <?php } 
                                              } else { ?>
                                                <tr>
                                                    <td colspan="7" class="text-center">No Record To Display</td>
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
