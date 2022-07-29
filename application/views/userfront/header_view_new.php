<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= isset($restaurantInfo["restaurant_name"]) ? $restaurantInfo["restaurant_name"] : 'Waive Inc' ?></title>
	<link rel="icon" href="<?= base_url() ?>/favicon.ico">
	<script src="https://kit.fontawesome.com/92a16d9d6c.js" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	<!--................. Start Jquery Ui Popup Effect ..............-->
	<link type="text/css" href="<?= base_url() ?>css/waiveinc.css" rel="stylesheet" />
	<link type="text/css" href="<?= base_url() ?>assets/css/jquery-ui.min.css" rel="stylesheet" />
	<!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> -->
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
	<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery-ui.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/frontfunctions.js"></script>

	<!--................. End Jquery Ui Popup Effect ..............-->
	<!--................. Start FireBud Here ..............-->
	<!-- <script type="text/javascript" src="https://getfirebug.com/firebug-lite.js"></script> -->
	<!--................. End FireBud Here ..............-->

	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

	<script language="javascript">
		jQuery.browser = {
				msie: false,
				version: 0
		};
		var base_url = "<?= base_url() ?>";
		var itemId;

		function openSign(nSignId) {
			signId = nSignId;
			$('#signin-message').modal('show');
			return false;
		}

		var base_url = "<?= base_url() ?>";
		var itemId;

		function forgotPass(nForgotId) {
			forgotId = nForgotId;
			//$('#forgot-message').dialog('open');
			return false;
		}

		var base_url = "<?= base_url() ?>";
		var itemId;

		function orderPickUp(nOrderId) {
			orderId = nOrderId;
			$('#order-message').dialog('open');
			return false;
		}

		function closeOrderPickup() {
			$('#order-message').dialog('close');
			return false;
		}
	</script>

	<style>
		* {}

		ui-state-hover {
			background: transparent !important;
			border-color: transparent !important;
		}

		.modal-title a {
			font-size: 12px !important;
			text-decoration: none !important;
		}

		.modal-body .qty-wrap,
		.modal-body .qty,
		.modal-body .item-name,
		.modal-body .item-price {
			font-size: 16px;
			font-weight: 500;
			font-stretch: normal;
			font-family: 'Roboto', sans-serif !important;
			font-style: normal;
			line-height: 1.56;
			letter-spacing: 0.14px;
			text-align: left;
			color: rgba(0, 0, 0, 0.87);
		}

		.cart-item {
			font-family: 'Roboto', sans-serif !important;
			padding: 15px 0px;
			border-bottom: 1px solid #c8c8c8;
			margin-bottom: 10px;
			position: relative;
		}

		span.cart-arrow {
			font-family: 'Roboto', sans-serif !important;
			position: absolute;
			right: 0px;
			top: 20%;
			/* background-color: #37b8ac; */
			min-width: 104px;
			border-radius: 50px;
			text-align: center;
			display: flex;
			align-items: center;
		}

		span.cart-arrow span.cart-num {
			font-size: 16px;
			background: white;
			font-family: 'Roboto', sans-serif !important;
			min-width: 40px;
			display: inline-flex;
			min-height: 29px;
			align-items: center;
			cursor: pointer;
			justify-content: center;
		}

		span.cart-arrow span:first-child,
		span.cart-arrow span:last-child {
			/* color: white; */
			font-size: 26px;
			font-family: 'Roboto', sans-serif !important;
			cursor: pointer;
			width: 30px;
			display: inline-flex;
			max-height: 29px;
			align-items: center;
			justify-content: center;
		}

		.cart-item .cart-itemName {
			font-size: 18px;
			font-weight: 800;
			font-stretch: normal;
			font-family: 'Roboto', sans-serif !important;
			font-style: normal;
			line-height: 1.16;
			letter-spacing: 0.14px;
			text-align: left;
			color: rgba(0, 0, 0, 0.87);
		}

		.cart-item .cart-itemName small {
			display: block;
			font-size: 14px;
			font-family: 'Roboto', sans-serif !important;
			font-weight: 500;
			font-stretch: normal;
			font-style: normal;
			line-height: 1;
			letter-spacing: 0.32px;
			text-align: left;
			/* color: rgba(0, 0, 0, 0.6) !important; */
		}

		.orderForm h3 {
			margin-bottom: 0px;
			font-family: 'Roboto', sans-serif !important;
			font-size: 18px;
			font-weight: 500;
			padding: 15px 0px;
			border-bottom: 1px solid #c8c8c8;
			font-stretch: normal;
			font-style: normal;
			line-height: 1.56;
			letter-spacing: 0.14px;
			text-align: left;
			position: relative;
			color: rgba(0, 0, 0, 0.87);
		}

		.modal-body p {
			margin-bottom: 0px;
			font-family: 'Roboto', sans-serif !important;
			font-size: 18px;
			font-weight: 500;
			padding: 15px 0px;
			border-bottom: 1px solid #c8c8c8;
			font-stretch: normal;
			font-style: normal;
			line-height: 1.56;
			letter-spacing: 0.14px;
			text-align: left;
			position: relative;
			color: rgba(0, 0, 0, 0.87);
		}

		.modal-body p strong {
			font-size: 18px;
			font-family: 'Roboto', sans-serif !important;
			float: right;
			font-weight: normal;
			font-stretch: normal;
			font-style: normal;
			line-height: 1.28;
			letter-spacing: 0.32px;
			text-align: left;
			/* color: rgba(0, 0, 0, 0.6); */
		}

		.modal-body p.checkout_btn {
			position: relative;
		}

		.modal-body p.checkout_btn i {
			position: absolute;
			left: 30% !important;
			top: 15px !important;
			right: unset !important;
		}

		.order_type {
			font-size: 18px;
			font-family: 'Roboto', sans-serif !important;
			font-weight: normal;
			font-stretch: normal;
			font-style: normal;
			line-height: 1.28;
			letter-spacing: 0.32px;
			text-align: left;
			color: rgba(0, 0, 0, 0.6);
		}

		.add-btn {
			border-radius: 19px !important;
			background-color: #37b8ac !important;
			width: 100% !important;
			margin: 0 auto;
			text-align: center !important;
			border-color: transparent !important;
			color: white !important;
			font-size: 16px !important;
			font-weight: 500 !important;
			font-stretch: normal !important;
			font-style: normal !important;
			line-height: 1.75 !important;
			letter-spacing: 0.12px !important;
		}

		.clear_cart{
			display: block;
		    text-decoration: none;
		    padding-bottom: 4px;
				padding-top: 3px;
		}
		.cross-icon-adj{
			font-size:12px;
		}
	</style>
	<?
	   $this->load->view("userfront/themeColor");
   ?>
	<!-- Start Dialog Popups -->
	<script type="text/javascript">
		

		$(function() {
			// Dialog	( Start Edit Variant Popup Window Here )

			// $('#forgot-message').dialog({
			// 	autoOpen: false,
			// 	modal: true,
			// 	width: 'auto',
			// 	fluid: true,
			// 	responsive: true,
			// 	maxWidth: 300,
			// });

		});

		$(function() {
			// Dialog	( Start Edit Variant Popup Window Here )
			// $('#order-message').dialog({
			// 	autoOpen: false,
			// 	modal: true,
			// 	width: 'auto',
			// 	fluid: true,
			// 	responsive: true,
			// 	maxWidth: 300,
			// });

		});
	</script>
	<script>
		function logout() {
			$.ajax({
				type: "POST",
				url: "<?= base_url() ?>irestaurant/logout",
				data: "",
				success: function(logout) {
					//alert(addFavoriteRestaurant);
					document.location.href = document.location.href;
				} //end function
			});

		}
	</script>
	<!-- End Dialog Popups -->
