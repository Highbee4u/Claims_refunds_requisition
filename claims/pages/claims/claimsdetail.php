<?php !isset($_GET['id']) ? header("location:javascript://history.go(-1)") : ''; ?>
<?php  require '../includes/header.php';   ?>
<?php require '../../../model/Claim.php'; ?>
<?php require '../../../model/Department.php'; ?>
<?php require '../includes/menu.php'; ?>
<?php $header = $claim->fetch_by_criterial(array('id'=>$_GET['id']), 'claims_header')[0]; ?>

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
                    Claims Detail For Claim ID: <b><?php echo isset($_GET['id']) ? $_GET['id'] : ""; ?></b>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Claims</a></li>
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
                                          <td>Claim ID</td>
                                          <td><?php echo isset($_GET['id']) ? $_GET['id'] : ""; ?></td>
                                          <td>Hospital Number:</td>
                                          <td><?php echo isset($header['hospital_no']) && $header['hospital_no'] != NULL ? $header['hospital_no'] : "Not Applicable"; ?></td>
                                      </tr>
                                      <tr>
                                          <td>Initiated By:</td>
                                          <td><?php echo isset($header['Enteredby']) ? $user->get_user_name_by_email($header['Enteredby']) : "" ?></td>
                                          <td>To be Audited By:</td>
                                          <td><?php echo isset($header['Auditedby']) && !empty($header['Auditedby']) ? $user->get_user_name_by_id($header['Auditedby']) : ""; ?></td>
                                      </tr>
                                      <tr>
                                          <td>Payee Name:</td>
                                          <td><?php echo isset($header['Payee']) && $header['Payee'] != NULL ? $header['Payee'] : "Not Applicable"; ?></td>
                                          <td>Creation Date:</td>
                                          <td><?php echo isset($header['Created_date']) ? $header['Created_date'] : ""; ?></td>
                                      </tr>
                                      <tr>
                                          <td>Bank Name:</td>
                                          <td><?php echo isset($header['bank_name']) && $header['bank_name'] != NULL  ? $header['bank_name'] : "Not Applicable"; ?></td>
                                          <td>Account Name:</td>
                                          <td><?php echo isset($header['account_name']) && $header['account_name'] != NULL ? $header['account_name'] : "Not Applicable"; ?></td>
                                         
                                          
                                      </tr>
                                      <tr>
                                          <td>Account Number:</td>
                                          <td><?php echo isset($header['account_number']) && $header['account_number'] != NULL  ? $header['account_number'] : "Not Applicable"; ?></td>
                                          <td>Total Amount:</td>
                                          <td><?php echo isset($header['Amount']) ? $header['Amount'] : ""; ?></td>
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
                                    <h4>Claims Break Down</h4></div><hr>
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
                                              $data = $claim->fetch_by_criterial(array('claim_id'=>$_GET['id']), 'claims_detail');
                                              if(count($data) > 0) {  
                                                  $counter = 1; 
                                                  $total = 0;
                                              foreach($data as $dt){
                                                $total += $dt['Amount'];
                                                  ?>
                                                      <tr>
                                                        <?php if($header['Audited'] == 1 || $header['Approved'] == 1){ ?>
                                                          <td>&nbsp;</td>
                                                        <?php }else{ ?>
                                                        <td>
                                                          <?php if($header['approvalRequest'] == 1) { ?>
                                                            &nbsp;
                                                          <?php } else { ?>
                                                              <a onclick = "deletedetail('<?php echo $dt['id']; ?>', '<?php echo $_GET['id']; ?>')"><i class="fa fa-trash"></i></a> | <a  onclick = "get_edit_modal('<?php echo $dt['id']; ?>')" ><i class="fa fa-edit"></i></a>
                                                          <?php } ?>
                                                        </td>
                                                        <?php } ?>
                                                        <td> <?php echo $counter ++; ?> </td>
                                                        <td><?php echo isset($dt['Description']) ? $dt['Description'] : "----------"; ?></td>
                                                        <td><?php echo isset($dt['Amount']) ? $dt['Amount'] : ""; ?></td>
                                                      
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
                                      <?php if ((!empty($header))  && $header['approvalRequest'] != 1){ ?>
                                          <button class="btn btn-primary" onclick="get_modal()">New</button>
                                          <a class="btn btn-success" onclick="approval_request('<?php echo isset($header['id']) ? $header['id'] : '' ?>')">Request Approval</a>
                                      <?php } ?>

                                      <?php if(isset($_SESSION['user']) && $user->canAudit($_SESSION['user'][0]['id']) && $header['approvalRequest'] == 1 && $header['Audited'] == 0 ) {?>
                                              <a class="btn btn-success" onclick="audit('<?php echo isset($header['id']) ? $header['id'] : '' ?>')">Audit</a>
                                              <button class="btn btn-danger" onclick="get_return_modal('<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>')">Return</button>
                                      <?php } ?>
                                      <?php if(isset($_SESSION['user']) && $user->canApprove($_SESSION['user'][0]['id'])  && $header['approvalRequest'] == 1 && $header['Approved'] == 0) {?>
                                              <a class="btn btn-success" onclick="approve('<?php echo isset($header['id']) ? $header['id'] : '' ?>')">Approve</a>
                                              <button class="btn btn-danger" onclick="get_return_modal('<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>')">Return</button>

                                      <?php } ?>  
                                      <?php if(isset($_SESSION['user']) && $user->is_hr($_SESSION['user'][0]['id']) && $header['approvalRequest'] == 1 && $header['Audited'] == 0 ) {?>
                                              <a class="btn btn-success" onclick="get_dialog_approval_status_dialog('<?php echo isset($header['id']) ? $header['id'] : '' ?>')">Approve</a>
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
            <h5 class="modal-title" id="exampleModalLongTitle">Add Claims Detail</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form id="frmAdddetail" class="frmAdddetail" onsubmit="return false" method = "POST" >
            <div class="form-group">
              <input type="hidden" name="claimid" id="claimid" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
                <label for="exampleInputEmail1">Amount:</label>
                <input type="number" name="Amount" id="Amount" class="form-control" >
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

    <div class="modal fade" id="editdetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form id="frmeditdetail" class="frmeditdetail" onsubmit="return false" method = "POST" >
            <div class="form-group">
              <input type="hidden" name="eclaimid" id="eclaimid" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
              <input type="hidden" name="edetailid" id="edetailid" >
                <label for="exampleInputEmail1">Amount:</label>
                <input type="number" name="eAmount" id="eAmount" class="form-control" >
                <span id="eAmounterror"></span>
                <label for="exampleInputEmail1">Description:</label>
                <textarea name="eDescription" class="form-control" id="eDescription"></textarea>
                <span id="eDescriptionrror"></span>
            </div>
            
          </div>
          <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="saveeditdetail">Update</button>
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
            <h5 class="modal-title" id="exampleModalLongTitle">Return Claim</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form id="frmreturn"  onsubmit="return false" method = "POST" >
            <div class="form-group">
              <input type="hidden" name="Claimid" id="Claimid" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
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
              <input type="hidden" name="claimid" id="claimid" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
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

    <div class="modal fade" id="hrapprovedialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Audit And Approval Status</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form id="frmhrapprovedialog"  onsubmit="return false" method = "POST" >
            <div class="form-group">
              <input type="hidden" name="claimid" id="claimid" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
              <input type="hidden" name="userid" id="userid" value="<?php echo isset($_SESSION['user']) ? $_SESSION['user'][0]['id'] : ''; ?>">
                 <label for="exampleInputEmail1" id="lbltobeapproved">To be Auited By:</label>
                <select name="auditby" class="form-control" id="auditby" required></select>
                <span id="auditbyerror"></span>
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

    function get_modal(){ 
      $("#adddetail").modal('show');
    }


    $("form#frmAdddetail").submit(function (e) { 

        var Amount = $("#Amount").val();      
        var Description = $("#Description").val();      
        var claimid = $("#claimid").val();      
        

       var status = false;

        if(Amount == ""){
            $('#Amounterror').html('Amount Cannot be blank').addClass('text-danger');
            status = true;
        }else{
            $('#Amounterror').html(" ");
        }
        if(Description == ""){
            $('#Descriptionerror').html('Description  Cannot be blanck').addClass('text-danger');
            status = true;
        }else{
            $('#Descriptionerror').html(" ");
        }
        
        if(status == false ){
          var data = {'Amount': Amount, 'Description':Description, 'claim_id':claimid }

          $.ajax({
              url: "../../../library/request.php?action=add_claimsdetail",
              type: 'POST',
              data: data,
              dataType: 'JSON',
              success:function(data){
                if(data.id != "" || data.id != "undefined"){
                  window.location.reload();
                }else{
                  alert("Unable to add details now, try later");
                }
                  
              }, 
              error: function(error){
                  console.log(error);
              }
          })
        }
    });

    $("form#frmeditdetail").submit(function (e) { 
        var Amount = $("#frmeditdetail #eAmount").val();      
        var Description = $("#frmeditdetail #eDescription").val();      
        var claim_id = $("#frmeditdetail #eclaimid").val();  
        var detailid = $("#frmeditdetail #edetailid").val();  

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
          var data = {'Amount': Amount, 'Description':Description, 'claim_id':claim_id, 'id': detailid }
          // console.log(data);
          $.ajax({
              url: "../../../library/request.php?action=update_claim_detail",
              type: 'POST',
              data: data,
              dataType: 'JSON',
              success:function(response){
                console.log(response);
                // if(data == 1){
                //   window.location.reload();
                // }else{
                //   alert("Unable to make changes, try later");
                // }
                  
              }, 
              error: function(error){
                  console.log(error);
              }
          })
        }
    });

    function deletedetail(id, headerid){
      let url = "../../../library/request.php?action=delete_claim_detail";

      if(confirm("Are you sure you want to delete ?")){
          $.ajax({
            type: "POST",
            url: url,
            data: {'id': id, 'claim_id':headerid} ,
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
        let url = "../../../library/request.php?action=get_claim_detail_by_id";
       
        $.ajax({
          type: "POST",
          url: url,
          data: {"id":id},
          dataType: "JSON",
          success: function (response) {
            console.log(response);
            if(response != ""){
              $("#editdetail #eAmount").val(response[0].Amount);
              $("#editdetail #eDescription").val(response[0].Description);
              $("#editdetail #edetailid").val(response[0].id);

              $("#editdetail").modal('show');
            }
           
          }
         
        });
        $("#editdetail").modal('show');
    }

    function approval_request(id){
      if(confirm("Are you sure you want to request for Approval")){
        let url = "../../../library/request.php?action=claims_approval_request";

          $.ajax({
            type: "POST",
            url: url,
            data: {"id":id},
            dataType: "JSON",
            success: function (response) {
              if(response == 1){
                alert("Claims sent for Approval");
                window.location.href = "index.php";
              }else{
                alert("Unable to request approval, try later");
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
          }else {
            $("#approvalstatusdialog #lbltobeapproved").hide().prop('required',false)
            $("#approvalstatusdialog #approvedby").hide().prop('required',false)
          }
        }
    }

    function approve(id){
      if(confirm("Are you sure you want to Approve this Claim ? ")){
        let url = "../../../library/request.php?action=approve_claim";

          $.ajax({
            type: "POST",
            url: url,
            data: {"id":id},
            dataType: "JSON",
            success: function (response) {
              if(response == 1){
                alert("Claim Approved Successfully")
                window.location = "approve.php";
              }
            }
          });
      }
    }

    $("form#frmreturn").submit(function (e) { 

        var id = $("#Claimid").val();      
        var comment = $("#description").val();      

        var status = false;

        if(comment == ""){
          $("#descriptionerror").html("Comment Field Cannot be emty").addClass("text-danger");
          status = true;
        }else{
          $("#descriptionerror").html("");
        }

        if(status == false){
          if(confirm("Are you sure uou want to return this claims?")){
            let url = "../../../library/request.php?action=returnclaim";

              $.ajax({
                type: "POST",
                url: url,
                data: { 'id':id, 'description':comment },
                dataType: "JSON",
                success: function (response) {
                  
                    if(response == 1){
                      alert("Claim Returned");
                      window.location = 'index.php';
                    }else{
                      alert("Unable to return Claim, try again");
                      window.location.reload();
                    }
                }
              });
          }
          
        }
    });

    $("form#frmaudit").submit(function (e) { 

        var claimid = $("#frmaudit #claimid").val();      
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
                if(confirm("Are you sure you want to Approve this Claim ? ")){
                  let url = "../../../library/request.php?action=claim_audit_approve";

                  $.ajax({
                    type: "POST",
                    url: url,
                    data: {"id":claimid, "userid":userid },
                    dataType: "JSON",
                    success: function (response) {
                      // console.log(response);
                      if(response == 1){
                        alert("Claim Audited And Approved Successfully");
                        window.location = "audit.php";
                      }else{
                        alert("Unable to approve, try again later");
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
                  if(confirm("Are you sure you want to Audit this Claim ? ")){
                    let url = "../../../library/request.php?action=audit_set_claim_for_approval";

                    $.ajax({
                      type: "POST",
                      url: url,
                      data: {"id":claimid, "userid":userid, "approvedby":approvedby },
                      dataType: "JSON",
                      success: function (response) {
                        if(response == 1){
                          alert("Claim Audited And Sent for Approval Successfully");
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

    function get_return_modal(id){
      $("#returndialog").modal("show");
    }

    function get_dialog_approval_status_dialog(){
   
      $("#hrapprovedialog #auditby").empty();
      $("#hrapprovedialog #auditby").append("<option value=''>-- Select Auditor --</option>");
      $.each(Auditors, function (indexInArray, valueOfElement) { 
          $("#hrapprovedialog #auditby").append("<option value="+Auditors[indexInArray].id+">"+Auditors[indexInArray].name+"</option>");
      });
      

      $("#hrapprovedialog").modal('show')
    }

    $("#hrapprovedialog #frmhrapprovedialog").submit(function(e){
        var claimid = $("#claimid").val();      
        var userid = $("#userid").val();      
        var auditby = $("#auditby").val();      

        var status = false;

        if( auditby == ""){
          $("#auditbyerror").html("Auditby Field Cannot be emty").addClass("text-danger");
          status = true;
        }else{
          $("#auditbyerror").html("");
        }

        data = {'id':claimid, 'Auditedby':auditby };

        if(status == false){
          let url = "../../../library/request.php?action=hr_approve_claim";

          if(confirm("Are you sure you want to Approve this claim? \r\n Note: This can not be Reversed"))
              $.ajax({
                type: "POST",
                data: data,
                url: url,
                dataType: "JSON",
                success: function (response) {
                  if(response == 1){
                    alert("Claims Approved");
                    window.location.href = "hrapprove.php";
                  }else{
                    alert("Unable to approve, try again later");
                  }
                }
              });
        }
    });

    $(document).ready(function () {
      get_auditor();
      get_approval();
    });
    
    
</script>