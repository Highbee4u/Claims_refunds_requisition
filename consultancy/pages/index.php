<?php require '../includes/header.php'; ?>
<?php require '../../model/Consultant.php'; ?>
<?php require '../../model/Department.php'; ?>

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
                        <h4 class="page-title">Consulting Record List</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Consulting Record</a></li>
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
                                <button class="btn btn-primary" onclick="create_record('<?php echo isset($_SESSION['user'][0]['email']) ? $_SESSION['user'][0]['email'] : "" ; ?>', '<?php echo isset($_SESSION['user'][0]['departmentid']) ? $_SESSION['user'][0]['departmentid'] : "" ; ?>', '<?php echo isset($_SESSION['user'][0]['category']) ? $_SESSION['user'][0]['category'] : "" ; ?>')" ><i class="fa fa-plus "></i>Create Record</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>&nbsp;</th>
                                                <th>Record. No</th>
                                                <th>Initiated. By</th>
                                                <th>Return Status</th>
                                                <th>Returned By</th>
                                                <th>Auditor Status</th>
                                                <th>MD Status</th>
                                                <th>Paymt. Status</th>
                                                <th>Initiated Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                               
                                                $data = $consultant->fetch_by_criterial(array('Enteredby'=>$_SESSION['user'][0]['email']), 'consultings_header');
                                               
                                                
                                                if(count($data) > 0) {   
                                                foreach($data as $dt){ 
                                            ?>
                                                <tr>
                                                <td>
                                                    <?php if($dt['approvalRequest'] == 0) { ?>
                                                        <a href="detail.php?id=<?php echo $dt['id']; ?>"><i class='fa fa-edit'></i></a>
                                                        <a onclick ="delete_record('<?php echo $dt['id']; ?>')"><i class='fa fa-trash'></i></a>
                                                    <?php } else{ ?>  
                                                        <a href="view.php?id=<?php echo $dt['id']; ?>"><i class="fa fa-eye"></i></i></a>
                                                    <?php }  ?>
                                                        <a href="printable.php?id=<?php echo $dt['id']; ?>"><i class="fa fa-print"></i></a>
                                                
                                                </td>
                                                <td><?php echo $dt['id']; ?></td>
                                                <td><?php echo isset($dt['Enteredby']) ? $user->get_user_name_by_email($dt['Enteredby']) : ""; ?></td>
                                                <td><?php echo isset($dt['returned']) && $dt['returned'] == 1 ? "<span class='bg-danger blink_text' style = 'color: white'>Returned</span><br>".$dt['returneddate']  : '---------'; ?></td>
                                                <td><?php echo isset($dt['returnedby']) && $dt['returnedby'] != NULL ? $user->get_user_name_by_id($dt['returnedby'])  : '---------'; ?></td>
                                                <td>
                                                    <?php 
                                                        if($dt['returned'] == 1){
                                                            echo '--------'; 
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
                                                            echo '--------'; 
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

<?php  require '../includes/footer.php'; ?>
<script>

  let hod_client_service;
  let autorized_auditor;
  let autorized_approval;
  
  function delete_record(id){
    if(confirm("Are you sure you want to delete ?")){
      let url = "../../library/request.php?action=deleteclaims";

      $.ajax({
        type: "POST",
        url: url,
        data: {"id":id},
        dataType: "JSON",
        success: function (response) {
            if(response == 1){
              alert("Record Deleted");
              window.location.reload();
            }else{
              alert("Unable to delete");
            }
        }
      });
    }
    
  }

  function create_record(creator, department, category){

    var enteredby = creator;
    var department = department;
    var recordcategory = category;
    var hod = hod_client_service[0].email;
    var Approvedby = autorized_approval[0].id;
    var Auditedby = autorized_auditor[0].id;

    

    var data;
    
    data = {
        'Enteredby': enteredby, 
        'departmentid':department,
        'consulttype':recordcategory,
        'hodid':hod,
        'Approvedby':Approvedby,
        'Auditedby':Auditedby
    }
    
    $.ajax({
        url: "../../library/request.php?action=createcconsultingrecordheader",
        type: 'POST',
        data: data,
        dataType: 'JSON',
        success:function(data){
            if(data.id != "" || data.id != "undefined")
            window.location = "detail.php?id="+data.id;
            else
            alert("Unable to Create Record, try later");
        }, 
        error: function(error){
            console.log(error);
        }
    })
         
  }

  function get_clients_service_hod(){
    let url = "../../library/request.php?action=get_client_service_hod";

    $.ajax({
    type: "POST",
    url: url,
    dataType: "JSON",
    success: function (response) {
        hod_client_service = response;
    }
    });
  }

  function get_autorized_auditor(){
    let url = "../../library/request.php?action=getauditor";

    $.ajax({
    type: "POST",
    url: url,
    dataType: "JSON",
    success: function (response) {
        autorized_auditor = response;
    }
    });
  }

  function get_autorized_approval(){
    let url = "../../library/request.php?action=getapproval";

    $.ajax({
    type: "POST",
    url: url,
    dataType: "JSON",
    success: function (response) {
        autorized_approval = response;
    }
    });
  }

  $(document).ready(function () {
    get_clients_service_hod();
    get_autorized_auditor();
    get_autorized_approval();
  });
 
</script>