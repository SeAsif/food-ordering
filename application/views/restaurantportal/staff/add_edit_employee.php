<link href="<?= base_url() ?>css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="<?= base_url() ?>css/cupertino/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?= base_url() ?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/jquery-ui-1.8.6.custom.min.js"></script>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
<style>
	form,
	body {
		box-shadow: none !important;
		background: 0px none !important;
	}

	input.txt-field,
	input.form-control,
	.txtarea,
	.custom-select,
	select {
		display: inline-block;
		width: 70%;
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
	a.global-link span
	{
		background-image:none !important;
		color: white !important;
	}
	a img
	{
		display:none !important;
	}
	a.global-link {
		background: none !important;
		border-color: transparent !important;
		color: white !important;
		outline: none !important;
		min-height: 30px !important;
		border-radius:5px !important;
		font-size: 15px !important;
		min-width: 30px !important;
		background-color: #f36737 !important;
	}

	.ui-widget-header
    {
        background: white !important;
        border-color: transparent !important;
    }
    
    .ui-widget-content
    {
        background: white !important;
    }
    
    .ui-state-hover span{
    	font-weight:normal !important;
	}
     
    .ui-state-default,
	.ui-widget-content .ui-state-default,
	.ui-widget-header .ui-state-default {
	    background: none !important;
	    border-color: transparent !important;
	    color: white !important;
	    outline: none !important;
	    min-height: 20px !important;
	    font-size: 16px !important;
	    min-width: 30px !important;
	    background-color: #f36737 !important;
	}
      
    input {
	    display: inline-block;
	    width: 70%;
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
</style>

<script language="javascript">
	<? if (isset($success["msg"])) { ?>
    	var successMgs = '<?= $success["msg"] ?>';
    <? } else { ?>
    	var successMgs = '';
    <? } ?>

  	$(document).ready(function() {

  		if (successMgs != "") {
	      	var objRef = parent.window;
	      	objRef.refreshItemPage(successMgs);
	    }

    	$("#add_edit_role").click(function() {
      		$('#frmAddEditRole').submit();
		});

  	});
</script>

<?
$attributes = array('id' => 'frmAddEditRole','name' => 'frmAddEditRole');
echo form_open(base_url().'restaurantstaff/add_edit_employee/'.$employee["id"],$attributes);
?>
	<div class="add-item">
  		<? if (isset($success["msg"])) { ?>
  			<div class="ui-widget">
    			<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
      				<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
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

  		<table width="100%" border="0" cellspacing="0" cellpadding="0">
    		<tr>
      			<td style="padding-top:14px;">
        			<table width="100%" border="0" cellspacing="0" cellpadding="0">
          				<tr>
            				<td><strong>First Name:</strong></td>
            				<td><input name="firstname" id="firstname" type="text" class="txt-field" value="<?= $employee["firstname"] ?>" /></td>
          				</tr>
          				<tr>
            				<td><strong>Last Name:</strong></td>
            				<td><input name="lastname" id="lastname" type="text" class="txt-field" value="<?= $employee["lastname"] ?>" /></td>
          				</tr>
          				<tr>
            				<td><strong>Email:</strong></td>
            				<td><input name="email" id="email" type="email" class="txt-field" value="<?= $employee["email"] ?>" /></td>
          				</tr>
          				<tr>
            				<td><strong>Role:</strong></td>
            				<td>
            					<select name="role_id" class="form-control" style="width:242px; float:left; margin-right:10px;">
                					<option value="">Please Select Role</option>
                        			<?php if (!empty($roles)) { ?>
	                        			<?php foreach ($roles as $key => $role) { ?>
	                        				<option value="<?php echo $role["id"]; ?>" <?php echo $employee["role_id"] == $role["id"] ? "selected='selected'" : ''; ?>>
	                        					<?php echo $role["role_name"]; ?>
	                        				</option>
	                        			<?php } ?>
                        			<?php } ?>
                       			</select>
            				</td>
          				</tr>
          				<tr>
            				<td><strong>Phone Number:</strong></td>
            				<td><input name="phone_number" id="phone_number" type="text" class="txt-field" value="<?= $employee["phone_number"] ?>" /></td>
          				</tr>
          				<tr>
            				<td><strong>Address</strong></td>
            				<td><input name="address" id="address" type="text" class="txt-field" value="<?= $employee["address"] ?>" /></td>
          				</tr>
          				<tr>
            				<td><strong>Country:</strong></td>
            				<td>
            					<select id="country_id" name="country_id" class="form-control" style="width:242px; float:left; margin-right:10px;">
									<option value="select">Select Country</option>
									<option value="1" <?php echo $employee["country_id"] == 1 ? "selected='selected'" : ""; ?>>USA</option>
									<option value="2" <?php echo $employee["country_id"] == 2 ? "selected='selected'" : ""; ?>>Canada</option>
									<option value="3" <?php echo $employee["country_id"] == 3 ? "selected='selected'" : ""; ?>>Nigeria</option>
				                </select>
            				</td>
          				</tr>
          				<tr>
            				<td><strong>State:</strong></td>
            				<td><input name="state" id="state" type="text" class="txt-field" value="<?= $employee["state"] ?>" /></td>
          				</tr>
          				<tr>
            				<td><strong>City:</strong></td>
            				<td><input name="city" id="city" type="text" class="txt-field" value="<?= $employee["city"] ?>" /></td>
          				</tr>
          				<tr>
            				<td><strong>Zip:</strong></td>
            				<td><input name="zip" id="zip" type="text" class="txt-field" value="<?= $employee["zip"] ?>" /></td>
          				</tr>
          				<?php if ($employee["id"] == 0) { ?>
	          				<tr>
	            				<td><strong>Password:</strong></td>
	            				<td><input name="password" id="password" type="text" class="txt-field" value="" /></td>
	          				</tr>
	          				<tr>
	            				<td><strong>Confirm Password:</strong></td>
	            				<td><input name="passconf" id="passconf" type="text" class="txt-field" value="" /></td>
	          				</tr>
          				<?php } ?>
        			</table>
      			</td>
    		</tr>
    		<tr>
      			<td>
			        <table width="100%" border="0" cellspacing="0" cellpadding="0">
			          	<tr>
			            	<td><strong>Status:</strong></td>
			            	<td>
			              		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="add-variant">
					                <tr>
					                  	<td><input name="status" type="radio" value="Active" <?= ($employee["status"] == 'Active' || $employee["status"] == "") ? 'checked="checked"' : '' ?> /></td>
					                  	<td>Active</td>
					                  	<td>
					                    	<a href="#"><img src="<?= base_url() ?>images/Q-mark.png" alt="mark" border="0" /></a>
					                  	</td>
					                </tr>
			              		</table>
			            	</td>
			            	<td>
			              		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="add-variant">
			                		<tr>
			                  			<td><input name="status" type="radio" value="Inactive" <?= ($employee["status"] == "Inactive") ? 'checked="checked"' : '' ?> /></td>
			                  			<td>Inactive</td>
			                  			<td>
			                    			<a href="#"><img src="<?= base_url() ?>images/Q-mark.png" alt="mark" border="0" /></a>
			                  			</td>
			                		</tr>
			              		</table>
			            	</td>
			          	</tr>
			        </table>
      			</td>
		    </tr>
		    <tr>
      			<td>
			        <table width="100%" border="0" cellspacing="0" cellpadding="0">
			          	<tr>
			            	<td><strong>Is Manager:</strong></td>
			            	<td>
			              		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="add-variant">
					                <tr>
					                  	<td><input name="is_manager" type="radio" value="1" <?= ($employee["is_manager"] == 1 || $employee["is_manager"] == "") ? 'checked="checked"' : '' ?> /></td>
					                  	<td>Yes</td>
					                  	<td>
					                    	<a href="#"><img src="<?= base_url() ?>images/Q-mark.png" alt="mark" border="0" /></a>
					                  	</td>
					                </tr>
			              		</table>
			            	</td>
			            	<td>
			              		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="add-variant">
			                		<tr>
			                  			<td><input name="is_manager" type="radio" value="0" <?= ($employee["is_manager"] == 0) ? 'checked="checked"' : '' ?> /></td>
			                  			<td>No</td>
			                  			<td>
			                    			<a href="#"><img src="<?= base_url() ?>images/Q-mark.png" alt="mark" border="0" /></a>
			                  			</td>
			                		</tr>
			              		</table>
			            	</td>
			          	</tr>
			        </table>
      			</td>
		    </tr>
    		<tr>
      			<td style="padding:10px 0px 0px 0px;">
        			<a href="javascript:void(null);" id="add_edit_role" class="global-link float-left" style="margin-right:5px;">
          				<span>Save</span></a>
        			<a href="javascript:void(null)" onclick="parent.closeAddEditRole();" class="global-link float-left">
          				<span>Cancel</span></a>
      			</td>
    		</tr>
  		</table>
	</div>
</form>