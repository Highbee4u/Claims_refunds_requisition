

<?php require '../includes/header.php';   ?>

<?php require '../../../model/Requisition.php'; ?>
<?php require_once '../../../model/Claim.php'; ?>
<?php require_once '../../../model/Refund.php'; ?>

        <?php require '../includes/menu.php'; ?>
        <?php 
  $claimsawaitingpayment = $claim->fetch_by_criterial(array('Accounting_status'=> 0), 'claims_header');
  $refundsawaitingpayment = $refund->fetch_by_criterial(array('Accounting_status'=> 0), 'refunds_header');
  $totalclaims = $claim->fetch_all();
  $totalrefunds = $refund->fetch_all();

  $admin_data =array(
    'awaitingpayment_claims' => $claimsawaitingpayment,
    'awaitingpayment_refund' => $refundsawaitingpayment,
    'totalclaims' => $totalclaims,
    'totalrefund' => $totalrefunds
  );
  
?>
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
                        <h4 class="page-title">Accountant Dashboard</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Accountant</li>
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
                <!-- Sales Cards  -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
                                <?php  
                                    if(isset($admin_data['awaitingpayment_claims']) && count($admin_data["awaitingpayment_claims"]) > 0){
                                      echo '<h6 class="text-white"><span class="blink_text">('.count($admin_data["awaitingpayment_claims"]).')</span><br> Refunds Awaitig Payment(s)</h6>';
                                    } else {
                                      echo '<h6 class="text-white">(0) <br> Refunds Awaitig Payment(s)</h6>';
                                    }
                                  ?>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-chart-areaspline"></i></h1>
                                <?php  
                                    if(isset($admin_data['awaitingpayment_refund']) && count($admin_data["awaitingpayment_refund"]) > 0){
                                      echo '<h6 class="text-white"><span class="blink_text">('.count($admin_data["awaitingpayment_refund"]).')</span><br> Refunds Awaitig Payment(s)</h6>';
                                    } else {
                                      echo '<h6 class="text-white">(0) <br> Refunds Awaitig Payment(s)</h6>';
                                    }
                                  ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                     <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-warning text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-collage"></i></h1>
                                <?php  
                                    if(isset($admin_data['totalclaims']) && count($admin_data["totalclaims"]) > 0){
                                      echo '<h6 class="text-white">('.count($admin_data["totalclaims"]).')<br> Claims(s)</h6>';
                                    } else {
                                      echo '<h6 class="text-white">(0) <br> Claims(s)</h6>';
                                    }
                                  ?>
                            </div>
                        </div>
                    </div>
                     <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-warning text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-collage"></i></h1>
                                <?php  
                                    if(isset($admin_data['totalrefund']) && count($admin_data["totalrefund"]) > 0){
                                      echo '<h6 class="text-white">('.count($admin_data["totalrefund"]).')<br> Refunds(s)</h6>';
                                    } else {
                                      echo '<h6 class="text-white">(0) <br> Refunds(s)</h6>';
                                    }
                                  ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <?php require '../includes/footer.php';   ?>