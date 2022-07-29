<?
// $this->load->view("userfront/header_view");
$this->load->view("userfront/header_view_new");

?>

<div class="main-container">
    <div class="grid_row sign_in mb-5">

        <div class="alert alert-success" role="alert" style="display:none;">
			Please See Your Email Address, a reset password link has been sent to you. Thank You!!
        </div>
		<div class="alert alert-danger" role="alert" style="display:none;">
			Email Not Sent. Try again.

        </div>
        <form action="" method="post">
            <div></div>
            <div class="card mb-0 mt-3">
                <div class="card-header">
                    <h5>Reset Your Password</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" value="" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                        <!-- <div id="first_name" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-0 mt-2">

						           <input name="btn" type="button" class="btn btn-primary text-white" value="Reset Your Password" onclick="forgotPass()"/>

                        <a class=" btn btn-secondary" href="<?= base_url() ?>useraccount/login">Login</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function forgotPass() {
	var Email = $("#email").val();
					
	$.ajax({
		type: "POST",
		url: base_url + "home/verifyEmail/",
		data: "email=" + Email,
		success: function(response) {
			console.log(response);
			if (response === 'Email_Sent') {
				$(".alert-danger").hide();
				$(".alert-success").show();
			} else{
				$(".alert-success").hide();
				$(".alert-danger").show();
			}
				
		}

	});
}
</script>
<?
$this->load->view("userfront/footer_view");
?>

