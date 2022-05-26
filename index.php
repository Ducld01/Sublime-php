<?php
// session_start();
require './global.php';
require './admin/dao/product.php';
require './admin/dao/cart.php';
//tiến hành kiểm tra là người dùng đã đăng nhập hay chưa
//nếu chưa, chuyển hướng người dùng ra lại trang đăng nhập
if (!isset($_SESSION['user'])) {
	 header('Location: /sublime/client/pages/user/login.php');
}
// sau khi đăng nhập check role, nếu role là admin thì chuyển dến trang admin
// nếu role là user thì sẽ ở lại trang index
if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
	if ($user['role_user'] == 'ADMIN') {
		header('Location: /sublime/admin/index.php');
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sublime</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sublime project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
    <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
    <link rel="stylesheet" type="text/css" href="/client/styles/customstyle.css">
    <link rel="stylesheet" type="text/css" href="./client/styles/main_styles.css">
    <link rel="stylesheet" type="text/css" href="./client/styles/responsive.css">
    <link rel="stylesheet" type="text/css" href="./client/styles/customstyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">

</head>

<body>
    <?php
    $products = getAllProducts()
 ?>
    <div class="super_container">

        <!-- Header -->

        <?php
		include './client/components/header.php';
	?>

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
                            <a href="index.html">Home<i class="fa fa-angle-down"></i></a>
                            <ul class="page_menu_selection menu_mm">
                                <li class="page_menu_item menu_mm"><a href="categories.html">Categories<i
                                            class="fa fa-angle-down"></i></a></li>
                                <li class="page_menu_item menu_mm"><a href="product.html">Product<i
                                            class="fa fa-angle-down"></i></a></li>
                                <li class="page_menu_item menu_mm"><a href="cart.html">Cart<i
                                            class="fa fa-angle-down"></i></a></li>
                                <li class="page_menu_item menu_mm"><a href="checkout.html">Checkout<i
                                            class="fa fa-angle-down"></i></a></li>
                                <li class="page_menu_item menu_mm"><a href="contact.html">Contact<i
                                            class="fa fa-angle-down"></i></a></li>
                            </ul>
                        </li>
                        <li class="page_menu_item has-children menu_mm">
                            <a href="categories.html">Categories<i class="fa fa-angle-down"></i></a>
                            <ul class="page_menu_selection menu_mm">
                                <?php 
									require_once __DIR__ . '/admin/dao/category.php';
									$categories = allCategories();
									foreach ($categories as $category) {
										echo'
											<li class="page_menu_item menu_mm">
												<a href="#">
													'.$category['name_category'].'
													<i class="fa fa-angle-down"></i>
												</a>
											</li>
										';
											}
								?>
                            </ul>
                        </li>
                        <li class="page_menu_item menu_mm"><a href="index.html">Accessories<i
                                    class="fa fa-angle-down"></i></a></li>
                        <li class="page_menu_item menu_mm"><a href="#">Offers<i class="fa fa-angle-down"></i></a></li>
                        <li class="page_menu_item menu_mm"><a href="contact.html">Contact<i
                                    class="fa fa-angle-down"></i></a></li>
                        <?php
							if (isset($_SESSION['user'])) {
								echo '
								<li class="page_menu_item menu_mm">
									<a href="'.$CLIENT_URL.'/pages/user/login.php">
										Profile<i class="fa fa-angle-down"></i>
									</a>
								</li>
								';
							}
							else {
								echo '
								<li class="page_menu_item menu_mm">
									<a href="'.$CLIENT_URL.'/pages/user/login.php">Login</a>
								</li>';
							}
						?>
                    </ul>
                </div>
            </div>

            <div class="menu_close"><i class="fa fa-times" aria-hidden="true"></i></div>

        </div>

        <!-- Home -->

        <div class="home">
            <div class="home_slider_container">

                <!-- Home Slider -->
                <div class="owl-carousel owl-theme home_slider">

                    <!-- Slider Item -->
                    <div class="owl-item home_slider_item">
                        <div class="home_slider_background" style="background-image:url(images/home_slider_1.jpg)">
                        </div>
                        <div class="home_slider_content_container">
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <div class="home_slider_content" data-animation-in="fadeIn"
                                            data-animation-out="animate-out fadeOut">
                                            <div class="home_slider_title">A new Online Shop experience.</div>
                                            <div class="home_slider_subtitle">Lorem ipsum dolor sit amet, consectetur
                                                adipiscing elit. Nullam a ultricies metus. Sed nec molestie eros. Sed
                                                viverra velit venenatis fermentum luctus.</div>
                                            <div class="button button_light home_button"><a href="#">Shop Now</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slider Item -->
                    <div class="owl-item home_slider_item">
                        <div class="home_slider_background" style="background-image:url(images/home_slider_1.jpg)">
                        </div>
                        <div class="home_slider_content_container">
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <div class="home_slider_content" data-animation-in="fadeIn"
                                            data-animation-out="animate-out fadeOut">
                                            <div class="home_slider_title">A new Online Shop experience.</div>
                                            <div class="home_slider_subtitle">Lorem ipsum dolor sit amet, consectetur
                                                adipiscing elit. Nullam a ultricies metus. Sed nec molestie eros. Sed
                                                viverra velit venenatis fermentum luctus.</div>
                                            <div class="button button_light home_button"><a href="#">Shop Now</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slider Item -->
                    <div class="owl-item home_slider_item">
                        <div class="home_slider_background" style="background-image:url(images/home_slider_1.jpg)">
                        </div>
                        <div class="home_slider_content_container">
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <div class="home_slider_content" data-animation-in="fadeIn"
                                            data-animation-out="animate-out fadeOut">
                                            <div class="home_slider_title">A new Online Shop experience.</div>
                                            <div class="home_slider_subtitle">Lorem ipsum dolor sit amet, consectetur
                                                adipiscing elit. Nullam a ultricies metus. Sed nec molestie eros. Sed
                                                viverra velit venenatis fermentum luctus.</div>
                                            <div class="button button_light home_button"><a href="#">Shop Now</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Home Slider Dots -->

                <div class="home_slider_dots_container">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="home_slider_dots">
                                    <ul id="home_slider_custom_dots" class="home_slider_custom_dots">
                                        <li class="home_slider_custom_dot active">01.</li>
                                        <li class="home_slider_custom_dot">02.</li>
                                        <li class="home_slider_custom_dot">03.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Ads -->

        <div class="avds">
            <div class="avds_container d-flex flex-lg-row flex-column align-items-start justify-content-between">
                <div class="avds_small">
                    <div class="avds_background" style="background-image:url(images/avds_small.jpg)"></div>
                    <div class="avds_small_inner">
                        <div class="avds_discount_container">
                            <img src="images/discount.png" alt="">
                            <div>
                                <div class="avds_discount">
                                    <div>20<span>%</span></div>
                                    <div>Discount</div>
                                </div>
                            </div>
                        </div>
                        <div class="avds_small_content">
                            <div class="avds_title">Smart Phones</div>
                            <div class="avds_link"><a href="./pages/categories.php">See More</a></div>
                        </div>
                    </div>
                </div>
                <div class="avds_large">
                    <div class="avds_background" style="background-image:url(images/avds_large.jpg)"></div>
                    <div class="avds_large_container">
                        <div class="avds_large_content">
                            <div class="avds_title">Professional Cameras</div>
                            <div class="avds_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a
                                ultricies metus. Sed nec molestie eros. Sed viver ra velit venenatis fermentum luctus.
                            </div>
                            <div class="avds_link avds_link_large"><a href="./pages/categories.php">See More</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="products">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="text-center mb-4">
                            <h3 class="title_heading" style="color: #000000">Our Products</h3>
                        </div>
                        <ul class="nav menu-titles justify-content-center">
                            <li class="nav-item">
                                <a class="nav-link active"  data-toggle="tab">All</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab">Best Sellers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab">Sales</a>
                            </li>

                        </ul>
                        <style>
                        .title_heading {
                            font-family: Quicksand;
                            font-size: 30px;
                            font-weight: 500;
                            line-height: 1.2;
                            text-transform: none;
                            border: none;
                            border-color: #000;
                            padding-bottom: 15px;
                            display: inline-block;
                        }

                        .menu-titles {
                            margin-bottom: 55px;
                            border-bottom: none;
                        }

                        .menu-titles li:first-child {
                            margin-left: 0;
                        }

                        .menu-titles li {
                            margin-left: 25px;
                            margin-right: 25px;
                        }

                        .menu-titles li a {
                            margin-bottom: 15px;
                            font-family: Quicksand;
                            text-transform: uppercase;
                            font-weight: 700;
                            color: #000;
                            position: relative;
                            transition: 0.3s;
                        }

                        .menu-titles li a::before {
                            content: "";
                            width: 0;
                            border-bottom: 2px solid;
                            position: absolute;
                            right: 50%;
                            bottom: -2px;
                            transition: width .3s linear 0s;
                        }

                        .menu-titles li a::after {
                            content: "";
                            width: 0;
                            border-bottom: 2px solid;
                            position: absolute;
                            left: 50%;
                            bottom: -2px;
                            transition: width .3s linear 0s;
                        }

                        .menu-titles li a.active {
                            color: #8c9b71;
                        }

                        .menu-titles li a:hover::before,
                        .menu-titles li a:hover::after {
                            width: 50%;
                        }

                        .menu-titles li a.active::before,
                        .menu-titles li a.active::after {
                            width: 50%;
                        }
                        </style>
                        <div class="product_grid">
                            <!-- Product -->
                            <?php
                                foreach ($products as $product) {
                                    $image = (!empty($product['image_product'])) ? './client/images/products/'.$product['image_product'] : './client/images/products/noimage.jpg';
                                    $price = !empty($product['sale_product']) ? '$'.$product['sale_product'] : '$'.$product['price_product'];
                                    $oldPrice = empty($product['sale_product']) ?  null : '$'.$product['price_product'];
                                    echo "
                                    <div class='product'>
                                        <div class='product_image'><img src='".$image."' alt=''></div>
                                        <div class='product_extra product_new'><a href='categories.html'>New</a></div>
                                        <div class='product_content'>
                                            <div class='product_title'><a href='./client/pages/product.php?id_product=".$product['id_product']."'>".$product['name_product']."</a></div>
                                            <s class='old-price'>".$oldPrice."</s>
                                            <span class='product_price'>".$price."</span>
                                        </div>
                                    </div>
                                    ";
                                }
                            ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>


        <!-- Ad -->

        <?php 
	include './client/components/advertisement.php'
	?>

        <!-- Icon Boxes -->

        <div class="icon_boxes">
            <div class="container">
                <div class="row icon_box_row">

                    <!-- Icon Box -->
                    <div class="col-lg-4 icon_box_col">
                        <div class="icon_box">
                            <div class="icon_box_image"><img src="images/icon_1.svg" alt=""></div>
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
                            <div class="icon_box_image"><img src="images/icon_2.svg" alt=""></div>
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
                            <div class="icon_box_image"><img src="images/icon_3.svg" alt=""></div>
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
            <div class="footer_background" style="background-image:url(images/footer.jpg)"></div>
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

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="styles/bootstrap4/popper.js"></script>
    <script src="styles/bootstrap4/bootstrap.min.js"></script>
    <script src="plugins/greensock/TweenMax.min.js"></script>
    <script src="plugins/greensock/TimelineMax.min.js"></script>
    <script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
    <script src="plugins/greensock/animation.gsap.min.js"></script>
    <script src="plugins/greensock/ScrollToPlugin.min.js"></script>
    <script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
    <script src="plugins/Isotope/isotope.pkgd.min.js"></script>
    <script src="plugins/easing/easing.js"></script>
    <script src="plugins/parallax-js-master/parallax.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>