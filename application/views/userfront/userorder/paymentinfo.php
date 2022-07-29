<?
   // $this->load->view("userfront/header_view");
   $this->load->view("userfront/header_view_new");
   ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/frontfunctions.js"></script>
<script>
	//
	$(document).on('click', '#perform_submit_action', function() {
		var payment_mode = $('input[name="payment_method"]:checked').val();

		if (payment_mode == 'cash_on_delivery') {
			$("#form_place_order").submit();
		} else if (payment_mode == 'pay_online') {
			var new_location = '<?php echo base_url('payment/initialize') . '/' . $order; ?>';
			$(location).attr('href', new_location)
		}
	});
	//
	jQuery.noConflict();
	//
	var url = '<?= base_url() ?>userrestaurant/itemdetail/';

	function openItem(nItemId) {
		itemId = nItemId;
		var pageFrame = document.getElementById('itemIframe');

		pageFrame.src = url + nItemId;		
		jQuery('#exampleModal').modal('show');
		// $('#dialog-message').dialog('open');
		return false;
	}
	$(function() {
		// Dialog	( Start Edit Variant Popup Window Here )
		$('#dialog-message').dialog({
			autoOpen: false,
			modal: true,
			width: 560
		});

	});

	function profileCheck(userid) {
		//	alert(selectedOption);
		showProfile(userid);
		//	$.ajax({ type: "POST", url: "<?= base_url() ?>userorder/getProfile", data:{id : userid}, success: function(response)
		//	{
		//	alert(response);
		//	}

		//	});
	}

	function startTransaction(userid) {

		paymentProfile = $('#profile_id').val();
		amount = $('#chargetotal').val();
		//	alert(amount);
		//	exit();
		//	alert(paymentProfile);
		$.ajax({
			type: "POST",
			url: "<?= base_url() ?>irestaurant/createCustomerProfileTransaction",
			data: {
				id: userid,
				totalAmount: amount,
				paymentProfileId: paymentProfile
			},
			success: function(response) {
				var obj = eval("(" + response + ")");
				alert(obj.text);
			}

		});
	}

	function startTransactionAim() {
		amount = $('#chargetotal').val();
		cardnumber = $('#cardnumber').val();
		expyear = $('#cardexpyear').val();
		expmonth = $('#cardexpmonth').val();
		userid = $('#user_id').val();
		if ($('#addToProfile').attr('checked')) {
			$.ajax({
				type: "POST",
				url: "<?= base_url() ?>irestaurant/createCustomerProfile/" + userid,
				data: {
					cardnumber: cardnumber,
					expyear: expyear,
					expmonth: expmonth
				},
				success: function(response) {
					var obj = eval("(" + response + ")");
					if (obj.validation == "YES")
						alert('Added to profile Successfully.');
					else
						alert(obj.text);

					if (obj.validation == "YES") {
						$.ajax({
							type: "POST",
							url: "<?= base_url() ?>irestaurant/createCustomerProfileTransaction",
							data: {
								totalAmount: amount,
								paymentProfileId: obj.paymentProfile,
								userid: userid
							},
							success: function(response) {
								var obj = eval("(" + response + ")");
								alert(obj.text);
							}

						});
					} // end if(obj.validation == "YES")
				}

			});
		} // end if($('#addToProfile').attr('checked'))
		else {
			$.ajax({
				type: "POST",
				url: "<?= base_url() ?>irestaurant/createCustomerProfileTransactionAim",
				data: {
					totalAmount: amount,
					cardnumber: cardnumber,
					expyear: expyear,
					expmonth: expmonth
				},
				success: function(response) {
					alert(response);
				}

			});
		} // end else
	}

	function addProfile(userId) {
		cardnumber = $('#cardnumber').val();
		expyear = $('#cardexpyear').val();
		expmonth = $('#cardexpmonth').val();
		//	alert(userId);
		$.ajax({
			type: "POST",
			url: "<?= base_url() ?>irestaurant/createCustomerProfile/" + userId,
			data: {
				cardnumber: cardnumber,
				expyear: expyear,
				expmonth: expmonth
			},
			success: function(response) {
				alert(response);
			}

		});
	}

	function deleteProfile(userId) {
		paymentProfile = $('#paymentProfileId').val();
		$.ajax({
			type: "POST",
			url: "<?= base_url() ?>irestaurant/deleteCustomerPaymentProfile/" + userId,
			data: {
				paymentProfile: paymentProfile
			},
			success: function(response) {
				var obj = eval("(" + response + ")");
				if (obj.resultCode == "Ok") {
					alert(obj.text);
					document.location.href = document.location.href;
				}
			}

		});
	}
