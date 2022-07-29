<?
	$this->load->view("restaurantportal/header_view");
	$this->load->view("restaurantportal/sidepanel_view");
	$this->load->view("restaurantportal/top_bar");
?>
<style>
/*.login-page-wrap {
	    width: 100%;
	}

	.grid_row {
	    display: block;
	}*/

.subscriptional_info {
    padding: 15px 30px;
    border-radius: 20px;
    box-shadow: 0 0 8px #f36737;
    margin-bottom: 40px;
    margin-top: 24px;
}

.plan_card {
    text-align: center;
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 0 8px #f36737;
    margin-bottom: 16px;
    min-height: 300px;
}

.plan_card h2 {
    color: #20c997;
    font-weight: 900;
}

.plan_card h3 {
    margin-top: 18px
}

.cr_acc {
    position: relative;
    top: -64px;
    left: 26%;
}

.contact_info {
    padding-left: 188px;
    display: block;
}
</style>
<div class="title_bar">
    <h1>Subscription Packages</h1>
</div>
<div class="mid-right">
    <? if (isset($success["msg"])) { ?>
    <div class="ui-widget">
        <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
            <p>
                <span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                <strong><?= $success["msg"] ?></strong>
            </p>
        </div>
    </div>
    <? } ?>
    <? if (isset($errors) && count($errors)) { ?>
    <br />
    <div class="ui-widget">
        <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
            <? 
      				foreach ($errors as $error) {
						echo $error;
					}
				?>
        </div>
    </div>
    <? } ?>
    <br class="clear" />
    <br />
    <style>
    .card {
        box-shadow: 0 6px 6px 0 rgb(0 0 0 / 16%);
        border-color: transparent;
        border-radius: 20px;
    }

    .card .card_body {
        padding: 25px;
    }

    .card .card_body p.flex {
        display: flex;
        margin-bottom: 20px;
        font-weight: bold;
        justify-content: space-between;
    }

    .card .card_body p.flex span {
        font-weight: bold;
        color: #20c997;
    }

    .card .card_body p {
        font-weight: normal;
        margin-bottom: 0;
    }

    .plan_card1 {
        padding: 30px;
        flex-direction: column;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .plan_card1 h2 {
        font-weight: bold;
        margin-bottom: 25px;
    }

    .plan_card1 p {
        font-weight: normal !important;
        margin-bottom: 15px !important;
    }

    h1 {
        margin-bottom: 30px;
    }
    </style>
    <div class="row">
        <div class="col-12 mb-5">
            <div class="card">
                <div class="card_body">
                    <p class="flex">
                        Current Package: <?php echo $current_package; ?>
                        <?php if ($is_trial_remaining == 'yes' && $current_package == 'Trial') { ?>
                        <span>Trial will expire in <?php echo $trial_day; ?> days.</span>

                        <?php } ?>
                    </p>
                    <?php if ($is_subscribe == 'no') { ?>
                    <p>Expiry Date: <?php echo $sub_expiry_date; ?></p>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6 col-lg-6 col-md-6 mb-4">
            <?php if ($current_package != "Annually") { ?>
            <div class="card plan_card1">
                <div class="card-body ">
                    <h2>Monthly</h2>
                    <p>₦38,000/month</p>
                    <?php if ($current_package == "Monthly") { ?>
                    <?php $annual_txt = "Upgrade to Annually"; ?>
                    <p class="orange_btn btn text-white">Current Package</p>
                    <?php } else { ?>
                    <?php $annual_txt = "Subscribe Now"; ?>

                    <?php if ($is_trial_remaining == 'yes') { ?>
                    <a href="<?php echo base_url("subscription/purchase/monthly/" . $trial_day); ?>"
                        class="orange_btn btn text-white "> Subscribe Now </a>

                    <?php } else { ?>
                    <a href="<?php echo base_url("subscription/purchase/monthly/" . $total_day); ?>"
                        class="orange_btn btn text-white "> Subscribe Now </a>
                    <?php } ?>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="col-12 col-xl-6 col-lg-6 col-md-6">
            <div class="card plan_card1">
                <div class="card_body ">
                    <h2>Annually</h2>
                    <p>₦410,000/year</p>
                    <p>10% Discount</p>
                    <p>₦38,000/month</p>
                    <?php if ($current_package == "Annually") { ?>
                    <p class="cr_acc">Current Package</p>
                    <?php } else { ?>
                    <?php if ($is_trial_remaining == 'yes') { ?>
                    <a style="width:160px !important;"
                        href="<?php echo base_url("subscription/purchase/yearly/" . $trial_day); ?>"
                        class="orange_btn btn text-white"> <?= $annual_txt ?> </a>

                    <?php } else { ?>
                    <a style="width:160px !important;"
                        href="<?php echo base_url("subscription/purchase/yearly/" . $total_day); ?>"
                        class="orange_btn btn text-white "> <?= $annual_txt ?> </a>
                    <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-12 mt-5">
            <h1 class="text-center" style="display: block;">To cancel subscription contact us:</h1>
            <p class="text-center">Phone: <?php echo $phone; ?></p>
            <p class="text-center">Email: <?php echo $email; ?></p>
        </div>
    </div>


    <!-- <table width="100%" border="0" cellspacing="0" cellpadding="0" class="password">
		<tr>
			<td>
				<table width="770" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top">
							<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table" s>
								<tr>
									<td valign="top">
										<?php if ($this->session->flashdata('payment_error')) { ?>
											<div class="ui-widget">
												<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
													<?php echo $this->session->flashdata('payment_error'); ?>
												</div>
											</div>
										<?php } ?>
									</td>
								</tr>
								<tr>
									<td valign="top" style="padding-top:30px;">
										<div class="">
											<section id="advert_pckg" class="advert_sect font_rlw">
												<div class="">
													<div class="row">
														<div class="col-lg-12 col-sm-12 col-md-12 col-12">
															<div class="subscriptional_info">

																<?php if ($is_trial_remaining == 'yes' && $current_package == 'Trial') { ?>
																	<p style="float: right; display: block;">Trial will expire in <?php echo $trial_day; ?> days.</p>

																<?php } ?>
																<p>Current Package: <?php echo $current_package; ?></p>
																<p>Expiry Date: <?php echo $sub_expiry_date; ?></p>
															</div>
														</div>
													</div>
													<div class="row">
														<?php if ($current_package != "Annually") { ?>
															<div class="col-lg-6 col-sm-6 col-md-6 col-12">
																<div class="plan_card">

																	<h2>Monthly</h2>
																	<h3>₦38,000/month</h3>
																</div>
																<?php if ($current_package == "Monthly") {
																	$annual_txt = "Upgrade to Annually";
																?>
																	<h4 class="cr_acc">Current Package</h4>
																<?php } else {
																	$annual_txt = "Subscribe Now";
																?>

																	<?php if ($is_trial_remaining == 'yes') { ?>
																		<a href="<?php echo base_url("subscription/purchase/monthly/" . $trial_day); ?>" class="orange_btn btn text-white cr_acc"> Subscribe Now </a>

																	<?php } else { ?>
																		<a href="<?php echo base_url("subscription/purchase/monthly/" . $total_day); ?>" class="orange_btn btn text-white cr_acc"> Subscribe Now </a>
																	<?php } ?>
																<?php } ?>
															</div>
														<?php } ?>
														<div class="col-lg-6 col-sm-6 col-md-6 col-12">
															<div class="plan_card">

																<h2>Annually</h2>
																<h3>₦410,000/year</h3>
																<h3>10% Discount</h3>
																<h3>₦38,000/month</h3>
															</div>
															<?php if ($current_package == "Annually") { ?>
																<h4 class="cr_acc">Current Package</h4>
															<?php } else { ?>
																<?php if ($is_trial_remaining == 'yes') { ?>
																	<a style="width:160px !important;" href="<?php echo base_url("subscription/purchase/yearly/" . $trial_day); ?>" class="orange_btn btn text-white cr_acc"> <?= $annual_txt ?> </a>

																<?php } else { ?>
																	<a style="width:160px !important;" href="<?php echo base_url("subscription/purchase/yearly/" . $total_day); ?>" class="orange_btn btn text-white cr_acc"> <?= $annual_txt ?> </a>
																<?php } ?>
															<?php } ?>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-12 col-sm-12 col-md-12 col-12">
															<div>
																<p style="display: block;">To cancel subscription contact us:</p>
																<p class="contact_info">Phone: <?php echo $phone; ?></p>
																<p class="contact_info">Email: <?php echo $email; ?></p>
															</div>
														</div>
													</div>
												</div>
											</section>
										</div>

									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table> -->
</div>
<!-- End Mid Right -->
<?
	$this->load->view("restaurantportal/footer_view");
?>

<script>
jQuery(document).ready(function() {
    var currentheight = 0;
    jQuery('.plan_card1').each(function() {
        var active = jQuery(this);
        var height = jQuery(this).height();
        console.log('height ', height);
        if (currentheight < height) {
            var currentheight = height;
        }
        console.log('active ', active);
        jQuery(active).css('height', currentheight);
    });
});
</script>