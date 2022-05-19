<?php
 require '../../../global.php';
 require '../../dao/category.php';

 if (!isset($_SESSION['user'])) {
  header('Location: /sublime/client/pages/user/login.php');
}
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
    <div class="container-scroller">
        <!-- partial:../../partials/_navbar.html -->
        <?php
            include '../../components/navbar.php'
        ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:../../partials/_sidebar.html -->
            <?php
                include '../../components/sidebar.php'
            ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            <span class="page-title-icon bg-gradient-primary text-white me-2">
                                <i class="mdi mdi-format-list-bulleted"></i>
                            </span>
                            Categories
                        </h3>
                        <a href="" class="nav-link">
                            <button type="button" class="btn btn-success btn-fw">Add Categories</button>
                        </a>

                    </div>
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">User Table</h4>
                                    </p>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Name</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $categories = allCategories();
                                                foreach ($categories as $category) {
                                                    echo "
                                                        <tr>
                                                            <th><input type='checkbox' name='id_user[]' value='".$category['id_category']."'></th>
                                                            <td>".$category['name_category']."</td>
                                                            <td class='d-flex'>
                                                                <button class='btn btn-inverse-success btn-fw'><i class='fa fa-edit'></i> Edit</button>
                                                                <button  class='btn btn-inverse-warning btn-fw'>Delete</button>
                                                            </td>
                                                        </tr>

                                                    ";
                                                }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4">
                                                    <button class="btn btn-outline-secondary btn-sm" id="select-all" type="button">Select All</button>
                                                    <button class="btn btn-outline-secondary btn-sm" id="clear-all" type="button">Clear All</button>
                                                    <button class="btn btn-outline-secondary btn-sm" id="delete-hand" type="button">Delete</button>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
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
    <script src="/sublime/client/js/table.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
</body>

</html>