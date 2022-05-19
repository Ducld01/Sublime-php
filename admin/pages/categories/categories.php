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
    <?php
        if (isset($_POST['btn-add'])){
            $name = $_POST['name_category'];
            if (categoryExists($name)) {
                $_SESSION['error'] = 'Category already exists';
            } else {
                try {
                    create_category($name);
                    $_SESSION['success'] = 'Category added successfully';
                } catch (\Throwable $th) {
                    $_SESSION['error'] = $e->getMessage();
                }
            }
        }
       
        if (isset($_POST['btn-edit'])){
            $id = $_POST['id_cate'];
		    $name = $_POST['name_cate'];
            try {
                updateCategory($id, $name);
                $_SESSION['success'] = 'Category has been updated successfully';
            } catch (\Throwable $th) {
                $_SESSION['error'] = $e->getMessage();
            }
        }

        if (isset($_POST['btn-delete'])){
            $id = $_POST['id_cate'];
            try {
                deleteCategory($id, $name);
                $_SESSION['success'] = 'Category has been updated successfully';
            } catch (\Throwable $th) {
                $_SESSION['error'] = $e->getMessage();
            }
        }
    ?>
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
                        <button type="button" class="btn btn-success btn-fw" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Add Categories</button>

                    </div>
                    <!-- Modal add -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal Add Category</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="forms-sample" method="post" action="categories.php">
                                        <div class="form-group">
                                            <label for="exampleInputName1">Name</label>
                                            <input type="text" class="form-control" id="exampleInputName1"
                                                name="name_category" placeholder="Name">
                                        </div>

                                </div>
                                <div class="modal-footer d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="btn-add">Add</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal edit -->
                    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Modal Edit Category</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="forms-sample" method="POST" action="categories.php">
                                        <input type="hidden" class="category_id" name="id_cate">
                                        <div class="form-group">
                                            <label for="Inputname">Name</label>
                                            <input type="text" class="form-control" id="Inputname" name="name_cate"
                                                placeholder="Name">
                                        </div>
                                </div>
                                <div class="modal-footer d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="btn-edit">Save change</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal delete -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Modal Delte Category</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="forms-sample" method="POST" action="categories.php">
                                        <input type="hidden" class="category_id" name="id_cate">
                                        <div class="text-center">
                                            <p>DELETE CATEGORY</p>
                                            <h2 class="bold cname"></h2>
                                        </div>
                                </div>
                                <div class="modal-footer d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger" name="btn-delete">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
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
                                                                <button class='btn btn-inverse-success btn-fw btn-edit' data-bs-toggle='modal'
                                                                    data-bs-target='#editModal' data-id='".$category['id_category']."'>
                                                                    <i class='fa fa-edit'></i> Edit
                                                                </button>
                                                                <button  class='btn btn-delete btn-inverse-warning btn-fw' data-bs-toggle='modal'
                                                                    data-bs-target='#deleteModal' data-id='".$category['id_category']."'>Delete</button>
                                                            </td>
                                                        </tr>

                                                    ";
                                                }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4">
                                                    <button class="btn btn-outline-secondary btn-sm" id="select-all"
                                                        type="button">Select All</button>
                                                    <button class="btn btn-outline-secondary btn-sm" id="clear-all"
                                                        type="button">Clear All</button>
                                                    <button class="btn btn-outline-secondary btn-sm" id="delete-hand"
                                                        type="button">Delete</button>
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
<script>
$(function() {
    $(document).on('click', '.btn-edit', function(e) {
        // e.preventDefault();
        var id = $(this).data('id');
        getRow(id);
    });

    $(document).on('click', '.btn-delete', function(e) {
        var id = $(this).data('id');
        getRow(id);
    });

});

function getRow(id) {
    $.ajax({
        type: 'POST',
        url: 'category_row.php',
        data: {
            id: id
        },
        dataType: 'json',
        success: function(response) {
            console.log(response);
            $('.category_id').val(response.id_category);
            $('#Inputname').val(response.name_category);
            $('.cname').html(response.name_category);
        }
    });
}
</script>