<?php  require '../includes/header.php'; ?>
<?php require '../../model/Item.php'; ?>
<?php require '../../model/uom.php'; ?>
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
                        <h4 class="page-title">Item Uom(s)</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Item</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Uom List</li>
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
                                <button class="btn btn-primary" data-toggle="modal" data-target="#adduom"><i class="fa fa-plus "></i>Create Item</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>&nbsp;</th>
                                                <th>ID</th>
                                                <th>Unit(s)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $data = $uom->fetch_all();
                                            if(count($data) > 0) {   
                                            foreach($data as $dt){
                                            ?>
                                                <tr>
                                                <td>
                                                    <a href="" onclick="get_edit_modal('<?php echo $dt['id']; ?>')"><i class="fa fa-edit"></i></a>
                                                </td>
                                                <td><?php echo $dt['id']; ?></td>
                                                <td><?php echo $dt['uomname']; ?></td>
                                                </tr>
                                            <?php } } else { ?>
                                                <tr>
                                                    <td colspan="3" class="text-center">No Record To Display</td>
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
<div class="modal fade" id="adduom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Create Item UOM</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form>
        <div class="form-group">
            <label for="exampleInputEmail1">UOM</label>
            <input type="tex" class="form-control" id="uom" required aria-describedby="emailHelp" placeholder="Enter unit">
            <span id="uomerror"></span>
        </div>
        
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-success" id="frmCreateuom">Create</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
      </form>
    </div>
  </div>
</div>
<?php  require '../includes/footer.php'; ?>
<script>
    
    
    frmCreateuom.onclick = ()=>{
        
        var errorstatus = false;

        var uom = $('#uom').val();

        if(uom  === "") {
            $('#uomerror').html("UOM Can't be empty").addClass('text-danger');
            errorstatus = true;
        } else if(errorstatus != true){
            
            var data = {'unit':uom}

            $.ajax({
                type: "POST",
                url: "../../library/request.php?action=createuom",
                data: data,
                dataType: "JSON",
                success: function (response) {
                  console.log(response);  
                    
                    if(response == 1){
                        alert("Unit Added Successfully");
                        window.location="uom.php";
                    }else{
                        alert("Error Updating Property detail");
                    }
                }
            });
        }
    }

    function get_edit_modal(id){

    }
</script>