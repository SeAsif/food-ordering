<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
	<li class="nav-item" role="presentation">
		<button class="nav-link active" id="pills-guest-tab" data-bs-toggle="pill" data-bs-target="#pills-guest" type="button" role="tab" aria-controls="pills-guest" aria-selected="true">Guest</button>
	</li>
	<li class="nav-item" role="presentation">
		<button class="nav-link" id="pills-login-tab" data-bs-toggle="pill" data-bs-target="#pills-login" type="button" role="tab" aria-controls="pills-login" aria-selected="false">Login</button>
	</li>
</ul>
<script>

	function login() {
		user = document.getElementById('user').value;
		pass = document.getElementById('pass').value;
		userType = 'user';
		$.ajax({
			type: "POST",
			url: "<?= base_url() ?>irestaurant/login",
			data: "email=" + user + "&" + "password=" + pass + "&" + "usertype=" + userType + "",
			success: function(login) {
				//alert(addFavoriteRestaurant);
				var status = "";
				var obj = jQuery.parseJSON(login);
				$.each(obj, function() {

					status = obj.error;

				});

				if (status) {

					document.getElementById("login-error").innerHTML = status;
					document.getElementById("login-error").style.display = "block";
				
				}else {
					document.location.href = document.location.href;
				}
			} //end function
		});

	}

	function keyCheck(e) {
		var code;
		if (!e) var e = window.event;
		if (e.keyCode) code = e.keyCode;
		else if (e.which) code = e.which;
		if (code == 13) {
			login();
		}
	}

	function keyCheck2(e) {
		var code;
		if (!e) var e = window.event;
		if (e.keyCode) code = e.keyCode;
		else if (e.which) code = e.which;
		if (code == 13) {
			login_guest();
		}
	}

	function login_guest() {
		firstname = document.getElementById('firstname').value;
		lastname = document.getElementById('lastname').value;
		guest_email2 = document.getElementById('guest_email').value;
		guest_email_conf2 = document.getElementById('guest_email_conf').value;
		phone2 = document.getElementById('phone').value;
		guest_order_type = document.getElementById('guest_order_type').value;

		$.ajax({
			type: "POST",
			url: "<?= base_url() ?>irestaurant/login_guest",
			data: {
				firstname: firstname,
				lastname: lastname,
				guest_email: guest_email2,
				guest_email_conf: guest_email_conf2,
				phone: phone2,
				order_type: guest_order_type
			},
			success: function(data) {
				//alert(addFavoriteRestaurant);
				var status = "";
				var obj = jQuery.parseJSON(data);

				$.each(obj, function() {

					status = obj.error;

				});

				if (status.length > 0 ) {

					document.getElementById("guest-error").innerHTML = status;
					document.getElementById("guest-error").style.display = "block";

				}else {

					$("#guest_next").hide();
					$("#guest_submit").show();
					$('#signin-message').modal('hide');
				}
			} //end function
		});

	}
</script>


<script language="javascript">
	var base_url = '<?= base_url(); ?>';

	function forgotPassword(nPassId) {
		forgotPass = nPassId;
		PassId = nPassId;

		$('#forgot_pass').dialog('open');
		return false;
	}

	var base_url = '<?= base_url(); ?>';

	function forgotMsg(nPassId) {
		forgotMsg = nPassId;
		$('#forgot_msg').dialog('open');
		return false;
	}

	var base_url = '<?= base_url(); ?>';

	function forgotMsgFail(nPassId) {
		forgotMsgFail = nPassId;
		$('#forgot_msg_fail').dialog('open');
		return false;
	}
</script>


