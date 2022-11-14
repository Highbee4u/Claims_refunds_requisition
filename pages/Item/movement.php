<?php  require '../includes/header.php'; ?>
<?php require '../../model/Item.php'; ?>
<?php require '../../model/Itemmovement.php'; ?>
<?php require '../../model/uom.php'; ?>
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
                    Stock Movement
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Item</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Stock Movement</li>
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
                            <div class="col-md-6 mt-5">
                                <button class="btn btn-primary" onclick="get_stock_modal()">Add Stock</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                
                                    <table id="zero_config" class="table table-striped table-bordered">
                                      <thead>
                                        <tr>
                                          <th>&nbsp;</th>
                                          <th>S/N</th>
                                          <th>Name</th>
                                          <th>Item Name</th>
                                          <th>Units</th>
                                        </tr>
                                      </thead>
                                        <tbody>
                                        <?php 
                                            $data = $itemmovement->fetch_header();
                                            // print_r($data);
                                            if(count($data) > 0) {   
                                                $i = 1;
                                            foreach($data as $dt){
                                            ?>
                                                <tr>
                                                <td><a  class="btn btn-xs btn-primary" href="flowdetail.php?id=<?php echo ($dt['itemid']); ?>" >view</a></td>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo isset($dt['itemid']) ? $item->get_item_name_by_id($dt['itemid']) : ""; ?></td>
                                                <td><?php echo 'Stock Item'; ?></td>
                                                <td><?php echo isset($dt['itemid']) ? $item->get_uom_by_item(array("id"=>$dt['itemid'])) : ""; ?></td>
                                                </tr>
                                            <?php } } else { ?>
                                                <tr>
                                                    <td colspan="4" class="text-center">No Record To Display</td>
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
    <div class="modal fade" id="createstock"  role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Create New Item</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form id="frmcreatestock" onsubmit="return false">
            <div class="form-group">
            <label for="exampleInputEmail1">Item ID:</label>
            <div class="form-control">
            <select name="itemid" class="form-control itemtoadd" id="itemid" ></select>
                <span id="itemiderror"></span>
            </div>
                
                <label for="exampleInputEmail1">UOM:</label>
                <input type="text" name="uom" class="form-control" id="uom">
                <span id="uomerror"></span>
                <label for="exampleInputEmail1">Quantity:</label>
                <input type="number" name="qty" class="form-control" id="qty" >
                <span id="qtyerror"></span>
            </div>
            
          </div>
          <div class="modal-footer">
                <button type="submit" class="btn btn-success" >Add</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            
          </div>
          </form>
        </div>
      </div>
    </div>

            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                All Rights Reserved by ISALU HOSPITAL<a href=""></a>
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../../assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="../../dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../../dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <!-- <script src="../../dist/js/pages/dashboards/dashboard1.js"></script> -->
    <!-- Charts js Files -->
    <script src="../../assets/libs/flot/excanvas.js"></script>
    <script src="../../assets/libs/flot/jquery.flot.js"></script>
    <script src="../../assets/libs/flot/jquery.flot.pie.js"></script>
    <script src="../../assets/libs/flot/jquery.flot.time.js"></script>
    <script src="../../assets/libs/flot/jquery.flot.stack.js"></script>
    <script src="../../assets/libs/flot/jquery.flot.crosshair.js"></script>
    <script src="../../assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="../../dist/js/pages/chart/chart-page-init.js"></script>
    <script src="../../assets/extra-libs/DataTables/datatables.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>$('#zero_config').DataTable();</script>
<script>
   let itemlist;

function get_stock_modal(){
  itemlist = itemlist.filter(e => e.itemtypeid == 1);
  $("#createstock #itemid").empty();
      $("#createstock #itemid").append("<option>--Select Item--</option>");
      
      $.each(itemlist, function (indexInArray, valueOfElement) { 
        $("#createstock #itemid").append("<option value="+ itemlist[indexInArray].itemid +">"+itemlist[indexInArray].name+"</option>");
      });

    $("#createstock").modal('show');
}

$("#itemid").change('show.bs.modal', function (e){ 
      let url = "../../library/request.php?action=getUomName";

      $.ajax({
        type: "POST",
        url: url,
        data: {'itemid' : $('#createstock #itemid').val() },
        dataType: "JSON",
        success: function (response) {
          $("#createstock #uom").val(response);
        }
      });

});

function get_item(){
  let url = "../../library/request.php?action=getAllItem";

$.ajax({
  type: "GET",
  url: url,
  dataType: "JSON",
  success: function (response) {
    itemlist = response;
  }
});
}

$('form#frmcreatestock').submit(function(){
  if(confirm("Are you sure you want to update quantity of this item")){
  let itemid = $("#itemid").val();
  let uom = $("#uom").val();
  let qty = $("#qty").val();

  var status = false;

   // validate item name
  if(itemid == "" ) {
      $('#itemidError').html('Item name cannot be blank').addClass('text-danger');
      status = true;
  }
  else{
      $('#itemidError').html(" ");
  }
  if(uom == "" ) {
      $('#uomerror').html('UOM field cannot be blank').addClass('text-danger');
      status = true;
  }
  else{
      $('#uomerror').html(" ");
  }
  
  if(qty == "" ) {
    $('#qtyerror').html('Qty field cannot be blank for stock Item').addClass('text-danger');
    status = true;
  }
  else{
      $('#qtyerror').html(" ");
  }
     

  if(status == false){
    let res = '';
    var data = {'itemid': itemid, 'uom':uom, 'qty':qty }
    $.ajax({

      type: "POST",
      url: "../../library/request.php?action=create_positive_movement",
      data: data,
      dataType: "JSON",
      success: function (response) {
          let responses = JSON.parse(response);
                    
          if(responses == true){
              alert("Stock Added Successfully");
              window.location.reload();
          }else{
              alert("Error Adding Stock");
          }
      }
    });
  }

}
});


$(document).ready(function () {
  
  get_item();
  $('.itemtoadd').select2();
});
</script>