<?php (isset($_SESSION['user']) ? header("location:javascript://history.go(-1)") : "");?>
<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>ISALU REQUISITION AND PAYMENT VOUCHER</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
</head>

<body>
    <div class="main-wrapper" >
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-light" >

            <div class="auth-box bg-primary border-top border-secondary">
                <div id="loginform">
                    <div class="text-center p-t-20 p-b-20">
                        <span class="db"><img src="assets/images/logo5.png" alt="logo" /></span>
                    </div>
                    <!-- Form -->
                    <form class="form-horizontal m-t-20" id="loginform" name="loginform" onsubmit="return false">
                        <div class="row p-b-30">
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" id="email" placeholder="Enter Your Email" aria-label="Username" aria-describedby="basic-addon1" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" id="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                        <div class="row border-top border-secondary">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="p-t-20">
                                        <button class="btn btn-info" id="to-recover" type="button"><i class="fa fa-lock m-r-5"></i> Lost password?</button>
                                        <button class="btn btn-success float-right" type="submit">Login</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="recoverform">
                    <div class="text-center">
                        <span class="text-white">Enter your e-mail address below and we will send you instructions how to recover a password.</span>
                    </div>
                    <div class="row m-t-20">
                        <!-- Form -->
                        <form class="col-12" action="index.html">
                            <!-- email -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="ti-email"></i></span>
                                </div>
                                <input type="text" class="form-control form-control-lg" placeholder="Email Address" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <!-- pwd -->
                            <div class="row m-t-20 p-t-20 border-top border-secondary">
                                <div class="col-12">
                                    <a class="btn btn-success" href="#" id="to-login" name="action">Back To Login</a>
                                    <button class="btn btn-info float-right" type="button" name="action">Recover</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>

    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    // ============================================================== 
    // Login and Recover Password 
    // ============================================================== 
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
    $('#to-login').click(function(){
        
        $("#recoverform").hide();
        $("#loginform").fadeIn();
    });
    </script>
     <script>
        $('form#loginform').submit(function(){

             var email = $('#email').val();
             var password  = $('#password').val();
             var status = false;

              // email regular expression
              var emailRegex =/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
              // validate email
              if(email == "" || !emailRegex.test(email)) {
                  $('#emailError').html('Enter Valid Email Address').addClass('text-danger');
                  status = true;
              }
              else{
                  $('#emailError').html(" ");
              }
             // validate password
             if(password == ""){
                 $('#passwordError').html('Enter Password').addClass('text-danger');
                 status = true;
             }else{
                 $('#passwordError').html(" ");
             }

             if(status == false){
                 let res = '';
                 var data = {'email': email, 'password':password}
                 $.ajax({
                     url: "library/login.php",
                     type: 'POST',
                     data: data,
                     dataType: 'JSON',
                     success:function(data){
                      //  console.log(data.data[0]);
                       if(data.status == 1){
                          alert(data.message);
                          if(data.data[0].login_attempt == 0){ window.location = 'change-password.php'; }
                          else if(data.data[0].user_roleid == '-1'){
                            window.location = 'pages/dashboard/admin.php';
                          }else if(data.data[0].user_roleid == '0'){
                            window.location = 'pages/dashboard/dashboard.php';
                          }else if(data.data[0].user_roleid == '1'){
                            window.location = 'pages/dashboard/auditor.php';
                          }else if(data.data[0].user_roleid == '2'){
                            window.location = 'pages/dashboard/approval.php';
                          }else if(data.data[0].user_roleid == '3'){
                            window.location = 'pages/procurement/index.php';
                          }else if(data.data[0].user_roleid == '4'){
                            window.location = 'pages/dashboard/accountant.php';
                          }else if(data.data[0].user_roleid == '5'){
                            window.location = 'pages/dashboard/hr.php';
                          }else if(data.data[0].user_roleid == '6'){
                            window.location = 'pages/dashboard/hmo.php';
                          }else if(data.data[0].user_roleid == '7'){
                            window.location = 'pages/dashboard/bcc.php';
                          }else if(data.data[0].user_roleid == '8'){
                            window.location = 'pages/dashboard/hod.php';
                          }
                       }else{
                         alert(data.message);
                       }
                         
                     }, 
                     error: function(error){
                         console.log(error);
                     }
                 })
             }
        });
    </script>
</body>

</html>