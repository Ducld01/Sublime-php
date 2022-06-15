<?php
require '../../../global.php';
require '../../dao/order.php';

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
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../../assets/images/favicon.ico" />
</head>

<body>
    <?php
    $Rowperpage = 4;
    $total_row = pdo_query_value("SELECT count(*) FROM orders");
    $total_page = ceil($total_row / $Rowperpage);
    $current_page = existParam("page") ? $_GET['page'] : 1;
    if ($current_page < 1) {
        $current_page = 1;
    }
    if ($current_page > $total_page) {
        $current_page = $total_page;
    }
    $start = ($current_page - 1) * $Rowperpage;
    $sql = "SELECT * FROM orders LEFT JOIN products ON products.id_product = orders.id_product LEFT JOIN users ON users.id_user = orders.id_user ORDER BY id_order  LIMIT {$start}, {$Rowperpage}";
    $_SESSION['total_page'] = $total_page;
    $_SESSION['prev_page'] = ($current_page > 1) ? ($current_page - 1) : 1;
    $_SESSION['next_page'] = ($current_page < $total_page) ? ($current_page + 1) : $total_page;
    $orders = pdo_query($sql);
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
                                <i class="mdi mdi-cart-outline"></i>
                            </span>
                            Orders
                        </h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Order Table</h4>
                                    </p>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Product</th>
                                                <th>Quantity</th>
                                                <th>User</th>
                                                <th>Phone</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($orders as $order) {
                                                $image = (!empty($order['image_product'])) ? '../../../client/images/products/' . $order['image_product'] : '../../assets/images/faces-clipart/pic-1.png';
                                                echo "<tr>
                                                    <td class='py-1'>
                                                        <img src='" . $image . "' alt='image' />
                                                    </td>
                                                    <td>" . $order['name_product'] . "</td>
                                                    <td>" . $order['quantity_product'] . "</td>
                                                    <td>" . $order['name_user'] . "</td>
                                                    <td>" . $order['phone_number'] . "</td>
                                                    </tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <div class="product_pagination mt-3">
                                        <ul class="d-flex" style="list-style: none">
                                            <li class="page-item">
                                                <a class="page-link" href="?&page=<?= $_SESSION['prev_page'] ?>" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                            <?php
                                            for ($i = 1; $i <= $_SESSION['total_page']; $i++)
                                                echo "<li class='page-item'><a class='page-link' href='??&page=$i'>$i</a></li> ";
                                            ?>
                                            <li class="page-item">
                                                <a class="page-link" href="?&page=<?= $_SESSION['next_page'] ?>" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
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
                        <span class="float-none float-sm-end mt-1 mt-sm-0 text-end"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap
                                admin template</a> from Bootstrapdash.com</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <style>
        .product_pagination {
        display: flex;
        justify-content: flex-end;
    }
	.rows-per-page{
		margin: 10px 20px 0 0;
	}
    </style>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/hoverable-collapse.js"></script>
    <script src="../../assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
</body>

</html>