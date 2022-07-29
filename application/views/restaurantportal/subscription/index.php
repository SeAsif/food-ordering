<?
	$this->load->view("restaurantportal/header_view");
	echo form_open(base_url().'restaurantportal');
?>
<style>
	.login-page-wrap {
	    width: 100%;
	}

	.grid_row {
	    display: block;
	}

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

	.cr_acc{
	    position: relative;
	    top: -64px;
	    left: 26%;
	}

	.contact_info {
		padding-left: 188px;
		display: block;
	}
</style>
<div class="text-center">
  	<img style="width: 100px;margin-top:50px;margin-bottom:30px" src="<?= base_url() . 'images/new_logo.png'; ?>" srcset="<?= base_url() . 'images/new_logo@2x.png'; ?>" class="img-fluid " alt="">
</div>

<table width="770" border="0" align="center" cellpadding="0" cellspacing="0">
  	<tr>
    	<td valign="top">
      		<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table" s>
        		<tr>
          			<td valign="top">
          				<?php if($this->session->flashdata('payment_error')){ ?>
          					<div class="ui-widget">
					    		<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
					      			 <?php echo $this->session->flashdata('payment_error');?>
					    		</div>
					  		</div>
						<?php } ?>
          			</td>
        		</tr>
        		<tr>
          			<td valign="top" style="padding-top:30px;">
            			<div class="login-page-wrap">
                			<section id="advert_pckg" class="advert_sect font_rlw">
    							<div class="container">
	      							<div class="row">
		        						<div class="col-lg-12 col-sm-12 col-md-12 col-12">
		          							<div class="subscriptional_info">

		          								<?php if ($is_trial_remaining == 'yes' && $current_package == 'Trial') { ?>
			            							<p style="float: right; display: block;">Trail will expire in <?php echo $trial_day; ?> days.</p>

			            						<?php } ?>	
		            							<p>Current Package: <?php echo $current_package; ?></p>
		            							<p>Expiry Date: <?php echo $sub_expiry_date; ?></p>
		          							</div>
		        						</div> 
		      						</div>
	     							<div class="row">
	        							<div class="col-lg-6 col-sm-6 col-md-6 col-12">
	          								<div class="plan_card">

									            <h2>Monthly</h2>
									            <h3>₦38,000/month</h3>
								          	</div>
								          	<?php if ($is_trial_remaining == 'yes') { ?>
		            							<a href="<?php echo base_url("subscription/purchase/monthly/".$trial_day); ?>" class="orange_btn btn text-white cr_acc"> Subscribe Now </a>

		            						<?php } else { ?>
		            							<a href="<?php echo base_url("subscription/purchase/monthly/".$total_day); ?>" class="orange_btn btn text-white cr_acc"> Subscribe Now </a>
		            						<?php } ?>
								        </div>
								        <div class="col-lg-6 col-sm-6 col-md-6 col-12">
									        <div class="plan_card">

									            <h2>Annually</h2>
									            <h3>₦410,000/year</h3>
									            <h3>10% Discount</h3>
									            <h3>₦38,000/month</h3>
									        </div>
									        <?php if ($is_trial_remaining == 'yes') { ?>
		            							<a href="<?php echo base_url("subscription/purchase/yearly/".$trial_day); ?>" class="orange_btn btn text-white cr_acc"> Subscribe Now </a>
		            						<?php } else { ?>
		            							<a href="<?php echo base_url("subscription/purchase/yearly/".$total_day); ?>" class="orange_btn btn text-white cr_acc"> Subscribe Now </a>
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
<script>
	var message = "Please subscribe your trial has ended.";
    alertify.alert('Notice', message);
</script>
<!-- End Mid Right -->
<?
	$this->load->view("restaurantportal/footer_view");
?>
