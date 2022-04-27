

<?php require '../includes/header.php';   ?>

<?php require '../../../model/Requisition.php'; ?>
<?php require '../../../model/Item.php'; ?>
<?php // require_once '../../../model/User.php'; ?>

<?php require '../includes/menu.php'; ?>
        <?php 
  $users = $user->get_user_count();
  $low_stock = $item->get_low_stock();
  $reqtotal = $req->fetch_all();
  $stock_count = $item->fetch_by_criterial(array('itemtypeid'=> 1));

  $admin_data = array(
    'user' => $users,
    'low_stock' => $low_stock,
    'requisition' => $reqtotal,
    'stock_count' => $stock_count
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
                        <h4 class="page-title">HMO Dashboard</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">HMO</li>
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
                                <h6 class="text-white"><?php  echo isset($admin_data['user']) ? "(".$admin_data['user'].")" : "(0)"; ?> User(s)</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-chart-areaspline"></i></h1>
                                <h6 class="text-white"><?php  echo isset($admin_data['requisition']) ? "(".count($admin_data['requisition']).") " : "(0) "; ?>Requisition(s)</h6>
                            </div>
                        </div>
                    </div>
                     <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-warning text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-collage"></i></h1>
                                <h6 class="text-white"><?php  echo isset($admin_data['stock_count']) ? "(".count($admin_data['stock_count']).") " : "(0) "; ?>Stock Item(s)</h6>
                            </div>
                        </div>
                    </div>
                     <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-warning text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-collage"></i></h1>
                                <h6 class="text-white"><?php  echo isset($admin_data['low_stock']) ? "(".count($admin_data['low_stock']).") " : "(0) "; ?>Low Stock Item(s)</h6>
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