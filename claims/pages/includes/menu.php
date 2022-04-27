<?php 
require '../../../model/User.php'; ?>
<!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin5">
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
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo "../dashboard/audit.php"; ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                        <?php } else if(isset($_SESSION['user']) && $user->is_accountant($_SESSION['user'][0]['id'])) { ?>
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo "../dashboard/accountant.php"; ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                        <?php } else if(isset($_SESSION['user']) && $user->is_hr($_SESSION['user'][0]['id'])) {?>
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo "../dashboard/hr.php"; ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                        <?php } else if(isset($_SESSION['user']) && $user->is_hmo($_SESSION['user'][0]['id'])) {?>
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo "../dashboard/hmo.php"; ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                        <?php } else if(isset($_SESSION['user']) && $user->is_bcc($_SESSION['user'][0]['id'])) { ?>
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo "../dashboard/bcc.php"; ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                        <?php } else if(isset($_SESSION['user']) && $user->is_hod($_SESSION['user'][0]['id'])) {?>
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo "../dashboard/hod.php"; ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                        <?php } ?>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Claims </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="<?php echo "../claims/index.php"; ?>" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Create And View Claims </span></a></li>
                                <li class="sidebar-item"><a href="<?php echo "../claims/history.php"; ?>" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">Claims History</span></a></li>
                               <?php if(isset($_SESSION['user']) && ($user->is_admin($_SESSION['user'][0]['id']))){ ?>
                                    <li class="sidebar-item"><a href="<?php echo "../claims/claimscategory.php"; ?>" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Claim category(s) </span></a></li>
                               <?php } ?>     
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Refund </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="<?php echo "../refund/index.php"; ?>" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Create And View Refund(s) </span></a></li>
                                <li class="sidebar-item"><a href="<?php echo "../refund/history.php"; ?>" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">Refund History</span></a></li>
                            </ul>
                        </li>
                        <?php if(isset($_SESSION['user']) && ($user->is_hr($_SESSION['user'][0]['id']))){ ?>
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Approval </span></a>
                                <ul aria-expanded="false" class="collapse  first-level">
                                    <li class="sidebar-item"><a href="<?php echo "../claims/hrapprove.php"; ?>" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Approve Claim(s) </span></a></li>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if(isset($_SESSION['user']) && $user->canAudit($_SESSION['user'][0]['id'])){ ?>
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Audits </span></a>
                                <ul aria-expanded="false" class="collapse  first-level">
                                    <li class="sidebar-item"><a href="<?php echo "../claims/audit.php"; ?>" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Audit Claim(s) </span></a></li>
                                    <li class="sidebar-item"><a href="<?php echo "../refund/audit.php"; ?>" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">Audit Refund(s)</span></a></li>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if(isset($_SESSION['user']) && $user->canApprove($_SESSION['user'][0]['id'])){ ?>
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Approval </span></a>
                                <ul aria-expanded="false" class="collapse  first-level">
                                    <li class="sidebar-item"><a href="<?php echo "../claims/approve.php"; ?>" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Approve Claim(s) </span></a></li>
                                    <li class="sidebar-item"><a href="<?php echo "../refund/approve.php"; ?>" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">Approve Refund(s)</span></a></li>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if(isset($_SESSION['user']) && $user->is_bcc($_SESSION['user'][0]['id'])){ ?>
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Approval </span></a>
                                <ul aria-expanded="false" class="collapse  first-level">
                                    <li class="sidebar-item"><a href="<?php echo "../refund/bccapprove.php"; ?>" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Approve Refund(s) </span></a></li>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if(isset($_SESSION['user']) && $user->is_hod($_SESSION['user'][0]['id'])){ ?>
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Approval </span></a>
                                <ul aria-expanded="false" class="collapse  first-level">
                                    <li class="sidebar-item"><a href="<?php echo "../refund/hmoapprove.php"; ?>" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Approve Refund(s) </span></a></li>
                                </ul>
                            </li>
                        <?php } ?>
                            <?php if(isset($_SESSION['user']) && $user->is_admin($_SESSION['user'][0]['id'])){ ?>
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo "./../../../pages/dashboard/admin.php"; ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Requisition</span></a></li>
                            <?php } else if(isset($_SESSION['user']) && $user->canApprove($_SESSION['user'][0]['id'])) {?>
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo "./../../../pages/dashboard/approval.php"; ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Requisition</span></a></li>
                            <?php } else if(isset($_SESSION['user']) && $user->canAudit($_SESSION['user'][0]['id'])) {?>
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo "./../../../pages/dashboard/auditor.php"; ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Requisition</span></a></li>
                            <?php } else if(isset($_SESSION['user']) && $user->is_accountant($_SESSION['user'][0]['id'])) {?>
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo "./../../../pages/dashboard/accountant.php"; ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Requisition</span></a></li>
                            <?php } else if(isset($_SESSION['user']) && $user->is_hr($_SESSION['user'][0]['id'])) {?>
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo "./../../../pages/dashboard/hr.php"; ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Requisition</span></a></li>
                            <?php }  else if(isset($_SESSION['user']) && $user->is_hmo($_SESSION['user'][0]['id'])) {?>
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo "./../../../pages/dashboard/hmo.php"; ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Requisition</span></a></li>
                            <?php } else if(isset($_SESSION['user']) && $user->is_bcc($_SESSION['user'][0]['id'])) {?>
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo "./../../../pages/dashboard/bcc.php"; ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Requisition</span></a></li>
                            <?php } else if(isset($_SESSION['user']) && $user->is_hod($_SESSION['user'][0]['id'])) {?>
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo "./../../../pages/dashboard/hod.php"; ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Requisition</span></a></li>
                            <?php } ?>
                            
                            <?php if(isset($_SESSION['user']) && $user->is_admin($_SESSION['user'][0]['id'])){ ?>

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