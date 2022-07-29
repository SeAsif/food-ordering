<?
$this->load->view("userfront/header_view");
?>

    	<div class="crum-menu">
        	<a href="<?=base_url()?>home">Home</a><span>&gt;</span>
            <a href="<?=base_url()?>useraccount/accountsetting">Account Settings</a><span>&gt;</span>
            Payment Preferences
        </div>
		<div class="cont-wrap">
        	<div class="cont-round"><img src="<?=base_url()?>images/front/rest-top.jpg" alt="top" border="0" /></div>
        	<div class="rest-mid">

            <!-- Start Restaurant Account Settings Head -->
				<div class="account-hed">
                	<h1>Payment Preferences</h1>
                </div>
            <!-- End Restaurant Account Settings Head -->
				<br class="clear" />
			
            <!-- Start Update Account Form Section -->
				<div class="account-form">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:20px;">
                      <tr>
                        <td><strong>Payment Options</strong></td>
                      </tr>
                      <tr>
                        <td><select name="menu" class="combowd" style="width:276px;"></select></td>
                      </tr>
                      <tr>
                        <td style="padding-top:10px;"><strong>Card Number</strong></td>
                      </tr>
                      <tr>
                        <td><input name="name" type="text" class="txt-field" style="width:264px;" /></td>
                      </tr>
                      <tr>
                        <td style="padding-top:10px;"><strong>Name</strong></td>
                      </tr>
                      <tr>
                        <td><input name="name" type="text" class="txt-field" style="width:264px;" /></td>
                      </tr>
                      <tr>
                        <td style="padding-top:10px;"><strong>Expiry Date</strong></td>
                      </tr>
                      <tr>
                        <td><input name="name" type="text" class="txt-field02" /></td>
                      </tr>
                      <tr>
                        <td style="padding-top:10px;"><strong>State</strong></td>
                      </tr>
                      <tr>
                        <td><select name="menu" class="combowd" style="width:276px;"></select></td>
                      </tr>
                      <tr>
                        <td style="padding-top:10px;"><strong>Zip</strong></td>
                      </tr>
                      <tr>
                        <td><input name="name" type="text" class="txt-field" style="width:264px;" /></td>
                      </tr>
                      <tr>
                        <td style="padding-top:10px;"><strong>Street Address</strong></td>
                      </tr>
                      <tr>
                        <td><textarea name="name" class="txt-area" style="width:264px;"></textarea></td>
                      </tr>
                      <tr>
                        <td style="padding-top:20px;">
                        	<input name="box" type="checkbox" value="" style="margin-right:10px;" />
                            <strong>mark as default payment option</strong>
                        </td>
                      </tr>
                    </table>
                    <input name="btn" type="button" class="btn float-left" value="Update" />
                </div>
            <!-- End Update Account Form Section -->

            </div>
        	<div class="cont-round"><img src="<?=base_url()?>images/front/rest-bottom.jpg" alt="top" border="0" /></div>
        </div>

<?
$this->load->view("userfront/footer_view");
?>