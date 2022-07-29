<?
$this->load->view("restaurantportal/header_view");
$this->load->view("restaurantportal/sidepanel_view");
?>
<?
$this->load->view("restaurantportal/top_bar");
?>
<div class="title_bar">
	<h1>Notification Settings</h1>
</div>
<div class="title_bar content">
	<?
$this->load->view("restaurantportal/messages");
?>
	<div class="alert alert-danger" style="display: none"></div>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
	<script>
		$(document).ready(function() {
			function showEmail(){
				if($("#send_email:checked").length > 0){
					$("#email_wrapper").css("display","block");
				}else{
					$("#email_wrapper").css("display","none");
				}
			}
			showEmail();
			$( "#send_email" ).change(function() {
				showEmail();
			});
			function showPhone(){
				if($("#send_sms:checked").length > 0){
					$("#phone_wrapper").css("display","block");
				}else{
					$("#phone_wrapper").css("display","none");
				}
			}
			showPhone();
			$( "#send_sms" ).change(function() {
				showPhone();
			});
			const phoneInputField = document.querySelector("#phone_number");
			const phoneInput = window.intlTelInput(phoneInputField, {
				utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
			});

			const info = document.querySelector(".alert-info");
			const error = document.querySelector(".alert-danger");
			$("#notification_form").submit(function(e) {

				if($("#send_sms:checked").length > 0){
					const phoneNumber = phoneInput.getNumber();
					$("#phone_number").val(phoneNumber);
					console.log(phoneNumber);
					info.style.display = "none";
					error.style.display = "none";

					if (phoneInput.isValidNumber()) {
						return true;
					} else{
						error.style.display = "block";
						error.innerHTML = `Invalid phone number.`;
						event.preventDefault();
						return false;
					}
				}
			});
		});
	</script>
	<div class="row ">
		<form action="<?= base_url('restaurantsettings/notification_settings') ?>" method="POST" id="notification_form">
			<h4>Where do you want to send a new order notification?</h4>
			<div class="col-lg-6 col-xl-6 col-md-6 col-12">
				<div class="form-group mb-3">
					<div class="form-check">
						<input name="send_email" type="hidden" value="No" />
						<input id="send_email" class="form-check-input checkbox_adj" name="send_email" type="checkbox" value="Yes" <?= ($restaurant["send_email"] == "Yes") ? 'checked="checked"' : '' ?> />
						<label class="form-check-label " for="flexCheckChecked">
							<b>Email</b>
						</label>
					</div>
				</div>
				
				<div id="email_wrapper" class="form-group mb-3" style="display: none">
					<label for="email" class="form-label">Email Address</label>
					<input type="email" class="form-control" name="email" aria-describedby="email" value="<?= $restaurant["email"] ?>">
				</div>
				<div class="form-group mb-3">
					<div class="form-check">
						<input name="send_sms" type="hidden" value="No" />
						<input id="send_sms" class="form-check-input checkbox_adj" name="send_sms" type="checkbox" value="Yes" <?= ($restaurant["send_sms"] == "Yes") ? 'checked="checked"' : '' ?> />
						<label class="form-check-label " for="flexCheckChecked">
							<b>SMS</b>
						</label>
					</div>
				</div>
				<div id="phone_wrapper" class="form-group" style="display: none">
					<label for="phone_number" class="form-label">Phone Number</label>
					<input type="tel" id="phone_number" class="form-control mb-3" name="phone_number" aria-describedby="phone_number" value="<?= $restaurant["phone_number"] ?>">
					<div class="alert alert-info" style="display: none"></div>
				</div>
			</div>
			<div class="col-lg-12 col-xl-12 col-md-12 col-12">
				<input type="submit" class="btn  btn_adj" value="Save">
			</div>
		</form>
	</div>
</div>
</form>
<?
$this->load->view("restaurantportal/footer_view");
?>
