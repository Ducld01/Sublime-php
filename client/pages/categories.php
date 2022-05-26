<?php
	require '../../global.php';
	require '../../admin/dao/cart.php';
	require '../../admin/dao/category.php';
	require '../../admin/dao/product.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Categories</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sublime project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../styles/bootstrap4/bootstrap.min.css">
    <link href="../plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="../plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="../plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="../plugins/OwlCarousel2-2.2.1/animate.css">
    <link rel="stylesheet" type="text/css" href="../styles/categories.css">
    <link rel="stylesheet" type="text/css" href="../styles/categories_responsive.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body>
    <?php
	require_once '../../admin/dao/connect.php';
	$where = '';
	if (isset($_GET['category'])){
		$id_category = $_GET['category'];
		$where = 'WHERE id_category = ' . $id_category;
	}
	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	}
	$total_row = pdo_query_value("SELECT * FROM products $where");
	$total_page = ceil($total_row/8);
	$current_page = existParam("page")? $_GET['page'] : 1;
	if ($current_page < 1) {
        $current_page = 1;
    }
    if ($current_page > $total_page){
        $current_page = $total_page;
    }
	$start = ($current_page-1)* 8;
	$sql = "SELECT * FROM products $where ORDER BY id_category LIMIT {$start}, 8";
	$_SESSION['total_page']= $total_page;
    $_SESSION['prev_page']= ($current_page > 1) ? ($current_page - 1):1;
    $_SESSION['next_page']= ($current_page < $total_page) ? ($current_page + 1):$total_page;
	$products = pdo_query($sql);
