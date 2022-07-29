<div class="modal fade" id="cart_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" style="border-radius: 20px;">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Your Cart</h5>
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
									<span class="cart-itemName font11" id="set2">
										<?= substr($cartItem["item_name"], 0, 13) ?>
										<span class="cart-itemDel">
											<a href="javascript:void(null);" onclick="deleteItem(<?= $cartItem["id"] ?>);" title="Delete Item"><img src="<?= base_url() ?>images/front/del.png" alt="del" border="0" /></a>
										</span>
										<small>₦<span id="<?= $cartItem["id"] ?>_total_price"><?= $english_format_number ?></span></small>
									</span>
									<span class="cart-arrow">
										<span href="javascript:void(null);" onclick="decreaseQuantity(<?= $cartItem["id"] ?>);">-</span>
										<span  id="<?= $cartItem["id"] ?>_dec_inc" class="cart-num font11"><?= $cartItem["quantity"] ?></span>
										<span href="javascript:void(null);" onclick="increaseQuantity(<?= $cartItem["id"] ?>);">+</span>
									</span>
								</div>
					<?
								
								$totalCityTax = $totalCityTax + $cartItem["city_tax"];
								$totalStateTax = $totalStateTax + $cartItem["state_tax"];
								$grandTotal	=	$grandTotal+$cartItem["totalpricewithtax"];
							}
					?>

					<? $english_format_number = number_format($totalCityTax, 2, '.', '');?>
					<p>Total City Tax: <strong>₦<span id="dis_city_tax"><?= $english_format_number ?></span></strong></p>

					<? $english_format_number = number_format($totalStateTax, 2, '.', '');?>
					<p>Total State Tax: <strong>₦<span id="dis_state_tax"><?= $english_format_number ?></span></strong></p>

					<? $english_format_number = number_format($grandTotal, 2, '.', '');?>
					<p>Total: <strong>₦<span id="dis_Total"><?= $english_format_number ?></span></strong></p>
				</div>
			</div>
		</div>
	</div>
</div>	
