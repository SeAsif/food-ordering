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
	p,.alert-heading
	{
		font-size: 16px;
    font-weight: 800;
    font-stretch: normal;
    font-family: 'Roboto', sans-serif !important;
    font-style: normal;
    line-height: 1.16;
    letter-spacing: 0.14px;
		margin-bottom: 0;
    text-align: left;
    color: rgba(0, 0, 0, 0.6);
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
<div class="main-container">
	<!-- <div class="crum-menu breadcrumb">
		Order History
	</div> -->
	<div class="cont-wrap">
		<div class="rest-mid">

			<!-- Start Restaurant Head -->
			<div class="card">
				<div class="card-header">
					<h1>
						Order Fail
					</h1>
				</div>
				<div class="card-body">
					<!-- Start Content Section -->
					<div class="account">

						<!-- Start Order Success If User Login -->
						<div class="orderFail">
							<div class="alert alert-danger" role="alert">
								<h4 class="alert-heading">Failed</h4>
								<p>Sorry! We were unable to process your order</p>
							</div>
							<p>
								Please try again
								<a href="<?= base_url('/') ?><?= $this->session->userdata('restaurantID') ?>">click here</a>
							</p>
						</div>
						<!-- End Order Success If User Login -->

						<!-- Start Order Success If Guest Login -->
						<!-- End Order Success If Guest Login -->
					</div>
				</div>
			</div>
			<!-- End Content Section -->

		</div>
	</div>
</div>

<?
$this->load->view("userfront/footer_view");
?>
