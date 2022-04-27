<?php session_start(); ?>
<?php (isset($_SESSION['user']) && $_SESSION['user'][0]['login_attempt'] != 0 ? header("location:javascript://history.go(-1)") : "");?>
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
    <title>Matrix Template - The Ultimate Multipurpose admin template</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
</head>

<body>
    <div class="main-wrapper">
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
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
            <div class="auth-box bg-dark border-top border-secondary">
                <div id="loginform">
                    <div class="text-center p-t-20 p-b-20">
                    <div class="col-md-12 text-white">Hi <?php echo(isset($_SESSION['user']) ? $_SESSION['user'][0]['name'] : ""); ?></div>
                    <div class="col-md-12 text-white">Please Change your password to continue</div>
                    </div>
                    <!-- Form -->
                    <form class="form-horizontal m-t-20 bg-color-light" id="changepasswordform" name="changepasswordform" onsubmit="return false">
                        <div class="row p-b-30">
                            <div class="col-12">
                            <input type="hidden" name="email" id="email" class="form-control" value="<?php echo (isset($_SESSION['user']) ? $_SESSION['user'][0]['email'] : "") ?>" autofocus>
          <input type="hidden" name="userid" id="userid" class="form-control" value="<?php echo (isset($_SESSION['user']) ? $_SESSION['user'][0]['id'] : "") ?>">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Enter New Password" aria-label="Username" aria-describedby="basic-addon1" required>
                                    <span id="passworderror"></span>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" id="cpassword" name="cpassword" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" required>
                                    <span id="cpassworderror"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row border-top border-secondary">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="p-t-20">
                                        <button class="btn btn-success float-right" type="submit">Change Password</button>
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
        $('form#changepasswordform').submit(function(){

var password = $('#password').val();
 var confirmpassword  = $('#cpassword').val();
 var userid  = $('#userid').val();
 var email  = $('#email').val();

 

 var status = false;

 // validate password
 if(password == "") {
     $('#passworderror').html('Password Field Cannot be empty').addClass('text-danger');
     document.getElementbyId('password').focus();
     status = true;
 }
 else{
     $('#passworderror').html(" ");
 }
 // validate confirm password
 if(confirmpassword == ""){
     $('#cpassword').html('Confirm Password Field cannot be empty').addClass('text-danger');
     document.getElementbyId('confirmpassword').focus();
     status = true;
 }else{
     $('#cpassword').html(" ");
 }

//  validate for matching
if(password != confirmpassword){
    $('#passworderror').html('Password and Confirm password doesnot match').addClass('text-danger');
    $('#cpassworderror').html('Password and Confirm password doesnot match').addClass('text-danger');

    status = true;
}else{
    $('#passworderror').html(" ");
    $('#cpassworderror').html(" ");
}

if(status == false){
     let res = '';
     var data = {'userid': userid, 'password':password, 'email':email }
     $.ajax({
         url: "library/request.php?action=changepassword",
         type: 'POST',
         data: data,
         dataType: 'JSON',
         success:function(data){
           if(data == 1){
               alert("Password Change Successful");
               window.location = 'index.php';
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