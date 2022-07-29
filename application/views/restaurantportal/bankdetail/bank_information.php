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
  	<h1>Bank Account Detail</h1>
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
  	<?
        $attributes = array('id' => 'frmbankdetail','name' => 'frmbankdetail');
        echo form_open(base_url().'restaurantsettings/bankinformation',$attributes);
    ?>
	  	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="password">
	  		<tr>
	  			<td>
	  				<h4 class="section">Bank Account</h4>
	  			</td>
	  		</tr>
	    	<tr>
	      		<td><strong>&nbsp;&nbsp;&nbsp;IBAN <span class="required">*</span>:</strong></td>
	      		<td><input name="IBAN" type="text" class="form-control w-50" /></td>
	   	 	</tr>
	    	<tr>
	      		<td><strong>&nbsp;&nbsp;&nbsp;Account Number:</strong></td>
	      		<td><input name="account_number" type="text" class="form-control w-50" /></td>
	    	</tr>
	    	<tr>
	      		<td><strong>&nbsp;&nbsp;&nbsp;Account Name <span class="required">*</span>:</strong></td>
	      		<td><input name="account_name" type="text" class="form-control w-50" /></td>
	    	</tr>
	    	<tr>
	  			<td>
	  				<h4 class="section">Bank Details</h4>
	  			</td>
	  		</tr>
	    	<tr>
	      		<td><strong>&nbsp;&nbsp;&nbsp;Bank Name <span class="required">*</span>:</strong></td>
	      		<td><input name="bank_name" type="text" class="form-control w-50" /></td>
	   	 	</tr>
	    	<tr>
	      		<td><strong>&nbsp;&nbsp;&nbsp;Country <span class="required">*</span>:</strong></td>
	      		<td><input name="country" type="text" class="form-control w-50" /></td>
	    	</tr>
	    	<tr>
	  			<td>
	  				<h4 class="section">Branch Address</h4>
	  			</td>
	  		</tr>
	    	<tr>
	      		<td><strong>&nbsp;&nbsp;&nbsp;Address <span class="required">*</span>:</strong></td>
	      		<td><input name="address" type="text" class="form-control w-50" /></td>
	   	 	</tr>
	    	<tr>
	      		<td><strong>&nbsp;&nbsp;&nbsp;City <span class="required">*</span>:</strong></td>
	      		<td><input name="city" type="text" class="form-control w-50" /></td>
	    	</tr>
	    	<tr>
	      		<td><strong>&nbsp;&nbsp;&nbsp;Postal Code:</strong></td>
	      		<td><input name="post_code" type="text" class="form-control w-50" /></td>
	    	</tr>
	    	<tr>
	      		<td></td>
	      		<td>
	        		<input name="btm" type="submit" value="Save"  class="orange_btn btn text-white" style="margin-right:10px;" />
	        		<input name="btm1" type="submit"value="Cancel" class="orange_btn btn text-white" style="margin-right:10px;" />
	      		</td>
	    	</tr>
	  	</table>
  	</form>
</div>
<!-- End Mid Right -->
<?
	$this->load->view("restaurantportal/footer_view");
?>
