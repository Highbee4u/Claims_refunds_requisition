<?php require_once '../../model/User.php'; ?>
<!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- #27a9e3 -->
        <aside class="left-sidebar"  data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                        <?php if(isset($_SESSION['user']) && $user->is_admin($_SESSION['user'][0]['id'])){ ?>
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo "../dashboard/admin.php"; ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                        <?php } else if(isset($_SESSION['user']) && $user->canApprove($_SESSION['user'][0]['id'])) {?>
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo "../dashboard/approval.php"; ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                        <?php } else if(isset($_SESSION['user']) && $user->canAudit($_SESSION['user'][0]['id'])) {?>
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo "../dashboard/auditor.php"; ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                        <?php } else if(isset($_SESSION['user']) && $user->is_accountant($_SESSION['user'][0]['id'])) {?>
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo "../dashboard/accountant.php"; ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                        <?php } else if(isset($_SESSION['user']) && $user->is_hr($_SESSION['user'][0]['id'])) {?>
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo "../dashboard/hr.php"; ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                        <?php } else if(isset($_SESSION['user']) && $user->is_consultant($_SESSION['user'][0]['id'])) {?>
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo "../dashboard/consultant.php"; ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                        <?php } ?>
                        <?php  if(isset($_SESSION['user']) && !$user->is_consultant($_SESSION['user'][0]['id'])){ ?>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Requisition </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                
                                <li class="sidebar-item"><a href="<?php echo "../requisition/index.php"; ?>" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Create And View Requisition </span></a></li>
                                <?php  if((isset($_SESSION['user']) && $user->canAudit($_SESSION['user'][0]['id'])) || $_SESSION['user'][0]['user_roleid'] == -1){ ?>
                                    <li class="sidebar-item"><a href="<?php echo "../requisition/audit.php"; ?>" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Audit Requisition </span></a></li>
                                <?php  } ?>
                                <?php  if((isset($_SESSION['user']) && $user->canApprove($_SESSION['user'][0]['id'])) || $_SESSION['user'][0]['user_roleid'] == -1){ ?>
                                    <li class="sidebar-item"><a href="<?php echo "../requisition/approve.php"; ?>" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Approve Requisition </span></a></li>
                                <?php  } ?>
                                <?php  if((isset($_SESSION['user']) && $_SESSION['user'][0]['user_roleid'] == 3)){ ?>
                                    <li class="sidebar-item" ><a href="<?php echo "../procurement/index.php"; ?>" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> List Requisition Awaiting </span></a></li>
                                <?php  } ?>
                                <li class="sidebar-item"><a href="<?php echo "../requisition/history.php"; ?>" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">Requisition History</span></a></li>
                            </ul>
                        </li>
                        <?php } ?>
                        <?php if(isset($_SESSION['user']) && $user->is_admin($_SESSION['user'][0]['id'])){ ?>
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Item </span></a>
                                <ul aria-expanded="false" class="collapse  first-level">
                                    <li class="sidebar-item"><a href="<?php echo "../Item/index.php"; ?>" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Create And View Item(s) </span></a></li>
                                    <li class="sidebar-item"><a href="<?php echo "../Item/uom.php"; ?>" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Uom(s) </span></a></li>
                                    <li class="sidebar-item"><a href="<?php echo "../Item/movement.php"; ?>" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Item Movement(s) </span></a></li>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if(isset($_SESSION['user']) && $user->is_admin($_SESSION['user'][0]['id'])){ ?>
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Users </span></a>
                                <ul aria-expanded="false" class="collapse  first-level">
                                    <li class="sidebar-item"><a href="<?php echo "../users/index.php"; ?>" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Create And View User(s) </span></a></li>
                                    <li class="sidebar-item"><a href="<?php echo "../users/department.php"; ?>" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Department(s) </span></a></li>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php  if(isset($_SESSION['user']) && !$user->is_consultant($_SESSION['user'][0]['id'])){ ?>
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo "../../claims/pages/dashboard/admin.php"; ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Refunds And Claims</span></a></li>
                        <?php } ?>
                        <?php if(isset($_SESSION['user']) && $user->is_consultant($_SESSION['user'][0]['id'])){ ?>
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Consultancy </span></a>
                                <ul aria-expanded="false" class="collapse  first-level">
                                    <li class="sidebar-item"><a href="<?php echo "../../consultancy/pages/index.php"; ?>" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Create And View Record(s) </span></a></li>
                                    <li class="sidebar-item"><a href="<?php echo "../users/department.php"; ?>" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> History </span></a></li>
                                </ul>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->