<?php
	require '../../global.php';
	require '../../admin/dao/cart.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cart</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sublime project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../styles/bootstrap4/bootstrap.min.css">
    <link href="../plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="../styles/cart.css">
    <link rel="stylesheet" type="text/css" href="../styles/cart_responsive.css">
</head>

<body>
    <?php
        if (isset($_POST['quantity_control'])){
            $id = $_POST['id_cart'];
            $quantity = $_POST['quantity_product'];
            try {
                updateCart($id, $quantity);
                $_SESSION['success'] = 'Update quantity successfully';
            } catch (PDOException $e){
                $_SESSION['error'] = $e->getMessage();
            }
        }
        if (isset($_POST['clear_cart'])) {
            $id_user = $_POST['userid'];
            try {
                deleteCart($id_user);
                $_SESSION['success'] = 'Clear cart successfully';
            } catch (PDOException $e) {
                $_SESSION['error'] = $e->getMessage();
            }
        }
        
    ?>
    <div class="super_container">

        <!-- Header -->

        <?php
		include '../components/header.php'
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
                            <a href="../index.php">Home<i class="fa fa-angle-down"></i></a>
                            <ul class="page_menu_selection menu_mm">
                                <li class="page_menu_item menu_mm"><a href="./categories.php">Categories<i
                                            class="fa fa-angle-down"></i></a></li>
                                <li class="page_menu_item menu_mm"><a href="./product.php">Product<i
                                            class="fa fa-angle-down"></i></a></li>
                                <li class="page_menu_item menu_mm"><a href="./cart.php">Cart<i
                                            class="fa fa-angle-down"></i></a></li>
                                <li class="page_menu_item menu_mm"><a href="./checkout.php">Checkout<i
                                            class="fa fa-angle-down"></i></a></li>
                                <li class="page_menu_item menu_mm"><a href="./contact.php">Contact<i
                                            class="fa fa-angle-down"></i></a></li>
                            </ul>
                        </li>
                        <li class="page_menu_item has-children menu_mm">
                            <a href="">Categories<i class="fa fa-angle-down"></i></a>
                            <ul class="page_menu_selection menu_mm">
                                <li class="page_menu_item menu_mm"><a href="./categories.php">Category<i
                                            class="fa fa-angle-down"></i></a></li>
                                <li class="page_menu_item menu_mm"><a href="./categories.php">Category<i
                                            class="fa fa-angle-down"></i></a></li>
                                <li class="page_menu_item menu_mm"><a href="./categories.php">Category<i
                                            class="fa fa-angle-down"></i></a></li>
                                <li class="page_menu_item menu_mm"><a href="./categories.php">Category<i
                                            class="fa fa-angle-down"></i></a></li>
                            </ul>
                        </li>
                        <li class="page_menu_item menu_mm"><a href="../index.php">Accessories<i
                                    class="fa fa-angle-down"></i></a></li>
                        <li class="page_menu_item menu_mm"><a href="#">Offers<i class="fa fa-angle-down"></i></a></li>
                        <li class="page_menu_item menu_mm"><a href="./contact.php">Contact<i
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

        <!-- Home -->

        <div class="home">
            <div class="home_container">
                <div class="home_background" style="background-image:url(../images/cart.jpg)"></div>
                <div class="home_content_container">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="home_content">
                                    <div class="breadcrumbs">
                                        <ul>
                                            <li><a href="../index.php">Home</a></li>
                                            <li><a href="./categories.php">Categories</a></li>
                                            <li>Shopping Cart</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cart Info -->

        <div class="cart_info">
            <div class="container">
                <div class="row">
                    <p class="card-title-res"></p>
                    <div class="col">
                        <!-- Column Titles -->
                        <div class="cart_info_columns clearfix">
                            <div class="cart_info_col cart_info_col_product">Product</div>
                            <div class="cart_info_col cart_info_col_price">Price</div>
                            <div class="cart_info_col cart_info_col_quantity">Quantity</div>
                            <div class="cart_info_col cart_info_col_total">Total</div>
                        </div>
                    </div>
                </div>
                <div class="row cart_items_row">
                    <div class="col">
                        <?php
					$user = $_SESSION['user'];
					$items = fetchProductCart($user['id_user']);
					$total = 0;
                    if (count($items) > 0) {
                        foreach ($items as $item){
						$image = (!empty($item['image_product'])) ? '../images/products/'.$item['image_product'] : '../images/products/noimage.jpg';
						$price = !empty($item['sale_product']) ? $item['sale_product'] : $item['price_product'];
						$itemTotal = $item['quantity_product'] * $price;
						$total += $itemTotal;
						echo "
						<div class='cart_item d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start'>
						<div class='cart_item_product d-flex flex-row align-items-center justify-content-start'>
							<div class='cart_item_image'>
								<div><img src='".$image."' alt=''></div>
							</div>
							<div class='cart_item_name_container'>
								<div class='cart_item_name'><a href='#'>".$item['name_product']."</a></div>
								<div class='cart_item_edit'><a href='#'>".$item['name_category']."</a></div>
							</div>
						</div>
						<div class='cart_item_price'>$".$price."</div>
						<div class='cart_item_quantity'>
							<div class='product_quantity_container'>
                            <form method='post' action='cart.php'>
								<div class='product_quantity clearfix'>
									<span>Qty</span>
									<input id='quantity_input' type='text'  value='".$item['quantity_product']."' name='quantity_product' placeholder='Quantity'>
                                    <input type='hidden' name='id_cart' value='".$item['id']."' placeholder='Id'>
									<div class='quantity_buttons'>
										<button type='submit' name='quantity_control' id='quantity_inc_button' title='Increment Quantity' class='quantity_inc quantity_control' ><i class='fa fa-chevron-up' aria-hidden='true'></i></button>
										<button type='submit' name='quantity_control' id='quantity_dec_button' title='Decrease Quantity' class='quantity_dec quantity_control' ><i class='fa fa-chevron-down' aria-hidden='true'></i></button>
									</div>
								</div>
                            </form>
							</div>
						</div>
						<div class='cart_item_total'>$".$itemTotal."</div>
					</div>
						";
					}
                    } else {
                        echo "
                        <tr>
					        <td colspan='6' align='center'>Shopping cart empty</td>
				        <tr>
                        ";
                    }
					
				?>
                    </div>
                </div>
                <div class="row row_cart_buttons">
                    <div class="col">
                        <div
                            class="cart_buttons d-flex flex-lg-row flex-column align-items-start justify-content-start">
                            <div class="button continue_shopping_button"><a href="#">Continue shopping</a></div>
                            <div class="cart_buttons_right ml-lg-auto">
                                <form action="cart.php" method="post">
                                    <input type="hidden" value="<?=$user['id_user']?>" name="userid" value="<?=$user['id_user']?>">
                                <button type="submit" name="clear_cart" class="btn clear_cart_button">
                                    Clear cart
                                </button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row_extra">
                    <div class="col-lg-12 ">
                        <div class="cart_total">
                            <div class="section_title">Cart total</div>
                            <div class="section_subtitle">Final info</div>
                            <div class="cart_total_container">
                                <ul>
                                    <?php
									echo "
									<li class='d-flex flex-row align-items-center justify-content-start'>
										<div class='cart_total_title'>Subtotal</div>
										<div class='cart_total_value ml-auto'>$".$total."</div>
									</li>
									<li class='d-flex flex-row align-items-center justify-content-start'>
										<div class='cart_total_title'>Shipping</div>
										<div class='cart_total_value ml-auto'>Free</div>
									</li>
									<li class='d-flex flex-row align-items-center justify-content-start'>
										<div class='cart_total_title'>Total</div>
										<div class='cart_total_value ml-auto'>$".$total."</div>
									</li>
									"
								?>

                                </ul>
                            </div>
                            <div class="button checkout_button"><a href="<?=$CLIENT_URL?>/pages/checkout.php">Proceed to checkout</a></div>
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
                                    aria-hidden="true"></i> by Duc
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
    .quantity_control {
        border: none;
        background: none;
    }

    .quantity_control:active {
        border: none;
    }

    .clear_cart_button {
        width: 178px;
        height: 61px;
        background: none;
        text-align: center;
        border: solid 2px #1b1b1b;
        overflow: hidden;
        cursor: pointer;
        display: block;
        position: relative;
        font-size: 16px;
        font-weight: 600;
        line-height: 40px;
        color: #1b1b1b;
        z-index: 1;
        -webkit-transition: all 200ms ease;
        -moz-transition: all 200ms ease;
        -ms-transition: all 200ms ease;
        -o-transition: all 200ms ease;
        transition: all 200ms ease;
    }
    .clear_cart_button:hover{
        background: #000;
        color: #fff
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
    <script src="../plugins/easing/easing.js"></script>
    <script src="../plugins/parallax-js-master/parallax.min.js"></script>
    <script src="../js/cart.js"></script>

</body>

</html>