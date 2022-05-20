<?php
 require '../../../global.php';
 require '../../dao/product.php';

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
        if (isset($_POST['btn-delete'])) {
            $id = $_POST['id_product'];
            try {
                deleteProduct($id);
                $_SESSION['success'] = 'Product has been updated successfully';
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
                                <i class="mdi mdi-apple"></i>
                            </span>
                            Products
                        </h3>
                        <a href="./addProduct.php" class="nav-link">
                            <button type="button" class="btn btn-success btn-fw">Add Product</button>
                        </a>
                    </div>
                    <!-- Modal Description -->
                    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="editModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><b><span class="name"></span></b></h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p id="desc"></p>
                                </div>
                                <div class="modal-footer d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Delete -->
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
                                    <form class="forms-sample" method="POST" action="products.php">
                                        <input type="hidden" class="id_product" name="id_product">
                                        <div class="text-center">
                                            <p>DELETE Product</p>
                                            <h2 class="bold productname"></h2>
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
                                    <h4 class="card-title">Product Table</h4>
                                    </p>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Product</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Sale</th>
                                                <th>View number</th>
                                                <th>CreateAt</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $products = getAllProducts();
                                                foreach ($products as $product){
                                                    $image =(!empty($product['image_product'])) ? '../../../client/images/products/'.$product['image_product'] : '../../assets/images/faces-clipart/pic-1.png';
                                                    echo"
                                                    <tr>
                                                        <th><input type='checkbox' name='id_product[]' value='".$product['id_product']."'></th>
                                                        <td class='py-1'>
                                                            <img src='".$image."' alt='image' />
                                                        </td>
                                                        <td>".$product['name_product']."</td>
                                                        <td>".$product['price_product']."</td>
                                                        <td>".$product['sale_product']."</td> 
                                                        <td>".$product['view_of_number']."</td>
                                                        <td>".$product['createAt_product']."</td>
                                                        <td class='d-flex text-right'>
                                                            <button type='button' class='detail btn btn-inverse-dark btn-fw btn-md'
                                                            data-bs-toggle='modal' data-bs-target='#detailModal'
                                                            data-id='".$product['id_product']."'>
                                                                <i class='mdi mdi-eye'></i> View</button>
                                                            <a href='$ADMIN_URL/pages/products/editProduct.php?editproduct&id=".$product['id_product']."' class='btn btn-inverse-info btn-fw btn-md'>Edit</a>
                                                            <button type='button' data-bs-toggle='modal' data-bs-target='#deleteModal'
                                                            class='btn btn-delete btn-inverse-danger btn-fw btn-md' data-id='".$product['id_product']."'>Delete</button>
                                                        </td>
                                                    </tr>
                                                    ";
                                                }
                                            ?>
                                        </tbody>
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
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
</body>

</html>
<script>
$(function() {
    $(document).on('click', '.detail', function(e) {
        var id = $(this).data('id');
        getRow(id);
    });
    $(document).on('click', '.btn-delete', function(e) {
        var id = $(this).data('id');
        getRow(id);
    });
})

function getRow(id) {
    $.ajax({
        type: 'POST',
        url: 'product_row.php',
        data: {
            id: id
        },
        dataType: 'json',
        success: function(response) {
            $('#desc').html(response.description_product);
            $('.name').html(response.name_product);
            $('.productname').html(response.name_product);
            $('.id_product').val(response.id_product);
        }
    });
}
</script>