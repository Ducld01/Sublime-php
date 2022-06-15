<?php 
    require '../../../global.php';
    require '../../dao/product.php';
    require '../../dao/category.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Product</title>
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
            $name = $_POST['name'];
            $price = $_POST['price'];
            $sales = $_POST['sales'];
            $createAt = $_POST['createAt'];
            $description = $_POST['description'];
            $viewnumber = $_POST['viewnumber'];
            $special = $_POST['special'];
            $category = $_POST['category'];
            $filename = $_FILES['image']['name'];
                if(!empty($filename)){
                  move_uploaded_file($_FILES['image']['tmp_name'], '../../../client/images/products/'.$filename);	
                }
                try {
                    createProduct($name, $price, $sales, $filename, $createAt, $description, $special, $viewnumber, $category);
                    $_SESSION['success'] = 'Product has been created successfully';
                    // header('Location: users.php');
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
                            Product
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
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Add Product Form</h4>
                                    <form class="form-sample" method="post" action="addProduct.php" enctype="multipart/form-data">
                                        <p class="card-description"> Product info </p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Name</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="name" class="form-control" placeholder=" Name" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Price</label>
                                                    <div class="col-sm-9"> 
                                                        <input type="text" name="price" class="form-control" placeholder="Price" required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Sales</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="sales" class="form-control" placeholder="Sales" />
                                                        <input type="hidden" name="viewnumber" value="0" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Create At</label>
                                                    <div class="col-sm-9">
                                                        <input type="date" name="createAt" class="form-control"
                                                            placeholder="dd/mm/yyyy" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Category</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="category">
                                                            <?php
                                                                $categories = allCategories();
                                                                foreach ($categories as $category) {
                                                                    echo "<option value='".$category['id_category']."'>".$category['name_category']."</option>";
                                                                }
                                                            ?>>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Special</label>
                                                    <div class="col-sm-4">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input"
                                                                    name="special" id="membershipRadios1"
                                                                    value="0" checked> Special </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input"
                                                                    name="special" id="membershipRadios2"
                                                                    value="1"> Normal </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Description</label>
                                                    <div class="col-sm-9">
                                                    <textarea class="form-control" name="description" id="exampleTextarea1" rows="4"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Image</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" name="image" id="image"
                                                            class="file-upload-default">
                                                        <div class="input-group col-xs-12">
                                                            <input type="text" class="form-control file-upload-info"
                                                                disabled placeholder="Image">
                                                            <span class="input-group-append">
                                                                <button
                                                                    class="file-upload-browse btn btn-gradient-primary"
                                                                    type="button">Upload</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group d-flex justify-content-between">
                                                    <button class="btn btn-light">Cancel</button>
                                                    <button type="submit" name="btn-create"
                                                        class="btn btn-gradient-primary me-2 btn-update">Submit</button>
                                                </div>
                                            </div>
                                        </div>
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