</script>

<style>
	

	h1 {
		font-size: 25px;
		font-weight: 800;
		font-stretch: normal;
		font-family: 'Roboto', sans-serif !important;
		font-style: normal;
		line-height: 1.16;
		letter-spacing: 0.14px;
		text-align: left;
		color: rgba(0, 0, 0, 0.87);
	}

	.close {
		background: transparent !important;
		border-color: transparent !important;
	}

	h2 {
		font-size: 20px;
		font-weight: 800;
		font-stretch: normal;
		font-family: 'Roboto', sans-serif !important;
		font-style: normal;
		line-height: 1.16;
		letter-spacing: 0.14px;
		text-align: left;
		color: rgba(0, 0, 0, 0.77);
	}

	.paymment p {
		font-size: 16px;
		font-weight: 500;
		width: 90%;
		font-stretch: normal;
		font-family: 'Roboto', sans-serif !important;
		font-style: normal;
		line-height: 1.16;
		letter-spacing: 0.14px;
		text-align: left;
		color: rgba(0, 0, 0, 0.6);
	}

	h3 {
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

	.grid_row {
		display: grid;
		grid-template-columns: repeat(2, 1fr);
		margin-bottom: 20px;
	}

	.grid_row a,
	.grid_row table td {
		padding: 0px 10px;
		font-family: 'Roboto', sans-serif !important;
		font-size: 18px !important;
		font-weight: 500 !important;
		font-stretch: normal !important;
		font-style: normal !important;
		line-height: 1.56 !important;
		letter-spacing: 0.14px !important;
		text-align: left !important;
		color: rgba(0, 0, 0, 0.87) !important;
	}

	.paymment {
		width: 100%;
		text-align: center;
		margin-top: 20px;
	}

	.paymment a , .paymment button {
		padding: 10px 30px;
		font-family: 'Roboto', sans-serif !important;
		font-size: 18px !important;
		font-weight: 500 !important;
		font-stretch: normal !important;
		font-style: normal !important;
		line-height: 1.56 !important;
		letter-spacing: 0.14px !important;
		width: 25% !important;
		display: block;
	}

	.bordered_row {
		display: grid;
		grid-template-columns: repeat(2, 1fr);
		padding: 20px;
		border-bottom: 1px solid rgba(0, 0, 0, 0.15);
	}

	.grid_row a
	{
		width: 100% !important;
	}

	.bordered_row div:last-child {
		text-align: right !important;
	}

	.bordered_row div {
		font-family: 'Roboto', sans-serif !important;
		font-size: 18px !important;
		font-weight: 500 !important;
		font-stretch: normal !important;
		font-style: normal !important;
		line-height: 1.56 !important;
		letter-spacing: 0.14px !important;
		text-align: left !important;
		color: rgba(0, 0, 0, 0.87) !important;
	}

	@media only screen and (max-width:767px) {

		.card,
		.paymment a , .paymment button {
			width: 100% !important;
		}
	}

	#signin-message .add-btn {
		padding: 10px;
		margin: 10px 0;
	}
</style>
<?php if ($this->session->flashdata('paystack')) { ?>
	<br />
	<div class="ui-widget">
		<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
			<?php echo $this->session->flashdata('paystack'); ?>
		</div>
	</div>
<?php } ?>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" style="font-weight: bold;" id="exampleModalLabel">Item Detail</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<iframe allowtransparency="true" frameborder="0" width="526" height="590" style="background:0px none; padding-top:10px;" id="itemIframe" name="itemIframe">
				</iframe>
			</div>
		</div>
	</div>