<!-- Start Dialog Popups -->
<script type="text/javascript">
	$(function() {
		// Dialog	( Start Edit Variant Popup Window Here )
		$('#forgot_pass').dialog({
			autoOpen: false,
			modal: true,
			width: 300,
			buttons: {
				"Submit": function() {
					//$(this).dialog("close"); 
					var Email = $("#emailAddress").val();
					//$("#variant").val(Variant);
					$.ajax({
						type: "POST",
						url: base_url + "home/verifyEmail/",
						data: "varia=" + Email,
						success: function(response) {
							if (response == 'Email_Sent') {
								$('#forgot_msg').dialog('open');
								//	alert(response);

								//	document.location.href=document.location.href;

							} else
								$('#forgot_msg_fail').dialog('open');
							//	alert(response);


						}

					});

				},
				"Cancel": function() {
					$(this).dialog("close");
				}
			}

		});

	});

	$(function() {
		// Dialog	( Start Edit Variant Popup Window Here )
		$('#forgot_msg').dialog({
			autoOpen: false,
			modal: true,
			width: 300,

			buttons: {
				"Ok": function() {
					$('#forgot_pass').dialog("close");
					$(this).dialog("close");
				}
			}

		});

	});

	$(function() {
		// Dialog	( Start Edit Variant Popup Window Here )
		$('#forgot_msg_fail').dialog({
			autoOpen: false,
			modal: true,
			width: 300,

			buttons: {
				"Ok": function() {
					$(this).dialog("close");
				}
			}

		});

	});
</script>
<!-- End Dialog Popups -->




<!-- Start Forgot passwrod process Window Here -->
<div id="forgot_pass" title="Forgot Password" style="display:none;">
	<table cellspacing="0" cellpadding="0" border="0" width="100%">
		<tr>
			<td style="padding-bottom: 10px; width: 596px; font-size:12px; padding-top:10px;" colspan="2">
				Email Address
			</td>
		</tr>
		<tr>
			<td>
				<input type="text" value="" name="emailAddress" id="emailAddress" style="width:200px; padding:3px;" class="txt-field01">
				<input type="hidden" value="yes" name="add">
			</td>
		</tr>
	</table>
</div>
<!-- End Forgot passwrod process Window Here -->

<!-- Start Forgot passwrod Email Msg -->
<div id="forgot_msg" title="Forgot Password" style="display:none;">
	<table cellspacing="0" cellpadding="0" border="0" width="100%">
		<tr>
			<td style="padding-bottom: 10px; width: 596px; font-size:12px; padding-top:10px;" colspan="2">
				<strong>Please See Your Email Address security code has been sent to you. Thank You!!</strong>
			</td>
		</tr>
	</table>
</div>
<!-- End Forgot passwrod Email Msg -->

<!-- Start Forgot passwrod Email Not Sent Msg -->
<div id="forgot_msg_fail" title="Forgot Password" style="display:none;">
	<table cellspacing="0" cellpadding="0" border="0" width="100%">
		<tr>
			<td style="padding-bottom: 10px; width: 596px; font-size:12px; padding-top:10px;" colspan="2">
				<strong>Email Not Sent</strong>
			</td>
		</tr>
	</table>
</div>
<!-- End Forgot passwrod Email Not Sent Msg -->




<!-- Start Error Success Msg -->
<br />



<br class="clear" />
<!-- End Error Success Msg -->

<style>
	.ui-widget-header {
		background: white !important;
		border: none;
	}

	.ui-widget-content {
		background: white !important;
		border-radius: 20px !important;
		border: none !important;
	}

	.label {
		font-family: Helvetica;
		font-size: 16px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: 1.8;
		letter-spacing: normal;
		color: #575757;
		width: 100%;
		display: inline-block;
	}

	a.label,
	span.label,
	span.label a {
		font-size: 12px !important;
		display: block !important;
	}

	.signinfld {
		display: inline-block;
		width: 100%;
		padding: .375rem .75rem;
		font-size: 1rem;
		line-height: 1.5;
		color: #495057;
		background-color: #fff;
		background-clip: padding-box;
		border: 1px solid #ced4da;
		border-radius: .25rem;
		transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
	}

	.ui-state-hover {
		background-image: none !important;
	}

	.nav-pills .nav-link.active,
	.nav-pills .show>.nav-link {
		background-color: #37b8ac !important;
	}
	.link-color{
		color:#37B8AC;
	}
