<?php  require '../includes/header.php';   ?>
<?php require '../../../model/Refund.php'; ?>
<?php require '../../../model/Department.php'; ?>
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
                        <h4 class="page-title">Refund Awaiting Audit</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Refund</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Awaiting Audit</li>
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
                                    <thead>
                                        <tr>
                                            <th>&nbsp;</th>
                                            <th>Refund. No</th>
                                            <th>Initiated. By</th>
                                            <th>Hospt. No</th>
                                            <th>Patient Name</th>
                                            <th>Account Name</th>
                                            <th>Account Number</th>
                                            <th>Amount</th>
                                            <th>Auditor Status</th>
                                            <th>MD Status</th>
                                            <th>Paymt. Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $data = $refund->fetch_by_criterial(array('approvalRequest'=> 1, 'is_hod'=> 0, 'is_bcc'=> 0, 'audited'=> 0), 'refunds_header');
                                        if(count($data) > 0) {   
                                        foreach($data as $dt){
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php if($dt['audited'] == 0) { ?>
                                                        <a href="detail.php?id=<?php echo $dt['id']; ?>"><i class="fa fa-eye"></i></i></a>
                                                    <?php } else{ ?>  
                                                        <a href="view.php?id=<?php echo $dt['id']; ?>"><i class="fa fa-eye"></i></i></a>
                                                    <?php }  ?>
                                                        <a href="printable.php?id=<?php echo $dt['id']; ?>"><i class="fa fa-print"></i></a>
                                                
                                                </td>
                                                <td><?php echo $dt['id']; ?></td>
                                                <td><?php echo isset($dt['enteredby']) ? $user->get_user_name_by_email($dt['enteredby']) : ""; ?></td>
                                                <td><?php echo isset($dt['hospital_no']) && $dt['hospital_no'] != '0' ? $dt['hospital_no'] : "---"; ?></td>
                                                <td><?php echo $dt['patient_name']; ?></td>
                                                <td><?php echo isset($dt['account_name']) && $dt['account_name'] !="" ? $dt['account_name'] : "--------------"; ?></td>
                                                <td><?php echo isset($dt['account_number']) && $dt['account_number'] !="" ? $dt['account_number'] : "--------------"; ?></td>
                                                <td><?php echo isset($dt['amount']) && $dt['amount'] !="" ? $dt['amount'] : "--------------"; ?></td>
                                                <td><?php if($dt['audited'] == 0 ){ 
                                                            echo '<span class="bg-danger" style = "color: white">Pending</span>'; 
                                                    } else { 
                                                    echo '<span class="bg-success" style = "color: white">Approved</span>'; 
                                                    } ?>
                                                </td>
                                                <td><?php if($dt['approval'] == 0){ 
                                                            echo '<span class="bg-danger" style = "color: white">Pending</span>'; 
                                                    } else if($dt['approval'] == 1 ){ 
                                                    echo '<span class="bg-success" style = "color: white">Approved</span>'; 
                                                    } ?>
                                                </td>
                                                <td><?php if($dt['accountant_status'] == 0){ 
                                                            echo '<span class="bg-danger" style = "color: white">Pending</span>'; 
                                                    } else if($dt['accountant_status'] == 1 ){ 
                                                    echo '<span class="bg-success" style = "color: white">Approved</span>'; 
                                                    } ?>
                                                </td>
                                                </tr>
                                            <?php } } else { ?>
                                                <tr>
                                                    <td colspan="11" class="text-center">No Record To Display</td>
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

           
<?php require '../includes/footer.php'; ?>