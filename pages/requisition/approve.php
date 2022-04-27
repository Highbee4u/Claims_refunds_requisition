<?php require '../includes/header.php'; ?>
<?php require '../../model/Requisition.php'; ?>
<?php require '../../model/Department.php'; ?>

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
                        <h4 class="page-title">Awaiting Approval Requisition</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Requisition</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Awaiting Approval List</li>
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
                                                <th>Comment</th>
                                                <th>Status</th>
                                                <th>Audited</th>
                                                <th>Approval Req.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $data = $req->fetch_by_criterial(array('approvalRequest'=> 1, 'audited'=> 1, 'approved'=> 0, 'approvedby'=>$_SESSION['user'][0]['id']));
                                            if(count($data) > 0) {   
                                            foreach($data as $dt){
                                            ?>
                                                <tr>
                                                <td>
                                                <?php echo ($dt['approvalRequest'] == 1  ? "<a href='detail.php?id=".$dt['reqnumber']."&rectype=".$dt['requisitiontype']."';><i class='fa fa-eye'></i></a>" : ''); ?> | <?php echo ($dt['approvalRequest'] == 1  ? "<a href='printable.php?id=".$dt['reqnumber']."'><i class='fa fa-print'></i></i></a>" : ''); ?>
                                                </td>
                                                <td><?php echo $dt['reqnumber']; ?></td>
                                                <td><?php echo $dt['reqby']; ?></td>
                                                <td><?php echo isset($dt['departmentid']) && $dt['departmentid'] != 0 ? $department->get_depart_name_by_id($dt['departmentid']) : ""; ?></td>
                                                <td><?php echo $dt['reqdate']; ?></td>
                                                <td><?php echo $dt['coment']; ?></td>
                                                <td><?php echo ($dt['approved'] == 1 ? 'Approved' : 'No Yet Approved'); ?></td>
                                                <td><?php echo ($dt['audited'] == 1 ? 'Audited' : 'No Yet Approved'); ?></td>
                                                <td><?php echo ($dt['approvalRequest'] == 1 ? 'Yes' : 'No'); ?></td>
                                                </tr>
                                            <?php } } else { ?>
                                                <tr>
                                                    <td colspan="7" class="text-center" >No Record To Display</td>
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