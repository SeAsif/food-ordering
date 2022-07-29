<?
$this->load->view("userfront/header_view_new");
?>
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

	p {
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

	iframe {
		min-height: 600px !important;
	}

	@media only screen and (max-width:992px) {
		p {
			font-weight: normal !important;
			font-size: 14px !important;
		}

		.card {
			width: 100% !important;
		}

		.account-hed {
			width: 100% !important;
		}
	}
</style>
<!-- Start Menu Popups -->

<script language="javascript">
	var url = '<?= base_url() ?>userorder/orderdetail/';

	function refreshItemPage() {
		document.location.href = document.location.href;
	}

	function openItem(nItemId) {
		itemId = nItemId;
		var pageFrame = document.getElementById('itemIframe');

		pageFrame.src = url + nItemId;

		$('#dialog-message').dialog('open');
		return false;
	}
</script>

<script type="text/javascript">
	$(function() {
		// Dialog	( Start Edit Variant Popup Window Here )
		$('#dialog-message').dialog({
			autoOpen: false,
			modal: true,
			width: 920
		});

	});
</script>

<!-- End Menu Popups -->


<!-- Start Menu Popup -->
<!-- <div id="dialog-message" title="Order Detail">
        <iframe allowtransparency="true" frameborder="0" width="870" height="590" style="background:0px none; padding-top:10px;" id="itemIframe" name="itemIframe" >
        </iframe>
		</div> -->

<!-- End Menu Popup -->

<div class="main-container main-menu-bg-color">

	<!-- <div class="crum-menu breadcrumb">
		Order History
	</div> -->
	<div class="cont-wrap">
		<div class="rest-mid">

			<!-- Start Restaurant Head -->
			<div class="card main-menu-bg-color">
				<div class="card-header">
					<h1 class="category-text-color" style="text-align:center !important;">
						Order Number: <?= $orderCode ?>
					</h1>
				</div>
				<div class="card-body">
					<!-- Start Content Section -->
					<div class="account">

						<!-- Start Order Success If User Login -->
						<?
                	if($orderStatus=="Confirmed")
					{
				?>
						<div class="orderSuccess" style="text-align:center !important;">
							<p class="menu-heading" style="text-align:center !important;">Your order have been confirmed successfully.</p>
							<p class="menu-heading" style="text-align:center !important;">Order Information has been sent to your Email. Click here to <a style="padding: 5px;" class="primary-btn-bg-color primary-btn-text-color" href="<?= base_url('m/') ?><?= $this->session->userdata('restaurantName') ?>">continue shopping</a></p>
						</div>
						<?
                	}else{
					?>
						<div class="orderSuccess" style="text-align:center !important;">
							<h2 class="menu-heading" style="text-align:center !important;">Order Number: <?= $orderCode ?></h2>
							<h1 class="menu-heading" style="text-align:center !important;">Sorry! We were unable to process your order</h1>
							<p class="menu-heading" style="text-align:center !important;">
								Please try again
								<a href="<?= base_url() ?>">click here</a>
							</p>
						</div>
						<?	
					}
				?>
						<!-- End Order Success If User Login -->

						<!-- Start Order Success If Guest Login -->
						<!-- End Order Success If Guest Login -->
					</div>
					<!-- End Content Section -->
				</div>
				<!-- <embed src="<?= base_url() ?>userorder/orderdetail/<?= $orderId ?>" style="padding:15px" width="100%" height="1300px" /> -->
				<iframe src="<?= base_url() ?>userorder/orderdetail/<?= $orderId ?>" style="padding:15px" width="100%" height="100%">
				</iframe>
			</div>
		</div>
	</div>
</div>
<?
$this->load->view("userfront/footer_view");
?>
