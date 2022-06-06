<?php
	require '../../global.php';
	require '../../admin/dao/cart.php';
	require '../../admin/dao/order.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Checkout</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Sublime project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../styles/bootstrap4/bootstrap.min.css">
<link href="../plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../styles/checkout.css">
<link rel="stylesheet" type="text/css" href="../styles/checkout_responsive.css">
</head>
<body>
<?php
	if (isset($_POST['order_create'])) {
		$user = $_SESSION['user'];
		$date = date("Y-m-d");
		$id_product = $_POST['id_product'];
		$quantity = $_POST['quantity_product'];
		$fname = $_POST['first_name'];
		$lname = $_POST['last_name'];
		$address = $_POST['address'];
		$pnumber = $_POST['phone_number'];
		try {
			create_order($id_product, $quantity, $user['id_user'], $fname, $lname, $address,$pnumber, $date);
			deleteCart($user['id_user']);
		} catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
	}
?>
<div class="super_container">

	<!-- Header -->

	<?php require "../components/header.php"?>

	<!-- Menu -->

	<div class="menu menu_mm trans_300">
		<div class="menu_container menu_mm">
			<div class="page_menu_content">
							
				<div class="page_menu_search menu_mm">
					<form action="#">
						<input type="search" required="required" class="page_menu_search_input menu_mm" placeholder="Search for products...">
					</form>
				</div>
				<ul class="page_menu_nav menu_mm">
					<li class="page_menu_item has-children menu_mm">
						<a href="index.html">Home<i class="fa fa-angle-down"></i></a>
						<ul class="page_menu_selection menu_mm">
							<li class="page_menu_item menu_mm"><a href="categories.html">Categories<i class="fa fa-angle-down"></i></a></li>
							<li class="page_menu_item menu_mm"><a href="product.html">Product<i class="fa fa-angle-down"></i></a></li>
							<li class="page_menu_item menu_mm"><a href="cart.html">Cart<i class="fa fa-angle-down"></i></a></li>
							<li class="page_menu_item menu_mm"><a href="checkout.html">Checkout<i class="fa fa-angle-down"></i></a></li>
							<li class="page_menu_item menu_mm"><a href="contact.html">Contact<i class="fa fa-angle-down"></i></a></li>
						</ul>
					</li>
					<li class="page_menu_item has-children menu_mm">
						<a href="categories.html">Categories<i class="fa fa-angle-down"></i></a>
						<ul class="page_menu_selection menu_mm">
							<li class="page_menu_item menu_mm"><a href="categories.html">Category<i class="fa fa-angle-down"></i></a></li>
							<li class="page_menu_item menu_mm"><a href="categories.html">Category<i class="fa fa-angle-down"></i></a></li>
							<li class="page_menu_item menu_mm"><a href="categories.html">Category<i class="fa fa-angle-down"></i></a></li>
							<li class="page_menu_item menu_mm"><a href="categories.html">Category<i class="fa fa-angle-down"></i></a></li>
						</ul>
					</li>
					<li class="page_menu_item menu_mm"><a href="index.html">Accessories<i class="fa fa-angle-down"></i></a></li>
					<li class="page_menu_item menu_mm"><a href="#">Offers<i class="fa fa-angle-down"></i></a></li>
					<li class="page_menu_item menu_mm"><a href="contact.html">Contact<i class="fa fa-angle-down"></i></a></li>
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
										<li><a href="index.html">Home</a></li>
										<li><a href="cart.html">Shopping Cart</a></li>
										<li>Checkout</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Checkout -->
	
	<div class="checkout">
		<div class="container">
			<div class="row">
				<!-- Billing Info -->
				<div class="col-lg-6">
					<div class="billing checkout_section">
						<div class="section_title">Billing Address</div>
						<div class="section_subtitle">Enter your address info</div>
						<div class="checkout_form_container">
							<form action="checkout.php" method="post"id="checkout_form" class="checkout_form">
								<div class="row">
									<div class="col-xl-6">
										<!-- Name -->
										<label for="checkout_name">First Name*</label>
										<input type="text" id="checkout_name" name="first_name" class="checkout_input" required="required">
									</div>
									<div class="col-xl-6 last_name_col">
										<!-- Last Name -->
										<label for="checkout_last_name">Last Name*</label>
										<input type="text" id="checkout_last_name" name="last_name" class="checkout_input" required="required">
									</div>
								</div>
								<div>
									<!-- Address -->
									<label for="checkout_address">Address*</label>
									<input type="text" id="checkout_address" name="address" class="checkout_input" required="required">
								</div>
								<div>
									<!-- Phone no -->
									<label for="checkout_phone">Phone no*</label>
									<input type="text" id="checkout_phone" name="phone_number" class="checkout_input" required="required">
								</div>
						</div>
					</div>
				</div>

				<!-- Order Info -->

				<div class="col-lg-6">
					<div class="order checkout_section">
						<div class="section_title">Your order</div>
						<div class="section_subtitle">Order details</div>

						<!-- Order details -->
						<div class="order_list_container">
							<div class="order_list_bar d-flex flex-row align-items-center justify-content-start">
								<div class="order_list_title">Product</div>
								<div class="order_list_value ml-auto">Total</div>
							</div>
							<ul class="order_list">
									<?php
										$user = $_SESSION['user'];
										$items = fetchProductCart($user['id_user']);
										$total = 0;
										foreach ($items as $item) {
											$price = !empty($item['sale_product']) ? $item['sale_product'] : $item['price_product'];
											$itemTotal = $item['quantity_product'] * $price;
											$total += $itemTotal;
											echo "
											<li class='d-flex flex-row align-items-center justify-content-start'>
											<div class='order_list_title'>".$item['name_product']."</div>
											<div class='order_list_value ml-auto'>$".$item['price_product']." * ".$item['quantity_product']."</div>
											<input type='hidden' name='id_product' value='".$item['id_product']."'>
											<input type='hidden' name='quantity_product' value='".$item['quantity_product']."'>
											</li>
											";
										}
									?>
									
								
								<?php
									echo "
									<li class='d-flex flex-row align-items-center justify-content-start'>
									<div class='order_list_title'>Subtotal</div>
									<div class='order_list_value ml-auto'>".$total."</div>
								</li>
								<li class='d-flex flex-row align-items-center justify-content-start'>
									<div class='order_list_title'>Shipping</div>
									<div class='order_list_value ml-auto'>Free</div>
								</li>
								<li class='d-flex flex-row align-items-center justify-content-start'>
									<div class='order_list_title'>Total</div>
									<div class='order_list_value ml-auto'>$".$total."</div>
								</li>
									";
								?>
								
							</ul>
						</div>
						<!-- Order Text -->
						<button class="btn order_button" name="order_create" type="submit">Place Order</button>
						</form>

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
					<div class="footer_content d-flex flex-lg-row flex-column align-items-center justify-content-lg-start justify-content-center">
						<div class="footer_logo"><a href="#">Sublime.</a></div>
						<div class="copyright ml-auto mr-auto"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></div>
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
	.order_button {
	color: #000!important;
    display: flex;
    justify-content: center;
    align-items: center;
	width: 100%;
    height: 61px;
    background: none;
    text-align: center;
    border: solid 2px #1b1b1b;
    overflow: hidden;
    cursor: pointer;
}
.order_button:hover{
	color: #ffffff!important;
	background: #000;
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
<script src="../js/checkout.js"></script>
</body>
</html>