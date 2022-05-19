<?php 
 require '../../../global.php';

    require '../../dao/user.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>User</title>
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
        if (isset($_POST['btn-create'])) {
            $name_user = $_POST['name_user'];
            $fullname_user = $_POST['fullname_user'];
            $password_user = $_POST['password_user'];
            $email_user = $_POST['email_user'];
            $status_user = $_POST['status_user'];
            $role_user = $_POST['role_user'];
            $filename = $_FILES['image']['name'];
                if(!empty($filename)){
                  move_uploaded_file($_FILES['image']['tmp_name'], '../../../client/images/'.$filename);	
                }
                try {
                    addUserByAdmin($name_user, $fullname_user, $password_user, $filename, $email_user, $status_user, $role_user);
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
                                <div class='alert alert-warning' role='alert'>
                                    ".$_SESSION['error']."
                                </div>
                                ";
                                unset($_SESSION['error']);
                            }
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Basic form elements</h4>
                                    <p class="card-description"> Basic form elements </p>
                                    <form class="forms-sample" method="post" action="newUser.php"
                                        enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputName1">Username</label>
                                            <input type="text" class="form-control" name="name_user"
                                                id="exampleInputName1" placeholder="Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Full name</label>
                                            <input type="text" class="form-control" name="fullname_user"
                                                id="exampleInputName1" placeholder="Full name">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Password</label>
                                            <input type="password" class="form-control" name="password_user"
                                                id="exampleInputName1" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail3">Email address</label>
                                            <input type="email" class="form-control" name="email_user"
                                                id="exampleInputEmail3" placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            <label>Image</label>
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
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Status</label>
                                                <div class="col-sm-4">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" checked
                                                                name="status_user" id="membershipRadios1" value="0">
                                                            Actived </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input"
                                                                name="status_user" id="membershipRadios2" value="1">
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
                                                                name="role_user" id="membershipRadios1" value="ADMIN">
                                                            Admin </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" checked
                                                                name="role_user" id="membershipRadios2" value="USER">
                                                            User </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" name="btn-create"
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