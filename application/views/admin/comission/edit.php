<?
		$this->load->view( 'admin/header_view');
?>
		<?=form_open_multipart(base_url().'admincomissions/edit/'.$comissionInfo["id"])?>
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
					<td align="center" colspan="5" class="tdHead"><strong>Add Comission Slot </strong></td>
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
				  <td align="left" class="tdRow">Start minute</td>
				  <td align="left" class="tdRow">
                  <input type="text" name="start" value="<?=$comissionInfo["start"]?>" />                  </td>
			    </tr>

				<tr>
					<td align="left" class="tdRow" width="35%">End minute</td>
					<td align="left" class="tdRow">
					<input name="end" type="text" value="<?=$comissionInfo["end"]?>">	
                    <input type="hidden" name="id" value="<?=$comissionInfo["id"]?>">                    </td>
				</tr>
				<tr>
				  <td align="center" class="tdRow">Percentage in %</td>
				  <td align="center" class="tdRow"><input name="percent" type="text" value="<?=$comissionInfo["percent"]?>">%	</td>
			  </tr>
				<tr>
					<td align="center" class="tdRow"></td>
					<td align="center" class="tdRow">
							<input type="submit" class="btn" value="Submit" >                    </td>
				</tr>
			</table>
		</form>
<?
		$this->load->view( 'admin/footer_view');
?>