</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="signin">
	<tr>
		<td style="width:100%;">

			<div class="tab-content" id="pills-tabContent">
				<div class="tab-pane fade show active" id="pills-guest" role="tabpanel" aria-labelledby="pills-guest-tab">
				<div class="alert alert-danger" role="alert" id="guest-error" style="display:none">
				</div>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<input type="hidden" id="guest_order_type" name="guest_order_type" value="TakeAway">
						<tr>
							<td style="padding-top:5px;" class="label">First Name: <span class="not_req_guest_field" style="color:#FF0000;">*</span></td>
						</tr>
						<tr>
							<td><input id="firstname" type="text" class="signinfld" /></td>
						</tr>
						<tr>
							<td style="padding-top:5px;" class="label">Last Name: <span class="not_req_guest_field" style="color:#FF0000;">*</span></td>
						</tr>
						<tr>
							<td><input id="lastname" type="text" class="signinfld" /></td>
						</tr>
						<tr>
							<td style="padding-top:5px;" class="label">Email: <span style="color:#FF0000;">*</span></td>
						</tr>
						<tr>
							<td><input id="guest_email" type="text" onkeypress="keyCheck2(event);" class="signinfld" /></td>
						</tr>
						<tr>
							<td style="padding-top:5px;" class="label">Retype Email: <span style="color:#FF0000;">*</span></td>
						</tr>
						<tr>
							<td><input id="guest_email_conf" type="text" onkeypress="keyCheck2(event);" class="signinfld" /></td>
						</tr>
						<tr>
							<td style="padding-top:5px;" class="label">Mobile Phone: <span class="not_req_guest_field" style="color:#FF0000;">*</span></td>
						</tr>
						<tr>
							<td><input id="phone" type="text" class="signinfld" /></td>
						</tr>
						<tr>
							<td>
								<a class="add-btn label" href="javascript:void(null);" onclick="javascript:login_guest();">
									Proceed as Guest
								</a>
							</td>
						</tr>
						<tr>
							<td>
								<span class="font11 label" style="text-decoration:none; font-weight:normal; color:#0065B4;">
									<span style="color:#FF0000;">*</span>Email address is needed to allow us<br /> to send you a confirmation for your order.<br /> Phone number is optional.
								</span>
							</td>
						</tr>
					</table>
				</div>
				<div class="tab-pane fade" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab">
				<div class="alert alert-danger" role="alert" id="login-error" style="display:none">
				</div>
					<form method="post" id="signin-form">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td style="padding-top:5px;" class="label">Email:</td>
							</tr>
							<tr>
								<td><input name="user" id="user" onkeypress="keyCheck(event);" type="text" class="signinfld" /></td>
							</tr>
							<tr>
								<td style="padding-top:5px;" class="label">Password:</td>
							</tr>
							<tr>
								<td><input name="pass" id="pass" type="password" onkeypress="keyCheck(event);" class="signinfld" /></td>
							</tr>
							<tr>
								<td>
									<a class="add-btn label" href="javascript:void(null);" onclick="javascript:login();">
										Sign In
									</a>
								</td>
							</tr>
							<tr>
								<td>
									<a class="link-color" href="<?= base_url('useraccount/createaccount')?>">
										Don't have account? Signup
									</a>
								</td>
							</tr>
						</table>
					</form>
				</div>
				<div class="tab-pane fade" id="pills-signup" role="tabpanel" aria-labelledby="pills-signup-tab">
					<form method="post" id="signin-form">
						<div class="mb-3">
							<label for="first_name" class="form-label">First Name</label>
							<input type="text" value="<?= $userDetail["firstname"] ?>" name="firstname" class="form-control" id="first_name" aria-describedby="emailHelp">
						</div>
						<div class="mb-3">
							<label for="last_name" class="form-label">Last Name</label>
							<input type="text" value="<?= $userDetail["lastname"] ?>" name="lastname" class="form-control" id="last_name" aria-describedby="emailHelp">
						</div>
						<div class="mb-3">
							<label for="new_email_address" class="form-label">Email Address</label>
							<input type="text" value="<?= $userDetail["email"] ?>" name="newemail" class="form-control" id="new_email_address" aria-describedby="emailHelp">
						</div>
						<div class="mb-3">
							<label for="newpass" class="form-label">New Password</label>
							<input type="password" name="newpass" class="form-control" id="newpass" aria-describedby="emailHelp">
						</div>
						<div class="mb-3">
							<label for="retyppass" class="form-label">Retype Password</label>
							<input type="password" name="confpass" class="form-control" id="retyppass" aria-describedby="emailHelp">
						</div>
						<div class="mb-3">
							<a class="add-btn label" href="javascript:void(null);" onclick="javascript:signup();">
									Signup
								</a>
						</div>
					</form>
				</div>
			</div>

		</td>
	</tr>
</table>
