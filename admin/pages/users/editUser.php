<?php 
 require '../../../global.php';

 if (!isset($_SESSION['user'])) {
  header('Location: /sublime/client/pages/user/login.php');
}
    require '../../dao/user.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
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
    <!-- End layout styles -->
    <link rel="shortcut icon" href="/sublime/admin/assets/images/favicon.ico" />
</head>

<body>
    <?php
    extract($_REQUEST);
    $user = getUserById($id_user);
        if (isset($_POST['btn-update'])) {
            $name_user = $_POST['name_user'];
            $fullname_user = $_POST['fullname_user'];
            $email_user = $_POST['email_user'];
            $status_user = $_POST['status_user'];
            $role_user = $_POST['role_user'];

                $filename = $_FILES['image_user']['name'];
                if(!empty($filename)){
                  move_uploaded_file($_FILES['image_user']['tmp_name'], '../images/'.$filename);	
                }
                try {
                    updateUser($id_user, $name_user, $fullname_user, $email_user, $status_user, $role_user);
                    $_SESSION['success'] = 'User updated successfully';
                    header('Location: users.php');
                } catch(PDOException $e){
                    $_SESSION['error'] = $e->getMessage();
                }
        }
        
    ?>
    <div class="container-scroller">
        <!-- partial:../../partials/_navbar.html -->
        <?php
            include '../../components/navbar.php';
        ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:../../partials/_sidebar.html -->
            <?php
                include '../../components/sidebar.php';
            ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            <span class="page-title-icon bg-gradient-primary text-white me-2">
                                <i class="mdi mdi-account"></i>
                            </span>
                            Users
                        </h3>
                        <?php
                           if (isset($_SESSION['error'])) {
                            echo "
                                <div class='alert alert-danger d-flex align-items-center justify-content-between px-4' role='alert'>
                                        ".$_SESSION['error']."
                                        <button type'button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>
                                    ";
                                    unset($_SESSION['error']);
                        }
                        if (isset($_SESSION['success'])) {
                            echo "
                                <div class='alert alert-success d-flex align-items-center justify-content-between px-4' role='alert'>
                                        ".$_SESSION['success']."
                                        <button type'button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>
                                    ";
                                    unset($_SESSION['success']);
                        }
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Basic form elements</h4>
                                    <p class="card-description"> Basic form elements </p>
                                    <form class="forms-sample" method="post" action="editUser.php"
                                        enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputName1">Username</label>
                                            <input type="text" value="<?=$user['name_user']?>" class="form-control"
                                                name="name_user" id="exampleInputName1" placeholder="Name">
                                            <input type="hidden" value="<?=$user['name_user']?>" name="id_user">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Full name</label>
                                            <input type="text" value="<?=$user['fullname_user']?>" class="form-control"
                                                name="fullname_user" id="exampleInputName1" placeholder="Full name">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail3">Email address</label>
                                            <input type="email" value="<?=$user['email_user']?>" class="form-control"
                                                name="email_user" id="exampleInputEmail3" placeholder="Email">
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Status</label>
                                                <div class="col-sm-4">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input"
                                                                <?=!$user['status_user']  ? 'checked' : null;?>
                                                                name="status_user" id="membershipRadios1" value="ADMIN">
                                                            Actived </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input"
                                                                <?=$user['status_user']  ? 'checked' : null;?>
                                                                name="status_user" id="membershipRadios2" value="USER">
                                                            Not actived </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Role</label>
                                                <div class="col-sm-4">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input"
                                                                <?=$user['role_user'] == 'ADMIN' ? 'checked' : null;?>
                                                                name="role_user" id="membershipRadios1" value="ADMIN">
                                                            Admin </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input"
                                                                <?=$user['role_user'] !== 'ADMIN' ? 'checked' : null;?>
                                                                name="role_user" id="membershipRadios2" value="USER">
                                                            User </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" name="btn-update"
                                            class="btn btn-gradient-primary me-2 btn-update">Submit</button>
                                        <button class="btn btn-light">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:../../partials/_footer.html -->
                <footer class="footer">
                    <div class="container-fluid d-flex justify-content-between">
                        <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Copyright ©
                            bootstrapdash.com 2021</span>
                        <span class="float-none float-sm-end mt-1 mt-sm-0 text-end"> Free <a
                                href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap
                                admin template</a> from Bootstrapdash.com</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
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
    <!-- Custom js for this page -->
    <script src="/sublime/admin/assets/js/file-upload.js"></script>
    <!-- End custom js for this page -->
</body>

</html>