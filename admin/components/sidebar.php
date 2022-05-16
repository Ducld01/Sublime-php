    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item nav-profile">
                <a href="#" class="nav-link">
                    <div class="nav-profile-image">
                        <img src="/sublime/admin/assets/images/faces/face1.jpg" alt="profile">
                        <span class="login-status online"></span>
                        <!--change to offline or busy as needed-->
                    </div>
                    <div class="nav-profile-text d-flex flex-column">
                        <?php
                            if (isset($_SESSION['user'])) {
                                $username = (isset($_SESSION['user'])) ? $_SESSION['user'] : null;
                                echo '<span class="font-weight-bold mb-2">'.$username['name_user'].'</span>';
                            }
                        ?>
                    </div>
                    <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=$ADMIN_URL?>/index.php">
                    <span class="menu-title">Dashboard</span>
                    <i class="mdi mdi-home menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?=$ADMIN_URL?>/pages/users/users.php" class="nav-link">
                    <span class="menu-title">Users</span>
                    <i class="mdi mdi-account menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?=$ADMIN_URL?>/pages/categories/categories.php" class="nav-link">
                    <span class="menu-title">Categories</span>
                    <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?=$ADMIN_URL?>/pages/products/products.php" class="nav-link">
                    <span class="menu-title">Products</span>
                    <i class="mdi mdi-apple menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?=$ADMIN_URL?>/pages/orders/orders.php" class="nav-link">
                    <span class="menu-title">Orders</span>
                    <i class="mdi mdi-cart-outline menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?=$ADMIN_URL?>/pages/contact/contact.php" class="nav-link">
                    <span class="menu-title">Contact</span>
                    <i class="mdi mdi-gmail menu-icon"></i>
                </a>
            </li>
        </ul>
    </nav>