?>
    <div class="super_container">

        <!-- Header -->

        <?php include '../components/header.php' ?>

        <!-- Menu -->

        <div class="menu menu_mm trans_300">
            <div class="menu_container menu_mm">
                <div class="page_menu_content">

                    <div class="page_menu_search menu_mm">
                        <form action="#">
                            <input type="search" required="required" class="page_menu_search_input menu_mm"
                                placeholder="Search for products...">
                        </form>
                    </div>
                    <ul class="page_menu_nav menu_mm">
                        <li class="page_menu_item has-children menu_mm">
                            <a href="index.php">Home<i class="fa fa-angle-down"></i></a>
                            <ul class="page_menu_selection menu_mm">
                                <li class="page_menu_item menu_mm"><a href="categories.php">Categories<i
                                            class="fa fa-angle-down"></i></a></li>
                                <li class="page_menu_item menu_mm"><a href="product.php">Product<i
                                            class="fa fa-angle-down"></i></a></li>
                                <li class="page_menu_item menu_mm"><a href="cart.php">Cart<i
                                            class="fa fa-angle-down"></i></a></li>
                                <li class="page_menu_item menu_mm"><a href="checkout.php">Checkout<i
                                            class="fa fa-angle-down"></i></a></li>
                                <li class="page_menu_item menu_mm"><a href="contact.php">Contact<i
                                            class="fa fa-angle-down"></i></a></li>
                            </ul>
                        </li>
                        <li class="page_menu_item has-children menu_mm">
                            <a href="categories.php">Categories<i class="fa fa-angle-down"></i></a>
                            <ul class="page_menu_selection menu_mm">
                                <li class="page_menu_item menu_mm"><a href="categories.php">Category<i
                                            class="fa fa-angle-down"></i></a></li>
                                <li class="page_menu_item menu_mm"><a href="categories.php">Category<i
                                            class="fa fa-angle-down"></i></a></li>
                                <li class="page_menu_item menu_mm"><a href="categories.php">Category<i
                                            class="fa fa-angle-down"></i></a></li>
                                <li class="page_menu_item menu_mm"><a href="categories.php">Category<i
                                            class="fa fa-angle-down"></i></a></li>
                            </ul>
                        </li>
                        <li class="page_menu_item menu_mm"><a href="index.html">Accessories<i
                                    class="fa fa-angle-down"></i></a></li>
                        <li class="page_menu_item menu_mm"><a href="#">Offers<i class="fa fa-angle-down"></i></a></li>
                        <li class="page_menu_item menu_mm"><a href="contact.html">Contact<i
                                    class="fa fa-angle-down"></i></a></li>
                    </ul>
                </div>
            </div>

            <div class="menu_close"><i class="fa fa-times" aria-hidden="true"></i></div>

            <div class="menu_social">
                <ul>
                    <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div>

        <!-- Products -->

        <div class="products">
            <div class="container">
                <div class="row">
                    <div class="col">

                        <!-- Product Sorting -->
                        <div
                            class="sorting_bar d-flex flex-md-row flex-column align-items-md-center justify-content-md-start">
                            <div class="results">Showing <span>12</span> results</div>
                            <div class="sorting_container ml-md-auto">
                                <div class="sorting">
                                    <ul class="item_sorting">
                                        <li>
                                            <span class="sorting_text">Sort by</span>
                                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                            <ul>
                                                <li class="product_sorting_btn"
                                                    data-isotope-option='{ "sortBy": "original-order" }'>
                                                    <span>Default</span>
                                                </li>
                                                <li class="product_sorting_btn"
                                                    data-isotope-option='{ "sortBy": "price" }'><span>Price</span></li>
                                                <li class="product_sorting_btn"
                                                    data-isotope-option='{ "sortBy": "stars" }'><span>Name</span></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="widget-title">
                            <h2 class="mb-0">Categories</h2>
                        </div>
                        <div class="widget-content">
                            <ul class="pl-0 mb-1 list-categories-toggle">
                                <li class="item-toggle-tab"><a href="<?=$CLIENT_URL?>/pages/categories.php">All</a></li>
                                <?php
									$categories = allCategories();
									foreach ($categories as $category){
										echo "
										<li class='item-toggle-tab'>
											<a href='?category=".$category['id_category']."'>".$category['name_category']."</a>
										</li>";
									}
								?>
                            </ul>
                        </div>
                    </div>
                    <div class="product_grid col-lg-9">
                        <div class="col">
                            <div class="container">
                                <?php
								foreach ($products as $product) {
									$image = (!empty($product['image_product'])) ? '../images/products/'.$product['image_product'] : '../images/products/noimage.jpg';
									$price = !empty($product['sale_product']) ? '$'.$product['sale_product'] : '$'.$product['price_product'];
                                    $oldPrice = empty($product['sale_product']) ?  null : '$'.$product['price_product'];
									echo "
									<div class='product'>
                                		<div class='product_image'><img src='".$image."' alt='".$product['name_product']."'></div>
                                		<div class='product_content'>
                                    		<div class='product_title'><a href='".$CLIENT_URL."/pages/product.php?id_product=".$product['id_product']."'>".$product['name_product']."</a></div>
                                    		<div class=''>
											<s class='old-price'>".$oldPrice."</s>
                                            <span class='product_price'>".$price."</span>
											</div>
                                		</div>
                            		</div>
									";
								}
							?>
                            </div>
                        </div>
                        <div class="product_pagination">
                            <ul>
                                <li class="page-item">
                                    <a class="page-link" href="?&page=<?=$_SESSION['prev_page']?>"
                                        aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <?php
                				for($i = 1; $i<=$_SESSION['total_page']; $i++)
                    				echo "<li class='page-item'><a class='page-link' href='?page=$i'>$i</a></li> ";
                    			?>
                                <li class="page-item">
                                    <a class="page-link" href="?&page=<?=$_SESSION['next_page']?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Icon Boxes -->

        <div class="icon_boxes">
            <div class="container">
                <div class="row icon_box_row">

                    <!-- Icon Box -->
                    <div class="col-lg-4 icon_box_col">
                        <div class="icon_box">
                            <div class="icon_box_image"><img src="../images/icon_1.svg" alt=""></div>
                            <div class="icon_box_title">Free Shipping Worldwide</div>
                            <div class="icon_box_text">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus.
                                    Sed nec molestie.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Icon Box -->
                    <div class="col-lg-4 icon_box_col">
                        <div class="icon_box">
                            <div class="icon_box_image"><img src="../images/icon_2.svg" alt=""></div>
                            <div class="icon_box_title">Free Returns</div>
                            <div class="icon_box_text">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus.
                                    Sed nec molestie.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Icon Box -->
                    <div class="col-lg-4 icon_box_col">
                        <div class="icon_box">
                            <div class="icon_box_image"><img src="../images/icon_3.svg" alt=""></div>
                            <div class="icon_box_title">24h Fast Support</div>
                            <div class="icon_box_text">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus.
                                    Sed nec molestie.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Newsletter -->

        <div class="newsletter">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="newsletter_border"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="newsletter_content text-center">
                            <div class="newsletter_title">Subscribe to our newsletter</div>
                            <div class="newsletter_text">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus.
                                    Sed nec molestie eros</p>
                            </div>
                            <div class="newsletter_form_container">
                                <form action="#" id="newsletter_form" class="newsletter_form">
                                    <input type="email" class="newsletter_input" required="required">
                                    <button class="newsletter_button trans_200"><span>Subscribe</span></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->

        <div class="footer_overlay"></div>
        <footer class="footer">
            <div class="footer_background" style="background-image:url(../images/footer.jpg)"></div>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div
                            class="footer_content d-flex flex-lg-row flex-column align-items-center justify-content-lg-start justify-content-center">
                            <div class="footer_logo"><a href="#">Sublime.</a></div>
                            <div class="copyright ml-auto mr-auto">
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script>
                                document.write(new Date().getFullYear());
                                </script> All rights reserved | This template is made with <i class="fa fa-heart-o"
                                    aria-hidden="true"></i> by <a href="https://colorlib.com"
                                    target="_blank">Colorlib</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </div>
                            <div class="footer_social ml-lg-auto">
                                <ul>
                                    <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <style>
    .widget-title {
        padding: 6px 0 6px 14px;
        border-left: 3px solid black;
        position: relative;
        overflow: hidden;
    }

    .widget-title:after {
        content: "";
        border-bottom: 1px solid #e6e6e6;
        width: 100%;
        position: absolute;
        top: 50%;
    }

    .widget-title h2 {
        font-size: 20px;
        font-weight: 500;
        text-transform: capitalize;
        color: #000;
        position: relative;
        display: inline-block;
        padding-right: 15px;
    }

    .list-categories-toggle li a {
        line-height: 36px;
        display: inline-block;
        font-family: Quicksand;
        font-size: 15px;
        font-weight: 400;
        color: #000;
        text-transform: capitalize;
    }

    .product_grid {
        display: flex;
        flex-direction: column;
    }

    .product {
        height: 340px;
        display: flex;
        justify-content: space-between;
        flex-direction: column;
    }

    .product_pagination {
        display: flex;
        justify-content: flex-end;
    }
	.rows-per-page{
		margin: 10px 20px 0 0;
	}
    </style>
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../styles/bootstrap4/popper.js"></script>
    <script src="../styles/bootstrap4/bootstrap.min.js"></script>
    <script src="../plugins/greensock/TweenMax.min.js"></script>
    <script src="../plugins/greensock/TimelineMax.min.js"></script>
    <script src="../plugins/scrollmagic/ScrollMagic.min.js"></script>
    <script src="../plugins/greensock/animation.gsap.min.js"></script>
    <script src="../plugins/greensock/ScrollToPlugin.min.js"></script>
    <script src="../plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
    <script src="../plugins/Isotope/isotope.pkgd.min.js"></script>
    <script src="../easing/easing.js"></script>
    <script src="../plugins/parallax-js-master/parallax.min.js"></script>
    <script src="../js/categories.js"></script>
</body>

</html>