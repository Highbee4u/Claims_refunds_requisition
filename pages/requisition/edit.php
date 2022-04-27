<?php !isset($_GET['id']) ? header("location:javascript://history.go(-1)") : ''; ?>
<?php require '../includes/header.php';   ?>
<?php require '../../model/Requisition.php'; ?>
<?php require '../../model/Item.php'; ?>
<?php require '../../model/Department.php'; ?>
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
                        View Requisition
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Requisition</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">View</li>
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
                                    <?php $header = $req->fetch_by_criterial(array('reqnumber'=> $_GET['id']))[0]; ?>
                                    <table id="zero_config" class="table table-striped table-bordered">
                                    <tr>
                                        <td>Req No.</td>
                                        <td><?php echo $header['reqnumber']; ?></td>
                                        <td>&nbsp;</td>
                                        <td>Req. by</td>
                                        <td><?php echo $header['reqby']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Req Date.</td>
                                        <td><?php echo $header['reqdate']; ?></td>
                                        <td>&nbsp;</td>
                                        <td>Status</td>
                                        <td><?php echo ($header['approved'] == 1 ? 'Approved' : 'No Yet Approved'); ?></td>
                                    </tr>
                                    <tr>
                                        <td>To be Approved By:</td>
                                        <td><?php echo $user->get_user_name_by_id($header['approvedby']); ?></td>
                                        <td>&nbsp;</td>
                                        <td>To be Audited By:</td>
                                        <td><?php echo $user->get_user_name_by_id($header['auditedby']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Department:</td>
                                        <td><?php echo isset($header['departmentid']) ? $department->get_depart_name_by_id($header['departmentid']) : ""; ?></td>
                                        <td>&nbsp;</td>
                                        <td>Description:</td>
                                        <td><?php echo isset($header['description']) ? $user->get_user_name_by_id($header['description']) : ""; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Description:</td>
                                        <td colspan ="4"><?php echo isset($header['description']) ? $header['description'] : ""; ?></td>
                                    </tr>
                                    </table>
                                    <hr>
                                    <h4>Requisition Details</h4></div><hr>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Req. No</th>
                                                <th>Item Name</th>
                                                <th>Qty</th>
                                                <th>UOM</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $data = $req->fetch_detail_by_criterial(array('reqnumber'=> $_GET['id']));
                                            if(count($data) > 0) {   
                                            foreach($data as $dt){
                                            ?>
                                                <tr>
                                                <td><?php echo $dt['reqnumber']; ?></td>
                                                <td><?php echo isset($dt['itemid']) ? $item->get_item_name_by_id($dt['itemid']) : ""; ?></td>
                                                <td><?php echo $dt['qty']; ?></td>
                                                <td><?php echo isset($dt['itemid']) ? $item->get_uom_by_item($dt['itemid']) : ""; ?></td>
                                                </tr>
                                            <?php } } else { ?>
                                                <tr>
                                                    <td colspan="7" class="text-center" >No Record To Display</td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <div>
                                        <?php if((!empty($header))  && ($header['approvalRequest'] == 1 || $header['audited'] == 1 || $header['approved'] == 1)) { ?>
                                            <span class="btn btn-success dissabled">Approval Requested</span>
                                        <?php } else  { ?>
                                            <button class="btn btn-primary" onclick="get_modal('<?php echo $_GET['rectype'] ?>')">New</button>
                                            <a class="btn btn-success" onclick="approval_request('<?php echo isset($header['reqnumber']) ? $header['reqnumber'] : '' ?>')">Request Approval</a>
                                        <?php } ?>

                                        <?php if(isset($_SESSION['user']) && $user->canAudit($_SESSION['user'][0]['id']) && ($header['approvalRequest'] == 1)) {?>
                                                <a class="btn btn-success" onclick="audit('<?php echo isset($header['reqnumber']) ? $header['reqnumber'] : '' ?>')">Audit</a>
                                                <button class="btn btn-danger" onclick="get_return_modal('<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>')">Return</button>
                                        <?php } ?>
                                        <?php if(isset($_SESSION['user']) && $user->canApprove($_SESSION['user'][0]['id'])  && ($header['approvalRequest'] == 1)) {?>
                                                <a class="btn btn-success" onclick="approve('<?php echo isset($header['reqnumber']) ? $header['reqnumber'] : '' ?>')">Approve</a>
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

          
<?php require '../includes/footer.php'; ?>