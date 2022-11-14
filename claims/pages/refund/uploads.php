<?php !isset($_GET['actionid'],$_GET['actiontype']) ? header("location:javascript://history.go(-1)") : ''; ?>
<?php  require '../includes/header.php';   ?>
<?php require '../../../model/Refund.php'; ?>
<?php require '../../../model/Department.php'; ?>
<?php require '../../../model/Upload.php'; ?>
<?php require '../includes/menu.php'; ?>
<?php $header = $refund->fetch_by_criterial(array('id'=>$_GET['actionid']), 'refunds_header')[0];  ?>
<?php $uploadsdata = $upload->getuploads(array('actionid'=>$_GET['actionid'], 'actiontype'=>$_GET['actiontype']));  ?>
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
                    Refund Attachments Detail For Refund ID: <b><?php echo isset($_GET['actionid']) ? $_GET['actionid'] : ""; ?></b>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Refund</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Attachment Detail</li>
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
                                          <td>Refund ID</td>
                                          <td><?php echo isset($_GET['actionid']) ? $_GET['actionid'] : ""; ?></td>
                                          <td>Hospital Number:</td>
                                          <td><?php echo isset($header['hospital_no']) ? $header['hospital_no'] : ""; ?></td>
                                      </tr>
                                      <tr>
                                          <td>Initiated By:</td>
                                          <td><?php echo isset($header['enteredby']) ? $user->get_user_name_by_email($header['enteredby']) : "" ?></td>
                                          <td>Created Date:</td>
                                          <td><?php echo isset($header['Created_date']) ? $header['Created_date'] : "" ?></td>
                                      </tr>
                                      <tr>
                                          <td>Patient Name:</td>
                                          <td><?php echo isset($header['patient_name']) ? $header['patient_name'] : ""; ?></td>
                                          <td>Paymen Status:</td>
                                          <td><?php echo isset($header['accountant_status']) && $header['accountant_status'] == 1 ? 'Approved' : "Pending"; ?></td>
                                      </tr>
                                      <tr>
                                          <td>Total Amount:</td>
                                          <td colspan="3"><?php echo isset($header['amount']) ? $header['amount'] : ""; ?></td>
                                         
                                      </tr>
                                      <?php if(isset($header['returned']) && $header['returned'] == 1){ ?>
                                        <tr>
                                          <td>Status:</td>
                                          <td colspan="3"><?php echo isset($header['returned']) && $header['returned'] == 1 ? "<span class='bg-danger blink_text'>Returned</span>" : ""; ?></td>
                                          
                                        </tr>
                                        <tr>
                                          <td>Return:</td>
                                          <td colspan="3"><?php echo isset($header['comment']) ? $header['comment'] : ""; ?></td>
                                        </tr>
                                      <?php } ?>
                                      <tr>
                                        <td colspan="4"><a class="btn btn-primary btn-xs" onclick="showupload('<?php echo $_GET['actionid'] ?>', '2')" style = 'color: white'><i class="fa fa-plus"></i> Add Attachment</a></td>
                                      </tr>
                                 
                                    </table>
                                    <hr>
                                    <h4>Attachment's </h4></div><hr>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                          <tr>
                                              <th>S/N</th>
                                              <th>Tittle</th>
                                              <th>Uploaded Date</th>
                                              <th>Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php if(!empty($uploadsdata) && count($uploadsdata) > 0){ $i = 1; ?>
                                            <?php foreach($uploadsdata as $data){ ?>
                                              <tr>
                                                <td><?php echo $i++ ?></td>
                                                <td><?php echo isset($data['title']) ? $data['title'] : "-------"; ?></td>
                                                <td><?php echo isset($data['created_date']) ? $data['created_date'] : "-------"; ?></td>
                                                <td colspan="2"><a class="btn btn-xs btn-primary text-light" target="popup"  onclick="window.open('<?php echo ROOT.$data['url'] ?>', 'popup','width=600,height=600', 'noopener')" return false >View</a> </td>
                                                <?php if(isset($data['createdby']) && $data['createdby'] == $_SESSION['user'][0]['id']){ ?>
                                                <td> <button  onclick="removeImg('<?php echo $data['id'] ?>','<?php echo $data['actiontype'] ?>','<?php echo $data['url'] ?>')" class="btn btn-xs btn-danger">remove</button></td>
                                                <?php } else { ?>
                                                  <td>&nbsp;</td>
                                                <?php } ?>
                                              </tr>
                                            <?php } ?>
                                            
                                          <?php } else { ?>
                                              <tr><td colspan="4">No Attachment found</td></tr>
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

             <!-- show upload modal-->
    <div class="modal fade" id="upload_modal" tabindex="-1" role="dialog" aria-labelledby="viewclient" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Upload</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="frmupload"   enctype = "multipart/form-data">
                    <input type="hidden" name="createdby" id="createdby" value="<?php echo isset($_SESSION['user']) ? $_SESSION['user'][0]['id'] : "" ; ?>">
                    <input type="hidden" name="actiontype" id="actiontype" > <!-- action type 2 represent requisition -->
                    <input type="hidden" name="actionid" id="actionid"> <!-- action id, primary key -->
                    <div class="form-group">
                        <label for="lbltitle">Image tittle</label>
                        <input type="text" class="form-control" name="imgtitle" id="imgtitle">
                        <span id="titleerror"></span>
                    </div>
                    <div class="form-group">
                        <label for="lbltitle">choose file</label>
                        <input class="form-control" type="file" name="imgupload"  id="imgupload">
                    </div>
                    <div id="error"></div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                        <button type="button" id="btn_upload" class="btn btn-primary"> Upload</button>
                    </div>
                </form>
          </div>
        </div>
    </div>


<?php  require '../includes/footer.php'; ?>
<script>
    function showupload(actionid, actiontype){
        
        $('#upload_modal #actionid').empty();
        $('#upload_modal #actionid').val(actionid);
        $('#upload_modal #actiontype').val(actiontype);
        $('#upload_modal').modal("show");
    }


   // uploads start here
    btn_upload.onclick = ()=>{
        var imgtitle = document.getElementById('imgtitle').value;
        var createdby = document.getElementById('createdby').value;
        var actiontype = document.getElementById('actiontype').value;
        var imgname = document.getElementById('imgupload').files[0];
        var actionid = document.getElementById('actionid').value;


        let formData = new FormData();

        formData.append("file", imgname);
        formData.append("title", imgtitle);
        formData.append("createdby", createdby);
        formData.append("actiontype", actiontype);
        formData.append("actionid", actionid);

        // console.log(formData);

        if($('#imgtitle').val() == ""){
          $("#titleerror").html("Image Tittle field Can't be empty").addClass("text-danger");
        }else{
            $.ajax({
                url:'../../../library/request.php?action=upload',
                type:'POST',
                data: formData,
                processData: false,
                contentType: false,
                success:function(data){
                    let datas = JSON.parse(data);
                    if(datas.status == 1){
                      window.location.reload();
                    }else if(datas.status == 0){
                      $.each(datas.error, function (i, elem) { 
                        $('#upload_modal #error').empty();
                        $('#upload_modal #error').append(datas.error[i]).addClass('text-danger');
                        $('#upload_modal #error').append(', ');
                      });
                    }
                },error: function(e){
                    console.log(e);
                },
            }); 
        }
    }

    function removeImg(id,actiontype, url){
        let delurl = "../../../library/request.php?action=deleteupload";
        let data = {'id': id, 'actiontype': actiontype, 'url': url };
        if(confirm("Are you sure you want to delete ?")){
            $.ajax({
              type: "POST",
              url: delurl,
              data: data ,
              dataType: "JSON",
              success: function (response) {
                if(response == true){
                  alert("Detail deleted Successfully");
                  window.location.reload();
                }
              }
            });
        }
    }
</script>