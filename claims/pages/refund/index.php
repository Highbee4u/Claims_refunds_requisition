<?php require '../includes/header.php';   ?>

<?php require_once '../../../model/Refund.php'; ?>
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
                        <h4 class="page-title">Refunds List(s)</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Refunds</a></li>
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
                                <button class="btn btn-primary" onclick="create_modal()" ><i class="fa fa-plus "></i>Create Refund</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>&nbsp;</th>
                                                <th>Refund. No</th>
                                                <th>Initiated. By</th>
                                                <th>Hospt. No</th>
                                                <th>Patient Name</th>
                                                <th>Account Name</th>
                                                <th>Account Number</th>
                                                <th>Amount</th>
                                                <th>Return Status</th>
                                                <th>HOD Status</th>
                                                <th>Auditor Status</th>
                                                <th>MD Status</th>
                                                <th>Paymt. Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                 if($_SESSION['user'][0]['user_roleid'] == -1 || $_SESSION['user'][0]['user_roleid'] == 1 || $_SESSION['user'][0]['user_roleid'] == 2 || $_SESSION['user'][0]['user_roleid'] == 3 || $_SESSION['user'][0]['user_roleid'] == 4 || $_SESSION['user'][0]['user_roleid'] == 5 || $_SESSION['user'][0]['user_roleid'] == 7 || $_SESSION['user'][0]['user_roleid'] == 8){
                                                    $data = $refund->fetch_all();
                                                }else{
                                                    $data = $refund->fetch_by_criterial(array('Enteredby'=>$_SESSION['user'][0]['email']), 'refunds_header');
                                                }
                                                
                                                if(count($data) > 0) {   
                                                foreach($data as $dt){ 
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php if($dt['approvalRequest'] == 0) { ?>
                                                        <a href="detail.php?id=<?php echo $dt['id']; ?>"><i class='fa fa-edit'></i></a>
                                                        <a onclick ="delete_refund('<?php echo $dt['id']; ?>')"><i class='fa fa-trash'></i></a>
                                                    <?php } else{ ?>  
                                                        <a href="view.php?id=<?php echo $dt['id']; ?>"><i class="fa fa-eye"></i></i></a>
                                                    <?php }  ?>
                                                        <a href="printable.php?id=<?php echo $dt['id']; ?>"><i class="fa fa-print"></i></a>
                                                
                                                </td>
                                                <td><?php echo $dt['id']; ?></td>
                                                <td><?php echo isset($dt['enteredby']) ? $user->get_user_name_by_email($dt['enteredby']) : ""; ?></td>
                                                <td><?php echo isset($dt['hospital_no']) && $dt['hospital_no'] != '0' ? $dt['hospital_no'] : "---"; ?></td>
                                                <td><?php echo $dt['patient_name']; ?></td>
                                                <td><?php echo isset($dt['account_name']) && $dt['account_name'] !="" ? $dt['account_name'] : "--------------"; ?></td>
                                                <td><?php echo isset($dt['account_number']) && $dt['account_number'] !="" ? $dt['account_number'] : "--------------"; ?></td>
                                                <td><?php echo isset($dt['amount']) && $dt['amount'] !="" ? $dt['amount'] : "--------------"; ?></td>
                                                <td><?php echo isset($dt['returned']) && $dt['returned'] == 1 ? "<span class='bg-danger blink_text' style = 'color: white'>Returned</span>" : '------'; ?></td>
                                                <td>
                                                    <?php if(isset($dt['hodrequired']) && $dt['hodrequired'] == 1){
                                                        echo isset($dt['is_hod']) && $dt['is_hod'] == 1 ? "<span class='bg-danger' style = 'color: white'>Pending</span>" : "<span class='bg-success' style = 'color: white'>Approved</span><br>".$dt['hodapproveddate'];  
                                                    }else{
                                                        echo "<span class='bg-danger' style = 'color: white'>Not Applicable</span>";
                                                    }
                                                    ?></td>
                                                <td>
                                                    <?php 
                                                        if($dt['returned'] == 1){
                                                            echo '------'; 
                                                        }else{
                                                            if($dt['audited'] == 0 ){ 
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
                                                            echo '-----'; 
                                                        } else { 
                                                            if($dt['approval'] == 0){ 
                                                                echo '<span class="bg-danger" style = "color: white">Pending</span>'; 
                                                            } else if($dt['approval'] == 1 ){ 
                                                            echo '<span class="bg-success" style = "color: white">Approved</span><br>'.$dt['approveddate']; 
                                                            }
                                                        }
                                                     ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        if($dt['returned'] == 1){
                                                            echo '-----'; 
                                                        }else{
                                                            if($dt['accountant_status'] == 0){ 
                                                                echo '<span class="bg-danger" style = "color: white">Pending</span>'; 
                                                            } else if($dt['accountant_status'] == 1 ){ 
                                                                if(isset($dt['paidby']) && $dt['paidby'] != NULL){ 
                                                                    echo '<span class="bg-success" style = "color: white">Approved</span><br> By: '.$user->get_user_name_by_id($dt['paidby']);
                                                                }else{
                                                                    echo '<span class="bg-success" style = "color: white">Approved</span>';
                                                                }
                                                            }
                                                        }
                                                     ?>
                                                </td>
                                                </tr>
                                            <?php } } else { ?>
                                                <tr>
                                                    <td colspan="11" class="text-center">No Record To Display</td>
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
    <div class="modal fade" id="addrefunds" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Create New Refund</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form id="frmClaims" method="POST" name="frmClaims" onsubmit="return false">
            <div class="form-group">
                <input type="hidden" class="form-control" id="enteredby" required aria-describedby="emailHelp" disabled>
                <input type="hidden" class="form-control" id="departmentid" required aria-describedby="emailHelp" disabled>
                <label for="exampleInputEmail1">Hospital Number:</label>
                <input type="text" name="hospitalno" class="form-control" id="hospitalno" required ></textarea>
                <span id="hospitalnoerror"></span>
                <label for="exampleInputEmail1">Patient's Name:</label>
                <input type="text" name="patientname" class="form-control" id="patientname" required ></textarea>
                <span id="patientnameerror"></span>
                <label for="exampleInputEmail1">Account No:</label>
                <input type="text" name="account_number" class="form-control" id="account_number" required ></textarea>
                <span id="accountnumbererror"></span>
                <label for="exampleInputEmail1">Account Name:</label>
                <input type="text" name="account_name" class="form-control" id="account_name" required ></textarea>
                <span id="accountnameerror"></span>
                <label for="exampleInputEmail1">Bank Name:</label>
                <input type="text" name="bank_name" class="form-control" id="bank_name" required ></textarea>
                <span id="banknameerror"></span>
                <label for="exampleInputEmail1">Refund Type:</label>
                <select name="refundtype" class="form-control" id="refundtype" onchange="selectedoption(this)" required >
                    <option value="">Choose...</option>
                    <option value="private">PRIVATE</option>
                    <option value="hmo">HMO</option>
                </select>
                <span id="refundtypeerror"></span>
                <div id="item"></div>
            </div>
            
          </div>
          <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="frmCreaterefunds">Create</button>
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
  let bccs;
  let hods;

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

  function get_bcc(){

    let url = "../../../library/request.php?action=getbcc";

    $.ajax({
      type: "POST",
      url: url,
      dataType: "JSON",
      success: function (response) {
          bccs = response;
      }
    });
  }

  function get_hods(){

    let url = "../../../library/request.php?action=gethod";

    $.ajax({
      type: "POST",
      url: url,
      dataType: "JSON",
      success: function (response) {
          hods = response;
      }
    });
  }

  function delete_refund(id){
    if(confirm("Are you sure you want to delete ?")){
      let url = "../../../library/request.php?action=deleterefund";

      $.ajax({
        type: "POST",
        url: url,
        data: {"id":id},
        dataType: "JSON",
        success: function (response) {
            if(response == 1){
              alert("Refund Deleted");
              window.location.reload();
            }else{
              alert("Unable to delete");
            }
        }
      });
    }
    
  }


  function create_modal(){

    $("#addrefunds #auditedby").empty();
    $("#addrefunds #auditedby").append("<option value=''>-- Select Auditor --</option>");
    $.each(Auditors, function (indexInArray, valueOfElement) { 
        $("#addrefunds #auditedby").append("<option value="+Auditors[indexInArray].id+">"+Auditors[indexInArray].name+"</option>");
    });


    $("#addrefunds #enteredby").val("<?php echo isset($_SESSION['user']) ? $_SESSION['user'][0]['email'] : "" ; ?>");
    $("#addrefunds #departmentid").val("<?php echo isset($_SESSION['user']) ? $_SESSION['user'][0]['departmentid'] : "" ; ?>");

      $("#addrefunds").modal('show');
  }

  $('form#frmClaims').submit(function(){

    var enteredby = $('#enteredby').val();
    var auditedby = $('#auditedby').val();
    var hospitalno = $('#hospitalno').val();
    var patientname = $('#patientname').val();
    var department = $('#departmentid').val();
    var account_number = $('#account_number').val();
    var account_name = $('#account_name').val();
    var bank_name = $('#bank_name').val();
    var refundtype = $('#refundtype').val();
    var hod = $('#hod').val();
    var bcc = $('#bcc').val();
    var is_hod;
    var is_bcc;
    var hodrequired = 0;


        var status = "";

        if(refundtype == "hmo"){
            if(bcc == ""){
                $('#bccerror').html('Bcc cannot be empty').addClass('text-danger');
                status = true;
            }else{
                $('#bccerror').html(" ");
            }
            is_bcc = 1;
        }else if(refundtype == "private"){
            if(hod == ""){
                $('#hoderror').html('hod by cannot be empty').addClass('text-danger');
                status = true;
            }else{
                $('#hoderror').html(" ");

            }
            is_hod = 1;
            hodrequired = 1;
        }

        if(auditedby == ""){
            $('#auditedbyerror').html('Audited by cannot be empty').addClass('text-danger');
            status = true;
        }else{
            $('#auditedbyerror').html(" ");
        }
        if(hospitalno == ""){
            $('#hospitalnoerror').html('Hospital No cannot be empty').addClass('text-danger');
            status = true;
        }else{
            $('#hospitalnoerror').html(" ");
        }
        if(patientname == ""){
            $('#patientnameerror').html('Patient\'s\ cannot be empty').addClass('text-danger');
            status = true;
        }else{
            $('#patientnameerror').html(" ");
        }
        if(account_number == ""){
            $('#accountnumbererror').html('Account cannot be empty').addClass('text-danger');
            status = true;
        }else{
            $('#accountnumbererror').html(" ");
        }
        if(account_name == ""){
            $('#accountnameerror').html('Account name cannot be empty').addClass('text-danger');
            status = true;
        }else{
            $('#accountnameerror').html(" ");
        }
        if(bank_name == ""){
            $('#banknameerror').html('Bank Name cannot be empty').addClass('text-danger');
            status = true;
        }else{
            $('#banknameerror').html(" ");
        }
       

        if(status != true){
            
            var data = {'enteredby': enteredby, 'hospital_no': hospitalno, 'auditedby':auditedby, 'patient_name':patientname, 'departmentid':department, 'account_number': account_number, 'account_name':account_name, 'bank_name':bank_name, 'is_hod':is_hod, 'is_bcc':is_bcc,'bcc':bcc, 'hod':hod, 'hodrequired':hodrequired }
            $.ajax({
                url: "../../../library/request.php?action=createrefundsheader",
                type: 'POST',
                data: data,
                dataType: 'JSON',
                success:function(data){
                    if(data.id != "undefined" || data.id != "")
                        window.location = "detail.php?id="+data.id;
                    else
                        alert("Unable to create Refund, try again later");
                }, 
                error: function(error){
                    console.log(error);
                }
            })
        }

    
  });

  function selectedoption(option){
        var hoddata = '<label for="exampleInputEmail1">Select HOD:</label><select name="hod" class="form-control" id="hod" ></select><span id="hoderror"></span>';

        var bccdata = '<label for="exampleInputEmail1">Select BCC:</label><select name="bcc" class="form-control" id="bcc" ></select><span id="bccerror"></span>';

        var datatoappend;

        if(option.value == "private"){
            datatoappend = hoddata;
            
            $("#addrefunds #item").empty();
            $("#addrefunds #item").append(datatoappend);

            $("#addrefunds #hod").empty();
            $("#addrefunds #hod").append("<option value=''>-- Select hod --</option>");
            $.each(hods, function (indexInArray, valueOfElement) { 
                $("#addrefunds #hod").append("<option value="+hods[indexInArray].id+">"+hods[indexInArray].name+"</option>");
            });

        }else if(option.value == "hmo"){
            datatoappend = bccdata;
            
            $("#addrefunds #item").empty();
            $("#addrefunds #item").append(datatoappend);

            $("#addrefunds #bcc").empty();
            $("#addrefunds #bcc").append("<option value=''>-- Select bcc --</option>");
            $.each(bccs, function (indexInArray, valueOfElement) { 
                $("#addrefunds #bcc").append("<option value="+bccs[indexInArray].id+">"+bccs[indexInArray].name+"</option>");
            });

        }
        
  }
  

  $(document).ready(function () {
    get_bcc();
    get_hods();
    get_auditor();
  });

</script>