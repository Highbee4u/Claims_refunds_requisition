<?php !isset($_GET['id']) ? header("location:javascript://history.go(-1)") : ''; ?>
<?php  require '../includes/header.php';   ?>
<?php require '../../model/Consultant.php'; ?>
<?php require '../../model/Department.php'; ?>

        <!-- ============================================================== -->
        <?php require '../includes/menu.php'; ?>
<?php $header = $consultant->fetch_by_criterial(array('id'=>$_GET['id']), 'consultings_header')[0]; ?>

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
                    Consult Record Detail For Record ID: <b><?php echo isset($_GET['id']) ? $_GET['id'] : ""; ?></b>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Consult</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Record Detail</li>
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
                                          <td>Record ID</td>
                                          <td><?php echo isset($_GET['id']) ? $_GET['id'] : ""; ?></td>
                                          <td>Record Date:</td>
                                          <td><?php echo isset($header['Created_date']) ? $header['Created_date'] : ""; ?></td>
                                      </tr>
                                      <tr>
                                          <td>Category:</td>
                                          <td><?php echo isset($header['consulttype']) ? $consultant->get_category_name_by_id($header['consulttype']) : ""; ?></td>
                                          <td>Created By:</td>
                                          <td><?php echo isset($header['Enteredby']) ? $user->get_user_name_by_email($header['Enteredby']) : "" ?></td>
                                      </tr>
                                      <tr>
                                          <td>To be Audited By:</td>
                                          <td><?php echo isset($header['Auditedby']) ? $user->get_user_name_by_id($header['Auditedby']) : ""; ?></td>
                                          <td>To be Approved By:</td>
                                          <td><?php echo isset($header['Approvedby']) ? $user->get_user_name_by_id($header['Approvedby']) : ""; ?></td>
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
                                          <td colspan="3"><?php echo isset($header['comment']) ? $header['comment'] : ""; ?></td>
                                        </tr>
                                      <?php } ?>
                                    </table>
                                    <hr>
                                    <h4>Service Detail</h4></div><hr>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                          <tr>
                                              <th>&nbsp;</th>
                                              <th>S/N</th>
                                              <th>Patient Number</th>
                                              <th>Patient Name</th>
                                              <th>Amount</th>
                                              <th>Description</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $data = $consultant->fetch_detail_by_criterial(array('consult_id'=>$_GET['id']));
                                            if(count($data) > 0) {  
                                                $counter = 1; 
                                                $total = 0;
                                            foreach($data as $dt){
                                              $total += $dt['Amount'];
                                            ?>
                                                <tr>
                                                  <?php if($header['approvalRequest'] == 1 || $header['Audited'] == 1 || $header['Approved'] == 1){ ?>
                                                    <td>&nbsp;</td>
                                                  <?php }else{ ?>
                                                <td><a onclick = "deletedetail('<?php echo $dt['id']; ?>', '<?php echo $_GET['id']; ?>')"><i class="fa fa-trash"></i></a> | <a  onclick = "get_edit_modal('<?php echo $dt['id']; ?>')" ><i class="fa fa-edit"></i></a></td>
                                                <?php } ?>
                                                <td> <?php echo $counter ++; ?> </td>
                                                <td><?php echo isset($dt['hospital_no']) ? $dt['hospital_no'] : ""; ?></td>
                                                <td><?php echo isset($dt['Patients_name']) ? $dt['Patients_name'] : ""; ?></td>
                                                <td><?php echo isset($dt['Amount']) ? $dt['Amount'] : ""; ?></td>
                                                <td><?php echo isset($dt['Description']) ? $dt['Description'] : ""; ?></td>
                                                </tr>
                                               
                                            <?php } ?>
                                             <tr><td colspan='4' class='text-right'>Total:</td><td>#<?php echo $total ?></td><td>&nbsp;</td></tr>
                                            <?php  } else { ?>
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
                                          <button class="btn btn-primary" onclick="get_modal('<?php echo $_GET['id'] ?>')">New</button>
                                          <?php if(count($data) < 1 ){ ?>
                                            <a class="btn btn-success disabled"> Request Approval</a>
                                          <?php } else { ?> 
                                          <a class="btn btn-success" style="color: white" onclick="approval_request('<?php echo isset($header['id']) ? $header['id'] : '' ?>')">Request Approval</a>
                                            <?php } ?>
                                      <?php } ?>

                                      <?php if(isset($_SESSION['user']) && $user->canAudit($_SESSION['user'][0]['id']) && ($header['approvalRequest'] == 1) && ($header['Audited'] == 0)) {?>
                                              <a class="btn btn-success" onclick="audit('<?php echo isset($header['id']) ? $header['id'] : '' ?>')">Audit</a>
                                              <button class="btn btn-danger" onclick="get_return_modal('<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>')">Return</button>
                                      <?php } ?>
                                      <?php if(isset($_SESSION['user']) && $user->canApprove($_SESSION['user'][0]['id'])  && ($header['approvalRequest'] == 1) && ($header['Approved'] == 0)) {?>
                                              <a class="btn btn-success" onclick="approve('<?php echo isset($header['id']) ? $header['id'] : '' ?>')">Approve</a>
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
     <div class="modal fade" id="adddetail"  role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add Patient Detail</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form id="frmAdddetail" class="frmAdddetail" onsubmit="return false" method = "POST" >
            <div class="form-group">
                <input type="hidden" name="consult_id" id="consult_id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
                <label for="exampleInputEmail1">Patient ID:</label>
                <input type="text" class="form-control" id="hospital_no" name="hospital_no" required aria-describedby="emailHelp" >
                <span id="hospital_noerror"></span>
                <label for="exampleInputEmail1">Patient Name:</label>
                <input type="text" class="form-control" id="patient_name" name="patient_name" required aria-describedby="emailHelp" >
                <span id="patient_nameerror"></span>
                <label for="exampleInputEmail1">Amount:</label>
                <input type="number" name="amount" class="form-control" id="amount" required>
                <span id="amounterror"></span>
                <label for="exampleInputEmail1">Addtitional Comment:</label>
                <textarea name="comment" class="form-control" id="comment" cols="30" rows="5"></textarea>
                <span id="commenterror"></span>
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
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Patient Detail</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form id="frmeditdetail"  onsubmit="return false" method = "POST" >
          <div class="form-group">
                <input type="hidden" name="consult_id" id="consult_id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
                <input type="hidden" name="id" id="id">
                <label for="exampleInputEmail1">Patient ID:</label>
                <input type="text" class="form-control" id="hospital_no" name="hospital_no" required aria-describedby="emailHelp" >
                <span id="hospital_noerror"></span>
                <label for="exampleInputEmail1">Patient Name:</label>
                <input type="text" class="form-control" id="patient_name" name="patient_name" required aria-describedby="emailHelp" >
                <span id="patient_nameerror"></span>
                <label for="exampleInputEmail1">Amount:</label>
                <input type="number" name="amount" class="form-control" id="amount" required>
                <span id="amounterror"></span>
                <label for="exampleInputEmail1">Addtitional Comment:</label>
                <textarea name="comment" class="form-control" id="comment" cols="30" rows="5"></textarea>
                <span id="commenterror"></span>
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
            <h5 class="modal-title" id="exampleModalLongTitle">Return Record</h5>
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
      
      $("#adddetail").modal('show');
    }

    $("form#frmAdddetail").submit(function (e) { 
        var consult_id = $("#consult_id").val();      
        var hospital_no = $("#hospital_no").val();      
        var Patient_name = $("#patient_name").val();      
        var amount = $("#amount").val();      
        var comment = $("#comment").val();  


       var status = false;

        if(hospital_no == ""){
            $('#hospital_noerror').html('Patirnts No Cannot be blank').addClass('text-danger');
            status = true;
        }else{
            $('#hospital_noerror').html(" ");
        }
        if(Patient_name == ""){
            $('#Patient_nameerror').html('Patient number Cannot be blanck').addClass('text-danger');
            status = true;
        }else{
            $('#Patient_nameerror').html(" ");
        }
        if(amount == ""){
            $('#amounterror').html('Amount Charged Cannot be blanck').addClass('text-danger');
            status = true;
        }else{
            $('#amounterror').html(" ");
        }

        if(status == false ){
          var data = {'Patients_name': Patient_name, 'Amount':amount, 'hospital_no':hospital_no, 'consult_id': consult_id, 'comment':comment }

          $.ajax({
              url: "../../library/request.php?action=add_consult_detail",
              type: 'POST',
              data: data,
              dataType: 'JSON',
              success:function(data){
                if(data == 1){
                  window.location.reload();
                }else{
                  alert("Technical error, unable to create entry, try again");
                }
                  
              }, 
              error: function(error){
                  console.log(error);
              }
          })
        }
    });

    $("form#frmeditdetail").submit(function (e) { 
      var consult_id = $("#frmeditdetail #consult_id").val();      
        var hospital_no = $("#frmeditdetail #hospital_no").val();      
        var Patient_name = $("#frmeditdetail #patient_name").val();      
        var amount = $("#frmeditdetail #amount").val();      
        var comment = $("#frmeditdetail #comment").val(); 
        var id = $("#frmeditdetail #id").val(); 
       var status = false;

       if(hospital_no == ""){
            $('#hospital_noerror').html('Patirnts No Cannot be blank').addClass('text-danger');
            status = true;
        }else{
            $('#hospital_noerror').html(" ");
        }
        if(Patient_name == ""){
            $('#Patient_nameerror').html('Patient number Cannot be blanck').addClass('text-danger');
            status = true;
        }else{
            $('#Patient_nameerror').html(" ");
        }
        if(amount == ""){
            $('#amounterror').html('Amount Charged Cannot be blanck').addClass('text-danger');
            status = true;
        }else{
            $('#amounterror').html(" ");
        }


        if(status == false ){
          var data = {'Patients_name': Patient_name, 'Amount':amount, 'hospital_no':hospital_no, 'consult_id': consult_id, 'comment':comment, 'id':id }

          $.ajax({
              url: "../../library/request.php?action=update_consult_detail",
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
      let url = "../../library/request.php?action=deleteconsultdetail";

      if(confirm("Are you sure you want to delete ?")){
          $.ajax({
            type: "POST",
            url: url,
            data: {'id': id, 'consult_id': headerid} ,
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
        let url = "../../library/request.php?action=get_consult_detail_by_id";
        $.ajax({
          type: "POST",
          url: url,
          data: {"id":id},
          dataType: "JSON",
          success: function (response) {
            if(response != ""){
       
              $("#editdetail #consult_id").val(response[0].consult_id);
              $("#editdetail #hospital_no").val(response[0].hospital_no);
              $("#editdetail #patient_name").val(response[0].Patients_name);
              $("#editdetail #amount").val(response[0].Amount);
              $("#editdetail #comment").val(response[0].Description);
              $("#editdetail #id").val(response[0].id);
            }

           
          }
         
        });
        $("#editdetail").modal('show');
    }

    function approval_request(id){
      if(confirm("Are you sure you want to request for Approval, \n Note that this can\'t be undo and it ends activity for the whole day")){
        let url = "../../library/request.php?action=consult_approval_Request";

          $.ajax({
            type: "POST",
            url: url,
            data: {"id":id},
            dataType: "JSON",
            success: function (response) {
              console.log(response);
              if(response == 1){
                alert("Record sent for Approval");
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

    function approve(id){
      if(confirm("Are you sure you want to Approve this Record ? ")){
        let url = "../../library/request.php?action=approve";

          $.ajax({
            type: "POST",
            url: url,
            data: {"id":id },
            dataType: "JSON",
            success: function (response) {
              if(response == 1){
                alert("Record Approved Successfully")
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
                  alert("Record Returned");
                  window.location = 'index.php';
                }else{
                  alert("Unable to return Record, try again");
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
                if(confirm("Are you sure you want to Approve this Record ? ")){
                  let url = "../../library/request.php?action=audit_approve";

                  $.ajax({
                    type: "POST",
                    url: url,
                    data: {"id":reqid, "userid":userid, "requisitiontype":rectype },
                    dataType: "JSON",
                    success: function (response) {
                      if(response.status == 1){
                        alert("Record Audited And Approved Successfully");
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
                  if(confirm("Are you sure you want to Audit this Record ? ")){
                    let url = "../../library/request.php?action=audit_set_approval";

                    $.ajax({
                      type: "POST",
                      url: url,
                      data: {"id":reqid, "userid":userid, "approvedby":approvedby },
                      dataType: "JSON",
                      success: function (response) {
                        if(response == 1){
                          alert("Record Audited And Approved Successfully");
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
      $('.myitemid').select2();
    });
    
    
</script>