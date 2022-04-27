<?php require '../includes/header.php';   ?>
<?php require_once '../../model/Claim.php'; ?>
<?php require_once '../../model/Refund.php'; ?>
<?php require_once '../../model/Requisition.php'; ?>
<?php require '../includes/menu.php'; ?>
<?php 
    $claimsawaitingAudit = $claim->fetch_by_criterial(array('Audited'=> 0), 'claims_header');
    $refundsawaitingAudit = $refund->fetch_by_criterial(array('audited'=> 0), 'refunds_header');
    $requisitionawaitingAudit = $req->fetch_by_criterial(array('audited'=> 0), 'requisition_header');
    $totalrequisition = $req->fetch_all();
   

  $admin_data =array(
    'awaitingaudit_claims' => $claimsawaitingAudit,
    'awaitingaudit_refunds' => $refundsawaitingAudit,
    'requisition_awaitingaudit' => $requisitionawaitingAudit,
    'totalrequisition' => $totalrequisition,
    
  ); ?>
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
                        <h4 class="page-title">Dashboard</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Auditor</li>
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
                    <div class="col-md-6 col-lg-3 col-xlg-4">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
                                    <?php  
                                    if(isset($admin_data['awaitingaudit_claims']) && count($admin_data["awaitingaudit_claims"]) > 0){
                                      echo '<h4 class="text-white"><span class="blink_text">('.count($admin_data["awaitingaudit_claims"]).')</span><br>Claim(s) Awaiting Audit</h4>';
                                    } else {
                                      echo '<h6 class="text-white">(0) <br> Awaiting Audit(s)</h6>';
                                    }
                                  ?>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-4">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-chart-areaspline"></i></h1>
                                <?php  
                                    if(isset($admin_data['awaitingaudit_refunds']) && count($admin_data["awaitingaudit_refunds"]) > 0){
                                      echo '<h4 class="text-white"><span class="blink_text">('.count($admin_data["awaitingaudit_refunds"]).')</span><br> Refund(s) Awaiting Audit</h4>';
                                    } else {
                                      echo '<h6 class="text-white">(0) <br> Awaiting Audit(s)</h6>';
                                    }
                                  ?>
                            </div>
                        </div>
                    </div>
                     <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-4">
                        <div class="card card-hover">
                            <div class="box bg-warning text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-collage"></i></h1>
                                <?php 
                                     if(isset($admin_data['requisition_awaitingaudit']) && count($admin_data["requisition_awaitingaudit"]) > 0){
                                        echo '<h4 class="text-white"><span class="blink_text">('.count($admin_data["requisition_awaitingaudit"]).')</span><br> Requisition(s) Awaiting Audit</h4>';
                                      } else {
                                        echo '<h6 class="text-white">(0) <br> Awaiting Audit(s)</h6>';
                                      }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 col-xlg-4">
                        <div class="card card-hover">
                            <div class="box bg-warning text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-collage"></i></h1>
                                <?php 
                                     if(isset($admin_data['totalrequisition']) && count($admin_data["totalrequisition"]) > 0){
                                        echo '<h4 class="text-white">('.count($admin_data["totalrequisition"]).')<br> Total Requisition(s)</h4>';
                                      } else {
                                        echo '<h6 class="text-white">(0) <br> Total Requisition(s)</h6>';
                                      }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Sales chart -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4 class="card-title">Site Analysis</h4>
                                        <h5 class="card-subtitle">Overview of Latest Month</h5>
                                    </div>
                                </div>
                                <div class="row">
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Sales chart -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                All Rights Reserved by Matrix-admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../../assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="../../dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../../dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <!-- <script src="../../dist/js/pages/dashboards/dashboard1.js"></script> -->
    <!-- Charts js Files -->
    <script src="../../assets/libs/flot/excanvas.js"></script>
    <script src="../../assets/libs/flot/jquery.flot.js"></script>
    <script src="../../assets/libs/flot/jquery.flot.pie.js"></script>
    <script src="../../assets/libs/flot/jquery.flot.time.js"></script>
    <script src="../../assets/libs/flot/jquery.flot.stack.js"></script>
    <script src="../../assets/libs/flot/jquery.flot.crosshair.js"></script>
    <script src="../../assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="../../dist/js/pages/chart/chart-page-init.js"></script>

</body>

</html>