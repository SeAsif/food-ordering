<?
		$this->load->view( 'admin/header_view');
?>
		<?=form_open_multipart(base_url().'admindefaultvariants/edit/'.$variantInfo["id"])?>
			<div class="trl-menu">
	<? 
	if(isset($breadcrumbs))
	{
			echo $breadcrumbs;
	}
	?>
            </div>
            <br class="clear" />
			
            <table align="center" width="500" cellpadding="5" cellspacing="1" class="tablebg">

				<tr>
					<td align="center" colspan="5" class="tdHead"><strong>Add Default Variant </strong></td>
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
                  </div>
                  </td>
			  </tr>
				<tr>
				  <td align="left" class="tdRow">Name</td>
				  <td align="left" class="tdRow">
                  <input type="text" name="name" value="<?=$variantInfo["name"]?>" />
                  </td>
			    </tr>

				<tr>
					<td align="left" class="tdRow" width="35%">Price</td>
					<td align="left" class="tdRow">
					<input name="price" type="text" value="<?=$variantInfo["price"]?>">	
                    <input type="hidden" name="id" value="<?=$variantInfo["id"]?>">
                    </td>
				</tr>
				<tr>
					<td align="left" class="tdRow" width="35%">Terminal Name</td>
					<td align="left" class="tdRow"><?=$status?>
                    </td>
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