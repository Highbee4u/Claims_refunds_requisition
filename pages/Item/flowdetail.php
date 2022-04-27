<?php !isset($_GET['id']) ? header("location:javascript://history.go(-1)") : ''; ?>
<?php  require '../includes/header.php';   ?>
<?php require '../../model/Requisition.php'; ?>
<?php require '../../model/Item.php'; ?>
<?php require '../../model/Itemmovement.php'; ?>
<?php require '../../model/Uom.php'; ?>
<?php require '../../model/User.php'; ?>
<?php require '../../model/Department.php'; ?>
<?php require '../includes/menu.php'; ?>
<?php $header = $item->fetch_by_criterial(array('itemid'=>$_GET['id']))[0];?>

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
                    Item Flow Detail
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
                                        <tr>
                                            <td>Item Name</td>
                                            <td><?php echo isset($_GET['id']) ? $item->get_item_name_by_id($_GET['id']) : ""; ?></td>
                                            <td>UOM</td>
                                            <td><?php echo isset($header['itemid']) ? $item->get_uom_by_item(array('id'=>$header['itemid'])) : ""; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Item type:</td>
                                            <td><?php echo "Stock Item"; ?></td>
                                            <td>Available Qty:</td>
                                            <td><?php echo isset($header['itemid']) ? $itemmovement->get_balance_qty($header['itemid']) : ""; ?></td>
                                        </tr>
                                    </table>
                                    <hr>
                                    <h4>Item Movement Details</h4></div><hr>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Quantity</th>
                                                <th>Direction</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $data = $itemmovement->fetch_by_criterial(array('itemid'=>$_GET['id']));
                                            if(count($data) > 0) {  
                                                $counter = 1; 
                                                foreach($data as $dt){
                                                ?>
                                                <td> <?php echo $counter ++; ?> </td>
                                                    <td><?php echo isset($dt['qty']) ? (($dt['qty']) < 0 ? "<span class='text-danger'>(".abs($dt['qty']).")</span>": $dt['qty'] ): ""; ?></td>
                                                    <td><?php echo isset($dt['flow']) ? $dt['flow'] : ""; ?></td>
                                                    <td><?php echo isset($dt['flowdate']) ? $dt['flowdate'] : ""; ?></td>
                                                    </tr>
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

            <!-- Modal -->
     <div class="modal fade" id="adddetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add Requisition Detail</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form id="frmAdddetail" class="frmAdddetail" onsubmit="return false" method = "POST" >
            <div class="form-group">
              <input type="hidden" name="requisitionid" id="requisitionid" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
                <label for="exampleInputEmail1">Item ID:</label>
                <select name="itemid" class="form-control" id="itemid"></select>
                <span id="itemiderror"></span>
                <label for="exampleInputEmail1">UOM:</label>
                <input type="text" name="uom" class="form-control" id="uom">
                <span id="uomerror"></span>
                <label for="exampleInputEmail1">Quantity:</label>
                <input type="number" name="qty" class="form-control" id="qty" >
                <span id="qtyerror"></span>
            </div>
            
          </div>
          <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="savedetail">Add</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            
          </div>
          </form>
        </div>
      </div>
    </div>


    <!-- Edit modal -->
    <!-- Modal -->
    <div class="modal fade" id="editdetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Requisition Detail</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form id="frmeditdetail"  onsubmit="return false" method = "POST" >
            <div class="form-group">
              <input type="hidden" name="requisitionid" id="requisitionid" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
              <input type="hidden" name="detailid" id="detailid" >
                <label for="exampleInputEmail1">Item ID:</label>
                <select name="itemid" class="form-control" id="itemid"></select>
                <span id="itemiderror"></span>
                <label for="exampleInputEmail1">UOM:</label>
                <input type="text" name="uom" class="form-control" id="uom">
                <span id="uomerror"></span>
                <label for="exampleInputEmail1">Quantity:</label>
                <input type="number" name="qty" class="form-control" id="qty" >
                <span id="qtyerror"></span>
            </div>
            
          </div>
          <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="savedetail">Update</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            
          </div>
          </form>
        </div>
      </div>
    </div>

     <!-- Modal -->
     <div class="modal fade" id="returndialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Return Requisition</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form id="frmreturn"  onsubmit="return false" method = "POST" >
            <div class="form-group">
              <input type="hidden" name="requisitionid" id="requisitionid" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
                <label for="exampleInputEmail1">Enter Comment:</label>
                <input type="text" name="description" class="form-control" id="description" >
                <span id="descriptionerror"></span>
            </div>
            
          </div>
          <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="savedetail">Return</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            
          </div>
          </form>
        </div>
      </div>
    </div>
<?php require '../includes/footer.php'; ?>