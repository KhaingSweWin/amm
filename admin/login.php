<?php 
session_start();
session_unset();
include_once __DIR__."/../controller/usercontroller.php";
$user_controller = new UserController;
if(isset($_POST['submit'])){
    if(!empty($_POST['email']))
    {
        $form_email=$_POST['email'];
    }
    if(!empty($_POST['password']))
    {
        $form_password=$_POST['password'];
    }
   
    $results=$user_controller->getUser();
    print_r($results);
    foreach($results as $result){
      if((password_verify($form_password,$result['password'])&& $form_email==$result['email'])){
        $_SESSION['email']=$form_email;
        $_SESSION['password']=$form_password;
        header("Location:../index.php");
       
      }
      else{
        header("Location:../error404.php");
      }
      
    }

}

?>
<?php 

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Skydash Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../vendors/feather/feather.css">
  <link rel="stylesheet" href="../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="../images/agmyanmar.png" alt="logo">
              </div>
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form class="pt-3" action="" method="POST" autocomplete="off">
              <input type="hidden" name="" value="login">
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username" name="email" required>
                  <span class="text-danger"><?php if(isset($enter_email)) echo $enter_email ?>  </span>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" name="password" required>
                  <h5><?php if(isset($pwd_error)) echo $pwd_error;  ?></h5>
                </div>
                <div class="mt-3">
                  <input class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" name="submit" id="submit" type="submit">
                </div>
             
               
                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="register.php" class="text-primary">Create</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../js/off-canvas.js"></script>
  <script src="../js/hoverable-collapse.js"></script>
  <script src="../js/template.js"></script>
  <script src="../js/settings.js"></script>
  <script src="../js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>