</head>

<body>
	<!-- Start Order PickUp Popup Window Here -->
	
	<!-- End Order PickUp Popup Window Here -->
	<!-- Start Main Body -->
	<div id="main-wrap">
		<!-- //////////////////////////////navbar/////////////////////////////// -->
		<div class="bg top-bar-bg-color" >
			<div class="main-container" style="position: relative;">
				<nav class="navbar navbar-expand-lg navbar-light top-bar-bg-color">
					<div class="collapse navbar-collapse show" id="navbarNavAltMarkup">
						<div class="navbar-nav">
							<a class="nav-item nav-link" href="<?= base_url('m/') ?><?= $this->session->userdata('restaurantName') ?>">
								<img src="<?= !empty($restaurantInfo["logo"]) ? base_url() . "uploads/restaurant/logo/" . $restaurantInfo["logo"] : base_url().'/images/new_logo.png' ?>" style="max-width: 50px; max-height: 50px;" alt="Logo" />
								<label class="top-bar-txt-color" style="font-weight:bold;display:inline-block;font-size:20px;padding-left:10px;"><?= isset( $restaurantInfo['restaurant_name']) ? $restaurantInfo['restaurant_name'] : ''; ?></label>
							</a>
							<span class="login-name">
								<?
                     if( $this->session->userdata('id')== "")
                     {
                     ?>
								<!--	Hi User: -->
								<?
                     }
                     else
                     {
                     ?>
								<!-- Hi <?= $this->session->userdata('firstname') ?>: -->
								<?
                     }
                     ?>
							</span>
							<?
                  if( $this->session->userdata('id')== "")
                  {
                  ?>

							<!-- <a href="<?= base_url() . "userorder/checkout" ?>">Checkout</a> -->
							<!-- <a href="<?= base_url() . "useraccount/createaccount" ?>">Create Account</a> -->
							<!-- <a href="javascript:void(null);" onclick="orderPickUp(0);">Order PickUp</a> -->
							<!-- <a href="javascript:void(null);" onclick="openSign(0);" class="active">Sign In</a> -->
							<?
                  }else{
                  ?>
							<!-- <a href="<?= base_url() . "useraccount/accountsetting" ?>">Your Account</a> -->
							<!-- <a href="<?= base_url() . "userfavorites/favoritemenu" ?>">Favorites</a> -->
							<!-- <a href="<?= base_url() . "userorder/orderhistory" ?>">Order History</a> -->
							<!-- <a href="<?= base_url() . "userorder/checkout" ?>">Checkout</a> -->
							<!-- <a href="javascript:void(null);" onclick="javascript:logout();" class="active">Logout</a> -->

							<?
                  }
                  ?>
						</div>
					</div>
				</nav>
				<?php if(isset($cartItems)){ ?>

				<i data-bs-toggle="modal" data-bs-target="#cart_modal" class="fas fa-shopping-cart topbar-cart top-bar-txt-color"></i>
				<?php
				if( !($this->session->userdata('id')== "" && $this->session->userdata('guest_email')==""))
        { 
				?>
				<a href="javascript:void(null);" onclick="javascript:logout();" src="<?php echo base_url('images/').'/logout1.png';  ?>">
          <i class="fas fa-sign-out-alt signout-icon-adj top-bar-txt-color"></i>
        </a>
				<?php 
				} ?>
				<!-- <img style="position: absolute;
    right: 10px;
    top: 20px;
    width: 35px;"  src="<?php echo base_url('images/').'/logout1.png';  ?>" alt=""> -->

				<? if(count($cartItems) > 0) {?>
					<span style="    position: absolute;top: 18px;right: 60px;width: 15px;height: 15px;background: red;border-radius: 50%;display: flex;align-items: center;justify-content: center;font-size: 12px;color: #fff;"><?= count($cartItems) ?></span>
				<? } }?>
			</div>
		</div>

		<!-- /////////////////////////////////////////////////////////////// -->
		<!-- Start Header -->
		<? /*
		<div id="hed-wrap">
			<div class="logo">
				<a href="<?= base_url() . "" ?>">
		<span style="display:none;">
			Waive<br /><span>Hungry!</span>
		</span>
		<img src="<?= base_url() ?>/images/new_logo.png" style="max-width: 340px; max-height: 85px;" alt="Logo" />
		</a>
	</div>
	<div class="login-wrap">
		<span class="login-name">

			<?
                  if( $this->session->userdata('id')== "")
                  {
                  ?>
			<!--	Hi User: -->
			<?
                  }
                  else
                  {
                  ?>
			Hi <?= $this->session->userdata('firstname') ?>:
			<?
                  }

                  ?>
		</span>
		<?
               if( $this->session->userdata('id')== "")
               {
               ?>
		<a href="<?= base_url() . "userorder/checkout" ?>">Checkout</a><span>|</span>
		<a href="<?= base_url() . "useraccount/createaccount" ?>">Create Account</a><span>|</span>
		<!-- <a href="javascript:void(null);" onclick="orderPickUp(0);">Order PickUp</a><span>|</span> -->
		<a href="javascript:void(null);" onclick="openSign(0);" class="active">Sign In</a>
		<?
               }else{
               ?>
		<a href="<?= base_url() . "useraccount/accountsetting" ?>">Your Account</a><span>|</span>
		<a href="<?= base_url() . "userfavorites/favoritemenu" ?>">Favorites</a><span>|</span>
		<a href="<?= base_url() . "userorder/orderhistory" ?>">Order History</a><span>|</span>
		<a href="<?= base_url() . "userorder/checkout" ?>">Checkout</a><span>|</span>
		<a href="javascript:void(null);" onclick="javascript:logout();" class="active">Logout</a>
		<?
               }
               ?>
	</div>
	</div>
	*/ ?>
	<!-- End Header -->
	<?
         if( $this->session->userdata('id')== "")
         {
         ?>
	<!-- Start Signin Popup Window Here -->
	<div class="modal fade" id="signin-message" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog ">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Proceed</h5>
				<button type="button" class="close_button" data-bs-dismiss="modal" aria-label="Close">
					<i class=" fa fa-lg fa-times category-text-color"></i>
				</button>
			</div>
			<div class="modal-body">
					<?
            $this->load->view("userfront/signin");
            ?>
			</div>
		</div>
	</div>
</div>
	<?
         }
         ?>
	<!-- End Signin Legend Popup Window Here -->
	<!-- Start Forgot Password Window Here -->
	<div id="forgot-message" title="Forgot Password" style="display:none;">
		<?
            $this->load->view("userfront/forgotpass");
            ?>
	</div>

	<div class="modal fade" id="cart_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content main-menu-bg-color" style="border-radius: 20px;">
				<div class="modal-header">
					<h5 class="modal-title category-text-color" id="exampleModalLabel ">Your Cart</h5>
					<button type="button" class="close_button" data-bs-dismiss="modal" aria-label="Close">
						<i class=" fa fa-lg fa-times category-text-color"></i>
					</button>
				</div>
				<div class="modal-body">
					<div id="cart_message_section" class="alert alert-warning" style='display: none'>
						<p id="cart_message_text" class="mb-0 p-0" style='border-bottom:0'>
								this is my test message 							
						</p>
					</div>
					<!-- <div class="qty-wrap">
						<span class="qty">QTY</span>
						<span class="item-name">Item Name</span>
						<span class="item-price">(₦)</span>
					</div> -->
					<?
						if (isset($cartItems) && count($cartItems) > 0)
						{
							$grandTotal	=	0;
							$totalCityTax = 0;
							$totalStateTax = 0;
							foreach ($cartItems as $cartItem)
							{
					?>
					<div class="cart-item">
						<? $english_format_number = number_format($cartItem["totalprice"], 2, '.', '');?>
						<span class="cart-itemName font11 menu-heading" id="set2">
							<?= substr($cartItem["item_name"], 0, 13) ?>
							<span class="cart-itemDel">
								<a  href="javascript:void(null);" onclick="deleteItem(<?= $cartItem["id"] ?>);" title="Delete Item"><i class="fas fa-times menu-heading cross-icon-adj"></i></a>
							</span>
							<small class="menu-heading">₦<span id="<?= $cartItem["id"] ?>_total_price"><?= $english_format_number ?></span>
							</small>
						</span>
						<span class="cart-arrow">
							<!-- <a href="javascript:void(null);" onclick="increaseQuantity(<?= $cartItem["id"] ?>);" title="Increase Quantity" style="line-height:3px;">
								<img src="<?= base_url() ?>images/front/add-cart.png" alt="Add Product" />
							</a> -->
							<span class="primary-btn-bg-color primary-btn-text-color" href="javascript:void(null);" onclick="decreaseQuantity(<?= $cartItem["id"] ?>);">-</span>
							<span  id="<?= $cartItem["id"] ?>_dec_inc" class="cart-num font11 text-input-color"><?= $cartItem["quantity"] ?></span>
							<span class="primary-btn-bg-color primary-btn-text-color " href="javascript:void(null);" onclick="increaseQuantity(<?= $cartItem["id"] ?>);">+</span>
							<!-- <a href="javascript:void(null);" onclick="decreaseQuantity(<?= $cartItem["id"] ?>);" title="Decrease Quantity" style="line-height:10px;">
								<img src="<?= base_url() ?>images/front/remov-cart.png" alt="Remove Product" />
							</a> -->
						</span>
					</div>
					<?
								
								$totalCityTax = $totalCityTax + $cartItem["city_tax"];
								$totalStateTax = $totalStateTax + $cartItem["state_tax"];
								$grandTotal	=	$grandTotal+$cartItem["totalpricewithtax"];
							}
						?>

					<? $english_format_number = number_format($totalCityTax, 2, '.', '');?>
					<p class="menu-heading">Total City Tax: <strong>₦<span id="dis_city_tax"><?= $english_format_number ?></span></strong></p>

					<? $english_format_number = number_format($totalStateTax, 2, '.', '');?>
					<p class="menu-heading">Total State Tax: <strong>₦<span id="dis_state_tax"><?= $english_format_number ?></span></strong></p>

					<? $english_format_number = number_format($grandTotal, 2, '.', '');?>
					<p class="menu-heading">Total: <strong>₦<span id="dis_Total"><?= $english_format_number ?></span></strong></p>
					<?
                        }//end if (count($cartItems) > 0)
						else
						{
						?>

					<div class="ui-widget" style="margin-top:10px;">
						<div class="ui-state-error ui-corner-all" style="padding:10px;">
							Cart Is Empty
						</div>
					</div>
					<?
						}
                        ?>
					<form action="<?= base_url('m'); ?>/<?= urlencode($restaurantInfo["restaurant_name"]) ?>" method="post">

						<div class="orderForm">
							

							<? if (isset($errors) && count($errors))
						{
						?>
							<div class="ui-widget" style="margin-top:10px;">
								<div class="ui-state-error ui-corner-all" style="padding:10px;">
									<?
								   foreach($errors as $error)
								   		echo $error;
								   ?>
								</div>
							</div>

							<?
                        }?>
							
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td style="padding-top:25px;">
										<button type="submit" class="add-btn primary-btn-bg-color primary-btn-text-color" name="Checkout" value="Checkout">
											<i class="fas fa-shopping-cart primary-btn-text-color" style="margin-right:10px;" aria-hidden="true"></i> Checkout
										</button>
										<p>
											<a type="submit" class="add-btn clear_cart secondary-btn-color" name="clear_cart" style="background: #f36737 !important;" value="Checkout" onclick="resetShoppingCart();">
												<i class="fas fa-recycle secondary-btn-color" style="margin-right:10px;" aria-hidden="true"></i> Clear Cart
											</a>
										</p>
									</td>
								</tr>
							</table>
						</div>
					</form>
				</div>
				<!-- End Left Cart Section -->
				<!-- Start Menu Popup -->
				<div id="dialog-message" title="Item Details">
					<iframe width="100%" height="640" style="padding-top:10px;" allowtransparency="true" frameborder="0" id="itemIframe" name="itemIframe">
					</iframe>
				</div>

			</div>
		</div>
	</div>
	<!-- End Forgot Password Window Here -->
	<!-- Start Mid Section -->
	<div id="mid-wrap">
