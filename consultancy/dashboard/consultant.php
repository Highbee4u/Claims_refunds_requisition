

<?php require '../includes/header.php';   ?>

<?php require '../../model/Requisition.php'; ?>
<?php require '../../model/Item.php'; ?>
<?php require '../../model/Consultant.php'; ?>


<?php require '../includes/menu.php'; ?>
        <?php 
  $total_service_per_day = $consultant->get_total_service_per_day();

  $total_patients = $consultant->total_patients();
  $awaiting_approval = $consultant->fetch_by_criterial(array('Approved'=> 0), 'consultings_header');
  $awaiting_auditing = $consultant->fetch_by_criterial(array('Audited'=> 0), 'consultings_header');

  $admin_data = array(
    'total_service' => number_format((float)$total_service_per_day['total'], 2, '.', ''),
    'total_patients' => $total_patients,
    'awaiting_approval' => $awaiting_approval,
    'awaiting_auditing' => $awaiting_auditing
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
                        <h4 class="page-title">Consultant Dashboard</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Consultant</li>
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
                                <h6 class="text-white"><?php  echo isset($admin_data['awaiting_auditing']) ? "(".count($admin_data['awaiting_auditing']).")" : "(0)"; ?> Awaiting Auditing(s)</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-chart-areaspline"></i></h1>
                                <h6 class="text-white"><?php  echo isset($admin_data['awaiting_approval']) ? "(".count($admin_data['awaiting_approval']).") " : "(0) "; ?>Awaiting Approval(s)</h6>
                            </div>
                        </div>
                    </div>
                     <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-warning text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-collage"></i></h1>
                                <h6 class="text-white"><?php  echo isset($admin_data['total_patients']) ? "(".count($admin_data['total_patients']).") " : "(0) "; ?>Total Patient(s) Attend to</h6>
                            </div>
                        </div>
                    </div>
                     <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-warning text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-collage"></i></h1>
                                <h6 class="text-white"><?php  echo "(".$admin_data['total_service'].")"; ?>Total Amount / Day</h6>
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