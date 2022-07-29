<?
$this->load->view("userfront/header_view_new");
?>

<div class="main-container">
    <div class="row justify-content-cetner">
        <div class="col-12 p-0">
            <div aria-label="breadcrumb ">
                <ol class="breadcrumb sign_in pt-3 MB-3">
                    <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url() ?>home">Home</a></li>
                    <li class="breadcrumb-item active"><span>Forgot Password</span></li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="main-container">
    <div class="grid_row sign_in mb-5">
				<?php if(!empty($success)) { ?>
        <div class="alert alert-success" role="alert">
					<?= $success ?>
        </div>
				<?php } ?>
				<?php if(!empty($error)) { ?>
        <div class="alert alert-danger" role="alert">
					<?= $error ?>
        </div>
				<?php } ?>
        <form class="mt-3" action="<?= base_url().'home/recoverview/',$arrUser['id'].'/',$arrUser['security_code'] ?>" method="post">
            <div></div>
            <div class="card mb-0 mt-0">
                <div class="card-header">
                    <h5>Reset Your Password</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="password" class="form-label">Enter New Password</label>
                        <input type="password" value="" name="password" class="form-control" id="new_pass" aria-describedby="emailHelp">
                        <!-- <div id="first_name" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="confpass" class="form-label">Confirm Password</label>
                        <input type="password" value="" name="confpass" class="form-control" id="new_pass_conf" aria-describedby="emailHelp">
                        <!-- <div id="first_name" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-0 mt-2">
												<input type="hidden" name="userid" id="userid" value="<?=$arrUser["id"]?>">
                        <input type="hidden" name="codeid" id="codeid" value="<?=$arrUser["security_code"]?>">
                        <input name="btn" type="submit" class="btn btn-primary text-white" value="Reset Your Password" onclick="forgotPassword()"/>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?
$this->load->view("userfront/footer_view");
?>
