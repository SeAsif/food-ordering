<?
// $this->load->view("userfront/header_view");
$this->load->view("userfront/header_view_new");

?>

<div class="main-container">
    <div class="grid_row sign_in mb-5 pt-3">

	<!-- Start Error Success Msg -->
<?php if (isset($_SESSION['success']))
			{
			?>
		<div class="alert alert-success" role="alert">
			<?= $_SESSION['success'] ?>
			<?php unset($_SESSION['success']) ?>
		</div>

		<?
			}	
	?>
	<div class="alert alert-danger" role="alert" id="error" style="display:none">
		Username or password is invalid
	</div>
	<div class="alert alert-danger" role="alert" id="email_password" style="display:none">
		Email and password is Required!!
	</div>
	<div class="alert alert-danger" role="alert" id="email_error" style="display:none">
		Email field is Required!!
	</div>
	<div class="alert alert-danger" role="alert" id="password_error" style="display:none">
		Password field is Required!!
	</div>
	<div class="alert alert-danger" role="alert" id="error_guest" style="display:none">
		Email addresses does not match
	</div>
	<div class="alert alert-danger" role="alert" id="error_email" style="display:none">
		Email address is not valid. Please Enter valid email address
	</div>

<!-- End Error Success Msg -->

        <form action="" method="post">
            <div></div>
            <div class="card mb-0 mt-0">
                <div class="card-header">
                    <h5>Login Into Your Account</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">

                        <label for="username" class="form-label">Email</label>
                        <input required="required" type="text" value="" name="username" class="form-control" id="username" aria-describedby="emailHelp">

                        <!-- <div id="first_name" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>

                        <input required="required" type="password" value="" name="password" class="form-control" id="password" aria-describedby="emailHelp">
                        <!-- <div id="first_name" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-0 mt-2">
                        <input name="btn" type="button" class="btn btn-primary text-white" value="Login" onclick="login()" />

                        <a class=" btn btn-secondary" href="<?= base_url() ?>useraccount/forgotPasswordScreen">Forgot Password</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
	function login() {
		user = document.getElementById('username').value;
		pass = document.getElementById('password').value;
		userType = 'user';
		console.log(user);
		console.log(pass);
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

				document.getElementById("password_error").style.display = "none";
				document.getElementById("error").style.display = "none";
				document.getElementById("email_error").style.display = "none";
				document.getElementById("email_password").style.display = "none";
				document.getElementById("error_guest").style.display = "none";
				document.getElementById("error_email").style.display = "none";

				if (status == "Login_Error") {
					document.getElementById("error").style.display = "block";

				} else if (status == "Email_Required") {
					document.getElementById("email_error").style.display = "block";

				} else if (status == "Password_Required") {
					document.getElementById("password_error").style.display = "block";

				} else if (status == "Email_Password") {
					document.getElementById("email_password").style.display = "block";

				} 
				else {
					document.location.href = "<?= base_url('/') ?><?= $this->session->userdata('restaurantID') ?>";
				}
			} //end function
		});

	}
</script>
<?
$this->load->view("userfront/footer_view");
?>

