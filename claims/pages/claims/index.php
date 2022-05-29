<?php require '../includes/header.php';   ?>

<?php require_once '../../../model/Claim.php'; ?>
<?php require '../../../model/Department.php'; ?>

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
                        <h4 class="page-title">Claims List</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Claims</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">List</li>
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
                                <button class="btn btn-primary" onclick="create_modal()" ><i class="fa fa-plus "></i>Create Claims</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>&nbsp;</th>
                                                <th>Claim. No</th>
                                                <th>Initiated. By</th>
                                                <th>Staff. No</th>
                                                <th>Category</th>
                                                <th>Payee Name</th>
                                                <th>Return Status</th>
                                                <th>Returned By</th>
                                                <th>Hr Status</th>
                                                <th>Auditor Status</th>
                                                <th>MD Status</th>
                                                <th>Paymt. Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                if($_SESSION['user'][0]['user_roleid'] == -1 || $_SESSION['user'][0]['user_roleid'] == 1 || $_SESSION['user'][0]['user_roleid'] == 2 || $_SESSION['user'][0]['user_roleid'] == 4 || $_SESSION['user'][0]['user_roleid'] == 5 || $_SESSION['user'][0]['user_roleid'] == 7 || $_SESSION['user'][0]['user_roleid'] == 8){
                                                    $data = $claim->fetch_all();
                                                }else{
                                                    $data = $claim->fetch_by_criterial(array('Enteredby'=>$_SESSION['user'][0]['email']), 'claims_header');
                                                }
                                                
                                                if(count($data) > 0) {   
                                                foreach($data as $dt){ 
                                            ?>
                                                <tr>
                                                <td>
                                                    <?php if($dt['approvalRequest'] == 0) { ?>
                                                        <a href="claimsdetail.php?id=<?php echo $dt['id']; ?>"><i class='fa fa-edit'></i></a>
                                                        <a onclick ="delete_claims('<?php echo $dt['id']; ?>')"><i class='fa fa-trash'></i></a>
                                                    <?php } else{ ?>  
                                                        <a href="view.php?id=<?php echo $dt['id']; ?>"><i class="fa fa-eye"></i></i></a>
                                                    <?php }  ?>
                                                        <a href="printable.php?id=<?php echo $dt['id']; ?>"><i class="fa fa-print"></i></a>
                                                
                                                </td>
                                                <td><?php echo $dt['id']; ?></td>
                                                <td><?php echo isset($dt['Enteredby']) ? $user->get_user_name_by_email($dt['Enteredby']) : ""; ?></td>
                                                <td><?php echo isset($dt['hospital_no']) && $dt['hospital_no'] != "" ? $dt['hospital_no'] : "<span class='bg-danger' style = 'color: white'>Not Applicable</span>"; ?></td>
                                                <td><?php echo isset($dt['claim_categoryid']) ? $claim->get_category_name_by_id($dt['claim_categoryid']) : ""; ?></td>
                                                <td><?php echo isset($dt['Payee']) && $dt['Payee'] !="" ? $dt['Payee'] : "<span class='bg-danger' style = 'color: white'>Not Applicable</span>"; ?></td>
                                                <td><?php echo isset($dt['returned']) && $dt['returned'] == 1 ? "<span class='bg-danger blink_text' style = 'color: white'>Returned</span><br>".$dt['returneddate']  : '---------'; ?></td>
                                                <td><?php echo isset($dt['returnedby']) && $dt['returnedby'] != NULL ? $user->get_user_name_by_id($dt['returnedby'])  : '---------'; ?></td>
                                                <td>
                                                    <?php if($dt['hrrequired'] == 1){ ?>
                                                        <?php if($dt['hrstatus'] == 1) {?>
                                                            <span class="bg-success" style = "color: white">Approved</span><br><?php echo $dt['hrapproveddate']; ?>
                                                        <?php } else { ?>
                                                            <span class="bg-danger" style="color: white">Pending</span>
                                                        <?php } ?>
                                                    <?php }  else { ?>
                                                        <span class="bg-danger" style ="color: white"">NOT Applicable</span>
                                                    <?php } ?>          

                                                </td>
                                                <td>
                                                    <?php 
                                                        if($dt['returned'] == 1){
                                                            echo '------------'; 
                                                        }else{
                                                            if($dt['Audited'] == 0 ){ 
                                                                echo '<span class="bg-danger" style = "color: white">Pending</span>'; 
                                                            } else { 
                                                                echo '<span class="bg-success" style = "color: white">Approved</span><br>'.$dt['auditeddate']; 
                                                            }
                                                        }
                                                     ?>
                                                </td>
                                                
                                                <td>
                                                    <?php 
                                                        if($dt['returned'] == 1){
                                                            echo '------------'; 
                                                        }else{
                                                            if($dt['Approved'] == 0){ 
                                                                echo '<span class="bg-danger" style = "color: white">Pending</span>'; 
                                                            } else if($dt['Approved'] == 1 ){ 
                                                            echo '<span class="bg-success" style = "color: white">Approved</span><br>'.$dt['Approveddate'];  
                                                            }
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        if($dt['returned'] == 1){
                                                            echo '------------'; 
                                                        }else{
                                                            if($dt['Accounting_status'] == 0){ 
                                                                echo '<span class="bg-danger" style = "color: white">Pending</span>'; 
                                                            } else if($dt['Accounting_status'] == 1 ){ 
                                                                echo '<span class="bg-success" style = "color: white">Approved</span><br>'.$dt['payment_date']; 
                                                            }
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo isset($dt['Created_date']) ? $dt['Created_date'] : "" ?></td>
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
    <div class="modal fade" id="addclaims" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Create New Claims</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form id="frmClaims" method="POST" name="frmClaims" onsubmit="return false">
            <div class="form-group">
                <input type="hidden" class="form-control" id="enteredby" required aria-describedby="emailHelp" disabled>
                <input type="hidden" class="form-control" id="departmentid" required aria-describedby="emailHelp" disabled>
                <label for="exampleInputEmail1" id="lblPayeename">Payees Name:</label>
                <input type="text" name="payee" class="form-control" id="payee" required ></textarea>
                <span id="payeeerror"></span>
                <label for="exampleInputEmail1" id="lblhospitalno">Staff Number (If Applicable):</label>
                <input type="text" name="hospitalno" class="form-control" id="hospitalno"></textarea>
                <span id="hospitalnoerror"></span>
                <label for="exampleInputEmail1">Account No (If Applicable):</label>
                <input type="text" name="account_number" class="form-control" id="account_number" ></textarea>
                <span id="accountnumbererror"></span>
                <label for="exampleInputEmail1">Account Name (If Applicable):</label>
                <input type="text" name="account_name" class="form-control" id="account_name" ></textarea>
                <span id="accountnameerror"></span>
                <label for="exampleInputEmail1">Bank Name (If Applicable):</label>
                <input type="text" name="bank_name" class="form-control" id="bank_name" ></textarea>
                <span id="banknameerror"></span>
                <label for="exampleInputEmail1">Select HOD:</label>
                <select name="hod" class="form-control" id="hod" required ></select>
                <span id="hodstatuserror"></span>
                <!-- <label for="exampleInputEmail1">Auditor Status:</label>
                <select name="auditstatus" class="form-control" id="auditstatus" onchange="get_audit_status(this)" required >
                    <option value="">-- Send status --</option>
                    <option value="Auditor">Send to Auditor</option>
                    <option value="hr">Send to HR</option>
                </select>
                <span id="auditstatuserror"></span> -->
                <div id="divauditor">
                    <label for="exampleInputEmail1">To be Audited By:</label>
                    <select name="auditedby" class="form-control" id="auditedby"  ></select>
                    <span id="auditedbyerror"></span>
                </div>
                <div id="divhr">
                    <label for="exampleInputEmail1">Select HR:</label>
                    <select name="hr" class="form-control" id="hr" ></select>
                    <span id="hrerror"></span>
                </div>

                <label for="lblstaffname" id="lblclaimscat">Claims Category Name:</label>
                <div class="form-control">
                <select name="claimscategory" id="claimscategory" class="form-control js-example-basic-single" ></select>
                <span id="claimscategoryerror"></span>
                </div>
            </div>
            
          </div>
          <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="frmCreateclaims">Create</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            
          </div>
          </form>
        </div>
      </div>
    </div>

<?php  require '../includes/footer.php'; ?>
<script>
  let Auditors;
  let Approvals;
  let claimcategory;
  let hrlist;
  let hodlist;

  function get_hod(){

    let url = "../../../library/request.php?action=gethod";

    $.ajax({
      type: "POST",
      url: url,
      dataType: "JSON",
      success: function (response) {
          hodlist = response;
      }
    });
  }
//   function get_auditor(){

//     let url = "../../../library/request.php?action=getauditor";

//     $.ajax({
//       type: "POST",
//       url: url,
//       dataType: "JSON",
//       success: function (response) {
//           Auditors = response;
//       }
//     });
//   }

//   function get_hr(){

//     let url = "../../../library/request.php?action=gethr";

//     $.ajax({
//       type: "POST",
//       url: url,
//       dataType: "JSON",
//       success: function (response) {
//           hrlist = response;
//       }
//     });
//   }

  function delete_claims(id){
    if(confirm("Are you sure you want to delete ?")){
      let url = "../../../library/request.php?action=deleteclaims";

      $.ajax({
        type: "POST",
        url: url,
        data: {"id":id},
        dataType: "JSON",
        success: function (response) {
            if(response == 1){
              alert("Claims Deleted");
              window.location.reload();
            }else{
              alert("Unable to delete");
            }
        }
      });
    }
    
  }


  function create_modal(){

    // $("#addclaims #auditedby").empty();
    // $("#addclaims #auditedby").append("<option value=''>-- Select Auditor --</option>");
    // $.each(Auditors, function (indexInArray, valueOfElement) { 
    //     $("#addclaims #auditedby").append("<option value="+Auditors[indexInArray].id+">"+Auditors[indexInArray].name+"</option>");
    // });

    $("#addclaims #hod").empty();
    $("#addclaims #hod").append("<option value=''>-- Select HOD --</option>");
    $.each(hodlist, function (indexInArray, valueOfElement) { 
        $("#addclaims #hod").append("<option value="+hodlist[indexInArray].id+">"+hodlist[indexInArray].name+"</option>");
    });
    
    $("#addclaims #claimscategory").empty();
    $("#addclaims #claimscategory").append("<option value=''>-- Select Category --</option>");
    $.each(claimcategory, function (indexInArray, valueOfElement) { 
        $("#addclaims #claimscategory").append("<option value="+claimcategory[indexInArray].id+">"+claimcategory[indexInArray].name+"</option>");
    });

    // $("#addclaims #hr").empty();
    // $("#addclaims #hr").append("<option value=''>-- Select HR --</option>");
    // $.each(hrlist, function (indexInArray, valueOfElement) { 
    //     $("#addclaims #hr").append("<option value="+hrlist[indexInArray].id+">"+hrlist[indexInArray].name+"</option>");
    // });


    $("#addclaims #enteredby").val("<?php echo isset($_SESSION['user']) ? $_SESSION['user'][0]['email'] : "" ; ?>");
    $("#addclaims #departmentid").val("<?php echo isset($_SESSION['user']) ? $_SESSION['user'][0]['departmentid'] : "" ; ?>");


        $("#addclaims #divauditor").hide();
        $("#addclaims #divhr").hide();


      $("#addclaims").modal('show');
  }

  $('form#frmClaims').submit(function(){

    var enteredby = $('#enteredby').val();
    var hospitalno = $('#hospitalno').val();
    var department = $('#departmentid').val();
    var payee = $('#payee').val();
    var claimscategory = $('#claimscategory').val();
    var account_number = $('#account_number').val();
    var account_name = $('#account_name').val();
    var bank_name = $('#bank_name').val();
    var hod = $('#hod').val();
    
        var status = "";

          
            
            if(payee == ""){
                $('#payeeerror').html('Payee name cannot be empty').addClass('text-danger');
                status = true;
            }else{
                $('#payeeerror').html(" ");
            }
            if(claimscategory == ""){
                $('#claimscategoryerror').html('Claim Category cannot be empty for staff claims').addClass('text-danger');
                status = true;
            }else{
                $('#claimscategoryerror').html(" ");
            }

        var data;
       
        if(status != true){
            data = {
                'Enteredby': enteredby, 
                'departmentid':department,
                'hospital_no': hospitalno, 
                'Payee': payee, 
                'returned': 0,
                'claim_categoryid':claimscategory,
                'account_number':account_number,
                'account_name':account_name,
                'bank_name':bank_name,
                'hodname':hod,
                'hod': 1
            }
            console.log(data);
            
            $.ajax({
                url: "../../../library/request.php?action=createclaimsheader",
                type: 'POST',
                data: data,
                dataType: 'JSON',
                success:function(data){
                    if(data.id != "" || data.id != "undefined")
                    window.location = "claimsdetail.php?id="+data.id;
                    else
                    alert("Unable to Create Claim, try lategr");
                }, 
                error: function(error){
                    console.log(error);
                }
            })
            
        }

    
  });
  function get_audit_status(id){


      if(id.value == "Auditor"){

        $("#addclaims #divauditor").show();
        $("#addclaims #divhr").hide();

      }else if(id.value == "hr"){
        $("#addclaims #divauditor").hide();
        $("#addclaims #divhr").show();
      }
  }



  function get_claims_category(){
    let url = "../../../library/request.php?action=getcateorylist";

        $.ajax({
            type: "POST",
            url: url,
            dataType: "JSON",
            success: function (response) {
                claimcategory = response;
            }
        });
  }

  $(document).ready(function () {
    // get_auditor();
    get_claims_category();
    // get_hr();
    get_hod();
  });

</script>