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
                        <h4 class="page-title">Requisition Awaiting Audit</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Requisition</a></li>
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
                                            <th>Req. No</th>
                                            <th>Req. By</th>
                                            <th>Department</th>
                                            <th>Req. Date</th>
                                            <th>Comment</th>
                                            <th>Status</th>
                                            <th>Approval Req.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $data = $req->fetch_by_criterial(array('approvalRequest'=> 1, 'audited'=> 0, 'awaiting_price'=> 0, 'auditedby'=>$_SESSION['user'][0]['id']));
                                        
                                        
                                        if(count($data) > 0) {   
                                        foreach($data as $dt){
                                        ?>
                                            <tr>
                                            <td>
                                                <?php echo ($dt['approvalRequest'] == 1  ? "<a href='detail.php?id=".$dt['reqnumber']."&rectype=".$dt['requisitiontype']."'><i class='fa fa-eye'></i></i></a>" : ''); ?> | <?php echo ($dt['approvalRequest'] == 1  ? "<a href='printable.php?id=".$dt['reqnumber']."'><i class='fa fa-print'></i></i></a>" : ''); ?>
                                            </td>
                                            <td><?php echo $dt['reqnumber']; ?></td>
                                            <td><?php echo $dt['reqby']; ?></td>
                                            <td><?php echo isset($dt['departmentid']) ? $department->get_depart_name_by_id($dt['departmentid']) : ""; ?></td>
                                            <td><?php echo $dt['reqdate']; ?></td>
                                            <td><?php echo $dt['coment']; ?></td>
                                            <td><?php echo ($dt['approved'] == 1 ? 'Approved' : 'No Yet Approved'); ?></td>
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

             <!-- Modal -->
            <div class="modal fade" id="addrequisition" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Create New Requisition</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form id="frmRequisition" method="POST" name="frmRequisition" onsubmit="return false">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="reqby" required aria-describedby="emailHelp" disabled>
                        <input type="hidden" class="form-control" id="departmentid" required aria-describedby="emailHelp" disabled>
                        <label for="exampleInputEmail1">To be Audited By:</label>
                        <select name="auditedby" class="form-control" id="auditedby" required ></select>
                        <span id="auditedbyerror"></span>
                        <label for="exampleInputEmail1">Requested Item Type:</label>
                        <select name="requisitiontype" class="form-control" id="requisitiontype" required>
                        <option value="">Choose Type</option>
                        <option value="1">Stock Item</option>
                        <option value="2">Non Stock Item</option>
                        </select>
                        <span id="requisitiontypeerror"></span>
                        <label for="exampleInputEmail1">To be Approved By:</label>
                        <select name="approvedby" class="form-control" id="approvedby" required></select>
                        <span id="approvedbyerror"></span>
                        <label for="exampleInputEmail1">Description:</label>
                        <textarea name="description" class="form-control" id="description" cols="30" rows="5"></textarea>
                        <span id="descriptionerror"></span>
                    </div>
                    
                </div>
                <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="frmCreaterequisition">Create</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    
                </div>
                </form>
                </div>
            </div>
            </div>
<?php require '../includes/footer.php'; ?>