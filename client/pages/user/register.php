<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register</title>
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
      if (isset($_POST['btn-register'])) {
          $name_user = $_POST['name_user'];
          $fullname_user = $_POST['fullname_user'];
          $email_user = $_POST['email_user'];
          $password_user = $_POST['password_user'];
          $confirm_password = $_POST['confirm_password'];
          $status_user = $_POST['status_user'];
          $role_user = $_POST['role_user'];
          $regexUsername = '/^[a-zA-Z0-9_]{5,30}$/';
          $regexPassword = '/^[a-zA-Z0-9_]{6,30}$/';
          $regexEmail =  '/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/'; 
          if (existUser($email_user)) {
            $_SESSION['error'] = 'Email already registered';
          } else if (existUserName($name_user)){
            $_SESSION['error'] = 'Username already registered';
          } else if (!preg_match($regexUsername,$name_user)) {
            $_SESSION['error'] = 'Invalid username';
          } else if (!preg_match($regexPassword,$password_user)) {
            $_SESSION['error'] = 'Password Minimum 6 characters and No more than 30 characters';
          } else if (!preg_match($regexEmail,$email_user)) {
            $_SESSION['error'] = 'Invalid email';
          } else if ($password_user !==$confirm_password) {
            $_SESSION['error'] = 'Confirm password is not matching';
          } else{
            $filename = $_FILES['image']['name'];
            if(!empty($filename)){
              move_uploaded_file($_FILES['image']['tmp_name'], '../../images/'.$filename);
              if (move_uploaded_file($_FILES['image']['tmp_name'], '../../images/'.$filename)) {
                echo "Image uploaded successfully";
              } else {
                echo "Image uploaded failed";
              }
            }
            try{
              addUser($name_user, $fullname_user, $password_user, $filename, $email_user, $status_user, $role_user);
              $_SESSION['success'] = 'User added successfully';
              header('Location: login.php');
            }
            catch(PDOException $e){
              $_SESSION['error'] = $e->getMessage();
            }
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
                            <div class="logo"><a href="">Sublime.</a></div>
                            <h4>New here?</h4>
                            <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                            <form class="pt-3" method="post" action="register.php" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="text" name="name_user" class="form-control form-control-lg"
                                        id="exampleInputUsername1" placeholder="Username" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="fullname_user" class="form-control form-control-lg"
                                        id="exampleInputUsername1" placeholder="Full name" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email_user" class="form-control form-control-lg"
                                        id="exampleInputEmail1" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password_user" class="form-control form-control-lg"
                                        id="exampleInputPassword1" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="confirm_password" class="form-control form-control-lg"
                                        id="exampleInputPassword1" placeholder="Confirm Password">
                                        <input type="hidden" name="role_user" value="USER">
                                        <input type="hidden" name="status_user" value="1">
                                </div>
                                <div class="form-group">
                                    <input type="file" name="image" id="image" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled
                                            placeholder="Image">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-gradient-primary"
                                                type="button">Upload</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="mt-3 mb-4">
                                    <button
                                        class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"
                                        name="btn-register" type="submit">SIGN UP</button>
                                </div>
                                <div class="text-center mt-4 font-weight-light"> Already have an account? <a
                                        href="<?=$CLIENT_URL?>/pages/user/login.php" class="text-primary">Login</a>
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
    <script src="/sublime/admin/assets/js/file-upload.js"></script>
    <!-- endinject -->
</body>

</html>