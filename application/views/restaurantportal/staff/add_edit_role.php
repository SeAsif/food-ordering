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
echo form_open(base_url().'restaurantstaff/add_edit_role/'.$role["id"],$attributes);
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
            				<td><strong>Role Title:</strong></td>
            				<td><input name="role_name" id="role_name" type="text" class="txt-field" value="<?= $role["role_name"] ?>" /></td>
          				</tr>
          				<tr>
            				<td><strong>Location/Department:</strong></td>
            				<td><input name="department" id="department" type="text" class="txt-field" value="<?= $role["department"] ?>" /></td>
          				</tr>
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
					                  	<td><input name="status" type="radio" value="1" <?= ($role["status"] == 1 || $role["status"] == "") ? 'checked="checked"' : '' ?> /></td>
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
			                  			<td><input name="status" type="radio" value="0" <?= ($role["status"] == 0) ? 'checked="checked"' : '' ?> /></td>
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