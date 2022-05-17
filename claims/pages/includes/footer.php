 <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                All Rights Reserved by ISALU HOSPITAL <a href=""></a>.
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
    <script src="../../../assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../../../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../../../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../../../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../../../assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="../../../dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../../../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../../../dist/js/custom.min.js"></script>
    <!-- this page js -->
    <script src="../../../assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
    <script src="../../../assets/extra-libs/multicheck/jquery.multicheck.js"></script>
    <script src="../../../assets/extra-libs/DataTables/datatables.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        /****************************************
         *       Basic Table                   *
         ****************************************/
        $('#zero_config').DataTable();

        $(document).ready(function() {
            $('.js-example-basic-single').select2();
            
            function audit(id){
                let url = '../../library/request.php?action=audit';

                $.ajax({
                type: "POST",
                url: url,
                data: {"id":id },
                dataType: "JSON",
                success: function (response) {
                    if(response == 1){
                        window.location.reload();
                    }else{
                        alert("Unable to Audit, Please try again later");
                    }
                }
                });
            }

            function approve($id){
                let url = '../../library/request.php?action=approve';

                $.ajax({
                    type: "POST",
                    url: url,
                    data: {"id":id },
                    dataType: "JSON",
                    success: function (response) {
                        if(response == 1){
                        window.location.reload();
                        }else{
                        alert("Unable to Audit, Please try again later");
                        }
                    }
                });
            }
        });
    </script>