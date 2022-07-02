<?php require '../includes/header.php'; ?>
<?php require '../../model/Requisition.php'; ?>
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
                        <h4 class="page-title">Requisition List(s)</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Requisition</a></li>
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
                                <button class="btn btn-primary" onclick="create_modal()" ><i class="fa fa-plus "></i>Create Requisition</button>
                            </div>
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
                                                <th>Returned By</th>
                                                <th>Procmnt Status</th>
                                                <th>Auditor Status</th>
                                                <th>MD Status</th>
                                                <th>DESC</th>
                                                <th>Uploads</th>
                                                <th>Approval Req.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if($_SESSION['user'][0]['user_roleid'] == -1 || $_SESSION['user'][0]['user_roleid'] == 1 || $_SESSION['user'][0]['user_roleid'] == 2 || $_SESSION['user'][0]['user_roleid'] == 3 || $_SESSION['user'][0]['user_roleid'] == 4 || $_SESSION['user'][0]['user_roleid'] == 5 || $_SESSION['user'][0]['user_roleid'] == 7 || $_SESSION['user'][0]['user_roleid'] == 8){
                                                $data = $req->fetch_all();
                                            }else{
                                                $data = $req->fetch_by_criterial(array('reqby'=>$_SESSION['user'][0]['email']));
                                            }
                                            
                                            if(count($data) > 0) {   
                                            foreach($data as $dt){
                                            ?>
                                                <tr>
                                                <td>
                                                    <?php if($dt['approvalRequest'] == 1 || $dt['approved'] == 1 || $dt['audited'] == 1 ) { ?>
                                                        <a href="view.php?id=<?php echo $dt['reqnumber']; ?>"><i class="fa fa-eye"></i></i></a>
                                                        <a href="printable.php?id=<?php echo $dt['reqnumber']; ?>"><i class="fa fa-print"></i></a>
                                                      
                                                    <?php } else{ ?>  
                                                        <a  href="detail.php?id=<?php echo $dt['reqnumber']; ?>&rectype=<?php echo $dt['requisitiontype']; ?>"><i class="fa fa-edit"></i></a>
                                                        <a onclick ="delete_requisition('<?php echo $dt['reqnumber']; ?>')"><i class='fa fa-trash'></i></i></a>
                                                        <a href="printable.php?id=<?php echo $dt['reqnumber']; ?>"><i class="fa fa-print"></i></a>
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo $dt['reqnumber']; ?></td>
                                                <td><?php echo isset($dt['reqby']) ? $user->get_user_name_by_email($dt['reqby']) : ""; ?></td>
                                                <td><?php echo isset($dt['departmentid']) && $dt['departmentid'] !=0 ? $department->get_depart_name_by_id($dt['departmentid']) : ""; ?></td>
                                                <td><?php echo $dt['reqdate']; ?></td>
                                               
                                               <!-- <td> <?php /* echo isset($dt['return']) && $dt['return'] == 1 ? "<span class='bg-danger blink_text' style = 'color: white'>Returned</span><br>".$dt['returneddate'] : "--------------"; */?></td> -->


                                                <td>
                                                    <?php if($dt['returnedby'] == NULL ||$dt['returnedby'] == 0){
                                                        echo '---------------'; 
                                                    } else {
                                                        echo "<span class='bg-danger' style = 'color: white'>".$user->get_user_name_by_id($dt['returnedby'])."</span>";
                                                    } ?>
                                                </td>
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
                                                <td> <button type="submit" class="btn btn-success text-center btn-xs" onclick="ViewDetail('<?php echo $dt['reqnumber']; ?>')">view</button></td>
                                                <td> <a type="submit" class="btn btn-success text-center btn-xs" target="_blank" href="uploads.php?actionid=<?php echo $dt['reqnumber']; ?>&actiontype=1">Uploads</a></td>
                                                <td><?php echo ($dt['approvalRequest'] == 1 ? 'Yes' : 'No'); ?></td>
                                                </tr>
                                            <?php } } else { ?>
                                                <tr>
                                                    <td colspan="10" class="text-center">No Record To Display</td>
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
                <!-- <label for="exampleInputEmail1">To be Approved By:</label>
                <select name="approvedby" class="form-control" id="approvedby" required></select>
                <span id="approvedbyerror"></span> -->
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

                <!-- view desc. modal -->
    <div class="modal fade" id="viewdetail"  role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Requisition Description</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <input type="hidden" name="requisitionid" id="requisitionid" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
                <label for="exampleInputEmail1">Date Requested:</label>
                <input type="text" name="dateRequested" class="form-control" readonly id="dateRequested" >
                <label for="exampleInputEmail1">Requisition Description:</label>
                <textarea name="desc" id="desc" class="form-control"  readonly></textarea>
            </div>
            
          </div>
          <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            
          </div>
        </div>
      </div>
    </div>

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
                    <input type="hidden" name="actiontype" id="actiontype" value="1"> <!-- action type 1 represent requisition -->
                    <input type="hidden" name="actionid" id="actionid" value="1"> <!-- action id, primary key -->
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
  let Auditors;
  let Approvals;

  let links = new Array();

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

  // function get_approval(){
  //   let url = "../../library/request.php?action=getapproval";

  //   $.ajax({
  //     type: "POST",
  //     url: url,
  //     dataType: "JSON",
  //     success: function (response) {
  //           Approvals = response;
  //     }
  //   });
  // }

  function create_modal(){

    $("#addrequisition #auditedby").empty();
    $("#addrequisition #auditedby").append("<option value=''>-- Select Auditor --</option>");
    $.each(Auditors, function (indexInArray, valueOfElement) { 
        $("#addrequisition #auditedby").append("<option value="+Auditors[indexInArray].id+">"+Auditors[indexInArray].name+"</option>");
    });

    // $("#addrequisition #approvedby").empty();
    // $("#addrequisition #approvedby").append("<option value=''>-- To be Approved By --</option>");
    // $.each(Approvals, function (indexInArray, valueOfElement) { 
    //     $("#addrequisition #approvedby").append("<option value="+Approvals[indexInArray].id+">"+Approvals[indexInArray].name+"</option>");
    // });

    $("#addrequisition #reqby").val("<?php echo isset($_SESSION['user']) ? $_SESSION['user'][0]['email'] : "" ; ?>");
    $("#addrequisition #departmentid").val("<?php echo isset($_SESSION['user']) ? $_SESSION['user'][0]['departmentid'] : "" ; ?>");

      $("#addrequisition").modal('show');
  }

  $('form#frmRequisition').submit(function(){

    var reqby = $('#reqby').val();
    var reqdate = "<?php echo date("Y-m-d h:i:s", time()); ?>";
    var auditedby = $('#auditedby').val();
    // var approvedby = $('#approvedby').val();
    var description = $('#description').val();
    var department = $('#departmentid').val();
    var requisitiontype = $('#requisitiontype').val();
    var awaiting_price;
    

        var status = "";

        if(requisitiontype == 1){
            awaiting_price = 1;
        }else if(requisitiontype == 2){
            awaiting_price = 0;
        }

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
        // if(approvedby == ""){
        //     $('#approvedbyerror').html('To be approved by cannot be empty').addClass('text-danger');
        //     status = true;
        // }else{
        //     $('#approvedbyerror').html(" ");
        // }
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
            
            // var data = {'reqby': reqby, 'reqdate':reqdate, 'auditedby':auditedby, 'approvedby':approvedby, 'description':description, 'department':department, 'requisitiontype': requisitiontype }
            var data = {'reqby': reqby, 'reqdate':reqdate, 'auditedby':auditedby, 'description':description, 'department':department, 'requisitiontype': requisitiontype, 'awaiting_price':awaiting_price }
            $.ajax({
                url: "../../library/request.php?action=createrequisitionheader",
                type: 'POST',
                data: data,
                dataType: 'JSON',
                success:function(data){
                    if(data.id != "" || data.id != "undefined"){
                        window.location = "detail.php?id="+data.id+"&rectype="+data.rectype;
                    }else{
                        alert("Unable to create requisition, try later");
                    }
                    
                    
                }, 
                error: function(error){
                    console.log(error);
                }
            })
        }

    
  });

  function ViewDetail(id){
    if(id.lenght == 0){
        return false;
    } else {
      let url = "../../library/request.php?action=getrequisitionheader";

      $.ajax({
        type: "POST",
        url: url,
        data: {"id":id},
        dataType: "JSON",
        success: function (response) {
            if(response){
                $("#viewdetail #dateRequested").empty();
                $("#viewdetail #dateRequested").val(response[0].reqdate);
                $("#viewdetail #desc").empty();
                $("#viewdetail #desc").val(response[0].description);
                $("#viewdetail").modal('show');
            }
        }
      });
    }

    
  }

    // uploads start here
    btn_upload.onclick = (actionid)=>{
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
                // url:'include/test.php',
                url:'../../library/request.php?action=upload',
                type:'POST',
                data: formData,
                processData: false,
                contentType: false,
                success:function(data){
                    let datas = JSON.parse(data);
                    if(datas.status == 1){
                      links.push(datas);
                    //   bindUploads(links);
                      
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
        // return false;
    }
  
    let bindUploads = (links) =>{
        var i = 0;
        let html = '';
        for( link of links){
            i++;
            html += `<tr> <td>${i}</td><td>${link.title}</td><td colspan="2"><a class="btn btn-xs btn-success" target="popup"  onclick="window.open('${link.link}', 'popup','width=600,height=600', 'noopener')" return false >View</a> | <button onclick="removeImg('${link.link}')" class="btn btn-xs btn-danger">remove</button></td> </tr>`
        }
        document.getElementById('myupload').innerHTML = html;
        cleartextbox();
    }

    let removeImg = (elem) =>{
        let elemIndex = links.findIndex(val => val == elem);
        links.splice(elemIndex,1);
        bindUploads(links);
    }

    function cleartextbox(){
        $('#upload_modal #imgtitle').val('');
        $('#upload_modal #imgupload').val('');
    }

    $(document).ready(function () {
        // get_approval();
        get_auditor();
    });

</script>