<?php require '../includes/header.php'; ?>
<?php require '../../model/User.php'; ?>
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
                        <h4 class="page-title">User(s) List</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Users</a></li>
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
                                <button class="btn btn-primary" onclick="add_new_user()" ><i class="fa fa-plus "></i>Add New User</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>&nbsp;</th>
                                                <th>S/N</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Department</th>
                                                <th>Password</th>
                                                <th>Role</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $data = $user->fetch_all();
                                            if(count($data) > 0) {   
                                                $i = 1;
                                            foreach($data as $dt){
                                            ?>
                                                <tr>
                                                <td><a  onclick="edit_user('<?php echo $dt['id']; ?>')"><i class="fa fa-edit"></i></a> | <a  onclick="delete_user('<?php echo $dt['id']; ?>')"><i class="fa fa-trash"></i></a></td>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo isset($dt['name']) ? $dt['name'] : ""; ?></td>
                                                <td><?php echo isset($dt['email']) ? $dt['email'] : ""; ?></td>
                                                <td><?php echo isset($dt['email']) ? $department->get_depart_name_by_id($dt['departmentid']) : ""; ?></td>
                                                <td><button class="btn btn-xs btn-primary" onclick="update_password('<?php echo $dt['id'] ?>', '<?php echo $dt['email'] ?>')">Change</button></td>
                                                <td><?php if(isset($dt['user_roleid'])){
                                                            switch($dt['user_roleid']){
                                                            case '-1':
                                                                echo "supper user";
                                                                break;
                                                            case '0':
                                                                echo "Users";
                                                                break;
                                                            case '1':
                                                                echo "Auditor";
                                                                break;
                                                            case '2':
                                                                echo "Approval";
                                                                break;
                                                            case '3':
                                                                echo "Procurement";
                                                                break;
                                                            case '4':
                                                                echo "Accountant";
                                                                break;
                                                            case '5':
                                                                echo "HR";
                                                                break;
                                                            case '6':
                                                                echo "HMO";
                                                                break;
                                                            case '7':
                                                                echo "BCC";
                                                                break;
                                                            case '8':
                                                                echo "HOD";
                                                                break;
                                                            }
                                                }  ?></td>
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
    <div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add New User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form id="frmadduser" onsubmit="return false">
            <div class="form-group">
                <label for="exampleInputEmail1">Name:</label>
               <input type="text" name="name" class="form-control" id="name">
                <span id="nameerror"></span>
                <label for="exampleInputEmail1">Email:</label>
               <input type="text" name="email" class="form-control" id="email">
                <span id="emailerror"></span>
                <label for="exampleInputEmail1">Password:</label>
               <input type="password" name="password" class="form-control" id="password">
                <span id="passworderror"></span>
                <label for="exampleInputEmail1">Userrole:</label>
                <select name="userrole" class="form-control" id="userrole">
                  <option value="">-- Select Role --</option>
                  <option value="-1">Super User</option>
                  <option value="0">User</option>
                  <option value="1">Auditor</option>
                  <option value="2">Approval</option>
                  <option value="3">Procurement</option>
                  <option value="4">Accountant</option>
                  <option value="5">HR</option>
                </select>
                <span id="userroleerror"></span>
                <label for="exampleInputEmail1">Department:</label>
                <select name="departmentid" class="form-control" id="departmentid"></select>
                <span id="departmenterror"></span>
            </div>
            
          </div>
          <div class="modal-footer">
                <button type="submit" class="btn btn-success" >Add User</button>
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
            <h5 class="modal-title" id="exampleModalLongTitle">Edit User Detail</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form id="frmEditUser" onsubmit="return false">
            <div class="form-group">
                <input type="hidden" id="eid">
                <label for="exampleInputEmail1">Name:</label>
               <input type="text" name="ename" class="form-control" id="ename">
                <span id="enameerror"></span>
                <label for="exampleInputEmail1">Email:</label>
               <input type="text" name="eemail" class="form-control" id="eemail">
                <span id="eemailerror"></span>
                <label for="exampleInputEmail1">Userrole:</label>
                <select name="euserrole" class="form-control" id="euserrole">
                  <option value="">-- Select Role --</option>
                  <option value="-1">Super User</option>
                  <option value="0">User</option>
                  <option value="1">Auditor</option>
                  <option value="2">Approval</option>
                  <option value="3">Procurement</option>
                </select>
                <span id="euserroleerror"></span>
                <label for="exampleInputEmail1">Department:</label>
                <select name="edepartmentid" class="form-control" id="edepartmentid"></select>
                <span id="edepartmenterror"></span>
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

    <div class="modal fade" id="updatepassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Update User password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form id="frmupdatepassword" method="POST" name="frmupdatepassword" onsubmit="return false">
            <div class="form-group">
                <input type="hidden" class="form-control" id="id" disabled>
                <input type="hidden" class="form-control" id="cemail" disabled>
                <span id="iderror"></span>
                <label for="exampleInputEmail1">New Password:</label>
                <input type="cpassword" class="form-control" id="cpassword" required aria-describedby="emailHelp" >
                <span id="cpassworderror"></span>
            </div>
            
          </div>
          <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="frmCreaterequisition">Change Password</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            
          </div>
          </form>
        </div>
      </div>
    </div>

<?php  require '../includes/footer.php'; ?>
<script>
  var department_list;

  function get_department_list(){
      $.ajax({
        type: "GET",
        url: "../../library/request.php?action=getdepartment",
        dataType: "JSON",
        success: function (response) {
            department_list = response;
        }
      });
  }

  function add_new_user(){
    $("#adduser #departmentid").empty();
    $("#adduser #departmentid").append("<option value = ''> -- Select Department --</option>");

    $.each(department_list, function (i, val) { 
      $("#adduser #departmentid").append("<option value ='"+department_list[i].id+"'>"+ department_list[i].name+ "</option>");
    });
    

    $("#adduser").modal('show');
  }

function edit_user(id){
  let url = "../../library/request.php?action=getuserbyid";

  var data = {'id': id}
  $.ajax({
    type: "POST",
    url: url,
    data: data,
    dataType: "JSON",
    success: function (response) {
      $("#edititem #ename").val(response[0].name);
      $("#edititem #eemail").val(response[0].email);
      $("#edititem #eid").val(response[0].id);

      $("#frmEditUser #edepartmentid").empty();
      $.each(department_list, function (i, val) { 
        $("#frmEditUser #edepartmentid").append("<option "+(response[0].departmentid == department_list[i].id ? "Selected ": "")+" value ='"+department_list[i].id+"'>"+ department_list[i].name+ "</option>");
      });
      edepartmentid
    }
  });
  
  $("#edititem").modal('show');
}

$('form#frmadduser').submit(function(){
  
  let name = $("#name").val();
  let email = $("#email").val();
  let user_roleid = $("#userrole").val();
  let password = $("#password").val();
  let departmentid = $("#departmentid").val();

  var status = false;

   // validate item name
  if(name == "" ) {
      $('#nameerror').html('Name cannot be blank').addClass('text-danger');
      status = true;
  }
  else{
      $('#nameError').html(" ");
  }

  // department validation
  if(departmentid == "" ) {
      $('#departmenterror').html('Department cannot be blank').addClass('text-danger');
      status = true;
  }
  else{
      $('#departmenterror').html(" ");
  }

  // email regular expression
  var emailRegex =/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  // validate email
  if(email == "" || !emailRegex.test(email)) {
      $('#emailError').html('Enter Valid Email Address').addClass('text-danger');
      status = true;
  }
  else{
      $('#emailError').html(" ");
  }

  if(password == "" ) {
      $('#passworderror').html('Password field cannot be blank').addClass('text-danger');
      status = true;
  }
  else{
      $('#passworderror').html(" ");
  }

  if(userrole == "" ) {
      $('#userroleerror').html('Userrole field cannot be blank').addClass('text-danger');
      status = true;
  }
  else{
      $('#userroleerror').html(" ");
  }


  if(status == false){
    let res = '';
    var data = {'name': name, 'email':email, 'password':password, 'user_roleid':user_roleid, "department":departmentid }

    $.ajax({

      type: "POST",
      url: "../../library/request.php?action=createuser",
      data: data,
      dataType: "JSON",
      success: function (response) {
          let responses = JSON.parse(response);
          if(responses == true){
              alert("User created Successfully");
              window.location.reload();
          }else{
              alert("Error Creating User");
          }
      }
    });
  }

  
});


$('form#frmupdatepassword').submit(function(){
  
  let id = $("#id").val();
  let password = $("#cpassword").val();
  let email = $("#cemail").val();
  var status = false;


  if(password == "" ) {
      $('#cpassworderror').html('Password field cannot be blank').addClass('text-danger');
      status = true;
  }
  else{
      $('#cpassworderror').html(" ");
  }

  if(status == false){

    if(confirm("Are you sure you want to change password")){
      let res = '';
    var data = {'id': id, 'password':password ,'email': email}

    $.ajax({

      type: "POST",
      url: "../../library/request.php?action=update_user_password",
      data: data,
      dataType: "JSON",
      success: function (response) {
          let responses = JSON.parse(response);
          if(responses == true){
              alert("Password Updated Successfully");
              window.location.reload();
          }else{
              alert("Unable to update Password, try later");
          }
      }
    });
    }
  }

  
});

// save edit detail
$('form#frmEditUser').submit(function(){
  
  let ename = $("#ename").val();
  let eemail = $("#eemail").val();
  let euser_roleid = $("#euserrole").val();
  let edepartment = $("#edepartmentid").val();
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

  // department validation
  if(edepartment == "" ) {
      $('#edepartmenterror').html('Department cannot be blank').addClass('text-danger');
      status = true;
  }
  else{
      $('#edepartmenterror').html(" ");
  }


  // email regular expression
  var emailRegex =/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  // validate email
  if(eemail == "" || !emailRegex.test(eemail)) {
      $('#eemailerror').html('Enter Valid Email Address').addClass('text-danger');
      errorstatus = true;
  }
  else{
      $('#eemailerror').html(" ");
  }

  if(euser_roleid == "" ) {
      $('#euserroleerror').html('Userrole field cannot be blank').addClass('text-danger');
      errorstatus = true;
  }
  else{
      $('#euserroleerror').html(" ");
  }


  if(errorstatus == false){

    var data = {'name': ename, 'email':eemail, 'user_roleid':euser_roleid, 'id':eid , 'departmentid': edepartment }

    $.ajax({

      type: "POST",
      url: "../../library/request.php?action=updateuserdetail",
      data: data,
      dataType: "JSON",
      success: function (response) {
          let responses = JSON.parse(response);
          if(responses == true){
              alert("User Detail Updated Successfully");
              window.location.reload();
          }else{
              alert("Error Updating User");
          }
      }
    });
  }


  
});

function update_password(id, email){
  $("#updatepassword #id").val(id);
  $("#updatepassword #cemail").val(email);
  $("#updatepassword").modal('show');

} 


function delete_user(id){
  if(confirm("Are You Sure You Want To Delete User ?")){
    $.ajax({

        type: "POST",
        url: "../../library/request.php?action=deleteuser",
        data: {'id': id},
        dataType: "JSON",
        success: function (response) {
            if(response == true){
                alert("User Deleted Successfully");
                window.location.reload();
            }else{
                alert("Error Deleting User, try again");
            }
        }
    });
  }
}

$(document).ready(function () {
  get_department_list();
});

</script>