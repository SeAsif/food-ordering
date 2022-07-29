<?
$this->load->view("userfront/header_view");

?>

    	<div class="crum-menu">
        	<a href="<?=base_url()?>home">Home</a><span>&gt;</span>
            <a href="<?=base_url()?>useraccount/accountsetting">Account Settings</a><span>&gt;</span>
            Update Account
        </div>
		<div class="cont-wrap">
        	<div class="cont-round"><img src="<?=base_url()?>images/front/rest-top.jpg" alt="top" border="0" /></div>
        	<div class="rest-mid">

            <!-- Start Restaurant Account Settings Head -->
				<div class="account-hed">
                	<h1>Update Account<br /><span>Change Your Name, Email, Adress and Password</span></h1>
					<?
					 if(isset($errors))  	
					 {
					   if (isset($errors) && count($errors) > 0)
					   {
						   foreach ($errors as $error)
						   {
							echo $error;
						   }
					   }
					 } 
					?>                                    
                    
                </div>
            <!-- End Restaurant Account Settings Head -->
				<br class="clear" />
            
                <!-- Start Error Success Msg -->
						<?
                        if (isset($success["msg"]))
                        {
                        ?>
                        <div class="ui-widget">
                            <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"> 
                                <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                                <strong><?=$success["msg"]?></strong></p>
                            </div>
                        </div>
                        <?
                        }
                        ?>
                        <?
                        if (isset($errors) && count($errors))
                        {
                        ?>
                        <br/>
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
                <!-- End Error Success Msg -->

			
            <!-- Start Update Account Form Section -->
            <form action="" method="post">
				<div class="account-form" style="">
                	<div class="float-left">
                        <h2>Change Profile Name</h2>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:20px;">
                          <tr>
                            <td><strong>First Name</strong></td>
                          </tr>
                          <tr>
                            <td>
                            <input name="firstname" type="text" class="txt-field" value="<?=$userDetail[0]["firstname"]?>" /></td>
                          </tr>
                          <tr>
                            <td style="padding-top:10px;"><strong>Last Name</strong></td>
                          </tr>
                          <tr>
                            <td><input name="lastname" type="text" class="txt-field" value="<?=$userDetail[0]["lastname"]?>"/></td>
                          </tr>
                        </table>
                        <h2>Change Email Address</h2>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:20px;">
                          <tr>
                            <td><strong>Old Email Address</strong></td>
                          </tr>
                          <tr>
                            <td><input name="email" type="text" class="txt-field" value="<?=$userDetail[0]["email"]?>" readonly="readonly"/></td>
                          </tr>
                          <tr>
                            <td style="padding-top:10px;"><strong>New Email Address</strong></td>
                          </tr>
                          <tr>
                            <td><input name="newemail" type="text" class="txt-field" /></td>
                          </tr>
                          <tr>
                            <td style="padding-top:10px;"><strong>Retype Email Address</strong></td>
                          </tr>
                          <tr>
                            <td><input name="confemail" type="text" class="txt-field" /></td>
                          </tr>
                        </table>
                    </div>
                	<div class="float-right">
                        <!--<h2>Address</h2>-->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:16px;">
                          <tr>
                            <td>
                            <!--<textarea name="address" class="txt-area"><?=$userDetail[0]["address"]?></textarea>-->
                            <input type="hidden" name="address" value="<?=$userDetail[0]["address"]?>" />
                            </td>
                          </tr>
                        </table>
                        <h2>Change Password</h2>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:20px;">
                          <tr>
                            <td><strong>Old Password</strong></td>
                          </tr>
                          <tr>
                            <td><input name="pass" type="password" class="txt-field" /></td>
                          </tr>
                          <tr>
                            <td style="padding-top:10px;"><strong>New Password</strong></td>
                          </tr>
                          <tr>
                            <td><input name="newpass" type="password" class="txt-field" /></td>
                          </tr>
                          <tr>
                            <td style="padding-top:10px;"><strong>Retype Password</strong></td>
                          </tr>
                          <tr>
                            <td><input name="confpass" type="password" class="txt-field" /></td>
                          </tr>
                        </table>
                    </div>
                    <br class="clear" />
					<div style="margin:0px auto; width:135px;">					                    
                    	<input name="btn" type="submit" class="btn" value="Save Changes"  />
                    </div>
                </div>
            </form>    
            <!-- End Update Account Form Section -->

            </div>
        	<div class="cont-round"><img src="<?=base_url()?>images/front/rest-bottom.jpg" alt="top" border="0" /></div>
        </div>

<?
$this->load->view("userfront/footer_view");
?>