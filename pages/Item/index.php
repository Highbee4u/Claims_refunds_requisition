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
                        <h4 class="page-title">Item List(s)</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Item</a></li>
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
                                <button class="btn btn-primary" onclick="create_item_modal()" ><i class="fa fa-plus "></i>Create Item</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>&nbsp;</th>
                                                <th>S/N</th>
                                                <th>Item Name</th>
                                                <th>Item Type</th>
                                                <th>UOM</th>
                                                <th>Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $data = $item->fetch_all();
                                            if(count($data) > 0) {   
                                                $i = 1;
                                            foreach($data as $dt){
                                            ?>
                                                <tr>
                                                <td><a  onclick="edit_item('<?php echo $dt['itemid']; ?>')"><i class="fa fa-edit"></i></a></td>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo isset($dt['itemname']) ? $dt['itemname'] : ""; ?></td>
                                                <td><?php echo isset($dt['itemtypeid']) ? $dt['itemtypeid'] == '1' ? 'Stock Item' : 'Non Stock Item' : ""; ?></td>
                                                <td><?php echo isset($dt['uom']) ? $uom->get_uom_name($dt['uom']) : ""; ?></td>
                                                <td><?php echo isset($dt['qty']) ? $dt['qty'] : ""; ?></td>
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
    <div class="modal fade" id="additem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Create New Item</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form id="frmAddItem" onsubmit="return false">
            <div class="form-group">
                <label for="exampleInputEmail1">Item Name:</label>
               <input type="text" name="itemname" class="form-control" id="itemname">
                <span id="itemnameError"></span>
                <label for="exampleInputEmail1">Item Type:</label>
                <select name="itemtype" class="form-control"  onchange="selecteditem(this)" id="itemtype">
                  <option value="">choose item type</option>
                  <option value="1">Stock Item</option>
                  <option value="2">Non Stock Item</option>
                </select>
                <span id="itemtypeerror"></span>
                <label for="exampleInputEmail1">Notify When Qty equals:</label>
               <input type="number" name="limit" class="form-control" id="limit">
                <span id="limiterror"></span>
                <label for="exampleInputEmail1">UOM:</label>
                <select name="uom" class="form-control" id="uom"></select>
                <span id="uomerror"></span>
            </div>
            
          </div>
          <div class="modal-footer">
                <button type="submit" class="btn btn-success" >Save</button>
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
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Item</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form id="frmEditItem" onsubmit="return false">
            <div class="form-group">
              <input type="hidden" id="itemid">
                <label for="exampleInputEmail1">Item Name:</label>
               <input type="text" name="itemname" class="form-control" id="itemname">
                <span id="itemnameError"></span>
                <label for="exampleInputEmail1">Item Type:</label>
                <select name="itemtype" class="form-control" id="itemtype">
                  <option value="">choose item type</option>
                  <option value="1">Stock Item</option>
                  <option value="2">Non Stock Item</option>
                </select>
                <span id="itemtypeerror"></span>
                <label for="exampleInputEmail1">UOM:</label>
                <select name="uom" class="form-control" id="uom"></select>
                <span id="uomerror"></span>
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
  let uomArray;

function create_item_modal(){
  $("#additem #uom").append('<option value=""> -- Select Uom -- </option>');
    $.each(uomArray, function (indexInArray, valueOfElement) { 
      $("#additem #uom").append("<option value="+uomArray[indexInArray].id+">"+uomArray[indexInArray].uomname+"</option>");
    });
    $("#additem #lbllimit").hide();
    $("#additem #limit").hide();

    $("#additem").modal('show');
}

function get_uom(){
  let url = "../../library/request.php?action=getuom";

  $.ajax({
    type: "GET",
    url: url,
    dataType: "JSON",
    success: function (response) {
        uomArray = response;          
    }
});

}

function edit_item(id){
  let url = "../../library/request.php?action=getitem";

  var data = {'itemid': id}
  $.ajax({
    type: "POST",
    url: url,
    data: data,
    dataType: "JSON",
    success: function (response) {
      console.log(response);
      $("#edititem #itemname").val(response[0].itemname);
      $("#edititem #itemid").val(response[0].itemid);
      $("#edititem #itemtype").val(response[0].itemtypeid);
      $.each(uomArray, function (indexInArray, valueOfElement) { 
        $("#edititem #uom").append("<option " + (uomArray[indexInArray].id == response[0].itemid ? 'selected' : '') + " value="+uomArray[indexInArray].id+">"+uomArray[indexInArray].uomname+"</option>");
      });
    }
  });
  
  $("#edititem").modal('show');
}

$('form#frmAddItem').submit(function(){
  if(confirm("Are you sure you want to add this item")){

  let itemname = $("#itemname").val();
  let uom = $("#uom").val();
  let itemtype = $("#itemtype").val();
  let limit = $("#limit").val();

  var status = false;

   // validate item name
  if(itemname == "" ) {
      $('#itemnameError').html('Item name cannot be blank').addClass('text-danger');
      status = true;
  }
  else{
      $('#itemnameError').html(" ");
  }
  if(uom == "" ) {
      $('#uomerror').html('UOM field cannot be blank').addClass('text-danger');
      status = true;
  }
  else{
      $('#uomerror').html(" ");
  }
  
  if(itemtype == "" ) {
      $('#itemtypeerror').html('item type id field cannot be blank').addClass('text-danger');
      status = true;
  } else if(itemtype == "1"){
      if(limit == ""){
        $('#limiterror').html('limit field cannot be blank for stock Item').addClass('text-danger');
        status = true;
      }else{
        $('#limiterror').html('');
      }
  }else{
    $('#itemtypeerror').html(" ");
  }


  if(status == false){
    let res = '';
    var data = {'itemname': itemname, 'uom':uom, 'itemtype':itemtype, 'limit':limit }
    $.ajax({

      type: "POST",
      url: "../../library/request.php?action=createitem",
      data: data,
      dataType: "JSON",
      success: function (response) {
          let responses = JSON.parse(response);
                    
          if(responses == true){
              alert("Item Added Successfully");
              window.location.reload();
          }else{
              alert("Error Adding Item");
          }
      }
    });
  }

}
});

// save edit detail
$('form#frmEditItem').submit(function(){
  
  let itemname = $("#frmEditItem #itemname").val();
  let uom = $("#frmEditItem #uom").val();
  let itemid = $("#frmEditItem #itemid").val();
  let itemtype = $("#frmEditItem #itemtype").val();

  var status = false;

   // validate item name
  if(itemname == "" ) {
      $('#frmEditItem #itemnameError').html('Item name cannot be blank').addClass('text-danger');
      status = true;
  }
  else{
      $('#frmEditItem #itemnameError').html(" ");
  }
  if(uom == "" ) {
      $('#frmEditItem #uomerror').html('UOM field cannot be blank').addClass('text-danger');
      status = true;
  }
  else{
      $('#frmEditItem #uomerror').html(" ");
  }
  if(itemtype == "" ) {
      $('#frmEditItem #itemtypeerror').html('Item type field cannot be blank').addClass('text-danger');
      status = true;
  }else{
      $('#frmEditItem #itemtypeerror').html(" ");
  }
  

    

  if(status == false){
    let res = '';
    var data = {'itemname': itemname, 'uom':uom, 'itemtype':itemtype,'itemid':itemid}
    $.ajax({

      type: "POST",
      url: "../../library/request.php?action=updateitemdetail",
      data: data,
      dataType: "JSON",
      success: function (response) {
          let responses = JSON.parse(response);
                    
          if(responses == true){
              alert("Item details updated Successfully");
              window.location.reload();
          }else{
              alert("Error Adding Item");
          }
      }
    });
  }

  
});

 function selecteditem(id){
   if(id.value == 1){
     $("#additem #lbllimit").show(); 
     $("#additem #limit").show(); 
   } else{
    $("#additem #lbllimit").hide(); 
     $("#additem #limit").hide(); 
   }
 }


$(document).ready(function () {
  get_uom();
});
</script>