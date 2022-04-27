<?php require '../includes/header.php';   ?>

<?php require_once '../../../model/Refund.php'; ?>
<?php require '../../../model/Department.php'; ?>
<?php require '../../../model/User.php'; ?>
<?php $userslist = $user->fetch_all(); ?>

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
                        <h4 class="page-title">Refunds History List(s)</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Refunds</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">History</li>
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

                    <div class="col-md-12">
                      <div class="card">
                          <di class="card-header">Filters</di>
                          <div class="card-body">
                              <form method="post" id="frmfilter" onsubmit="return false">
                                  <div class="form-group">
                                      <label for="">User</label>
                                      <select name="filter" id="filter" class="form-control" onchange="myfilter(this.value)">
                                          <option value="">Select User..</option>
                                          <?php foreach($userslist as $users){ ?>
                                              <option value="<?php echo $users['email']; ?>"><?php echo $users['name']; ?></option>
                                          <?php } ?>
                                      </select>
                                      <span id="filtererror"></span>
                                  </div>
                                  <div class="form-group d-flex justify-content-between">
                                      <button type="submit" class="btn btn-primary btn-sm" onclick="clear_filter()">Clear Filter</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="card">
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
                                                <th>HOD</th>
                                                <th>Auditor Status</th>
                                                <th>MD Status</th>
                                                <th>Paymt. Status</th>
                                                <th>Paymt. Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if(isset($_GET['filter']) && !empty($_GET['filter'])){
                                              $data = $refund->fetch_by_criterial(array('approval'=>1, 'audited'=> 1, 'approvalRequest'=> 1, 'enteredby'=>$_GET['filter']), 'refunds_header');
                                            } else{
                                              $data = $refund->fetch_by_criterial(array('approval'=>1, 'audited'=> 1, 'approvalRequest'=> 1), 'refunds_header');
                                            }
                                               
                                                if(count($data) > 0) {   
                                                foreach($data as $dt){ 
                                            ?>
                                            <tr>
                                                <td>
                                                    <a href="view.php?id=<?php echo $dt['id']; ?>"><i class="fa fa-eye"></i></i></a>
                                                    <a href="printable.php?id=<?php echo $dt['id']; ?>"><i class="fa fa-print"></i></a>
                                                </td>
                                                <td><?php echo $dt['id']; ?></td>
                                                <td><?php echo isset($dt['enteredby']) ? $user->get_user_name_by_email($dt['enteredby']) : ""; ?></td>
                                                <td><?php echo isset($dt['hospital_no']) && $dt['hospital_no'] != '0' ? $dt['hospital_no'] : "---"; ?></td>
                                                <td><?php echo $dt['patient_name']; ?></td>
                                                <td><?php echo isset($dt['account_name']) && $dt['account_name'] !="" ? $dt['account_name'] : "--------------"; ?></td>
                                                <td><?php echo isset($dt['account_number']) && $dt['account_number'] !="" ? $dt['account_number'] : "--------------"; ?></td>
                                                <td><?php echo isset($dt['amount']) && $dt['amount'] !="" ? $dt['amount'] : "--------------"; ?></td>
                                                <td><?php echo isset($dt['is_hod']) && $dt['is_hod'] == 1 ? "<span class='bg-danger'>Pending</span>" : "<span class='bg-success'>Approved</span>"; ?></td>
                                                <td><?php if($dt['audited'] == 0 ){ 
                                                            echo '<span class="bg-danger" style = "color: white">Pending</span>'; 
                                                    } else { 
                                                    echo '<span class="bg-success" style = "color: white">Approved</span>'; 
                                                    } ?>
                                                </td>
                                                <td><?php if($dt['approval'] == 0){ 
                                                            echo '<span class="bg-danger" style = "color: white">Pending</span>'; 
                                                    } else if($dt['approval'] == 1 ){ 
                                                    echo '<span class="bg-success" style = "color: white">Approved</span>'; 
                                                    } ?>
                                                </td>
                                                <td><?php if($dt['accountant_status'] == 0){ ?>
                                                               <?php if($user->is_accountant($_SESSION['user'][0]['id'])) { ?>
                                                                    <button class="btn btn-xs btn-primary" onclick="update_payment_status('<?php echo $dt['id'] ?>')">Update</button>
                                                               <?php } else { 
                                                                    echo '<span class="bg-danger" style = "color: white">Pending</span>'; 
                                                                } ?> 
                                                    <?php } else if($dt['accountant_status'] == 1 ){ 
                                                        echo '<span class="bg-success" style = "color: white">Paid</span>'; 
                                                        } ?>
                                                    </td>
                                                    <td><?php if($dt['payment_date'] == "0000-00-00" || $dt['payment_date'] == NULL){ 
                                                                echo ' -------- '; 
                                                        } else if($dt['payment_date'] != "0000-00-00" ){ 
                                                                echo $dt['payment_date']; 
                                                        } ?>
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
                <label for="exampleInputEmail1">To be Audited By:</label>
                <select name="auditedby" class="form-control" id="auditedby" required ></select>
                <span id="auditedbyerror"></span>
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

  let base_url = "http://localhost/requisitionclaims/claims/pages/refund/history.php";

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


        var status = "";

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
            
            var data = {'enteredby': enteredby, 'hospital_no': hospitalno, 'auditedby':auditedby, 'patient_name':patientname, 'departmentid':department, 'account_number': account_number, 'account_name':account_name, 'bank_name':bank_name }
            $.ajax({
                url: "../../../library/request.php?action=createrefundsheader",
                type: 'POST',
                data: data,
                dataType: 'JSON',
                success:function(data){
                    window.location = "detail.php?id="+data.id;
                }, 
                error: function(error){
                    console.log(error);
                }
            })
        }

    
  });
  
  function update_payment_status(id){
      if(id.length != ""){
          if(confirm("Are you sure you have made payment!?\r\n this cannot be Reverse")){
            $.ajax({
                url: "../../../library/request.php?action=updaterefundpaymentstatus",
                type: 'POST',
                data: {"id":id},
                dataType: 'JSON',
                success:function(data){
                    if(data == 1){
                        alert("Payment Status Updated Successfully");
                        window.location.reload();
                    }else{
                        alert("Unable to update status, try later");
                    }
                    
                }, 
                error: function(error){
                    console.log(error);
                }
            })
          }
      }
  }

  function myfilter(param){
        if(param.length != ""){
            window.location.href = base_url + "?filter="+param;
        }
  }

  function clear_filter(){
      window.location.href = base_url;
  }

  $(document).ready(function () {
    // get_approval();
    get_auditor();
  });

</script>