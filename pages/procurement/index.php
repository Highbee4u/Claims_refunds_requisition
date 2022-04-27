<?php  require '../includes/header.php'; ?>
<?php require '../../model/Requisition.php'; ?>
<?php require '../../model/Department.php'; ?>
<?php require '../includes/menu.php'; ?>

<div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title"> Requisition Waiting For Price</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Requisition</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Awaiting Price List</li>
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
                                                <th>Req. No</th>
                                                <th>Req. By</th>
                                                <th>Department</th>
                                                <th>Req. Date</th>
                                                <th>Return Comment</th>
                                                <th>Status</th>
                                                <th>Approval Req.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $data = $req->fetch_by_criterial(array("audited"=>0, "approved"=>0,  "awaiting_price"=> 1, "approvalRequest"=>1));
                                            if(count($data) > 0) {   
                                            foreach($data as $dt){
                                            ?>
                                                <tr>
                                                <td>
                                                    <a href="detail.php?id=<?php echo $dt['reqnumber']; ?>"><i class="fa fa-eye"></i></a>
                                                </td>
                                                <td><?php echo $dt['reqnumber']; ?></td>
                                                <td><?php echo isset($dt['reqby']) ? $user->get_user_name_by_email($dt['reqby']) : ""; ?></td>
                                                <td><?php echo isset($dt['departmentid']) ? $department->get_depart_name_by_id($dt['departmentid']) : ""; ?></td>
                                                <td><?php echo $dt['reqdate']; ?></td>
                                                <td><?php echo isset($dt['coment']) && $dt['coment'] !="" ? $dt['coment'] : "--------------"; ?></td>
                                                <td><?php if($dt['approved'] == 1){ echo '<span class="bg-success">Approved</span>'; } else if($dt['returned'] == 1){ echo '<span class="bg-danger" style = "color: white">Requisition returned</span>' ; } else { echo '<span class="bg-primary" style = "color: white">No Yet Approved</span>'; } ?></td>
                                                <td><?php echo ($dt['approvalRequest'] == 1 ? 'Yes' : 'No'); ?></td>
                                                </tr>
                                            <?php } } else { ?>
                                                <tr>
                                                    <td colspan="9" class="text-center">No Record To Display</td>
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
