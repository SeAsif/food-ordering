<?
		$this->load->view( 'admin/header_view');

?>
<?=form_open_multipart(base_url().'admin/add_user')?>
			<div class="trl-menu">
	<? 
	if(isset($breadcrumbs))
	{
			echo $breadcrumbs;
	}
	?>
                
            </div>
            <br class="clear" />
			<table align="center" cellpadding="5" cellspacing="1" class="tablebg">

				<tr>
					<td align="center" colspan="5" class="tdHead"><strong>Add Restaurant Manager</strong></td>
				</tr>
				<tr>
				  <td colspan="2" class="tdRow" style="color:#FF0000">
                  <div align="center">
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
                  </div>                  </td>
			  </tr>
				

				<tr>
					<td align="left" class="tdRow" width="162">Email</td>
					<td width="404" align="left" class="tdRow">
					<input name="email" type="text" class="input" size="56" maxlength="255" value="<?=set_value("email");?>">					</td>
					<input type="hidden" name="hidden">
				</tr>
				<tr>
				  <td align="left" class="tdRow">First Name</td>
				  <td align="left" class="tdRow">
                  <input name="firstname" type="text" class="input" size="56" maxlength="255" value="<?=set_value("firstname");?>">                  </td>
			  </tr>
				<tr>
				  <td align="left" class="tdRow">Last Name</td>
				  <td align="left" class="tdRow">
                  <input name="lastname" type="text" class="input" size="56" maxlength="255" value="<?=set_value("lastname");?>">                  </td>
			  </tr>
				<tr>
				  <td align="left" class="tdRow">Password</td>
				  <td align="left" class="tdRow">
                  <input name="password" type="password" class="input" size="56" maxlength="255">                  </td>
			  </tr>
				<tr>
				  <td align="left" class="tdRow">Confirm Password</td>
				  <td align="left" class="tdRow">
                  <input name="passconf" type="password" class="input" size="56" maxlength="255">                  </td>
			  </tr>
              
              
              <tr>
				  <td align="left" class="tdRow">Contact Number</td>
				  <td align="left" class="tdRow">
                  <input name="phone_number" id="phone_number" type="text" class="input" size="56" maxlength="255" value="<?=set_value("phone_number");?>">                  </td>
			  </tr>
              
              
              
              <tr>
				  <td align="left" class="tdRow">Address Line1</td>
				  <td align="left" class="tdRow">
                  <input name="address_line1" id="address_line1" type="text" class="input" size="56" maxlength="255" value="<?=set_value("address_line1");?>">                  </td>
			  </tr>
              
              <tr>
				  <td align="left" class="tdRow">Address Line2</td>
				  <td align="left" class="tdRow">
                  <input name="address_line2" id="address_line2" type="text" class="input" size="56" maxlength="255" value="<?=set_value("address_line2");?>">                  </td>
			  </tr>
              
              <tr>
				  <td align="left" class="tdRow">City</td>
				  <td align="left" class="tdRow">
                  <input name="city" id="city" type="text" class="input" size="56" maxlength="255" value="<?=set_value("city");?>">                  </td>
			  </tr>
              
              <tr>
				  <td align="left" class="tdRow">State</td>
				  <td align="left" class="tdRow">
                  <input name="state" id="state" type="text" class="input" size="56" maxlength="255" value="<?=set_value("state");?>">                  </td>
			  </tr>
              
              <tr>
				  <td align="left" class="tdRow">zip</td>
				  <td align="left" class="tdRow">
                  <input name="zip" id="zip" type="text" class="input" size="56" maxlength="255" value="<?=set_value("zip");?>">                  </td>
			  </tr>
              <tr>
				  <td align="left" class="tdRow">Country</td>
				  <td align="left" class="tdRow">
                  <select id="country_id" name="country_id" class="combowd float-left">
                  <option value="select">Select Country</option>
                  <option value="1">USA</option>
                  <option value="2">Canada</option>
                  <option value="3">Nigeria</option>
                  </select>
                  </td>
			  </tr>
              
           <!--   
				<tr>
				  <td align="left" class="tdRow">Address</td>
				  <td align="left" class="tdRow"><textarea name="address" id="textarea" cols="35" rows="5"><?=set_value("address");?></textarea></td>
			  </tr> -->
              	<tr>
				  <td align="left" class="tdRow">Status</td>
				  <td align="left" class="tdRow"><?=$statusDD?></td>
			  </tr>
				
				
				<tr>
					<td align="center" colspan="2" class="tdRow">
							<input type="submit" class="button" value="Submit" >										</td>
				</tr>
		</table>
</form>
<?
		$this->load->view( 'admin/footer_view');

?>
