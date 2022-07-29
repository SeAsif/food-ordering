<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link href="<?= base_url() ?>css/frontstyle.css" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
	<script type="text/javascript" src="<?= base_url() ?>js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/jquery-ui-1.8.6.custom.min.js"></script>

	<script>
		var base_url = "<?= base_url() ?>";
	</script>
	<script type="text/javascript" src="<?= base_url() ?>js/frontfunctions.js"></script>
	<style type="text/css">
		body {
			background: 0px none !important;
		}

		.main-form,
		.form-order-details {
			width: 100%;
		}

		.main-form *,
		.form-order-details td {
			font-size: 16px;
			font-weight: 800;
			font-stretch: normal;
			font-family: 'Roboto', sans-serif !important;
			font-style: normal;
			line-height: 1.16;
			letter-spacing: 0.14px;
			text-align: left;
			color: rgba(0, 0, 0, 0.6);
		}

		.add-btn {
			border: solid 1px #37b8ac !important;
			color: #fff !important;
			background-color: #37b8ac !important;
		}

		@media only screen and (min-width:575px) {
			.on_mobile tr td:first-child {
				width: 50%;
			}
		}
		.account-hed {
				width: 100% !important;
			}
		@media only screen and (max-width:575px) {
			

			.modified_on_mobile tr td {
				font-weight: normal !important;
				font-size: 14px !important;
			}

			.modified_on_mobile tr td:first-child {
				width: 10% !important;
			}

			.modified_on_mobile tr td:last-child {
				width: 10% !important;
			}

			table tr td,
			table tr td strong,
			table tr td strong span {
				font-weight: normal !important;
				font-size: 14px !important;
			}

			.on_mobile tr td:first-child {
				width: 30%;
			}

			.on_mobile tr td table tr td {
				width: 50% !important;
			}

			.on_mobile tr td table tr td:last-child {
				text-align: right !important;
			}
		}
	</style>
		<!-- theme color style goes here -->
		<?
	   $this->load->view("userfront/themeColor");
   ?>
	 <!-- end of theme color style goes here -->
<body>
	<!-- Start Restaurant Account Settings Head -->
	<div class="account-hed" style="padding-left:0px;">
		<?
            if ($order["is_favorite"]	==	"Yes")
			{
			?>
		<a href="javascript:void(null);" onClick="alert ('Remove from favorite flow.');" class="remove" style="padding:6px 20px 6px 20px; margin-top:6px;">Remove From Fav</a>

		<?
				$arrSearchCriteria	=	$this->session->userdata('search_criteria');
				if($arrSearchCriteria['pickup_time_hour']=="")
				{
			?>

		<a href="javascript:void(null);" onClick="parent.document.getElementById('flagPickup').value=<?= $order["id"] ?>;parent.orderPickUp(0);" class="add-btn" style="padding:6px 20px 6px 20px; margin-top:6px;">Re Order</a>

		<?
				}else{
				?>
		<a href="javascript:void(null);" onClick="reOrder(<?= $order["id"] ?>);" class="add-btn" style="padding:6px 20px 6px 20px; margin-top:6px;">Re Order</a>
		<?
				}
            }
			?>
	</div>
	<!-- End Restaurant Account Settings Head -->
	<br class="clear" />
	<div class="main-form">
		<div class="form-order-details">
			<table width="100%" border="0" class="modified_on_mobile" cellspacing="0" cellpadding="0" style="margin-bottom:20px;">
				<tr style="margin-bottom:10px;">
					<td>Restaurant:</td>
					<td><strong style="margin-right:3px; float:left;">
							<?= $order["restaurant_name"] ?></strong><?= !empty($order["restaurant_addresss"]) ? "(".$order["restaurant_addresss"].")" : '' ?>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>Order Number:</td>
					<td><strong><?= $order["order_code"] ?></strong></td>
				</tr>
				<tr>
					<td>Order Date:</td>
					<td><strong><?= date("d M Y", strtotime($order["stamp"])) ?></strong></td>
				</tr>
				<tr>
					<td>Order Type:</td>
					<td><strong><?= $order["order_type"] ?></strong></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr style="margin-bottom:10px;">
					<td style="padding-top:7px;">Purchased: </td>
				</tr>

			</table>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="blueTxt">
				<?
						 $totalItems = 0;
						 $totalTax = 0;
						 $totalPrice = 0;
						 $total = 0;
                         foreach ($orderitems as $orderitem)
						 {
						 ?>
				<tr>
					<td style="padding-right:50px">
						<strong><?= $orderitem["item_name"] ?></strong>
						<?
                                    foreach ($orderitem["variant_list"] as $variantitem)
									{
									?>
						<span class="font11" style="padding-left:10px;">
							<?= $variantitem["variant_name"] ?> (<span style="font-family: DejaVu Sans;">&#x20A6;</span><?= $variantitem["price"] ?>)
						</span>
						<?
                                    }
									?>
					</td>
					<td style="padding-right:50px">QTY: <?= $orderitem["quantity"] ?></td>
					<td><span style="font-family: DejaVu Sans;">&#x20A6;</span><?= $orderitem["totalprice"] ?></td>
				</tr>
				<?	
						 	$totalItems++;	
							$totalTax = $totalTax + $orderitem["city_tax"] + $orderitem["state_tax"];
							$totalPrice = $totalPrice + $orderitem["totalpricewithtax"];
							$total = $total + $orderitem["totalprice"];
                         }//end foreach ($orderitems as $orderitem)
						 
						 ?>

			</table>
		</div>
	</div>
	<div class="main-form" style="margin-bottom:20px;">
		<div class="form-order-details">
			<table width="100%" border="0" class="on_mobile" cellspacing="0" cellpadding="0">
				<tr>
					<td>
						&nbsp;
					</td>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:20px;">
							<tr>
								<td style="width:40%;"><strong>Order:</strong></td>
								<td></td>
							</tr>
							<tr>
								<td>Item:</td>
								<td><strong><?= $totalItems ?></strong></td>
							</tr>
							<tr>
								<td>Tax:</td>
								<? $english_format_number = number_format($totalTax, 2, '.', '');?>
								<td><strong><span style="font-family: DejaVu Sans;">&#x20A6;</span><?= $english_format_number ?></strong></td>
							</tr>
							<tr>
								<td>Sub Total :</td>
								<? $english_format_number = number_format($total, 2, '.', '');?>
								<td><strong><span style="font-family: DejaVu Sans;">&#x20A6;</span><?= $english_format_number ?></strong></td>
							</tr>
							<?php if(!empty($order["delivery_charge"])){ ?>
							<tr>
								<td>Delivery Fee :</td>
								<? $english_format_number = number_format($order["delivery_charge"], 2, '.', '');?>
								<td><strong><span style="font-family: DejaVu Sans;">&#x20A6;</span><?= $english_format_number ?></strong></td>
							</tr>
							<?php } ?>
							<tr>
								<td>Total:</td>
								<? $english_format_number = number_format($order["totalprice"], 2, '.', '');?>
								<td><strong><span style="font-family: DejaVu Sans;">&#x20A6;</span><?= $english_format_number ?></strong></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<?php if (empty($pdf)) { ?>
		<a href="javascript:window.print()" class="primary-btn-bg-color primary-btn-text-color" style="padding:6px 20px 6px 20px; margin-right:30px;">Print</a>
	<?php } ?>
</body>

</html>
