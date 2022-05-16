<?php !isset($_GET['id']) ? header("location:javascript://history.go(-1)") : ''; ?>
<?php  require '../includes/header.php';   ?>
<?php require '../../model/Requisition.php'; ?>
<?php require '../../model/Item.php'; ?>
<?php require '../../model/User.php'; ?>
<?php require '../../model/Department.php'; ?>
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
                                          <td><?php echo isset($header['departmentid']) && $header['departmentid'] != 0 ? $department->get_depart_name_by_id($header['departmentid']) : ""; ?></td>
                                          <td>Requisited By:</td>
                                          <td><?php echo isset($header['reqby']) ? $user->get_user_name_by_email($header['reqby']) : "" ?></td>
                                      </tr>
                                      <tr>
                                          <td>Description:</td>
                                          <td colspan="3"><?php echo isset($header['description']) ? $header['description'] : ""; ?></td>
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
                                          <td colspan="3"><?php echo isset($header['coment']) ? $header['coment'] : ""; ?></td>
                                        </tr>
                                      <?php } ?>
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
                                              <?php echo isset($_SESSION['user']) && ($_SESSION['user'][0]['user_roleid'] == '1' || $_SESSION['user'][0]['user_roleid'] == '-1' || $_SESSION['user'][0]['user_roleid'] == '2') ? '<th>Price</th>' : ""; ?>
                                              <th>Quantity</th>
                                              <th>Subtotal</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $data = $req->fetch_detail_by_criterial(array('reqnumber'=>$_GET['id']));
                                            if(count($data) > 0) {  
                                                $counter = 1; 
                                                $total = 0;
                                            foreach($data as $dt){
                                              $total += $dt['qty'] * $dt['price'];
                                            ?>
                                                <tr>
                                                  <?php if($header['approvalRequest'] == 1 || $header['audited'] == 1 || $header['approved'] == 1){ ?>
                                                    <td>&nbsp;</td>
                                                  <?php }else{ ?>
                                                <td><a onclick = "deletedetail('<?php echo $dt['reqdetailid']; ?>')"><i class="fa fa-trash"></i></a> | <a  onclick = "get_edit_modal('<?php echo $dt['reqdetailid']; ?>', '<?php echo $_GET['rectype']; ?>')" ><i class="fa fa-edit"></i></a></td>
                                                <?php } ?>
                                                <td> <?php echo $counter ++; ?> </td>
                                                <td><?php echo isset($dt['itemid']) ? $item->get_item_name_by_id($dt['itemid']) : ""; ?></td>
                                                <td><?php echo isset($dt['uom']) ? $dt['uom'] : ""; ?></td>
                                                <?php echo isset($_SESSION['user']) && ($_SESSION['user'][0]['user_roleid'] == '1' || $_SESSION['user'][0]['user_roleid'] == '-1' || $_SESSION['user'][0]['user_roleid'] == '2') ? '<td>'.$dt['price'].'</td>' : ""; ?>
                                                <td><?php echo isset($dt['qty']) ? $dt['qty'] : ""; ?></td>
                                                <td><?php echo isset($dt['qty'], $dt['price']) ? ($dt['price'] * $dt['qty']) : ""; ?></td>
                                                </tr>
                                            <?php } 
                                              if(isset($_SESSION['user']) && ($_SESSION['user'][0]['user_roleid'] == '1' || $_SESSION['user'][0]['user_roleid'] == '-1' || $_SESSION['user'][0]['user_roleid'] == '2')){
                                                  echo "<tr><td colspan='6' class='text-right'>Total:</td><td>#".$total."</td></tr>";
                                              }
                                                    
                                              } else { ?>
                                                <tr>
                                                    <td colspan="7" class="text-center">No Record To Display</td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <div>
                                      <?php if((!empty($header))  && $header['approvalRequest'] == 1) { ?>
                                          <span class="btn btn-success dissabled">Approval Requested</span>
                                      <?php } else if($header['approvalRequest'] == 0)  { ?>
                                          <button class="btn btn-primary" onclick="get_modal('<?php echo $_GET['rectype'] ?>')">New</button>
                                          <?php if(count($data) < 1 ){ ?>
                                            <a class="btn btn-success disabled">Request Approval</a>
                                          <?php } else { ?> 
                                          <a class="btn btn-success" onclick="approval_request('<?php echo isset($header['reqnumber']) ? $header['reqnumber'] : '' ?>')">Request Approval</a>
                                            <?php } ?>
                                      <?php } ?>

                                      <?php if(isset($_SESSION['user']) && $user->canAudit($_SESSION['user'][0]['id']) && ($header['approvalRequest'] == 1) && ($header['audited'] == 0)) {?>
                                              <a class="btn btn-success" onclick="audit('<?php echo isset($header['reqnumber']) ? $header['reqnumber'] : '' ?>')">Audit</a>
                                              <button class="btn btn-danger" onclick="get_return_modal('<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>')">Return</button>
                                      <?php } ?>
                                      <?php if(isset($_SESSION['user']) && $user->canApprove($_SESSION['user'][0]['id'])  && ($header['approvalRequest'] == 1) && ($header['approved'] == 0)) {?>
                                              <a class="btn btn-success" onclick="approve('<?php echo isset($header['reqnumber']) ? $header['reqnumber'] : '' ?>', '<?php echo isset($_GET['rectype']) ? $header['requisitiontype'] : '' ?>')">Approve</a>
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
                <input type="text" name="uom" readonly class="form-control" id="uom">
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
              <input type="hidden" name="userid" id="userid" value="<?php echo isset($_SESSION['user']) ? $_SESSION['user'][0]['id'] : ''; ?>">
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

    <div class="modal fade" id="approvalstatusdialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Audit And Approval Status</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form id="frmaudit"  onsubmit="return false" method = "POST" >
            <div class="form-group">
              <input type="hidden" name="requisitionid" id="requisitionid" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
              <input type="hidden" name="userid" id="userid" value="<?php echo isset($_SESSION['user']) ? $_SESSION['user'][0]['id'] : ''; ?>">
              <input type="hidden" name="rectype" id="rectype" value="<?php echo isset($_GET['rectype']) ? $_GET['rectype'] : ''; ?>">
                <label for="exampleInputEmail1">Approval Action:</label>
                <select name="status" class="form-control" onchange="getSelectedaction(this)" id="status" >
                  <option value="">Choose Action..</option>
                  <option value="Approve">Approve</option>
                  <option value="Audit">Sent For Approval</option>
                </select>
                <span id="statuserror"></span>
                 <label for="exampleInputEmail1" id="lbltobeapproved">To be Approved By:</label>
                <select name="approvedby" class="form-control" id="approvedby" required></select>
                <span id="approvedbyerror"></span>
            </div>
            
          </div>
          <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="savedetail">Proceed</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            
          </div>
          </form>
        </div>
      </div>
    </div>


<?php  require '../includes/footer.php'; ?>
<script>

    let itemlist;
    let Approvals;

    function get_modal(id){
      
      itemlist = itemlist.filter(e => e.itemtypeid == id)

      $("#adddetail #itemid").empty();
      $("#adddetail #itemid").append("<option>--Select Item--</option>");
      
      $.each(itemlist, function (indexInArray, valueOfElement) { 
        $("#adddetail #itemid").append("<option " + ((itemlist[indexInArray].itemtypeid == 1 && itemlist[indexInArray].qty < 1) ? 'disabled' : '') +" value="+ itemlist[indexInArray].itemid +" >"+itemlist[indexInArray].name + ((itemlist[indexInArray].itemtypeid == 1 && itemlist[indexInArray].qty < 1) ? '---'+"<span class='bg-danger'>(out of stock)</span>" : "" ) +"</option>");
      });
    
    
      $("#adddetail").modal('show');
    }

    $("#itemid").change('show.bs.modal', function (e){ 
      let url = "../../library/request.php?action=getUomName";

      $.ajax({
        type: "POST",
        url: url,
        data: {'itemid' : $('#adddetail #itemid').val() },
        dataType: "JSON",
        success: function (response) {
          $("#adddetail #uom").val(response);
        }
      });
      
    });

    $("form#frmAdddetail").submit(function (e) { 
        var itemid = $("#itemid").val();      
        var uom = $("#uom").val();      
        var qty = $("#qty").val();      
        var requisitionid = $("#requisitionid").val();  


       var status = false;

        if(itemid == ""){
            $('#itemiderror').html('Item ID Cannot be blank').addClass('text-danger');
            status = true;
        }else{
            $('#itemiderror').html(" ");
        }
        if(uom == ""){
            $('#uomerror').html('Item UOM  Cannot be blanck').addClass('text-danger');
            status = true;
        }else{
            $('#uomerror').html(" ");
        }
        if(qty == ""){
            $('#qtyerror').html('Quantity Cannot be blanck').addClass('text-danger');
            status = true;
        }else{
            $('#qtyerror').html(" ");
        }

        if(status == false ){
          var data = {'itemid': itemid, 'qty':qty, 'uom':uom, 'requisitionid': requisitionid}

          $.ajax({
              url: "../../library/request.php?action=add_requisition_detail",
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

    $("form#frmeditdetail").submit(function (e) { 
        var itemid = $("#frmeditdetail #itemid").val();      
        var uom = $("#frmeditdetail #uom").val();      
        var qty = $("#frmeditdetail #qty").val();  
        var requisitionid = $("#frmeditdetail #requisitionid").val();  
        var detailid = $("#frmeditdetail #detailid").val();  

       var status = false;

        if(itemid == ""){
            $('#itemiderror').html('Item ID Cannot be blank').addClass('text-danger');
            status = true;
        }else{
            $('#itemiderror').html(" ");
        }
        if(uom == ""){
            $('#uomerror').html('Item UOM  Cannot be blanck').addClass('text-danger');
            status = true;
        }else{
            $('#uomerror').html(" ");
        }
        if(qty == ""){
            $('#qtyerror').html('Quantity Cannot be blanck').addClass('text-danger');
            status = true;
        }else{
            $('#qtyerror').html(" ");
        }

        if(status == false ){
          var data = {'itemid': itemid, 'qty':qty, 'uom':uom, 'requisitionid': requisitionid, 'detailid':detailid}

          console.log(data);

          $.ajax({
              url: "../../library/request.php?action=update_req_detail",
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

    function deletedetail(id){
      let url = "../../library/request.php?action=deletereqdetail";

      if(confirm("Are you sure you want to delete ?")){
          $.ajax({
            type: "POST",
            url: url,
            data: {'id': id} ,
            dataType: "JSON",
            success: function (response) {
              if(response == 1){
                alert("Detail deleted Successfully");
                window.location.reload();
              }
            }
          });
      }
    }

    function get_edit_modal(id,type){
        let url = "../../library/request.php?action=get_req_detail_by_id";
        itemlist = itemlist.filter(e => e.itemtypeid == type);
        $.ajax({
          type: "POST",
          url: url,
          data: {"id":id},
          dataType: "JSON",
          success: function (response) {

            if(response != ""){
              $("#editdetail #itemid").empty();
              $.each(itemlist, function (indexInArray, valueOfElement) { 
                $("#editdetail #itemid").append("<option " + (response.itemid == itemlist[indexInArray].itemid ? 'selected' : '') + " value="+ itemlist[indexInArray].itemid +">"+itemlist[indexInArray].name+"</option>");
              });
              $("#editdetail #uom").val(response.uom);
              $("#editdetail #qty").val(response.qty);
              $("#editdetail #detailid").val(response.reqdetailid);
            }

           
          }
         
        });
        $("#editdetail").modal('show');
    }

    function item_list(){
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

    function approval_request(id){
      if(confirm("Are you sure you want to request for Approval")){
        let url = "../../library/request.php?action=approvalRequest";

          $.ajax({
            type: "POST",
            url: url,
            data: {"id":id},
            dataType: "JSON",
            success: function (response) {
              console.log(response);
              if(response == 1){
                alert("Requisition sent for Approval");
                window.location.href = "index.php";
              }else{
                alert("Unable to request Approval, Try later");
              }
            }
          });
      }
    }

    function audit(id){
      $("#approvalstatusdialog #lbltobeapproved").hide().prop('required',false);
      $("#approvalstatusdialog #approvedby").hide().prop('required',false);

      $("#approvalstatusdialog #approvedby").empty();
      $("#approvalstatusdialog #approvedby").append("<option value=''>-- To be Approved By --</option>");
      $.each(Approvals, function (indexInArray, valueOfElement) { 
          $("#approvalstatusdialog #approvedby").append("<option value="+Approvals[indexInArray].id+">"+Approvals[indexInArray].name+"</option>");
      });

      $("#approvalstatusdialog").modal('show');
      
    }

    function getSelectedaction(id){
        if(id != ""){
          if(id.value == "Audit"){
            $("#approvalstatusdialog #lbltobeapproved").show()
            $("#approvalstatusdialog #approvedby").show()
          }else{
            $("#approvalstatusdialog #lbltobeapproved").hide().prop('required',false)
            $("#approvalstatusdialog #approvedby").hide().prop('required',false)
          }
        }
    }

    function approve(id, rectype){
      if(confirm("Are you sure you want to Approve this requisition ? ")){
        let url = "../../library/request.php?action=approve";

          $.ajax({
            type: "POST",
            url: url,
            data: {"id":id, "requisitiontype": rectype },
            dataType: "JSON",
            success: function (response) {
              if(response == 1){
                alert("Requisition Approved Successfully")
                window.location = "approve.php";
              }
            }
          });
      }
    }

    $("form#frmreturn").submit(function (e) { 

        var reqid = $("#requisitionid").val();      
        var comment = $("#description").val();      
        var userid = $("#userid").val();      

        var status = false;

        if(comment == ""){
          $("#descriptionerror").html("Comment Field Cannot be emty").addClass("text-danger");
          status = true;
        }else{
          $("#descriptionerror").html("");
        }

        if(status == false){

          let url = "../../library/request.php?action=returnrequisition";

          $.ajax({
            type: "POST",
            url: url,
            data: { 'requisitionid':reqid, 'description':comment, 'userid':userid },
            dataType: "JSON",
            success: function (response) {
              
                if(response == 1){
                  alert("Requisition Returned");
                  window.location = 'index.php';
                }else{
                  alert("Unable to return requisition, try again");
                  window.location.reload();
                }
            }
          });
        }
    });

    $("form#frmaudit").submit(function (e) { 

        var reqid = $("#frmaudit #requisitionid").val();      
        var approvedby = $("#frmaudit #approvedby").val();      
        var userid = $("#frmaudit #userid").val();      
        var status = $("#frmaudit #status").val();   
        var rectype = $("#frmaudit #rectype").val();   

        var errorstatus = false;
        var errorstatus = false;

        if(status == ""){
            $("#frmaudit #statuserror").html("Approval Action Cannot be empty").addClass('text-danger');
            errorstatus = true;
        }else{
          $('#frmaudit #statuserror').html(" ");
          errorstatus = false;
        }

          if(errorstatus == false){
            if(status == "Approve"){
                if(confirm("Are you sure you want to Approve this requisition ? ")){
                  let url = "../../library/request.php?action=audit_approve";

                  $.ajax({
                    type: "POST",
                    url: url,
                    data: {"id":reqid, "userid":userid, "requisitiontype":rectype },
                    dataType: "JSON",
                    success: function (response) {
                      if(response == 1){
                        alert("Requisition Audited And Approved Successfully");
                        window.location = "audit.php";
                      }else{
                        alert("unable to Audit, try again later");
                      }
                    }
                  });
                }   
            }else if(status == "Audit"){

                if(approvedby == ""){
                  $("#frmaudit #approvedbyerror").html("Approved By Cannot be empty").addClass('text-danger');
                  errorstatus = true;
                }else{
                  $('#frmaudit #approvedbyerror').html(" ");
                }

                

                if(errorstatus == false){
                  if(confirm("Are you sure you want to Audit this requisition ? ")){
                    let url = "../../library/request.php?action=audit_set_approval";

                    $.ajax({
                      type: "POST",
                      url: url,
                      data: {"id":reqid, "userid":userid, "approvedby":approvedby },
                      dataType: "JSON",
                      success: function (response) {
                        if(response == 1){
                          alert("Requisition Audited And Approved Successfully");
                          window.location = "audit.php";
                        }
                      }
                    });
                  }   
                }

            }
          }
            
    });

     function get_approval(){
      let url = "../../library/request.php?action=getapproval";

      $.ajax({
        type: "POST",
        url: url,
        dataType: "JSON",
        success: function (response) {
              Approvals = response;
        }
      });
    }

    function get_return_modal(id){
      $("#returndialog").modal("show");
    }

    $(document).ready(function () {
      item_list();
      get_approval();
    });
    
    
</script>