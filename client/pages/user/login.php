<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="/sublime/admin/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/sublime/admin/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="/sublime/admin/assets/css/style.css">
    <link rel="stylesheet" href="/sublime/client/styles/main_styles.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="/sublime/admin/assets/images/favicon.ico" />
</head>

<body>
    <?php
      require '../../../global.php';
      require '../../../admin/dao/user.php';

      extract($_REQUEST);

      if (existParam("btn-lg")) {
        $user = getUserById($name_user);
        if ($user) {
          if ($user['password_user'] == $password_user) {
            $_SESSION['success'] = "Login successfully!";
            header("location: /sublime/index.php");
            
            if (existParam("rememberme")) {
              addCookie("name_user", $name_user, 30);
              addCookie("password_user", $password_user, 30);
            }
            else{
              deleteCookie("name_user");
              deleteCookie("password_user");
            }
            $_SESSION['user'] = $user;

            if(isset($_SESSION['request_uri'])){
              header("location: " . $_SESSION['request_uri']);
          }
          }
          else {
            $_SESSION['error'] = " Incorrect Password";
          }
        }
        else{
          $_SESSION['error'] = "Username is wrong";
        }
      }
      
    ?>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <?php 
                          if (isset($_SESSION['success'])) {
                            echo "
                            <div class='alert alert-success' role='alert'>
                            ".$_SESSION['success']."
                          </div>
                            ";
                            unset($_SESSION['success']);
                          }
                          if (isset($_SESSION['error'])) {
                            echo "
                            <div class='alert alert-danger' role='alert'>
                            ".$_SESSION['error']."
                          </div>
                            ";
                            unset($_SESSION['error']);
                          }
                        ?>
                        <div class="auth-form-light text-left p-5">
                            <div class="logo"><a href="#">Sublime.</a></div>
                            <h4>Hello! let's get started</h4>
                            <h6 class="font-weight-light">Sign in to continue.</h6>
                            <form class="pt-3" method="POST" action="login.php">
                                <div class="form-group">
                                    <input type="text" name="name_user" class="form-control form-control-lg"
                                        id="exampleInputEmail1" required placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input type="password" required name="password_user"
                                        class="form-control form-control-lg" id="exampleInputPassword1"
                                        placeholder="Password">
                                </div>
                                <div class="form-check mx-sm-2">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="rememberme" class="form-check-input"> Remember me
                                    </label>
                                </div>
                                <div class="mt-3">
                                    <button name="btn-lg"
                                        class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"
                                        type="submit">SIGN IN</button>
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                    </div>
                                    <a href="<?=$CLIENT_URL?>/pages/user/forgotPassword.php"
                                        class="auth-link text-black">Forgot password?</a>
                                </div>
                                <div class="text-center mt-4 font-weight-light"> Don't have an account? <a
                                        href="<?=$CLIENT_URL?>/pages/user/register.php" class="text-primary">Create</a>
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
    <script src="/sublime/admin/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="/sublime/admin/assets/js/off-canvas.js"></script>
    <script src="/sublime/admin/assets/js/hoverable-collapse.js"></script>
    <script src="/sublime/admin/assets/js/misc.js"></script>
    <!-- endinject -->
</body>

</html>