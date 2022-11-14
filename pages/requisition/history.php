<?php require '../includes/header.php'; ?>
<?php require '../../model/Requisition.php'; ?>
<?php require '../../model/Department.php'; ?>
<?php require '../../model/User.php'; ?>


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
                        <h4 class="page-title">Requisition History</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Requisition</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">History List</li>
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
                                            <select name="filter" id="filter" class="form-control" onchange="myfilter(this.value)"></select>
                                            <span id="filtererror"></span>
                                        </div>
                                        <div class="form-group d-flex justify-content-between">
                                            <button type="submit" class="btn btn-primary btn-sm" onclick="clear_filter()">Clear Filter</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="row">
                    
                        
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="zero_config" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>&nbsp;</th>
                                                    <th>Req. No</th>
                                                    <th>Req. By</th>
                                                    <th>Department</th>
                                                    <th>Req. Date</th>
                                                    <th>Comment</th>
                                                    <th>Procmnt Status</th>
                                                    <th>Auditor Status</th>
                                                    <th>MD Status</th>
                                                    <th>Paymt. Status</th>
                                                    <?php  if($user->is_accountant($_SESSION['user'][0]['id'])) { ?>
                                                    <th>Paymt. Proc. Status</th>
                                                    <?php } ?>
                                                    <th>Paymt. Date</th>
                                                
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                if(isset($_GET['filter']) && !empty($_GET['filter'])){
                                                    $data = $req->fetch_by_criterial(array('approvalRequest'=> 1, 'audited'=> 1, 'approved'=> 1, 'reqby'=> $_GET['filter']));    
                                                } else{
                                                    $data = $req->fetch_by_criterial(array('approvalRequest'=> 1, 'audited'=> 1, 'approved'=> 1));    
                                                }
                                                
                                                if(count($data) > 0) {   
                                                foreach($data as $dt){
                                                ?>
                                                    <tr>
                                                    <td>
                                                    <a href="view.php?id=<?php echo $dt['reqnumber']; ?>"><i class="fa fa-eye"></i></i></a>
                                                        <?php echo ($dt['approvalRequest'] == 1  ? "<a href='printable.php?id=".$dt['reqnumber']."'><i class='fa fa-print'></i></i></a>" : ''); ?>
                                                    </td>
                                                    <td><?php echo $dt['reqnumber']; ?></td>
                                                    <td><?php echo $dt['reqby']; ?></td>
                                                    <td><?php echo isset($dt['departmentid']) ? $department->get_depart_name_by_id($dt['departmentid']) : ""; ?></td>
                                                    <td><?php echo $dt['reqdate']; ?></td>
                                                    <td><?php echo ($dt['coment'] == "" ? '----------' : $dt['coment']) ; ?></td>
                                                    <td><?php if($dt['awaiting_price'] == 1){ 
                                                            echo '<span class="bg-danger" style = "color: white">Pending</span>'; 
                                                        } else if($dt['awaiting_price'] == 0 ){ 
                                                        echo '<span class="bg-success" style = "color: white">Approved</span><br>'.$dt['procapproveddate'];  
                                                        } ?>
                                                    </td>
                                                    <td><?php if($dt['audited'] == 0){ 
                                                            echo '<span class="bg-danger" style = "color: white">Pending</span>'; 
                                                    } else if($dt['audited'] == 1 ){ 
                                                    echo '<span class="bg-success" style = "color: white">Approved</span><br>'.$dt['auditeddate']; 
                                                    } ?>
                                                </td>
                                                <td><?php if($dt['approved'] == 0){ 
                                                            echo '<span class="bg-danger" style = "color: white">Pending</span>';
                                                    } else if($dt['approved'] == 1 ){ 
                                                    echo '<span class="bg-success" style = "color: white">Approved</span><br>'.$dt['approveddate'];
                                                    } ?>
                                                </td>
                                                    <td>
                                                        <?php if($dt['requisitiontype'] == 2){ ?>
                                                            <?php if($dt['payment_status'] == 0){ ?>
                                                                <?php if($user->is_accountant($_SESSION['user'][0]['id'])) { ?>
                                                                    <button class="btn btn-xs btn-primary" onclick="update_payment_status('<?php echo $dt['reqnumber'] ?>', '<?php echo isset($_SESSION['user']) ? $_SESSION['user'][0]['id'] : '' ; ?>')">Update</button>
                                                                <?php } else { 
                                                                    echo '<span class="bg-danger" style = "color: white">Pending</span>'; 
                                                                } ?> 
                                                        <?php } else { 
                                                            if(isset($dt['paidby']) && $dt['paidby'] != NULL){ 
                                                                echo '<span class="bg-success" style = "color: white">Paid</span><br> By: '.$user->get_user_name_by_id($dt['paidby']);
                                                            } else { 
                                                            echo '<span class="bg-success" style = "color: white">Paid</span>';
                                                            } 
                                                        } ?>
                                                                
                                                    <?php } else { 
                                                        echo '<span class="bg-success" style = "color: white">Approved</span>'; 
                                                        } ?>
                                                    </td>
                                                    <?php if($user->is_accountant($_SESSION['user'][0]['id'])) { ?>
                                                    <td>
                                                    <?php if($dt['requisitiontype'] == 2){ ?>
                                                        <?php if($dt['payment_process_status'] == 0){ ?>
                                                            <button class="btn btn-xs btn-primary" onclick="update_payment_process_status('<?php echo $dt['reqnumber'] ?>')">Update</button>
                                                        <?php } else { 
                                                                echo 'Processed'; 
                                                        } ?>
                                                    <?php } else { 
                                                        echo '<span class="bg-danger" style = "color: white">Not Applicable</span>';
                                                     } ?>
                                                    </td>
                                                    <?php } ?>
                                                    <td>
                                                    <?php if($dt['requisitiontype'] == 2){ ?>
                                                        <?php if($dt['payment_date'] == "0000-00-00"){ 
                                                                echo ' -------- '; 
                                                        } else if($dt['payment_date'] != "0000-00-00" ){ 
                                                                echo $dt['payment_date']; 
                                                        } ?>

                                                        <?php } else { 
                                                            echo '<span class="bg-success" style = "color: white">Approved</span>'; 
                                                        } ?>
                                                    </td>
                                                    </tr>
                                                <?php } } else { ?>
                                                    <tr>
                                                        <td colspan="11" class="text-center" >No Record To Display</td>
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
            <div class="modal fade" id="addrequisition" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Create New Requisition</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form id="frmRequisition" method="POST" name="frmRequisition" onsubmit="return false">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="reqby" required aria-describedby="emailHelp" disabled>
                        <input type="hidden" class="form-control" id="departmentid" required aria-describedby="emailHelp" disabled>
                        <label for="exampleInputEmail1">To be Audited By:</label>
                        <select name="auditedby" class="form-control" id="auditedby" required ></select>
                        <span id="auditedbyerror"></span>
                        <label for="exampleInputEmail1">Requested Item Type:</label>
                        <select name="requisitiontype" class="form-control" id="requisitiontype" required>
                        <option value="">Choose Type</option>
                        <option value="1">Stock Item</option>
                        <option value="2">Non Stock Item</option>
                        </select>
                        <span id="requisitiontypeerror"></span>
                        <label for="exampleInputEmail1">To be Approved By:</label>
                        <select name="approvedby" class="form-control" id="approvedby" required></select>
                        <span id="approvedbyerror"></span>
                        <label for="exampleInputEmail1">Description:</label>
                        <textarea name="description" class="form-control" id="description" cols="30" rows="5"></textarea>
                        <span id="descriptionerror"></span>
                    </div>
                    
                </div>
                <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="frmCreaterequisition">Create</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    
                </div>
                </form>
                </div>
            </div>
            </div>
<?php require '../includes/footer.php'; ?>

<script>
  let Auditors;
  let Approvals;
  let base_url = "http://192.168.2.15:7676/request/pages/requisition/history.php";

  function get_auditor(){

    let url = "../../library/request.php?action=getauditor";

    $.ajax({
      type: "POST",
      url: url,
      dataType: "JSON",
      success: function (response) {
          Auditors = response;
      }
    });
  }

  function delete_requisition(id){
    if(confirm("Are you sure you want to delete ?")){
      let url = "../../library/request.php?action=deleterequisition";

      $.ajax({
        type: "POST",
        url: url,
        data: {"id":id},
        dataType: "JSON",
        success: function (response) {
            if(response == 1){
              alert("Requisition Deleted");
              window.location.reload();
            }else{
              alert("Unable to delete");
            }
        }
      });
    }
    
  }

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

  function create_modal(){

    $("#addrequisition #auditedby").empty();
    $("#addrequisition #auditedby").append("<option value=''>-- Select Auditor --</option>");
    $.each(Auditors, function (indexInArray, valueOfElement) { 
        $("#addrequisition #auditedby").append("<option value="+Auditors[indexInArray].id+">"+Auditors[indexInArray].name+"</option>");
    });

    $("#addrequisition #approvedby").empty();
    $("#addrequisition #approvedby").append("<option value=''>-- To be Approved By --</option>");
    $.each(Approvals, function (indexInArray, valueOfElement) { 
        $("#addrequisition #approvedby").append("<option value="+Approvals[indexInArray].id+">"+Approvals[indexInArray].name+"</option>");
    });

    $("#addrequisition #reqby").val("<?php echo isset($_SESSION['user']) ? $_SESSION['user'][0]['email'] : "" ; ?>");
    $("#addrequisition #departmentid").val("<?php echo isset($_SESSION['user']) ? $_SESSION['user'][0]['departmentid'] : "" ; ?>");

      $("#addrequisition").modal('show');
  }

  $('form#frmRequisition').submit(function(){

    var reqby = $('#reqby').val();
    var reqdate = "<?php echo date("Y-m-d", time()); ?>";
    var auditedby = $('#auditedby').val();
    var approvedby = $('#approvedby').val();
    var description = $('#description').val();
    var department = $('#departmentid').val();
    var requisitiontype = $('#requisitiontype').val();

        var status = "";

        if(reqby == ""){
            $('#reqbyerror').html('Requested by cannot be empty').addClass('text-danger');
            status = true;
        }else{
            $('#reqbyerror').html(" ");
        }
        if(reqdate == ""){
            $('#reqdateerror').html('Requisition date cannot be empty').addClass('text-danger');
            status = true;
        }else{
            $('#reqdateerror').html(" ");
        }
        if(auditedby == ""){
            $('#auditedbyerror').html('To be audited by cannot be empty').addClass('text-danger');
            status = true;
        }else{
            $('#auditedbyerror').html(" ");
        }
        if(approvedby == ""){
            $('#approvedbyerror').html('To be approved by cannot be empty').addClass('text-danger');
            status = true;
        }else{
            $('#approvedbyerror').html(" ");
        }
        if(descriptionerror == ""){
            $('#descriptionerrorerror').html('Description cannot be empty').addClass('text-danger');
            status = true;
        }else{
            $('#descriptionerrorerror').html(" ");
        }
        if(requisitiontypeerror == ""){
            $('#requisitiontypeerrorerror').html('Requisition type cannot be empty').addClass('text-danger');
            status = true;
        }else{
            $('#requisitiontypeerrorerror').html(" ");
        }

        if(status != true){
            
            var data = {'reqby': reqby, 'reqdate':reqdate, 'auditedby':auditedby, 'approvedby':approvedby, 'description':description, 'department':department, 'requisitiontype': requisitiontype }
            $.ajax({
                url: "../../library/request.php?action=createrequisitionheader",
                type: 'POST',
                data: data,
                dataType: 'JSON',
                success:function(data){
                    window.location = "detail.php?id="+data.id+"&rectype="+data.rectype;
                    
                }, 
                error: function(error){
                    console.log(error);
                }
            })
        }

    
  });

  function myfilter(param){
        if(param.length != ""){
            window.location.href = base_url + "?filter="+param;
        }
  }

  function clear_filter(){
      window.location.href = base_url;
  }


  function update_payment_status(id, userid){
      if(id.length != ""){
          if(confirm("Are you sure you have made payment!?\r\n this cannot be reversed")){
            $.ajax({
                url: "../../library/request.php?action=updatepaymentstatus",
                type: 'POST',
                data: {"id":id, "userid":userid},
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

  
  function update_payment_process_status(id){
      if(id.length != ""){
          if(confirm("Are you sure you have Processed this Payment payment!?\r\n this cannot be reversed")){
            $.ajax({
                url: "../../library/request.php?action=updatepaymentprocessstatus",
                type: 'POST',
                data: {"id":id},
                dataType: 'JSON',
                success:function(data){
                    if(data == 1){
                        alert("Payment Marked As Process");
                        window.location.reload();
                    }else{
                        alert("Unable to mark");
                    }
                    
                }, 
                error: function(error){
                    console.log(error);
                }
            })
          }
      }
  }
  

  function get_all_user(){
    $.ajax({
        url: "../../library/request.php?action=getuserlist",
        type: 'POST',
        dataType: 'JSON',
        success:function(data){
            $("#filter").empty();
            $("#filter").append("<option value=''>-- Select User --</option>");
            $.each(data, function (indexInArray, valueOfElement) { 
                $("#filter").append("<option value="+data[indexInArray].email+">"+data[indexInArray].name+"</option>");
            });
        }, 
        error: function(error){
            console.log(error);
        }
    })
  }

  $(document).ready(function () {
    get_approval();
    get_auditor();
    get_all_user();
  });

</script>

</body>

</html>