<?php  require '../includes/header.php';   ?>
<?php require '../../../model/Claim.php'; ?>
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
                        <h4 class="page-title">Claim Awaiting Approval</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Claim</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Awaiting Approval</li>
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
                                            <th>Claim. No</th>
                                            <th>Initiated. By</th>
                                            <th>Claim Type</th>
                                            <th>Amount</th>
                                            <th>Auditor Status</th>
                                            <th>MD Status</th>
                                            <th>Paymt. Status</th>
                                            <th>Date</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        // $data = $claim->fetch_by_criterial(array('approvalRequest'=> 1, 'audited'=> 0, 'Auditedby'=> $_SESSION['user'][0]['id']), 'claims_header');
                                        $data = $claim->fetch_by_criterial(array('approvalRequest'=> 1, 'audited'=> 0, 'hrrequired'=> 1, 'hrname'=> $_SESSION['user'][0]['id'], 'hrstatus'=> 0), 'claims_header');
                                        if(count($data) > 0) {   
                                        foreach($data as $dt){
                                        ?>
                                            <tr>
                                                <td>
                                                    <a href="claimsdetail.php?id=<?php echo $dt['id']; ?>"><i class="fa fa-eye"></i></i></a>
                                                    <a href="printable.php?id=<?php echo $dt['id']; ?>"><i class="fa fa-print"></i></a>
                                                </td>
                                                <td><?php echo $dt['id']; ?></td>
                                                <td><?php echo isset($dt['Enteredby']) ? $user->get_user_name_by_email($dt['Enteredby']) : ""; ?></td>
                                                <td><?php echo isset($dt['claimtype']) && $dt['claimtype'] != '0' ? $dt['claimtype'] : "---"; ?></td>
                                                <td><?php echo isset($dt['Amount']) && $dt['Amount'] !="" ? $dt['Amount'] : "--------------"; ?></td>
                                                <td><?php if($dt['Audited'] == 0 ){ 
                                                            echo '<span class="bg-danger" style = "color: white">Pending</span>'; 
                                                    } else { 
                                                    echo '<span class="bg-success" style = "color: white">Approved</span>'; 
                                                    } ?>
                                                </td>
                                                <td><?php if($dt['Approved'] == 0){ 
                                                            echo '<span class="bg-danger" style = "color: white">Pending</span>'; 
                                                    } else if($dt['Approved'] == 1 ){ 
                                                    echo '<span class="bg-success" style = "color: white">Approved</span>'; 
                                                    } ?>
                                                </td>
                                                <td><?php if($dt['Accounting_status'] == 0){ 
                                                            echo '<span class="bg-danger" style = "color: white">Pending</span>'; 
                                                    } else if($dt['Accounting_status'] == 1 ){ 
                                                    echo '<span class="bg-success" style = "color: white">Approved</span>'; 
                                                    } ?>
                                                </td>
                                                <td><?php echo isset($dt['Created_date']) ? $dt['Created_date'] : "" ?></td>
                                                </tr>
                                            <?php } } else { ?>
                                                <tr>
                                                    <td colspan="8" class="text-center">No Record To Display</td>
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
