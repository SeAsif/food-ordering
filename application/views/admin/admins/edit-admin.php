<?
		$this->load->view( 'admin/header_view');
?>
<?=form_open_multipart(base_url().'admin/edit_admin/'.$userDetail["admin_id"])?>
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
					<td align="center" colspan="5" class="tdHead"><strong>Edit Admin</strong></td>
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
					<input name="email" type="text" class="input" size="56" maxlength="255" value="<?=$userDetail["admin_email"]?>">		
                    <input type="hidden" name="id" value="<?=$userDetail["admin_id"]?>">                    			</td>
					<input type="hidden" name="hidden">
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
					<td align="center" class="tdRow"></td>
					<td align="center" class="tdRow">
							<input type="submit" class="btn" value="Submit" >
                    </td>
				</tr>
		</table>
</form>
<?
		$this->load->view( 'admin/footer_view');

?>
