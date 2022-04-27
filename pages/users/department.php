<?php require '../includes/header.php'; ?>
<?php require '../../model/Department.php'; ?>
<?php require '../includes/menu.php'; ?>

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
                        <h4 class="page-title">Department List</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Departments</a></li>
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
                                <button class="btn btn-primary" onclick="add_new_department()" ><i class="fa fa-plus "></i>Add New Department</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>&nbsp;</th>
                                                <th>S/N</th>
                                                <th>Department Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $data = $department->fetch_all();
                                            if(count($data) > 0) {   
                                                $i = 1;
                                            foreach($data as $dt){
                                            ?>
                                                <tr>
                                                <td><a  onclick="edit_department('<?php echo $dt['id']; ?>')"><i class="fa fa-pencil"></i></a> | <a  onclick="delete_department('<?php echo $dt['id']; ?>')"><i class="fa fa-trash-o"></i></a></td>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo isset($dt['name']) ? $dt['name'] : ""; ?></td>
                                                
                                                </tr>
                                            <?php } } else { ?>
                                                <tr>
                                                    <td colspan="4" class="text-center">No Record To Display</td>
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
    <div class="modal fade" id="adddepartment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add New Department</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form id="frmadddepartment" onsubmit="return false">
            <div class="form-group">
                <label for="exampleInputEmail1">Name:</label>
               <input type="text" name="name" class="form-control" id="name">
                <span id="nameerror"></span>
            </div>
            
          </div>
          <div class="modal-footer">
                <button type="submit" class="btn btn-success" >Add Department</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            
          </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="edititem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Department Detail</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form id="frmEditDepartment" onsubmit="return false">
            <div class="form-group">
                <input type="hidden" id="eid">
                <label for="exampleInputEmail1">Name:</label>
               <input type="text" name="ename" class="form-control" id="ename">
                <span id="enameerror"></span>
            </div>
            
          </div>
          <div class="modal-footer">
                <button type="submit" class="btn btn-success" >Update</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            
          </div>
          </form>
        </div>
      </div>
    </div>


<?php  require '../includes/footer.php'; ?>
<script>

  function add_new_department(){
    $("#adddepartment").modal('show');
  }

function edit_department(id){
  let url = "../../library/request.php?action=getdepartmentbyid";

  var data = {'id': id}
  $.ajax({
    type: "POST",
    url: url,
    data: data,
    dataType: "JSON",
    success: function (response) {
      $("#edititem #ename").val(response[0].name);
      $("#edititem #eid").val(response[0].id);
    }
  });
  
  $("#edititem").modal('show');
}

$('form#frmadddepartment').submit(function(){
  
  let name = $("#name").val();
  

  var status = false;

   // validate item name
  if(name == "" ) {
      $('#nameerror').html('Name cannot be blank').addClass('text-danger');
      status = true;
  }
  else{
      $('#nameError').html(" ");
  }


  if(status == false){

    var data = {'name': name }

    $.ajax({

      type: "POST",
      url: "../../library/request.php?action=createdepartment",
      data: data,
      dataType: "JSON",
      success: function (response) {
          let responses = JSON.parse(response);
          if(responses == true){
              alert("Department created Successfully");
              window.location.reload();
          }else{
              alert("Error Creating Department");
          }
      }
    });
  }

  
});

// save edit detail
$('form#frmEditDepartment').submit(function(){
  
  let ename = $("#ename").val();
  let eid = $("#eid").val();
  
  var errorstatus = false;

   // validate item name
  if(ename == "" ) {
      $('#enameerror').html('Name cannot be blank').addClass('text-danger');
      errorstatus = true;
  }
  else{
      $('#enameerror').html(" ");
  }

  if(errorstatus == false){

    var data = {'name': ename, "id":eid}

    $.ajax({

      type: "POST",
      url: "../../library/request.php?action=updatedepartmentdetail",
      data: data,
      dataType: "JSON",
      success: function (response) {
          let responses = JSON.parse(response);
          if(responses == true){
              alert("Department Detail Updated Successfully");
              window.location.reload();
          }else{
              alert("Error Updating Department");
          }
      }
    });
  }


  
});


function delete_department(id){
  if(confirm("Are You Sure You Want To Delete Department ?")){
    
    $.ajax({

        type: "POST",
        url: "../../library/request.php?action=deletedepartment",
        data: {'id': id},
        dataType: "JSON",
        success: function (response) {
            if(response == true){
                alert("Department Deleted Successfully");
                window.location.reload();
            }else{
                alert("Error Deleting Department, try again");
            }
        }
    });
  }
}

</script>