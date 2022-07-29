<?
	$this->load->view("restaurantportal/header_view");
	$this->load->view("restaurantportal/sidepanel_view");
	$this->load->view("restaurantportal/top_bar");
?>
<style>
.required {
    color: red;
}

.section {
    color: #f36737;
}
</style>
<div class="title_bar">
    <h1>Payment Gateway Detail</h1>
</div>
<div class="mid-right">
    <?
		$this->load->view("restaurantportal/messages");
	?>
    <br class="clear" />
    <br />
    <?
        $attributes = array('id' => 'frmpaystack','name' => 'frmpaystack');
        echo form_open(base_url().'restaurantsettings/paymentgateway',$attributes);
    ?>
    <style>
    .card {
        box-shadow: 0 6px 6px 0 rgb(0 0 0 / 16%);
        border-color: transparent;
        border-radius: 20px;
    }

    .card .card_body {
        padding: 25px;
    }

    .card .card_body h3 {
        text-align: center;
        font-family: Helvetica;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .card .card_body label {
        width: 100%;
        font-family: Helvetica;
        margin: 10px 0;
    }

    .card .card_body label:last-child {
        margin: 0;
    }

    .card .card_body label input {
        width: 100% !important;
        min-height: 45px;
        padding: 0 10px;
        font-family: Helvetica;
    }

    .card .card_body label input[type="radio"] {
        width: 1em !important;
        min-height: unset;
        padding: 0;
        border-color: #000;
    }

    .card .card_body label .form-check-input:checked {
        border-color: transparent;
    }
    </style>
    <div class="row">
        <div class="col-lg-6 col-12 col-xl-6 col-md-6 mb-3">
            <div class="card">
                <div class="card_body">
                    <h3>Paystack API Key</h3>
                    <label for="payment_gateway">
                        API Secret Key
                        <input name="paystack_secret_key" id="paystack_secret_key" type="text" class="form-control w-50"
                            value="<?php echo $payment_gateway_info['paystack_secret_key']; ?>" />
                    </label>
                    <label class="form-check-label" for="payment_gateway">
                        <input name="payment_gateway" id="payment_gateway" class="form-check-input payment_gateway"
                            type="radio" value="paystack"
                            <?php echo $payment_gateway_info['payment_gateway'] == "paystack" ? 'checked="checked"' : ''; ?>>
                        Select as Default
                    </label>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12 col-xl-6 col-md-6 mb-3">
            <div class="card">
                <div class="card_body">
                    <h3>Flutterwave API Key</h3>
                    <label for="flutterwave_secret_key">
                        API Secret Key
                        <input name="flutterwave_secret_key" id="flutterwave_secret_key" type="text"
                            class="form-control w-50"
                            value="<?php echo $payment_gateway_info['flutterwave_secret_key']; ?>" />
                    </label>
                    <label class="form-check-label" for="payment_gateway1">
                        <input name="payment_gateway" class="form-check-input payment_gateway" id="payment_gateway1"
                            type="radio" value="flutterwave"
                            <?php echo $payment_gateway_info['payment_gateway'] == "flutterwave" ? 'checked="checked"' : ''; ?>>
                        Select as Default
                    </label>
                </div>
            </div>
        </div>
        <input style="min-height: 45px;" name="btm" type="submit" value="Save" class="orange_btn btn text-white mx-3"
            style="margin-right:10px;margin-top:20px;" />
        <!-- <input name="btm1" type="submit" value="Cancel" class="orange_btn btn text-white" style="margin-right:10px;margin-top:20px;" /> -->
    </div>
    <!-- <table width="100%" border="0" cellspacing="0" cellpadding="0" class="password">
		<tr>
			<td>
				<h4 class="section">Paystack API Key</h4>
			</td>
		</tr>
		<tr>
			<td><strong>&nbsp;&nbsp;&nbsp;Secret Key :</strong></td>
			<td><input name="paystack_secret_key" id="paystack_secret_key" type="text" class="form-control w-50" value="<?php echo $payment_gateway_info['paystack_secret_key']; ?>" /></td>
		</tr>
		<tr>
			<td>
				<h4 class="section">Flutterwave API Key</h4>
			</td>
		</tr>
		<tr>
			<td><strong>&nbsp;&nbsp;&nbsp;Secret Key :</strong></td>
			<td><input name="flutterwave_secret_key" type="text" id="flutterwave_secret_key" class="form-control w-50" value="<?php echo $payment_gateway_info['flutterwave_secret_key']; ?>" /></td>
		</tr>
		<tr>
			<td>
				<h4 class="section">Active Payment Gateway</h4>
			</td>
		</tr>
		<tr>
			<td>
				<span><strong>Note:</strong> Please select any of one payment gateway.</span>
				<div class="form-check" style="margin-top:20px">
					<input name="payment_gateway" class="form-check-input payment_gateway" type="radio" value="paystack" checked="checked">
					<label class="form-check-label" for="whole_week_check">
						Paystack
					</label>
					&nbsp;&nbsp;&nbsp;
				</div>
				<div class="form-check" style="margin-top:20px">
					<input name="payment_gateway" class="form-check-input payment_gateway" type="radio" value="flutterwave" <?php echo $payment_gateway_info['payment_gateway'] == "flutterwave" ? 'checked="checked"' : ''; ?>>
					<label class="form-check-label" for="whole_week_check">
						Flutterwave
					</label>
				</div>
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input name="btm" type="submit" value="Save" class="orange_btn btn text-white" style="margin-right:10px;" />
				<input name="btm1" type="submit" value="Cancel" class="orange_btn btn text-white" style="margin-right:10px;" />
			</td>
		</tr>
	</table> -->
    </form>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/js/bootstrap-colorpicker.js"></script>

<script>
$('#frmpaystack').submit(function() {
    var payment_gateway = $('input[name="payment_gateway"]:checked').val();
    if (payment_gateway == "paystack") {
        var paystack = $("#paystack_secret_key").val();
        if (paystack == "" || paystack == undefined) {
            alertify.alert('Error', 'Please enter paystack secret key.');
            return false;
        }
    } else {
        var paystack = $("#flutterwave_secret_key").val();
        if (paystack == "" || paystack == undefined) {
            alertify.alert('Error', 'Please enter flutterwave secret key.');
            return false;
        }
    }
});
</script>

<!-- End Mid Right -->
<?
	$this->load->view("restaurantportal/footer_view");
?>