<?php !isset($_GET['id']) ? header("location:javascript://history.go(-1)") : ''; ?>
<?php  require '../includes/header.php';   ?>
<?php require '../../../model/Refund.php'; ?>
<?php require '../../../model/Department.php'; ?>
<?php require '../includes/menu.php'; ?>
<?php $header = $refund->fetch_by_criterial(array('id'=>$_GET['id']), 'refunds_header')[0];  ?>

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
                    Refund Detail For Refund ID: <b><?php echo isset($_GET['id']) ? $_GET['id'] : ""; ?></b>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Refund</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
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
                                          <td>Refund ID</td>
                                          <td><?php echo isset($_GET['id']) ? $_GET['id'] : ""; ?></td>
                                          <td>Hospital Number:</td>
                                          <td><?php echo isset($header['hospital_no']) ? $header['hospital_no'] : ""; ?></td>
                                      </tr>
                                      <tr>
                                          <td>Initiated By:</td>
                                          <td><?php echo isset($header['enteredby']) ? $user->get_user_name_by_email($header['enteredby']) : "" ?></td>
                                          <td>To be Audited By:</td>
                                          <td><?php echo isset($header['auditedby']) ? $user->get_user_name_by_id($header['auditedby']) : ""; ?></td>
                                      </tr>
                                      <tr>
                                          <td>Patient Name:</td>
                                          <td><?php echo isset($header['patient_name']) ? $header['patient_name'] : ""; ?></td>
                                          <td>Account Name:</td>
                                          <td><?php echo isset($header['account_name']) ? $header['account_name'] : ""; ?></td>
                                      </tr>
                                      <tr>
                                          <td>Account Number:</td>
                                          <td><?php echo isset($header['account_number']) ? $header['account_number'] : ""; ?></td>
                                          <td>To be Approved By:</td>
                                          <td><?php echo isset($header['approvedby']) ? $user->get_user_name_by_id($header['approvedby']) : ""; ?></td>
                                      </tr>
                                      <tr>
                                          <td>Total Amount:</td>
                                          <td><?php echo isset($header['amount']) ? $header['amount'] : ""; ?></td>
                                          <td>Payment Status:</td>
                                          <td><?php echo isset($header['accountant_status']) && $header['accountant_status'] == 1 ? 'Approved' : "Pending"; ?></td>
                                      </tr>
                                      <tr>
                                          <td>Initiated Date:</td>
                                          <td colspan="3"><?php echo isset($header['Created_date']) ? $header['Created_date'] : ""; ?></td>
                                      </tr>
                                      <?php if(isset($header['returned']) && $header['returned'] == 1){ ?>
                                        <tr>
                                          <td>Status:</td>
                                          <td colspan="3"><?php echo isset($header['returned']) && $header['returned'] == 1 ? "<span class='bg-danger blink_text'>Returned</span>" : ""; ?></td>
                                          
                                        </tr>
                                        <tr>
                                          <td>Return:</td>
                                          <td colspan="3"><?php echo isset($header['comment']) ? $header['comment'] : ""; ?></td>
                                        </tr>
                                      <?php } ?>
                                    </table>
                                    <hr>
                                    <h4>Refund Break Down</h4></div><hr>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                          <tr>
                                              <th>&nbsp;</th>
                                              <th>S/N</th>
                                              <th>Description</th>
                                              <th>Amount</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                              $data = $refund->fetch_by_criterial(array('refund_id'=>$_GET['id']), 'refunds_detail');

                                              if(count($data) > 0) {  
                                                  $counter = 1; 
                                                  $total = 0;
                                              foreach($data as $dt){
                                                $total += $dt['amount'];

                                                  ?>
                                                      <tr>
                                                        <?php if($header['audited'] == 1 || $header['approval'] == 1){ ?>
                                                          <td>&nbsp;</td>
                                                        <?php }else{ ?>
                                                        <td><a onclick = "deletedetail('<?php echo $dt['id']; ?>', '<?php echo $_GET['id']; ?>')"><i class="fa fa-trash"></i></a> | <a  onclick = "get_edit_modal('<?php echo $dt['id']; ?>')" ><i class="fa fa-edit"></i></a></td>
                                                        <?php } ?>
                                                        <td> <?php echo $counter ++; ?> </td>
                                                        <td><?php echo isset($dt['Description']) ? $dt['Description'] : ""; ?></td>
                                                        <td><?php echo isset($dt['amount']) ? $dt['amount'] : ""; ?></td>
                                                      
                                                      </tr>
                                            <?php } 
                                              if(isset($_SESSION['user']) && ($_SESSION['user'][0]['user_roleid'] == '1' || $_SESSION['user'][0]['user_roleid'] == '-1' || $_SESSION['user'][0]['user_roleid'] == '2')){
                                                  echo "<tr><td colspan='3' class='text-right'>Total:</td><td>#".$total."</td></tr>";
                                              }
                                                    
                                              } else { ?>
                                                <tr>
                                                    <td colspan="4" class="text-center">No Record To Display</td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <div>
                                      <?php if((!empty($header))  && $header['audited'] == 1 && $header['approval'] == 1) { ?>
                                          <span class="btn btn-success dissabled">Approved</span>
                                      <?php } else if((!empty($header))  && ( $header['approvalRequest'] == 0) ) { ?>
                                          <button class="btn btn-primary" onclick="get_modal()">New</button>
                                          <?php if(count($data) < 1 ){ ?>
                                            <a class="btn btn-success disabled">Request Approval</a>
                                          <?php } else { ?> 
                                            <a class="btn btn-success" onclick="approval_request('<?php echo isset($header['id']) ? $header['id'] : '' ?>')">Request Approval</a>
                                            <?php } ?>
                                          
                                      <?php } else if((!empty($header))  && ( $header['approvalRequest'] == 1) ) { ?>
                                        <span class="btn btn-success dissabled">Sent For Approval</span>
                                      <?php } ?>

                                      <?php if(isset($_SESSION['user']) && $header['approvalRequest'] == 1 && $header['audited'] == 0 && ($user->canAudit($_SESSION['user'][0]['id']) || $user->is_admin($_SESSION['user'][0]['id'])  )) {?>
                                              <a class="btn btn-success" onclick="audit('<?php echo isset($header['id']) ? $header['id'] : '' ?>')">Audit</a>
                                              <button class="btn btn-danger" onclick="get_return_modal('<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>')">Return</button>
                                      <?php } else if(isset($_SESSION['user']) && $header['approvalRequest'] == 1 && $header['audited'] == 1 && ($user->canAudit($_SESSION['user'][0]['id']) || $user->is_admin($_SESSION['user'][0]['id'])  )) { ?>
                                              <span class="btn btn-success dissabled"> Audited </span>
                                        <?php } ?>

                                      <?php if(isset($_SESSION['user']) && $header['approval'] == 0 && $header['audited'] == 1 && ($user->canApprove($_SESSION['user'][0]['id'])  ||  $user->is_admin($_SESSION['user'][0]['id']))) {?>
                                              <a class="btn btn-success" onclick="approve('<?php echo isset($header['id']) ? $header['id'] : '' ?>')">Approve</a>
                                              <button class="btn btn-danger" onclick="get_return_modal('<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>')">Return</button>

                                      <?php }  ?>    
                                      <?php if(isset($_SESSION['user']) && $header['is_hod'] == 1 && $header['audited'] == 0 && ($user->is_hod($_SESSION['user'][0]['id']))) {?>
                                              <a class="btn btn-success" onclick="hmoapprove('<?php echo isset($header['id']) ? $header['id'] : '' ?>')">Approve</a>
                                              <button class="btn btn-danger" onclick="get_return_modal('<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>')">Return</button>

                                      <?php }  ?>   
                                      <?php if(isset($_SESSION['user']) && $header['is_bcc'] == 1 && $header['audited'] == 0 && ($user->is_bcc($_SESSION['user'][0]['id']))) {?>
                                              <a class="btn btn-success" onclick="bccapprove('<?php echo isset($header['id']) ? $header['id'] : '' ?>')">Approve</a>
                                              <button class="btn btn-danger" onclick="get_return_modal('<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>')">Return</button>

                                      <?php }  ?>    
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
            <h5 class="modal-title" id="exampleModalLongTitle">Add Refund Detail</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form id="frmAdddetail" class="frmAdddetail" onsubmit="return false" method = "POST" >
            <div class="form-group">
              <input type="hidden" name="id" id="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
                <label for="exampleInputEmail1">Amount:</label>
                <input type="number" step=".01" class="form-control" name="Amount" id="Amount">
                <span id="Amounterror"></span>
                <label for="exampleInputEmail1">Description:</label>
                <textarea name="Description" class="form-control" id="Description"></textarea>
                <span id="Descriptionrror"></span>
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

      <!-- Modal -->
      <div class="modal fade" id="returndialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Return Refund</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form id="frmreturn"  onsubmit="return false" method = "POST" >
              <div class="form-group">
                <input type="hidden" name="refundid" id="refundid" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
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
              <input type="hidden" name="id" id="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
              <input type="hidden" name="userid" id="userid" value="<?php echo isset($_SESSION['user']) ? $_SESSION['user'][0]['id'] : ''; ?>">
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

    <div class="modal fade" id="hodstatusdialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Select Auditor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form id="frmhodaudit"  onsubmit="return false" method = "POST" >
            <div class="form-group">
              <input type="hidden" name="id" id="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
              <input type="hidden" name="userid" id="userid" value="<?php echo isset($_SESSION['user']) ? $_SESSION['user'][0]['id'] : ''; ?>">
                <label for="exampleInputEmail1">Select Auditor:</label>
                <select name="hodselectedauditor" class="form-control" id="hodselectedauditor" ></select>
                <span id="hodselectedauditorerror"></span>
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

    <div class="modal fade" id="bccstatusdialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Select HOD</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form id="frmbccaudit"  onsubmit="return false" method = "POST" >
            <div class="form-group">
              <input type="hidden" name="id" id="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
              <input type="hidden" name="userid" id="userid" value="<?php echo isset($_SESSION['user']) ? $_SESSION['user'][0]['id'] : ''; ?>">
                <label for="exampleInputEmail1">Select HOD:</label>
                <select name="bccselectedhod" class="form-control" id="bccselectedhod" ></select>
                <span id="bccselectedhoderror"></span>
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
    let Auditors;
    let Hods;

    function get_modal(){ 
      $("#adddetail").modal('show');
    }


    $("form#frmAdddetail").submit(function (e) { 
        var Amount = $("#Amount").val();      
        var Description = $("#Description").val();      
        var id = $("#id").val();      
        

       var status = false;

        if(Amount == ""){
            $('#Amounterror').html('Amount Cannot be blank').addClass('text-danger');
            status = true;
        }else{
            $('#Amounterror').html(" ");
        }
        if(Description == ""){
            $('#Descriptionrror').html('Description  Cannot be blanck').addClass('text-danger');
            status = true;
        }else{
            $('#Descriptionrror').html(" ");
        }
        
        if(status == false ){
          var data = {'amount': Amount, 'Description':Description, 'refund_id':id }

          console.log(data);

          $.ajax({
              url: "../../../library/request.php?action=add_refundsdetail",
              type: 'POST',
              data: data,
              dataType: 'JSON',
              success:function(data){
                if(data != "" ){
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
        var Amount = $("#frmeditdetail #Amount").val();      
        var Description = $("#frmeditdetail #Description").val();      
        var id = $("#frmeditdetail #refundeid").val();  
        var detailid = $("#frmeditdetail #detailid").val();  

       var status = false;

        if(Amount == ""){
            $('#frmeditdetail #Amounterror').html('Amount Cannot be blank').addClass('text-danger');
            status = true;
        }else{
            $('#frmeditdetail #Amounterror').html(" ");
        }
        if(Description == ""){
            $('#frmeditdetail #Descriptionerror').html('Description Cannot be blanck').addClass('text-danger');
            status = true;
        }else{
            $('#frmeditdetail #Descriptionerror').html(" ");
        }
       

        if(status == false ){
          var data = {'amount': Amount, 'Desription':Desription, 'id':id, 'id': detailid }

          $.ajax({
              url: "../../../library/request.php?action=update_refund_detail",
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

    function deletedetail(id, headerid){
      let url = "../../../library/request.php?action=delete_refund_detail";

      if(confirm("Are you sure you want to delete ?")){
          $.ajax({
            type: "POST",
            url: url,
            data: {'id': id, 'refund_id': headerid} ,
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

    function get_edit_modal(id){
        let url = "../../../library/request.php?action=get_refund_detail_by_id";
       
        $.ajax({
          type: "POST",
          url: url,
          data: {"id":id},
          dataType: "JSON",
          success: function (response) {
            if(response != ""){
              $("#editdetail #emount").val(response.Amount);
              $("#editdetail #edescription").val(response.Description);
              $("#editdetail #detailid").val(response.detailid);
            }

           
          }
         
        });
        $("#editdetail").modal('show');
    }

    function approval_request(id){
      if(confirm("Are you sure you want to request for Approval")){
        let url = "../../../library/request.php?action=refunds_approval_request";

          $.ajax({
            type: "POST",
            url: url,
            data: {"id":id},
            dataType: "JSON",
            success: function (response) {
              if(response == 1){
                alert("Refund sent for Approval");
                window.location.href = "index.php";
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

    function approve(id){
      if(confirm("Are you sure you want to Approve this Refund ? ")){
        let url = "../../../library/request.php?action=approve_refund";

          $.ajax({
            type: "POST",
            url: url,
            data: {"id":id},
            dataType: "JSON",
            success: function (response) {
              if(response == 1){
                alert("Refund Approved Successfully")
                window.location = "approve.php";
              }else{
                alert("Unable to approve refund now, try later");
              }
            }
          });
      }
    }

    $("form#frmreturn").submit(function (e) { 

        var id = $("#refundid").val();      
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

          if(confirm("Are you sure you want to return this ?")){
            let url = "../../../library/request.php?action=returnrefund";

            $.ajax({
              type: "POST",
              url: url,
              data: { 'id':id, 'description':comment, 'userid':userid },
              dataType: "JSON",
              success: function (response) {
                
                  if(response == 1){
                    alert("Refund Returned");
                    window.location = 'index.php';
                  }else{
                    alert("Unable to return refund, try again");
                    window.location.reload();
                  }
              }
            });
          }

          
        }
    });

    $("form#frmaudit").submit(function (e) { 

        var id = $("#frmaudit #id").val();      
        var approvedby = $("#frmaudit #approvedby").val();      
        var userid = $("#frmaudit #userid").val();      
        var status = $("#frmaudit #status").val();   

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
                if(confirm("Are you sure you want to Approve this refund ? ")){

                  let url = "../../../library/request.php?action=refund_auditor_approve";

                  $.ajax({
                    type: "POST",
                    url: url,
                    data: {"id":id, "userid":userid },
                    dataType: "JSON",
                    success: function (response) {
                      if(response == 1){
                        alert("Refund Audited And Approved Successfully");
                        window.location = "audit.php";
                      }else{
                        alert("Unable Approve, try later");
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
                  if(confirm("Are you sure you want to Audit this refund ? ")){
                    let url = "../../../library/request.php?action=refund_audit_set_approval";

                    $.ajax({
                      type: "POST",
                      url: url,
                      data: {"id":id, "userid":userid, "approvedby":approvedby },
                      dataType: "JSON",
                      success: function (response) {
                        if(response == 1){
                          alert("Refund Audited And Sent For Approval");
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
      let url = "../../../library/request.php?action=getapproval";

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

    function hmoapprove(){
      $("#hodstatusdialog #hodselectedauditor").empty();
      $("#hodstatusdialog #hodselectedauditor").append("<option value=''>-- To be Audited By --</option>");
      $.each(Auditors, function (indexInArray, valueOfElement) { 
          $("#hodstatusdialog #hodselectedauditor").append("<option value="+Auditors[indexInArray].id+">"+Auditors[indexInArray].name+"</option>");
      });
      $("#hodstatusdialog").modal("show");
    }

    $("form#frmhodaudit").submit(function (e) { 

        var id = $("#frmhodaudit #id").val();        
        var hodselectedauditor = $("#frmhodaudit #hodselectedauditor").val();   

        var errorstatus = false;

        if(hodselectedauditor == ""){
            $("#frmhodaudit #hodselectedauditorerror").html("Auditor Cannot be empty").addClass('text-danger');
            errorstatus = true;
        }else{
          $('#frmhodaudit #hodselectedauditorerror').html(" ");
          errorstatus = false;
        }


      if(errorstatus == false){
        if(confirm("Are you sure you want to proceed ? ")){

          let url = "../../../library/request.php?action=refund_hod_set_auditor";

          $.ajax({
            type: "POST",
            url: url,
            data: {"id":id, "auditedby":hodselectedauditor },
            dataType: "JSON",
            success: function (response) {
              if(response == 1){
                alert("Sent to Audit Successfully");
                window.location = "hmoapprove.php";
              }else{
                alert("Unable Send for audit, try later");
              }
            }
          });
        }   
      }
        
    });

    function bccapprove(){
      $("#bccstatusdialog #bccselectedhod").empty();
      $("#bccstatusdialog #bccselectedhod").append("<option value=''>Choose HOD</option>");
      $.each(Hods, function (indexInArray, valueOfElement) { 
          $("#bccstatusdialog #bccselectedhod").append("<option value="+Hods[indexInArray].id+">"+Hods[indexInArray].name+"</option>");
      });
      $("#bccstatusdialog").modal("show");
    }

    $("form#frmbccaudit").submit(function (e) { 

        var id = $("#frmbccaudit #id").val();        
        var bccselectedhod = $("#frmbccaudit #bccselectedhod").val();   

        var errorstatus = false;

        if(bccselectedhod == ""){
            $("#frmbccaudit #bccselectedhoderror").html("Auditor Cannot be empty").addClass('text-danger');
            errorstatus = true;
        }else{
          $('#frmbccaudit #bccselectedhoderror').html(" ");
          errorstatus = false;
        }


        if(errorstatus == false){
          if(confirm("Are you sure you want to proceed ? ")){

            let url = "../../../library/request.php?action=refund_bcc_set_auditor";

            $.ajax({
              type: "POST",
              url: url,
              data: {"id":id, "auditedby":bccselectedhod },
              dataType: "JSON",
              success: function (response) {

                if(response == 1){
                  alert("Sent to Audit Successfully");
                  window.location = "hmoapprove.php";
                }else{
                  alert("Unable Send for audit, try later");
                }
              }
            });
          }   
        }

    });

    function get_auditor(){

      let url = "../../../library/request.php?action=getauditor";

      $.ajax({
        type: "POST",
        url: url,
        dataType: "JSON",
        success: function (response) {
            Auditors = response;
        }
      });
    }
    
    function get_hod(){

      let url = "../../../library/request.php?action=gethod";

      $.ajax({
        type: "POST",
        url: url,
        dataType: "JSON",
        success: function (response) {
            Hods = response;
        }
      });
    }

    $(document).ready(function () {
      get_auditor();
      get_approval();
      get_hod();
    });
    
    
</script>