</div>
<!-- Start Menu Popup -->
<div class="main-container">
	<?
         if(isset($errors))  	
         {
           if (isset($errors) && count($errors) > 0)
           {
           ?>
	<div class="alert alert-success">
		<div class="ui-widget">
			<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
				<?
               foreach ($errors as $error)
               {
               echo $error;
               }
               ?>
			</div>
		</div>
	</div>
	<?
         }
         } 
         ?>
	<div class="cont-wrap ">
		<div class="card">
			<div class="card-header">
				<h1>
					Payment Information
				</h1>
			</div>
			<div class="card-body">
				<div class="rest-mid">
					<div class="paymment">
						<h2>Total Amount</h2>
						<span>
							<!--$<? //$orderDetail["totalprice"]?>-->
							<?
               if (count($cartItems) > 0)
               {
               ?>
							<!-- Start Content Section -->
							<div class="account" >
								<?
                  $grandTotal	=	0;
                  
                                 foreach ($cartItems as $cartItem)
                  {
                  ?>
								<div class="Italiano-Piza" >
									<h3><?= $cartItem["item_name"] ?></h3>
									<p><?= $cartItem["item_description"] ?></p>
									<div class="grid_row">


										<a href="javascript:void(null);" onclick="openItem(<?= $cartItem["id"] ?>);">View Details</a>
										<div class="qty-price w-100">
											<table border="0" cellspacing="0" cellpadding="0" class="w-100">
												<tr>
													<td>Qty: <strong style="color:#5B5B5B;"><?= $cartItem["quantity"] ?></strong></td>
													<td style="padding:2px 10px 0px 10px; vertical-align:top;">
														<img src="<?= base_url() ?>images/front/Review-sprtr.gif" alt="sprtr" />
													</td>
													<? $english_format_number = number_format($cartItem["totalprice"], 2, '.', '');?>
													<td>Price: <strong style="color:#5B5B5B;">₦<?= $english_format_number ?></strong></td>
												</tr>
											</table>
										</div>
									</div>
								</div>
								<?
                  $grandTotal	=	$grandTotal+$cartItem["totalprice"];
                                }//end foreach ($cartItems as $cartItem)
                  ?>
								<div class="taxTotal">									
									<div class="bordered_row">
										<div>
										Total City Tax:
										</div>
										<div>
										₦<?= $english_format_number ?>
										</div>
									</div>
									<? $english_format_number = number_format($orderDetail["state_tax"], 2, '.', '');?>
									<div class="bordered_row">
										<div>
										Total State Tax:
										</div>
										<div>
										₦<?= $english_format_number ?>
										</div>
									</div>
									<? $english_format_number = number_format($grandTotal, 2, '.', '');?>
									<div class="bordered_row">
										<div>
											Total:
										</div>
										<div>
										₦<?= $orderDetail["totalprice"] ?>
										</div>
									</div>
								</div>
								<!-- <table border="0" cellspacing="0" cellpadding="0" style="min-width:143px; margin-bottom:10px;" align="right">
									<tr>
										
										<td><span style="padding-right:10px;"> ₦<?= $english_format_number ?></span> </td>
									</tr>
									<tr>
										<? $english_format_number = number_format($orderDetail["state_tax"], 2, '.', '');?>
										<td><span style="padding-right:10px;">Total State Tax: ₦<?= $english_format_number ?></span> <br /> </td>
									</tr>
									<tr>
										<? $english_format_number = number_format($grandTotal, 2, '.', '');?>
										<td><span style="padding-right:10px;">Total : ₦<?= $orderDetail["totalprice"] ?></span></td>
									</tr>
								</table> -->
							</div>
							<?	
               }	
               	?>
						</span>
						<br />
						<div class="payment_methode">
							<div>Select Payment Type:</div>
							<div>
								<input name="payment_method" type="radio" value="cash_on_delivery" checked="checked" />
								<label for="cash_on_delivery">Cash</label>
							</div>
							<div>
								<input name="payment_method" type="radio" value="pay_online" />
								<label for="pay_online">Card</label>
							</div>
						</div>
						<button class="add-btn float-left" id="perform_submit_action" style="padding:6px 25px 6px 25px;">Submit</button>
						<?php $attributes = array('id' => 'form_place_order'); ?>
						<?php echo form_open($this->config->item('base_url_https') . 'userorder/processorder_gateway/', $attributes); ?>
						<input type="hidden" name="oid" value="<?= $orderDetail['id'] ?>">
						<input type="hidden" name="ordertype" value="SALE" />
						<input type="hidden" name="orderoptions" value="GOOD" />
						<input type="hidden" name="chargetotal" id="chargetotal" value="<?= $orderDetail['totalprice'] ?>">
						</form>
					</div>
					<!-- End Content Section -->
				</div>
			</div>
		</div>
	</div>
</div>
<?
   $this->load->view("userfront/footer_view");
   ?>
