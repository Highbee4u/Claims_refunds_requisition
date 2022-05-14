<?php !isset($_GET['id']) ? header("location:javascript://history.go(-1)") : ''; ?>
<?php  require '../includes/header.php';   ?>
<?php require '../../model/Requisition.php'; ?>
<?php require '../../model/Item.php'; ?>
<?php require '../../model/User.php'; ?>
<?php require '../../model/department.php'; ?>

<?php require '../includes/menu.php'; ?>
<?php $header = $req->fetch_by_criterial(array('reqnumber'=>$_GET['id']))[0]; ?>


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
                    Requisition Detail For Req ID: <b><?php echo isset($_GET['id']) ? $_GET['id'] : ""; ?></b>
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
                                            <td>Requisition ID</td>
                                            <td><?php echo isset($_GET['id']) ? $_GET['id'] : ""; ?></td>
                                            <td>Requisition Date:</td>
                                            <td><?php echo isset($header['reqdate']) ? $header['reqdate'] : ""; ?></td>
                                        </tr>
                                        <tr>
                                            <td>To be Audited By:</td>
                                            <td><?php echo isset($header['auditedby']) ? $user->get_user_name_by_id($header['auditedby']) : ""; ?></td>
                                            <td>To be Approved By:</td>
                                            <td><?php echo isset($header['approvedby']) ? $user->get_user_name_by_id($header['approvedby']) : ""; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Department:</td>
                                            <td><?php echo isset($header['departmentid']) && $header['departmentid'] != 0  ? $department->get_depart_name_by_id($header['departmentid']) : ""; ?></td>
                                            <td>Description:</td>
                                            <td><?php echo isset($header['description']) ? $header['description'] : ""; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Requisited By:</td>
                                            <td colspan="3"><?php echo isset($header['reqby']) ? $user->get_user_name_by_email($header['reqby']) : "" ?></td>
                                        </tr>
                                    </table>
                                    <hr>
                                    <h4>Item Details</h4></div><hr>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>&nbsp;</th>
                                                <th>S/N</th>
                                                <th>Item Name</th>
                                                <th>UOM</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $data = $req->fetch_detail_by_criterial(array('reqnumber'=>$_GET['id']));
                                            if(count($data) > 0) {  
                                                $counter = 1;
                                            
                                            foreach($data as $dt){
                                            
                                            ?>
                                                <tr>
                                                <td><button class="btn btn-primary" onclick = "get_edit_modal('<?php echo $dt['reqdetailid']; ?>')" >Add Price</button></td>
                                                <td> <?php echo $counter ++; ?> </td>
                                                <td><?php echo isset($dt['itemid']) ? $item->get_item_name_by_id($dt['itemid']) : ""; ?></td>
                                                <td><?php echo isset($dt['uom']) ? $dt['uom'] : ""; ?></td>
                                                <td><?php echo isset($dt['qty']) ? $dt['qty'] : ""; ?></td>
                                                <td><?php echo isset($dt['price']) ? $dt['price'] : ""; ?></td>
                                                </tr>
                                            <?php } 
                                            } else { ?>
                                                <tr>
                                                    <td colspan="7" class="text-center">No Record To Display</td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <div>
                                        <?php if((!empty($header))  && $header['approvalRequest'] == 1) { ?>
                                            <button onclick="req_proceed('<?php echo isset($_GET['id']) ? $_GET['id'] :"" ?>')" class="btn btn-primary">Proceed</button>
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

            <!-- Edit modal -->
    <!-- Modal -->
    <div class="modal fade" id="editdetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add Price For Item</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form id="frmeditdetail"  onsubmit="return false" method = "POST" >
            <div class="form-group">
              <input type="hidden" name="requisitionid" id="requisitionid" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
              <input type="hidden" name="detailid" id="detailid" >
                <label for="exampleInputEmail1">UOM:</label>
                <span type="text" name="uom" class="form-control" id="uom"></span>
                <label for="exampleInputEmail1">Quantity:</label>
                <input type="number"  name="qty" class="form-control" required id="qty" >
                <span id="qtyerror"></span>
                <label for="exampleInputEmail1">Price:</label>
                <input type="number" name="price" step=".01" required class="form-control" id="price" >
                <span id="priceerror"></span>
            </div>
            
          </div>
          <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="savedetail">Add Price</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            
          </div>
          </form>
        </div>
      </div>
    </div>

<?php  require '../includes/footer.php'; ?>

<script>

    let itemlist;

    
    
    $("form#frmeditdetail").submit(function (e) { 
        var price = $("#frmeditdetail #price").val();  
        var qty = $("#frmeditdetail #qty").val();  
        var requisitionid = $("#frmeditdetail #requisitionid").val();  
        var detailid = $("#frmeditdetail #detailid").val();  

       var status = false;
        if(price == ""){
            $('#priceerror').html('Price Cannot be blank').addClass('text-danger');
            status = true;
        }else{
            $('#priceerror').html(" ");
        }

        if(qty == ""){
            $('#qtyerror').html('Qty Cannot be blank').addClass('text-danger');
            status = true;
        }else if(qty == 0 || qty == "undefined" || qty < 0 ){
          $('#qtyerror').html('Qty Cannot be zero or less than zero').addClass('text-danger');
            status = true;
        }else{
            $('#qtyerror').html(" ");
        }

        if(status == false ){
          var data = {'price':price , 'qty':qty , 'requisitionid': requisitionid, 'detailid':detailid}

          console.log(data);

          $.ajax({
              url: "../../library/request.php?action=add_price",
              type: 'POST',
              data: data,
              dataType: 'JSON',
              success:function(data){
                if(data == 1){
                  window.location.reload();
                }
                  
              }, 
              error: function(error){
                  console.log(error);
              }
          })
        }
    });

    function get_edit_modal(id){
        let url = "../../library/request.php?action=get_req_detail_by_id";

        $.ajax({
          type: "POST",
          url: url,
          data: {"id":id},
          dataType: "JSON",
          success: function (response) {
            console.log(response.qty);
            if(response != ""){
              $("#editdetail #uom").html(response.uom);
              $("#editdetail #qty").val(response.qty);
              $("#editdetail #price").val(response.price);
              $("#editdetail #detailid").val(response.reqdetailid);
            }

           
          }
         
        });
        $("#editdetail").modal('show');
    }

  function req_proceed(id){
    let url = "../../library/request.php?action=get_release_from_procurement";

        $.ajax({
          type: "POST",
          url: url,
          data: {"id":id},
          dataType: "JSON",
          success: function (response) {
            if(response == 1){
              alert("Price Set Successfully");
              window.location.href = 'index.php';
            }
          }
        });
  }
    
    
</script>