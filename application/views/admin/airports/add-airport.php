<?
		$this->load->view( 'admin/header_view');
?>
<script>
	function check()
	{
		if(document.add.name.value == "")
		{
			alert("Event Name not given");
			document.add.name.focus();
			return;
		}
		if(document.add.detail.value == "")
		{
			alert("Detail not given");
			document.add.detail.focus();
			return;
		}
		
		document.add.submit();
	}
</script>
		<?=form_open_multipart(base_url().'adminairport/add_airport')?>
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
					<td align="center" colspan="5" class="tdHead"><strong>Add Airport </strong></td>
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
					<td align="left" class="tdRow" width="35%">Airport Name</td>
					<td width="50" align="left" class="tdRow">
					<input name="name" type="text" class="input" size="50" maxlength="255" value="<?=$airportdata["airport_name"]?>">					</td>
					
				</tr>
				<tr>
					<td align="left" class="tdRow" width="35%">Airport Code</td>
					<td width="50" align="left" class="tdRow">
					<input name="code" type="text" class="input" size="50" maxlength="255" value="<?=$airportdata["airport_code"]?>">					</td>
					
				</tr>
				<tr>
					<td align="left" class="tdRow" width="35%">State Tax (%)</td>
					<td width="50" align="left" class="tdRow">
					<input name="statetax" type="text" class="input" size="50" maxlength="255" value="<?=$airportdata["airport_statetax"]?>">					</td>
					
				</tr>
                <tr>
					<td align="left" class="tdRow" width="35%">City Tax (%)</td>
					<td width="50" align="left" class="tdRow">
					<input name="citytax" type="text" class="input" size="50" maxlength="255" value="<?=$airportdata["airport_citytax"]?>">					</td>
					
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