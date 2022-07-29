<?
$this->load->view("restaurantportal/header_view");
$this->load->view("restaurantportal/sidepanel_view");
?>
<?
$this->load->view("restaurantportal/top_bar");
?>
<!-- Start Mid Right -->
<div class="title_bar">
    <h1>Change Password</h1>
</div>
<div class="mid-right">
    <?
            if (isset($success["msg"]))
			{
			?>
    <div class="ui-widget">
        <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
            <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                <strong><?= $success["msg"] ?></strong>
            </p>
        </div>
    </div>
    <?
            }
			?>
    <?
            if (isset($errors) && count($errors))
			{
			?>
    <br />
    <div class="ui-widget">
        <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
            <?
                    foreach ($errors as $error)
					{
						echo $error;
					}
					?>

        </div>

    </div>
    <?
            }
			?>
    <br class="clear" />
    <br />
    <?
            $attributes = array('id' => 'frmchangepassword','name' => 'frmchangepassword');
            echo form_open(base_url().'restaurantsettings/changepassword',$attributes);
            ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="password">
        <tr>
            <td style="width:20%;"><strong>Old Password:</strong></td>
            <td><input name="currentpassword" type="password" class="form-control change_password_input w-50 " /></td>
        </tr>
        <tr>
            <td><strong>New Password:</strong></td>
            <td><input name="Password" type="password" class="form-control change_password_input w-50 " /></td>
        </tr>
        <tr>
            <td><strong>Retype Password:</strong></td>
            <td><input name="ConfirmPassword" type="password" class="form-control  change_password_input w-50 " /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input name="btm" type="submit" value="Send" class="orange_btn btn change_password_btn mb-2 text-white"
                    style="margin-right:10px;" />
                <input name="btm1" type="submit" value="Cancel"
                    class="orange_btn  change_password_btn btn mb-2 text-white" style="margin-right:10px;" />
            </td>
        </tr>
    </table>
    </form>
</div>

<!-- End Mid Right -->
<?
$this->load->view("restaurantportal/footer_view");
?>