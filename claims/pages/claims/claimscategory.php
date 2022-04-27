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
                        <h4 class="page-title">Claims Category(s)</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Claims</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">category</li>
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
                                <button class="btn btn-primary" onclick="create_modal()" ><i class="fa fa-plus "></i>Add Claim Category</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>&nbsp;</th>
                                                <th>Category ID</th>
                                                <th>Category Name</th>
                                                <th>Description</th>
                                                <th>Created By</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $data = $claim->fetch_all_category('claims_category');
                                                if(count($data) > 0) {   
                                                foreach($data as $dt){ 
                                            ?>
                                                <tr>
                                                <td>
                                                    <a onclick = get_category(<?php echo $dt['id']; ?>)><i class='fa fa-edit'></i></a>
                                                    <a onclick ="delete_claimscategory('<?php echo $dt['id']; ?>')"><i class='fa fa-trash'></i></a>
                                                </td>
                                                <td><?php echo $dt['id']; ?></td>
                                                <td><?php echo isset($dt['name']) ? $dt['name'] : "" ; ?></td>
                                                <td><?php echo isset($dt['description']) ? $dt['description'] : "" ; ?></td>
                                                <td><?php echo isset($dt['createdby']) ? $user->get_user_name_by_email($dt['createdby']) : ""; ?></td>
                                              
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
    <div class="modal fade" id="addclaimscategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Create New </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form id="frmClaimscategory" method="POST" name="frmClaimscategory" onsubmit="return false">
                <div class="form-group">
                    <input type="hidden" class="form-control" id="enteredby" required aria-describedby="emailHelp" disabled>
                    <input type="hidden" class="form-control" id="created_at" required value="<?php echo date('Y-m-d'); ?>" disabled>
                    <label for="lblcategorytitle" id="lblStaffname">Category Name:</label>
                    <input type="text" name="categoryname" id="categoryname" class="form-control">
                    <span id="categorynameerror"></span>
                    <label for="lblDescription" id="lblDescription">Claims Category Description:</label>
                    <textarea name="description" id="description" cols="30" rows="5" class="form-control" ></textarea>
                    <span id="descriptionerror"></span>                     
                </div>
          </div>
          <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="frmCreateclaimscategory">Create</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            
          </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="editclaimscategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Create New </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form id="frmEditcategory" method="POST" name="frmEditcategory" onsubmit="return false">
                <div class="form-group">
                    <input type="hidden" class="form-control" id="eid" required aria-describedby="emailHelp" disabled>
                    <input type="hidden" class="form-control" id="eenteredby" required aria-describedby="emailHelp" disabled>
                    <input type="hidden" class="form-control" id="ecreated_at" required value="<?php echo date('Y-m-d'); ?>" disabled>
                    <label for="lblcategorytitle" id="lblStaffname">Category Name:</label>
                    <input type="text" name="ecategoryname" id="ecategoryname" class="form-control">
                    <span id="ecategorynameerror"></span>
                    <label for="lblDescription" id="lblDescription">Claims Category Description:</label>
                    <textarea name="edescription" id="edescription" cols="30" rows="5" class="form-control" ></textarea>
                    <span id="edescriptionerror"></span>                     
                </div>
          </div>
          <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="fermCreateclaimscategory">Update</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            
          </div>
          </form>
        </div>
      </div>
    </div>

<?php  require '../includes/footer.php'; ?>
<script>

    function get_category(id){

        let url = "../../../library/request.php?action=get_category";

        $.ajax({
        type: "POST",
        url: url,
        data: {"id":id},
        dataType: "JSON",
        success: function (response) {
            console.log(response);
            $("#editclaimscategory #eenteredby").val("<?php echo isset($_SESSION['user']) ? $_SESSION['user'][0]['email'] : "" ; ?>");
            $("#editclaimscategory #ecreated_at").val("<?php echo isset($_SESSION['user']) ? $_SESSION['user'][0]['departmentid'] : "" ; ?>");
            $("#editclaimscategory #eid").val(response[0].id);
            $("#editclaimscategory #ecategoryname").val(response[0].name);
            $("#editclaimscategory #edescription").val(response[0].description);
            $("#editclaimscategory").modal('show');
        }
        });
    }
 
    function delete_claimscategory(id){
        if(confirm("Are you sure you want to delete ?")){
        let url = "../../../library/request.php?action=deleteclaimscategory";

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


        $("#addclaimscategory #enteredby").val("<?php echo isset($_SESSION['user']) ? $_SESSION['user'][0]['email'] : "" ; ?>");
        $("#addclaimscategory #departmentid").val("<?php echo isset($_SESSION['user']) ? $_SESSION['user'][0]['departmentid'] : "" ; ?>");
        $("#addclaimscategory").modal('show');
    }

    $('form#frmClaimscategory').submit(function(){

        var enteredby = $('#enteredby').val();
        var categoryname = $('#categoryname').val();
        var description = $('#description').val();
        var created_at = $('#created_at').val();
        

            var status = "";

        if(categoryname == ""){
            $('#categorynameerror').html('Category Name Cannot Be Empty').addClass('text-danger');
            status = true;
        }else{
            $('#categorynameerror').html(" ");
        }
        if(description == ""){
            $('#descriptionerror').html('Hospital No cannot be empty').addClass('text-danger');
            status = true;
        }else{
            $('#descriptionerror').html(" ");
        }
        
            if(status != true){
                
                var data = {'createdby': enteredby, 'name': categoryname, 'description':description, 'created_at':created_at }
                $.ajax({
                    url: "../../../library/request.php?action=createclaimscategory",
                    type: 'POST',
                    data: data,
                    dataType: 'JSON',
                    success:function(data){
                        if(data.id != ""){
                            alert("Category Added");
                            window.location.reload();
                        }else{
                            alert("Unable to add Category");
                        }
                    }, 
                    error: function(error){
                        console.log(error);
                    }
                })
            }

        
    });
  
    $('form#frmEditcategory').submit(function(){

        var enteredby = $('#eenteredby').val();
        var categoryname = $('#ecategoryname').val();
        var description = $('#edescription').val();
        var created_at = $('#ecreated_at').val();
        var id = $('#eid').val();


        var status = "";

        if(categoryname == ""){
            $('#ecategorynameerror').html('Category Name Cannot Be Empty').addClass('text-danger');
            status = true;
        }else{
            $('#ecategorynameerror').html(" ");
        }
        if(description == ""){
            $('#edescriptionerror').html('Hospital No cannot be empty').addClass('text-danger');
            status = true;
        }else{
            $('#edescriptionerror').html(" ");
        }

            if(status != true){
                
                var data = {'createdby': enteredby, 'name': categoryname, 'description':description, 'created_at':created_at, 'id':id }
                $.ajax({
                    url: "../../../library/request.php?action=updateclaimscategory",
                    type: 'POST',
                    data: data,
                    dataType: 'JSON',
                    success:function(data){
                        if(data.id != ""){
                            alert("Category Updated");
                            window.location.reload();
                        }else{
                            alert("Unable to add Category");
                        }
                    }, 
                    error: function(error){
                        console.log(error);
                    }
                })
            }
    });
</script>